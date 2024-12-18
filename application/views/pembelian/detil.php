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

                            <div class="row">
                                <div class="col-md-8">
                                    <h5>DATA PEMBELIAN</h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">ID. Pembelian</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><?php echo $dataId->idpembelian; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Tgl. Pembelian</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style="">
                                                        <?php echo formatHariTanggal(date('Y-m-d', strtotime($dataId->tglpembelian))); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">No. Struk</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><?php echo $dataId->nostruk; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Supplier</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><?php echo $dataId->namasupplier; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Pengguna</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><?php echo $dataId->namapengguna; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Keterangan</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><?php echo $dataId->keterangan; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Total Harga</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style=""><span
                                                            style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Rp.'.number_format($dataId->totalharga); ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Pengadaan</td>
                                                    <td style="width: 5%; text-align: center">: </td>
                                                    <td style="">
                                                        <?php 
													if (!empty($dataId->idpengadaan)) {
														$idpengadaan = '<small>
															<a href="'.base_url('Pengadaan/detil/'.$this->encrypt->encode($dataId->idpengadaan)).'" class="btn btn-info btn-sm" style="text-align: left !important;" target="_blank">
																ID. '.$dataId->idpengadaan.' <br>
																Tgl. '.formatHariTanggal(date('d/m/Y', strtotime($dataId->tglpengadaan))).'
															</a>
														</small>';
													}else{
														$idpengadaan = 'PEMBELIAN LANGSUNG';
													}

													echo $idpengadaan;
													?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>FOTO STRUK PEMBELIAN</h5>
                                    <?php 
									if (!empty($dataId->foto)) { ?>
                                    <a href="<?php echo base_url('uploads/'.$dataId->foto) ?>" target="_blank">
                                        <img src="<?php echo base_url('uploads/'.$dataId->foto) ?>" alt=""
                                            style="width: 100%; height: auto; display: block; margin: 0 auto;"
                                            class="img img-thumbnail">
                                    </a>
                                    <?php
									}else{ ?>
                                    <img src="<?php echo base_url('images/nofoto.png') ?>" alt=""
                                        style="width: 100%; height: auto; display: block; margin: 0 auto;"
                                        class="img img-thumbnail">
                                    <?php
									}
									?>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <h5 style="text-align: center;">DETIL PEMBELIAN</h5>

                                    <div class="table-responsive mt-4">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; width: 5%;">NO.</th>
                                                    <th style="text-align: center;">ID. PRODUK</th>
                                                    <th style="text-align: center;">NAMA PRODUK</th>
                                                    <th style="text-align: center;">KATEGORI</th>
                                                    <th style="text-align: center;">SATUAN</th>
                                                    <th style="text-align: center;">QTY</th>
                                                    <th style="text-align: center;">HARGA</th>
                                                    <th style="text-align: center;">TOTAL HARGA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
												$no = 1;
												$queryPembelianDetil = $this->db->query("SELECT * FROM v_pembelian_detil WHERE idpembelian='$dataId->idpembelian' ORDER BY namaproduk ASC ");
												if ($queryPembelianDetil->num_rows() > 0) {
													foreach ($queryPembelianDetil->result() as $rowPembelianDetil) { ?>
                                                <tr>
                                                    <td style="text-align: center; width: 5%;"><?php echo $no++; ?></td>
                                                    <td style="text-align: center;">
                                                        <?php echo $rowPembelianDetil->idproduk; ?></td>
                                                    <td style="text-align: left;">
                                                        <?php echo $rowPembelianDetil->namaproduk; ?></td>
                                                    <td style="text-align: left;">
                                                        <?php echo $rowPembelianDetil->namakategori; ?></td>
                                                    <td style="text-align: center;">
                                                        <?php echo $rowPembelianDetil->satuan; ?></td>
                                                    <td style="text-align: center;">
                                                        <?php echo number_format($rowPembelianDetil->qty); ?></td>
                                                    <td style="text-align: right;">
                                                        <?php echo 'Rp. '.number_format($rowPembelianDetil->harga); ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php echo 'Rp. '.number_format($rowPembelianDetil->totalharga); ?>
                                                    </td>
                                                </tr>
                                                <?php
													}
												}
												?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="7" style="text-align: right">TOTAL</th>
                                                    <th style="text-align: right">
                                                        <?php echo 'Rp. '.number_format($dataId->totalharga); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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


<?php 
  $this->load->view('template/footer');
?>


<script type="text/javascript"></script>

</body>





</html>
