<?php
$this->load->view('template/header');
$this->load->view('template/topmenu');
$this->load->view('template/sidemenu');

$level = $this->session->userdata('level');
if ($level == "Tim Warehouse") {
  $readonly = "readonly='true'";
} else {
  $readonly = "";
}
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

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="staticEmail" class="col-form-label">ID. Pembelian</label>
                    <div class="">
                      <input type="text" class="form-control" name="idpembelian" id="idpembelian" placeholder="Kode Otomatis Generate" readonly="">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Tanggal</label>
                    <div class="">
                      <input type="date" class="form-control" name="tglpembelian" id="tglpembelian" placeholder="tglpembelian" <?php echo ($readonly) ?>>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">No. Struk</label>
                    <div class="">
                      <input type="text" class="form-control" name="nostruk" id="nostruk" placeholder="No. Struk" maxlength="20" <?php echo ($readonly) ?>>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Supplier</label>
                    <div class="">
                      <select name="idsupplier" id="idsupplier" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php
                        $querySupplier = $this->db->query("SELECT * FROM supplier WHERE statusaktif='Aktif' ORDER BY namasupplier ");
                        if ($querySupplier->num_rows() > 0) {
                          foreach ($querySupplier->result() as $rowSupplier) { ?>
                            <option value="<?php echo ($rowSupplier->idsupplier) ?>"><?php echo ($rowSupplier->namasupplier); ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group required">
                    <label for="inputPassword" class="col-form-label">Keterangan</label>
                    <div class="">
                      <textarea type="text" class="form-control" rows="4" name="keterangan" id="keterangan" placeholder="Keterangan" <?php echo ($readonly) ?>></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <br>
                  <h4 class="text-center">Detil Pembelian</h4>
                  <hr>
                </div>


                <div class="col">
                  <div class="form-group">
                    <label for="inputPassword" class="col-form-label">Produk</label>
                    <div class="">
                      <select name="idproduk" id="idproduk" class="form-control select2">
                        <option value="">Pilih Produk</option>
                        <?php
                        $queryProduk = $this->db->query("SELECT * FROM v_produk WHERE statusaktif='Aktif' ORDER BY namaproduk ASC ");
                        if ($queryProduk->num_rows() > 0) {
                          foreach ($queryProduk->result() as $rowProduk) { ?>
                            <option value="<?php echo ($rowProduk->idproduk) ?>"><?php echo ($rowProduk->namaproduk . ' / ' . $rowProduk->satuan) ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="form-group">
                    <label for="inputPassword" class="col-form-label">Qty</label>
                    <div class="">
                      <input type="text" class="form-control money" name="qty" id="qty" placeholder="0">
                    </div>
                  </div>
                </div>

                <div class="col">
                  <a href="javascript:void(0)" class="btn btn-info" style="margin-top: 36px;" id="tambahkan">
                    <i class="fa fa-plus"></i> Tambahkan
                  </a>
                </div>


                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="table" class="display" style="width: 100%; font-size: 15px;">
                      <thead>
                        <tr>
                          <th style="text-align: center;">#</th>
                          <th style="text-align: center;">ID</th>
                          <th style="text-align: center;  width: 15%;">Nama</th>
                          <th style="text-align: center;">Kategori</th>
                          <th style="text-align: center;">Harga Beli</th>
                          <th style="text-align: center;">Qty</th>
                          <th style="text-align: center;">Total Harga</th>
                          <th style="text-align: center;" style="width: 5%;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right; font-weight: bold; font-size: 15px;">Total : </th>
                        <th style="text-align: right; font-weight: bold; font-size: 15px" colspan="2"></th>
                        <th></th>
                      </tfoot>
                    </table>
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
  $(document).ready(function() {

    var primaryKey = "<?php echo ($primaryKey); ?>";
    var v_columnDefs = [{
        "targets": [0],
        "className": 'dt-body-center'
      },
      {
        "targets": [1],
        "className": 'dt-body-center'
      },
      {
        "targets": [4],
        "className": 'dt-body-right'
      },
      {
        "targets": [5],
        "className": 'dt-body-center'
      },
      {
        "targets": [6],
        "className": 'dt-body-right'
      },
      {
        "targets": [7],
        "className": 'dt-body-center'
      },
    ];

    if (primaryKey != "") {

      $.ajax({
        url: "<?php echo (site_url($controller . '/getEditData')); ?>",
        type: "POST",
        dataType: "JSON",
        data: {
          primaryKey: primaryKey
        },
        success: function(result) {

          $("#idpembelian").val(result.idpembelian);

          $("#tglpembelian").val(result.tglpembelian);
          $("#nostruk").val(result.nostruk);
          $("#keterangan").val(result.keterangan);
          $("#idsupplier").val(result.idsupplier);

        }
      });

    } else {
      $("#tglpembelian").val("<?php echo (date('Y-m-d')) ?>");
    }

    table = $('#table').DataTable({
      "select": true,
      "processing": true,
      "ordering": false,
      "bPaginate": false,
      "searching": false,
      "bInfo": false,
      "ajax": {
        "url": "<?php echo site_url('Pembelian/datatablesourcedetail') ?>",
        "dataType": "json",
        "type": "POST",
        "data": {
          "idpembelian": '<?php echo ($primaryKey) ?>'
        }
      },
      "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
          data;

        // Hilangkan format number untuk menghitung sum
        var intVal = function(i) {
          return typeof i === 'string' ?
            i.replace(/[\$,.]/g, '') * 1 :
            typeof i === 'number' ?
            i : 0;
        };

        // Total Semua Halaman
        total = api
          .column(6)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Total Halaman Terkait
        pageTotal = api
          .column(6, {
            page: 'current'
          })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Update footer
        $(api.column(6).footer()).html(
          'Rp. ' + numberWithCommas(total)
        );

      },
      "columnDefs": v_columnDefs,

    });

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

        tglpembelian: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>tglpembelian tidak boleh kosong</span>"
            },
          }
        },
        nostruk: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>nostruk tidak boleh kosong</span>"
            },
          }
        },
        idsupplier: {
          validators: {
            notEmpty: {
              message: "<span style='color:red;'>Supplier tidak boleh kosong</span>"
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
    }).on('success.form.bv', function(e) {
      e.preventDefault();

      var idpembelian = $('#idpembelian').val();
      var tglpembelian = $('#tglpembelian').val();
      var nostruk = $('#nostruk').val();
      var keterangan = $('#keterangan').val();
      var idsupplier = $('#idsupplier').val();


      if (!table.data().count()) {
        Swal.fire(
          "Informasi",
          "Detail Pengajuan Tidak Ada... ",
          "info"
        );
        return false;
      }

      var isidatatable = table.data().toArray();

      var formData = {
        'idpembelian': idpembelian,
        'tglpembelian': tglpembelian,
        'nostruk': nostruk,
        'keterangan': keterangan,
        'idsupplier': idsupplier,
        'isidatatable': isidatatable,
      };

      // console.log(formData);

      $.ajax({
        url: "<?php echo (site_url('Pembelian/simpan')) ?>",
        type: "POST",
        dataType: "JSON",
        data: formData,
        success: function(result) {

          if (result.success) {
            Swal.fire(
              "Berhasil",
              "Data Berhasil Disimpan... ",
              "success"
            );
            setTimeout(function() {
              window.location.href = "<?php echo (site_url('Pembelian')); ?>";
            }, 2000);
          } else {

          }

        },
        error: function() {
          alert("Terjadi kesalahan dalam simpan data...");
        }
      });


    });
    //------------------------------------------------------------------------> END VALIDASI DAN SIMPAN

    $('#tambahkan').click(function(event) {
      event.preventDefault();
      var idproduk = $('#idproduk').val();
      var qty = untitik($('#qty').val());

      if (idproduk == '') {
        Swal.fire(
          "Informasi",
          "Produk belum dipilih... ",
          "info"
        );
        return false;
      }

      if (qty == '' || qty == '0') {
        Swal.fire(
          "Informasi",
          "Qty tidak boleh 0 atau kosong ",
          "info"
        );
        return false;
      }


      var isicolomn = table.columns(1).data().toArray();
      for (var i = 0; i < isicolomn.length; i++) {
        for (var j = 0; j < isicolomn[i].length; j++) {
          if (isicolomn[i][j] === idproduk) {
            Swal.fire(
              "Informasi",
              "Produk Sudah ada... ",
              "info"
            );
            return false;
          }

        }
      }

      $.ajax({
        url: "<?php echo (site_url('Pembelian/getProduk')) ?>",
        type: "POST",
        dataType: "JSON",
        data: {
          'idproduk': idproduk,
          'qty': qty
        },
        success: function(result) {

          console.log(result);
          nomorrow = table.page.info().recordsTotal + 1;
          var i = nomorrow - 1;
          table.row.add([
            nomorrow,
            result.idproduk,
            result.namaproduk,
            result.namakategori,
            numberWithCommas(result.hargabeli),
            numberWithCommas(result.qty),
            numberWithCommas(result.totalharga),
            '<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>'
          ]).draw(false);

          $('#idproduk').val('');
          $('#idproduk').change();
          $('#qty').val(0);
        },
        error: function() {
          alert("Terjadi kesalahan load Get Produk");
        }
      })
    });

    $('#table tbody').on('click', 'span', function() {
      table
        .row($(this).parents('tr'))
        .remove()
        .draw();
    });

  });
</script>

</body>

</html>