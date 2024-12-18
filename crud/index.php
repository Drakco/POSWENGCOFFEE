<?php
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/process.php';
?>
<!doctype html>
<html>
    <head>
        <title>Admin LTE 3 - CRUD</title>
        <link rel="stylesheet" href="core/bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-3">
                <form action="index.php" method="POST">

                    <div class="form-group">
                        <label>Pilih Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Pilih table...</option>
                            <?php
$table_list          = $hc->table_list();
$table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
foreach ($table_list as $table) {
    ?>
                                <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                                <?php
}
?>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <div class="checkbox">
                            <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : '';?>
                            <label>
                                <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                Export Excel
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : '';?>
                            <label>
                                <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                Export Word
                            </label>
                        </div>
                    </div> -->


                    <div class="form-group">
                        <div class="row">
                            <?php $layout = isset($_POST['layout']) ? $_POST['layout'] : 'layout1';?>
                            <!-- <div class="col-md-12">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="layout" value="layout1" <?php echo $layout == 'layout1' ? 'checked' : ''; ?>>
                                        Layout 1 (Top Menu - No Breadcrumb)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="layout" value="layout2" <?php echo $layout == 'layout2' ? 'checked' : ''; ?>>
                                        Layout 2 (Top Menu - Breadcrumb)
                                    </label>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="layout" value="layout3" checked="">
                                        Layout (Admin LTE 3)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--                    <div class="form-group">
                                            <div class="checkbox  <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled';   ?>">
                    <?php // $export_pdf = isset($_POST['export_pdf']) ? $_POST['export_pdf'] : ''; ?>
                                                <label>
                                                    <input type="checkbox" name="export_pdf" value="1" <?php // echo $export_pdf == '1' ? 'checked' : ''   ?>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled'; ?>>
                                                    Export PDF
                                                </label>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : '<small class="text-danger">mpdf required, download <a href="http://harviacode.com">here</a></small>'; ?>
                                            </div>
                                        </div>-->


                    <!-- <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div> -->
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                    <input type="submit" value="Generate All" name="generateall" class="btn btn-danger" onclick="javascript: return confirm('WARNING !! This will generate code for ALL TABLE and overwrite the existing files\
                    \nPlease double check before continue. Continue ?')" />
                    <a href="core/setting.php" class="btn btn-default">Setting</a>
                </form>
                <br>

                <?php
foreach ($hasil as $h) {
    echo '<p>' . $h . '</p>';
}
?>
            </div>
            <div class="col-md-9">
                <h3 style="margin-top: 0px">Admin LTE 3 1 Generator by <a target="_blank" href="http://ptbahari.com/demo/portfolio">Noval Error</a></h3>
                <p><strong>Tentang :</strong></p>
                <p>
                    CRUD generator ini menggunakan bootstrap 4, bootstrap validator, datatables, jquery-mask, jquery-ui, smartwizard, select2
                </p>

                <p><strong>Persiapan sebelum memulai Admin LTE 3 1 - crud (Penting!) :</strong></p>
                <ul>
                    <li>Sesuaikan application/config/autoload.php, load database library, session library and url helper</li>
                    <li>Sesuaikan application/config/config.php :</b>.
                        <ul>
                            <li>$config['base_url'] = 'http://localhost/yourprojectname'</li>
                            <li>$config['index_page'] = ''</li>
                            <li>$config['url_suffix'] = '.html'</li>
                            <li>$config['encryption_key'] = 'randomstring'</li>

                        </ul>

                    </li>
                    <li>Sesuaikan application/config/database.php</li>
                </ul>
                <p><strong>PENTING !!!</strong></p>
                <ul>
                    <li>Jika anda menggunakan Plugin Code Matter</li>
                    <li>Perhatikan file application/config/database.php</li>
                    <li>defined('BASEPATH') OR exit('No direct script access allowed'); setting or menjadi OR, karna gak kebaca harviacode nya</li>
                </ul>
                <p><strong>FAQ :</strong></p>
                <ul>
                    <li>Jika crud-generator sudah dijalankan anda dapat membuka http://localhost/yourproject/home</li>
                </ul>
                <br>

                <p><strong>Update</strong></p>

                <ul>
                    <li>V.1.1 - 4 Juni 2021
                        <ul>
                            <li>Perbaikan Admin LTE</li>
                        </ul>
                    </li>
                </ul>

                <p><strong>&COPY; 2021 <a target="_blank" href="http://ptbahari.com/demo/portfolio">novalprogrammer@gmail.com</a></strong></p>
            </div>
        </div>
        <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }
        </script>
    </body>
</html>
