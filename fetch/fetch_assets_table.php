
<?php
//fetch.php
session_start();
include('../connection/connect.php');
include('../helper/utilities.php');
$column = array("ams_products.id", "ams_products.sl_no", "ams_products.item_name", "assets_categories.assets_category", "ams_products.model", "ams_products.assign_status");
$query = "
 SELECT *,ams_products.id as id_no FROM ams_products 
 INNER JOIN assets_categories 
 ON assets_categories.assets_id = ams_products.assets_category 
";
$query .= " WHERE 1=1 AND  ";
if(isset($_POST["is_categories"]))
{
 $query .= "ams_products.assets_category = '".$_POST["is_categories"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(ams_products.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR ams_products.sl_no LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR ams_products.item_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR ams_products.assets_description LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR assets_categories.assets_category LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR ams_products.model LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR ams_products.assign_status LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY ams_products.id DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{

	$actionData     =   get_receive_list_action_data($row);
 $sub_array = array();

 $sub_array[] = $row["sl_no"];
 $sub_array[] = $row["item_name"];
 $sub_array[] = $row["assets_category"];
 $sub_array[] = $row["model"];
 $sub_array[] = $row["assets_description"];
 $sub_array[] = $row["assign_status"];
 $sub_array[] = $actionData;
 $data[] = $sub_array;
}

function get_receive_list_action_data($row){
	//$edit_url = 'receive_edit.php?edit_id='.$row["sl_no"];
    
	$edit_url = 'receive_edit.php?edit_id='.$row["id_no"];
    $view_url = 'asset-details.php?no='.$row["id_no"];
    $transfer_url = 'transfer.php?id='.$row["id_no"];
    $refund_url = 'refund.php?id='.$row["id_no"];
    //$approve_url = 'receive_approve.php?no='.$row["sl_no"];
    $assign_url = 'assign.php?id='.$row["id_no"];
    $s2s_transfer_url = 's2s_transfer.php?id='.$row["id_no"];
    $action = "";
	

    $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$edit_url.'" title="edit"><i class="fa fa-edit text-info mborder"></i></a></span>';

						
	$action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-approve" href="'.$view_url.'" title="View"><i class="fa fa-eye text-success mborder"></i></a></span>';

    if($row['assign_status']=='assigned'){
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$transfer_url.'" title="transfer"><i class="fa fa-user text-warning"></i></a></span>';
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$refund_url.'" title="return"><i class="fa fa-user text-info"></i></a></span>';
	   }else{
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$assign_url.'" title="Assign"><i class="fa fa-user-plus text-success"></i></a></span>';
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$s2s_transfer_url.'" title="S2S Transfer"><i class="fa fa-exchange text-danger"></i></a></span>';
       }					
															
    return $action;

}

function get_all_data($conn)
{
 $query = "SELECT * FROM ams_products";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>