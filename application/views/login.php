<!doctype html>
<html lang="en">

<head>
	<title>PERANCANGAN SISTEM INFORMASI POINT OF SALE BERBASIS WEB PADA WENG COFFEE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/login-form-11') ?>/css/style.css">
</head>

<style>
	body {
		background-image: url("<?php echo base_url('images/backgrd.png') ?>");
		/* background-color: #cccccc; */
		background-repeat: no-repeat;
		background-size: 100% 150%;
	}
</style>

<body>
	<section class="ftco-section" style="opacity: 0.9;">
		<div class="container">
			<div class="row justify-content-center">

			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<h3 class="text-center mb-4">LOGIN</h3>
						<form action="<?php echo (site_url('Login/cekLogin')) ?>" method="POST" class="login-form">
							<div class="form-group">
								<input type="text" name="username" class="form-control rounded-left" placeholder="Username" required>
							</div>
							<div class="form-group d-flex">
								<input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>

								<a href="<?php echo site_url('DaftarProduk') ?>" class="btn btn-info rounded submit px-3 mt-2 btn-block btn-lg">
									DAFTAR PRODUK
								</a>

								<a href="<?php echo site_url('PembayaranNonTunaiPelanggan') ?>" class="btn btn-danger rounded submit px-3 mt-2 btn-block btn-lg">
									DAFTAR PEMBAYARAN NON TUNAI
								</a>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?php echo base_url('assets/login-form-11') ?>/js/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/login-form-11') ?>/js/popper.js"></script>
	<script src="<?php echo base_url('assets/login-form-11') ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/login-form-11') ?>/js/main.js"></script>

	<?php
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)) {
		echo $pesan;
		$this->session->set_flashdata('pesan', NULL);
	}

	?>
</body>

</html>