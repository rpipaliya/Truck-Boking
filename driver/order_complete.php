<?php
include "conection.php";

if(isset($_POST["booking_id"]))
{
    
 
    $bookingid = $_POST["booking_id"];
    
        $sql1="SELECT truck_booking.booking_id, user_master.user_contactno_primary FROM truck_booking JOIN user_master ON truck_booking.user_id = user_master.user_id where truck_booking.booking_id ='$bookingid'";
        $result1=mysqli_query($conn,$sql1);
        $row = mysqli_fetch_assoc($result1);
        $contact=$row["user_contactno_primary"];

    
    $sql="UPDATE assign_driver SET order_status='1' where booking_id = '$bookingid'";
    $result=mysqli_query($conn,$sql);
    $code = "order_completed";
    $response['code'] = $code;
    $response['contact'] = $contact;
}
else
{
    $code = "order_issue";
    $response['code'] = $code;
   
}
echo json_encode($response);
mysqli_close($conn);


?>