<?php
session_start();
include "navigation.php";
include "koneksi.php";
if (!isset($_SESSION['pelanggan']) or empty($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Riwayat Belanja</title>

</head>

<body>

	<!-- Page Content -->
	<section class="content mt-4" style="margin-bottom: 320px;">
		<div class="container">
			<div align="left">
				<br>
				<h3>Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?></h3>
				<hr>
			</div>
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;
					$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
					$ambil = $koneksi->query("SELECT *FROM pembelian WHERE id_pelanggan = '$id_pelanggan' ");
					while ($pecah = $ambil->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $nomor ?></td>
							<td><?php echo $pecah["tgl_pembelian"]; ?></td>
							<td>
								<?php echo $pecah["status_pembelian"]; ?>
							</td>
							<td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
							<td>
								<a href="nota.php?id=<?php echo ($pecah["id_pembelian"]) ?>" class="btn btn-info">Nota</a>
								<?php if ($pecah["status_pembelian"] == "Pending") : ?>
									<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-warning">Pembayaran</a>
								<?php else : ?>
									<a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Lihat Pembayaran</a>
								<?php endif ?>
							</td>
							</td>
						</tr>
						<?php $nomor++; ?>
					<?php } ?>
				</tbody>
			</table>
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