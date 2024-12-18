<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

	public $controller   = 'Pembelian';
	public $loadViewList = 'pembelian/list';
	public $loadViewForm = 'pembelian/form';

	public $formNameHead = 'Produk Masuk';
	public $formNameData = 'Data Produk Masuk';
	public $formNameAdd  = 'Form Tambah Data';
	public $formNameEdit = 'Form Edit Data';

	public $menu = 'Pembelian';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('Pembelian_model');

		$config['upload_path']   = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = '2000000KB'; // 200KB
		$config['quality']       = '100%';
		$config['remove_space']  = true;

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
		$data['menu']       = $this->menu;
		$data['controller'] = $this->controller;
		$data['formNameHead'] = $this->formNameHead;
		$data['formNameData'] = $this->formNameData;


		$this->load->view($this->loadViewList, $data);
	}

	public function tambah()
	{
		$data['primaryKey'] = '';

		$data['menu']       = $this->menu;
		$data['controller'] = $this->controller;
		$data['formNameHead'] = $this->formNameHead;
		$data['formNameData'] = $this->formNameData;

		$data['formName'] = $this->formNameAdd;
		$data['button']   = 'Simpan';
		$this->load->view($this->loadViewForm, $data);
	}

	public function edit($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Pembelian_model->getById($primaryKey)->num_rows() == 0) {
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

		$data['primaryKey'] = $primaryKey;

		$data['menu']       = $this->menu;
		$data['controller'] = $this->controller;
		$data['formNameHead'] = $this->formNameHead;
		$data['formNameData'] = $this->formNameData;


		$data['formName'] = $this->formNameEdit;
		$data['button']   = 'Update';
		$this->load->view($this->loadViewForm, $data);
	}

	public function detil($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Pembelian_model->getById($primaryKey)->num_rows() == 0) {
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

		$data['primaryKey'] = $primaryKey;

		$data['menu']       = $this->menu;
		$data['controller'] = $this->controller;
		$data['formNameHead'] = $this->formNameHead;
		$data['formNameData'] = $this->formNameData;
		$data['formName'] = "Detil Produk Masuk";

		$data['button']   = 'Detil';

		$data['dataId'] = $this->Pembelian_model->getById($primaryKey)->row();
		$this->load->view('pembelian/detil', $data);
	}

	public function hapus($primaryKey)
	{
		$primaryKey = $this->encrypt->decode($primaryKey);
		if ($this->Pembelian_model->getById($primaryKey)->num_rows() == 0) {
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

		$hapus = $this->Pembelian_model->delete($primaryKey);
		if ($hapus) {
			$pesan = $this->pesan(true, 'Hapus');
		} else {
			$pesan = $this->pesan(false, 'Gagal');
		}

		$this->session->set_flashdata('pesan', $pesan);
		redirect($this->controller);
	}

	public function simpanUpload()
	{
		$idpembelian = $this->input->post('idpembelian');

		$file_lama = $this->input->post('file_lama');
		$foto      = $this->update_upload_file($_FILES, "file", $file_lama);

		$simpan = $this->db->query("UPDATE pembelian SET foto='$foto' WHERE idpembelian='$idpembelian' ");
		if ($simpan) {
			$pesan = $this->pesan(true, 'Simpan');
		} else {
			$pesan = $this->pesan(true, 'Gagal');
		}

		$this->session->set_flashdata('pesan', $pesan);
		redirect($this->controller);
	}

	public function simpan()
	{

		$idpembelian  = $this->input->post('idpembelian');
		$tglpembelian = date('Y-m-d', strtotime($this->input->post('tglpembelian')));
		$nostruk        = $this->input->post('nostruk');
		$keterangan     = $this->input->post('keterangan');
		$idsupplier     = $this->input->post('idsupplier');

		$idpengguna     = $this->session->userdata('idpengguna');
		$tglinsert      = date('Y-m-d H:i:s');
		$tglupdate      = date('Y-m-d H:i:s');

		$isidatatable = $this->input->post('isidatatable');

		if ($idpembelian == '') {

			$idpembelian = $this->db->query("SELECT f_idpembelian_create('" . date('Y-m-d') . "') AS idpembelian")->row()->idpembelian;

			$data = array(
				'idpembelian'     => $idpembelian,
				'tglpembelian'    => $tglpembelian,
				'nostruk'          => $nostruk,
				'keterangan'       => $keterangan,
				'idsupplier'       => $idsupplier,
				'idpengguna'       => $idpengguna,
				'tglinsert'        => $tglinsert,
				'tglupdate'        => $tglupdate,
			);

			$dataDetail = array();
			foreach ($isidatatable as $item) {
				$idproduk              = $item[1];
				$qty                   = $item[5];
				$harga                 = $item[4];
				$totalharga            = $item[6];

				$dataDetailTemp = array(
					'idpembelian'         => $idpembelian,
					'idproduk'              => $idproduk,
					'qty'                   => untitik($qty),
					'harga'                 => untitik($harga),
					'totalharga'            => untitik($totalharga),
				);

				array_push($dataDetail, $dataDetailTemp);
			}

			$simpan = $this->Pembelian_model->insert($data, $dataDetail);
			if ($simpan) {
				echo json_encode(array(
					'success' => true,
					'msg'     => 'Data Berhasil Disimpan',
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
				'tglpembelian' => $tglpembelian,
				'nostruk'        => $nostruk,
				'keterangan'     => $keterangan,
				'idsupplier'     => $idsupplier,
				'idpengguna'     => $idpengguna,
				'tglupdate'      => $tglupdate,
			);

			$dataDetail = array();
			foreach ($isidatatable as $item) {
				$idproduk              = $item[1];
				$qty                   = $item[5];
				$harga             = $item[4];
				$totalharga            = $item[6];

				$dataDetailTemp = array(
					'idpembelian'         => $idpembelian,
					'idproduk'              => $idproduk,
					'qty'                   => untitik($qty),
					'harga'             => untitik($harga),
					'totalharga'            => untitik($totalharga),
				);

				array_push($dataDetail, $dataDetailTemp);
			}

			$simpan = $this->Pembelian_model->update($data, $idpembelian, $dataDetail);
			if ($simpan) {
				echo json_encode(array(
					'success' => true,
					'msg'     => 'Data Berhasil Disimpan',
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
			$eror   = $this->db->error();
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
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'uploads/' . $data['file_name'];
		$config['create_thumb']   = false;
		$config['maintain_ratio'] = false;
		$config['quality']        = '70';
		$config['width']          = 600;
		$config['height']         = 480;
		$config['new_image']      = 'uploads/' . $data['file_name'];

		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	// END UPLOAD FILE

	// AJAX
	public function getEditData()
	{
		$primaryKey = $this->input->post('primaryKey');
		$result     = $this->Pembelian_model->getById($primaryKey)->row();

		$data = array(
			'idpembelian'    => $result->idpembelian,
			'tglpembelian'   => $result->tglpembelian,
			'nostruk'          => $result->nostruk,
			'keterangan'       => $result->keterangan,
			'idsupplier'       => $result->idsupplier,
			'namasupplier'     => $result->namasupplier,
			'totalharga'       => $result->totalharga,
			'idpengguna'       => $result->idpengguna,
			'namapengguna'     => $result->namapengguna,
			'tglinsert'        => $result->tglinsert,
			'tglupdate'        => $result->tglupdate,
		);

		echo (json_encode($data));
	}

	public function getData()
	{
		$data    = $this->Pembelian_model->get_datatables();
		$dataArr = array();
		$no      = $_POST['start'];

		$level = $this->session->userdata('level');

		foreach ($data as $row) {
			$no++;
			$arr = array();

			$arr[] = $no;

			$arr[] = '<b>' . $row->idpembelian . '</b>';

			$arr[] = formatHariTanggal($row->tglpembelian);
			$arr[] = '<small>' . $row->keterangan . '</samll>';

			$arr[] = $row->nostruk;

			if (!empty($row->foto)) {
				$arr[] = '
                    <a href="' . base_url('uploads/' . $row->foto) . '" class="btn btn-success btn-block btn-xs" target="_blank" style="font-size: 11px !important;">
                        <i class="fa fa-check"></i> Sudah Upload
                    </a>
                ';
			} else {
				$arr[] = '
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" id="uploadStruk"
                    data-idpembelian="' . $row->idpembelian . '"
                    data-foto="' . $row->foto . '" style="font-size: 11px !important;">
                      <i class="fa fa-upload"></i> Belum Upload
                    </button>
                ';
			}

			$arr[] = $row->namasupplier;
			$arr[] = number_format($row->totalharga);

			if (!empty($row->idpengadaan)) {
				$idpengadaan = '<small>
					<a href="' . base_url('Pengadaan/detil/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-info btn-sm btn-block" style="font-size: 10px !important; text-align: left !important;" target="_blank">
						ID. ' . $row->idpengadaan . ' <br>
						Tgl. ' . formatHariTanggal(date('d/m/Y', strtotime($row->tglpengadaan))) . '
					</a>
				</small>';
			} else {
				$idpengadaan = 'PEMBELIAN LANGSUNG';
			}

			$arr[] = $idpengadaan;

			if ($level != 'Gudang') {
				$arr[] = '
                            <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpembelian)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idpembelian)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idpembelian)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                                <i class="fa fa-trash"></i>
                            </a>';
			} else {
				$arr[] = '
                            <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpembelian)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                <i class="fa fa-eye"></i>
                            </a>';
			}

			array_push($dataArr, $arr);
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->Pembelian_model->count_all(),
			"recordsFiltered" => $this->Pembelian_model->count_filtered(),
			"data"            => $dataArr,
		);

		echo json_encode($output);
	}

	public function datatablesourcedetail()
	{
		$idpembelian = $this->input->post('idpembelian');
		$data          = array();

		$query = $this->db->query("SELECT * FROM v_pembelian_detil WHERE idpembelian='$idpembelian' ");
		$no    = 1;
		$i     = 0;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {

				$dataTemp = array(
					$no++,
					$row->idproduk,
					'<b>' . $row->namaproduk . '</b><br> Satuan : ' . $row->satuan,
					$row->namakategori,
					number_format($row->harga),
					number_format($row->qty),
					number_format($row->totalharga),
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

	public function getProduk()
	{
		$idproduk = $this->input->post('idproduk');
		$qty      = untitik($this->input->post('qty'));

		$query = $this->db->query("SELECT * FROM v_produk WHERE idproduk='$idproduk' ");
		if ($query->num_rows() > 0) {
			$row = $query->row();

			$totalharga = $qty * $row->hargabeli;

			$data = array(
				'idproduk'              => $row->idproduk,
				'namaproduk'            => '<b>' . $row->namaproduk . '</b><br> Satuan : ' . $row->satuan,
				'namakategori'          => $row->namakategori,
				'hargabeli'             => $row->hargabeli,
				'qty'                   => $qty,
				'totalharga'            => $totalharga
			);
		} else {
			$data = array();
		}

		echo (json_encode($data));
	}
	// END AJAX

}

/* End of file Pembelian.php */
