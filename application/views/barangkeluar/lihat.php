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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo ($formNameData); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> List Penggunaan</h5>
                        </div>


                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo (site_url($controller)) ?>" class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>

                    </div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID. / Tgl. Penggunaan</td>
                                <td style="width: 5%;"> : </td>
                                <td style="width: 70%;"><b><?php echo ($dataID->idbarangkeluar); ?></b> / <?php echo (formatHariTanggal($dataID->tglbarangkeluar)); ?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td style="width: 5%;"> : </td>
                                <td style="width: 70%;">
                                    <?php echo ($dataID->keterangan); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td style="width: 5%;"> : </td>
                                <td style="width: 70%;"><b>Rp. <?php echo (number_format($dataID->totalharga)); ?></b></td>
                            </tr>
                        </tbody>
                    </table>


                    <br>
                    <h3 class="text-center">Detail Penggunaan</h3>
                    <br>

                    <div class="table-responsive">
                        <table class="table" style="width: 100%; font-size: 15px;">
                            <thead>
                                <tr class="bg-secondary">
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;  width: 15%;">Nama</th>
                                    <th style="text-align: center;">Jenis / Kategori</th>
                                    <th style="text-align: center;">Harga</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no    = 1;
                                $total = 0;
                                if ($dataDetail->num_rows() > 0) {
                                    foreach ($dataDetail->result() as $row) {
                                ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo ($no++); ?></td>
                                            <td style="text-align: center;"><?php echo ($row->idbarangkeluar); ?></td>
                                            <td style="text-align: left;"><?php echo ('<b>' . $row->namabarang . '</b> <br> Satuan : ' . $row->satuan); ?></td>
                                            <td style="text-align: center;"><?php echo ($row->namajenis . ' / ' . $row->namakategori); ?></td>
                                            <td style="text-align: right;">Rp. <?php echo (number_format($row->harga)); ?></td>
                                            <td style="text-align: center;"><?php echo (number_format($row->qty)); ?></td>
                                            <td style="text-align: right;">Rp. <?php echo (number_format($row->totalharga)); ?></td>
                                        </tr>
                                <?php
                                        $total += $row->totalharga;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="text-align: right; font-weight: bold; font-size: 15px;">Total : </th>
                                <th style="text-align: right; font-weight: bold; font-size: 15px;"><b>Rp. <?php echo (number_format($total)) ?></b></th>
                            </tfoot>
                        </table>
                    </div>









                    <!-- card -->
                </div>

                <?php
                if ($level == 'Tim Warehouse') { ?>

                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <a href="javascript:void(0)" data-konfirmasi="Dikonfirmasi" class="btn btn-primary btn-block btn-lg update">
                                    <i class="fa fa-check"></i> Disetujui
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:void(0)" data-konfirmasi="Ditolak" class="btn btn-danger btn-block btn-lg update">
                                    <i class="fa fa-times"></i> Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>


</div>

</div>

<?php
$this->load->view('template/footer');
?>

<script type="text/javascript">
    $('.update').click(function() {
        var konfirmasi = $(this).attr('data-konfirmasi');
        var primaryKey = "<?php echo ($primaryKey); ?>";

        $.ajax({
            url: "<?php echo (site_url('Barangkeluar/konfirmasi_update')) ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                'primaryKey': primaryKey,
                'konfirmasi': konfirmasi
            },
            success: function(result) {

                if (result.status) {
                    Swal.fire(
                        "Berhasil !",
                        result.msg,
                        "success"
                    );

                    setTimeout(function() {
                        window.location.href = "<?php echo (site_url('Barangkeluar/konfirmasi/' . $this->encrypt->encode($primaryKey))); ?>";
                    }, 2000);

                    return false;
                } else {
                    Swal.fire(
                        "Gagal !",
                        result.msg,
                        "error"
                    );

                    return false;
                }

            },
            error: function() {
                alert("Terjadi Kesalahan . . .");
            }
        });

    });
</script>



</body>

</html>