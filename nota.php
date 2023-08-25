<?php
session_start();
include "navigation.php";
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Nota Pembelian</title>
</head>

<body>

	<section>
		<div class="container mt-5 mb-4">

			<h2>Detail Pembelian</h2>
			<hr>
			<?php
			$ambil = $koneksi->query("SELECT *FROM pembelian JOIN pelanggan
				ON pembelian.id_pelanggan=pelanggan.id_pelanggan
				WHERE pembelian.id_pembelian='$_GET[id]'");
			$detail = $ambil->fetch_assoc();
			?>

			<?php

			$id_pelanggan_yang_beli = $detail["id_pelanggan"];
			$id_pelanggan_yang_login = $_SESSION["pelanggan"]["id_pelanggan"];

			if ($id_pelanggan_yang_beli !== $id_pelanggan_yang_login) {
				echo "<script>alert('Data Diproteksi');</script>";
				echo "<script>location='history.php';</script>";
				exit();
			}
			?>

			<div class="row">
				<div class="col-md-4">
					<h3>Pembelian</h3>
					<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
					Tanggal : <?php echo $detail['tgl_pembelian']; ?><br>
					Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
					<?php echo $detail['telepon']; ?> <br>
					<?php echo $detail['email_pelanggan']; ?>
				</div>
			</div>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Jumlah Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1; ?>
					<?php $ambil = $koneksi->query("SELECT *FROM pembelian_produk
					WHERE id_pembelian = '$_GET[id]' ") ?>
					<?php while ($pecah = $ambil->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['nama_produk']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
							<td><?php echo $pecah['jumlah']; ?></td>
							<td>Rp. <?php echo number_format($pecah['total_harga']); ?></td>
						</tr>
						</tr>
						<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>

			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
							<strong>Ke BANK BCA 7620921453 AN. Pecel Keliling 2023</strong>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>
</body>

</html>