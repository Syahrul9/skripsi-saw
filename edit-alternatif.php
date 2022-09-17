<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1,2)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_alternatif = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(isset($_POST['submit'])):	
	
	$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
	$alamat = (isset($_POST['alamat'])) ? trim($_POST['alamat']) : '';
	$nomor_hp = (isset($_POST['nomor_hp'])) ? trim($_POST['nomor_hp']) : '';
	$jk = (isset($_POST['jk'])) ? trim($_POST['jk']) : '';
	
	// Validasi
	if(!$nama && !$alamat && !$nomor_hp && !$jk) {
		$errors[] = 'Tidak boleh ada yang kosong!!';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$update = mysqli_query($koneksi,"UPDATE alternatif SET nama = '$nama', Alamat = '$alamat', Nomor_HP = '$nomor_hp', Jenis_Kelamin = '$jk' WHERE id_alternatif = '$id_alternatif'");
		if($update) {
			redirect_to('list-alternatif.php?status=sukses-edit');
		}else{
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Alternatif";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Tenaga Magang</h1>

	<a href="list-alternatif.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>
			
<?php if(!empty($errors)): ?>
	<div class="alert alert-info">
		<?php foreach($errors as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if($sukses): ?>
	<div class="alert alert-success">
		Data berhasil disimpan
	</div>	
<?php elseif($ada_error): ?>
	<div class="alert alert-info">
		<?php echo $ada_error; ?>
	</div>
<?php else: ?>		
			
<form action="edit-alternatif.php?id=<?php echo $id_alternatif; ?>" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-fw fa-edit"></i> Edit Data Tenaga Magang</h6>
		</div>
		<?php
		if(!$id_alternatif) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
		$data = mysqli_query($koneksi,"SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif'");
		$cek = mysqli_num_rows($data);
		if($cek <= 0) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
			while($d = mysqli_fetch_array($data)){
		?>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama']; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Alamat</label>
					<input autocomplete="off" type="text" name="alamat" required value="<?php echo $d['Alamat']; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nomor HP</label>
					<input autocomplete="off" type="number" name="nomor_hp" required value="<?php echo $d['Nomor_HP']; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Jenis Kelamin</label>
					<select name="jk" class="custom-select" required  >
						<option value="<?php echo $d['Jenis_Kelamin']; ?>" selected><?php echo $d['Jenis_Kelamin']; ?></option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>
		</div>
	
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
		<?php
		}
		}
		}
		?>
	</div>
</form>

<?php
endif;
require_once('template/footer.php');
?>