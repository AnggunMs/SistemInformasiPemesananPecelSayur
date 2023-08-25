<?php
include "navigation.php";
include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Registration</title>

</head>

<body>

	<!-- Page Content -->
	<div class="container" style="margin-top: 5px;">
		<div class="row text-center ">
			<div class="col-md-12">
				<br>
				<h2> Registration</h2>
				<h5>(Register yourself to get access )</h5>
				<br>
			</div>
		</div>
		<div class="card bg-light mb-5 mx-auto" style="width: 25rem";>
			<div class="card-header mb-2" align="center"><strong> New user ? Register yourself</strong></div>
			<div class="card-body">
				<form role="form" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"  ></i></span>
						</div>
						<input type="text" class="form-control" name="nama" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"  ></i></span>
						</div>
						<input type="text" class="form-control" name="phone" placeholder="Telepon" aria-label="Telepon" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"  ></i></span>
						</div>
						<input type="email" class="form-control" name="email" placeholder="@mail" aria-label="@mail" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"  ></i></span>
						</div>
						<input type="text" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
					</div>
					<button class="btn btn-success mb-3" name="regis">Resgistration</button>
					<hr />
					Already registed ? <a href="login.php">Login here </a> 
				</form>
				<?php
				if (isset($_POST['regis']))
				{

					$nama = $_POST["nama"];
					$phone = $_POST["phone"];
					$email = $_POST["email"];
					$password = $_POST["password"];

					$ambil = $koneksi->query("SELECT *FROM pelanggan WHERE email_pelanggan ='$_POST[email]' ");
					$cek = $ambil->num_rows;
					if ($cek==1)
					{
						echo "<script>alert('Pendaftaran Gagal, email Sudah Digunakan');</script>";
						echo "<script>location='registeration.php';</script>";
					}
					else
					{
						$koneksi->query("INSERT INTO pelanggan (nama_pelanggan,telepon,email_pelanggan,password_pelanggan)
							VALUES ('$nama','$phone','$email','$password')" );

						echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
						echo "<script>location='login.php';</script>";
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