<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapBarang_model extends CI_Model
{

    public function getLapBarang()
    {
        return $this->db->query("SELECT * FROM v_barang WHERE statusaktif='Aktif' ");
    }

}

/* End of file LapBarang_model.php */
/* Location: ./application/models/LapBarang_model.php */
