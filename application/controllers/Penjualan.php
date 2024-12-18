<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

	var $controller     = 'Penjualan';
	var $loadViewList   = 'penjualan/list';
	var $loadViewForm   = 'penjualan/form';

	var $formNameHead   = 'Pesanan';
	var $formNameData   = 'Data Pesanan';
	var $formNameAdd    = 'Form Tambah Data';
	var $formNameEdit   = 'Form Edit Data';

	var $menu           = 'Penjualan';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('Penjualan_model');

		$config['upload_path']          = 'uploads/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = '2000000KB'; // 200KB
		$config['quality']              = '100%';
		$config['remove_space']         = TRUE;

		$this->load->library('upload', $config);
		$this->load->library('image_lib');
	}

	public function isLogin()
	{
		$idpengguna = $this->session->userdata('idpengguna');
		if (empty($idpengguna)) {
			$pesan = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Session telah berakhir. Silahkan login kembali . . . ",
                          "error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect('Login');
			exit();
		}
	}

	public function index()
	{
		$data['primaryKey']     = '';

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = $this->formNameData;
		$data['formName']       = $this->formNameAdd;
		$data['button']         = 'Simpan';
		$this->load->view($this->loadViewForm, $data);
	}

	public function list()
	{
		$data['primaryKey']     = '';

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = $this->formNameData;
		$data['formName']       = $this->formNameAdd;
		$data['button']         = 'Simpan';
		$this->load->view($this->loadViewList, $data);
	}

	public function cetak($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Data tidak ditemukan",
                          "error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['primaryKey']     = $primaryKey;

		$data['dataPerusahaan']         = $this->db->query("SELECT * FROM profil WHERE id=1 ")->row();
		$data['dataPerusahaanKontak']   = $this->db->query("SELECT * FROM profil_kontakkami WHERE id=1 ")->row();

		$data['dataID']         = $this->db->query("SELECT * FROM v_penjualan WHERE idpenjualan='$primaryKey' ")->row();
		$data['dataDetail']     = $this->db->query("SELECT * FROM v_penjualandetil WHERE idpenjualan='$primaryKey' ORDER BY namaproduk ");
		$data['dataDetailService'] = $this->db->query("SELECT * FROM v_penjualandetilservice WHERE idpenjualan='$primaryKey' ORDER BY namatarif ");

		$this->load->view('penjualan/cetak', $data);
	}

	public function bayarnontunai($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['primaryKey']     = $primaryKey;

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = "Pembayaran Non Tunai";
		$data['formName']       = "Pembayaran Non Tunai";
		$data['button']         = 'Update';

		$data['dataId'] = $this->Penjualan_model->getById($primaryKey)->row();
		$this->load->view('penjualan/bayarnontunai', $data);
	}

	public function updateBayarNonTunai()
	{
		$idpenjualan = $this->input->post('idpenjualan');
		if ($this->Penjualan_model->getById($idpenjualan)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$idkasir = $this->session->userdata('idpengguna');
		$data = array(
			'statuspembayaran' => 'Sudah Bayar',
			'idkasir' => $idkasir,
		);

		$this->db->where('idpenjualan', $idpenjualan);
		$simpan = $this->db->update('penjualan', $data);
		if ($simpan) {
			echo json_encode(array(
				'success'       => true,
				'msg'           => 'Data Berhasil Disimpan',
				'idpenjualan'   => $this->encrypt->encode($idpenjualan)
			));
			exit();
		} else {
			$eror = $this->db->error();
			echo json_encode(array(
				'success' => false,
				'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
			));
			exit();
		}
	}

	public function bayartunai($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['primaryKey']     = $primaryKey;

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = "Pembayaran Tunai";
		$data['formName']       = "Pembayaran Tunai";
		$data['button']         = 'Update';

		$data['dataId'] = $this->Penjualan_model->getById($primaryKey)->row();
		$this->load->view('penjualan/bayartunai', $data);
	}

	public function updateBayarTunai()
	{
		$idpenjualan = $this->input->post('idpenjualan');
		if ($this->Penjualan_model->getById($idpenjualan)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$idkasir = $this->session->userdata('idpengguna');
		$data = array(
			'statuspembayaran' => 'Sudah Bayar',
			'idkasir' => $idkasir,
		);

		$this->db->where('idpenjualan', $idpenjualan);
		$simpan = $this->db->update('penjualan', $data);
		if ($simpan) {
			echo json_encode(array(
				'success'       => true,
				'msg'           => 'Data Berhasil Disimpan',
				'idpenjualan'   => $this->encrypt->encode($idpenjualan)
			));
			exit();
		} else {
			$eror = $this->db->error();
			echo json_encode(array(
				'success' => false,
				'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
			));
			exit();
		}
	}

	public function detilpemesanan($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['primaryKey']     = $primaryKey;

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = "Detil Pemesanan";
		$data['formName']       = "Detil Pemesanan";
		$data['button']         = 'Update';

		$data['dataId'] = $this->Penjualan_model->getById($primaryKey)->row();
		$this->load->view('penjualan/detilpemesanan', $data);
	}

	public function updatepemesanan($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$idkoki = $this->session->userdata('idpengguna');
		$data = array(
			'statuspemesanan' => 'Sudah Selesai',
			'idkoki' => $idkoki,
		);

		$this->db->where('idpenjualan', $primaryKey);
		$update = $this->db->update('penjualan', $data);
		if ($update) {
			$pesan = $this->pesan(TRUE, 'Update');
		} else {
			$pesan = $this->pesan(TRUE, 'Gagal');
		}

		$this->session->set_flashdata('pesan', $pesan);
		redirect($this->controller . '/list');
	}

	public function edit($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Data tidak ditemukan",
                          "error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['primaryKey']     = $primaryKey;

		$data['menu']           = $this->menu;
		$data['controller']     = $this->controller;
		$data['formNameHead']   = $this->formNameHead;
		$data['formNameData']   = $this->formNameData;
		$data['formName']       = $this->formNameEdit;
		$data['button']         = 'Update';
		$this->load->view($this->loadViewForm, $data);
	}

	public function hapus($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Penjualan_model->getById($primaryKey)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Data tidak ditemukan",
                          "error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$qrcode = $this->db->query("SELECT qrcode FROM penjualan WHERE idpenjualan='$primaryKey' ")->row()->qrcode;
		$hapus = $this->Penjualan_model->delete($primaryKey);
		if ($hapus) {
			$pesan = $this->pesan(TRUE, 'Hapus');
			unlink('uploads/qrcode_penjualan/' . $qrcode . '.png');
		} else {
			$pesan = $this->pesan(FALSE, 'Gagal');
		}

		$this->session->set_flashdata('pesan', $pesan);
		redirect($this->controller);
	}

	public function simpan()
	{

		$idpenjualan = $this->input->post('idpenjualan');
		$tglpenjualan = date('Y-m-d', strtotime($this->input->post('tglpenjualan'))) . ' ' . date('H:i:s');
		$keterangan = $this->input->post('keterangan');
		$diskon = untitik($this->input->post('diskon'));
		$grandtotal = untitik($this->input->post('grandtotal'));
		$tglinsert = date('Y-m-d H:i:s');
		$tglupdate = date('Y-m-d H:i:s');
		$idpengguna = $this->session->userdata('idpengguna');

		$carapembayaran = $this->input->post('carapembayaran');
		$statuspemesanan = 'Sedang Proses';
		$statuspembayaran = 'Belum Bayar';
		$idkoki = NULL;
		$idkasir = NULL;

		if ($this->input->post('idjadwalboking')) {
			$idjadwalboking = NULL;
		} else {
			$idjadwalboking = $this->input->post('idjadwalboking');
		}

		if ($this->input->post('idpelanggan')) {
			$idpelanggan = $this->input->post('idpelanggan');
		} else {
			$idpelanggan = NULL;
		}

		if ($idjadwalboking != '') {
			$this->db->query("UPDATE jadwalboking SET status='Sudah Selesai' WHERE idjadwalboking='$idjadwalboking' ");
		}

		$isidatatable = $this->input->post('isidatatable');
		$isidatatableService = $this->input->post('isidatatableService');

		if ($idpenjualan == '') {

			$idpenjualan = $this->db->query("SELECT f_idpenjualan_create('" . date('Y-m-d') . "') AS idpenjualan")->row()->idpenjualan;

			// Qrcode
			$qrcode = 'IVC-' . $idpenjualan;
			$this->load->library('ciqrcode');
			$config['cacheable']    = true; //boolean, the default is true
			$config['cachedir']     = 'uploads/qrcode_penjualan/'; //string, the default is application/cache/
			$config['errorlog']     = 'uploads/qrcode_penjualan/'; //string, the default is application/logs/
			$config['imagedir']     = 'uploads/qrcode_penjualan/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);

			$image_name = $qrcode . '.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] = $qrcode; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
			// end qrcode

			$data = array(
				'idpenjualan' => $idpenjualan,
				'tglpenjualan' => $tglpenjualan,
				'keterangan' => $keterangan,
				'diskon' => $diskon,
				'grandtotal' => $grandtotal,
				'tglinsert' => $tglinsert,
				'tglupdate' => $tglupdate,
				'idpengguna' => $idpengguna,
				'qrcode' => $qrcode,
				'idjadwalboking' => $idjadwalboking,
				'idpelanggan' => $idpelanggan,
				'carapembayaran' => $carapembayaran,
				'statuspemesanan' => $statuspemesanan,
				'statuspembayaran' => $statuspembayaran,
				'idkoki' => $idkoki,
				'idkasir' => $idkasir,
			);

			$dataDetail = array();
			if ($isidatatable) {
				foreach ($isidatatable as $item) {
					$idproduk       = $item[12];
					$qty            = untitik($item[10]);
					$hargamodal     = untitik($item[3]);
					$hargajual      = untitik($item[4]);
					$diskon         = untitik($item[11]);
					$totalharga     = untitik($item[8]);

					$dataDetailTemp = array(
						'idpenjualan' => $idpenjualan,
						'idproduk'    => $idproduk,
						'qty'         => untitik($qty),
						'hargamodal'  => untitik($hargamodal),
						'hargajual'   => untitik($hargajual),
						'diskon'      => untitik($diskon),
						'totalharga'  => untitik($totalharga),
					);

					array_push($dataDetail, $dataDetailTemp);
				}
			}

			$dataDetailService = array();
			if ($isidatatableService) {
				foreach ($isidatatableService as $item) {
					$idtarif       = $item[1];
					$harga         = untitik($item[3]);

					$dataDetailServiceTemp = array(
						'idpenjualan' => $idpenjualan,
						'idtarif'     => $idtarif,
						'harga'       => untitik($harga),
					);

					array_push($dataDetailService, $dataDetailServiceTemp);
				}
			}


			$simpan = $this->Penjualan_model->insert($data, $dataDetail, $dataDetailService);
			if ($simpan) {
				echo json_encode(array(
					'success'       => true,
					'msg'           => 'Data Berhasil Disimpan',
					'idpenjualan'   => $this->encrypt->encode($idpenjualan)
				));
				exit();
			} else {
				$eror = $this->db->error();
				echo json_encode(array(
					'success' => false,
					'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
				));
				exit();
			}
		} else {

			$data = array(
				'keterangan' => $keterangan,
				'diskon' => $diskon,
				'grandtotal' => $grandtotal,
				'tglinsert' => $tglinsert,
				'tglupdate' => $tglupdate,
				'idpengguna' => $idpengguna,
				'idjadwalboking' => $idjadwalboking,
				'idpelanggan' => $idpelanggan,
				'carapembayaran' => $carapembayaran,
			);

			$dataDetail = array();
			if ($isidatatable) {
				foreach ($isidatatable as $item) {
					$idproduk       = $item[12];
					$qty            = untitik($item[10]);
					$hargamodal     = untitik($item[3]);
					$hargajual      = untitik($item[4]);
					$diskon         = untitik($item[11]);
					$totalharga     = untitik($item[8]);

					$dataDetailTemp = array(
						'idpenjualan' => $idpenjualan,
						'idproduk'    => $idproduk,
						'qty'         => untitik($qty),
						'hargamodal'  => untitik($hargamodal),
						'hargajual'   => untitik($hargajual),
						'diskon'      => untitik($diskon),
						'totalharga'  => untitik($totalharga),
					);

					array_push($dataDetail, $dataDetailTemp);
				}
			}

			$dataDetailService = array();
			if ($isidatatableService) {
				foreach ($isidatatableService as $item) {
					$idtarif       = $item[1];
					$harga         = untitik($item[3]);

					$dataDetailServiceTemp = array(
						'idpenjualan' => $idpenjualan,
						'idtarif'     => $idtarif,
						'harga'       => untitik($harga),
					);

					array_push($dataDetailService, $dataDetailServiceTemp);
				}
			}

			$simpan = $this->Penjualan_model->update($data, $idpenjualan, $dataDetail, $dataDetailService);
			if ($simpan) {
				echo json_encode(array(
					'success'       => true,
					'msg'           => 'Data Berhasil Diupdate',
					'idpenjualan'   => $this->encrypt->encode($idpenjualan)
				));
				exit();
			} else {
				$eror = $this->db->error();
				echo json_encode(array(
					'success' => false,
					'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
				));
				exit();
			}
		}
	}

	public function pesan($boolean, $pesan)
	{
		if ($boolean) {
			$output = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Berhasil !",
                          "Data Berhasil Di ' . $pesan . ' !",
                          "success"
                        );
                        </script>
                        ';
		} else {
			$eror = $this->db->error();
			$output = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '",
                          "error"
                        );
                        </script>
                        ';
		}
		return $output;
	}

	// UPLOAD FILE
	public function upload_file($file, $nama)
	{
		if (!empty($file[$nama]['tmp_name'])) {
			if ($this->upload->do_upload($nama)) {
				$file = $this->upload->data('file_name');
				$size = $this->upload->data('file_size');
				$ext  = $this->upload->data('file_ext');

				// $this->resize_foto($this->upload->data());

			} else {
				$file = "";
			}
		} else {
			$file = "";
		}
		return $file;
	}

	public function update_upload_file($file, $nama, $file_lama)
	{
		if (!empty($file[$nama]['tmp_name'])) {
			if ($this->upload->do_upload($nama)) {
				$file = $this->upload->data('file_name');
				$size = $this->upload->data('file_size');
				$ext  = $this->upload->data('file_ext');

				// $this->resize_foto($this->upload->data());

			} else {
				$file = $file_lama;
			}
		} else {
			$file = $file_lama;
		}
		return $file;
	}

	public function resize_foto($data)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'uploads/' . $data['file_name'];
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['quality'] = '70';
		$config['width'] = 600;
		$config['height'] = 480;
		$config['new_image'] = 'uploads/' . $data['file_name'];

		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	// END UPLOAD FILE

	// AJAX
	public function getEditData()
	{
		$primaryKey             = $this->input->post('primaryKey');
		$result                 = $this->Penjualan_model->getById($primaryKey)->row();

		$data = array(
			'idpenjualan' => $result->idpenjualan,
			'tglpenjualan' => date('Y-m-d', strtotime($result->tglpenjualan)),
			'keterangan' => $result->keterangan,
			'tglinsert' => $result->tglinsert,
			'tglupdate' => $result->tglupdate,
			'namapengguna' => $result->namapengguna,
		);

		echo (json_encode($data));
	}

	function getData()
	{
		$data       = $this->Penjualan_model->get_datatables();
		$dataArr    = array();
		$no         = $_POST['start'];

		$level = $this->session->userdata('level');


		foreach ($data as $row) {
			$no++;
			$arr = array();

			$arr[] = $no;
			$arr[] = $row->idpenjualan;

			$arr[] = formatHariTanggal(date('Y-m-d', strtotime($row->tglpenjualan))) . '<br>Jam : ' . date('H:i:s', strtotime($row->tglpenjualan));
			$arr[] = $row->keterangan;
			$arr[] = number_format($row->diskon);
			$arr[] = number_format($row->grandtotal);
			$arr[] = $row->namapengguna;

			if ($row->statuspemesanan == 'Sedang Proses') {
				$statuspemesanan = '<span class="badge badge-warning">SEDANG PROSES</span>';
			} else {
				$namakoki = '';
				if (!empty($row->idkoki)) {
					$idkoki = $row->idkoki;
					$namakoki = $this->db->query("SELECT * FROM pengguna WHERE idpengguna='$idkoki' ")->row()->namapengguna;
				}
				$statuspemesanan = '<span class="badge badge-success">SUDAH SELESAI</span><br>' . $namakoki;
			}
			$arr[] = $statuspemesanan;


			if ($row->carapembayaran == 'Tunai') {
				$carapembayaran = '<span class="badge badge-success">TUNAI</span>';
			} else {
				$carapembayaran = '<span class="badge badge-warning">NON TUNAI</span>';
			}
			$arr[] = $carapembayaran;


			if ($row->statuspembayaran == 'Belum Bayar') {
				$statuspembayaran = '<span class="badge badge-danger">BELUM BAYAR</span>';
			} else {
				$namakasir = '';
				if (!empty($row->idkasir)) {
					$idkasir = $row->idkasir;
					$namakasir = $this->db->query("SELECT * FROM pengguna WHERE idpengguna='$idkasir' ")->row()->namapengguna;
				}
				$statuspembayaran = '<span class="badge badge-success">SUDAH BAYAR</span><br>' . $namakasir;
			}
			$arr[] = $statuspembayaran;

			if ($row->qrcode == '') {
				$arr[] = '<img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('images/nofoto.png') . '">';
			} else {
				$arr[] = '<a href="' . base_url('uploads/qrcode_penjualan/' . $row->qrcode . '.png') . '" target="_blank"><img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('uploads/qrcode_penjualan/' . $row->qrcode . '.png') . '"></a>';
			}


			if ($level == 'Pelayan') {
				$arr[]  = '
                        <a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Print Data" target="_blank">
                            <i class="fa fa-print"></i>
                        </a>';
			} elseif ($level == 'Koki') {
				$arr[]  = '
							<a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Print Data" target="_blank">
								<i class="fa fa-print"></i>
							</a>
							<a href="' . site_url($this->controller . '/detilpemesanan/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-warning btn-circle">
								<i class="fas fa-tasks"></i>
							</a>';
			} elseif ($level == 'Kasir') {

				if ($row->statuspembayaran == 'Belum Bayar') {
					$arr[]  = '
								<a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Print Data" target="_blank">
									<i class="fa fa-print"></i>
								</a>
								<a href="' . site_url($this->controller . '/bayartunai/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-success btn-circle">
									<i class="fas fa-dollar-sign"></i> TUNAI
								</a>
								<a href="' . site_url($this->controller . '/bayarnontunai/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-dark btn-circle mt-1">
									<i class="fas fa-dollar-sign"></i> NON TUNAI
								</a>
								';
				} else {
					$arr[]  = '
								<a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Print Data" target="_blank">
									<i class="fa fa-print"></i>
								</a>
								';
				}
			} else {
				$arr[]  = '
							<a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Print Data" target="_blank">
								<i class="fa fa-print"></i>
							</a>
							<a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
								<i class="fa fa-trash"></i>
							</a>';
			}


			array_push($dataArr, $arr);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Penjualan_model->count_all(),
			"recordsFiltered" => $this->Penjualan_model->count_filtered(),
			"data" => $dataArr,
		);

		echo json_encode($output);
	}

	public function getProduk()
	{
		$qrcode     = $this->input->post('qrcode');
		$qty        = untitik($this->input->post('qty'));

		$query = $this->db->query("SELECT * FROM produk WHERE qrcode='$qrcode' ");
		if ($query->num_rows() > 0) {
			$row = $query->row();

			$totalharga = $qty * $row->hargajual;

			$data = array(
				'qrcode'            => $row->qrcode,
				'namaproduk'        => $row->namaproduk,
				'hargabeli'         => $row->hargabeli,
				'hargajual'         => $row->hargajual,
				'qty'               => $qty,
				'satuan'            => $row->satuan,
				'diskon'            => 0,
				'totalharga'        => $totalharga,
				'idproduk'          => $row->idproduk,
			);
		} else {
			$data = array();
		}

		echo (json_encode($data));
	}

	public function getTarif()
	{
		$idtarif     = $this->input->post('idtarif');

		$query = $this->db->query("SELECT * FROM tarif WHERE idtarif='$idtarif' ");
		if ($query->num_rows() > 0) {
			$row = $query->row();

			$data = array(
				'idtarif' => $row->idtarif,
				'namatarif' => $row->namatarif,
				'tarif' => $row->tarif,
				'keterangan' => $row->keterangan,
				'statusaktif' => $row->statusaktif,
			);
		} else {
			$data = array();
		}

		echo (json_encode($data));
	}

	public function datatablesourcedetail()
	{
		$idpenjualan = $this->input->post('idpenjualan');
		$data        = array();

		$no    = 1;
		$i     = 0;
		$query = $this->db->query("SELECT * FROM v_penjualandetil WHERE idpenjualan='$idpenjualan' ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$dataTemp = array(
					$no++,
					$row->qrcode,
					$row->namaproduk,
					number_format($row->hargamodal),
					number_format($row->hargajual),
					'<input type="number" class="detailQty" style="text-align:right; width:100px;" name="qty[]" id="qty_' . $i . '" value="' . number_format($row->qty) . '" min="1">',
					$row->satuan,
					'<input type="text" class="detailDiskon moneyDetail" style="text-align:right; width:150px;" name="diskon[]" id="diskon_' . $i . '" value="' . number_format($row->diskon) . '" >',
					number_format($row->totalharga),
					'<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>',
					number_format($row->qty),
					number_format($row->diskon),
					$row->idproduk,
				);
				array_push($data, $dataTemp);

				$i++;
			}
		}

		$output = array(
			'data' => $data,
		);

		echo (json_encode($output));
	}

	public function datatablesourcedetailservice()
	{
		$idpenjualan = $this->input->post('idpenjualan');
		$data        = array();

		$no    = 1;
		$i     = 0;
		$query = $this->db->query("SELECT * FROM v_penjualandetilservice WHERE idpenjualan='$idpenjualan' ORDER BY namatarif ");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$dataTemp = array(
					$no++,
					$row->idtarif,
					$row->namatarif,
					number_format($row->harga),
					'<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>',
				);
				array_push($data, $dataTemp);

				$i++;
			}
		}

		$output = array(
			'data' => $data,
		);

		echo (json_encode($output));
	}
	// END AJAX


}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
