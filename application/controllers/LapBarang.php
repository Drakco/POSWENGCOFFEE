<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarang extends CI_Controller
{

	public $controller   = 'LapBarang';
	public $loadViewList = 'lapbarang/list';
	public $loadViewForm = 'lapbarang/form';

	public $formNameHead = 'Laporan Stok Barang';
	public $formNameData = 'Data Laporan Stok Barang';
	public $formNameAdd  = 'Form Tambah Data';
	public $formNameEdit = 'Form Edit Data';

	public $menu = 'LapBarang';

	public function __construct()
	{
		parent::__construct();
		$this->isLogin();
		$this->load->model('LapBarang_model');
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
		$this->load->view($this->loadViewList, $data);
	}

	public function cetak()
	{
		error_reporting(0);
		$this->load->library('Pdf');

		$data['data'] = $this->LapBarang_model->getLapBarang();

		$data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
		$data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;

		$this->load->view('lapbarang/cetakpdf', $data);
	}
}

/* End of file lapBarang.php */
/* Location: ./application/controllers/lapBarang.php */
