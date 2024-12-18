<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

	var $table             = 'penjualan';
	var $pK_table          = 'idpenjualan';
	var $v_table           = 'v_penjualan';

	var $column_order = array(null, 'idpenjualan', 'tglpenjualan', 'keterangan', 'diskon', 'totalharga', 'totalharga', 'grandtotal', 'tglinsert', 'tglupdate', 'idpengguna', 'namapengguna', 'qrcode', 'carapembayaran', 'statuspemesanan', 'statuspembayaran', 'idkoki', 'idkasir');
	var $column_search = array('idpenjualan', 'tglpenjualan', 'keterangan', 'diskon', 'totalharga', 'totalharga', 'grandtotal', 'tglinsert', 'tglupdate', 'idpengguna', 'namapengguna', 'qrcode', 'carapembayaran', 'statuspemesanan', 'statuspembayaran', 'idkoki', 'idkasir');
	var $order = array('idpenjualan' => 'desc'); // default order 


	public function getAll()
	{
		return $this->db->get($this->v_table);
	}

	public function getById($primaryKey)
	{
		$this->db->where($this->pK_table, $primaryKey);
		return $this->db->get($this->v_table);
	}

	public function delete($primaryKey)
	{
		$this->db->trans_begin();

		$this->db->query("DELETE FROM penjualandetil WHERE idpenjualan='$primaryKey' ");

		$this->db->where($this->pK_table, $primaryKey);
		$this->db->delete($this->table);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function insert($data, $dataDetail, $dataDetailService)
	{
		$this->db->trans_begin();

		$this->db->insert($this->table, $data);
		if (count($dataDetail) > 0) {
			$this->db->insert_batch('penjualandetil', $dataDetail);
		}

		if (count($dataDetailService) > 0) {
			$this->db->insert_batch('penjualandetilservice', $dataDetailService);
		}

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function update($data, $idpenjualan, $dataDetail, $dataDetailService)
	{
		$this->db->trans_begin();

		$this->db->query("DELETE FROM penjualandetil WHERE idpenjualan='$idpenjualan' ");
		$this->db->insert_batch('penjualandetil', $dataDetail);

		$this->db->query("DELETE FROM penjualandetilservice WHERE idpenjualan='$idpenjualan' ");
		$this->db->insert_batch('penjualandetilservice', $dataDetailService);

		$this->db->where($this->pK_table, $idpenjualan);
		$this->db->update($this->table, $data);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	// Datatable serverside
	private function _get_datatables_query()
	{
		$level = $this->session->userdata('level');
		if ($level == 'Koki') {
			$this->db->where('statuspemesanan', 'Sedang Proses');
		}


		$this->db->from($this->v_table);
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->v_table);
		return $this->db->count_all_results();
	}
}

/* End of file Penjualan_model.php */
/* Location: ./application/models/Penjualan_model.php */
