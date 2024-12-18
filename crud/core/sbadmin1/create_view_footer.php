<?php 

$string = '
  <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid">
              <div class="d-flex align-items-center justify-content-between small">
                  <div class="text-muted">Copyright &copy; Your Website 2019</div>
                  <div>
                      <a href="#">Privacy Policy</a>
                      &middot;
                      <a href="#">Terms &amp; Conditions</a>
                  </div>
              </div>
          </div>
      </footer>
  </div>
  </div>
  <script src="<?php echo(base_url(\'assets/jquery/jquery-3.4.1.min.js\')) ?>" crossorigin="anonymous"></script>
  <script src="<?php echo(base_url(\'assets/bootstrap/bootstrap.bundle.min.js\')) ?>" crossorigin="anonymous"></script>
  <script src="<?php echo(base_url(\'assets/sbadmin1/dist/js/scripts.js\')) ?>"></script>
    


  <!-- datatables -->
  <!-- <script src="<?php echo(base_url(\'assets/jquerydatatable/jquery.dataTables.min.js\')) ?>"></script> -->
  <script src="<?php echo(base_url(\'assets/datatables/js/jquery.dataTables.min.js\')) ?>"></script>
  
  <!-- bootbox -->
  <script type="text/javascript" src="<?php echo base_url(\'assets/bootbox/bootbox.js\'); ?>"></script>
  
  <!-- jquery-mask -->
  <script type="text/javascript" src="<?php echo base_url(\'assets/jquery_mask/jquery.mask.js\') ?>"></script>

  <!-- Bootstrap validator -->
  <script src="<?php echo(base_url(\'assets/bootstrap-validator/js/bootstrapValidator.js\')) ?>"></script>

  <!-- jquery-ui -->
  <script src="<?php echo(base_url(\'assets/jquery-ui/jquery-ui-2.js\')) ?>"></script>
  
  <!-- Sweat Alert -->
  <script src="<?php echo(base_url(\'assets/sweatalert/sweatalert.js\')) ?>"></script>

  <script src="<?php echo(base_url(\'assets/fa/fa.min.js\')); ?>"></script>





<script>
    const numberWithCommas = (x) => {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }  

    const untitik = (i) => {
        return typeof i === \'string\' ?
                            i.replace(/[\$,]/g, \'\')*1 :
                            typeof i === \'number\' ?
                                i : 0;
    }

    function AllowOnlyNumbers(e) {

      e = (e) ? e : window.event;
      var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
      var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
      var str = (e.type && e.type == "paste") ? clipboardData.getData(\'Text\') : String.fromCharCode(key);

      return (/^\d+$/.test(str));
    }
   
</script>

</body>
</html>


';

$hasil_view_list = createFile($string, $target."views/template/footer.php");

?>

	