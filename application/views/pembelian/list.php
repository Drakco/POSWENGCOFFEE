<?php
$this->load->view('template/header');
$this->load->view('template/topmenu');
$this->load->view('template/sidemenu');
$level = $this->session->userdata('level');
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
							<h5 class="card-title"><i class="fa fa-list-alt"></i> List <?php echo ($formNameData) ?>
							</h5>
						</div>

						<div class="col-md-6 col-lg-6">
							<a href="<?php echo (site_url($controller . '/tambah')) ?>" class="btn btn-sm btn-primary float-right mb-3" title="Tambah Data">
								<i class="fa fa-plus-circle"></i> Tambah Data
							</a>

						</div>

					</div>


					<div class="table-responsive">
						<table class="table table-striped" id="table">
							<thead>
								<tr>
									<th style="width: 5%; text-align: center;">No</th>
									<th style="width: 10%; text-align: center;">ID. Pembelian</th>
									<th style="text-align: center;">Tanggal</th>
									<th style="text-align: center; width: 20%;">Keterangan</th>
									<th style="text-align: center;">No. Struk</th>
									<th style="text-align: center;">Foto Struk</th>
									<th style="text-align: center;">Supplier</th>
									<th style="text-align: center;">Total <br> Harga (Rp.) </th>
									<th style="text-align: center;">Pengadaan</th>
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
	</div>


</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">

		<form action="<?php echo (site_url($controller . '/simpanUpload')) ?>" method="post" id="form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Foto Struk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">ID. Pembelian</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="idpembelian" id="idpembelian" readonly="">
						</div>
					</div>

					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Upload Struk</label>
						<div class="col-sm-9">
							<input type="file" class="form-control" name="file" id="file">
							<input type="hidden" class="form-control" name="file_lama" id="file_lama">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
						Close</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
				</div>
			</div>
		</form>

	</div>
</div>

<?php
$this->load->view('template/footer');
?>

<script type="text/javascript">
	$(document).ready(function() {

		var v_columnDefs = [{
				"targets": [0],
				"orderable": false,
				"className": 'dt-body-center'
			},
			{
				"targets": [1],
				"className": 'dt-body-center'
			},
			{
				"targets": [2],
				"className": 'dt-body-center'
			},
			{
				"targets": [4],
				"className": 'dt-body-left'
			},
			{
				"targets": [5],
				"orderable": false,
				"className": 'dt-body-center'
			},
			{
				"targets": [7],
				"className": 'dt-body-right'
			},
			{
				"targets": [-1],
				"orderable": false,
				"className": 'dt-body-center'
			},
		];

		var table;
		table = $('#table').DataTable({
			"select": true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url($controller . '/getData') ?>",
				"type": "POST"
			},
			"columnDefs": v_columnDefs,

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

	$('#table').on('click', '#uploadStruk', function() {
		var idpembelian = $(this).attr("data-idpembelian");
		var file_lama = $(this).attr("data-foto");

		$('#idpembelian').val(idpembelian);
		$('#file_lama').val(file_lama);
	});
</script>




</body>

</html>
