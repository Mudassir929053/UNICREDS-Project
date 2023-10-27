<?php
include("../function/student-function.php");

// Constant values for the path.
define("COURSE_TUTORIAL_PATH", "../../assets/attachment/student/".$suID."/submission/course/tutorial/", true);
define("COURSE_ASSIGNMENT_PATH", "../../assets/attachment/student/".$suID."/submission/course/assignment/", true);
define("COURSE_PROJECT_PATH", "../../assets/attachment/student/".$suID."/submission/course/project/", true);

define("MC_TUTORIAL_PATH", "../../assets/attachment/student/".$suID."/submission/microcredential/tutorial/", true);
define("MC_ASSIGNMENT_PATH", "../../assets/attachment/student/".$suID."/submission/microcredential/assignment/", true);
define("MC_PROJECT_PATH", "../../assets/attachment/student/".$suID."/submission/microcredential/project/", true);


/*--------------------------------------------------------- VIDEO FUNCTION ---------------------------------------------------------*/

/**
 * Upload the video that has been watched.
 * Call function `insert_watched_video` from `Microcredential` class.
 * 
 * Return 'success' on success, alert message on failure.
 */
if(isset($_POST["videoProgress"])) {
    $tlmCat = $_POST["videoProgress"];
    $videoID = $_POST["videoID"];

    // echo "<script>alert('$suID & $tlmCat & $studuniID & $videoID')</script>";

    if($tlmCat === "course") {
        // --- for course.
        $insertData = $courseInfo->insert_watched_video($videoID);
    } else if($tlmCat === "mc") {
        // --- for micro-credential.
        $insertData = $mcInfo->insert_watched_video($videoID);
    }

    if($insertData) {
        echo "success";
    } else {
        echo "fail";
    }

    exit();
}

/**-------------------------------------------------------- VIDEO FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- FILE DISPLAY AJAX REQUEST ---------------------------------------------------------*/

/**
 * Fetch and display submitted tutorial, assignment, and project file.
 * Call function `fetch_tutorial_submission`, `fetch_assignment_submission`, and `fetch_project_submission` 
 * from `Microcredential` class.
 * 
 * Return json encoded associative array if not NULL.
 */
if(isset($_POST["fetchUploadedFile"])) {
    $tlmCat = $_POST["fetchUploadedFile"][0];
    $tlmType = $_POST["fetchUploadedFile"][1];
    $tlmID = $_POST["tlm_id"];

    // Check if it's course or micro-credential.
    if($tlmCat === "course") {
        // --- for course.
        switch($tlmType) {
            case "tutorial":
                $dirPath = COURSE_TUTORIAL_PATH;
                $tlmInfo = $courseInfo->fetch_tutorial_submission($tlmID);
                $fileName = $tlmInfo["suctus_attachment"];
                break;
            case "assignment":
                $dirPath = COURSE_ASSIGNMENT_PATH;
                $tlmInfo = $courseInfo->fetch_assignment_submission($tlmID);
                $fileName = $tlmInfo["sucas_attachment"];
                break;
            case "project":
                $dirPath = COURSE_PROJECT_PATH;
                $tlmInfo = $courseInfo->fetch_project_submission($tlmID);
                $fileName = $tlmInfo["sucps_attachment"];
                break;
            default:
                exit();
        }
    } else if($tlmCat === "mc") {
        // --- for micro-credential.
        switch($tlmType) {
            case "tutorial":
                $dirPath = MC_TUTORIAL_PATH;
                $tlmInfo = $mcInfo->fetch_tutorial_submission($tlmID);
                $fileName = $tlmInfo["sumctus_attachment"];
                break;
            case "assignment":
                $dirPath = MC_ASSIGNMENT_PATH;
                $tlmInfo = $mcInfo->fetch_assignment_submission($tlmID);
                $fileName = $tlmInfo["sumcas_attachment"];
                break;
            case "project":
                $dirPath = MC_PROJECT_PATH;
                $tlmInfo = $mcInfo->fetch_project_submission($tlmID);
                $fileName = $tlmInfo["sumcps_attachment"];
                break;
            default:
                exit();
        }
    }

    if($tlmInfo !== NULL) {
        $file = scandir($dirPath);
        if($file) {
            foreach($file as $val) {
                if($val === $fileName) {
                    echo json_encode(
                        array(
                            "fileName"  => $fileName, 
                            "fileSize"  => filesize($dirPath . $fileName), 
                            "filePath"  => $dirPath . $fileName, 
                            "fileCount" => 1
                        )
                    );
                }
            }
        }
    }

    exit();
}

/**-------------------------------------------------------- FILE DISPLAY AJAX REQUEST --------------------------------------------------------**/


/*--------------------------------------------------------- FILE UPLOAD AJAX REQUEST ---------------------------------------------------------*/

/**
 * Upload tutorial file submission.
 * Call function `insert_tutorial_submission` from `Microcredential` class.
 * 
 * Return json encoded associative array on success, alert message on failure.
 */
if(isset($_POST["uploadFile"])) {
    $tlmCat = $_POST["tlm_cat"];
    $tlmType = $_POST["uploadFile"];
    $tlmID = $_POST["tlm_id"];
    $currDate = date('Y-m-d H:i:s', strtotime("now"));

    // Uploaded file validation.
    if(!empty($_FILES)) {
        $fileName = $_FILES["file"]["name"];
        $fileTemp = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $uploadOk = 1;

        // --- allowed file types.
        $allowExt = array("doc", "docx", "pdf");

        // --- check file size.
        if($fileSize > 104857600) { // --- 100MB limit.
            echo "<script>alert('Sorry, this file is too large (Must < 100MB).');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        }
        // --- check file extension type.
        if(!in_array($fileExt, $allowExt)) {
            echo "<script>alert('Sorry, only DOC, DOCX, and PDF files are allowed.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
            $uploadOk = 0;
        }

        // Upload the file and store the data in database.
        if($uploadOk == 1) {
            // Check if it's course or micro-credential.
            if($tlmCat === "course") {
                // --- for course.
                switch($tlmType) {
                    case "tutorial":
                        $dirPath = COURSE_TUTORIAL_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $courseInfo->insert_tutorial_submission($tlmID, $fileName);
    
                        $showCheck = "#showTutorialCheck";
                        $showStatus = "#showTutorialStatus";
                        $showDate = "#showTutorialDateModified";
                        break;
                    case "assignment":
                        $dirPath = COURSE_ASSIGNMENT_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $courseInfo->insert_assignment_submission($tlmID, $fileName);
    
                        $showCheck = "#showAssignmentCheck";
                        $showStatus = "#showAssignmentStatus";
                        $showDate = "#showAssignmentDateModified";
                        break;
                    case "project":
                        $dirPath = COURSE_PROJECT_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $courseInfo->insert_project_submission($tlmID, $fileName);
                        
                        $showCheck = "#showProjectCheck";
                        $showStatus = "#showProjectStatus";
                        $showDate = "#showProjectDateModified";
                        break;
                    default:
                        exit();
                }
            } else if($tlmCat === "mc") {
                // --- for micro-credential.
                switch($tlmType) {
                    case "tutorial":
                        $dirPath = MC_TUTORIAL_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $mcInfo->insert_tutorial_submission($tlmID, $fileName);
    
                        $showCheck = "#showTutorialCheck";
                        $showStatus = "#showTutorialStatus";
                        $showDate = "#showTutorialDateModified";
                        break;
                    case "assignment":
                        $dirPath = MC_ASSIGNMENT_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $mcInfo->insert_assignment_submission($tlmID, $fileName);
    
                        $showCheck = "#showAssignmentCheck";
                        $showStatus = "#showAssignmentStatus";
                        $showDate = "#showAssignmentDateModified";
                        break;
                    case "project":
                        $dirPath = MC_PROJECT_PATH;
                        $filePath = $dirPath . $fileName;
                        // --- store the file in database.
                        $upStatus = $mcInfo->insert_project_submission($tlmID, $fileName);
                        
                        $showCheck = "#showProjectCheck";
                        $showStatus = "#showProjectStatus";
                        $showDate = "#showProjectDateModified";
                        break;
                    default:
                        exit();
                }
            }
        
            // --- store the file in directory.
            if($upStatus) {
                move_uploaded_file($fileTemp, $filePath);

                echo json_encode(
                    array(
                        "check"      => '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>', 
                        "status"     => "Submitted", 
                        "date"       => $currDate, 
                        "showCheck"  => $showCheck, 
                        "showStatus" => $showStatus, 
                        "showDate"   => $showDate
                    )
                );
            } else {
                echo "Error: Uploading Tutorial file --> database\n";
                echo $tlmType;
            }
        } else {
            echo "<script>alert('Error: Uploading Tutorial --> file not valid.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        echo "<script>alert('Empty files');location.href = '$_SERVER[HTTP_REFERER]';</script>";
    }

    exit();
}

/**-------------------------------------------------------- FILE UPLOAD AJAX REQUEST --------------------------------------------------------**/


/*--------------------------------------------------------- FILE REMOVE AJAX REQUEST ---------------------------------------------------------*/

/**
 * Remove/Delete tutorial file.
 * Call functions `fetch_tutorial_submission` and `remove_tutorial_submission` from `Microcredential` class.
 * 
 * Return json encoded associative array.
 */
if(isset($_POST["deleteUploadedFile"])) {
    $tlmCat = $_POST["deleteUploadedFile"][0];
    $tlmType = $_POST["deleteUploadedFile"][1];
    $tlmID = $_POST["tlm_id"];
    $currDate = date('Y-m-d H:i:s', strtotime("now"));

    // Check if it's course or micro-credential.
    if($tlmCat === "course") {
        // for course.
        switch($tlmType) {
            case "tutorial":
                $showCheck = "#showTutorialCheck";
                $showStatus = "#showTutorialStatus";
                $showDate = "#showTutorialDateModified";
    
                $dirPath = COURSE_TUTORIAL_PATH;
                // --- fetch data (file name).
                $fileName = $courseInfo->fetch_tutorial_submission($tlmID)["suctus_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $courseInfo->remove_tutorial_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            case "assignment":
                $showCheck = "#showAssignmentCheck";
                $showStatus = "#showAssignmentStatus";
                $showDate = "#showAssignmentDateModified";
    
                $dirPath = COURSE_ASSIGNMENT_PATH;
                // --- fetch data (file name).
                $fileName = $courseInfo->fetch_assignment_submission($tlmID)["sucas_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $courseInfo->remove_assignment_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            case "project":
                $showCheck = "#showProjectCheck";
                $showStatus = "#showProjectStatus";
                $showDate = "#showProjectDateModified";
    
                $dirPath = COURSE_PROJECT_PATH;
                // --- fetch data (file name).
                $fileName = $courseInfo->fetch_project_submission($tlmID)["sucps_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $courseInfo->remove_project_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            default:
                exit();
        }
    } else if($tlmCat === "mc") {
        // for micro-credential.
        switch($tlmType) {
            case "tutorial":
                $showCheck = "#showTutorialCheck";
                $showStatus = "#showTutorialStatus";
                $showDate = "#showTutorialDateModified";
    
                $dirPath = MC_TUTORIAL_PATH;
                // --- fetch data (file name).
                $fileName = $mcInfo->fetch_tutorial_submission($tlmID)["sumctus_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $mcInfo->remove_tutorial_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            case "assignment":
                $showCheck = "#showAssignmentCheck";
                $showStatus = "#showAssignmentStatus";
                $showDate = "#showAssignmentDateModified";
    
                $dirPath = MC_ASSIGNMENT_PATH;
                // --- fetch data (file name).
                $fileName = $mcInfo->fetch_assignment_submission($tlmID)["sumcas_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $mcInfo->remove_assignment_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            case "project":
                $showCheck = "#showProjectCheck";
                $showStatus = "#showProjectStatus";
                $showDate = "#showProjectDateModified";
    
                $dirPath = MC_PROJECT_PATH;
                // --- fetch data (file name).
                $fileName = $mcInfo->fetch_project_submission($tlmID)["sumcps_attachment"];
    
                // --- remove data from directory.
                if(unlink($dirPath . $fileName)) {
                    // --- remove the data from database.
                    $mcInfo->remove_project_submission($tlmID);
                    $deleteOk = true;
                } else {
                    $deleteOk = false;
                }
                break;
            default:
                exit();
        }
    }

    if($deleteOk) {
        echo json_encode(
            array(
                "status"     => "Not submitted", 
                "date"       => $currDate, 
                "showCheck"  => $showCheck, 
                "showStatus" => $showStatus, 
                "showDate"   => $showDate
            )
        );
    } else {
        echo json_encode(
            array(
                "status"     => "Error: File not unlinked", 
                "date"       => $currDate, 
                "showCheck"  => $showCheck, 
                "showStatus" => $showStatus, 
                "showDate"   => $showDate
            )
        );
    }

    exit();
}

/**-------------------------------------------------------- FILE REMOVE AJAX REQUEST --------------------------------------------------------**/