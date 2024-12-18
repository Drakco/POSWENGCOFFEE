<?php 

$string = '
	<script src="<?php echo base_url("assets/js/jquery-1.11.2.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/datatables/jquery.dataTables.js") ?>"></script>
    <script src="<?php echo base_url("assets/datatables/dataTables.bootstrap.js") ?>"></script>
    <!-- easyautocomplete -->
	  <script src="<?php echo base_url("assets/easyautocomplete/jquery.easy-autocomplete.min.js"); ?>"></script>
	<!-- bootbos -->
  	<script src="<?php echo base_url("assets/bootstrap/js/bootbox.js"); ?>"></script>
  	<!-- chosen -->
  	<script src="<?php echo(base_url("assets/chosen/chosen.jquery.js")); ?>"></script>
  	<!-- jquery-mask -->
  	<script type="text/javascript" src="<?php echo base_url("assets/jquery_mask/jquery.mask.js"); ?>"></script>
    ';

$hasil_view_list = createFile($string, $target."views/template/footer.php");

?>

	