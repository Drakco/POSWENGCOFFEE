<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPemesanan_model extends CI_Model {

	public function getLaporan($tglAwal, $tglAkhir, $statuskonfirmasi)
	{
		$filter = '';
		if ($statuskonfirmasi != '') {
			$filter = "AND statuskonfirmasi='$statuskonfirmasi' ";
		}

		$strSQL = "
			SELECT 
			* 
			FROM v_pemesanan
			WHERE
				CAST(tglpemesanan AS DATE) BETWEEN '$tglAwal' AND '$tglAkhir'
				$filter
				ORDER BY tglpemesanan ASC
		";

		return $this->db->query($strSQL);
	}	

}

/* End of file LapPemesanan_model.php */
/* Location: ./application/models/LapPemesanan_model.php */