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
                        <li class="breadcrumb-item active"> <a
                                href="<?php echo (site_url('Kategori')) ?>"><?php echo ($formNameData); ?></a></li>
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
                            <a href="<?php echo (site_url($controller)) ?>"
                                class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>


                    <form action="<?php echo (site_url($controller . '/simpan')) ?>" method="post" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">ID. Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="idsupplier" id="idsupplier"
                                            placeholder="Kode Otomatis Generate" readonly="">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Nama Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="namasupplier" id="namasupplier"
                                            placeholder="Nama Supplier">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">No. Telp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="notelp" id="notelp"
                                            placeholder="No. Telp" onkeypress="return AllowOnlyNumbers(event);"
                                            minlength="11" maxlength="13">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="E-mail">
                                    </div>
                                </div>

                                <div class="form-group row required">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="alamat" id="alamat"
                                            placeholder="Alamat"></textarea>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Foto <span
                                            style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran file
                                                2MB</i></span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="file" name="file" id="file" accept="image/*"
                                                onchange="loadFile1(event)">
                                            <input type="hidden" value="" name="file_lama" id="file_lama"
                                                class="form-control" />
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
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <div class="form-group float-right">
                                            <label for="inputPassword" class="col-form-label">Status Aktif</label>
                                            <div class="">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="statusaktif"
                                                        name="statusaktif" value="Aktif">
                                                    <label class="form-check-label" for="statusaktif"> Aktif</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>
                                    <?php echo ($button) ?></button>

                                <a href="<?php echo (site_url($controller)) ?>"
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

                $("#idsupplier").val(result.idsupplier);

                $("#namasupplier").val(result.namasupplier);
                $("#notelp").val(result.notelp);
                $("#email").val(result.email);
                $("#alamat").val(result.alamat);

                var statusaktif = result.statusaktif;
                if (statusaktif == 'Aktif') {
                    $('#statusaktif').prop('checked', true);
                } else {
                    $('#statusaktif').prop('checked', false);
                }

                $('#file_lama').val(result.foto);
                if (result.foto != '' && result.foto != null) {
                    $("#output1").attr("src", "<?php echo (base_url('./uploads/')) ?>" + result
                        .foto);
                } else {
                    $("#output1").attr("src", "<?php echo (base_url('images/nofoto.png')) ?>");
                }

            }
        });

    } else {
        $('#statusaktif').prop('checked', true);
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

            namasupplier: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>namasupplier tidak boleh kosong</span>"
                    },
                }
            },
            notelp: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>notelp tidak boleh kosong</span>"
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
            email: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>email tidak boleh kosong</span>"
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