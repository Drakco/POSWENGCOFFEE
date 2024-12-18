<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    var $controller     = 'Pembayaran'; 
    var $loadViewList   = 'pembayaran/list';
    var $loadViewForm   = 'pembayaran/form';

    var $formNameHead   = 'Pembayaran';
    var $formNameData   = 'Data Pembayaran';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Pembayaran';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Pembayaran_model');
    
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
        if ($this->Pembayaran_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Pembayaran_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Pembayaran_model->delete($primaryKey);
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

        $idpembayaran = $this->input->post('idpembayaran');
        $tglpembayaran = date('Y-m-d H:i:s', strtotime($this->input->post('tglpembayaran')));
        $keterangan = $this->input->post('keterangan');
        $idpemesanan = $this->input->post('idpemesanan');
        $metodepembayaran = $this->input->post('metodepembayaran');
        
        if ($metodepembayaran == 'Via Bank') {
            $idbank = $this->input->post('idbank');
        }else{
            $idbank = NULL;
        }
        // $fotobuktipembayaran = $this->input->post('fotobuktipembayaran');
        $statuskonfirmasi = 'Dikonfirmasi';
        $tglkonfirmasi = date('Y-m-d H:i:s');
        $idkonfirmasi = $this->session->userdata('idpembayaran');;


        $rowJumlahPembayaran = $this->db->query("SELECT * FROM v_pemesanan WHERE idpemesanan='$idpemesanan' ")->row();
        $totalharga = $rowJumlahPembayaran->totalharga;
        $totaltarif = $rowJumlahPembayaran->totaltarif;
        $jumlahpembayaran = $totalharga + $totaltarif;



        if ($idpembayaran == '') {
            
            $idpembayaran = $this->db->query("SELECT f_idpembayaran_create('".date('Y-m-d')."') AS idpembayaran")->row()->idpembayaran;
            $fotobuktipembayaran = $this->upload_file($_FILES, "file");

            $data = array(
                'idpembayaran' => $idpembayaran, 
                'tglpembayaran' => $tglpembayaran,
                'keterangan' => $keterangan,
                'idpemesanan' => $idpemesanan,
                'metodepembayaran' => $metodepembayaran,
                'idbank' => $idbank,
                'fotobuktipembayaran' => $fotobuktipembayaran,
                'jumlahpembayaran' => $jumlahpembayaran,
                'statuskonfirmasi' => $statuskonfirmasi,
                'tglkonfirmasi' => $tglkonfirmasi,
                'idkonfirmasi' => $idkonfirmasi,
            );

            $simpan = $this->Pembayaran_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            }else{
                $pesan = $this->pesan(TRUE, 'Gagal');
            }

        }else{

            $file_lama = $this->input->post('file_lama');
            $fotobuktipembayaran = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
                'tglpembayaran' => $tglpembayaran,
                'keterangan' => $keterangan,
                'idpemesanan' => $idpemesanan,
                'metodepembayaran' => $metodepembayaran,
                'idbank' => $idbank,
                'fotobuktipembayaran' => $fotobuktipembayaran,
                'jumlahpembayaran' => $jumlahpembayaran,
                'statuskonfirmasi' => $statuskonfirmasi,
                'tglkonfirmasi' => $tglkonfirmasi,
                'idkonfirmasi' => $idkonfirmasi,                
            );

            $simpan = $this->Pembayaran_model->update($data, $idpembayaran);
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
        $result                 = $this->Pembayaran_model->getById($primaryKey)->row();

        $data = array(
            'idpembayaran' => $result->idpembayaran, 
            'tglpembayaran' => date('Y-m-d', strtotime($result->tglpembayaran)) . 'T' . date('H:i:s', strtotime($result->tglpembayaran)), 
            'keterangan' => $result->keterangan, 
            'idpemesanan' => $result->idpemesanan, 
            'metodepembayaran' => $result->metodepembayaran, 
            'idbank' => $result->idbank, 
            'fotobuktipembayaran' => $result->fotobuktipembayaran, 
            'jumlahpembayaran' => $result->jumlahpembayaran, 
            'statuskonfirmasi' => $result->statuskonfirmasi, 
            'tglkonfirmasi' => $result->tglkonfirmasi, 
            'idkonfirmasi' => $result->idkonfirmasi, 
        );

        echo(json_encode($data));
    }

    function getData()
    {
        $data       = $this->Pembayaran_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = 'ID.'.$row->idpembayaran.'<br>'.formatHariTanggal($row->tglpembayaran);

            $arr[] = '<a href="'.base_url('Pemesanan/konfirmasi/'.$this->encrypt->encode($row->idpemesanan)).'" class="btn btn-info btn-xs btn-block" style="padding:0px; margin:0px; font-size:12px !important" target="_blank">
                        IVC-'.$row->idpemesanan.'<br>'.formatHariTanggal($row->tglpemesanan).'
                    </a>';
            
            $arr[] = 'ID.'.$row->idpelanggan.'<br>'.$row->namapelanggan;
            $arr[] = 'Rp. '.number_format($row->totalharga);

            $arr[] = $row->metodepembayaran;
            $arr[] = $row->namabank.'<br>'.$row->atasnama;
            $arr[] = 'Rp. '.number_format($row->jumlahpembayaran);
            
            if ($row->statuskonfirmasi == 'Dikonfirmasi') {
                $statuskonfirmasi = '<span class="badge badge-success">Dikonfirmasi</span>';
            }elseif ($row->statuskonfirmasi == 'Ditolak') {
                $statuskonfirmasi = '<span class="badge badge-danger">Ditolak</span>';
            }else{
                $statuskonfirmasi = '<span class="badge badge-warning">Menunggu</span>';
            }
            $arr[] = $statuskonfirmasi;
            
            if ($row->statuskonfirmasi == 'Dikonfirmasi' || $row->statuskonfirmasi == 'Ditolak') {
                $konfirmasi = formatHariTanggal($row->tglkonfirmasi).'<br>'.$row->namapengguna;
            }else{
                $konfirmasi = '';
            }
            $arr[] = $konfirmasi;
            

            $arr[]  = '
                        <a href="'.site_url( $this->controller.'/edit/'.$this->encrypt->encode($row->idpembayaran) ).'" class="btn btn-sm btn-success btn-circle" title="Edit Data">
                            <i class="fa fa-check"></i>
                        </a>  
                     
                        <a href="'.site_url( $this->controller.'/hapus/'.$this->encrypt->encode($row->idpembayaran) ).'" class="btn btn-sm btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pembayaran_model->count_all(),
            "recordsFiltered" => $this->Pembayaran_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }

    public function getPemesanan()
    {
        $idpemesanan = $this->input->post('idpemesanan');
        $queryPemesanan = $this->db->query("SELECT * FROM v_pemesanan WHERE idpemesanan='$idpemesanan' ");
        if ($queryPemesanan->num_rows() > 0) {
            $rowPemesanan = $queryPemesanan->row();

            $sisapembayaran = $rowPemesanan->totalharga - $rowPemesanan->totalpembayaran;
            $data = array(
                'totalpembayaran' => number_format($rowPemesanan->totalpembayaran),
                'sisapembayaran' => number_format($sisapembayaran)
            );
            echo(json_encode($data));
        }else{
            $data = array(
                'totalpembayaran' => 0,
                'sisapembayaran' => 0
            );
            echo(json_encode($data));
        }

    }
    // END AJAX


}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
