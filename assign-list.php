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
            <small>Assets</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Assets</li>
        </ol>
    </section>  -->

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Assign List</h3>
                        <div class="box-tools">
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
        							<th width="10%">Product ID</th>
        							<th width="10%">
        								<select name="employees" id="employees" class="form-control select2">
        									<option value="">EMP ID Search</option>
        									<?php 
        									$query = "SELECT * FROM inv_employee ORDER BY employeeid ASC";
        									$result = mysqli_query($conn, $query);
        									while($row = mysqli_fetch_array($result))
        									{
        										echo '<option value="'.$row["employeeid"].'">'.$row["employeeid"].'</option>';
        									}
        									?>
        								</select>
        							</th>
                                    <th width="10%">Assign Date</th>
        							<th width="15%">Remarks</th>
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

 function load_receive_data(is_employees)
 {
  var dataTable = $('#receive_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch/fetch_assign_table.php",
    type:"POST",
    data:{is_employees:is_employees}
   },
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            if ( aData[4] == "Active" )
            {
				$('td', nRow).css('background-color', '#b01a33');
				$('td', nRow).css('color', '#fff');
            }else{
				$('td', nRow).css('background-color', '#218a5c');
				$('td', nRow).css('color', '#fff');
			}
        },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#employees', function(){
  var employees = $(this).val();
  $('#receive_data_list').DataTable().destroy();
  if(employees != '')
  {
   load_receive_data(employees);
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


