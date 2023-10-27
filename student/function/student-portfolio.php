<?php
include("../function/student-function.php");


/*--------------------------------------------------------- STUDENT UNIVERSITY CURRICULUM VITAE ---------------------------------------------------------*/

/**
 * Upload student university's curriculum vitae (CV).
 * It will upload the file in related student university's directory.
 * If there is an existing CV, it will override it with new CV.
*/
if(isset($_POST["uploadCV"])) {
    // Directory for the CV file to be uploaded.
    $dirPath = "../../assets/attachment/student/$suID/cv/";
    $uploadOk = 1;

    if(!empty($_FILES["studentCV"]["name"])) {
        // If there is existing CV, remove it from directory.
        if(isset($_POST["currCV"])) {
            unlink($dirPath . $_POST["currCV"]);
        }

        $fileName = basename($_FILES["studentCV"]["name"]);
        $fileTmp = $_FILES["studentCV"]["tmp_name"];
        $filePath = $dirPath . $fileName;
        $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Allowed file types.
        $allowExt = array("pdf");

        // File validation.
        if(file_exists($filePath)) {
            echo "<script>alert('Sorry, this file already exists.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
            exit();
        } 
        if($_FILES["studentCV"]["size"] > 41943040) { // 40MB limit.
            echo "<script>alert('Sorry, this file is too large (> 40MB).');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
            exit();
        } 
        if(!in_array($fileExt, $allowExt)) {
            echo "<script>alert('Sorry, only PDF files are allowed.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
            exit();
        }

        // Upload file.
        if($uploadOk == 1) {
            // --- upload file into the specified directory.
            move_uploaded_file($fileTmp, $filePath);

            // --- add file path into DB.
            $uploadsuCV = $suInfo->update_cv($fileName);
            
            // --- check if the update is a success or failure.
            if($uploadsuCV) {
                echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('Error: Upload CV.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Please select a file to be uploaded.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/** 
 * Delete the current student university's curriculum vitae (CV).
 * Remove the file from the directory and database.
*/
if(isset($_GET["delCV"])) {
    $fileName = $_GET["delCV"];
    $fileDir = "../../assets/attachment/student/$suID/cv/";

    // Check if the remove operation successfull or not.
    if(unlink($fileDir . $fileName)) {
        // --- update su_cv to NULL.
        $delCV = $suInfo->update_cv(NULL);
        
        // --- check if the update is a success or failure.
        if($delCV) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Update SU.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Error removing file from directory.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**-------------------------------------------------------- STUDENT UNIVERSITY CURRICULUM VITAE --------------------------------------------------------**/


/*--------------------------------------------------------- STUDENT UNIVERSITY JOB EXPERIENCE ---------------------------------------------------------*/

/**
 * Insert new/Update current student university's job experience.
 * Pass all the data to the `insert_experience` or `update_experience` function in `Student` class 
 * based on the type of operation (value in $_POST["suExp"]).
*/

// Education

if(isset($_POST["suEdu"])) {
    // Check if the experience descriptions is empty or not.
    if($_POST["eduDesc"] === "") {
        echo "<script>alert('It's compulsory to fill in the Education Description.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
        $eduDesc = mysqli_real_escape_string($conn, $_POST["eduDesc"]);

        // Check if it's the current job or not.
        if(isset($_POST["courseStatus"])) {
            $courseStatus = mysqli_real_escape_string($conn, $_POST["courseStatus"]);
            $endDate = "0000-00-00";
        } else {
            $courseStatus = "Past";
            
        }

        // Check if sued_id is not empty.
        $suedID = isset($_POST["suedID"]) ? $_POST["suedID"] : "";

        // Add all the student university's experience details in $suExp associative array.
        $suEdu = array(
            
            "course_title"     => mysqli_real_escape_string($conn, $_POST["courseTitle"]), 
            "course_desc"      => $eduDesc, 
            "college_name"     => mysqli_real_escape_string($conn, $_POST["collegeName"]), 
            
            "start_course_date"    => $_POST["startDate"], 
            "course_end_date"      => $_POST["endDate"],
            "course_status"    => $courseStatus, 
            "sued_id"       => $suedID
        );

        if($_POST["suEdu"] === "add") {
            // --- insert all the data in $suEdu into the database.
            $suEduInsert = $suInfo->insert_education($suEdu);
        } else if($_POST["suEdu"] === "edit") {
            // --- insert all the new data in $suExp into the database.
            $suEduInsert = $suInfo->update_education($suEdu);
        }

        if($suEduInsert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Insert SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }

    exit();
}
// public function delete_education($sued_id) {
//     $suEduInfo = $this->dbconn->query(
//         "DELETE FROM `student_university_education_details` WHERE `sued_id` = {$sued_id};"      
     
//     );
//     // -- DELETE FROM `student_university_education_details` 
//     // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
//     if($suEduInfo) {
//         return true;
//     } else {
//         return false;
//     }

//     exit();
// }

if(isset($_GET["sued_id"])) {

    $suedID = $_GET["sued_id"];

    $suEduInfo = $this->dbconn->query(

        "DELETE FROM `student_university_education_details` WHERE `sued_id` = $suedID;"    
    );

    // Remove the data from database.

    $deleteEducation = $suEduInfo($suedID);

    if($deleteEducation) {

        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");

    } else {

        echo "<script>alert('System Error: Delete SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";

    }



    exit();

}
// reference
if(isset($_POST["suReference"])) {
    // Check if the experience descriptions is empty or not.
    if($_POST["referenceDesc"] === "") {
        echo "<script>alert('It's compulsory to fill in the reference Description.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
        $referenceDesc = mysqli_real_escape_string($conn, $_POST["referenceDesc"]);

        // Check if it's the current job or not.
      
        // Check if sued_id is not empty.
        $suedID = isset($_POST["suedID"]) ? $_POST["suedID"] : "";

        // Add all the student university's experience details in $suExp associative array.
        $suReference = array(
            "reference"      => $referenceDesc, 
            "sued_id"       => $suedID
        );

        if($_POST["suReference"] === "add") {
            // --- insert all the data in $suEdu into the database.
            $suReferenceInsert = $suInfo->insert_reference($suReference);
        } else if($_POST["suReference"] === "edit") {
            // --- insert all the new data in $suExp into the database.
            $suReferenceInsert = $suInfo->update_reference($suReference);
        }

        if($suReferenceInsert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
           
           
          
        } else {
            echo "<script>alert('System Error: Insert SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";
         
        }
    }

    exit();
}

// public function delete_education($sued_id) {
//     $suEduInfo = $this->dbconn->query(
//         "DELETE FROM `student_university_education_details` WHERE `sued_id` = {$sued_id};"      
     
//     );
//     // -- DELETE FROM `student_university_education_details` 
//     // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
//     if($suEduInfo) {
//         return true;
//     } else {
//         return false;
//     }

//     exit();
// }

if(isset($_GET["sued_id"])) {

    $suedID = $_GET["sued_id"];

    $suReferenceInfo = $this->dbconn->query(

        "DELETE FROM `student_university_reference_details` WHERE `sued_id` = $suedID;"    
    );

    // Remove the data from database.

    $deleteReference = $suReferenceInfo($suedID);

    if($deleteReference) {

        echo ("<script>alert('success')</script>");

    } else {

        echo "<script>alert('System Error: Delete SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";

    }



    exit();

}

// reference end



/**
 * Insert new student university's skill set.
 * Pass all the data to the `insert_skill` function in `Student` class based on the type of operation (value in $_POST["suSkill"]).
 * It will also upload skill certificate to the directory and database, if it exists.
*/
if(isset($_POST["addSkill"])) {
    // Directory for the certificate file to be uploaded, if exists.
    
    $dirPath = "../../assets/attachment/student/$suID/skillcert/";
    // Number of skills inserted.
    $inputCount = count($_POST["skillTitle"]);
    // Upload status.
    $uploadOk = 1;

    if($inputCount > 0) {
        for($i = 0; $i < $inputCount; $i++) {
            $fileName = NULL;
            $certDate = NULL;
            $certProvider = NULL;

            // Check for certificate if uploaded.
            if(!empty($_FILES["upCert"]["name"][$i])) {
                $fileName = $_FILES["upCert"]["name"][$i];
                $fileTmp = $_FILES["upCert"]["tmp_name"][$i];
                $filePath = $dirPath . $fileName;
                $fileSize = $_FILES["upCert"]["size"][$i];
                $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);

                // Allowed file types.
                $allowExt = array("pdf", "doc", "docx");
    
                // File validation.
                if(file_exists($filePath)) {
                    echo "<script>alert('Sorry, this file already exists.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                    $uploadOk = 0;
                    exit();
                } 
                if($fileSize > 41943040) { // 40MB limit.
                    echo "<script>alert('Sorry, this file is too large (Must < 40MB).');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                    $uploadOk = 0;
                    exit();
                } 
                if(!in_array($fileExt, $allowExt)) {
                    echo "<script>alert('Sorry, only PDF, DOC, and DOCX files are allowed.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                    $uploadOk = 0;
                    exit();
                }

                // Upload file.
                if($uploadOk == 1) {
                    // --- upload file into the specified directory.
                    move_uploaded_file($fileTmp, $filePath);
                } else {
                    echo "<script>alert('Error: Upload Skill Certificate.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                    exit();
                }

                // Store the certificate date and provider data.
                $certDate = $_POST["certDate"][$i];
                $certProvider = mysqli_real_escape_string($conn, $_POST["certProvider"][$i]);
            }

            // Push all the skill info into associative array.
            $suSkill = array(
                "skill_name" => mysqli_real_escape_string($conn, $_POST["skillTitle"][$i]), 
                "skill_lvl"  => $_POST["skillLvl"][$i], 
                "skill_cert" => $fileName, 
                "cert_prvd"  => $certProvider, 
                "cert_date"  => $certDate
            );

            // Insert new skill set.
            $suSkillInsert = $suInfo->insert_skill($suSkill);
            
            if($suSkillInsert) {
                echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
            } else {
                echo "<script>alert('System Error: Insert Skill');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        }
    } else {
        echo "<script>alert('Please insert all the required fields.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**
 * Update current student university's skill informations.
 * Only store the new skill name and skill proficiency level.
 */
if(isset($_POST["editSkillInfo"])) {
    // Push all the skill info into an associative array.
    $suSkill = array(
        "skill_id"   => $_POST["skill_type_id"], 
        "sus_id"     => $_POST["su_skill_id"], 
        "skill_name" => mysqli_real_escape_string($conn, $_POST["skill_name"]), 
        "skill_lvl"  => $_POST["skill_lvl"], 
        "skill_cert" => NULL
    );

    // Update current skill set.
    $suSkillUpdate = $suInfo->update_skill($suSkill);
    
    if($suSkillUpdate) {
        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('System Error: Update Skill Info');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**
 * Update current student university's skill certificate information.
 * It will override the current skill certificate, if exists.
 */
if(isset($_POST["upSkillCert"])) {
    // Directory for the cert file to be uploaded.
    $dirPath = "../../assets/attachment/student/{$suID}/skillcert/";
    // Upload status.
    $uploadOk = 1;
    $susID = $_POST["su_skill_id"];

    // Check for new uploaded file.
    if(!empty($_FILES["skill_cert"]["name"])) {
        // Check if the certificate date and provider inserted.
        if(isset($_POST["skill_prvd_name"]) && isset($_POST["skill_date"])) {
            // --- pass the value.
            $certPrvd = mysqli_real_escape_string($conn, $_POST["skill_prvd_name"]);
            $certDate = $_POST["skill_date"];

            // --- remove old file from directory.
            $getOldFile = $conn->query("SELECT sus.sus_skill_certificate FROM `student_university_skill_set` AS sus WHERE sus.sus_id = '$susID';");
            $getOldFileRow = mysqli_fetch_object($getOldFile);
            if($getOldFileRow->sus_skill_certificate !== NULL) {
                unlink($dirPath . $getOldFileRow->sus_skill_certificate);
            }
    
            $fileName = basename($_FILES["skill_cert"]["name"]);
            $fileTmp = $_FILES["skill_cert"]["tmp_name"];
            $filePath = $dirPath . $fileName;
            $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
            // --- allowed file types.
            $allowExt = array("pdf", "doc", "docx");
    
            // --- file validation.
            if(file_exists($filePath)) {
                echo "<script>alert('Sorry, this file already exists.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                $uploadOk = 0;
                exit();
            } 
            if($_FILES["skill_cert"]["size"] > 41943040) { // 40MB limit.
                echo "<script>alert('Sorry, this file is too large (> 40MB).');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                $uploadOk = 0;
                exit();
            } 
            if(!in_array($fileExt, $allowExt)) {
                echo "<script>alert('Sorry, only PDF, DOC, and DOCX files are allowed.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                $uploadOk = 0;
                exit();
            }
    
            // --- upload file.
            if($uploadOk == 1) {
                // --- upload file into the specified directory.
                move_uploaded_file($fileTmp, $filePath);

                // Push all the skill info into an associative array.
                $suSkill = array(
                    "sus_id"     => $_POST["su_skill_id"], 
                    "skill_cert" => $fileName, 
                    "cert_prvd"  => mysqli_real_escape_string($conn, $_POST["skill_prvd_name"]), 
                    "cert_date"  => $_POST["skill_date"]
                );

                // Update current skill set.
                $suSkillUpdate = $suInfo->update_skill($suSkill);
                
                if($suSkillUpdate) {
                    echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
                } else {
                    echo "<script>alert('System Error: Update Skill Info');location.href = '$_SERVER[HTTP_REFERER]';</script>";
                }
            } else {
                echo "<script>alert('Error: Upload Skill Certificate.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        } else {
            echo "<script>alert('The Date and/or Provider input field must be filled.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Must upload a file.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**
 * Delete current student university's skill certificate.
 * Remove the certificate from the directory.
 */
if(isset($_GET["delSkillCert"])) {
    // Skill certificate directory.
    $certLink = "../".$_GET["delSkillCert"];

    // Push all the skill info into an associative array.
    $suSkill = array(
        "sus_id"     => $_GET["su_skill_id"], 
        "skill_id" => NULL
    );

    // Remove the certificate from directory.
    if(unlink($certLink)) {
        // --- remove certificate from database.
        $removeSkillCert = $suInfo->delete_skill($suSkill);

        if($removeSkillCert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Delete from database.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Error: Remove file from dir --> \"$certLink\"');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**
 * Delete current student university's skill set.
 * Remove the certificate from directory, if exists.
 */
if(isset($_GET["delSkillSet"])) {
    // Store certificate directory, if exists.
    $certLink = empty($_GET["delSkillSet"]) ? "" : "../".$_GET["delSkillSet"];

    // Remove certificate from directory, if exists.
    if($certLink !== "") {
       
    }
    
    // Push all the skill info into an associative array.
    $suSkill = array(
        "sus_id"     => $_GET["su_skill_id"], 
        "skill_id" => $_GET["skill_id"]
    );

    // Remove certificate from database.
    $removeSkillCert = $suInfo->delete_skill($suSkill);

    if($removeSkillCert) {
        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
    } else {
        echo "<script>alert('System Error: Delete from database.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}




/**-------------------------------------------------------- STUDENT UNIVERSITY SKILL SET --------------------------------------------------------**/
// hobby
if(isset($_POST["suHobby"])) {
    // Check if the experience descriptions is empty or not.
   

        // Check if sued_id is not empty.
        $suedID = isset($_POST["suedID"]) ? $_POST["suedID"] : "";

        // Add all the student university's experience details in $suExp associative array.
        $suHobby = array(
            
            "hobby_name"     => mysqli_real_escape_string($conn, $_POST["courseTitle"]), 
           
            "sued_id"       => $suedID
        );

        if($_POST["suHobby"] === "add") {
            // --- insert all the data in $suEdu into the database.
            $suHobbyInsert = $suInfo->insert_hobby($suHobby);
        } else if($_POST["suHobby"] === "edit") {
            // --- insert all the new data in $suExp into the database.
            $suHobbyInsert = $suInfo->update_hobby($suHobby);
        }

        if($suHobbyInsert) {
            echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
        } else {
            echo "<script>alert('System Error: Insert SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }

    exit();

// public function delete_education($sued_id) {
//     $suEduInfo = $this->dbconn->query(
//         "DELETE FROM `student_university_education_details` WHERE `sued_id` = {$sued_id};"      
     
//     );
//     // -- DELETE FROM `student_university_education_details` 
//     // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
//     if($suEduInfo) {
//         return true;
//     } else {
//         return false;
//     }

//     exit();
// }

if(isset($_GET["sued_id"])) {

    $suedID = $_GET["sued_id"];

    $suHobbyInfo = $this->dbconn->query(

        "DELETE FROM `student_university_hobby_details` WHERE `sued_id` = $suedID;"    
    );

    // Remove the data from database.

    $deleteHobby = $suHobbyInfo($suedID);

    if($deleteHobby) {

        echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");

    } else {

        echo "<script>alert('System Error: Delete SUED.')location.href = '$_SERVER[HTTP_REFERER]';</script>";

    }



    exit();

}

//  hobby end
