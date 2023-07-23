<?php
require_once "connection/connect.php";
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
if(mysqli_query($conn, "INSERT INTO ajax_form_test(name, email, mobile) VALUES('" . $name . "', '" . $email . "', '" . $mobile . "')")) {
echo '1';
} else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
mysqli_close($conn);
?>