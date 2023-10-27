<?php
session_start();
// BillPlz Payment Gateway

require 'database.php';
require 'payment_config.php';

require 'lib/API.php';
require 'lib/Connect.php';

use Billplz\Minisite\API;
use Billplz\Minisite\Connect;

// print_r($_SESSION);

$description = "UNICREDS - Payment for Order #";
$reference_1 = null;

// $reference_2_label = '';

$amount = null;
$name = null;
$email = null;
$mobile = null;
$collection_id = null;
$orderID = null;

// Please prepare dynamic cart function
$sql = "SELECT cart.id, cart.grandTotal, paymentMethod AS pm, su_fname, su_lname, su_email, su_contact_no, `type`
    FROM cart
    JOIN student_university as su ON cart.userId = su.su_user_id
    WHERE paid=2 AND userId='{$_SESSION['user']}'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $cart_id = null;
    $type = null;
    while ($row = $result->fetch_assoc()) {

        $orderID = $row['id'];
        $description = $description . $orderID;

        $amount = $row['grandTotal'];

        $name = $row['su_fname'] . ' ' . $row['su_lname'];
        $email = $row['su_email'];
        $mobile = $row['su_contact_no'];

        $reference_1 = $row['pm'];
        $type = $row['type']; // to parse collection id
    }

    if ($type == 'mc') {
        $collection_id = '81xe7jst';
    } else if ($type == 'c') {
        $collection_id = 'dooacdxy';
    }
} else {
    // ---
    // error
    echo 'error ez_01';
}

$parameter = array(
    'collection_id' => $collection_id,
    'email' => $email,
    'mobile' => $mobile,
    'name' => $name,
    'amount' => $amount,
    'callback_url' => $websiteurl . 'module/ez_callback.php',
    'description' => $description
);

$optional = array(
    'redirect_url' => $websiteurl . 'module/post_payment.php',
    'reference_1_label' => "Bank Code",
    'reference_1' => $reference_1,
    'reference_2_label' => '',
    'reference_2' => '',
    'deliver' => 'false'
);

// if (empty($parameter['mobile']) && empty($parameter['email'])) {
//     $parameter['email'] = 'noreply@billplz.com';
// }

// if (!filter_var($parameter['email'], FILTER_VALIDATE_EMAIL)) {
//     $parameter['email'] = 'noreply@billplz.com';
// }

$connect = new Connect($api_key);
$connect->setStaging($is_sandbox);
$billplz = new API($connect);
list($rheader, $rbody) = $billplz->toArray($billplz->createBill($parameter, $optional));
/***********************************************/
// Include tracking code here

// INSERT order (billplz) into DB
try {
    $token = $rbody['id'];
    $sql = "UPDATE cart SET token='$token' WHERE id='$orderID'";
    // echo $sql;
    $conn->query($sql);
} catch (mysqli_sql_exception $e) {
    echo 'fail ez_t 01';
    mysqli_rollback($conn);
}

/***********************************************/
if ($rheader !== 200) {
    if (defined('DEBUG')) {
        echo '<pre>' . print_r($rbody, true) . '</pre>';
    }
    if (!empty($fallbackurl)) {
        header('Location: ' . $fallbackurl);
    }
}

header('Location: ' . $rbody['url'] . '?auto_submit=true');
