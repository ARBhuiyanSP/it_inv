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
                        <h3 class="box-title">Consumable Items Receive Details</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="receive-list.php"><i class="fa fa-user-plus"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="printableArea">
                       <?php
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
                                <table width='100%'>				
									<tr>
										<td style="text-align:center">
											<div class="headbody">
												<h1 align="center"><img src="images/spl2.png" width="162" height=""></h1>
												<h2 align="center">SAIF POWER GROUP</h2>
												<p align="center">Rupayan Centre(8th Floor),72, Mohakhali C/A,Dhaka-1212,Bangladesh</p>
												<h3 align="center">Assets Details</h3>
												<h1 align="center"><img src="<?php echo $row['qr_image'] ?>" height="200" /></h1>
											</div>
										</td>
									</tr>
								</table>
								<table class="table table-bordered">
									<tr>
										<th>Product Photo:</th>
										<td><img src="products_photo/<?php if($row['pro_photo']==''){echo "blank.png";}else{echo $row['pro_photo'];} ?>" height="100" /></td>
									</tr>
									<tr>
										<th>Item Name:</th>
										<td><?php echo $row['item_name'] ?></td>
									</tr>
									<tr>
										<th>Item Description:</th>
										<td><?php echo $row['assets_description'] ?></td>
									</tr>
									<tr>
										<th>Brand:</th>
										<td><?php echo $row['brand'] ?></td>
									</tr>
									<tr>
										<th>Model:</th>
										<td><?php echo $row['model'] ?></td>
									</tr>
									<tr>
										<th>Manufacturing SL No:</th>
										<td><?php echo $row['manu_sl'] ?></td>
									</tr>
									<tr>
										<th>Description:</th>
										<td><?php echo $row['assets_description'] ?></td>
									</tr>
									<tr>
										<th>RLP No:</th>
										<td><?php echo $row['rlp_no'] ?></td>
									</tr>
									<tr>
										<th>Country Origin:</th>
										<td><?php echo $row['origin'] ?></td>
									</tr>
									<tr>
										<th>Vendor Name:</th>
											<?php 
												$vendor_id = $row['vendor_name'];
												$sqlvendor	= "select * from `vendors` where `vendor_id`='$vendor_id'";
												$resultvendor = mysqli_query($conn, $sqlvendor);
												$rowvendor=mysqli_fetch_array($resultvendor);
											?>
										<td><?php echo $rowvendor['vendor_name']; ?></td>
									</tr>
									<tr>
										<th>Purchase Date:</th>
										<td><?php echo $row['puchase_date']; ?></td>
									</tr>
									<tr>
										<th>Custody:</th>
										<td><?php echo $row['custody']; ?></td>
									</tr>
									<tr>
										<th>User:</th>
											<?php if($row['assign_status']=='assigned'){ 
											$products_id	=	$row['id'];
												$sqlassign	= "select * FROM `product_assign` WHERE `product_id`='$products_id' ORDER BY `id` DESC LIMIT 1 ";
												$resultassign = mysqli_query($conn, $sqlassign);
												$rowassign=mysqli_fetch_array($resultassign);
												
													$employee_id = $rowassign['employee_id'];
													$sqlemployee	= "select * from `inv_employee` where `employeeid`='$employee_id'";
													$resultemployee = mysqli_query($conn, $sqlemployee);
													$rowemployee=mysqli_fetch_array($resultemployee);
											?>
										<td><?php echo $rowemployee['employeeid']; ?> || <?php echo $rowemployee["name"]; ?> || <?php echo $rowemployee["division"]; ?>-<?php echo $rowemployee["department"]; ?></td>
											<?php }else{ ?>
										<td>---</td>
										<?php } ?>
									</tr>
								</table>
						
                <!-- /.row -->
                    </div>
					
                    <!-- /.box-body -->
					<center>
						<button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
						<button class="btn btn-primary mx-2 px-3" onclick="window.location.href = 'assets-list.php'" role="button"><i class="fa fa-outdent"></i> Back To Products Lis</button>
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


