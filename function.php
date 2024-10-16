<?php 


include ('database/dbcon.php');
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; 
  
//Load Composer's autoloader
require 'vendor/autoload.php';
// require '../vendor/phpmailer\phpmailer/src/PHPMailer.php';
// require '../vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/Exception.php';








// Login Credentials
if(isset($_POST['btnLogin']))
{


    if(empty($_POST["user_username"]) || empty($_POST["user_password"]))  
    {  
       echo '<script>alert("Both Fields are required")</script>';  
   } 
   else
   {
    $user_username = mysqli_real_escape_string($conn,$_POST["user_username"]);
    $Password = mysqli_real_escape_string($conn,$_POST["user_password"]);
    // $_SESSION['sess_parentusername'] = $_POST["user_username"];


    $sqlUser = $conn -> query("SELECT * FROM user WHERE user_username = '$user_username'");

    if(mysqli_num_rows($sqlUser) > 0) 
    {
        while($row = mysqli_fetch_object($sqlUser))
        {
            if(password_verify($Password, $row -> user_password))
            {

                session_regenerate_id();
                $user_id = $_SESSION['sess_id'] = $row -> user_id;
                $role_id = $_SESSION['sess_role'] = $row -> user_role_id;

                $date = date('y-m-d H:i:s');


                if ($_SESSION['sess_role'] == "1")
                {
                    $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");

                    $rowuser_id = mysqli_fetch_object($getID);
                    $get_adminid = $rowuser_id -> admin_id;
                    $_SESSION['sess_adminid'] = $get_adminid;
                    session_write_close();

                    echo ("<script>window.location.href = 'admin/dashboard.php'</script>");
                    exit();            
                }
                                //Upper Management
                elseif ($_SESSION['sess_role'] == "2")
                {
                    $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_adminid = $rowUserid -> admin_id;
                    $_SESSION['sess_adminid'] = $get_adminid;
                    session_write_close();

                    echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                    exit();            
                }
                                // Finance
                elseif ($_SESSION['sess_role'] == "3")
                {
                    $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_adminid = $rowUserid -> admin_id;
                    $_SESSION['sess_adminid'] = $get_adminid;
                    session_write_close();

                    echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                    exit();            
                }
                                //Micro-Credentials
                elseif ($_SESSION['sess_role'] == "4")
                {
                    $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_adminid = $rowUserid -> admin_id;
                    $_SESSION['sess_adminid'] = $get_adminid;
                    session_write_close();

                    echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                    exit();             
                }
                                //Institution
                elseif ($_SESSION['sess_role'] == "5")
                {
                    $getID = $conn -> query("SELECT institution_id FROM institution WHERE institution_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_institutionid = $rowUserid -> institution_id;
                    $_SESSION['sess_institutionid'] = $get_institutionid;
                    session_write_close();

                    echo ("<script>window.location.href = 'institution/dashboard.php'</script>");
                    exit();            
                }
                                //Industry
                elseif ($_SESSION['sess_role'] == "6")
                {
                    $getID = $conn -> query("SELECT industry_id FROM industry WHERE industry_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_industryid = $rowUserid -> industry_id;
                    $_SESSION['sess_industryid'] = $get_industryid;
                    session_write_close();

                    echo ("<script>window.location.href = 'industry/dashboard.php'</script>");
                    exit();            
                }
                                // 7 = Lecturer
                elseif ($_SESSION['sess_role'] == "7")
                {
                    
                    $sql = "SELECT lecturer_id
                    FROM user JOIN lecturer
                    ON user.user_id = lecturer.lecturer_user_id 
                    WHERE user_id='$user_id'";
                    $getID = $conn -> query($sql);
 
                     if(mysqli_num_rows($getID) > 0 )
 
                     {
                         
                         $rowuser_id = mysqli_fetch_object($getID);
                         $get_lectid = $rowuser_id -> lecturer_id;
 
                         $_SESSION['sess_lecturerid'] = $get_lectid;

                         session_write_close();
 
                         echo ("<script>window.location.href = 'lecturer/dashboard.php'</script>");
                         exit(); 
  
                     }
                     else {
                         
                         $deluser = $conn->query("DELETE FROM user where user_id = '$user_id'");
 
                         if($deluser) 
                         {
                             echo "<script>alert('You does not verify your account after sign up and the account has been terminated, please sign up and verify your account consecutively');
                             location.href = 'registerselection.php';</script>";
                         
                         }
                         else
                         {
                             echo "<script>alert('system error')</script>";
                         }
                         
                     }
                }
                                // Expert
                elseif ($_SESSION['sess_role'] == "8")
                {
                    $getID = $conn -> query("SELECT expert_id FROM expert WHERE expert_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_expertid = $rowUserid -> expert_id;
                    $_SESSION['sess_adminid'] = $get_expertid;
                    session_write_close();

                    echo ("<script>window.location.href = 'admin/pages-admin-dashboard.php'</script>");
                    exit();            
                }

                elseif ($_SESSION['sess_role'] == "10")
                {
                    $getID = $conn -> query("SELECT committee_id FROM committee WHERE committee_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_committeeid = $rowUserid -> committee_id;
                    $_SESSION['sess_committeeid'] = $get_committeeid;
                    session_write_close();

                    echo ("<script>window.location.href = 'committee/dashboard.php'</script>");
                    exit();            
                }
                                //    9 = student
                elseif ($_SESSION['sess_role'] == "9")

                {   
                    // $checkstudent = $conn -> query ("SELECT institution.institution_id, university.university_name from user left join student_university on  user_id = student_university.su_user_id left join institution ON su_institution_id = institution.institution_id left join university on institution.institution_university_id = university.university_id where student_university.su_user_id = '$user_id' ");
                    // $rowcheckstudent = mysqli_fetch_object($checkstudent);
                    // $getInstitutionId = $rowcheckstudent -> institution_id;
                    // $getUniName = $rowcheckstudent -> university_name;

                   // $getID = $conn -> query("SELECT su_id FROM student_university WHERE su_user_id = '$user_id'");
                   $sql = "SELECT user_id, su_id, user_role_id, su_fname, su_lname, su_contact_no, su_email
                   FROM user JOIN student_university
                   ON user.user_id = student_university.su_user_id
                   WHERE user_id='$user_id'";
                   $getID = $conn -> query($sql);

                    if(mysqli_num_rows($getID) > 0 )

                    {
                        
                        $rowuser_id = mysqli_fetch_object($getID);
                        $get_userid = $rowuser_id -> su_id;

                        $_SESSION['sess_studentid'] = $get_userid;


                        // ADIB BAZLI - FOR PAYMENT GATEWAY
                        $_SESSION['user'] = $user_id;
                        $_SESSION['fname'] = $rowuser_id -> su_fname; // checkout
                        $_SESSION['lname'] = $rowuser_id -> su_lname; // checkout
                        $_SESSION['contact'] = $rowuser_id -> su_contact_no;
                        $_SESSION['email'] = $rowuser_id -> su_email;
                        $_SESSION['userType'] = "student";

                        setcookie('user', $user_id);
                        setcookie('type', 'student');
                        // END OF ADIB BAZLI - FOR PAYMENT GATEWAY

                        session_write_close();

                        echo ("<script>window.location.href ='student/student-home-page.php'</script>");
                        exit();  
 
                    }
                    else {
                        
                        $deluser = $conn->query("DELETE FROM user where user_id = '$user_id'");

                        if($deluser) 
                        {
                            echo "<script>alert('You does not verify your account after sign up and the account has been terminated, please sign up and verify your account consecutively');
		                    location.href = 'registerselection.php';</script>";
                        
                        }
                        else
                        {
                            echo "<script>alert('system error')</script>";
                        }
                        
                    }

                }
                
            } 

            else
            {
                echo "<script>alert('Wrong password')</script>";
            }
        }   

    }          
    else
    {
        echo '<script>alert("Username not exist")</script>';
    }
}
} 

if (isset($_POST['stdntregister']))
{

    $user_password= mysqli_real_escape_string($conn, $_POST['user_password']);
    
    $student_email = mysqli_real_escape_string($conn, $_POST['user_username']);
    $student_fname= mysqli_real_escape_string($conn, $_POST['student_fname']);
    $student_lname= mysqli_real_escape_string($conn, $_POST['student_lname']);
    $institution_id= mysqli_real_escape_string($conn, $_POST['student_institution_id']);
    $institution_name= mysqli_real_escape_string($conn, $_POST['institution_name']);


    $date = date('Y-m-d H:i:s');

    $querycheckregisteration = $conn -> query ("SELECT user_username from user where user_username = '$student_email';");

    if (mysqli_num_rows($querycheckregisteration) == 0 )
    {
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $vcode = rand(999999, 111111);
        $status = "not verified";
        $queryuser = $conn-> query ("INSERT INTO user (user_username,user_password,user_role_id, user_vcode, user_status, user_created_date) 
            VALUES('$student_email', '$user_password', '9', '$vcode', '$status', '$date')");

        if($queryuser)
        {  
            $getID = $conn -> query("SELECT * FROM user WHERE user_username = '$student_email' AND user_password = '$user_password' AND user_created_date = '$date'");

            $rowuser_id = mysqli_fetch_object($getID);
            $get_userid = $rowuser_id->user_id;
            $get_user_role = $rowuser_id->user_role_id;


            $mail = new PHPMailer;

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.unicreds.org';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'support@unicreds.org';                     //SMTP username
                $mail->Password   = 'bK{hqUK9,qwS';                               //SMTP password
                $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('support@unicreds.org');
                $mail->addAddress($student_email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Account Verification';
                $mail->Body    = 'Here is the verification code for Unicreds account registration : <b> '.$vcode.' </b>';

                $mail->send();
                $_SESSION['user'] = $get_userid;
                $_SESSION['email'] = $student_email;
                $_SESSION['fname'] = $student_fname;
                $_SESSION['lname'] = $student_lname;
                $_SESSION['institution_id'] = $institution_id;
                $_SESSION['role_id'] = $get_user_role;
                
                echo ("<script>window.location.href ='verify_account.php'</script>");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

      else
      {
          echo "<script>alert('Error in user registration')</script>";
      }

  }
  else
  {
     echo '<script>alert("This User has been registered")</script>';
  }


}

if(isset($_POST['verify_account_student'])){
    
    $verification_code = mysqli_real_escape_string($conn, $_POST['vcode']);
    $institution_id = $_POST['institution_id'];
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
	$student_fname = mysqli_real_escape_string($conn, $_POST['su_fname']);
	$student_lname = mysqli_real_escape_string($conn, $_POST['su_lname']);
    $student_email = mysqli_real_escape_string($conn, $_POST['su_email']);

    $date = date('Y-m-d H:i:s');
    

        $checkvcode =  $conn -> query("SELECT * FROM user WHERE user_vcode = '$verification_code' AND user_id = '$user_id'");

        if(mysqli_num_rows($checkvcode) == 1)
        {
            $status = "Verified";

            $updateUser = $conn->query("UPDATE user SET user_status = '$status', user_updated_date = '$date' WHERE user_id = '$user_id'");

            if($updateUser)
            {
                if($role_id == "9")
                {
                $querycreatestudentuni = $conn -> query("INSERT INTO student_university (su_user_id, su_role_id, su_institution_id, su_fname, su_lname, su_email, su_registered_date, su_status) 
                VALUES('$user_id', '$role_id', '$institution_id', '$student_fname', '$student_lname', '$student_email', '$date', 'Active')");

                if($querycreatestudentuni)
                {
                    $getstudent = $conn -> query("SELECT su_id FROM student_university WHERE su_user_id = '$user_id'");
                    $row = $getstudent->fetch_object();
                 

                    $_SESSION['sess_studentid'] = $row->su_id;
                    $_SESSION['user'] = $user_id;
                    $_SESSION['fname'] = $student_fname; // checkout
                    $_SESSION['lname'] = $student_lname; // checkout
                    $_SESSION['email'] = $student_email;
                    $_SESSION['userType'] = "student";

                    setcookie('user', $user_id);
                    setcookie('type', 'student');
                    // END OF ADIB BAZLI - FOR PAYMENT GATEWAY

                    session_write_close();

                    echo ("<script>window.location.href ='student/student-home-page.php'</script>");
                    exit(); 
                }
                else
                {
                    echo "<script>alert('Registration student failed')</script>";
                }
                }
               else
                {
                    echo "<script>alert('lecturer')</script>";
                }

            }
            else
            {
                echo "<script>alert('User info cannot be updated!')</script>";
            }

        }
        else
        {
            echo "<script>alert('You have entered incorrect code')</script>";

        }
    

}



if (isset($_POST['lectregister']))
{


    $lecturer_fname = mysqli_real_escape_string($conn,$_POST['lecturer_fname']);
    $lecturer_lname = mysqli_real_escape_string($conn,$_POST['lecturer_lname']);
    $lecturer_uni = mysqli_real_escape_string($conn,$_POST['lecturer_uni']);
    $lecturer_email = mysqli_real_escape_string($conn,$_POST['lecturer_email']);
    $user_password = mysqli_real_escape_string($conn,$_POST['user_password']);

    $date = date('Y-m-d H:i:s');

    $querycheckregisteration = $conn -> query ("SELECT user_username from user where user_username = '$lecturer_email';");

    if (mysqli_num_rows($querycheckregisteration) == 0 )
    {
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $vcode = rand(999999, 111111);
        $status = "not verified";
        $queryuser = $conn-> query ("INSERT INTO user (user_username,user_password,user_role_id, user_vcode, user_status, user_created_date) 
            VALUES('$lecturer_email', '$user_password', '7', '$vcode', '$status', '$date')");

        if($queryuser)
        {  
            $getID = $conn -> query("SELECT * FROM user WHERE user_username = '$lecturer_email' AND user_password = '$user_password' AND user_created_date = '$date'");

            $rowuser_id = mysqli_fetch_object($getID);
            $get_userid = $rowuser_id->user_id;
            $get_user_role = $rowuser_id->user_role_id;


            $mail = new PHPMailer;

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.unicreds.org';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'support@unicreds.org';                     //SMTP username
                $mail->Password   = 'bK{hqUK9,qwS';                               //SMTP password
                $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('support@unicreds.org');
                $mail->addAddress($lecturer_email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Account Verification';
                $mail->Body    = 'Here is the verification code for Unicreds account registration : <b> '.$vcode.' </b>';

                $mail->send();
                $_SESSION['user'] = $get_userid;
                $_SESSION['email'] = $lecturer_email;
                $_SESSION['fname'] = $lecturer_fname;
                $_SESSION['lname'] = $lecturer_lname;
                $_SESSION['institution_id'] = $lecturer_uni;
                $_SESSION['role_id'] = $get_user_role;
                
                echo ("<script>window.location.href ='verify_account.php'</script>");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

      else
      {
          echo "<script>alert('Error in user registration')</script>";
      }

  }
  else
  {
     echo '<script>alert("This User has been registered")</script>';
  }


}

if(isset($_POST['verify_account_lecturer'])){
    
    $verification_code = mysqli_real_escape_string($conn, $_POST['vcode']);
    $institution_id = $_POST['institution_id'];
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
	$lecturer_fname = mysqli_real_escape_string($conn, $_POST['lect_fname']);
	$lecturer_lname = mysqli_real_escape_string($conn, $_POST['lect_lname']);
    $lecturer_email = mysqli_real_escape_string($conn, $_POST['lect_email']);

    $date = date('Y-m-d H:i:s');
    

        $checkvcode =  $conn -> query("SELECT * FROM user WHERE user_vcode = '$verification_code' AND user_id = '$user_id'");

        if(mysqli_num_rows($checkvcode) == 1)
        {
            $status = "Verified";

            $updateUser = $conn->query("UPDATE user SET user_status = '$status', user_updated_date = '$date' WHERE user_id = '$user_id'");

            if($updateUser)
            {

                $querycreatelecturer = $conn -> query("INSERT INTO lecturer (lecturer_user_id, lecturer_role_id, lecturer_fname, lecturer_lname, lecturer_email, lecturer_institution_id, lecturer_status, lecturer_created_date) 
                VALUES('$user_id', '$role_id', '$lecturer_fname', '$lecturer_lname', '$lecturer_email', '$institution_id', 'Active', '$date')");

                if($querycreatelecturer)
                {
                    $getID = $conn -> query("SELECT lecturer_id FROM lecturer WHERE lecturer_user_id = '$user_id'");

                    $rowUserid = mysqli_fetch_object($getID);
                    $get_lecturerid = $rowUserid -> lecturer_id;
                    $_SESSION['sess_lecturerid'] = $get_lecturerid;
                    session_write_close();

                    echo ("<script>window.location.href = 'lecturer/dashboard.php'</script>");
                    exit();  
                }
                else
                {
                    echo "<script>alert('Registration lecturer failed')</script>";
                }


            }
            else
            {
                echo "<script>alert('User info cannot be updated!')</script>";
            }

        }
        else
        {
            echo "<script>alert('You have entered incorrect code')</script>";

        }
    

}



// Forget password 
if(isset($_POST['forgot_password']))
{
    $user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
    $token = md5(rand());

    $check_email = "SELECT * FROM user WHERE  user_username = '$user_username' LIMIT 1";
    $check_email_run = mysqli_query($conn,$check_email);

    if(mysqli_num_rows($check_email_run) > 0 )
    {
        $row = mysqli_fetch_array($check_email_run);
                // $get_user_role = $row['role'];
        $get_user_username = $row['user_username'];

                //update verify_token
        $update_token = "UPDATE user SET verify_token= '$token'  WHERE user_username='$user_username' LIMIT 1 " ;
        $update_token_run = mysqli_query($conn,$update_token);


        if($update_token_run)
        {
                        // send_password_reset($get_user_username, $token);      //send_password_reset #01
                        // $_SESSION['status'] = "Password has been sent to your email";
                        // echo ("<script>window.location.href = '../pages/forget-password.php'</script>");
                        // exit(0);

        }
        else
        {
                    // $_SESSION['status'] = " Something went wrong";
                    // echo ("<script>window.location.href = '../pages/forget-password.php'</script>");
                    // exit(0);
        }

    }
    else
    {
        $_SESSION['status'] = "This Email not found";
        echo ("<script>window.location.href = '../pages/forget-password.php'</script>");
        exit(0);
    }


}

   //      if (isset($_POST['type'])) {


   //        if ($_POST['type'] == 'read_university_name') 
   //        {
   //          $role = mysqli_real_escape_string($conn,$_POST['role']);
   //          $institution = mysqli_real_escape_string($conn,$_POST['uni_id']);

   //          $queryCheckUni = $conn -> query ("SELECT * from university left join institution ON university_id =  institution.institution_university_id where institution_id = '$institution';");

   //          if (mysqli_num_rows($queryCheckUni) > 0)

   //          {
   //              while ($rows = $queryCheckUni->fetch_assoc())
   //              {
   //                  $uniname = echo $rows -> university_name;

   //                  echo json_encode($uniname);
   //              }
   //          }
   //          else
   //          {
   //              echo "<script>alert('No university found')</script>";
   //          }

   //      }
   //      else
   //      {
   //         echo "<script>alert('error')</script>";
   //     }

   // }



if (isset($_POST['type'])) 
{


  if ($_POST['type'] == 'read_university_name') 
  {
    $role = mysqli_real_escape_string($conn,$_POST['role']);
    $institution = mysqli_real_escape_string($conn,$_POST['uni_id']);

    $queryCheckUni = $conn -> query ("SELECT * from university left join institution ON university_id =  institution.institution_university_id where institution_id = '$institution';");
    $rowreaduni = $queryCheckUni->fetch_object();

    echo json_encode(array(
        "uniname"=>$rowreaduni->university_name,
        "institutionID"=>$rowreaduni->institution_id

    ));

}
else
{
 echo "<script>alert('error')</script>";
}

}
