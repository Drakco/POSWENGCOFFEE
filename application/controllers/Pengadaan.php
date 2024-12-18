<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengadaan extends CI_Controller
{

    var $controller     = 'Pengadaan';
    var $loadViewList   = 'pengadaan/list';
    var $loadViewForm   = 'pengadaan/form';

    var $formNameHead   = 'Pengadaan';
    var $formNameData   = 'Data Pengadaan';
    var $formNameAdd    = 'Form Tambah Data';
    var $formNameEdit   = 'Form Edit Data';

    var $menu           = 'Pengadaan';

    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model('Pengadaan_model');

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
        if ($this->Pengadaan_model->getById($primaryKey)->num_rows() == 0) {
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
        if ($this->Pengadaan_model->getById($primaryKey)->num_rows() == 0) {
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

        $data['dataId'] = $this->Pengadaan_model->getById($primaryKey)->row();
        $this->load->view('pengadaan/detil', $data);
    }

    public function hapus($primaryKey)
    {
        $primaryKey = $this->encrypt->decode($primaryKey);
        if ($this->Pengadaan_model->getById($primaryKey)->num_rows() == 0) {
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

        $hapus = $this->Pengadaan_model->delete($primaryKey);
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

        $idpengadaan = $this->input->post('idpengadaan');
        $tglpengadaan = date('Y-m-d', strtotime($this->input->post('tglpengadaan')));
        $idsupplier = $this->input->post('idsupplier');
        $keterangan = $this->input->post('keterangan');
        $tglinsert = date('Y-m-d H:i:s');
        $tglupdate = date('Y-m-d H:i:s');
        $idpengguna = $this->session->userdata('idpengguna');
        $statuskonfirmasi = "Menunggu";
        $tglkonfirmasi = NULL;
        $idkonfirmasi = NULL;

        $isidatatable = $this->input->post('isidatatable');

        if ($idpengadaan == '') {

            $idpengadaan = $this->db->query("SELECT f_idpengadaan_create('" . date('Y-m-d') . "') AS idpengadaan")->row()->idpengadaan;

            $data = array(
                'idpengadaan' => $idpengadaan,
                'tglpengadaan' => $tglpengadaan,
                'idsupplier' => $idsupplier,
                'keterangan' => $keterangan,
                'tglinsert' => $tglinsert,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
                'statuskonfirmasi' => $statuskonfirmasi,
                'tglkonfirmasi' => $tglkonfirmasi,
                'idkonfirmasi' => $idkonfirmasi,
            );

            $dataDetail = array();
            foreach ($isidatatable as $item) {
                $idproduk              = $item[1];
                $qty                   = $item[5];
                $harga                 = $item[4];
                $totalharga            = $item[6];

                $dataDetailTemp = array(
                    'idpengadaan'           => $idpengadaan,
                    'idproduk'              => $idproduk,
                    'qty'                   => untitik($qty),
                    'harga'                 => untitik($harga),
                    'totalharga'            => untitik($totalharga),
                );

                array_push($dataDetail, $dataDetailTemp);
            }

            $simpan = $this->Pengadaan_model->insert($data, $dataDetail);
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
                'tglpengadaan' => $tglpengadaan,
                'idsupplier' => $idsupplier,
                'keterangan' => $keterangan,
                'tglupdate' => $tglupdate,
                'idpengguna' => $idpengguna,
            );

            $dataDetail = array();
            foreach ($isidatatable as $item) {
                $idproduk          = $item[1];
                $qty               = $item[5];
                $harga             = $item[4];
                $totalharga        = $item[6];

                $dataDetailTemp = array(
                    'idpengadaan'   => $idpengadaan,
                    'idproduk'      => $idproduk,
                    'qty'           => untitik($qty),
                    'harga'         => untitik($harga),
                    'totalharga'    => untitik($totalharga),
                );

                array_push($dataDetail, $dataDetailTemp);
            }

            $simpan = $this->Pengadaan_model->update($data, $idpengadaan, $dataDetail);
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


    public function konfirmasi()
    {
        $idpengadaan = $this->input->post('idpengadaan');
        $idsupplier = $this->input->post('idsupplier');
        $tglkonfirmasi = date('Y-m-d H:i:s');
        $idkonfirmasi = $this->session->userdata('idpengguna');
        $statuskonfirmasi = $this->input->post('statuskonfirmasi');

        $data = array(
            'idsupplier' => $idsupplier,
            'statuskonfirmasi' => $statuskonfirmasi,
            'tglkonfirmasi' => $tglkonfirmasi,
            'idkonfirmasi' => $idkonfirmasi,
        );

        $idproduk = $this->input->post('idproduk');
        $qty = $this->input->post('qty');
        $qtykonfirmasi = $this->input->post('qtykonfirmasi');
        $harga = $this->input->post('harga');

        $dataDetail = array();
        $count = count($idproduk);

        $idpembelian = $this->db->query("SELECT f_idpembelian_create('" . date('Y-m-d') . "') AS idpembelian")->row()->idpembelian;
        $dataPembelian = array(
            'idpembelian' => $idpembelian,
            'tglpembelian' => date('Y-m-d'),
            'nostruk' => $idpengadaan,
            'keterangan' => "Pengadaan dari ID. " . $idpengadaan . ', Tgl. Konfirmasi ' . formatHariTanggal(date('Y-m-d')) . ' Jam : ' . date('H:i:s'),
            'foto' => NULL,
            'idsupplier' => $idsupplier,
            'idpengguna' => $this->session->userdata('idpengguna'),
            'tglinsert' => date('Y-m-d H:i:s'),
            'tglupdate' => date('Y-m-d H:i:s'),
            'idpengadaan' => $idpengadaan,
        );

        for ($i = 0; $i < $count; $i++) {

            $totalharga = $harga[$i] * $qtykonfirmasi[$i];
            $dataTemp = array(
                'idpembelian' => $idpembelian,
                'idproduk' => $idproduk[$i],
                'qty' => $qtykonfirmasi[$i],
                'harga' => $harga[$i],
                'totalharga' => $totalharga,
            );
            array_push($dataDetail, $dataTemp);
        }

        $simpan = $this->Pengadaan_model->konfirmasi($data, $dataPembelian, $dataDetail, $idpengadaan, $statuskonfirmasi);
        if ($simpan) {
            $pesan = $this->pesan(TRUE, 'Update');
        } else {
            $pesan = $this->pesan(TRUE, 'Gagal');
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
        $result                 = $this->Pengadaan_model->getById($primaryKey)->row();

        $data = array(
            'idpengadaan' => $result->idpengadaan,
            'tglpengadaan' => $result->tglpengadaan,
            'idsupplier' => $result->idsupplier,
            'keterangan' => $result->keterangan,
            'tglinsert' => $result->tglinsert,
            'tglupdate' => $result->tglupdate,
            'idpengguna' => $result->idpengguna,
            'statuskonfirmasi' => $result->statuskonfirmasi,
            'tglkonfirmasi' => $result->tglkonfirmasi,
            'idkonfirmasi' => $result->idkonfirmasi,
        );

        echo (json_encode($data));
    }

    function getData()
    {
        $data       = $this->Pengadaan_model->get_datatables();
        $dataArr    = array();
        $no         = $_POST['start'];

        $level = $this->session->userdata('level');

        foreach ($data as $row) {
            $no++;
            $arr = array();

            $arr[] = $no;
            $arr[] = $row->idpengadaan;

            $arr[] = formatHariTanggal(date('Y-m-d', strtotime($row->tglpengadaan)));
            $arr[] = $row->namasupplier;
            $arr[] = $row->keterangan;
            $arr[] = 'Rp. ' . number_format($row->totalharga);
            $arr[] = '<small>
				' . $row->namapengguna . ' <br>
				' . formatHariTanggal(date('Y-m-d', strtotime($row->tglupdate))) . ' Jam ' . date('H:i:s', strtotime($row->tglupdate)) . '
			</small>';

            if ($row->statuskonfirmasi == 'Dikonfirmasi') {
                $statuskonfirmasi = '<span class="badge badge-success">Dikonfirmasi<span>';
            } elseif ($row->statuskonfirmasi == 'Ditolak') {
                $statuskonfirmasi = '<span class="badge badge-danger">Ditolak<span>';
            } else {
                $statuskonfirmasi = '<span class="badge badge-warning">Menunggu<span>';
            }
            $arr[] = $statuskonfirmasi;

            if (!empty($row->idkonfirmasi)) {
                $idkonfirmasi = '<small>
				' . $row->namakonfirmasi . ' <br>
				' . formatHariTanggal(date('Y-m-d', strtotime($row->tglkonfirmasi))) . ' Jam ' . date('H:i:s', strtotime($row->tglkonfirmasi)) . '
			</small>';
            } else {
                $idkonfirmasi = '-';
            }

            $arr[] = $idkonfirmasi;


            if ($level == 'Pimpinan') {
                if ($row->statuskonfirmasi == 'Dikonfirmasi') {
                    $arr[]  = '
							<a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-info btn-circle" title="Konfirmasi Data">
								<i class="fa fa-eye"></i>
							</a>';
                } else {
                    $arr[]  = '
								<a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-success btn-circle" title="Konfirmasi Data">
									<i class="fa fa-check"></i>
								</a>
								<a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
									<i class="fa fa-edit"></i>
								</a>  
								<a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
									<i class="fa fa-trash"></i>
								</a>';
                }
            } else {

                if ($row->statuskonfirmasi == 'Dikonfirmasi') {
                    $arr[]  = '
								<a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-info btn-circle" title="Konfirmasi Data">
									<i class="fa fa-eye"></i>
								</a>';
                } else {
                    $arr[]  = '
								<a href="' . site_url($this->controller . '/detil/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-info btn-circle" title="Konfirmasi Data">
									<i class="fa fa-eye"></i>
								</a>
								<a href="' . site_url($this->controller . '/edit/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-warning btn-circle" title="Edit Data">
									<i class="fa fa-edit"></i>
								</a>  
								<a href="' . site_url($this->controller . '/hapus/' . $this->encrypt->encode($row->idpengadaan)) . '" class="btn btn-xs btn-danger btn-circle" id="hapus" title="Hapus Data">
									<i class="fa fa-trash"></i>
								</a>';
                }
            }

            array_push($dataArr, $arr);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pengadaan_model->count_all(),
            "recordsFiltered" => $this->Pengadaan_model->count_filtered(),
            "data" => $dataArr,
        );

        echo json_encode($output);
    }

    public function getProduk()
    {
        $idproduk = $this->input->post('idproduk');
        $qty      = untitik($this->input->post('qty'));

        $query = $this->db->query("SELECT * FROM v_produk WHERE idproduk='$idproduk' ");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $totalharga = $qty * $row->hargabeli;

            $data = array(
                'idproduk'              => $row->idproduk,
                'namaproduk'            => '<b>' . $row->namaproduk . '</b><br> Satuan : ' . $row->satuan,
                'namakategori'          => $row->namakategori,
                'hargabeli'             => $row->hargabeli,
                'qty'                   => $qty,
                'totalharga'            => $totalharga
            );
        } else {
            $data = array();
        }

        echo (json_encode($data));
    }

    public function datatablesourcedetail()
    {
        $idpengadaan = $this->input->post('idpengadaan');
        $data          = array();

        $query = $this->db->query("SELECT * FROM v_pengadaan_detil WHERE idpengadaan='$idpengadaan' ");
        $no    = 1;
        $i     = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $dataTemp = array(
                    $no++,
                    $row->idproduk,
                    '<b>' . $row->namaproduk . '</b><br> Satuan : ' . $row->satuan,
                    $row->namakategori,
                    number_format($row->harga),
                    number_format($row->qty),
                    number_format($row->totalharga),
                    '<span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>',
                );
                array_push($data, $dataTemp);

                $i++;
            }
        }

        $output = array(
            'data' => $data,
        );

        echo (json_encode($output));
    }
    // END AJAX


}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */
