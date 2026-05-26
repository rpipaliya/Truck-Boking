<?php
// include "conection.php";
// if(isset($_POST["booking_id"]))
// {
//     $bookingid = $_POST["booking_id"];
//     $sql="UPDATE truck_booking SET assign_driver_status='0' where booking_id = '$bookingid'";
//     $result=mysqli_query($conn,$sql);
// }
?>

<?php
include "conection.php";

if (isset($_POST["booking_id"])) {
    $bookingid = $_POST["booking_id"]; // Retrieve booking_id from the form

    try {
        $response=array();
        // Begin a database transaction
        $conn->begin_transaction();

        // Update the assign_driver_status in the truck_booking table
        $sql1 = "UPDATE truck_booking SET assign_driver_status = '0' WHERE booking_id = '$bookingid'";
        $conn->query($sql1);

        // Delete the corresponding row from the assign_driver table
        $sql2 = "DELETE FROM assign_driver WHERE booking_id = '$bookingid'";
        $conn->query($sql2);

        // Commit the transaction
        $conn->commit();
        $response['code']="order_rejected";
        $response['message']="oreder rejected for some reasone";
        echo "Update and delete completed successfully!";
    } catch (PDOException $e) {
        // If there was an error, rollback the transaction
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
