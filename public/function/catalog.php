<?php
include("../function/function.php");

/*--------------------------------------------------------- FILTER VIEW FUNCTION ---------------------------------------------------------*/

/**
 * Function that contain strings of HTML code to display the empty 
 * lists in tab pane/grid lists form.
 * 
 * @return string string of HTML code.
 */
function emptyList() {
    $str = (
        '<!-- No contents -->' . 
        '<div class="row mt-8 justify-content-center">' . 
            '<div class="col-lg-10 col-md-12 col-12 text-center">' . 
                '<h2 class="mb-2 display-4 fw-bold">Sorry, there\'s no related contents right now.</h2>' . 
            '</div>' . 
        '</div>'
    );

    return $str;
    exit();
}

/**
 * Function that contain strings of HTML code to display the Course/Micro-credential 
 * lists in grid lists form.
 * 
 * @param array $arr associative 2D array.
 * @return string string of HTML code.
 */
function displayGrid($arr) {
    $str = "";

    foreach($arr as $data) {
        $str1 = (
            '<div id="" class="col-lg-4 col-md-6 col-12 mb-0" >' . 
                '<a href="' . $data["link"] . '">' . 
                    '<div class="card mb-4 card-hover border">'
        );
        
        // $str2 = "";
        // if($data["enrolled"]) {
        //     $str2 = (
        //                 '<div class="position-absolute w-100">' . 
        //                     '<div class="">' . 
        //                         '<div class="w-25 mt-2 ms-2">' . 
        //                             '<span class="badge rounded-pill bg-success fs-5">Enrolled</span>' . 
        //                         '</div>' . 
        //                     '</div>' . 
        //                 '</div>'
        //     );
        // }

        $str3 = (
                        '<div style="max-height: 150px;">' . 
                            '<img src="' . $data["image"] . '"' .  
                                'alt="" class="card-img-top rounded-top-md" height="150">' . 
                        '</div>' . 
                        '<div class="card-body">' . 
                            '<h4 class="mb-2 text-truncate">' . 
                               $data["title"] .  
                            '</h4>' . 
                            '<ul class="list-inline mt-3 m-0 mb-2">' . 
                                '<li class="text-truncate mb-1">' . 
                                    '<i class="fe fe-user-check me-2" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>' . 
                                    '<span class="text-body">' . 
                                        $data["owner"] . 
                                    '</span>' . 
                                '</li>' . 
                                '<li class="text-truncate mb-1">' . 
                                    '<i class="fe fe-book me-2 text-success" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>' . 
                                    '<span class="text-body text-truncate">' . 
                                        $data["category"] . 
                                    '</span>' . 
                                '</li>' . 
                                '<li class="mb-1">' . 
                                    '<i class="far fa-clock me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>' . 
                                    '<span class="text-body">' . 
                                        $data["duration"] . 
                                    '</span>' . 
                                '</li>' . 
                                '<li class="text-truncate mb-1">' . 
                                    '<i class="mdi mdi-school me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>' . 
                                    '<span class="text-body">' . 
                                        $data["level"] . 
                                    '</span>' . 
                                '</li>' . 
                                // '<li class="mb-1">' . 
                                //     '<i class="fe fe-book-open me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>' . 
                                //     '<span class="text-body">' . 
                                //         $data["credit"] .  
                                //     '</span>' . 
                                // '</li>' . 
                                '<li>' . 
                                    '<i class="fe fe-users me-2 text-warning" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>' . 
                                    '<span class="text-body">' . 
                                        $data["total_enrolled"] . 
                                    '</span>' . 
                                '</li>' . 
                            '</ul>' . 
                        '</div>' . 
                    '</div>' . 
                '</a>' . 
            '</div>'
        );

        $str .= ($str1 . $str3);
    }

    return $str;
    exit();
}

/**
 * Function that contain strings of HTML code to display the Course/Micro-credential 
 * lists in tab pane lists form.
 * 
 * @param array $arr associative 2D array.
 * @return string string of HTML code.
 */
function displayTab($arr) {
    $str = "";

    foreach($arr as $data) {
        $str1 = (
            '<a href="' . $data["link"] . '">' . 
                '<div id="" class="card mb-4 card-hover border" style="max-height: 242px;">' . 
                    '<div class="row g-0 h-100">' . 
                        '<span class="col-12 col-md-12 col-xl-3 col-lg-3 bg-cover img-left-rounded"' . 
                            'style="background-image: url(' . $data["image"] . ');">' . 
                            '<img src="' . $data["image"] . '" alt="..." class="img-fluid d-lg-none invisible">'
        );
        
        // $str2 = "";
        // if($data["enrolled"]) {
        //     $str2 = (
        //                     '<div class="position-absolute w-100">' . 
        //                         '<div class="">' . 
        //                             '<div class="w-25 mt-2 ms-2">' . 
        //                                 '<span class="badge rounded-pill bg-success fs-5">Enrolled</span>' . 
        //                             '</div>' . 
        //                         '</div>' . 
        //                     '</div>'
        //     );
        // }

        $str3 = (
                        '</span>' . 
                        '<div class="col-lg-9 col-md-12 col-12">' . 
                            '<!-- Card body -->' . 
                            '<div class="card-body">' . 
                                '<h4 class="mb-2 text-truncate">' . 
                                    $data["title"] . 
                                '</h4>' . 
                                '<ul class="list-inline mt-3 m-0 mb-2">' . 
                                    '<li class="text-truncate mb-1">' . 
                                        '<i class="fe fe-user-check me-2" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>' . 
                                        '<span class="text-body">' . 
                                            $data["owner"] . 
                                        '</span>' . 
                                    '</li>' . 
                                    '<li class="text-truncate mb-1">' . 
                                        '<i class="fe fe-book me-2 text-success" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>' . 
                                        '<span class="text-body text-truncate">' . 
                                            $data["category"] . 
                                        '</span>' . 
                                    '</li>' . 
                                    '<li class="mb-1">' . 
                                        '<i class="far fa-clock me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>' . 
                                        '<span class="text-body">' . 
                                            $data["duration"] . 
                                        '</span>' . 
                                    '</li>' . 
                                    '<li class="text-truncate mb-1">' . 
                                        '<i class="mdi mdi-school me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>' . 
                                        '<span class="text-body">' . 
                                            $data["level"] . 
                                        '</span>' . 
                                    '</li>' . 
                                    // '<li class="mb-1">' . 
                                    //     '<i class="fe fe-book-open me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>' . 
                                    //     '<span class="text-body">' . 
                                    //         $data["credit"] . 
                                    //     '</span>' . 
                                    // '</li>' . 
                                    '<li class="mb-1">' . 
                                        '<i class="fe fe-users me-2 text-warning" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>' . 
                                        '<span class="text-body">' . 
                                            $data["total_enrolled"] . 
                                        '</span>' . 
                                    '</li>' . 
                                '</ul>' . 
                                '<div></div>' . 
                            '</div>' . 
                        '</div>' . 
                    '</div>' . 
                '</div>' . 
            '</a>'
        );

        $str .= ($str1 . $str3);
    }

    return $str;
    exit();
}

/**-------------------------------------------------------- CATALOG DISPLAY --------------------------------------------------------**/


/*--------------------------------------------------------- CATALOG FUNCTIONS ---------------------------------------------------------*/

/**
 * Function to process all the Course/Micro-credential data to be displayed.
 * 
 * @param string $type can be either __c__ (Course) or __mc__ (Micro-credential).
 * @param array $list array of Course/Micro-credential data.
 * @param object $c instantiation of __Course__ class.
 * @param object $mc instantiation of __Microcredential__ class.
 * @return array an associative array.
 */
function process_data($type, $list, $c, $mc) {
    if($type === "c") {
        // $stud_enr = $c->fetch_enrolled_courses();
        
        $id = $list["course_id"];
        $link = "course-enroll.php?course_id={$id}";
        $enrolled = false;
        // $image = $list["course_image"] !== NULL ? "../assets/images/course/" . $list["course_image"] : "../assets/images/course/course-default.jpg";
        $image = "../assets/images/course/".$list["course_image"];
        $title = $list["course_title"];
        $owner = $list["course_owner"] !== NULL ? $c->check_course_owner($list["course_owner"])["name"] : "<span class='text-muted'><em>Not available</em></span>";
        $category = $list["course_category"] !== NULL ? $list["course_category"] : "<span class='text-muted'><em>Not set</em></span>";
        $duration = $list["course_duration"];
        $level = $list["course_level"] !== NULL ? acadLevel($list["course_level"]) : "<span class='text-muted'><em>Not set</em></span>";
        $credit = $list["course_credit"] !== NULL ? $list["course_credit"] . " credits" : "<span class='text-muted'><em>Not set</em></span>";
        $total_enrolled = ($list["course_total_enrolled"] == 0 || $list["course_total_enrolled"] === NULL) ? "<span class='text-muted'><em>No enrollment</em></span>" : $list["course_total_enrolled"]." enrolled";
    } else if($type === "mc") {
        // $stud_enr = $mc->fetch_enrolled_microcredentials();

        $id = $list["mc_id"];
        $link = "micro-creds-enroll.php?mc_id={$id}";
        $enrolled = false;
        $image = "../assets/images/microcredential/" . $list["mc_image"];
        $title = $list["mc_title"];
        $owner = $list["mc_owner"] !== NULL ? $list["university_name"] : "<span class='text-muted'><em>Not available</em></span>";
        $category = $list["mc_category"] !== NULL ? $list["mc_category"] : "<span class='text-muted'><em>Not set</em></span>";
        $duration = $list["mc_duration"];
        $level = $list["mc_level"] !== NULL ? acadLevel($list["mc_level"]) : "<span class='text-muted'><em>Not set</em></span>";
        $credit = $list["mc_credit_transfer"] !== NULL ? $list["mc_credit_transfer"] . " credits" : "<span class='text-muted'><em>Not set</em></span>";
        $total_enrolled = ($list["mc_total_enrolled"] == 0 || $list["mc_total_enrolled"] === NULL) ? "<span class='text-muted'><em>No enrollment</em></span>" : $list["mc_total_enrolled"] . " enrolled";
    }

    // Check enrolled.
    // if($stud_enr !== NULL) {
    //     foreach($stud_enr as $val) {
    //         if($type === "c") {
    //             if($val["ecsu_course_id"] === $id) {
    //                 $link = "course-view-enrolled.php?course_id={$id}&amp;pill=desc";
    //                 $enrolled = true;
    //             }
    //         } else if($type === "mc") {
    //             if($val["emcsu_mc_id"] === $id) {
    //                 $link = "micro-creds-view-enrolled.php?mc_id={$id}&amp;pill=desc";
    //                 $enrolled = true;
    //             }
    //         }  
    //     }
    // }

    return array(
        "link"              => $link, 
        "enrolled"          => $enrolled, 
        "image"             => $image, 
        "title"             => $title, 
        "owner"             => $owner, 
        "category"          => $category, 
        "duration"          => $duration, 
        "level"             => $level, 
        "credit"            => $credit, 
        "total_enrolled"    => $total_enrolled
    );
}

/**
 * Function to fetch all the related courses/micro-credentials list.
 * 
 * @param string $type can be either __c__ (Course) or __mc__ (Micro-credential).
 * @param string $sql_opr contains the SQL statement or empty string.
 * @param string $sql_limit contains the SQL LIMIT clause or empty string.
 * @param object $c instantiation of __Course__ class.
 * @param object $mc instantiation of __Microcredential__ class.
 * @return array json encoded associative array.
 */
function fetch_list_info($type, $sql_opr, $sql_limit, $c, $mc) {
    $lists = array();

    if($type === "c") {
        if($sql_opr === "") {
            $data_list = $c->fetch_courses($sql_opr, $sql_limit);
            $total = $c->fetch_courses() !== NULL ? count($c->fetch_courses()) : 0;
        } else {
            $data_list = $c->fetch_courses($sql_opr, $sql_limit);
            $total = $c->fetch_courses($sql_opr) !== NULL ? count($c->fetch_courses($sql_opr)) : 0;
        }
    } else if($type === "mc") {
        if($sql_opr === "") {
            $data_list = $mc->fetch_microcredentials($sql_opr, $sql_limit);
            $total = $mc->fetch_microcredentials() !== NULL ? count($mc->fetch_microcredentials()) : 0;
        } else {
            $data_list = $mc->fetch_microcredentials($sql_opr, $sql_limit);
            $total = $mc->fetch_microcredentials($sql_opr) !== NULL ? count($mc->fetch_microcredentials($sql_opr)) : 0;
        }
    }

    if($data_list !== NULL) {
        foreach($data_list as $val) {
            array_push($lists, process_data($type, $val, $c, $mc));
        }

        array_multisort(array_column($lists, "title"), SORT_ASC, SORT_STRING, $lists);

        if(count($lists) > 0) {
            return json_encode(
                array(
                    "grid"  => displayGrid($lists), 
                    "tab"   => displayTab($lists), 
                    "count" => count($lists), 
                    "total" => $total
                )
            );
        }
    } else {
        return json_encode(
            array(
                "grid"  => emptyList(), 
                "tab"   => emptyList(), 
                "count" => count($lists), 
                "total" => $total
            )
        );
    }
}

/**
 * Function to parse the string to: '__varchar__', '__varchar__', ... , '__varchar__'
 * 
 * @param array $str_arr array that contain the varchar.
 * @return string the processed string.
 */
function parse_sql_IN($str_arr) {
    $sql_str = "";

    foreach($str_arr as $key => $val) {
        if($key === array_key_first($str_arr)) {
            $sql_str .= "'".$val."'";
        } else {
            $sql_str .= ", '".$val."'";
        }
    }

    return $sql_str;
}

/**
 * Function to parse the string to: __field__ LIKE '%__varchar__%' OR __field__ LIKE '%__varchar__%' ... OR __field__ LIKE '%__varchar__%'
 * 
 * @param array $str_arr array that contain the varchar.
 * @param string $field field name in a table.
 * @return string the processed string.
 */
function parse_sql_LIKE($str_arr, $field) {
    $sql_str = "";

    foreach($str_arr as $key => $val) {
        if($key === array_key_first($str_arr)) {
            $sql_str .= $field." LIKE '%".$val."%'";
        } else {
            $sql_str .= " OR ".$field." LIKE '%".$val."%'";
        }
    }

    return $sql_str;
}

/**-------------------------------------------------------- CATALOG FUNCTIONS --------------------------------------------------------**/


/*--------------------------------------------------------- CATALOG AJAX RESPONSE ---------------------------------------------------------*/

/**
 * Courses/Micro-credentials lists to show all or filter based on institution or academic level.
 * Response with json ecoded associative array.
 */
if(isset($_POST["fetchList"])) {
    $fetch_type = $_POST["fetchList"];
    $type = $_POST["curr_path"];
    $list_count = $_POST["list_count"];

    $sql_limit = "LIMIT  $list_count, 12";

    if($fetch_type === "all") {
        echo fetch_list_info($type, "", $sql_limit, $courseInfo, $mcInfo);
    } else if($fetch_type === "filter") {
        $inst_ids_arr = isset($_POST["inst_id"]) ? $_POST["inst_id"] : NULL;
        $acad_lvl_arr = isset($_POST["acad_lvl"]) ? $_POST["acad_lvl"] : NULL;

        $sql_opr = "";

        if($type === "c") {
            $inst_sql = $inst_ids_arr !== NULL ? "c.course_owner IN (".parse_sql_IN($inst_ids_arr).")" : "";
            $acad_sql = $acad_lvl_arr !== NULL ? "(".parse_sql_LIKE($acad_lvl_arr, "c.course_level").")" : "";
        } else if($type === "mc") {
            $inst_sql = $inst_ids_arr !== NULL ? "mc.mc_owner IN (".parse_sql_IN($inst_ids_arr).")" : "";
            $acad_sql = $acad_lvl_arr !== NULL ? "(".parse_sql_LIKE($acad_lvl_arr, "mc.mc_level").")" : "";
        }

        $sql_opr = $inst_sql.(($inst_sql === "" xor $acad_sql === "") ? "" : " AND ").$acad_sql;
    
        echo fetch_list_info($type, $sql_opr, $sql_limit, $courseInfo, $mcInfo);
    }

    exit();
}

/**-------------------------------------------------------- CATALOG AJAX RESPONSE --------------------------------------------------------**/