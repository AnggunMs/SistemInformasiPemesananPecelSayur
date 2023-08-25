<?php
session_start();
include "navigation.php";
include "koneksi.php";
if (!isset($_SESSION['pelanggan'])) 
{
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
elseif (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) 
{
	echo "<script>alert('Keranjang Anda Kosong, Silahkan Belanja Dahulu!');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Keranjang Belanja</title>

</head>

<body>

	<!-- Page Content -->
	<section class="content mt-4" style="margin-bottom: 200px;">
		<div class="container">
			<div align="left">
				<br>
				<h2>Keranjang Belanja</h2>
				<hr>
			</div>
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Jumlah Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$nomor = 1; ?>
					<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
						
						<?php
						$ambil = $koneksi->query("SELECT *FROM produk
							WHERE id_produk = '$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$totalharga = $pecah['harga_produk']*$jumlah;
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['nama_produk']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
							<td><?php echo $jumlah; ?></td>
							<td>Rp. <?php echo number_format($totalharga);?></td>
							<td>
								<a href="hapuskeranjang.php?id=<?php echo $id_produk?>" class="btn btn-danger btn-xs">Batal</a>
							</td>
						</tr>
						<?php $nomor++;?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-secondary">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</section>

	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>

</body>
</html>
