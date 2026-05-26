<?php

include 'conection.php';
function sendResponse($code, $message, $data) {
    $response = array(
        "code" => $code,
        "message" => $message
    );
    if ($data !== null) {
        $response["data"] = $data;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function showDriverData($conn, $driver_email) {
    $driver_email = mysqli_real_escape_string($conn, $driver_email); 

    $sql = "SELECT driver_email, driver_fullname, driver_contactno_primary, driver_address, driver_city FROM truck_driver WHERE driver_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $driver_email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            sendResponse("error", "Error in Database Query");
        } else if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            sendResponse("success", "Driver found", $row);
        } else {
            sendResponse("not_found", "Driver not found");
        }
        
        mysqli_stmt_close($stmt);
    } else {
        sendResponse("error", "Error in Database Query");
    }
}

// Routing for the API
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['driver_email'])) {
        $driver_email = $_POST['driver_email'];
        showDriverData($conn, $driver_email);
    } else {
        sendResponse("error", "Missing driver_email parameter");
    }
} else {
    sendResponse("error", "Invalid request method");
}


?>

