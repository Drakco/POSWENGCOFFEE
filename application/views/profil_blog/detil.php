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
                        <li class="breadcrumb-item"><a href="<?php echo(site_url('Dashboard')) ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"> <a
                                href="<?php echo(site_url('Kategori')) ?>"><?php echo($formNameData); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo($formName); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> <?php echo($formName) ?></h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo(site_url($controller)) ?>"
                                class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="" style="text-align: center;">
                                <h3><?php echo($dataId->judul) ?></h3>

                                <span style="font-size: 13px; margin-top: -5px; display: block;">
                                    <i class="fa fa-calendar" style="font-size: 11px; "></i>
                                    <?php echo(formatHariTanggal($dataId->tglblog)) ?>&nbsp;&nbsp;&nbsp; <i
                                        class="fa fa-user" style="font-size: 11px; "></i>
                                    <?php echo($dataId->namapengguna) ?>
                                </span>

                            </div>
                            <hr>
                            <br>
                            <img src="<?php echo(base_url('uploads/'.$dataId->foto)) ?>" alt="" class="img-thumbnail"
                                style="display: block; margin: 0 auto; height: 50%; width: auto;">
                            <br>
                            <p>
                                <?php echo($dataId->konten); ?>
                            </p>


                        </div>

                        <div class="card-footer">
                            <a href="<?php echo(site_url($controller)) ?>"
                                class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-chevron-circle-left"></i>
                                Kembali</a>
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