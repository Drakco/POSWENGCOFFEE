<?php 

$string = '<!DOCTYPE html>
<html>
<head>
    <title>TNZ.COM - TNZ CRUD</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/datatables/dataTables.bootstrap.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/datatables/dataTables.bootstrap.css") ?>"/>
    <!-- font-awesome -->
    <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.css"); ?>">
    <!-- choosen -->
    <link href="<?php echo(base_url("assets/chosen/chosen.css")); ?>" rel="stylesheet">
    <!-- easy-autocomplete -->
    <link  rel="stylesheet" type="text/css" href="<?php echo(base_url("assets/easyautocomplete/easy-autocomplete.min.css")); ?>" />
    <style>

        
        .dataTables_processing {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            margin-left: -50%;
            margin-top: -25px;
            padding-top: 20px;
            text-align: center;
            font-size: 1.2em;
            color:grey;
        }

        .headbreadcrumb {
            color: #727272
        }
        .headbreadcrumb .namapt {
            font-size: 30px;
            margin-top: -5px;
        }

        #panelbody {
            box-shadow: 0 0 30px black;
            padding:0 15px 0 15px;
            min-height: 550px;
        }

    </style>


</head>

<body>';

$hasil_view_list = createFile($string, $target."views/template/header.php");

?>