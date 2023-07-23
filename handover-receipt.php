<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
	$id=$_GET['id'];
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
                        <h3 class="box-title">Handover Receipt Details</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="assign-list.php"><i class="fa fa-user-plus"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <?php
									$sql	=	"select * from `product_assign` where `id`='$id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									
										$product_id=$row['product_id'];
										$sql2	=	"select * from `ams_products` where `id`='$product_id'";
										$result2 = mysqli_query($conn, $sql2);
										$rowp=mysqli_fetch_array($result2);
								?>
                                <center>
									
									<div class="row">
										<div class="col-md-12" id="printableArea">
											<div class="row">
												<center>
												<div class="col-sm-12">	
													<h1 align="center"><img src="images/spl2.png" height="50px;"/></h1>
													<h2>SAIF POWER GROUP</h2>
													<p>72,Mohakhali C/A, (8th Floor),Rupayan Center,Dhaka-1212,bangladesh</p>
													<h3>Assets Handover Receipt</h3>
													<table style="" class="table table-bordered">
														<tr>
															<th>S/L No:</th>
															<td><?php echo $rowp['sl_no'] ?></td>
														</tr>
														<tr>
															<th>Item Name:</th>
															<td><?php echo $rowp['item_name'] ?></td>
														</tr>
														<tr>
															<th>Item Description:</th>
															<td><?php echo $rowp['assets_description'] ?></td>
														</tr>
														<tr>
															<th>Brand:</th>
															<td><?php echo $rowp['brand'] ?></td>
														</tr>
														<tr>
															<th>Model:</th>
															<td><?php echo $rowp['model'] ?></td>
														</tr>
														<tr>
															<th>Manufacturing SL No:</th>
															<td><?php echo $rowp['manu_sl'] ?></td>
														</tr>
														<tr>
															<th>RLP No:</th>
															<td><?php echo $rowp['rlp_no'] ?></td>
														</tr>
														<tr>
															<th>Purchase Date:</th>
															<td><?php echo $rowp['puchase_date'] ?></td>
														</tr>
														<tr>
															<th>Custody:</th>
															<td><?php echo $rowp['custody'] ?></td>
														</tr>
													</table>
													<table style="" class="table table-bordered">
														
														<tr>
															<td style="width:20%">Handover date:</td>
															<td><?php 
															$cDate = strtotime($row['assign_date']);
															$dDate = date("jS \of F Y",$cDate);
															echo $dDate;?></td>
															
														</tr>
														<tr>
															<td style="width:20%">Handover To:</td>
															<td><?php 
															$employee_id=$row['employee_id'];
															$sql4	=	"select * from `inv_employee` where `employeeid`='$employee_id'";
															$result4 = mysqli_query($conn, $sql4);
															$rowe=mysqli_fetch_array($result4);
															echo $rowe['name'];
															echo ' || '.$rowe['employeeid'].' || '.$rowe['division'].' || '.$rowe['department'];

															 ?></td>
														</tr>
														<tr>
															<td style="width:20%">Remarks:</td>
															<td><?php echo $row['remarks']; ?></td>
														</tr>
													</table>
												</div>
												</center>
											</div>
												<center><div class="row">
													<div class="col-xs-3"></br>
														<?php if($row['assigned_by']){ 
																	
																		$employee_id = $row['assigned_by'];
																		$sqlemployee	= "select * from `inv_employee` where `employeeid`='$employee_id'";
																		$resultemployee = mysqli_query($conn, $sqlemployee);
																		$rowemployee=mysqli_fetch_array($resultemployee);
																?>
															<?php echo $rowemployee["name"]; }else{ ?>---<?php } ?>
													</br>--------------------</br>Handover By</div>
													<div class="col-xs-3"></br></br>--------------------</br>Received By</div>
													<div class="col-xs-3"></br></br>--------------------</br>Checked By</div>
													<div class="col-xs-3"></br></br>--------------------</br>Approved by</div>
												</div></center></br>
												<div class="row">
													<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
														<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
														
													</div>
												</div>
											</div>			
										</div>
										<center><button class="btn btn-success mt-4" onclick="printDiv('printableArea')"><i class="fa fa-print"> </i>Print</button></center>
								</center>
								<script>
								function printDiv(divName) {
									 var printContents = document.getElementById(divName).innerHTML;
									 var originalContents = document.body.innerHTML;

									 document.body.innerHTML = printContents;

									 window.print();

									 document.body.innerHTML = originalContents;
								}
								</script>
								<!--- Search Result--->
						
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


