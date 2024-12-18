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

        <div class="card-body">

          <div class="row">
            <div class="col-md-6 col-lg-6">
              <h5 class="card-title"><i class="fa fa-list-alt"></i> Cetak Laporan Stock Opname</h5>
            </div>
          </div>

          <br>

          <a href="<?php echo (site_url('lapBarang/cetak')) ?>" class="btn btn-danger float-right mb-3" target="_blank">
            <i class="fa fa-download"></i> Cetak PDF
          </a>

          <div class="table-responsive">
            <table class="table table-striped" id="table">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 10%; text-align: center;">ID. Barang</th>
                  <th style="text-align: center;">Nama Barang</th>
                  <th style="text-align: center;">Jenis</th>
                  <th style="text-align: center;">Kategori</th>
                  <th style="text-align: center;">Harga <br>(Rp.)</th>
                  <th style="text-align: center;">Stok Satuan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no    = 1;
                $query = $this->db->query("SELECT * FROM v_barang WHERE statusaktif='Aktif' ");
                if ($query->num_rows() > 0) {
                  foreach ($query->result() as $row) {

                    if ($row->statusaktif == 'Aktif') {
                      $statusaktif = '<span class="bagde badge-success">Aktif</span>';
                    } else {
                      $statusaktif = '<span class="bagde badge-danger">Tidak Aktif</span>';
                    }
                ?>
                    <tr>
                      <td style="text-align: center;"><?php echo ($no++); ?></td>
                      <td style="text-align: center;"><?php echo ('<b>' . $row->idbarang . '</b><br>' . $statusaktif); ?></td>
                      <td style="text-align: left;"><?php echo ($row->namabarang); ?></td>
                      <td style="text-align: center;"><?php echo ($row->nama); ?></td>
                      <td style="text-align: center;"><?php echo ($row->namakategori); ?></td>
                      <td style="text-align: center;"><?php echo (number_format($row->harga)); ?></td>
                      <td style="text-align: center;"><?php echo (number_format($row->stok) . ' ' . $row->satuan); ?></td>

                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
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

  });
</script>



</body>

</html>