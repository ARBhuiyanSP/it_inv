<?php
include 'header.php';
$_SESSION['activeMenu'] = 'agency';
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
            Group Access
            <small>Assign</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User Info</a></li>
            <li class="active">User Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="" method="post">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->                        
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Group:</label>
                                <select class="form-control" id="group_id" name="group_id">
                                    <option value="">Please select</option>
                                    <?php
                                    $table = "roles";
                                    $order = "ASC";
                                    $column = "name";
                                    $datas = getTableDataByTableName($table, $order, $column);
                                    foreach ($datas as $data) {
                                        ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Division:</label>
                                <select class="form-control" id="branch_id" name="branch_id" onchange="getDepartmentByBranch(this.value);">
                                    <option value="">Please select</option>
                                    <?php
                                    $table = "branch";
                                    $order = "ASC";
                                    $column = "name";
                                    $datas = getTableDataByTableName($table, $order, $column);
                                    foreach ($datas as $data) {
                                        ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Department:</label>
                                <select class="form-control" id="department_id" name="department_id" onchange="getDepartmentWiseUsers('branch_id','department_id','access_form','user_id');">
                                    <option value="">Please select</option>
                                    <?php
                                    $table = "department";
                                    $order = "ASC";
                                    $column = "name";
                                    $datas = getTableDataByTableName($table, $order, $column);
                                    foreach ($datas as $data) {
                                        ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Users:</label>
                                <select class="form-control" id="user_id" name="user_id" onchange="getRoleAccessDetails(this.value);">
                                    <option value="">Select User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Page name</th>
                                            <th style="text-align: center;">Add</th>
                                            <th style="text-align: center;">Edit</th>
                                            <th style="text-align: center;">Delete</th>
                                            <th style="text-align: center;">View</th>
                                            <th style="text-align: center;">Print</th>
                                            <th style="text-align: center;">All</th>
                                        </tr>
                                    </thead>
                                    <tbody id='page_assign_body'>
                                        <?php
                                        $table = "page_details";
                                        $order = "ASC";
                                        $column = "show_order";
                                        $pagedetails = getTableDataByTableName($table, $order, $column);
                                        if (isset($pagedetails) && !empty($pagedetails)) {
                                            foreach ($pagedetails as $data) {
                                                ?>
                                                <tr>
                                                    <td style="text-align: right;"><?php echo $data->name ?></td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="add[]" value="<?php echo $data->id; ?>">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="edit[]" value="<?php echo $data->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="delete[]" value="<?php echo $data->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="view[]" value="<?php echo $data->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="print[]" value="<?php echo $data->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="All[]" value="<?php echo $data->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-6">
                                    <input type="submit" class="btn btn-success btn-block" name="role_access_update" value="Update">
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>
                <!-- /.box-body -->
            </div>
        </form>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
