<?php
session_start();
include "navigation.php";
include "koneksi.php";
$keyword = $_GET['keyword'];

$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
	OR deskripsi_produk LIKE '%$keyword%' ");
while ($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

/*echo "<pre>";
print_r($semuadata);
echo "</pre>";*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pencarian</title>
</head>

<body>

	<!-- Page Content -->
	<div class="container" style="margin-top: 40px;">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
		<hr>
		
		<div class="row">

			<div class="col-lg-9">

				<div class="row">
					<?php foreach ($semuadata as $key => $value):?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<img class="card-img-top" src="foto_produk/<?php echo $value['foto_produk']; ?>" alt="img-responsive">
								<div class="card-body">
									<h4 class="card-title">
										<h4><?php echo $value['nama_produk'];?></h4>
									</h4>
									<h5>Rp. <?php echo number_format($value['harga_produk']);?></h5>
									<p><?php echo $value['deskripsi_produk']; ?></p>
									<small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
								</div>
								<div class="card-footer">
									<div class="input-group">
										<div class="input-group-prepend">
											<a href="beli.php?id=<?php echo $value['id_produk'];?>"><button class="btn btn-outline-primary" type="button" id="button-addon1" name="beli">Beli</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>

			</div>
			<!-- /.col-lg-9 -->

		</div>

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