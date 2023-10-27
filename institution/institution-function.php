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
if (isset($_POST['add_announcement'])) {
    $institution_id = $_SESSION['sess_institutionid'];
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

    $addAnnouncement = $conn->query("INSERT INTO announcement_institution (announcement_title, announcement_receiver, announcement_message, announcement_attachment, announcement_created_by, announcement_created_date)
										VALUES ('$announcement_title', '" . $checkbox1 . "', '$announcement_message', '$announcement_attachment', '$institution_id', '$announcement_date_created')");

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
        $checkAnnouncementFile = $conn->query("SELECT announcement_attachment FROM announcement_institution WHERE announcement_id = '$announcement_id'");

        $checkAnnouncementRow = mysqli_fetch_object($checkAnnouncementFile);

        if ($checkAnnouncementRow->announcement_attachment != NULL) {
            unlink($dir . $checkAnnouncementRow->announcement_attachment);
            move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

            $editAnnouncement = $conn->query("UPDATE announcement_institution SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

            if ($editAnnouncement) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Upload new file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            move_uploaded_file($_FILES['announcement_attachment']['tmp_name'], $file);

            $editAnnouncement = $conn->query("UPDATE announcement_institution SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message', announcement_attachment = '$newfilename'
												WHERE announcement_id = '$announcement_id'");

            if ($editAnnouncement) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Upload file for announcement is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        }
    } else {
        $editAnnouncement = $conn->query("UPDATE announcement_institution SET announcement_title = '$new_title', announcement_receiver = '$new_receiver', announcement_message = '$new_message'
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

    $deleteAnnouncement = $conn->query("DELETE FROM announcement_institution where announcement_id = '$delete_announcement'");

    if ($deleteAnnouncement) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Delete announcement is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}
/* --------delete announcement---------*/

/*------------Academic Programme----------*/

//add new programme
if (isset($_POST['add_ap'])) {
    $institution_id = $_SESSION['sess_institutionid'];
    $ap_name = $_POST['programme_name'];
    $ap_description = $_POST['programme_description'];
    $ap_type = $_POST['programme_type'];
    $ap_field_id = $_POST['programme_field'];
    $ap_duration = $_POST['programme_duration'];
    $rm = "RM ";
    $fee = $_POST['programme_fee'];
    $ap_fee = $rm . $fee;
    $ap_total_credit = $_POST['programme_total_credit'];
    $ap_date_created = date('Y-m-d H:i:s');
    $ap_image = $_POST['ap_image'];

    if ($_FILES['ap_image']['name'] != NULL) {
        $ap_image = str_replace("'", "", date('YmdHis') . $_FILES['ap_image']['name']);
    } else {
        $ap_image = "";
    }

    $folder1 = "../assets/images/academicprogramme/";
    move_uploaded_file($_FILES['ap_image']['tmp_name'], $folder1 . $ap_image);


    $insertAP = $conn->query("INSERT INTO academic_programme (ap_id, ap_field_id, ap_name, ap_description, ap_type, ap_duration, ap_fee, ap_total_credit, ap_certificate, ap_created_by, ap_created_date, ap_updated_date, ap_deleted_date, ap_image) 
        values (NULL, '$ap_field_id','$ap_name', '$ap_description', '$ap_type', '$ap_duration','$ap_fee','$ap_total_credit', NULL, '$institution_id','$ap_date_created', NULL, NULL, '$ap_image')");


    if ($insertAP) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Create academic programme is not successful')";
        //location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
}

// edit academic programme
if (isset($_POST['edit_academic_programme'])) {
    $ap_id  = $_POST['ap_id'];
    //$ap_field_id = $_POST['programme_field'];

    $new_programme_name = mysqli_real_escape_string($conn, $_POST['new_programme_name']);
    $new_programme_description = mysqli_real_escape_string($conn, $_POST['new_programme_description']);
    $new_programme_type = $_POST['new_programme_type'];
    $new_programme_field = mysqli_real_escape_string($conn, $_POST['new_programme_field']);
    $new_programme_duration = mysqli_real_escape_string($conn, $_POST['new_programme_duration']);
    $new_programme_fee = mysqli_real_escape_string($conn, $_POST['new_programme_fee']);
    $new_programme_total_credit = mysqli_real_escape_string($conn, $_POST['new_programme_total_credit']);

    $ap_updated_date = date('Y-m-d H:i:s');

    $folder1 = "../assets/images/academicprogramme/";

    $file_url = $_POST['file_url'];
    $fileName = $file_url;

    if ($_FILES['ap_image']['error'] == 0) {
        $fileName = str_replace("'", "", date('YmdHis') . $_FILES['ap_image']['name']);
        $fileUploaded = move_uploaded_file($_FILES['ap_image']['tmp_name'], $folder1 . $fileName);
    }

    $editAcademicProgramme = $conn->query("UPDATE academic_programme SET ap_name = '$new_programme_name', ap_description = '$new_programme_description', ap_type = '$new_programme_type', ap_field_id = '$new_programme_field', 
            ap_duration = '$new_programme_duration', ap_fee = '$new_programme_fee', ap_total_credit = '$new_programme_total_credit', ap_image = '$fileName', ap_updated_date = '$ap_updated_date'  WHERE ap_id = '$ap_id'");

    if ($editAcademicProgramme) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Edit academic programme details is not successful.');
                        location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//delete academic programme
if (isset($_GET['delete_academic_programme'])) {
    $delete_academic_programme = $_GET['delete_academic_programme'];
    $ap_deleted_date = date('Y-m-d H:i:s');


    $deleteAcademicProgramme = $conn->query("UPDATE academic_programme SET ap_deleted_date = '$ap_deleted_date' WHERE ap_id = '$delete_academic_programme'");
    if (isset($_GET['delete_academic_programme'])) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Delete academic programme is not successful.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}


/*------------Course----------*/

//add new course
if (isset($_POST['add_course'])) {
    $institution_id = $_SESSION['sess_institutionid'];
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_description = $_POST['course_description'];
    $course_duration = $_POST['course_duration'];
    $rm = "RM ";
    $fee = $_POST['course_fee'];
    $course_fee = $rm . $fee;
    $course_credit = $_POST['course_credit'];
    $course_level = $_POST['course_level'];
    $course_type = $_POST['course_type'];
    $course_field = $_POST['course_field'];


    if ($_FILES['coursecoverimage']['name'] != NULL) {
        $course_image = str_replace("'", "", date('YmdHis') . $_FILES['coursecoverimage']['name']);
    } else {
        $course_image = "";
    }

    $folder1 = "../assets/images/course/";
    move_uploaded_file($_FILES['coursecoverimage']['tmp_name'], $folder1 . $course_image);

    $insertCourse = $conn->query("INSERT INTO course (course_name, course_code, course_description, course_duration, course_fee, course_credit, course_level, course_field_id, course_created_by, course_image, course_type) 
        values ('$course_name', '$course_code', '$course_description', '$course_duration', '$course_fee','$course_credit','$course_level', '$course_field', '$institution_id', '$course_image', '$course_type')");


    if ($insertCourse) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Create new course is not successful');
            location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
}

//edit course
if (isset($_POST['edit_course'])) {
    $course_id  = $_POST['course_id'];

    $new_course_name = mysqli_real_escape_string($conn, $_POST['new_course_name']);
    $new_course_code = mysqli_real_escape_string($conn, $_POST['new_course_code']);
    $new_course_description = mysqli_real_escape_string($conn, $_POST['new_course_description']);
    $new_course_level = $_POST['new_course_level'];
    $new_course_type = $_POST['new_course_type'];
    $new_course_field = mysqli_real_escape_string($conn, $_POST['new_course_field']);
    $new_course_fee = mysqli_real_escape_string($conn, $_POST['new_course_fee']);
    $new_course_duration = mysqli_real_escape_string($conn, $_POST['new_course_duration']);
    $new_course_credit = mysqli_real_escape_string($conn, $_POST['new_course_credit']);

    $dir = "../assets/images/course/";
    if ($_FILES["coursecoverimage"]["name"] != NULL) {
        $newfileimg = str_replace("'", "", date('YmdHis') . $_FILES["coursecoverimage"]["name"]);
    } else {
        $newfileimg = "";
    }
    $file = $dir . $newfileimg;

    if ($newfileimg != NULL) {
        $checkimgfile = $conn->query("SELECT course_image FROM course WHERE course_id = '$course_id'");

        $checkimgRow = mysqli_fetch_object($checkimgfile);

        if ($checkimgRow->course_image != NULL) {
            unlink($dir . $checkimgRow->course_image);
            move_uploaded_file($_FILES['coursecoverimage']['tmp_name'], $file);

            $editCourse = $conn->query("UPDATE course SET course_name = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_description', 
                course_duration = '$new_course_duration', course_fee = '$new_course_fee', course_credit = '$new_course_credit', course_level = '$new_course_level', course_field_id = '$new_course_field', 
                course_image = '$newfileimg', course_type = '$new_course_type' WHERE course_id = '$course_id'");

            if ($editCourse) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Edit course details is not successful.');
                            location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            move_uploaded_file($_FILES['coursecoverimage']['tmp_name'], $file);

            $editCourse = $conn->query("UPDATE course SET course_name = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_description', 
                course_duration = '$new_course_duration', course_fee = '$new_course_fee', course_credit = '$new_course_credit', course_level = '$new_course_level', course_field_id = '$new_course_field', 
                course_image = '$newfileimg', course_type = '$new_course_type' WHERE course_id = '$course_id'");

            if ($editCourse) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Edit course details is not successful.');
                            location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        }
    } else {
        $editCourse = $conn->query("UPDATE course SET course_name = '$new_course_name', course_code = '$new_course_code', course_description = '$new_course_description', 
            course_duration = '$new_course_duration', course_fee = '$new_course_fee', course_credit = '$new_course_credit', course_level = '$new_course_level', course_field_id = '$new_course_field', 
            course_type = '$new_course_type' WHERE course_id = '$course_id'");

        if ($editCourse) {
            // echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Edit course details is not successful.');
                        location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }
}

//delete course
if (isset($_GET['delete_course'])) {
    $delete_course = $_GET['delete_course'];
    $course_deleted_date = date('Y-m-d H:i:s');


    $deleteCourse = $conn->query("UPDATE course SET course_deleted_date = '$course_deleted_date' WHERE course_id = '$delete_course'");
    if ($deleteCourse) {
        echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('Delete course is not successful.');
            location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}


/*------------Lecturer----------*/

//read state from country using ajax
if (isset($_POST['country_id'])) {

    $querystate = "SELECT * FROM state where state_country_id = " . $_POST['country_id'];
    $result = $conn->query($querystate);

    if ($result->num_rows > 0) {
        echo '<option value="" selected disabled>Select state</option>';

        while ($rowstate = $result->fetch_assoc()) {
            echo '<option value="' . $rowstate['state_id'] . '">' . $rowstate['state_name'] . '</option>';
        }
    } else {
        echo '<option value="">State not available</option>';
    }
}

//read city from state using ajax
if (isset($_POST['state_id'])) {

    $querycity = "SELECT * FROM city where city_state_id = " . $_POST['state_id'];
    $result = $conn->query($querycity);

    if ($result->num_rows > 0) {
        echo '<option value="">Select City</option>';

        while ($rowcity = $result->fetch_assoc()) {
            echo '<option value="' . $rowcity['city_id'] . '">' . $rowcity['city_name'] . '</option>';
        }
    } else {
        echo '<option value="">State not available</option>';
    }
}

//add lecturer
if (isset($_POST['add_lecturer'])) {

    $lecturer_fname = $_POST['lecturer_fname'];
    $lecturer_lname = $_POST['lecturer_lname'];
    // $lecturer_no_ic = $_POST['lecturer_no_ic'];
    $lecturer_email = $_POST['lecturer_email'];
    $lecturer_gender = $_POST['lecturer_gender'];
    //$lecturer_dob = date('Y-m-d',strtotime($_POST['lecturer_dob']));
    $lecturer_contact_no = $_POST['lecturer_contact_no'];
    //$lecturer_address = $_POST['lecturer_address'];
    $lecturer_institution = $_POST['institution_id'];

    $lecturer_created_date = date('Y-m-d H:i:s');

    $lecturer_title = $_POST['lecturer_title'];
    $lecturer_faculty = $_POST['lecturer_faculty'];
    $lecturer_department = $_POST['lecturer_department'];

    $queryCheckUsername = $conn->query("SELECT user_username FROM user WHERE user_username = '$lecturer_email';");

    if (mysqli_num_rows($queryCheckUsername) == 0) {
        $user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

        $queryCreateUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date, user_updated_date, user_deleted_date) values ('$lecturer_email', '$user_password', '7', current_timestamp, NULL, NULL)");

        if ($queryCreateUser) {
            $queryReadUser = $conn->query("SELECT user_id FROM user WHERE user_username = '$lecturer_email';");
            $rowReadUser = $queryReadUser->fetch_object();
            $get_userid = $rowReadUser->user_id;


            $insertLecturer = $conn->query("INSERT INTO lecturer (lecturer_id, lecturer_user_id, lecturer_role_id, lecturer_fname, lecturer_lname, lecturer_nationality, lecturer_no_ic, lecturer_passport_no, lecturer_email, lecturer_gender, lecturer_contact_no, 
                lecturer_dob, lecturer_address, lecturer_city_id, lecturer_state_id, lecturer_country_id, lecturer_institution_id, lecturer_status, lecturer_created_by, lecturer_created_date, lecturer_updated_date, lecturer_deleted_date, lecturer_title, lecturer_faculty, 
                lecturer_department) VALUES (NULL, '$get_userid', '7', '$lecturer_fname', '$lecturer_lname', NULL, NULL, NULL, '$lecturer_email', '$lecturer_gender', '$lecturer_contact_no', NULL, NULL, NULL, NULL, NULL, '$lecturer_institution', 'Active', NULL, 
                '$lecturer_created_date', NULL, NULL, '$lecturer_title', '$lecturer_faculty', '$lecturer_department')");

            if ($insertLecturer) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Create lecturer is not successful');
                    location.href='$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('System Failed');
                location.href='$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('This lecturer already exist');
            location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
}

//edit lecturer
if (isset($_POST['edit_lecturer'])) {
    $lecturer_id = $_POST['lecturer_id'];
    $lecturer_user_id = $_POST['lecturer_user_id'];
    $new_lecturer_title = mysqli_real_escape_string($conn, $_POST['new_lecturer_title']);
    $new_lecturer_fname = mysqli_real_escape_string($conn, $_POST['new_lecturer_fname']);
    $new_lecturer_lname = mysqli_real_escape_string($conn, $_POST['new_lecturer_lname']);
    // $new_lecturer_no_ic = mysqli_real_escape_string($conn, $_POST['new_lecturer_no_ic']);
    $new_lecturer_email = mysqli_real_escape_string($conn, $_POST['new_lecturer_email']);
    $new_lecturer_gender = mysqli_real_escape_string($conn, $_POST['new_lecturer_gender']);
    //$new_lecturer_dob = date('Y-m-d',strtotime($_POST['new_lecturer_dob']));
    $new_lecturer_contact_no = mysqli_real_escape_string($conn, $_POST['new_lecturer_contact_no']);
    //$new_lecturer_address = mysqli_real_escape_string($conn,$_POST['new_lecturer_address']);
    // $new_lecturer_institution = mysqli_real_escape_string($conn,$_POST['new_lecturer_institution']);
    $new_lecturer_faculty = mysqli_real_escape_string($conn, $_POST['new_lecturer_faculty']);
    $new_lecturer_department = mysqli_real_escape_string($conn, $_POST['new_lecturer_department']);
    $new_lecturer_status = mysqli_real_escape_string($conn, $_POST['new_lecturer_status']);

    $lecturer_updated_date = date('Y-m-d H:i:s');

    $editLecturer = $conn->query("UPDATE lecturer SET lecturer_fname = '$new_lecturer_fname', lecturer_lname = '$new_lecturer_lname', lecturer_email = '$new_lecturer_email', lecturer_gender = '$new_lecturer_gender', 
        lecturer_contact_no = '$new_lecturer_contact_no', lecturer_status = '$new_lecturer_status', lecturer_title = '$new_lecturer_title', lecturer_faculty = '$new_lecturer_faculty', lecturer_department = '$new_lecturer_department',
        lecturer_updated_date = '$lecturer_updated_date' WHERE lecturer_id = '$lecturer_id'");

    if ($editLecturer) {
        $editLecturerUser = $conn->query("UPDATE user SET user_username = '$new_lecturer_email', user_updated_date = '$lecturer_updated_date' WHERE user_id = '$lecturer_user_id'");

        if ($editLecturerUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Edit email is not successful.');
                    location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Edit lecturer details is not successful.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//delete lecturer
if (isset($_GET['delete_lecturer'])) {
    $lecturer_id = $_GET['delete_lecturer'];
    $lecturer_user_id = $_GET['lecturer_user_id'];

    $lecturer_deleted_date = date('Y-m-d H:i:s');

    $deleteLecturer = $conn->query("DELETE FROM lecturer WHERE lecturer_id  = '$lecturer_id ' AND lecturer_user_id = '$lecturer_user_id'");

    if ($deleteLecturer) {
        $deleteLecturerUser = $conn->query("DELETE FROM user WHERE user_id  = '$lecturer_user_id' AND user_role_id  = '7'");

        if ($deleteLecturerUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Delete lecturer user is not successful.');
            location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Delete lecturer is not successful.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}





/*------------Faculty----------*/

//add new faculty
if (isset($_POST['add_faculty'])) {

    $faculty_name = $_POST['faculty_name'];
    $faculty_email = $_POST['faculty_email'];
    $faculty_contact_no = $_POST['faculty_contact_no'];
    $faculty_address = $_POST['faculty_address'];
    $faculty_institution = $_POST['faculty_institution'];
    $faculty_created_date = date('Y-m-d H:i:s');

    $queryCheckUsername = $conn->query("SELECT user_username FROM user WHERE user_username = '$faculty_email';");



    if (mysqli_num_rows($queryCheckUsername) == 0) {

        $user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

        $queryCreateUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date, user_updated_date, user_deleted_date) VALUES ('$faculty_email', '$user_password', NULL, current_timestamp, NULL, NULL)");

        if ($queryCreateUser) {
            $queryReadUser = $conn->query("SELECT user_id FROM user WHERE user_username = '$faculty_email';");
            $rowReadUser = $queryReadUser->fetch_object();
            $get_userid = $rowReadUser->user_id;


            $insertFaculty = $conn->query("INSERT INTO faculty (faculty_id, faculty_user_id, faculty_name, faculty_email, faculty_contact_no, faculty_address, faculty_institution_id, faculty_created_by, faculty_created_date, faculty_updated_date, faculty_deleted_date) VALUES 
            (NULL, '$get_userid', '$faculty_name', '$faculty_email', '$faculty_contact_no', '$faculty_address', '$faculty_institution', NULL, '$faculty_created_date', NULL, NULL)");

            if ($insertFaculty) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Create faculty is not successful');
				location.href='$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('System Failed');
			location.href='$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('This faculty already exist');
		location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
}

//edit faculty
if (isset($_POST['edit_faculty'])) {

    $faculty_id    = $_POST['faculty_id'];
    $faculty_user_id = $_POST['faculty_user_id'];
    $new_faculty_name = mysqli_real_escape_string($conn, $_POST['new_faculty_name']);
    $new_faculty_email = mysqli_real_escape_string($conn, $_POST['new_faculty_email']);
    $new_faculty_contact_no = mysqli_real_escape_string($conn, $_POST['new_faculty_contact_no']);
    $new_faculty_address = mysqli_real_escape_string($conn, $_POST['new_faculty_address']);
    $new_faculty_institution = mysqli_real_escape_string($conn, $_POST['new_faculty_institution']);

    $faculty_updated_date = date('Y-m-d H:i:s');

    $editFaculty = $conn->query("UPDATE faculty SET faculty_name = '$new_faculty_name', faculty_email = '$new_faculty_email', faculty_contact_no = '$new_faculty_contact_no', faculty_address = '$new_faculty_address', faculty_institution_id = '$new_faculty_institution', 
    faculty_updated_date = '$faculty_updated_date' WHERE faculty_id = '$faculty_id'");

    if ($editFaculty) {
        $editFacultyUser = $conn->query("UPDATE user SET user_username = '$new_faculty_email', user_updated_date = '$faculty_updated_date' WHERE user_id = '$faculty_user_id'");

        if ($editFacultyUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Edit email is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Edit faculty details is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//delete faculty
if (isset($_GET['delete_faculty'])) {

    $delete_faculty = $_GET['delete_faculty'];
    $faculty_user_id = $_GET['faculty_user_id'];

    $faculty_deleted_date = date('Y-m-d H:i:s');

    $deleteFaculty = $conn->query("UPDATE faculty SET faculty_deleted_date = '$faculty_deleted_date' WHERE faculty_id = '$delete_faculty'");

    if ($deleteFaculty) {
        $deleteFacultyUser = $conn->query("UPDATE user SET user_deleted_date = '$faculty_deleted_date' WHERE user_id = '$faculty_user_id'");

        if ($deleteFacultyUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Delete faculty user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Delete faculty is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

/*------------Profile----------*/

//edit profile
if (isset($_POST['edit_profile'])) {
    $institution_id = $_POST['institution_id'];
    $institution_user_id = $_POST['institution_user_id'];
    // $new_institution_university_id = $_POST['new_institution_university_id'];
    $institution_email = $_POST['institution_email'];
    $institution_contact_no = $_POST['institution_contact_no'];
    $institution_address = $_POST['institution_address'];
    // $new_institution_status = $_POST['new_institution_status'];

    $institution_updated_date = date('Y-m-d H:i:s');

    $editProfile = $conn->query("UPDATE institution SET institution_email = '$institution_email', institution_contact_no = '$institution_contact_no', institution_address = '$institution_address' 
                                 WHERE institution_id = '$institution_id' AND institution_user_id = '$institution_user_id'");

    if ($editProfile) {
        $editUser = $conn->query("UPDATE user SET user_username = '$institution_email' WHERE user_id = '$institution_user_id'");

        if ($editUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Edit user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Edit profile is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//update profile
if (isset($_POST['update_ProfilePic'])) {
    $institution_id = $_POST['institution_id'];

    $profile_picture = time() . '_' . $_FILES['institution_logo']['name'];

    $target = '../assets/images/avatar/' . $profile_picture;

    if (move_uploaded_file($_FILES['institution_logo']['tmp_name'], $target)) {
        $updatePP = $conn->query("UPDATE institution 
                                SET institution_logo = '$profile_picture'
                                WHERE institution_id = '$institution_id'");
        if ($updatePP) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Failed to upload picture updatePP');
											location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Failed to upload picture update profile');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

/*------------Committee----------*/

//add new committee
if (isset($_POST['add_committee'])) {

    $committee_name = $_POST['committee_name'];
    $committee_email = $_POST['committee_email'];
    $committee_contact_no = $_POST['committee_contact_no'];
    $committee_address = $_POST['committee_address'];
    $committee_institution = $_POST['committee_institution_id'];
    $committee_created_date = date('Y-m-d H:i:s');

    $queryCheckUsername = $conn->query("SELECT user_username FROM user WHERE user_username = '$committee_email';");



    if (mysqli_num_rows($queryCheckUsername) == 0) {

        $user_password = password_hash("Unicreds123", PASSWORD_DEFAULT);

        $queryCreateUser = $conn->query("INSERT INTO user (user_username, user_password, user_role_id, user_created_date, user_updated_date, user_deleted_date) values ('$committee_email', '$user_password', '10', current_timestamp, NULL, NULL)");

        if ($queryCreateUser) {
            $queryReadUser = $conn->query("SELECT user_id FROM user WHERE user_username = '$committee_email';");
            $rowReadUser = $queryReadUser->fetch_object();
            $get_userid = $rowReadUser->user_id;


            $insertCommittee = $conn->query("INSERT INTO committee (committee_id, committee_user_id, committee_role_id, committee_name, committee_email, committee_contact_no, committee_address, committee_status, committee_institution_id, committee_created_by, committee_created_date, committee_updated_date, committee_deleted_date) VALUES 
            (NULL, '$get_userid', '10', '$committee_name', '$committee_email', '$committee_contact_no', '$committee_address', 'Active', '$committee_institution', NULL, '$committee_created_date', NULL, NULL)");

            if ($insertCommittee) {
                echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('Create committee is not successful');
				location.href='$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('System Failed');
			location.href='$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('This committee already exist');
		location.href='$_SERVER[HTTP_REFERER]';</script>";
    }
}

//edit committee
if (isset($_POST['edit_committee'])) {

    $committee_id    = $_POST['committee_id'];
    $committee_user_id = $_POST['committee_user_id'];
    $new_committee_name = mysqli_real_escape_string($conn, $_POST['new_committee_name']);
    $new_committee_email = mysqli_real_escape_string($conn, $_POST['new_committee_email']);
    $new_committee_contact_no = mysqli_real_escape_string($conn, $_POST['new_committee_contact_no']);
    $new_committee_address = mysqli_real_escape_string($conn, $_POST['new_committee_address']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_committee_status']);

    $committee_updated_date = date('Y-m-d H:i:s');

    $editCommittee = $conn->query("UPDATE committee SET committee_name = '$new_committee_name', committee_email = '$new_committee_email', committee_contact_no = '$new_committee_contact_no', committee_address = '$new_committee_address', committee_status = '$new_status', 
    committee_updated_date = '$committee_updated_date' WHERE committee_id = '$committee_id'");

    if ($editCommittee) {
        $editCommitteeUser = $conn->query("UPDATE user SET user_username = '$new_committee_email', user_updated_date = '$committee_updated_date' WHERE user_id = '$committee_user_id'");

        if ($editCommitteeUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Edit email is not successful.');
					location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Edit committee details is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//delete committee
if (isset($_GET['delete_committee'])) {

    $committe_id = $_GET['delete_committee'];
    $committee_user_id = $_GET['committee_user_id'];

    $committee_deleted_date = date('Y-m-d H:i:s');

    $deleteCommittee = $conn->query("DELETE FROM committee WHERE committee_id = '$committe_id' AND committee_user_id = '$committee_user_id'");

    if ($deleteCommittee) {
        $deleteCommitteeUser = $conn->query("DELETE FROM user WHERE user_id  = '$committee_user_id' AND user_role_id  = '6'");

        if ($deleteCommitteeUser) {
            echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('Delete committee user is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Delete committee is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}


##################################################################################
/*------------Employability Program----------*/



#######################################################################################

/* ------------add course----------*/
if (isset($_POST['add_employability_program'])) {

	$institution_id = $_SESSION['sess_institutionid'];
	$course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
	$course_category = mysqli_real_escape_string($conn, $_POST['course_category']);
	$course_description = mysqli_real_escape_string($conn, $_POST['course_desc']);
	// $course_fee = $_POST['course_fee'];
	$fee = $_POST['course_fee'];
	$course_fee = floatval($fee * 100);
	$course_date_created = date('Y-m-d H:i:s');
	$course_skills = mysqli_real_escape_string($conn, $_POST['course_skills']);
	if ($_FILES['coursecoverimg']['name'] != NULL) {
		$course_coverimg = str_replace("'", "", date('YmdHis') . $_FILES['coursecoverimg']['name']);
	} else {
		$course_coverimg = "";
	}
	$folder1 = "../assets/images/employability_program/epthumbnails/";
	move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $folder1 . $course_coverimg);

	if ($_FILES['cv_attachment']['name'] != NULL) {
		$cv_attachment = str_replace("'", "", date('YmdHis') . $_FILES['cv_attachment']['name']);
	} else {
		$cv_attachment = "";
	}

	$folder2 = "../assets/attachment/employability_program/epintrovideos/";
	move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $folder2 . $cv_attachment);
	$getID3 = new getID3();
	$filename = "../assets/attachment/employability_program/epintrovideos/" . $cv_attachment;
	// $fileinfo = $getID3->analyze($filename);
	// $duration = $fileinfo['playtime_string'];
	// $dur = duration($duration); 

	$checkuserrow = $conn->query("SELECT institution_user_id FROM institution WHERE institution_id = '$institution_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->institution_user_id;

	$insertcourse = $conn->query("INSERT INTO employability_program (ep_title, ep_description, ep_fee, ep_category, ep_publish, ep_cover_attachment, ep_introvideo, ep_skills_achieve, course_created_by,  ep_created_date) 
							      VALUES ('$course_title',  '$course_description',  '$course_fee', '$course_category', 'Draft', '$course_coverimg','$cv_attachment', '$course_skills', '$get_userID', '$course_date_created')");
                if ($insertcourse) {
                    echo ("<script>window.location.href ='pages-employability-program.php'</script>");
                } else {
                    echo "<script>alert('insert course learning details is not successful.');
                        location.href = '$_SERVER[HTTP_REFERER]';</script>";
                }
	} 


/* ------------update employability_program----------*/
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
	if ($_FILES["coursecoverimg"]["name"] != NULL) {
		$newfileimg = str_replace("'", "", date('YmdHis') . $_FILES["coursecoverimg"]["name"]);
	} else {
		$newfileimg = "";
	}
	$file = $dir . $newfileimg;

	if ($newfileimg != NULL) {
		$checkimgfile = $conn->query("SELECT ep_cover_attachment FROM employability_program WHERE ep_id  = '$ep_id'");

		$checkimgRow = mysqli_fetch_object($checkimgfile);

		if ($checkimgRow->ep_cover_attachment != NULL) {
			unlink($dir . $checkimgRow->ep_cover_attachment);
			move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $file);
			

			$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category',
             ep_fee = '$new_course_fee', ep_cover_attachment = '$newfileimg' WHERE ep_id = '$ep_id'");

			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful1.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			move_uploaded_file($_FILES['coursecoverimg']['tmp_name'], $file);

			$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category', ep_fee = '$new_course_fee',
             ep_cover_attachment = '$newfileimg' WHERE ep_id = '$ep_id'");

			if ($editcourse) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
			} else {
				echo "<script>alert('Upload new image for course is not successful2.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		}
	} else {
		$editcourse = $conn->query("UPDATE employability_program SET ep_title = '$new_course_name', ep_description = '$new_course_desc', ep_category = '$new_course_category', ep_fee = '$new_course_fee'  WHERE ep_id  = '$ep_id'");

		if ($editcourse) {
			echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
		} else {
			echo "<script>alert('Update course is not successful3.');
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

/* ------------update employability_program Skills ----------*/

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
		}}
	}

/* ------------update employability_program Introvideo ----------*/

/* ------------delete employability_program----------*/
if (isset($_GET['delete_ep'])) {
	$delete = $_GET['delete_ep'];

	$delep = $conn->query("DELETE FROM employability_program where ep_id = '$delete'");

	if ($delep) {

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
if (isset($_GET['unpublish_course'])) {
	$course_id = $_GET['unpublish_course'];
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



#----------------------------------- ADD NOTES ---------------------------------------#

/* ------------add course notes----------*/
if (isset($_POST['add_course_note'])) {
    $institution_id = $_SESSION['sess_institutionid'];
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

	$checkuserrow = $conn->query("SELECT institution_user_id FROM institution WHERE institution_id = '$institution_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->institution_user_id;
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
if (isset($_POST['edit_cn'])) {

	$ep_id = $_POST['cid_id'];
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

			$editcn = $conn->query("UPDATE employabilty_program_note SET cn_title = '$new_cn_title', cn_discription = '$new_cn_desc', epn_attachment = '$newattach' WHERE epn_id = '$epn_id' AND epn_ep_id = '$ep_id'");

			if ($editcn) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Upload new attachment for course note is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
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
    $institution_id = $_SESSION['sess_institutionid'];
// $ep_id = $_GET['cid'];

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
	$filename = "../assets/attachment/employability_program/epvideos/" . $cv_attachment;
	$fileinfo = $getID3->analyze($filename);
	$duration = $fileinfo['playtime_string'];
	$dur = duration($duration);

	$checkuserrow = $conn->query("SELECT institution_user_id FROM institution WHERE institution_id = '$institution_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->institution_user_id;

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
if (isset($_POST['edit_cv'])) {
	$course_id = $_POST['course_id'];
	$cv_id = $_POST['cv_id'];
	$new_cv_title = $_POST['new_cv_title'];
	$new_cv_desc = mysqli_real_escape_string($conn, $_POST['new_cv_desc']);
	$contenttype = "Video";
	$cv_date_updated = date('Y-m-d H:i:s');
	$dir = "../assets/attachment/employability_program/epvideos/";
	if ($_FILES["cv_attachment"]["name"] != NULL) {
		$newattachvid = str_replace("'", "", date('YmdHis') . $_FILES["cv_attachment"]["name"]);
		$file = $dir . $newattachvid;
		if (move_uploaded_file($_FILES['cv_attachment']['tmp_name'], $file)) {
			$getID3 = new getID3();
			$filename = $file;
			$fileinfo = $getID3->analyze($filename);
			$duration = $fileinfo['playtime_string'];
			$dur = duration($duration);
			$checkattachvid = $conn->query("SELECT epv_attachment FROM employabilty_program_video WHERE epv_id = '$cv_id'");
			if ($checkattachvid && $checkattachvid->num_rows > 0) {
				$checkattachvidRow = mysqli_fetch_object($checkattachvid);
				if ($checkattachvidRow->epv_attachment != NULL) {
					unlink($dir . $checkattachvidRow->epv_attachment);
				}
			}
			$editcv = $conn->query("UPDATE employabilty_program_video SET epv_title = '$new_cv_title', epv_discription = '$new_cv_desc', epv_attachment = '$newattachvid', epv_duration = '$dur' WHERE epv_id = '$cv_id' AND epv_ep_id = '$course_id'");
			if ($editcv) {
				echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
				$_SESSION['content_type'] = $contenttype;
			} else {
				echo "<script>alert('Update course video is not successful.');
				location.href = '$_SERVER[HTTP_REFERER]';</script>";
			}
		} else {
			echo "<script>alert('Upload new attachment for course video is not successful.');
			location.href = '$_SERVER[HTTP_REFERER]';</script>";
		}
	} else {
		$sql = "UPDATE employabilty_program_video SET epv_title = '$new_cv_title', epv_discription = '$new_cv_desc' WHERE epv_id = '$cv_id' AND epv_ep_id = '$course_id'";
		$editcv = $conn->query($sql);
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
    $institution_id = $_SESSION['sess_institutionid'];
	// $admin_id = $_SESSION['sess_adminid'];
	$ep_id = $_GET['cid'];
	$cq_title = $_POST['cq_title'];
	$cq_instruction = mysqli_real_escape_string($conn, $_POST['cq_instruction']);
	$cq_duration = $_POST['cq_duration'];

	$cq_date_created = date('Y-m-d H:i:s');
	$cq_status = $_POST['cq_status'];
	$assessmenttype = "Quiz";

	$checkuserrow = $conn->query("SELECT institution_user_id FROM institution WHERE institution_id = '$institution_id'");
	$rowReadUser = $checkuserrow->fetch_object();
	$get_userID = $rowReadUser->institution_user_id;

	$insertcoursequiz = $conn->query("INSERT INTO employability_program_quiz(epq_ep_id,epq_title,epq_instruction,epq_duration,epq_created_by,epq_status) 
		values('$ep_id','$cq_title','$cq_instruction','$cq_duration','$get_userID','$cq_status')");

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
if (isset($_POST['edit_cq'])) {

	$ep_id = $_POST['cid_id'];
	$cq_id = $_POST['cq_id'];
	$new_cq_title = $_POST['new_cq_title'];
	$new_cq_instruction = mysqli_real_escape_string($conn, $_POST['new_cq_instruction']);
	$new_cq_duration = $_POST['new_cq_duration'];
	$cq_date_updated = date('Y-m-d H:i:s');
	$assessmenttype = "Quiz";

	// $updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET epq_title = '$new_cq_title', epq_instruction = '$new_cq_instruction',
    //  epq_duration = '$new_cq_duration' WHERE epq_id = '$cq_id' AND epq_ep_id  = '$course_id'");
	 $updatecoursequiz = $conn->query("UPDATE employability_program_quiz SET epq_title = '$new_cq_title', epq_instruction = '$new_cq_instruction', epq_duration = '$new_cq_duration' 
	 									WHERE epq_id = '$cq_id' AND epq_ep_id = '$ep_id';");

	if ($updatecoursequiz) {
		$_SESSION['assessment_type'] = $assessmenttype;
		echo ("<script>alert('edit course quiz is  successful');location.href='$_SERVER[HTTP_REFERER]';</script>");
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
/* ------------delete course quiz----------*/

/* ------------add course quiz question----------*/
if (isset($_POST['add_course_quiz_question'])) {

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

// ADD CERTIFICATES TYPE

// Check if the form is submitted
if (isset($_POST['add_certificate_type'])) {
    // Retrieve the form data
    $certificateName = $_POST['certificate_name'];
    $certificateType = $_POST['certificate_type'];

    // Prepare the SQL statement
    $insertcertificatetype = $conn->query("INSERT INTO certificate_type (ct_name, ct_type) VALUES ('$certificateName', '$certificateType')");

    // Execute the query
    if ($insertcertificatetype) {
		echo "<script>alert('Insert is successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";;
        
    } else {
        echo "Error: " . $insertcertificatetype . "<br>" . $conn->error;
		echo "<script>alert('Insert is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }
}

//UPDATE CERTIFICATE TYPE
if (isset($_POST['update_certificate'])) {
    // Retrieve the form data
    $ctId = $_POST['ct_id'];
    $certificateName = $_POST['certificate_name'];
    $certificateType = $_POST['certificate_type'];

    // Prepare the SQL statement
    $updatecertificatetype = $conn->query("UPDATE certificate_type SET ct_name='$certificateName', ct_type='$certificateType' WHERE ct_id='$ctId'");

    // Execute the query
    if ($updatecertificatetype) {
        echo "<script>alert('update is successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
		echo "<script>alert('update is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
        echo "Error: " . $updatecertificatetype . "<br>" . $conn->error;
    }
}

//DELETE CERTIFICATE TYPE


// Check if the delete form is submitted and the necessary data is present
if (isset($_POST['delete_certificate'])){
    // Retrieve the ct_id from the form
    $ctId = $_POST['ct_id'];

    // Prepare the SQL statement
    $deletecertificatetype =  $conn->query("DELETE FROM certificate_type WHERE ct_id = '$ctId'");

    // Execute the query
    if ($deletecertificatetype) {
		echo "<script>alert('delete is successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
		echo "<script>alert('delete is not successful.');
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
        echo "Error: " . $deletecertificatetype . "<br>" . $conn->error;
    }
}


?>



