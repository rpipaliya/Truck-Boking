<?php
require("conection.php");

// fetch_user_count_for_month.php

// Include your database connection code (e.g., require('conection.php'))

// Get the current month
$currentMonth = date('m');

// Assuming you have a table named 'user_master' with a 'user_register_date' column
// Change the table and column names accordingly
$sql = "SELECT COUNT(*) AS user_count FROM user_master WHERE MONTH(user_register_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentMonth);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$userCount = $row['user_count'];

// Return the user count as a JSON response
echo json_encode($userCount);
?>


