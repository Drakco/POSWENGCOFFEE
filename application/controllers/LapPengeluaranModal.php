<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPengeluaranModal extends CI_Controller {

	public $controller   = 'LapPengeluaranModal';
    public $loadViewList = 'lappengeluaranmodal/list';
    public $loadViewForm = 'lappengeluaranmodal/form';

    public $formNameHead = 'Laporan Pengeluaran Modal';
    public $formNameData = 'Data Lapoan Pengeluaran Modal';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapPengeluaranModal';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapPengeluaranModal_model');
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
        $this->load->view('lappengeluaranmodal/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $tglAwal  = $this->uri->segment(3);
        $tglAkhir = $this->uri->segment(4);

        $dataFilter = array();
        array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
        array_push($dataFilter, '- '.formatHariTanggal($tglAkhir));
        
        $status   = $this->uri->segment(5);
        if ($status == '-') {
        	$status = '';
        }else{
        	array_push($dataFilter, '<br>Status '.$status);
        }

        $idkategori = $this->uri->segment(6);
        if ($idkategori == '-') {
        	$idkategori = '';
        }else{
        	$namakategori = $this->db->query("SELECT namakategori FROM kategori WHERE idkategori='$idkategori' ")->row()->namakategori;
        	array_push($dataFilter, 'Kategori '.$namakategori);
        }

        $idproduk = $this->uri->segment(7);
        if ($idproduk == '-') {
        	$idproduk = '';
        }else{
        	$namaproduk = $this->db->query("SELECT namaproduk FROM produk WHERE idproduk='$idproduk' ")->row()->namaproduk;
        	array_push($dataFilter, 'Produk '.$namaproduk);
        }

        $data['data']       = $this->LapPengeluaranModal_model->getLaporan($tglAwal, $tglAkhir, $status, $idkategori, $idproduk);
        $data['dataFilter'] = $dataFilter;

        $data['dataPerusahaan'] 		= $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']	= $this->db->query("
        													SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;
        													")->row()->alamatlengkap;
        $this->load->view('lappengeluaranmodal/cetakpdf', $data);
    }

}

/* End of file LapPengeluaranModal.php */
/* Location: ./application/controllers/LapPengeluaranModal.php */