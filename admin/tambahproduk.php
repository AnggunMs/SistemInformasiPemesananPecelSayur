<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Stock</label>
		<input type="number" class="form-control" name="stock">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-gorup">
		<label>Foto</label>
		<input type="file" class="from-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save'])) {
	$picture = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../dist/foto_produk/" . $picture);
	$koneksi->query("INSERT INTO produk
		(nama_produk,stock,harga_produk,foto_produk,deskripsi_produk)
		VALUES ('$_POST[nama]','$_POST[stock]',$_POST[harga],'$picture','$_POST[deskripsi]')");

	echo "<script>alert('Data Tersimpan');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>