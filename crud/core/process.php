<?php

$hasil = array();

if (isset($_POST['generate']))
{
    // get form data
    $table_name = safe($_POST['table_name']);
    $jenis_tabel = safe($_POST['jenis_tabel']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $export_pdf = safe($_POST['export_pdf']);
    $controller = safe($_POST['controller']);
    $model = safe($_POST['model']);
    $layout    = safe($_POST['layout']);

    if ($table_name <> '')
    {

        if ($layout == 'layout3') {
           
            
                $table_name = safe($_POST['table_name']);
                $c = ucfirst($table_name);
                $m = ucfirst($table_name) . '_model';
                $v_list = "list";
                $v_form = "form";

                // url
                $c_url = strtolower($c);

                // filename
                $c_file = $c . '.php';
                $m_file = $m . '.php';
                $v_list_file = $v_list . '.php';
                $v_form_file = $v_form . '.php';

                // read setting
                $get_setting = readJSON('core/settingjson.cfg');
                $target = $get_setting->target;
                if (!file_exists($target . "views/" . $c_url))
                {
                    mkdir($target . "views/" . $c_url, 0777, true);
                }

                $pk = $hc->primary_field($table_name);
                $non_pk = $hc->not_primary_field($table_name);
                $all = $hc->all_field($table_name);

                // generate
                include 'core/adminlte/create_controller.php';
                include 'core/adminlte/create_model.php';

                include 'core/adminlte/create_view_listdata.php';
                include 'core/adminlte/create_view_form.php';

                $hasil[] = $hasil_controller;
                $hasil[] = $hasil_model;
                $hasil[] = $hasil_view_list;
                $hasil[] = $hasil_view_form;
            
        }else{

            // set data
            $table_name = $table_name;
            $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
            $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';
            $v_list = $table_name . "_list";
            $v_read = $table_name . "_read";
            $v_form = $table_name . "_form";
            $v_doc = $table_name . "_doc";
            $v_pdf = $table_name . "_pdf";

            // url
            $c_url = strtolower($c);

            // filename
            $c_file = $c . '.php';
            $m_file = $m . '.php';
            $v_list_file = $v_list . '.php';
            $v_read_file = $v_read . '.php';
            $v_form_file = $v_form . '.php';
            $v_doc_file = $v_doc . '.php';
            $v_pdf_file = $v_pdf . '.php';

            // read setting
            $get_setting = readJSON('core/settingjson.cfg');
            $target = $get_setting->target;

            if (!file_exists($target . "views/" . $c_url))
            {
                mkdir($target . "views/" . $c_url, 0777, true);
            }

            $pk = $hc->primary_field($table_name);
            $non_pk = $hc->not_primary_field($table_name);
            $all = $hc->all_field($table_name);

            // generate
            include 'core/create_config_pagination.php';
            include 'core/create_controller.php';
            include 'core/create_model.php';
            if ($jenis_tabel == 'reguler_table') {
                include 'core/create_view_list.php';
            } else {
                include 'core/create_view_list_datatables.php';
                include 'core/create_libraries_datatables.php';
            }
            include 'core/create_view_form.php';
            include 'core/create_view_read.php';

            $export_excel == 1 ? include 'core/create_exportexcel_helper.php' : '';
            $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
            $export_pdf == 1 ? include 'core/create_pdf_library.php' : '';
            $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

            $hasil[] = $hasil_controller;
            $hasil[] = $hasil_model;
            $hasil[] = $hasil_view_list;
            $hasil[] = $hasil_view_form;
            $hasil[] = $hasil_view_read;
            $hasil[] = $hasil_view_doc;
            $hasil[] = $hasil_view_pdf;
            $hasil[] = $hasil_config_pagination;
            $hasil[] = $hasil_exportexcel;
            $hasil[] = $hasil_pdf;
        }
    } else
    {
        $hasil[] = 'No table selected.';
    }
}

if (isset($_POST['generateall']))
{

    $jenis_tabel = safe($_POST['jenis_tabel']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $export_pdf = safe($_POST['export_pdf']);

    $layout    = safe($_POST['layout']);

    $get_setting = readJSON('core/settingjson.cfg');
    $target = $get_setting->target;
    if (!file_exists($target . "views/template"))
    {
        mkdir($target . "views/template", 0777, true);
    }

    switch ($layout) {
        case 'layout1':
            include 'core/create_view_header.php';
            include 'core/create_view_topmenu.php';
            
            include 'core/create_view_footer.php';
            include 'core/create_controller_home.php';
            include 'core/create_view_home.php';


            $table_list = $hc->table_list();
            foreach ($table_list as $row) {

                $table_name = $row['table_name'];
                $c = ucfirst($table_name);
                $m = ucfirst($table_name) . '_model';
                $v_list = $table_name . "_list";
                $v_read = $table_name . "_read";
                $v_form = $table_name . "_form";
                $v_doc = $table_name . "_doc";
                $v_pdf = $table_name . "_pdf";

                // url
                $c_url = strtolower($c);

                // filename
                $c_file = $c . '.php';
                $m_file = $m . '.php';
                $v_list_file = $v_list . '.php';
                $v_read_file = $v_read . '.php';
                $v_form_file = $v_form . '.php';
                $v_doc_file = $v_doc . '.php';
                $v_pdf_file = $v_pdf . '.php';

                // read setting
                $get_setting = readJSON('core/settingjson.cfg');
                $target = $get_setting->target;
                if (!file_exists($target . "views/" . $c_url))
                {
                    mkdir($target . "views/" . $c_url, 0777, true);
                }

                $pk = $hc->primary_field($table_name);
                $non_pk = $hc->not_primary_field($table_name);
                $all = $hc->all_field($table_name);

                // generate
                include 'core/create_config_pagination.php';
                include 'core/create_controller.php';
                include 'core/create_model.php';
                
                
                // if ($jenis_tabel == 'reguler_table') {
                //     include 'core/create_view_list.php';
                // } else {
                // }


                if ($layout == 'layout1') {
                    include 'core/create_view_list_datatables.php';
                    include 'core/create_libraries_datatables.php';
                    include 'core/create_view_form.php';
                }else{
                    include 'core/create_view_list_datatables_v2.php';
                    include 'core/create_libraries_datatables.php';
                    include 'core/create_view_form_v2.php';
                }

                

                $export_excel == 1 ? include 'core/create_exportexcel_helper.php' : '';
                $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
                $export_pdf == 1 ? include 'core/create_pdf_library.php' : '';
                $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

                $hasil[] = $hasil_controller;
                $hasil[] = $hasil_model;
                $hasil[] = $hasil_view_list;
                $hasil[] = $hasil_view_form;
                $hasil[] = $hasil_view_read;
                $hasil[] = $hasil_view_doc;
            }

            $hasil[] = $hasil_config_pagination;
            $hasil[] = $hasil_exportexcel;
            $hasil[] = $hasil_pdf;

            break;
         case 'layout2':
            include 'core/create_view_header_v2.php';
            include 'core/create_view_topmenu_v2.php';
            
            include 'core/create_view_footer.php';
            include 'core/create_controller_home.php';
            include 'core/create_view_home.php';


            $table_list = $hc->table_list();
            foreach ($table_list as $row) {

                $table_name = $row['table_name'];
                $c = ucfirst($table_name);
                $m = ucfirst($table_name) . '_model';
                $v_list = $table_name . "_list";
                $v_read = $table_name . "_read";
                $v_form = $table_name . "_form";
                $v_doc = $table_name . "_doc";
                $v_pdf = $table_name . "_pdf";

                // url
                $c_url = strtolower($c);

                // filename
                $c_file = $c . '.php';
                $m_file = $m . '.php';
                $v_list_file = $v_list . '.php';
                $v_read_file = $v_read . '.php';
                $v_form_file = $v_form . '.php';
                $v_doc_file = $v_doc . '.php';
                $v_pdf_file = $v_pdf . '.php';

                // read setting
                $get_setting = readJSON('core/settingjson.cfg');
                $target = $get_setting->target;
                if (!file_exists($target . "views/" . $c_url))
                {
                    mkdir($target . "views/" . $c_url, 0777, true);
                }

                $pk = $hc->primary_field($table_name);
                $non_pk = $hc->not_primary_field($table_name);
                $all = $hc->all_field($table_name);

                // generate
                include 'core/create_config_pagination.php';
                include 'core/create_controller.php';
                include 'core/create_model.php';
                
                
                // if ($jenis_tabel == 'reguler_table') {
                //     include 'core/create_view_list.php';
                // } else {
                // }


                if ($layout == 'layout1') {
                    include 'core/create_view_list_datatables.php';
                    include 'core/create_libraries_datatables.php';
                    include 'core/create_view_form.php';
                }else{
                    include 'core/create_view_list_datatables_v2.php';
                    include 'core/create_libraries_datatables.php';
                    include 'core/create_view_form_v2.php';
                }

                

                $export_excel == 1 ? include 'core/create_exportexcel_helper.php' : '';
                $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
                $export_pdf == 1 ? include 'core/create_pdf_library.php' : '';
                $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

                $hasil[] = $hasil_controller;
                $hasil[] = $hasil_model;
                $hasil[] = $hasil_view_list;
                $hasil[] = $hasil_view_form;
                $hasil[] = $hasil_view_read;
                $hasil[] = $hasil_view_doc;
            }

            $hasil[] = $hasil_config_pagination;
            $hasil[] = $hasil_exportexcel;
            $hasil[] = $hasil_pdf;

            break;
         case 'layout3':

            include 'core/adminlte/create_view_header.php';
            include 'core/adminlte/create_view_topmenu.php';
            include 'core/adminlte/create_view_sidemenu.php';
            include 'core/adminlte/create_view_footer.php';
            
            include 'core/adminlte/create_controller_dashboard.php';
            include 'core/adminlte/create_view_dashboard.php';
            include 'core/adminlte/create_model_dashboard.php';

            include 'core/adminlte/create_controller_login.php';
            include 'core/adminlte/create_view_login.php';
            include 'core/adminlte/create_model_login.php';

            include 'core/adminlte/create_view_setting.php';


            $table_list = $hc->table_list();
            foreach ($table_list as $row) {

                $table_name = $row['table_name'];
                $c = ucfirst($table_name);
                $m = ucfirst($table_name) . '_model';
                $v_list = "list";
                $v_form = "form";

                // url
                $c_url = strtolower($c);

                // filename
                $c_file = $c . '.php';
                $m_file = $m . '.php';
                $v_list_file = $v_list . '.php';
                $v_form_file = $v_form . '.php';

                // read setting
                $get_setting = readJSON('core/settingjson.cfg');
                $target = $get_setting->target;
                if (!file_exists($target . "views/" . $c_url))
                {
                    mkdir($target . "views/" . $c_url, 0777, true);
                }

                $pk = $hc->primary_field($table_name);
                $non_pk = $hc->not_primary_field($table_name);
                $all = $hc->all_field($table_name);

                // generate
                include 'core/adminlte/create_controller.php';
                include 'core/adminlte/create_model.php';

                include 'core/adminlte/create_view_listdata.php';
                include 'core/adminlte/create_view_form.php';

                $hasil[] = $hasil_controller;
                $hasil[] = $hasil_model;
                $hasil[] = $hasil_view_list;
                $hasil[] = $hasil_view_form;
            }

            break;
        default:

            break;
    }


    
}

?>