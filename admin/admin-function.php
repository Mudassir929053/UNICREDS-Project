<?php
// file untuk proses dan function
include('../database/dbcon.php');
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$admin_id = $_SESSION['sess_adminid'];
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
if (isset($_POST['add_announcement'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$announcement_title = mysqli_real_escape_string($conn, ucwords($_POST['announcement_title']));
	$checkbox1 = implode(",", $_POST['announcement_receiver']);
	$announcement_message = mysqli_real_escape_string($conn, $_POST['announcement_message']);

	if ($_FILES['announcement_attachment']['name'] != NULL) {
		$announcement_attachment = str_replace("'", "", date('YmdHis') . $_FILES['announcement_attachment']['name']);
	} else {
		$announcement_attachment = "";
	}

	//Folder for attachment
	$folder1 = "../assets/attachment/announcement/";
	move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $folder1 . $announcement_attachment);
	$announcement_date_created = date('Y-m-d H:i:s');

	$addAnnouncement = $conn->query("INSERT INTO announcement_admin (announcement_title, announcement_receiver, announcement_message, announcement_attachment, announcement_created_by, announcement_created_date)
										VALUES ('$announcement_title', '" . $checkbox1 . "', '$announcement_message', '$announcement_attachment', '$admin_id', '$announcement_date_created')");

	if ($addAnnouncement) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Announcement is not successful create.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add announcement----------*/

/* --------edit announcement---------*/
if (isset($_POST['edit_announcement'])) {
	$announcement_id = $_POST['announcement_id'];

	$new_title = mysqli_real_escape_string($conn, ucwords($_POST['new_title']));
	$new_receiver = implode(",", $_POST['arr']);
	$new_message = mysqli_real_escape_string($conn, $_POST['new_message']);

	$dir = "../assets/attachment/announcement/";
	if ($_FILES["announcement_attachment"]["name"] != NULL) {
		$newfilename = str_replace("'", "", date('YmdHis') . $_FILES["announcement_attachment"]["name"]);
	} else {
		$newfilename = "";
	}
	$file = $dir . $newfilename;

	if ($newfilename != NULL) {
		$checkAnnouncementFile = $conn->query("SELECT announcement_attachment FROM announcement_admin WHERE announcement_id = '$announcement_id'");

		$checkAnnouncementRow = mysqli_fetch_object($checkAnnouncementFile);

		if ($checkAnnouncementRow->announcement_attachment != NULL) {
			unlink($dir . $checkAnnouncementRow->announcement_attachment);
			move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

			$editAnnouncement = $conn->query("UPDATE announcement_admin SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

			if ($editAnnouncement) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

			$editAnnouncement = $conn->query("UPDATE announcement_admin SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

			if ($editAnnouncement) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editAnnouncement = $conn->query("UPDATE announcement_admin SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message'
											WHERE announcement_id = '$announcement_id'");

		if ($editAnnouncement) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Edit announcement is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* --------edit announcement---------*/

/* --------delete announcement---------*/
if (isset($_GET['delete_announcement'])) {
	$delete_announcement = $_GET['delete_announcement'];

	$deleteAnnouncement = $conn->query("DELETE FROM announcement_admin where announcement_id = '$delete_announcement'");

	if ($deleteAnnouncement) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Delete announcement is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* --------delete announcement---------*/

/* ------------add admin----------*/
if (isset($_POST['add_admin_unicreds'])) {
	$admin_name = strtoupper($_POST['admin_name']);
	$admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
	$admin_department = $_POST['admin_department'];
	$admin_date_created = date('Y-m-d H:i:s');

	$queryCheckUsername = $conn->query("SELECT user_username from user where user_username = '$admin_email';");

	if (mysqli_num_rows($queryCheckUsername) == 0) {

		$user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

		$queryCreateUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date, user_updated_date, user_deleted_date) values ('$admin_email', '$user_password', '$admin_department', current_timestamp, NULL, NULL)");

		if ($queryCreateUser) {
			$queryReadUser = $conn->query("SELECT user_id from user where user_username = '$admin_email';");
			$rowReadUser = $queryReadUser->fetch_object();
			$get_userid = $rowReadUser->user_id;


			$queryCreateAdmin = $conn->query("INSERT INTO admin (admin_user_id, admin_name, admin_email, admin_role_id, admin_created_date, admin_updated_date, admin_deleted_date) 
			VALUES ('$get_userid', '$admin_name', '$admin_email', '$admin_department', '$admin_date_created', NULL, NULL)");

			if ($queryCreateAdmin) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Create admin UNICREDS is not successful');
				location.href='$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('System Failed');
			location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('This admin UNICREDS already exist');
		location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add admin----------*/

/* ------------edit admin----------*/
if (isset($_POST['edit_admin_unicreds'])) {
	$admin_id	= $_POST['admin_id'];
	$admin_user_id = $_POST['admin_user_id'];
	$new_admin_name = mysqli_real_escape_string($conn, $_POST['new_admin_name']);
	$new_admin_email = mysqli_real_escape_string($conn, $_POST['new_admin_email']);
	$new_admin_role = $_POST['new_admin_department'];
	$admin_date_updated = date('Y-m-d H:i:s');

	$editAdminUnicreds = $conn->query("UPDATE admin SET admin_name = '$new_admin_name', admin_email = '$new_admin_email', admin_role_id = '$new_admin_role', admin_updated_date = '$admin_date_updated' WHERE admin_id = '$admin_id'");

	if ($editAdminUnicreds) {
		$editAdminUser = $conn->query("UPDATE user SET user_username = '$new_admin_email', user_updated_date = '$admin_date_updated', user_role_id = '$new_admin_role' WHERE user_id = '$admin_user_id'");

		if ($editAdminUser) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Edit email and role is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Edit admin details is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit admin----------*/

/* ------------delete admin----------*/
if (isset($_GET['delete_admin_unicreds'])) {
	$delete_admin = $_GET['delete_admin_unicreds'];
	$admin_user_id = $_GET['admin_user_id'];
	$admin_deleted_date = date('Y-m-d H:i:s');

	$deleteAdmin = $conn->query("UPDATE admin SET admin_deleted_date = '$admin_deleted_date' WHERE admin_id = '$delete_admin'");

	if ($deleteAdmin) {
		$deleteUser = $conn->query("UPDATE user SET user_deleted_date = current_timestamp WHERE user_id = '$admin_user_id'");

		if ($deleteUser) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete admin user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete admin is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete admin----------*/

/* ------------add institution----------*/
if (isset($_POST['add_institution'])) {
	$institution_university_id = $_POST['institution_university_id'];
	$institution_address = mysqli_real_escape_string($conn, $_POST['institution_address']);
	$institution_email = mysqli_real_escape_string($conn, $_POST['institution_email']);
	$institution_contact_no = mysqli_real_escape_string($conn, $_POST['institution_contact_no']);
	$institution_date_created = date('Y-m-d H:i:s');

	$queryCheckUniUsername = $conn->query("SELECT user_username from user where user_username = '$institution_email';");

	if (mysqli_num_rows($queryCheckUniUsername) == 0) {
		$user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

		$queryCreateInstitutionUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date) values ('$institution_email', '$user_password', '5', '$institution_date_created')");

		if ($queryCreateInstitutionUser) {
			$queryReadInstitutionUser = $conn->query("SELECT user_id from user where user_username = '$institution_email';");
			$rowReadInstitutionUser = $queryReadInstitutionUser->fetch_object();
			$get_InstitutionUserid = $rowReadInstitutionUser->user_id;

			$insertInstitution = $conn->query("INSERT INTO institution (institution_user_id, institution_university_id, institution_role_id, institution_email, institution_contact_no, institution_address, institution_status, institution_created_by, institution_created_date) values ('$get_InstitutionUserid', '$institution_university_id', '5', '$institution_email', '$institution_contact_no', '$institution_address', 'Active', NULL, '$institution_date_created')");

			if ($insertInstitution) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Create institution is not successful')</script>";
			}
		} else {
			echo "<script>alert('System Failed');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('This institution already exist');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add institution----------*/

/* ------------edit institution----------*/

if (isset($_POST['edit_institution'])) {
	$institution_id	= $_POST['institution_id'];
	$institution_user_id = $_POST['institution_user_id'];
	$new_institution_university_id	= $_POST['new_institution_university_id'];
	$new_institution_address = mysqli_real_escape_string($conn, $_POST['new_institution_address']);
	$new_institution_email = mysqli_real_escape_string($conn, $_POST['new_institution_email']);
	$new_institution_contact_no = mysqli_real_escape_string($conn, $_POST['new_institution_contact_no']);
	$new_status = mysqli_real_escape_string($conn, $_POST['new_institution_status']);
	$institution_date_updated = date('Y-m-d H:i:s');

	$editInstitution = $conn->query("UPDATE institution SET institution_university_id = '$new_institution_university_id', institution_email = '$new_institution_email', institution_contact_no = '$new_institution_contact_no', institution_address = '$new_institution_address', institution_status = '$new_status', institution_updated_date = '$institution_date_updated' WHERE institution_id = '$institution_id' AND institution_user_id = '$institution_user_id'");

	if ($editInstitution) {
		$editInstitutionUser = $conn->query("UPDATE user SET user_username = '$new_institution_email', user_updated_date = '$institution_date_updated' WHERE user_id = '$institution_user_id'");

		if ($editInstitutionUser) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Edit email is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Edit institution details is not successful.')</script>";
		// location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit institution----------*/

/* ------------delete institution----------*/
if (isset($_GET['delete_institution'])) {
	$delete_institution = $_GET['delete_institution'];
	$institution_user_id = $_GET['institution_user_id'];
	$institution_deleted_date = date('Y-m-d H:i:s');

	$deleteInstitution = $conn->query("UPDATE institution SET institution_deleted_date = '$institution_deleted_date' WHERE institution_id = '$delete_institution'");

	if ($deleteInstitution) {
		$deleteInstitutionUser = $conn->query("UPDATE user SET user_deleted_date = '$institution_deleted_date' WHERE user_id = '$institution_user_id'");

		if ($deleteInstitutionUser) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete institution user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete institution is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete institution----------*/

/* ------------add industry----------*/
if (isset($_POST['add_industry'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$industry_field_id = $_POST['industry_field_id'];
	$industry_name = mysqli_real_escape_string($conn, $_POST['industry_name']);
	$industry_website = mysqli_real_escape_string($conn, $_POST['industry_website']);
	$industry_email = mysqli_real_escape_string($conn, $_POST['industry_email']);
	$industry_contact_no = mysqli_real_escape_string($conn, $_POST['industry_contact_no']);

	if ($_FILES['ssm_attachment']['name'] != NULL) {
		$ssm_attachment = str_replace("'", "", date('YmdHis') . $_FILES['ssm_attachment']['name']);
	} else {
		$ssm_attachment = "";
	}

	$folder1 = "attachment/industry_attachment/";

	move_uploaded_file($_FILES['ssm_attachment']['tmp_name'], $folder1 . $ssm_attachment);

	$industry_date_created = date('Y-m-d H:i:s');

	$queryCheckIndUsername = $conn->query("SELECT user_username from user where user_username = '$industry_email';");

	if (mysqli_num_rows($queryCheckIndUsername) == 0) {
		$user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

		$queryCreateIndustryUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date) values ('$industry_email', '$user_password', '6', '$industry_date_created')");

		if ($queryCreateIndustryUser) {
			$queryReadIndustryUser = $conn->query("SELECT user_id from user where user_username = '$industry_email';");
			$rowReadIndustryUser = $queryReadIndustryUser->fetch_object();
			$get_IndustryUserid = $rowReadIndustryUser->user_id;

			$addIndustry = $conn->query("INSERT INTO industry(industry_id, industry_user_id, industry_role_id, industry_name,  industry_email, industry_website, industry_contact_no, industry_address1, industry_address2, industry_city_id, industry_state_id, industry_country_id, industry_ssm, industry_industry_field_id, industry_created_by, industry_created_date, industry_updated_date, industry_deleted_date, industry_status) VALUES (NULL, '$get_IndustryUserid', '6', '$industry_name', '$industry_email', '$industry_website','$industry_contact_no', null, null, null, null, null, '$ssm_attachment', '$industry_field_id', NULL, '$industry_date_created', NULL, NULL, 'Active')");

			if ($addIndustry) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Create industry is not successful')</script>";
			}
		} else {
			echo "<script>alert('System Failed');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('This industry already exist');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add industry----------*/

/* ------------edit industry----------*/
if (isset($_POST['edit_industry'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$industry_id = $_POST['industry_id'];
	$industry_user_id = $_POST['industry_user_id'];
	$new_industry_field_id = $_POST['new_industry_field_id'];
	$new_industry_name = mysqli_real_escape_string($conn, $_POST['new_industry_name']);
	$new_industry_website = mysqli_real_escape_string($conn, $_POST['new_industry_website']);
	$new_industry_email = mysqli_real_escape_string($conn, $_POST['new_industry_email']);
	$new_industry_contact_no = mysqli_real_escape_string($conn, $_POST['new_industry_contact_no']);
	$new_industry_status = $_POST['new_industry_status'];
	$industry_date_updated = date('Y-m-d H:i:s');

	$dir = "attachment/industry_attachment/";

	if ($_FILES["ssm_attachment"]["name"] != NULL) {
		$newfilessm = str_replace("'", "", date('YmdHis') . $_FILES["ssm_attachment"]["name"]);
	} else {
		$newfilessm = "";
	}
	$file = $dir . $newfilessm;

	if ($newfilessm != NULL) {
		$checkssmFile = $conn->query("SELECT industry_ssm FROM industry WHERE industry_id = '$industry_id'");

		$checkssmRow = mysqli_fetch_object($checkssmFile);

		if ($checkssmRow->industry_ssm != NULL) {
			unlink($dir . $checkssmRow->industry_ssm);
			move_uploaded_file($_FILES['ssm_attachment']['tmp_name'], $file);

			$editindustry = $conn->query("UPDATE industry SET industry_name = '$new_industry_name', industry_email = '$new_industry_email', industry_website = '$new_industry_website', industry_contact_no = '$new_industry_contact_no', industry_ssm = '$newfilessm', industry_industry_field_id = '$new_industry_field_id', industry_status = '$new_industry_status', industry_updated_date = '$industry_date_updated' WHERE industry_id = '$industry_id'");

			if ($editindustry) {
				$editindustryUser = $conn->query("UPDATE user SET user_username = '$new_industry_email', user_updated_date = '$industry_date_updated' WHERE user_id = '$industry_user_id'");

				if ($editindustryUser) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				} else {
					echo "<script>alert('Edit email user is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('Upload new file for SSM is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['ssm_attachment']['tmp_name'], $file);

			$editindustry = $conn->query("UPDATE industry SET industry_name = '$new_industry_name', industry_email = '$new_industry_email', industry_website = '$new_industry_website', industry_contact_no = '$new_industry_contact_no', industry_ssm = '$newfilessm', industry_industry_field_id = '$new_industry_field_id', industry_status = '$new_industry_status', industry_updated_date = '$industry_date_updated' WHERE industry_id = '$industry_id'");

			if ($editindustry) {

				$editindustryUser = $conn->query("UPDATE user SET user_username = '$new_industry_email', user_updated_date = '$industry_date_updated' WHERE user_id = '$industry_user_id'");

				if ($editindustryUser) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				} else {
					echo "<script>alert('Edit email user is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
				}
			} else {
				echo "<script>alert('Upload new file for SSM is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editindustry = $conn->query("UPDATE industry SET industry_name = '$new_industry_name', industry_email = '$new_industry_email', industry_website = '$new_industry_website', industry_contact_no = '$new_industry_contact_no', industry_industry_field_id = '$new_industry_field_id', industry_status = '$new_industry_status', industry_updated_date = '$industry_date_updated' WHERE industry_id = '$industry_id'");

		if ($editindustry) {

			$editindustryUser = $conn->query("UPDATE user SET user_username = '$new_industry_email', user_updated_date = '$industry_date_updated' WHERE user_id = '$industry_user_id'");

			if ($editindustryUser) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Edit email user is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Upload new file for SSM is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------edit industry----------*/

/* ------------delete industry----------*/
if (isset($_GET['delete_industry'])) {
	$delete_industry = $_GET['delete_industry'];
	$industry_user_id = $_GET['industry_user_id'];

	$industry_deleted_date = date('Y-m-d H:i:s');

	$deleteIndustry = $conn->query("UPDATE industry SET industry_deleted_date = '$industry_deleted_date' WHERE industry_id = '$delete_industry'");

	if ($deleteIndustry) {
		$deleteIndustryUser = $conn->query("UPDATE user SET user_deleted_date = '$industry_deleted_date' WHERE user_id = '$industry_user_id'");

		if ($deleteIndustryUser) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete industry user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete industry is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete industry----------*/

/* ------------add university----------*/
if (isset($_POST['add_uni'])) {
	$admin_id = $_SESSION['sess_adminid'];

	$uni_name = mysqli_real_escape_string($conn, $_POST['uni_name']);
	$uni_website = mysqli_real_escape_string($conn, $_POST['uni_website']);

	$addUni = $conn->query("INSERT INTO university (university_name, university_website)
							   VALUES ('$uni_name', '$uni_website')");

	if ($addUni) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('University not successfully stored.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add university----------*/

/* ------------edit university----------*/
if (isset($_POST['edit_uni'])) {

	$university_id 	= $_POST['university_id'];
	$new_uni_name = mysqli_real_escape_string($conn, $_POST['new_uni_name']);
	$new_uni_website = mysqli_real_escape_string($conn, $_POST['new_uni_website']);


	$editUniversity = $conn->query("UPDATE university SET university_name = '$new_uni_name', university_website = '$new_uni_website' WHERE university_id = '$university_id'");

	if ($editUniversity) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Edit university details is not successful.')</script>";
		// location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit university----------*/

/* ------------delete university----------*/
if (isset($_GET['delete_uni'])) {
	$delete = $_GET['delete_uni'];

	$deluni = $conn->query("DELETE FROM university where university_id = '$delete'");

	if ($deluni) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('delete university is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete university----------*/

/* ------------add education field----------*/
if (isset($_POST['add_edu_field'])) {

	$field_name = mysqli_real_escape_string($conn, $_POST['field_name']);

	$addedufield = $conn->query("INSERT INTO field (field_name)
							   VALUES ('$field_name')");

	if ($addedufield) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Education field not successfully save.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add education field----------*/

/* ------------edit education field----------*/
if (isset($_POST['edit_edu_field'])) {

	$field_id 	= $_POST['field_id'];
	$new_field = mysqli_real_escape_string($conn, $_POST['new_field']);

	$editEduField = $conn->query("UPDATE field SET field_name = '$new_field' WHERE field_id = '$field_id'");

	if ($editEduField) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Edit education field is not successful.')</script>";
		// location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit education field----------*/

/* ------------delete education field----------*/
if (isset($_GET['delete_edu_field'])) {
	$delete = $_GET['delete_edu_field'];

	$delEduField = $conn->query("DELETE FROM field where field_id = '$delete'");

	if ($delEduField) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('delete education field is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete education field----------*/

/* ------------add industry field----------*/
if (isset($_POST['add_industry_field'])) {

	$field_name = mysqli_real_escape_string($conn, $_POST['field_name']);

	$addIndfield = $conn->query("INSERT INTO industry_field (industry_field_name)
							   VALUES ('$field_name')");

	if ($addIndfield) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Industry field not successfully save.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add industry field----------*/

/* ------------edit industry field----------*/
if (isset($_POST['edit_industry_field'])) {

	$industry_field_id 	= $_POST['industry_field_id'];
	$new_indusfield_name = mysqli_real_escape_string($conn, $_POST['new_indusfield_name']);

	$editIndField = $conn->query("UPDATE industry_field SET industry_field_name = '$new_indusfield_name' WHERE industry_field_id = '$industry_field_id'");

	if ($editIndField) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Edit industry field is not successful.')</script>";
		// location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------edit industry field----------*/

/* ------------delete industry field----------*/
if (isset($_GET['delete_industry_field'])) {
	$delete = $_GET['delete_industry_field'];

	$delField = $conn->query("DELETE FROM industry_field where industry_field_id = '$delete'");

	if ($delField) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('delete industry field is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete industry field----------*/

/* ------------select institution----------*/
if (isset($_POST['select_institution'])) {

	$institution_id	= $_POST['institution_id'];

	$queryCheckUni = $conn->query("SELECT institution_id from  institution where institution_id = '$institution_id';");
	$rowReadUni = $queryCheckUni->fetch_object();
	$insti_ID = $rowReadUni->institution_id;

	header("Location: pages-mcreq-register.php?i_id=$insti_ID");

	exit();
}
/* ------------select institution----------*/


/* ------------add micro-credential from unicreds----------*/
if (isset($_POST['add_microcredential_unicreds'])) {

	$admin_id = $_SESSION['sess_adminid'];
	$mc_owner = $_POST['institution_id'];
	$mc_title = mysqli_real_escape_string($conn, $_POST['mc_title']);
	$mc_code = mysqli_real_escape_string($conn, $_POST['mc_code']);
	if (isset($_POST['mc_level'])) {
		$mc_level = implode(",", $_POST['mc_level']);
	} else {
		$mc_level = (NULL);
	}
	$mc_description = mysqli_real_escape_string($conn, $_POST['mc_desc']);
	$mc_category = mysqli_real_escape_string($conn, $_POST['mc_category']);

	$mc_date_enrollment = mysqli_real_escape_string($conn, $_POST['offerdate']);
	$mc_start_date = mysqli_real_escape_string($conn, $_POST['mc_start_date']);
	$mc_end_date = mysqli_real_escape_string($conn, $_POST['mc_end_date']);
	$fee = $_POST['mc_fee'];
	$mc_fee = floatval($fee * 100);
	$mc_duration = mysqli_real_escape_string($conn, $_POST['mc_duration']);

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

	$folder1 = "../assets/images/microcredential/";
	move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $folder1 . $mc_coverimg);

	$checkuserrow = $conn->query("SELECT admin_user_id from admin where admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$insertMC = $conn->query("INSERT INTO microcredential (mc_title, mc_code, mc_description, mc_category, mc_level, mc_duration, mc_fee, mc_created_by, mc_owner, mc_created_date, mc_image, mc_status, mc_enrollment_date) 
		values ('$mc_title', '$mc_code', '$mc_description', '$mc_category', '" . $mc_level . "', '$mc_duration', '$mc_fee', '$get_userID', '$mc_owner', '$mc_date_created', '$mc_coverimg', 'Draft', '$mc_date_enrollment')");

	if ($insertMC) {
		if ($mc_date_enrollment == 'choosedate') {

			$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
			$rowReadMC = $queryReadMC->fetch_object();
			$get_mcid = $rowReadMC->mc_id;

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
			$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
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
		echo "<script>alert('Create micro-credential is not successful');
        	location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

/* ------------add micro-credential from unicreds----------*/

/* ------------request micro-credential from institution----------*/
if (isset($_POST['add_microcredential'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$mc_owner = $_POST['institution_id'];
	$mc_title = mysqli_real_escape_string($conn, $_POST['mc_title']);
	$mc_code = mysqli_real_escape_string($conn, $_POST['mc_code']);
	if (isset($_POST['mc_level'])) {
		$mc_level = implode(",", $_POST['mc_level']);
	} else {
		$mc_level = (NULL);
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

	if (isset($_POST['mcm_collaboration'])) {
		$mcm_collaboration = mysqli_real_escape_string($conn, $_POST['mcm_collaboration']);
	} else {
		$mcm_collaboration = (NULL);
	}

	$folder1 = "../assets/images/microcredential/";
	move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $folder1 . $mc_coverimg);

	$foldermou = "../assets/attachment/microcredential/mouattachment/";
	move_uploaded_file($_FILES['mou_attachment']['tmp_name'], $foldermou . $mc_mou);

	$checkuserrow = $conn->query("SELECT admin_user_id from admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	if ($mc_credit_transfer == 'No') {

		$insertMC = $conn->query("INSERT INTO microcredential (mc_title, mc_code, mc_description, mc_category, mc_level, mc_duration, mc_fee, mc_credit_transfer, mc_created_by, mc_owner, mc_created_date, mc_image, mc_status, mc_enrollment_date) 
		values ('$mc_title', '$mc_code', '$mc_description', '$mc_category', '" . $mc_level . "', '$mc_duration', '$mc_fee', '$mc_credit_transfer', '$get_userID', '$mc_owner', '$mc_date_created', '$mc_coverimg', 'Draft', '$mc_date_enrollment')");

		if ($insertMC) {

			$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
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
							if ($mc_owner == '1') {
								echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
							} else {
								echo ("<script>window.location.href ='pages-mcreq-list.php'</script>");
							}
						} else {
							echo "<script>alert('insert micro-credential enrolment date is not successful.');
							location.href = '$_SERVER[HTTP_REFERER]';</script>";
						}
					} else {
						echo "<script>alert('insert micro-credential learning details is not successful.');
						location.href = '$_SERVER[HTTP_REFERER]';</script>";
					}
				} else {
					$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
					$rowReadMC = $queryReadMC->fetch_object();
					$get_mcid = $rowReadMC->mc_id;

					$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
												VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

					if ($add_mc_details) {
						if ($mc_owner == '1') {
							echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
						} else {
							echo ("<script>window.location.href ='pages-mcreq-list.php'</script>");
						}
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

			$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
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
								if ($mc_owner == '1') {
									echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
								} else {
									echo ("<script>window.location.href ='pages-mcreq-list.php'</script>");
								}
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
					$queryReadMC = $conn->query("SELECT mc_id from microcredential WHERE mc_title = '$mc_title' AND mc_code = '$mc_code' AND mc_created_by = '$get_userID' AND mc_created_date = '$mc_date_created';");
					$rowReadMC = $queryReadMC->fetch_object();
					$get_mcid = $rowReadMC->mc_id;

					$add_mc_course = $conn->query("INSERT INTO mc_course_credit_transfer (mccct_mc_id, mccct_course_title, mccct_course_code, mccct_course_level, mccct_created_by, mccct_created_date) 
			VALUES ('$get_mcid', '$mc_course_title', '$mc_course_code', '" . $checkbox1 . "', '$get_userID', '$mc_date_created')");

					if ($add_mc_course) {
						$add_mc_details = $conn->query("INSERT INTO mc_learning_details (mcld_mc_id, mcld_learning_outcome, mcld_intended_learners, mcld_prerequisites, mcld_skills) 
				VALUES ('$get_mcid', '$mc_lo', '$mc_il', '$mc_prerequisites', '$mc_skills')");

						if ($add_mc_details) {
							if ($mc_owner == '1') {
								echo ("<script>window.location.href ='pages-microcredential-list.php'</script>");
							} else {
								echo ("<script>window.location.href ='pages-mcreq-list.php'</script>");
							}
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

/* ------------request micro-credential from institution----------*/

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
	// $new_mc_level = implode(", ", $_POST['new_mc_level']);
	$new_mc_desc = mysqli_real_escape_string($conn, $_POST['new_mc_desc']);
	$new_mc_category = mysqli_real_escape_string($conn, $_POST['new_mc_category']);
	$fee = $_POST['new_mc_fee'];
	$new_mc_fee = floatval($fee * 100);
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

			$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '" . $new_mc_level . "', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_image = '$newfileimg', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

			if ($editmc) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for micro-credential is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['mccoverimg']['tmp_name'], $file);

			$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '" . $new_mc_level . "', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_image = '$newfileimg', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

			if ($editmc) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for micro-credential is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editmc = $conn->query("UPDATE microcredential SET mc_title = '$new_mc_name', mc_code = '$new_mc_code', mc_description = '$new_mc_desc', mc_category = '$new_mc_category', mc_level = '" . $new_mc_level . "', mc_duration = '$new_mc_duration', mc_fee = '$new_mc_fee', mc_updated_date = '$mc_date_updated' WHERE mc_id = '$mc_id'");

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
	$mc_date_published = date('Y-m-d H:i:s');

	$publishmc =  $conn->query("UPDATE microcredential SET mc_status = '$status', mc_published_date = '$mc_date_published' WHERE mc_id = '$mc_id'");

	if ($publishmc) {

		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
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
	$admin_id = $_SESSION['sess_adminid'];
	$mc_id	= $_POST['mc_id'];
	$mc_credit_transfer = $_POST['mc_credit_transfer'];
	$mc_course_title = mysqli_real_escape_string($conn, $_POST['mc_course_title']);
	$mc_course_code = mysqli_real_escape_string($conn, $_POST['mc_course_code']);
	$mc_course_level = implode(",", $_POST['mc_course_level']);

	$mc_date_updated = date('Y-m-d H:i:s');

	$checkuserrow = $conn->query("SELECT admin_user_id from admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$editmc = $conn->query("UPDATE microcredential SET mc_credit_transfer = '$mc_credit_transfer', mc_updated_date = '$mc_date_updated'  
	WHERE mc_id = '$mc_id'");

	if ($editmc) {

		$insertcourse = $conn->query("INSERT INTO mc_course_credit_transfer (mccct_mc_id, mccct_course_title, mccct_course_code, mccct_course_level, mccct_created_by, mccct_created_date) 
			VALUES ('$mc_id', '$mc_course_title', '$mc_course_code', '" . $mc_course_level . "', '$get_userID', '$mc_date_updated')");

		if ($insertcourse) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('insert course credit transfer is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('Update micro-credential details is not successful.');
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

	if ($add_mc_enrolment_date) {

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

		if ($editmcdateEnrol) {
			$deletedateEnrolment = $conn->query("DELETE FROM mc_enrolment_session WHERE mces_mc_id = '$mc_id' AND mces_id = '$mces_id'");

			if ($deletedateEnrolment) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Delete enrolment date is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Update micro-credential learning details is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
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

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id from admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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
	$mc_id = $_GET['mcid'];
	$mcn_deleted_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";

	$delmcnote = $conn->query("DELETE FROM mc_notes WHERE mcn_id = '$delete' AND mcn_mc_id = '$mc_id'");

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

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id from admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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
	$mc_id = $_GET['mcid'];
	$mcv_deleted_date = date('Y-m-d H:i:s');
	$contenttype = "Video";

	$delmcvid = $conn->query("DELETE FROM mc_video WHERE mcv_id = '$delete' AND mcv_mc_id = '$mc_id'");

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

/* ------------add micro-credential quiz----------*/
if (isset($_POST['add_mc_quiz'])) {

	$admin_id = $_SESSION['sess_adminid'];
	$mcq_mc = $_POST['mc_id'];
	$mcq_title = $_POST['mcq_title'];
	$mcq_instruction = mysqli_real_escape_string($conn, $_POST['mcq_instruction']);
	$mcq_duration = $_POST['mcq_duration'];

	$mcq_date_created = date('Y-m-d H:i:s');
	$mcq_status = $_POST['mcq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$admin_id = $_SESSION['sess_adminid'];
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
	$mc_id = $_GET['mcid'];
	$assessmenttype = "Quiz";
	$mcq_deleted_date = date('Y-m-d H:i:s');

	$delmcq = $conn->query("DELETE FROM mc_quiz WHERE mcq_id = '$delete' AND mcq_mc_id = '$mc_id'");

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

	$mc_quiz_id = $_POST['mcq_id'];
	$quiz_question = $_POST['mcq_question'];
	$mcq_question_type = $_POST['mcq_question_type'];
	$mcqq_created_date = date('Y-m-d H:i:s');

	if ($mcq_question_type == "Multiple Choice") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	} elseif ($mcq_question_type == "True/False") {
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
			echo "<script>alert('insert answer is successful.');
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
	$mcq_question_type = $_POST['mcqq_type'];
	$new_quiz_question = $_POST['new_mcq_question'];

	$mcqq_updated_date = date('Y-m-d H:i:s');

	if ($mcq_question_type == "Multiple Choice") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	} elseif ($mcq_question_type == "True/False") {
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

	$admin_id = $_SESSION['sess_adminid'];
	$mct_mc = $_POST['mc_id'];
	$mct_title = $_POST['mct_title'];
	$mct_instruction = mysqli_real_escape_string($conn, $_POST['mct_instruction']);
	$mct_duration = $_POST['mct_duration'];
	$mct_date_created = date('Y-m-d H:i:s');
	$mct_status = $_POST['mct_status'];
	$assessmenttype = "Test";

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$admin_id = $_SESSION['sess_adminid'];
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
	$mc_id = $_GET['mcid'];
	$assessmenttype = "Test";
	$mct_deleted_date = date('Y-m-d H:i:s');

	$delmct = $conn->query("DELETE FROM mc_test WHERE mct_id  = '$delete' AND mct_mc_id = '$mc_id'");

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

	if ($mct_question_type == "Multiple Choice") {
		$answer1 = mysqli_real_escape_string($conn, $_POST['question_answer1']);
		$answer2 = mysqli_real_escape_string($conn, $_POST['question_answer2']);
		$answer3 = mysqli_real_escape_string($conn, $_POST['question_answer3']);
		$answer4 = mysqli_real_escape_string($conn, $_POST['question_answer4']);
		$radiobutton = $_POST['answermulchoice'];
	} elseif ($mct_question_type == "True/False") {
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
	$mct_question_type = $_POST['mctq_type'];

	$mctq_updated_date = date('Y-m-d H:i:s');

	if ($mct_question_type == "Multiple Choice") {
		$new_answer1 = mysqli_real_escape_string($conn, $_POST['new_question_answer1']);
		$new_answer2 = mysqli_real_escape_string($conn, $_POST['new_question_answer2']);
		$new_answer3 = mysqli_real_escape_string($conn, $_POST['new_question_answer3']);
		$new_answer4 = mysqli_real_escape_string($conn, $_POST['new_question_answer4']);
		$radiobutton = $_POST['new_answermulchoice'];
	} elseif ($mct_question_type == "True/False") {
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

/* ------------add micro-credential slide----------*/
if (isset($_POST['addmcs'])) {

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

/* ------------add micro-credential tutorial----------*/
if (isset($_POST['addmctu'])) {

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$insertmctu = $conn->query("INSERT INTO mc_tutorial (mctu_mc_id, mctu_title, mctu_description, mctu_attachment, mctu_created_date, mctu_created_by, mctu_status) 
		   					   VALUES ('$mctu_mc', '$mctu_title', '$mctu_description', '$mctu_attachment', '$mctu_date_created', '$get_userID', '$mctu_status')");

	if ($insertmctu) {

		$queryReadMCTU = $conn->query("SELECT mctu_id FROM mc_tutorial WHERE mctu_title = '$mctu_title' AND mctu_mc_id  = '$mctu_mc' AND mctu_created_date = '$mctu_date_created' AND mctu_created_by  = '$get_userID';");
		$rowReadMCTU = $queryReadMCTU->fetch_object();
		$get_mctuid = $rowReadMCTU->mctu_id;

		$insertduedate = $conn->query("INSERT INTO mc_tutorial_duedate (mctud_mc_tutorial_id, mctud_duedate_date, mctud_duedate_time)
									   VALUES ('$get_mctuid', '$mctu_due_date', '$mctu_due_time')");

		if ($insertduedate) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			$_SESSION['assessment_type'] = $assessmenttype;
		} else {
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
				} else {
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

			if ($editmctu) {
				$editmctud = $conn->query("UPDATE mc_tutorial_duedate SET mctud_duedate_date = '$new_mctu_due_date', mctud_duedate_time = '$new_mctu_due_time' 
										   WHERE mctud_id = '$mctud_id' AND mctud_mc_tutorial_id = '$mctu_id'");

				if ($editmctud) {
					echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
					$_SESSION['assessment_type'] = $assessmenttype;
				} else {
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
			} else {
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

	$admin_id = $_SESSION['sess_adminid'];

	$course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
	$course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
	$course_level = implode(", ", $_POST['course_level']);
	$course_description = mysqli_real_escape_string($conn, $_POST['course_desc']);
	$course_category = mysqli_real_escape_string($conn, $_POST['course_category']);

	$course_date_enrollment = mysqli_real_escape_string($conn, $_POST['offerdate']);
	$course_start_date = mysqli_real_escape_string($conn, $_POST['course_start_date']);
	$course_end_date = mysqli_real_escape_string($conn, $_POST['course_end_date']);
	// $course_fee = $_POST['course_fee'];
	$fee = $_POST['course_fee'];
	$course_fee = floatval($fee * 100);
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;


	$insertcourse = $conn->query("INSERT INTO course (course_title, course_code, course_description, course_category, course_level, course_duration, course_fee, course_created_by, course_owner, course_created_date, course_image, course_status, course_enrollment_date) 
							      VALUES ('$course_title', '$course_code', '$course_description', '$course_category', '" . $course_level . "', '$course_duration', '$course_fee', '$get_userID', '$get_userID', '$course_date_created', '$course_coverimg', 'Draft', '$course_date_enrollment')");

	if ($insertcourse) {
		if ($course_date_enrollment == 'choosedate') {

			$queryReadCourse = $conn->query("SELECT course_id FROM course WHERE course_title = '$course_title' AND course_code = '$course_code' AND course_created_by = '$get_userID' AND course_created_date = '$course_date_created';");
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
			$queryReadCourse = $conn->query("SELECT course_id FROM course WHERE course_title = '$course_title' AND course_code = '$course_code' AND course_created_by = '$get_userID' AND course_created_date = '$course_date_created';");
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
	$new_course_fee = floatval($fee * 100);
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

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$sql = "INSERT INTO course_notes (cn_course_id, cn_title, cn_description, cn_attachment, cn_created_date, cn_created_by, cn_status) 
	values ('$course_id', '$cn_title', '$cn_description', '$cn_attachment', '$cn_date_created', '$get_userID', '$cn_status')";
	// exit;
	$insertcoursenote = $conn->query($sql);

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

	$admin_id = $_SESSION['sess_adminid'];
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
	$filename = "../assets/attachment/course/coursevideo/" . $cv_attachment;
	$fileinfo = $getID3->analyze($filename);
	$duration = $fileinfo['playtime_string'];
	$dur = duration($duration);

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$admin_id = $_SESSION['sess_adminid'];
	$course_id = $_POST['course_id'];
	$cq_title = $_POST['cq_title'];
	$cq_instruction = mysqli_real_escape_string($conn, $_POST['cq_instruction']);
	$cq_duration = $_POST['cq_duration'];

	$cq_date_created = date('Y-m-d H:i:s');
	$cq_status = $_POST['cq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$insertcoursequiz = $conn->query("INSERT INTO course_quiz (cq_course_id, cq_title, cq_instruction, cq_duration, cq_created_date, cq_created_by, cq_status) 
		values ('$course_id', '$cq_title', '$cq_instruction', '$cq_duration', '$cq_date_created', '$get_userID', '$cq_status')");

	if ($insertcoursequiz) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
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

	$admin_id = $_SESSION['sess_adminid'];
	$course_id = $_POST['course_id'];
	$ct_title = $_POST['ct_title'];
	$ct_instruction = mysqli_real_escape_string($conn, $_POST['ct_instruction']);
	$ct_duration = $_POST['ct_duration'];
	$ct_date_created = date('Y-m-d H:i:s');
	$ct_status = $_POST['ct_status'];
	$assessmenttype = "Test";

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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


		$queryReadQuestion = $conn->query("SELECT cqq_id FROM course_quiz_question WHERE cqq_course_quiz_id = '$cq_id' AND cqq_question = '$quiz_question' AND cqq_created_date = '$cqq_created_date'");
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



/*-------------------------------------------------------------------------------Start Employabiltiy Program ----------------------------------------------------------------------------------------------------------*/
/********************************************************************************************************************************************************************************************** */


/* ------------------------------------Add Employalibility program ------------------------------------ */

if (isset($_POST['add_employability_program'])) {
	// var_dump($_POST);
	// var_dump($_FILES);

	// exit;
	$admin_id = $_SESSION['sess_adminid'];

	$course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
	$course_category = mysqli_real_escape_string($conn, $_POST['course_category']);
	$course_description = mysqli_real_escape_string($conn, $_POST['course_desc']);
	// $course_fee = $_POST['course_fee'];
	$fee = $_POST['course_fee'];
	$course_fee = floatval($fee * 100);
	$course_date_created = date('Y-m-d H:i:s');
	$course_skills = mysqli_real_escape_string($conn, $_POST['course_skills']);
	if ($_FILES['coursecoverImg']['name'] != NULL) {
		$course_coverimg = str_replace("'", "", date('YmdHis') . $_FILES['coursecoverImg']['name']);
	} else {
		$course_coverimg = "";
	}
	$folder1 = "../assets/images/employability_program/epthumbnails/";
	move_uploaded_file($_FILES['coursecoverImg']['tmp_name'], $folder1 . $course_coverimg);

	if ($_FILES['cv_attachment']['name'] != NULL) {
		$cv_attachment = str_replace("'", "", date('YmdHis') . $_FILES['cv_attachment']['name']);
	} else {
		$cv_attachment = "";
	}

	$folder2 = "../assets/attachment/employability_program/epintrovideos/";
	move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $folder2 . $cv_attachment);
	$getID3 = new getID3();
	$filename = "../assets/images/course/" . $cv_attachment;
	// $fileinfo = $getID3->analyze($filename);
	// $duration = $fileinfo['playtime_string'];
	// $dur = duration($duration); 

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$sql = "INSERT INTO employability_program (ep_title, ep_description, ep_fee, ep_category, ep_publish, ep_cover_attachment, ep_introvideo, ep_skills_achieve, course_created_by,  ep_created_date) 
	VALUES ('$course_title',  '$course_description',  '$course_fee', '$course_category', 'Draft', '$course_coverimg','$cv_attachment', '$course_skills', '$get_userID', '$course_date_created')";
	// exit;
	$insertcourse = $conn->query($sql);
	if ($insertcourse) {
		echo ("<script>window.location.href ='pages-employability-program.php'</script>");
	} else {
		echo "<script>alert('insert course learning details is not successful.');
                        location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------------------------------Add Employalibility program ------------------------------------ */


/* ------------------------------------Edit Employalibility program ------------------------------------ */

if (isset($_POST['edit_employability_program'])) {
	$ep_id = $_POST['course_id'];
	$new_course_name = $_POST['new_course_name'];
	$new_course_desc = mysqli_real_escape_string($conn, $_POST['new_course_desc']);
	$new_course_category = mysqli_real_escape_string($conn, $_POST['new_course_category']);
	// $new_course_skills = mysqli_real_escape_string($conn, $_POST['new_course_skills']);
	$fee = $_POST['new_course_fee'];
	$new_course_fee = floatval($fee * 100);
	$course_date_updated = date('Y-m-d H:i:s');
	$dir = "../assets/images/employability_program/epthumbnails/";
	if ($_FILES["coursecoverImg"]["name"] != NULL) {
		$newfileimg = str_replace("'", "", date('YmdHis') . $_FILES["coursecoverImg"]["name"]);
	} else {
		$newfileimg = "";
	}
	$file = $dir . $newfileimg;
	if ($newfileimg != NULL) {
		$checkimgfile = $conn->query("SELECT ep_cover_attachment FROM employability_program WHERE ep_id  = '$ep_id'");
		$checkimgRow = mysqli_fetch_object($checkimgfile);
		if ($checkimgRow->ep_cover_attachment != NULL) {
			unlink($dir . $checkimgRow->ep_cover_attachment);
			move_uploaded_file($_FILES['coursecoverImg']['tmp_name'], $file);
			$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category',
             ep_fee = '$new_course_fee', ep_cover_attachment = '$newfileimg' WHERE ep_id = '$ep_id'");
			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['coursecoverImg']['tmp_name'], $file);
			$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category', ep_fee = '$new_course_fee',
             ep_cover_attachment = '$newfileimg', WHERE ep_id = '$ep_id'");
			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category', ep_fee = '$new_course_fee'  WHERE ep_id  = '$ep_id'");
		if ($editcourse) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	}
}
/* ------------update employability_program Skills----------*/
if (isset($_POST['edit_employability_program_skills'])) {
	$ep_id = $_POST['course_id'];
	$new_course_skills = mysqli_real_escape_string($conn, $_POST['new_course_skills']);
	$course_date_updated = date('Y-m-d H:i:s');
	$editcourse = $conn->query("UPDATE employability_program SET ep_skills_achieve = '$new_course_skills' WHERE ep_id  = '$ep_id'");
	if ($editcourse) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Update course is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------update employability_program Introvideo ----------*/
/* ------------update employability_program Skills----------*/
if (isset($_POST['edit_employability_program_video'])) {
	$ep_id = $_POST['course_id'];
	$dir = "../assets/attachment/employability_program/epintrovideos/";
	if ($_FILES["cv_attachment"]["name"] != NULL) {
		$newattachvid = str_replace("'", "", date('YmdHis') . $_FILES["cv_attachment"]["name"]);
	} else {
		$newattachvid = "";
	}
	$file = $dir . $newattachvid;
	if ($newattachvid != NULL) {
		$checkattachvid = $conn->query("SELECT ep_introvideo FROM employability_program WHERE ep_id = '$ep_id'");
		$checkattachvidRow = mysqli_fetch_object($checkattachvid);
		if ($checkattachvidRow->ep_introvideo != NULL) {
			unlink($dir . $checkattachvidRow->ep_introvideo);
			move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file);
			$editcv = $conn->query("UPDATE employability_program SET ep_introvideo = '$newattachvid' WHERE ep_id = '$ep_id'");
			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new attachment for course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	}
}
/* ------------update employability_program Introvideo ----------*/
/* ------------------------------------Edit Employalibility program ------------------------------------ */

/* ------------delete course----------*/
if (isset($_GET['delete_ep'])) {
	$delete = $_GET['delete_ep'];
	$delcourse = $conn->query("DELETE FROM employability_program where ep_id = '$delete'");
	if ($delcourse) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Delete course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course ----------*/
/* ------------publish course----------*/
if (isset($_GET['publish_ep'])) {
	$course_id = $_GET['publish_ep'];
	$status = "Published";
	$course_date_published = date('Y-m-d H:i:s');
	$publishcourse =  $conn->query("UPDATE employability_program SET ep_published_date = '$course_date_published', ep_publish = '$status' WHERE ep_id = '$course_id'");
	if ($publishcourse) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Publish course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course ----------*/
/* ------------unpublish course----------*/
if (isset($_GET['unpublish_ep'])) {
	$course_id = $_GET['unpublish_ep'];
	$status = "Draft";
	$unpublishcourse =  $conn->query("UPDATE employability_program SET ep_publish = '$status', ep_published_date=(NULL) WHERE ep_id = '$course_id'");
	if ($unpublishcourse) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Publish course is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course ----------*/

/* ------------add course quiz question----------*/
if (isset($_POST['add_ep_quiz_question'])) {
	// $cq_id = $_GET['cq_id'];
	$epq_id = $_GET['cq_id'];
	$quiz_question = $_POST['cq_question'];
	$cq_question_type = $_POST['cq_question_type'];
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
	$cqq_created_date = date('Y-m-d H:i:s');
	$add_question = $conn->query("INSERT INTO employability_program_quiz_question (epq_ep_id, epqq_type, epqq_question, epqq_created_date) 
		VALUES ('$epq_id', '$cq_question_type', '$quiz_question', '$cqq_created_date')");
	if ($add_question) {
		$queryReadQuestion = $conn->query("SELECT epqq_id  FROM employability_program_quiz_question WHERE epq_ep_id = '$epq_id' AND epqq_question = '$quiz_question'AND epqq_created_date = '$cqq_created_date'");
		$rowReadQuestion = $queryReadQuestion->fetch_object();
		$get_cqqid = $rowReadQuestion->epqq_id;
		$add_answer = $conn->query("INSERT INTO employability_program_quiz_answer(epqa_epq_id,epqa_answer1,epqa_answer2,epqa_answer3,epqa_answer4,epqa_right_answer, epqa_right_answerword) 
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
/* ------------add course quiz question----------*/
/* ------------edit course quiz question----------*/
if (isset($_POST['edit_ep_quiz_question'])) {
	$cq_id = $_POST['cq_id'];
	$cqq_id = $_POST['epqq_id'];
	$cqa_id = $_POST['epqa_id'];
	$cq_question_type = $_POST['epqq_type'];
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
	$edit_question = $conn->query("UPDATE employability_program_quiz_question SET epqq_question = '$new_quiz_question'
		WHERE epqq_id = '$cqq_id' AND epq_ep_id = '$cq_id'");
	if ($edit_question) {
		$edit_answer = $conn->query("UPDATE employability_program_quiz_answer SET epqa_answer1 = '$new_answer1', epqa_answer2 = '$new_answer2', epqa_answer3 = '$new_answer3', 
			epqa_answer4 = '$new_answer4', epqa_right_answer = '$radiobutton', epqa_right_answerword = '$word' 
			WHERE epqa_id = '$cqa_id' AND epqa_epq_id = '$cqq_id'");
		if ($edit_answer) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('edit answer is successful.');
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
	$deleteAnswer = $conn->query("DELETE FROM employability_program_quiz_answer WHERE epqa_id = '$delete_answer'");
	if ($deleteAnswer) {
		$deleteQuestion = $conn->query("DELETE FROM employability_program_quiz_question WHERE epqq_id = '$delete_question'");
		if ($deleteQuestion) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Delete answer is yes successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		echo "<script>alert('delete question is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------delete course quiz question----------*/



/* ------------add course notes----------*/
if (isset($_POST['add_ep_note'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$ep_id = $_GET['cid'];
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
	$folder1 = "../assets/attachment/employability_program/epnotes/";
	move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $folder1 . $cn_attachment);
	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$insertcoursenote = $conn->query("INSERT INTO employabilty_program_note (epn_ep_id, cn_title, cn_discription, epn_attachment, epn_created_date, epn_created_by, epn_status) 
		   values ('$ep_id', '$cn_title', '$cn_description', '$cn_attachment', '$cn_date_created', '$get_userID', '$cn_status')");
	if ($insertcoursenote) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create course notes is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course notes----------*/

/* ------------publish course notes----------*/
if (isset($_GET['publish_cn'])) {
	$cn_id = $_GET['publish_cn'];
	$update_date = date('Y-m-d H:i:s');
	$contenttype = "Notes";
	$publishcn = $conn->query("UPDATE employabilty_program_note SET epn_status = 'Published' WHERE epn_id = '$cn_id'");
	if ($publishcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Publish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------publish course notes----------*/

/* ------------update course notes----------*/
if (isset($_POST['edit_epn'])) {
	$ep_id = $_POST['cid'];
	$epn_id = $_POST['cn_id'];
	$new_cn_title = $_POST['new_cn_title'];
	$new_cn_desc = mysqli_real_escape_string($conn, $_POST['new_cn_desc']);
	$contenttype = "Notes";
	$dir = "../assets/attachment/employability_program/epnotes/";
	if ($_FILES["cn_attachment"]["name"] != NULL) {
		$newattach = str_replace("'", "", date('YmdHis') . $_FILES["cn_attachment"]["name"]);
	} else {
		$newattach = "";
	}
	$file = $dir . $newattach;
	if ($newattach != NULL) {
		$checkattachfile = $conn->query("SELECT epn_attachment FROM employabilty_program_note WHERE epn_id = '$epn_id'");
		$checkattachRow = mysqli_fetch_object($checkattachfile);
		if ($checkattachRow->epn_attachment != NULL) {
			unlink($dir . $checkattachRow->epn_attachment);
			move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $file);
			$editcn = $conn->query("UPDATE employabilty_program_note SET cn_title = '$new_cn_title', cn_discription = '$new_cn_desc', epn_attachment = '$newattach' 
			WHERE epn_id = '$epn_id' AND epn_ep_id = '$ep_id'");
			if ($editcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['cn_attachment']['tmp_name'], $file);
			$editcn = $conn->query("UPDATE employabilty_program_note SET cn_title = '$new_cn_title', cn_discription = '$new_cn_desc', epn_attachment = '$newattach' WHERE epn_id = '$epn_id' AND epn_ep_id = '$ep_id'");
			if ($editcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for micro-credential note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcn = $conn->query("UPDATE employabilty_program_note SET cn_title = '$new_cn_title', cn_discription = '$new_cn_desc' WHERE epn_id = '$epn_id' AND epn_ep_id = '$ep_id'");
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
	$ep_id = $_GET['cid'];
	$contenttype = "Notes";
	$delcoursenote = $conn->query("DELETE FROM employabilty_program_note WHERE epn_id = '$delete' AND epn_ep_id = '$ep_id'");
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
	$publishcn = $conn->query("UPDATE employabilty_program_note SET epn_status = 'Published' WHERE  epn_id = '$cn_id'");
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
	$unpublishcn = $conn->query("UPDATE employabilty_program_note SET  epn_status = 'Save Only' WHERE  epn_id = '$cn_id'");
	if ($unpublishcn) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course notes----------*/
if (isset($_POST['add_course_video'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$course_id = $_GET['cid'];
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
	$folder1 = "../assets/attachment/employability_program/epvideos/";
	move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $folder1 . $cv_attachment);
	$getID3 = new getID3();
	$filename = "../assets/attachment/course/coursevideo/" . $cv_attachment;
	$fileinfo = $getID3->analyze($filename);
	$duration = $fileinfo['playtime_string'];
	$dur = duration($duration);
	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$insertcv = $conn->query("INSERT INTO employabilty_program_video (epv_ep_id, epv_title, epv_discription, epv_attachment, epv_duration, epv_created_date, epv_created_by, epv_status) 
		values ('$course_id', '$cv_title', '$cv_desc', '$cv_attachment', '$dur','$cv_date_created', '$get_userID', '$cv_status')");
	if ($insertcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Create course video is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------update course video----------*/
if (isset($_POST['edit_ev'])) {
	$course_id = $_POST['course_id'];
	$cv_id = $_POST['cv_id'];
	$new_cv_title = $_POST['new_cv_title'];
	$new_cv_desc = mysqli_real_escape_string($conn, $_POST['new_cv_desc']);
	$contenttype = "Video";
	$cv_date_updated = date('Y-m-d H:i:s');
	$dir = "../assets/attachment/employability_program/epvideos/";
	if ($_FILES["cv_attachment"]["name"] != NULL) {
		$newattachvid = str_replace("'", "", date('YmdHis') . $_FILES["cv_attachment"]["name"]);
	} else {
		$newattachvid = "";
	}
	$file = $dir . $newattachvid;
	if ($newattachvid != NULL) {
		$checkattachvid = $conn->query("SELECT epv_attachment FROM employabilty_program_video WHERE epv_id = '$cv_id'");
		$checkattachvidRow = mysqli_fetch_object($checkattachvid);
		if ($checkattachvidRow->epv_attachment != NULL) {
			unlink($dir . $checkattachvidRow->epv_attachment);
			move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file);
			$getID3 = new getID3();
			$filename = $file;
			$fileinfo = $getID3->analyze($filename);
			$duration = $fileinfo['playtime_string'];
			$dur = duration($duration);
			$editcv = $conn->query("UPDATE employabilty_program_video SET epv_title = '$new_cv_title', epv_discription = '$new_cv_desc', epv_attachment = '$newattachvid', epv_duration = '$dur' WHERE epv_id = '$cv_id' AND epv_ep_id = '$course_id'");
			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file);
			$editcv = $conn->query("UPDATE employabilty_program_video SET epv_title = '$new_cv_title', epv_discription = '$new_cv_desc', epv_attachment = '$newattachvid', epv_duration = '$dur' WHERE epv_id = '$cv_id' AND epv_ep_id = '$course_id'");
			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcv =  $conn->query("UPDATE employabilty_program_video SET epv_title = '$new_cv_title', epv_discription = '$new_cv_desc', epv_attachment = '$newattachvid', epv_duration = '$dur' WHERE epv_id = '$cv_id' AND epv_ep_id = '$course_id'");
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
	// $course_id = $_GET['course_id'];
	$contenttype = "Video";
	$delcvid = $conn->query("DELETE FROM employabilty_program_video WHERE epv_id = '$delete'");
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
	$publishcv = $conn->query("UPDATE employabilty_program_video SET epv_status = 'Published' WHERE epv_id = '$cv_id' ");
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
	$unpublishcv = $conn->query("UPDATE employabilty_program_video SET epv_status = 'Save Only' WHERE epv_id = '$cv_id'");
	if ($unpublishcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['content_type'] = $contenttype;
	} else {
		echo "<script>alert('Unpublish is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------unpublish course video----------*/
/* ------------add course quiz----------*/
if (isset($_POST['add_course_quiz'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$ep_id = $_GET['cid'];
	$cq_title = $_POST['cq_title'];
	$cq_instruction = mysqli_real_escape_string($conn, $_POST['cq_instruction']);
	$cq_duration = mysqli_real_escape_string($conn, $_POST['cq_duration']);
	$cq_date_created = date('Y-m-d H:i:s');
	$cq_status = $_POST['cq_status'];
	$assessmenttype = "Quiz";
	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$insertcoursequiz = $conn->query("INSERT INTO employability_program_quiz(epq_ep_id,epq_title,epq_instruction,epq_duration,epq_created_by,epq_status) 
		values('$ep_id','$cq_title','$cq_instruction','$cq_duration','$get_userID','$cq_status')");
	if ($insertcoursequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add course quiz----------*/
/* ------------edit course quiz----------*/
if (isset($_POST['edit_cq'])) {
	$ep_id = $_POST['cid_id'];
	$cq_id = $_POST['cq_id'];
	$new_cq_title = $_POST['new_cq_title'];
	$new_cq_instruction = mysqli_real_escape_string($conn, $_POST['new_cq_instruction']);
	$new_cq_duration = $_POST['new_cq_duration'];
	$cq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Quiz";
	$updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET epq_title = '$new_cq_title', epq_instruction = '$new_cq_instruction', epq_duration = '$new_cq_duration' 
	 									WHERE epq_id = '$cq_id' AND epq_ep_id = '$ep_id';");
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
if (isset($_GET['publish_cq'])) {
	$cq_id = $_GET['publish_cq'];
	$assessmenttype = "Quiz";
	$cq_updated_date = date('Y-m-d H:i:s');
	$publishcq = $conn->query("UPDATE employability_program_quiz SET epq_status = 'Published' WHERE epq_id = '$cq_id' ");
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
	$unpublishcq = $conn->query("UPDATE employability_program_quiz SET epq_status = 'Save Only' WHERE epq_id = '$cq_id'");
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
	$delcq = $conn->query("DELETE FROM employability_program_quiz WHERE epq_id = '$delete' AND epq_ep_id = '$course_id'");
	if ($delcq) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('Delete quiz is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
	}
}
// ------------delete course quiz----------

/*-------------------------------------------------------------------------------End Empolayability Program ----------------------------------------------------------------------------------------------------------*/
/********************************************************************************************************************************************************************************************** */



/*-------------------------------------------------------------------------------Start Physometric Test code ----------------------------------------------------------------------------------------------------------*/
/********************************************************************************************************************************************************************************************** */
/* ------------add Psychometric Test----------*/
if (isset($_POST['add_Physometric_Test'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$pt_title = $_POST['pt_title'];
	$pt_instruction = mysqli_real_escape_string($conn, $_POST['pt_instruction']);
	$pt_duration = mysqli_real_escape_string($conn, $_POST['pt_duration']);
	$pt_date_created = date('Y-m-d H:i:s');
	$pt_status = $_POST['pt_status'];
	$assessmenttype = "Physometric-Test";
	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$insertcoursequiz = $conn->query("INSERT INTO psychometric_test(pt_title,pt_instruction,pt_duration,pt_created_by,pt_status) 
		values('$pt_title','$pt_instruction','$pt_duration','$get_userID','$pt_status')");
	if ($insertcoursequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
/* ------------add Psychometric Test----------*/
/* ------------edit Psychometric Test----------*/
if (isset($_POST['edit_psychometric_test'])) {
	$pt_id = $_POST['pt_id'];
	$new_pt_title = $_POST['new_pt_title'];
	$new_pt_instruction = mysqli_real_escape_string($conn, $_POST['new_pt_instruction']);
	$new_pt_duration = $_POST['new_pt_duration'];
	$cq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Physometric-Test";
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
/* ------------edit Psychometric Test----------*/
/* ------------publish Psychometric Test----------*/
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
/* ------------publish Psychometric Test----------*/
/* ------------unpublish Psychometric Test----------*/
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
/* ------------unpublish Psychometric Test----------*/
/* ------------delete Psychometric Test----------*/
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



/* ------------Add Psychometric Test question----------*/
if (isset($_POST['add_psychometric_test_question'])) {
	$epq_id = $_GET['pt_id'];
	$quiz_question = $_POST['pt_question'];
	$pt_question_type = $_POST['pt_question_type'];
	$pts_id = $_POST['pts_id'];
	if ($pt_question_type == "Multiple Choice") {
		$answer1 = $_POST['question_answer1'];
		$answer2 = $_POST['question_answer2'];
		$answer3 = $_POST['question_answer3'];
		$answer4 = $_POST['question_answer4'];
		$answer8 = NULL;
	} elseif ($pt_question_type == "True/False") {
		$answer1 = $_POST['question_answer5'];
		$answer2 = $_POST['question_answer6'];
		$answer3 = NULL;
		$answer4 = NULL;
		$answer8 = NULL;
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
	foreach ($quiz_question as $index => $quiz_questions) {
		if ($_FILES['image']['name'] != NULL) {
			// $question_image = str_replace("'", "", date('YmdHis') . $_FILES['image']['name'][$index]);
			$question_image =  $_FILES['image']['name'];

		} else {
			$question_image = "";
		}
		$folder1 = "../assets/images/question/";
		move_uploaded_file($_FILES['image']['tmp_name'][$index], $folder1 . $question_image[$index]);
		$add_question = $conn->query("INSERT INTO psychometric_test_question (ptq_pt_id, ptq_type, ptq_pts_id, ptq_question,ptq_option1,ptq_option2,ptq_option3,ptq_option4,ptq_option5,question_img, ptq_created_date)
		VALUES ('$epq_id', '$pt_question_type', '$pts_id','$quiz_questions','$answer1[$index]','$answer2[$index]','$answer3[$index]',
		'$answer4[$index]','$answer8','$question_image[$index]' , '$cqq_created_date')");
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

/* ------------delete psychometric_test question----------*/
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
/* ------------delete psychometric_test question----------*/

//---------------------------section for Psychometric Test---------------------------------------------
/* ------------add course quiz----------*/
if (isset($_POST['add_psychometric_section'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$pts_title = mysqli_real_escape_string($conn, $_POST['section_name']);
	$pt_id = $_POST['pt_id'];
	$pt_date_created = date('Y-m-d H:i:s');
	$insertsection = $conn->query("INSERT INTO psychometric_test_section(pts_name,pts_pt_id,pts_created_date) 
		values('$pts_title','$pt_id','$pt_date_created')");
	if ($insertsection) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
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
/* ------------edit course quiz----------*/
/* ------------delete course quiz----------*/
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
/*------------------------------------------------------------------------------End Physometric Test code ----------------------------------------------------------------------------------------------------------*/
/********************************************************************************************************************************************************************************************** */


// ******************************************************** SKILL ASSESSMENT TEST*************************************************************************//

// ******************************************************** SKILL ASSESSMENT TEST*************************************************************************//


//********************ADD COURSE-------->>>>>>>>skill assessement test*******************************/
if (isset($_POST['add_skill_Test'])) {
	$admin_id = $_SESSION['sess_adminid'];
	$st_title = $_POST['st_title'];
	$st_industry_field = $_POST['st_industry_field'];
	$st_instruction = mysqli_real_escape_string($conn, $_POST['st_instruction']);
	$st_duration = mysqli_real_escape_string($conn, $_POST['st_duration']);
	$st_date_created = date('Y-m-d H:i:s');
	$st_status = $_POST['st_status'];
	$assessmenttype = "Skill-Assessment-Test";
	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;
	$insertcoursequiz = $conn->query("INSERT INTO skill_assessment_test(st_title,st_industry_field,st_instruction,st_duration,st_created_by,st_status) 
		values('$st_title','$st_industry_field','$st_instruction','$st_duration','$get_userID','$st_status')");
	if ($insertcoursequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}



/* ------------publish course quiz----------*/
if (isset($_GET['publish_sat'])) {
	$st_id = $_GET['publish_sat'];
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
if (isset($_GET['unpublish_sat'])) {
	$st_id = $_GET['unpublish_sat'];
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


//new code//



if (isset($_POST['add_skill_question'])) {
	// $cq_id = $_GET['cq_id'];
	$admin_id = $_SESSION['sess_adminid'];

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
	$admin_id = $_SESSION['sess_adminid'];
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$insertquestionfilequiz = $conn->query("INSERT INTO skill_assessment_test_question(stq_st_id,stq_type,stq_fileupload) 
		values('$stid','$stq_type','$stq_fileupload') ");
	if ($insertquestionfilequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {

		echo "<script>alert('create employability program quiz is not successful');
        location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

// *************************end FILE UPLOAD**********************************************************//

// *************************EDIT SKILL QUESTIONS(MULTIPLE CHOICE)**********************************************************//

//new code


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



//NEW CODE

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

	$checkuserrow = $conn->query("SELECT admin_user_id  from admin where admin_id  = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;


	$updatescore1 = $conn->query("UPDATE studuni_st_test_review SET susatrv_answer_status = '$susatrv_answer_status'
	WHERE susatrv_st_test_question_id = '$susatrv_st_test_question_id';");

	//Total Answered 
	$sql1 = "SELECT *
	FROM studuni_st_test_review AS sstr
	WHERE sstr.susatrv_st_test_id=$susatrv_st_test_id ";
	if ($result1 = mysqli_query($conn, $sql1)) {

		// Return the number of rows in result set
		$susatqrs_total_answered_question = mysqli_num_rows($result1);
	}

	//Total Correct Answers
	$sql = "SELECT *
	FROM studuni_st_test_review AS sstr
	WHERE sstr.susatrv_st_test_id=$susatrv_st_test_id AND sstr.susatrv_answer_status='Correct'";

	if ($result = mysqli_query($conn, $sql)) {

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



/*----------------------------------------------------------------------------language test-----------------------------------------------------/
/*-------------------MANAGE LANGUAGE TEST FUNCTIONS************************************************--------------------*/
/* ------------add quiz----------*/
if (isset($_POST['add_lt_quiz'])) {
	// $institution_id = $_SESSION['sess_institutionid'];
	$admin_id = $_SESSION['sess_adminid'];
	$ltq_id = $_POST['ltq_id'];
	$ltq_title = mysqli_real_escape_string($conn, $_POST['ltq_title']);
	$ltq_instruction = mysqli_real_escape_string($conn, $_POST['ltq_instruction']);
	$ltq_duration = mysqli_real_escape_string($conn, $_POST['ltq_duration']);

	$ltq_date_created = date('Y-m-d H:i:s');
	$ltq_status = $_POST['ltq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id = '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

	$insertcoursequiz = $conn->query("INSERT INTO language_test_quiz(ltq_id,ltq_title,ltq_instruction,ltq_duration,ltq_created_by,ltq_status)
     values('$ltq_id','$ltq_title','$ltq_instruction','$ltq_duration','$get_userID','$ltq_status')");

	if ($insertcoursequiz) {
		echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
		$_SESSION['assessment_type'] = $assessmenttype;
	} else {
		echo "<script>alert('create employability program quiz is not successful');
       location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}

if (isset($_POST['edit_ltq'])) {

	$ltq_id = $_POST['ltq_id'];
	$new_ltq_title = mysqli_real_escape_string($conn, $_POST['new_ltq_title']);
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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id= '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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

	$checkuserrow = $conn->query("SELECT admin_user_id FROM admin WHERE admin_id= '$admin_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->admin_user_id;

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
