<?php
session_start();
include "navigation.php";
include "koneksi.php";
$id = $_SESSION['pelanggan']['id_pelanggan'];
$nama = $_SESSION['pelanggan']['nama_pelanggan'];
$telepon = $_SESSION['pelanggan']['telepon'];
$email = $_SESSION['pelanggan']['email_pelanggan'];
$password = $_SESSION['pelanggan']['password_pelanggan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Detail Account</title>

</head>

<body>

	<!-- Page Content -->
	<div class="container" style="margin-bottom: 100px; margin-top: 120px;">
		<div class="card bg-info mt-5 mx-auto" style="width: 25rem;">
			<div class="card-header mb-2" align="center"><strong>Your Account Info</strong></div>
			<div class="card-body">
				<form role="form" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="nama" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1" value="<?php print_r($nama); ?>">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
						</div>
						<input type="text" class="form-control" name="telepon" readonly="" value="<?php print_r($telepon); ?>" aria-label="Telepon" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
						</div>
						<input type="text" class="form-control" name="email" readonly="" value="<?php print_r($email); ?>" aria-label="@mail" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
						</div>
						<input type="text" class="form-control" name="password" value="<?php print_r($password); ?>" aria-label="Password" aria-describedby="basic-addon1">
					</div>
					<button class="btn btn-danger mb-3" name="ubah">Ubah</button>
				</form>
				<?php
				if (isset($_POST['ubah'])) {

					$koneksi->query("UPDATE pelanggan SET email_pelanggan='$_POST[email]',
						password_pelanggan='$_POST[password]', nama_pelanggan='$_POST[nama]',
						telepon='$_POST[telepon]'
						WHERE id_pelanggan='$id' ");

					echo "<script>alert('Data Telah Diubah Silahkan Login Kembali');</script>";
					session_destroy();
					echo "<script>location='login.php';</script>";
				}
				?>
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