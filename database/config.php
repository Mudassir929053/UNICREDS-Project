
<?php
session_start();
include  ('dbcon.php');

date_default_timezone_set("Asia/Kuala_Lumpur");

//Include Google Client Library for PHP autoload file
require 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('121593610783-gng69o530li7hdhegfqtrnnjcee6f9er.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('evq81fPHBegy4KW0LXqYGwor');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/unicreds/sign-in.php');

//
$google_client->addScope('email');
$google_client->addScope('profile');

$login_url = $google_client->createAuthUrl();


// authenticate code from Google OAuth Flow
if (isset($_GET['code']))
 {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"]))
    {

        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
       
        //     get profile info
            $google_oauth = new Google_Service_Oauth2($google_client);
            $data = $google_oauth->userinfo->get();

            if(!empty($data ['email']))
            {
                $_SESSION['user_email_address'] = $data['email'];
            }
   
            $user_username = $_SESSION['user_email_address'] =  $data['email'];
            // $user_password = $_SESSION['user_password'] = $data['Password'];



            // check user exists
            $sqlUser = $conn -> query("SELECT * FROM user WHERE user_username = '$user_username'");
      
            if(mysqli_num_rows($sqlUser) > 0) 
            {
                while($row = mysqli_fetch_object($sqlUser))
                {
                    
                        session_regenerate_id();
                        $user_id = $_SESSION['sess_id'] = $row -> user_id;
                        $role_id = $_SESSION['sess_role'] = $row -> user_role_id;
        
                        $date = date('y-m-d H:i:s');
        
        
                        if ($_SESSION['sess_role'] == "1")
                        {
                            $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");
        
                            $rowuser_id = mysqli_fetch_object($getID);
                            $get_userid = $rowuser_id -> admin_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = 'admin/dashboard.php'</script>");
                            exit();            
                        }
                                        //Upper Management
                        elseif ($_SESSION['sess_role'] == "2")
                        {
                            $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> admin_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                            exit();            
                        }
                                        // Finance
                        elseif ($_SESSION['sess_role'] == "3")
                        {
                            $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> admin_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                            exit();            
                        }
                                        //Micro-Credentials
                        elseif ($_SESSION['sess_role'] == "4")
                        {
                            $getID = $conn -> query("SELECT admin_id FROM admin WHERE admin_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> admin_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = '../admin/pages-admin-dashboard.php'</script>");
                            exit();             
                        }
                                        //Institution
                        elseif ($_SESSION['sess_role'] == "5")
                        {
                            $getID = $conn -> query("SELECT institution_id FROM institution WHERE institution_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> institution_id;
                            $_SESSION['sess_institutionid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = 'institution/dashboard.php'</script>");
                            exit();            
                        }
                                        //Industry
                        elseif ($_SESSION['sess_role'] == "6")
                        {
                            $getID = $conn -> query("SELECT industry_id FROM industry WHERE industry_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> industry_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = 'industry/dashboard.php'</script>");
                            exit();            
                        }
                                        // 7 = Lecturer
                        elseif ($_SESSION['sess_role'] == "7")
                        {
                            $getID = $conn -> query("SELECT lecturer_id FROM lecturer WHERE lecturer_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> lecturer_id;
                            $_SESSION['sess_lecturerid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = 'lecturer/dashboard.php'</script>");
                            exit();            
                        }
                                        // Expert
                        elseif ($_SESSION['sess_role'] == "8")
                        {
                            $getID = $conn -> query("SELECT expert_id FROM expert WHERE expert_user_id = '$user_id'");
        
                            $rowUserid = mysqli_fetch_object($getID);
                            $get_userid = $rowUserid -> expert_id;
                            $_SESSION['sess_adminid'] = $get_userid;
                            session_write_close();
        
                            echo ("<script>window.location.href = 'admin/pages-admin-dashboard.php'</script>");
                            exit();            
                        }
                                        //    9 = student
                        elseif ($_SESSION['sess_role'] == "9")
        
                        {   
                            // $checkstudent = $conn -> query ("SELECT institution.institution_id, university.university_name from user left join student_university on  user_id = student_university.su_user_id left join institution ON su_institution_id = institution.institution_id left join university on institution.institution_university_id = university.university_id where student_university.su_user_id = '$user_id' ");
                            // $rowcheckstudent = mysqli_fetch_object($checkstudent);
                            // $getInstitutionId = $rowcheckstudent -> institution_id;
                            // $getUniName = $rowcheckstudent -> university_name;
        
                           $getID = $conn -> query("SELECT su_id FROM student_university WHERE su_user_id = '$user_id'");
        
                            if(mysqli_num_rows($getID) > 0 )
        
                            {
        
                                $rowuser_id = mysqli_fetch_object($getID);
                                $get_userid = $rowuser_id -> su_id;
                                $_SESSION['sess_studentid'] = $get_userid;
                                session_write_close();
        
                                echo ("<script>window.location.href ='student/student-home-page.php'</script>");
                                exit();     
        
                            }
                            else {
                                echo "<script>alert('Your account has been terminated by Unicreds');
                                location.href = '$_SERVER[HTTP_REFERER]';</script>";
                            }
        
        
                        }
                        
                    }
                } else
                {
                    echo '<script>alert("Username not exist")</script>';
                }
            

     } else {
         header('Location: sign-in.php');
         exit;
     }

}


   

?>

