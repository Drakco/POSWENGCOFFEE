<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembayaranNonTunaiPelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Penjualan_model');
	}

	public function index()
	{
		$this->load->view('pembayarannontunaipelanggan');
	}

	public function detil()
	{
		$idpenjualan = $this->input->post('idpenjualan');
		if ($this->Penjualan_model->getById($idpenjualan)->num_rows() == 0) {
			$pesan = '
                        <script type="text/javascript">
							Swal.fire(
							"Gagal !",
							"Data tidak ditemukan",
							"error"
                        );
                        </script>
                        ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect($this->controller);
			exit();
		};

		$data['idpenjualan']     = $idpenjualan;

		$data['dataId'] = $this->Penjualan_model->getById($idpenjualan)->row();
		$this->load->view('pembayarannontunaipelanggandetil', $data);
	}
}

/* End of file PembayaranNonTunaiPelanggan.php */
