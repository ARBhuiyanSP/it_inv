<?php include 'header.php'; ?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php
            if(is_password_changed()){
        ?>
        <div class="row">
            <?php
                $currentUserId  = $_SESSION['logged']['user_id'];
                if(is_super_admin($currentUserId)){
                    include 'partial/dashboard_superadmin.php';
                }elseif($_SESSION['logged']['role_name']    ==  "member"){
                    include 'partial/dashboard_member.php';
                }elseif($_SESSION['logged']['role_name']    ==  "dh"){
                    include 'partial/dashboard_dh.php';
                }elseif($_SESSION['logged']['role_name']    ==  "ab"){
                    include 'partial/dashboard_ab.php';
                }
            ?>
            <!-- ./col -->
        </div>
		<?php
		$currentUserId  = $_SESSION['logged']['user_id'];
			if(is_super_admin($currentUserId)){
				//include 'partial/equipment_list.php';
			}elseif($_SESSION['logged']['role_name']    ==  "member"){
				
			}elseif($_SESSION['logged']['role_name']    ==  "dh"){
				//include 'partial/equipment_list.php';
			}elseif($_SESSION['logged']['role_name']    ==  "ab"){
//include 'partial/equipment_list.php';
		}}else{ ?>
            
			<div class="row">
				<div class="col-sm-12"><!-- Info Boxes Style 2 -->
					<div class="info-box bg-red">
						<span class="info-box-icon"><i class="fa fa-warning"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Dear User, You don not change your default password yet.Plaese Change it first.</span>

							<div class="progress">
								<div class="progress-bar" style="width: 50%"></div>
							</div>
							<span class="progress-description">
							<button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='employee_update.php?employee_id=<?php echo $_SESSION['logged']['user_id'] ?>';">Click to Change Password</button>
							</span>
						</div>
					<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
			</div>
            <?php } ?>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    // setTimeout(function() {
    //     window.location.reload();
    //   }, 30000);    
</script>
<?php include 'footer.php'; ?>
