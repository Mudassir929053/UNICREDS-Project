<?php
include('../database/dbcon.php');
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
require_once('../assets/libs/getid3/getid3.php');


function duration($dur)
{
	$slot = explode(":", $dur);

	$count_slot = count($slot);

	$hour = " ";
	$minute = " ";
	$second = " ";

	if ($count_slot == 3) {
		if ($slot[0] != "00") {
			$hour  = (substr($slot[0], 0, -1) == "0") ? (substr($slot[0], 1) . "h ") : ($slot[0] . "h ");
		}

		if ($slot[1] != "00") {
			$minute = (substr($slot[1], 0, -1) == "0") ? (substr($slot[1], 1) . "m ") : ($slot[1] . "m ");
		}

		if ($slot[2] != "00") {
			$second = (substr($slot[2], 0, -1) == "0") ? (substr($slot[2], 1) . "s ") : ($slot[2] . "s ");
		}

		$duration = $hour . $minute . $second;
	} else if ($count_slot == 2) {
		if ($slot[0] != "00") {
			$minute = (substr($slot[0], 0, -1) == "0") ? (substr($slot[0], 1) . "m ") : ($slot[0] . "m ");

			if ($slot[1] != "00") {
				$second = (substr($slot[1], 0, -1) == "0") ? (substr($slot[1], 1) . "s ") : ($slot[1] . "s ");
			}

			$duration = $minute . $second;
		} else {
			if ($slot[1] != "00") {
				$second = (substr($slot[1], 0, -1) == "0") ? (substr($slot[1], 1) . "s ") : ($slot[1] . "s ");
			}

			$duration = $second;
		}
	}
	return $duration;
}

/*-----------------add announcement----------------------------*/
if (isset($_POST['add_announcement']))
{
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$announcement_title = mysqli_real_escape_string($conn,ucwords ($_POST['announcement_title']));
	$checkbox1 = implode(",", $_POST['announcement_receiver']);
	$announcement_message = mysqli_real_escape_string($conn,$_POST['announcement_message']);

	if ($_FILES['announcement_attachment']['name'] != NULL) {
		$announcement_attachment = str_replace("'","",date('YmdHis').$_FILES['announcement_attachment']['name']);
	}
	else {
		$announcement_attachment = "";
	}

	//Folder for attachment
	$folder1 = "../assets/attachment/announcement/";
	move_uploaded_file($_FILES['announcement_attachment']['tmp_name'],$folder1.$announcement_attachment);
	$announcement_date_created = date('Y-m-d H:i:s');

	$addAnnouncement = $conn -> query ("INSERT INTO announcement_lecturer (announcement_title, announcement_receiver, announcement_message, announcement_attachment, announcement_created_by, announcement_created_date)
										VALUES ('$announcement_title', '".$checkbox1."', '$announcement_message', '$announcement_attachment', '$lecturer_id', '$announcement_date_created')");

	if($addAnnouncement){
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	}
	else{
		echo "<script>alert('Announcement is not successful create.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add announcement----------*/

/* --------edit announcement---------*/
if (isset($_POST['edit_announcement']))
{
	$announcement_id = $_POST['announcement_id'];

	$new_title =mysqli_real_escape_string($conn,ucwords($_POST['new_title']));
	$new_receiver = implode(",", $_POST['arr']);
	$new_message = mysqli_real_escape_string($conn,$_POST['new_message']);

	$dir = "../assets/attachment/announcement/";
	if ($_FILES["announcement_attachment"]["name"] != NULL) {
		$newfilename = str_replace("'","",date('YmdHis').$_FILES["announcement_attachment"]["name"]);
	}
	else {
		$newfilename = "";
	}
	$file = $dir . $newfilename;

	if($newfilename != NULL){
		$checkAnnouncementFile = $conn -> query("SELECT announcement_attachment FROM announcement_lecturer WHERE announcement_id = '$announcement_id'");

		$checkAnnouncementRow = mysqli_fetch_object($checkAnnouncementFile);

		if($checkAnnouncementRow -> announcement_attachment != NULL){
			unlink($dir. $checkAnnouncementRow -> announcement_attachment);
			move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

			$editAnnouncement = $conn -> query("UPDATE announcement_lecturer SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

			if($editAnnouncement){
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			}
			else {
				echo "<script>alert('Upload new file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

			$editAnnouncement = $conn -> query("UPDATE announcement_lecturer SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

			if($editAnnouncement){
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			}
			else {
				echo "<script>alert('Upload file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editAnnouncement = $conn -> query("UPDATE announcement_lecturer SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message'
											WHERE announcement_id = '$announcement_id'");

		if($editAnnouncement){
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		}
		else {
			echo "<script>alert('Edit announcement is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* --------edit announcement---------*/

/* --------delete announcement---------*/
if(isset($_GET['delete_announcement'])){
	$delete_announcement = $_GET['delete_announcement'];

	$deleteAnnouncement = $conn -> query ("DELETE FROM announcement_lecturer where announcement_id = '$delete_announcement'");

	if($deleteAnnouncement){
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	}
	else {
		echo "<script>alert('Delete announcement is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* --------delete announcement---------*/


//----------Lecturer-update-profile.php----------
if (isset($_POST['country_id']))
{
	$lecturer_id = $_POST['lecturer_id'];
	$querystate = "SELECT * FROM state where state_country_id = ".$_POST['country_id'];
	$result = $conn -> query($querystate);


	if ($result->num_rows > 0) 
	{

		while ($rowstate = $result->fetch_assoc())
		{
			echo '<option value="'.$rowstate['state_id'].'">'.$rowstate['state_name'].'</option>';
		}
	}
	else 
	{
		echo '<option value="">State not available</option>';
	}	
}

//read city from state using ajax
if (isset($_POST['state_id']))
{
	
	$querycity = "SELECT * FROM city where city_state_id = ".$_POST['state_id'];
	$result = $conn -> query($querycity);

	if ($result->num_rows > 0) 
	{
		echo '<option value="">Select City</option>';

		while ($rowcity = $result->fetch_assoc())
		{
			echo '<option value="'.$rowcity['city_id'].'">'.$rowcity['city_name'].'</option>';
		}
	}
	else 
	{
		echo '<option value="">State not available</option>';
	}	
}

if (isset($_POST["countryID"])) {
    $stateInfo = $conn->query("SELECT * 
                                FROM `state` 
                                WHERE state_country_id = " . $_POST["countryID"] . " 
                                ORDER BY state_name;");
    $stateInfoNumRow = mysqli_num_rows($stateInfo);

	if ($stateInfoNumRow != 0) {
		echo "<option value=\"\" selected disabled>Select state</option>";

		for($i = 0; $i < $stateInfoNumRow; $i++) {
            $stateInfoRow = mysqli_fetch_object($stateInfo);

            echo "<option value=\"" . $stateInfoRow->state_id . "\">" . $stateInfoRow->state_name . "</option>";
		}
	} else {
		echo "<option value=\"\">State not available</option>";
	}	
}

/* read city from state using ajax */
if (isset($_POST["stateID"])) {
	$cityInfo = $conn->query("SELECT * 
                                FROM city 
                                WHERE city_state_id = " . $_POST["stateID"] . "
                                ORDER BY city_name;");
	$cityInfoNumRow = mysqli_num_rows($cityInfo);

	if ($cityInfoNumRow != 0) {
		echo "<option value=\"\">Select City</option>";

		for($i = 0; $i < $cityInfoNumRow; $i++) {
            $cityInfoRow = mysqli_fetch_object($cityInfo);

            echo "<option value=\"" . $cityInfoRow->city_id . "\">" . $cityInfoRow->city_name . "</option>";
		}
	} else {
		echo "<option value=\"\">State not available</option>";
	}	
}


if (isset($_POST['edit_profile']))
{
	$lecturer_id	= $_POST['lecturer_id'];

    $lecturer_fname = $_POST['lecturer_fname'];
	$lecturer_lname = $_POST['lecturer_lname'];
	$lecturer_email = $_POST['lecturer_email'];
	$lecturer_gender = $_POST['lecturer_gender'];
	$lecturer_contact_no = $_POST['lecturer_contact_no'];
	$lecturer_address = $_POST['lecturer_address'];

	$lecturer_title = $_POST['lecturer_title'];
	$lecturer_faculty = $_POST['lecturer_faculty'];
	$lecturer_department = $_POST['lecturer_department'];

	$lecturer_updated_date = date('Y-m-d H:i:s');

	$editProfile = $conn -> query ("UPDATE lecturer 
                                SET lecturer_fname = '$lecturer_fname', 
									lecturer_lname = '$lecturer_lname',  
									lecturer_email = '$lecturer_email',
									lecturer_gender = '$lecturer_gender',
									lecturer_contact_no = '$lecturer_contact_no',					
									lecturer_address = '$lecturer_address',
									lecturer_updated_date ='$lecturer_updated_date',
									lecturer_title = '$lecturer_title',
									lecturer_faculty = '$lecturer_faculty',
									lecturer_department = '$lecturer_department'
                                WHERE lecturer_id = '$lecturer_id'");

		if($editProfile)
		{
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		}
		else
		{
			echo "<script>alert('Edit profile is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
}

if (isset($_POST['update_ProfilePic'])){

	$lecturer_id	= $_POST['lecturer_id'];

	$profile_picture = time() . '_' . $_FILES['lecturer_profile_picture']['name'];

	$target = '../assets/images/avatar/' . $profile_picture;

	if (move_uploaded_file($_FILES['lecturer_profile_picture']['tmp_name'], $target)){
		$updatePP = $conn -> query ("UPDATE lecturer 
                                SET lecturer_profile_picture = '$profile_picture'
                                WHERE lecturer_id = '$lecturer_id'");
								if($updatePP)
								{
									echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
								}
								else
								{
									echo "<script>alert('Failed to upload picture');
											location.href = '$_SERVER[HTTP_REFERER]';</script>";
								}
	} else {
		echo "<script>alert('Failed to upload picture');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}

//----------lecturer-request-micro-credential.php----------

if (isset($_POST['select_institution'])) {


	$institution_id	= $_POST['institution_id'];

	$queryCheckUni = $conn->query("SELECT institution_id FROM institution WHERE institution_id = '$institution_id';");
	$rowReadUni = $queryCheckUni->fetch_object();
	$insti_ID = $rowReadUni->institution_id;

	header("Location: pages-microcredential-register.php?i_id=$insti_ID");

	exit();
}

/* ------------select institution----------*/

/* ------------add micro-credential----------*/
if (isset($_POST['add_microcredential'])) {
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mc_owner = $_POST['institution_id'];
	$mc_title = mysqli_real_escape_string($conn, $_POST['mc_title']);
	$mc_code = mysqli_real_escape_string($conn, $_POST['mc_code']);
	if (isset($_POST['mc_level'])) {
		$mc_level = implode(",", $_POST['mc_level']);
	} else {
		$mc_level =(NULL);
	}

	$mc_description = mysqli_real_escape_string($conn, $_POST['mc_desc']);
	$mc_category = mysqli_real_escape_string($conn, $_POST['mc_category']);

	$mc_date_enrollment = mysqli_real_escape_string($conn, $_POST['offerdate']);
	$mc_start_date = mysqli_real_escape_string($conn, $_POST['mc_start_date']);
	$mc_end_date = mysqli_real_escape_string($conn, $_POST['mc_end_date']);
	$fee = $_POST['mc_fee'];
	$mc_fee = floatval($fee * 100);
	$mc_duration = mysqli_real_escape_string($conn, $_POST['mc_duration']);

	$mc_credit_transfer = mysqli_real_escape_string($conn, $_POST['tab']);

	$mc_course_title = mysqli_real_escape_string($conn, $_POST['mc_course_title']);
	$mc_course_code = mysqli_real_escape_string($conn, $_POST['mc_course_code']);

	$mc_date_created = date('Y-m-d H:i:s');

	$mc_lo = mysqli_real_escape_string($conn, $_POST['mc_lo']);
	$mc_il = mysqli_real_escape_string($conn, $_POST['mc_il']);
	$mc_prerequisites = mysqli_real_escape_string($conn, $_POST['mc_prerequisites']);
	$mc_skills = mysqli_real_escape_string($conn, $_POST['mc_skills']);

	if ($_FILES['mccoverimg']['name'] != NULL) {
		$mc_coverimg = str_replace("'", "", date('YmdHis') . $_FILES['mccoverimg']['name']);
	} else {
		$mc_coverimg = "";
	}

	if ($_FILES['mou_attachment']['name'] != NULL) {
		$mc_mou = str_replace("'", "", date('YmdHis') . $_FILES['mou_attachment']['name']);
	} else {
		$mc_mou = (NULL);
	}

	
	$mcm_collaboration = mysqli_real_escape_string($conn, $_POST['mcm_collaboration']);


	$folder1 = "../assets/images/microcredential/";
	move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $folder1 . $mc_coverimg);

	$foldermou = "../assets/attachment/microcredential/mouattachment/";
	move_uploaded_file($_FILES['mou_attachment']['tmp_name'], $foldermou . $mc_mou);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	if ($mc_credit_transfer == 'No') {

		$insertMC = $conn->query("INSERT INTO microcredential (mc_title, mc_code, mc_description, mc_category, mc_level, mc_duration, mc_fee, mc_credit_transfer, mc_created_by, mc_owner, mc_created_date, mc_image, mc_status, mc_enrollment_date) 
		values ('$mc_title', '$mc_code', '$mc_description', '$mc_category', '" . $mc_level . "', '$mc_duration', '$mc_fee', '$mc_credit_transfer', '$get_userID', '$mc_owner', '$mc_date_created', '$mc_coverimg', 'Draft', '$mc_date_enrollment')");

		if ($insertMC) {

			$queryReadMC = $conn->query("SELECT mc_id FROM microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
			$rowReadMC = $queryReadMC->fetch_object();
			$get_mcid = $rowReadMC->mc_id;

			$insertmou = $conn->query("INSERT INTO mc_mou (mcm_mc_id, mcm_institution_id, mcm_user_request_id, mcm_collaboration, mcm_attachment, mcm_created_date) 
										VALUES ('$get_mcid', '$mc_owner', '$get_userID', '$mcm_collaboration', '$mc_mou', '$mc_date_created')");

			if ($insertmou) {
				if ($mc_date_enrollment == 'choosedate') {

					$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
												VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

					if ($add_mc_details) {
						$add_mc_enrolment_date = $conn->query("INSERT INTO mc_enrolment_session (mces_mc_id, mces_start_date, mces_end_date) 
														   VALUES ('$get_mcid', '$mc_start_date', '$mc_end_date')");

						if ($add_mc_enrolment_date) {
							echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
							
						} else {
							echo "<script>alert('insert micro-credential enrolment date is not successful.');
							location.href = '$_SERVER[HTTP_REFERER]';</script>";
						}
					} else {
						echo "<script>alert('insert micro-credential learning details is not successful.');
						location.href = '$_SERVER[HTTP_REFERER]';</script>";
					}
				} else {
					$queryReadMC = $conn->query("SELECT mc_id FROM microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
					$rowReadMC = $queryReadMC->fetch_object();
					$get_mcid = $rowReadMC->mc_id;

					$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
												VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

					if ($add_mc_details) {
						echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
						
					} else {
						echo "<script>alert('insert micro-credential learning details is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
					}
				}
			} else {
				echo "<script>alert('Insert MoU attachment is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Create micro-credential is not successful');
		location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		$checkbox1 = implode(",", $_POST['mc_course_level']);

		$insertMC = $conn->query("INSERT INTO microcredential (mc_title, mc_code, mc_description, mc_category, mc_level, mc_duration, mc_fee, mc_credit_transfer, mc_created_by, mc_owner, mc_created_date, mc_image, mc_status, mc_enrollment_date) 
		values ('$mc_title', '$mc_code', '$mc_description', '$mc_category', '" . $mc_level . "', '$mc_duration', '$mc_fee', '$mc_credit_transfer', '$get_userID', '$mc_owner', '$mc_date_created', '$mc_coverimg', 'Draft', '$mc_date_enrollment')");

		if ($insertMC) {

			$queryReadMC = $conn->query("SELECT mc_id FROM microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
			$rowReadMC = $queryReadMC->fetch_object();
			$get_mcid = $rowReadMC->mc_id;

			$insertmou = $conn->query("INSERT INTO mc_mou (mcm_mc_id, mcm_institution_id, mcm_user_request_id, mcm_collaboration, mcm_attachment, mcm_created_date) 
			VALUES ('$get_mcid', '$mc_owner', '$get_userID', '$mcm_collaboration', '$mc_mou', '$mc_date_created')");

			if ($insertmou) {

				if ($mc_date_enrollment == 'choosedate') {


					$add_mc_course = $conn->query("INSERT INTO mc_course_credit_transfer (mccct_mc_id, mccct_course_title, mccct_course_code, mccct_course_level, mccct_created_by, mccct_created_date) 
			VALUES ('$get_mcid', '$mc_course_title', '$mc_course_code', '" . $checkbox1 . "', '$get_userID', '$mc_date_created')");

					if ($add_mc_course) {
						$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
				VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

						if ($add_mc_details) {
							$add_mc_enrolment_date = $conn->query("INSERT INTO mc_enrolment_session (mces_mc_id, mces_start_date, mces_end_date) 
					VALUES ('$get_mcid', '$mc_start_date', '$mc_end_date')");

							if ($add_mc_enrolment_date) {
								echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
								
							} else {
								echo "<script>alert('insert micro-credential enrolment date is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
							}
						} else {
							echo "<script>alert('insert micro-credential learning details is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
						}
					} else {
						echo "<script>alert('insert course details for credit transfer is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
					}
				} else {
					$queryReadMC = $conn->query("SELECT mc_id FROM microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
					$rowReadMC = $queryReadMC->fetch_object();
					$get_mcid = $rowReadMC->mc_id;

					$add_mc_course = $conn->query("INSERT INTO mc_course_credit_transfer (mccct_mc_id, mccct_course_title, mccct_course_code, mccct_course_level, mccct_created_by, mccct_created_date) 
			VALUES ('$get_mcid', '$mc_course_title', '$mc_course_code', '" . $checkbox1 . "', '$get_userID', '$mc_date_created')");

					if ($add_mc_course) {
						$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
				VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

						if ($add_mc_details) 
						{
							echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
							
						} else {
							echo "<script>alert('insert micro-credential learning details is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
						}
					} else {
						echo "<script>alert('insert course details for credit transfer is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
					}
				}
			} else {
				echo "<script>alert('Insert MoU attachment is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Create micro-credential is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}

/* ------------add micro-credential----------*/

/* ------------request micro-credential----------*/
if (isset($_POST['request_mc'])) {

	$institution_id = $_POST['institution_id'];
	$mc_id = $_POST['mc_id'];
	$user_id = $_POST['user_id'];
	$mc_status = "Processing";
	$tab_type = "Processing";
	$mc_request_date = date('Y-m-d H:i:s');

	$insertmcrequest = $conn->query("INSERT INTO review_microcredential (rmc_mc_id, rmc_institution_id, rmc_user_request, rmc_status, rmc_date_request) 
		VALUES ('$mc_id', '$institution_id', '$user_id', '$mc_status', '$mc_request_date')");

	if ($insertmcrequest) {

		$editmc = $conn->query("UPDATE microcredential SET mc_status = '$mc_status' WHERE mc_id = '$mc_id'");

		if ($editmc) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['tab_type'] = $tab_type;
		} else {
			echo "<script>alert('Update micro-credential details is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Request micro-credential is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------request micro-credential----------*/


/* ------------update micro-credential----------*/
if (isset($_POST['edit_mc'])) {
	
	$mc_id = $_POST['mc_id'];
	$new_mc_name = $_POST['new_mc_name'];
	$new_mc_code = mysqli_real_escape_string($conn, $_POST['new_mc_code']);
	if (isset($_POST['new_mc_level'])) {
		$new_mc_level = implode(",", $_POST['new_mc_level']);
	} else {
		$new_mc_level = (NULL);
	}
	// $new_mc_level = implode(",", $_POST['new_mc_level']);
	$new_mc_desc = mysqli_real_escape_string($conn, $_POST['new_mc_desc']);
	$new_mc_category = mysqli_real_escape_string($conn, $_POST['new_mc_category']);
	$fee = $_POST['new_mc_fee'];
	$new_mc_fee = floatval($fee*100);
	$new_mc_duration = mysqli_real_escape_string($conn, $_POST['new_mc_duration']);

	$mc_date_updated = date('Y-m-d H:i:s');

	$dir = "../assets/images/microcredential/";
	if ($_FILES["mccoverimg"]["name"] != NULL) {
		$newfileimg = str_replace("'", "", date('YmdHis') . $_FILES["mccoverimg"]["name"]);
	} else {
		$newfileimg = "";
	}
	$file = $dir . $newfileimg;

	if ($newfileimg != NULL) {
		$checkimgfile = $conn->query("SELECT mc_image FROM microcredential WHERE mc_id = '$mc_id'");

		$checkimgRow = mysqli_fetch_object($checkimgfile);

		if ($checkimgRow->mc_image != NULL) {
			unlink($dir . $checkimgRow->mc_image);
			move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $file);

			$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '".$new_mc_level."', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_image = '$newfileimg', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

			if ($editmc) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for micro-credential is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $file);

			$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '".$new_mc_level."', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_image = '$newfileimg', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

			if ($editmc) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for micro-credential is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '".$new_mc_level."', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

		if ($editmc) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential ----------*/

/* ------------delete micro-credential----------*/
if (isset($_GET['delete_mc'])) {
	$delete = $_GET['delete_mc'];

	$mc_deleted_date = date('Y-m-d H:i:s');

	$delmc = $conn->query("DELETE FROM microcredential where mc_id = '$delete'");

	if ($delmc) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Delete micro-credential is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential ----------*/

/* ------------publish micro-credential----------*/
if (isset($_GET['publish_mc'])) {
	$mc_id = $_GET['publish_mc'];
	$status = "Published";
	$tab_type = "Published";
	$mc_date_published = date('Y-m-d H:i:s');

	$publishmc =  $conn->query("UPDATE microcredential SET mc_status = '$status', mc_published_date = '$mc_date_published' WHERE mc_id = '$mc_id'");

	if ($publishmc) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['tab_type'] = $tab_type;
	} else {
		echo "<script>alert('Publish micro-credential is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential ----------*/

/* ------------unpublish micro-credential----------*/
if (isset($_GET['unpublish_mc'])) {
	$mc_id = $_GET['unpublish_mc'];
	$status = "Draft";

	$publishmc =  $conn->query("UPDATE microcredential SET mc_status = '$status', mc_published_date=(NULL) WHERE mc_id = '$mc_id'");

	if ($publishmc) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Publish micro-credential is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential ----------*/

/* ------------update micro-credential course transfer----------*/
if (isset($_POST['edit_course_transfer_credit'])) {
	$mc_id	= $_POST['mc_id'];
	$mccct_id = $_POST['mccct_id'];
	$new_mc_course_title = mysqli_real_escape_string($conn, $_POST['new_mc_course_title']);
	$new_mc_course_code = mysqli_real_escape_string($conn, $_POST['new_mc_course_code']);
	$new_course_level = implode(",", $_POST['new_mc_course_level']);

	$mccct_date_updated = date('Y-m-d H:i:s');

	$editmccct = $conn->query("UPDATE mc_course_credit_transfer SET mccct_course_title = '$new_mc_course_title', mccct_course_code = '$new_mc_course_code', mccct_course_level =  '" . $new_course_level . "', mccct_updated_date = '$mccct_date_updated'  
	WHERE mccct_mc_id  = '$mc_id' AND mccct_id = '$mccct_id'");


	if ($editmccct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Update course credit transfer is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------update micro-credential course transfer----------*/

/* ------------change/edit to micro-credential course transfer----------*/
if (isset($_POST['change_to_transfer_credit'])) {
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mc_id	= $_POST['mc_id'];
	$mc_credit_transfer = $_POST['mc_credit_transfer'];
	$mc_course_title = mysqli_real_escape_string($conn, $_POST['mc_course_title']);
	$mc_course_code = mysqli_real_escape_string($conn, $_POST['mc_course_code']);
	$mc_course_level = implode(",", $_POST['mc_course_level']);

	$mc_date_updated = date('Y-m-d H:i:s');

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcourse = $conn->query("INSERT INTO mc_course_credit_transfer (mccct_mc_id, mccct_course_title, mccct_course_code, mccct_course_level, mccct_created_by, mccct_created_date) 
			VALUES ('$mc_id', '$mc_course_title', '$mc_course_code', '" . $mc_course_level . "', '$get_userID', '$mc_date_updated')");

	
	if ($insertcourse) {	

		$editmc = $conn->query("UPDATE microcredential SET mc_credit_transfer = '$mc_credit_transfer', mc_updated_date = '$mc_date_updated'  
			WHERE mc_id = '$mc_id'");

		if ($editmc) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update micro-credential details is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		
		echo "<script>alert('insert course credit transfer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------change/edit to micro-credential course transfer----------*/

/* ------------delete micro-credential course transfer----------*/
if (isset($_GET['delete_mccct'])) {
	$deletemccct = $_GET['delete_mccct'];
	$mc_id = $_GET['mcid'];

	$delmccct = $conn->query("DELETE FROM mc_course_credit_transfer WHERE mccct_id = '$deletemccct' AND mccct_mc_id = '$mc_id'");

	if ($delmccct) {
		$updatectmc = $conn->query("UPDATE microcredential SET mc_credit_transfer = 'No' WHERE mc_id = '$mc_id'");

		if ($updatectmc) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('update micro-credential credit transfer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Delete course information is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential course transfer----------*/

/* ------------update micro-credential learning details----------*/
if (isset($_POST['edit_mcld'])) {
	$mc_id	= $_POST['mc_id'];
	$mcld_id = $_POST['mcld_id'];
	$new_mc_lo = mysqli_real_escape_string($conn, $_POST['new_mc_lo']);
	$new_mc_il = mysqli_real_escape_string($conn, $_POST['new_mc_il']);
	$new_mc_prerequisites = mysqli_real_escape_string($conn, $_POST['new_mc_prerequisites']);
	$new_mc_skills = mysqli_real_escape_string($conn, $_POST['new_mc_skills']);

	$editmcld = $conn->query("UPDATE mc_learning_details SET mcld_learning_outcome = '$new_mc_lo', mcld_intended_learners = '$new_mc_il', mcld_prerequisites =  '$new_mc_prerequisites', mcld_skills = '$new_mc_skills'  
	WHERE mcld_mc_id = '$mc_id' AND mcld_id = '$mcld_id'");


	if ($editmcld) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Update micro-credential learning details is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------update micro-credential learning details----------*/

/* ------------add micro-credential enrolment date----------*/
if (isset($_POST['add_enrolment_date'])) {
	$mc_id	= $_POST['mc_id'];
	$mc_start_date = mysqli_real_escape_string($conn, $_POST['mc_start_date']);
	$mc_end_date = mysqli_real_escape_string($conn, $_POST['mc_end_date']);

	$add_mc_enrolment_date = $conn->query("INSERT INTO mc_enrolment_session (mces_mc_id, mces_start_date, mces_end_date) 
	VALUES ('$mc_id', '$mc_start_date', '$mc_end_date')");

	if ($add_mc_enrolment_date) 
	{

	$updateenrolmentdatemc = $conn->query("UPDATE microcredential SET mc_enrollment_date = 'choosedate' WHERE mc_id = '$mc_id'");

		if ($updateenrolmentdatemc) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Add micro-credential enrolment date is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential enrolment date----------*/


/* ------------edit micro-credential enrolment date----------*/
if (isset($_POST['edit_enrolment_date'])) {
	$mc_id	= $_POST['mc_id'];
	$mces_id = $_POST['mces_id'];
	$new_offerdate = mysqli_real_escape_string($conn, $_POST['new_offerdate']);
	$new_mc_start_date = mysqli_real_escape_string($conn, $_POST['new_mc_start_date']);
	$new_mc_end_date = mysqli_real_escape_string($conn, $_POST['new_mc_end_date']);

	if ($new_offerdate == 'anytime') {

		$editmcdateEnrol = $conn->query("UPDATE microcredential SET mc_enrollment_date = '$new_offerdate' WHERE mc_id = '$mc_id'");

		if ($editmcdateEnrol)
		{
			$deletedateEnrolment = $conn->query("DELETE FROM mc_enrolment_session WHERE mces_mc_id = '$mc_id' AND mces_id = '$mces_id'");

			if($deletedateEnrolment)
			{
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			}
			else
			{
				echo "<script>alert('Delete enrolment date is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
		else
		{
			echo "<script>alert('Update micro-credential learning details is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	
	} 
	
	else {
		$editdateenrolment = $conn->query("UPDATE mc_enrolment_session SET mces_start_date = '$new_mc_start_date', mces_end_date = '$new_mc_end_date' WHERE mces_mc_id = '$mc_id' AND mces_id = '$mces_id'");


		if ($editdateenrolment) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update micro-credential enrolment date is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------edit micro-credential enrolment date----------*/

/* ------------update micro-credential mou----------*/
if (isset($_POST['edit_mou_attachment'])) {

	$mc_id = $_POST['mc_id'];
	$mcm_id = $_POST['mcm_id'];
	$institution_id = $_POST['institution_id'];
	$new_mcm_collaboration = mysqli_real_escape_string($conn, $_POST['new_mcm_collaboration']);


	$dir = "../assets/attachment/microcredential/mouattachment/";
	if ($_FILES["mcm_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["mcm_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT mcm_attachment FROM mc_mou WHERE mcm_id = '$mcm_id' AND mcm_mc_id = '$mc_id' AND mcm_institution_id = '$institution_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->mcm_attachment != NULL) {
			unlink($dir . $checkattachRow->mcm_attachment);
			move_uploaded_file($_FILES['mcm_attachment']['tmp_name'], $file);

			$editmcm = $conn->query("UPDATE mc_mou SET mcm_collaboration = '$new_mcm_collaboration', mcm_attachment = '$newattach' WHERE mcm_id = '$mcm_id' AND mcm_mc_id = '$mc_id' AND mcm_institution_id = '$institution_id'");

			if ($editmcm) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential MoU is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mcm_attachment']['tmp_name'], $file);

			$editmcm = $conn->query("UPDATE mc_mou SET mcm_collaboration = '$new_mcm_collaboration', mcm_attachment = '$newattach' WHERE mcm_id = '$mcm_id' AND mcm_mc_id = '$mc_id' AND mcm_institution_id = '$institution_id'");

			if ($editmcm) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential MoU is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {

		$editmcm = $conn->query("UPDATE mc_mou SET mcm_collaboration = '$new_mcm_collaboration' WHERE mcm_id = '$mcm_id' AND mcm_mc_id = '$mc_id' AND mcm_institution_id = '$institution_id'");

		if ($editmcm) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Upload micro-credential MoU is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential mou----------*/

/* ------------add micro-credential notes----------*/
if (isset($_POST['addmcn'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mcn_mc = $_POST['mc_id'];
	$mcn_title = $_POST['mcn_title'];
	$mcn_description = mysqli_real_escape_string($conn, $_POST['mcn_desc']);
	$mcn_date_created = date('Y-m-d H:i:s');
	$mcn_status = $_POST['mcn_status'];
	$contenttype = "Notes";

	if ($_FILES['mcn_attachment']['name'] != NULL) {
		$mcn_attachment = str_replace("'", "", date('YmdHis') . $_FILES['mcn_attachment']['name']);
	} else {
		$mcn_attachment = "";
	}

	$folder1 = "../assets/attachment/microcredential/mcnote/";
	move_uploaded_file($_FILES['mcn_attachment']['tmp_name'], $folder1 . $mcn_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id from lecturer where lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmcnote = $conn->query("INSERT INTO mc_notes (mcn_mc_id, mcn_title, mcn_description, mcn_attachment, mcn_created_date, mcn_created_by, mcn_status) 
		   values ('$mcn_mc', '$mcn_title', '$mcn_description', '$mcn_attachment', '$mcn_date_created', '$get_userID', '$mcn_status')");

	if ($insertmcnote) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create micro-credential notes is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential notes----------*/

/* ------------update micro-credential notes----------*/
if (isset($_POST['edit_mcn'])) {

	$mc_id = $_POST['mc_id'];
	$mcn_id = $_POST['mcn_id'];
	$new_mcn_title = $_POST['new_mcn_title'];
	$new_mcn_desc = mysqli_real_escape_string($conn, $_POST['new_mcn_desc']);
	$mcn_date_updated = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$dir = "../assets/attachment/microcredential/mcnote/";
	if ($_FILES["mcn_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["mcn_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT mcn_attachment FROM mc_notes WHERE mcn_id = '$mcn_id' AND mcn_mc_id = '$mc_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->mcn_attachment != NULL) {
			unlink($dir . $checkattachRow->mcn_attachment);
			move_uploaded_file($_FILES['mcn_attachment']['tmp_name'], $file);

			$editmcn = $conn->query("UPDATE mc_notes SET mcn_title = '$new_mcn_title', mcn_description = '$new_mcn_desc', mcn_attachment = '$newattach', mcn_updated_date = '$mcn_date_updated' WHERE mcn_id = '$mcn_id' AND mcn_mc_id = '$mc_id'");

			if ($editmcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mcn_attachment']['tmp_name'], $file);

			$editmcn = $conn->query("UPDATE mc_notes SET mcn_title = '$new_mcn_title', mcn_description = '$new_mcn_desc', mcn_attachment = '$newattach', mcn_updated_date = '$mcn_date_updated' WHERE mcn_id = '$mcn_id' AND mcn_mc_id = '$mc_id'");

			if ($editmcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmcn = $conn->query("UPDATE mc_notes SET mcn_title = '$new_mcn_title', mcn_description = '$new_mcn_desc', mcn_updated_date = '$mcn_date_updated' WHERE mcn_id = '$mcn_id' AND mcn_mc_id = '$mc_id'");

		if ($editmcn) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential notes----------*/

/* ------------delete micro-credential notes----------*/
if (isset($_GET['delete_mcn'])) {
	$delete = $_GET['delete_mcn'];
	$mc_id = $_GET['mc_id'];
	$mcn_deleted_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$delmcnote = $conn->query("DELETE FROM mc_notes WHERE mcn_mc_id = '$mc_id' AND mcn_id = '$delete'");

	if ($delmcnote) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete notes is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential notes----------*/


/* ------------publish micro-credential notes----------*/
if (isset($_GET['publish_mcn'])) {
	$mcn_id = $_GET['publish_mcn'];
	$update_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$publishmcn = $conn->query("UPDATE mc_notes SET mcn_status = 'Published', mcn_updated_date = '$update_date' WHERE mcn_id = '$mcn_id'");

	if ($publishmcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential notes----------*/

/* ------------unpublish micro-credential notes----------*/
if (isset($_GET['unpublish_mcn'])) {
	$mcn_id = $_GET['unpublish_mcn'];
	$mcn_updated_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$unpublishmcn = $conn->query("UPDATE mc_notes SET mcn_status = 'Save Only', mcn_updated_date = '$mcn_updated_date' WHERE mcn_id = '$mcn_id'");

	if ($unpublishmcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential notes----------*/


/* ------------add micro-credential video----------*/
if (isset($_POST['add_mc_video'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mcv_mc = $_POST['mc_id'];
	$mcv_title = $_POST['mcv_title'];
	$mcv_desc = mysqli_real_escape_string($conn, $_POST['mcv_desc']);
	$mcv_date_created = date('Y-m-d H:i:s');
	$mcv_status = $_POST['mcv_status'];
	$contenttype = "Video";

	if ($_FILES['mcv_attachment']['name'] != NULL) {
		$mcv_attachment = str_replace("'", "", date('YmdHis') . $_FILES['mcv_attachment']['name']);
	} else {
		$mcv_attachment = "";
	}

	$folder1 = "../assets/attachment/microcredential/mcvideo/";
	move_uploaded_file($_FILES['mcv_attachment']['tmp_name'], $folder1 . $mcv_attachment);
	$getID3 = new getID3();
	$filename = "../assets/attachment/microcredential/mcvideo/" . $mcv_attachment;
	$fileinfo = $getID3->analyze($filename);
	$duration = $fileinfo['playtime_string'];
	$dur = duration($duration);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmcv = $conn->query("INSERT INTO mc_video (mcv_mc_id, mcv_title, mcv_description, mcv_attachment, mcv_duration, mcv_created_date, mcv_created_by, mcv_status) 
		values ('$mcv_mc', '$mcv_title', '$mcv_desc', '$mcv_attachment', '$dur', '$mcv_date_created', '$get_userID', '$mcv_status')");

	if ($insertmcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create micro-credential video is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential video----------*/

/* ------------update micro-credential video----------*/
if (isset($_POST['edit_mcv'])) {
	
	$mc_id = $_POST['mc_id'];
	$mcv_id = $_POST['mcv_id'];
	$new_mcv_title = $_POST['new_mcv_title'];
	$new_mcv_desc = mysqli_real_escape_string($conn, $_POST['new_mcv_desc']);
	$contenttype = "Video";

	$mcv_date_updated = date('Y-m-d H:i:s');

	$dir = "../assets/attachment/microcredential/mcvideo/";
	if ($_FILES["mcv_attachment"]["name"] != NULL) {
		$newattachvid = str_replace("'", "", date('YmdHis') . $_FILES["mcv_attachment"]["name"]);
	} else {
		$newattachvid = "";
	}
	$file = $dir . $newattachvid;

	if ($newattachvid != NULL) {
		$checkattachvid = $conn->query("SELECT mcv_attachment FROM mc_video WHERE mcv_id = '$mcv_id' AND mcv_mc_id = '$mc_id'");

		$checkattachvidRow = mysqli_fetch_object($checkattachvid);

		if ($checkattachvidRow->mcv_attachment != NULL) {
			unlink($dir . $checkattachvidRow->mcv_attachment);
			move_uploaded_file($_FILES['mcv_attachment']['tmp_name'], $file);
			$getID3 = new getID3();
			$filename = $file;
			$fileinfo = $getID3->analyze($filename);
			$duration = $fileinfo['playtime_string'];
			$dur = duration($duration);

			$editmcv = $conn->query("UPDATE mc_video SET mcv_title = '$new_mcv_title', mcv_description = '$new_mcv_desc', mcv_attachment = '$newattachvid', mcv_duration = '$dur', mcv_updated_date = '$mcv_date_updated' WHERE mcv_id = '$mcv_id' AND mcv_mc_id = '$mc_id'");

			if ($editmcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mcv_attachment']['tmp_name'], $file);

			$editmcv = $conn->query("UPDATE mc_video SET mcv_title = '$new_mcv_title', mcv_description = '$new_mcv_desc', mcv_attachment = '$newattachvid', mcv_duration = '$dur', mcv_updated_date = '$mcv_date_updated' WHERE mcv_id = '$mcv_id' AND mcv_mc_id = '$mc_id'");

			if ($editmcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmcv = $conn->query("UPDATE mc_video SET mcv_title = '$new_mcv_title', mcv_description = '$new_mcv_desc', mcv_updated_date = '$mcv_date_updated' WHERE mcv_id = '$mcv_id' AND mcv_mc_id = '$mc_id'");

		if ($editmcv) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update micro-credential video is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential video----------*/

/* ------------delete micro-credential video----------*/
if (isset($_GET['delete_mcv'])) {
	$delete = $_GET['delete_mcv'];
	$mc_id = $_GET['mc_id'];
	$mcv_deleted_date = date('Y-m-d H:i:s');
	$contenttype = "Video";

	$delmcvid = $conn->query("DELETE FROM mc_video WHERE mcv_mc_id = '$mc_id' AND mcv_id = '$delete'");

	if ($delmcvid) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential video----------*/

/* ------------publish micro-credential video----------*/
if (isset($_GET['publish_mcv'])) {
	$mcv_id = $_GET['publish_mcv'];

	$mcv_updated_date = date('Y-m-d H:i:s');
	$contenttype = "Video";


	$publishmcv = $conn->query("UPDATE mc_video SET mcv_status = 'Published', mcv_updated_date = '$mcv_updated_date' WHERE mcv_id = '$mcv_id' ");

	if ($publishmcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential video----------*/

/* ------------unpublish micro-credential video----------*/
if (isset($_GET['unpublish_mcv'])) {
	$mcv_id = $_GET['unpublish_mcv'];

	$mcv_updated_date = date('Y-m-d H:i:s');
	$contenttype = "Video";

	$unpublishmcv = $conn->query("UPDATE mc_video SET mcv_status = 'Save Only', mcv_updated_date = '$mcv_updated_date' WHERE mcv_id = '$mcv_id'");

	if ($unpublishmcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential video----------*/

/* ------------add micro-credential slide----------*/
if (isset($_POST['addmcs'])) {
	
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mcs_mc = $_POST['mc_id'];
	$mcs_title = $_POST['mcs_title'];
	$mcs_description = mysqli_real_escape_string($conn, $_POST['mcs_desc']);
	$mcs_date_created = date('Y-m-d H:i:s');
	$mcs_status = $_POST['mcs_status'];
	$contenttype = "Slide";

	if ($_FILES['mcs_attachment']['name'] != NULL) {
		$mcs_attachment = str_replace("'", "", date('YmdHis') . $_FILES['mcs_attachment']['name']);
	} else {
		$mcs_attachment = "";
	}

	$folder1 = "../assets/attachment/microcredential/mcslide/";
	move_uploaded_file($_FILES['mcs_attachment']['tmp_name'], $folder1 . $mcs_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmcslide = $conn->query("INSERT INTO mc_slide (mcs_mc_id, mcs_title, mcs_description, mcs_attachment, mcs_created_date, mcs_created_by, mcs_status) 
		   values ('$mcs_mc', '$mcs_title', '$mcs_description', '$mcs_attachment', '$mcs_date_created', '$get_userID', '$mcs_status')");

	if ($insertmcslide) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create micro-credential slide is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential slide----------*/

/* ------------update micro-credential slide----------*/
if (isset($_POST['edit_mcs'])) {
	
	$mc_id = $_POST['mc_id'];
	$mcs_id = $_POST['mcs_id'];
	$new_mcs_title = $_POST['new_mcs_title'];
	$new_mcs_desc = mysqli_real_escape_string($conn, $_POST['new_mcs_desc']);
	$mcs_date_updated = date('Y-m-d H:i:s');
	$contenttype = "Slide";

	$dir = "../assets/attachment/microcredential/mcslide/";
	if ($_FILES["mcs_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["mcs_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT mcs_attachment FROM mc_slide WHERE mcs_id = '$mcs_id' AND mcs_mc_id = '$mc_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->mcs_attachment != NULL) {
			unlink($dir . $checkattachRow->mcs_attachment);
			move_uploaded_file($_FILES['mcs_attachment']['tmp_name'], $file);

			$editmcs = $conn->query("UPDATE mc_slide SET mcs_title = '$new_mcs_title', mcs_description = '$new_mcs_desc', mcs_attachment = '$newattach', mcs_updated_date = '$mcs_date_updated' 
			WHERE mcs_id = '$mcs_id' AND mcs_mc_id = '$mc_id'");

			if ($editmcs) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mcs_attachment']['tmp_name'], $file);

			$editmcs = $conn->query("UPDATE mc_slide SET mcs_title = '$new_mcs_title', mcs_description = '$new_mcs_desc', mcs_attachment = '$newattach', mcs_updated_date = '$mcs_date_updated' 
			WHERE mcs_id = '$mcs_id' AND mcs_mc_id = '$mc_id'");

			if ($editmcs) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmcs = $conn->query("UPDATE mc_slide SET mcs_title = '$new_mcs_title', mcs_description = '$new_mcs_desc', mcs_updated_date = '$mcs_date_updated' 
		WHERE mcs_id = '$mcs_id' AND mcs_mc_id = '$mc_id'");

		if ($editmcs) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential slide----------*/

/* ------------delete micro-credential slide----------*/
if (isset($_GET['delete_mcs'])) {
	$delete = $_GET['delete_mcs'];
	$mc_id = $_GET['mcid'];
	$mcs_deleted_date = date('Y-m-d H:i:s');
	$contenttype = "Slide";

	$delmcslide = $conn->query("DELETE FROM mc_slide WHERE mcs_id = '$delete' AND mcs_mc_id = '$mc_id'");

	if ($delmcslide) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete slide is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential slide----------*/

/* ------------publish micro-credential slide----------*/
if (isset($_GET['publish_mcs'])) {
	$mcs_id = $_GET['publish_mcs'];
	$update_date = date('Y-m-d H:i:s');
	$contenttype = "Slide";

	$publishmcs = $conn->query("UPDATE mc_slide SET mcs_status = 'Published', mcs_updated_date = '$update_date' WHERE mcs_id = '$mcs_id'");

	if ($publishmcs) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential slide----------*/

/* ------------unpublish micro-credential slide----------*/
if (isset($_GET['unpublish_mcs'])) {
	$mcs_id = $_GET['unpublish_mcs'];
	$mcs_updated_date = date('Y-m-d H:i:s');
	$contenttype = "Slide";

	$unpublishmcs = $conn->query("UPDATE mc_slide SET mcs_status = 'Save Only', mcs_updated_date = '$mcs_updated_date' WHERE mcs_id = '$mcs_id'");

	if ($unpublishmcs) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential slide----------*/


/* ------------add micro-credential quiz----------*/
if (isset($_POST['add_mc_quiz'])) {
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mcq_mc = $_POST['mc_id'];
	$mcq_title = $_POST['mcq_title'];
	$mcq_instruction = mysqli_real_escape_string($conn, $_POST['mcq_instruction']);
	$mcq_duration = $_POST['mcq_duration'];

	$mcq_date_created = date('Y-m-d H:i:s');
	$mcq_status = $_POST['mcq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmcquiz = $conn->query("INSERT INTO mc_quiz (mcq_mc_id, mcq_title, mcq_instruction, mcq_duration, mcq_created_date, mcq_created_by, mcq_status) 
		values ('$mcq_mc', '$mcq_title', '$mcq_instruction', '$mcq_duration', '$mcq_date_created', '$get_userID', '$mcq_status')");

	if ($insertmcquiz) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Create micro-credential quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential quiz----------*/

/* ------------edit micro-credential quiz----------*/
if (isset($_POST['edit_mcq'])) {
	
	$mcq_mc = $_POST['mc_id'];
	$mcq_id = $_POST['mcq_id'];
	$new_mcq_title = $_POST['new_mcq_title'];
	$new_mcq_instruction = mysqli_real_escape_string($conn, $_POST['new_mcq_instruction']);
	$new_mcq_duration = $_POST['new_mcq_duration'];
	$mcq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Quiz";

	$updatemcquiz = $conn->query("UPDATE mc_quiz SET mcq_title = '$new_mcq_title', mcq_instruction = '$new_mcq_instruction', mcq_duration = '$new_mcq_duration', mcq_updated_date = '$mcq_date_updated' 
	WHERE mcq_id = '$mcq_id' AND mcq_mc_id = '$mcq_mc'");

	if ($updatemcquiz) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('edit micro-credential quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------edit micro-credential quiz----------*/

/* ------------publish micro-credential quiz----------*/
if (isset($_GET['publish_mcq'])) {
	$mcq_id = $_GET['publish_mcq'];
	$assessmenttype = "Quiz";
	$mcq_updated_date = date('Y-m-d H:i:s');

	$publishmcq = $conn->query("UPDATE mc_quiz SET mcq_status = 'Published', mcq_updated_date = '$mcq_updated_date' WHERE mcq_id = '$mcq_id' ");

	if ($publishmcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential quiz----------*/

/* ------------unpublish micro-credential quiz----------*/
if (isset($_GET['unpublish_mcq'])) {
	$mcq_id = $_GET['unpublish_mcq'];
	$assessmenttype = "Quiz";
	$mcq_updated_date = date('Y-m-d H:i:s');

	$unpublishmcq = $conn->query("UPDATE mc_quiz SET mcq_status = 'Save Only', mcq_updated_date = '$mcq_updated_date' WHERE mcq_id = '$mcq_id'");

	if ($unpublishmcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential quiz----------*/


/* ------------delete micro-credential quiz----------*/
if (isset($_GET['delete_mcq'])) {
	$delete = $_GET['delete_mcq'];
	$mc_id = $_GET['mc_id'];
	$assessmenttype = "Quiz";
	$mcq_deleted_date = date('Y-m-d H:i:s');

	$delmcq = $conn->query("DELETE FROM mc_quiz WHERE mcq_mc_id  = '$mc_id' AND mcq_id = '$delete'");

	if ($delmcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential quiz----------*/

/* ------------add micro-credential quiz question----------*/
if (isset($_POST['add_quiz_question'])) {
	// $mcqq_mcq = $_POST['mcq_id'];
	$mc_quiz_id = $_POST['mcq_id'];
	$quiz_question = $_POST['mcq_question'];
	$mcq_question_type = $_POST['mcq_question_type'];
	$mcqq_created_date = date('Y-m-d H:i:s');

	if ($mcq_question_type == "Multiple Choice")
	{
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	}
	elseif ($mcq_question_type == "True/False")
	{
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);
		$answer3 = "";
		$answer4 = "";
		$radiobutton = $_POST['tf_answer'];
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
	}

	$add_question = $conn->query("INSERT INTO mc_quiz_question (mcqq_mc_quiz_id, mcqq_type, mcqq_question, mcqq_created_date) 
		VALUES ('$mc_quiz_id', '$mcq_question_type', '$quiz_question', '$mcqq_created_date')");

	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT mcqq_id FROM mc_quiz_question WHERE mcqq_mc_quiz_id = '$mc_quiz_id' AND mcqq_question = '$quiz_question' AND mcqq_created_date = '$mcqq_created_date';");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_mcqqid = $rowReadQuestion->mcqq_id;

		$add_answer = $conn->query("INSERT INTO mc_quiz_answer (mcqa_mc_quiz_question_id, mcqa_answer1, mcqa_answer2, mcqa_answer3, mcqa_answer4, mcqa_right_answer, mcqa_right_answerword) 
			VALUES ('$get_mcqqid', '$answer1', '$answer2', '$answer3', '$answer4', '$radiobutton', '$word')");

		if ($add_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('insert question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential quiz question----------*/


/* ------------edit micro-credential quiz question----------*/
if (isset($_POST['edit_quiz_question'])) {

	// $mcqq_mcq = $_POST['mcq_id'];
	$mc_quiz_id = $_POST['mcq_id'];
	$mcqq_id = $_POST['mcqq_id'];
	$mcqa_id = $_POST['mcqa_id'];
	$new_quiz_question = $_POST['new_mcq_question'];
	$mcq_question_type = $_POST['mcqq_type'];
	$mcqq_updated_date = date('Y-m-d H:i:s');

	if ($mcq_question_type == "Multiple Choice")
	{
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	}
	elseif ($mcq_question_type == "True/False")
	{
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
		$new_answer3 = "";
		$new_answer4 = "";
		$radiobutton = $_POST['new_answertf'];
	}

	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
	} elseif ($radiobutton == 5) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
	} elseif ($radiobutton == 6) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
	}

	$edit_question = $conn->query("UPDATE mc_quiz_question SET mcqq_question = '$new_quiz_question', mcqq_updated_date = '$mcqq_updated_date' 
		WHERE mcqq_id = '$mcqq_id' AND mcqq_mc_quiz_id = '$mc_quiz_id'");

	$edit_question = $conn->query("UPDATE mc_quiz_question SET mcqq_question = '$new_quiz_question', mcqq_updated_date = '$mcqq_updated_date' 
		WHERE mcqq_id = '$mcqq_id' AND mcqq_mc_quiz_id = '$mc_quiz_id'");

	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE mc_quiz_answer SET mcqa_answer1 = '$new_answer1', mcqa_answer2 = '$new_answer2', mcqa_answer3 = '$new_answer3', 
			mcqa_answer4 = '$new_answer4', mcqa_right_answer = '$radiobutton', mcqa_right_answerword = '$word' 
			WHERE mcqa_id = '$mcqa_id' AND mcqa_mc_quiz_question_id = '$mcqq_id'");

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
/* ------------edit micro-credential quiz question----------*/



/* ------------delete micro-credential quiz question----------*/

if (isset($_GET['delete_quiz_question'])) {
	$delete_question = $_GET['delete_quiz_question'];
	$delete_answer = $_GET['question_answer'];

	$deleteAnswer = $conn->query("DELETE FROM mc_quiz_answer WHERE mcqa_id = '$delete_answer'");

	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM mc_quiz_question WHERE mcqq_id = '$delete_question'");

		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential quiz question----------*/

/* ------------add micro-credential test----------*/
if (isset($_POST['add_mc_test'])) {
	
	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mct_mc = $_POST['mc_id'];
	$mct_title = $_POST['mct_title'];
	$mct_instruction = mysqli_real_escape_string($conn, $_POST['mct_instruction']);
	$mct_duration = $_POST['mct_duration'];
	$mct_date_created = date('Y-m-d H:i:s');
	$mct_status = $_POST['mct_status'];
	$assessmenttype = "Test";

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmctest = $conn->query("INSERT INTO mc_test (mct_mc_id, mct_title, mct_instruction, mct_duration, mct_created_date, mct_created_by, mct_status) 
		values ('$mct_mc', '$mct_title', '$mct_instruction', '$mct_duration', '$mct_date_created', '$get_userID', '$mct_status')");

	if ($insertmctest) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Create micro-credential test is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential test----------*/

/* ------------edit micro-credential test----------*/
if (isset($_POST['edit_mct'])) {
	
	$mct_mc = $_POST['mc_id'];
	$mct_id = $_POST['mct_id'];
	$new_mct_title = $_POST['new_mct_title'];
	$new_mct_instruction = mysqli_real_escape_string($conn, $_POST['new_mct_instruction']);
	$new_mct_duration = $_POST['new_mct_duration'];
	$mct_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Test";

	$updatemctest = $conn->query("UPDATE mc_test SET mct_title = '$new_mct_title', mct_instruction = '$new_mct_instruction', mct_duration = '$new_mct_duration', mct_updated_date = '$mct_date_updated' 
	WHERE mct_id = '$mct_id' AND mct_mc_id = '$mct_mc'");

	if ($updatemctest) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('edit micro-credential test is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------edit micro-credential test----------*/


/* ------------publish micro-credential test----------*/
if (isset($_GET['publish_mct'])) {
	$mct_id = $_GET['publish_mct'];
	$assessmenttype = "Test";
	$mct_updated_date = date('Y-m-d H:i:s');

	$publishmct = $conn->query("UPDATE mc_test SET mct_status = 'Published', mct_updated_date = '$mct_updated_date' WHERE mct_id = '$mct_id' ");

	if ($publishmct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential test----------*/

/* ------------unpublish micro-credential test----------*/
if (isset($_GET['unpublish_mct'])) {
	$mct_id = $_GET['unpublish_mct'];
	$assessmenttype = "Test";
	$mct_updated_date = date('Y-m-d H:i:s');

	$unpublishmct = $conn->query("UPDATE mc_test SET mct_status = 'Save Only', mct_updated_date = '$mct_updated_date' WHERE mct_id = '$mct_id'");

	if ($unpublishmct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential test----------*/


/* ------------delete micro-credential test----------*/
if (isset($_GET['delete_mct'])) {
	$delete = $_GET['delete_mct'];
	$mc_id = $_GET['mc_id'];
	$assessmenttype = "Test";
	$mct_deleted_date = date('Y-m-d H:i:s');

	$delmct = $conn->query("DELETE FROM mc_test WHERE mct_mc_id = '$mc_id' AND mct_id = '$delete'");

	if ($delmct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete test is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential test----------*/


/* ------------add micro-credential test question----------*/
if (isset($_POST['add_test_question'])) {

	
	$mc_test_id = $_POST['mct_id'];
	$test_question = $_POST['mct_question'];
	$mct_question_type = $_POST['mct_question_type'];
	$mctq_created_date = date('Y-m-d H:i:s');

	if ($mct_question_type == "Multiple Choice")
	{
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	}
	elseif ($mct_question_type == "True/False")
	{
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);
		$answer3 = "";
		$answer4 = "";
		$radiobutton = $_POST['tf_answer'];
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
	}
	$add_question = $conn->query("INSERT INTO mc_test_question (mctq_mc_test_id, mctq_type, mctq_question, mctq_created_date) 
		VALUES ('$mc_test_id', '$mct_question_type', '$test_question', '$mctq_created_date')");

	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT mctq_id FROM mc_test_question WHERE mctq_mc_test_id = '$mc_test_id' AND mctq_question = '$test_question' AND mctq_created_date = '$mctq_created_date';");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_mctqid = $rowReadQuestion->mctq_id;

		$add_answer = $conn->query("INSERT INTO mc_test_answer (mcta_mc_test_question_id, mcta_answer1, mcta_answer2, mcta_answer3, mcta_answer4, mcta_right_answer, mcta_right_answerword) 
			VALUES ('$get_mctqid', '$answer1', '$answer2', '$answer3', '$answer4', '$radiobutton', '$word')");

		if ($add_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('insert question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential test question----------*/


/* ------------edit micro-credential test question----------*/
if (isset($_POST['edit_test_question'])) {
	
	$mc_test_id = $_POST['mct_id'];
	$mctq_id = $_POST['mctq_id'];
	$mcta_id = $_POST['mcta_id'];
	$new_test_question = $_POST['new_mct_question'];
	$mctq_updated_date = date('Y-m-d H:i:s');
	$mct_question_type = $_POST['mctq_type'];

	if ($mct_question_type == "Multiple Choice")
	{
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	}
	elseif ($mct_question_type == "True/False")
	{
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
		$new_answer3 = "";
		$new_answer4 = "";
		$radiobutton = $_POST['new_answertf'];
	}

	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
	} elseif ($radiobutton == 5) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
	} elseif ($radiobutton == 6) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
	}


	$edit_question = $conn->query("UPDATE mc_test_question SET mctq_question = '$new_test_question', mctq_updated_date = '$mctq_updated_date' 
		WHERE mctq_id = '$mctq_id' AND mctq_mc_test_id = '$mc_test_id'");

	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE mc_test_answer SET mcta_answer1 = '$new_answer1', mcta_answer2 = '$new_answer2', mcta_answer3 = '$new_answer3', 
			mcta_answer4 = '$new_answer4', mcta_right_answer = '$radiobutton', mcta_right_answerword = '$word' 
			WHERE mcta_id = '$mcta_id' AND mcta_mc_test_question_id = '$mctq_id'");

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
/* ------------edit micro-credential test question----------*/

/* ------------delete micro-credential test question----------*/

if (isset($_GET['delete_test_question'])) {
	$delete_question = $_GET['delete_test_question'];
	$delete_answer = $_GET['question_answer'];

	$deleteAnswer = $conn->query("DELETE FROM mc_test_answer WHERE mcta_id = '$delete_answer'");

	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM mc_test_question WHERE mctq_id = '$delete_question'");

		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential test question----------*/

/* ------------add micro-credential tutorial----------*/
if (isset($_POST['addmctu'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$mctu_mc = $_POST['mc_id'];
	$mctu_title = $_POST['mctu_title'];
	$mctu_description = mysqli_real_escape_string($conn, $_POST['mctu_desc']);
	$mctu_date_created = date('Y-m-d H:i:s');
	$mctu_status = $_POST['mctu_status'];
	$mctu_due_date = $_POST['mctu_due_date'];
	$mctu_due_time = $_POST['mctu_due_time'];
	$assessmenttype = "Tutorial";

	if ($_FILES['mctu_attachment']['name'] != NULL) {
		$mctu_attachment = str_replace("'", "", date('YmdHis') . $_FILES['mctu_attachment']['name']);
	} else {
		$mctu_attachment = "";
	}

	$folder1 = "../assets/attachment/microcredential/mctutorial/";
	move_uploaded_file($_FILES['mctu_attachment']['tmp_name'], $folder1 . $mctu_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertmctu = $conn->query("INSERT INTO mc_tutorial (mctu_mc_id, mctu_title, mctu_description, mctu_attachment, mctu_created_date, mctu_created_by, mctu_status) 
		   values ('$mctu_mc', '$mctu_title', '$mctu_description', '$mctu_attachment', '$mctu_date_created', '$get_userID', '$mctu_status')");

	if ($insertmctu) {

		$queryReadMCTU = $conn->query("SELECT mctu_id FROM mc_tutorial WHERE mctu_title = '$mctu_title' AND mctu_mc_id  = '$mctu_mc' AND mctu_created_date = '$mctu_date_created' AND mctu_created_by  = '$get_userID';");
		$rowReadMCTU = $queryReadMCTU->fetch_object();
		$get_mctuid = $rowReadMCTU->mctu_id;

		$insertduedate = $conn->query("INSERT INTO mc_tutorial_duedate (mctud_mc_tutorial_id, mctud_duedate_date, mctud_duedate_time)
			VALUES ('$get_mctuid', '$mctu_due_date', '$mctu_due_time')");

		if ($insertduedate) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
		}
		else
		{
			echo "<script>alert('Create micro-credential tutorial due date is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Create micro-credential tutorial is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add micro-credential tutorial----------*/

/* ------------update micro-credential tutorial----------*/
if (isset($_POST['edit_mctu'])) {
	
	$mc_id = $_POST['mc_id'];
	$mctu_id = $_POST['mctu_id'];
	$mctud_id = $_POST['mctud_id'];
	$new_mctu_title = $_POST['new_mctu_title'];
	$new_mctu_desc = mysqli_real_escape_string($conn, $_POST['new_mctu_desc']);
	$mctu_date_updated = date('Y-m-d H:i:s');
	$new_mctu_due_date = $_POST['new_mctu_due_date'];
	$new_mctu_due_time = $_POST['new_mctu_due_time'];
	$assessmenttype = "Tutorial";

	$dir = "../assets/attachment/microcredential/mctutorial/";
	if ($_FILES["mctu_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["mctu_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT mctu_attachment FROM mc_tutorial WHERE mctu_id = '$mctu_id' AND mctu_mc_id = '$mc_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->mctu_attachment != NULL) {
			unlink($dir . $checkattachRow->mctu_attachment);
			move_uploaded_file($_FILES['mctu_attachment']['tmp_name'], $file);

			$editmctu = $conn->query("UPDATE mc_tutorial SET mctu_title = '$new_mctu_title', mctu_description = '$new_mctu_desc', mctu_attachment = '$newattach', mctu_updated_date = '$mctu_date_updated' 
			WHERE mctu_id = '$mctu_id' AND mctu_mc_id = '$mc_id'");

			if ($editmctu) {

				$editmctud = $conn->query("UPDATE mc_tutorial_duedate SET mctud_duedate_date = '$new_mctu_due_date', mctud_duedate_time = '$new_mctu_due_time' 
				WHERE mctud_id = '$mctud_id' AND mctud_mc_tutorial_id = '$mctu_id'");

				if ($editmctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				}

				else {
					echo "<script>alert('Update due date for micro-credential tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
	
			} else {
				echo "<script>alert('Upload new attachment for micro-credential tutorial is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mctu_attachment']['tmp_name'], $file);

			$editmctu = $conn->query("UPDATE mc_tutorial SET mctu_title = '$new_mctu_title', mctu_description = '$new_mctu_desc', mctu_attachment = '$newattach', mctu_updated_date = '$mctu_date_updated' 
			WHERE mctu_id = '$mctu_id' AND mctu_mc_id = '$mc_id'");

			if ($editmctu) 
			{
				$editmctud = $conn->query("UPDATE mc_tutorial_duedate SET mctud_duedate_date = '$new_mctu_due_date', mctud_duedate_time = '$new_mctu_due_time' 
				WHERE mctud_id = '$mctud_id' AND mctud_mc_tutorial_id = '$mctu_id'");

				if ($editmctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				}

				else {
					echo "<script>alert('Update due date for micro-credential tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('Upload new attachment for micro-credential slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmctu = $conn->query("UPDATE mc_tutorial SET mctu_title = '$new_mctu_title', mctu_description = '$new_mctu_desc', mctu_updated_date = '$mctu_date_updated' 
			WHERE mctu_id = '$mctu_id' AND mctu_mc_id = '$mc_id'");

		if ($editmctu) {
			$editmctud = $conn->query("UPDATE mc_tutorial_duedate SET mctud_duedate_date = '$new_mctu_due_date', mctud_duedate_time = '$new_mctu_due_time' 
				WHERE mctud_id = '$mctud_id' AND mctud_mc_tutorial_id = '$mctu_id'");

				if ($editmctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				}

				else {
					echo "<script>alert('Update due date for micro-credential tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
		} else {
			echo "<script>alert('Update micro-credential is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update micro-credential tutorial----------*/

/* ------------delete micro-credential tutorial----------*/
if (isset($_GET['delete_mctu'])) {
	$delete = $_GET['delete_mctu'];
	$mc_id = $_GET['mcid'];
	$assessmenttype = "Tutorial";

	$delmctu = $conn->query("DELETE FROM mc_tutorial WHERE mctu_id = '$delete' AND mctu_mc_id = '$mc_id'");

	if ($delmctu) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete micro-credential tutorial is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete micro-credential tutorial----------*/

/* ------------publish micro-credential tutorial----------*/
if (isset($_GET['publish_mctu'])) {
	$mctu_id = $_GET['publish_mctu'];
	$update_date = date('Y-m-d H:i:s');
	$assessmenttype = "Tutorial";

	$publishmctu = $conn->query("UPDATE mc_tutorial SET mctu_status = 'Published' WHERE mctu_id = '$mctu_id'");

	if ($publishmctu) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish micro-credential tutorial----------*/

/* ------------unpublish micro-credential tutorial----------*/
if (isset($_GET['unpublish_mctu'])) {
	$mctu_id = $_GET['unpublish_mctu'];
	$update_date = date('Y-m-d H:i:s');
	$assessmenttype = "Tutorial";

	$unpublishmctu = $conn->query("UPDATE mc_tutorial SET mctu_status = 'Save Only' WHERE mctu_id = '$mctu_id'");

	if ($unpublishmctu) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish micro-credential tutorial----------*/

/* ------------add course----------*/
if (isset($_POST['add_course'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];

	$course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
	$course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
	$course_level = implode(", ", $_POST['course_level']);
	$course_description = mysqli_real_escape_string($conn, $_POST['course_desc']);
	$course_category = mysqli_real_escape_string($conn, $_POST['course_category']);

	$course_date_enrollment = mysqli_real_escape_string($conn, $_POST['offerdate']);
	$course_start_date = mysqli_real_escape_string($conn, $_POST['course_start_date']);
	$course_end_date = mysqli_real_escape_string($conn, $_POST['course_end_date']);
	$fee = $_POST['course_fee'];
	$course_fee = floatval($fee*100);
	$course_duration = mysqli_real_escape_string($conn, $_POST['course_duration']);

	$course_date_created = date('Y-m-d H:i:s');

	$course_lo = mysqli_real_escape_string($conn, $_POST['course_lo']);
	$course_il = mysqli_real_escape_string($conn, $_POST['course_il']);
	$course_prerequisites = mysqli_real_escape_string($conn, $_POST['course_prerequisites']);
	$course_skills = mysqli_real_escape_string($conn, $_POST['course_skills']);

	if ($_FILES['coursecoverimg']['name'] != NULL) {
		$course_coverimg = str_replace("'", "", date('YmdHis') . $_FILES['coursecoverimg']['name']);
	} else {
		$course_coverimg = "";
	}

	$folder1 = "../assets/images/course/";
	move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $folder1 . $course_coverimg);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;


	$insertcourse = $conn->query("INSERT INTO course (course_title, course_code, course_description, course_category, course_level, course_duration, course_fee, course_created_by, course_owner, course_created_date, course_image, course_status, course_enrollment_date) 
		values ('$course_title', '$course_code', '$course_description', '$course_category', '" . $course_level . "', '$course_duration', '$course_fee', '$get_userID', '$get_userID', '$course_date_created', '$course_coverimg', 'Draft', '$course_date_enrollment')");

	if ($insertcourse) {
		if ($course_date_enrollment == 'choosedate') {

			$queryReadCourse = $conn->query("SELECT course_id FROM course WHERE course_title = '$course_title' AND course_code = '$course_code' AND course_created_date = '$course_date_created' AND course_created_by = '$get_userID';");
			$rowReadCourse = $queryReadCourse->fetch_object();
			$get_courseid = $rowReadCourse->course_id;

			$add_course_details = $conn->query("INSERT INTO course_learning_details (cld_course_id, cld_learning_outcome, cld_intended_learners, cld_prerequisites, cld_skills) 
				VALUES ('$get_courseid', '$course_lo', '$course_il', '$course_prerequisites', '$course_skills')");


			if ($add_course_details) {
				$add_course_enrolment_date = $conn->query("INSERT INTO course_enrolment_session (ces_course_id, ces_start_date, ces_end_date) 
				VALUES ('$get_courseid', '$course_start_date', '$course_end_date')");

				if ($add_course_enrolment_date) {
					echo ("<script>window.location.href ='pages-course-list.php'</script>");
				} else {
					echo "<script>alert('insert course enrolment date is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('insert course learning details is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			$queryReadCourse = $conn->query("SELECT course_id FROM course WHERE course_title = '$course_title' AND course_code = '$course_code' AND course_created_date = '$course_date_created' AND course_created_by = '$get_userID';");
			$rowReadCourse = $queryReadCourse->fetch_object();
			$get_courseid = $rowReadCourse->course_id;

			$add_course_details = $conn->query("INSERT INTO course_learning_details (cld_course_id, cld_learning_outcome, cld_intended_learners, cld_prerequisites, cld_skills) 
				VALUES ('$get_courseid', '$course_lo', '$course_il', '$course_prerequisites', '$course_skills')");

			if ($add_course_details) {
				echo ("<script>window.location.href ='pages-course-list.php'</script>");
			} else {
				echo "<script>alert('insert course learning details is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		echo "<script>alert('Create course is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------add course----------*/

/* ------------update course----------*/
if (isset($_POST['edit_course'])) {

	$course_id = $_POST['course_id'];
	$new_course_name = $_POST['new_course_name'];
	$new_course_code = mysqli_real_escape_string($conn, $_POST['new_course_code']);
	$new_course_level = implode(", ", $_POST['new_course_level']);
	$new_course_desc = mysqli_real_escape_string($conn, $_POST['new_course_desc']);
	$new_course_category = mysqli_real_escape_string($conn, $_POST['new_course_category']);
	$fee = $_POST['new_course_fee'];
	$new_course_fee = floatval($fee*100);
	$new_course_duration = mysqli_real_escape_string($conn, $_POST['new_course_duration']);

	$course_date_updated = date('Y-m-d H:i:s');

	$dir = "../assets/images/course/";
	if ($_FILES["coursecoverimg"]["name"] != NULL) {
		$newfileimg = str_replace("'", "", date('YmdHis') . $_FILES["coursecoverimg"]["name"]);
	} else {
		$newfileimg = "";
	}
	$file = $dir . $newfileimg;

	if ($newfileimg != NULL) {
		$checkimgfile = $conn->query("SELECT course_image FROM course WHERE course_id  = '$course_id'");

		$checkimgRow = mysqli_fetch_object($checkimgfile);

		if ($checkimgRow->course_image != NULL) {
			unlink($dir . $checkimgRow->course_image);
			move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $file);

			$editcourse = $conn->query("UPDATE course SET course_title = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_desc', course_category = '$new_course_category', course_level = '" . $new_course_level . "', course_duration = '$new_course_duration', course_fee = '$new_course_fee', course_image = '$newfileimg' WHERE course_id  = '$course_id '");

			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $file);

			$editcourse = $conn->query("UPDATE course SET course_title = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_desc', course_category = '$new_course_category', course_level = '" . $new_course_level . "', course_duration = '$new_course_duration', course_fee = '$new_course_fee', course_image = '$newfileimg' WHERE course_id  = '$course_id '");

			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcourse = $conn->query("UPDATE course SET course_title = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_desc', course_category = '$new_course_category', course_level = '" . $new_course_level . "', course_duration = '$new_course_duration', course_fee = '$new_course_fee' WHERE course_id  = '$course_id '");

		if ($editcourse) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update course ----------*/

/* ------------delete course----------*/
if (isset($_GET['delete_course'])) {
	$delete = $_GET['delete_course'];

	$delcourse = $conn->query("DELETE FROM course where course_id = '$delete'");

	if ($delcourse) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Delete course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course ----------*/

/* ------------publish course----------*/
if (isset($_GET['publish_course'])) {
	$course_id = $_GET['publish_course'];
	$status = "Published";
	$course_date_published = date('Y-m-d H:i:s');

	$publishcourse =  $conn->query("UPDATE course SET course_published_date = '$course_date_published', course_status = '$status' WHERE course_id = '$course_id'");

	if ($publishcourse) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Publish course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course ----------*/

/* ------------unpublish course----------*/
if (isset($_GET['unpublish_course'])) {
	$course_id = $_GET['unpublish_course'];
	$status = "Draft";

	$unpublishcourse =  $conn->query("UPDATE course SET course_status = '$status', course_published_date=(NULL) WHERE course_id = '$course_id'");

	if ($unpublishcourse) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Publish course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course ----------*/

/* ------------add course enrolment date----------*/
if (isset($_POST['add_course_enrolment_date'])) {
	$course_id	= $_POST['course_id'];
	$course_start_date = mysqli_real_escape_string($conn, $_POST['course_start_date']);
	$course_end_date = mysqli_real_escape_string($conn, $_POST['course_end_date']);

	$add_course_enrolment_date = $conn->query("INSERT INTO course_enrolment_session (ces_course_id, ces_start_date, ces_end_date) 
	VALUES ('$course_id', '$course_start_date', '$course_end_date')");

	if ($add_course_enrolment_date) {

		$updateenrolmentdatecourse = $conn->query("UPDATE course SET course_enrollment_date = 'choosedate' WHERE course_id = '$course_id '");

		if ($updateenrolmentdatecourse) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Add course enrolment date is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course enrolment date----------*/

/* ------------edit course enrolment date----------*/
if (isset($_POST['edit_course_enrolment_date'])) {
	$course_id	= $_POST['course_id'];
	$ces_id = $_POST['ces_id'];
	$new_offerdate = mysqli_real_escape_string($conn, $_POST['new_offerdate']);
	$new_course_start_date = mysqli_real_escape_string($conn, $_POST['new_course_start_date']);
	$new_course_end_date = mysqli_real_escape_string($conn, $_POST['new_course_end_date']);

	if ($new_offerdate == 'anytime') {

		$editcoursedateEnrol = $conn->query("UPDATE course SET course_enrollment_date = '$new_offerdate' WHERE course_id = '$course_id'");

		if ($editcoursedateEnrol) {
			$deletedateEnrolment = $conn->query("DELETE FROM course_enrolment_session WHERE ces_course_id = '$course_id' AND ces_id = '$ces_id'");

			if ($deletedateEnrolment) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Delete enrolment date is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Update enrolment date is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		$editdateenrolment = $conn->query("UPDATE course_enrolment_session SET ces_start_date = '$new_course_start_date', ces_end_date = '$new_course_end_date' WHERE ces_course_id = '$course_id' AND ces_id = '$ces_id'");

		if ($editdateenrolment) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update course enrolment date is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------edit course enrolment date----------*/

/* ------------update course learning details----------*/
if (isset($_POST['edit_cld'])) {

	$course_id	= $_POST['course_id'];
	$cld_id = $_POST['cld_id'];
	$new_course_lo = mysqli_real_escape_string($conn, $_POST['new_course_lo']);
	$new_course_il = mysqli_real_escape_string($conn, $_POST['new_course_il']);
	$new_course_prerequisites = mysqli_real_escape_string($conn, $_POST['new_course_prerequisites']);
	$new_course_skills = mysqli_real_escape_string($conn, $_POST['new_course_skills']);

	$editcld = $conn->query("UPDATE course_learning_details SET cld_learning_outcome = '$new_course_lo', cld_intended_learners = '$new_course_il', cld_prerequisites =  '$new_course_prerequisites', cld_skills = '$new_course_skills'  
	WHERE cld_course_id = '$course_id' AND cld_id = '$cld_id'");

	if ($editcld) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Update course learning details is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------update course learning details----------*/


/* ------------add course notes----------*/
if (isset($_POST['add_course_note'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$cn_title = $_POST['cn_title'];
	$cn_description = mysqli_real_escape_string($conn, $_POST['cn_desc']);
	$cn_date_created = date('Y-m-d H:i:s');
	$cn_status = $_POST['cn_status'];
	$contenttype = "Notes";

	if ($_FILES['cn_attachment']['name'] != NULL) {
		$cn_attachment = str_replace("'", "", date('YmdHis') . $_FILES['cn_attachment']['name']);
	} else {
		$cn_attachment = "";
	}

	$folder1 = "../assets/attachment/course/coursenote/";
	move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $folder1 . $cn_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcoursenote = $conn->query("INSERT INTO course_notes (cn_course_id, cn_title, cn_description, cn_attachment, cn_created_date, cn_created_by, cn_status) 
		   values ('$course_id', '$cn_title', '$cn_description', '$cn_attachment', '$cn_date_created', '$get_userID', '$cn_status')");

	if ($insertcoursenote) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create course notes is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course notes----------*/

/* ------------update course notes----------*/
if (isset($_POST['edit_cn'])) {

	$course_id = $_POST['course_id'];
	$cn_id = $_POST['cn_id'];
	$new_cn_title = $_POST['new_cn_title'];
	$new_cn_desc = mysqli_real_escape_string($conn, $_POST['new_cn_desc']);
	$contenttype = "Notes";

	$dir = "../assets/attachment/course/coursenote/";
	if ($_FILES["cn_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["cn_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT cn_attachment FROM course_notes WHERE cn_id = '$cn_id' AND cn_course_id = '$course_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->cn_attachment != NULL) {
			unlink($dir . $checkattachRow->cn_attachment);
			move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $file);

			$editcn = $conn->query("UPDATE course_notes SET cn_title = '$new_cn_title', cn_description = '$new_cn_desc', cn_attachment = '$newattach' WHERE cn_id = '$cn_id' AND cn_course_id = '$course_id'");

			if ($editcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $file);

			$editcn = $conn->query("UPDATE course_notes SET cn_title = '$new_cn_title', cn_description = '$new_cn_desc', cn_attachment = '$newattach' WHERE cn_id = '$cn_id' AND cn_course_id = '$course_id'");

			if ($editcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcn = $conn->query("UPDATE course_notes SET cn_title = '$new_cn_title', cn_description = '$new_cn_desc' WHERE cn_id = '$cn_id' AND cn_course_id = '$course_id'");

		if ($editcn) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update course notes----------*/

/* ------------delete course notes----------*/
if (isset($_GET['delete_cn'])) {
	$delete = $_GET['delete_cn'];
	$course_id = $_GET['cid'];
	$contenttype = "Notes";

	$delcoursenote = $conn->query("DELETE FROM course_notes WHERE cn_id = '$delete' AND cn_course_id = '$course_id'");

	if ($delcoursenote) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete notes is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course notes----------*/

/* ------------publish course notes----------*/
if (isset($_GET['publish_cn'])) {
	$cn_id = $_GET['publish_cn'];
	$update_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$publishcn = $conn->query("UPDATE course_notes SET cn_status = 'Published' WHERE cn_id = '$cn_id'");

	if ($publishcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course notes----------*/

/* ------------unpublish course notes----------*/
if (isset($_GET['unpublish_cn'])) {
	$cn_id = $_GET['unpublish_cn'];
	$contenttype = "Notes";

	$unpublishcn = $conn->query("UPDATE course_notes SET cn_status = 'Save Only' WHERE cn_id = '$cn_id'");

	if ($unpublishcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course notes----------*/

/* ------------add course video----------*/
if (isset($_POST['add_course_video'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$cv_title = $_POST['cv_title'];
	$cv_desc = mysqli_real_escape_string($conn, $_POST['cv_desc']);
	$cv_date_created = date('Y-m-d H:i:s');
	$cv_status = $_POST['cv_status'];
	$contenttype = "Video";

	if ($_FILES['cv_attachment']['name'] != NULL) {
		$cv_attachment = str_replace("'", "", date('YmdHis') . $_FILES['cv_attachment']['name']);
	} else {
		$cv_attachment = "";
	}

	$folder1 = "../assets/attachment/course/coursevideo/";
	move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $folder1 . $cv_attachment);
	$getID3 = new getID3();
	$filename = "../assets/attachment/course/coursevideo/".$cv_attachment;
	$fileinfo = $getID3->analyze($filename);
	$duration = $fileinfo['playtime_string'];
	$dur = duration($duration);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcv = $conn->query("INSERT INTO course_video (cv_course_id, cv_title, cv_description, cv_attachment, cv_duration, cv_created_date, cv_created_by, cv_status) 
		values ('$course_id', '$cv_title', '$cv_desc', '$cv_attachment', '$dur', '$cv_date_created', '$get_userID', '$cv_status')");

	if ($insertcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create course video is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course video----------*/

/* ------------update course video----------*/
if (isset($_POST['edit_cv'])) {

	$course_id = $_POST['course_id'];
	$cv_id = $_POST['cv_id'];
	$new_cv_title = $_POST['new_cv_title'];
	$new_cv_desc = mysqli_real_escape_string($conn, $_POST['new_cv_desc']);
	$contenttype = "Video";

	$cv_date_updated = date('Y-m-d H:i:s');

	$dir = "../assets/attachment/course/coursevideo/";
	if ($_FILES["cv_attachment"]["name"] != NULL) {
		$newattachvid = str_replace("'", "", date('YmdHis') . $_FILES["cv_attachment"]["name"]);
	} else {
		$newattachvid = "";
	}
	$file = $dir . $newattachvid;

	if ($newattachvid != NULL) {
		$checkattachvid = $conn->query("SELECT cv_attachment FROM course_video WHERE cv_id = '$cv_id' AND cv_course_id = '$course_id'");

		$checkattachvidRow = mysqli_fetch_object($checkattachvid);

		if ($checkattachvidRow->cv_attachment != NULL) {
			unlink($dir . $checkattachvidRow->cv_attachment);
			move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file);
			$getID3 = new getID3();
			$filename = $file;
			$fileinfo = $getID3->analyze($filename);
			$duration = $fileinfo['playtime_string'];
			$dur = duration($duration);

			$editcv = $conn->query("UPDATE course_video SET cv_title = '$new_cv_title', cv_description = '$new_cv_desc', cv_attachment = '$newattachvid', cv_duration = '$dur' WHERE cv_id = '$cv_id' AND cv_course_id = '$course_id'");

			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file);

			$editcv = $conn->query("UPDATE course_video SET cv_title = '$new_cv_title', cv_description = '$new_cv_desc', cv_attachment = '$newattachvid', cv_duration = '$dur' WHERE cv_id = '$cv_id' AND cv_course_id = '$course_id'");

			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcv =  $conn->query("UPDATE course_video SET cv_title = '$new_cv_title', cv_description = '$new_cv_desc' WHERE cv_id = '$cv_id' AND cv_course_id = '$course_id'");

		if ($editcv) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update course video is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update course video----------*/

/* ------------delete course video----------*/
if (isset($_GET['delete_cv'])) {
	$delete = $_GET['delete_cv'];
	$course_id = $_GET['cid'];
	$contenttype = "Video";

	$delcvid = $conn->query("DELETE FROM course_video WHERE cv_id = '$delete' AND cv_course_id = '$course_id'");

	if ($delcvid) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course video----------*/

/* ------------publish course video----------*/
if (isset($_GET['publish_cv'])) {
	$cv_id = $_GET['publish_cv'];

	$contenttype = "Video";

	$publishcv = $conn->query("UPDATE course_video SET cv_status = 'Published' WHERE cv_id = '$cv_id' ");

	if ($publishcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course video----------*/

/* ------------unpublish course video----------*/
if (isset($_GET['unpublish_cv'])) {
	$cv_id = $_GET['unpublish_cv'];

	$contenttype = "Video";

	$unpublishcv = $conn->query("UPDATE course_video SET cv_status = 'Save Only' WHERE cv_id = '$cv_id'");

	if ($unpublishcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course video----------*/


/* ------------add course slide----------*/
if (isset($_POST['add_cs'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$cs_title = $_POST['cs_title'];
	$cs_desc = mysqli_real_escape_string($conn, $_POST['cs_desc']);
	$cs_date_created = date('Y-m-d H:i:s');
	$cs_status = $_POST['cs_status'];
	$contenttype = "Slide";

	if ($_FILES['cs_attachment']['name'] != NULL) {
		$cs_attachment = str_replace("'", "", date('YmdHis') . $_FILES['cs_attachment']['name']);
	} else {
		$cs_attachment = "";
	}

	$folder1 = "../assets/attachment/course/courseslide/";
	move_uploaded_file($_FILES['cs_attachment']['tmp_name'], $folder1 . $cs_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcourseslide = $conn->query("INSERT INTO course_slide (cs_course_id, cs_title, cs_description, cs_attachment, cs_created_date, cs_created_by, cs_status) 
		   values ('$course_id', '$cs_title', '$cs_desc', '$cs_attachment', '$cs_date_created', '$get_userID', '$cs_status')");

	if ($insertcourseslide) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create course slide is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course slide----------*/

/* ------------update course slide----------*/
if (isset($_POST['edit_cs'])) {

	$course_id = $_POST['course_id'];
	$cs_id = $_POST['cs_id'];
	$new_cs_title = $_POST['new_cs_title'];
	$new_cs_desc = mysqli_real_escape_string($conn, $_POST['new_cs_desc']);
	$contenttype = "Slide";

	$dir = "../assets/attachment/course/courseslide/";
	if ($_FILES["cs_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["cs_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT cs_attachment FROM course_slide WHERE cs_id = '$cs_id' AND cs_course_id = '$course_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->cs_attachment != NULL) {
			unlink($dir . $checkattachRow->cs_attachment);
			move_uploaded_file($_FILES['cs_attachment']['tmp_name'], $file);

			$editcs = $conn->query("UPDATE course_slide SET cs_title = '$new_cs_title', cs_description = '$new_cs_desc', cs_attachment = '$newattach'
			WHERE cs_id = '$cs_id' AND cs_course_id = '$course_id'");

			if ($editcs) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['cs_attachment']['tmp_name'], $file);

			$editcs = $conn->query("UPDATE course_slide SET cs_title = '$new_cs_title', cs_description = '$new_cs_desc', cs_attachment = '$newattach'
			WHERE cs_id = '$cs_id' AND cs_course_id = '$course_id'");

			if ($editcs) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcs = $conn->query("UPDATE course_slide SET cs_title = '$new_cs_title', cs_description = '$new_cs_desc'
			WHERE cs_id = '$cs_id' AND cs_course_id = '$course_id'");

		if ($editcs) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['content_type'] = $contenttype;
		} else {
			echo "<script>alert('Update course slide is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update course slide----------*/

/* ------------delete course slide----------*/
if (isset($_GET['delete_cs'])) {
	$delete = $_GET['delete_cs'];
	$course_id = $_GET['cid'];

	$contenttype = "Slide";

	$delcourseslide = $conn->query("DELETE FROM course_slide WHERE cs_id = '$delete' AND cs_course_id = '$course_id'");

	if ($delcourseslide) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Delete slide is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course slide----------*/

/* ------------publish course slide----------*/
if (isset($_GET['publish_cs'])) {
	$cs_id = $_GET['publish_cs'];

	$contenttype = "Slide";

	$publishcs = $conn->query("UPDATE course_slide SET cs_status = 'Published' WHERE cs_id = '$cs_id'");

	if ($publishcs) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course slide----------*/

/* ------------unpublish course slide----------*/
if (isset($_GET['unpublish_cs'])) {
	$cs_id = $_GET['unpublish_cs'];

	$contenttype = "Slide";

	$unpublishcs = $conn->query("UPDATE course_slide SET cs_status = 'Save Only' WHERE cs_id = '$cs_id'");

	if ($unpublishcs) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course slide----------*/


/* ------------add course quiz----------*/
if (isset($_POST['add_course_quiz'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$cq_title = $_POST['cq_title'];
	$cq_instruction = mysqli_real_escape_string($conn, $_POST['cq_instruction']);
	$cq_duration = $_POST['cq_duration'];

	$cq_date_created = date('Y-m-d H:i:s');
	$cq_status = $_POST['cq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcoursequiz = $conn->query("INSERT INTO course_quiz (cq_course_id, cq_title, cq_instruction, cq_duration, cq_created_date, cq_created_by, cq_status) 
		values ('$course_id', '$cq_title', '$cq_instruction', '$cq_duration', '$cq_date_created', '$get_userID', '$cq_status')");

	if ($insertcoursequiz) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Create course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course quiz----------*/

/* ------------edit course quiz----------*/
if (isset($_POST['edit_cq'])) {


	$course_id = $_POST['course_id'];
	$cq_id = $_POST['cq_id'];
	$new_cq_title = $_POST['new_cq_title'];
	$new_cq_instruction = mysqli_real_escape_string($conn, $_POST['new_cq_instruction']);
	$new_cq_duration = $_POST['new_cq_duration'];
	$cq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Quiz";

	$updatecoursequiz = $conn->query("UPDATE course_quiz SET cq_title = '$new_cq_title', cq_instruction = '$new_cq_instruction', cq_duration = '$new_cq_duration' WHERE cq_id = '$cq_id' AND cq_course_id  = '$course_id'");

	if ($updatecoursequiz) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('edit course quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit course quiz----------*/

/* ------------publish course quiz----------*/
if (isset($_GET['publish_cq'])) {
	$cq_id = $_GET['publish_cq'];
	$assessmenttype = "Quiz";
	$cq_updated_date = date('Y-m-d H:i:s');

	$publishcq = $conn->query("UPDATE course_quiz SET cq_status = 'Published' WHERE cq_id = '$cq_id' ");

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
if (isset($_GET['unpublish_cq'])) {
	$cq_id = $_GET['unpublish_cq'];
	$assessmenttype = "Quiz";

	$unpublishcq = $conn->query("UPDATE course_quiz SET cq_status = 'Save Only' WHERE cq_id = '$cq_id'");

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
if (isset($_GET['delete_cq'])) {
	$delete = $_GET['delete_cq'];
	$course_id = $_GET['cid'];
	$assessmenttype = "Quiz";

	$delcq = $conn->query("DELETE FROM course_quiz WHERE cq_id = '$delete' AND cq_course_id = '$course_id'");

	if ($delcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course quiz----------*/


/* ------------add course test----------*/
if (isset($_POST['add_course_test'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$ct_title = $_POST['ct_title'];
	$ct_instruction = mysqli_real_escape_string($conn, $_POST['ct_instruction']);
	$ct_duration = $_POST['ct_duration'];
	$ct_date_created = date('Y-m-d H:i:s');
	$ct_status = $_POST['ct_status'];
	$assessmenttype = "Test";

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcoursetest = $conn->query("INSERT INTO course_test (ct_course_id, ct_title, ct_instruction, ct_duration,ct_created_date, ct_created_by, ct_status) 
		values ('$course_id', '$ct_title', '$ct_instruction', '$ct_duration', '$ct_date_created', '$get_userID', '$ct_status')");

	if ($insertcoursetest) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Create course test is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course test----------*/

/* ------------edit course test----------*/
if (isset($_POST['edit_ct'])) {

	$course_id = $_POST['course_id'];
	$ct_id = $_POST['ct_id'];
	$new_ct_title = $_POST['new_ct_title'];
	$new_ct_instruction = mysqli_real_escape_string($conn, $_POST['new_ct_instruction']);
	$new_ct_duration = $_POST['new_ct_duration'];

	$assessmenttype = "Test";

	$updatecoursetest = $conn->query("UPDATE course_test SET ct_title = '$new_ct_title', ct_instruction = '$new_ct_instruction', ct_duration = '$new_ct_duration' 
	WHERE ct_id = '$ct_id' AND ct_course_id = '$course_id'");

	if ($updatecoursetest) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('edit course test is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------edit course test----------*/

/* ------------publish course test----------*/
if (isset($_GET['publish_ct'])) {
	$ct_id = $_GET['publish_ct'];
	$assessmenttype = "Test";

	$publishct = $conn->query("UPDATE course_test SET ct_status = 'Published' WHERE ct_id = '$ct_id' ");

	if ($publishct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course test----------*/

/* ------------unpublish course test----------*/
if (isset($_GET['unpublish_ct'])) {
	$ct_id = $_GET['unpublish_ct'];
	$assessmenttype = "Test";

	$unpublishct = $conn->query("UPDATE course_test SET ct_status = 'Save Only' WHERE ct_id = '$ct_id'");

	if ($unpublishct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course test----------*/

/* ------------delete course test----------*/
if (isset($_GET['delete_ct'])) {
	$delete = $_GET['delete_ct'];
	$course_id = $_GET['cid'];
	$assessmenttype = "Test";

	$delct = $conn->query("DELETE FROM course_test WHERE ct_id  = '$delete' AND ct_course_id = '$course_id'");

	if ($delct) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete test is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course test----------*/

/* ------------add course tutorial----------*/
if (isset($_POST['add_course_tutorial'])) {

	$lecturer_id = $_SESSION['sess_lecturerid'];
	$course_id = $_POST['course_id'];
	$ctu_title = $_POST['ctu_title'];
	$ctu_description = mysqli_real_escape_string($conn, $_POST['ctu_desc']);
	$ctu_date_created = date('Y-m-d H:i:s');
	$ctu_status = $_POST['ctu_status'];
	$ctu_due_date = $_POST['ctu_due_date'];
	$ctu_due_time = $_POST['ctu_due_time'];
	$assessmenttype = "Tutorial";

	if ($_FILES['ctu_attachment']['name'] != NULL) {
		$ctu_attachment = str_replace("'", "", date('YmdHis') . $_FILES['ctu_attachment']['name']);
	} else {
		$ctu_attachment = "";
	}

	$folder1 = "../assets/attachment/course/coursetutorial/";
	move_uploaded_file($_FILES['ctu_attachment']['tmp_name'], $folder1 . $ctu_attachment);

	$checkuserrow = $conn->query("SELECT lecturer_user_id FROM lecturer WHERE lecturer_id = '$lecturer_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->lecturer_user_id;

	$insertcoursetu = $conn->query("INSERT INTO course_tutorial (ctu_course_id, ctu_title, ctu_description, ctu_attachment, ctu_created_date, ctu_created_by, ctu_status) 
		   values ('$course_id', '$ctu_title', '$ctu_description', '$ctu_attachment', '$ctu_date_created', '$get_userID', '$ctu_status')");

	if ($insertcoursetu) {

		$queryReadcoursetu = $conn->query("SELECT ctu_id FROM course_tutorial WHERE ctu_title = '$ctu_title' AND ctu_course_id = '$course_id' AND ctu_created_date = '$ctu_date_created' AND ctu_created_by = '$get_userID';");
		$rowReadctu = $queryReadcoursetu->fetch_object();
		$get_ctuid = $rowReadctu->ctu_id;

		$insertduedate = $conn->query("INSERT INTO course_tutorial_duedate (ctud_course_tutorial_id, ctud_duedate_date, ctud_duedate_time)
			VALUES ('$get_ctuid', '$ctu_due_date', '$ctu_due_time')");

		if ($insertduedate) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['assessment_type'] = $assessmenttype;
		} else {
			echo "<script>alert('Create course tutorial due date is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Create course tutorial is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course tutorial----------*/

/* ------------update course tutorial----------*/
if (isset($_POST['edit_ctu'])) {

	$course_id = $_POST['course_id'];
	$ctu_id = $_POST['ctu_id'];
	$ctud_id = $_POST['ctud_id'];
	$new_ctu_title = $_POST['new_ctu_title'];
	$new_ctu_desc = mysqli_real_escape_string($conn, $_POST['new_ctu_desc']);
	$ctu_date_updated = date('Y-m-d H:i:s');
	$new_ctu_due_date = $_POST['new_ctu_due_date'];
	$new_ctu_due_time = $_POST['new_ctu_due_time'];
	$assessmenttype = "Tutorial";

	$dir = "../assets/attachment/course/coursetutorial/";
	if ($_FILES["ctu_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["ctu_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;

	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT ctu_attachment FROM course_tutorial WHERE ctu_id = '$ctu_id' AND ctu_course_id = '$course_id'");

		$checkattachRow = mysqli_fetch_object($checkattachfile);

		if ($checkattachRow->ctu_attachment != NULL) {
			unlink($dir . $checkattachRow->ctu_attachment);
			move_uploaded_file($_FILES['ctu_attachment']['tmp_name'], $file);

			$editctu = $conn->query("UPDATE course_tutorial SET ctu_title = '$new_ctu_title', ctu_description = '$new_ctu_desc', ctu_attachment = '$newattach'
			WHERE ctu_id = '$ctu_id' AND ctu_course_id = '$course_id'");

			if ($editctu) {

				$editctud = $conn->query("UPDATE course_tutorial_duedate SET ctud_duedate_date = '$new_ctu_due_date', ctud_duedate_time = '$new_ctu_due_time' 
				WHERE ctud_id = '$ctud_id' AND ctud_course_tutorial_id = '$ctu_id'");

				if ($editctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				} else {
					echo "<script>alert('Update due date for course tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('Upload new attachment for course tutorial is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['ctu_attachment']['tmp_name'], $file);

			$editctu = $conn->query("UPDATE course_tutorial SET ctu_title = '$new_ctu_title', ctu_description = '$new_ctu_desc', ctu_attachment = '$newattach'
			WHERE ctu_id = '$ctu_id' AND ctu_course_id = '$course_id'");

			if ($editctu) {
				$editctud = $conn->query("UPDATE course_tutorial_duedate SET ctud_duedate_date = '$new_ctu_due_date', ctud_duedate_time = '$new_ctu_due_time' 
				WHERE ctud_id = '$ctud_id' AND ctud_course_tutorial_id = '$ctu_id'");

				if ($editctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				} else {
					echo "<script>alert('Update due date for course tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('Upload new attachment for course slide is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editctu = $conn->query("UPDATE course_tutorial SET ctu_title = '$new_ctu_title', ctu_description = '$new_ctu_desc', ctu_updated_date = '$ctu_date_updated' 
			WHERE ctu_id = '$ctu_id' AND ctu_course_id = '$course_id'");

		if ($editctu) {
			$editctud = $conn->query("UPDATE course_tutorial_duedate SET ctud_duedate_date = '$new_ctu_due_date', ctud_duedate_time = '$new_ctu_due_time' 
				WHERE ctud_id = '$ctud_id' AND ctud_course_tutorial_id = '$ctu_id'");

			if ($editctud) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['assessment_type'] = $assessmenttype;
			} else {
				echo "<script>alert('Update due date for course tutorial is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update course tutorial----------*/

/* ------------delete course tutorial----------*/
if (isset($_GET['delete_ctu'])) {
	$delete = $_GET['delete_ctu'];
	$course_id = $_GET['cid'];
	$assessmenttype = "Tutorial";

	$delctu = $conn->query("DELETE FROM course_tutorial WHERE ctu_id = '$delete' AND ctu_course_id = '$course_id'");

	if ($delctu) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete course tutorial is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course tutorial----------*/

/* ------------publish course tutorial----------*/
if (isset($_GET['publish_ctu'])) {
	$ctu_id = $_GET['publish_ctu'];
	$assessmenttype = "Tutorial";

	$publishctu = $conn->query("UPDATE course_tutorial SET ctu_status = 'Published' WHERE ctu_id = '$ctu_id'");

	if ($publishctu) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course tutorial----------*/

/* ------------unpublish course tutorial----------*/
if (isset($_GET['unpublish_ctu'])) {
	$ctu_id = $_GET['unpublish_ctu'];

	$assessmenttype = "Tutorial";

	$unpublishctu = $conn->query("UPDATE course_tutorial SET ctu_status = 'Save Only' WHERE ctu_id = '$ctu_id'");

	if ($unpublishctu) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course tutorial----------*/

/* ------------add course quiz question----------*/
if (isset($_POST['add_course_quiz_question'])) {

	$cq_id = $_POST['cq_id'];
	$quiz_question = $_POST['cq_question'];
	$cq_question_type = $_POST['cq_question_type'];
	$cqq_created_date = date('Y-m-d H:i:s');

	if ($cq_question_type == "Multiple Choice") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	} elseif ($cq_question_type == "True/False") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);
		$answer3 = "";
		$answer4 = "";
		$radiobutton = $_POST['tf_answer'];
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
	}

	$add_question = $conn->query("INSERT INTO course_quiz_question (cqq_course_quiz_id, cqq_type, cqq_question, cqq_created_date) 
		VALUES ('$cq_id', '$cq_question_type', '$quiz_question', '$cqq_created_date')");

	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT cqq_id FROM course_quiz_question WHERE cqq_course_quiz_id = '$cq_id' AND cqq_question = '$quiz_question' AND cqq_created_date = '$cqq_created_date';");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_cqqid = $rowReadQuestion->cqq_id;

		$add_answer = $conn->query("INSERT INTO course_quiz_answer (cqa_course_quiz_question_id, cqa_answer1, cqa_answer2, cqa_answer3, cqa_answer4, cqa_right_answer, cqa_right_answerword) 
			VALUES ('$get_cqqid', '$answer1', '$answer2', '$answer3', '$answer4', '$radiobutton', '$word')");

		if ($add_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('insert question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course quiz question----------*/

/* ------------edit course quiz question----------*/
if (isset($_POST['edit_course_quiz_question'])) {

	$cq_id = $_POST['cq_id'];
	$cqq_id = $_POST['cqq_id'];
	$cqa_id = $_POST['cqa_id'];
	$cq_question_type = $_POST['cqq_type'];

	$new_quiz_question = $_POST['new_cq_question'];


	if ($cq_question_type == "Multiple Choice") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	} elseif ($cq_question_type == "True/False") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
		$new_answer3 = "";
		$new_answer4 = "";
		$radiobutton = $_POST['new_answertf'];
	}

	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
	} elseif ($radiobutton == 5) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
	} elseif ($radiobutton == 6) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
	}

	$edit_question = $conn->query("UPDATE course_quiz_question SET cqq_question = '$new_quiz_question'
		WHERE cqq_id = '$cqq_id' AND cqq_course_quiz_id = '$cq_id'");

	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE course_quiz_answer SET cqa_answer1 = '$new_answer1', cqa_answer2 = '$new_answer2', cqa_answer3 = '$new_answer3', 
			cqa_answer4 = '$new_answer4', cqa_right_answer = '$radiobutton', cqa_right_answerword = '$word' 
			WHERE cqa_id = '$cqa_id' AND cqa_course_quiz_question_id = '$cqq_id'");

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
/* ------------edit course quiz question----------*/

/* ------------delete course quiz question----------*/

if (isset($_GET['delete_course_quiz_question'])) {
	$delete_question = $_GET['delete_course_quiz_question'];
	$delete_answer = $_GET['cquestion_answer'];

	$deleteAnswer = $conn->query("DELETE FROM course_quiz_answer WHERE cqa_id = '$delete_answer'");

	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM course_quiz_question WHERE cqq_id = '$delete_question'");

		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course quiz question----------*/

/* ------------add course test question----------*/
if (isset($_POST['add_course_test_question'])) {

	$ct_id = $_POST['ct_id'];
	$ct_question = $_POST['ct_question'];
	$ct_question_type = $_POST['ct_question_type'];
	$ctq_created_date = date('Y-m-d H:i:s');

	if ($ct_question_type == "Multiple Choice") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	} elseif ($ct_question_type == "True/False") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer5']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer6']);
		$answer3 = "";
		$answer4 = "";
		$radiobutton = $_POST['tf_answer'];
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
	}
	$add_question = $conn->query("INSERT INTO course_test_question (ctq_course_test_id, ctq_type, ctq_question, ctq_created_date) 
		VALUES ('$ct_id', '$ct_question_type', '$ct_question', '$ctq_created_date')");

	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT ctq_id FROM course_test_question WHERE ctq_course_test_id = '$ct_id' AND ctq_question = '$ct_question' AND ctq_created_date = '$ctq_created_date';");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_ctqid = $rowReadQuestion->ctq_id;

		$add_answer = $conn->query("INSERT INTO course_test_answer (cta_course_test_question_id, cta_answer1, cta_answer2, cta_answer3, cta_answer4, cta_right_answer, cta_right_answerword) 
			VALUES ('$get_ctqid', '$answer1', '$answer2', '$answer3', '$answer4', '$radiobutton', '$word')");

		if ($add_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('insert question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course test question----------*/

/* ------------edit course test question----------*/
if (isset($_POST['edit_course_test_question'])) {

	$ct_id = $_POST['ct_id'];
	$ctq_id = $_POST['ctq_id'];
	$cta_id = $_POST['cta_id'];
	$new_ct_question = $_POST['new_ct_question'];
	$ct_question_type = $_POST['ctq_type'];


	if ($ct_question_type == "Multiple Choice") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	} elseif ($ct_question_type == "True/False") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
		$new_answer3 = "";
		$new_answer4 = "";
		$radiobutton = $_POST['new_answertf'];
	}

	if ($radiobutton == 1) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
	} elseif ($radiobutton == 2) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
	} elseif ($radiobutton == 3) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
	} elseif ($radiobutton == 4) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
	} elseif ($radiobutton == 5) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer5']);
	} elseif ($radiobutton == 6) {
		$word = mysqli_real_escape_string($conn, $_POST['new_question_answer6']);
	}

	$edit_question = $conn->query("UPDATE course_test_question SET ctq_question = '$new_ct_question' 
		WHERE ctq_id = '$ctq_id' AND ctq_course_test_id = '$ct_id'");

	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE course_test_answer SET cta_answer1 = '$new_answer1', cta_answer2 = '$new_answer2', cta_answer3 = '$new_answer3', 
			cta_answer4 = '$new_answer4', cta_right_answer = '$radiobutton', cta_right_answerword = '$word' 
			WHERE cta_id = '$cta_id' AND cta_course_test_question_id  = '$ctq_id'");

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
/* ------------edit course test question----------*/

/* ------------delete course test question----------*/
if (isset($_GET['delete_course_test_question'])) {
	$delete_question = $_GET['delete_course_test_question'];
	$delete_answer = $_GET['question_answer'];

	$deleteAnswer = $conn->query("DELETE FROM course_test_answer WHERE cta_id = '$delete_answer'");

	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM course_test_question WHERE ctq_id = '$delete_question'");

		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete answer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course test question----------*/

/* ------------add forum topic----------*/
if (isset($_POST['add_topic_forum'])) {

	$user_id = $_POST['user_id'];
	$ftc_course_id = $_POST['ftc_course_id'];

	$ftc_name = mysqli_real_escape_string($conn, $_POST['topic_name']);

	$date = date('Y-m-d H:i:s');

	$addTopicForum = $conn->query("INSERT INTO forum_topic_course (ftc_topic_name, ftc_course_id, ftc_created_by, ftc_date_created)
							   VALUES ('$ftc_name', '$ftc_course_id', '$user_id', '$date')");

	if ($addTopicForum) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum topic are not successfully stored.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum topic----------*/

/* ------------edit forum topic----------*/
if (isset($_POST['edit_topic_forum'])) {

	$user_id = $_POST['user_id'];
	$ftc_course_id = $_POST['ftc_course_id'];
	$ftc_id = $_POST['ftc_id'];

	$ftc_topic_name = mysqli_real_escape_string($conn, $_POST['new_topic_name']);

	$edittopicforum = $conn->query("UPDATE forum_topic_course SET ftc_topic_name = '$ftc_topic_name' 
									WHERE ftc_id = '$ftc_id' AND ftc_course_id = '$ftc_course_id' AND ftc_created_by = '$user_id'");

	if ($edittopicforum) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('edit is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit forum topic----------*/

/* ------------delete forum topic----------*/
if (isset($_GET['delete_forum_topic'])) {

	$ftc_id = $_GET['delete_forum_topic'];
	$ftc_course_id = $_GET['course_id'];

	$deletetopicforum = $conn->query("DELETE FROM forum_topic_course WHERE ftc_id = '$ftc_id' AND ftc_course_id = '$ftc_course_id'");

	if ($deletetopicforum) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete forum topic is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum topic----------*/


/* ------------add forum message----------*/
if (isset($_POST['add_forum_message'])) {

	$sender_id = $_POST['sender_user_id'];
	$topic_id = $_POST['topic_id'];
	$forum_message = mysqli_real_escape_string($conn, $_POST['forum_message']);

	$date = date('Y-m-d H:i:s');


	$addForumMessage = $conn->query("INSERT INTO forum_post_course (fpc_topic_id, fpc_message, fpc_instructor, fpc_created_date)
							   VALUES ('$topic_id', '$forum_message', '$sender_id', '$date')");

	if ($addForumMessage) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum message are not successfully sent.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum message----------*/

/* ------------edit forum message----------*/
if (isset($_POST['edit_forum_message'])) {

	$fpc_id = $_POST['fpc_id'];
	$fpc_topic_id = $_POST['fpc_topic_id'];
	$fpc_instructor = $_POST['fpc_instructor'];
	$forum_message = mysqli_real_escape_string($conn, $_POST['new_forum_message']);

	$date = date('Y-m-d H:i:s');


	$editforummessage = $conn->query("UPDATE forum_post_course SET fpc_message = '$forum_message' 
									WHERE fpc_id = '$fpc_id' AND fpc_topic_id = '$fpc_topic_id' AND fpc_instructor = '$fpc_instructor'");

	if ($editforummessage) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Edit forum message are not successfully.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit forum message----------*/

/* ------------delete forum message----------*/
if (isset($_GET['delete_forum_message'])) {

	$fpc_id = $_GET['delete_forum_message'];
	$fpc_topic_id = $_GET['fpc_topic_id'];
	$fpc_instructor = $_GET['fpc_instructor'];

	$deleteforummessage = $conn->query("DELETE FROM forum_post_course 
										WHERE fpc_id = '$fpc_id' 
										AND fpc_topic_id = '$fpc_topic_id' 
										AND fpc_instructor = '$fpc_instructor'");

	if ($deleteforummessage) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete forum message is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum message----------*/

/* ------------add forum topic----------*/
if (isset($_POST['add_topic_forum_mc'])) {

	$user_id = $_POST['user_id'];
	$ftm_mc_id = $_POST['ftm_mc_id'];

	$ftm_name = mysqli_real_escape_string($conn, $_POST['topic_name']);

	$date = date('Y-m-d H:i:s');

	$addTopicForumMC = $conn->query("INSERT INTO forum_topic_mc (ftm_topic_name, ftm_mc_id, ftm_created_by, ftm_date_created)
							   VALUES ('$ftm_name', '$ftm_mc_id', '$user_id', '$date')");

	if ($addTopicForumMC) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum topic are not successfully stored.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum topic----------*/

/* ------------edit forum topic----------*/
if (isset($_POST['edit_topic_forum_mc'])) {

	$user_id = $_POST['user_id'];
	$ftm_mc_id = $_POST['ftm_mc_id'];
	$ftm_id = $_POST['ftm_id'];

	$ftm_topic_name = mysqli_real_escape_string($conn, $_POST['new_topic_name']);

	$edittopicforumMC = $conn->query("UPDATE forum_topic_mc SET ftm_topic_name = '$ftm_topic_name' 
									WHERE ftm_id = '$ftm_id' AND ftm_mc_id = '$ftm_mc_id' AND ftm_created_by = '$user_id'");

	if ($edittopicforumMC) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('edit is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit forum topic----------*/

/* ------------delete forum topic----------*/
if (isset($_GET['delete_forum_topic_mc'])) {

	$ftm_id = $_GET['delete_forum_topic_mc'];
	$ftm_mc_id = $_GET['mc_id'];

	$deletetopicforummc = $conn->query("DELETE FROM forum_topic_mc WHERE ftm_id = '$ftm_id' AND ftm_mc_id = '$ftm_mc_id'");

	if ($deletetopicforummc) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete forum topic is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum topic----------*/

/* ------------add forum message----------*/
if (isset($_POST['add_forum_message_mc'])) {

	$sender_id = $_POST['sender_user_id'];
	$topic_id = $_POST['topic_id'];
	$forum_message = mysqli_real_escape_string($conn, $_POST['forum_message_mc']);

	$date = date('Y-m-d H:i:s');

	$addForumMessageMC = $conn->query("INSERT INTO forum_post_mc (fpm_topic_id, fpm_message, fpm_instructor, fpm_created_date)
							   VALUES ('$topic_id', '$forum_message', '$sender_id', '$date')");

	if ($addForumMessageMC) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Forum message are not successfully sent.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add forum message----------*/

/* ------------edit forum message----------*/
if (isset($_POST['edit_forum_message_mc'])) {

	$fpm_id = $_POST['fpm_id'];
	$fpm_topic_id = $_POST['fpm_topic_id'];
	$fpm_instructor = $_POST['fpm_instructor'];
	$forum_message = mysqli_real_escape_string($conn, $_POST['new_forum_message_mc']);

	$date = date('Y-m-d H:i:s');


	$editforummessageMC = $conn->query("UPDATE forum_post_mc SET fpm_message = '$forum_message' 
									WHERE fpm_id = '$fpm_id' AND fpm_topic_id = '$fpm_topic_id' AND fpm_instructor = '$fpm_instructor'");

	if ($editforummessageMC) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Edit forum message are not successfully.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit forum message----------*/

/* ------------delete forum message----------*/
if (isset($_GET['delete_forum_message_mc'])) {

	$fpm_id = $_GET['delete_forum_message_mc'];
	$fpm_topic_id = $_GET['fpm_topic_id'];
	$fpm_instructor = $_GET['fpm_instructor'];

	$deleteforummessageMC = $conn->query("DELETE FROM forum_post_mc 
										WHERE fpm_id = '$fpm_id' 
										AND fpm_topic_id = '$fpm_topic_id' 
										AND fpm_instructor = '$fpm_instructor'");

	if ($deleteforummessageMC) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");

	} else {
		echo "<script>alert('Delete forum message is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete forum message----------*/









