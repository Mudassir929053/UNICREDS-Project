<?php
// This guy will return json. Thank you. and oh please refer the flowchart
session_start();

// deny access for non login

require 'database.php';
require 'enroll_lesson.php';
header('Content-Type: application/json');

// Number 3
function updateCartItem($cart_id, $conn)
{

    $data_id = mysqli_real_escape_string($conn, $_REQUEST['data-id']);

    // Enrolled validation
    $sql = "SELECT esu.emcsu_id FROM enrolled_mc_studuni AS esu
    WHERE esu.emcsu_student_university_id = '{$_SESSION['sess_studentid']}'
    AND esu.emcsu_mc_id='$data_id'";

    //  echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

        // $row = $result->fetch_assoc();
        $sql = "INSERT INTO cart_mc (cart_id, sub_id)
            VALUE ('$cart_id', '$data_id')";

        // echo $sql;

        $_SESSION['cart_id'] = $cart_id;

        if ($conn->query($sql) === TRUE) {
            // Success
            $response = array("result" => "success", "type" => "mc", "function" => "addtocart");
        } else {
            // fail most likely due to existing error
            // let review this, or fix the db
            if (mysqli_errno($conn) == 1062) {
                $response = array("result" => "fail_already_exist");
            } else {
                echo mysqli_errno($conn);
                $response = array("result" => "fail_update_cart_here");
            }
        }
    } else {
        // fail or error
        $response = array("result" => "fail_already_enrolled");
    }

    // return or echo
    return $response;
}
// Number 3
function updateCartItemEP($cart_id, $conn)
{

    $data_id = mysqli_real_escape_string($conn, $_REQUEST['data-id']);

    // Enrolled validation
    $sql = "SELECT esu.eepsu_id FROM enrolled_ep_studuni AS esu
    WHERE esu.eepsu_student_university_id = '{$_SESSION['sess_studentid']}'
    AND esu.eepsu_ep_id='$data_id'";

    //  echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

        // $row = $result->fetch_assoc();
        $sql = "INSERT INTO cart_ep (cart_id, sub_id)
            VALUE ('$cart_id', '$data_id')";

        // echo $sql;

        $_SESSION['cart_id'] = $cart_id;

        if ($conn->query($sql) === TRUE) {
            // Success
            $response = array("result" => "success", "type" => "ep", "function" => "addtocart");
        } else {
            // fail most likely due to existing error
            // let review this, or fix the db
            if (mysqli_errno($conn) == 1062) {
                $response = array("result" => "fail_already_exist");
            } else {
                echo mysqli_errno($conn);
                $response = array("result" => "fail_update_cart_here");
            }
        }
    } else {
        // fail or error
        $response = array("result" => "fail_already_enrolled");
    }

    // return or echo
    return $response;
}

function updateCartItemCourse($cart_id, $conn)
{

    $data_id = mysqli_real_escape_string($conn, $_REQUEST['data-id']);

    // Enrolled validation
    $sql = "SELECT ecs.ecsu_id  FROM enrolled_course_studuni AS ecs
    WHERE ecs.ecsu_student_university_id = '{$_SESSION['sess_studentid']}'
    AND ecs.ecsu_course_id='$data_id'";

    //  echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

        // $row = $result->fetch_assoc();
        $sql = "INSERT INTO cart_course (cart_id, course_id)
            VALUE ('$cart_id', '$data_id')";

        // echo $sql;

        $_SESSION['cart_id'] = $cart_id;

        if ($conn->query($sql) === TRUE) {
            // Success
            $response = array("result" => "success", "type" => "c", "function" => "addtocart");
        } else {
            // fail most likely due to existing error
            // let review this, or fix the db
            if (mysqli_errno($conn) == 1062) {
                $response = array("result" => "fail_already_exist");
            } else {
                echo mysqli_errno($conn);
                $response = array("result" => "fail_update_cart_here");
            }
        }
    } else {
        // fail or error
        $response = array("result" => "fail_already_enrolled");
    }

    // return or echo
    
    return $response;
    
}

function isBuyDuplicate($conn)
{
    $data_id = mysqli_real_escape_string($conn, $_REQUEST['data-id']);

    if ($_REQUEST['data-type'] == 'c') {

        // Enrolled validation c
        $sql = "SELECT esu.ecsu_id FROM enrolled_course_studuni AS esu
        WHERE esu.ecsu_student_university_id = '{$_SESSION['sess_studentid']}'
        AND esu.ecsu_course_id='$data_id'";
    } else if ($_REQUEST['data-type'] == 'mc') {

        // Enrolled validation mc
        $sql = "SELECT esu.emcsu_id FROM enrolled_mc_studuni AS esu
        WHERE esu.emcsu_student_university_id = '{$_SESSION['sess_studentid']}'
        AND esu.emcsu_mc_id='$data_id'";
    }
    else if ($_REQUEST['data-type'] == 'ep') {

        // Enrolled validation mc
        $sql = "SELECT esu.eepsu_id FROM enrolled_ep_studuni AS esu
        WHERE esu.eepsu_student_university_id = '{$_SESSION['sess_studentid']}'
        AND esu.eepsu_ep_id='$data_id'";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true;
    } else return false;
}

function checkcookie($conn)
{
    //check if cookie set
    // if set check value
    // if not set or false ignore
    //  if value true check paid
    //  if paid 1, ignore
    //   if paid 2, revert function with type

    //    mmm, sounds like a plan   //

    if (isset($_COOKIE["p"])) {
        if ($_COOKIE["p"] == true) {
            $sql = "SELECT id, `type`, paid FROM cart 
            WHERE (userId='{$_SESSION['user']}' AND paid='2')";
            $result = $conn->query($sql);

            // echo $sql;

            if ($result->num_rows > 0) {
                $getObject = mysqli_fetch_object($result);
                revert($conn, $getObject->type, $getObject->id, $_SESSION['user']);
                setcookie("p", "", time() - 3600);
            }
        }
    }

    // if not set, ignore it
}

$response = null;

checkcookie($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // add button verifier (addToCart, remove, buynow)
    // addtocart and buynow has similar opening but buynow,
    // redirect to checkout
    if ($_REQUEST['data-function'] == 'addtocart') {

        if ($_REQUEST['data-type'] == 'mc') {
            // check if user has cart (1)
            // paid cart = no cart
            $sql = "SELECT * FROM cart 
                WHERE (userId='{$_SESSION['user']}' AND paid='0' AND `type`='mc')";

            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // else insert into existing cart (3)
                $row = $result->fetch_assoc();

                $response = updateCartItem($row['id'], $conn);
            } else if ($result->num_rows == 0) {
                // if none, create new (2)
                $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                    VALUE ('{$_SESSION['user']}', '{$_SESSION['userType']}', 0, 'mc')";

                // echo $sql;

                if ($conn->query($sql) === TRUE) {
                    // Success
                    $last_id = $conn->insert_id;
                    $response = updateCartItem($last_id, $conn);
                } else {
                    // fail 

                    $response = array("result" => "fail_create_new");
                };
            } else {
                // unknown error (more than 1)
            }
        } 
        else if ($_REQUEST['data-type'] == 'c') {
            // check if user has cart (1)
            // paid cart = no cart
            $sql = "SELECT * FROM cart 
                WHERE (userId='{$_SESSION['user']}' AND paid='0' AND `type`='c')";

            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // else insert into existing cart (3)
                $row = $result->fetch_assoc();

                $response = updateCartItemCourse($row['id'], $conn);
            } else if ($result->num_rows == 0) {
                // if none, create new (2)
                $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                    VALUE ('{$_SESSION['user']}', '{$_SESSION['userType']}', 0, 'c')";

                // echo $sql;

                if ($conn->query($sql) === TRUE) {
                    // Success
                    $last_id = $conn->insert_id;
                    $response = updateCartItemCourse($last_id, $conn);
                } else {
                    // fail 

                    $response = array("result" => "fail_create_new");
                };
            } else {
                // unknown error (more than 1)
            }
        }
        else if ($_REQUEST['data-type'] == 'ep') {
            // check if user has cart (1)
            // paid cart = no cart
            $sql = "SELECT * FROM cart 
                WHERE (userId='{$_SESSION['user']}' AND paid='0' AND `type`='ep')";

            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // else insert into existing cart (3)
                $row = $result->fetch_assoc();

                $response = updateCartItemEP($row['id'], $conn);
            } else if ($result->num_rows == 0) {
                // if none, create new (2)
                $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                    VALUE ('{$_SESSION['user']}', '{$_SESSION['userType']}', 0, 'ep')";

                // echo $sql;

                if ($conn->query($sql) === TRUE) {
                    // Success
                    $last_id = $conn->insert_id;
                    $response = updateCartItemEP($last_id, $conn);
                } else {
                    // fail 

                    $response = array("result" => "fail_create_new");
                };
            } else {
                // unknown error (more than 1)
            }
        }
        else {
            $response = array("result" => "error_not_supported");
        }
    } else if ($_REQUEST['data-function'] == 'buynow') {
        if (!isBuyDuplicate($conn)) {
            $id = null;
            $data_id = mysqli_real_escape_string($conn, $_REQUEST['data-id']);
            if ($_REQUEST['data-type'] == 'c') {
                // check active cart_id
                $sql = "SELECT id FROM cart WHERE userId = '{$_SESSION['user']}' AND `type`='c' AND paid=1";
                $result = $conn->query($sql);

                // echo 'i am here';
                // clear course cart if necessary
                if ($result->num_rows > 0) { // exist
                    $getObject = mysqli_fetch_object($result);
                    $id = $getObject->id;
                    $sql = "DELETE FROM cart_course WHERE cart_id = '{$id}'";

                    $conn->query($sql);
                } else { // not exist
                    try {
                        $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                        VALUE ({$_SESSION['user']}, '{$_SESSION['userType']}', 1, 'c')";
                        $conn->query($sql);
                        $id = mysqli_insert_id($conn);
                    } catch (mysqli_sql_exception $exception) {
                        mysqli_rollback($mysqli);
                        $response = array("result" => "fail_create_new");
                    }
                }
                // add to cart
                mysqli_begin_transaction($conn);

                try {

                    $sql = "INSERT INTO cart_course (cart_id, course_id)
                    VALUE ($id, $data_id)";
                    $conn->query($sql);

                    mysqli_commit($conn);
                    $response = array(
                        "result" => "success",
                        "redirect_url" => "/unicreds/student/cart-checkout.php?r=course",
                        "type" => "c"
                    );
                } catch (mysqli_sql_exception $exception) {
                    mysqli_rollback($mysqli);
                    $response = array("result" => "fail_create_new");

                    // throw $exception;
                }
            } else if ($_REQUEST['data-type'] == 'mc') {
                $sql = "SELECT id FROM cart WHERE userId = '{$_SESSION['user']}' AND type='mc' AND paid='1'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { // exist
                    $getObject = mysqli_fetch_object($result);
                    $id = $getObject->id;
                    $sql = "DELETE FROM cart_mc WHERE cart_id = '{$id}'";

                    $conn->query($sql);
                } else { // not exist
                    try {
                        $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                        VALUE ({$_SESSION['user']}, '{$_SESSION['userType']}', 1, 'mc')";
                        $conn->query($sql);
                        $id = mysqli_insert_id($conn);
                    } catch (mysqli_sql_exception $exception) {
                        mysqli_rollback($mysqli);
                        $response = array("result" => "fail_create_new");
                    }
                }
                try {
                    $sql = "INSERT INTO cart_mc (cart_id, sub_id)
                    VALUE ($id, $data_id)";
                    $conn->query($sql);
                    mysqli_commit($conn);

                    $response = array(
                        "result" => "success",
                        "redirect_url" => "/unicreds/student/cart-checkout.php?r=microcredential",
                        "type" => "mc"
                    );
                } catch (mysqli_sql_exception $exception) {
                    mysqli_rollback($mysqli);
                    $response = array("result" => "fail_create_new");
                }
            }
            else if ($_REQUEST['data-type'] == 'ep') {
                $sql = "SELECT id FROM cart WHERE userId = '{$_SESSION['user']}' AND type='ep' AND paid='1'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { // exist
                    $getObject = mysqli_fetch_object($result);
                    $id = $getObject->id;
                    $sql = "DELETE FROM cart_ep WHERE cart_id = '{$id}'";

                    $conn->query($sql);
                } else { // not exist
                    try {
                        $sql = "INSERT INTO cart (userId, userType, paid, `type`)
                        VALUE ({$_SESSION['user']}, '{$_SESSION['userType']}', 1, 'ep')";
                        $conn->query($sql);
                        $id = mysqli_insert_id($conn);
                    } catch (mysqli_sql_exception $exception) {
                        mysqli_rollback($mysqli);
                        $response = array("result" => "fail_create_new");
                    }
                }
                try {
                    $sql = "INSERT INTO cart_ep (cart_id, sub_id)
                    VALUE ($id, $data_id)";
                    $conn->query($sql);
                    mysqli_commit($conn);

                    $response = array(
                        "result" => "success",
                        "redirect_url" => "/unicreds/student/cart-checkout.php?r=employability",
                        "type" => "ep"
                    );
                } catch (mysqli_sql_exception $exception) {
                    mysqli_rollback($mysqli);
                    $response = array("result" => "fail_create_new");
                }
            }
        } else $response = array("result" => "fail_already_enrolled");
    } else if ($_REQUEST['data-function'] == 'remove') {
        if ($_REQUEST['data-type'] == 'mc') {
            $sql = "DELETE FROM cart_mc WHERE (cart_id={$_SESSION['cart_id']}
            AND sub_id={$_REQUEST['data-id']})";
            // echo $sql;
            if ($conn->query($sql) === TRUE) {
                // Success
                $response = array("result" => "success");
            } else {
                // fail 
                $response = array("result" => "fail_to_remove");
            };
        } else {
            $response = array("result" => "error_not_supported");
        }
    }

    // echo print_r($_REQUEST);
    echo json_encode($response);

    // POST HERE
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = null;
    // echo $_GET['r'];
    if (isset($_REQUEST['r'])) {

        if ($_REQUEST['r'] == 'course') {

            // Retrieve Cart Data
            $sql = "SELECT cart_id, cart.type as `type`, cart_course.course_id as product_id,
            course_name as product_name, course_fee as product_fee
            FROM cart_course 
            LEFT JOIN cart ON cart_course.cart_id = cart.id
            LEFT JOIN course ON cart_course.course_id = course.course_id
            WHERE userId='{$_SESSION['user']}' AND paid='1' AND `type`='c'";
            // echo $sql;
        } else if ($_REQUEST['r'] == 'microcredential') {
            $sql = "SELECT cart_id, `type`, cart_mc.sub_id as product_id,
            mc_title as product_name, mc_fee as product_fee
            FROM cart_mc 
            LEFT JOIN cart ON cart_mc.cart_id = cart.id
            LEFT JOIN microcredential ON cart_mc.sub_id = microcredential.mc_id
            WHERE userId='{$_SESSION['user']}' AND paid='1' AND `type`='mc'";
        }
        else if ($_REQUEST['r'] == 'employability') {
            $sql = "SELECT cart_id, `type`, cart_ep.sub_id as product_id,
            ep_title as product_name, ep_fee as product_fee
            FROM cart_ep 
            LEFT JOIN cart ON cart_ep.cart_id = cart.id
            LEFT JOIN employability_program as ep ON cart_ep.sub_id = ep.ep_id
            WHERE userId='{$_SESSION['user']}' AND paid='1' AND `type`='ep'";
        }
    } else {
        // Retrieve Cart Data
        // $sql = "SELECT cart_id, cart.type as `type`, cart_mc.sub_id as product_id,
        // mc_title as product_name, mc_fee as product_fee
        // FROM cart_mc 
        // LEFT JOIN cart ON cart_mc.cart_id = cart.id
        // LEFT JOIN microcredential ON cart_mc.sub_id = microcredential.mc_id
        // WHERE userId='{$_SESSION['user']}' AND paid='0' AND `type`='mc'";
    }

    // echo $sql;

    if ($result = $conn->query($sql)) {
        // output data of each row
        $response = array();

        while ($row = $result->fetch_assoc()) {
            $_SESSION['cart_id'] = $row['cart_id']; // not efficient
            $temp = array(
                "product_id" => $row['product_id'],
                "product_name" => $row['product_name'],
                // "product_description" => $row['subcourse_description'],
                "product_type" => $row['type'],
                "product_price" => $row['product_fee'],
            );
            array_push($response, $temp);
        }
    }

    echo json_encode($response);
}
