<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    var $controller     = 'Pemesanan'; 
    var $loadViewList   = 'pemesanan/list';
    var $loadViewForm   = 'pemesanan/form';

    var $formNameHead   = 'Pemesanan';
    var $formNameData   = 'Data Pemesanan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Konfirmasi Data';

    var $menu           = 'Pemesanan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Pemesanan_model');
    
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

    public function konfirmasi($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Pemesanan_model->getById($primaryKey)->num_rows() == 0) {
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
        $data['dataID']         = $this->Pemesanan_model->getById($primaryKey)->row();
        $data['dataDetail']     = $this->db->query("SELECT * FROM v_pemesanandetil WHERE idpemesanan='$primaryKey' ORDER BY namaproduk ASC");

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
        if ($this->Pemesanan_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Pemesanan_model->delete($primaryKey);
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
        $primaryKey = $this->input->post('primaryKey');

        $informasipemesanan = $this->input->post('informasipemesanan');
        $noresi = $this->input->post('noresi');
        $idpengguna         = $this->session->userdata('idpengguna');

        $data = array(
            'informasipemesanan' => $informasipemesanan,
            'noresi' => $noresi,
            'idkonfirmasi' => $idpengguna,
        );

        $update = $this->Pemesanan_model->update($data, $primaryKey);
        if ($update) {
            $output = array(
                'status' => true,
                'msg'    => 'Informasi Berhasil Dikirim . . . ',
            );
        } else {
            $output = array(
                'status' => false,
                'msg'    => 'Data Informasi Gagal Dikirim . . . ',
            );
        }

        echo (json_encode($output));
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
        $result                 = $this->Pemesanan_model->getById($primaryKey)->row();

        $data = array(
            'idpemesanan' => $result->idpemesanan, 
            'tglpemesanan' => $result->tglpemesanan, 
            'keterangan' => $result->keterangan, 
            'idpelanggan' => $result->idpelanggan, 
            'negara' => $result->negara, 
            'provinsi' => $result->provinsi, 
            'kabupaten' => $result->kabupaten, 
            'kecamatan' => $result->kecamatan, 
            'kelurahan' => $result->kelurahan, 
            'alamat' => $result->alamat, 
            'kodepos' => $result->kodepos, 
            'totalpembayaran' => $result->totalpembayaran, 
            'statuslunas' => $result->statuslunas, 
            'idkonfirmasi' => $result->idkonfirmasi, 
            'tglkonfirmasi' => $result->tglkonfirmasi, 
            'statuskonfirmasi' => $result->statuskonfirmasi, 
            'informasipemesanan' => $result->informasipemesanan, 
            'noresi' => $result->noresi, 
        );

        echo(json_encode($data));
    }

    function getData()
    {
        $data       = $this->Pemesanan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idpemesanan;

            $arr[] = formatHariTanggal($row->tglpemesanan).', Jam '.date('H:i', strtotime($row->tglpemesanan));
            $arr[] = 'ID. '.$row->idpelanggan.'<br>'.$row->namapelanggan;
            $arr[] = number_format($row->totalharga);
            $arr[] = number_format($row->totaltarif);
            
            $grandTotal = $row->totalharga + $row->totaltarif;
            $arr[] = number_format($grandTotal);
            $arr[] = number_format($row->totalpembayaran);
            
            if ($row->statuslunas == "Sudah Lunas") {
                $statuslunas = '<span class="badge badge-success">Sudah Lunas</span>';
            }else{
                $statuslunas = '<span class="badge badge-danger">Belum Lunas</span>';
            }
            $arr[] = $statuslunas;

            if ($row->statuskonfirmasi == 'Dikonfirmasi' OR $row->statuskonfirmasi == 'Ditolak') {
                $statuskonfirmasi = '
                    '.$row->namapengguna.' <br>
                    '.formatHariTanggal(date('Y-m-d', strtotime($row->tglkonfirmasi))).'
                ';
            }else{
                $statuskonfirmasi = '';
            }
            $arr[] = $statuskonfirmasi;
            
            if ($row->statuskonfirmasi == 'Dikonfirmasi') {
                $spanKonfirmasi = '<span class="badge badge-success">Dikonfirmasi</span>';
            }elseif ($row->statuskonfirmasi == 'Ditolak') {
                $spanKonfirmasi = '<span class="badge badge-danger">Di Tolak</span>';
            }else{
                $spanKonfirmasi = '<span class="badge badge-warning">Menunggu</span>';
            }
            $arr[] = $spanKonfirmasi;

            
            $arr[]  = '
                        <a href="'.site_url( $this->controller.'/konfirmasi/'.$this->encrypt->encode($row->idpemesanan) ).'" class="btn btn-xs btn-info btn-circle" title="Konfirmasi Data">
                            <i class="fa fa-check"></i>
                        </a>  
                     
                        <a href="'.site_url( $this->controller.'/hapus/'.$this->encrypt->encode($row->idpemesanan) ).'" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </a>';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pemesanan_model->count_all(),
            "recordsFiltered" => $this->Pemesanan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }

    function getDataPembayaran()
    {
        $this->db->where('statuskonfirmasi', 'Dikonfirmasi');
        $this->db->where('statuslunas', 'Belum Lunas');
        $data       = $this->Pemesanan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idpemesanan;

            $arr[] = formatHariTanggal($row->tglpemesanan).', Jam '.date('H:i', strtotime($row->tglpemesanan));
            $arr[] = 'ID. '.$row->idpelanggan.'<br>'.$row->namapelanggan;
            $arr[] = number_format($row->totalharga);
            $arr[] = number_format($row->totalpembayaran);
            
            if ($row->statuslunas == "Sudah Lunas") {
                $statuslunas = '<span class="badge badge-success">Sudah Lunas</span>';
            }else{
                $statuslunas = '<span class="badge badge-danger">Belum Lunas</span>';
            }
            $arr[] = $statuslunas;

            

            
            $arr[]  = '
                        <a href="javascript:void(0)" class="btn btn-sm btn-success btn-circle" title="Konfirmasi Data" id="add" 
                         data-idpemesanan="'.$row->idpemesanan.'"
                         data-totalharga="'.$row->totalharga.'"
                         data-totalpembayaran="'.$row->totalpembayaran.'"
                        >
                            <i class="fa fa-check"></i>
                        </a>

                        <a href="'.site_url( $this->controller.'/konfirmasi/'.$this->encrypt->encode($row->idpemesanan) ).'" class="btn btn-sm btn-info btn-circle" title="Lihat Data" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>  
                    ';
 
            array_push($dataArr, $arr);
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pemesanan_model->count_all(),
            "recordsFiltered" => $this->Pemesanan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }

    public function konfirmasi_update()
    {
        $primaryKey = $this->input->post('primaryKey');

        $konfirmasi      = $this->input->post('konfirmasi');
        $tglkonfirmasi   = date('Y-m-d H:i:s');
        $idpengguna      = $this->session->userdata('idpengguna');

        $data = array(
            'statuskonfirmasi'  => $konfirmasi,
            'tglkonfirmasi'    => $tglkonfirmasi,
            'idkonfirmasi'       => $idpengguna,
        );

        $update = $this->Pemesanan_model->konfirmasi($data, $primaryKey, $konfirmasi);
        if ($update) {
            $output = array(
                'status' => true,
                'msg'    => 'Data Berhasil ' . $konfirmasi,
            );
        } else {
            $output = array(
                'status' => false,
                'msg'    => 'Data Gagal ' . $konfirmasi,
            );
        }

        echo (json_encode($output));
    }
    // END AJAX


}

/* End of file Pemesanan.php */
/* Location: ./application/controllers/Pemesanan.php */
