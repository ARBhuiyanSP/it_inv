<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
		
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<style>

table tr th{
	 text-align:center;
	 font-size:10px;
}
table tr td{
	 text-align:center;
}
table td {
	font-size:10px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Maintenance Cost Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Maintenance Cost Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php if(hasAccessPermission($user_id_session, 'crlp', 'view_access')){ ?>
								<li><button class="btn btn-success" onclick="location.href='maintenance_cost.php';">Maintenance Cost Entry</button></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                     <div class="box-body">
		 <div class="row">
							<div class="col-sm-12">
								<form action="" method="post">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Equipment</label>
												<select class="form-control select2" id="eel_code" name="eel_code">
														<?php $results = mysqli_query($conn, "SELECT * FROM `equipments`"); 
														while ($row = mysqli_fetch_array($results)) { ?>
														<option value="<?php echo $row['eel_code']; ?>"><?php echo $row['eel_code']; ?> || <?php echo $row['name']; ?></option>
														<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label></label>
												<input type="submit" name="submit" id="submit" class="btn btn-block btn-primary" value="Search Data" />
											</div>
										</div>
									</div>
								</form>
							</div>
							 <?php
						if(isset($_POST['submit'])){ 
							/* $m_cost_id         =   $_POST['m_cost_id'];    
							$m_cost_parts_details    =   getMaintenanceCostDetailsData($m_cost_id);   
							$m_cost_info       =   $m_cost_parts_details['m_cost_info'];
							$m_cost_parts_details    =   $m_cost_parts_details['m_cost_parts_details']; */
						?>
						<div class="row">
								<?php
								$eel_code = $_POST['eel_code'];
								$sql	=	"select * from `equipments` where `eel_code`='$eel_code'";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
							</div>
							<div class="row" id="printableArea" style="display:block;">
								<div class="col-md-12">
									<center>
									<h5 align="center"><img src="images/spl.png" height="50"></h5>
									<h2>E-Engineering Limited</h2>
									<p>Khawaja Tower[13th Floor], 95 Bir Uttam A.K Khandokar Road, Mohakhali C/A, Dhaka-1212, Bangladesh</p>
									<h5><b>Equipment Maintenance Cost Report</b></h5>
									<table class="table" style="width:80%">
										<tr>
											<th>Name:</th>
											<td><?php echo $row['name']; ?>
											</td>
											<th>EEl Code:</th>
											<td><?php echo $row['eel_code'] ?></td>
											<th>Brand:</th>
											<td><?php echo $row['makeby'] ?></td>
											
										</tr>
										<tr>
											<th>Model:</th>
											<td><?php echo $row['model'] ?></td>
											<th>Origin:</th>
											<td><?php echo $row['origin'] ?></td>
											<th>Purchase Date:</th>
											<td><?php //echo $row['purchase_date'] ?></td>
										</tr>
									</table>
									
									<table id="" class="table table-bordered table-striped" style="width:90%">
										<thead>
											<tr>
												<th>Date of IN</th>
												<th>Date of Out</th>
												<th>Problem Description</th>
												<th>List of Used Spare Parts</th>
												<th>Responsible Mechanic</th>
												<th>Certified By</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$eel_code = $row['eel_code'];
											$sqlh	=	"select * from `maintenance_cost` where `eel_code`='$eel_code'";
											$resulth = mysqli_query($conn, $sqlh);
											while ($rowh = mysqli_fetch_array($resulth)) { ?>
										
											<tr>
												<td><?php 
												if($rowh['in_time']){
													$rDate = strtotime($rowh['in_time']);
													$rfDate = date("jS \of F Y",$rDate);
													echo $rfDate;
												}else{
													echo '---';
												}
												?>
												</td>
												<td><?php 
												if($rowh['out_time']){
													$rDate = strtotime($rowh['out_time']);
													$rfDate = date("jS \of F Y",$rDate);
													echo $rfDate;
												}else{
													echo '---';
												}
												?>
												</td>
												<td><?php echo $rowh['problem_details']; ?></td>
												<td>
													<table class="table">
														<tr>
															<td><b>Used Spare Parts</b></td>
															<td><b>Quantity</b></td>
															<td><b>Rate</b></td>
															<td><b>Amount</b></td>
														</tr>
														<?php 
															$m_cost_id = $rowh['m_cost_id'];
															$sqlparts	=	"select * from `maintenance_spare_parts` where `m_cost_id`='$m_cost_id'";
															$resultparts = mysqli_query($conn, $sqlparts);
															while ($rowparts = mysqli_fetch_array($resultparts)) {
														?>
														<tr>
															<td><?php echo $rowparts['spare_parts_name']; ?></td>
															<td><?php echo $rowparts['qty']; ?></td>
															<td><?php echo $rowparts['rate']; ?></td>
															<td><?php echo $rowparts['amount']; ?></td>
														</tr>
														<?php } ?>
													</table>
												</td>
												<td>
													<table class="table">
														<tr>
															<td><b>Name</b></td>
															<td><b>Signature</b></td>
														</tr>
														<?php 
															$m_cost_id = $rowh['m_cost_id'];
															$sqlmechanic	=	"select * from `maintenance_mechanic` where `m_cost_id`='$m_cost_id'";
															$resultmechanic = mysqli_query($conn, $sqlmechanic);
															while ($rowmechanic = mysqli_fetch_array($resultmechanic)) {
														?>
														<tr>
															<td><?php echo $rowmechanic['mechanic_name']; ?></td>
															<td></td>
														</tr>
														<?php } ?>
													</table>
												</td>
												<td><?php echo $rowh['certified_by']; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</center>
								</div>
							</div>
								
							<center><button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="font-size: 17px;"> Print</i></button></center>					
							<script>
							function printDiv(divName) {
								 var printContents = document.getElementById(divName).innerHTML;
								 var originalContents = document.body.innerHTML;

								 document.body.innerHTML = printContents;

								 window.print();

								 document.body.innerHTML = originalContents;
							}
							</script>
						<?php  } ?>
	

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
