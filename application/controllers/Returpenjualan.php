<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Returpenjualan extends CI_Controller
{

    var $controller     = 'Returpenjualan';
    var $loadViewList   = 'returpenjualan/list';
    var $loadViewForm   = 'returpenjualan/form';

    var $formNameHead   = 'Retur Penjualan';
    var $formNameData   = 'Data Retur Penjualan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Returpenjualan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Returpenjualan_model');

        $config['upload_path']          = 'uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = '2000000KB'; // 200KB
        $config['quality']              = '100%';
        $config['remove_space']         = TRUE;

        $this->load->library('upload', $config);
        $this->load->library('image_lib');
    }

    public function isLogin()
    {
        $idpengguna = $this->session->userdata('idpengguna');
        if (empty($idpengguna)) {
            $pesan = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Session telah berakhir. Silahkan login kembali . . . ",
                          "error"
                        );
                        </script>
                        ';
            $this->session->set_flashdata('pesan', $pesan);
            redirect('Login');
            exit();
        }
    }

    public function index()
    {
        $data['menu']           = $this->menu;
        $data['controller']     = $this->controller;
        $data['formNameHead']   = $this->formNameHead;
        $data['formNameData']   = $this->formNameData;
        $this->load->view($this->loadViewList, $data);
    }

    public function tambah($idpenjualan)
    {
        $idpenjualan = $this->encrypt->decode($idpenjualan);
        if ($this->db->query("SELECT * FROM v_penjualan WHERE idpenjualan='$idpenjualan' ")->num_rows() == 0) {
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

        $data['primaryKey']     = '';

        $data['menu']           = $this->menu;
        $data['controller']     = $this->controller;
        $data['formNameHead']   = $this->formNameHead;
        $data['formNameData']   = $this->formNameData;
        $data['formName']       = $this->formNameAdd;
        $data['button']         = 'Simpan';

        $data['dataId']         = $this->db->query("SELECT * FROM v_penjualan WHERE idpenjualan='$idpenjualan' ")->row();
        $this->load->view($this->loadViewForm, $data);
    }

    public function edit($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Returpenjualan_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['primaryKey']     = $primaryKey;

        $data['menu']           = $this->menu;
        $data['controller']     = $this->controller;
        $data['formNameHead']   = $this->formNameHead;
        $data['formNameData']   = $this->formNameData;
        $data['formName']       = $this->formNameEdit;
        $data['button']         = 'Update';
        $this->load->view($this->loadViewForm, $data);
    }

    public function detil($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Returpenjualan_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['primaryKey']     = $primaryKey;

        $data['menu']           = $this->menu;
        $data['controller']     = $this->controller;
        $data['formNameHead']   = $this->formNameHead;
        $data['formNameData']   = "Detil Data";
        $data['formName']       = "Detil Data";
        $data['button']         = 'detil';

        $data['dataId'] = $this->Returpenjualan_model->getById($primaryKey)->row();
        $this->load->view("returpenjualan/detil", $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Returpenjualan_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Returpenjualan_model->delete($primaryKey);
        if ($hapus) {
            $pesan = $this->pesan(TRUE, 'Hapus');
        } else {
            $pesan = $this->pesan(FALSE, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function simpan()
    {

        $idreturpenjualan = $this->db->query("SELECT f_idreturpenjualan_create('" . date('Y-m-d') . "') AS idreturpenjualan")->row()->idreturpenjualan;
        $tglreturpenjualan = date('Y-m-d H:i:s');
        $idpenjualan = $this->input->post('idpenjualan');
        $keterangan = $this->input->post('keterangan');
        $tglinsert = date('Y-m-d H:i:s');
        $tglupdate = date('Y-m-d H:i:s');
        $idpengguna = $this->session->userdata('idpengguna');

        $data = array(
            'idreturpenjualan' => $idreturpenjualan,
            'tglreturpenjualan' => $tglreturpenjualan,
            'idpenjualan' => $idpenjualan,
            'keterangan' => $keterangan,
            'tglinsert' => $tglinsert,
            'tglupdate' => $tglupdate,
            'idpengguna' => $idpengguna,
        );

        $idproduk = $this->input->post('idproduk');
        $qtyRetur = $this->input->post('qtyRetur');
        $harga = $this->input->post('harga');

        $dataDetail = array();
        $count = count($idproduk);

        for ($i = 0; $i < $count; $i++) {
            if ($qtyRetur[$i] != 0 or $qtyRetur[$i] == '') {
                $totalharga = $harga[$i] * $qtyRetur[$i];

                $dataTemp = array(
                    'idreturpenjualan' => $idreturpenjualan,
                    'idproduk' => $idproduk[$i],
                    'qty' => $qtyRetur[$i],
                    'harga' => $harga[$i],
                    'totalharga' => $totalharga,
                );
                array_push($dataDetail, $dataTemp);
            }
        }

        if (count($dataDetail) == 0) {
            $pesan = '
                        <script type="text/javascript">
                            Swal.fire(
                            "Validasi",
                            "Retur Data Tidak Ada",
                            "warning"
                        );
                        </script>
                        ';
            $this->session->set_flashdata('pesan', $pesan);
            redirect($this->controller . '/tambah/' . $this->encrypt->encode($idpenjualan));
            exit();
        }

        $simpan = $this->Returpenjualan_model->insert($data, $dataDetail);
        if ($simpan) {
            $pesan = $this->pesan(TRUE, 'Simpan');
        } else {
            $pesan = $this->pesan(TRUE, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function pesan($boolean, $pesan)
    {
        if ($boolean) {
            $output = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Berhasil !",
                          "Data Berhasil Di ' . $pesan . ' !",
                          "success"
                        );
                        </script>
                        ';
        } else {
            $eror = $this->db->error();
            $output = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '",
                          "error"
                        );
                        </script>
                        ';
        }
        return $output;
    }

    // UPLOAD FILE
    public function upload_file($file, $nama)
    {
        if (!empty($file[$nama]['tmp_name'])) {
            if ($this->upload->do_upload($nama)) {
                $file = $this->upload->data('file_name');
                $size = $this->upload->data('file_size');
                $ext  = $this->upload->data('file_ext');

                // $this->resize_foto($this->upload->data());

            } else {
                $file = "";
            }
        } else {
            $file = "";
        }
        return $file;
    }

    public function update_upload_file($file, $nama, $file_lama)
    {
        if (!empty($file[$nama]['tmp_name'])) {
            if ($this->upload->do_upload($nama)) {
                $file = $this->upload->data('file_name');
                $size = $this->upload->data('file_size');
                $ext  = $this->upload->data('file_ext');

                // $this->resize_foto($this->upload->data());

            } else {
                $file = $file_lama;
            }
        } else {
            $file = $file_lama;
        }
        return $file;
    }

    public function resize_foto($data)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/' . $data['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '70';
        $config['width'] = 600;
        $config['height'] = 480;
        $config['new_image'] = 'uploads/' . $data['file_name'];

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }
    // END UPLOAD FILE

    // AJAX
    public function getEditData()
    {
        $primaryKey             = $this->input->post('primaryKey');
        $result                 = $this->Returpenjualan_model->getById($primaryKey)->row();

        $data = array(
            'idreturpenjualan' => $result->idreturpenjualan,
            'tglreturpenjualan' => $result->tglreturpenjualan,
            'idpenjualan' => $result->idpenjualan,
            'keterangan' => $result->keterangan,
            'tglinsert' => $result->tglinsert,
            'tglupdate' => $result->tglupdate,
            'idpengguna' => $result->idpengguna,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Returpenjualan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idreturpenjualan;

            $arr[] = formatHariTanggal(date('Y-m-d', strtotime($row->tglreturpenjualan)));

            $idpenjualan = '<small>
					<a href="' . base_url('Penjualan/cetak/' . $this->encrypt->encode($row->idpenjualan)) . '" class="btn btn-info btn-sm btn-block" style="font-size: 10px !important; text-align: left !important;" target="_blank">
						ID. ' . $row->idpenjualan . ' <br>
						Tgl. ' . formatHariTanggal(date('d/m/Y', strtotime($row->tglpenjualan))) . '
					</a>
				</small>';

            $arr[] = $idpenjualan;

            $arr[] = $row->keterangan;
            $arr[] = 'Rp. ' . number_format($row->totalharga);

            $idpengguna = '<small>
				' . $row->namapengguna . ' <br>
				' . formatHariTanggal(date('Y-m-d', strtotime($row->tglupdate))) . ' Jam ' . date('H:i:s', strtotime($row->tglupdate)) . '
			</small>';

            $arr[] = $idpengguna;

            $arr[]  = '
                        <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idreturpenjualan)) . '" class="btn btn-xs btn-info btn-circle" title="Edit Data">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idreturpenjualan)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Returpenjualan_model->count_all(),
            "recordsFiltered" => $this->Returpenjualan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Returpenjualan.php */
/* Location: ./application/controllers/Returpenjualan.php */