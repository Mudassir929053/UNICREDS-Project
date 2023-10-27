<?php
// This guy will return json. Thank you. and oh please refer the flowchart
session_start();

// deny access for non login

require 'database.php';
header('Content-Type: application/json');

// print_r($_REQUEST);

function calculateTotal($conn, $sql, $type)
{
    $response = null;
    $result = $conn->query($sql);
    $total = 0;
    $cart_id = null; // fecth first then reset
    $pm = $_REQUEST['paymentmethod'];

    // echo $sql;

    // Calculate total price to pay
    if ($result->num_rows > 0) {
        $cart_id = null;
        while ($row = $result->fetch_assoc()) {

            $product_fee = $row['product_fee'];
            $cart_id = $row['cart_id']; // not efficient //fetch first then reset
            $sub_id = $row['sub_id'];

            // get latest fee and update here
            if ($type == "mc") {
                $sql = "UPDATE cart_mc SET cost='$product_fee' WHERE cart_id='$cart_id' AND sub_id='$sub_id'";
            } else if ($type == "c") {
                $sql = "UPDATE cart_course SET cost='$product_fee' WHERE cart_id='$cart_id' AND course_id='$sub_id'";
            }
            $conn->query($sql);
            

            $total += $product_fee;
        }

        // check discount (from coupon)
        $discount = 0;
        $grand_total = $total - $discount;

        // update db for order
        $sql = "UPDATE cart SET grandTotal='$grand_total', 
                subTotal='$total', paymentMethod='$pm', paid='2' WHERE id='$cart_id'";

        // echo $sql;
        if ($conn->query($sql) === TRUE) {
            // trigger payment gateway api call

            // set paying cookies to avoid broken pipe
            setcookie("p", true);

            // Redirect on success
            $response = array('result' => 'success');
            $response['redirect_url'] = '/unicreds/module/ez_redirect_to_payment.php'; //Payment Gateway URL -- NOT POST PAYMENT

        } else {
            echo mysqli_error($conn);
        }
    } else {
        // error
        $response = array('result' => 'error_not_exist');
    }
    return $response;
}

$response = null;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // actually, no, let use post_cart.php
    $response = array('result' => 'error_not_allowed');
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $type = null;

    if (isset($_REQUEST['r'])) { // exist
        if ($_REQUEST['r'] == 'microcredential') {
            $sql = "SELECT cart_id, mc_fee as product_fee, mc_id as sub_id
            FROM cart_mc 
            LEFT JOIN cart ON cart_mc.cart_id = cart.id
            LEFT JOIN microcredential as mc ON cart_mc.sub_id = mc.mc_id
            WHERE userId='{$_SESSION['user']}' AND paid='1' AND `type`='mc'";

            $type = "mc";

        } else if ($_REQUEST['r'] == 'course') {
            $sql = "SELECT cart_id, course_fee as product_fee, course.course_id as sub_id
            FROM cart_course 
            LEFT JOIN cart ON cart_course.cart_id = cart.id
            LEFT JOIN course ON cart_course.course_id = course.course_id
            WHERE userId='{$_SESSION['user']}' AND paid='1' AND `type`='c'";

            $type = "c";

        }

        $response = calculateTotal($conn, $sql, $type);

    } else { // r not exist
        // display course content

        // echo $_REQUEST['paymentmethod'];
        // check payment method (not required for form payment)

        // Retreive cart content
        $sql = "SELECT cart_id, mc_fee as product_fee, mc_id as sub_id
            FROM cart_mc 
            LEFT JOIN cart ON cart_mc.cart_id = cart.id
            LEFT JOIN microcredential as mc ON cart_mc.sub_id = mc.mc_id
            WHERE userId='{$_SESSION['user']}' AND paid='0' AND `type`='mc'";

            $type = "mc";

        $response = calculateTotal($conn, $sql, $type);
    }
}
// response
echo json_encode($response);
