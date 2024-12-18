<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapReturPenjualan extends CI_Controller
{

    public $controller   = 'LapReturPenjualan';
    public $loadViewList = 'lapreturpenjualan/list';
    public $loadViewForm = 'lapreturpenjualan/form';

    public $formNameHead = 'Laporan Retur Penjualan';
    public $formNameData = 'Data Laporan Retur Penjualan';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'LapReturPenjualan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('LapReturPenjualan_model');
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
        $this->load->view('lapreturpenjualan/form', $data);
    }

    public function cetak()
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $tglAwal  = $this->uri->segment(3);
        $tglAkhir = $this->uri->segment(4);

        $dataFilter = array();
        array_push($dataFilter, 'Periode : ' . formatHariTanggal($tglAwal));
        array_push($dataFilter, '- ' . formatHariTanggal($tglAkhir));

        $data['data']       = $this->LapReturPenjualan_model->getLaporan($tglAwal, $tglAkhir);
        $data['dataFilter'] = $dataFilter;

        $data['dataPerusahaan']         = $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']    = $this->db->query("SELECT CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap FROM profil_kontakkami WHERE id=1;")->row()->alamatlengkap;
        $this->load->view('lapreturpenjualan/cetakpdf', $data);
    }
}

/* End of file LapReturPenjualan.php */
