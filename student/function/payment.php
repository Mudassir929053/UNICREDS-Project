<?php
include("../function/student-function.php");

function empty_cart()
{
    return ('<!-- Empty cart lists -->' .
        '<div class="my-4 d-flex flex-column justify-content-center align-items-center">' .
        '<h3 class="m-0 text-primary">Your Cart is Empty</h3>' .
        '<small class="text-muted">Browse the catalog now!</small>' .
        '</div>'
    );
}

function cart_lists($data)
{
    $str = "";

    foreach ($data as $val) {
        $str .= ('<li class="list-group-item ">' .
            '<div class="row">' .
            '<div class="col">' .
            '<div class="d-flex align-items-center">' .
            '<a href="' . $val["link"] . '" class="avatar avatar-md col-auto" style="min-width: 50px;">' .
            '<img src="' . $val["image"] . '" alt="avatar" class="rounded">' .
            '</a>' .
            '<div class="ms-3 w-100">' .
            '<div class="mb-2">' .
            '<h5 class="fw-bold p-0 m-0 text-truncate-line-2">' .
            '<a href="' . $val["link"] . '" class="text-inherit">' .
            '' . $val["title"] . '' .
            '</a>' .
            '</h5>' .
            '<small class="fw-medium text-muted"><em>' . $val["type"] . '</em></small>' .
            '</div>' .
            '<span class="fw-bold text-dark cart-price">' . $val["fee"] . '</span>' .
            '</div>' .
            '</div>' .
            '</div>' .
            '</div>' .
            '</li>'
        );
    }

    return $str;
}

if (isset($_POST["cartLists"])) {
    $cc = $conn->query("SELECT * FROM `cart_course` AS cc 
                        LEFT JOIN `cart` AS cart ON cc.cart_id = cart.id 
                        LEFT JOIN `course` AS c ON cc.course_id = c.course_id 
                        WHERE cart.paid = 0;");
    $cmc = $conn->query("SELECT * FROM `cart_mc` AS cmc 
                        LEFT JOIN `cart` AS cart ON cmc.cart_id = cart.id 
                        LEFT JOIN `microcredential` AS mc ON cmc.sub_id = mc.mc_id 
                        WHERE cart.paid = 0;");
    $cep = $conn->query("SELECT * FROM `cart_ep` AS cep 
                        LEFT JOIN `cart` AS cart ON cep.cart_id = cart.id 
                        LEFT JOIN `employability_program` AS ep ON cep.sub_id = ep.ep_id 
                        WHERE cart.paid = 0;");

    if ($cc->num_rows == 0 && $cmc->num_rows == 0 && $cep->num_rows == 0) {
        echo empty_cart();
    } else {
        $cart_items = array();
        $c_data = array();
        $mc_data = array();
        $ep_data = array();

        // Micro-credential cart items.
        foreach ($cmc->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();

            $data["link"] = "micro-creds-enroll.php?mc_id=" . $val["sub_id"];
            $data["image"] = "../assets/images/microcredential/" . $val["mc_image"];
            $data["title"] = $val["mc_title"];
            $data["type"] = "Micro-credential";
            $data["fee"] = feeFormat($val["mc_fee"]);
            $data["date"] = $val["createdAt"];

            array_push($mc_data, $data);
        }

        // Course cart items.
        foreach ($cc->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();

            $data["link"] = "course-enroll.php?course_id=" . $val["course_id"];
            $data["image"] = "../assets/images/course/" . $val["course_image"];
            $data["title"] = $val["course_title"];
            $data["type"] = "Course";
            $data["fee"] = feeFormat($val["course_fee"]);
            $data["date"] = $val["createdAt"];

            array_push($c_data, $data);
        }
        // // Employability Program items.
        // foreach($cep->fetch_all(MYSQLI_ASSOC) as $val) {
        //     $data = array();

        //     $data["link"] = "ep-enroll.php?ep_id=".$val["ep_id"];
        //     $data["image"] = "assets/images/employability_program/epthumbnails/".$val["ep_cover_attachment"];
        //     $data["title"] = $val["ep_title"];
        //     $data["type"] = "Emploability-Program";
        //     $data["fee"] = feeFormat($val["ep_fee"]);
        //     $data["date"] = $val["createdAt"];

        //     array_push($ep_data, $data);
        // }
        // Employability Program items.
        foreach ($cep->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();

            $data["link"] = "ep-enroll.php?ep_id=" . $val["ep_id"];
            $data["image"] = "assets/images/employability_program/epthumbnails/" . $val["ep_cover_attachment"];
            $data["title"] = $val["ep_title"];
            $data["type"] = "Employability-Program"; // Corrected typo "Emploability-Program"
            $data["fee"] = feeFormat($val["ep_fee"]);
            $data["date"] = $val["createdAt"];

            array_push($ep_data, $data); // Corrected array push to $ep_data instead of $c_data
        }

        if ($cc->num_rows == 0) {
            // $cart_items = $mc_data;
            $cart_items = array_merge_recursive($ep_data, $mc_data);
        } else if ($cmc->num_rows == 0) {
            // $cart_items = $c_data;
            $cart_items = array_merge_recursive($ep_data, $c_data);
        } else if ($cep->num_rows == 0) {
            $cart_items = array_merge_recursive($mc_data, $c_data);
        } else {
            $cart_items = array_merge_recursive($mc_data, $c_data, $ep_data);
        }


        array_multisort(array_column($cart_items, "date"), SORT_DESC, SORT_STRING, $cart_items);

        echo cart_lists($cart_items);
    }

    exit();
}

if (isset($_POST["removeItem"])) {
    $id = $_POST["id"];
    $type = $_POST["type"];

    if ($type === "Course") {
        $cc_rmv = $conn->query("DELETE FROM `cart_course` WHERE `course_id` = $id;");

        if ($cc_rmv) {
            echo "success";
        } else {
            echo "fail";
        }
    } else if ($type === "Micro-credential") {
        $cmc_rmv = $conn->query("DELETE FROM `cart_mc` WHERE `sub_id` = $id;");

        if ($cmc_rmv) {
            echo "success";
        } else {
            echo "fail";
        }
    } else if ($type === "Employability-Program") {
        $cep_rmv = $conn->query("DELETE FROM `cart_ep` WHERE `sub_id` = $id;");
        
        if ($cep_rmv) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}
