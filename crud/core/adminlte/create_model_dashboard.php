<?php 

$string = '<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

class Dashboard_model extends CI_Model {

  public function tampil()
  {
    
  } 

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */


';



$hasil_view_form = createFile($string, $target.'models/Dashboard_model.php');

?>