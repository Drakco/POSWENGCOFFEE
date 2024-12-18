<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarangKeluar extends CI_Controller
{

	public $controller   = 'LapBarangKeluar';
	public $loadViewList = 'lapbarangkeluar/list';
	public $loadViewForm = 'lapbarangkeluar/form';

	public $formNameHead = 'Laporan Barang Keluar';
	public $formNameData = 'Data Laporan Barang Keluar';
	public $formNameAdd  = 'Form Tambah Data';
	public $formNameEdit = 'Form Edit Data';

	public $menu = 'LapBarangKeluar';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('LapBarangKeluar_model');
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
		$this->load->view('lapbarangkeluar/form', $data);
	}

	public function cetak()
	{
		error_reporting(0);
		$this->load->library('Pdf');

		$tglawal  = $this->uri->segment(3);
		$tglakhir = $this->uri->segment(4);
		$idbidang = $this->uri->segment(5);

		$dataFilter = array();

		array_push($dataFilter, 'Tgl. Awal : ' . formatHariTanggal($tglawal));
		array_push($dataFilter, 'Tgl. Akhir : ' . formatHariTanggal($tglakhir));

		$data['data']       = $this->LapBarangKeluar_model->getLapBarangKeluar($tglawal, $tglakhir);
		$data['dataFilter'] = $dataFilter;

		$data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
		$data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;

		$this->load->view('lapbarangkeluar/cetakpdf', $data);
	}
}

/* End of file LapBarangKeluar.php */
/* Location: ./application/controllers/LapBarangKeluar.php */
