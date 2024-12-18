<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    var $controller     = 'Produk';
    var $loadViewList   = 'produk/list';
    var $loadViewForm   = 'produk/form';

    var $formNameHead   = 'Produk';
    var $formNameData   = 'Data Produk';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Produk';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Produk_model');

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
        if ($this->Produk_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Produk_model->getById($primaryKey)->num_rows() == 0) {
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
        $data['button']         = 'Detil';

        $data['dataId'] = $this->Produk_model->getById($primaryKey)->row();
        $this->load->view('produk/detil', $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Produk_model->getById($primaryKey)->num_rows() == 0) {
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

        $qrcode = $this->db->query("SELECT qrcode FROM produk WHERE idproduk='$primaryKey' ")->row()->qrcode;
        $hapus = $this->Produk_model->delete($primaryKey);
        if ($hapus) {
            $pesan = $this->pesan(TRUE, 'Hapus');
            unlink('uploads/qrcode/' . $qrcode . '.png');
        } else {
            $pesan = $this->pesan(FALSE, 'Gagal');
        }

        $this->session->set_flashdata('pesan', $pesan);
        redirect($this->controller);
    }

    public function simpan()
    {

        $idproduk = $this->input->post('idproduk');
        $idkategori = $this->input->post('idkategori');
        $namaproduk = $this->input->post('namaproduk');
        $keterangan = $this->input->post('keterangan');
        $satuan = $this->input->post('satuan');
        $stok = untitik($this->input->post('stok'));
        $stokminimum = untitik($this->input->post('stokminimum'));
        $hargabeli = untitik($this->input->post('hargabeli'));
        $hargajual = untitik($this->input->post('hargajual'));

        if ($this->input->post('statusaktif')) {
            $statusaktif = $this->input->post('statusaktif');
        } else {
            $statusaktif = "Tidak Aktif";
        }

        $urisegment = str_replace(' ', '-', strtolower($this->input->post('namaproduk')));

        if ($idproduk == '') {

            $idproduk = $this->db->query("SELECT f_idproduk_create() AS idproduk")->row()->idproduk;
            $foto = $this->upload_file($_FILES, "file");

            $qrcode = $idkategori . $idproduk;

            $this->load->library('ciqrcode');

            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = 'uploads/qrcode/'; //string, the default is application/cache/
            $config['errorlog']     = 'uploads/qrcode/'; //string, the default is application/logs/
            $config['imagedir']     = 'uploads/qrcode/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name = $qrcode . '.png'; //buat name dari qr code sesuai dengan nim

            $params['data'] = $qrcode; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


            $data = array(
                'idproduk' => $idproduk,
                'idkategori' => $idkategori,
                'namaproduk' => $namaproduk,
                'keterangan' => $keterangan,
                'satuan' => $satuan,
                'stok' => $stok,
                'stokminimum' => $stokminimum,
                'hargabeli' => $hargabeli,
                'hargajual' => $hargajual,
                'foto' => $foto,
                'statusaktif' => $statusaktif,
                'qrcode' => $qrcode,
                'urisegment' => $urisegment,
            );

            $simpan = $this->Produk_model->insert($data);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Simpan');
            } else {
                $pesan = $this->pesan(TRUE, 'Gagal');
            }
        } else {

            $file_lama = $this->input->post('file_lama');
            $foto = $this->update_upload_file($_FILES, "file", $file_lama);

            $data = array(
                'idkategori' => $idkategori,
                'namaproduk' => $namaproduk,
                'keterangan' => $keterangan,
                'satuan' => $satuan,
                'stok' => $stok,
                'stokminimum' => $stokminimum,
                'hargabeli' => $hargabeli,
                'hargajual' => $hargajual,
                'foto' => $foto,
                'statusaktif' => $statusaktif,
                'urisegment' => $urisegment,
            );

            $simpan = $this->Produk_model->update($data, $idproduk);
            if ($simpan) {
                $pesan = $this->pesan(TRUE, 'Update');
            } else {
                $pesan = $this->pesan(FALSE, 'Gagal');
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
        $result                 = $this->Produk_model->getById($primaryKey)->row();

        $data = array(
            'idproduk' => $result->idproduk,
            'idkategori' => $result->idkategori,
            'namaproduk' => $result->namaproduk,
            'keterangan' => $result->keterangan,
            'satuan' => $result->satuan,
            'stok' => $result->stok,
            'stokminimum' => $result->stokminimum,
            'hargabeli' => number_format($result->hargabeli),
            'hargajual' => number_format($result->hargajual),
            'foto' => $result->foto,
            'statusaktif' => $result->statusaktif,
            'qrcode' => $result->qrcode,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Produk_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        $level = $this->session->userdata('level');

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;

            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">Aktif</span>';
            } else {
                $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
            }
            $arr[] = $row->idproduk . '<br>' . $statusaktif;

            if ($row->foto == '') {
                $arr[] = '<img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('images/nofoto.png') . '">';
            } else {
                $arr[] = '<a href="' . base_url('uploads/' . $row->foto) . '" target="_blank"><img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('uploads/' . $row->foto) . '"></a>';
            }

            $arr[] = $row->namakategori;
            $arr[] = $row->namaproduk;
            $arr[] = number_format($row->stok) . ' / ' . $row->satuan;
            $arr[] = 'Rp. ' . number_format($row->hargabeli);
            $arr[] = 'Rp. ' . number_format($row->hargajual);


            if ($row->qrcode == '') {
                $arr[] = '<img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('images/nofoto.png') . '">';
            } else {
                $arr[] = '<a href="' . base_url('uploads/qrcode/' . $row->qrcode) . '.png" target="_blank"><img class="img-thumbnail" style="height: auto; width: 60px;" src="' . base_url('uploads/qrcode/' . $row->qrcode) . '.png"></a>';
            }


            if ($level != 'Sales') {
                $arr[]  = '
                            <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idproduk)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                <i class="fa fa-eye"></i>
                            </a> 
                            <a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idproduk)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
                                <i class="fa fa-edit"></i>
                            </a> 
                            <a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idproduk)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
                                <i class="fa fa-trash"></i>
                            </a>';
            } else {
                $arr[]  = '
                            <a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idproduk)) . '" class="btn btn-xs btn-info btn-circle" title="Detil Data">
                                <i class="fa fa-eye"></i>
                            </a>';
            }

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Produk_model->count_all(),
            "recordsFiltered" => $this->Produk_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }

    function getDataPenjualan()
    {
        $this->db->where('statusaktif', 'Aktif');
        $data       = $this->Produk_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;

            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">Aktif</span>';
            } else {
                $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
            }
            $arr[] = $row->idproduk . '<br>' . $statusaktif;

            $arr[] = $row->namakategori;
            $arr[] = $row->namaproduk;
            $arr[] = number_format($row->stok);
            $arr[] = $row->satuan;
            $arr[] = 'Rp. ' . number_format($row->hargabeli);
            $arr[] = 'Rp. ' . number_format($row->hargajual);


            $arr[]  = '
                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-circle" title="Pilih Data" data-qrcode="' . $row->qrcode . '" id="pilihProduk">
                            <i class="fa fa-check"></i> Pilih
                        </a>
                    ';

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Produk_model->count_all(),
            "recordsFiltered" => $this->Produk_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }
    // END AJAX


}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
