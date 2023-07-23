<?php
    $currentUserId		=   $_SESSION['logged']['user_id'];
    $id         		=   $_GET['id'];    
    $equipment_details	=   getEquipmentDetailsData($id);   
    $equipment_info  	=   $equipment_details['equipments'];
    $equipment_details 	=   $equipment_details['equipments'];
	
    if(!empty($_SESSION['logged']['branch_id']) && !empty($_SESSION['logged']['department_id'])){
?>
<form action="" method="post">
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Date</label>
                <input name="commissioning_date" type="text" class="form-control" id="rlpdate" value="" size="30" autocomplete="off" />
            </div>
        </div>
		<div class="col-sm-2">
            <div class="form-group">
				<label for="division/company">Project:</label>
				<select class="all_emplyees form-control" id="project_id" name="project_id" required >
					<option value="">Select Project</option>
					<?php
					$tableName = 'projects';
					$column = 'project_name';
					$order = 'asc';
					$dataType = 'obj';
					$projectsData = getTableDataByTableName($tableName, $order, $column, $dataType);
					if (isset($projectsData) && !empty($projectsData)) {
						foreach ($projectsData as $data) {
							
							if($equipment_info->project_id == $data->id){
								$selected	= 'selected';
								}else{
								$selected	= '';
								}
							
							?>
							<option value="<?php echo $data->id; ?>" <?php echo $selected; ?>><?php echo $data->project_name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
        </div>
		<div class="col-sm-2">
            <div class="form-group">
				<label for="division/company">Sub Project:</label>
                <select class="all_emplyees form-control" id="sub_project_id" name="sub_project_id" >
					<option value="">Select Sub Project</option>
					<?php
					$tableName = 'sub_projects';
					$column = 'name';
					$order = 'asc';
					$dataType = 'obj';
					$projectsData = getTableDataByTableName($tableName, $order, $column, $dataType);
					if (isset($projectsData) && !empty($projectsData)) {
						foreach ($projectsData as $data) {
							if($equipment_info->sub_project_id == $data->id){
								$selected	= 'selected';
								}else{
								$selected	= '';
								}
							?>
							<option value="<?php echo $data->id; ?>" <?php echo $selected; ?>><?php echo $data->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
        </div>
		<div class="col-sm-2">
            <div class="form-group">
				<label for="exampleId">Type:</label>
                <div class="radio">
                    <label><input type="radio" name="equipment_type" value="1" <?php if($equipment_info->equipment_type == 1){ echo 'checked'; } ?> > <span class="label label-success">OWN</span> </label>
                    <label><input type="radio" name="equipment_type" value="2" <?php if($equipment_info->equipment_type == 2){ echo 'checked'; } ?>> <span class="label label-danger">RENTAL</span> </label>
                </div>
			</div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php echo $equipment_info->name; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">EEL Code</label>
                <input name="eel_code" type="text" class="form-control" id="eel_code" value="<?php echo $equipment_info->eel_code; ?>" autocomplete="off" required />
            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-sm-2">
            <div class="form-group">
				<label for="division/company">Country Origin:</label>
                <select class="all_emplyees form-control" id="origin" name="origin" required >
					<option value="">Select</option>
					<?php
					$tableName = 'country';
					$column = 'nicename';
					$order = 'asc';
					$dataType = 'obj';
					$projectsData = getTableDataByTableName($tableName, $order, $column, $dataType);
					if (isset($projectsData) && !empty($projectsData)) {
						foreach ($projectsData as $data) {
							if($equipment_info->origin == $data->nicename){
								$selected	= 'selected';
								}else{
								$selected	= '';
								}
							?>
							<option value="<?php echo $data->nicename; ?>" <?php echo $selected; ?>><?php echo $data->nicename; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <label for="exampleId">Capacity</label>
                <input name="capacity" type="text" class="form-control" id="capacity" value="<?php echo $equipment_info->capacity; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Brand/Make By</label>
                <input name="makeby" type="text" class="form-control" id="makeby" value="<?php echo $equipment_info->makeby; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Model</label>
                <input name="model" type="text" class="form-control" id="model" value="<?php echo $equipment_info->model; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="exampleId">Year of Manufacture</label>
                <input name="year_manufacture" type="text" class="form-control" id="year_manufacture" value="<?php echo $equipment_info->year_manufacture; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Inventory SL No</label>
                <input name="inventory_sl_no" type="text" class="form-control" id="inventory_sl_no" value="<?php echo $equipment_info->inventory_sl_no; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="exampleId">Engine Model</label>
                <input name="engine_model" type="text" class="form-control" id="engine_model" value="<?php echo $equipment_info->engine_model; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="exampleId">Engine SL No</label>
                <input name="engine_sl_no" type="text" class="form-control" id="engine_sl_no" value="<?php echo $equipment_info->engine_sl_no; ?>" autocomplete="off" required />
            </div>
        </div>
		<div class="col-sm-2">
            <div class="form-group">
				<label for="division/company">Present Location:</label>
                <select class="all_emplyees form-control" id="present_location" name="present_location" required >
					<option value="">Select Project</option>
					<?php
					$tableName = 'projects';
					$column = 'project_name';
					$order = 'asc';
					$dataType = 'obj';
					$projectsData = getTableDataByTableName($tableName, $order, $column, $dataType);
					if (isset($projectsData) && !empty($projectsData)) {
						foreach ($projectsData as $data) {
							if($equipment_info->present_location == $data->project_name){
								$selected	= 'selected';
								}else{
								$selected	= '';
								}
							?>
							<option value="<?php echo $data->project_name; ?>" <?php echo $selected; ?>><?php echo $data->project_name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
        </div>
		<div class="col-sm-2">
            <div class="form-group">
				<label for="division/company">Present Condition:</label>
                <select class="all_emplyees form-control" id="present_condition" name="present_condition" required >
					<option value="">Select</option>
					<?php
					$tableName = 'present_condition';
					$column = 'name';
					$order = 'asc';
					$dataType = 'obj';
					$projectsData = getTableDataByTableName($tableName, $order, $column, $dataType);
					if (isset($projectsData) && !empty($projectsData)) {
						foreach ($projectsData as $data) {
							if($equipment_info->present_condition == $data->name){
								$selected	= 'selected';
								}else{
								$selected	= '';
								}
							?>
							<option value="<?php echo $data->name; ?>" <?php echo $selected; ?>><?php echo $data->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="exampleId">Price</label>
                <input name="price" type="text" class="form-control" id="price" value="<?php echo $equipment_info->price; ?>" autocomplete="off" required />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleId">Remarks:</label>
                <textarea class="form-control" id="" name="remarks" rows="1"><?php echo $equipment_info->remarks; ?></textarea>
            </div>
        </div>
    </div>
	<input name="id" type="hidden" class="form-control" id="" value="<?php echo $equipment_info->id; ?>" />
    <div class="row" style="padding-top:5px;">
        <div class="col-sm-12">
            <input type="submit" name="equipment_update" id="submit" class="btn btn-block btn-primary" value="Update Equipment Data" />
        </div>
    </div>
</form>

    <?php }else{ ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Division and Department are required to create RLP .
    </div>
    <?php } ?>