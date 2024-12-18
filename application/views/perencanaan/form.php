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
                            <div class="card-body row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="staticEmail" class="col-form-label">ID. Perencanaan</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="idperencanaan"
                                                id="idperencanaan" placeholder="Kode Otomatis Generate" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="inputPassword" class="col-form-label">Tgl. perencanaan</label>
                                        <div class="">
                                            <input type="date" class="form-control" name="tglperencanaan"
                                                id="tglperencanaan" placeholder="Tgl. perencanaan">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="inputPassword" class="col-form-label">Jenis Perencanaan</label>
                                        <div class="">
                                            <select name="jenis" id="jenis" class="form-control">
                                                <option value="">Pilih Jenis Perencanaan</option>
                                                <option value="Promosi">Promosi</option>
                                                <option value="Kerja Sama Dengan Distributor">Kerja Sama Dengan
                                                    Distributor</option>
                                                <option value="Kerja Sama Denga Pelanggan">Kerja Sama Denga Pelanggan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="inputPassword" class="col-form-label">Nama Perencanaan</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                placeholder="Nama Perencanaan">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group required">
                                        <label for="inputPassword" class="col-form-label">Tujuan Perencanaan</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="tujuan" id="tujuan"
                                                placeholder="Tujuan Perencanaan">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group required">
                                        <label for="inputPassword" class="col-form-label">Deskripsi</label>
                                        <div class="">
                                            <textarea type="text" class="form-control" name="keterangan" id="keterangan"
                                                placeholder="Deskripsi"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="ol-form-label">Foto <span
                                                style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran
                                                    file
                                                    2MB</i></span></label>
                                        <div class="">
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

                $("#idperencanaan").val(result.idperencanaan);

                $("#tglperencanaan").val(result.tglperencanaan);
                $("#jenis").val(result.jenis);
                $("#nama").val(result.nama);
                $("#tujuan").val(result.tujuan);
                $("#keterangan").val(result.keterangan);

                CKEDITOR.replace("keterangan", {
                    filebrowserImageBrowseUrl: "<?php echo(base_url("uploads/")) ?>",
                    height: ["400px"],
                });
                CKEDITOR.instances.keterangan.setData(result.keterangan);

                $('#file_lama').val(result.foto);
                if (result.foto != '' && result.foto != null) {
                    $("#output1").attr("src", "<?php echo(base_url('./uploads/')) ?>" + result
                        .foto);
                } else {
                    $("#output1").attr("src", "<?php echo(base_url('images/nofoto.png')) ?>");
                }

            }
        });

    } else {
        $('#tglperencanaan').val("<?php echo date('Y-m-d') ?>");
        CKEDITOR.replace("keterangan", {
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

            tglperencanaan: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>tglperencanaan tidak boleh kosong</span>"
                    },
                }
            },
            jenis: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>jenis tidak boleh kosong</span>"
                    },
                }
            },
            nama: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>nama tidak boleh kosong</span>"
                    },
                }
            },
            tujuan: {
                validators: {
                    notEmpty: {
                        message: "<span style='color:red;'>tujuan tidak boleh kosong</span>"
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