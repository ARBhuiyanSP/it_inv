<?php

include 'function/class_loader.php';
// include 'connection/connect.php';

// foreach ($sqlconn->query($sql) as $row) {
// 	echo "<pre>";
//     print_r($row);
// 	echo "</pre>";
// }


$db_connect 	=	new Database;

$codes_data  = $db_connect->get_all_data('Employees');

print '<pre>';
print_r($codes_data);
print '</pre>';
exit;

 ?>