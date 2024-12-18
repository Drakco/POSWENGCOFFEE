<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarangMasuk_model extends CI_Model
{

    public function getLapBarangMasuk($tglawal, $tglakhir)
    {
        return $this->db->query("SELECT * FROM v_barangmasuk WHERE tglbarangmasuk BETWEEN '$tglawal' AND '$tglakhir' ");
    }

}

/* End of file LapBarangMasuk_model.php */
/* Location: ./application/models/LapBarangMasuk_model.php */
