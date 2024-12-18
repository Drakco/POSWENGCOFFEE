<?php 

$string = '<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" role="button">SISTEM INFORMASI</a>
    </li>  
  </ul>

</nav>
';



$hasil_view_list = createFile($string, $target."views/template/topmenu.php");

?>


	