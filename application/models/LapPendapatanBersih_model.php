<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapPendapatanBersih_model extends CI_Model {

	public function getLaporan($tglAwal, $tglAkhir, $status, $idkategori, $idproduk)
	{
		$filter = '';
		if ($status != '') {
			$filter .= 'AND status="'.$status.'" ';
		}

		if ($idkategori != '') {
			$filter .= 'AND idkategori="'.$idkategori.'" ';
		}

		if ($idproduk != '') {
			$filter .= 'AND idproduk="'.$idproduk.'" ';
		}


		$strSQL = "
			SELECT
				`v_penjualandetil_global`.`id`      AS `id`,
				`v_penjualandetil_global`.`status`  AS `status`,
				`v_penjualandetil_global`.`tanggal` AS `tanggal`,
				SUM(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargamodal`) AS `totalharga_modal`,
				SUM(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargajual`) AS `totalharga_jual`,
				(SUM(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargajual`) - SUM(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargamodal`))
				AS totalharga_bersih,
				SUM(`v_penjualandetil_global`.`diskon`) AS `totalharga_diskon`,
				SUM(`v_penjualandetil_global`.`totalharga`) AS `totalharga`
			FROM `v_penjualandetil_global`
			WHERE 
				DATE_FORMAT(`v_penjualandetil_global`.`tanggal`, '%Y-%m-%d') BETWEEN '$tglAwal' AND '$tglAkhir'
				$filter
			GROUP BY `v_penjualandetil_global`.`id`,`v_penjualandetil_global`.`status`, `v_penjualandetil_global`.`tanggal`
			ORDER BY `v_penjualandetil_global`.`tanggal`
		";
		return $this->db->query($strSQL);
	}

	public function getLaporanDetil($id)
	{
		$strSQL = "
			SELECT * FROM v_penjualandetil_global WHERE id='$id' ORDER BY tanggal ASC
		";

		return $this->db->query($strSQL);
	}	

}

/* End of file LapPendapatanBersih_model.php */
/* Location: ./application/models/LapPendapatanBersih_model.php */