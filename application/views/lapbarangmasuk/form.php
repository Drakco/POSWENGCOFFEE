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

        <div class="card-body" style="min-height: 500px">

          <div class="row">
            <div class="col-md-6 col-lg-6">
              <h5 class="card-title"><i class="fa fa-list-alt"></i> Cetak Periode Laporan</h5>
            </div>
          </div>

          <br>

          <form>
            <div class="row">
              <div class="col">
                <input type="date" name="tglawal" id="tglawal" value="<?php echo (date('Y-m-d')) ?>" class="form-control" placeholder="First name">
              </div>
              <div class="col">
                <input type="date" name="tglakhir" id="tglakhir" value="<?php echo (date('Y-m-d')) ?>" class="form-control" placeholder="Last name">
              </div>

              <div class="col">
                <a href="javascript:void(0)" class="btn btn-danger" id="cetak">
                  <i class="fa fa-download"></i> Cetak PDF
                </a>
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

<script type="text/javascript">
  $(document).ready(function() {

    $('#cetak').click(function() {

      var tglawal = $('#tglawal').val();
      if (tglawal == '') {
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

      window.open("<?php echo site_url('LapBarangMasuk/cetak/') ?>" + tglawal + '/' + tglakhir + '/Laporan Pengadaan', '_blank');


    });

  });
</script>



</body>

</html>