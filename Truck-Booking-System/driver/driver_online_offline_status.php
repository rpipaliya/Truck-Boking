<?php
include "conection.php"; // Assuming it's a typo and should be "connection.php"

if (isset($_POST["email"]) && isset($_POST["status"])) 
{
    $status = $_POST["status"];
    $email = $_POST["email"];
    $sql = "UPDATE truck_driver SET driver_active_status = $status WHERE driver_email = '$email'";
    $response = array();

    if (mysqli_query($conn, $sql))
    {
        $code = "driver_online";
        $response['code'] = $code;
        echo"update";
    }
    else
    {
        $code = "driver_offline";
        $response['code'] = $code;
    }
    echo json_encode($response);
    mysqli_close($conn);
}
?>
