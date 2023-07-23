<?php
$NotesheetListData = getNotesheetListData();
if (isset($NotesheetListData) && !empty($NotesheetListData)) {
    ?>
    <div class="table-responsive">
        <table id="rlp_list_table" class="table table-bordered table-striped list-table-custom-style">
            <thead>
                <tr>
                    <th>SLN#</th>
                    <th>Notesheet No</th>
                    <th>RLP No</th>
                    <th>Supplier</th>
                    <th>Created At</th>
                    <th>Project name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = 0;
                $delUrl =   "function/rlp_process.php?process_type=rlp_delete";
                //$approve_url =   "function/rlp_process.php?process_type=rlp_approve";
				$role       =   get_role_group_short_name();
				if(is_super_admin($currentUserId)){
					//include 'rrr_update_view_sa.php';
					$approve_url =   "function/rlp_process.php?process_type=rlp_dh_common_update_execute";
				}elseif($role    ==  "member"){
					//include 'rrr_update_view_member.php';
					$approve_url =   "function/rlp_process.php?process_type=rlp_dh_common_update_execute";
				}elseif($role    ==  "dh"){
					//include 'rrr_update_view_dh.php';
					$approve_url =   "function/rlp_process.php?process_type=rlp_dh_common_update_execute";
				}elseif($role    ==  "ab"){
					//include 'rrr_update_view_ab.php';
					$approve_url =   "function/rlp_process.php?process_type=rlp_ab_common_update_execute";
				}else{
					//include 'rrr_update_view_dh.php';
					$approve_url =   "function/rlp_process.php?process_type=rlp_dh_common_update_execute";
				}
                foreach ($NotesheetListData as $adata) {
                    ?>
                    <tr id="row_id_<?php echo $adata->id; ?>">
                        <td><?php echo ++$sl; ?> </td>
                        <td>
                            <div title="RLP quick view" onclick="rlp_quick_view('<?php echo $adata->id ?>');" style="cursor: pointer;padding: 2% 2%; font-weight: bold; background-color: <?php echo get_status_color($adata->notesheet_status); ?>">
                                <span>
                                    <?php echo (isset($adata->notesheet_no) && !empty($adata->notesheet_no) ? $adata->notesheet_no : 'No data'); ?>
                                </span>
                            </div>
                        </td>
						 <td><?php echo (isset($adata->rlp_no) && !empty($adata->rlp_no) ? $adata->rlp_no : 'No data'); ?></td>
						 <td><?php echo (isset($adata->supplier_name) && !empty($adata->supplier_name) ? $adata->supplier_name : 'No data'); ?></td>
						 
                        <td><?php echo (isset($adata->created_at) && !empty($adata->created_at) ? human_format_date($adata->created_at) : 'No data'); ?></td>
						
                        <td><?php echo (isset($adata->request_project) && !empty($adata->request_project) ? getProjectNameById($adata->request_project) : 'No data'); ?></td>
                        
						
                        <td>
                            <div style="padding: 2% 10%; font-weight: bold; background-color: <?php echo get_status_color($adata->notesheet_status); ?>">
                                <?php echo get_status_name($adata->notesheet_status); ?>
                            </div>
                        </td>
                        <td>
                            <?php if (!is_super_admin($user_id_session)) {?>
							
							<?php if(hasAccessPermission($user_id_session, 'crlp', 'edit_access') && get_status_name($adata->notesheet_status)!='Approve'){ ?>
                            <a title="Edit RLP" class="btn btn-sm btn-info" href="notesheet_update.php?id=<?php echo $adata->id; ?>">
                                <span class="fa fa-pencil"> Approval</span>
                            </a>
                            <?php } }?>
							
							
							
							<!-- <?php if(hasAccessPermission($user_id_session, 'crlp', 'edit_access') && get_status_name($adata->notesheet_status)!='Approve'){ ?>
                            <a title="Delete RLP" class="btn btn-sm btn-success" href="javascript:void(0)" onclick="commonApproveOperation('<?php echo $approve_url ?>', '<?php echo $adata->id ?>', '<?php echo $_SESSION['logged']['user_id'] ?>');">
                                <span class="fa fa-close"> Approve</span>
                            </a>
                            <?php } ?> --->
							
                            <!---  <?php if(hasAccessPermission($user_id_session, 'crlp', 'delete_access')){ ?>
                            <a title="Delete RLP" class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="commonDeleteOperation('<?php echo $delUrl ?>', '<?php echo $adata->id ?>');">
                                <span class="fa fa-close"> Delete</span>
                            </a>
                            <?php } ?>
							
							
							
							<?php if(hasAccessPermission($user_id_session, 'crlp', 'edit_access')){ ?>
                            <a title="Print RLP History" class="btn btn-sm btn-info bg-olive" href="rlp_view.php?rlp_id=<?php echo $adata->id; ?>">
                                <span class="fa fa-print"> History</span>
                            </a>
                            <?php } ?>    ---> 

							<?php if(hasAccessPermission($user_id_session, 'crlp', 'edit_access')){ ?>
                            <a title="Print RLP" class="btn btn-sm btn-info bg-blue" href="notesheets_view.php?id=<?php echo $adata->id; ?>">
                                <span class="fa fa-print"> Details/Print</span>
                            </a>
                            <?php } ?>	

							<?php if(hasAccessPermission($user_id_session, 'crlp', 'delete_access') && get_status_name($adata->notesheet_status)=='Approve' && $adata->is_wo==0){ ?>
                            <a title="Edit RLP" class="btn btn-sm btn-success" href="create_workorder.php?id=<?php echo $adata->id; ?>">
                                <span class="fa fa-plus"> Work Order</span>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">
        <strong>Sorry there is no data!</strong>
    </div>
<?php } ?>

<script>
$(document).ready(function () {
    $('#rlp_list_table').DataTable({
        scrollY: '400px',
        scrollCollapse: true,
        paging: false,
    });
});
</script>