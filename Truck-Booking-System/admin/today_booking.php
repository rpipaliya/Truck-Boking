<?php
require("conection.php");

//booking count

$today = date('Y-m-d');
$sql = "SELECT COUNT(*) AS booking_count FROM truck_booking WHERE DATE(booking_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$bookingcount = $row['booking_count'];

// Return the user count as a JSON response
echo json_encode($bookingcount);
?>