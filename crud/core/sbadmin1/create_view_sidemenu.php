<?php 

$string = '<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    
                    <div class="sb-sidenav-menu-heading" style="margin-bottom: -15px;">
                        <img src="<?php echo(base_url(\'images/nofoto_l.png\')); ?>" class="img-thumbnail" style="max-height: 100px; width: auto; display: block; margin:0 auto;"> 
                        <div class="mt-3 text-center" style="color:black;">Administrator</div>
                        <div class="mt-2 text-center" style="color:black;">Guru</div>
                    </div>

                    <div class="sb-sidenav-menu-heading">Daftar Menu</div>
                    <a class="nav-link" href="<?php echo(site_url(\'Home\')) ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Master Data</div>';

$table_list = $hc->table_list();
foreach ($table_list as $row) {

$table_name = $row['table_name'];
$c = ucfirst($table_name);
$string .='

                    <a class="nav-link" href="<?php echo(site_url("'.$c.'")); ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-tag"></i>
                        </div>
                        '.$c.'
                    </a>';         

}
                    
$string .='
                    <div class="sb-sidenav-menu-heading">Pengaturan</div>

                    <a class="nav-link" href="<?php echo(site_url(\'Logout\')); ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-power-off"></i>
                        </div>
                        Logout
                    </a>
                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div> -->
        </nav>
    </div>
<div id="layoutSidenav_content">
';

$hasil_view_list = createFile($string, $target."views/template/sidemenu.php");

?>