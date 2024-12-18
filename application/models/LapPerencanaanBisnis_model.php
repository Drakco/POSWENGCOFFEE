<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPerencanaanBisnis_model extends CI_Model
{

    public function getLap($tglAwal, $tglAkhir, $statusperencanaan)
    {
        $filter = '';
        if ($statusperencanaan != '') {
            $filter .= "AND statusperencanaan='$statusperencanaan' ";
        }

        $strSQL = "
            SELECT 
            *
            FROM v_perencanaan
            WHERE tglperencanaan BETWEEN '$tglAwal' AND '$tglAkhir'
            $filter
            ORDER BY tglperencanaan
        ";
        return $this->db->query($strSQL);
    }
}

/* End of file LapPerencanaanBisnis_model.php */
