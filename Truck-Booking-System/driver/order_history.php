<?php
include 'conection.php';

$booking = array();

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $stmt = $conn->prepare("SELECT tb.booking_id, tb.pickup_address, tb.drop_address, tb.booking_date, td.truck_image1 AS truckimage FROM truck_booking tb INNER JOIN truck_detials td ON tb.truck_id = td.truck_id LEFT JOIN assign_driver ad ON tb.booking_id = ad.booking_id INNER JOIN truck_driver tdv ON ad.driver_id = tdv.driver_id WHERE ad.order_status='1' AND tdv.driver_email=?");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($bid, $padd, $dadd, $bookdate, $image);

    while ($stmt->fetch()) {
        $temp = array();
        $temp['booking_id'] = $bid;
        $temp['pickup_address'] = $padd;
        $temp['drop_address'] = $dadd;
        $temp['order_date'] = $bookdate;
        $temp['truckimage'] = $image;

        array_push($booking, $temp);
    }
    $stmt->close();
}

echo json_encode($booking);
$conn->close();
?>
