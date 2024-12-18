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
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-file"></i> <?php echo ($formNameHead); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo (site_url('Dashboard')) ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"> <a href="<?php echo (site_url('Kategori')) ?>"><?php echo ($formNameData); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo ($formName); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> <?php echo ($formName) ?></h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo (site_url($controller)) ?>" class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    if (!empty($dataId->foto)) { ?>
                                        <img src="<?php echo base_url('uploads/' . $dataId->foto) ?>" alt="" style="width: 100%; height: auto; display: block; margin: 0 auto;" class="img img-thumbnail">
                                    <?php
                                    } else { ?>
                                        <img src="<?php echo base_url('images/nofoto.png') ?>" alt="" style="width: 100%; height: auto; display: block; margin: 0 auto;" class="img img-thumbnail">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <h3><?php echo $dataId->namaproduk . ' <small>(ID. ' . $dataId->idproduk . ')</small>'; ?>
                                    </h3>
                                    <span style="color: gray;"><?php echo $dataId->namakategori ?></span>
                                    <br>
                                    <br>

                                    <img class="img-thumbnail mt-4 mb-4" style="height: auto; width: 30%; display: block; margin: 0 auto;" src="<?php echo base_url('uploads/qrcode/' . $dataId->qrcode . '.png') ?>">

                                    <h5>STOK : <?php echo number_format($dataId->stok) . ' ' . $dataId->satuan ?></h5>
                                    <h6>STOK MINIMUM : <?php echo number_format($dataId->stokminimum) . ' ' . $dataId->satuan ?></h5>

                                        <div class="bg-info py-2 px-3 mt-4">
                                            <h4 class="mt-0">
                                                <small>HARGA BELI </small>
                                            </h4>
                                            <h2 class="mb-0 float-right">
                                                <?php echo 'Rp. ' . number_format($dataId->hargabeli) ?>
                                            </h2>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="bg-success py-2 px-3 mt-4">
                                            <h4 class="mt-0">
                                                <small>HARGA JUAL </small>
                                            </h4>
                                            <h2 class="mb-0 float-right">
                                                <?php echo 'Rp. ' . number_format($dataId->hargajual) ?>
                                            </h2>
                                            <div class="clearfix"></div>
                                        </div>

                                        <br><b></b>
                                        <?php
                                        if ($dataId->statusaktif == 'Aktif') {
                                            $statusaktif = '<span class="badge badge-success">Aktif</span>';
                                        } else {
                                            $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
                                        }

                                        echo 'STATUS PRODUK : ' . $statusaktif;
                                        ?>
                                </div>

                                <div class="col-md-12">
                                    <nav class="w-100">
                                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                            <?php echo $dataId->keterangan; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="<?php echo (site_url($controller)) ?>" class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Kembali</a>
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

<script type="text/javascript"></script>

</body>





</html>