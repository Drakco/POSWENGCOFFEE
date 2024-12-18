<?php 

    $string = '<?php 
            $this->load->view("template/header");
            $this->load->view("template/topmenu");
        ?>
        

        <div class="container">
            
            <div class="panel panel-default" id="panelbody">
                <div class="panel-body"> ';

$string .= "<h2 style=\"margin-top:0px\"><?php echo \$button ?> ".ucfirst($table_name)."</h2><hr>
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-success pull-right\">Simpan</button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default pull-right\">Batal</a>";
$string .= "\n\t</form>";

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



$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>