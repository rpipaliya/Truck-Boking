<?php
include 'conection.php';

$booking = array();

if (isset($_POST["booking_id"])) {
    $booking_id = $_POST["booking_id"];
    $stmt = $conn->prepare("SELECT tb.booking_id, tb.pickup_address, tb.drop_address, tb.booking_date, tb.pickup_date, tb.drop_date, td.truck_image1 as truck_image, td.truck_name,td.truck_register_number, g.goods_type, um.user_contactno_primary,um.user_fullname FROM truck_booking tb INNER JOIN truck_detials td ON tb.truck_id = td.truck_id INNER JOIN goods g ON tb.goods_id = g.goods_id INNER JOIN user_master um ON tb.user_id = um.user_id WHERE tb.booking_id=?");

    $stmt->bind_param("s", $booking_id); // Binding $booking_id as parameter
    $stmt->execute();
    $stmt->bind_result($bid, $padd, $dadd, $bookdate, $pickupdate, $dropdate, $image, $truckname,$truckNo, $goodtype, $contact,$custname);

    while ($stmt->fetch()) {
        $temp = array();
        $temp['booking_id'] = $bid;
        $temp['pickup_address'] = $padd;
        $temp['drop_address'] = $dadd;
        $temp['order_date'] = $bookdate;
        $temp['pickup_date'] = $pickupdate;
        $temp['drop_date'] = $dropdate;
        $temp['truckimage'] = $image;
        $temp['truck_name'] = $truckname;
        $temp['truck_no'] = $truckNo;
        $temp['goods_type'] = $goodtype;
        $temp['contact'] = $contact;
        $temp['cust_name'] = $custname;
        array_push($booking, $temp);
    }
    $stmt->close();
}

echo json_encode($booking);
$conn->close();
?>
