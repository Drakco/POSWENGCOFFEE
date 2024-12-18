<?php  

$string = '
<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

class Dashboard extends CI_Controller {

	var $controller     = \'Dashboard\'; 
    var $loadViewList   = \'dashboard\';

    var $menu			= \'Dashboard\';


    public function __construct()
    {
        parent::__construct();
        $this->isLogin();
        $this->load->model(\'Dashboard_model\');
    }

    public function isLogin()
    {
        $idpengguna = $this->session->userdata(\'idpengguna\');
        if (empty($idpengguna)) {
            $pesan = \'
                        <script type="text/javascript">
                          Swal.fire(
                          "Gagal !",
                          "Session telah berakhir. Silahkan login kembali . . . ",
                          "error"
                        );
                        </script>
                        \';
            $this->session->set_flashdata(\'pesan\', $pesan);
            redirect(\'Login\'); 
            exit();
        }
    }

    public function index()
    {
    	$data[\'menu\'] = $this->menu;
        $data[\'controller\'] = $this->controller;
        $this->load->view($this->loadViewList, $data);
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */

';


$hasil_controller = createFile($string, $target . "controllers/Dashboard.php");
?>