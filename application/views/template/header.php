<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>
		<?php
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

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-navy text-sm">
	<div class="wrapper">