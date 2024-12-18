<?php 

$string = '
		
		<style>
	.navbar-custom {
  background-color: #373838;
  border-color: #272727;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#505252), to(#373838));
  background-image: -webkit-linear-gradient(top, #505252, 0%, #373838, 100%);
  background-image: -moz-linear-gradient(top, #505252 0%, #373838 100%);
  background-image: linear-gradient(to bottom, #505252 0%, #373838 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff505252", endColorstr="#ff373838", GradientType=0);
}
.navbar-custom .navbar-brand {
  color: #ffffff;
}
.navbar-custom .navbar-brand:hover,
.navbar-custom .navbar-brand:focus {
  color: #e6e6e6;
  background-color: transparent;
}
.navbar-custom .navbar-text {
  color: #ffffff;
}
.navbar-custom .navbar-nav > li:last-child > a {
  border-right: 1px solid #272727;
}
.navbar-custom .navbar-nav > li > a {
  color: #ffffff;
  border-left: 1px solid #272727;
}
.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus {
  color: #c0c0c0;
  background-color: transparent;
}
.navbar-custom .navbar-nav > .active > a,
.navbar-custom .navbar-nav > .active > a:hover,
.navbar-custom .navbar-nav > .active > a:focus {
  color: #c0c0c0;
  background-color: #272727;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#272727), to(#404141));
  background-image: -webkit-linear-gradient(top, #272727, 0%, #404141, 100%);
  background-image: -moz-linear-gradient(top, #272727 0%, #404141 100%);
  background-image: linear-gradient(to bottom, #272727 0%, #404141 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff272727", endColorstr="#ff404141", GradientType=0);
}
.navbar-custom .navbar-nav > .disabled > a,
.navbar-custom .navbar-nav > .disabled > a:hover,
.navbar-custom .navbar-nav > .disabled > a:focus {
  color: #cccccc;
  background-color: transparent;
}
.navbar-custom .navbar-toggle {
  border-color: #dddddd;
}
.navbar-custom .navbar-toggle:hover,
.navbar-custom .navbar-toggle:focus {
  background-color: #dddddd;
}
.navbar-custom .navbar-toggle .icon-bar {
  background-color: #cccccc;
}
.navbar-custom .navbar-collapse,
.navbar-custom .navbar-form {
  border-color: #252626;
}
.navbar-custom .navbar-nav > .dropdown > a:hover .caret,
.navbar-custom .navbar-nav > .dropdown > a:focus .caret {
  border-top-color: #c0c0c0;
  border-bottom-color: #c0c0c0;
}
.navbar-custom .navbar-nav > .open > a,
.navbar-custom .navbar-nav > .open > a:hover,
.navbar-custom .navbar-nav > .open > a:focus {
  background-color: #272727;
  color: #c0c0c0;
}
.navbar-custom .navbar-nav > .open > a .caret,
.navbar-custom .navbar-nav > .open > a:hover .caret,
.navbar-custom .navbar-nav > .open > a:focus .caret {
  border-top-color: #c0c0c0;
  border-bottom-color: #c0c0c0;
}
.navbar-custom .navbar-nav > .dropdown > a .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}
@media (max-width: 767) {
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a {
    color: #ffffff;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #c0c0c0;
    background-color: transparent;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #c0c0c0;
    background-color: #272727;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:focus {
    color: #cccccc;
    background-color: transparent;
  }
}
.navbar-custom .navbar-link {
  color: #ffffff;
}
.navbar-custom .navbar-link:hover {
  color: #c0c0c0;
}
</style>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo(site_url()) ?>">SISTEM INFORMASI AKUNTANSI</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
					
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">DATA MASTER <b class="caret"></b></a>
					<ul class="dropdown-menu">';

					 $table_list = $hc->table_list();
    foreach ($table_list as $row) {
        $table_name = $row['table_name'];
        $c = ucfirst($table_name);

     		$string .= '<li><a href="<?php echo site_url("'.$c.'"); ?>">'.$c.'</a></li>
     					';
    }

$string .='
					</ul>
				</li>

				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">LAPORAN <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url("Lapkependudukan"); ?>">Jurnal Umum</a></li>
						<li><a href="<?php echo site_url("Lappermohonansurat"); ?>">Buku Besar</a></li>
						<li><a href="<?php echo site_url("Lapkeluhanwarga"); ?>">Neraca Saldo</a></li>
						<li><a href="<?php echo site_url("Lapkeuangan"); ?>">Laba Rugi</a></li>
						<li><a href="<?php echo site_url("Lapkeuangan"); ?>">Perubahan Modal</a></li>
						<li><a href="<?php echo site_url("Lapkeuangan"); ?>">Neraca</a></li>
					</ul>
				</li>

				
				<!-- <li class="active"><a href="#">Link</a></li>
				<li><a href="#">Link</a></li> -->
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Nama User <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("Login/ubahpassword"); ?>">Ubah Password</a></li>
            <li><a href="<?php echo site_url("Login/keluar"); ?>">Logout</a></li>
          </ul>
        </li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>
';

$hasil_view_list = createFile($string, $target."views/template/topmenu.php");

?>

	