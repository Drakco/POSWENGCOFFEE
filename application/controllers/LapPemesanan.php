<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPemesanan extends CI_Controller {

	public $controller   = 'LapPemesanan';
    public $loadViewList = 'lappemesanan/list';
    public $loadViewForm = 'lappemesanan/form';

    public $formNameHead = 'Laporan Pemesanan';
    public $formNameData = 'Data Laporan Pemesanan';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapPemesanan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapPemesanan_model');
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
        $this->load->view('lappemesanan/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $tglAwal  = $this->uri->segment(3);
        $tglAkhir = $this->uri->segment(4);
        
        $statuspemesanan = $this->uri->segment(5);
        if ($statuspemesanan == 1) {
        	$statuspemesanan = 'Dikonfirmasi';
        }elseif ($statuspemesanan == 2) {
        	$statuspemesanan = 'Ditolak';
        }elseif ($statuspemesanan == 0){
        	$statuspemesanan = 'Menunggu';
        }else{
        	$statuspemesanan = '';
        }


        $dataFilter = array();
        array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
        array_push($dataFilter, '- '.formatHariTanggal($tglAkhir));
        
        $data['statuspemesanan'] = $statuspemesanan;
        $data['data']       = $this->LapPemesanan_model->getLaporan($tglAwal, $tglAkhir, $statuspemesanan);
        $data['dataFilter'] = $dataFilter;


        $data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;
        $this->load->view('lappemesanan/cetakpdf', $data);
    }

}

/* End of file LapPemesanan.php */
/* Location: ./application/controllers/LapPemesanan.php */