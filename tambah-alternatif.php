<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1,2)); ?>

<?php
$errors = array();
$sukses = false;

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$alamat = (isset($_POST['alamat'])) ? trim($_POST['alamat']) : '';
$nomor_hp = (isset($_POST['nomor_hp'])) ? trim($_POST['nomor_hp']) : '';
$jk = (isset($_POST['jk'])) ? trim($_POST['jk']) : '';

if(isset($_POST['submit'])):	
	// Validasi
	if(!$nama && !$alamat && !$nomor_hp && !$jk) {
		$errors[] = 'Tidak boleh ada yang kosong!!';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		$simpan = mysqli_query($koneksi,"INSERT INTO alternatif (id_alternatif, nama, Alamat, Nomor_HP, Jenis_Kelamin) VALUES ('', '$nama', '$alamat', '$nomor_hp','$jk')");
		if($simpan) {
			redirect_to('list-alternatif.php?status=sukses-baru');
		}else{
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

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
			
<form action="tambah-alternatif.php" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-fw fa-plus"></i> Tambah Data Tenaga Magang</h6>
		</div>
		<div class="card-body">
			<div class="row">				
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $nama; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Alamat</label>
					<input autocomplete="off" type="text" name="alamat" required value="<?php echo $alamat; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nomor HP</label>
					<input autocomplete="off" type="number" name="nomor_hp" required value="<?php echo $nomor_hp; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Jenis Kelamin</label>
					<select name="jk" class="custom-select" required>
						<option selected>Pilih Jenis Kelamin</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	</div>
</form>

<?php
require_once('template/footer.php');
?>