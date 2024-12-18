<?php 

$string = '<?php 
  $idpengguna = $this->session->userdata(\'idpengguna\');
  $namapengguna = $this->session->userdata(\'namapengguna\');
  $level = $this->session->userdata(\'level\');
  $foto = $this->session->userdata(\'foto\');
 ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="<?php echo(base_url()) ?>/assets/adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">WEB Administrator</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        
        <?php 
        if (empty($foto)) { ?>
          <img src="<?php echo(base_url()) ?>/images/nofoto_l.png" class="img-circle elevation-2" alt="User Image">
        <?php
        }else{ ?>
          <img src="<?php echo(base_url()) ?>/uploads/<?php echo($foto) ?>" class="img-circle elevation-2" alt="User Image">
        <?php
        }
         ?>
        
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo($namapengguna) ?></a>
      </div>
    </div>

    
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-header">Daftar Menu</li>
        
        <li class="nav-item">
          <a href="<?php echo(site_url(\'Dashboard\')) ?>" class="nav-link <?php echo ($menu==\'Dashboard\') ? \'active\' : \'\' ?> ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>


        <?php  
          $menudropdown = array();
          if (in_array($menu, $menudropdown)) {
            $dropdownselected = true;
          }else{
            $dropdownselected = false;
          }
        ?>

        <li class="nav-item has-treeview <?php echo ($dropdownselected) ? \'menu-open\' : \'\' ?> ">
          <a href="#" class="nav-link <?php echo ($dropdownselected) ? \'active\' : \'\' ?> ">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">';

$table_list = $hc->table_list();
foreach ($table_list as $row) {

$table_name = $row['table_name'];
$c = ucfirst($table_name);
$string .='
            <li class="nav-item">
              <a href="<?php echo(site_url("'.$c.'")) ?>" class="nav-link <?php echo ($menu=="'.$c.'") ? \'active\' : \'\' ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>'.$c.'</p>
              </a>
            </li>
        ';         

}
           
$string .='
          </ul>
        </li>
        
        <li class="nav-header">Setting</li>
        
        <li class="nav-item">
          <a href="<?php echo(site_url(\'Login/settingAkun\')) ?>" class="nav-link <?php echo ($menu==\'Settingakun\') ? \'active\' : \'\' ?> ">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Setting Akun
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo(site_url(\'Login/logout\')) ?>" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Log Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

';

$hasil_view_list = createFile($string, $target."views/template/sidemenu.php");

?>