<?php
include "conection.php";

// month 10
$sqlOct = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(NOW())";
$result = mysqli_query($conn, $sqlOct);
$rowOct = mysqli_fetch_assoc($result);
$amountOct = $rowOct["sum"];


$sqlOct = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(NOW())-1";
$result = mysqli_query($conn, $sqlOct);
$rowOct = mysqli_fetch_assoc($result);
$amountOctPrevious = $rowOct["sum"];


$sqlOct = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(NOW())-2";
$result = mysqli_query($conn, $sqlOct);
$rowOct = mysqli_fetch_assoc($result);
$amountOctPrevious2 = $rowOct["sum"];

//month 11


$sqlNow = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 11 AND YEAR(date) = YEAR(NOW())";
$resultNow = mysqli_query($conn, $sqlNow);
$rowNow = mysqli_fetch_assoc($resultNow);
$amountNow = $rowNow["sum"];


$sqlNow = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 11 AND YEAR(date) = YEAR(NOW())-1";
$resultNow = mysqli_query($conn, $sqlNow);
$rowNow = mysqli_fetch_assoc($resultNow);
$amountNowPrevious = $rowNow["sum"];


$sqlNow = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 11 AND YEAR(date) = YEAR(NOW())-2";
$resultNow = mysqli_query($conn, $sqlNow);
$rowNow = mysqli_fetch_assoc($resultNow);
$amountNowPrevious2 = $rowNow["sum"];



//Month 12


$sqlDec = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 12 AND YEAR(date) = YEAR(NOW())";
$resultDec = mysqli_query($conn, $sqlDec);
$rowDec = mysqli_fetch_assoc($resultDec);
$amountDec = $rowDec["sum"];


$sqlDec = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 12 AND YEAR(date) = YEAR(NOW())-1";
$resultDec = mysqli_query($conn, $sqlDec);
$rowDec = mysqli_fetch_assoc($resultDec);
$amountDecPrevious = $rowDec["sum"];


$sqlDec = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 12 AND YEAR(date) = YEAR(NOW())-2";
$resultDec = mysqli_query($conn, $sqlDec);
$rowDec = mysqli_fetch_assoc($resultDec);
$amountDecPrevious2 = $rowDec["sum"];




//MOnth 9


$sqlSep = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(NOW())";
$resultSep = mysqli_query($conn, $sqlSep);
$rowSep = mysqli_fetch_assoc($resultSep);
$amountSep = $rowSep["sum"];


$sqlSep = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(NOW())-1";
$resultSep = mysqli_query($conn, $sqlSep);
$rowSep = mysqli_fetch_assoc($resultSep);
$amountSepPrevious = $rowSep["sum"];


$sqlSep = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(NOW())-2";
$resultSep = mysqli_query($conn, $sqlSep);
$rowSep = mysqli_fetch_assoc($resultSep);
$amountSepPrevious2 = $rowSep["sum"];



//Month 8



$sqlAu = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 8 AND YEAR(date) = YEAR(NOW())";
$resultAug = mysqli_query($conn, $sqlAu);
$rowAug = mysqli_fetch_assoc($resultAug);
$amountAug = $rowAug["sum"];


$sqlAug = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 8 AND YEAR(date) = YEAR(NOW())-1";
$resultAug = mysqli_query($conn, $sqlAug);
$rowAug = mysqli_fetch_assoc($resultAug);
$amountAugPrevious = $rowAug["sum"];


$sqlAug = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 8 AND YEAR(date) = YEAR(NOW())-2";
$resultAug = mysqli_query($conn, $sqlAug);
$rowAug = mysqli_fetch_assoc($resultAug);
$amountAugPrevious2 = $rowAug["sum"];


// MONTH 7


$sqlJul = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 7 AND YEAR(date) = YEAR(NOW())";
$resultJul = mysqli_query($conn, $sqlJul);
$rowJul = mysqli_fetch_assoc($resultJul);
$amountJul = $rowJul["sum"];


$sqlJul = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 7 AND YEAR(date) = YEAR(NOW())-1";
$resultJul = mysqli_query($conn, $sqlJul);
$rowJul = mysqli_fetch_assoc($resultJul);
$amountJulPrevious = $rowJul["sum"];


$sqlJul = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 7 AND YEAR(date) = YEAR(NOW())-2";
$resultJul = mysqli_query($conn, $sqlJul);
$rowJul = mysqli_fetch_assoc($resultJul);
$amountJulPrevious2 = $rowJul["sum"];


// Month 6

$sqlJun = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 6 AND YEAR(date) = YEAR(NOW())";
$resultJun = mysqli_query($conn, $sqlJun);
$rowJun = mysqli_fetch_assoc($resultJun);
$amountJun = $rowJun["sum"];


$sqlJun = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 6 AND YEAR(date) = YEAR(NOW())-1";
$resultJun = mysqli_query($conn, $sqlJun);
$rowJun = mysqli_fetch_assoc($resultJun);
$amountJunPrevious = $rowJun["sum"];


$sqlJun = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 6 AND YEAR(date) = YEAR(NOW())-2";
$resultJun = mysqli_query($conn, $sqlJun);
$rowJun = mysqli_fetch_assoc($resultJun);
$amountJunPrevious2 = $rowJun["sum"];



// Month 5

$sqlMay = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 5 AND YEAR(date) = YEAR(NOW())";
$resultMay = mysqli_query($conn, $sqlMay);
$rowMay = mysqli_fetch_assoc($resultMay);
$amountMay = $rowMay["sum"];


$sqlMay = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 5 AND YEAR(date) = YEAR(NOW())-1";
$resultMay = mysqli_query($conn, $sqlMay);
$rowMay = mysqli_fetch_assoc($resultMay);
$amountMayPrevious = $rowMay["sum"];


$sqlMay = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 5 AND YEAR(date) = YEAR(NOW())-2";
$resultMay = mysqli_query($conn, $sqlMay);
$rowMay = mysqli_fetch_assoc($resultMay);
$amountMayPrevious2 = $rowMay["sum"];


//Month 4


$sqlApr = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 4 AND YEAR(date) = YEAR(NOW())";
$resultApr = mysqli_query($conn, $sqlApr);
$rowApr = mysqli_fetch_assoc($resultApr);
$amountApr = $rowApr["sum"];


$sqlApr = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 4 AND YEAR(date) = YEAR(NOW())-1";
$resultApr = mysqli_query($conn, $sqlApr);
$rowApr = mysqli_fetch_assoc($resultApr);
$amountAprPrevious = $rowApr["sum"];


$sqlApr = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 4 AND YEAR(date) = YEAR(NOW())-2";
$resultApr = mysqli_query($conn, $sqlApr);
$rowApr = mysqli_fetch_assoc($resultApr);
$amountAprPrevious2 = $rowApr["sum"];

// month 3


$sqlMar = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 3 AND YEAR(date) = YEAR(NOW())";
$resultMar = mysqli_query($conn, $sqlMar);
$rowMar = mysqli_fetch_assoc($resultMar);
$amountMar = $rowMar["sum"];


$sqlMar = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 3 AND YEAR(date) = YEAR(NOW())-1";
$resultMar = mysqli_query($conn, $sqlMar);
$rowMar = mysqli_fetch_assoc($resultMar);
$amountMarPrevious = $rowMar["sum"];


$sqlMar = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 3 AND YEAR(date) = YEAR(NOW())-2";
$resultMar = mysqli_query($conn, $sqlMar);
$rowMar = mysqli_fetch_assoc($resultMar);
$amountMarPrevious2 = $rowMar["sum"];

// month 2


$sqlFeb = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 2 AND YEAR(date) = YEAR(NOW())";
$resultFeb = mysqli_query($conn, $sqlFeb);
$rowFeb = mysqli_fetch_assoc($resultFeb);
$amountFeb = $rowFeb["sum"];


$sqlFeb = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 2 AND YEAR(date) = YEAR(NOW())-1";
$resultFeb = mysqli_query($conn, $sqlFeb);
$rowFeb = mysqli_fetch_assoc($resultFeb);
$amountFebPrevious = $rowFeb["sum"];


$sqlFeb = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 2 AND YEAR(date) = YEAR(NOW())-2";
$resultFeb = mysqli_query($conn, $sqlFeb);
$rowFeb = mysqli_fetch_assoc($resultFeb);
$amountFebPrevious2 = $rowFeb["sum"];



// month 1


$sqlJan = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 1 AND YEAR(date) = YEAR(NOW())";
$resultJan = mysqli_query($conn, $sqlJan);
$rowJan = mysqli_fetch_assoc($resultJan);
$amountJan = $rowJan["sum"];


$sqlJan = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 1 AND YEAR(date) = YEAR(NOW())-1";
$resultJan = mysqli_query($conn, $sqlJan);
$rowJan = mysqli_fetch_assoc($resultJan);
$amountJanPrevious = $rowJan["sum"];


$sqlJan = "SELECT SUM(payment_amount) as sum FROM admin_payment WHERE MONTH(date) = 1 AND YEAR(date) = YEAR(NOW())-2";
$resultJan = mysqli_query($conn, $sqlJan);
$rowJan = mysqli_fetch_assoc($resultJan);
$amountJanPrevious2 = $rowJan["sum"];


$data = array(
    'JAN' => array($amountJanPrevious2,$amountJanPrevious , $amountJan),  
    'FEB' => array($amountFebPrevious2, $amountFebPrevious2, $amountFeb),  
    'MAR' => array($amountMarPrevious2, $amountMarPrevious, $amountMar), 
    'APRIL' => array($amountAprPrevious2, $amountAprPrevious, $amountApr),  // Data for Chart 3
    'MAY' => array($amountMayPrevious2, $amountMayPrevious, $amountMay),  // Data for Chart 3
    'JUN' => array($amountJunPrevious2, $amountJunPrevious, $amountJun),  // Data for Chart 3
    'JUL' => array($amountJulPrevious2, $amountJulPrevious, $amountJul),  // Data for Chart 3
    'AUG' => array($amountAugPrevious2, $amountAugPrevious, $amountAug),  // Data for Chart 3
    'SEP' => array($amountSepPrevious2, $amountSepPrevious, $amountSep),  // Data for Chart 3
    'OCT' => array($amountOctPrevious2,$amountOctPrevious , $amountOct),  // Data for Chart 3
    'NOV' => array($amountNowPrevious2,$amountNowPrevious , $amountNow),  // Data for Chart 3
    'DEC' => array($amountDecPrevious2, $amountDecPrevious, $amountDec),  // Data for Chart 3
    // Add more years and data for additional charts
);

echo json_encode($data);
// include "connection.php";

// die($aucNow);
// $data = 
?>
