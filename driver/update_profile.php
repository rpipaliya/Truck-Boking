<?php

include 'conection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driver_email = $_POST['driver_email'];
    $driverfullname = $_POST['driver_fullname'];
    $driverContactPrimary = $_POST['driver_contactno_primary'];
    $driveraddress = $_POST['driver_address'];
    $drivercity = $_POST['driver_city'];

    // Sanitize input data to prevent SQL injection
    $driver_email = mysqli_real_escape_string($conn, $driver_email);
    $driverfullname = mysqli_real_escape_string($conn, $driverfullname);
    $driverContactPrimary = mysqli_real_escape_string($conn, $driverContactPrimary);
    $driveraddress = mysqli_real_escape_string($conn, $driveraddress);
    $drivercity = mysqli_real_escape_string($conn, $drivercity);

    // SQL update query
    $sql = "UPDATE truck_driver SET driver_fullname = '$driverfullname', driver_contactno_primary = '$driverContactPrimary', driver_address = '$driveraddress', driver_city = '$drivercity' WHERE driver_email = '$driver_email'";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        // Retrieve the updated data
        $result = $conn->query("SELECT * FROM truck_driver WHERE driver_email = '$driver_email'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $updatedData = $row;
            echo json_encode(["code" => "profile_updated", "message" => "Profile updated successfully", "data" => $updatedData]);
        } else {
            echo json_encode(["code" => "profile_update_failed", "message" => "Profile update failed"]);
        }
    } else {
        echo json_encode(["code" => "database_error", "message" => "Error updating profile: " . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(["code" => "error", "message" => "Invalid request method"]);
}

?>
