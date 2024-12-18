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

                      <div class="form-group row">
                          <label for="staticEmail" class="col-sm-3 col-form-label">ID. Jenis</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="idjenis" id="idjenis" placeholder="Kode Otomatis Generate" readonly="">
                          </div>
                      </div>

                      <div class="form-group row required">
                          <label for="inputPassword" class="col-sm-3 col-form-label">Nama Jenis</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Jenis">
                          </div>
                      </div>

                      <div class="form-group row required">
                          <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>
                          <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
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

</div>

<?php
$this->load->view('template/footer');
?>

<script type="text/javascript">
$(document).ready(function(){

    var primaryKey = "<?php echo ($primaryKey); ?>";

    if (primaryKey != "") {

        $.ajax({
            url : "<?php echo (site_url($controller . '/getEditData')); ?>",
            type : "POST",
            dataType : "JSON",
            data : { primaryKey : primaryKey },
            success : function(result){

              $("#idjenis").val(result.idjenis);

              $("#nama").val(result.nama);
              $("#keterangan").val(result.keterangan);

            }
        });

    }else{

    }

    $("form").attr('autocomplete', 'off');
    $('.tanggal').mask('00-00-0000', {placeholder:"hh-bb-tttt"});
    $('.money').mask('000,000,000,000', {reverse: true});


    //----------------------------------------------------------------- > validasi
    $('#form').bootstrapValidator({
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {

        nama: {
          validators:{
            notEmpty: {
                message: "<span style='color:red;'>nama tidak boleh kosong</span>"
            },
          }
        },
        keterangan: {
          validators:{
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


