<?php
$idpengguna   = $this->session->userdata('idpengguna');
$namapengguna = $this->session->userdata('namapengguna');
$namalengkap  = explode(" ", $namapengguna);
$namadepan    = $namalengkap[0];
$level        = $this->session->userdata('level');
$foto         = $this->session->userdata('foto');
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" role="button"><?php echo strtoupper("PERANCANGAN SISTEM INFORMASI POINT OF SALE WENG COFFEE") ?></a>
		</li>
	</ul>

	<ul class="navbar-nav ml-auto">

		<!-- Profil -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
				<?php echo $namadepan; ?> &nbsp;&nbsp;<i class="fa fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-center" style="text-align: center;">
				<a href="javascript:void(0)" class="dropdown-item mt-3">
					<?php
					if (!empty($foto)) { ?>
						<img src="<?php echo base_url('uploads/' . $foto) ?>" alt="User Avatar" class="img-size-50 img-circle" style="display: block; margin: 0 auto;">
					<?php
					} else { ?>
						<img src="<?php echo base_url('images/nofoto_l.png') ?>" alt="User Avatar" class="img-size-50 img-circle" style="display: block; margin: 0 auto;">
					<?php
					}
					?>
					<div class="media-body">
						<h3 class="dropdown-item-title"><?php echo $namapengguna; ?></h3>
						<p class="text-sm"><?php echo $level; ?></p>
						<p class="text-sm text-muted"><i class="fa fa-id-card mr-1"></i> ID. <?php echo $idpengguna; ?>
						</p>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?php echo site_url('Login/settingAkun') ?>" class="btn btn-warning btn-xs mt-3 mb-3">
					<i class="fa fa-cog"></i> Setting
				</a>

				<a href="<?php echo site_url('Login/logout') ?>" class="btn btn-danger btn-xs mt-3 mb-3">
					<i class="fa fa-power-off"></i> Logout
				</a>
			</div>
		</li>
	</ul>


</nav>