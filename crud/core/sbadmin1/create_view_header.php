<?php 

$string = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sidenav Light - SB Admin</title>
        <link href="<?php echo(base_url(\'assets/sbadmin1/dist/css/styles.css\')) ?>" rel="stylesheet" />
        <!-- datatables -->
        <link href="<?php echo(base_url(\'assets/datatables/css/jquery.dataTables.min.css\')) ?>" rel="stylesheet">
        <!-- jquery-ui -->
        <link href="<?php echo(base_url(\'assets/jquery-ui/themes/base/jquery-ui.css\')) ?>">
    </head>
    <body class="sb-nav-fixed">  

    <style>
        table {
            font-size: 14px;
        }
    </style>

';

$hasil_view_list = createFile($string, $target."views/template/header.php");

?>