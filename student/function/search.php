<?php
include("../function/student-function.php");

use DBData\Course as c;
use DBData\Microcredential as mc;

// Instantiation of classes.
$courseInfo = new c($suID);
$mcInfo = new mc($suID);


/*--------------------------------------------------------- SEARCH RESULTS FUNCTION ---------------------------------------------------------*/

/**
 * Function that contain strings of HTML code to display the empty result search box dropdown and __search-results.php__ page.
 * 
 * @return string string of HTML code.
 */
function emptyResult() {
    $returnString = (
        '<!-- No contents -->' . 
        '<div class="d-flex justify-content-center">' . 
            '<div class="text-center">' . 
                '<h4 class="mb-2 mt-2 fw-bold">Sorry, there\'s no matching results.</h4>' . 
            '</div>' . 
        '</div>'
    );

    return $returnString;

    exit();
}

/**
 * Function that contain strings of HTML code to display the results of the search query in search box dropdown.
 * 
 * @param array $displayArr an associative array that contain the results of the search query.
 * @return string string of HTML code.
 */
function searchResult($displayArr) {
    $returnString = "";

    foreach($displayArr as $val) {
        $returnString .= (
            '<li class="list-group-item list-group-item-action text-truncate" href="#">' . 
                '<div class="row" style="width: 600px;">' . 
                    '<div class="col">' . 
                        '<a class="text-body" href="'.$val["link"].'">' . 
                            '<div class="d-flex align-items-center justify-content-between w-100">' . 
                                '<span class="avatar avatar-lg border" style="width: 100px;">' . 
                                    '<img src="'.$val["image"].'" alt="" class="rounded">' . 
                                '</span>' . 
                                '<div class="ms-3" style="width: 450px;">' . 
                                    '<h5 class="fw-bold mb-2 text-truncate">'.$val["name"].'</h5>' . 
                                    '<div class="mb-2 text-wrap text-truncate-line-2">' . 
                                        $val["description"] . 
                                    '</div>' . 
                                    '<span class="fs-6 text-muted">' . 
                                        '<span>' . 
                                            '<span class="fe fe-users text-warning me-1"></span>' . 
                                            '<span class="text-dark">Total enrolled: </span>' . 
                                            $val["total_enrolled"] . 
                                        '</span>' . 
                                    '</span>' . 
                                '</div>' . 
                            '</div>' . 
                        '</a>' . 
                    '</div>' . 
                '</div>' . 
            '</li>'
        );
    }

    return $returnString;

    exit();
}

/**
 * Function to process all the course information into the data that suitable to be displayed.
 * 
 * @param array $courseData associative 2D array that contains all necessary information of courses.
 * @param array $enrolledCourse associative 2D array that contains all necessary information of enrolled courses.
 * @param array associative 2D array.
 */
function parseCourse($courseData,$enrolledCourse) {
    $dataArr = array();

    foreach($courseData as $val) {
        $course_id = $val["course_id"];
        $link = "course-enroll.php?course_id={$course_id}";
        $enrolled = false;
        $image = $val["course_image"] !== NULL ? "../assets/images/course/".$val["course_image"] : "../assets/images/course/course-default.jpg";
        $total_enrolled = $val["course_total_enrolled"] !== NULL ? $val["course_total_enrolled"]." enrolled" : "<span class='text-muted'><em>No enrollment</em></span>";

        // check whether the course are enrolled or not.
        if($enrolledCourse !== NULL) {
            foreach($enrolledCourse as $enroll) {
                if($enroll["ecsu_course_id"] === $course_id) {
                    $link = "course-view-enrolled.php?course_id={$course_id}&amp;pill=desc";
                    $enrolled = true;
                }
            }
        }

        $storeInfo = array(
            "link"              => $link, 
            "enrolled"          => $enrolled, 
            "image"             => $image, 
            "name"              => $val["course_title"], 
            "description"       => $val["course_description"], 
            "total_enrolled"    => $total_enrolled
        );

        array_push($dataArr, $storeInfo);
    }

    return $dataArr;

    exit();
}

/**
 * Function to process all the micro-credentials information into the data that suitable to be displayed.
 * 
 * @param array $mcData associative 2D array that contains all necessary information of micro-credentials.
 * @param array $enrolledMC associative 2D array that contains all necessary information of enrolled micro-credentials.
 */
function parseMC($mcData, $enrolledMC) {
    $dataArr = array();

    foreach($mcData as $val) {
        $mc_id = $val["mc_id"];
        $link = "micro-creds-enroll.php?mc_id={$mc_id}";
        $enrolled = false;
        $image = "../assets/images/microcredential/".$val["mc_image"];
        $total_enrolled = $val["mc_total_enrolled"] !== NULL ? $val["mc_total_enrolled"]." enrolled" : "<span class='text-muted'><em>No enrollment</em></span>";
    
        // check whether the micro-credentials are enrolled or not.
        if($enrolledMC !== NULL) {
            foreach($enrolledMC as $enroll) {
                if($enroll["emcsu_mc_id"] === $mc_id) {
                    $link = "micro-creds-view-enrolled.php?mc_id={$mc_id}&amp;pill=desc";
                    $enrolled = true;
                }
            }
        }
    
        $storeInfo = array(
            "link"              => $link, 
            "enrolled"          => $enrolled, 
            "image"             => $image, 
            "name"              => $val["mc_title"], 
            "description"       => $val["mc_description"], 
            "total_enrolled"    => $total_enrolled
        );

        array_push($dataArr, $storeInfo);
    }

    return $dataArr;

    exit();
}

/**-------------------------------------------------------- SEARCH RESULTS FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- SEARCH AJAX REQUEST ---------------------------------------------------------*/

/**
 * Function to process Course SQL statement.
 * 
 * @param string $query string of the search query.
 * @param string $type can be either `matched` or `relevant`.
 * @return string SQL LIKE operator statement.
 */
function courseQuery($query, $type) {
    if($type === "matched") {
        $str = "c.course_title LIKE '%".$query."%' OR c.course_code LIKE '%".$query."%'";
    } else if($type === "relevant") {
        $str = "c.course_description LIKE '%".$query."%'";
    }

    return $str;

    exit();
}

/**
 * Function to process Micro-credential SQL statement.
 * 
 * @param string $query string of the search query.
 * @param string $type can be either `matched` or `relevant`.
 * @return string SQL LIKE operator statement.
 */
function mcQuery($query, $type) {
    if($type === "matched") {
        $str = "mc.mc_title LIKE '%".$query."%' OR mc.mc_code LIKE '%".$query."%'";
    } else if($type === "relevant") {
        $str = "mc.mc_description LIKE '%".$query."%' OR mcld.mcld_learning_outcome LIKE '%".$query."%' OR mcld.mcld_intended_learners LIKE '%".$query."%' OR mcld.mcld_prerequisites LIKE '%".$query."%' OR mcld.mcld_skills LIKE '%".$query."%'";
    }

    return $str;

    exit();
}

/**
 * Function to process the search query into SQL LIKE operator statement.
 * 
 * @param string $searchQuery string of the search query.
 * @param string $subjType can be either `course` or `mc`.
 * @param string $resultType can be either `matched` or `relevant`.
 * @return string SQL LIKE operator statement.
 */
function processQuery($searchQuery, $subjType, $resultType) {
    $strResult = "";
    $strArr = explode(" ", $searchQuery);

    foreach($strArr as $key => $val) {
        if($key === array_key_first($strArr)) {
            $strResult .= $subjType === "course" ? courseQuery($val, $resultType) : mcQuery($val, $resultType);
        } else {
            if($val !== "") {
                $strResult .= " OR ".($subjType === "course" ? courseQuery($val, $resultType) : mcQuery($val, $resultType));
            }
        }
    }

    return $strResult;

    exit();
}

/**
 * Matched search results.
 */
if(isset($_POST["matchedSearch"])) {
    $searchQuery = $_POST["matchedSearch"];

    // Fetch all the related courses and/or micro-credentials based on the search query.
    $courseSearch = $courseInfo->fetch_courses(processQuery($searchQuery, "course", "matched"));
    $mcSearch = $mcInfo->fetch_microcredentials(processQuery($searchQuery, "mc", "matched"));
    // Fetch all the enrolled courses and micro-credentials.
    $courseEnrolled = $courseInfo->fetch_enrolled_courses();
    $mcEnrolled = $mcInfo->fetch_enrolled_microcredentials();

    if(($courseSearch !== NULL) || ($mcSearch !== NULL)) {
        if($courseSearch === NULL) {
            $searchResult = parseMC($mcSearch, $mcEnrolled);
        } else if($mcSearch === NULL) {
            $searchResult = parseCourse($courseSearch, $courseEnrolled);
        } else {
            $searchResult = array_merge(parseCourse($courseSearch, $courseEnrolled), parseMC($mcSearch, $mcEnrolled));
        }

        array_multisort(array_column($searchResult, "name"), SORT_ASC, SORT_STRING, $searchResult);
        echo searchResult($searchResult);
    } else {
        echo emptyResult();
    }

    exit();
}

/**
 * Relevant search results.
 */
// if(isset($_POST["relevantSearch"])) {
//     $searchQuery = $_POST["relevantSearch"];

//     // Fetch all the related courses and/or micro-credentials based on the search query.
//     $courseSearch = $courseInfo->fetch_on_operator(processQuery($searchQuery, "course", "relevant"));
//     $mcSearch = $mcInfo->fetch_on_operator(processQuery($searchQuery, "mc", "relevant"));
//     // Fetch all the enrolled courses and micro-credentials.
//     $courseEnrolled = $courseInfo->fetch_enrolled_studuni();
//     $mcEnrolled = $mcInfo->fetch_enrolled_studuni();

//     if(($courseSearch !== NULL) || ($mcSearch !== NULL)) {
//         if($courseSearch === NULL) {
//             $searchResult = parseMC($mcSearch, $mcEnrolled);
//         } else if($mcSearch === NULL) {
//             $searchResult = parseCourse($courseSearch, $courseEnrolled);
//         } else {
//             $searchResult = array_merge(parseCourse($courseSearch, $courseEnrolled), parseMC($mcSearch, $mcEnrolled));
//         }

//         array_multisort(array_column($searchResult, "name"), SORT_ASC, SORT_STRING, $searchResult);
//         echo searchResult($searchResult);
//     } else {
//         echo emptyResult();
//     }

//     exit();
// }

/**-------------------------------------------------------- SEARCH AJAX REQUEST --------------------------------------------------------**/