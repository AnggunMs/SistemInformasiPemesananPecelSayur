<?php session_start();
include 'koneksi.php';
include "navigation.php";


if (!isset($_SESSION['pelanggan']) or empty($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//mendapatkan id_pembelian dari url
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT *FROM pembelian WHERE id_pembelian='$idpem' ");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem['id_pelanggan'];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];
if ($id_pelanggan_login !== $id_pelanggan_beli) {
	echo "<script>alert('Data diproteksi');</script>";
	echo "<script>location='history.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Pembayaran</title>
</head>

<body>

	<div class="container mt-5 mb-4">
		<h2>Konfirmasi Pembayaran</h2>
		<hr>
		<p>Kirim bukti pembayaran anda disini</p>
		<div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($detpem['total_pembelian']); ?></strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-user-alt"></i></span>
				</div>
				<input name="nama" type="text" class="form-control" placeholder="Your Name" aria-label="Username" aria-describedby="basic-addon1">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fab fa-cc-visa"></i></span>
				</div>
				<input name="bank" type="text" class="form-control" placeholder="Bank" aria-label="Username" aria-describedby="basic-addon1">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
				</div>
				<input type="number" readonly="" value="<?php echo ($detpem['total_pembelian']) ?>" name="jumlah" type="text" class="form-control" placeholder="Bank" aria-label="Username" aria-describedby="basic-addon1">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
				</div>
				<div class="custom-file">
					<input name="bukti" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
					<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
				</div>
			</div>
			<p class="text-danger">Foto Bukti Maksimal 2MB</p>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

	<?php
	// jika ada tombol kirim
	if (isset($_POST['kirim'])) {
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$picture = date("YmdHis") . "_" . $namabukti;
		move_uploaded_file($lokasibukti, "bukti_pembayaran/$picture");

		$nama = $_POST["nama"];
		$bank = $_POST["bank"];
		$jumlah = $_POST["jumlah"];
		$tanggal = date("Y-m-d");

		$koneksi->query("INSERT INTO pembayaran
			(id_pembelian,nama,bank,jumlah,tanggal,bukti)
			VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$picture') ");

		//update data pembelian

		$koneksi->query("UPDATE pembelian set status_pembelian = 'Sudah Kirim Pembayaran' WHERE id_pembelian='$idpem' ");

		echo "<script>alert('Terima Kasih Sudah Mengirimkan Bukti Pembayaran');</script>";
		echo "<script>location='history.php';</script>";
	}
	?>

	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>
</body>

</html>