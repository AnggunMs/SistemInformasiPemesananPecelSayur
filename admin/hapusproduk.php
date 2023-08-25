<?php
$ambil = $koneksi->query("SELECT *FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$gambar = $pecah['foto_produk'];
if (file_exists("../foto_produk/$gambar"))
{
	unlink("../foto_produk/$gambar");
}

$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('Produk Terhapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
?>