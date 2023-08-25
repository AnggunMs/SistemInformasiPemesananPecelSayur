<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<style>
		#parent #popup {
			display: none;
		}

		#parent:hover #popup {
			display: block;
		}
	</style>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="foto_produk/Icon1.png" rel="shotcot icon"/>

	<!-- Bootstrap core CSS -->
	<link href="style/bootstrap/css/bootstrap.css" rel="stylesheet">


	<!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nav nav-tabs">
		<div class="container">
			<a class="navbar-brand" href="about.php">Pecel Keliling</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					<li class="nav-item">
						<form action="pencarian.php" method="get">
							<div class="input-group mt-1">
								<input name="keyword" placeholder="search" type="text" class="form-control" aria-label="search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
								</div>
							</div>
						</form>
					</li>

					<div id="parent">
						<li class="nav-item active">
							<a class="nav-link" href="index.php"><i class="fas fa-home col font" style="color: aqua;"></i>
								<!--<span class="sr-only">(current)</span>--></a>
						</li>
						<div id="popup" style="text-align: center; color: white;">Home</div>
					</div>
					<div id="parent">
						<li class="nav-item">
							<a class="nav-link" href="keranjang.php"><i class="fas fa-shopping-cart col font" style="color: aqua;"></i></a>
						</li>
						<div id="popup" style="text-align: center; color: white;">Keranjang</div>
					</div>
					<div id="parent">
						<li class="nav-item">
							<a class="nav-link" href="checkout.php"><i class="fas fa-money-check col font" style="color: aqua;"></i></a>
						</li>
						<div id="popup" style="text-align: center; color: white;">Check Out</div>
					</div>
					<div id="parent">
						<li class="nav-item">
							<a class="nav-link" href="history.php"><i class="fas fa-file-invoice col font" style="color: aqua;"></i></a>
						</li>
						<div id="popup" style="text-align: center; color: white;">History</div>
					</div>

					<?php if (isset($_SESSION['pelanggan'])) : ?>
						<div id="parent">
							<li class="nav-item">
								<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt col font" style="color: aqua;"></i></a>
							</li>
							<div id="popup" style="text-align: center; color: white;">Log Out</div>
						</div>
					<?php else : ?>
						<div id="parent">
							<li class="nav-item">
								<a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt col font" style="color: aqua;"></i></a>
							</li>
							<div id="popup" style="text-align: center; color: white;">Log In</div>
						</div>
					<?php endif ?>
					<?php if (isset($_SESSION['pelanggan'])) : ?>
						<li class="nav-item">
							<a class="nav-link" href="account.php"><strong style="color: white;"><?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></strong></a>
						</li>
					<?php else : ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php"><strong style="color: white;">Account</strong></a>
						</li>
					<?php endif ?>
					<li class="nav-item">
						<div class="d-flex mt-1">
							<div class="btn-group">
								<button type="button" class="btn btn-secondary">Reference</button>
								<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
									<a class="dropdown-item" href="contact.php">Contact</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Bootstrap core JavaScript -->
	<script src="style/jquery/jquery.js"></script>
	<script src="style/bootstrap/js/bootstrap.bundle.js"></script>

	<!-- Custom styles Fontawesome Bootstrap -->
	<script src="https://kit.fontawesome.com/7b9c7d7bfa.js" crossorigin="anonymous"></script>

</body>

</html>