<?php
session_start();
include "navigation.php";
include "koneksi.php";

if (!isset($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
} elseif (empty($_SESSION['keranjang'])) {
	echo "<script>alert('Keranjang Anda Kosong, Silahkan Belanja Dahulu!');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Checkout</title>
	<style>
		/* Set tinggi div peta agar dapat terlihat */
		#map {
			height: 400px;
			width: 100%;
			margin-bottom: 50px;
		}
	</style>

</head>

<body>

	<!-- Page Content -->
	<section class="content mt-4 mb-1">
		<div class="container">
			<div align="left">
				<br>
				<h2>Checkout</h2>
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
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php $nomor = 1; ?>
						<?php $totalbelanja = 0; ?>
						<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
							<!---menampilkan produk yang sedang dibeli-->
							<?php
							$ambil = $koneksi->query("SELECT *FROM produk
								WHERE id_produk = '$id_produk'");
							$pecah = $ambil->fetch_assoc();
							$subharga = $pecah['harga_produk'] * $jumlah;
							?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja += $subharga; ?>
				<?php endforeach ?>
				</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>

			<form method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo ($_SESSION['pelanggan']['nama_pelanggan']) ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo ($_SESSION['pelanggan']['telepon']) ?>" class="form-control">
						</div>
					</div>
				</div>
				<button class="btn btn-primary mb-3" name='checkout'>Checkout</button>
				<button onclick="openLocationOnGoogleMaps()" class="btn btn-primary mb-3" name="open_google_maps">Open on Google Maps</button>
			</form>
			<p class="font-weight-bolder">Lokasi Penjual</p>
			<?php
			$loc = $koneksi->query("SELECT * FROM lokasi ORDER BY id_lokasi DESC LIMIT 1");
			$location_data = $loc->fetch_assoc();
			?>
			<div id="map"></div>
			<script>
				function initMap() {
					var latitude = <?php echo $location_data['latitude']; ?>;
					var longitude = <?php echo $location_data['longitude']; ?>;

					var mapOptions = {
						center: {
							lat: latitude,
							lng: longitude
						},
						zoom: 15
					};

					// Membuat peta baru
					var map = new google.maps.Map(document.getElementById('map'), mapOptions);

					// Menambahkan marker pada lokasi
					var marker = new google.maps.Marker({
						position: {
							lat: latitude,
							lng: longitude
						},
						map: map
					});
				}

				function openLocationOnGoogleMaps() {
					var latitude = <?php echo $location_data['latitude']; ?>;
					var longitude = <?php echo $location_data['longitude']; ?>;
					var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
					window.open(url, "_blank");
				}
			</script>
			<!-- Add your other JavaScript scripts here if needed -->
			<!-- Make sure to replace YOUR_GOOGLE_MAPS_API_KEY with your actual API key -->
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDy8lalbliWCHFvDkEQeXHR26NPsMO3E7k&callback=initMap" async defer></script>

			<?php
			if (isset($_POST['checkout'])) {
				$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
				$tanggal_pembelian = date('Y-m-d');

				//1. meninput data ke tabel pembelian
				$koneksi->query("INSERT INTO pembelian (
					id_pelanggan,id_produk,tgl_pembelian,total_pembelian,status_pembelian)
					VALUES ('$id_pelanggan','$id_produk','$tanggal_pembelian','$totalbelanja','Pending') ");

				//2. meninput data ke tabel pembelian_produk
				//mendapatkan id_pembelian barusan
				$id_pembelian_barusan = $koneksi->insert_id;

				foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
					//mendapatkan data produk berdasarkan id_produk
					$ambil = $koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk' ");
					$perproduk = $ambil->fetch_assoc();

					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];
					$total_harga = $perproduk['harga_produk'] * $jumlah;

					$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah,nama_produk,harga_produk,total_harga)
						VALUES ('$id_pembelian_barusan','$id_produk','$jumlah','$nama','$harga',
						'$total_harga') ");

					$koneksi->query("UPDATE produk SET stock =stock-$jumlah WHERE id_produk = '$id_produk' ");
				}

				//tampilan dialihkan ke halaman nota dari pembelian barusan
				echo "<script>alert('Pembelian Sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

				//mengkosongkan keranjang belanja
				unset($_SESSION['keranjang']);
			}
			?>

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