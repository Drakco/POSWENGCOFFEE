<?php

$string = "<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class " . $c . " extends CI_Controller {

    var \$controller     = '".$c."'; 
    var \$loadViewList   = '".$c_url."/list';
    var \$loadViewForm   = '".$c_url."/form';

    var \$formNameHead   = '".$c."';
    var \$formNameData   = 'Data ".$c."';
    var \$formNameAdd    = 'Form Tambah Data';
    var \$formNameEdit   = 'Form Edit Data';


    public function __construct()
    {
        parent::__construct();
        \$this->load->model('".$m."');
    
        \$config['upload_path']          = 'uploads/';
        \$config['allowed_types']        = 'gif|jpg|jpeg|png';
        \$config['max_size']             = '2000000KB'; // 200KB
        \$config['quality']              = '50%';
        \$config['remove_space']         = TRUE;

        \$this->load->library('upload', \$config);
        \$this->load->library('image_lib');
    }

    public function index()
    {
        \$data['controller']     = \$this->controller;
        \$data['formNameHead']   = \$this->formNameHead;
        \$data['formNameData']   = \$this->formNameData;
        \$this->load->view(\$this->loadViewList, \$data);
    }

    public function tambah()
    {
        \$data['primaryKey']     = '';
        
        \$data['controller']     = \$this->controller;
        \$data['formNameHead']   = \$this->formNameHead;
        \$data['formNameData']   = \$this->formNameData;
        \$data['formName']       = \$this->formNameAdd;
        \$data['button']         = 'Simpan';
        \$this->load->view(\$this->loadViewForm, \$data);
    }

    public function edit(\$primaryKey)
    {
        \$data['primaryKey']     = \$primaryKey;

        \$data['controller']     = \$this->controller;
        \$data['formNameHead']   = \$this->formNameHead;
        \$data['formNameData']   = \$this->formNameData;
        \$data['formName']       = \$this->formNameEdit;
        \$data['button']         = 'Update';
        \$this->load->view(\$this->loadViewForm, \$data);
    }

    public function hapus(\$primaryKey)
    {
        \$hapus = \$this->".$m."->delete(\$primaryKey);
        if (\$hapus) {
            \$pesan = \$this->pesan(TRUE, 'Hapus');
        }else{
            \$pesan = \$this->pesan(FALSE, 'Gagal');
        }

        \$this->session->set_flashdata('pesan', \$pesan);
        redirect(\$this->controller);
    }

    public function simpan()
    {

        \$".$pk." = \$this->input->post('".$pk."');";

foreach ($non_pk as $row) {

$string .= "
        \$".$row['column_name']." = \$this->input->post('".$row['column_name']."');";

}

$string .="

        if (\$".$pk." == '') {
            
            //  \$".$pk." = \$this->db->query(\"SELECT f_".$pk."_create() AS ".$pk."\")->row()->".$pk.";
            //  \$foto = \$this->upload_file(\$_FILES, \"file\");

            \$data = array(
                // '".$pk."' => \$".$pk.", ";

foreach ($non_pk as $row) {

$string .="
                '".$row['column_name']."' => \$".$row['column_name'].",";

}

$string .="
            );

            \$simpan = \$this->".$m."->insert(\$data);
            if (\$simpan) {
                \$pesan = \$this->pesan(TRUE, 'Simpan');
            }else{
                \$pesan = \$this->pesan(TRUE, 'Gagal');
            }

        }else{

            //  \$file_lama = \$this->input->post('file_lama');
            //  \$foto = \$this->update_upload_file(\$_FILES, \"file\", \$file_lama);

            \$data = array(";

foreach ($non_pk as $row) {

$string .="
                '".$row['column_name']."' => \$".$row['column_name'].",";

}

$string .="                
            );

            \$simpan = \$this->".$m."->update(\$data, \$".$pk.");
            if (\$simpan) {
                \$pesan = \$this->pesan(TRUE, 'Update');
            }else{
                \$pesan = \$this->pesan(TRUE, 'Gagal');
            }
        }

        \$this->session->set_flashdata('pesan', \$pesan);
        redirect(\$this->controller);

    }

    public function pesan(\$boolean, \$pesan)
    {
        if (\$boolean) {
            \$output = '
                        <script type=\"text/javascript\">
                          Swal.fire(
                          \"Berhasil !\",
                          \"Data Berhasil Di '.\$pesan.' !\",
                          \"success\"
                        );
                        </script>
                        ';
        }else{
            \$eror = \$this->db->error();         
            \$output = '
                        <script type=\"text/javascript\">
                          Swal.fire(
                          \"Gagal !\",
                          \"Pesan Error : '.\$eror['code'].' '.\$eror['message'].'\",
                          \"error\"
                        );
                        </script>
                        ';
        }
        return \$output;
    }

    // UPLOAD FILE
    public function upload_file(\$file, \$nama)
    {
        if (!empty(\$file[\$nama]['tmp_name'])) {
            if (\$this->upload->do_upload(\$nama)) {
                \$file = \$this->upload->data('file_name');
                \$size = \$this->upload->data('file_size');
                \$ext  = \$this->upload->data('file_ext');

                \$this->resize_foto(\$this->upload->data());

             }else{
                 \$file = \"\";
             }
        }else{
            \$file = \"\";
        }
        return \$file;
    }

    public function update_upload_file(\$file, \$nama, \$file_lama)
    {
        if (!empty(\$file[\$nama]['tmp_name'])) {
            if (\$this->upload->do_upload(\$nama)) {
                \$file = \$this->upload->data('file_name');
                \$size = \$this->upload->data('file_size');
                \$ext  = \$this->upload->data('file_ext');

                \$this->resize_foto(\$this->upload->data());

             }else{
                \$file = \$file_lama;
             }
        }else{
            \$file = \$file_lama;
        }
        return \$file;
    }

    public function resize_foto(\$data)
    {
        \$config['image_library'] = 'gd2';
        \$config['source_image'] = 'uploads/'.\$data['file_name'];
        \$config['create_thumb'] = FALSE;
        \$config['maintain_ratio'] = FALSE;
        \$config['quality'] = '70';
        \$config['width'] = 600;
        \$config['height'] = 480;
        \$config['new_image'] = 'uploads/'.\$data['file_name'];

        \$this->image_lib->clear();
        \$this->image_lib->initialize(\$config);              
        \$this->image_lib->resize();
    }
    // END UPLOAD FILE

    // AJAX
    public function getEditData()
    {
        \$primaryKey             = \$this->input->post('primaryKey');
        \$result                 = \$this->".$m."->getById(\$primaryKey)->row();

        \$data = array(";
foreach ($all as $row) {

$string .="
            '".$row['column_name']."' => \$result->".$row['column_name'].", ";
}

$string .="
        );

        echo(json_encode(\$data));
    }

    function getData()
    {
        \$data       = \$this->".$m."->get_datatables();
        \$dataArr    = array();
        \$no         = \$_POST['start'];

        foreach (\$data as \$row) {
            \$no++;
            \$arr = array();

            \$arr[] = \$no;
";

foreach ($non_pk as $row) {

$string .= "
            \$arr[] = \$row->".$row['column_name'].";";

}

$string .= "
            
            // if ($row->foto == '') {
            //  \$arr[] = '<img class=\"img-thumbnail\" style=\"height: 100px; width: 100px;\" src=\"'. base_url('images/nofoto_l.png') .'\">';
            // }else{
            //  \$arr[] = '<img class=\"img-thumbnail\" style=\"height: 100px; width: 100px;\" src=\"'. base_url('./uploads/'.$row->foto) .'\">';
            // }

            \$arr[]  = '
                        <a href=\"'.site_url( \$this->controller.'/edit/'.\$row->".$pk." ).'\" class=\"btn btn-sm btn-warning btn-circle\" title=\"Edit Data\">
                            <i class=\"fa fa-edit\"></i>
                        </a>  
                     
                        <a href=\"'.site_url( \$this->controller.'/hapus/'.\$row->".$pk." ).'\" class=\"btn btn-sm btn-danger btn-circle\" id=\"hapus\" title=\"Hapus Data\">
                            <i class=\"fa fa-trash\"></i>
                        </a>';
 
            array_push(\$dataArr, \$arr);
        }
 
        \$output = array(
            \"draw\" => \$_POST['draw'],
            \"recordsTotal\" => \$this->".$m."->count_all(),
            \"recordsFiltered\" => \$this->".$m."->count_filtered(),
            \"data\" => \$dataArr,
        );

        echo json_encode(\$output);
    }
    // END AJAX


}

/* End of file ".$c.".php */
/* Location: ./application/controllers/".$c.".php */";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>