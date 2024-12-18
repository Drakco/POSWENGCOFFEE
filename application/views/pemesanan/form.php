<?php 
  $this->load->view('template/header');
  $this->load->view('template/topmenu');
  $this->load->view('template/sidemenu');

  $tglkonfirmasi = $dataID->tglkonfirmasi;
  if ($tglkonfirmasi == '') {
    $tglkonfirmasi = '-';
  }else{
    $tglkonfirmasi = formatHariTanggal(date('Y-m-d', strtotime($dataID->tglkonfirmasi))).' Jam '.date('H:i', strtotime($dataID->tglkonfirmasi));
  }

  $namapengguna = $dataID->namapengguna;
  if ($namapengguna == '') {
    $namapengguna = '-';
  }else{
    $namapengguna = $dataID->namapengguna;
  }

  if ($dataID->statuskonfirmasi == 'Dikonfirmasi') {
    $bg = 'bg-success';
  }elseif ($dataID->statuskonfirmasi == 'Ditolak') {
    $bg = 'bg-danger';
  }else{
    $bg = 'bg-warning';
  }
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

                <div class="card-body <?php echo $bg; ?> text-white">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <h5 class="card-title">
                                <i class="fa fa-list-alt"></i> <?php echo($formName) ?> <br>
                                <br>
                                <small><i class="fa fa-check"></i> Status
                                    <?php echo($dataID->statuskonfirmasi); ?></small>
                                <br>
                                <small>
                                    <i class="fa fa-user"> </i> <?php echo($namapengguna); ?>
                                    <?php echo str_repeat('&nbsp;', 10); ?>
                                    <i class="fa fa-calendar"></i> <?php echo($tglkonfirmasi); ?>
                                </small>
                            </h5>

                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo(site_url($controller)) ?>"
                                class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                                <i class="fa fa-chevron-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid row">

                    <!-- Informasi Pelanggan -->
                    <div class="col-md-3">

                        <div class="card card-primary card-outline" style="min-height: 200px;">
                            <div class="card-body box-profile">
                                <div class="text-center">

                                    <?php 
                if (empty($dataID->foto)) { ?>

                                    <img class="profile-user-img img-fluid img-circle"
                                        src="<?php echo(base_url()) ?>/images/nofoto_l.png" alt="User profile picture">

                                    <?php
                }else{ ?>

                                    <img class="profile-user-img img-fluid img-circle"
                                        src="<?php echo(base_url()) ?>/uploads/<?php echo($dataID->foto) ?>"
                                        alt="User profile picture">

                                    <?php
                }
                 ?>

                                </div>

                                <h3 class="profile-username text-center mt-3">
                                    <?php echo(strtoupper($dataID->namapelanggan)) ?></h3>
                                <p class="text-muted text-center"><?php echo($dataID->idpelanggan) ?></p>

                            </div>
                        </div>

                        <!-- About Me Box -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user"></i> Kelengkapan Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <strong><i class="fa fa fa-tag mr-1"></i> No. Telp & E-mail</strong>
                                <p class="text-muted">
                                    <?php echo($dataID->notelp); ?>
                                    <br>
                                    <?php echo($dataID->email) ?>
                                </p>
                                <hr>
                                <strong><i class="far fa fa-map-marker mr-1"></i> Alamat Lengkap</strong>
                                <p class="text-muted">
                                    <?php echo($dataID->alamat); ?>
                                </p>
                                <hr>
                                <strong><i class="far fa fa-map mr-1"></i> Wilayah</strong>
                                <p class="text-muted">
                                    <?php echo($dataID->negara.', '.$dataID->provinsi.', '.$dataID->kecamatan.', '.$dataID->kelurahan); ?>
                                </p>
                                <hr>
                                <strong><i class="far fa fa-map-marker mr-1"></i> Kode Pos</strong>
                                <p class="text-muted">
                                    <?php echo($dataID->kodepos); ?>
                                </p>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-phone"></i> Kontak Pelanggan</h3>
                            </div>

                            <div class="card-body row">

                                <div class="col-4">
                                    <a href="mailto:<?php echo($dataID->email); ?>" target="_blank">
                                        <img src="<?php echo(base_url('images/mail.png')) ?>" alt=""
                                            class="img-thumbnail float-right m-1" style="height: 80%; width: auto;">
                                    </a>
                                </div>

                                <div class="col-4">
                                    <a href="https://api.whatsapp.com/send?phone=<?php echo($dataID->notelp); ?>&text=Hello"
                                        target="_blank">
                                        <img src="<?php echo(base_url('images/wa.png')) ?>" alt=""
                                            class="img-thumbnail float-right m-1" style="height: 80%; width: auto;">
                                    </a>
                                </div>

                                <div class="col-4">
                                    <a href="tel:<?php echo($dataID->notelp); ?>">
                                        <img src="<?php echo(base_url('images/telp1.png')) ?>" alt=""
                                            class="img-thumbnail float-right m-1" style="height: 80%; width: auto;">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Informasi Pelanggan -->

                    <!-- Pemesanan -->
                    <div class="col-md-9">

                        <div class="card card-primary card-outline" style="min-height: 250px;">

                            <div class="card-body box-profile">
                                <h3 class="card-title"><i class="fa fa-box"></i> Pemesanan</h3>
                                <div class="clearfix"></div>
                                <br>

                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 25%">ID. Pemesanan</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td>IVC-<?php echo($dataID->idpemesanan) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Tgl. Pemesanan</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td><?php echo(formatHariTanggal(date('Y-m-d', strtotime($dataID->tglpemesanan)))) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Ekspedisi</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td><?php echo($dataID->namaekspedisi) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Tarif Ekspedisi</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td><?php echo 'Rp. '.(number_format($dataID->totaltarif)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Keterangan</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td><?php echo($dataID->keterangan) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Total Harga</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td>
                                                        <span
                                                            style="font-size: 28px; color: red; font-weight: bold;"><?php echo('Rp. '.number_format($dataID->totalharga + $dataID->totaltarif)) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 25%">Status Lunas</td>
                                                    <td style="width: 5%;"> : </td>
                                                    <td>
                                                        <?php 
                          if ($dataID->statuslunas == 'Sudah Lunas') {
                            $statuslunas = '<span class="badge badge-success">Sudah Lunas</span>';
                          }else{ 
                            $statuslunas = '<span class="badge badge-danger">Belum Lunas</span>';
                          }
                          echo($statuslunas);
                           ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-4">
                                        <?php 
                  if (!empty($dataID->qrcode)) { ?>
                                        <img src="<?php echo(base_url('uploads/qrcode_pemesanan/'.$dataID->qrcode.'.png')) ?>"
                                            alt=""
                                            style="height: 180px; width: auto; display: block; margin: 0 auto; margin-top: -10px;">
                                        <?php
                  }
                   ?>
                                    </div>
                                </div>



                            </div>
                        </div>


                        <div class="card card-primary card-outline" style="min-height: 250px;">

                            <div class="card-body box-profile">
                                <h3 class="card-title"><i class="fa fa-list-alt"></i> Detil Pemesanan</h3>
                                <div class="clearfix"></div>
                                <br>

                                <div class="table-responsive" style="overflow-x:auto; width: 100%;">
                                    <table class="table table-sm table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 5%;">#</th>
                                                <th style="text-align: center; width: 15%;">Foto</th>
                                                <th style="text-align: center;">Kategori</th>
                                                <th style="text-align: center;">Item</th>
                                                <th style="text-align: center;">Harga</th>
                                                <th style="text-align: center;">Qty</th>
                                                <th style="text-align: center;">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                  $no = 1;
                  $totalharga = 0;
                  if ($dataDetail->num_rows() > 0) {
                    foreach ($dataDetail->result() as $rowDetail) { ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo($no++); ?></td>
                                                <td style="text-align: center;">
                                                    <?php 
                          if (!empty($rowDetail->foto)) {
                            echo('<img class="img-thumbnail" style="height: auto; width: 60px;" src="'. base_url('uploads/'.$rowDetail->foto) .'">');
                          }else{
                            echo('<img class="img-thumbnail" style="height: auto; width: 60px;" src="'. base_url('images/nofoto.png') .'">');
                          }
                           ?>
                                                </td>
                                                <td style="text-align: left;"><?php echo($rowDetail->namakategori); ?>
                                                </td>
                                                <td style="text-align: left;"><?php echo($rowDetail->namaproduk); ?>
                                                </td>
                                                <td style="text-align: right;">
                                                    <?php echo('Rp. '.number_format($rowDetail->hargajual)); ?></td>
                                                <td style="text-align: center;">
                                                    <?php echo(number_format($rowDetail->qty).' '.$rowDetail->satuan); ?>
                                                </td>
                                                <td style="text-align: right;">
                                                    <?php echo('Rp. '.number_format($rowDetail->totalharga)); ?></td>

                                            </tr>
                                            <?php
                    $totalharga += $rowDetail->totalharga;
                    }
                  ?>
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align: right; font-size: 18px; font-weight: bold;">Grand
                                                    Total : </td>
                                                <td style="text-align: right; font-size: 18px; font-weight: bold;">
                                                    <?php echo('Rp. '.number_format($totalharga)) ?>
                                                </td>
                                            </tr>
                                            <?php
                  }else{ ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center;">Data Produk Tidak Ada . . .
                                                </td>
                                            </tr>
                                            <?php
                  }
                   ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <!-- end Pemesanan -->

                        <!-- informasi pelanggan -->
                        <div class="card card-primary card-outline">
                            <form action="" method="post" id="form">
                                <div class="card-body">
                                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Informasi Ke Pelanggan</h3>
                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="form-group">
                                        <textarea type="text" class="form-control" rows="5" name="informasipemesanan"
                                            id="informasipemesanan" placeholder="Tulis disini . . ."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nomor Resi</label>
                                        <input type="text" class="form-control" name="noresi" id="noresi"
                                            placeholder="Nomor Resi">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right"><i
                                            class="fa fa-paper-plane"></i> Kirim</button>
                                </div>
                            </form>



                        </div>
                        <!-- end informasi pelangan -->

                        <!-- Konfirmasi -->
                        <div class="card card-primary">

                            <div class="card-body box-profile">

                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <a href="javascript:void(0)" data-konfirmasi="Dikonfirmasi"
                                            class="btn btn-primary btn-block btn-lg update">
                                            <i class="fa fa-check"></i> Dikonfirmasi
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0)" data-konfirmasi="Ditolak"
                                            class="btn btn-danger btn-block btn-lg update">
                                            <i class="fa fa-times"></i> Ditolak
                                        </a>
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

                            $("#idpemesanan").val(result.idpemesanan);
                            $("#informasipemesanan").val(result.informasipemesanan);
                            $("#noresi").val(result.noresi);

                        }
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

                        informasipemesanan: {
                            validators: {
                                notEmpty: {
                                    message: "<span style='color:red;'>informasipemesanan tidak boleh kosong</span>"
                                },
                            }
                        },

                    }
                }).on('success.form.bv', function(e) {
                    e.preventDefault();

                    var informasipemesanan = $('#informasipemesanan').val();
                    var noresi = $('#noresi').val();
                    var primaryKey = "<?php echo ($primaryKey); ?>";


                    $.ajax({
                        url: "<?php echo (site_url('Pemesanan/simpan')) ?>",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            'primaryKey': primaryKey,
                            'informasipemesanan': informasipemesanan,
                            'noresi': noresi
                        },
                        success: function(result) {


                            if (result.status) {
                                Swal.fire(
                                    "Berhasil !",
                                    result.msg,
                                    "success"
                                );

                                setTimeout(function() {
                                    window.location.href =
                                        "<?php echo (site_url('Pemesanan/konfirmasi/' . $this->encrypt->encode($primaryKey))); ?>";
                                }, 2000);

                                return false;
                            } else {
                                Swal.fire(
                                    "Gagal !",
                                    result.msg,
                                    "error"
                                );

                                return false;
                            }

                        },
                        error: function() {
                            alert("Terjadi Kesalahan . . .");
                        }
                    });

                });
                //------------------------------------------------------------------------> END VALIDASI DAN SIMPAN
            });
            $('.update').click(function() {
                var konfirmasi = $(this).attr('data-konfirmasi');
                var primaryKey = "<?php echo ($primaryKey); ?>";

                $.ajax({
                    url: "<?php echo (site_url('Pemesanan/konfirmasi_update')) ?>",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        'primaryKey': primaryKey,
                        'konfirmasi': konfirmasi
                    },
                    success: function(result) {

                        if (result.status) {
                            Swal.fire(
                                "Berhasil !",
                                result.msg,
                                "success"
                            );

                            setTimeout(function() {
                                window.location.href =
                                    "<?php echo (site_url('Pemesanan/konfirmasi/' . $this->encrypt->encode($primaryKey))); ?>";
                            }, 2000);

                            return false;
                        } else {
                            Swal.fire(
                                "Gagal !",
                                result.msg,
                                "error"
                            );

                            return false;
                        }

                    },
                    error: function() {
                        alert("Terjadi Kesalahan . . .");
                    }
                });

            });
            </script>

            </body>

            </html>