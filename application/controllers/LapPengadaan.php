<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPengadaan extends CI_Controller
{

    public $controller   = 'LapPengadaan';
    public $loadViewList = 'lappengadaan/list';
    public $loadViewForm = 'lappengadaan/form';

    public $formNameHead = 'Laporan Pengadaan';
    public $formNameData = 'Data Laporan Pengadaan';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapPengadaan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapPengadaan_model');
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
        $this->load->view('lappengadaan/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $tglAwal  = $this->uri->segment(3);
        $tglAkhir = $this->uri->segment(4);
        $statuskonfirmasi = $this->uri->segment(5);

        if ($statuskonfirmasi == '-') {
            $statuskonfirmasi = '';
            $namastatuskonfirmasi = 'Semua Status Konfirmasi';
        } else {
            $namastatuskonfirmasi = $statuskonfirmasi;
        }

        $dataFilter = array();
        array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
        array_push($dataFilter, ' ' . formatHariTanggal($tglAkhir));


        $data['dataPerusahaan']         = $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']    = $this->db->query("SELECT CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap FROM profil_kontakkami WHERE id=1 ")->row()->alamatlengkap;

        $data['namastatuskonfirmasi'] = $namastatuskonfirmasi;
        $data['dataFilter'] = $dataFilter;
        $data['data'] = $this->LapPengadaan_model->getLap($tglAwal, $tglAkhir, $statuskonfirmasi);
        $this->load->view('lappengadaan/cetakpdf', $data);
    }
}

/* End of file LapPengadaan.php */
