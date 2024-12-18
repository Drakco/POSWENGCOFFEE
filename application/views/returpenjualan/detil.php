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


                    <form action="<?php echo (site_url($controller . '/simpan')) ?>" method="post" id="form" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <h5>DATA RETUR PENJUALAN</h5>
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%">ID. Retur Penjualan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><?php echo $dataId->idreturpenjualan; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Tgl. Retur Penjualan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style="">
                                                    <?php echo formatHariTanggal(date('Y-m-d', strtotime($dataId->tglreturpenjualan))) . '<br>Jam : ' . date('H:i:s', strtotime($dataId->tglreturpenjualan)); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Penjualan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style="">
                                                    <?php
                                                    $idpenjualan = '<small>
                                                    <a href="' . base_url('Penjualan/cetak/' . $this->encrypt->encode($dataId->idpenjualan)) . '" class="btn btn-info btn-sm" style="font-size: 10px !important; text-align: left !important;" target="_blank">
                                                        ID. ' . $dataId->idpenjualan . ' <br>
                                                        Tgl. ' . formatHariTanggal(date('d/m/Y', strtotime($dataId->tglpenjualan))) . '
                                                    </a>
                                                </small>';

                                                    echo $idpenjualan;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Keterangan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><?php echo $dataId->keterangan; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Total Harga</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><span style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Rp.' . number_format($dataId->totalharga); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Pengguna</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><?php echo $dataId->namapengguna; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 style="text-align: center;">DETIL PENJUALAN</h5>

                                <div class="table-responsive mt-4">
                                    <table class="table table-striped" id="tablePenjualanDetil" style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 5%;">NO.</th>
                                                <th style="text-align: center;">ID. PRODUK</th>
                                                <th style="text-align: center;">NAMA PRODUK</th>
                                                <th style="text-align: center;">KATEGORI</th>
                                                <th style="text-align: center;">SATUAN</th>
                                                <th style="text-align: center;">QTY RETUR</th>
                                                <th style="text-align: center;">HARGA JUAL</th>
                                                <th style="text-align: center;">TOTAL HARGA RETUR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $total = 0;
                                            $queryReturPenjualan = $this->db->query("SELECT * FROM v_returpenjualan_detil WHERE idreturpenjualan='$dataId->idreturpenjualan' ORDER BY tglreturpenjualan DESC ");
                                            if ($queryReturPenjualan->num_rows() > 0) {
                                                foreach ($queryReturPenjualan->result() as $rowReturPenjualan) { ?>
                                                    <tr>
                                                        <td style="text-align: center; width: 5%;"><?php echo $no++; ?></td>
                                                        <td style="text-align: center;"><?php echo $rowReturPenjualan->idreturpenjualan; ?></td>
                                                        <td style="text-align: left;"><?php echo $rowReturPenjualan->namaproduk; ?></td>
                                                        <td style="text-align: left;"><?php echo $rowReturPenjualan->namakategori; ?></td>
                                                        <td style="text-align: left;"><?php echo $rowReturPenjualan->satuan; ?></td>
                                                        <td style="text-align: center;"><?php echo number_format($rowReturPenjualan->qty); ?></td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($rowReturPenjualan->harga); ?></td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($rowReturPenjualan->totalharga); ?></td>
                                                    </tr>
                                            <?php
                                                    $total += $rowReturPenjualan->totalharga;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="7" style="text-align: right">TOTAL</th>
                                                <th style="text-align: right">
                                                    <span id="">Rp. <?php echo number_format($total); ?></span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer">
                                <a href="<?php echo (site_url($controller)) ?>" class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Batal</a>
                            </div>
                        </div>

                    </form>
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