<?php
include("../function/student-function.php");

/*--------------------------------------------------------- STUDENT UNIVERSITY PORTFOLIO AJAX REQUEST ---------------------------------------------------------*/

/**
 * Fetch all state and city based on current country id and state id.
 * Return the json ecoded associative array.
*/
if(isset($_POST["fetchCurrAddr"])) {
    $countryID = $_POST["country_id"];
    $stateID = $_POST["state_id"];
    $cityID = $_POST["city_id"];
    $echoState = "";
    $echoCity = "";

    // Fetch state info based on country id.
    $stateInfo = $conn->query("SELECT * 
                                FROM `state` AS st 
                                WHERE st.state_country_id = '$countryID' 
                                ORDER BY st.state_name;");

	if($stateInfo->num_rows !== 0) {
		$echoState .= '<option value="" selected disabled>Select state</option>';

        foreach($stateInfo->fetch_all(MYSQLI_ASSOC) as $val) {
            if($val["state_id"] == $stateID) {
                $echoState .= '<option value="'.$val["state_id"].'" selected>'.$val["state_name"].'</option>';
            } else {
                $echoState .= '<option value="'.$val["state_id"].'">'.$val["state_name"].'</option>';
            }
        }
	} else {
		$echoState = '<option value="">State not available</option>';
	}

    // Fetch city based on state id.
    $cityInfo = $conn->query("SELECT * 
                                FROM `city` AS cty 
                                WHERE cty.city_state_id = '$stateID' 
                                ORDER BY cty.city_name;");

    if($cityInfo->num_rows !== 0) {
        $echoCity .= '<option value="" selected disabled>Select city</option>';

        foreach($cityInfo->fetch_all(MYSQLI_ASSOC) as $val) {
            if($val["city_id"] == $cityID) {
                $echoCity .= '<option value="'.$val["city_id"].'" selected>'.$val["city_name"].'</option>';
            } else {
                $echoCity .= '<option value="'.$val["city_id"].'">'.$val["city_name"].'</option>';
            }
        }
    } else {
        $echoCity = '<option value="">City not available</option>';
    }

    echo json_encode(
        array(
            "state" => $echoState, 
            "city"  => $echoCity
        )
    );

    exit();
}

/**
 * Fetch all the state based on the country_id.
 */
if(isset($_POST["fetchState"])) {
    $countryID = $_POST["country_id"];
    $echoState = "";

    // Fetch state info based on country id.
    $stateInfo = $conn->query("SELECT * 
                                FROM `state` AS st 
                                WHERE st.state_country_id = '$countryID' 
                                ORDER BY st.state_name;");

	if($stateInfo->num_rows !== 0) {
		$echoState .= '<option value="" selected disabled>Select state</option>';

        foreach($stateInfo->fetch_all(MYSQLI_ASSOC) as $val) {
            $echoState .= '<option value="'.$val["state_id"].'">'.$val["state_name"].'</option>';
        }
	} else {
		$echoState = '<option value="">State not available</option>';
	}

    echo $echoState;

    exit();
}

/**
 * Fetch all the city based on the state_id.
 */
if(isset($_POST["fetchCity"])) {
    $stateID = $_POST["state_id"];
    $echoCity = "";

    // Fetch city based on state id.
    $cityInfo = $conn->query("SELECT * 
                                FROM `city` AS cty 
                                WHERE cty.city_state_id = '$stateID' 
                                ORDER BY cty.city_name;");

    if($cityInfo->num_rows !== 0) {
        $echoCity .= '<option value="" selected disabled>Select city</option>';

        foreach($cityInfo->fetch_all(MYSQLI_ASSOC) as $val) {
            $echoCity .= '<option value="'.$val["city_id"].'">'.$val["city_name"].'</option>';
        }
    } else {
        $echoCity = '<option value="">City not available</option>';
    }

    echo $echoCity;

    exit();
}

/**-------------------------------------------------------- STUDENT UNIVERSITY PORTFOLIO AJAX REQUEST --------------------------------------------------------**/