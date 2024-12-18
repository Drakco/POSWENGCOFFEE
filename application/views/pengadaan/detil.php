<?php
$this->load->view('template/header');
$this->load->view('template/topmenu');
$this->load->view('template/sidemenu');

$level = $this->session->userdata('level');
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

                    <form action="<?php echo site_url('Pengadaan/konfirmasi') ?>" method="POST">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>DATA PENGADAAN</h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%">ID. Pengadaan</td>
                                                        <td style="width: 5%; text-align: center">: </td>
                                                        <td style=""><?php echo $dataId->idpengadaan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Tgl. Pengadaan</td>
                                                        <td style="width: 5%; text-align: center">: </td>
                                                        <td style="">
                                                            <?php echo formatHariTanggal(date('Y-m-d', strtotime($dataId->tglpengadaan))); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Supplier</td>
                                                        <td style="width: 5%; text-align: center">: </td>
                                                        <td style="">
                                                            <?php
                                                            if ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') { ?>
                                                                <input type="hidden" name="idpengadaan" id="idpengadaan" value="<?php echo $dataId->idpengadaan; ?>">
                                                                <select name="idsupplier" id="idsupplier" class="form-control form-control-sm" style="width: 50%;">
                                                                    <?php
                                                                    $querySupplier = $this->db->query("SELECT * FROM supplier WHERE statusaktif='Aktif' ORDER BY namasupplier");
                                                                    if ($querySupplier->num_rows() > 0) {
                                                                        foreach ($querySupplier->result() as $rowSupplier) { ?>
                                                                            <option value="<?php echo $rowSupplier->idsupplier ?>">
                                                                                <?php echo $rowSupplier->namasupplier; ?></option>

                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            } else {
                                                                echo $dataId->namasupplier;
                                                            }
                                                            ?>

                                                        </td>
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
                                                        <td style=""><span style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Rp.' . number_format($dataId->totalharga); ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Status Konfirmasi</td>
                                                        <td style="width: 5%; text-align: center">: </td>
                                                        <td style="">
                                                            <?php
                                                            if ($dataId->statuskonfirmasi == 'Dikonfirmasi') {
                                                                $statuskonfirmasi = '<span class="badge badge-success">Dikonfirmasi<span>';
                                                            } elseif ($dataId->statuskonfirmasi == 'Ditolak') {
                                                                $statuskonfirmasi = '<span class="badge badge-danger">Ditolak<span>';
                                                            } else {
                                                                $statuskonfirmasi = '<span class="badge badge-warning">Menunggu<span>';
                                                            }
                                                            echo $statuskonfirmasi;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Pimpinan</td>
                                                        <td style="width: 5%; text-align: center">: </td>
                                                        <td style="">
                                                            <?php
                                                            if (!empty($dataId->idkonfirmasi)) {
                                                                $idkonfirmasi = '<small>
														' . $dataId->namakonfirmasi . ' <br>
														' . formatHariTanggal(date('Y-m-d', strtotime($dataId->tglkonfirmasi))) . ' Jam ' . date('H:i:s', strtotime($dataId->tglkonfirmasi)) . '
													</small>';
                                                            } else {
                                                                $idkonfirmasi = '-';
                                                            }
                                                            echo $idkonfirmasi;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <h5 style="text-align: center;">DETIL PENGADAAN</h5>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-striped" id="tablePengadaanDetil">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 5%;">NO.</th>
                                                        <th style="text-align: center;">ID. PRODUK</th>
                                                        <th style="text-align: center;">NAMA PRODUK</th>
                                                        <th style="text-align: center;">KATEGORI</th>
                                                        <th style="text-align: center;">SATUAN</th>
                                                        <th style="text-align: center;">QTY</th>
                                                        <th style="text-align: center; width: 10%; <?php echo ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') ? '' : 'display: none'; ?>">
                                                            QTY Konfirmasi</th>
                                                        <th style="text-align: center;">HARGA</th>
                                                        <th style="text-align: center;">TOTAL HARGA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $arr = 0;
                                                    $queryPengadaanDetil = $this->db->query("SELECT * FROM v_pengadaan_detil WHERE idpengadaan='$dataId->idpengadaan' ORDER BY namaproduk ASC ");
                                                    if ($queryPengadaanDetil->num_rows() > 0) {
                                                        foreach ($queryPengadaanDetil->result() as $rowPengadaanDetil) { ?>
                                                            <tr>
                                                                <td style="text-align: center; width: 5%;"><?php echo $no++; ?>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <?php echo $rowPengadaanDetil->idproduk; ?>
                                                                    <input type="hidden" class="form-control form-control-sm text-right" id="idproduk_<?php echo $arr; ?>" name="idproduk[]" value="<?php echo $rowPengadaanDetil->idproduk; ?>">
                                                                </td>
                                                                <td style="text-align: left;">
                                                                    <?php echo $rowPengadaanDetil->namaproduk; ?></td>
                                                                <td style="text-align: left;">
                                                                    <?php echo $rowPengadaanDetil->namakategori; ?></td>
                                                                <td style="text-align: center;">
                                                                    <?php echo $rowPengadaanDetil->satuan; ?></td>
                                                                <td style="text-align: center;">
                                                                    <?php echo number_format($rowPengadaanDetil->qty); ?>
                                                                    <input type="hidden" class="form-control form-control-sm text-right" id="qty_<?php echo $arr; ?>" name="qty[]" value="<?php echo $rowPengadaanDetil->qty ?>">
                                                                </td>
                                                                <td style="text-align: center; <?php echo ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') ? '' : 'display: none'; ?>">
                                                                    <input type="number" class="form-control form-control-sm text-right qtykonfirmasi" id="qtykonfirmasi_<?php echo $arr; ?>" name="qtykonfirmasi[]" value="<?php echo $rowPengadaanDetil->qty ?>" min="0">
                                                                </td>
                                                                <td style="text-align: right;">
                                                                    <?php echo 'Rp. ' . number_format($rowPengadaanDetil->harga); ?>
                                                                    <input type="hidden" class="form-control form-control-sm text-right" id="harga_<?php echo $arr; ?>" value="<?php echo $rowPengadaanDetil->harga; ?>" name="harga[]">
                                                                </td>
                                                                <td style="text-align: right;">
                                                                    <span id="spanTotalHarga_<?php echo $arr; ?>"><?php echo 'Rp. ' . number_format($rowPengadaanDetil->totalharga); ?></span>
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
                                                        <th colspan="<?php echo ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') ? '8' : '7'; ?>" style="text-align: right">TOTAL</th>
                                                        <th style="text-align: right">
                                                            <span id="spanGrandTotal"><?php echo 'Rp. ' . number_format($dataId->totalharga); ?></span>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <?php
                                    if ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') { ?>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="staticEmail" class="col-form-label">Status
                                                        Konfirmasi</label>
                                                    <div class="">
                                                        <select name="statuskonfirmasi" id="statuskonfirmasi" class="form-control">
                                                            <option value="Dikonfirmasi">Dikonfirmasi</option>
                                                            <option value="Ditolak">Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="form-group required">
                                                    <label for="inputPassword" class="col-form-label">Tgl.
                                                        Konfirmasi</label>
                                                    <div class="">
                                                        <input type="datetime-local" class="form-control" name="tglkonfirmasi" id="tglkonfirmasi" placeholder="tglkonfirmasi" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>

                            <div class="card-footer">
                                <?php
                                if ($level == 'Pimpinan' and $dataId->statuskonfirmasi != 'Dikonfirmasi') { ?>
                                    <button type="submit" class="btn btn-primary float-right">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                <?php
                                }
                                ?>
                                <a href="<?php echo (site_url($controller)) ?>" class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Kembali</a>
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
    $(document).ready(function() {
        $('#idsupplier').val("<?php echo $dataId->idsupplier; ?>");
        $('#tglkonfirmasi').val("<?php echo date('Y-m-d') . 'T' . date('H:i:s') ?>");
    })

    $('#tablePengadaanDetil').on('change', '.qtykonfirmasi', function() {
        var count = $('#tablePengadaanDetil tbody tr').length - 1;
        var grandTotal = 0;
        for (let i = 0; i <= count; i++) {
            var qty = parseInt($('#qty_' + i).val());
            var qtykonfirmasi = parseInt($('#qtykonfirmasi_' + i).val());
            var harga = $('#harga_' + i).val();

            if (qty < qtykonfirmasi) {
                Swal.fire(
                    "Validasi",
                    "QTY Konfirmasi melebihi dari QTY Pengadaan",
                    "warning"
                );
                qtykonfirmasi = $('#qtykonfirmasi_' + i).val(qty);
                return false;
            }

            var total = parseInt(qtykonfirmasi) * parseInt(harga);
            var grandTotal = parseInt(grandTotal) + parseInt(total);
            $('#spanTotalHarga_' + i).html('Rp. ' + numberWithCommas(total));
        }

        $('#spanGrandTotal').html('Rp. ' + numberWithCommas(grandTotal));
    });
</script>

</body>





</html>