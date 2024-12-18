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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> List <?php echo($formNameData) ?></h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <button type="button" class="btn btn-sm btn-primary float-right mb-3" data-toggle="modal"
                                data-target="#modalPenjualan">
                                <i class="fa fa-list-alt"></i> Retur Penjualan
                            </button>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">No</th>
                                    <th style="width: 10%; text-align: center;">ID. ReturPenjualan</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Penjualan</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Total Harga</th>
                                    <th style="text-align: center;">Pengguna</th>
                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="modalPenjualan" tabindex="-1" role="dialog" aria-labelledby="modalPenjualanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPenjualanLabel"><i class="fa fa-list-alt"></i> Daftar Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="tablePenjualan" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th style="width: 10%; text-align: center;">Pilih</th>
                                <th style="width: 10%; text-align: center;">ID. Penjualan</th>
                                <th style="text-align: center;">Tgl. Penjualan</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Diskon</th>
                                <th style="text-align: center;">Grand Total</th>
                                <th style="text-align: center;">Kasir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
												$no = 1;
												$queryPenjualan = $this->db->query("SELECT * FROM v_penjualan ORDER BY tglpenjualan DESC");
												if ($queryPenjualan->num_rows() > 0) {
													foreach ($queryPenjualan->result() as $rowPenjualan) { ?>
                            <tr>
                                <td style="width: 5%; text-align: center;"><?php echo $no++; ?></td>
                                <td style="width: 10%; text-align: center;">
                                    <a href="<?php echo site_url('Returpenjualan/tambah/'.$this->encrypt->encode($rowPenjualan->idpenjualan)) ?>"
                                        class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i>
                                    </a>
                                </td>
                                <td style="width: 10%; text-align: center;">
                                    <?php echo $rowPenjualan->idpenjualan; ?>
                                </td>
                                <td style="text-align: left;">
                                    <?php echo formatHariTanggal(date('Y-m-d', strtotime($rowPenjualan->tglpenjualan))) . '<br>Jam : ' . date('H:i:s', strtotime($rowPenjualan->tglpenjualan)); ?>
                                </td>
                                <td style="text-align: left;">
                                    <?php echo $rowPenjualan->keterangan; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($rowPenjualan->diskon); ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($rowPenjualan->grandtotal); ?>
                                </td>
                                <td style="text-align: left;">
                                    <?php echo $rowPenjualan->namapengguna; ?>
                                </td>
                            </tr>
                            <?php
													}
												}
												?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>


<?php 
  $this->load->view('template/footer');
?>

<script type="text/javascript">
$(document).ready(function() {

    var tablePenjualan;
    tablePenjualan = $('#tablePenjualan').DataTable();

    var table;
    table = $('#table').DataTable({
        "select": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo site_url($controller.'/getData')?>",
            "type": "POST"
        },
        "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "className": 'dt-body-center'
            },
            {
                "targets": [5],
                "className": 'dt-body-right'
            },
            {
                "targets": [-1],
                "orderable": false,
                "className": 'dt-body-center'
            },
        ],

    });

    $('#table').on('click', '#hapus', function(e) {
        var link = $(this).attr("href");
        e.preventDefault();

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Menghapus Data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = link;
            }
        });
    });

});
</script>



</body>

</html>