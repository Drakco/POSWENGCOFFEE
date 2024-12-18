<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPembelian_model extends CI_Model {

	public function getLap($tglAwal, $tglAkhir, $idsupplier)
	{
		$filter = '';
		if ($idsupplier != '') {
			$idsupplier = "AND idsupplier='$idsupplier' ";
		}

		$strSQL = "
			SELECT 
			* 
			FROM v_pembelian
			WHERE tglpembelian BETWEEN '$tglAwal' AND '$tglAkhir'
			$filter
			ORDER BY tglpembelian  
		";

		return $this->db->query($strSQL);
	}	

}

/* End of file LapPembelian_model.php */
/* Location: ./application/models/LapPembelian_model.php */