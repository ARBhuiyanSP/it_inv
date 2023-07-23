
<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<link href="css/bootstrap-transfer.css" rel="stylesheet">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Interview Create form</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Interview Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="rlp_list.php"><i class="fa fa-user-plus"></i> Interview List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
							<div id="test" style="width:400px"> </div>
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
<script src="js/bootstrap-transfer.js"></script>
    <script>
		$(function() {
			var t = $('#test').bootstrapTransfer(
				{'target_id': 'multi-select-input',
				 'height': '15em',
				 'hilite_selection': true});
			
			t.populate([
				{value:"1", content:"Apple"},
				{value:"2", content:"Orange"},
				{value:"3", content:"Banana"},
				{value:"4", content:"Peach"},
				{value:"5", content:"Grapes"}
			]);
			//t.set_values(["2", "4"]);
			//console.log(t.get_values());
		});
    </script>
<?php include 'footer.php'; ?>
