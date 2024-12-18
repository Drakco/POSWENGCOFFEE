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
							<a href="<?php echo (site_url($controller . '/list')) ?>"
								class="btn btn-sm btn-default float-right mb-3" title="Tambah Data">
								<i class="fa fa-chevron-circle-left"></i> Kembali
							</a>
						</div>
					</div>

					<div class="card">
						<div class="card-body">

							<div class="row">
								<div class="col-md-12">
									<h5>QR INVOICE PEMESANAN</h5>
									<?php

									$dataBank = $this->db->query("SELECT * FROM bank WHERE idbank='BNK-000002' ")->row();


									if (!empty($dataBank->foto)) { ?>
										<a href="<?php echo base_url('uploads/' . $dataBank->foto) ?>" target="_blank">
											<img src="<?php echo base_url('uploads/' . $dataBank->foto) ?>" alt=""
												style="width: 30%; height: auto; display: block; margin: 0 auto;"
												class="img img-thumbnail">
										</a>
									<?php
									} else { ?>
										<img src="<?php echo base_url('images/nofoto.png') ?>" alt=""
											style="width: 100%; height: auto; display: block; margin: 0 auto;"
											class="img img-thumbnail">
									<?php
									}
									?>
								</div>

								<div class="col-md-4"></div>
								<div class="col-md-4 mt-4">
									<div class="card">
										<div class="card-body p-0">
											<table class="table table-sm">
												<thead>
													<tr>
														<th style="text-align: center;"><span
																style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Total Harga : Rp.' . number_format($dataId->grandtotal); ?></span>
														</th>
													</tr>
													<tr>
														<th style="text-align: center;"><span
																style="font-size: 18px; color: red; font-weight: bold;"><?php echo $dataId->keterangan ?></span>
														</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="card-footer">
							<a href="javascript:void(0)" id="simpanPembayaran"
								class="btn btn-success float-right mr-1 ml-1" id="konfirmasi"><i class="fa fa-check"></i> Selesai Pembayaran</a>
							<a href="<?php echo (site_url($controller . '/list')) ?>"
								class="btn btn-danger float-right mr-1 ml-1"><i class="fa fa-times"></i> Kembali</a>
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
	$('.money').mask('000,000,000,000', {
		reverse: true
	});

	$('#pembayaran').blur(function() {
		pembayaran();
	})

	function pembayaran() {
		var totalpembayaran = untitik($('#totalpembayaran').val());

		var pembayaran = $('#pembayaran').val();
		if (pembayaran == '') {
			pembayaran = 0;
		} else {
			var pembayaran = untitik(pembayaran);
		}
		var kembalian = parseInt(pembayaran) - parseInt(totalpembayaran);
		$('#kembalian').val(numberWithCommas(kembalian));
	}

	$('#simpanPembayaran').click(function(e) {
		var idpenjualan = "<?php echo $dataId->idpenjualan; ?>";

		e.preventDefault();

		Swal.fire({
			title: 'Apakah Anda Yakin?',
			text: "Proses Pembayaran Ini Sudah Selesai ?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Sudah Selesai!'
		}).then((result) => {
			if (result.value) {

				$.ajax({
					url: "<?php echo (site_url('Penjualan/updateBayarNonTunai')) ?>",
					type: "POST",
					dataType: "JSON",
					data: {
						'idpenjualan': idpenjualan
					},
					success: function(result) {

						if (result.success) {
							Swal.fire(
								"Berhasil",
								"Data Berhasil Disimpan... ",
								"success"
							);
							setTimeout(function() {
								window.open(
									"<?php echo (site_url('Penjualan/cetak/')); ?>" +
									result.idpenjualan);
							}, 2000);
						} else {

						}

					},
					error: function() {
						alert("Terjadi kesalahan dalam simpan data...");
					}
				});

			}
		});

	});
</script>

</body>





</html>