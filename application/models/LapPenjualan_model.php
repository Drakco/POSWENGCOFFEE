<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPenjualan_model extends CI_Model {

	public function getLaporan($tglAwal, $tglAkhir)
	{
		$strSQL = "
			SELECT 
			* 
			FROM v_penjualan
			WHERE
				CAST(tglpenjualan AS DATE) BETWEEN '$tglAwal' AND '$tglAkhir'
				ORDER BY tglpenjualan ASC
		";
		return $this->db->query($strSQL);
	}	

}

/* End of file LapPenjualan_model.php */
/* Location: ./application/models/LapPenjualan_model.php */