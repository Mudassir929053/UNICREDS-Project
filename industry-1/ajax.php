<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "employability_platform");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$industry_id = $_SESSION['sess_industryid'];
$checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id = '$industry_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->industry_user_id;


if(isset($_GET['checkPayment'])){
    extract($_REQUEST);
     $sql = "SELECT * FROM `resume_payment` where r_industry_user_id='$get_userID' and r_student_id='$stuid'";
     $result = $conn->query($sql);
     if (mysqli_num_rows($result) > 0) {
        echo "Payment Done";
     }
     else{
        echo "Not Paid";
     }

  }