
	<script type="text/javascript">
        $(document).ready(function(){

            $(document).on('keydown', '.employeeid', function() {
                
                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];

                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "getEmpDetails.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,request:1
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    select: function (event, ui) {
                        $(this).val(ui.item.label); // display the selected text
                        var userid = ui.item.value; // selected id to input

                        // AJAX
                        $.ajax({
                            url: 'getEmpDetails.php',
                            type: 'post',
                            data: {userid:userid,request:2},
                            dataType: 'json',
                            success:function(response){
                                
                                var len = response.length;

                                if(len > 0){
                                    var id = response[0]['id'];
                                    var name = response[0]['name'];
                                    var designation = response[0]['designation'];
                                    var department = response[0]['department'];
                                    var division = response[0]['division'];
                                    var group = response[0]['group'];

                                    document.getElementById('name_'+index).value = name;
                                    document.getElementById('designation_'+index).value = designation;
                                    document.getElementById('department_'+index).value = department;
                                    document.getElementById('division_'+index).value = division;
                                    document.getElementById('group_'+index).value = group;
                                }  
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
<form role="form" method="post">
    <div class="box-body">
        <div class="row">
            	<!--------------Employee-------------->
						
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="field_title">Employee ID<span class="reqr"> is required***</span></label>
								<input type='text' name="office_id" class='form-control employeeid' id='employeeid_1' placeholder='Enter employee id No' required >
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="field_title">Division</label>
                                <input type='text' name="" class='form-control division' id='division_1' readonly >
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="field_title">Department</label>
                                <input type='text' name="" class='form-control department' id='department_1' readonly >
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="field_title">Designation</label>
                                <input type='text' name="" class='form-control designation' id='designation_1' readonly >
                            </div>
                        </div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="field_title">Group</label>
								<input type='text' name="" class='form-control group' id='group_1' readonly >
							</div>
						</div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="field_title">Employee Name</label>
                                <input type='text' name="name" class='form-control name' id='name_1' readonly >
                            </div>
                        </div>
						<!--------------Employee-------------->
			
            <div class="col-md-2"></div>
            <div class="col-md-2">
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
            </div>
       
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sel1">Department:</label>
                    <select class="form-control select2" id="department_id" name="department_id">
                        <option value="">Please select</option>
<!-- <?php
$table = "department";
$order = "ASC";
$column = "name";
$datas = getTableDataByTableName($table, $order, $column);
foreach ($datas as $data) {
    ?>
                            <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
<?php } ?> -->
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleId">Designation</label>
                    <select class="form-control select2" id="designation" name="designation">
						<option value="">Please select</option>
						<?php
						$table = "designations";
						$order = "ASC";
						$column = "name";
						$datas = getTableDataByTableName($table, $order, $column);
						foreach ($datas as $data) {
							?>
							<option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-md-2">
                <div class="form-group">
                    <label for="sel1">Group:</label>
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
            </div>
			<div class="col-md-2">
                <div class="form-group">
                    <label for="sel1">Projects:</label>
                    <select class="form-control select2" id="project_id" name="project_id">
                        <option value="">Please select</option>
						<?php
						$table = "projects";
						$order = "ASC";
						$column = "project_name";
						$datas = getTableDataByTableName($table, $order, $column);
						foreach ($datas as $data) {
							?>
						<option value="<?php echo $data->id; ?>"><?php echo $data->project_name; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password" value="">
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <input type="submit" name="user_create" class="btn btn-primary btn-block" value="Create">
    </div>
</form>