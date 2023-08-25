<?php session_start();
include 'koneksi.php';
include "navigation.php";
include "koneksi.php";

$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT *FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian' ");
$detbay = $ambil->fetch_assoc();

if (empty($detbay)) {
	echo "<script>alert('Belum Ada Data Pembayaran');</script>";
	echo "<script>location='history.php';</script>";
	exit();
}

if ($_SESSION["pelanggan"]['id_pelanggan'] !== $detbay["id_pelanggan"]) {
	echo "<script>alert('Anda Tidak Berhak Melihat Pembayaran Orang lain');</script>";
	echo "<script>location='history.php';</script>";
}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Lihat Pembayaran</title>
</head>

<body>
	<div class="container mt-5 mb-5">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td><?php echo $detbay["nama"] ?></td>
					</tr>
					<tr>
						<th>Bank</th>
						<td><?php echo $detbay["bank"] ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?php echo $detbay["tanggal"] ?></td>
					</tr>
					<tr>
						<th>Jumlah</th>
						<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<div class="card bg-dark text-white">
					<img src="bukti_pembayaran/<?php echo $detbay['bukti']; ?>" class="img-thumbnail" alt="...">
					<div class="card-img-overlay">
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>
</body>

</html>