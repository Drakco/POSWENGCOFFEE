<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPembelian extends CI_Controller
{

	public $controller   = 'LaPembelian';
	public $loadViewList = 'lappembelian/list';
	public $loadViewForm = 'lappembelian/form';

	public $formNameHead = 'Laporan Produk Masuk';
	public $formNameData = 'Data Laporan Produk Masuk';
	public $formNameAdd  = 'Form Tambah Data';
	public $formNameEdit = 'Form Edit Data';

	public $menu = 'LapPembelian';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('LapPembelian_model');
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
		$data['menu']         = $this->menu;
		$data['controller']   = $this->controller;
		$data['formNameHead'] = $this->formNameHead;
		$data['formNameData'] = $this->formNameData;
		$this->load->view('lappembelian/form', $data);
	}

	public function cetak()
	{
		error_reporting(0);
		$this->load->library('Pdf');

		$tglAwal  = $this->uri->segment(3);
		$tglAkhir = $this->uri->segment(4);
		$idsupplier = $this->uri->segment(5);

		if ($idsupplier == '-') {
			$idsupplier = '';
			$namasupplier = "Semua Supplier";
		} else {
			$namasupplier = $this->db->query("SELECT * FROM supplier WHERE idsupplier='$idsupplier' ")->row()->namasupplier;
		}

		$dataFilter = array();
		array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
		array_push($dataFilter, ' ' . formatHariTanggal($tglAkhir));


		$data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
		$data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;

		$data['namasupplier'] = $namasupplier;
		$data['dataFilter'] = $dataFilter;
		$data['data'] = $this->LapPembelian_model->getLap($tglAwal, $tglAkhir, $idsupplier);
		$this->load->view('lappembelian/cetakpdf', $data);
	}
}

/* End of file LapPembelian.php */
/* Location: ./application/controllers/LapPembelian.php */
