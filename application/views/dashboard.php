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
					<h1 class="m-0 text-dark"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">

			<div class="row justify-content-center">

				<div class="col-md-12" style="display: none;">
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h4 class="">APLIKASI PENJUALAN DAN PERSEDIAAN BARANG <br>CV GEMILANG JAYA</h4>
							<p class="lead">Selamat datang kembali
								<?php echo strtoupper($this->session->userdata('namapengguna')); ?> (AKSES -
								<?php echo strtoupper($level) ?>)</p>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="card" style="display: none;">
						<div class="card-body">

							<div class="form-group row">
								<label class="col-md-12 col-form-label">Filter Box Info</label>
								<div class="col-md-4">
									<input type="number" name="boxinfo_tahun" id="boxinfo_tahun" class="form-control form-control-sm" value="<?php echo date('Y') ?>" style="text-align: right;" min="2000" minlength="4" maxlength="4">
								</div>
								<div class="col-md-4">
									<select name="boxinfo_bulan" id="boxinfo_bulan" class="form-control form-control-sm">
										<option value="01">Januari</option>
										<option value="02">Februari</option>
										<option value="03">Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06">Juni</option>
										<option value="07">Juli</option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</div>
								<div class="col-md-4">
									<a href="javascript:void(0)" id="boxinfo_filter" class="btn btn-primary btn-sm">
										<i class="fa fa-search"></i> Filter
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>


			</div>



			<div class="row">

				<div class="col-12 col-sm-6 col-md-3" style="display: none;">
					<div class="info-box">
						<span class="info-box-icon bg-info elevation-1"><i class="fa fa-calculator"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Diskon</span>
							<span class="info-box-number" id="spanDiskon">
								Rp.
							</span>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-md-3" style="display: none;">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-calculator"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Pengeluaran Modal</span>
							<span class="info-box-number" id="spanPengeluaranModal">
								Rp.
							</span>
						</div>
					</div>
				</div>

				<div class="clearfix hidden-md-up"></div>

				<div class="col-12 col-sm-6 col-md-3" style="display: none;">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-calculator"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Pendapatan Kotor</span>
							<span class="info-box-number" id="spanPendapatanKotor">
								Rp.
							</span>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-md-3" style="display: none;">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-success elevation-1"><i class="fa fa-calculator"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Pendapatan Bersih</span>
							<span class="info-box-number" id="spanPendapatanBersih">
								Rp.
							</span>
						</div>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-12" style="display: none;">
					<div class="card mb-3 text-left card-btm-border card-shadow-warning border-warning opacity-9">
						<div class="card-header">
							<h5><i class="fa fa-chart-line"></i> Statistik Pendapatan Pertanggal</span></h5>
						</div>
						<div class="card-body chartPertanggal">

							<div class="row">
								<!-- <div class="col-md-"></div> -->
								<div class="col-md-12 text-bold">

									<div class="form-group row">
										<label class="col-md-12 col-form-label">Filter Statistik</label>
										<div class="col-md-2">
											<input type="number" name="getStatistikPertanggal_tahun" id="getStatistikPertanggal_tahun" class="form-control form-control-sm" value="<?php echo date('Y') ?>" style="text-align: right;" min="2000" minlength="4" maxlength="4">
										</div>
										<div class="col-md-2">
											<select name="getStatistikPertanggal_bulan" id="getStatistikPertanggal_bulan" class="form-control form-control-sm">
												<option value="">Pilih Bulan</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<div class="col-md-2">
											<a href="javascript:void(0)" id="getStatistikPertanggal_filter" class="btn btn-primary btn-sm">
												<i class="fa fa-search"></i> Filter
											</a>
										</div>
									</div>
								</div>
							</div>

							<canvas id="chartPertanggal"></canvas>

						</div>
					</div>
				</div>

				<div class="col-md-6">

					<div class="card mb-3 text-left card-btm-border card-shadow-warning border-warning opacity-9" style="min-height: 500px;">
						<div class="card-header">
							<h5><i class="fa fa-chart-line"></i> Statistik Pendapatan Perbulan</span></h5>
						</div>
						<div class="card-body chartPerbulan">

							<div class="row">
								<!-- <div class="col-md-"></div> -->
								<div class="col-md-12 text-bold">

									<div class="form-group row">
										<label class="col-md-12 col-form-label">Filter Statistik</label>
										<div class="col-md-2">
											<input type="number" name="getStatistikBulan_tahun" id="getStatistikBulan_tahun" class="form-control form-control-sm" value="<?php echo date('Y') ?>" style="text-align: right;" min="2000" minlength="4" maxlength="4">
										</div>
										<div class="col-md-2">
											<a href="javascript:void(0)" id="getStatistikBulan_filter" class="btn btn-primary btn-sm">
												<i class="fa fa-search"></i> Filter
											</a>
										</div>
									</div>
								</div>
							</div>

							<canvas id="chartPerbulan"></canvas>

						</div>
					</div>

				</div>

				<div class="col-md-6">
					<div class="card mb-3 text-left card-btm-border card-shadow-warning border-warning opacity-9" style="min-height: 500px;">
						<div class="card-header">
							<h5><i class="fa fa-chart-line"></i> Statistik Pendapatan Pertahun</span></h5>
						</div>
						<div class="card-body chartPertahun">
							<br><br><br>
							<canvas id="chartPertahun"></canvas>

						</div>
					</div>
				</div>

				<div class="col-md-7">
					<div class="card mb-3 text-left card-btm-border card-shadow-warning border-warning opacity-9">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-table"></i> Stok Minimum</span></h5>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
						</div>
						<div class="card-body p-0">
							<table class="table table-sm">
								<thead>
									<tr>
										<th style="text-align: center; vertical-align: middle; width: 5%;"># </th>
										<th style="text-align: center; vertical-align: middle;">PRODUK</th>
										<th style="text-align: center; vertical-align: middle;">HARGA BELI</th>
										<th style="text-align: center; vertical-align: middle;">HARGA JUAL</th>
										<th style="text-align: center; vertical-align: middle;">STOK MINIMUM</th>
										<th style="text-align: center; vertical-align: middle;">STOK </th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$queryStokMinimum = $this->db->query("SELECT * FROM v_produk WHERE stokminimum >= stok AND statusaktif='Aktif' ORDER BY namaproduk ASC ");
									if ($queryStokMinimum->num_rows() > 0) {
										foreach ($queryStokMinimum->result() as $rowStokMinimum) { ?>
											<tr>
												<td style="text-align: center; vertical-align: middle;">
													<a href="<?php echo site_url('Produk/detil/' . $this->encrypt->encode($rowStokMinimum->idproduk)) ?>" class="btn btn-xs btn-info" target="_blank">
														<i class="fa fa-eye"></i>
													</a>
												</td>
												<td style="text-align: left; vertical-align: middle;">
													<?php echo '<small class="text-gray">' . $rowStokMinimum->namakategori . '</small><br>' . $rowStokMinimum->namaproduk; ?>
												</td>
												<td style="text-align: right; vertical-align: middle;">
													<?php echo 'Rp.' . number_format($rowStokMinimum->hargabeli); ?></td>
												<td style="text-align: right; vertical-align: middle;">
													<?php echo 'Rp.' . number_format($rowStokMinimum->hargajual); ?></td>
												<td style="text-align: center; vertical-align: middle;">
													<?php echo number_format($rowStokMinimum->stokminimum) . ' ' . $rowStokMinimum->satuan; ?>
												</td>
												<td style="text-align: center; vertical-align: middle;">
													<?php echo number_format($rowStokMinimum->stok) . ' ' . $rowStokMinimum->satuan; ?>
												</td>
											</tr>
										<?php
										}
									} else { ?>
										<tr>
											<th colspan="10" style="text-align: center;">TIDAK ADA DATA STOK MINIMUM</th>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="card-footer text-center">
							<a href="<?php echo site_url('Produk') ?>" class="uppercase">Tampilkan Semua Stok</a>
						</div>
					</div>
				</div>

				<div class="col-md-5">
					<!-- PRODUCT LIST -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-table"></i> Top Penjualan</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">

							<div class="row pl-2 pr-2">
								<!-- <div class="col-md-"></div> -->
								<div class="col-md-12 text-bold">

									<div class="form-group row">
										<label class="col-md-12 col-form-label">Filter Statistik</label>
										<div class="col-md-4">
											<input type="date" name="getTopPenjualan_tglawal" id="getTopPenjualan_tglawal" class="form-control form-control-sm" value="<?php echo date('Y-m-01') ?>">
										</div>
										<div class="col-md-4">
											<input type="date" name="getTopPenjualan_tglakhir" id="getTopPenjualan_tglakhir" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
										</div>
										<div class="col-md-2">
											<input type="number" name="getTopPenjualan_limit" id="getTopPenjualan_limit" class="form-control form-control-sm" value="10">
										</div>
										<div class="col-md-2">
											<a href="javascript:void(0)" id="getTopPenjualan_filter" class="btn btn-primary btn-sm">
												<i class="fa fa-search"></i>
											</a>
										</div>
									</div>
								</div>
							</div>

							<ul class="products-list product-list-in-card pl-2 pr-2" id="getTopPenjualan_load">
								<li class="item">
									<div class="product-img">
										<img src="<?php echo base_url('images/nofoto.png') ?>" alt="Product Image" class="img-size-50">
									</div>
									<div class="product-info">
										<a href="javascript:void(0)" class="product-title">AKI MOTOR
											<span class="badge badge-info float-right">7 pcs</span></a>
										<span class="product-description">
											SPARE PART MOTOR
											<span class="float-right">Harga : Rp. 195,000</span>
										</span>
									</div>
								</li>
							</ul>
						</div>
						<!-- /.card-body -->
						<div class="card-footer text-center">
							<a href="<?php echo site_url('LapPenjualan') ?>" class="uppercase">Tampilkan Laporan
								Penjualan</a>
						</div>
						<!-- /.card-footer -->
					</div>
					<!-- /.card -->
				</div>



			</div>


		</div>
	</div>




</div>

<?php
$this->load->view('template/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var bulan = "<?php echo (date('m')); ?>";
		var tahun = "<?php echo (date('Y')); ?>";

		$('#boxinfo_bulan').val(bulan);
		$('#boxinfo_tahun').val(tahun);

		$('#getStatistikPertanggal_bulan').val(bulan);
		$('#getStatistikPertanggal_tahun').val(tahun);

		boxinfo_getdata(bulan, tahun);
		getStatistikPertanggal(tahun, bulan);
		getStatistikBulan(tahun);
		getStatistikTahun();
		getTopPenjualan();
	});

	$('#boxinfo_filter').click(function() {
		var bulan = $('#boxinfo_bulan').val();
		var tahun = $('#boxinfo_tahun').val();

		boxinfo_getdata(bulan, tahun);
	});

	function boxinfo_getdata(bulan, tahun) {
		if (bulan != '' && tahun != '') {

			$.ajax({
				url: "<?php echo (site_url('Dashboard/boxinfo_getdata')) ?>",
				type: "POST",
				dataType: "JSON",
				data: {
					'bulan': bulan,
					'tahun': tahun
				},
				success: function(result) {
					// console.log(result);

					$('#spanDiskon').html('Rp. ' + numberWithCommas(result.pengeluaranDiskon));
					$('#spanPengeluaranModal').html('Rp. ' + numberWithCommas(result.pengeluaranModal));
					$('#spanPendapatanKotor').html('Rp. ' + numberWithCommas(result.pendapatanKotor));
					$('#spanPendapatanBersih').html('Rp. ' + numberWithCommas(result.pendapatanBersih));
				},
				error: function() {
					alert("Terjadi Kesalahan dalam load boxinfo_getdata . . .");
				}
			});
		}
	}

	$('#getStatistikPertanggal_filter').click(function() {
		var getStatistikPertanggal_tahun = $('#getStatistikPertanggal_tahun').val();
		var getStatistikPertanggal_bulan = $('#getStatistikPertanggal_bulan').val();

		getStatistikPertanggal(getStatistikPertanggal_tahun, getStatistikPertanggal_bulan);
	});

	function getStatistikPertanggal(getStatistikPertanggal_tahun, getStatistikPertanggal_bulan) {
		$.ajax({
			url: "<?php echo (site_url('Dashboard/getStatistikPertanggal')) ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				'tahun': getStatistikPertanggal_tahun,
				'bulan': getStatistikPertanggal_bulan
			},
			success: function(result) {
				// console.log(result);

				$('#chartPertanggal').remove();
				$('.chartPertanggal').append('<canvas id="chartPertanggal"><canvas>');


				const labels = result.arrlabels;
				const data = {
					labels: labels,
					datasets: [{
							label: 'Pengeluaran Modal',
							backgroundColor: 'rgb(255, 99, 132)',
							borderColor: 'rgb(255, 99, 132)',
							data: result.arrValue1,
						},
						{
							label: 'Pendapatan Kotor',
							backgroundColor: 'rgb(205, 209, 228)',
							borderColor: 'rgb(205, 209, 228)',
							data: result.arrValue2,
						},
						{
							label: 'Pendapatan Bersih',
							backgroundColor: 'rgb(44, 62, 80)',
							borderColor: 'rgb(44, 62, 80)',
							data: result.arrValue3,
						},
						{
							label: 'Total Diskon',
							backgroundColor: 'rgb(255, 255, 159, 1)',
							borderColor: 'rgb(255, 255, 159, 1)',
							data: result.arrValue4,
						}
					]
				};
				const config = {
					type: 'bar',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Statistik Pendapatan'
							}
						},
						scales: {
							yAxes: [{
								ticks: {
									callback: function(label, index, labels) {
										return numberWithCommas(label);
									}
								},
								scaleLabel: {
									display: true,
									labelString: 'Tahun <?php echo (date("Y")) ?>'
								}
							}]
						}
					},
				};
				var chartPertanggal = new Chart(document.getElementById('chartPertanggal'), config);
				chartPertanggal.update();


			},
			error: function() {
				alert('Telah terjadi kesalahan . . .');
			}
		});
	}

	$('#getStatistikBulan_filter').click(function() {
		var getStatistikBulan_tahun = $('#getStatistikBulan_tahun').val();
		getStatistikBulan(getStatistikBulan_tahun);
	});

	function getStatistikBulan(getStatistikBulan_tahun) {
		$.ajax({
			url: "<?php echo (site_url('Dashboard/getStatistikBulan')) ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				'tahun': getStatistikBulan_tahun
			},
			success: function(result) {
				console.log(result);

				$('#chartPerbulan').remove();
				$('.chartPerbulan').append('<canvas id="chartPerbulan"><canvas>');


				const labels = result.arrlabels;
				const data = {
					labels: labels,
					datasets: [{
							label: 'Pengeluaran Modal',
							backgroundColor: 'rgb(255, 99, 132)',
							borderColor: 'rgb(255, 99, 132)',
							data: result.arrValue1,
						},
						{
							label: 'Pendapatan Kotor',
							backgroundColor: 'rgb(205, 209, 228)',
							borderColor: 'rgb(205, 209, 228)',
							data: result.arrValue2,
						},
						{
							label: 'Pendapatan Bersih',
							backgroundColor: 'rgb(44, 62, 80)',
							borderColor: 'rgb(44, 62, 80)',
							data: result.arrValue3,
						},
						{
							label: 'Total Diskon',
							backgroundColor: 'rgb(255, 255, 159, 1)',
							borderColor: 'rgb(255, 255, 159, 1)',
							data: result.arrValue4,
						}
					]
				};
				const config = {
					type: 'bar',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Statistik Pendapatan'
							}
						},
						scales: {
							yAxes: [{
								ticks: {
									callback: function(label, index, labels) {
										return numberWithCommas(label);
									}
								},
								scaleLabel: {
									display: true,
									labelString: 'Tahun <?php echo (date("Y")) ?>'
								}
							}]
						}
					},
				};
				var chartPerbulan = new Chart(document.getElementById('chartPerbulan'), config);
				chartPerbulan.update();

			},
			error: function() {
				alert('Telah terjadi kesalahan . . .');
			}
		});
	}

	function getStatistikTahun() {

		$.ajax({
			url: "<?php echo (site_url('Dashboard/getStatistikTahun')) ?>",
			method: "POST",
			dataType: "JSON",
			success: function(result) {
				// console.log(result);

				$('#chartPertahun').remove();
				$('.chartPertahun').append('<canvas id="chartPertahun"><canvas>');

				const labels = result.arrlabels;
				const data = {
					labels: labels,
					datasets: [{
							label: 'Pengeluaran Modal',
							backgroundColor: 'rgb(255, 99, 132)',
							borderColor: 'rgb(255, 99, 132)',
							data: result.arrValue1,
						},
						{
							label: 'Pendapatan Kotor',
							backgroundColor: 'rgb(205, 209, 228)',
							borderColor: 'rgb(205, 209, 228)',
							data: result.arrValue2,
						},
						{
							label: 'Pendapatan Bersih',
							backgroundColor: 'rgb(44, 62, 80)',
							borderColor: 'rgb(44, 62, 80)',
							data: result.arrValue3,
						},
						{
							label: 'Total Diskon',
							backgroundColor: 'rgb(255, 255, 159, 1)',
							borderColor: 'rgb(255, 255, 159, 1)',
							data: result.arrValue4,
						}
					]
				};

				const config = {
					type: 'bar',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Statistik Pendapatan Pertahun'
							}
						},
						scales: {
							yAxes: [{
								ticks: {
									callback: function(label, index, labels) {
										return numberWithCommas(label);
									}
								},
								scaleLabel: {
									display: true,
									labelString: '1k = 1000'
								}
							}]
						}
					},
				};
				var chartPertahun = new Chart(document.getElementById('chartPertahun'), config);


			},
			error: function() {
				alert('Telah terjadi kesalahan . . .');
			}
		});
	}

	$('#getTopPenjualan_filter').click(function() {
		getTopPenjualan();
	});

	function getTopPenjualan() {
		var getTopPenjualan_tglawal = $('#getTopPenjualan_tglawal').val();
		var getTopPenjualan_tglakhir = $('#getTopPenjualan_tglakhir').val();
		var getTopPenjualan_limit = $('#getTopPenjualan_limit').val();

		$.ajax({
			url: "<?php echo (site_url('Dashboard/getTopPenjualan')) ?>",
			method: "POST",
			data: {
				'tglawal': getTopPenjualan_tglawal,
				'tglakhir': getTopPenjualan_tglakhir,
				'limit': getTopPenjualan_limit
			},
			dataType: "JSON",
			success: function(result) {
				var html = '';
				if (result.length > 0) {
					for (let i = 0; i < result.length; i++) {
						html += '<li class="item">';
						html += '    <div class="product-img">';
						html += '        <img src="' + result[i]['foto'] +
							'" alt="Product Image" class="img-size-50">';
						html += '    </div>';
						html += '    <div class="product-info">';
						html += '        <a href="javascript:void(0)" class="product-title">' + result[i][
							'namakategori'
						] + '';
						html += '            <span class="badge badge-info float-right">' + result[i][
							'totalqty'
						] + ' ' + result[i]['satuan'] + '</span></a>';
						html += '        <span class="product-description">';
						html += '            ' + result[i]['namaproduk'] + ' ';
						html += '            <span class="float-right">Harga : Rp. ' + result[i]['hargajual'] +
							'</span>';
						html += '        </span>';
						html += '    </div>';
						html += '</li>';
					}
				}
				$('#getTopPenjualan_load').html(html);
			},
			error: function() {
				alert('Telah terjadi kesalahan . . .');
			}
		});
	}
</script>


</body>

</html>