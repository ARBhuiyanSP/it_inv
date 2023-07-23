
<?php
//fetch.php
session_start();
include('../connection/connect.php');
include('../helper/utilities.php');
$column = array("product_assign.id", "product_assign.product_id", "product_assign.employee_id", "inv_employee.employeeid", "product_assign.assign_date", "product_assign.remarks", "product_assign.status");
$query = "
 SELECT *,product_assign.id as id_no FROM product_assign 
 INNER JOIN inv_employee 
 ON inv_employee.employeeid = product_assign.employee_id 
";
$query .= " WHERE 1=1 AND  ";
if(isset($_POST["is_employees"]))
{
 $query .= "product_assign.employee_id = '".$_POST["is_employees"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(product_assign.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR product_assign.product_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR product_assign.employee_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR product_assign.assign_date LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR product_assign.remarks LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR product_assign.status LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY product_assign.id DESC ';
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

 $sub_array[] = $row["product_id"];
 $sub_array[] = $row["employee_id"];
 $sub_array[] = $row["assign_date"];
 $sub_array[] = $row["remarks"];
 $sub_array[] = $row["status"];
 $sub_array[] = $actionData;
 $data[] = $sub_array;
}

function get_receive_list_action_data($row){
	//$edit_url = 'receive_edit.php?edit_id='.$row["product_id"];
    
	//$edit_url = 'receive_edit.php?edit_id='.$row["id_no"];
    $view_url = 'assign-details.php?no='.$row["id_no"];
    $hr_url = 'handover-receipt.php?id='.$row["id_no"];
    //$approve_url = 'receive_approve.php?no='.$row["id_no"];
    $action = "";
	
						
	$action.='<span style="background-color:#fff;border-radius:5px;padding:2px;margin:1px;"><a class="action-icons c-approve" href="'.$view_url.'" title="View"><i class="fa fa-eye text-success mborder"></i></a></span>';

    $action.='<span style="background-color:#fff;border-radius:5px;padding:2px;margin:1px;"><a class="action-icons c-delete" href="'.$hr_url.'" title="Handover Receipt"><i class="fa fa-check text-info mborder"></i></a></span>';

		
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