<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    var $controller     = 'Dashboard';
    var $loadViewList   = 'dashboard';

    var $menu            = 'Dashboard';


    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Dashboard_model');
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
        $data['menu'] = $this->menu;
        $data['controller'] = $this->controller;
        $this->load->view($this->loadViewList, $data);
    }

    public function boxinfo_getdata()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $pendapatanKotor = $this->db->query("
                                        SELECT f_pendapatan('$bulan', '$tahun', 'Pendapatan Kotor') AS pendapatanKotor
                                    ")->row()->pendapatanKotor;

        $pengeluaranModal = $this->db->query("
                                        SELECT f_pendapatan('$bulan', '$tahun', 'Pengeluaran Modal') AS pengeluaranModal
                                    ")->row()->pengeluaranModal;

        $pendapatanBersih = $this->db->query("
                                        SELECT f_pendapatan('$bulan', '$tahun', 'Pendapatan Bersih') AS pendapatanBersih
                                    ")->row()->pendapatanBersih;

        $pengeluaranDiskon = $this->db->query("
                                        SELECT f_pendapatan('$bulan', '$tahun', 'Pengeluaran Diskon') AS pengeluaranDiskon
                                    ")->row()->pengeluaranDiskon;

        $output = array(
            'pendapatanKotor' => $pendapatanKotor,
            'pengeluaranModal' => $pengeluaranModal,
            'pendapatanBersih' => $pendapatanBersih,
            'pengeluaranDiskon' => $pengeluaranDiskon,
        );

        echo json_encode($output);
    }

    public function getStatistikPertanggal()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $arrlabels = array();
        $arrValue1  = array();
        $arrValue2  = array();
        $arrValue3  = array();
        $arrValue4  = array();

        $queryLastDay = $this->db->query("SELECT DATEDIFF(LAST_DAY('$tahun-$bulan-01'), '$tahun-$bulan-01') + 1 AS lastday ")->row()->lastday;
        $int          = (int) $queryLastDay;
        for ($i = 1; $i <= $int; $i++) {

            $strQuery = "
                            SELECT
                                DAY(tanggal) AS day,
                                SUM(totalharga_modal) AS totalharga_modal,
                                SUM(totalharga_jual) AS totalharga_jual,
                                SUM(totalharga_bersih) AS totalharga_bersih,
                                SUM(totalharga_diskon) AS totalharga_diskon
                            FROM v_penjualan_global
                            WHERE
                                DAY(tanggal)='$i' AND
                                MONTH(tanggal)='$bulan' AND
                                YEAR(tanggal)='$tahun'
                            GROUP BY DAY(tanggal)
                            ORDER BY DAY(tanggal)
            ";
            $query = $this->db->query($strQuery);
            if ($query->num_rows() > 0) {
                $row = $query->row();

                array_push($arrlabels, $row->day);
                array_push($arrValue1, $row->totalharga_modal);
                array_push($arrValue2, $row->totalharga_jual);
                array_push($arrValue3, $row->totalharga_bersih);
                array_push($arrValue4, $row->totalharga_diskon);
            } else {

                array_push($arrlabels, $i);
                array_push($arrValue1, 0);
                array_push($arrValue2, 0);
                array_push($arrValue3, 0);
                array_push($arrValue4, 0);
            }
        }

        $output = array(
            'arrlabels' => $arrlabels,
            'arrValue1' => $arrValue1,
            'arrValue2' => $arrValue2,
            'arrValue3' => $arrValue3,
            'arrValue4' => $arrValue4,
        );

        echo (json_encode($output));
    }

    public function getStatistikBulan()
    {
        $tahun = $this->input->post('tahun');

        $arrlabels = array();

        $arrValue1  = array();
        $arrValue2  = array();
        $arrValue3  = array();
        $arrValue4  = array();

        $strQuery = "
            SELECT
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS januari_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS januari_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS januari_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS januari_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS februari_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS februari_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS februari_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS februari_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS maret_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS maret_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS maret_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS maret_totalharga_diskon,

                IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS april_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS april_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS april_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS april_totalharga_diskon,

                IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS mei_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS mei_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS mei_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS mei_totalharga_diskon,

                IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS juni_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS juni_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS juni_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS juni_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS juli_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS juli_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS juli_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS juli_totalharga_diskon,
                                                        
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS agustus_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS agustus_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS agustus_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS agustus_totalharga_diskon,

                IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS september_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS september_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS september_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS september_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS oktober_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS oktober_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS oktober_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS oktober_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS november_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS november_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS november_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS november_totalharga_diskon,
                            
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN v_penjualan_global.totalharga_modal ELSE 0 END), 0)               AS desember_totalharga_modal,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN v_penjualan_global.totalharga_jual ELSE 0 END), 0)                AS desember_totalharga_jual,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN v_penjualan_global.totalharga_bersih ELSE 0 END), 0)              AS desember_totalharga_bersih,
                IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN v_penjualan_global.totalharga_diskon ELSE 0 END), 0)              AS desember_totalharga_diskon
            FROM v_penjualan_global
            WHERE
            YEAR(tanggal)='$tahun'
        ";

        $result = $this->db->query($strQuery)->row();

        $arrlabels = array(
            strtoupper('januari'),
            strtoupper('februari'),
            strtoupper('maret'),
            strtoupper('april'),
            strtoupper('mei'),
            strtoupper('juni'),
            strtoupper('juli'),
            strtoupper('agustus'),
            strtoupper('september'),
            strtoupper('oktober'),
            strtoupper('november'),
            strtoupper('desember'),
        );

        $arrValue1 = array(
            $result->januari_totalharga_modal,
            $result->februari_totalharga_modal,
            $result->maret_totalharga_modal,
            $result->april_totalharga_modal,
            $result->mei_totalharga_modal,
            $result->juni_totalharga_modal,
            $result->juli_totalharga_modal,
            $result->agustus_totalharga_modal,
            $result->september_totalharga_modal,
            $result->oktober_totalharga_modal,
            $result->november_totalharga_modal,
            $result->desember_totalharga_modal,
        );

        $arrValue2 = array(
            $result->januari_totalharga_jual,
            $result->februari_totalharga_jual,
            $result->maret_totalharga_jual,
            $result->april_totalharga_jual,
            $result->mei_totalharga_jual,
            $result->juni_totalharga_jual,
            $result->juli_totalharga_jual,
            $result->agustus_totalharga_jual,
            $result->september_totalharga_jual,
            $result->oktober_totalharga_jual,
            $result->november_totalharga_jual,
            $result->desember_totalharga_jual,
        );

        $arrValue3 = array(
            $result->januari_totalharga_bersih,
            $result->februari_totalharga_bersih,
            $result->maret_totalharga_bersih,
            $result->april_totalharga_bersih,
            $result->mei_totalharga_bersih,
            $result->juni_totalharga_bersih,
            $result->juli_totalharga_bersih,
            $result->agustus_totalharga_bersih,
            $result->september_totalharga_bersih,
            $result->oktober_totalharga_bersih,
            $result->november_totalharga_bersih,
            $result->desember_totalharga_bersih,
        );

        $arrValue4 = array(
            $result->januari_totalharga_diskon,
            $result->februari_totalharga_diskon,
            $result->maret_totalharga_diskon,
            $result->april_totalharga_diskon,
            $result->mei_totalharga_diskon,
            $result->juni_totalharga_diskon,
            $result->juli_totalharga_diskon,
            $result->agustus_totalharga_diskon,
            $result->september_totalharga_diskon,
            $result->oktober_totalharga_diskon,
            $result->november_totalharga_diskon,
            $result->desember_totalharga_diskon,
        );

        $output = array(
            'arrlabels'  => $arrlabels,
            'arrValue1'  => $arrValue1,
            'arrValue2'  => $arrValue2,
            'arrValue3'  => $arrValue3,
            'arrValue4'  => $arrValue4,
        );

        echo (json_encode($output));
    }

    public function getStatistikTahun()
    {

        $arrlabels = array();
        $arrValue1  = array();
        $arrValue2  = array();
        $arrValue3  = array();
        $arrValue4  = array();

        $strQuery = "
            SELECT
                YEAR(tanggal) AS tahun,
                SUM(totalharga_modal) AS totalharga_modal,
                SUM(totalharga_jual) AS totalharga_jual,
                SUM(totalharga_bersih) AS totalharga_bersih,
                SUM(totalharga_diskon) AS totalharga_diskon
                FROM v_penjualan_global
            GROUP BY YEAR(tanggal)
            ORDER BY YEAR(tanggal)
        ";

        $result = $this->db->query($strQuery);
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                array_push($arrlabels, $row->tahun);
                array_push($arrValue1, $row->totalharga_modal);
                array_push($arrValue2, $row->totalharga_jual);
                array_push($arrValue3, $row->totalharga_bersih);
                array_push($arrValue4, $row->totalharga_diskon);
            }
        }

        $output = array(
            'arrlabels'  => $arrlabels,
            'arrValue1'  => $arrValue1,
            'arrValue2'  => $arrValue2,
            'arrValue3'  => $arrValue3,
            'arrValue4'  => $arrValue4,
        );

        echo (json_encode($output));
    }

    public function getTopPenjualan()
    {
        $tglawal = date('Y-m-d', strtotime($this->input->post('tglawal')));
        $tglakhir = date('Y-m-d', strtotime($this->input->post('tglakhir')));
        $limit = $this->input->post('limit');

        $data = array();
        $strSQL = "
            SELECT 
            * 
            FROM(
                SELECT 
                    idproduk,
                    namaproduk,
                    idkategori,
                    namakategori,
                    satuan,
                    hargajual,
                    foto,
                    IFNULL(SUM(qty), 0) AS totalqty 
                FROM v_penjualandetil_global
                WHERE CAST(tanggal AS DATE) BETWEEN '$tglawal' AND '$tglakhir'
                GROUP BY
                    idproduk,
                    namaproduk,
                    idkategori,
                    namakategori,
                    satuan,
                    hargajual,
                    foto
            ) z
            ORDER BY totalqty DESC
            LIMIT $limit
        ";

        $query = $this->db->query($strSQL);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                if (!empty($row->foto)) {
                    $foto = base_url('uploads/' . $row->foto);
                } else {
                    $foto = base_url('images/nofoto.png');
                }

                $dataTemp = array(
                    'idproduk' => $row->idproduk,
                    'namaproduk' => $row->namaproduk,
                    'idkategori' => $row->idkategori,
                    'namakategori' => $row->namakategori,
                    'satuan' => $row->satuan,
                    'hargajual' => number_format($row->hargajual),
                    'foto' => $foto,
                    'totalqty' => number_format($row->totalqty),
                );
                array_push($data, $dataTemp);
            }
        }

        echo json_encode($data);
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
