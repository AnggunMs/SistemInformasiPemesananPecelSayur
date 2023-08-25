<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT *FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre><?php //print_r($detail); 
			?></pre> -->

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
		Tanggal : <?php echo $detail['tgl_pembelian']; ?><br>
		Total : Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
		Status : <?php echo $detail['status_pembelian']; ?>
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
			<th>Nama</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Jumlah Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi->query("SELECT *FROM pembelian_produk JOIN produk ON
			pembelian_produk.id_produk=produk.id_produk
			WHERE pembelian_produk.id_pembelian = '$_GET[id]' ") ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
				<td><?php echo $pecah['jumlah']; ?></td>
				<td>Rp.
					<?php echo number_format($pecah['harga_produk'] * $pecah['jumlah']); ?>
				</td>
			</tr>
			</tr>
			<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>