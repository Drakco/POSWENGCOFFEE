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

			<form id="form">

				<div class="row">

					<!-- Kasir -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body" style="min-height: 174px;">

								<input type="hidden" id="idpenjualan" name="idpenjualan">

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Tanggal</label>
									<div class="col-sm-8">
										<input type="date" class="form-control form-control-sm" name="tglpenjualan"
											id="tglpenjualan" placeholder="Tanggal" readonly="">
									</div>
								</div>

								<div class="form-group row" style="margin-top: -10px;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Kasir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm" name="idpengguna"
											id="idpengguna" placeholder="Nama Pengguna" readonly="">
									</div>
								</div>

								<div class="form-group row" style="margin-top: -10px; display: none;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Booking</label>
									<div class="col-sm-8">
										<select name="idjadwalboking" id="idjadwalboking"
											class="form-control form-control-sm">
											<option value="">Pelanggan Umum</option>
											<?php
											$queryJadwalBoking = $this->db->query("SELECT * FROM v_jadwalboking WHERE status='Menunggu' ORDER BY namapelanggan ");
											if ($queryJadwalBoking->num_rows() > 0) {
												foreach ($queryJadwalBoking->result() as $rowJadwalBoking) { ?>
													<option value="<?php echo $rowJadwalBoking->idjadwalboking ?>">
														<?php echo $rowJadwalBoking->namapelanggan; ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Pelanggan</label>
									<div class="col-sm-8">
										<select name="idpelanggan" id="idpelanggan"
											class="form-control form-control-sm">
											<option value="">Pelanggan Umum</option>
											<?php
											$queryPelanggan = $this->db->query("SELECT * FROM pelanggan WHERE statusaktif='Aktif' ORDER BY namapelanggan ");
											if ($queryPelanggan->num_rows() > 0) {
												foreach ($queryPelanggan->result() as $rowPelanggan) { ?>
													<option value="<?php echo $rowPelanggan->idpelanggan ?>">
														<?php echo $rowPelanggan->namapelanggan; ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>


							</div>
						</div>
					</div>
					<!-- End Kasir -->

					<!-- Invoice -->
					<div class="col-md-6">
						<div class="card" style="min-height: 174px;">
							<div class="card-body text-right">
								<h5>Invoice :
									<b>IVC-<?php echo ($this->db->query("SELECT f_idpenjualan_create('" . date('Y-m-d') . "') AS kode ")->row()->kode); ?></b>
								</h5>
								<br><br>
								<h2 id="labelTotalHarga">Rp. 0</h2>
							</div>
						</div>
					</div>
					<!-- End Invoice -->

					<!-- Tambah Barang -->
					<div class="col-md-4">
						<div class="card" style="min-height: 174px;">
							<div class="card-body">

								<h5>Penjualan Produk</h5>

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">QR Code</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" class="form-control" id="qrcode" placeholder="QR Code"
												autofocus="">
											<div class="input-group-append">
												<button class="btn btn-info" type="button" data-toggle="modal"
													data-target="#modalProduk">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row" style="margin-top: -10px;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Qty</label>
									<div class="col-sm-8">
										<input type="number" class="form-control form-control-sm" name="qty" id="qty"
											placeholder="Qty" value="1" min="1">
									</div>
								</div>

								<div class="form-group row" style="margin-top: -10px;">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<a href="javascript:void(0)" class="btn btn-info btn-sm" id="tambahkan">
											<i class="fas fa-shopping-cart"></i> Add
										</a>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- End Tambah Barang -->

					<!-- Tambah Barang -->
					<div class="col-md-5" style="display: none;">
						<div class="card" style="min-height: 174px;">
							<div class="card-body">

								<h5>Tarif Service</h5>

								<div class="form-group row" style="margin-bottom:55px;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Tarif Service</label>
									<div class="col-sm-8">
										<div class="input-group">
											<select name="idtarif" id="idtarif" class="form-control select2">
												<option value="">Pilih Tarif Service</option>
												<?php
												$queryTarif = $this->db->query("SELECT * FROM tarif WHERE statusaktif='Aktif' ORDER BY namatarif ");
												if ($queryTarif->num_rows() > 0) {
													foreach ($queryTarif->result() as $rowTarif) { ?>
														<option value="<?php echo $rowTarif->idtarif ?>">
															<?php echo $rowTarif->namatarif; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>


								<div class="form-group row" style="margin-top: -10px;">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<a href="javascript:void(0)" class="btn btn-info btn-sm" id="tambahkanService">
											<i class="fas fa-shopping-cart"></i> Add
										</a>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- End Tambah Barang -->

					<!-- Table Transaksi -->
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">

								<div class="table-responsive">
									<table id="table" class="display" style="width: 100%; font-size: 15px;">
										<thead>
											<tr>
												<th style="text-align: center;">#</th>
												<th style="text-align: center;">QR Code</th>
												<th style="text-align: center;  width: 15%;">Produk</th>
												<th style="text-align: center;">Harga Modal</th>
												<th style="text-align: center;">Harga Rp.</th>
												<th style="text-align: center;">Qty</th>
												<th style="text-align: center;">Satuan</th>
												<th style="text-align: center;">Diskon</th>
												<th style="text-align: center;">Total Harga</th>
												<th style="text-align: center;" style="width: 5%;">Aksi</th>
												<th style="text-align: center;">Qty Hidden</th>
												<th style="text-align: center;">Diskon Hidden</th>
												<th style="text-align: center;">Id Produk Hidden</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th style="text-align: right; font-weight: bold; font-size: 15px;">Grand
												Total : </th>
											<th style="text-align: right; font-weight: bold; font-size: 15px"
												colspan="1"></th>
											<th></th>
											<th></th>
											<th></th>
										</tfoot>
									</table>
								</div>
								<input type="hidden" id="subTotalProduk">

							</div>
						</div>
					</div>
					<!-- end table transaksi -->

					<div class="col-md-5" style="display: none;">
						<div class="card">
							<div class="card-body">

								<div class="table-responsive">
									<table id="tableService" class="display" style="width: 100%; font-size: 12px;">
										<thead>
											<tr>
												<th style="text-align: center;">#</th>
												<th style="text-align: center;">ID. Tarif</th>
												<th style="text-align: center;  width: 15%;">Nama Tarif</th>
												<th style="text-align: center;">Harga</th>
												<th style="text-align: center;" style="width: 5%;">Aksi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<th></th>
											<th></th>
											<th></th>
											<th style="text-align: right; font-weight: bold; font-size: 15px;">Grand
												Total : </th>
											<th style="text-align: right; font-weight: bold; font-size: 15px"
												colspan="1"></th>
										</tfoot>
									</table>
								</div>
								<input type="hidden" id="subTotalService">

							</div>
						</div>
					</div>

					<!-- end table transaksi -->

					<!-- Subtotal -->
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Sub Total</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm" name="subTotal"
											id="subTotal" placeholder="0" readonly="">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Diskon</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm money" name="subDiskon"
											id="subDiskon" placeholder="0">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Granda Total</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm" name="grandTotal"
											id="grandTotal" placeholder="0" readonly="">
									</div>
								</div>

							</div>
						</div>
					</div>

					<!-- Pembayaran Cash -->
					<div class="col-md-3">
						<div class="card" style="min-height: 193px;">
							<div class="card-body">

								<div class="form-group row" style="display: none;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Cash</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm money" name="pembayaran"
											id="pembayaran" placeholder="0">
									</div>
								</div>

								<div class="form-group row" style="display: none;">
									<label for="inputPassword" class="col-sm-4 col-form-label">Change</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm" name="kembalian"
											id="kembalian" placeholder="0" readonly="">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Cara Pembayaran</label>
									<div class="col-sm-8">
										<select name="carapembayaran" id="carapembayaran" class="form-control">
											<option value="Tunai">Tunai</option>
											<option value="Non Tunai">Non Tunai</option>
										</select>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- End Pembayaran Cash -->

					<!-- Keterangan -->
					<div class="col-md-3">
						<div class="card" style="min-height: 193px;">
							<div class="card-body">

								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 col-form-label">Note</label>
									<div class="col-sm-8">
										<textarea type="text" class="form-control form-control-sm" name="keterangan"
											id="keterangan" placeholder="Keterangan" rows="6"></textarea>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- end keterangan -->

					<!-- Tombol Simpan -->
					<div class="col-md-3">
						<div class="card" style="min-height: 193px;">
							<div class="card-body">

								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-paper-plane"></i> Proses Pembayaran
										</button>
										<br>
									</div>

									<div class="col-md-6">
										<a href="<?php echo (base_url('Penjualan')) ?>"
											class="btn btn-warning btn-lg btn-block">
											<i class="fa fa-chevron-circle-left"></i> Refresh
										</a>
									</div>

									<div class="col-md-6">
										<a href="<?php echo (base_url('Penjualan/list/')) ?>"
											class="btn btn-info btn-lg btn-block">
											<i class="fa fa-list-alt"></i> List Data
										</a>
									</div>

								</div>

							</div>
						</div>
					</div>
					<!-- end Tombol Simpan -->

				</div>
				<!-- end row -->


			</form>

		</div>
	</div>


	<?php
	$this->load->view('template/footer');
	?>
	<!-- Modal -->
	<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-box"></i> List Data Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="table-responsive">
						<table class="table table-striped" id="tableProduk" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 5%; text-align: center;">No</th>
									<th style="width: 10%; text-align: center;">ID. Produk</th>
									<th style="text-align: center;">Kategori</th>
									<th style="text-align: center;">Produk</th>
									<th style="text-align: center;">Stok</th>
									<th style="text-align: center;">Satuan</th>
									<th style="text-align: center;">Harga Beli</th>
									<th style="text-align: center;">Harga Jual</th>
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
		$(document).ready(function() {

			$("body").addClass("sidebar-mini sidebar-collapse");
			var tableProduk;
			var tableService;

			tableProduk = $('#tableProduk').DataTable({
				"select": true,
				"processing": true,
				"serverSide": true,
				"order": [],
				"ajax": {
					"url": "<?php echo site_url('Produk/getDataPenjualan') ?>",
					"type": "POST"
				},
				"columnDefs": [{
						"targets": [0],
						"orderable": false,
						"className": 'dt-body-center'
					},
					{
						"targets": [1],
						"className": 'dt-body-center'
					},
					{
						"targets": [5],
						"className": 'dt-body-center'
					},
					{
						"targets": [5],
						"orderable": false,
						"className": 'dt-body-right'
					},
					{
						"targets": [6],
						"orderable": false,
						"className": 'dt-body-right'
					},
					{
						"targets": [-1],
						"orderable": false,
						"className": 'dt-body-center'
					},
				],
			});

			var primaryKey = "<?php echo ($primaryKey); ?>";

			if (primaryKey != "") {

				$.ajax({
					url: "<?php echo (site_url($controller . '/getEditData')); ?>",
					type: "POST",
					dataType: "JSON",
					data: {
						primaryKey: primaryKey
					},
					success: function(result) {

						$("#idpenjualan").val(result.idpenjualan);
						$("#tglpenjualan").val(result.tglpenjualan);
						$("#idpengguna").val(result.namapengguna);

					}
				});

			} else {
				$('#tglpenjualan').val("<?php echo (date('Y-m-d')) ?>")
				$('#idpengguna').val("<?php echo ($this->session->userdata('namapengguna')); ?>")
			}

			$("form").attr('autocomplete', 'off');
			$('.tanggal').mask('00-00-0000', {
				placeholder: "hh-bb-tttt"
			});
			$('.money').mask('000,000,000,000', {
				reverse: true
			});
			// $('.moneyDetail').mask('000,000,000,000', {reverse: true});

			tableService = $('#tableService').DataTable({
				"select": true,
				"processing": true,
				"ordering": false,
				"bPaginate": false,
				"searching": false,
				"bInfo": false,
				"ajax": {
					"url": "<?php echo site_url('Penjualan/datatablesourcedetailservice') ?>",
					"dataType": "json",
					"type": "POST",
					"data": {
						"idpenjualan": '<?php echo ($primaryKey) ?>'
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
					totalService = api
						.column(3)
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);

					// Total Halaman Terkait
					pageTotal = api
						.column(3, {
							page: 'current'
						})
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);

					// Update footer
					$(api.column(3).footer()).html(
						'Rp. ' + numberWithCommas(totalService)
					);

					// $('#labelTotalHarga').html('Rp. '+ numberWithCommas(totalService));
					$('#subTotalService').val(numberWithCommas(totalService));
					subTotalAll();
				},
				"columnDefs": [{
						"targets": [0],
						"orderable": false,
						"className": 'dt-body-center'
					},
					{
						"targets": [1],
						"className": 'dt-body-center'
					},
					{
						"targets": [3],
						"orderable": false,
						"className": 'dt-body-right'
					},
					{
						"targets": [-1],
						"orderable": false,
						"className": 'dt-body-center'
					},
				],

			});




			table = $('#table').DataTable({
				"select": true,
				"processing": true,
				"ordering": false,
				"bPaginate": false,
				"searching": false,
				"bInfo": false,
				"ajax": {
					"url": "<?php echo site_url('penjualan/datatablesourcedetail') ?>",
					"dataType": "json",
					"type": "POST",
					"data": {
						"idpenjualan": '<?php echo ($primaryKey) ?>'
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
						.column(8)
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);


					// Total Halaman Terkait
					pageTotal = api
						.column(8, {
							page: 'current'
						})
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);

					// Update footer
					$(api.column(8).footer()).html(
						'Rp. ' + numberWithCommas(total)
					);

					$('#subTotalProduk').val(numberWithCommas(total));
					subTotalAll();
				},
				"columnDefs": [{
						"targets": [0],
						"className": 'dt-body-center'
					},
					{
						"targets": [1],
						"className": 'dt-body-center'
					},
					{
						"targets": [3],
						"className": 'dt-body-center',
						"visible": false
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
						"className": 'dt-body-center'
					},
					{
						"targets": [7],
						"className": 'dt-body-right'
					},
					{
						"targets": [8],
						"className": 'dt-body-right'
					},
					{
						"targets": [9],
						"className": 'dt-body-center'
					},
					{
						"targets": [10],
						"className": 'dt-body-center',
						"visible": false
					},
					{
						"targets": [11],
						"className": 'dt-body-center',
						"visible": false
					},
					{
						"targets": [12],
						"className": 'dt-body-center',
						"visible": false
					},
				],

			});

			$('#tambahkan').click(function(event) {
				event.preventDefault();
				var qrcode = $('#qrcode').val();
				var qty = untitik($('#qty').val());

				if (qrcode == '') {
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
				var detailQty = table.columns(10).data().toArray();
				// console.log(detailQty);
				for (var i = 0; i < isicolomn.length; i++) {
					for (var j = 0; j < isicolomn[i].length; j++) {
						if (isicolomn[i][j] === qrcode) {

							var qtySebelumUpdate = detailQty[i][j];
							var qtySesudahUpdate = parseInt(qtySebelumUpdate) + parseInt(qty);

							var hargajual = untitik(table.data()[j][4]);
							var totalharga = parseInt(qtySesudahUpdate) * parseInt(hargajual);

							var updateQty = table.cell(j, 10);
							updateQty.data(numberWithCommas(qtySesudahUpdate)).draw();

							var updateTotalHarga = table.cell(j, 8);
							updateTotalHarga.data(numberWithCommas(totalharga)).draw();

							$('#qty_' + j).val(qtySesudahUpdate);
							$('#qrcode').val('');
							$('#qrcode').focus();
							$('#qty').val(1);

							var updateDiskon = table.cell(j, 11);
							updateDiskon.data(numberWithCommas(0)).draw();

							$('#diskon_' + j).val(0);
							grandTotalChange();
							return false;
						}

					}
				}

				$.ajax({
					url: "<?php echo (site_url('Penjualan/getProduk')) ?>",
					type: "POST",
					dataType: "JSON",
					data: {
						'qrcode': qrcode,
						'qty': qty
					},
					success: function(result) {

						nomorrow = table.page.info().recordsTotal + 1;
						var i = nomorrow - 1;
						table.row.add([
							nomorrow,
							result.qrcode,
							result.namaproduk,
							numberWithCommas(result.hargabeli),
							numberWithCommas(result.hargajual),
							'<input type="number" class="detailQty" style="text-align:right; width:100px;" name="qty[]" id="qty_' +
							i + '" value="' + numberWithCommas(result.qty) +
							'" min="1">',
							result.satuan,
							'<input type="text" class="detailDiskon moneyDetail" style="text-align:right; width:150px;" name="diskon[]" id="diskon_' +
							i + '" value="' + numberWithCommas(result.diskon) + '" >',
							numberWithCommas(result.totalharga),
							'<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>',
							result.qty,
							result.diskon,
							result.idproduk
						]).draw(false);

						$('#qrcode').val('');
						$('#qrcode').focus();
						$('#qty').val(1);

						$('.moneyDetail').mask('000,000,000,000', {
							reverse: true
						});
						grandTotalChange();
					},
					error: function() {
						alert("Terjadi kesalahan load getPerlengkapan");
					}
				})
			});

			$('#tambahkanService').click(function(event) {
				event.preventDefault();
				var idtarif = $('#idtarif').val();

				if (idtarif == '') {
					Swal.fire(
						"Informasi",
						"Produk belum dipilih... ",
						"info"
					);
					return false;
				}

				var isicolomn = tableService.columns(1).data().toArray();
				for (var i = 0; i < isicolomn.length; i++) {
					for (var j = 0; j < isicolomn[i].length; j++) {
						if (isicolomn[i][j] === idtarif) {
							Swal.fire(
								"Informasi",
								"Tarif Sudah ada... ",
								"info"
							);
							return false;
						}

					}
				}

				$.ajax({
					url: "<?php echo (site_url('Penjualan/getTarif')) ?>",
					type: "POST",
					dataType: "JSON",
					data: {
						'idtarif': idtarif
					},
					success: function(result) {

						nomorrow = tableService.page.info().recordsTotal + 1;
						var i = nomorrow - 1;
						tableService.row.add([
							nomorrow,
							result.idtarif,
							result.namatarif,
							numberWithCommas(result.tarif),
							'<span class="btn btn-danger btn-sm" id="hapusService"><i class="fa fa-trash"></i></span>'
						]).draw(false);

						$('#idtarif').val('');

						grandTotalChange();
					},
					error: function() {
						alert("Terjadi kesalahan load getPerlengkapan");
					}
				})
			});




			$('#table tbody').on('click', 'span', function() {
				table
					.row($(this).parents('tr'))
					.remove()
					.draw();
			});

			$('#tableService tbody').on('click', 'span', function() {
				tableService
					.row($(this).parents('tr'))
					.remove()
					.draw();
			});


			$('#table tbody').on('change', '.detailQty', function() {
				hitungTotal();
			});

			function hitungTotal() {
				var totalColumn = $('#table tbody tr').length - 1;

				for (var i = 0; i <= totalColumn; i++) {

					var qty = parseInt(untitik($('#qty_' + i).val()));
					var hargajual = untitik(table.data()[i][4]);
					var totalharga = parseInt(qty) * parseInt(hargajual);

					var updateQty = table.cell(i, 10);
					updateQty.data(numberWithCommas(qty)).draw();

					var updateTotalHarga = table.cell(i, 8);
					updateTotalHarga.data(numberWithCommas(totalharga)).draw();
					grandTotalChange();
				}
			}

			$('#table tbody').on('change', '.detailDiskon', function() {
				hitungTotalDiskon();
			});

			function hitungTotalDiskon() {
				var totalColumn = $('#table tbody tr').length - 1;

				for (var i = 0; i <= totalColumn; i++) {

					var diskon = parseInt(untitik($('#diskon_' + i).val()));
					var totalharga = untitik(table.data()[i][8]);
					var totalhargaDiskon = parseInt(totalharga) - parseInt(diskon);

					if (diskon >= totalharga) {
						var updateDiskon = table.cell(i, 11);
						updateDiskon.data(numberWithCommas(0)).draw();

						var updateTotalHarga = table.cell(i, 8);
						updateTotalHarga.data(numberWithCommas(totalharga)).draw();
						grandTotalChange();
						$('#diskon_' + i).val(0);
						Swal.fire(
							"Informasi",
							"Diskon Melibihi Total Harga ... ",
							"info"
						);
						return false;

					} else {
						var updateDiskon = table.cell(i, 11);
						updateDiskon.data(numberWithCommas(diskon)).draw();

						var updateTotalHarga = table.cell(i, 8);
						updateTotalHarga.data(numberWithCommas(totalhargaDiskon)).draw();
						grandTotalChange();
					}


				}
			}

			//----------------------------------------------------------------- > validasi
			$('#form').bootstrapValidator({
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {

					pembayaran: {
						validators: {
							notEmpty: {
								message: "<span style='color:red;'>Pembayaran tidak boleh kosong</span>"
							},
						}
					},

				}
			}).on('success.form.bv', function(e) {
				e.preventDefault();

				// validasi
				var kembalian = untitik($('#kembalian').val());
				if (parseInt(kembalian) < 0) {
					Swal.fire(
						"Informasi",
						"Pembayaran Lebih Kecil dari Kembalian... ",
						"info"
					);
					return false;
				}
				// end Validasi

				var idpenjualan = $('#idpenjualan').val();
				var tglpenjualan = $('#tglpenjualan').val();
				var idjadwalboking = $('#idjadwalboking').val();
				var idpelanggan = $('#idpelanggan').val();

				var keterangan = $('#keterangan').val();
				var diskon = $('#subDiskon').val();
				var grandtotal = $('#grandTotal').val();

				// if ( !table.data().count() ) {
				//   Swal.fire(
				//     "Informasi",
				//     "Detail Produk Tidak Ada... ",
				//     "info"
				//   );
				//   return false;
				// }

				var carapembayaran = $('#carapembayaran').val();

				var isidatatable = table.data().toArray();
				var isidatatableService = tableService.data().toArray();

				var formData = {
					'idpenjualan': idpenjualan,
					'tglpenjualan': tglpenjualan,
					'keterangan': keterangan,
					'diskon': diskon,
					'grandtotal': grandtotal,
					'idjadwalboking': idjadwalboking,
					'idpelanggan': idpelanggan,
					'carapembayaran': carapembayaran,
					'isidatatable': isidatatable,
					'isidatatableService': isidatatableService,
				};


				// console.log(formData);
				// return false;

				$.ajax({
					url: "<?php echo (site_url('Penjualan/simpan')) ?>",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(result) {

						// console.log(result);
						// return false;


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


			});;
			//------------------------------------------------------------------------> END VALIDASI DAN SIMPAN
		});

		$('#tableProduk').on('click', '#pilihProduk', function() {
			var qrcode = $(this).attr('data-qrcode');
			$('#qrcode').val(qrcode);
			$('#modalProduk').modal('hide');
		});

		$('#subDiskon').keyup(function() {
			grandTotalChange();
		});

		$('#pembayaran').keyup(function() {
			grandTotalChange();
		})

		function grandTotalChange() {
			var subDiskon = untitik($('#subDiskon').val());
			var subTotal = untitik($('#subTotal').val());

			// var totalService

			var grandTotal = parseInt(subTotal) - parseInt(subDiskon);
			$('#grandTotal').val(numberWithCommas(grandTotal));
			$('#pembayaran').val(numberWithCommas(grandTotal))
			pembayaran();
		}

		function subTotalAll() {
			var subTotalService = $('#subTotalService').val();
			if (subTotalService == '') {
				subTotalService = 0;
			}

			var subTotalProduk = $('#subTotalProduk').val();
			if (subTotalProduk == '') {
				subTotalProduk = 0;
			}

			var hasil = untitik(subTotalService) + untitik(subTotalProduk);

			$('#labelTotalHarga').html('Rp. ' + numberWithCommas(hasil));
			$('#subTotal').val(numberWithCommas(hasil));
		}

		function pembayaran() {
			var grandTotal = untitik($('#grandTotal').val());

			var pembayaran = $('#pembayaran').val();
			if (pembayaran == '') {
				pembayaran = 0;
			} else {
				var pembayaran = untitik(pembayaran);
			}


			var kembalian = parseInt(pembayaran) - parseInt(grandTotal);
			$('#kembalian').val(numberWithCommas(kembalian));
		}
	</script>

	<style>
		.form-group input {
			font-size: 14px;
		}

		.form-group label {
			font-size: 14px;
		}

		#tableProduk th {
			font-size: 12px;
			color: black;
		}

		#tableProduk td {
			font-size: 13px;
			vertical-align: middle;
		}
	</style>
	</body>


	</html>