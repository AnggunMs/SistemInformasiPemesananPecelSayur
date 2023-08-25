<h2>Data Pembayaran</h2>

<?php

include 'koneksi.php';

//mendapatkan id_pembelian dari url
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT *FROM pembayaran WHERE id_pembelian='$id_pembelian' ");
$detail = $ambil->fetch_assoc();

?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<div>
				<img src="../bukti_pembayaran/<?php echo $detail['bukti']; ?>" alt="" class="img-responsive">
			</div>
			<br>
			<tr>
				<th>Nama</th>
				<td><?php echo $detail['nama']; ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detail['bank']; ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detail['tanggal']; ?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp. <?php echo number_format($detail['jumlah']); ?></td>
			</tr>
		</table>
	</div>
</div>

<form method="post">
	<div class="form-group">
		<select class="form-control" name="status">
			<option value="">Pilih Status</option>
			<option value="Menunggu Antrian">Menunggu</option>
			<option value="Sedang Dibuat">Proses</option>
			<option value="Selesai">Selesai</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST["proses"])) {
	$status = $_POST["status"];

	$koneksi->query("UPDATE pembelian SET status_pembelian ='$status' 
		WHERE id_pembelian='$id_pembelian' ");

	echo "<script>alert('Data Pembelian Terupdate');</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>