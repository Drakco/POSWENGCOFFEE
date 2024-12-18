<?php 

$string = '<?php 
  $this->load->view(\'template/header\');
  $this->load->view(\'template/topmenu\');
  $this->load->view(\'template/sidemenu\');
 ?>

<main>
    <div class="container-fluid">
        <h2 class="mt-4"><i class="fa fa-tag"></i> Dashboard</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo(site_url(\'Home\')) ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-database"></i> Data</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">This page is an example of using the light side navigation option. By appending the <code>.sb-sidenav-light</code> class to the <code>.sb-sidenav</code> class, the side navigation will take on a light color scheme. The <code>.sb-sidenav-dark</code> is also available for a darker option.</div>
        </div>
    </div>
</main>

<?php 
  $this->load->view(\'template/footer\');
?>





';



$hasil_view_form = createFile($string, $target.'views/home.php');

?>