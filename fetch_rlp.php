<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "e_equipment");
$columns = array('rlp_info.id', 'rlp_info.rlp_no', 'rlp_info.request_project ', 'rlp_info.request_person', 'rlp_info.rlp_status', 'rlp_info.request_date', 'projects.project_name', 'status_details.name');

//$query = "SELECT * FROM rlp_info WHERE ";
$query = "SELECT rlp_info.id,rlp_info.rlp_no,rlp_info.request_person,rlp_info.rlp_status,rlp_info.request_date, projects.project_name, status_details.name FROM rlp_info 
INNER JOIN projects ON rlp_info.request_project=projects.id 
INNER JOIN status_details ON rlp_info.rlp_status=status_details.id 
WHERE ";


if($_POST["is_date_search"] == "yes")
{
 $query .= 'rlp_info.request_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (rlp_info.id LIKE "%'.$_POST["search"]["value"].'%" 
  OR rlp_info.rlp_no LIKE "%'.$_POST["search"]["value"].'%" 
  OR rlp_info.request_person LIKE "%'.$_POST["search"]["value"].'%" 
  OR status_details.name LIKE "%'.$_POST["search"]["value"].'%" 
  OR projects.project_name LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
	{
		
		$sub_array = array();
		$sub_array[] = $row["id"];
		$sub_array[] = $row["rlp_no"];
		$sub_array[] = $row["request_person"];
		$sub_array[] = $row["name"];
		$sub_array[] = $row["request_date"];
		$sub_array[] = $row["project_name"];
		
		$edit_url = 'patient_edit.php?id='.$row["id"];
		$actionData     =   '<button class="btn btn-sm btn-warning"><a class="action-icons c-approve" href="'.$edit_url.'" title="Edit">
			<i class="fas fa-edit text-info"></i>Edit
		</a></button><button class="btn btn-sm btn-success" style="margin-left:2px;"><a class="action-icons c-approve" href="'.$edit_url.'" title="Edit">
			<i class="fas fa-edit text-info"></i>View
		</a></button>';
		
	
		 $sub_array[] = $actionData;
		$data[] = $sub_array;
	}
	

function get_all_data($connect)
	{
		$query = "SELECT * FROM rlp_info";
		$result = mysqli_query($connect, $query);
		return mysqli_num_rows($result);
	}

	$output = array(
		 "draw"    => intval($_POST["draw"]),
		 "recordsTotal"  =>  get_all_data($connect),
		 "recordsFiltered" => $number_filter_row,
		 "data"    => $data
	);

echo json_encode($output);


?>
