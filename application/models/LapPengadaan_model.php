<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPengadaan_model extends CI_Model
{

    public function getLap($tglAwal, $tglAkhir, $statuskonfirmasi)
    {
        $filter = '';
        if ($statuskonfirmasi != '') {

            if ($statuskonfirmasi == 'Menunggu') {
                $filter .= "AND (statuskonfirmasi='Menunggu' OR statuskonfirmasi IS NULL)";
            } else {
                $filter .= "AND (statuskonfirmasi='$statuskonfirmasi')";
            }
        } else {
            $filter .= "";
        }

        $strSQL = "
            SELECT 
            * 
            FROM v_pengadaan 
            WHERE tglpengadaan BETWEEN '$tglAwal' AND '$tglAkhir'
            $filter
            ORDER BY tglpengadaan ASC
        ";

        return $this->db->query($strSQL);
    }
}

/* End of file LapPengadaan_model.php */
