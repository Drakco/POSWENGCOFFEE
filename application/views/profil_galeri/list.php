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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo ($formNameData); ?></li>
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
                            <h5 class="card-title"><i class="fa fa-list-alt"></i> List <?php echo ($formNameData) ?></h5>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="<?php echo (site_url($controller . '/tambah')) ?>" class="btn btn-sm btn-primary float-right mb-3" title="Tambah Data">
                                <i class="fa fa-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                    </div>

                    <br>

                    <div class="row" id="table">
                        <?php
                        $queryGallery = $this->db->query("SELECT * FROM v_profil_galeri ORDER BY idgaleri DESC ");
                        if ($queryGallery->num_rows() > 0) {
                            foreach ($queryGallery->result() as $rowGallery) { ?>

                                <div class="col-md-3">
                                    <div class="card mb-5">
                                        <img class="card-img-top" src="<?php echo (base_url('uploads/' . $rowGallery->foto)) ?>" alt="" style="height: 200px; width: 100%; display: block; margin: 0 auto;">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <?php echo ($rowGallery->keterangan); ?>
                                                <br>
                                                Publish : <?php echo time_elapsed_string($rowGallery->tglupdate, 'full'); ?>
                                            </p>
                                        </div>
                                        <div class="card-footer" style="text-align: right;">
                                            <a href="<?php echo (site_url('Profil_galeri/edit/' . $this->encrypt->encode($rowGallery->idgaleri))) ?>" style="text-align: right; color: #FBE257;">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="<?php echo (site_url('Profil_galeri/hapus/' . $this->encrypt->encode($rowGallery->idgaleri))) ?>" style="text-align: right; color: red;" id="hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        } else { ?>
                            <div class="col-md-12">
                                <h3 style="text-align: center;">Belum ada data . . .</h3>
                            </div>
                        <?php
                        }
                        ?>

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