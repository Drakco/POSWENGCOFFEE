<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapStok_model extends CI_Model {

	public function getLap($idkategori)
	{
		$filter = '';
		if ($idkategori != '') {
			$filter .= "AND idkategori='$idkategori' ";
		}

		$strSQL = "
			SELECT * FROM v_produk WHERE statusaktif='Aktif' $filter ORDER BY namaproduk
		";

		return $this->db->query($strSQL);
	}	

}

/* End of file LapStok_model.php */
/* Location: ./application/models/LapStok_model.php */