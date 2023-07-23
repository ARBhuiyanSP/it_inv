<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
	$consumption_id=$_GET['no'];
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
<?php
				$sqld = "select * from `inv_consumption` where `consumption_id`='$consumption_id'";
							$resultd = mysqli_query($conn, $sqld);
							$rowd = mysqli_fetch_array($resultd);
			?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Consumable Items Issue/Consumption Details</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="receive-list.php"><i class="fa fa-user-plus"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="printableArea">
                       <div class="row">
									<div class="col-xs-6">	
										<p>
										<img src="images/spl2.png" height="50px;"/>
										<h5>Saif Power Group </h5><span>Material Consumption Details</span></p>
									</div>
									<div class="col-xs-6">
										<table class="table table-bordered">
											<tr>
												<th>Consumption ID:</th>
												<td><?php echo $consumption_id; ?></td>
											</tr>
											<tr>
												<th>Consumption Date:</th>
												<td><?php
												echo $rowd['consumption_date'] ?></td>
											</tr>
											<tr>
												<th>From Store:</th>
												<td>
													<?php 
													$dataresult =   getDataRowByTableAndId('store', $rowd['warehouse_id']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
													?>
												</td>
											</tr>
											<tr>
												<th>Employee/User:</th>
												<td>
													<?php 
													
														$employee_id = $rowd['employee_id'];
														$sqlemployee	= "select * from `inv_employee` where `employeeid`='$employee_id'";
														$resultemployee = mysqli_query($conn, $sqlemployee);
														$rowemployee=mysqli_fetch_array($resultemployee);
														echo $rowemployee["employeeid"] .'</br>'.$rowemployee["name"];
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="table table-bordered" id="material_receive_list"> 
									<thead>
										<tr>
											<th width="5%">SL #</th>
											<th>Material Name</th>
											<th>Device Name</th>
											<th width="10%">Unit</th>
											<th width="10%">Quantity</th>
										</tr>
									</thead>
									<tbody id="material_receive_list_body">
										<?php
										$sql = "select * from `inv_consumptiondetails` where `consumption_id`='$consumption_id'";
										$result = mysqli_query($conn, $sql);
											for($i=1; $row = mysqli_fetch_array($result); $i++){
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td>
												<?php 
													$dataresult =   getDataRowByTableAndId('inv_material', $row['material_name']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->material_description : '');
												?>
											</td>
											
											<td>
												<?php 
													$dataresult =   getDataRowByTableAndId('inv_material', $row['material_name']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->brand_name : '');
												?>
											</td>
											<td>
												<?php 
												$dataresult =   getDataRowByTableAndId('inv_item_unit', $row['unit']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->unit_name : '');
												?>
											</td>
												
											<td><?php echo $row['consumption_qty'] ?></td>
										</tr>
										<?php } ?>
										<tr>
											<td colspan="4" class="grand_total">Grand Total:</td>
											<td>
												<?php 
												$sql2 = "SELECT sum(consumption_qty) FROM  `inv_consumptiondetails` where `consumption_id`='$consumption_id'";
												$result2 = mysqli_query($conn, $sql2);
												for($i=0; $row2 = mysqli_fetch_array($result2); $i++){
												$fgfg2=number_format((float)$row2['sum(consumption_qty)'], 2, '.', '');
												
												echo $fgfg2 ;
												}
												?>
											</td>
										</tr>
										<tr>
											<td colspan="5"><span style="text-decoration:underline">Remarks:</span></br>
												<?php 
												echo $rowd['remarks'];
												?>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="row" style="text-align:center">
									<div class="col-xs-6"></br><?php echo $rowd['received_by'];?></br>--------------------</br>Receiver Signature</div>	
									
									
									<div class="col-xs-6"></br><?php 
												if($rowd['approved_by']){
												$dataresult =   getDataRowByTableAndId('users', $rowd['approved_by']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->first_name . ' ' .$dataresult->last_name : '');	
												}?></br>--------------------</br>Authorised Signature</div>
								</div></br>
								<div class="row">
									<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
										<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
									</div>
								</div>
						
                <!-- /.row -->
                    </div>
					
                    <!-- /.box-body -->
					<center><button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></center>			
						<script>
						function printDiv(divName) {
							 var printContents = document.getElementById(divName).innerHTML;
							 var originalContents = document.body.innerHTML;

							 document.body.innerHTML = printContents;

							 window.print();

							 document.body.innerHTML = originalContents;
						}
						</script>
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


