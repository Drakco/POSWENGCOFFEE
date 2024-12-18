<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_video extends CI_Controller {

	var $controller     = 'Profil_video'; 
    var $loadViewList   = 'profil_video/list';
    var $loadViewForm   = 'profil_video/form';

    var $formNameHead   = 'Video';
    var $formNameData   = 'Data Video';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Profil_video';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Profil_video_model');
    
        $config['upload_path']          = 'uploads/video/';
        $config['allowed_types']        = 'mp4';
        $config['max_size']             = '2000000000000000000000000000KB'; // 200KB
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
        if ($this->Profil_video_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Profil_video_model->getById($primaryKey)->num_rows() == 0) {
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

        $file = $this->db->query("SELECT file FROM profil_video WHERE idvideo='$primaryKey' ")->row()->file;
        $hapus = $this->Profil_video_model->delete($primaryKey);
        if ($hapus) {
            $pesan = $this->pesan(TRUE, 'Hapus');
             unlink('uploads/video/'.$file);
        }else{
            $pesan = $this->pesan(FALSE, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function simpan()
    {
		$idvideo = $this->input->post('idvideo');
		$judul = $this->input->post('judul');
		$keterangan = $this->input->post('keterangan');
		$urisegment = str_replace(' ', '-', strtolower($judul));
		$tglinsert = date('Y-m-d H:i:s');
		$tglupdate = date('Y-m-d H:i:s');
		$idpengguna = $this->session->userdata('idpengguna');

        if ($idvideo == '') {
            
            $idvideo = $this->db->query("SELECT f_idvideo_create('".date('Y-m-d')."') AS idvideo")->row()->idvideo;
            $file = $this->upload_file($_FILES, "file");

            $data = array(
				'idvideo' => $idvideo,
				'judul' => $judul,
				'file' => $file,
				'keterangan' => $keterangan,
				'urisegment' => $urisegment,
				'tglinsert' => $tglinsert,
				'tglupdate' => $tglupdate,
				'idpengguna' => $idpengguna,
            );

            $simpan = $this->Profil_video_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            }else{
                $pesan = $this->pesan(TRUE, 'Gagal');
            }

        }else{

            $file_lama = $this->input->post('file_lama');
            $file = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
				'idvideo' => $idvideo,
				'judul' => $judul,
				'file' => $file,
				'keterangan' => $keterangan,
				'urisegment' => $urisegment,
				'tglupdate' => $tglupdate,
				'idpengguna' => $idpengguna,
            );

            $simpan = $this->Profil_video_model->update($data, $idvideo);
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
        $result                 = $this->Profil_video_model->getById($primaryKey)->row();

        $data = array(
			'idvideo' => $result->idvideo,
			'judul' => $result->judul,
			'file' => $result->file,
			'keterangan' => $result->keterangan,
			'urisegment' => $result->urisegment,
			'tglinsert' => $result->tglinsert,
			'tglupdate' => $result->tglupdate,
			'idpengguna' => $result->idpengguna,
			'namapengguna' => $result->namapengguna,
        );

        echo(json_encode($data));
    }

    function getData()
    {
        $data       = $this->Profil_video_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idvideo;

            $arr[] = $row->judul;
            $arr[] = $row->keterangan;
            $arr[] = formatHariTanggal(date('Y-m-d', strtotime($row->tglupdate))).' Jam : '.date('H:i', strtotime($row->tglupdate));
            $arr[] = $row->namapengguna;

            $arr[]  = '
                        <a href="'.site_url( $this->controller.'/edit/'.$this->encrypt->encode($row->idvideo) ).'" class="btn btn-sm btn-warning btn-circle" title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>  
                     
                        <a href="'.site_url( $this->controller.'/hapus/'.$this->encrypt->encode($row->idvideo) ).'" class="btn btn-sm btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Profil_video_model->count_all(),
            "recordsFiltered" => $this->Profil_video_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX

}

/* End of file Profil_video.php */
/* Location: ./application/controllers/Profil_video.php */