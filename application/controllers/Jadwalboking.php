<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwalboking extends CI_Controller
{

    var $controller     = 'Jadwalboking';
    var $loadViewList   = 'jadwalboking/list';
    var $loadViewForm   = 'jadwalboking/form';

    var $formNameHead   = 'Booking Service';
    var $formNameData   = 'Data Jadwal Service';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Jadwalboking';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Jadwalboking_model');

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

    public function tambah()
    {
        $data['primaryKey']     = '';

        $data['menu']           = $this->menu;
        $data['controller']     = $this->controller;
        $data['formNameHead']   = $this->formNameHead;
        $data['formNameData']   = $this->formNameData;
        $data['formName']       = $this->formNameAdd;
        $data['button']         = 'Simpan';
        $this->load->view($this->loadViewForm, $data);
    }

    public function edit($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Jadwalboking_model->getById($primaryKey)->num_rows() == 0) {
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

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Jadwalboking_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Jadwalboking_model->delete($primaryKey);
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

        $idjadwalboking = $this->input->post('idjadwalboking');
        $tgljadwalboking = $this->input->post('tgljadwalboking');
        $idjadwal = $this->input->post('idjadwal');
        $idpelanggan = $this->input->post('idpelanggan');
        $keterangan = $this->input->post('keterangan');
        $status = $this->input->post('status');

        if ($idjadwalboking == '') {

            $idjadwalboking = $this->db->query("SELECT f_idjadwalboking_create() AS idjadwalboking")->row()->idjadwalboking;
            //  $foto = $this->upload_file($_FILES, "file");

            $data = array(
                'idjadwalboking' => $idjadwalboking,
                'tgljadwalboking' => $tgljadwalboking,
                'idjadwal' => $idjadwal,
                'idpelanggan' => $idpelanggan,
                'keterangan' => $keterangan,
                'status' => $status,
            );

            $simpan = $this->Jadwalboking_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            } else {
                $pesan = $this->pesan(TRUE, 'Gagal');
            }
        } else {

            //  $file_lama = $this->input->post('file_lama');
            //  $foto = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
                'tgljadwalboking' => $tgljadwalboking,
                'idjadwal' => $idjadwal,
                'idpelanggan' => $idpelanggan,
                'keterangan' => $keterangan,
                'status' => $status,
            );

            $simpan = $this->Jadwalboking_model->update($data, $idjadwalboking);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Update');
            } else {
                $pesan = $this->pesan(TRUE, 'Gagal');
            }
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
        $result                 = $this->Jadwalboking_model->getById($primaryKey)->row();

        $data = array(
            'idjadwalboking' => $result->idjadwalboking,
            'tgljadwalboking' => $result->tgljadwalboking,
            'idjadwal' => $result->idjadwal,
            'idpelanggan' => $result->idpelanggan,
            'keterangan' => $result->keterangan,
            'status' => $result->status,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Jadwalboking_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idjadwalboking;

            $arr[] = formatHariTanggal(date('Y-m-d', strtotime($row->tgljadwalboking)));
            $arr[] = $row->hari . ', Jam : ' . $row->jamawal . ' - ' . $row->jamakhir;
            $arr[] = $row->namapelanggan;
            $arr[] = $row->keterangan;

            if ($row->status == "Sudah Selesai") {
                $arr[] = '<span class="badge badge-success">Sudah Selesai</span>';
            } else {
                $arr[] = '<span class="badge badge-warning">Menunggu</span>';
            }

            // if ($row->foto == '') {
            //  $arr[] = '<img class="img-thumbnail" style="height: 90px; width: auto;" src="'. base_url('images/nofoto_l.png') .'">';
            // }else{
            //  $arr[] = '<a href="'. base_url('uploads/'.$row->foto) .'" target="_blank"><img class="img-thumbnail" style="height: 90px; width: auto;" src="'. base_url('uploads/'.$row->foto) .'"></a>';
            // }

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Jadwalboking_model->count_all(),
            "recordsFiltered" => $this->Jadwalboking_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Jadwalboking.php */
/* Location: ./application/controllers/Jadwalboking.php */