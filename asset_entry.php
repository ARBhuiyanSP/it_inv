<?php include 'header.php';
include 'includes/asset_process.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
				<div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Asset Entry</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="assets-list.php"><i class="fa fa-user-plus"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php include 'partial/asset_entry_form.php'; ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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