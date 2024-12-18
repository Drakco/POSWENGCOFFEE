<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarangMasuk extends CI_Controller
{

	public $controller   = 'LapBarangMasuk';
	public $loadViewList = 'lapbarangmasuk/list';
	public $loadViewForm = 'lapbarangmasuk/form';

	public $formNameHead = 'Laporan Barang Masuk';
	public $formNameData = 'Data Laporan Barang Masuk';
	public $formNameAdd  = 'Form Tambah Data';
	public $formNameEdit = 'Form Edit Data';

	public $menu = 'LapBarangMasuk';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('LapBarangMasuk_model');
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
		$this->load->view('lapbarangmasuk/form', $data);
	}

	public function cetak()
	{
		error_reporting(0);
		$this->load->library('Pdf');

		$tglawal  = $this->uri->segment(3);
		$tglakhir = $this->uri->segment(4);
		$idbidang = $this->uri->segment(5);

		$data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
		$data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;

		$dataFilter = array();

		array_push($dataFilter, 'Tgl. Awal : ' . formatHariTanggal($tglawal));
		array_push($dataFilter, 'Tgl. Akhir : ' . formatHariTanggal($tglakhir));

		$data['data']       = $this->LapBarangMasuk_model->getLapBarangMasuk($tglawal, $tglakhir);
		$data['dataFilter'] = $dataFilter;

		$this->load->view('lapbarangmasuk/cetakpdf', $data);
	}
}

/* End of file LapBarangMasuk.php */
/* Location: ./application/controllers/LapBarangMasuk.php */
