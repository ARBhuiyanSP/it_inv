<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
	$id = $_GET['id'];
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
                     <div class="row">
									<div class="col-md-12">
										<div class="page-title-box">
											<h4 class="page-title">Products View</h4>

											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<!-- end row -->
								<div class="row">
								<?php
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
								<div class="col-md-4">
									<table style="" class="table table-bordered">
										<tr>
											<th>Item Name:</th>
											<td><?php echo $row['item_name'] ?></td>
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
											<th>RLP No:</th>
											<td><?php echo $row['rlp_no'] ?></td>
										</tr>
										<tr>
											<th>Country Origin:</th>
											<td><?php echo $row['origin'] ?></td>
										</tr>
										<tr>
											<th>Vendor Name:</th>
											<td><?php echo $row['vendor_name'] ?></td>
										</tr>
										<tr>
											<th>Purchase Date:</th>
											<td><?php echo $row['puchase_date'] ?></td>
										</tr>
										<tr>
											<th>Custody:</th>
											<td><?php echo $row['custody'] ?></td>
										</tr>
									</table>
								</div>
								<div class="col-md-8">
									<h3>Scan Below Code</h3>
									<img src="<?php echo $row['qr_image'] ?>" height="250" />
								</div>
							</div>
								<h3 style="color:red;">Want To Assign This Product ?</h3>
								<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Assign To</label>
												<select id="dv" name="employee_id" class="form-control select2" required >
													<option value="">Select Employee</option>
													<?php 
													$sql	= "select * from inv_employee ORDER BY id ASC";
													$result = mysqli_query($conn, $sql);
													while($row=mysqli_fetch_array($result))
														{
													?>
													<option value="<?php echo $row['employeeid'] ?>">
													<?php echo $row['name'] ?>-<?php echo $row['employeeid'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Assign Date</label>
												<input name="assign_date" type="text" class="form-control" id="rndate" value="" size="30" autocomplete="off"/>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="id">Assigned By</label>
												<?php 
													$employee_id = $_SESSION['logged']['office_id'];
													$sqlemployee	= "select * from `inv_employee` where `employeeid`='$employee_id'";
													$resultemployee = mysqli_query($conn, $sqlemployee);
													$rowemployee=mysqli_fetch_array($resultemployee);
												?>
												<input type="text" class="form-control" id="" value="<?php echo $rowemployee["name"]; ?>" readonly required />
												<input name="assigned_by" type="hidden" id="assigned_by" value="<?php echo $rowemployee["employeeid"]; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="ad">Remarks</label>
												<textarea id="ad" name="remarks" class="form-control" placeholder=""></textarea>
											</div>
										</div>
									</div>
									<input type="hidden" name="product_id" value="<?php echo $id ?>" />
									<div class="row">
										<div class="col-md-8 mt-4">
											<div class="form-group">
												<button class="btn btn-danger" type="submit" id="assign_submit" name="assign_submit" style="width:100%"> Assign This Product</i></button>
											</div>
										</div>
									</div>
								</form>
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
 <script>
					$(function() {
					$("#rndate").datepicker({
							inline: true,
							dateFormat:"yy-mm-dd",
							yearRange:"-50:+10",
							changeYear: true,
							changeMonth: true
						});
					});
				</script>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>


