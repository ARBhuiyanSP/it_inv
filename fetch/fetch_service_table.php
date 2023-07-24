
<?php
//fetch.php
session_start();
include('../connection/connect.php');
include('../helper/utilities.php');
$column = array("inv_services.id", "inv_services.srv_no", "inv_services.assets_id", "vendors.vendor_name", "inv_services.handover_date", "inv_services.status");
$query = "
 SELECT *,inv_services.id as id_no,inv_services.status as s_status FROM inv_services 
 INNER JOIN vendors 
 ON vendors.vendor_id = inv_services.vendor 
";
$query .= " WHERE 1=1 AND  ";
if(isset($_POST["is_vendors"]))
{
 $query .= "inv_services.vendor = '".$_POST["is_vendors"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(inv_services.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR inv_services.srv_no LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR inv_services.assets_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR vendors.vendor_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR inv_services.handover_date LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR inv_services.status LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY inv_services.id DESC ';
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

 $sub_array[] = $row["srv_no"];
 $sub_array[] = $row["assets_id"];
 $sub_array[] = $row["vendor_name"];
 $sub_array[] = $row["handover_date"];
 $sub_array[] = $row["s_status"];
 $sub_array[] = $actionData;
 $data[] = $sub_array;
}

function get_receive_list_action_data($row){
    //$edit_url = 'receive_edit.php?edit_id='.$row["sl_no"];
    
    //$edit_url = 'receive_edit.php?edit_id='.$row["id_no"];
    $view_url = 'srv-handover-receipt.php?id='.$row["id_no"];
    $return_url = 'srv_return.php?id='.$row["id_no"];
    
    $action = "";
                        
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-approve" href="'.$view_url.'" title="Details"><i class="fa fa-eye text-success mborder"></i></a></span>';
    
    if($row['s_status']=='at_servicing'){
        // $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$edit_url.'" title="edit"><i class="fa fa-edit text-info mborder"></i></a></span>';
        $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$return_url.'" title="Return"><i class="fa fa-exchange text-info mborder"></i></a></span>';
    }

    // if($row['assign_status']=='active'){
    //     $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$transfer_url.'" title="transfer"><i class="fa fa-user text-warning"></i></a></span>';
    //     $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$refund_url.'" title="return"><i class="fa fa-user text-info"></i></a></span>';
    //    }else{
    //     $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$assign_url.'" title="Assign"><i class="fa fa-user-plus text-success"></i></a></span>';
    //     $action.='<span style="background-color:#fff;border-radius:5px;padding:1px;margin:1px;"><a class="action-icons c-delete" href="'.$s2s_transfer_url.'" title="S2S Transfer"><i class="fa fa-exchange text-danger"></i></a></span>';
    //    }                    
                                                            
    return $action;

}

function get_all_data($conn)
{
 $query = "SELECT * FROM inv_services";
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