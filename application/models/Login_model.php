<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function cekLogin($username, $password)
	{
		$query = "select * from pengguna where (username='".$username."' and password='".$password."') and statusaktif='Aktif' ";
		return $this->db->query($query);
	}

	public function update($idpengguna, $data)
	{
		$this->db->where('idpengguna', $idpengguna);
        return $this->db->update('pengguna', $data);
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */
