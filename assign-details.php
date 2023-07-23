<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
	$id=$_GET['no'];
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
            <small>Assets Assign</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Assets Assign</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Asset's Details</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="assign-list.php"><i class="fa fa-user-plus"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="printableArea">
						<div class="row">
							<?php
							$sql	=	"select * from `product_assign` where `id`='$id'";
							$result = mysqli_query($conn, $sql);
							$row=mysqli_fetch_array($result);
							
							
								$product_id=$row['product_id'];
								$sql2	=	"select * from `ams_products` where `id`='$product_id'";
								$result2 = mysqli_query($conn, $sql2);
								$rowp=mysqli_fetch_array($result2);
							?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
								<table style="" class="table table-bordered">
									<tr>
										<th>Item Name:</th>
										<td><?php echo $rowp['item_name'] ?></td>
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
										<th>RLP No:</th>
										<td><?php echo $rowp['rlp_no'] ?></td>
									</tr>
									<tr>
										<th>Country Origin:</th>
										<td><?php echo $rowp['origin'] ?></td>
									</tr>
									<tr>
										<th>Vendor Name:</th>
										<td><?php echo $rowp['vendor_name'] ?></td>
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
							</div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
								<h3>Scan Below Code</h3>
								<img src="<?php echo $rowp['qr_image'] ?>" height="250" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table style="" class="table table-bordered">
									<tr>
										<th>Assign date:</th>
										<td><?php 
										$cDate = strtotime($row['assign_date']);
										$dDate = date("jS \of F Y",$cDate);
										echo $dDate;?></td>
										
									</tr>
									<tr>
										<th>Refund date:</th>
										<td><?php 
										if($row['refund_date']){
											$rDate = strtotime($row['refund_date']);
											$rfDate = date("jS \of F Y",$rDate);
											echo $rfDate;
										}else{
											echo '--';
										}
										?>
										</td>

									</tr>
									<tr>
										<th>Assign To:</th>
										<td><?php 
										$employee_id=$row['employee_id'];
										$sql4	=	"select * from `inv_employee` where `employeeid`='$employee_id'";
										$result4 = mysqli_query($conn, $sql4);
										$rowe=mysqli_fetch_array($result4);
										echo $rowe['name'];
										echo '-'.$row['employee_id'];

										 ?></td>
									</tr>
									<tr>
										<th>Remarks:</th>
										<td><?php echo $row['remarks']; ?></td>
									</tr>
								</table>
							</div>
						</div>
                    </div>
                    <button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
							
					<script>
					function printDiv(divName) {
						 var printContents = document.getElementById(divName).innerHTML;
						 var originalContents = document.body.innerHTML;

						 document.body.innerHTML = printContents;

						 window.print();

						 document.body.innerHTML = originalContents;
					}
					</script>
					<button class="btn btn-info" onclick="window.location.href = 'assign-list.php'"><i class="fa fa-outdent"></i> Back To Assign List</button>
					
					<button class="btn btn-danger" onclick="window.location.href = 'transfer.php?id=<?php echo $row['product_id'] ?>'"><i class="fa fa-outdent"></i> Transfer To Another User</button>
					
					<button class="btn btn-warning" onclick="window.location.href = 'refund.php?id=<?php echo $row['product_id'] ?>'"><i class="fa fa-outdent"></i> Return From User</button>
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


