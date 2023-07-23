<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<style>
ul li{
	border:1px solid gray;
	border-radius:5px;
	list-style:none;
	padding:10px;
	margin-bottom:5px;
	color:#333333;
}

ul li:hover{
	color:#ffffff;
	background-color:#3C8DBC;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Home
            <small>Reports Section</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports Section</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
							<div class="col-sm-4">
								<h3>Maintenance Reports</h3>
								<ul>
									<a href="datewise_maintenance_report.php"><li><b>Datewise Schedule Maintenance Reports</b></li></a>
									<a href="datewise_maintenance_cost_report.php"><li><b>Datewise Maintenance Cost Reports</b></li></a>
								</ul>
							
								<h3>Operation Reports</h3>
								<ul>
									<a href="equipment_list_report.php"><li><b>Equipment List</b></li></a>
									<a href="equipment_history_report.php"><li><b>Equipment Movement History</b></li></a>
									<a href="datewise_logsheet_report.php"><li><b>Equipment Logsheet Report</b></li></a>
								</ul>
							</div>
						</div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
