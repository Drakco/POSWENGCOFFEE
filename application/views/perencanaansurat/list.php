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
              <h5 class="card-title"><i class="fa fa-list-alt"></i> List <?php echo ($formNameData) ?></h5>
            </div>
            <div class="col-md-6 col-lg-6">
              <?php
              if ($level != 'Pimpinan') { ?>
                <button type="button" class="btn btn-sm btn-primary float-right mb-3" title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-plus-circle"></i> Tambah Data
                </button>
              <?php
              } else {
                echo '<br><br>';
              }
              ?>
            </div>
          </div>


          <div class="table-responsive">
            <table class="table table-striped" id="table">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 10%; text-align: center;">ID. Surat</th>
                  <th style="text-align: center;">Tgl. Surat</th>
                  <th style="text-align: center;">Jenis Perencanaan</th>
                  <th style="text-align: center;">Perencanaan</th>
                  <th style="text-align: center;">Nama Perusahaan</th>
                  <th style="text-align: center;">Perihal</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list-alt"></i> Daftar Perencanaan Bisnis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="table-responsive">
          <table class="table table-striped" id="tablePerencanaan" style="font-size: 11px; width: 1200px;">
            <thead>
              <tr>
                <th style="text-align: center; width: 1%;">Pilih</th>
                <th style="text-align: center; width: 1%;">ID. Perencanaan</th>
                <th style="text-align: center;">Jenis</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">Tujuan</th>
                <th style="text-align: center;">Pengguna</th>
                <th style="text-align: center;">Foto</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $queryPerencanaan = $this->db->query("SELECT * FROM v_perencanaan WHERE statusperencanaan='Sedang Diproses' ORDER BY idperencanaan ASC");
              if ($queryPerencanaan->num_rows() > 0) {
                foreach ($queryPerencanaan->result() as $rowPerencanaan) { ?>
                  <tr>
                    <td style="vertical-align: middle; text-align: center;">
                      <a href="<?php echo site_url('Perencanaansurat/tambah/' . $this->encrypt->encode($rowPerencanaan->idperencanaan)) ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-check"></i>
                      </a>
                    </td>
                    <td style="vertical-align: middle; text-align: left;">
                      <?php
                      echo 'ID. ' . $rowPerencanaan->idperencanaan . '<br>' . formatHariTanggal($rowPerencanaan->tglperencanaan);
                      ?>
                    </td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo $rowPerencanaan->jenis ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo $rowPerencanaan->nama ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo $rowPerencanaan->tujuan ?></td>
                    <td style="vertical-align: middle; text-align: left;">
                      <?php
                      $idpengguna = '<span>
                    ' . $rowPerencanaan->namapengguna . ' <br>
                    ' . date('d/m/Y H:i:s', strtotime($rowPerencanaan->tglupdate)) . '
                    </span>';
                      echo $idpengguna;
                      ?>
                    </td>
                    <td style="vertical-align: middle; text-align: center;">
                      <?php
                      if ($rowPerencanaan->foto == '') {
                        $fotoPerencanaan = '<img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('images/nofoto_l.png') . '">';
                      } else {
                        $fotoPerencanaan = '<a href="' . base_url('uploads/' . $rowPerencanaan->foto) . '" target="_blank"><img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('uploads/' . $rowPerencanaan->foto) . '"></a>';
                      }
                      echo $fotoPerencanaan;
                      ?>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>


<?php
$this->load->view('template/footer');
?>

<script type="text/javascript">
  $(document).ready(function() {

    var tablePerencanaan;
    tablePerencanaan = $('#tablePerencanaan').DataTable();

    var table;
    table = $('#table').DataTable({
      "select": true,
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?php echo site_url($controller . '/getData') ?>",
        "type": "POST"
      },
      "columnDefs": [{
          "targets": [0],
          "orderable": false,
          "className": 'dt-body-center'
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