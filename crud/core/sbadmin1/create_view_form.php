<?php 

$string ='<?php 
    $this->load->view(\'template/header\');
    $this->load->view(\'template/topmenu\');
    $this->load->view(\'template/sidemenu\');
 ?>

<main>
    <div class="container-fluid">
        <h2 class="mt-4"><i class="fa fa-tag"></i> <?php echo($formNameHead) ?></h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo(site_url(\'Home\')) ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-database"></i> <?php echo($formNameData) ?></li>
        </ol>

        <div class="card mb-4 row">
            
            <div class="card-body col-sm-12 ">
                <h5 class="card-title">
                    <i class="fa fa-edit"></i> 
                    <?php echo($formName); ?>
                </h5>
                <hr>

                <form action="<?php echo(site_url($controller.\'/simpan\')) ?>" method="post" id="form" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">
                        
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">'.$pk.'</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="'.$pk.'" id="'.$pk.'" placeholder="Kode Otomatis Generate" readonly="">
                                </div>
                            </div>
';

foreach ($non_pk as $row) {

$string .= '
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">'.$row['column_name'].'</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="'.$row['column_name'].'" id="'.$row['column_name'].'" placeholder="'.$row['column_name'].'">
                                </div>
                            </div>
';

}


$string .= '
                            <!-- <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Foto <span style="color: red; font-size: 12px; font-weight: bold;"><i> Max ukuran file 2MB</i></span></label>
                                    <div class="col-md-9">
                                      <img src="<?php echo base_url(\'images/nofoto.png\'); ?>" id="output1" class="img-thumbnail" style="width:30%;max-height:30%;">
                                      <div class="form-group">
                                          <span class="btn btn-success btn-file btn-block;" style="width:30%;">
                                            <span class="fileinput-new">
                                            <input type="file" name="file" id="file" accept="image/*" onchange="loadFile1(event)">
                                            <input type="hidden" value="" name="file_lama" id="file_lama" class="form-control" />
                                          </span>
                                      </div>
                                      <script type="text/javascript">
                                          var loadFile1 = function(event) {
                                              var output1 = document.getElementById(\'output1\');
                                              output1.src = URL.createObjectURL(event.target.files[0]);
                                          };
                                      </script>
                                    </div>
                            </div> -->

                            

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?php echo($button) ?></button>
                            
                            <a href="<?php echo(site_url($controller)) ?>" class="btn btn-default float-right mr-1 ml-1"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                        </div>
                    </div>

                </form>  





                
                
            </div>
        </div>
    </div>
</main>

<?php 
    $this->load->view(\'template/footer\');
 ?>

 <script type="text/javascript">
$(document).ready(function(){

    var primaryKey = "<?php echo($primaryKey); ?>";

    if (primaryKey != "") {

        $.ajax({
            url : "<?php echo(site_url($controller.\'/getEditData\')); ?>",
            type : "POST",
            dataType : "JSON",
            data : { primaryKey : primaryKey },
            success : function(result){
              
              $("#'.$pk.'").val(result.'.$pk.');
';              

foreach ($non_pk as $row) {

$string .= '
              $("#'.$row['column_name'].'").val(result.'.$row['column_name'].');';
}

$string .= '
              // $(\'#file_lama\').val(result.foto);
              // if ( result.foto != \'\' && result.foto != null ) {
              //     $("#output1").attr("src","<?php echo(base_url(\'./uploads/\')) ?>" + result.foto);              
              // }else{
              //     $("#output1").attr("src","<?php echo(base_url(\'images/nofoto.png\')) ?>");    
              // }
            
            }
        });

    }else{

    }

    $("form").attr(\'autocomplete\', \'off\');
    $(\'.tanggal\').mask(\'00-00-0000\', {placeholder:"hh-bb-tttt"});
    $(\'.money\').mask(\'000,000,000,000\', {reverse: true});


    //----------------------------------------------------------------- > validasi
    $(\'#form\').bootstrapValidator({
      feedbackIcons: {
        valid: \'glyphicon glyphicon-ok\',
        invalid: \'glyphicon glyphicon-remove\',
        validating: \'glyphicon glyphicon-refresh\'
      },
      fields: {
';  

foreach ($non_pk as $row) {
$string .='        
        '.$row['column_name'].': {
          validators:{
            notEmpty: {
                message: "<span style=\'color:red;\'>'.$row['column_name'].' tidak boleh kosong</span>"
            },
          }
        },';
}



$string .= '
      }
    });
  //------------------------------------------------------------------------> END VALIDASI DAN SIMPAN
});

</script>



';



$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>