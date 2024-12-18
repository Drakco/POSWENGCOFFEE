<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LapPerencanaanBisnis extends CI_Controller
{

    public $controller   = 'LapPerencanaanBisnis';
    public $loadViewList = 'lapperencanaanbisnis/list';
    public $loadViewForm = 'lapperencanaanbisnis/form';

    public $formNameHead = 'Laporan Perencanaan Bisnis';
    public $formNameData = 'Data Laporan Perencanaan Bisnis';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapPerencanaanBisnis';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapPerencanaanBisnis_model');
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
        $this->load->view('lapperencanaanbisnis/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $tglAwal  = $this->uri->segment(3);
        $tglAkhir = $this->uri->segment(4);
        $statusperencanaan = $this->uri->segment(5);

        if ($statusperencanaan == 0) {
            $statusperencanaan = '';
            $namastatusperencanaan = "SEMUA STATUS PERENCANAAN";
        } elseif ($statusperencanaan == 1) {
            $statusperencanaan = 'Sedang Diproses';
            $namastatusperencanaan = "SEDANG DIPROSES";
        } elseif ($statusperencanaan == 2) {
            $statusperencanaan = 'Sudah Diproses';
            $namastatusperencanaan = "SUDAH DIPROSES";
        }

        $dataFilter = array();
        array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
        array_push($dataFilter, ' ' . formatHariTanggal($tglAkhir));


        $data['dataPerusahaan']         = $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']    = $this->db->query("SELECT CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap FROM profil_kontakkami WHERE id=1 ")->row()->alamatlengkap;

        $data['namastatusperencanaan'] = $namastatusperencanaan;
        $data['dataFilter'] = $dataFilter;
        $data['data'] = $this->LapPerencanaanBisnis_model->getLap($tglAwal, $tglAkhir, $statusperencanaan);
        $this->load->view('lapperencanaanbisnis/cetakpdf', $data);
    }
}

/* End of file LapPerencanaanBisnis.php */
