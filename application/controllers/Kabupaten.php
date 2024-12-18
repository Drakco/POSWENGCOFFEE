<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {

    var $controller     = 'Kabupaten'; 
    var $loadViewList   = 'kabupaten/list';
    var $loadViewForm   = 'kabupaten/form';

    var $formNameHead   = 'Kabupaten';
    var $formNameData   = 'Data Kabupaten';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Kabupaten';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Kabupaten_model');
    
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
        if ($this->Kabupaten_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Kabupaten_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Kabupaten_model->delete($primaryKey);
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

        $idkabupaten = $this->input->post('idkabupaten');
        $namakabupaten = $this->input->post('namakabupaten');
        $tarifkabupaten = untitik($this->input->post('tarifkabupaten'));
        
        if ($this->input->post('statusaktif')) {
            $statusaktif = $this->input->post('statusaktif');
        }else {
            $statusaktif = "Tidak Aktif";
        }

        if ($idkabupaten == '') {
            
            $idkabupaten = $this->db->query("SELECT f_idkabupaten_create() AS idkabupaten")->row()->idkabupaten;
            //  $foto = $this->upload_file($_FILES, "file");

            $data = array(
                'idkabupaten' => $idkabupaten, 
                'namakabupaten' => $namakabupaten,
                'tarifkabupaten' => $tarifkabupaten,
                'statusaktif' => $statusaktif,
            );

            $simpan = $this->Kabupaten_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            }else{
                $pesan = $this->pesan(TRUE, 'Gagal');
            }

        }else{

            //  $file_lama = $this->input->post('file_lama');
            //  $foto = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
                'namakabupaten' => $namakabupaten,
                'tarifkabupaten' => $tarifkabupaten,
                'statusaktif' => $statusaktif,                
            );

            $simpan = $this->Kabupaten_model->update($data, $idkabupaten);
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
        $result                 = $this->Kabupaten_model->getById($primaryKey)->row();

        $data = array(
            'idkabupaten' => $result->idkabupaten, 
            'namakabupaten' => $result->namakabupaten, 
            'tarifkabupaten' => number_format($result->tarifkabupaten), 
            'statusaktif' => $result->statusaktif, 
        );

        echo(json_encode($data));
    }

    function getData()
    {
        $data       = $this->Kabupaten_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;

            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">Aktif</span>';
            }else{
                $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
            }
            $arr[] = $row->idkabupaten.'<br>'.$statusaktif;

            $arr[] = $row->namakabupaten;
            $arr[] = 'Rp. '.number_format($row->tarifkabupaten);
            
            // if ($row->foto == '') {
            //  $arr[] = '<img class="img-thumbnail" style="height: 90px; width: auto;" src="'. base_url('images/nofoto_l.png') .'">';
            // }else{
            //  $arr[] = '<a href="'. base_url('uploads/'.$row->foto) .'" target="_blank"><img class="img-thumbnail" style="height: 90px; width: auto;" src="'. base_url('uploads/'.$row->foto) .'"></a>';
            // }

            $arr[]  = '
                        <a href="'.site_url( $this->controller.'/edit/'.$this->encrypt->encode($row->idkabupaten) ).'" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>  
                     
                        <a href="'.site_url( $this->controller.'/hapus/'.$this->encrypt->encode($row->idkabupaten) ).'" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Kabupaten_model->count_all(),
            "recordsFiltered" => $this->Kabupaten_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */
