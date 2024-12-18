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

              <div class="col-12 row">
                  <div class="col-md-4"></div>
                  <div class="col-md-8 text-bold">

                      <div class="form-group row">
                          <label for="tglawal" class="col-md-3 col-form-label text-right">Periode Laporan</label>
                          <div class="col-md-4">
                              <input type="date" name="tglawal" id="tglawal" class="form-control" value="<?php echo date('Y-m-d') ?>">
                          </div>
                          <label for="tglakhir" class="col-md-1 col-form-label text-center">s/d</label>
                          <div class="col-md-4">
                              <input type="date" name="tglakhir" id="tglakhir" class="form-control" value="<?php echo date('Y-m-d') ?>">
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-12"><hr></div>
              <div class="col-12 mb-3">
                  <h3 class="text-muted">Filter Laporan</h3>
              </div>

              <div class="col-md-4">
                <select name="status" id="status" class="form-control">
                  <option value="">Pilih Status</option>
                  <option value="Pemesanan">Pemesanan</option>
                  <option value="Penjualan">Penjualan</option>
                </select>
              </div>

              <div class="col-md-4">
                <select name="idkategori" id="idkategori" class="form-control select2">
                  <option value="">Pilih Kategori</option>
                  <?php 
                  $queryKategori = $this->db->query("SELECT * FROM kategori WHERE statusaktif='Aktif' ORDER BY namakategori ");
                  if ($queryKategori->num_rows() > 0) {
                    foreach ($queryKategori->result() as $rowKategori) {
                      echo('<option value="'.$rowKategori->idkategori.'">'.$rowKategori->namakategori.'</option>');
                    }
                  }
                   ?>
                </select>
              </div>

              <div class="col-md-4">
                <select name="idproduk" id="idproduk" class="form-control select2_1">
                  <option value="">Cari Produk</option>
                  <?php 
                  $queryProduk = $this->db->query("SELECT * FROM produk WHERE statusaktif='Aktif' ORDER BY namaproduk ");
                  if ($queryProduk->num_rows() > 0) {
                    foreach ($queryProduk->result() as $rowProduk) {
                      echo('<option value="'.$rowProduk->idproduk.'">'.$rowProduk->namaproduk.'</option>');
                    }
                  }
                   ?>
                </select>
              </div>


              <div class="col-12 text-right mt-5">
                  <!-- <button class="btn btn-sm btn-success" id="btnCetakExcel"><i class="fa fa-file-excel"></i> Cetak Excel</button> -->
                  <button class="btn btn-sm btn-danger" id="btnCetakPdf"><i class="fa fa-file-pdf"></i> Cetak PDF</button>
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
$(document).ready(function(){

  $('#btnCetakPdf').click(function(){

    var tglawal = $('#tglawal').val();
    if (tglawal=='') {
      Swal.fire(
        "Informasi",
        "Tgl. Awal belum dipilih... ",
        "info"
      );
      return false;
    }

    var tglakhir = $('#tglakhir').val();
    if (tglakhir == '') {
      Swal.fire(
        "Informasi",
        "Tgl. Akhir belum dipilih... ",
        "info"
      );
      return false;
    }

    var status = $('#status').val();
    if (status == '') {
      status = '-';
    }

    var idkategori = $('#idkategori').val();
    if (idkategori == '') {
      idkategori = '-';
    }

    var idproduk = $('#idproduk').val();
    if (idproduk == '') {
      idproduk = '-';
    }

    window.open("<?php echo site_url('LapPendapatanKotor/cetak/') ?>"+ tglawal + '/' + tglakhir + '/' + status + '/' + idkategori + '/' + idproduk + '/Laporan Pendapatan Kotor', '_blank');


  });

});
</script>



</body>
</html>


