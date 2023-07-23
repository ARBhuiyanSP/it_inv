<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header)
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Service Area</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Service Area</li>
        </ol>
    </section>  -->

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Assets List</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="asset_entry.php"><i class="fa fa-user-plus"></i> New Entry</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive data-table-wrapper">
				<table id="receive_data_list" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">SRV No</th>
							<th width="10%">Asset ID</th>
							<th width="10%">
								<select name="vendors" id="vendors" class="form-control select2">
									<option value="">Vendor Search</option>
									<?php 
									$query = "SELECT * FROM vendors ORDER BY vendor_name ASC";
									$result = mysqli_query($conn, $query);
									while($row = mysqli_fetch_array($result))
									{
										echo '<option value="'.$row["vendor_id"].'">'.$row["vendor_name"].'</option>';
									}
									?>
								</select>
							</th>
							<th width="15%">Handover Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
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
 <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_receive_data();

 function load_receive_data(is_vendors)
 {
  var dataTable = $('#receive_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch/fetch_service_table.php",
    type:"POST",
    data:{is_vendors:is_vendors}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#vendors', function(){
  var vendors = $(this).val();
  $('#receive_data_list').DataTable().destroy();
  if(vendors != '')
  {
   load_receive_data(vendors);
  }
  else
  {
   load_receive_data();
  }
 });
});
</script>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>


