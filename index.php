<?php
session_start();
include "navigation.php";
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pecel Keliling</title>
</head>

<body>
	<!-- Page Content -->
	<div class="container mt-4">

		<div class="row">

			<div class="col-lg-3">

				<h1 class="my-4">Shopping List</h1>
				<div class="list-group">
					<a href="makanan.php" class="list-group-item font-weight-bold">Pecel Ibu Aminah</a>
				</div>

			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">

				<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<img class="d-block img-fluid" src="foto_produk/Logo_halaman.png" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block img-fluid" src="foto_produk/Gerobak.jpg" alt="Second slide">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<div class="row">

					<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
					<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<img class="card-img-top" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="img-responsive">
								<div class="card-body">
									<h4 class="card-title">
										<h4><?php echo $perproduk['nama_produk']; ?></h4>
									</h4>
									<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
									<small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
									<p>Stok : <?php echo $perproduk['stock'];  ?></p>
								</div>
								<div class="card-footer">
									<div class="input-group">
										<div class="input-group-prepend">
											<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"><button class="btn btn-outline-primary" type="button" id="button-addon1" name="beli">Beli</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

				</div>
				<!-- /.row -->

			</div>
			<!-- /.col-lg-9 -->

		</div>
		<!-- /.row -->

	</div>
	<!-- /.container -->

	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>

</body>

</html>