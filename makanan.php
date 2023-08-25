<?php
session_start();
include "navigation.php";
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title> Makanan</title>
</head>

<body>

	<!-- Page Content -->
	<div class="container" style="margin-top: 40px;">

		<div class="row">

			<div class="col-lg-3">

				<h1 class="my-4">Shopping List</h1>
				<div class="list-group">
					<a href="makanan.php" class="list-group-item font-weight-bold">Pecel</a>
					<a href="bakso.php" class="list-group-item font-weight-bold">Bakso</a>
				</div>

			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">
				<div class="row">

					<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE kategori='makanan' "); ?>
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