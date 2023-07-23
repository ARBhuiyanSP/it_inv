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
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php if(hasAccessPermission($user_id_session, 'crlp', 'view_access')){ ?>
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
										<div class="col-sm-3">
											<div class="form-group">
												<label>Project</label>
												<select class="form-control select2" id="project_id" name="project_id">
														<option value="all">All Project</option>
														<?php $results = mysqli_query($conn, "SELECT * FROM `projects`"); 
														while ($row = mysqli_fetch_array($results)) { ?>
														<option value="<?php echo $row['id']; ?>"><?php echo $row['project_name']; ?></option>
														<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Make By</label>
												<select class="form-control select2" id="makeby" name="makeby">
														<option value="all">All Brand</option>
														<option value="DENAIR">DENAIR</option>
														<option value="ULTRATEX">ULTRATEX</option>
														<option value="VOGLEE">VOGLEE</option>
														<option value="TTM">TTM</option>
														<option value="CASE">CASE</option>
														<option value="ZENITH">ZENITH</option>
														<option value="ZOOMLION">ZOOMLION</option>
														<option value="LOCAL">LOCAL</option>
														<option value="POWER PLUS">POWER PLUS</option>
														<option value="LIUGONG">LIUGONG</option>
														<option value="NICOL">NICOL</option>
														<option value="XCMG">XCMG</option>
														<option value="DAWEOO">DAWEOO</option>
														<option value="SIFANG">SIFANG</option>
														<option value="FUJIAN">FUJIAN</option>
														<option value="MINDONG">MINDONG</option>
														<option value="TEKSAN">TEKSAN</option>
														<option value="PRAMAC">PRAMAC</option>
														<option value="STARKE">STARKE</option>
														<option value="IHC-BEAVER">IHC-BEAVER</option>
														<option value="Longking">Longking</option>
														<option value="JULONG">JULONG</option>
														<option value="SINO">SINO</option>
														<option value="EICHER">EICHER</option>
														<option value="DOOSAN">DOOSAN</option>
														<option value="SOOSAN">SOOSAN</option>
														<option value="TATA">TATA</option>
														<option value="ACE">ACE</option>
														<option value="HAMM">HAMM</option>
														<option value="JUNMA">JUNMA</option>
														<option value="AMYTECH">AMYTECH</option>
														<option value="SONALIKA">SONALIKA</option>
														<option value="TAFE">TAFE</option>
														<option value="Changling">Changling</option>
														<option value="Euro">Euro</option>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label></label>
												<input type="submit" name="submit" id="submit" class="btn btn-block btn-success" value="Search Data" />
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label></label>
												<input type="button" name="" id="" class="btn btn-block btn-primary" value="Back To Reports Section" onclick="location.href='reports.php';"/>
											</div>
										</div>
									</div>
								</form>
							</div>
							 <?php
if(isset($_POST['submit'])){
	$assign_status	= 'assigned';
	//$origin			= $_POST['origin'];
	$project_id		= $_POST['project_id'];
	$makeby			= $_POST['makeby'];
	
	//query from db
	
	$resultSet = mysqli_query($conn, "SELECT * FROM `equipments` WHERE `assign_status` =  '$assign_status'".($project_id!='all'?" AND `project_id` = '$project_id'":'')." ".($makeby!='all'?" AND `makeby` = '$makeby'":'')." ");
	$count = $resultSet->num_rows;
	
/* 	echo "<pre>";
print_r($resultSet);
echo "</pre>"; */
	
	if($resultSet->num_rows > 0){
		echo "<div id='printableArea'><center><h1 align='center'><img src='images/spl.png' height='50' style='padding-top:10px'></h1><h2>SAIF POWERTEC LIMITED</h2><p>72,Mohakhali C/A, (8th Floor),Rupayan Center,Dhaka-1212,bangladesh</p><h3>Equipment List Report</h3>Total Equipment: $count</center>";
		echo "<table id='rlp_list_table' class='table table-bordered table-striped list-table-custom-style'>
		<tr>
			<th>SL No</th>
			<th>Name</th>
			<th>EEl Code</th>
			<th>Origin</th>
			<th>Capacity</th>
			<th>Make By</th>
			<th>Model</th>
		</tr>";

		$i = 0;
		while($rows = $resultSet->fetch_assoc()) {
			$i++;
			echo "<tr><td>" . $i . "</td>
					<td>" . $rows['name'] . "</td>
					<td>" . $rows['eel_code'] . "</td>
					<td>" . $rows['origin'] . "</td>
					<td>" . $rows['capacity'] . "</td>
					<td>" . $rows['makeby'] . "</td>
					<td>" . $rows['model'] . "</td>
					
					
				</tr>";
			
		}
		echo "</table></div>";
	}
	else{
		echo "<center>No Result</center>";
	}
}
?>
<div class="row">
	<div class="col-sm-12">
		<center>
			<a class="btn btn-default" onclick="printDiv('printableArea')" value="print a div!" style="margin-top:5px;">
				<i class="fa fa-print"></i> Print 
			</a>
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
</div>
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
