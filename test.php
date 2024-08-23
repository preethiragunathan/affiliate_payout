<?php
include "db/connection.php";

// Get the user ID from the request or session
$user_id = 6;  // Or use $_SESSION['user_id'] if available

$obj = new database();

for()
{
    
}

// Define the query
$sql = "
    SELECT 
        u1.id AS user_id,
        u1.referrer_id AS referrer_id,
        u2.id AS referral_id
    FROM 
        users AS u1
    LEFT JOIN 
        users AS u2 ON u1.id = u2.referrer_id
    WHERE 
        u1.id = :user_id
";

// Prepare and execute the query
$stmt = $obj->con->prepare($sql);
$stmt->execute(['user_id' => $user_id]);

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debugging: Print the results
echo "<pre>";
print_r($results);
echo "</pre>";
exit;
?>
