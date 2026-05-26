<?php
require("conection.php");
error_reporting(0);

//user count
$today = date('Y-m-d');
$sql = "SELECT COUNT(*) AS truck_count FROM user_master WHERE DATE(user_register_date) = ? AND user_type = '1'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$truckcount = $row['truck_count'];

// Return the user count as a JSON response
echo json_encode($truckcount);


?>

