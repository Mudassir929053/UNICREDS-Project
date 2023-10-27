<?php

function enrollLesson($conn, $transaction_id, $type, $order_id)
{
    $last_id = null;
    $sql = "UPDATE cart SET paid='4' WHERE id='$order_id'";
    if ($conn->query($sql) === TRUE) {
        if ($type == 'mc') {
            // get cart_mc list
            $sql = "SELECT su.su_id, userId, token, cart.id as cart_id, cart_mc.sub_id, grandTotal, cost
                        FROM cart_mc 
                        LEFT JOIN cart ON cart_mc.cart_id = cart_id
                        LEFT JOIN microcredential as mc ON cart_mc.sub_id = mc.mc_id
                        LEFT JOIN student_university AS su ON cart.userId = su.su_user_id
                        WHERE paid=4 AND cart_id='$order_id'";
            $result = $conn->query($sql);

            // echo $sql;

            if ($result->num_rows > 0) {
                // echo 'success 1';
                // WARNING - USING SESSION MAY NOT BE EFFECTIVE
                // IF BILLBLZ USE XSIGNATURE
                // IF SENANGPAY WE MIGHT ABLE TO DO SOMETHING WITH ORDER ID (user_id + cart_id)

                $getObject = mysqli_fetch_object($result);

                // create receipt (cart_order)
                // v0.2 - still lot of missing data
                $sql = "INSERT INTO cart_order (user_id, transaction_id, token, paid_value, amount_value, ip_address, order_type) VALUE
                            ('$getObject->userId', '$transaction_id', '$getObject->token', '{$getObject->grandTotal}', '{$getObject->grandTotal}', '" . get_client_ip() . "', 'mc')";
                // echo $sql;

                // EZ Debug
                // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                // fwrite($myfile, $sql);
                // fclose($myfile); 

                mysqli_data_seek($result, 0);
                // echo $sql;
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;

                    // update cart_mc to enrolled_subcourse_studuni
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // echo 'i am here at 82';
                        // input data into (cart_order_mc)

                        // Every loop insert to db
                        try {
                            $sql = "INSERT INTO cart_order_mc (order_id, sub_id, cost)
                                        VALUE ($last_id, '{$row['sub_id']}', '{$row['cost']}')";
                            $conn->query($sql);

                            $sql = "INSERT INTO enrolled_mc_studuni (emcsu_student_university_id,
                                        emcsu_mc_id, emcsu_status) VALUE
                                        ('{$row['su_id']}', '{$row['sub_id']}', 'In progress')";
                            $conn->query($sql);

                            // --- Update the total enrolled.
                            $total_enrolled = $conn->query("SELECT `mc_total_enrolled` FROM `microcredential` WHERE `mc_id` = {$row['sub_id']};");
                            $new_total_enrolled = $total_enrolled->fetch_all(MYSQLI_ASSOC)[0]["mc_total_enrolled"] + 1;

                            $sql = "UPDATE `microcredential` 
                                    SET `mc_total_enrolled` = '$new_total_enrolled' 
                                    WHERE `mc_id` = {$row['sub_id']};";
                            $conn->query($sql);
                            // --- Update the total enrolled

                            mysqli_commit($conn);
                        } catch (mysqli_sql_exception $exception) {
                            mysqli_rollback($conn);
                            echo 'fail 4';
                        }
                    }
                    // clear db
                    // this will be callback
                    // try {
                    //     $sql = "DELETE FROM cart WHERE id='$order_id'";
                    //     $conn->query($sql);

                    //     $sql = "DELETE FROM cart_mc WHERE id='$order_id'";
                    //     $conn->query($sql);
                    // } catch (Exception $e) {
                    //     echo 'Caught exception: ',  $e->getMessage(), "\n";
                    // }
                } else {
                    echo 'fail 3';
                }

                // redirect to success page

            } else {
                echo 'failure 1';
                // echo $sql;
            }
        } else if ($type == 'c') {
            $sql = "SELECT su.su_id, userId, cart.id, token, cart_course.course_id, grandTotal, cost
                        FROM cart_course 
                        LEFT JOIN cart ON cart_course.cart_id = cart.id
                        LEFT JOIN course ON cart_course.course_id = course.course_id
                        LEFT JOIN student_university AS su ON cart.userId = su.su_user_id
                        WHERE paid=4 AND cart.id='$order_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $getObject = mysqli_fetch_object($result);

                // create receipt (cart_order)
                // v0.2 - still lot of missing data
                $sql = "INSERT INTO cart_order (user_id, transaction_id, token, paid_value, amount_value, ip_address, order_type) VALUE
                            ('$getObject->userId', '$transaction_id', '$getObject->token', '{$getObject->grandTotal}', '{$getObject->grandTotal}', '" . get_client_ip() . "', 'c')";
                mysqli_data_seek($result, 0);

                                                              

                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    while ($row = $result->fetch_assoc()) {
                        try {
                            $sql = "INSERT INTO cart_order_course (order_id, course_id, cost)
                                        VALUE ($last_id, '{$row['course_id']}', '{$row['cost']}')";
                            $conn->query($sql);

                            $sql = "INSERT INTO enrolled_course_studuni (ecsu_student_university_id,
                                        ecsu_course_id, ecsu_status) VALUE
                                        ('{$row['su_id']}', '{$row['course_id']}', 'In progress')";
                            $conn->query($sql);

                            // --- Update the total enrolled.
                            $total_enrolled = $conn->query("SELECT `course_total_enrolled` FROM `course` WHERE `course_id` = {$row['course_id']};");
                            $new_total_enrolled = $total_enrolled->fetch_all(MYSQLI_ASSOC)[0]["course_total_enrolled"] + 1;

                            $sql = "UPDATE `course` 
                                    SET `course_total_enrolled` = '$new_total_enrolled' 
                                    WHERE `course_id` = {$row['course_id']};";
                            $conn->query($sql);
                            // --- Update the total enrolled

                            mysqli_commit($conn);
                        } catch (mysqli_sql_exception $exception) {
                            mysqli_rollback($conn);
                            echo 'error c_02';
                        }
                    }
                    // Delete will be callback job
                    // try {
                    //     $sql = "DELETE FROM cart WHERE id='$order_id'";
                    //     $conn->query($sql);

                    //     $sql = "DELETE FROM cart_course WHERE id='$order_id'";
                    //     $conn->query($sql);
                    //     mysqli_commit($conn);
                    // } catch (mysqli_sql_exception $exception) {
                    //     mysqli_report($conn);
                    //     echo 'error c_03';
                    // }
                }
            } else {
                // db error
                echo 'error c_01';
            }
        }
    } else {
        // db fail
        echo 'error 2';
    }
}

function deleteCart($conn, $order_id)
{
    try {
        $sql = "DELETE FROM cart WHERE id='$order_id'";
        $conn->query($sql);

        // $sql = "DELETE FROM cart_course WHERE id='$order_id'";
        // $conn->query($sql);
        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        echo 'error en_01';
    }
}

function record_commission($conn, $type, $order_id)
{

    // similar to how shopee work
    // payment id or rather order_id will be known as reference id
    // this reference id will linked to commission id
    // one ref id can have multiple commission id, from vary institution

    // unicreds will pay the payment gateway fee
    // example (single course)
    // amount = 100
    // payment gateway fee = 2%
    // rate = 80%
    // receivable amount = 98
    // payable amount = 80
    // profitable amount = 18 

    // that is the basic idea of it
    // it possible that payable amount is owned by multiple institution
    // example (multiple course with multiple rate)
    // name = total_amount_per_uni (rate%) payable_amount [profitable_amount]
    // uni A = 30 (70%) 21 [9]
    // uni B = 50 (80%) 40 [10]
    // uni C = 20 (75%) 15 [5]
    // total amount = 100
    // total payable amount = 76
    // payment gateway fee = 2% from total amount = 2
    // total profitable amount = 22

    // if course only one at a time
    // if microcredential can be multiple institution

    // commission is recorded per institution

    $rate = null;
    $institution_id = null;
    $cost = null;

    $institution_array = array();


    // go through every list of order_id to identify the institution to
    // sort institution into 2d array with ( cost )

    // check institution rate

    // loop for all institution
    //  from array
    //      save to commission_id per institution , with total, rate
    //      exit loop



    // dummy, to be updated
    if ($type == 'c') {
        // check course/mc owner , get the institution_id and use the id to check the rate
        $sql = "SELECT c.course_id, c.course_owner, cost FROM cart_order_course as coc
            LEFT JOIN course as c ON coc.course_id = c.course_id
            WHERE order_id = $order_id";

            //get user id  (course_owner)
            

        // course_owner = user_id
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $getObject = mysqli_fetch_object($result);
            $course_id = $getObject->course_id;
            $course_owner = $getObject->course_owner;
            $cost = $getObject->cost;

            $sql = "SELECT rate FROM commission_rate WHERE user_id = $course_owner";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                $getObject = mysqli_fetch_object($result);
                $rate = $getObject->rate;

                // gross profit
                $profit_amount = ($rate / 100) * $cost;

                // amount to be paid
                $pay_amount = $cost - $profit_amount;

                

                try {
                    $sql = "INSERT INTO commission (order_id, `user_id`, rate, receivable_amount, payable_amount, profitable_amount)
                    VALUES ($order_id, $course_owner, $rate, $cost, $pay_amount, $profit_amount)";
                    $conn->query($sql);

                    

                    $last_id = $conn->insert_id;

                    $sql = "INSERT INTO commission_course (cm_id, course_id, amount) VALUES ($last_id, $course_id, $cost)";
                    $conn->query($sql);
                } catch (mysqli_sql_exception $e) {
                    echo 'error_c in_001';
                }
            }
        }
    } else if ($type == 'mc') {
        // check course/mc owner , get the institution_id and use the id to check the rate
        $sql = "SELECT mc_id, mc_owner, cost FROM cart_order_mc
            LEFT JOIN microcredential AS mc ON sub_id = mc_id
            WHERE order_id=$order_id";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($institution_array, $row);
            }
        }

        $new_array = array();

        // Group Array Based on The Owner_ID
        foreach ($institution_array as $key => $item) {
            $new_array[$item['mc_owner']][$key] = $item;
        }

        // Process Each Array
        foreach ($new_array as $key => $item) {
            $re_amount = 0; // paid by user
            $last_id = null;

            $institution_id = $key;
            $user_id = null;

            // to find rate
            // check institution_user_id
            // check rate accordingly

            // update price cost
            $rate = 0;
            $sql = "SELECT rate, cr.user_id FROM institution i
            LEFT JOIN commission_rate cr ON i.institution_user_id = cr.user_id
            WHERE i.institution_id = $institution_id";
            $result = $conn->query($sql);

            // EZ Debug
            // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
            // fwrite($myfile, $sql);
            // fclose($myfile);

            if ($result->num_rows > 0) {
                $getObject = mysqli_fetch_object($result);
                $rate = $getObject->rate;
                $user_id = $getObject->user_id;
            } else {
                echo 'error rc_01';
            }

            try {
                $sql = "INSERT INTO commission (order_id, `user_id`) VALUES ($order_id, $user_id)";
                $conn->query($sql);

                $last_id = $conn->insert_id;
            } catch (mysqli_sql_exception $e) {
                mysqli_rollback($conn);
                echo 'fail l_01';
            }


            foreach ($item as $x_item) {
                $mc_id = $x_item['mc_id'];
                $mc_fee = $x_item['cost'];
                $re_amount += $mc_fee;

                try {
                    $sql = "INSERT INTO commission_mc (cm_id, mc_id, amount) VALUES ($last_id, $mc_id, $mc_fee)";
                    $conn->query($sql);
                } catch (mysqli_sql_exception $e) {
                    mysqli_rollback($conn);
                    echo 'fail l_02';
                }
            }

            // gross profit
            $profit_amount = ($rate / 100) * $re_amount;

            // amount to be paid
            $pay_amount = $re_amount - $profit_amount;

            try {
                $sql = "UPDATE commission SET rate = $rate, receivable_amount = $re_amount, payable_amount = $pay_amount, profitable_amount = $profit_amount WHERE cm_id = $last_id";
                $conn->query($sql);
            } catch (mysqli_sql_exception $e) {
                mysqli_rollback($conn);
                echo 'fail l_03';
            }
        }
        // echo '<br><br>';
    }
}

function revert($conn, $type, $order_id, $userId)
{

    if ($type == 'mc') {
        $sql = "SELECT id
        FROM cart
        WHERE paid='0' AND `type`='mc' AND userId=$userId";

        if ($conn->query($sql)->num_rows > 0) { // yes
            try {
                $sql = "UPDATE cart SET paid='1' WHERE id=$order_id";
                $conn->query($sql);
            } catch (mysqli_sql_exception $exception) {
                mysqli_rollback($conn);
                echo 'error f_01';
            }
        } else { // no
            try {
                $sql = "UPDATE cart SET paid='0' WHERE id=$order_id";
                $conn->query($sql);
            } catch (mysqli_sql_exception $exception) {
                mysqli_rollback($conn);
                echo 'error f_02';
            }
        }
    } else if ($type == 'c') {
        try {
            $sql = "UPDATE cart SET paid='1' WHERE id=$order_id";
            $conn->query($sql);
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($conn);
            echo 'error f_03';
        }
    }
}
