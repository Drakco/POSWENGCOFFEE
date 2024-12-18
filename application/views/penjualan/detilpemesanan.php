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
								<div class="col-md-9">
									<h5>DATA PESANAN</h5>
									<div class="table-responsive">
										<table class="table table-sm">
											<tbody>
												<tr>
													<td style="width: 30%">ID. Penjualan</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style=""><?php echo $dataId->idpenjualan; ?></td>
												</tr>
												<tr>
													<td style="width: 30%">Tgl. Pemesanan</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style="">
														<?php echo formatHariTanggal(date('Y-m-d', strtotime($dataId->tglpenjualan))); ?>
													</td>
												</tr>
												<tr>
													<td style="width: 30%">Keterangan</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style=""><?php echo $dataId->keterangan; ?></td>
												</tr>
												<tr>
													<td style="width: 30%">Pelayan</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style=""><?php echo $dataId->namapengguna; ?></td>
												</tr>
												<tr>
													<td style="width: 30%">Cara Pembayaran</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style=""><?php echo $dataId->carapembayaran; ?></td>
												</tr>
												<tr>
													<td style="width: 30%">Total Harga</td>
													<td style="width: 5%; text-align: center">: </td>
													<td style=""><span
															style="font-size: 28px; color: green; font-weight: bold;"><?php echo 'Rp.' . number_format($dataId->grandtotal); ?></span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-3">
									<h5>QR INVOICE PEMESANAN</h5>
									<?php
									if (!empty($dataId->qrcode)) { ?>
										<a href="<?php echo base_url('uploads/qrcode_penjualan/' . $dataId->qrcode . '.png') ?>" target="_blank">
											<img src="<?php echo base_url('uploads/qrcode_penjualan/' . $dataId->qrcode . '.png') ?>" alt=""
												style="width: 100%; height: auto; display: block; margin: 0 auto;"
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

								<div class="col-md-12 mt-4">
									<h5 style="text-align: center;">DETIL PESANAN</h5>

									<div class="table-responsive mt-4">
										<table class="table table-striped">
											<thead>
												<tr>
													<th style="text-align: center; width: 5%;">NO.</th>
													<th style="text-align: center;">ID. PRODUK</th>
													<th style="text-align: center;">NAMA PRODUK</th>
													<th style="text-align: center;">KATEGORI</th>
													<th style="text-align: center;">SATUAN</th>
													<th style="text-align: center;">QTY</th>
													<th style="text-align: center;">HARGA</th>
													<th style="text-align: center;">TOTAL HARGA</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												$query = $this->db->query("SELECT * FROM v_penjualandetil WHERE idpenjualan='$dataId->idpenjualan' ORDER BY namaproduk ASC ");
												if ($query->num_rows() > 0) {
													foreach ($query->result() as $row) { ?>
														<tr>
															<td style="text-align: center; width: 5%;"><?php echo $no++; ?></td>
															<td style="text-align: center;">
																<?php echo $row->idproduk; ?></td>
															<td style="text-align: left;">
																<?php echo $row->namaproduk; ?></td>
															<td style="text-align: left;">
																<?php echo $row->namakategori; ?></td>
															<td style="text-align: center;">
																<?php echo $row->satuan; ?></td>
															<td style="text-align: center;">
																<?php echo number_format($row->qty); ?></td>
															<td style="text-align: right;">
																<?php echo 'Rp. ' . number_format($row->hargajual); ?>
															</td>
															<td style="text-align: right;">
																<?php echo 'Rp. ' . number_format($row->totalharga); ?>
															</td>
														</tr>
												<?php
													}
												}
												?>
											</tbody>
											<tfoot>
												<tr>
													<th colspan="7" style="text-align: right">TOTAL</th>
													<th style="text-align: right">
														<?php echo 'Rp. ' . number_format($dataId->totalharga); ?></th>
												</tr>
											</tfoot>
										</table>
									</div>

								</div>
							</div>

						</div>

						<div class="card-footer">
							<a href="<?php echo (site_url($controller . '/updatepemesanan/' . $this->encrypt->encode($dataId->idpenjualan))) ?>"
								class="btn btn-success float-right mr-1 ml-1" id="konfirmasi"><i class="fa fa-check"></i> Sudah Selesai</a>
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
	$(document).on('click', '#konfirmasi', function(e) {
		var link = $(this).attr("href");
		e.preventDefault();

		Swal.fire({
			title: 'Apakah Anda Yakin?',
			text: "Pesanan ini sudah selesai anda proses ?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Sudah Selesai!'
		}).then((result) => {
			if (result.value) {
				document.location.href = link;
			}
		});
	});
</script>

</body>





</html>