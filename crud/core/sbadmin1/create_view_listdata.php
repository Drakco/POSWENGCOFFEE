<?php 

$string = '<?php 
    $this->load->view(\'template/header\');
    $this->load->view(\'template/topmenu\');
    $this->load->view(\'template/sidemenu\');
 ?>

<main>
    <div class="container-fluid">
        <h2 class="mt-4"><i class="fa fa-tag"></i> <?php echo($formNameHead); ?></h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo(site_url(\'Home\')) ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-database"></i> <?php echo($formNameData); ?></li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h5 class="card-title"><i class="fa fa-list-alt"></i> List <?php echo($formNameData) ?></h5>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <a href="<?php echo(site_url($controller.\'/tambah\')) ?>" class="btn btn-sm btn-primary float-right mb-3" title="Tambah Data">
                            <i class="fa fa-plus-circle"></i> Tambah Data
                        </a>
                    </div>
                </div>
                
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>';
foreach ($non_pk as $row) {

$string .='
                                <th style="">'.$row["column_name"].'</th>';
}

$string .='
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
</main>

<?php 
    $this->load->view(\'template/footer\');
    $pesan = $this->session->flashdata(\'pesan\');
    if (isset($pesan)) {
        echo($pesan);
    }
 ?>

 <script type="text/javascript">
$(document).ready(function(){

    var table;
    table = $(\'#table\').DataTable({ 
        "select": true,
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         "ajax": {
            "url": "<?php echo site_url($controller.\'/getData\')?>",
            "type": "POST"
        },
        "columnDefs": [
            { "targets": [ 0 ], "orderable": false, "className": \'dt-body-center\' },
            { "targets": [ -1 ], "orderable": false, "className": \'dt-body-center\' },
        ],
 
    });

    $(\'#table\').on(\'click\',\'#hapus\', function(e){
      var link = $(this).attr("href");
      e.preventDefault();

      Swal.fire({
        title: \'Apakah Anda Yakin?\',
        text: "Ingin Menghapus Data ini ?",
        icon: \'warning\',
        showCancelButton: true,
        confirmButtonColor: \'#3085d6\',
        cancelButtonColor: \'#d33\',
        confirmButtonText: \'Ya, Hapus Data!\'
      }).then((result) => {
        if (result.value) {
          document.location.href = link;
        }
      });  
    });

});
 </script>



';


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>