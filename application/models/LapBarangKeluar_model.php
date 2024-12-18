<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarangKeluar_model extends CI_Model
{

    public function getLapBarangKeluar($tglawal, $tglakhir)
    {
        return $this->db->query("SELECT * FROM v_barangkeluar WHERE tglbarangkeluar BETWEEN '$tglawal' AND '$tglakhir' ORDER BY tglbarangkeluar ASC ");
    }

}

/* End of file LapBarangKeluar_model.php */
/* Location: ./application/models/LapBarangKeluar_model.php */
