<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaansurat extends CI_Controller
{

    var $controller     = 'Perencanaansurat';
    var $loadViewList   = 'perencanaansurat/list';
    var $loadViewForm   = 'perencanaansurat/form';

    var $formNameHead   = 'Surat Perencanaan';
    var $formNameData   = 'Data Surat Perencanaan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Perencanaansurat';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Perencanaansurat_model');

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

    public function tambah($idperencanaan)
    {
        $idperencanaan = $this->encrypt->decode($idperencanaan);
        if ($this->db->query("SELECT * FROM v_perencanaan WHERE idperencanaan='$idperencanaan' ")->num_rows() == 0) {
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

        $data['dataId'] = $this->db->query("SELECT * FROM v_perencanaan WHERE idperencanaan='$idperencanaan' ")->row();
        $this->load->view($this->loadViewForm, $data);
    }

    public function edit($primaryKey, $idperencanaan)
    {
        $idperencanaan = $this->encrypt->decode($idperencanaan);
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Perencanaansurat_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['dataId'] = $this->db->query("SELECT * FROM v_perencanaan WHERE idperencanaan='$idperencanaan' ")->row();
        $this->load->view($this->loadViewForm, $data);
    }

    public function cetak($primaryKey)
    {
        error_reporting(0);
        $this->load->library('Pdf');

        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Perencanaansurat_model->getById($primaryKey)->num_rows() == 0) {
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
        $data['dataPerusahaan']         = $this->db->query("SELECT namaperusahaan FROM profil WHERE id=1 ")->row()->namaperusahaan;
        $data['dataPerusahaanDetil']    = $this->db->query("SELECT  
																CONCAT(alamat, ',<br>Email : ',email,', No. Telp : ',notelp) AS alamatlengkap
															FROM profil_kontakkami WHERE id=1;")->row()->alamatlengkap;

        $data['dataProfil']             = $this->db->query("SELECT * FROM profil WHERE id=1 ")->row();
        $data['dataProfilKontak']       = $this->db->query("SELECT * FROM profil_kontakkami WHERE id=1 ")->row();

        $data['dataId'] = $this->Perencanaansurat_model->getById($primaryKey)->row();
        $this->load->view('perencanaansurat/cetakpdf', $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Perencanaansurat_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Perencanaansurat_model->delete($primaryKey);
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

        $idperencanaansurat = $this->input->post('idperencanaansurat');
        $idperencanaan = $this->input->post('idperencanaan');
        $tglperencanaansurat = date('Y-m-d', strtotime($this->input->post('tglperencanaansurat')));
        $namaperusahaan = $this->input->post('namaperusahaan');
        $perihal = $this->input->post('perihal');
        $alamat = $this->input->post('alamat');
        $kota = $this->input->post('kota');
        $kodepos = $this->input->post('kodepos');
        $keterangan = $this->input->post('keterangan');
        $tglinsert = date('Y-m-d H:i:s');
        $tglupdate = date('Y-m-d H:i:s');
        $idpengguna = $this->session->userdata('idpengguna');

        if ($idperencanaansurat == '') {

            $idperencanaansurat = $this->db->query("SELECT f_idperencanaansurat_create('" . date('Y-m-d') . "') AS idperencanaansurat")->row()->idperencanaansurat;

            $data = array(
                'idperencanaansurat' => $idperencanaansurat,
                'idperencanaan' => $idperencanaan,
                'tglperencanaansurat' => $tglperencanaansurat,
                'namaperusahaan' => $namaperusahaan,
                'alamat' => $alamat,
                'kota' => $kota,
                'kodepos' => $kodepos,
                'perihal' => $perihal,
                'keterangan' => $keterangan,
                'tglinsert' => $tglinsert,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
            );

            $simpan = $this->Perencanaansurat_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            } else {
                $pesan = $this->pesan(TRUE, 'Gagal');
            }
        } else {

            $data = array(
                'tglperencanaansurat' => $tglperencanaansurat,
                'namaperusahaan' => $namaperusahaan,
                'alamat' => $alamat,
                'kota' => $kota,
                'kodepos' => $kodepos,
                'perihal' => $perihal,
                'keterangan' => $keterangan,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
            );

            $simpan = $this->Perencanaansurat_model->update($data, $idperencanaansurat);
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
        $result                 = $this->Perencanaansurat_model->getById($primaryKey)->row();

        $data = array(
            'idperencanaansurat' => $result->idperencanaansurat,
            'idperencanaan' => $result->idperencanaan,
            'tglperencanaansurat' => $result->tglperencanaansurat,
            'namaperusahaan' => $result->namaperusahaan,
            'perihal' => $result->perihal,
            'alamat' => $result->alamat,
            'kota' => $result->kota,
            'kodepos' => $result->kodepos,
            'keterangan' => $result->keterangan,
            'tglinsert' => $result->tglinsert,
            'tglupdate' => $result->tglupdate,
            'idpengguna' => $result->idpengguna,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Perencanaansurat_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        $level = $this->session->userdata('level');

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idperencanaansurat;

            $arr[] = formatHariTanggal($row->tglperencanaansurat);
            $arr[] = $row->jenis;
            $arr[] = $row->nama;
            $arr[] = $row->namaperusahaan;
            $arr[] = $row->perihal;

            $arr[] = '<small>
                ' . $row->namapengguna . ' <br>
                ' . formatHariTanggal(date('Y-m-d', strtotime($row->tglupdate))) . ' Jam ' . date('H:i', strtotime($row->tglupdate)) . '
            </small>';

            if ($level != 'Pimpinan') {
                $arr[]  = '
                            <a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idperencanaansurat)) . '" class="btn btn-xs btn-info btn-circle" title="Cetak Data" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                            <a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idperencanaansurat)) . '/' . $this->encrypt->encode($row->idperencanaan) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                                <i class="fa fa-edit"></i>
                            </a>  
                            <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idperencanaansurat)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                                <i class="fa fa-trash"></i>
                            </a>';
            } else {
                $arr[]  = '
                            <a href="' . site_url($this->controller . '/cetak/' . $this->encrypt->encode($row->idperencanaansurat)) . '" class="btn btn-xs btn-info btn-circle" title="Cetak Data" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>';
            }


            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Perencanaansurat_model->count_all(),
            "recordsFiltered" => $this->Perencanaansurat_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Perencanaansurat.php */
/* Location: ./application/controllers/Perencanaansurat.php */