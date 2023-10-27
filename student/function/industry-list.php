<?php
include("../function/student-function.php");

/*--------------------------------------------------------- INDUSTRY DISPLAY FUNCTION ---------------------------------------------------------*/

/**
 * Function that contain strings of HTML code for No Contents.
 * 
 * @return string string of HTML code.
 */
function noContent() {
    return (
        '<!-- No contents -->' . 
        '<div class="d-flex justify-content-center my-3">' . 
            '<h1 class="fw-bold">Oops! There\'s no related companies.</h1>' . 
        '</div>'
    );
}

/**
 * Function that contain strings of HTML code to display the Industries list.
 * 
 * @param array $ind_info associative 2D array.
 * @return string string of HTML code.
 */
function indList($ind_info) {
    $return_str = "";

    foreach($ind_info as $val) {
        $return_str .= (
            '<div class="col-lg-4 col-md-4 col-12">' . 
                '<div class="card card-hover mb-4 shadow-lg" style="height: 350px;">' . 
                    '<div class="card-img-top d-flex justify-content-center align-items-center" style="height: 150px;">'
        );

        if($val["industry_logo"] !== NULL) {
            $return_str .= (
                        '<img src="../assets/images/industry/'.$val["industry_logo"].'" alt="" class="img-4by3-xl" />'
            );
        } else {
            $return_str .= (
                        '<span class="avatar avatar-xxl avatar-info">' . 
                            '<span class="avatar-initials rounded fs-1">'.($val["industry_name"][0].$val["industry_name"][1]).'</span>' . 
                        '</span>'
            );
        }

        $return_str .= (
                    '</div>' . 
                    '<div class="card-body d-flex flex-column justify-content-center">' . 
                        '<span class="fs-5 mb-2 fw-semi-bold d-block text-info">'.$val["industry_field_name"].'</span>' . 
                        '<h3 class="mb-3 text-center">' . 
                            '<a href="job-industry-profile.php?ind_id='.$val["industry_id"].'" class="text-inherit">'.$val["industry_name"].'</a>' . 
                        '</h3>' . 
                        '<div class="d-flex flex-column align-items-center">' . 
                            '<div>' . 
                                '<i class="fe fe-users me-2"></i>' . 
                                '<span class="text-body fs-4">'.($val["ii_company_size"] === "" || $val["ii_company_size"] === NULL ? '<em class="text-muted">Not specified</em>' : $val["ii_company_size"]).'</span>' . 
                            '</div>' . 
                            '<div>' . 
                                '<i class="fe fe-map-pin me-2"></i>'
        );

        if($val["industry_city_id"] !== NULL) {
            $return_str .= (
                                '<span class="text-body fs-4">'.$val["industry_city_id"].', '.$val["state_name"].'</span>'
            );
        } else {
            $return_str .= (
                                '<em class="text-muted fs-4">Not specified</em>'
            );
        }

        $return_str .= (
                            '</div>' . 
                        '</div>' . 
                    '</div>' . 
                '</div>' . 
            '</div>'
        );
    }

    return $return_str;
}

/**-------------------------------------------------------- INDUSTRY DISPLAY FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- INDUSTRY AJAX RESPONSE ---------------------------------------------------------*/

/**
 * Fetch the first 9 rows of the list of industries.
 * Return json encoded associative array.
 */
if(isset($_POST["fetchAllInd"])) {
    $limit_sql = "LIMIT 0, 9";
    $ind_list = $jobInfo->fetch_industries("", $limit_sql);

    if($ind_list !== NULL) {
        echo json_encode(array(
            "ind_list"      => indList($ind_list), 
            "list_count"    => count($ind_list)
        ));
    } else {
        echo json_encode(array(
            "ind_list"      => noContent(), 
            "list_count"    => 0
        ));
    }

    exit();
}

/**
 * Fetch the industry name suggestion based on the query.
 * Return HTML strings.
 */
if(isset($_POST["fetchIndName"])) {
    $query = $_POST["fetchIndName"];

    $sql_operator = "i.industry_name LIKE '%$query%'";
    $indName = $jobInfo->fetch_industries($sql_operator);

    if($indName !== NULL) {
        $return_str = "";

        foreach($indName as $val) {
            $return_str .= '<span class="dropdown-item" style="cursor: pointer;">'.$val["industry_name"].'</span>';
        }

        echo $return_str;
    } else {
        echo '<span class="dropdown-item text-muted disabled" style="cursor: pointer;"><em>No matches</em></span>';
    }

    exit();
}

/**
 * Fetch list of industries based on the query.
 * Return json encoded associative array.
 */
if(isset($_POST["fetchIndQuery"])) {
    $query = $_POST["fetchIndQuery"];

    $sql_operator = "i.industry_name LIKE '%$query%'";
    $ind_list = $jobInfo->fetch_industries($sql_operator, "LIMIT 0, 9");

    if($ind_list !== NULL) {
        echo json_encode(array(
            "ind_list"      => indList($ind_list), 
            "list_count"    => count($ind_list)
        ));
    } else {
        echo json_encode(array(
            "ind_list"      => noContent(), 
            "list_count"    => 0
        ));
    }

    exit();
}

/**
 * Fetch list of industries based on the LIMIT count.
 * Return json encoded associative array.
 */
if(isset($_POST["fetchIndList"])) {
    $count_list = $_POST["fetchIndList"];
    $query = $_POST["query"] !== "NULL" ? "i.industry_name LIKE '%{$_POST["query"]}%'" : 1;

    $limit_sql = "LIMIT $count_list, 9";
    $ind_list = $jobInfo->fetch_industries($query, $limit_sql);

    if($ind_list !== NULL) {
        echo json_encode(array(
            "ind_list"      => indList($ind_list), 
            "list_count"    => count($ind_list)
        ));
    } else {
        echo json_encode(array(
            "ind_list"      => "", 
            "list_count"    => 0
        ));
    }

    exit();
}

/**-------------------------------------------------------- INDUSTRY AJAX RESPONSE --------------------------------------------------------**/