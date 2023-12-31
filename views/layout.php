<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title id="titulo-pagina"> Makfrio <?= setTitle() ?> </title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- iCheck -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- bootstrap-wysiwyg -->
	  <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/css/sweetAlert.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/css/custom.min.css" rel="stylesheet">

    <link href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/css/styles.css" rel="stylesheet">
  
    <link rel="shortcut icon" href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/logo.png" type="image/x-icon">
  </head> 

  <?php require_once $content ?>
  
</html>