<?php 

$string = '<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">
       <i class="fa fa-globe"></i> SIMUTRON
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
                
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fa fa-cog fa-fw"></i> Settings
                </a>
                
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="<?php echo(site_url(\'Logout\')); ?>">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

';



$hasil_view_list = createFile($string, $target."views/template/topmenu.php");

?>


	