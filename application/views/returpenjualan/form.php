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
                                    <h5>DATA PENJUALAN</h5>
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%">ID. Penjualan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><?php echo $dataId->idpenjualan; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Tgl. Penjualan</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style="">
                                                    <?php echo formatHariTanggal(date('Y-m-d', strtotime($dataId->tglpenjualan))) . '<br>Jam : ' . date('H:i:s', strtotime($dataId->tglpenjualan)); ?>
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
                                                <td style="width: 30%">Kasir</td>
                                                <td style="width: 5%; text-align: center">: </td>
                                                <td style=""><?php echo $dataId->namapengguna; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">ID. Retur Penjualan</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" name="idreturpenjualan" id="idreturpenjualan" placeholder="Kode Otomatis Generate" readonly="">
                                        <input type="hidden" class="form-control" name="idpenjualan" id="idpenjualan" value="<?php echo $dataId->idpenjualan; ?>" placeholder="idpenjualan">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Tgl. Retur Penjualan</label>
                                    <div class="col-sm-4">
                                        <input type="datetime-local" class="form-control form-control-sm" name="tglreturpenjualan" id="tglreturpenjualan" placeholder="tglreturpenjualan" value="<?php echo date('Y-m-d H:i:s') ?>" min="<?php echo date('Y-m-d H:i:s', strtotime($dataId->tglpenjualan)) ?>" readonly="">
                                    </div>
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
                                                <th style="text-align: center;">QTY</th>
                                                <th style="text-align: center; width: 10%;">QTY RETUR</th>
                                                <th style="text-align: center;">HARGA JUAL</th>
                                                <th style="text-align: center;">TOTAL HARGA RETUR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $arr = 0;
                                            $queryPenjualanDetil = $this->db->query("SELECT * FROM v_penjualandetil WHERE idpenjualan='$dataId->idpenjualan' ORDER BY namaproduk ASC ");
                                            if ($queryPenjualanDetil->num_rows() > 0) {
                                                foreach ($queryPenjualanDetil->result() as $rowPenjualanDetil) { ?>
                                                    <tr>
                                                        <td style="text-align: center; width: 5%;"><?php echo $no++; ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <?php echo $rowPenjualanDetil->idproduk; ?>
                                                            <input type="hidden" class="form-control form-control-sm text-right" id="idproduk_<?php echo $arr; ?>" name="idproduk[]" value="<?php echo $rowPenjualanDetil->idproduk; ?>">
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <?php echo $rowPenjualanDetil->namaproduk; ?></td>
                                                        <td style="text-align: left;">
                                                            <?php echo $rowPenjualanDetil->namakategori; ?></td>
                                                        <td style="text-align: center;">
                                                            <?php echo $rowPenjualanDetil->satuan; ?></td>
                                                        <td style="text-align: center;">
                                                            <span id="spanQty_<?php echo $arr; ?>"><?php echo number_format($rowPenjualanDetil->qty); ?></span>
                                                            <input type="hidden" class="form-control form-control-sm text-right" id="qty_<?php echo $arr; ?>" name="qty[]" value="<?php echo $rowPenjualanDetil->qty ?>">
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <input type="number" class="form-control form-control-sm text-right qtyRetur" id="qtyRetur_<?php echo $arr; ?>" name="qtyRetur[]" value="<?php echo $rowPenjualanDetil->qty ?>" min="0">
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <?php echo 'Rp. ' . number_format($rowPenjualanDetil->hargajual); ?>
                                                            <input type="hidden" class="form-control form-control-sm text-right" id="harga_<?php echo $arr; ?>" value="<?php echo $rowPenjualanDetil->hargajual; ?>" name="harga[]">
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <span id="spanTotalHarga_<?php echo $arr; ?>"><?php echo 'Rp. ' . number_format($rowPenjualanDetil->totalharga); ?></span>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $arr++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align: right">TOTAL</th>
                                                <th style="text-align: right">
                                                    <span id="spanGrandTotal"><?php echo 'Rp. ' . number_format($dataId->totalharga); ?></span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Keterangan</label>
                                    <div class="col-sm-12">
                                        <textarea type="text" rows="4" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>
                                    <?php echo ($button) ?></button>

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

<script type="text/javascript">
    $('#tablePenjualanDetil').on('change', '.qtyRetur', function() {
        var count = $('#tablePenjualanDetil tbody tr').length - 1;
        var grandTotal = 0;
        for (let i = 0; i <= count; i++) {
            var qty = parseInt($('#qty_' + i).val());
            var qtyRetur = parseInt($('#qtyRetur_' + i).val());
            var harga = $('#harga_' + i).val();

            if (qty < qtyRetur) {
                Swal.fire(
                    "Validasi",
                    "QTY Konfirmasi melebihi dari QTY Penjualan",
                    "warning"
                );
                qtyRetur = $('#qtyRetur_' + i).val(qty);
                return false;
            }

            var total = parseInt(qtyRetur) * parseInt(harga);
            var grandTotal = parseInt(grandTotal) + parseInt(total);
            $('#spanTotalHarga_' + i).html('Rp. ' + numberWithCommas(total));
        }

        $('#spanGrandTotal').html('Rp. ' + numberWithCommas(grandTotal));
    });
</script>
</body>

</html>