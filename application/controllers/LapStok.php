<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapStok extends CI_Controller {

	public $controller   = 'LapStok';
    public $loadViewList = 'lapstok/list';
    public $loadViewForm = 'lapstok/form';

    public $formNameHead = 'Laporan Stok';
    public $formNameData = 'Data Laporan Stok';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapStok';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapStok_model');
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
        $this->load->view('lapstok/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $idkategori = $this->uri->segment(3);
        if ($idkategori == '-') {
        	$idkategori = '';
        	$namakategori = "Semua Kategori";
        }else{
        	$namakategori = $this->db->query("SELECT * FROM kategori WHERE idkategori='$idkategori' ")->row()->namakategori;
        }

        $data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;

        $data['namakategori'] = $namakategori;
        $data['data'] = $this->LapStok_model->getLap($idkategori);
        $this->load->view('lapstok/cetakpdf', $data);
    }

}

/* End of file LapStok.php */
/* Location: ./application/controllers/LapStok.php */