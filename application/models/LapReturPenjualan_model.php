<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapReturPenjualan_model extends CI_Model
{

    public function getLaporan($tglAwal, $tglAkhir)
    {
        $strSQL = "
            SELECT 
            * 
            FROM v_returpenjualan
            WHERE CAST(tglreturpenjualan AS DATE) BETWEEN '$tglAwal' AND '$tglAkhir'
            ORDER BY tglreturpenjualan ASC
        ";

        return $this->db->query($strSQL);
    }
}

/* End of file LapReturPenjualan_model.php */
