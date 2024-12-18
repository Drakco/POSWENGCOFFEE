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

                <div class="card-body row">

                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mb-3">
                        <h3 class="text-muted">Filter Laporan</h3>
                    </div>

                    <div class="col-md-4">
                        <select name="idkategori" id="idkategori" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php   
                  $queryKategori = $this->db->query("SELECT * FROM kategori WHERE statusaktif='Aktif' ");
                  if ($queryKategori->num_rows() > 0) {
                    foreach ($queryKategori->result() as $rowKategori) { ?>
                            <option value="<?php echo($rowKategori->idkategori) ?>">
                                <?php echo($rowKategori->namakategori); ?></option>
                            <?php
                    }
                  }
                   ?>
                        </select>
                    </div>


                    <div class="col-12 text-right mt-5">
                        <!-- <button class="btn btn-sm btn-success" id="btnCetakExcel"><i class="fa fa-file-excel"></i> Cetak Excel</button> -->
                        <button class="btn btn-sm btn-danger" id="btnCetakPdf"><i class="fa fa-file-pdf"></i> Cetak
                            PDF</button>
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

    $('#btnCetakPdf').click(function() {


        var idkategori = $('#idkategori').val();
        if (idkategori == '') {
            idkategori = '-';
        }

        window.open("<?php echo site_url('LapStok/cetak/') ?>" + idkategori + '/Laporan Stok',
        '_blank');


    });

});
</script>



</body>

</html>