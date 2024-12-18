<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>
		<?php
		$profil = $this->db->query("SELECT * FROM profil WHERE id=1 ")->row();
		$resultProfil = $this->db->query("SELECT * FROM profil WHERE id=1 ")->row();
		echo $resultProfil->namaperusahaan;
		?>
	</title>

	<link rel="shortcut icon" href="<?php echo (base_url('uploads/' . $resultProfil->logoperusahaan)) ?>">
	<link rel="stylesheet" href="<?php echo (base_url()) ?>/assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo (base_url()) ?>/assets/adminlte3/dist/css/adminlte.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- datatables -->
	<link rel="stylesheet" href="<?php echo (base_url('assets/datatables/css/jquery.dataTables.min.css')) ?>">
	<!-- jquery-ui -->
	<link rel="stylesheet" href="<?php echo (base_url('assets/jquery-ui/themes/base/jquery-ui.css')) ?>">

	<style>
		/*
    .btn-success{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .text-dark{
      color: #17a2b8 !important;
    }

    .btn-primary{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .sidebar-dark-warning .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-warning .nav-sidebar>.nav-item>.nav-link.active{
      background-color: #82CFCF !important;
      color: white !important;
    }

    .accent-olive .btn-link, .accent-olive a:not(.dropdown-item){
      color: #17a2b8 !important;
    }


    .btn-info{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .btn-danger, .btn-warning{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    #table th {
      font-size: 12px;
      background-color: #f0ffff !important;
      color: black;
    }

    #table td {
      font-size: 14px;
      vertical-align: middle;
    }

    table.dataTable thead th {
      vertical-align: middle;
    }

    .content-wrapper{
      min-height: 800px !important;
    }*/

		#table th {
			font-size: 12px;
			color: white;
			background-color: #1089ff;
		}

		#table td {
			font-size: 13px;
			vertical-align: middle;
		}

		table.dataTable thead th {
			vertical-align: middle;
		}

		/* .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #343a40;
        color: #fff;
    } */

		.main-header {
			/* background-color: white; */
			/* background-color: #367fa9 !important; */
			background-color: white;
		}

		.navbar-light .navbar-nav .nav-link {
			color: black;
		}

		.navbar-light .navbar-nav .nav-link:focus,
		.navbar-light .navbar-nav .nav-link:hover {
			color: gray;
		}

		.main-footer {
			background: #1089ff;
			color: white !important;
		}

		.brand-link {
			/* background: linear-gradient(to right, #8e0e00, #1f1c18); */
			/* background-color: #367fa9 !important; */
			background: #1089ff;
			color: white !important;
		}

		.main-sidebar {
			/* background: linear-gradient(to right, #8e0e00, #1f1c18); */
			/* background-color: #222d32; */
			background: #1089ff;
		}

		.layout-navbar-fixed .wrapper .sidebar-dark-primary .brand-link:not([class*=navbar]) {
			background-color: #ffffff;
			color: black;
		}

		.required label {
			font-weight: bold;
		}

		.required label:after {
			color: #e32;
			content: " * wajib";
			font-style: italic;
			font-size: 12px;
			display: inline;
		}

		.uppercase {
			text-transform: uppercase;
		}

		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 50%;
			height: 50%;
			z-index: 9999;
			background: url('//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif') 100% 100% no-repeat;
		}

		.mt-min1 {
			margin-top: -10px;
		}
	</style>

</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
			<div class="container">
				<a href="<?php echo site_url('DaftarProduk') ?>" class="navbar-brand">
					<img src="<?php echo (base_url('uploads/' . $profil->logoperusahaan)) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
						style="opacity: .8">
					<span class="brand-text font-weight-light"><?php echo strtoupper("PERANCANGAN SISTEM INFORMASI POINT OF SALE WENG COFFEE") ?></span>
				</a>

				<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse order-3" id="navbarCollapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?php echo site_url('DaftarProduk') ?>" class="nav-link">DAFTAR PRODUK</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('PembayaranNonTunaiPelanggan') ?>" class="nav-link">PEMBAYARAN NON TUNAI</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('Login') ?>" class="nav-link">LOGIN</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>

		<div class="content-wrapper">
			<div class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"> PEMBAYARAN NON TUNAI <small>(pembayaran)</small></h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo site_url('PembayaranNonTunaiPelanggan') ?>">Pembayaran Non Tunai</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body">

							<div class="row">
								<div class="col-md-12">
									<h5>QR INVOICE PEMESANAN</h5>
									<?php

									$dataBank = $this->db->query("SELECT * FROM bank WHERE idbank='BNK-000002' ")->row();


									if (!empty($dataBank->foto)) { ?>
										<a href="<?php echo base_url('uploads/' . $dataBank->foto) ?>" target="_blank">
											<img src="<?php echo base_url('uploads/' . $dataBank->foto) ?>" alt=""
												style="width: 30%; height: auto; display: block; margin: 0 auto;"
												class="img img-thumbnail">
										</a>
									<?php
									} else { ?>
										<img src="<?php echo base_url('images/nofoto.png') ?>" alt=""
											style="width: 100%; height: auto; display: block; margin: 0 auto;"
											class="img img-thumbnail">
									<?php
									}
									?>
								</div>

								<div class="col-md-4"></div>
								<div class="col-md-4 mt-4">
									<div class="card">
										<div class="card-body p-0">
											<table class="table table-sm">
												<thead>
													<tr>
														<th style="text-align: center;"><span
																style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Total Harga : Rp.' . number_format($dataId->grandtotal); ?></span>
														</th>
													</tr>
													<tr>
														<th style="text-align: center;"><span
																style="font-size: 18px; color: red; font-weight: bold;"><?php echo $dataId->keterangan ?></span>
														</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>


					</div>
				</div>
			</section>

		</div>


		<?php
		$dataProfil = $this->db->query("SELECT * FROM profil WHERE id=1")->row();
		$dataProfilKontakKami = $this->db->query("SELECT * FROM profil_kontakkami WHERE id=1")->row();
		?>

		<footer class="main-footer">
			<div class="float-right d-none d-sm-inline">
				<?php echo $dataProfilKontakKami->alamat; ?>
			</div>
			<strong><?php echo strtoupper($dataProfil->namaperusahaan) ?> - Copyright <?php echo date('Y') ?></strong>
		</footer>
	</div>
	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?php echo (base_url()) ?>/assets/adminlte3/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo (base_url()) ?>/assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo (base_url()) ?>/assets/adminlte3/dist/js/adminlte.min.js"></script>

	<!-- datatables -->
	<script src="<?php echo (base_url('assets/datatables/js/jquery.dataTables.min.js')) ?>"></script>
	<!-- bootbox -->
	<script type="text/javascript" src="<?php echo base_url('assets/bootbox/bootbox.js'); ?>"></script>
	<!-- jquery-mask -->
	<script type="text/javascript" src="<?php echo base_url('assets/jquery_mask/jquery.mask.js') ?>"></script>
	<!-- Bootstrap validator -->
	<script src="<?php echo (base_url('assets/bootstrap-validator/js/bootstrapValidator.js')) ?>"></script>
	<!-- jquery-ui -->
	<script src="<?php echo (base_url('assets/jquery-ui/jquery-ui-2.js')) ?>"></script>
	<!-- Sweat Alert -->
	<script src="<?php echo (base_url('assets/sweatalert/sweatalert.js')) ?>"></script>
	<!-- Font Awesome -->
	<script src="<?php echo (base_url('assets/fa/fa.min.js')); ?>"></script>
	<!-- CK Editor -->
	<script type="text/javascript" src="<?php echo (base_url()) ?>/assets/ckeditor/ckeditor.js"></script>
	<!-- Select 2 -->
	<link href="<?php echo (base_url('assets/select2/dist/css/select2.min.css')) ?>" rel="stylesheet" />
	<script src="<?php echo (base_url('assets/select2/dist/js/select2.min.js')) ?>"></script>
	<script>
		$('.select2').addClass('form-control');
		$('.select2').select2();

		$('.select2_1').addClass('form-control');
		$('.select2_1').select2();

		$('.select2_2').addClass('form-control');
		$('.select2_2').select2();

		$('.select2_3').addClass('form-control');
		$('.select2_3').select2();
	</script>
	<style>
		.select2-container .select2-selection--single {
			height: 40px !important;
		}
	</style>

	<script>
		const numberWithCommas = (x) => {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		const untitik = (i) => {
			return typeof i === 'string' ?
				i.replace(/[\$,]/g, '') * 1 :
				typeof i === 'number' ?
				i : 0;
		}

		function AllowOnlyNumbers(e) {

			e = (e) ? e : window.event;
			var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
			var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
			var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);

			return (/^\d+$/.test(str));
		}
	</script>

	<script>
		var $loading = $('.loader').hide();
		$(document)
			.ajaxStart(function() {
				//ajax request went so show the loading image
				$loading.show();
			})
			.ajaxStop(function() {
				//got response so hide the loading image
				$loading.hide();
			});
	</script>
	<?php
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)) {
		echo ($pesan);
		$this->session->set_flashdata('pesan', NULL);
	}
	?>
</body>