<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php';
include ('proloc_process.php');
 ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Organization Setup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Projects / Locations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <?php if (isset($_SESSION['response'])) { ?>
                                        <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <b><?= $_SESSION['response']; ?></b>
                                        </div>
                                        <?php } unset($_SESSION['response']); ?>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <h3 class="text-center">Add New Project/Location</h3>
                                    <form action="proloc_process.php" method="post">
                                      <input type="hidden" name="id" value="<?= $id; ?>">
                                      
                                      <!--- New Form Suppliers as Vendors--->
                                      <!--- New Form Suppliers as Vendors--->
                                      <div class="form-group">
                                        <select name="company_id" class="form-control" id="company" required>
                                            <option value="">Select Company</option>
                                            <?php
                                            $query = "SELECT * FROM companies";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                if($company_id == $row['id']){
                                                    $selected   = 'selected';
                                                    }else{
                                                    $selected   = '';
                                                    }
                                                
                                            echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['company_name'].'</option>';
                                            }
                                            }else{
                                            echo '<option value="">Company not available</option>';
                                            }
                                            ?>
                                        </select>
                                      </div></br>
                                      <div class="form-group">
                                        <select name="division_id" class="form-control" id="division" required>
                                            <option value="">Select Division</option>
                                        </select>
                                      </div></br>
                                      <div class="form-group">
                                        <select name="department_id" class="form-control" id="department" required>
                                            <option value="">Select Department</option>
                                        </select>
                                      </div></br>
                                      
                                      <div class="form-group">
                                        <input type="text" name="proloc_name" value="<?= $proloc_name; ?>" class="form-control" placeholder="Enter Name" required>
                                      </div></br>
                                      
                                      <!--- New Form Suppliers as Vendors--->
                                      <!--- New Form Suppliers as Vendors--->
                                      
                                      
                                      
                                      <div class="form-group">
                                        <?php if ($update == true) { ?>
                                        <input type="submit" name="update" class="btn btn-success btn-block" style="width:100%" value="Update Record">
                                        <?php } else { ?>
                                        <input type="submit" name="add" class="btn btn-primary btn-block" style="width:100%" value="Add Record">
                                        <?php } ?>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-header" style="padding-bottom: 5px;">
                                        <button class="btn btn-primary linktext" onclick="window.location.href='companies.php';"> Company List</button>
                                        <button class="btn btn-primary linktext" onclick="window.location.href='divisions.php';"> Division List</button>
                                        <button class="btn btn-primary linktext" onclick="window.location.href='departments.php';"> Department List</button>
                                        <button class="btn btn-success linktext"> Project/Location List</button>
                                    </div>
                                    <table class="table table-hover" id="example">
                                        <thead>
                                            <tr>
                                                <th width="10%">SL No</th>
                                                <th width="20%">Company</th>
                                                <th width="15%">Division</th>
                                                <th width="15%">Department</th>
                                                <th width="20%">Project/Location</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $projectsData = getTableDataByTableNameById('projects');
                                            if (isset($projectsData) && !empty($projectsData)) {
                                                $i=1;
                                                foreach ($projectsData as $data) {
                                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>
                                                <?php 
                                                $dataresult =   getDataRowByTableAndId('companies', $data['company_id']);
                                                echo (isset($dataresult) && !empty($dataresult) ? $dataresult->company_name : ''); 
                                                ?>
                                                </td>
                                                <td>
                                                <?php 
                                                $dataresult =   getDataRowByTableAndId('branch', $data['division_id']);
                                                echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); 
                                                ?>
                                                </td>
                                                <td>
                                                <?php 
                                                $dataresult =   getDataRowByTableAndId('department', $data['department_id']);
                                                echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); 
                                                ?>
                                                </td>
                                                <td><?php echo $data['project_name']; ?></td>
                                                <td>
                                                    <a href="proloc_process.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want delete this record?');"><i class="fa fa-trash"></i></a>
                                                    <a href="prolocs.php?edit=<?= $data['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                  </div>
                                </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
// Company dependent ajax
$("#company").on("change",function(){
    var companyId = $(this).val();
    $.ajax({
    url :"getcompany.php",
    type:"POST",
    cache:false,
    data:{companyId:companyId},
    success:function(data){
    $("#division").html(data);
    $('#department').html('<option value="">Select department</option>');
    }
    });
    });

// division dependent ajax
$("#division").on("change", function(){
    var divisionId = $(this).val();
    $.ajax({
    url :"getcompany.php",
    type:"POST",
    cache:false,
    data:{divisionId:divisionId},
    success:function(data){
    $("#department").html(data);
    $('#proloc').html('<option value="">Select project/location</option>');
    }
    });
    });
    
// department dependent ajax
$("#department").on("change", function(){
    var departmentId = $(this).val();
    $.ajax({
    url :"getcompany.php",
    type:"POST",
    cache:false,
    data:{departmentId:departmentId},
    success:function(data){
    $("#proloc").html(data);
    }
    });
    });
    
});
</script>