<?php
// file untuk proses dan function
// include('../database/dbcon.php');
$root_path = $_SERVER["DOCUMENT_ROOT"]."/unicreds/";
// var_dump($root_path);
// exit;
include($root_path."database/dbcon.php");
foreach(glob($root_path."student/class/*.php") as $filename) {
    include $filename;
}
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

// Student university id.
$suID = !empty($_SESSION['sess_studentid'])?$_SESSION['sess_studentid']:'';

// Instantiation of classes.
use DBData\Student as student;
use DBData\Course as c;
use DBData\Microcredential as mc;
use DBData\Job as job;
use DBData\Announcement as ann;
use DBData\LanguageTest as lt;
use DBData\PsychometricTest as pt;
use DBData\SkillAssessment as sk;
use DBData\EmployabilityProgram as ep;



$suInfo = new student($suID);
$courseInfo = new c($suID);
$mcInfo = new mc($suID);
$jobInfo = new job();
$annInfo = new ann();
$epInfo = new ep($suID);
$ltInfo = new lt($suID);
$ptInfo = new pt($suID);
$skInfo = new sk($suID);

// Create new directory for student university based on su_id.
$fileDir = $root_path."assets/attachment/student/".$suID."/";
if(!file_exists($fileDir)) {
    // --- create cv directory.
    mkdir($fileDir."cv/", 0777, true);
    // --- create skillcert directory.
    mkdir($fileDir."skillcert/", 0777, true);
    // --- create submission/course/tutorial directory.
    mkdir($fileDir."submission/course/tutorial/", 0777, true);
    // --- create submission/course/assignment directory.
    mkdir($fileDir."submission/course/assignment/", 0777, true);
    // --- create submission/course/project directory.
    mkdir($fileDir."submission/course/project/", 0777, true);
    // --- create submission/microcredential/tutorial directory.
    mkdir($fileDir."submission/microcredential/tutorial/", 0777, true);
    // --- create submission/microcredential/assignment directory.
    mkdir($fileDir."submission/microcredential/assignment/", 0777, true);
    // --- create submission/microcredential/project directory.
    mkdir($fileDir."submission/microcredential/project/", 0777, true);
}


/*------------------------------------------------------------- FUNCTIONS -------------------------------------------------------------*/

/**
 * Function to format the Time.
 * Used for the __Video__ tab in __course/micro-creds-learning-material.php__ page.
 * 
 * @param string $time Time in __HH:MM:SS__ format.
 * @return string Time formatted in __HHh MMm SSs__.
 */
function duration_formatting($time) {
    $slot = explode(":", $time);

    $hour = $slot[0] === "00" ? "" : (substr($slot[0], 0, -1) == "0" ? substr($slot[0], 1)."h " : $slot[0]."h ");
    $minute = $slot[1] === "00" ? "" : (substr($slot[1], 0, -1) == "0" ? substr($slot[1], 1)."m " : $slot[1]."m ");
    $second = $slot[2] === "00" ? "" : (substr($slot[2], 0, -1) == "0" ? substr($slot[2], 1)."s " : $slot[2]."s");

    return $hour.$minute.$second;
}

/**
 * Function to calculate the time remaining based on the `$duetime` and `$duedate`.
 * Used for the __Tutorial__ and __Assignment__ tab in __course/micro-creds-learning-material.php__ page.
 * 
 * @param string $duetime Time string in __HH:MM:SS__ format.
 * @param string $duedate Date string in __YYYY-MM-DD__ format.
 * @return string string of time remainingf from the due time and due date.
 */
function timeRemaining($duetime, $duedate) {
    $dueDateTime = $duedate . " " . $duetime;

    $now = new DateTime();
    $future_date = new DateTime($dueDateTime);
    
    $interval = $future_date->diff($now);
    
    if($now->format("Y-m-d H-m-s") < $dueDateTime) {
        echo $interval->format("%a days, %h hours, %i minutes");
    } else {
        echo "<span class='text-danger'>Due: {$interval->format('%a days, %h hours, %i minutes')}</span>";
    }
}

/**
 * Function to determine the skill level and return HTML code to display the level.
 * Used for the __Skill__ tab in __student-manage-portfolio.php__ page.
 * 
 * @param string $skill_level level of the skill.
 * @return string string of HTML code.
 */
function skillLevel($skill_level) {
    switch($skill_level) {
        case "Beginner":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                    '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                    '<rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9" />' . 
                    '<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9" />' . 
                '</svg>' . 
                'Beginner'
            );
            break;
        case "Intermediate":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                    '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                    '<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE" />' . 
                    '<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9" />' . 
                '</svg>' . 
                'Intermediate'
            );
            break;
        case "Advance":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                   '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                   '<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE" />' . 
                   '<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE" />' . 
                '</svg>' . 
                'Advance'
            );
            break;
        default:
            return NULL;
    }
}

/**
 * Function to print the duration based on the format.
 * 
 * @param int $duration duration in minutes.
 * @param string $format how to display the duration based on format values.
 * @return string formatted string of duration.
 */
function durationFormat($duration, $format = "%02d:%02d:%02d") {
   $hours = floor($duration / 60);
   $minutes = ($duration % 60);
   $seconds = 0;

   return sprintf($format, $hours, $minutes, $seconds);
}

/**
 * Function to determine micro-credential's academic level.
 * 
 * @param string $acad_lvl string of integer of academic level (eg. '1, 2').
 * @return string string of academic level name.
 */
function acadLevel($acad_lvl) {
    $level_int = explode(",", $acad_lvl);
    $result = "";

    $i = 0;
    foreach($level_int as $val) {
        if($val == "1") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Undergraduate";
        } else if($val == "2") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Postgraduate";
        } else if($val == "3") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Continuing and Professional Development";
        }

        $i++;
    }

    return $result;
}

/**
 * Convert the fee from sen to RM.
 * eg.: 100 = RM 1.00.
 * 
 * @param string|int $fee fee for course/micro-credential.
 * @return string string of the fee in RM XXX.XX.
 */
function feeFormat($fee) {
    $fee_RM = floatval($fee/100);

    // return "RM ".number_format($fee_RM, 2, "."," ");
    return "RM ".$fee_RM;
}

/**
 * Function to parse the minimum and maximum job salary.
 * 
 * @param int $min_sal minimum salary in integer.
 * @param int $max_sal maximun salary in integer.
 * @return string formatted string of salary.
 */
function salary($min_sal, $max_sal) {
    if($min_sal != 0 || $max_sal != 0) {
        if($min_sal === 0) {
            $sal_str = $max_sal > 1000 ? round($max_sal/1000, 1)."K" : $max_sal;
        } else if($max_sal === 0) {
            $sal_str = $min_sal > 1000 ? round($min_sal/1000, 1)."K" : $min_sal;
        } else {
            $sal_str = ($min_sal > 1000 ? round($min_sal/1000, 1)."K" : $min_sal)." - ".($max_sal > 1000 ? round($max_sal/1000, 1)."K" : $max_sal);
        }

        return "MYR {$sal_str} monthly";
    } else {
        return "<span class='text-muted'><em>Not specified</em></span>";
    }
}

/* ------------add forum reply course----------*/
if (isset($_POST['add_forum_reply_course'])) {
	
	$topic_id = $_POST['topic_id'];
	$forum_reply = mysqli_real_escape_string($conn, $_POST['forum_reply']);

	$date = date('Y-m-d H:i:s');

    $queryUserId= $conn->query("SELECT su_user_id from student_university WHERE su_id = '$suID';");
    $rowReadUser = $queryUserId->fetch_object();
    $get_userID = $rowReadUser->su_user_id;
	

	$addForumMessage = $conn->query("INSERT INTO forum_post_course (fpc_topic_id, fpc_message, fpc_student, fpc_created_date)
							   VALUES ('$topic_id', '$forum_reply', '$get_userID', '$date')");

	if ($addForumMessage) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum message are not successfully sent.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum reply course----------*/

/* ------------edit forum reply course----------*/
if (isset($_POST['edit_forum_reply_course'])) {

	$topic_id = $_POST['topic_id'];
    $fpc_id = $_POST['fpc_id'];
    $student_user_id = $_POST['student_user_id'];
	$new_forum_reply = mysqli_real_escape_string($conn, $_POST['new_forum_reply']);

	$updateforumreply = $conn->query("UPDATE forum_post_course SET fpc_message = '$new_forum_reply' 
	WHERE fpc_id = '$fpc_id' AND fpc_topic_id = '$topic_id' AND fpc_student = '$student_user_id'");

	if ($updateforumreply) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('edit forum reply is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------edit forum reply course----------*/

/* ------------delete forum reply course----------*/
if (isset($_GET['delete_reply_course'])) {

	$fpc_id = $_GET['delete_reply_course'];
	$topic_id = $_GET['topic_id'];
	$student_user_id = $_GET['suid'];

	$delreply = $conn->query("DELETE FROM forum_post_course WHERE fpc_id = '$fpc_id' AND fpc_topic_id = '$topic_id' AND fpc_student = '$student_user_id'");

	if ($delreply) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete message is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum reply course----------*/



/* ------------add forum reply mc----------*/
if (isset($_POST['add_forum_reply_mc'])) {
	
	$topic_id = $_POST['topic_id'];
	$forum_reply = mysqli_real_escape_string($conn, $_POST['forum_reply']);

	$date = date('Y-m-d H:i:s');

    $queryUserId= $conn->query("SELECT su_user_id from student_university WHERE su_id = '$suID';");
    $rowReadUser = $queryUserId->fetch_object();
    $get_userID = $rowReadUser->su_user_id;
	

	$addForumMessageMC = $conn->query("INSERT INTO forum_post_mc (fpm_topic_id, fpm_message, fpm_student, fpm_created_date)
							   VALUES ('$topic_id', '$forum_reply', '$get_userID', '$date')");

	if ($addForumMessageMC) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum message are not successfully sent.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum reply mc----------*/

/* ------------edit forum reply mc----------*/
if (isset($_POST['edit_forum_mc_reply'])) {

	$topic_id = $_POST['topic_id'];
    $fpm_id = $_POST['fpm_id'];
    $student_user_id = $_POST['student_user_id'];
	$new_forum_reply = mysqli_real_escape_string($conn, $_POST['new_forum_reply_mc']);

	$updateforumreplymc = $conn->query("UPDATE forum_post_mc SET fpm_message = '$new_forum_reply' 
	WHERE fpm_id = '$fpm_id' AND fpm_topic_id = '$topic_id' AND fpm_student = '$student_user_id'");

	if ($updateforumreplymc) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('edit forum reply is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------edit forum reply mc----------*/

/* ------------delete forum reply----------*/
if (isset($_GET['delete_reply_mc'])) {

	$fpm_id = $_GET['delete_reply_mc'];
	$topic_id = $_GET['topic_id'];
	$student_user_id = $_GET['suid'];

	$delreplymc = $conn->query("DELETE FROM forum_post_mc WHERE fpm_id = '$fpm_id' AND fpm_topic_id = '$topic_id' AND fpm_student = '$student_user_id'");

	if ($delreplymc) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete message is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum reply----------*/




//*******************************************************START COVER LETTER******************************************************************/
/* ------------add cover letter-----------*/
if (isset($_POST['coversubmit'])) {
    $suID = $_SESSION['sess_studentid'];


    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $introduction = $_POST['introduction'];

    


    $date = $_POST['date'];

    //******FETCH DATA FOR DROPDOWN OF CURRENT SITUATION*******//
    $current_situation =  $_POST['current_situation'];


    if ($current_situation == "option1") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option1']);
    } elseif ($current_situation == "option2") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option2']);
    } elseif ($current_situation == "option3") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option3']);
    } elseif ($current_situation == "option4") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option4']);
    } elseif ($current_situation == "option5") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option5']);
    } elseif ($current_situation == "option6") {
        $answer1 = mysqli_real_escape_string($conn, $_POST['option6']);
    }else{
        $answer1=NULL;
    }


    //******FETCH DATA FOR DROPDOWN OF INTRODUCTION*******//
    $introduction = $_POST['introduction'];
    if ($introduction == "open") {
        $answer2 = mysqli_real_escape_string($conn, $_POST['open']);
    } elseif ($introduction == "mag") {
        $answer2 = mysqli_real_escape_string($conn, $_POST['mag']);
    } elseif ($introduction == "add") {
        $answer2 = mysqli_real_escape_string($conn, $_POST['add']);
    } elseif ($introduction == "other") {
        $answer2 = mysqli_real_escape_string($conn, $_POST['other']);
    }else{
        $answer2 = NULL;
    }

    //******INSERT DATA FOR DROPDOWN OF INTRODUCTION*******//
    $introduction = $_POST['introduction'];
    if ($introduction == "open") {
        $answer5 = "open";
    } elseif ($introduction == "mag") {
        $answer5 = "mag";
    } elseif ($introduction == "add") {
        $answer5 = "add";
    } elseif  ($introduction == "other"){
        $answer5 = "other";
    }else{
        $answer5="";
    }

    //******INSERT DATA FOR DROPDOWN OF CURRENT SITUATION*******//
    $current_situation = $_POST['current_situation'];
    if ($current_situation == "option1") {
        $answer6 = "option1";
    } elseif ($current_situation == "option2") {
        $answer6 = "option2";
    } elseif ($current_situation == "option3") {
        $answer6 = "option3";
    } elseif ($current_situation == "option4") {
        $answer6 = "option4";
    } elseif ($current_situation == "option5") {
        $answer6 = "option5";
    } elseif ($current_situation == "option6") {
        $answer6 = "option6";
    }else{
        $answer6="";
    }



    //******INSERT DATA FOR DROPDOWN OF MOTIVATION*******//
    $motivation = $_POST['motivation'];
    if ($motivation == "career") {
        $answer7 = "career";
    } elseif ($motivation == "education") {
        $answer7 = "education";
    } elseif ($motivation == "experience") {
        $answer7 = "experience";
    }else{
        $answer7="";
    }

    //******INSERT DATA FOR DROPDOWN OF CLOSING*******//
    $closing = $_POST['closing'];
    if ($closing == "vacancy") {
        $answer8 = "vacancy";
    } elseif($closing == "openapply") {
        $answer8 = "openapply";
    }else{
        $answer8="";
    }




    //******FETCH DATA FOR DROPDOWN OF MOTIVATION*******//
    $motivation = $_POST['motivation'];
    if ($motivation == "career") {
        $answer3 = mysqli_real_escape_string($conn, $_POST['career']);
    } elseif ($motivation == "education") {
        $answer3 = mysqli_real_escape_string($conn, $_POST['education']);
    } elseif ($motivation == "experience") {
        $answer3 = mysqli_real_escape_string($conn, $_POST['experience']);
    }else{
        $answer3=NULL;
    }



    //******FETCH DATA FOR DROPDOWN OF CLOSING*******//
    $closing = $_POST['closing'];
    if ($closing == "vacancy") {
        $answer4 = mysqli_real_escape_string($conn, $_POST['vacancy']);
    } elseif ($closing == "openapply") {
        $answer4 = mysqli_real_escape_string($conn, $_POST['openapply']);
    }else{
        $answer4=NULL;
    }


    
    

    
    $addcoverletter = $conn->query("INSERT INTO cover_letter(name,email,user_id,created_date,address,contact_no,introduction_type,current_situation_type,motivation_type,closing_type,introduction,current_situation,motivation,closing)
							   VALUES ('$name', '$email','$suID', '$date','$address','$contact_no','$answer5','$answer6','$answer7','$answer8','$answer2','$answer1','$answer3','$answer4')");

    if ($addcoverletter) {
        echo ("<script>location.href='cover-templates.php';</script>");
    } else {
        echo "<script>alert('something went wrong');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//***************UPDATE THE DATA****************************/




if (isset($_POST['coverupdatesubmit'])) {
    $suID = $_SESSION['sess_studentid'];


    $name_new = $_POST['name'];
    $email_new = $_POST['email'];
    $address_new = $_POST['address'];
    $contact_no_new = $_POST['contact_no'];
    $introduction_new = $_POST['introduction'];

    


    $date_new = $_POST['date'];

    //******FETCH DATA FOR DROPDOWN OF CURRENT SITUATION*******//
    $current_situation_new =  $_POST['current_situation'];


    if ($current_situation_new == "option1") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option1']);
    } elseif ($current_situation_new == "option2") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option2']);
    } elseif ($current_situation_new == "option3") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option3']);
    } elseif ($current_situation_new == "option4") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option4']);
    } elseif ($current_situation_new == "option5") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option5']);
    } elseif ($current_situation_new == "option6") {
        $answer1_new = mysqli_real_escape_string($conn, $_POST['option6']);
    }else{
        $answer1_new=NULL;
    }



    //******FETCH DATA FOR DROPDOWN OF INTRODUCTION*******//
    $introduction_new = $_POST['introduction'];
    if ($introduction_new == "open") {
        $answer2_new = mysqli_real_escape_string($conn, $_POST['open']);
    } elseif ($introduction_new == "mag") {
        $answer2_new = mysqli_real_escape_string($conn, $_POST['mag']);
    } elseif ($introduction_new == "add") {
        $answer2_new = mysqli_real_escape_string($conn, $_POST['add']);
    } elseif ($introduction_new == "other") {
        $answer2_new = mysqli_real_escape_string($conn, $_POST['other']);
    }else{
        $answer2_new=NULL;
    }


    //******INSERT DATA FOR DROPDOWN OF INTRODUCTION*******//
    $introduction_new = $_POST['introduction'];
    if ($introduction_new == "open") {
        $answer5_new = "open";
    } elseif ($introduction_new == "mag") {
        $answer5_new = "mag";
    } elseif($introduction_new == "add") {
        $answer5_new = "add";
    } else if($introduction_new == "other"){
        $answer5_new = "other";
    }else{
        $answer5_new="";
    }


    //******INSERT DATA FOR DROPDOWN OF CURRENT SITUATION*******//
    $current_situation_new = $_POST['current_situation'];
    if ($current_situation_new == "option1") {
        $answer6_new = "option1";
    } elseif ($current_situation_new == "option2") {
        $answer6_new = "option2";
    } elseif ($current_situation_new == "option3") {
        $answer6_new = "option3";
    } elseif ($current_situation_new == "option4") {
        $answer6_new = "option4";
    } elseif ($current_situation_new == "option5") {
        $answer6_new = "option5";
    } elseif ($current_situation_new == "option6") {
        $answer6_new = "option6";
    }else{
        $answer6_new="";
    }




    //******INSERT DATA FOR DROPDOWN OF MOTIVATION*******//
    $motivation_new = $_POST['motivation'];
    if ($motivation_new == "career") {
        $answer7_new = "career";
    } elseif ($motivation_new == "education") {
        $answer7_new = "education";
    } elseif ($motivation_new == "experience") {
        $answer7_new = "experience";
    }else{
        $answer7_new="";
    }

    //******INSERT DATA FOR DROPDOWN OF CLOSING*******//
    $closing_new = $_POST['closing'];
    if ($closing_new == "vacancy") {
        $answer8_new = "vacancy";
    } else if ($closing_new == "openapply"){
        $answer8_new = "openapply";
    }else{
        $answer8_new="";
    }




    //******FETCH DATA FOR DROPDOWN OF MOTIVATION*******//
    $motivation_new = $_POST['motivation'];
    if ($motivation_new == "career") {
        $answer3_new = mysqli_real_escape_string($conn, $_POST['career']);
    } elseif ($motivation_new == "education") {
        $answer3_new = mysqli_real_escape_string($conn, $_POST['education']);
    } elseif ($motivation_new == "experience") {
        $answer3_new = mysqli_real_escape_string($conn, $_POST['experience']);
    }else{
        $answer3_new=NULL;
    }


    //******FETCH DATA FOR DROPDOWN OF CLOSING*******//
    $closing_new = $_POST['closing'];
    if ($closing_new == "vacancy") {
        $answer4_new = mysqli_real_escape_string($conn, $_POST['vacancy']);
    } else if ($closing_new == "experience") {
        $answer4_new = mysqli_real_escape_string($conn, $_POST['experience']);
    }else{
        $answer4_new=NULL;
    }



    $updatecoverletter = $conn->query("UPDATE cover_letter SET name='$name_new',
    email='$email_new',
    user_id='$suID',
    created_date='$date_new',
    address='$address_new',
    contact_no='$contact_no_new',
    introduction_type='$answer5_new',
    current_situation_type='$answer6_new',
    motivation_type='$answer7_new',
    closing_type='$answer8_new',
    introduction='$answer2_new',
    current_situation='$answer1_new',
    motivation='$answer3_new',
    closing='$answer4_new'
    WHERE user_id=$suID 
                         order by coverletter_id desc
                         limit 1
    ");

    if ($updatecoverletter) {
        echo ("<script>location.href='cover-templates.php';</script>");
    } else {
        echo "<script>alert('something went wrong');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}
//*******************************************************END COVER LETTER******************************************************************/

//*******************************************************START DOCUMENT MANAGER******************************************************************/

// *****************FILE UPLOAD ADD FOR DOCUMENT MANAGER******************************//


if (isset($_POST['add_document_manager_file'])) {
    $suID = $_SESSION['sess_studentid'];
    // $stq_type = $_POST['stq_type'];
    $file_name = $_POST['file_name'];

    // $stqid = $_POST['stq_id'];
 
    if ($_FILES['pa_attachment']['name'] != NULL) {
       $pa_attachment = str_replace("'", "", date('YmdHis') . $_FILES['pa_attachment']['name']);
    } else {
       $pa_attachment = "";
    }
    $folder1 = "../assets/attachment/document_manager/";
    move_uploaded_file($_FILES['pa_attachment']['tmp_name'], $folder1 . $pa_attachment);
    // $st_date_created = date('Y-m-d H:i:s');
    
    $insertquestionfilequiz = $conn->query("INSERT INTO  document_manager(dm_file_name,dm_created_by,dm_file_upload) 
         values('$file_name','$suID','$pa_attachment') ");
    if ($insertquestionfilequiz) {
       echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
       $_SESSION['assessment_type'] = $assessmenttype;
    } else {
 
       echo "<script>alert('Create course quiz is not successful');
         location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
 }
 
// *****************END OF FILE UPLOAD ADD FOR DOCUMENT MANAGER******************************//

// **********************EDIT OF CV FOR DOCUMENT MANAGER*****************************************//

if (isset($_POST['dm_cv_edit_file_upload'])) {
    $suID = $_SESSION['sess_studentid'];
   $su_id = $_POST['su_id'];
    // $new_cv_attachment = $_POST['new_cv_attachment'];
    // $stq_question = "sana";
    $dir = "../assets/attachment/student/$su_id/cv/";
    if ($_FILES["new_cv_attachment"]["name"] != NULL) {
       $newattach = str_replace("'", "", date('YmdHis') . $_FILES["new_cv_attachment"]["name"]);
    } else {
       $newattach = "";
    }
    $file = $dir . $newattach;
    if ($newattach != NULL) {
       $checkattachfile = $conn->query("SELECT su_cv FROM student_university WHERE su_id = '$su_id' ");
       $checkattachRow = mysqli_fetch_object($checkattachfile);
       if ($checkattachRow->su_cv != NULL) {
          unlink($dir . $checkattachRow->su_cv);
          move_uploaded_file($_FILES['new_cv_attachment']['tmp_name'], $file);
          $editmcn = $conn->query("UPDATE student_university SET su_cv = '$newattach' WHERE su_id = '$su_id' ");
          if ($editmcn) {
             echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
             $_SESSION['content_type'] = $contenttype;
          } else {
             echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
                 location.href = '$_SERVER[HTTP_REFERER]';</script>";
          }
       } 
    }
 }
 
 // *****************************END OF CV FOR DOCUMENT MANAGER*******************************//

 // *****************************DELETE OF CV FOR DOCUMENT MANAGER*******************************//

 if (isset($_GET['dm_cv_delete_file'])) {
    $fileName = $_GET['dm_cv_delete_file'];
    $fileDir = "../../assets/attachment/student/$suID/cv/";

    // Check if the remove operation successfull or not.

    if (unlink($fileDir . $fileName)) {
        // --- update su_cv to NULL.
        $dm_cv_delete_file = $suInfo->update_cv(NULL);
        
        // --- check if the update is a success or failure.
        if($dm_cv_delete_file) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
      
    } else {
        echo "<script>alert('Error removing file from directory.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
    exit();
 }

 // *****************************END DELETE OF CV FOR DOCUMENT MANAGER*******************************//



// **********************EDIT OF FILE UPLOAD FOR DOCUMENT MANAGER*****************************************//

if (isset($_POST['dm_edit_file_upload'])) {
    $suID = $_SESSION['sess_studentid'];
    $dm_id = $_POST['dm_id'];
    $newfile_name = $_POST['new_file_name'];

    $dir = "../assets/attachment/document_manager/";
    $newattach = "";
    $file = "";

    // Check if a new file is selected for upload
    if ($_FILES["new_dm_attachment"]["name"] != "") {
        $newattach = str_replace("'", "", date('YmdHis') . $_FILES["new_dm_attachment"]["name"]);
        $file = $dir . $newattach;
    }

    // Check if the file exists and needs to be updated
    $checkattachfile = $conn->query("SELECT dm_file_upload FROM document_manager WHERE dm_id = '$dm_id'");
    $checkattachRow = mysqli_fetch_object($checkattachfile);
    $currentattach = $checkattachRow->dm_file_upload;

    // Update the file name and/or upload a new file
    if ($newfile_name != "" || $newattach != "") {
        $editmcn = $conn->query("UPDATE document_manager SET dm_file_name = '$newfile_name', dm_file_upload = '$newattach' WHERE dm_id = '$dm_id'");
        if ($editmcn) {
            // Remove the current file if a new file is uploaded
            if ($newattach != "" && $currentattach != "") {
                unlink($dir . $currentattach);
            }

            // Upload the new file if selected
            if ($newattach != "") {
                move_uploaded_file($_FILES['new_dm_attachment']['tmp_name'], $file);   
            }

            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            $_SESSION['content_type'] = $contenttype;
        } else {
            echo "<script>alert('Failed to update micro-credential note attachment.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }
}


 
 // *****************************END OF FILE UPLOAD FOR DOCUMENT MANAGER*******************************//


 // *****************************DELETE OF FILE UPLOAD FOR DOCUMENT MANAGER*******************************//

 if (isset($_GET['dm_delete_file'])) {
    $delete = $_GET['dm_delete_file'];

    $delfile = $conn->query("DELETE FROM document_manager WHERE dm_id = '$delete'");
    if ($delfile) {
       echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
       $_SESSION['assessment_type'] = $assessmenttype;
    } else {
       echo "<script>alert('Delete quiz is not successful.');
         location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
 }

 // *****************************END DELETE OF FILE UPLOAD FOR DOCUMENT MANAGER*******************************//



//*******************************************************END DOCUMENT MANAGER******************************************************************//

