<?php session_start();
date_default_timezone_set("Asia/Dhaka");
$page_name  =   basename($_SERVER['PHP_SELF']);
include 'partial/page_container.php';
if(!isset($_SESSION['logged']['status'])){
    header("location: index.php");
    exit();
}else{
    $currentUserId  =   $_SESSION['logged']['user_id'];
}
include 'connection/connect.php';

include 'function/class_loader.php';
//include 'function/global_connection.php';

include 'helper/utilities.php';
include 'function/user_management.php';
include 'function/candidates_management.php';
include 'function/role_access_management.php';
include 'function/rlp_process.php';
include 'function/rlp_chain_process.php';
include 'function/notesheet_chain_process.php';
include 'function/import_processing.php';
include 'function/rrr_processing.php';
include 'function/interview_register_form_process.php';
include 'function/evaluation_processing.php';
include 'function/notesheet_processing.php';
include 'function/equipment_processing.php';
include 'function/workorder_processing.php';
include 'function/maintenance_cost_processing.php';
include 'includes/item_process.php';
include 'includes/receive_process.php';
include 'includes/consumption_process.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RLP - Requisition For Local Purchase</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/icon/port.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vendor/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vendor/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vendor/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vendor/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vendor/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="vendor/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="vendor/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="vendor/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vendor/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="vendor/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <link rel="stylesheet" href="css/jquery.timepicker.min.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  <script src="js/site_url.js"></script>
  <script src="js/site_js.js"></script>
  <!-- jQuery 3 -->
<script src="vendor/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="vendor/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<link rel="stylesheet" href="css/interview-style.css">
		<link href="css/bootstrap-transfer.css" rel="stylesheet">
		<script src="js/bootstrap-transfer.js"></script>
		<script src="js/bom-transfer.js"></script>
		<script src="js/can-transfer.js"></script>
</head>
<style>
table.list-table-custom-style tr td{
	padding-top:2px;
	
}
.table>tbody>tr>td, .table>tbody>tr>th{
	padding:2px;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">