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
              <div class="card-body row">

                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <h6>DATA PERENCANAAN</h6>
                      <div class="table-responsive">
                        <table class="table table-sm">
                          <tbody>
                            <tr>
                              <td style="width: 25%;">ID. Perencanaan</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style=""><?php echo $dataId->idperencanaan; ?></td>
                            </tr>
                            <tr>
                              <td style="width: 25%;">Tgl. Perencanaan</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style=""><?php echo formatHariTanggal($dataId->tglperencanaan); ?></td>
                            </tr>
                            <tr>
                              <td style="width: 25%;">Jenis Perencanaan</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style=""><?php echo $dataId->jenis; ?></td>
                            </tr>
                            <tr>
                              <td style="width: 25%;">Nama Perencanaan</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style=""><?php echo $dataId->nama; ?></td>
                            </tr>
                            <tr>
                              <td style="width: 25%;">Tujuan Perencanaan</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style=""><?php echo $dataId->tujuan; ?></td>
                            </tr>
                            <tr>
                              <td style="width: 25%;">Deskrisi</td>
                              <td style="width: 5%; text-align: center;"> : </td>
                              <td style="">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalPerencanaan">
                                  <i class="fa fa-eye"></i> Lihat Selengkapnya
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="form-group">
                    <label for="staticEmail" class="col-form-label">ID. Surat</label>
                    <div class="" style="width: 30%;">
                      <input type="text" class="form-control form-control-sm" name="idperencanaansurat" id="idperencanaansurat" placeholder="Kode Otomatis Generate" readonly="">
                      <input type="hidden" class="form-control" name="idperencanaan" id="idperencanaan" value="<?php echo $dataId->idperencanaan; ?>">
                    </div>
                  </div>

                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Tgl. Surat</label>
                    <div class="" style="width: 50%;">
                      <input type="date" class="form-control form-control-sm" name="tglperencanaansurat" id="tglperencanaansurat" placeholder="tglperencanaansurat">
                    </div>
                  </div>

                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Perihal Surat</label>
                    <div class="" style="width: 80%;">
                      <input type="text" class="form-control form-control-sm" name="perihal" id="perihal" placeholder="Perihal Surat">
                    </div>
                  </div>
                </div>

                <div class="col-md-5">

                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Nama Perusahaan</label>
                    <div class="">
                      <input type="text" class="form-control form-control-sm" name="namaperusahaan" id="namaperusahaan" placeholder="Nama Perusahaan">
                    </div>
                  </div>

                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Alamat</label>
                    <div class="">
                      <textarea type="text" class="form-control form-control-sm" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-7">
                      <div class="form-group required">
                        <label for="inputPassword" class="col-form-label">Kota</label>
                        <div class="">
                          <input type="text" class="form-control form-control-sm" name="kota" id="kota" placeholder="Kota">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-5">
                      <div class="form-group required">
                        <label for="inputPassword" class="col-form-label">Kode Pos</label>
                        <div class="">
                          <input type="text" class="form-control form-control-sm" name="kodepos" id="kodepos" placeholder="Kode Pos">
                        </div>
                      </div>
                    </div>

                  </div>

                </div>

                <div class="col-md-12">
                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Isi Surat</label>
                    <div class="">
                      <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan"></textarea>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?php echo ($button) ?></button>

                <a href="<?php echo (site_url($controller)) ?>" class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Batal</a>
              </div>
            </div>

          </form>
        </div>



      </div>
    </div>
  </div>


</div>

<!-- Modal -->
<div class="modal fade" id="modalPerencanaan" tabindex="-1" aria-labelledby="modalPerencanaanLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPerencanaanLabel"><i class="fa fa-list"></i> Preview Perencanaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="card">
          <div class="card-body" style="padding-left:10%; padding-right:10%;">

            <h4 style="text-align: center;"><?php echo strtoupper($dataId->nama); ?>
            </h4>
            <hr>

            <h6 style="color: gray; text-align: right"><i class="fa fa-calendar"></i>
              <?php echo strtoupper(formatHariTanggal($dataId->tglperencanaan)); ?></h6>
            <h6 style="color: gray;"><i class="fa fa-tag"></i> JENIS PERENCANAAN :
              <?php echo strtoupper($dataId->jenis); ?></h6>
            <h6 style="color: gray; margin-top: -3px;"><i class="fa fa-tag"></i> TUJUAN PERENCANAAN :
              <?php echo strtoupper($dataId->tujuan); ?></h6>

            <?php
            if (!empty($dataId->foto)) { ?>
              <img src="<?php echo base_url('uploads/' . $dataId->foto) ?>" alt="" style="display: block; margin: 0 auto; height: 60%; width: auto;">
            <?php
            }
            ?>

            <p>
              <?php echo $dataId->keterangan; ?>
            </p>

            <?php
            if ($dataId->statusperencanaan == 'Sudah Diproses') {
              $statusperencanaan = '<span class="badge badge-success">Sudah Diproses</span>';
            } else {
              $statusperencanaan = '<span class="badge badge-warning">Sedang Diproses</span>';
            }

            echo $statusperencanaan;
            ?>

            <div class="row mt-5">
              <div class="col-md-6"></div>
              <div class="col-md-6 text-center">
                PIMPINAN
                <?php echo str_repeat('<br>', 5) ?>
                <u><b><?php echo strtoupper($dataId->namapengguna) ?></b></u>
              </div>
            </div>
          </div>
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

    var primaryKey = "<?php echo ($primaryKey); ?>";

    if (primaryKey != "") {

      $.ajax({
        url: "<?php echo (site_url($controller . '/getEditData')); ?>",
        type: "POST",
        dataType: "JSON",
        data: {
          primaryKey: primaryKey
        },
        success: function(result) {

          $("#idperencanaansurat").val(result.idperencanaansurat);

          $("#idperencanaan").val(result.idperencanaan);
          $("#tglperencanaansurat").val(result.tglperencanaansurat);
          $("#namaperusahaan").val(result.namaperusahaan);
          $("#perihal").val(result.perihal);
          $("#alamat").val(result.alamat);
          $("#kota").val(result.kota);
          $("#kodepos").val(result.kodepos);
          $("#keterangan").val(result.keterangan);

          CKEDITOR.replace("keterangan", {
            filebrowserImageBrowseUrl: "<?php echo (base_url("uploads/")) ?>",
            height: ["400px"],
          });
          CKEDITOR.instances.keterangan.setData(result.keterangan);

        }
      });

    } else {
      $('#tglperencanaansurat').val("<?php echo date('Y-m-d') ?>");
      CKEDITOR.replace("keterangan", {
        filebrowserImageBrowseUrl: "<?php echo (base_url("uploads/")) ?>",
        height: ["400px"],
      });

    }

    $("form").attr('autocomplete', 'off');
    $('.tanggal').mask('00-00-0000', {
      placeholder: "hh-bb-tttt"
    });
    $('.money').mask('000,000,000,000', {
      reverse: true
    });


    //----------------------------------------------------------------- > validasi
    $('#form').bootstrapValidator({
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {

        idperencanaan: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>idperencanaan tidak boleh kosong</span>"
            },
          }
        },
        tglperencanaansurat: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>tglperencanaansurat tidak boleh kosong</span>"
            },
          }
        },
        namaperusahaan: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>namaperusahaan tidak boleh kosong</span>"
            },
          }
        },
        perihal: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>perihal tidak boleh kosong</span>"
            },
          }
        },
        alamat: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>alamat tidak boleh kosong</span>"
            },
          }
        },
        kota: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>kota tidak boleh kosong</span>"
            },
          }
        },
        kodepos: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>kodepos tidak boleh kosong</span>"
            },
          }
        },
        keterangan: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>keterangan tidak boleh kosong</span>"
            },
          }
        },
      }
    });
    //------------------------------------------------------------------------> END VALIDASI DAN SIMPAN
  });
</script>

</body>

</html>