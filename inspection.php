<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Equipment Inspection</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Equipment Inspection</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Start box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                     <div class="box-body">
		 <!--logsheet_list_table  reference footer.php-->
            <table id="ins_list_table" class="table table-striped table-bordered  list-table-custom-style" style="width:100%">
				<thead>
					<tr class="tr_header">	
						<th>#</th>
                    <!-- <th>Requisition No</th> -->
                    <th>Name</th>
                    <th>EEL Code</th>
                    <th>Capacity</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Project</th>
                    <th>Present Condition</th>
						

						<th style="min-width: 190px">Action</th>
					</tr>
				</thead>
			</table>
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
