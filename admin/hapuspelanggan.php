<?php
$ambil = $koneksi->query("SELECT *FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$pelanggan = $pecah['id_pelanggan'];


$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
?>