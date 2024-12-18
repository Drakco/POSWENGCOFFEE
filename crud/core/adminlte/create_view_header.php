<?php

$string = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>WEB Administrator</title>

  <link rel="stylesheet" href="<?php echo(base_url()) ?>/assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo(base_url()) ?>/assets/adminlte3/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- datatables -->
  <link rel="stylesheet" href="<?php echo(base_url(\'assets/datatables/css/jquery.dataTables.min.css\')) ?>">
  <!-- jquery-ui -->
  <link rel="stylesheet" href="<?php echo(base_url(\'assets/jquery-ui/themes/base/jquery-ui.css\')) ?>">

  <style>
    /*.main-header {
      background: linear-gradient(90deg, rgba(87,182,182,1) 19%, rgba(240,255,255,1) 75%) fixed;
      color: black;
    }

    .main-footer {
      background: linear-gradient(90deg, rgba(87,182,182,1) 19%, rgba(240,255,255,1) 75%) !important;
      color: #FFFFFF;
    }

    .brand-link {
      background-color: #82CFCF !important;
      color: white !important;
    }

    .main-sidebar {
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%);
    }

    .btn-success{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .text-dark{
      color: #17a2b8 !important;
    }

    .btn-primary{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .sidebar-dark-warning .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-warning .nav-sidebar>.nav-item>.nav-link.active{
      background-color: #82CFCF !important;
      color: white !important;
    }

    .accent-olive .btn-link, .accent-olive a:not(.dropdown-item){
      color: #17a2b8 !important;
    }


    .btn-info{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    .btn-danger, .btn-warning{
      background: linear-gradient(90deg, rgba(147,227,227,1) 0%, rgba(240,255,255,1) 75%) !important;
      color: black !important;
      border-color: #17a2b8 !important;
    }

    #table th {
      font-size: 12px;
      background-color: #f0ffff !important;
      color: black;
    }

    #table td {
      font-size: 14px;
      vertical-align: middle;
    }

    table.dataTable thead th {
      vertical-align: middle;
    }

    .content-wrapper{
      min-height: 800px !important;
    }*/

    .required label {
      font-weight: bold;
    }

    .required label:after {
        color: #e32;
        content: " * wajib";
        font-style: italic;
        font-size: 12px;
        display:inline;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
';

$hasil_view_list = createFile($string, $target . "views/template/header.php");
