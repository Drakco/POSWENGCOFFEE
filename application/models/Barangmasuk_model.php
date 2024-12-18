<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk_model extends CI_Model
{

    public $table    = 'barangmasuk';
    public $pK_table = 'idbarangmasuk';
    public $v_table  = 'v_barangmasuk';

    public $column_order  = array(null, 'idbarangmasuk','tglbarangmasuk','nostruk', 'foto','keterangan','idsupplier','namasupplier','totalharga','idpengguna','namapengguna','tglinsert','tglupdate');
    public $column_search = array('idbarangmasuk','tglbarangmasuk','nostruk', 'foto','keterangan','idsupplier','namasupplier','totalharga','idpengguna','namapengguna','tglinsert','tglupdate');
    public $order         = array('tglbarangmasuk' => 'asc'); // default order

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

        $this->db->query("DELETE FROM barangmasuk_detail WHERE idbarangmasuk='$primaryKey' ");

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
        $this->db->insert_batch('barangmasuk_detail', $dataDetail);

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

        $this->db->query("DELETE FROM barangmasuk_detail WHERE idbarangmasuk='$primaryKey' ");
        $this->db->insert_batch('barangmasuk_detail', $dataDetail);

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

    // Datatable serverside
    private function _get_datatables_query()
    {

        $this->db->from($this->v_table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }

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

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->v_table);
        return $this->db->count_all_results();
    }

}

/* End of file Barangmasuk_model.php */
/* Location: ./application/models/Barangmasuk_model.php */
