<?php
ob_start();
require_once ("Db.php");
require_once ("admin/inc/Session.php");
require_once ("admin/inc/Function.php");

//$page = explode('/', $_SERVER['PHP_SELF']);
// echo "<pre>";
// print_r($page);
/*  [0] =>
    [1] => RodBlogSite
    [2] => rod-blog
    [3] => admin
    [4] => add_category.php
*/
// $page_count = count($page);
// $page = $page[$page_count-1];
//$page[5-1] = $page[4] = add_category.php
// echo $page;
// exit();

extract($_GET);

?>


<!doctype html>
<html lang="en" class="fixed left-sidebar-top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= isset($page) ? strtoupper($page) : 'ADMIN-ROD-BLOG'; ?></title>
    <link rel="icon" type="image/png" sizes="192x192" href="../admin/favicon/rod-logo-1.png">
    <!--load progress bar-->
    <script src="admin/vendor/pace/pace.min.js"></script>
    <link href="admin/vendor/pace/pace-theme-minimal.css" rel="stylesheet" />

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!--dataTable-->
    <link rel="stylesheet" href="admin/vendor/data-table/media/css/dataTables.bootstrap.min.css">
    <!-- dataTable Columns hiding responsive-->
    <link rel="stylesheet" href="admin/vendor/data-table/extensions/Responsive/css/responsive.bootstrap.min.css">
    <!--Select with searching & tagging-->
    <link rel="stylesheet" href="admin/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="admin/vendor/select2/css/select2-bootstrap.min.css">
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="admin/vendor/toastr/toastr.min.css">
    <!--Magnific popup-->
    <link rel="stylesheet" href="admin/vendor/magnific-popup/magnific-popup.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="admin/stylesheets/css/style.css">
</head>
<body>