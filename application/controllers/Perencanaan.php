<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan extends CI_Controller
{

    var $controller     = 'Perencanaan';
    var $loadViewList   = 'perencanaan/list';
    var $loadViewForm   = 'perencanaan/form';

    var $formNameHead   = 'Perencanaan';
    var $formNameData   = 'Data Perencanaan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Perencanaan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Perencanaan_model');

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
        if ($this->Perencanaan_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Perencanaan_model->getById($primaryKey)->num_rows() == 0) {
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
        $data['formNameData']   = "Detil Perencanaan";
        $data['formName']       = "Detil Perencanaan";
        $data['button']         = 'Detil';

        $data['dataId'] = $this->Perencanaan_model->getById($primaryKey)->row();
        $this->load->view('perencanaan/detil', $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Perencanaan_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Perencanaan_model->delete($primaryKey);
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

        $idperencanaan = $this->input->post('idperencanaan');
        $tglperencanaan = date('Y-m-d', strtotime($this->input->post('tglperencanaan')));
        $jenis = $this->input->post('jenis');
        $nama = $this->input->post('nama');
        $tujuan = $this->input->post('tujuan');
        $keterangan = $this->input->post('keterangan');

        $tglinsert = date('Y-m-d H:i:s');
        $tglupdate = date('Y-m-d H:i:s');
        $idpengguna = $this->session->userdata('idpengguna');

        if ($idperencanaan == '') {

            $idperencanaan = $this->db->query("SELECT f_idperencanaan_create('" . date('Y-m-d') . "') AS idperencanaan")->row()->idperencanaan;
            $foto = $this->upload_file($_FILES, "file");

            $data = array(
                'idperencanaan' => $idperencanaan,
                'tglperencanaan' => $tglperencanaan,
                'jenis' => $jenis,
                'nama' => $nama,
                'tujuan' => $tujuan,
                'keterangan' => $keterangan,
                'foto' => $foto,
                'tglinsert' => $tglinsert,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
            );

            $simpan = $this->Perencanaan_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            } else {
                $pesan = $this->pesan(TRUE, 'Gagal');
            }
        } else {

            $file_lama = $this->input->post('file_lama');
            $foto = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
                'tglperencanaan' => $tglperencanaan,
                'jenis' => $jenis,
                'nama' => $nama,
                'tujuan' => $tujuan,
                'keterangan' => $keterangan,
                'foto' => $foto,
                'tglinsert' => $tglinsert,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
            );

            $simpan = $this->Perencanaan_model->update($data, $idperencanaan);
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
        $result                 = $this->Perencanaan_model->getById($primaryKey)->row();

        $data = array(
            'idperencanaan' => $result->idperencanaan,
            'tglperencanaan' => $result->tglperencanaan,
            'jenis' => $result->jenis,
            'nama' => $result->nama,
            'tujuan' => $result->tujuan,
            'keterangan' => $result->keterangan,
            'foto' => $result->foto,
            'tglinsert' => $result->tglinsert,
            'tglupdate' => $result->tglupdate,
            'idpengguna' => $result->idpengguna,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Perencanaan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        $level = $this->session->userdata('level');

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;

            if ($row->statusperencanaan == 'Sudah Diproses') {
                $statusperencanaan = '<span class="badge badge-success">Sudah Diproses</span>';
            } else {
                $statusperencanaan = '<span class="badge badge-warning">Sedang Diproses</span>';
            }

            $arr[] = $row->idperencanaan . '<br>' . $statusperencanaan;

            $arr[] = formatHariTanggal($row->tglperencanaan);
            $arr[] = $row->jenis;
            $arr[] = $row->nama;
            $arr[] = $row->tujuan;
            $arr[] = '<small>
			' . $row->namapengguna . ' <br>
			' . date('d/m/Y H:i:s', strtotime($row->tglupdate)) . '
			</small>';

            if ($row->foto == '') {
                $arr[] = '<img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('images/nofoto_l.png') . '">';
            } else {
                $arr[] = '<a href="' . base_url('uploads/' . $row->foto) . '" target="_blank"><img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('uploads/' . $row->foto) . '"></a>';
            }

            if ($row->statusperencanaan == 'Sudah Diproses') {
                $arr[]  = '
							<a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idperencanaan)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
								<i class="fa fa-eye"></i>
							</a>';
            } else {
                if ($level != 'Admin') {
                    $arr[]  = '
                                <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idperencanaan)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idperencanaan)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idperencanaan)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </a>';
                } else {
                    $arr[]  = '
                                <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idperencanaan)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                    <i class="fa fa-eye"></i>
                                </a>';
                }
            }

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Perencanaan_model->count_all(),
            "recordsFiltered" => $this->Perencanaan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Perencanaan.php */
/* Location: ./application/controllers/Perencanaan.php */
