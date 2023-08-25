<?php
session_start();
include "navigation.php";
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Login Pelanggan</title>

</head>

<body>

	<!-- Page Content -->
	<div class="container" style="margin-bottom: 125px; margin-top: 80px;">
		<div class="row text-center ">
			<div class="col-md-12">
				<br>
				<h2> Login</h2>
				<h5>(Login yourself to get access)</h5>
				<br>
			</div>
		</div>
		<div class="card bg-light mb-5 mx-auto" style="width: 25rem" ;>
			<div class="card-header mb-2" align="center"><strong>Enter details to login</strong></div>
			<div class="card-body">
				<form role="form" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
						</div>
						<input type="email" class="form-control" name="email" placeholder="@mail" aria-label="@mail" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
					</div>
					<button class="btn btn-primary mb-3" name="login">Login</button>
					<hr />
					Not register ? <a href="registration.php">Click here </a>
				</form>
				<?php
				if (isset($_POST['login'])) {
					$ambil = $koneksi->query("SELECT *FROM pelanggan WHERE email_pelanggan ='$_POST[email]' 
						AND password_pelanggan = '$_POST[password]'");
					$cek = $ambil->num_rows;
					if ($cek == 1) {
						$_SESSION['pelanggan'] = $ambil->fetch_assoc();
						echo "<script>alert('Login Sukses');</script>";

						//jika sudah belanja
						if (isset($_SESSION['keranjang']) or !empty($_SESSION['keranjang'])) {
							echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
						} else {
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
						}
					} else {
						echo "<script>alert('Anda Gagal Login, Periksa Akun Anda!');</script>";
						echo "<meta http-equiv='refresh' content='1;url=login.php'>";
					}
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