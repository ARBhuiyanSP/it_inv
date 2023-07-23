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
            <small>Equipment List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Equipment List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                     <div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<form action="" method="post">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Equipment</label>
												<select class="form-control select2" id="project_id" name="eel_code">
														<?php $results = mysqli_query($conn, "SELECT * FROM `equipments`"); 
														while ($row = mysqli_fetch_array($results)) {
															if($_POST['eel_code'] == $row['eel_code']){
																$selected	= 'selected';
																}else{
																$selected	= '';
																}
															?>
														<option value="<?php echo $row['eel_code']; ?>" <?php echo $selected; ?>><?php echo $row['eel_code']; ?> || <?php echo $row['name']; ?></option>
														<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label></label>
												<input type="submit" name="submit" id="submit" class="btn btn-block btn-primary" value="NEXT" />
											</div>
										</div>
									</div>
								</form>
							</div>
							<?php    
								if(isset($_POST['submit'])){ 
									$eel_code = $_POST['eel_code'];
									$sql	=	"select * from `equipments` where `eel_code`='$eel_code'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									$id			= $row['eel_code'];
									$log_details    =   getLogDetailsData($id);   
									$log_info       =   $log_details['tb_logsheet'];
									$log_details    =   $log_details['tb_logsheet'];
							?>
							
							<form action="" method="post">
								<div class="" id="printableArea" style="display:block;">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Date</label>
											<input name="d_date" type="text" class="form-control" id="rlpdate" value="<?php echo date("Y-m-d"); ?>" size="30" autocomplete="off" required />
										</div>
									</div>
									
									 <div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">EEL Code</label>
											<input name="equipment_code" type="text" class="form-control" id="equipment_code" value="<?php echo $row['eel_code']; ?>" autocomplete="off" readonly />
										</div>
									</div>
									
									
									 <div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Equipment Name</label>
											<input name="equipment_Name" type="text" class="form-control" id="equipment_Name" value="<?php echo $row['name']; ?>" autocomplete="off" readonly />
										</div>
									</div>
									
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Project</label>
											<input name="" type="text" class="form-control" id="" value="<?php $dataresult =   getDataRowByTableAndId('projects', $row['project_id']); echo (isset($dataresult) && !empty($dataresult) ? $dataresult->project_name : ''); ?>" autocomplete="off" readonly />
										</div>
									</div>
									<input name="project_id" type="hidden" class="form-control" id="project_id" value="<?php echo $row['project_id']; ?>" autocomplete="off" />
									
									
								   <div class="col-md-4">
										<div class="form-group">
											<label for="exampleId">Work Narration</label>
											<textarea class="form-control" id="" name="workdetails" rows="1"></textarea>
										</div>
									</div>
									
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Running (Hr/KM)</label>
											<input name="runninghrkm" type="text" class="form-control" id="runninghrkm" value="<?php if(isset($log_info->closehrkm)){echo $log_info->closehrkm;} ?>" onkeyup="sum()" required />
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Close (Hr/KM)</label>
											<input name="closehrkm" type="number" class="form-control" id="closehrkm" onkeyup="sum()" autocomplete="off" min="<?php if(isset($log_info->closehrkm)){echo $log_info->closehrkm;} ?>" required />
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Total hour(Hr/KM)</label>
											<input name="totalhrkm" type="text" class="form-control" id="sumhrkm" value="" autocomplete="off" readonly />
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Status</label>
											
											<select class="form-control select2"  name="standby">
												<option value="">Select</option>
												<option value="Running">Running</option>
												<option value="Stand By">Stand By</option>
												<option value="Breakdown">Breakdown</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Hydraulic (Ltr)</label>
											<input name="hydrolicltr" type="text" class="form-control" id="hydrolicltr" value="" autocomplete="off"  />
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Diesel (Ltr)</label>
											<input name="disealltr" type="text" class="form-control" id="disealltr" value="" autocomplete="off"  />
										</div>
									</div>
									
									 <div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Engine oil</label>
											<input name="engineoil" type="text" class="form-control" id="engineoil" value="" autocomplete="off"  />
										</div>
									</div>
									
									
									
											 <div class="col-sm-2">
										<div class="form-group">
											<label for="exampleId">Greasing Hour Servicing</label>
											<input name="greasing" type="text" class="form-control" id="greasing" value="" autocomplete="off"  />
										</div>
									</div>
									
									
									<div class="col-sm-12">
										<input type="submit" name="logsheet_entry" id="submit" class="btn btn-block btn-primary" value="Save Data" />
									</div>
								</div>
							</form>
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
<script>
function sum() {
            var runninghrkm = document.getElementById('runninghrkm').value;
            var closehrkm = document.getElementById('closehrkm').value;

 

            var result =  parseInt(closehrkm) - parseInt(runninghrkm);
            if (!isNaN(result)) {
                document.getElementById('sumhrkm').value = result;
            }
        }
</script>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
