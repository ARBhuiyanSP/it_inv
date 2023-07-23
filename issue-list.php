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
            <small>Consumable Items</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Consumable Items</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Consumable Items I List</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="issue_entry.php"><i class="fa fa-user-plus"></i> New Entry</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <div class="row">
                  <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Consumption ID</th>
						<th>Consumption Date</th>
						<th>Store</th>
					    <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					//$role = $_SESSION['logged']['role'];
					$store_id = $_SESSION['logged']['store_id'];
					$item_details = getTableDataByTableNameById('inv_consumption', '', 'id');
					
					
					/* if($_SESSION['logged']['user_type'] == 'whm') {
						$item_details = getTableDataByTableNameWid('inv_consumption', '', 'id');
					}else{
						$item_details = getTableDataByTableName('inv_consumption', '', 'id');
					} */
					
					
					if (isset($item_details) && !empty($item_details)) {
						foreach ($item_details as $item) {
							if($item['approval_status'] == 0)
							//{
							?>
							<tr style="max-height:10px;">
							<?php // }else{ ?>
							<!-- <tr style="background-color: #218838;max-height:10px;"> -->
							<?php  //} ?>
								<td><?php echo $item['consumption_id']; ?></td>
								<td><?php echo $item['consumption_date']; ?></td>
								<td>
									<?php 
									$dataresult =   getDataRowByTableAndId('store', $item['warehouse_id']);
									echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td>
									<span><a class="btn btn-info action-icons c-approve" href="issue-view.php?no=<?php echo $item['consumption_id']; ?>" title="View"><i class="fa fa-eye text-success"></i> Details</a></span>
									<!-- <span><a class="action-icons c-delete" href="consumption_edit.php?edit_id=<?php echo $item['id']; ?>" title="edit"><i class="fa fa-edit text-info mborder"></i></a></span> 
									
										<span><a class="action-icons c-delete" href="consumption_approve.php?issue=<?php echo $item['consumption_id']; ?>" title="approve"><i class="fa fa-check text-info mborder"></i></a></span>
										
							<span><a class="action-icons c-delete" href="#" title="delete"><i class="fa fa-trash text-danger"></i></a></span> -->
								</td>
							</tr>
							<?php
						}
					}else{ ?>
						  <tr>
							  <td colspan="7">
									<div class="alert alert-info" role="alert">
										Sorry, no data found!
									</div>
								</td>
							</tr>  
					<?php } ?>
				</tbody>
			</table>
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

 function load_receive_data(is_suppliers)
 {
  var dataTable = $('#receive_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch/fetch_receive_table.php",
    type:"POST",
    data:{is_suppliers:is_suppliers}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#suppliers', function(){
  var suppliers = $(this).val();
  $('#receive_data_list').DataTable().destroy();
  if(suppliers != '')
  {
   load_receive_data(suppliers);
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


