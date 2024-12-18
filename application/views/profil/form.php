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
                        <li class="breadcrumb-item"><a href="<?php echo(site_url('Dashboard')) ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"> <a
                                href="<?php echo(site_url('Kategori')) ?>"><?php echo($formNameData); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo($formName); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> <?php echo($formName) ?></h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo(site_url($controller)) ?>"
                                class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>


                    <form action="<?php echo(site_url($controller.'/simpan')) ?>" method="post" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row" style="display: none;">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">id</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="id" id="id"
                                            placeholder="Kode Otomatis Generate" readonly="">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="namaperusahaan"
                                            id="namaperusahaan" placeholder="Nama Perusahaan">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Tentang Kami</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="tentangkami" id="tentangkami"
                                            placeholder="Tentang Kami"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Logo Perusahaan<span
                                            style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran file
                                                5MB</i></span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="file" name="logoperusahaan" id="logoperusahaan"
                                                accept="image/*" onchange="loadFile1(event)">
                                            <input type="hidden" value="" name="logoperusahaan_lama"
                                                id="logoperusahaan_lama" class="form-control" />
                                        </div>
                                        <img src="<?php echo base_url('images/nofoto.png'); ?>" id="output1"
                                            class="img-thumbnail" style="width:20%;max-height:auto;">
                                        <script type="text/javascript">
                                        var loadFile1 = function(event) {
                                            var output1 = document.getElementById('output1');
                                            output1.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                        </script>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Foto Perusahaan<span
                                            style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran file
                                                5MB</i></span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="file" name="fotoperusahaan" id="fotoperusahaan"
                                                accept="image/*" onchange="loadFile2(event)">
                                            <input type="text" value="" name="fotoperusahaan_lama"
                                                id="fotoperusahaan_lama" class="form-control" />
                                        </div>
                                        <img src="<?php echo base_url('images/nofoto.png'); ?>" id="output2"
                                            class="img-thumbnail" style="width:20%;max-height:auto;">
                                        <script type="text/javascript">
                                        var loadFile2 = function(event) {
                                            var output2 = document.getElementById('output2');
                                            output2.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                        </script>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>
                                    <?php echo($button) ?></button>

                                <a href="<?php echo(site_url($controller)) ?>"
                                    class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Batal</a>
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

    var primaryKey = "<?php echo($primaryKey); ?>";

    if (primaryKey != "") {

        $.ajax({
            url: "<?php echo(site_url($controller.'/getEditData')); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                primaryKey: primaryKey
            },
            success: function(result) {

                $("#id").val(result.id);

                $("#namaperusahaan").val(result.namaperusahaan);

                CKEDITOR.replace("tentangkami", {
                    filebrowserImageBrowseUrl: "<?php echo(base_url("uploads/")) ?>",
                    height: ["400px"],
                });
                CKEDITOR.instances.tentangkami.setData(result.tentangkami);

                $('#logoperusahaan_lama').val(result.logoperusahaan);
                if (result.logoperusahaan != '' && result.logoperusahaan != null) {
                    $("#output1").attr("src", "<?php echo(base_url('./uploads/')) ?>" + result
                        .logoperusahaan);
                } else {
                    $("#output1").attr("src", "<?php echo(base_url('images/nofoto.png')) ?>");
                }

                $('#fotoperusahaan_lama').val(result.fotoperusahaan);
                if (result.fotoperusahaan != '' && result.fotoperusahaan != null) {
                    $("#output2").attr("src", "<?php echo(base_url('./uploads/')) ?>" + result
                        .fotoperusahaan);
                } else {
                    $("#output2").attr("src", "<?php echo(base_url('images/nofoto.png')) ?>");
                }

            }
        });

    } else {

        CKEDITOR.replace("tentangkami", {
            filebrowserImageBrowseUrl: "<?php echo(base_url("uploads/")) ?>",
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

            namaperusahaan: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>namaperusahaan tidak boleh kosong</span>"
                    },
                }
            },
            tentangkami: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>tentangkami tidak boleh kosong</span>"
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