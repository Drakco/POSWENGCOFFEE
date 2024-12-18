<?php 
  $this->load->view('template/header');
  $this->load->view('template/topmenu');
  $this->load->view('template/sidemenu');
 ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-file"></i> <?php echo($formNameHead); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo($formNameData); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="card mb-4">

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> Profil Perusahaan</h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo(site_url($controller.'/edit/'.$this->encrypt->encode($dataId->id))); ?>"
                                class="btn btn-sm btn-warning float-right mb-3" title="Tambah Data">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">

                            <img src="<?php echo(base_url('uploads/'.$dataId->logoperusahaan)); ?>" alt=""
                                class="img-thumbnail" style="border-radius: 50%; height: 70px; width: auto;">

                            <div class="" style="text-align: center; display: block; margin-top: -60px;">
                                <h3><?php echo($dataId->namaperusahaan) ?></h3>

                                <span style="font-size: 13px; margin-top: -5px; display: block;">
                                    <i class="fa fa-calendar" style="font-size: 11px; "></i>
                                    <?php echo(formatHariTanggal($dataId->tglupdate)) ?>&nbsp;&nbsp;&nbsp; <i
                                        class="fa fa-user" style="font-size: 11px; "></i>
                                    <?php echo($dataId->namapengguna) ?>
                                </span>

                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?php echo(base_url('uploads/'.$dataId->fotoperusahaan)); ?>" alt=""
                                        class="img-thumbnail"
                                        style="display: block; margin: 0 auto; height: 50%; width: auto;">
                                </div>
                                <div class="col-md-7">
                                    <?php echo($dataId->tentangkami); ?>
                                </div>
                            </div>


                        </div>
                    </div>




                </div>
            </div>

        </div>
    </div>


</div>


<?php 
  $this->load->view('template/footer');
?>

<script type="text/javascript">
$(document).ready(function() {

});
</script>



</body>

</html>