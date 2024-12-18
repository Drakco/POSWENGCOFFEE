<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_model extends CI_Model {

    var $table             = 'pengadaan';
    var $pK_table          = 'idpengadaan';   
    var $v_table           = 'v_pengadaan';

    var $column_order = array(
			null,
			'idpengadaan',
			'tglpengadaan',
			'idsupplier',
			'namasupplier',
			'keterangan',
			'totalharga',
			'tglinsert',
			'tglupdate',
			'idpengguna',
			'namapengguna',
			'statuskonfirmasi',
			'tglkonfirmasi',
			'idkonfirmasi',
			'namakonfirmasi',
		);
    var $column_search = array(
		'idpengadaan',
		'tglpengadaan',
		'idsupplier',
		'namasupplier',
		'keterangan',
		'totalharga',
		'tglinsert',
		'tglupdate',
		'idpengguna',
		'namapengguna',
		'statuskonfirmasi',
		'tglkonfirmasi',
		'idkonfirmasi',
		'namakonfirmasi',
	);
    var $order = array('idpengadaan' => 'asc'); // default order 
   

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

        $this->db->query("DELETE FROM pengadaan_detil WHERE idpengadaan='$primaryKey' ");

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

    public function insert($data, $dataDetail)
    {       
        $this->db->trans_begin();

        $this->db->insert($this->table, $data);
        $this->db->insert_batch('pengadaan_detil', $dataDetail);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update($data, $primaryKey, $dataDetail)
    {
        $this->db->trans_begin();

        $this->db->query("DELETE FROM pengadaan_detil WHERE idpengadaan='$primaryKey' ");
        $this->db->insert_batch('pengadaan_detil', $dataDetail);

        $this->db->where($this->pK_table, $primaryKey);
        $this->db->update($this->table, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

	public function konfirmasi($data, $dataPembelian, $dataDetail, $idpengadaan, $statuskonfirmasi)
	{
		$this->db->trans_begin();

		$this->db->where('idpengadaan', $idpengadaan);
		$this->db->update('pengadaan', $data);

		if ($statuskonfirmasi == 'Dikonfirmasi') {
			$this->db->insert('pembelian', $dataPembelian);
			$this->db->insert_batch('pembelian_detil', $dataDetail);
		}

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
         
        $this->db->from($this->v_table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }else {
                    $this->db->or_like($item, $_POST['search']['value']);
                } if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
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

/* End of file Pengadaan_model.php */
/* Location: ./application/models/Pengadaan_model.php */