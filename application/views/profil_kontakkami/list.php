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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo($formNameData); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> Kontak Kami</h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo(site_url($controller.'/edit/'.$this->encrypt->encode($dataId->id))) ?>"
                                class="btn btn-sm btn-warning float-right mb-3" title="Edit Data">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <h3>Bagaimana Menghubungi Kami ?</h3>
                                <i>Berikut adalah daftar kontak dan alamat kami</i>
                            </div>
                            <hr>
                            <br>

                            <?php   
                    $iframe = str_replace('width="600"', 'width="100%"', $dataId->iframegoogle);
                    $iframe = str_replace('height="450"', 'height="300"', $iframe);
                    echo($iframe);
                    ?>
                            <div class="clearfix"></div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="min-height: 120px;">
                                        <div class="card-body">
                                            <i class="fa fa-map-marker" style="color: red;"></i> <i
                                                style="font-size: 13px;"><?php echo($dataId->alamat); ?></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card" style="min-height: 120px;">
                                        <div class="card-body">
                                            <i class="fa fa-phone" style="color: red;"></i>
                                            <a href="tel:<?php echo(hp($dataId->notelp)); ?>" style="color: gray;"
                                                target="_blank">
                                                <?php echo(hp($dataId->notelp)); ?>
                                            </a>

                                            <br>

                                            <span style="color: red; font-weight: bold;">WA</span>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo(hp($dataId->notelp)); ?>&text=Hello%20Admin%20I%20want%20to%20order%20"
                                                style="color: gray;" target="_blank">
                                                <?php echo(hp($dataId->notelp)); ?>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card" style="min-height: 120px;">
                                        <div class="card-body">
                                            <i class="fa fa-envelope" style="color: red;"></i>
                                            <a href="mailto:<?php echo($dataId->email); ?>" style="color: gray;"
                                                target="_blank">
                                                <?php echo($dataId->email); ?>
                                            </a>

                                        </div>
                                    </div>
                                </div>


                            </div>

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

    var table;
    table = $('#table').DataTable({
        "select": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo site_url($controller.'/getData')?>",
            "type": "POST"
        },
        "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "className": 'dt-body-center'
            },
            {
                "targets": [-1],
                "orderable": false,
                "className": 'dt-body-center'
            },
        ],

    });

    $('#table').on('click', '#hapus', function(e) {
        var link = $(this).attr("href");
        e.preventDefault();

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Menghapus Data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = link;
            }
        });
    });

});
</script>



</body>

</html>