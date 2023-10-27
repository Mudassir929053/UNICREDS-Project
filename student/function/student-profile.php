<?php
include("../function/student-function.php");

/*--------------------------------------------------------- STUDENT PROFILE PICTURE ---------------------------------------------------------*/

/**
 * Upload student university's profile picture.
 * It will overrides the current profile picture, if exists.
*/
if(isset($_POST["upProfilePic"])) {
    // Directory for the profile pic file to be uploaded.
    $dirPath = "../../assets/images/avatar/";
    $currPic = $_POST["currProfilePic"];
    $uploadOk = 1;

    if(!empty($_FILES["profilePic"]["name"])) {
        // Remove current picture from directory, if exists.
        $suProfilePic = $suInfo->fetch_info();
        if($suProfilePic["su_profile_pic"] !== NULL) {
            unlink($dirPath.$suProfilePic["su_profile_pic"]);
        }

        $fileName = basename($_FILES["profilePic"]["name"]);
        $fileTmp = $_FILES["profilePic"]["tmp_name"];
        $filePath = $dirPath . $fileName;
        $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Allowed file types.
        $allowExt = array("jpg", "jpeg", "png");

        // File validation.
        if(getimagesize($fileTmp) === false) {
            echo "<script>alert('Sorry, this file is not an image.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        } 
        if(file_exists($filePath)) {
            echo "<script>alert('Sorry, this file already exists.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        } 
        if($_FILES["profilePic"]["size"] > 41943040) { // 40MB limit.
            echo "<script>alert('Sorry, this file is too large (> 40MB).');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        } 
        if(!in_array($fileExt, $allowExt)) {
            echo "<script>alert('Sorry, only JPG, JPEG, and PNG files are allowed.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        }

        // Check if the file upload is a success or failure.
        if($uploadOk == 1) {
            // --- upload file into the specified directory.
            move_uploaded_file($fileTmp, $filePath);

            // --- add file path into DB.
            $upProfilePic = $suInfo->update_profile_picture($fileName);
            
            // --- check if the update is a success or failure.
            if($upProfilePic) {
                echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('Error: Upload Profile Picture.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Please select a file to be uploaded.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/** 
 * Delete the current student university's profile picture.
 * Remove the image from the directory and database.
*/
if(isset($_GET["deletePic"])) {
    $fileName = $suInfo->fetch_info()["su_profile_pic"];
    $fileDir = "../../assets/images/avatar/" . $fileName;
    $defaultPic = "../../assets/images/avatar/avatardefault.png";

    // Check if the current profile picture is not the default.
    if($fileDir !== $defaultPic) {
        // --- remove the file from the directory and database.
        if(unlink($fileDir)) {
            $delProfilePic = $suInfo->update_profile_picture(NULL);

            // --- check if the update is a success or failure.
            if($delProfilePic) {
                echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('Error removing picture from directory.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Cannot delete default picture.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**-------------------------------------------------------- STUDENT PROFILE PICTURE --------------------------------------------------------**/


/*--------------------------------------------------------- STUDENT PROFILE ---------------------------------------------------------*/

/**
 * Update student university profile informations.
 * Pass all the data in an associative array to the `update_profile` function in `Student` class.
*/
if(isset($_POST["upProfile"])) {
    // Check if the passport value are passed or not.
    if(isset($_POST["passSU"])) {
        $pass = $_POST["passSU"];
    } else {
        $pass = NULL;
    }

    // Pass all the input into $studuni_info associative array.
    $studuni_info = array( 
        "city_id"           => $_POST["cityID"], 
        "state_id"          => $_POST["stateID"], 
        "country_id"        => $_POST["countryID"], 
        "first_name"        => mysqli_real_escape_string($conn, $_POST["fnameSU"]), 
        "last_name"         => mysqli_real_escape_string($conn, $_POST["lnameSU"]), 
        "ic_no"             => mysqli_real_escape_string($conn, $_POST["icnumSU"]), 
        "linked_in"          => mysqli_real_escape_string($conn, $_POST["linkedinSU"]), 
        "pass_no"           => $pass, 
        "gender"            => mysqli_real_escape_string($conn, $_POST["genderSU"]), 
        "contact_no"        => mysqli_real_escape_string($conn, $_POST["phoneSU"]), 
        "dob"               => mysqli_real_escape_string($conn, $_POST["dobSU"]), 
        "addr"              => mysqli_real_escape_string($conn, $_POST["addrSU"]), 
        "nationality"       => mysqli_real_escape_string($conn, $_POST["natSU"]), 
         
        "date_updated"      => date('Y-m-d H:i:s', strtotime("now"))
    );

    // Insert all the data in $studuni_info into the database.
    $updateProfile = $suInfo->update_profile($studuni_info);
   
    // Insert/Updating new postcode.
    // --- get the postcode based on city id.
    $postcodeInfo = $conn->query("SELECT * 
                                    FROM `postcode` as p 
                                    WHERE p.postcode_city_id = '".$_POST["cityID"]."';");

    // --- if the postcode already exists --> update, 
    // --- if not exists --> insert new.
    if($postcodeInfo->num_rows !== 0) {
        $insertPostcode = $conn->query("UPDATE `postcode` 
                                    SET `postcode_number`='" . $_POST["zipCode"] . "' 
                                    WHERE `postcode_city_id` = '".$_POST["cityID"]."';");
    } else {
        $insertPostcode = $conn->query("INSERT INTO `postcode`(`postcode_city_id`, `postcode_number`) 
                                    VALUES ('".$_POST["cityID"]."','" . $_POST["zipCode"] . "');");
    }
    
    // Check if the update is a success or failure.
    if($updateProfile) {
        // header("Location: ../student-edit-profile.php");
        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}
if(isset($_POST["suExp"])) {
    // Check if the experience descriptions is empty or not.
    if($_POST["expDesc"] === "") {
        echo "<script>alert('It's compulsory to fill in the Education Description.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
        $expDesc = mysqli_real_escape_string($conn, $_POST["expDesc"]);

        // Check if it's the current job or not.
        if(isset($_POST["jobStatus"])) {
            $jobStatus = mysqli_real_escape_string($conn, $_POST["jobStatus"]);
            $endDate = "0000-00-00";
        } else {
            $jobStatus = "Past";
            $endDate = $_POST["endDate"];
        }

        // Check if sued_id is not empty.
        $suedID = isset($_POST["suedID"]) ? $_POST["suedID"] : "";

        // Add all the student university's experience details in $suExp associative array.
        $suExp = array(
            
            "city_id"       => $_POST["cityID"], 
            "state_id"      => $_POST["stateID"], 
            "country_id"    => $_POST["countryID"], 
            "job_title"     => mysqli_real_escape_string($conn, $_POST["jobTitle"]), 
            "exp_desc"      => $expDesc, 
            "comp_name"     => mysqli_real_escape_string($conn, $_POST["compName"]), 
            "addr"          => mysqli_real_escape_string($conn, $_POST["address"]), 
            "start_date"    => $_POST["startDate"], 
            "end_date"      => $endDate, 
            "job_status"    => $jobStatus, 
            "sued_id"       => $suedID
        );

        if($_POST["suExp"] === "add") {
            // --- insert all the data in $suEdu into the database.
            $suExpInsert = $suInfo->insert_experience($suExp);
        } else if($_POST["suExp"] === "edit") {
            // --- insert all the new data in $suExp into the database.
            $suExpInsert = $suInfo->update_experience($suExp);
        }

        if($suExpInsert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Insert SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }

    exit();
}


if(isset($_GET["sued_id"])) {
    $suedID = $_GET["sued_id"];

    // Remove the data from database.
    $deleteExperience = $suInfo->delete_experience($suedID);

    if($deleteExperience) {
        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('System Error: Delete SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}
if(isset($_POST["suExperience"])) {
    // Check if the experience descriptions is empty or not.
    if(isset($_POST["comStatus"])) {
        $comStatus = mysqli_real_escape_string($conn, $_POST["comStatus"]);
        $enddate = "0000-00-00";
    } else {
        $comStatus = "Past";
        
    }

        // Check if sued_id is not empty.
        $suedID = isset($_POST["suedID"]) ? $_POST["suedID"] : "";

        // Add all the student university's experience details in $suExp associative array.
        $suExperience = array(
            
            "language_name"     => mysqli_real_escape_string($conn, $_POST["course"]),
            "com_name"     => mysqli_real_escape_string($conn, $_POST["com"]),
            "job_start_date"     => mysqli_real_escape_string($conn, $_POST["startdate"]),
            "job_end_date"     => mysqli_real_escape_string($conn, $_POST["enddate"]),
            "job_description"     => mysqli_real_escape_string($conn, $_POST["desc"]), 
            "com_status"    => $comStatus, 
            "sued_id"       => $suedID
        );

        if($_POST["suExperience"] === "add") {
            // --- insert all the data in $suEdu into the database.
            $suExperienceInsert = $suInfo->insert_experience($suExperience);
        } else if($_POST["suExperience"] === "edit") {
            // --- insert all the new data in $suExp into the database.
            $suExperienceInsert = $suInfo->update_experience($suExperience);
        }

        if($suExperienceInsert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Insert Language');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }

    exit();

if(isset($_GET["sued_id"])) {

    $suedID = $_GET["sued_id"];

    $suExperienceInfo = $this->dbconn->query(

        "DELETE FROM `student_university_experience_details` WHERE `sued_id` = $suedID;"    
    );

    // Remove the data from database.

    $deleteExperience = $suExperienceInfo($suedID);

    if($deleteExperience) {

        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");

    } else {

        echo "<script>alert('System Error: Delete SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";

    }



    exit();

}

/**-------------------------------------------------------- STUDENT PROFILE --------------------------------------------------------**/