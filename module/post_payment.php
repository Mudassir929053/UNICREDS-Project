<?php

// TL;DR Enroll Student after payment

session_start(); // NOT REQUIRED - COULD BE DANGEROUS
require 'database.php';
// header('Content-Type: application/json');

// VERSION 0.2 (Catch payment from SenangPay)
// Prepare for BillPlz Version

// Payment Gateway return user to this page
// hash checking
// then do some magic, check success or not

// if success then
//      update db for successful payment
//      enroll student to paid microcreds
//      clear cart_mc db (transfer to cart_order_item)
//      update order db
//      redirect to success page

// else redirect to fail page

// May or may not belong to module (ALERT)

// status_id=1&order_id=9&transaction_id=163397079678940535&msg=Payment_was_successful&hash=a90c03c88a22813b898cf2abfa59cdf00a71f7dfc050b0aebe0a6876503a6a1c

require 'payment_config.php';

// $status_id = $_GET['status_id'];
// $order_id = $_GET['order_id'];
// $transaction_id = $_GET['transaction_id'];
// $msg = $_GET['msg'];
// $hash = $_GET['hash'];
// $newURL = null;

require 'enroll_lesson.php';

// *****************************************************
require 'lib/API.php';
require 'lib/Connect.php';
// require 'payment_config.php';

use Billplz\Minisite\API;
use Billplz\Minisite\Connect;

$data = Connect::getXSignature($x_signature, 'bill_redirect');
$connect = new Connect($api_key);
$connect->setStaging($is_sandbox);
$billplz = new API($connect);
// list($rheader, $rbody) = $billplz->toArray($billplz->getBill($data['id']));

// print_r($_REQUEST);
// print_r($data);
$token = $data['id'];
// *****************************************************
// $data['paid'] == 1
// $data['id'] == nfv0pfup
// $user = $_SESSION['user'];

// $str = $secretkey . urldecode($status_id) . urldecode($order_id) . urldecode($transaction_id) . urldecode($msg);
// $hashed_str = hash_hmac('SHA256', $str, $secretkey);

// if secretkey compromised, no validation toward server
// secretkey is equivalent to billplz xsignature

if (true) { // hash checking in BillPlz happened somewhere else

    $sql = "SELECT `type`, userId, id, grandTotal , updateAt FROM cart WHERE paid='2' AND cart.token='$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $getObject = mysqli_fetch_object($result);
        $type = $getObject->type;
        $order_id = $getObject->id;
        $userId = $getObject->userId;
        $grandTotal = $getObject->grandTotal;
        $date = $getObject->updateAt;
        $transaction_id = $data['transaction_id'];

        // Check transaction result returned by payment gateway
        if ($data['paid'] == 1) { // Tnx Success
            $newURL = "/unicreds/student/cart-receipt.php?total={$grandTotal}&payment_method=online_banking&transaction_id={$transaction_id}&reference_id={$order_id}&date_created={$date}"; // Redirect URL

            enrollLesson($conn, $data['transaction_id'], $type, $order_id);
            
        } else if ($data['paid'] == 2) { // Tnx Pending - dunno if BillPlz have Pending. KIV for now
            // We don't know how to handle pending transaction, actually
            $newURL = '/pending.php';
        }
        else { // Tnx Fail
            $newURL = '/unicreds/fail.php';

            // use revert Function

            revert($conn, $type, $order_id, $userId);
        }
    } else {
        // somewrong with the db
        echo 'error 1';
    }

    setcookie("p", "", time() - 3600);

    header('Location: ' . $newURL);
    // print_r($data);
} else {
    // invalid hash
    echo 'hash fail';
}
