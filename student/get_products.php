<?php
include "function/student-function.php"; 
$suID = $_SESSION['sess_studentid'];
$queryUserID = $conn->query("SELECT su_user_id  FROM student_university WHERE su_id = '$suID';");

$userID = mysqli_fetch_object($queryUserID);
$su_userID = $userID->su_user_id;

$query = "SELECT * FROM `cart_mc` AS cmc 
          LEFT JOIN `cart` AS cart ON cmc.cart_id = cart.id 
          LEFT JOIN `microcredential` AS mc ON cmc.sub_id = mc.mc_id 
          WHERE cart.paid = 0 AND cart.userId = '$su_userID';";
$result = mysqli_query($conn, $query);

$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$query = "SELECT * FROM `cart_course` AS cc 
          LEFT JOIN `cart` AS cart ON cc.cart_id = cart.id 
          LEFT JOIN `course` AS c ON cc.course_id = c.course_id 
          WHERE cart.paid = 0 AND cart.userId = '$su_userID';";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$query = "SELECT * FROM `cart_ep` AS cep
          LEFT JOIN `cart` AS cart ON cep.cart_id = cart.id 
          LEFT JOIN `employability_program` AS ep ON cep.sub_id = ep.ep_id 
          WHERE cart.paid = 0 AND cart.userId = '$su_userID';";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$json = json_encode($rows);

$c_data = array();
$rows = json_decode($json, true);
foreach ($rows as $val) {
    $data = array();

    if (isset($val["mc_id"])) {
        $data["id"] = $val["mc_id"];
        $data["cartid"] = $val["cart_id"];
        $data["enrolluserid"] = $suID;
        $data["coursetype"] = $val["type"];
        $data["image"] = "../assets/images/micro-credential/" . $val["mc_image"];
        $data["title"] = $val["mc_title"];
        $data["fee"] = (int) $val["mc_fee"] / 100;

        array_push($c_data, $data);
    } else if (isset($val["course_id"])) {
        $data["id"] = $val["course_id"];
        $data["cartid"] = $val["cart_id"];
        $data["enrolluserid"] = $suID;
        $data["coursetype"] = $val["type"];
        $data["image"] = "../assets/images/course/" . $val["course_image"];
        $data["title"] = $val["course_title"];
        $data["fee"] = (int) $val["course_fee"] / 100;

        array_push($c_data, $data);
    } else if (isset($val["ep_id"])) {
        $data["id"] = $val["ep_id"];
        $data["cartid"] = $val["cart_id"];
        $data["enrolluserid"] = $suID;
        $data["coursetype"] = $val["type"];
        $data["image"] = "../assets/images/employability-program/epthumbnails" . $val["ep_cover_attachment"];
        $data["title"] = $val["ep_title"];
        $data["fee"] = (int) $val["ep_fee"] / 100;

        array_push($c_data, $data);
    }
}

echo $cart_items = json_encode($c_data);
