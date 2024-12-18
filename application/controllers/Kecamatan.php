<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

    var $controller     = 'Kecamatan'; 
    var $loadViewList   = 'kecamatan/list';
    var $loadViewForm   = 'kecamatan/form';

    var $formNameHead   = 'Kecamatan';
    var $formNameData   = 'Data Kecamatan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Kecamatan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Kecamatan_model');
    
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
        if ($this->Kecamatan_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Kecamatan_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Kecamatan_model->delete($primaryKey);
        if ($hapus) {
            $pesan = $this->pesan(TRUE, 'Hapus');
        }else{
            $pesan = $this->pesan(FALSE, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function simpan()
    {

        $idkecamatan = $this->input->post('idkecamatan');
        $idkabupaten = $this->input->post('idkabupaten');
        $namakecamatan = $this->input->post('namakecamatan');
        $tarifkecamatan = untitik($this->input->post('tarifkecamatan'));
        
        $tarifkabupaten = $this->db->query("SELECT * FROM kabupaten WHERE idkabupaten='$idkabupaten' ")->row()->tarifkabupaten;
        $totaltarif = $tarifkabupaten + $tarifkecamatan;

        if ($this->input->post('statusaktif')) {
            $statusaktif = $this->input->post('statusaktif');
        }else{
            $statusaktif = "Tidak Aktif";
        }

        if ($idkecamatan == '') {
            
            $idkecamatan = $this->db->query("SELECT f_idkecamatan_create() AS idkecamatan")->row()->idkecamatan;

            $data = array(
                'idkecamatan' => $idkecamatan, 
                'idkabupaten' => $idkabupaten,
                'namakecamatan' => $namakecamatan,
                'tarifkecamatan' => $tarifkecamatan,
                'totaltarif' => $totaltarif,
                'statusaktif' => $statusaktif,
            );

            $simpan = $this->Kecamatan_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            }else{
                $pesan = $this->pesan(TRUE, 'Gagal');
            }

        }else{

            $data = array(
                'idkabupaten' => $idkabupaten,
                'namakecamatan' => $namakecamatan,
                'tarifkecamatan' => $tarifkecamatan,
                'totaltarif' => $totaltarif,
                'statusaktif' => $statusaktif,                
            );

            $simpan = $this->Kecamatan_model->update($data, $idkecamatan);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Update');
            }else{
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
                          "Data Berhasil Di '.$pesan.' !",
                          "success"
                        );
                        </script>
                        ';
        }else{
            $eror = $this->db->error();         
            $output = '
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Pesan Error : '.$eror['code'].' '.$eror['message'].'",
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

             }else{
                 $file = "";
             }
        }else{
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

             }else{
                $file = $file_lama;
             }
        }else{
            $file = $file_lama;
        }
        return $file;
    }

    public function resize_foto($data)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/'.$data['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '70';
        $config['width'] = 600;
        $config['height'] = 480;
        $config['new_image'] = 'uploads/'.$data['file_name'];

        $this->image_lib->clear();
        $this->image_lib->initialize($config);              
        $this->image_lib->resize();
    }
    // END UPLOAD FILE

    // AJAX
    public function getEditData()
    {
        $primaryKey             = $this->input->post('primaryKey');
        $result                 = $this->Kecamatan_model->getById($primaryKey)->row();

        $data = array(
            'idkecamatan' => $result->idkecamatan, 
            'idkabupaten' => $result->idkabupaten, 
            'namakecamatan' => $result->namakecamatan, 
            'tarifkecamatan' => number_format($result->tarifkecamatan), 
            'totaltarif' => number_format($result->totaltarif), 
            'statusaktif' => $result->statusaktif, 
        );

        echo(json_encode($data));
    }

    function getData()
    {
        $data       = $this->Kecamatan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            
            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">Aktif</span>';
            }else {
                $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
            }
            
            $arr[] = $row->idkecamatan.'<br>'.$statusaktif;

            $arr[] = $row->namakabupaten;
            $arr[] = 'Rp.'.number_format($row->tarifkabupaten);
            $arr[] = $row->namakecamatan;
            $arr[] = 'Rp. '.number_format($row->tarifkecamatan);
            $arr[] = 'Rp. '.number_format($row->totaltarif);
            
            $arr[]  = '
                        <a href="'.site_url( $this->controller.'/edit/'.$this->encrypt->encode($row->idkecamatan) ).'" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>  
                     
                        <a href="'.site_url( $this->controller.'/hapus/'.$this->encrypt->encode($row->idkecamatan) ).'" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Kecamatan_model->count_all(),
            "recordsFiltered" => $this->Kecamatan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Kecamatan.php */
/* Location: ./application/controllers/Kecamatan.php */