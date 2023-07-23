<?php
$user_id_session = $_SESSION['logged']['user_id'];
$user_type = $_SESSION['logged']['type'];
?>
<style>
.sidebar-menu li.header{
	padding:5px 25px 5px 15px;
}
.sidebar-menu>li>a {
	padding:5px 5px 5px 15px;
}
.sidebar-menu>li{
	border-bottom:1px solid #1A2226;
}
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="images/icon/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['logged']['user_name']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less general_sms_create -->
        <ul class="sidebar-menu" data-widget="tree">
            <?php if (is_super_admin($user_id_session)) { ?>
            
                <li class="header">Settings</li>
                <li class="<?php if ($page_name == "users_list.php") {
                echo "active";
            } ?>"><a href="users_list.php"><i class="fa fa-user-circle"></i> <span>User</span></a></li>

            <li class="<?php if ($page_name == "companies.php") {
                echo "active";
            } ?>"><a href="companies.php"><i class="fa fa-user-circle"></i> <span>Organization</span></a></li>

			
			<!-- <li class="<?php if ($page_name == "supplier_create.php") {
                echo "active";
            } ?>"><a href="supplier_create.php"><i class="fa fa-window-restore"></i> <span>Suppliers</span></a></li>
			
			<li class="<?php if ($page_name == "division_create.php") {
                echo "active";
            } ?>"><a href="division_create.php"><i class="fa fa-window-maximize"></i> <span>Division</span></a></li>
			
			<li class="<?php if ($page_name == "department_create.php") {
                echo "active";
            } ?>"><a href="department_create.php"><i class="fa fa-window-restore"></i> <span>Department</span></a></li>
			
			
                <li class="<?php if ($page_name == "role_access.php") {
                echo "active";
            } ?>"><a href="role_access.php"><i class="fa fa-superpowers"></i> <span>Role Access</span></a></li> -->
                <li class="<?php if ($page_name == "rlp_approve_chain_list.php") {
                echo "active";
            } ?>"><a href="rlp_approve_chain_list.php"><i class="fa fa-recycle"></i> <span>RLP Approval Chain</span></a></li>
			
			 <li class="<?php if ($page_name == "notesheet_approve_chain_list.php") {
                echo "active";
            } ?>"><a href="notesheet_approve_chain_list.php"><i class="fa fa-recycle"></i> <span>Notesheet Approval Chain</span></a></li>
			
			
			<!-- <li class="<?php if ($page_name == "candidates_create.php") {
                echo "active";
            } ?>"><a href="candidates_create.php"><i class="fa fa-window-restore"></i> <span>Candidates</span></a></li> --->
			
			
               <!-- <li class="<?php if ($page_name == "import_system.php") {
                echo "active";
            } ?>"><a href="import_system.php"><i class="fa fa-upload" aria-hidden="true"></i> <span>Import</span></a></li>--->
			<li class="<?php if ($page_name == "import_system.php") {
                echo "active";
            } ?>"><a href="backup_system.php"><i class="fa fa-download" aria-hidden="true"></i> <span>Data Backup</span></a></li>
<?php } ?>
            <li class="header">Operation</li>
            <?php if (hasAccessPermission($user_id_session, 'rlp_list', 'view_access')) { ?>
				<li class="<?php if ($page_name == "rlp_list.php") {
                echo "active";
            } ?>">
                    <a href="rlp_list.php"><i class="fa fa-file-text-o"></i> <span>RLP</span></a>
                </li>
				
				
				
			<?php if (is_not_guest($user_id_session)) { ?>
				
				
				<?php if ($_SESSION['logged']['type']!='user') { ?>		
				<li class="<?php if ($page_name == "notesheets_list.php") {
                echo "active";
            } ?>">
                    <a href="notesheets_list.php"><i class="fa fa-file-text-o"></i> <span>Notesheet</span></a>
                </li>
				<li class="<?php if ($page_name == "workorders_list.php") {
                echo "active";
            } ?>">
                    <a href="workorders_list.php"><i class="fa fa-file-text-o"></i> <span>Workorders</span></a>
                </li>
				<?php }} ?>
				<?php if ($_SESSION['logged']['type']!='user') { ?>	
				<!-- <li class="<?php if ($page_name == "equipment_list.php") {
                echo "active";
            } ?>">
                    <a href="equipment_list.php"><i class="fa fa-file-text-o"></i> <span>Equipment</span></a>
                </li> -->
				<?php } ?>
<li class="header">Assets</li>
				<li class="<?php if ($page_name == "assets-list.php") {
                echo "active";
            } ?>">
                    <a href="assets-list.php"><i class="fa fa-file-text-o"></i> <span>Assets</span></a>
                </li>

                <li class="<?php if ($page_name == "assign-list.php") {
                echo "active";
            } ?>">
                    <a href="assign-list.php"><i class="fa fa-file-text-o"></i> <span>Assigned</span></a>
                </li>

                <!-- <li class="<?php if ($page_name == "service_entry.php") {
                echo "active";
            } ?>">
                    <a href="service_entry.php"><i class="fa fa-file-text-o"></i> <span>Service Area</span></a>
                </li> -->
				
<li class="header">Consumable Products</li>
				<li class="<?php if ($page_name == "receive-list.php") {
                echo "active";
            } ?>">
                    <a href="receive-list.php"><i class="fa fa-file-text-o"></i> <span>Receive</span></a>
                </li>
				<li class="<?php if ($page_name == "issue-list.php") {
                echo "active";
            } ?>">
                    <a href="issue-list.php"><i class="fa fa-file-text-o"></i> <span>Issue/Consumption</span></a>
                </li>
				
				
<?php } ?>
			<!--- <li class="header">Maintenance</li>
			<li class="<?php if ($page_name == "schedulemaintenance.php") {
                echo "active";
            } ?>">
                    <a href="schedulemaintenance.php"><i class="fa fa-file-text-o"></i> <span>Schedule Maintenance</span></a>
                </li>
			<li class="<?php if ($page_name == "maintenance_cost.php") {
                echo "active";
            } ?>">
                    <a href="maintenance_cost.php"><i class="fa fa-file-text-o"></i> <span>Maintenance Cost</span></a>
                </li>
				<li class="<?php if ($page_name == "inspection.php") {
                echo "active";
            } ?>">
                    <a href="inspection.php"><i class="fa fa-file-text-o"></i> <span>Inspection</span></a>
                </li>
				
			<li class="<?php if ($page_name == "rlp_list.php") {
                echo "active";
            } ?>">
                    <a href="http://45.249.102.75/cted_inv/" target="blank"><i class="fa fa-file-text-o"></i> <span>Spare Parts</span></a>
                </li> --->
		   
				
            <li class="header">Report</li>
<?php if (hasAccessPermission($user_id_session, 'rlp_report', 'view_access')) { ?>
                <li class="<?php if ($page_name == "rlp_list.php") {
                echo "active";
            } ?>">
                    <a href="reports.php"><i class="fa fa-file-text-o"></i> <span>Reports Section</span></a>
                </li>
<?php } ?>
            <!--setActiveMenuClass-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>