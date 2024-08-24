<?php
include "db/connection.php";

// Get the user ID from the request or session
$user_id = 6;  // Or use $_SESSION['user_id'] if available

$obj = new database();

$data['id'] =$user_id;

$results = $obj->get_user_heirarchy($data);

// Debugging: Print the results
echo "<pre>";
print_r($results);
echo "</pre>";
exit;
?>
