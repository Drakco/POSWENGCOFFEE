<?php 

    $string = '<?php 
            $this->load->view("template/header");
            $this->load->view("template/topmenu");
        ?>
        

        <div class="container">
            
            <div class="panel panel-default" id="panelbody">
                <div class="panel-body"> ';

$string .= "<h2 style=\"margin-top:0px\">SELAMAT DATANG</h2><hr>";

$string .='
            </div>
        </div>
    </div>


    <?php  
        $this->load->view("template/footer");
    ?>

    
</body>
</html>
';



$hasil_view_form = createFile($string, $target.'views/home.php');

?>