<?php
session_start();
include "navigation.php";
include "koneksi.php";

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT *FROM produk
	WHERE id_produk='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Pembelian</title>
</head>

<body>

	<section style="margin-top: 40px;">
		<div class="container">

			<div class="media" style="margin-bottom: 150px;">
				<img style="height: 300px; width: 465px;" src="foto_produk/<?php echo $detail['foto_produk']; ?>" class="align-self-start mr-3" alt="...">
				<div class="media-body">
					<form method="post">
						<div class="form-group">
							<div class="input-group mb-3" style="width: 150px;">
								<div class="input-group-prepend">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
								<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo
																										$detail['stock']; ?>">
							</div>
						</div>
					</form>
					<h2><?php echo $detail['nama_produk']; ?></h2>
					<h5>Rp. <?php echo number_format($detail['harga_produk']); ?></h5>
					<h5>Stok : <?php echo $detail['stock'];  ?></h5>
					<p align="justify"><?php echo $detail['deskripsi_produk']; ?></p>
					<?php
					if (isset($_POST["beli"])) {

						$jumlah = $_POST["jumlah"];

						if ($jumlah == NULL) {
							echo "<script>alert('Jumlah Produk yang Anda Beli Tidak Ada, Silahkan Input Jumlah Produk Yang Sesuai!');</script>";
							echo "<script>location='beli.php?id=$_GET[id]';</script>";
						} else {
							//untuk membuat data array jumlah produk yang dibeli berdasarkan id_produknya
							$_SESSION['keranjang'][$id_produk] = $jumlah;
							echo "<script>alert('Produk Telah Masuk ke Keranjang');</script>";
							echo "<script>location='keranjang.php';</script>";
						}
					}
					?>
				</div>
			</div>



		</div>
		</div>
	</section>

	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Pecel Keliling 2023</p>
		</div>
	</footer>

</body>

</html>