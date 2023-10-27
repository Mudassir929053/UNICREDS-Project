<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "employability_platform");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include 'pages-head.php';
include 'industry-function.php';

$industry_id = $_SESSION['sess_industryid'];

$checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id = '$industry_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->industry_user_id;

if (isset($_POST['submit'])) {
    $querycn3 = $conn->query("UPDATE credit SET credit_point = credit_point - 5 WHERE cr_industry_user_id='$get_userID'");

    $get_userID = mysqli_real_escape_string($conn, $_POST['r_industry-user_id']);
    $suid = mysqli_real_escape_string($conn, $_POST['r_student_id']);
   

    $querycn4 = $conn->query("INSERT INTO resume_payment (r_industry_user_id, r_student_id, order_type) VALUES ('$get_userID', '$suid', 'resume')");
}

?>