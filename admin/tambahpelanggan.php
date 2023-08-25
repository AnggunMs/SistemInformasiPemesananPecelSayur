<h2>Data Pelanggan</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Pelanggan</label>
		<input type="text" name="nama" class="form-control" ">
	</div>
	<div class="form-group">
		<label>e-mail Pelanggan</label>
		<input type="text" name="email" class="form-control" ">
	</div>
	<div class="form-group">
		<label>Telepon</label>
		<input type="text" name="telepon" class="form-control" ">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" name="pass" class="form-control" ">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO pelanggan
		(nama_pelanggan,telepon,email_pelanggan,password_pelanggan)
		VALUES ('$_POST[nama]','$_POST[telepon]','$_POST[email]','$_POST[pass]')");
	
	echo "<script>alert('Data Tersimpan');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
}
?>