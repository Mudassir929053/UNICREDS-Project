<?php

// Fail-safe configuration for payment gateway senangpay

// check cart, if paid, then remove it

// check if transaction flow fail
// if not fail, do nothing
// if fail, update whatever necessary
// failure is likely occured at post_payment
// money deducted
// but not enrolled

// You might receive multiple callback for the same transaction. The latest callback data is considered as the most up-to-date data for the transaction

// print_r($_GET);

// status_id=1&order_id=9&transaction_id=163397079678940535&msg=Payment_was_successful&hash=a90c03c88a22813b898cf2abfa59cdf00a71f7dfc050b0aebe0a6876503a6a1c
// 1 8 163599142966540533 Payment_was_successful 816701f0880c7a4423f44a6b67e98665478bdd55e11fec6763eec475e0b15cd5

// EZ Debug
// $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
// fwrite($myfile, implode(" ", $_REQUEST));
// fclose($myfile);

// maybe sent multiple time (to update transaction ?)
require 'database.php';
require 'payment_config.php';
require 'enroll_lesson.php';

// $status_id = $_POST['status_id'];
// $order_id = $_POST['order_id'];
// $transaction_id = $_POST['transaction_id'];
// $msg = $_POST['msg'];
// $hash = $_POST['hash'];

$type = null;
$paid = null;
$userId = null;
$response = null;

$order_id = null;

// *************************************************************

// 

require 'lib/API.php';
require 'lib/Connect.php';
// require 'configuration.php';

use Billplz\Minisite\API;
use Billplz\Minisite\Connect;

$data = Connect::getXSignature($x_signature, 'bill_callback');
$connect = new Connect($api_key);
$connect->setStaging($is_sandbox);
$billplz = new API($connect);
list($rheader, $rbody) = $billplz->toArray($billplz->getBill($data['id']));

if ($rbody['paid']) {
    /*Do something here if payment has been made*/
} else {
    /*Do something here if payment has not been made*/
}

// echo 'Callback is done';

$token = $rbody['id'];
// $payment_method = $rbody['reference_1'];

/*
 * In variable (array) $moreData you may get this information:
 * 1. reference_1
 * 2. reference_1_label
 * 3. reference_2
 * 4. reference_2_label
 * 5. amount
 * 6. description
 * 7. id // bill_id
 * 8. name
 * 9. email
 * 10. paid
 * 11. collection_id
 * 12. due_at
 * 13. mobile
 * 14. url
 * 15. callback_url
 * 16. redirect_url
 */


// *************************************************************

$RES_OK = 'OK';


if (true) {
    try {
        $sql = "SELECT `type`, paid, userId , id FROM cart WHERE token='$token'";
        $result = $conn->query($sql);
        $getObject = mysqli_fetch_object($result);
        $type = $getObject->type;
        $paid = $getObject->paid;
        $userId = $getObject->userId;
        $order_id = $getObject->id;
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        echo 'error 01';
    }

    if ($rbody['paid'] == 1) { // Successful
        $sql = "SELECT order_id FROM cart_order WHERE token='$token'"; // WRONG - not order_id but cart_order
        $result = $conn->query($sql);

        $getObject = mysqli_fetch_object($result);
        $corder_id = $getObject->order_id;

        if ($type == 'mc' || $type == 'c') {     
            if ($result->num_rows == 1) { // exist

                // execute commission function
                record_commission($conn, $type, $corder_id);
            } else { // we assume 0 = not exist
                if ($paid == 2) {
                    // require 'enroll_lesson.php';
                    enrollLesson($conn, $token, $type, $order_id);

                    // execute commission function
                    record_commission($conn, $type, $corder_id);
                }
            }
            deleteCart($conn, $order_id);
            $response = $RES_OK;
        } else { // type not yet determined
            echo 'error 02, type not supported';
        }
    } else if ($rbody['paid'] == 2) { // pending
        $response = 'NOT OK';
    } else { // fail
        if ($paid != 2) {
            $response = $RES_OK;
        } else if ($paid == 2) {

            // use revert function

            revert($conn, $type, $order_id, $userId);
        }
    }
} else {
    echo 'INVALID HASH ERROR ';
}

echo $response;
