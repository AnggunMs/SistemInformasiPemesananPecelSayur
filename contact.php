<?php
session_start();
include "navigation.php";
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php
	$loc = $koneksi->query("SELECT * FROM lokasi ORDER BY id_lokasi DESC LIMIT 1");
	$location_data = $loc->fetch_assoc();
	?>

	<script>
		function openLocationOnGoogleMaps() {
			var latitude = <?php echo $location_data['latitude']; ?>;
			var longitude = <?php echo $location_data['longitude']; ?>;
			var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
			window.open(url, "_blank");
		}
	</script>

	<title>Contact</title>

</head>

<body>

	<!-- Page Content -->
	<div class="container mb-5">
		<div class="card bg-info mt-5 mx-auto" style="width: 25rem;">
			<div class="card-header mb-2" align="center"><strong>Our Contact Info Pecel Keliling</strong></div>
			<div class="card-body">
				<form role="form" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-store"></i></span>
						</div>
						<input type="text" class="form-control" name="nama" readonly="" placeholder="Pecel Keliling" aria-label="Nama" aria-describedby="basic-addon1">
					</div>
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile"></i></span>
						</div>
						<input type="text" class="form-control" name="mobile" readonly="" placeholder="081388180514" aria-label="Telepon" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
						</div>
						<input type="text" class="form-control" name="email" readonly="" placeholder="pecel_keliling@gmail.com" aria-label="@mail" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked"></i></span>
						</div>
						<button onclick="openLocationOnGoogleMaps()" class="btn btn-primary" name="open_google_maps">Open on Google Maps</button>
						<!-- <textarea name="alamat" placeholder="Jl. Citra Gading Residences, Cipocok Jaya, Kec. Cipocok Jaya, Kota Serang" readonly="" class="form-control" aria-label="With textarea"></textarea> -->
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>

</body>

</html>