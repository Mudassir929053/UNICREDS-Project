<?php
include('../database/dbcon.php');
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$industry_id = $_SESSION['sess_industryid'];

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
/* ------------update profile----------*/
if (isset($_POST['edit_industry_profile'])) {
   $industry_id = $_POST['industry_id'];
   $industry_user_id = $_POST['industry_user_id'];
   $new_company_size = mysqli_real_escape_string($conn, $_POST['new_company_size']);
   $new_operation_date = mysqli_real_escape_string($conn, $_POST['new_industry_start_operation_date']);
   $new_industry_field_id = $_POST['new_industry_field_id'];
   $new_company_overview = mysqli_real_escape_string($conn, $_POST['new_company_overview']);
   $new_industry_address1 = mysqli_real_escape_string($conn, $_POST['new_industry_address1']);
   $new_state = $_POST['new_state'];
   $new_industry_city = $_POST['new_industry_city'];
   $new_industry_country = $_POST['new_industry_country'];

   $editIndustry = $conn->query("UPDATE industry SET industry_address1 = '$new_industry_address1', 
                                        industry_city_id = '$new_industry_city', 
                                        industry_state_id = '$new_state', 
                                        industry_country_id = '$new_industry_country', 
                                        industry_industry_field_id = '$new_industry_field_id' 
                                        WHERE industry_id = '$industry_id' AND industry_user_id = '$industry_user_id'");

   if ($editIndustry) {

      $queryCheckIndDetail = $conn->query("SELECT * FROM industry_information WHERE ii_industry_id = '$industry_id';");

      if (mysqli_num_rows($queryCheckIndDetail) == 0) {

         $InsertCompanyDetails = $conn->query("INSERT INTO industry_information (ii_industry_id, ii_overview, ii_company_size, ii_start_operation_date)
         VALUES ('$industry_id', '$new_company_overview', '$new_company_size', '$new_operation_date')");

         if ($InsertCompanyDetails) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
         } else {
            echo "<script>alert('Industry information not successfully stored.');
            location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      } else {
         $editIndustryInfo = $conn->query("UPDATE industry_information SET ii_overview = '$new_company_overview',
                                          ii_company_size = '$new_company_size',
                                          ii_start_operation_date = '$new_operation_date'         
                                          WHERE ii_industry_id = '$industry_id'");

         if ($editIndustryInfo) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
         } else {
            echo "<script>alert('Edit industry information is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      }
   } else {
      echo "<script>alert('Edit industry not successfully stored.');
      location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------update profile----------*/

/* ------------add job----------*/
if (isset($_POST['add_job'])) {

   $industry_id = $_SESSION['sess_industryid'];
   $job_title = $_POST['job_title'];
   $job_code = $_POST['job_code'];
   $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
   $job_type = $_POST['job_type'];
   $job_level = $_POST['job_level'];
   $job_category = $_POST['job_category'];
   $salary_currency = $_POST['salary_currency'];
   $job_min_salary = $_POST['job_min_salary'];
   $job_max_salary = $_POST['job_max_salary'];
   $job_no_of_vacancies = $_POST['job_no_of_vacancies'];
   $job_experience_year = $_POST['job_experience_year'];
   $job_qualification = mysqli_real_escape_string($conn, $_POST['job_qualification']);
   $job_date_created = date('Y-m-d H:i:s');
   $job_status = "Draft";

   $addJob = $conn->query("INSERT INTO job (job_code, job_title, job_description, job_date_created, job_no_of_vacancies, job_salary_currency, job_min_salary, job_max_salary, job_type, job_category_id, job_industry_id, job_level, job_experience_year, job_qualification, job_status)
							   VALUES ('$job_code', '$job_title', '$job_description', '$job_date_created', '$job_no_of_vacancies', '$salary_currency', '$job_min_salary', '$job_max_salary', '$job_type', '$job_category', '$industry_id', '$job_level', '$job_experience_year', '$job_qualification', '$job_status')");

   if ($addJob) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('New vacancy not successfully stored.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------add job----------*/

/* ------------edit job----------*/
if (isset($_POST['edit_job'])) {

   $industry_id = $_SESSION['sess_industryid'];
   $job_id = $_POST['job_id'];
   $new_job_title = $_POST['new_job_title'];
   $new_job_code = $_POST['new_job_code'];
   $new_job_description = mysqli_real_escape_string($conn, $_POST['new_job_description']);
   $new_job_type = $_POST['new_job_type'];
   $new_job_level = $_POST['new_job_level'];
   $new_job_category = $_POST['new_job_category'];
   $new_salary_currency = $_POST['new_salary_currency'];
   $new_job_min_salary = $_POST['new_job_min_salary'];
   $new_job_max_salary = $_POST['new_job_max_salary'];
   $new_job_no_of_vacancies = $_POST['new_job_no_of_vacancies'];
   $new_job_experience_year = $_POST['new_job_experience_year'];
   $new_job_qualification = mysqli_real_escape_string($conn, $_POST['new_job_qualification']);

   $editJob = $conn->query("UPDATE job SET job_code = '$new_job_code', job_title = '$new_job_title', job_description = '$new_job_description', job_no_of_vacancies = '$new_job_no_of_vacancies', job_salary_currency = '$new_salary_currency', job_min_salary = '$new_job_min_salary', job_max_salary = '$new_job_max_salary', job_type = '$new_job_type', job_category_id = '$new_job_category', job_level = '$new_job_level', job_experience_year = '$new_job_experience_year', job_qualification = '$new_job_qualification' 
                            WHERE job_id = '$job_id' AND job_industry_id = '$industry_id'");

   if ($editJob) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('Edit vacancy not successfully.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------edit job----------*/

/* ------------delete job----------*/
if (isset($_GET['delete_job'])) {
   $delete = $_GET['delete_job'];

   $queryCheckJobApps = $conn->query("SELECT * FROM job_student_university_application WHERE jsua_job_id = '$delete';");

   if (mysqli_num_rows($queryCheckJobApps) == 0) {

      $deljob = $conn->query("DELETE FROM job where job_id = '$delete'");

   if ($deljob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('Delete vacancy is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }

   }else
   {
      echo "<script>alert('This job cannot be deleted because there is applicant(s) have applied this job.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }

   
}
/* ------------delete job----------*/

/* ------------post job----------*/
if (isset($_GET['post_job'])) {
   $job_id = $_GET['post_job'];
   $status = "Active";
   $job_date_posted = date('Y-m-d H:i:s');

   $postjob =  $conn->query("UPDATE job SET job_status = '$status', job_date_posted = '$job_date_posted' WHERE job_id = '$job_id'");

   if ($postjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('Post job is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------post job----------*/

/* ------------interview job----------*/
if (isset($_GET['interview'])) {
   $jsua_id = $_GET['interview'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "Invite for interview";

   $interviewjob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($interviewjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('Invite for interview is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------interview job----------*/

/* ------------remove interview----------*/
if (isset($_GET['remove_appt'])) {
   $jsua_id = $_GET['remove_appt'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "Pending";

   $removeapptjob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($removeapptjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('remove appointment is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------remove interview----------*/

/* ------------kiv----------*/
if (isset($_GET['kiv'])) {
   $jsua_id = $_GET['kiv'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "KIV";

   $kivjob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($kivjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('KIV is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------kiv----------*/

/* ------------remove kiv----------*/
if (isset($_GET['remove_kiv'])) {
   $jsua_id = $_GET['remove_kiv'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "Pending";

   $kivjob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($kivjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('Remove from keep in view is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------remove kiv----------*/

/* ------------reject----------*/
if (isset($_GET['reject'])) {
   $jsua_id = $_GET['reject'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "Rejected";

   $rejectjob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($rejectjob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('KIV is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------reject----------*/

/* ------------reject----------*/
if (isset($_GET['reinstate'])) {
   $jsua_id = $_GET['reinstate'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];
   $status = "Pending";

   $reinstatejob =  $conn->query("UPDATE job_student_university_application SET jsua_status = '$status'  WHERE jsua_id  = '$jsua_id' AND jsua_job_id  = '$job_id' AND jsua_student_university_id = '$su_id'");

   if ($reinstatejob) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['tab_type'] = $status;

   } else {
      echo "<script>alert('reinstate is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------reject----------*/




/*-------------------------------------------------------------------------------Physometric Test ----------------------------------------------------------------------------------------------------------*/
/* ------------add course quiz----------*/
if (isset($_POST['add_Physometric_Test'])) {
   $industry_id  = $_SESSION['sess_industryid'];
   $pt_title = $_POST['pt_title'];
   $pt_instruction = mysqli_real_escape_string($conn, $_POST['pt_instruction']);
   $pt_duration = mysqli_real_escape_string($conn, $_POST['pt_duration']);
   $pt_date_created = date('Y-m-d H:i:s');
   $pt_status = $_POST['pt_status'];
   $assessmenttype = "Physometric-Test";
   $checkuserrow = $conn->query("SELECT industry_user_id  FROM industry WHERE industry_id  = '$industry_id '");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_user_id;
   $insertcoursequiz = $conn->query("INSERT INTO psychometric_test(pt_title,pt_instruction,pt_duration,pt_created_by,pt_status) 
		values('$pt_title','$pt_instruction','$pt_duration','$get_userID','$pt_status')");
   if ($insertcoursequiz) {
      echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Create course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------add course quiz----------*/
/* ------------edit course quiz----------*/
if (isset($_POST['edit_career_readiness_test'])) {
   $pt_id = $_POST['pt_id'];
   $new_pt_title = $_POST['new_pt_title'];
   $new_pt_instruction = mysqli_real_escape_string($conn, $_POST['new_pt_instruction']);
   $new_pt_duration = $_POST['new_pt_duration'];
   $cq_date_updated = date('Y-m-d H:i:s');
   $assessmenttype = "Physometric-Test";
   // $updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET epq_title = '$new_pt_title', epq_instruction = '$new_pt_instruction',
   //  epq_duration = '$new_pt_duration' WHERE epq_id = '$cq_id' AND epq_ep_id  = '$course_id'");
   $updatecoursequiz = $conn->query("UPDATE psychometric_test SET pt_title = '$new_pt_title', pt_instruction = '$new_pt_instruction', pt_duration = '$new_pt_duration' 
	 									WHERE pt_id = '$pt_id';");
   if ($updatecoursequiz) {
      $_SESSION['assessment_type'] = $assessmenttype;
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('edit course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------edit course quiz----------*/
/* ------------publish course quiz----------*/
if (isset($_GET['publish_crt'])) {
   $pt_id = $_GET['publish_crt'];
   $assessmenttype = "Physometric-Test";
   $cq_updated_date = date('Y-m-d H:i:s');
   $publishcq = $conn->query("UPDATE psychometric_test SET pt_status = 'Published' WHERE pt_id = '$pt_id' ");
   if ($publishcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}

/* ------------unpublish course quiz----------*/
if (isset($_GET['unpublish_crt'])) {
   $pt_id = $_GET['unpublish_crt'];
   $assessmenttype = "Physometric-Test";
   $unpublishcq = $conn->query("UPDATE psychometric_test SET pt_status = 'Save Only' WHERE pt_id = '$pt_id'");
   if ($unpublishcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------unpublish course quiz----------*/
/* ------------delete course quiz----------*/
if (isset($_GET['delete_crt'])) {
   $delete = $_GET['delete_crt'];
   $assessmenttype = "Quiz";
   $delcq = $conn->query("DELETE FROM psychometric_test WHERE pt_id = '$delete'");
   if ($delcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------delete course quiz----------*/
//       ------------Add Psychometric Test question----------

if (isset($_POST['add_psychometric_test_question'])) {
   $epq_id = $_GET['pt_id'];
   $quiz_question = $_POST['pt_question'];
   $pt_question_type = $_POST['pt_question_type'];
   $pts_id = $_POST['pts_id'];
   // $answer1 =  $_POST['question_answer1'];
   // $answer2 =  $_POST['question_answer2'];
   // $answer3 =  $_POST['question_answer3'];
   // $answer4 =  $_POST['question_answer4'];

   // $answera = implode(",", $answer1);
   // $answerb = implode(",", $answer2);
   // $answerc = implode(",", $answer3);
   // $answerd = implode(",", $answer4);
   if ($pt_question_type == "Multiple Choice") {
      $answer1 = $_POST['question_answer1'];
      $answer2 = $_POST['question_answer2'];
      $answer3 = $_POST['question_answer3'];
      $answer4 = $_POST['question_answer4'];
      $answer8 = "";
   } elseif ($pt_question_type == "True/False") {
      $answer1 = $_POST['question_answer5'];
      $answer2 = $_POST['question_answer6'];
      $answer3 = "";
      $answer4 = "";
      $answer8 = "";
   } elseif ($pt_question_type == "Text") {
      $answer1 = "";
      $answer2 = "";
      $answer3 = "";
      $answer4 = "";
      $answer8 = "";
   } elseif ($pt_question_type == "Disagree/Agree") {
      $answer1 = $_POST['question_answer9'];
      $answer2 = $_POST['question_answer10'];
      $answer3 = $_POST['question_answer11'];
      $answer4 = $_POST['question_answer12'];
      $answer8 = $_POST['question_answer13'];
   }
   $cqq_created_date = date('Y-m-d H:i:s');
   $question_image = $_FILES['image']['name'];
   // for ($i = 0; $i < count($quiz_questions); $i++) {
   foreach ($quiz_question as $index => $quiz_questions) {

      if ($_FILES['image']['name'] != NULL) {

         $question_image =  $_FILES['image']['name'];
      } else {
         $question_image = "";
      }
      $folder1 = "../assets/images/question/";

      move_uploaded_file($_FILES['image']['tmp_name'][$index], $folder1 . $question_image[$index]);
      $add_question = $conn->query("INSERT INTO psychometric_test_question (ptq_pt_id, ptq_type, ptq_pts_id, ptq_question,ptq_option1,ptq_option2,ptq_option3,ptq_option4,ptq_option5,question_img, ptq_created_date)
       VALUES ('$epq_id', '$pt_question_type', '$pts_id','$quiz_questions','$answer1[$index]','$answer2[$index]','$answer3[$index]','$answer4[$index]','$answer8[$index]','$question_image[$index]' , '$cqq_created_date')");

      if ($add_question) {
         echo ("<script>
           location.href='$_SERVER[HTTP_REFERER]';</script>");
      } else {

         echo "<script>alert('insert question is not successful.');

           location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   }
}

/* ------------Add Psychometric Test question----------*/

/* ------------Edit Psychometric Test question----------*/

if (isset($_POST['edit_psychometric_quiz_question'])) {

   $pt_id = $_GET['pt_id'];

   $ptq_id = $_POST['ptq_id'];

   $cq_question_type = $_POST['ptq_type'];

   $new_quiz_question = $_POST['new_pt_question'];

   if ($cq_question_type == "Multiple Choice") {

      $new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);

      $new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);

      $new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);

      $new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);

      $new_answer5 = "";
   } elseif ($cq_question_type == "True/False") {

      $new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);

      $new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);

      $new_answer3 = "";

      $new_answer4 = "";

      $new_answer5 = "";
   } elseif ($cq_question_type == "Text") {

      $new_answer1 = "";

      $new_answer2 = "";

      $new_answer3 = "";

      $new_answer4 = "";

      $new_answer5 = "";
   } elseif ($cq_question_type == "Disagree/Agree") {

      $new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer9']);

      $new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer10']);

      $new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer11']);

      $new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer12']);

      $new_answer5 = mysqli_real_escape_string($conn, $_POST['new_question_answer13']);
   }

   $dir = "../assets/images/question/";

   if ($_FILES["coursecoverimg"]["name"] != NULL) {

      $newqueimg = str_replace("'", "", date('YmdHis') . $_FILES["coursecoverimg"]["name"]);
   } else {

      $newqueimg = "";
   }

   $file = $dir . $newqueimg;

   if ($newqueimg != NULL) {

      $checkimgfile = $conn->query("SELECT question_img FROM psychometric_test_question WHERE ptq_id  = '$ptq_id'");

      $checkimgRow = mysqli_fetch_object($checkimgfile);

      if ($checkimgRow->question_img != NULL) {

         unlink($dir . $checkimgRow->question_img);

         move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $file);

         $updateimg = $conn->query("UPDATE `psychometric_test_question`

           SET `ptq_question` = '$new_quiz_question', `question_img` = '$newqueimg', `ptq_option1` = '$new_answer1', `ptq_option2` = '$new_answer2', `ptq_option3` = '$new_answer3', `ptq_option4` = '$new_answer4', `ptq_option5` = '$new_answer5'

           WHERE `psychometric_test_question`.`ptq_id` = '$ptq_id';");

         // $updateimg = $conn->query("UPDATE psychometric_test_question SET question_img='$newfileimg', ptq_question='$new_quiz_question', ptq_option1 = '$new_answer1', ptq_option2 = '$new_answer2', ptq_option3 = '$new_answer3',

         // ptq_option4 = '$new_answer4',ptq_option5 = '$new_answer5' WHERE ptq_id = '$ptq_id'");

         //    

         if ($updateimg) {

            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
         } else {

            echo "<script>alert('edit answer is not successful.');

   location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      }
   } else {

      $updatedata = $conn->query("UPDATE `psychometric_test_question`

           SET `ptq_question` = '$new_quiz_question', `question_img` = '$newqueimg', `ptq_option1` = '$new_answer1', `ptq_option2` = '$new_answer2', `ptq_option3` = '$new_answer3', `ptq_option4` = '$new_answer4', `ptq_option5` = '$new_answer5'

           WHERE `psychometric_test_question`.`ptq_id` = '$ptq_id';");

      if ($updatedata) {

         echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      } else {

         echo "<script>alert('edit answer is not successful.');

   location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   }
}

/* ------------Edit Psychometric Test question----------*/

/* ------------delete course quiz question----------*/

if (isset($_GET['delete_psychometric_test_question'])) {

   $delete_question = $_GET['delete_psychometric_test_question'];

   // $delete_answer = $_GET['cquestion_answer'];

   $deleteQuestion = $conn->query("DELETE FROM psychometric_test_question WHERE ptq_id = '$delete_question'");

   if ($deleteQuestion) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {

      echo "<script>alert('Delete answer is yes successful.');

           location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}


/*-------------------------------------------------------------------------------------------------*/
if (isset($_POST['add_psychometric_section'])) {

   $industry_id  = $_SESSION['sess_industry_id'];
 
   $pts_title = mysqli_real_escape_string($conn, $_POST['section_name']);
   $pt_id = $_POST['pt_id'];
 
 
   // $pt_id = $_POST['pt_id'];
 
   $pt_date_created = date('Y-m-d H:i:s');
 
   // $pt_status = $_POST['pt_status'];
 
   $insertsection = $conn->query("INSERT INTO psychometric_test_section(pts_name,pts_pt_id,pts_created_date)
 
       values('$pts_title','$pt_id','$pt_date_created')");
 

   if ($insertsection) {

      echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";

      $_SESSION['assessment_type'] = $assessmenttype;
   } else {

      echo "<script>alert('Create course quiz is not successful');

       location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}

/* ------------add course quiz----------*/

/* ------------edit course quiz----------*/

if (isset($_POST['edit_pts'])) {

   $pts_id = $_POST['pts_id'];

   $pts_name = $_POST['pts_name'];



   $updatecoursequiz = $conn->query("UPDATE psychometric_test_section SET pts_name = '$pts_name'

                                       WHERE pts_id = '$pts_id';");

   if ($updatecoursequiz) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {

      echo "<script>alert('edit course quiz is not successful');

       location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}
if (isset($_GET['delete_pts'])) {

   $delete = $_GET['delete_pts'];

   $delcq = $conn->query("DELETE FROM psychometric_test_section WHERE pts_id = '$delete'");

   if ($delcq) {

      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

      $_SESSION['assessment_type'] = $assessmenttype;
   } else {

      echo "<script>alert('Delete quiz is not successful.');

       location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------edit course quiz----------*/



/*-------------------------------------------------------------------------------------------------*/


// ******************************************************** SKILL ASSESSMENT TEST*************************************************************************//


//********************ADD COURSE-------->>>>>>>>skill assessement test*******************************/
if (isset($_POST['add_skill_Test'])) {
	$industry_id = $_SESSION['sess_industryid'];
	$st_title = $_POST['st_title'];
	$st_industry_field = $_POST['st_industry_field'];
	$st_instruction = mysqli_real_escape_string($conn, $_POST['st_instruction']);
	$st_duration = mysqli_real_escape_string($conn, $_POST['st_duration']);
	$st_date_created = date('Y-m-d H:i:s');
	$st_status = $_POST['st_status'];
	$assessmenttype = "Skill-Assessment-Test";
	$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->industry_user_id;
	$insertcoursequiz = $conn->query("INSERT INTO skill_assessment_test(st_title,st_industry_field,st_instruction,st_duration,st_created_by,st_status) 
		values('$st_title','$st_industry_field','$st_instruction','$st_duration','$get_userID','$st_status')");
	if ($insertcoursequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Create course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}



/* ------------publish course quiz----------*/
if (isset($_GET['publish_crt'])) {
	$st_id = $_GET['publish_crt'];
	$assessmenttype = "Skill-Assessment-Test";
	$cq_updated_date = date('Y-m-d H:i:s');
	$publishcq = $conn->query("UPDATE skill_assessment_test SET st_status = 'Published' WHERE st_id = '$st_id' ");
	if ($publishcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}


/* ------------unpublish course quiz----------*/
if (isset($_GET['unpublish_crt'])) {
	$st_id = $_GET['unpublish_crt'];
	$assessmenttype = "Skill-Assessment-Test";
	$unpublishcq = $conn->query("UPDATE skill_assessment_test SET st_status = 'Save Only' WHERE st_id = '$st_id'");
	if ($unpublishcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------delete course quiz----------*/
if (isset($_GET['delete_crt'])) {
	$delete = $_GET['delete_crt'];
	$assessmenttype = "Quiz";
	$delcq = $conn->query("DELETE FROM skill_assessment_test WHERE st_id = '$delete'");
	if ($delcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}


/* ------------edit course quiz----------*/
if (isset($_POST['edit_skill_test'])) {
	$st_id = $_POST['st_id'];
	$new_st_title = $_POST['new_st_title'];
	$new_st_industry_field = $_POST['new_st_industry_field'];

	$new_st_instruction = mysqli_real_escape_string($conn, $_POST['new_st_instruction']);
	$new_st_duration = $_POST['new_st_duration'];
	$cq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "skill-assessment-Test";
	// $updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET epq_title = '$new_pt_title', epq_instruction = '$new_pt_instruction',
	//  epq_duration = '$new_pt_duration' WHERE epq_id = '$cq_id' AND epq_ep_id  = '$course_id'");
	$updatecoursequiz = $conn->query("UPDATE skill_assessment_test SET st_title = '$new_st_title',st_industry_field = '$new_st_industry_field', st_instruction = '$new_st_instruction', st_duration = '$new_st_duration' 
	 									WHERE st_id = '$st_id';");
	if ($updatecoursequiz) {
		$_SESSION['assessment_type'] = $assessmenttype;
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('edit course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}


// ******************************ADD SKILL QUESTIONS(MULTIPLE CHOICE)********************************************************//

if (isset($_POST['add_skill_question'])) {
	$industry_id = $_SESSION['sess_industryid'];
	$stq_id = $_GET['st_id'];
	$quiz_question = $_POST['stq_question'];
	$cq_question_type = $_POST['stq_type'];
	if ($cq_question_type == "multiple choice") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['stqa_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['stqa_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['stqa_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['stqa_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	} 

	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['stqa_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['stqa_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['stqa_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['stqa_answer4']);
	} 
	$cqq_created_date = date('Y-m-d H:i:s');
	$add_question = $conn->query("INSERT INTO skill_assessment_test_question (stq_st_id , stq_type, stq_question, stq_created_date) 
		VALUES ('$stq_id', '$cq_question_type', '$quiz_question', '$cqq_created_date')");
	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT stq_id   FROM skill_assessment_test_question WHERE stq_st_id  = '$stq_id' AND stq_question = '$quiz_question' AND stq_created_date = '$cqq_created_date'");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_cqqid = $rowReadQuestion->stq_id;
		$add_answer = $conn->query("INSERT INTO skill_assessment_test_answer(stqa_stq_id,stqa_answer1,stqa_answer2,stqa_answer3,stqa_answer4,stqa_right_answer, stqa_right_answer_word) 
			VALUES ('$get_cqqid', '$answer1', '$answer2', '$answer3', '$answer4', '$radiobutton', '$word')");
		if ($add_answer) {
			echo ("<script>
			location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('insert question type is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}





//*********************end multiple choice**********************************/

// *****************add file upload******************************//

if (isset($_POST['add_skill_question_file'])) {
	$admin_id = $_SESSION['sess_industryid'];
	$stq_type = $_POST['stq_type'];

	$stid = $_POST['st_id'];

	// $stqid = $_POST['stq_id'];

	if ($_FILES['stq_fileupload']['name'] != NULL) {
		$stq_fileupload = str_replace("'", "", date('YmdHis') . $_FILES['stq_fileupload']['name']);
	} else {
		$stq_fileupload = "";
	}
	$folder1 = "../assets/attachment/skillfileupload/";
	move_uploaded_file($_FILES['stq_fileupload']['tmp_name'], $folder1 . $stq_fileupload);
	$st_date_created = date('Y-m-d H:i:s');

	$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->industry_user_id;
	$insertquestionfilequiz = $conn->query("INSERT INTO skill_assessment_test_question(stq_st_id,stq_type,stq_fileupload) 
		values('$stid','$stq_type','$stq_fileupload') ");
	if ($insertquestionfilequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {

		echo "<script>alert('Create course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

// *************************end FILE UPLOAD**********************************************************//

// *************************EDIT SKILL QUESTIONS(MULTIPLE CHOICE)**********************************************************//
if (isset($_POST['edit_skill_question'])) {
	$cq_id = $_POST['st_id'];
	$cqq_id = $_POST['stq_id'];
	$cqa_id = $_POST['stqa_id'];
	$cq_question_type = $_POST['stq_type'];
	$new_quiz_question = $_POST['new_stq_question'];
	if ($cq_question_type == "multiple choice") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_stq_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_stq_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_stq_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_stq_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	} 
	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['new_stq_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['new_stq_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['new_stq_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['new_stq_answer4']);
	} 
	$edit_question = $conn->query("UPDATE skill_assessment_test_question SET stq_question = '$new_quiz_question'
		WHERE stq_id  = '$cqq_id' AND stq_st_id  = '$cq_id'");
	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE skill_assessment_test_answer SET stqa_answer1 = '$new_answer1', stqa_answer2 = '$new_answer2', stqa_answer3 = '$new_answer3', 
			stqa_answer4 = '$new_answer4', stqa_right_answer = '$radiobutton', stqa_right_answer_word = '$word' 
			WHERE stqa_id  = '$cqa_id' AND stqa_stq_id = '$cqq_id'");
		if ($edit_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('edit answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('edit question is not successful');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}



// **************************************************************END EDIT SKILL QUESTIONS(MULTIPLE CHOICE)*******************************************************************//

// **************************************************************EDIT SKILL QUESTIONS(FILE UPLOAD)***************************************************************************//

if (isset($_POST['edit_file_upload'])) {
	$stq_id = $_POST['stq_id'];
	// $stq_question = "sana";
	$dir = "../assets/attachment/skillfileupload/";
	if ($_FILES["new_stq_fileupload"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["new_stq_fileupload"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;
	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT stq_fileupload FROM skill_assessment_test_question WHERE stq_id = '$stq_id' ");
		$checkattachRow = mysqli_fetch_object($checkattachfile);
		if ($checkattachRow->stq_fileupload != NULL) {
			unlink($dir . $checkattachRow->stq_fileupload);
			move_uploaded_file($_FILES['new_stq_fileupload']['tmp_name'], $file);
			$editmcn = $conn->query("UPDATE skill_assessment_test_question SET   stq_fileupload = '$newattach' WHERE stq_id = '$stq_id' ");
			if ($editmcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['new_stq_fileupload']['tmp_name'], $file);
			$editmcn = $conn->query("UPDATE skill_assessment_test_question SET  stq_fileupload = '$newattach' WHERE stq_id = '$stq_id'");
			if ($editmcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmcn = $conn->query("UPDATE skill_assessment_test_question SET   stq_fileupload = '$newattach' WHERE stq_id = '$stq_id'");
		if ($editmcn) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}

// **************************************************************end of edit fileupload(SKILL ASSESSMENT)**********************************************//

// ***********************************************************delete multiple choice(SKILL ASSESSMENT)***********************************//


if (isset($_GET['delete_skill_assessment_test_quiz'])) {
	$delete_question = $_GET['delete_skill_assessment_test_quiz'];
	$delete_answer = $_GET['delete_skill_assessment_test_question_answer'];
	$deleteAnswer = $conn->query("DELETE FROM skill_assessment_test_answer WHERE stqa_id = '$delete_answer'");
	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM skill_assessment_test_question WHERE stqq_id = '$delete_question'");
		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete is successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}


// *************************************************end of delete multiple choice(SKILL ASSESSMENT)******************************************************


//***********************************************delete for file upload***********************************************/


if (isset($_GET['delete_language_test_quiz_file'])) {
	$delete = $_GET['delete_language_test_quiz_file'];
	$assessmenttype = "Quiz question";
	$delques = $conn->query("DELETE FROM skill_assessment_test_question WHERE stq_id = '$delete'");
	if ($delques) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}




// ********************************************UPDATE SCORE*******************************************
if (isset($_POST['submitscore'])) {


	$susatrv_st_test_id = $_POST['susatrv_st_test_id'];
	$susatqrs_total_question = $_POST['susatqrs_total_question'];
	$susatrv_st_test_question_id = $_POST['susatrv_st_test_question_id'];
	$susatrv_answer_status = $_POST['score'];
	$susatqrs_sat_quiz_id = $_POST['susatqrs_sat_quiz_id'];
	$stq_st_id = $_POST['stq_st_id'];
	$st_id = $_GET['st_id'];


	$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->industry_user_id;
	$sql = "SELECT *
	FROM studuni_st_test_review AS sstr
	WHERE sstr.susatrv_st_test_id=$susatrv_st_test_id AND sstr.susatrv_answer_status='Correct'";
$updatescore1 = $conn->query("UPDATE studuni_st_test_review SET susatrv_answer_status = '$susatrv_answer_status'
WHERE susatrv_st_test_question_id = '$susatrv_st_test_question_id';");

//Total Answered 
$sql1 = "SELECT *
FROM studuni_st_test_review AS sstr
WHERE sstr.susatrv_st_test_id=$susatrv_st_test_id ";
if ($result1 = mysqli_query($conn, $sql1)
) {

	// Return the number of rows in result set
	$susatqrs_total_answered_question = mysqli_num_rows($result1);
}

//Total Correct Answers
$sql = "SELECT *
FROM studuni_st_test_review AS sstr
WHERE sstr.susatrv_st_test_id=$susatrv_st_test_id AND sstr.susatrv_answer_status='Correct'";

if ($result = mysqli_query($conn, $sql)
) {

	// Return the number of rows in result set
	$susatqrs_total_correct_answer = mysqli_num_rows($result);
}
$updatescore1 = $conn->query("UPDATE studuni_st_test_review SET susatrv_answer_status = '$susatrv_answer_status'
	WHERE susatrv_st_test_question_id = '$susatrv_st_test_question_id';");


$updatescore = $conn->query("UPDATE studuni_sat_quiz_result SET susatqrs_total_correct_answer='$susatqrs_total_correct_answer',susatqrs_total_answered_question='$susatqrs_total_answered_question'
WHERE susatqrs_sat_quiz_id = '$susatqrs_sat_quiz_id';");

$susatqrs_grade = $susatqrs_total_correct_answer / $susatqrs_total_question * 100;

if ($updatescore != NULL) {
	$updatescore = $conn->query("UPDATE studuni_sat_quiz_result SET susatqrs_grade = '$susatqrs_grade'
WHERE susatqrs_sat_quiz_id = '$susatqrs_sat_quiz_id';");
}
}


// **************************************************PROJECT ADVERTISEMENT********************************************************************//

/* ------------add job----------*/
if (isset($_POST['add_job_advertisement'])) {

   $industry_id = $_SESSION['sess_industryid'];
   $pa_advrt_title = $_POST['pa_advrt_title'];
   $pa_start_date = $_POST['pa_start_date'];
   $formatted_start_date = date("F Y", strtotime($pa_start_date));
   $pa_duration = $_POST['pa_duration'];
   $pa_advrt_des = mysqli_real_escape_string($conn, $_POST['pa_advrt_des']);
   $pa_advrt_type = $_POST['pa_advrt_type'];
   // $pa_advrt_careerlevel = $_POST['pa_advrt_careerlevel'];
   $pa_category = $_POST['pa_category'];
   $pa_salary = $_POST['pa_salary'];
   $pa_salary_min = $_POST['pa_salary_min'];
   $pa_salary_max = $_POST['pa_salary_max'];
   $pa_vacancy = $_POST['pa_vacancy'];

   $pa_requirement = implode(',', $_POST['pa_requirement']);



   // $pa_attachment = $_POST['pa_attachment'];
   $checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id= '$industry_id'");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_user_id;
   // $pa_created_by = $_SESSION['pa_created_by'];

   $pa_created_on = date('Y-m-d H:i:s');
   if ($_FILES['pa_attachment']['name'] != NULL) {
      $pa_attachment = str_replace("'", "", date('YmdHis') . $_FILES['pa_attachment']['name']);
   } else {
      $pa_attachment = "";
   }

   $folder1 = "../assets/advertisement_Attachment/";
   move_uploaded_file($_FILES['pa_attachment']['tmp_name'], $folder1 . $pa_attachment);

   $addJob = $conn->query("INSERT INTO project_advertisement (pa_advrt_title, pa_start_date,pa_duration,pa_advrt_des,pa_advrt_type,pa_category,
										  pa_salary,pa_salary_min,pa_salary_max,pa_vacancy,pa_attachment,pa_created_on,pa_requirement ,pa_created_by)
								VALUES ('$pa_advrt_title', '$formatted_start_date', '$pa_duration', '$pa_advrt_des', '$pa_advrt_type', '$pa_category', '$pa_salary', '$pa_salary_min', '$pa_salary_max', '$pa_vacancy', '$pa_attachment', '$pa_created_on', '$pa_requirement','$get_userID')");

   if ($addJob) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('New Project not successfully stored.');
		 location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------add job----------*/

/* ------------edit job----------*/
if (isset($_POST['edit_job_advertisement'])) {

   @$industry_id = @$_SESSION['sess_industryid'];
   @$pa_id = @$_POST['pa_id'];
   @$new_pa_advrt_title = @$_POST['pa_advrt_title'];
   @$new_pa_start_date = @$_POST['pa_start_date'];
   @$formatted_start_date = date("F Y", strtotime($new_pa_start_date));
   @$new_pa_duration = @$_POST['pa_duration'];
   @$new_pa_advrt_des = mysqli_real_escape_string($conn, $_POST['pa_advrt_des']);
   @$new_pa_advrt_type = @$_POST['pa_advrt_type'];
   // $new_pa_advrt_careerlevel = $_POST['pa_advrt_careerlevel'];
   @$new_pa_category = @$_POST['pa_category'];
   @$new_pa_salary = @$_POST['pa_salary'];
   @$new_pa_salary_min = @$_POST['pa_salary_min'];
   @$new_pa_salary_max = @$_POST['pa_salary_max'];
   @$new_pa_vacancy = @$_POST['pa_vacancy'];
   @$new_pa_requirement = implode(',', $_POST['pa_requirement']);


   if ($_FILES['pa_attachment']['name'] != NULL) {
      @$new_pa_attachment = str_replace("'", "", date('YmdHis') . $_FILES['pa_attachment']['name']);
   } else {
      @$new_pa_attachment = "";
   }

   @$folder1 = "../assets/advertisement_Attachment/";
   move_uploaded_file($_FILES['pa_attachment']['tmp_name'], $folder1 . $new_pa_attachment);

   @$pa_updated_on = date('Y-m-d H:i:s');

   @$editJob = $conn->query("UPDATE project_advertisement SET pa_advrt_title = '$new_pa_advrt_title', pa_start_date = '$formatted_start_date', pa_duration = '$new_pa_duration', pa_advrt_des = '$new_pa_advrt_des', pa_advrt_type = '$new_pa_advrt_type', pa_category = '$new_pa_category', pa_salary = '$new_pa_salary', pa_salary_min = '$new_pa_salary_min', pa_salary_max = '$new_pa_salary_max', pa_vacancy = '$new_pa_vacancy', pa_requirement = '$new_pa_requirement', pa_attachment = '$new_pa_attachment',pa_updated_on = '$pa_updated_on'
	 WHERE pa_id = '$pa_id'");


   if ($editJob) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('Edit Project not successfully Stored.');
		 location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------edit job----------*/

/* ------------delete job----------*/
if (isset($_GET['delete_job_advertisement'])) {
   $delete = $_GET['delete_job_advertisement'];

   $queryCheckJobApps = $conn->query("SELECT * FROM project_advertisement WHERE pa_id = '$delete';");

   if (mysqli_num_rows($queryCheckJobApps) > 0) {

      $deljob = $conn->query("DELETE FROM project_advertisement where pa_id = '$delete'");

      if ($deljob) {

         echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      } else {
         echo "<script>alert('Delete vacancy is not successful.');
		 location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   }
}
/* ------------delete job----------*/


/*-------------------MANAGE LANGUAGE TEST FUNCTIONS************************************************--------------------*/
/* ------------add quiz----------*/
if (isset($_POST['add_lt_quiz'])) {
   // $institution_id = $_SESSION['sess_institutionid'];
   $industry_id = $_SESSION['sess_industryid'];
   $ltq_id = $_POST['ltq_id'];
   $ltq_title = $_POST['ltq_title'];
   $ltq_instruction = mysqli_real_escape_string($conn, $_POST['ltq_instruction']);
   $ltq_duration = mysqli_real_escape_string($conn, $_POST['ltq_duration']);

   $ltq_date_created = date('Y-m-d H:i:s');
   $ltq_status = $_POST['ltq_status'];
   $assessmenttype = "Quiz";

   $checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id= '$industry_id'");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_user_id;

   $insertcoursequiz = $conn->query("INSERT INTO language_test_quiz(ltq_id,ltq_title,ltq_instruction,ltq_duration,ltq_created_by,ltq_status)
     values('$ltq_id','$ltq_title','$ltq_instruction','$ltq_duration','$get_userID','$ltq_status')");

   if ($insertcoursequiz) {
      echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Create course quiz is not successful');
       location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}

if (isset($_POST['edit_ltq'])) {

   $ltq_id = $_POST['ltq_id'];
   $new_ltq_title = $_POST['new_ltq_title'];
   $new_ltq_instruction = mysqli_real_escape_string($conn, $_POST['new_ltq_instruction']);
   $new_ltq_duration = $_POST['new_ltq_duration'];
   $ltq_updated_date = date('Y-m-d H:i:s');
   $assessmenttype = "Quiz";

   // $updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET ltqq_title = '$new_cq_title', ltqq_instruction = '$new_cq_instruction',
   //  ltqq_duration = '$new_cq_duration' WHERE ltqq_id = '$cq_id' AND ltqq_ltq_id  = '$course_id'");
   $updatecoursequiz = $conn->query("UPDATE language_test_quiz SET ltq_title = '$new_ltq_title', ltq_instruction = '$new_ltq_instruction', ltq_duration = '$new_ltq_duration' , ltq_updated_date='$ltq_updated_date'
                              WHERE ltq_id = '$ltq_id';");

   if ($updatecoursequiz) {
      $_SESSION['assessment_type'] = $assessmenttype;
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
   } else {
      echo "<script>alert('edit course quiz is not successful');
       location.href='$_SERVER[HTTP_REFERER]';</script>";
   }
}

/* ------------delete course quiz----------*/
if (isset($_GET['delete_ltq'])) {
   @$delete = @$_GET['delete_ltq'];
   @$ltq_id = @$_POST['ltq_id'];
   @$assessmenttype = "Quiz";

   @$delcq = $conn->query("DELETE FROM  language_test_quiz WHERE ltq_id = '$delete'");

   if ($delcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Delete quiz is not successful.');
     location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}

if (isset($_GET['publish_ltq'])) {
   $ltq_id = $_GET['publish_ltq'];
   $assessmenttype = "Quiz";
   $ltq_updated_date = date('Y-m-d H:i:s');

   $publishcq = $conn->query("UPDATE language_test_quiz SET ltq_status = 'Published' WHERE ltq_id = '$ltq_id' ");

   if ($publishcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Publish is not successful.');
     location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------publish course quiz----------*/

/* ------------unpublish course quiz----------*/
if (isset($_GET['unpublish_ltq'])) {
   $ltq_id = $_GET['unpublish_ltq'];
   $assessmenttype = "Quiz";

   $unpublishcq = $conn->query("UPDATE language_test_quiz SET ltq_status = 'Save Only' WHERE ltq_id = '$ltq_id'");

   if ($unpublishcq) {
      echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
      $_SESSION['assessment_type'] = $assessmenttype;
   } else {
      echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------unpublish course quiz----------*/

/* ------------add course quiz question----------*/

if (isset($_POST['add_language_test_quiz_question'])) {

   @$ltqq_id = @$_POST['ltqq_id'];
   @$ltqq_question = @$_POST['ltqq_question'];
   @$ltqq_fitb1 = @$_POST['ltqq_fitb1'];
   @$ltqq_fitb2 = @$_POST['ltqq_fitb2'];
   @$ltqq_sa1 = @$_POST['ltqq_sa1'];
   @$ltqq_sa2 = @$_POST['ltqq_sa2'];
   @$ltqq_type = @$_POST['ltqq_type'];
   @$radiobutton = @$_POST['answermulchoice'];

   if ($ltqq_type == "Multiple Choice Question") {
      $answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
      $answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
      $answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
      $answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
      $radiobutton = $_POST['answermulchoice'];
   } elseif ($ltqq_type == "Fill In The Blank") {
      $answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
      $answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);

      $radiobutton = $_POST['tf_answer'];
   } elseif ($ltqq_type == "Short Answers") {
      $answer1 = mysqli_real_escape_string($conn, $_POST['question_answer7']);
      @$radiobutton = $_POST['short_answer'];
   } elseif ($ltqq_type == "Comprehension Passages") {
      $answer1 = mysqli_real_escape_string($conn, $_POST['ltqa_answer1']);
      $answer2 = mysqli_real_escape_string($conn, $_POST['ltqa_answer2']);
      $answer3 = mysqli_real_escape_string($conn, $_POST['ltqa_answer3']);
      $answer4 = mysqli_real_escape_string($conn, $_POST['ltqa_answer4']);
      $mcqa_b1 = mysqli_real_escape_string($conn, $_POST['mcqa_b1']);
      $mcqa_b2 = mysqli_real_escape_string($conn, $_POST['mcqa_b2']);
      $mcqa_b3 = mysqli_real_escape_string($conn, $_POST['mcqa_b3']);
      $mcqa_b4 = mysqli_real_escape_string($conn, $_POST['mcqa_b4']);
      $fitba_a1 = mysqli_real_escape_string($conn, $_POST['fitba_a1']);
      $fitba_a2 = mysqli_real_escape_string($conn, $_POST['fitba_a2']);
      $fitba_b1 = mysqli_real_escape_string($conn, $_POST['fitba_b1']);
      $fitba_b2 = mysqli_real_escape_string($conn, $_POST['fitba_b2']);
      $sa_a1 = mysqli_real_escape_string($conn, $_POST['sa_a1']);
      $sa_b1 = mysqli_real_escape_string($conn, $_POST['sa_b1']);
   }

   if ($radiobutton == 1) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer1']);
   } elseif ($radiobutton == 2) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer2']);
   } elseif ($radiobutton == 3) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer3']);
   } elseif ($radiobutton == 4) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer4']);
   } elseif ($radiobutton == 5) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer5']);
   } elseif ($radiobutton == 6) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer6']);
   } elseif ($radiobutton == null) {
      $word = mysqli_real_escape_string($conn, $_POST['question_answer7']);
   }
   $ltqq_created_date = date('Y-m-d H:i:s');

   $checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id= '$industry_id'");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_user_id;

   @$add_question = @$conn->query("INSERT INTO language_test_question (ltq_question,ltq_question_type,ltqq_id,ltq_created_date )
		VALUES ('$ltqq_question', '$ltqq_type','$ltqq_id','$ltqq_created_date')");

   if ($add_question) {
      $queryReadQuestion = $conn->query("SELECT ltq_id  FROM language_test_question WHERE ltq_question = '$ltqq_question' AND ltq_created_date = '$ltqq_created_date'");
      $rowReadQuestion = $queryReadQuestion->fetch_object();
      $get_ltqqid = $rowReadQuestion->ltq_id;

      @$add_answer = @$conn->query("INSERT INTO language_test_answer(lta_id_ltq_id,lta_answer1,lta_answer2,lta_answer3,lta_answer4,lta_right_answerword)
			VALUES ('$get_ltqqid', '$answer1', '$answer2', '$answer3', '$answer4','$word')");

      if ($add_answer) {
         echo ("<script>
			location.href='$_SERVER[HTTP_REFERER]';</script>");
      } else {
         echo "<script>alert('insert question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   } else {
      echo "<script>alert('insert question type is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------add course quiz question----------*/


/* ------------add course quiz PASSAGE question----------*/

if (isset($_POST['add_language_test_passage_question']) && !empty($_POST['ltqq_passage'])) {
   // $lid = $_POST['cid'];
   $ltqq_id = $_POST['ltqq_id'];
   @$ltqq_question = @$_POST['ltqq_question'];
   $ltqq_passage = $_POST['ltqq_passage'];
   @$ltqq_type = @$_POST['ltqq_type'];

   $ltqq_created_date = date('Y-m-d H:i:s');

   $checkuserrow = $conn->query("SELECT industry_user_id FROM industry WHERE industry_id= '$industry_id'");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_user_id;

   @$add_passage = @$conn->query("INSERT INTO `language_test_comp_pasage` (`test_id`, `ltcp_passage`, `ltcp_created_by`, `ltcp_created_date`)
   VALUES ('$ltqq_id','$ltqq_passage','$get_userID','$ltqq_created_date')");

   $queryReadQuestion = $conn->query("SELECT ltcp_id  FROM  language_test_comp_pasage WHERE 	ltcp_passage = '$ltqq_passage' AND ltcp_created_date = '$ltqq_created_date'");
   $rowReadQuestion = $queryReadQuestion->fetch_object();
   $get_ltcp_id = $rowReadQuestion->ltcp_id;

   foreach (@$ltqq_question as $index => $ltqq_questions) {

      if (@$ltqq_type[$index] == "Multiple Choice Question") {

         $answer1 = $_POST['question_answer1'];
         $answer2 = $_POST['question_answer2'];
         $answer3 = $_POST['question_answer3'];
         $answer4 = $_POST['question_answer4'];
         $radiobutton = $_POST['answermulchoice'][$index];

         if ($radiobutton == 1) {
            $word = $_POST['question_answer1'];
         } elseif ($radiobutton == 2) {
            $word = $_POST['question_answer2'];
         } elseif ($radiobutton == 3) {
            $word = $_POST['question_answer3'];
         } elseif ($radiobutton == 4) {
            $word = $_POST['question_answer4'];
         }

         @$add_question = @$conn->query("INSERT INTO language_test_question (	ltq_id_ltc_id,ltq_question,ltq_question_type,ltqq_id,ltq_created_date )
VALUES ('$get_ltcp_id','$ltqq_questions', '$ltqq_type[$index]','$ltqq_id','$ltqq_created_date')");

         if ($add_question) {
            $queryReadQuestion = $conn->query("SELECT ltq_id  FROM language_test_question WHERE ltq_question = '$ltqq_questions' AND ltq_created_date = '$ltqq_created_date'");
            $rowReadQuestion = $queryReadQuestion->fetch_object();
            $get_ltqqid = $rowReadQuestion->ltq_id;

            @$add_answer = @$conn->query("INSERT INTO language_test_answer(lta_id_ltq_id,lta_answer1,lta_answer2,lta_answer3,lta_answer4,lta_right_answerword)
			VALUES ('$get_ltqqid', '$answer1[$index]', '$answer2[$index]', '$answer3[$index]', '$answer4[$index]','$word[$index]')");

            if ($add_answer) {
               echo ("<script>
			location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
               echo "<script>alert('insert question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
         } else {
            echo "<script>alert('insert question type is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      } elseif (@$ltqq_type[$index] == "Fill In The Blank") {

         $answer1 = $_POST['question_answer1'];
         $answer2 = $_POST['question_answer2'];
         $radiobutton = $_POST['answermulchoice'][$index];

         if ($radiobutton == 1) {
            $word = $_POST['question_answer1'];
         } elseif ($radiobutton == 2) {
            $word = $_POST['question_answer2'];
         }

         @$add_question = @$conn->query("INSERT INTO language_test_question (	ltq_id_ltc_id,ltq_question,ltq_question_type,ltqq_id,ltq_created_date )
VALUES ('$get_ltcp_id','$ltqq_questions', '$ltqq_type[$index]','$ltqq_id','$ltqq_created_date')");

         if ($add_question) {
            $queryReadQuestion = $conn->query("SELECT ltq_id  FROM language_test_question WHERE ltq_question = '$ltqq_questions' AND ltq_created_date = '$ltqq_created_date'");
            $rowReadQuestion = $queryReadQuestion->fetch_object();
            $get_ltqqid = $rowReadQuestion->ltq_id;

            @$add_answer = @$conn->query("INSERT INTO language_test_answer(lta_id_ltq_id,lta_answer1,lta_answer2,lta_right_answerword)
			VALUES ('$get_ltqqid', '$answer1[$index]', '$answer2[$index]', '$word[$index]')");

            if ($add_answer) {
               echo ("<script>
			location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
               echo "<script>alert('insert question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
         } else {
            echo "<script>alert('insert question type is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      } elseif (@$ltqq_type[$index] == "Short Answers") {
         $answer1 = $_POST['question_answer1'];
         @$radiobutton = $_POST['answermulchoice'][$index];
         $word = $_POST['question_answer1'];

         @$add_question = @$conn->query("INSERT INTO language_test_question (	ltq_id_ltc_id,ltq_question,ltq_question_type,ltqq_id,ltq_created_date )
VALUES ('$get_ltcp_id','$ltqq_questions', '$ltqq_type[$index]','$ltqq_id','$ltqq_created_date')");

         if ($add_question) {
            $queryReadQuestion = $conn->query("SELECT ltq_id  FROM language_test_question WHERE ltq_question = '$ltqq_questions' AND ltq_created_date = '$ltqq_created_date'");
            $rowReadQuestion = $queryReadQuestion->fetch_object();
            $get_ltqqid = $rowReadQuestion->ltq_id;

            @$add_answer = @$conn->query("INSERT INTO language_test_answer(lta_id_ltq_id,lta_answer1,lta_right_answerword)
			VALUES ('$get_ltqqid', '$answer1[$index]', '$word[$index]')");

            if ($add_answer) {
               echo ("<script>
			location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
               echo "<script>alert('insert question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
         } else {
            echo "<script>alert('insert question type is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      }
   }
}
/* ------------add course quiz PASSAGE question----------*/



/* ------------edit _language_test quiz question----------*/
if (isset($_POST['edit_language_test_quiz_question'])) {
   $ltq_question_type = $_POST['ltq_question_type'];
   $ltqq_id = $_POST['ltqq_id'];
   $ltq_id = $_POST['ltq_id'];
   $lta_id = $_POST['lta_id'];
   $ltqq_question = $_POST['ltq_question'];


   if ($ltq_question_type == "Multiple Choice Question") {
      $new_answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
      $new_answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
      $new_answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
      $new_answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
      $radiobutton = $_POST['answermulchoice'];
   } elseif ($ltq_question_type == "Fill In The Blank") {
      $new_answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
      $new_answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);
      $new_answer3 = NULL;
      $new_answer4 = NULL;
      $radiobutton = $_POST['tf_answer'];
   } elseif ($ltq_question_type == "Short Answers") {
      $new_answer1 = mysqli_real_escape_string($conn, $_POST['question_answer7']);
      $new_answer2 = NULL;
      $new_answer3 = NULL;
      $new_answer4 = NULL;

      $word = $_POST['question_answer7'];
   }


   if (@$radiobutton == 1) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer1']);
   } elseif (@$radiobutton == 2) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer2']);
   } elseif (@$radiobutton == 3) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer3']);
   } elseif (@$radiobutton == 4) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer4']);
   } elseif (@$radiobutton == 5) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer5']);
   } elseif (@$radiobutton == 6) {
      @$word = mysqli_real_escape_string($conn, $_POST['question_answer6']);
   }


   $editquestion = $conn->query("UPDATE language_test_question SET ltq_question = '$ltqq_question' WHERE ltqq_id= '$ltqq_id' AND ltq_id = '$ltq_id';");

   if (@$editquestion) {
      @$edit_answer = $conn->query("UPDATE language_test_answer SET lta_answer1 = '$new_answer1', lta_answer2 = '$new_answer2', lta_answer3 = '$new_answer3', lta_answer4 = '$new_answer4', lta_right_answerword ='$word' WHERE lta_id = '$lta_id' AND lta_id_ltq_id  = '$ltq_id';");

      if (@$edit_answer) {
         echo "<script>
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
      } else {
         echo "<script>alert('edit answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   } else {
      echo "<script>alert('edit question is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}

/* ------------edit _language_test quiz question----------*/

/* ------------edit Comprehension Passage question----------*/
if (isset($_POST['edit_comprehension_passage'])) {
   $ltcp_id = $_POST['ltcp_id'];
   $ltqq_question = $_POST['ltq_question'];


   $editpassage = $conn->query("UPDATE language_test_comp_pasage SET ltcp_passage = '$ltqq_question' WHERE ltcp_id = '$ltcp_id';");

   if (@$editpassage) {
      echo "<script>alert('Edit Comprehension Passage is successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
   } else {
      echo "<script>alert('Edit Comprehension Passage is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}

/* ------------End Of edit Comprehension Passage question----------*/

/* ------------Delete Comprehension Passage question----------*/
if (isset($_GET['delete_language_test_question_for_passage'])) {
   $delete_question = $_GET['delete_language_test_question_for_passage'];
   $delete_answer = $_GET['delete_language_test_answer_for_passage'];
   $delete_passage = $_GET['delete_language_test_passage'];
   $delete_Answer = $conn->query("DELETE FROM language_test_answer WHERE `lta_id`= '$delete_answer'");
   if ($delete_Answer) {
      $delete_question = $conn->query("DELETE FROM language_test_question WHERE `ltq_id`= '$delete_question'");
      if ($delete_question) {
         $delete_passage = $conn->query("DELETE FROM language_test_comp_pasage WHERE `ltcp_id` = '$delete_passage'");
         if ($delete_passage) {
            echo "<script>alert('Delete Passage is successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
         } else {
            echo "<script>alert('Delete Passage is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      } else {
         echo "<script>alert('Delete Passage is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   } else {
      echo "<script>alert('Delete Passage is not successful.');
	location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------Delete Comprehension Passage question----------*/


/* ------------delete language test quiz question----------*/

if (isset($_GET['delete_language_test_question'])) {
   $delete_question = $_GET['delete_language_test_question'];
   $delete_answer = $_GET['delete_language_test_answer'];

   $delete_Answer = $conn->query("DELETE FROM language_test_answer WHERE `language_test_answer`.`lta_id`= '$delete_answer'");

   if ($delete_Answer) {
      $delete_Question = $conn->query("DELETE FROM language_test_question WHERE `language_test_question`.`ltq_id` = '$delete_question'");

      if ($delete_Question) {

         echo "<script>alert('Delete question is successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   } else {
      echo "<script>alert('Delete question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
   }
}
/* ------------delete language test quiz question----------*/

/* ------------end quiz----------*/

/*-------------------END OF MANAGE LANGUAGE TEST FUNCTIONS************************************************--------------------*/
if (isset($_POST['assign_test'])) {
   date_default_timezone_set('Asia/Kolkata'); // Set timezone to IST

   $industry_id = $_SESSION['sess_industryid'];
   $job_id = $_GET['job_id'];
   $su_id = $_GET['su_id'];

   $language_test = implode(',', $_POST['language_test']);
   $skill_assessment_test = implode(',', $_POST['skill_assessment_test']);
   $psychometric_test = implode(',', $_POST['psychometric_test']);

   $checkuserrow = $conn->query("SELECT * FROM industry WHERE industry_id= '$industry_id'");
   $rowReadUser = $checkuserrow->fetch_object();
   $get_userID = $rowReadUser->industry_id;

   $existing_record = $conn->query("SELECT * FROM assign_test WHERE at_job_id = '$job_id' AND at_su_id = '$su_id'");

      $assign_test = $conn->query("INSERT INTO assign_test (at_su_id, at_job_id, at_ltq_id, at_st_id, at_pt_id,at_assigned_by,at_created_date,at_expiry_date)
                                   VALUES ('$su_id', '$job_id', '$language_test', '$skill_assessment_test', '$psychometric_test','$get_userID',NOW(),DATE_ADD(NOW(), INTERVAL 1 DAY))");

                            $query11 = $conn->query("SELECT * FROM assign_test");


                            if (mysqli_num_rows($query11) > 0) {
                              while ($rows1 = mysqli_fetch_object($query11)) {
                                 $at_id=$rows1->at_id;
                              }}
                         


      if ($assign_test) {
         // Insert notification into notification_industry table
         $message = "You have been assigned a new test.";
         $deadline = date('Y-m-d H:i:s', strtotime("+1 days")); // Deadline is set to 1 day from now
         $insert_notification = $conn->query("INSERT INTO notification_industry (ni_at_id,ni_su_id, ni_job_id, ni_industry_user_id, ni_message, ni_deadline) VALUES ('$at_id','$su_id', '$job_id', '$get_userID', '$message', '$deadline')");
         
         if ($insert_notification) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            echo "<script>document.getElementById('assign-test-btn').setAttribute('disabled', 'disabled');</script>";
         } else {
            echo "<script>alert('Assign is not successful');
                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
         }
      } else {
         echo "<script>alert('Assign is not successful');
               location.href = '$_SERVER[HTTP_REFERER]';</script>";
      }
   }


/* ------------add job----------*/


