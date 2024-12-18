<?php  

$string = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->is_login();
		
		//Do your magic here
	}


	public function is_login()
    {
        $username = $this->session->userdata("username");
        if (empty($username)) {
            $pesan = \'<div class="alert alert-danger">Session telah berakhir. Silahkan login kembali . . . </div>\';
            $this->session->set_flashdata("pesan", $pesan);
            redirect("Login"); 
            exit();
        }
    }	

	public function index()
	{
		$data["menu"] = "Home";	
		$this->load->view("home", $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */';


$hasil_controller = createFile($string, $target . "controllers/Home.php");
?>