<?php

for($count 		= 0; $count<count($_POST['description']); $count++)
{  
$date			= $_POST['date'];
$priority		= $_POST['priority'];
$rlpNo			= $_POST['rlpNo'];

$description	= $_POST['description'][$count];
$perpose		= $_POST['perpose'][$count];
$quantity		= $_POST['quantity'][$count];
$estimatedPrice	= $_POST['estimatedPrice'][$count];

$remarks		= $_POST['remarks'];
$myArray 		= Array($date, $priority, $rlpNo, $description, $perpose, $quantity, $estimatedPrice, $remarks);

echo "<pre>";
print_r($myArray);
echo "</pre>";
}

?>