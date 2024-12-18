<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkeluar extends CI_Controller
{

    public $controller   = 'Barangkeluar';
    public $loadViewList = 'barangkeluar/list';
    public $loadViewForm = 'barangkeluar/form';

    public $formNameHead = 'Barang Keluar';
    public $formNameData = 'Data Barang Keluar';
    public $formNameAdd  = 'Form Tambah Data';
    public $formNameEdit = 'Form Edit Data';

    public $menu = 'Barangkeluar';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Barangkeluar_model');

        $config['upload_path']   = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = '2000000KB'; // 200KB
        $config['quality']       = '100%';
        $config['remove_space']  = true;

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
        $data['menu']       = $this->menu;
        $data['controller'] = $this->controller;

        $data['formNameHead'] = "Barang Keluar";
        $data['formNameData'] = "Barang Keluar";

        $this->load->view($this->loadViewList, $data);
    }

    public function tambah()
    {
        $data['primaryKey'] = '';

        $data['menu']       = $this->menu;
        $data['controller'] = $this->controller;

        $data['formNameHead'] = "Barang Keluar";
        $data['formNameData'] = "Barang Keluar";

        $data['formName'] = $this->formNameAdd;
        $data['button']   = 'Simpan';
        $this->load->view($this->loadViewForm, $data);
    }

    public function edit($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Barangkeluar_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['primaryKey'] = $primaryKey;

        $data['menu']       = $this->menu;
        $data['controller'] = $this->controller;

        $data['formNameHead'] = "Barang Keluar";
        $data['formNameData'] = "Barang Keluar";

        $data['formName'] = $this->formNameEdit;
        $data['button']   = 'Update';
        $this->load->view($this->loadViewForm, $data);
    }

    public function lihat($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Barangkeluar_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['primaryKey'] = $primaryKey;

        $data['menu']       = $this->menu;
        $data['controller'] = $this->controller;

        $data['formNameHead'] = "Penggunaan";
        $data['formNameData'] = "Penggunaan";

        $data['formName'] = $this->formNameEdit;

        $data['dataID']     = $this->Barangkeluar_model->getById($primaryKey)->row();
        $data['dataDetail'] = $this->db->query("SELECT * FROM v_barangkeluar_detail WHERE idbarangkeluar='$primaryKey' ORDER BY namabarang ");

        $data['button'] = 'Update';
        $this->load->view('barangkeluar/lihat', $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Barangkeluar_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Barangkeluar_model->delete($primaryKey);
        if ($hapus) {
            $pesan = $this->pesan(true, 'Hapus');
        } else {
            $pesan = $this->pesan(false, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function simpan()
    {

        $idbarangkeluar  = $this->input->post('idbarangkeluar');
        $tglbarangkeluar = date('Y-m-d', strtotime($this->input->post('tglbarangkeluar')));
        $keterangan      = $this->input->post('keterangan');
        $tglinsert       = date('Y-m-d H:i:s');
        $tglupdate       = date('Y-m-d H:i:s');
        $idpengguna      = $this->session->userdata('idpengguna');

        $isidatatable = $this->input->post('isidatatable');

        if ($idbarangkeluar == '') {

            $idbarangkeluar = $this->db->query("SELECT f_idbarangkeluar_create('" . date('Y-m-d') . "') AS idbarangkeluar")->row()->idbarangkeluar;

            $data = array(
                'idbarangkeluar'   => $idbarangkeluar,
                'tglbarangkeluar'  => $tglbarangkeluar,
                'keterangan'       => $keterangan,
                'tglinsert'        => $tglinsert,
                'tglupdate'        => $tglupdate,
                'idpengguna'       => $idpengguna,
            );

            $dataDetail = array();
            foreach ($isidatatable as $item) {
                $idbarang   = $item[1];
                $qty        = $item[5];
                $harga  = $item[4];
                $totalharga = $item[6];

                $dataDetailTemp = array(
                    'idbarangkeluar' => $idbarangkeluar,
                    'idbarang'       => $idbarang,
                    'qty'            => untitik($qty),
                    'harga'          => untitik($harga),
                    'totalharga'     => untitik($totalharga),
                );

                array_push($dataDetail, $dataDetailTemp);
            }

            $simpan = $this->Barangkeluar_model->insert($data, $dataDetail);
            if ($simpan) {
                echo json_encode(array(
                    'success' => true,
                    'msg'     => 'Data Berhasil Disimpan',
                ));
                exit();
            } else {
                $eror = $this->db->error();
                echo json_encode(array(
                    'success' => false,
                    'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
                ));
                exit();
            }
        } else {

            $data = array(
                'tglbarangkeluar' => $tglbarangkeluar,
                'keterangan'      => $keterangan,
                'tglupdate'       => $tglupdate,
                'idpengguna'      => $idpengguna,
            );

            $dataDetail = array();
            foreach ($isidatatable as $item) {
                $idbarang   = $item[1];
                $qty        = $item[5];
                $harga  = $item[4];
                $totalharga = $item[6];

                $dataDetailTemp = array(
                    'idbarangkeluar' => $idbarangkeluar,
                    'idbarang'       => $idbarang,
                    'qty'            => untitik($qty),
                    'harga'      => untitik($harga),
                    'totalharga'     => untitik($totalharga),
                );

                array_push($dataDetail, $dataDetailTemp);
            }

            $simpan = $this->Barangkeluar_model->update($data, $idbarangkeluar, $dataDetail);
            if ($simpan) {
                echo json_encode(array(
                    'success' => true,
                    'msg'     => 'Data Berhasil Disimpan',
                ));
                exit();
            } else {
                $eror = $this->db->error();
                echo json_encode(array(
                    'success' => false,
                    'msg'     => 'Kode Eror: ' . $eror['code'] . ' ' . $eror['message'],
                ));
                exit();
            }
        }
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
            $eror   = $this->db->error();
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
                // $size = $this->upload->data('file_size');
                // $ext  = $this->upload->data('file_ext');

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
                // $size = $this->upload->data('file_size');
                // $ext  = $this->upload->data('file_ext');

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
        $config['image_library']  = 'gd2';
        $config['source_image']   = 'uploads/' . $data['file_name'];
        $config['create_thumb']   = false;
        $config['maintain_ratio'] = false;
        $config['quality']        = '70';
        $config['width']          = 600;
        $config['height']         = 480;
        $config['new_image']      = 'uploads/' . $data['file_name'];

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }
    // END UPLOAD FILE

    // AJAX
    public function getEditData()
    {
        $primaryKey = $this->input->post('primaryKey');
        $result     = $this->Barangkeluar_model->getById($primaryKey)->row();

        $data = array(
            'idbarangkeluar'   => $result->idbarangkeluar,
            'tglbarangkeluar'  => $result->tglbarangkeluar,
            'keterangan'       => $result->keterangan,
            'totalharga'       => $result->totalharga,
            'idpelanggan'      => $result->idpelanggan,
            'namapelanggan'    => $result->namapelanggan,
            'notelp'           => $result->notelp,
            'alamat'           => $result->alamat,
            'email'            => $result->email,
            'tglinsert'        => $result->tglinsert,
            'tglupdate'        => $result->tglupdate,
            'idpengguna'       => $result->idpengguna,
            'namapengguna'     => $result->namapengguna,
            'statuskonfirmasi' => $result->statuskonfirmasi,
            'tglkonfirmasi'    => $result->tglkonfirmasi,
            'idkonfirmasi'     => $result->idkonfirmasi,
            'namakonfirmasi'   => $result->namakonfirmasi,

        );

        echo (json_encode($data));
    }

    public function getData()
    {
        $data    = $this->Barangkeluar_model->get_datatables();
        $dataArr = array();
        $no      = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;

            $arr[] = '<b>' . $row->idbarangkeluar . '</b>';
            $arr[] = formatHariTanggal($row->tglbarangkeluar);
            $arr[] = $row->keterangan;
            $arr[] = number_format($row->totalharga);
            $arr[] = $row->namapengguna;

            $arr[] = '
                        <a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idbarangkeluar)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idbarangkeluar)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';



            array_push($dataArr, $arr);
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Barangkeluar_model->count_all(),
            "recordsFiltered" => $this->Barangkeluar_model->count_filtered(),
            "data"            => $dataArr,
        );

        echo json_encode($output);
    }

    public function getStok()
    {
        $idbarang = $this->input->post('idbarang');
        $stok     = $this->db->query("SELECT stok FROM barang WHERE idbarang='$idbarang' ")->row()->stok;
        echo (json_encode(number_format($stok)));
    }

    public function datatablesourcedetail()
    {
        $idbarangkeluar = $this->input->post('idbarangkeluar');
        $data           = array();

        $no    = 1;
        $query = $this->db->query("SELECT * FROM v_barangkeluar_detail WHERE idbarangkeluar='$idbarangkeluar' ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dataTemp = array(
                    $no++,
                    $row->idbarang,
                    '<b>' . $row->namabarang . '</b><br> Satuan : ' . $row->satuan,
                    $row->namajenis,
                    number_format($row->harga),
                    number_format($row->qty),
                    number_format($row->totalharga),
                    '<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>',
                );
                array_push($data, $dataTemp);
            }
        }

        $output = array(
            'data' => $data,
        );

        echo (json_encode($output));
    }

    public function getBarang()
    {
        $idbarang = $this->input->post('idbarang');
        $qty      = untitik($this->input->post('qty'));

        $query = $this->db->query("SELECT * FROM v_barang WHERE idbarang='$idbarang' ");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $totalharga = $qty * $row->harga;

            $data = array(
                'idbarang'   => $row->idbarang,
                'namabarang' => '<b>' . $row->namabarang . '</b><br> Satuan : ' . $row->satuan,
                'nama'       => $row->nama,
                'harga'  => $row->harga,
                'qty'        => $qty,
                'totalharga' => $totalharga,
            );
        } else {
            $data = array();
        }

        echo (json_encode($data));
    }
    // END AJAX

}

/* End of file Barangkeluar.php */
/* Location: ./application/controllers/Barangkeluar.php */
