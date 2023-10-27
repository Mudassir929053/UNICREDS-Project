<?php
include("../function/function.php");

/*--------------------------------------------------------- JOB DISPLAY ---------------------------------------------------------*/

/**
 * Function that contain strings of HTML code to display empty Job Offers list.
 * 
 * @return string string of HTML code.
 */
function emptyJobList() {
    return (
        '<div class="d-flex justify-content-center">' . 
            '<!-- No content -->' . 
            '<div class="no-content px-4 mt-8">' . 
                '<h3 class="fw-bold text-center text-muted">There\'s no job matching your search.</h3>' . 
                '<p class="fs-5 text-dark text-center">Re-enter the keyword or adjust the filter.</p>' . 
            '</div>' . 
        '</div>'
    );
}

/**
 * Function that contain strings of HTML code to display the Job Offers list.
 * 
 * @param array $job_info associative 2D array.
 * @return string string of HTML code.
 */
function jobList($job_info) {
    $str = "";

    foreach($job_info as $val) {
        $str .= (
            '<li class="list-group-item list-group-item-action" data-id="'.$val["job_id"].'" style="cursor: pointer;">' . 
                '<div>' . 
                    $val["ind_logo"] . 
                    '<h3 class="mb-0 mt-2 fw-bold">'.$val["job_title"].'</h3>' . 
                    '<h5 class="mb-0">' . 
                        $val["ind_name"] . 
                    '</h5>' . 
                    '<p class="mt-3 mb-1 fw-medium">' . 
                        '<i class="fe fe-map-pin me-1" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>' . 
                        $val["job_loc"] . 
                    '</p>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-dollar-sign me-1" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>' . 
                        $val["job_sal"] . 
                    '</p>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-book me-1" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>' . 
                        $val["job_type"] . 
                    '</p>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-zoom-in me-1" data-bs-toggle="tooltip" data-placement="top" title="Vacancy"></i>' . 
                        $val["job_vacancy"] . 
                    '</p>' . 
                    '<p class="m-0 mt-2 text-end text-muted">'.$val["job_date"].'</p>' . 
                '</div>' . 
            '</li>'
        );
    }

    return $str;
}

/**
 * Function that contain strings of HTML code to displays the Job Description initial content.
 * 
 * @param int $job_count number of jobs found.
 * @return string string of HTML code.
 */
function jobInitialContent($job_count) {
    return (
        '<div class="d-flex justify-content-center">' . 
            '<!-- Initial content -->' . 
            '<div class="initial-content mt-8 ">' . 
                '<h1 class="fw-bold text-center text-muted">Found <span class="text-dark">'.$job_count.' jobs</span> available for you.</h1>' . 
                '<p class="fs-3 text-dark text-center">Select a job to view the details.</p>' . 
            '</div>' . 
        '</div>'
    );
}

/**
 * Function that contain strings of HTML code to display the Job Description.
 * 
 * @param array $job_desc associative array.
 * @return string string of HTML code.
 */
function jobDesc($job_desc) {
    return (
        '<div class="mb-3" style="height: 200px;">' . 
            '<img src="../assets/images/background/slider_1024.jpg" class="h-100 w-100" alt="">' . 
        '</div>' . 
        '<div class="px-6 mb-3">' . 
            $job_desc["ind_logo"] . 
            '<div class="mb-3">' . 
                '<h1 class="mb-0 fw-bold">'.$job_desc["job_title"].'</h1>' . 
                '<h4 class="mb-0">' . 
                    '<a id="ind-name" class="text-inherit" style="cursor: pointer;">'.$job_desc["ind_name"].'</a>' . 
                    '<a href="'.$job_desc["ind_link"].'"><i class="fe fe-info fs-4 ms-3" data-bs-toggle="tooltip" data-placement="top" title="Company profile"></i></a>' . 
                '</h4>' . 
            '</div>' . 
            '<div class="d-flex justify-content-between align-items-center mb-6">' . 
                '<div>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-map-pin me-1" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>' . 
                        $job_desc["job_loc"] . 
                    '</p>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-dollar-sign me-1" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>' . 
                        $job_desc["job_sal"] . 
                    '</p>' . 
                    '<p class="mb-1 fw-medium">' . 
                        '<i class="fe fe-book me-1" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>' . 
                        $job_desc["job_type"] . 
                    '</p>' . 
                    '<p class="mb-0 fw-medium">' . 
                        '<i class="fe fe-zoom-in me-1" data-bs-toggle="tooltip" data-placement="top" title="Vacancy"></i>' . 
                        $job_desc["job_vacancy"] . 
                    '</p>' . 
                '</div>' . 
                '<div>' . 
                 
                    '<a href="job-details.php?job_id='.$job_desc["job_id"].'" class="btn btn-info btn-icon ms-2" data-bs-toggle="tooltip" data-placement="top" title="View new tab" target="_blank">' . 
                        '<i class="fe fe-external-link"></i>' . 
                    '</a>' . 
                '</div>' . 
            '</div>' . 
            // '<div class="mb-5">' . 
            //     '<h3>Job Position: <span class="fw-normal text-body">'.$job_desc["job_pos"].'</span></h3>' . 
            //     '<h4 class="mb-1 text-body">'.$job_desc["job_pos"].'</h4>' . 
            //     '<div class="text-body mb-0">' . 
            //         $job_desc["job_pos_desc"] . 
            //     '</div>' . 
            // '</div>' . 
            '<div class="mb-5">' . 
                '<h3>Job Details</h3>' . 
                '<div class="accordion mt-2" id="accordionExample1">' . 
                    '<div class="card border rounded shadow-sm">' . 
                        '<div class="card-header rounded" id="headingOne">' . 
                            '<a href="#" class="d-flex align-items-center text-inherit text-decoration-none active" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">' . 
                                '<div class="me-auto">' . 
                                    '<h4 class="mb-0">Job Descriptions</h4>' . 
                                '</div>' . 
                                '<span class="chevron-arrow ms-4">' . 
                                    '<i class="fe fe-chevron-down fs-4"></i>' . 
                                '</span>' . 
                            '</a>' . 
                        '</div>' . 
                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">' . 
                            '<div class="card-body text-body">' . 
                                $job_desc["job_desc"] . 
                            '</div>' . 
                        '</div>' . 
                    '</div>' . 
                '</div>' . 
                // '<div class="accordion mt-2" id="accordionExample2">' . 
                //     '<div class="card border rounded shadow-sm">' . 
                //         '<div class="card-header rounded" id="headingTwo">' . 
                //             '<a href="#" class="d-flex align-items-center text-inherit text-decoration-none active" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">' . 
                //                 '<div class="me-auto">' . 
                //                     '<h4 class="mb-0">Job Responsibilities</h4>' . 
                //                 '</div>' . 
                //                 '<span class="chevron-arrow ms-4">' . 
                //                     '<i class="fe fe-chevron-down fs-4"></i>' . 
                //                 '</span>' . 
                //             '</a>' . 
                //         '</div>' . 
                //         '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">' . 
                //             '<div class="card-body text-body">' . 
                //                 $job_desc["job_resp"] . 
                //             '</div>' . 
                //         '</div>' . 
                //     '</div>' . 
                // '</div>' . 
                // '<div class="accordion mt-2" id="accordionExample3">' . 
                //     '<div class="card border rounded shadow-sm">' . 
                //         '<div class="card-header rounded" id="headingThree">' . 
                //             '<a href="#" class="d-flex align-items-center text-inherit text-decoration-none active" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">' . 
                //                 '<div class="me-auto">' . 
                //                     '<h4 class="mb-0">Job Requirements</h4>' . 
                //                 '</div>' . 
                //                 '<span class="chevron-arrow ms-4">' . 
                //                     '<i class="fe fe-chevron-down fs-4"></i>' . 
                //                 '</span>' . 
                //             '</a>' . 
                //         '</div>' . 
                //         '<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">' . 
                //             '<div class="card-body text-body">' . 
                //                 $job_desc["job_req"] . 
                //             '</div>' . 
                //         '</div>' . 
                //     '</div>' . 
                // '</div>' . 
            '</div>' . 
            '<div class="mb-5 row">' . 
                '<h3>Additional Information</h3>' . 
                '<div class="col-sm-6 col-md-6 col-lg-6 col-12">' . 
                    '<div class="mb-3">' . 
                        '<h4 class="mb-1 text-body">Career Level</h4>' . 
                        '<span class="text-dark fs-5">'.$job_desc["job_level"].'</span>' . 
                    '</div>' . 
                    '<div class="mb-1">' . 
                        '<h4 class="mb-1 text-body">Years of Experience</h4>' . 
                        '<span class="text-dark fs-5">'.$job_desc["job_exp"].'</span>' . 
                    '</div>' . 
                '</div>' . 
                '<div class="col-sm-6 col-md-6 col-lg-6 col-12">' . 
                    '<div class="mb-3">' . 
                        '<h4 class="mb-1 text-body">Job Category</h4>' . 
                        '<span class="text-dark fs-5">' . 
                            '<a id="job-categ" class="text-inherit" data-categ-code="'.$job_desc["job_categ_code"].'" style="cursor: pointer;">'.$job_desc["job_categ"].'</a>' . 
                        '</span>' . 
                    '</div>' . 
                    '<div class="mb-1">' . 
                        '<h4 class="mb-1 text-body">Qualifications</h4>' . 
                        '<span class="text-dark fs-5">'.$job_desc["job_qualify"].'</span>' . 
                    '</div>' . 
                '</div>' . 
            '</div>' . 
        '</div>'
    );
}

/**-------------------------------------------------------- JOB DISPLAY --------------------------------------------------------**/


/*--------------------------------------------------------- JOB FUNCTION ---------------------------------------------------------*/

/**
 * Function to process all Job offers information to be displayed.
 * 
 * @param array $jobList associative 2D array containing 30 job offers information.
 * @param array $allJob associative 2D array containing all the job offers information.
 * @return array json encoded associative array.
 */
function process_job_offers($jobList, $allJob = NULL) {
    $jobs = array();
    if($jobList !== NULL) {
        $count = 0;
        foreach($jobList as $val) {
            $job_id = $val["job_id"];

            if($val["industry_logo"] !== NULL) {
                $ind_logo = '<img src="../assets/images/industry/'.$val["industry_logo"].'" alt="Company logo" class="rounded img-4by3-md">';
            } else {
                $ind_logo = '<span class="avatar avatar-xl avatar-info"><span class="avatar-initials rounded fs-2">'.$val["industry_name"][0].$val["industry_name"][1].'</span></span>';
            }

            $job_title = $val["job_title"];
            $ind_name = $val["industry_name"];
            $job_loc = $val["industry_city_id"] !== NULL ? $val["industry_city_id"].", ".$val["state_name"] : '<em class="text-muted fs-4">Not specified</em>';
            $job_sal = salary($val["job_min_salary"], $val["job_max_salary"]);
            $job_type = $val["job_type"];
            $job_vacancy = $val["job_no_of_vacancies"]." position";
            $job_date = $val["job_date_posted"];

            array_push($jobs, array(
                "job_id"        => $job_id, 
                "ind_logo"      => $ind_logo, 
                "job_title"     => $job_title, 
                "ind_name"      => $ind_name, 
                "job_loc"       => $job_loc, 
                "job_sal"       => $job_sal, 
                "job_type"      => $job_type, 
                "job_vacancy"   => $job_vacancy, 
                "job_date"      => date_format(date_create($job_date), "jS F, Y")
            ));
        
            $count++;
        }

        return json_encode(
            array(
                "job_list"          => $count != 0 ? jobList($jobs) : emptyJobList(), 
                "job_desc_count"    => jobInitialContent(count($allJob)), 
                "curr_count"        => $count, 
                "total_count"       => count($allJob)
            )
        );
    } else {
        return json_encode(
            array(
                "job_list"          => emptyJobList(), 
                "job_desc_count"    => jobInitialContent(0), 
                "curr_count"        => 0, 
                "total_count"       => 0
            )
        );
    }
}

/**
 * Function to parse all the job search queries into SQL statement.
 * 
 * @param string $job_title string of name of the job or industry.
 * @param string $job_location string of name of the job location.
 * @param array $job_categ array of job categories.
 * @return string string of SQL statement.
 */
function search_query_sql($job_title, $job_location, $job_categ) {
    // Parse string of SQL LIKE operator for Job title or Company name.
    $job_title_query = "";
    if($job_title !== "") {
        $job_title_query .= "(j.job_title LIKE '%".$job_title."%' OR ind.industry_name LIKE '%".$job_title."%')";
    }

    // Parse string of SQL LIKE operator for Job Location.
    $job_location_query = "";
    if($job_location !== "") {
        if($job_title !== "") {
            $job_title_query .= " AND ";
        }

        $job_location_query .= "(ind.industry_city_id LIKE '%".$job_location."%' OR st.state_name LIKE '%".$job_location."%' OR ind.industry_country_id LIKE '%".$job_location."%')";
    }

    // Parse string of SQL LIKE operator for Job Category.
    $job_categ_query = "";
    if($job_categ !== "") {
        if($job_location !== "" || $job_title !== "") {
            $job_location_query .= " AND ";
        }

        foreach($job_categ as $key => $val) {
            if($key === array_key_first($job_categ)) {
                $job_categ_query .= "(jc.jc_code = '".$val."')";
            } else {
                $job_categ_query .= " OR (jc.jc_code = '".$val."')";
            }
        }

        $job_categ_query = "(".$job_categ_query.")";
    }

    return $job_title_query.$job_location_query.$job_categ_query;
}

/**
 * Function to parse all the job search filters into SQL statement.
 * 
 * @param array $job_type array of job types.
 * @param string $date_posted string of job posted date.
 * @return string string of SQL statement.
 */
function search_filter_sql($job_type, $date_posted) {
    // Parse string of SQL operator for $jobType.
    $job_type_sql = "";
    if($job_type > 0) {
        foreach($job_type as $key => $val) {
            if($key === array_key_first($job_type)) {
                $job_type_sql .= "j.job_type = '".$val."'";
            } else {
                $job_type_sql .= " OR j.job_type = '".$val."'";
            }
        }
        $job_type_sql = "(".$job_type_sql.")";
    }

    // Parse string of SQL operator for $datePosted.
    // $curr_datetime = date('Y-m-d H:i:s', strtotime("-24 hours"));
    $date_posted_sql = "";
    if($date_posted !== "anytime") {
        if($job_type > 0) {
            $job_type_sql .= " AND ";
        }

        switch($date_posted) {
            case "24h":
                $last_24h = date('Y-m-d H:i:s', strtotime("-24 hours"));
                $date_posted_sql = "(j.job_date_posted > '$last_24h')";

                break;
            case "3d":
                $last_3d = date('Y-m-d H:i:s', strtotime("-3 day"));
                $date_posted_sql = "(j.job_date_posted > '$last_3d')";

                break;
            case "7d":
                $last_7d = date('Y-m-d H:i:s', strtotime("-1 week"));
                $date_posted_sql = "(j.job_date_posted > '$last_7d')";

                break;
            case "14d":
                $last_14d = date('Y-m-d H:i:s', strtotime("-2 week"));
                $date_posted_sql = "(j.job_date_posted > '$last_14d')";

                break;
            case "30d":
                $last_30d = date('Y-m-d H:i:s', strtotime("-1 month"));
                $date_posted_sql = "(j.job_date_posted > '$last_30d')";

                break;
            default:
                // do nothing...
        }
    }

    return $job_type_sql.$date_posted_sql;
}

/**
 * Function to get the job that has been applied by student university and parse it into SQL IN operator.
 * 
 * @param array $su_job array of student university job application.
 * @param array $job_list array of list of job.
 * @return string string of SQL statement.
 */
function su_job_app_sql($su_job, $job_list) {
    $jsua_arr = array();
    if($su_job !== NULL) {
        foreach($su_job as $val) {
            array_push($jsua_arr, $val["jsua_job_id"]);
        }
    }

    $job_id_str = "";
    $i = 0;
    if($job_list !== NULL) {
        foreach($job_list as $val) {
            if(in_array($val["job_id"], $jsua_arr, TRUE)) {
                if($i === 0) {
                    $job_id_str .= $val["job_id"];
                } else {
                    $job_id_str .= ", ".$val["job_id"];
                }

                $i++;
            }
        }
    }

    return $job_id_str !== "" ? "(j.job_id NOT IN ($job_id_str))" : "";
}

/**-------------------------------------------------------- JOB FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- JOB AJAX RESPONSE ---------------------------------------------------------*/

/**
 * Fetch all the location names suggestion based on the input query.
 */
if(isset($_POST["searchSuggestion"])) {
    $search_box = $_POST["searchSuggestion"];
    $query = $_POST["query"];
    $result = "";

    if($search_box === "job-title") {
        $arr_result = $jobInfo->titleSuggestion($query);
    } else if($search_box === "job-location") {
        $arr_result = $jobInfo->locationSuggestion($query);
    }

    if($arr_result !== NULL) {
        foreach($arr_result as $val) {
            $result .= '<span class="dropdown-item" style="cursor: pointer;">'.$val.'</span>';
        }
    } else {
        $result = '<span class="dropdown-item text-muted" style="cursor: pointer;"><em>No matches</em></span>';
    }

    echo $result;

    exit();
}

/**
 * Fetch all the Job Offers list based on search query or all of it.
 */
if(isset($_POST["fetchJobList"])) {
    $search_query = $_POST["search_query"];
    $search_filter = $_POST["search_filter"];
    $page_num = (30 * ($_POST["page_num"]) - 30);

    // SQL statements.
    $search_sql = $search_query !== "" ? search_query_sql($search_query["job_title"], $search_query["job_location"], $search_query["job_category"]) : "";
    $filter_sql = search_filter_sql($search_filter["job_type"], $search_filter["date_posted"]);

    $sql_limit = "LIMIT $page_num, 30";
    // $jsua_sql = su_job_app_sql($jobInfo->fetch_job_applications($suID), $jobInfo->fetch_jobs());
    $sql_stmt = $search_sql.(($search_sql === "" || $filter_sql === "") ? "" : " AND ").$filter_sql;

    if($sql_stmt === "") {
        // fetch all Job List.
        $jobList = $jobInfo->fetch_jobs($filter_sql, $sql_limit);

        echo process_job_offers($jobList, $jobInfo->fetch_jobs($filter_sql));
    } else {
        // fetch Job List based on $sql_stmt.
        $sql_opr = $filter_sql.(($filter_sql === "" || $sql_stmt === "") ? "" : " AND ").$sql_stmt;

        $jobList = $jobInfo->fetch_jobs($sql_opr, $sql_limit);
    
        echo process_job_offers($jobList, $jobInfo->fetch_jobs($sql_opr));
    }

    exit();
}

/**
 * Fetch all Job Offers details to display in Job Description section.
 */
if(isset($_POST["fetchJobDesc"])) {
    $job_id = $_POST["fetchJobDesc"];
    $job = array();

    $jobDesc = $jobInfo->fetch_job($job_id);
    
    $job["job_id"] = $jobDesc["job_id"];

    if($jobDesc["industry_logo"] !== NULL) {
        $job["ind_logo"] = '<img src="../assets/images/industry/'.$jobDesc["industry_logo"].'" alt="Company logo" class="rounded img-4by3-md mb-3">';
    } else {
        $job["ind_logo"] = '<span class="avatar avatar-xl avatar-info mb-3"><span class="avatar-initials rounded fs-2">'.$jobDesc["industry_name"][0].$jobDesc["industry_name"][1].'</span></span>';
    }

    $job["job_title"]       = $jobDesc["job_title"];
    $job["ind_name"]        = $jobDesc["industry_name"];
    $job["ind_link"]        = "job-industry-profile.php?ind_id=".$jobDesc["industry_id"];
    $job["job_loc"]         = $jobDesc["industry_city_id"] !== NULL ? $jobDesc["industry_city_id"].", ".$jobDesc["state_name"] : '<em class="text-muted fs-4">Not specified</em>';
    $job["job_sal"]         = salary($jobDesc["job_min_salary"], $jobDesc["job_max_salary"]);
    $job["job_type"]        = $jobDesc["job_type"];
    $job["job_vacancy"]     = $jobDesc["job_no_of_vacancies"]." position";
    $job["job_pos"]         = $jobDesc["jp_name"];
    $job["job_pos_desc"]    = $jobDesc["jp_description"];
    $job["job_desc"]        = $jobDesc["job_description"];
    $job["job_resp"]        = $jobDesc["job_responsibility"];
    $job["job_req"]         = $jobDesc["job_requirement"];
    $job["job_level"]       = $jobDesc["job_level"];
    $job["job_exp"]         = $jobDesc["job_experience_year"] !== NULL ? ($jobDesc["job_experience_year"] > 1 ? $jobDesc["job_experience_year"]." years" : $jobDesc["job_experience_year"]." year") : "<em>Not set</em>";
    $job["job_qualify"]     = $jobDesc["job_qualification"] !== NULL ? $jobDesc["job_qualification"] : "<em class='text-muted'>Not specified</em>";
    $job["job_categ_code"]  = $jobDesc["jc_code"];
    $job["job_categ"]       = $jobDesc["jc_name"];

    echo jobDesc($job);
}

/**-------------------------------------------------------- JOB AJAX RESPONSE --------------------------------------------------------**/