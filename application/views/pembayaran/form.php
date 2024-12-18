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
              <li class="breadcrumb-item active"> <a href="<?php echo(site_url('Kategori')) ?>"><?php echo($formNameData); ?></a></li>
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
                        <a href="<?php echo(site_url($controller)) ?>" class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
                            <i class="fa fa-chevron-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
              

              <form action="<?php echo(site_url($controller.'/simpan')) ?>" method="post" id="form" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body row">
              
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="staticEmail" class=" col-form-label">ID. Pembayaran</label>
                            <div class="">
                              <input type="text" class="form-control" name="idpembayaran" id="idpembayaran" placeholder="Kode Otomatis Generate" readonly="">
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group required">
                            <label for="inputPassword" class=" col-form-label">Tgl. Pembayaran</label>
                            <div class="">
                              <input type="datetime-local" class="form-control" name="tglpembayaran" id="tglpembayaran" placeholder="Tgl. Pembayaran">
                            </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputPassword" class=" col-form-label">Keterangan</label>
                            <div class="">
                              <textarea type="text" class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group required">
                            <label for="inputPassword" class=" col-form-label">Pemesanan</label>
                            <div class="">
                              <div class="input-group">
                                <input type="text" class="form-control" id="idpemesanan" name="idpemesanan" placeholder="Cari Pemesanan" readonly="">
                                <div class="input-group-append">
                                  <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalPemesanan">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-3" style="display:none;">
                        <div class="form-group">
                            <label for="inputPassword" class=" col-form-label">Total Pembayaran</label>
                            <div class="">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon1">Rp.</span>
                                </div>
                                <input type="text" class="form-control text-right" id="totalpembayaran" name="totalpembayaran" placeholder="0" readonly="">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-3" style="display:none;">
                        <div class="form-group">
                            <label for="inputPassword" class=" col-form-label">Sisa Pembayaran</label>
                            <div class="">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon1">Rp.</span>
                                </div>
                                <input type="text" class="form-control text-right" id="sisapembayaran" name="sisapembayaran" placeholder="0" readonly="">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-3" style="display:none;">
                        <div class="form-group required">
                            <label for="inputPassword" class=" col-form-label">Jumlah Pembayaran</label>
                            <div class="">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon1">Rp.</span>
                                </div>
                                <input type="text" class="form-control text-right money" id="jumlahpembayaran" name="jumlahpembayaran" placeholder="0">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-3" style="display:none;">
                        <div class="form-group">
                            <label for="inputPassword" class=" col-form-label">Change</label>
                            <div class="">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon1">Rp.</span>
                                </div>
                                <input type="text" class="form-control text-right" id="change" name="change" placeholder="0" readonly="">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword" class=" col-form-label">Metode Pembayaran</label>
                            <div class="">
                              <div class="form-check">
                                <div class="row">
                                  <div class="col-1 text-left">
                                    <input class="form-check-input metodepembayaran" type="radio" name="metodepembayaran" id="metodepembayaran1" value="Tunai">
                                  </div>
                                  <div class="col-11">
                                    <label class="form-check-label" for="metodepembayaran1">
                                      Tunai
                                    </label>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="form-check">
                                <div class="row">
                                  <div class="col-1 text-left">
                                    <input class="form-check-input metodepembayaran" type="radio" name="metodepembayaran" id="metodepembayaran2" value="Via Bank">
                                  </div>
                                  <div class="col-11">
                                    <label class="form-check-label" for="metodepembayaran2">
                                      Via Bank
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-check">
                                <div class="row">
                                  <div class="col-1 text-left">
                                    <input class="form-check-input metodepembayaran" type="radio" name="metodepembayaran" id="metodepembayaran3" value="COD">
                                  </div>
                                  <div class="col-11">
                                    <label class="form-check-label" for="metodepembayaran3">
                                      COD
                                    </label>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                        </div>
                      </div>

                      <div id="divPembayaran" class="col-md-12 row" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="inputPassword" class=" col-form-label">Bank Pembayaran</label>
                              <div class="">
                                <?php 
                                $queryBank = $this->db->query("SELECT * FROM bank WHERE statusaktif='Aktif' ORDER BY namabank ");
                                if ($queryBank->num_rows() > 0) {
                                  $arrBank = 1;
                                  foreach ($queryBank->result() as $rowBank) { ?>
                                
                                    <div class="form-check mb-3">
                                      <div class="row">
                                        <div class="col-1 text-left">
                                          <input class="form-check-input" type="radio" name="idbank" id="<?php echo($rowBank->idbank) ?>" value="<?php echo($rowBank->idbank); ?>">
                                        </div>
                                        <div class="col-11">
                                          <img src="<?php echo(base_url('uploads/'.$rowBank->foto)) ?>" alt="" style="height: auto; width: 150px;" class="form-check-label" for="<?php echo($rowBank->idbank) ?>">
                                        </div>
                                        
                                      </div>
                                    </div>

                                <?php
                                  }
                                }
                                 ?>
                                
                              </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="" class=" col-form-label">Bukti Pembayaran <span style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran file 2MB</i></span></label>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="file" name="file" id="file" accept="image/*" onchange="loadFile1(event)">
                                      <input type="hidden" value="" name="file_lama" id="file_lama" class="form-control" />
                                    </div>
                                    <img src="<?php echo base_url('images/nofoto.png'); ?>" id="output1" class="img-thumbnail" style="width:40%;max-height:auto;">
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


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Konfirmasi Pembayaran</button>
                        
                        <a href="<?php echo(site_url($controller)) ?>" class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Batal</a>
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

<!-- Modal -->
<div class="modal fade" id="modalPemesanan" tabindex="-1" role="dialog" aria-labelledby="modalPemesananTitle" aria-hidden="true" style="width: 100%; !important">
  <div class="modal-dialog modal-xl" role="document" style="width: 100%; !important">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-list-alt"></i> List Data Pemesanan <small><small>(yang belum lunas)</small></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive">
          <table class="table table-striped" id="tablePemesanan" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">No</th>
                    <th style="width: 10%; text-align: center;">ID. Pemesanan</th>
                    <th style="text-align: center;">Tgl. Pemesanan</th>
                    <th style="text-align: center;">Pelanggan</th>
                    <th style="text-align: center;">Total Harga</th>
                    <th style="text-align: center;">Total Pembayaran</th>
                    <th style="text-align: center;">Status Lunas</th>
                    <th style="width: 10%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>   
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    var tablePemesanan;
    tablePemesanan = $('#tablePemesanan').DataTable({ 
        "select": true,
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         "ajax": {
            "url": "<?php echo site_url('Pemesanan/getDataPembayaran')?>",
            "type": "POST"
        },
        "columnDefs": [
            { "targets": [ 0 ], "orderable": false, "className": 'dt-body-center' },
            { "targets": [ 1 ], "className": 'dt-body-center' },
            { "targets": [ 4 ], "className": 'dt-body-right' },
            { "targets": [ 5 ], "className": 'dt-body-right' },
            { "targets": [ 6 ], "className": 'dt-body-center' },
            { "targets": [ -1 ], "orderable": false, "className": 'dt-body-center' },
        ],
 
    });

    var primaryKey = "<?php echo($primaryKey); ?>";

    if (primaryKey != "") {

        $.ajax({
            url : "<?php echo(site_url($controller.'/getEditData')); ?>",
            type : "POST",
            dataType : "JSON",
            data : { primaryKey : primaryKey },
            success : function(result){
              
              $("#idpembayaran").val(result.idpembayaran);

              $("#tglpembayaran").val(result.tglpembayaran);
              $("#keterangan").val(result.keterangan);
              $("#idpemesanan").val(result.idpemesanan);
              
              getPemesanan(result.idpemesanan);

              var metodepembayaran = result.metodepembayaran;
              if (metodepembayaran == 'COD') {
                $('#metodepembayaran1').prop('checked', true);
              } else if (metodepembayaran == 'Via Bank') {
                $('#metodepembayaran2').prop('checked', true);
              } else if (metodepembayaran == 'Tunai') {
                $('#metodepembayaran3').prop('checked', true);
              }            
              metodePembayaranChange();
              // setTimeout(metodePembayaranChange, 5000);
              // $("#jumlahpembayaran").val(numberWithCommas(result.jumlahpembayaran));
              
              
              var idbank = result.idbank;
              $('#'+idbank).prop('checked', true);



              $('#file_lama').val(result.fotobuktipembayaran);
              if ( result.fotobuktipembayaran != '' && result.fotobuktipembayaran != null ) {
                  $("#output1").attr("src","<?php echo(base_url('./uploads/')) ?>" + result.fotobuktipembayaran);              
              }else{
                  $("#output1").attr("src","<?php echo(base_url('images/nofoto.png')) ?>");    
              }

            
            }
        });

    }else{
      $('#tglpembayaran').val(new Date().toJSON().slice(0,19));
      $('#metodepembayaran1').prop('checked', true);
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
        
        tglpembayaran: {
          validators:{
            notEmpty: {
                message: "<span style='color:red;'>tglpembayaran tidak boleh kosong</span>"
            },
          }
        },        
        idpemesanan: {
          validators:{
            notEmpty: {
                message: "<span style='color:red;'>idpemesanan tidak boleh kosong</span>"
            },
          }
        },        
        metodepembayaran: {
          validators:{
            notEmpty: {
                message: "<span style='color:red;'>metodepembayaran tidak boleh kosong</span>"
            },
          }
        },                
        jumlahpembayaran: {
          validators:{
            notEmpty: {
                message: "<span style='color:red;'>jumlahpembayaran tidak boleh kosong</span>"
            },
          }
        },
      }
    });
  //------------------------------------------------------------------------> END VALIDASI DAN SIMPAN
});

$('#tablePemesanan').on('click', '#add', function(){
  var idpemesanan = $(this).attr('data-idpemesanan');
  var totalharga = $(this).attr('data-totalharga');
  var totalpembayaran = $(this).attr('data-totalpembayaran');
  var sisapembayaran = parseInt(totalharga) - parseInt(totalpembayaran);
  

  $('#idpemesanan').val(idpemesanan);
  $('#totalpembayaran').val(numberWithCommas(totalpembayaran));
  $('#sisapembayaran').val(numberWithCommas(sisapembayaran));
  $('#modalPemesanan').modal('hide');
  
  setTimeout(function() { $('#jumlahpembayaran').focus() }, 1000);
});

$('#jumlahpembayaran').keyup(function(){
  jumlahPembayaranChange();
});

function jumlahPembayaranChange()
{
  var sisapembayaran = $('#sisapembayaran').val();
  if (sisapembayaran == '') {
    sisapembayaran = 0;
  }

  var jumlahpembayaran = $('#jumlahpembayaran').val();
  if (jumlahpembayaran == '') {
    jumlahpembayaran = 0;
  }

  var change = parseInt(untitik(sisapembayaran)) - parseInt(untitik(jumlahpembayaran));
  $('#change').val(numberWithCommas(change)); 

}

$('.metodepembayaran').change(function(){
  metodePembayaranChange();  
});

function metodePembayaranChange()
{
  var metodepembayaran = $('.metodepembayaran:checked').val();
  if (metodepembayaran == "Tunai") {
    $('#divPembayaran').hide(1000);
  }else if (metodepembayaran == "Via Bank") {
    $('#divPembayaran').show(1000);
  }else{
    $('#divPembayaran').hide(1000);
  } 
}

function getPemesanan(idpemesanan)
{
  if (idpemesanan != ''){
    $.ajax({
      url : "<?php echo(site_url('Pembayaran/getPemesanan')) ?>",
      method : "POST",
      dataType : "JSON",
      data : {
        'idpemesanan' : idpemesanan
      },
      success : function(result){
        console.log(result);
        $('#totalpembayaran').val(result.totalpembayaran);
        $('#sisapembayaran').val(result.sisapembayaran);
      },
      error : function(){
        alert("Terjadi Kesalahan dalam load getPemesanan");
      }
    });    
  }
}

</script>
<style>
    #tablePemesanan th {
      font-size: 12px;
      color: black;
    }

    #tablePemesanan td {
      font-size: 12px;
      vertical-align: middle;
    }

    table.dataTable thead th {
      vertical-align: middle;
    }  
</style>
</body>
</html>


