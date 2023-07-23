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
            <small>Equipment Inspection</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Equipment Inspection</li>
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
                                <li><a href="equipment_list.php"><i class="fa fa-list"></i> List</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									
									<div class="page-title-box">
                                    <h4 class="page-title">Equipment Inspection</h4>

                                    <div class="clearfix"></div>
                                </div>
									<div class="row">
							<?php
							$id         =   $_GET['id']; 
							$sql	=	"select * from equipments where id=$id";
							$result = mysqli_query($conn, $sql);
							$row=mysqli_fetch_array($result);
							?>
                            <div class="col-lg-12">
								<table style="" class="table table-bordered">
									<tr>
										<th>Name:</th>
										<td>
										<?php echo $row['name'];?>
										</td>
										<td width="50%" rowspan="6"><center><h3>Equipment Image Not Found</h3></center></td>
									</tr>
									<tr>
										<th>EEL Code:</th>
										<td><?php echo $row['eel_code'] ?></td>
									</tr>
									<tr>
										<th>Origin:</th>
										<td><?php echo $row['origin'] ?></td>
									</tr>
									<tr>
										<th>Capacity:</th>
										<td><?php echo $row['capacity'] ?></td>
									</tr>
									<tr>
										<th>Model:</th>
										<td><?php echo $row['model'] ?></td>
									</tr>
									<tr>
										<th>Last Inspaction:</th>
										<td><?php echo $row['inspaction_date'] ?></td>
									</tr>
								</table>
							</div>
						</div>
						<form action="" method="post">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Inspection Date</label>
										<input name="ins_date" type="text" class="form-control" id="rlpdate" value="" size="30" autocomplete="off"/>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Inspection Status</label>
										<select id="dv" name="status" class="form-control select2">
											<option value="ok">Running</option>
											<option value="idle">Idle</option>
											<option value="breakdown">Breakdown</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label for="ad">Remarks</label>
										<textarea id="ad" name="remarks" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
							<input type="hidden" name="product_id" value="<?php echo $row['eel_code'] ?>" />
							<button class="btn btn-block btn-danger" type="submit" name="ins_submit"> Submit</i></button>
						</form>
								</div>
								<div class="col-md-1"></div>
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
