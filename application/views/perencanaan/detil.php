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
                        <div class="card-body" style="padding-left:10%; padding-right:10%;">

                            <h4 style="text-align: center;"><?php echo strtoupper($dataId->nama); ?>
                            </h4>
                            <hr>

                            <h6 style="color: gray; text-align: right"><i class="fa fa-calendar"></i>
                                <?php echo strtoupper(formatHariTanggal($dataId->tglperencanaan)); ?></h6>
                            <h6 style="color: gray;"><i class="fa fa-tag"></i> JENIS PERENCANAAN :
                                <?php echo strtoupper($dataId->jenis); ?></h6>
                            <h6 style="color: gray; margin-top: -3px;"><i class="fa fa-tag"></i> TUJUAN PERENCANAAN :
                                <?php echo strtoupper($dataId->tujuan); ?></h6>

                            <?php 
							if (!empty($dataId->foto)) { ?>
                            <img src="<?php echo base_url('uploads/'.$dataId->foto) ?>" alt=""
                                style="display: block; margin: 0 auto; height: 60%; width: auto;">
                            <?php
							}
							?>

                            <p>
                                <?php echo $dataId->keterangan; ?>
                            </p>

                            <?php 
							if ($dataId->statusperencanaan == 'Sudah Diproses') {
								$statusperencanaan = '<span class="badge badge-success">Sudah Diproses</span>';
							}else{
								$statusperencanaan = '<span class="badge badge-warning">Sedang Diproses</span>';
							}

							echo $statusperencanaan;
							?>

                            <div class="row mt-5">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-center">
                                    PIMPINAN
                                    <?php echo str_repeat('<br>', 5) ?>
                                    <u><b><?php echo strtoupper($dataId->namapengguna) ?></b></u>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="<?php echo(site_url($controller)) ?>"
                                class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Kembali</a>
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

</body>





</html>