<?php
namespace DBData;

/**
 * `Job` class.
 * This class used to fetch all necessary data related to Industry and Job Advertisement & Application.
 */
class Job {
    private $dbconn;

    public function __construct() {
        $this->dbconn = $this->connect();
    }

    public function __destruct() {
        mysqli_close($this->dbconn);
    }

    private function connect() {
        include("{$_SERVER["DOCUMENT_ROOT"]}/unicreds/database/dbcon.php");
        return $conn;

        exit();
    }

/*-------------------------------------------------- FETCH JOB INFORMATION --------------------------------------------------*/

    /**
     * Function to fetch all the data related to the jobs.
     * It holds all the data from __job__, __job_category__, __job_position__, __industry__, __industry_field__, and __state__ tables.
     * The parameter will filtered the fetched data.
     * 
     * @param string $sql_opr string of SQL operators statement such as __LIKE__ and __IN__. Default value is empty string.
     * @param string $sql_limit contains SQL LIMIT clause. Default value is empty string.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_jobs($sql_opr = "", $sql_limit = "") {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $job = $this->dbconn->query(
            "SELECT * 
            FROM `job` AS j 
            LEFT JOIN `job_category` AS jc ON j.job_category_id = jc.jc_id 
            LEFT JOIN `job_position` AS jp ON j.job_position_id = jp.jp_id 
            LEFT JOIN `industry` AS ind ON j.job_industry_id = ind.industry_id 
            LEFT JOIN `industry_field` AS indf ON ind.industry_industry_field_id = indf.industry_field_id 
            LEFT JOIN `state` AS st ON ind.industry_state_id = st.state_id 
            WHERE {$sql_opr} j.job_status = 'Active' AND DATEDIFF(CURDATE(), j.job_date_posted) <= 30 AND ind.industry_status = 'Active' AND ind.industry_deleted_date IS NULL 
            ORDER BY j.job_date_posted DESC 
            {$sql_limit};"
        );

        if($job->num_rows > 0) {
            return $job->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the job based on `$job_id`.
     * It holds all the data from __job__, __job_category__, __job_position__, __industry__, __industry_field__, and __state__ tables.
     * 
     * @param int $job_id id of the job.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_job($job_id) {
        $job = $this->dbconn->query(
            "SELECT * 
            FROM `job` AS j 
            LEFT JOIN `job_category` AS jc ON j.job_category_id = jc.jc_id 
            LEFT JOIN `job_position` AS jp ON j.job_position_id = jp.jp_id 
            LEFT JOIN `industry` AS ind ON j.job_industry_id = ind.industry_id 
            LEFT JOIN `industry_field` AS indf ON ind.industry_industry_field_id = indf.industry_field_id 
            LEFT JOIN `state` AS st ON ind.industry_state_id = st.state_id 
            WHERE j.job_id = {$job_id} AND ind.industry_status = 'Active' AND ind.industry_deleted_date IS NULL;"
        );

        if($job->num_rows > 0) {
            return $job->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the industries.
     * It holds all the data from __industry__, __industry_field__, and __state__ tables.
     * The parameter will filtered the fetched data.
     * 
     * @param string $sql_opr string of SQL operators statement such as __LIKE__ and __IN__. Default value is empty string.
     * @param string $sql_limit contains SQL LIMIT clause. Default value is empty string.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_industries($sql_opr = "", $sql_limit = "") {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $industry = $this->dbconn->query(
            "SELECT * 
            FROM `industry` AS i 
            LEFT JOIN `industry_information` AS ii ON ii.ii_industry_id = i.industry_id 
            LEFT JOIN `industry_field` AS ind_f ON i.industry_industry_field_id = ind_f.industry_field_id 
            LEFT JOIN `state` AS st ON i.industry_state_id = st.state_id 
            WHERE {$sql_opr} i.industry_status = 'Active' AND i.industry_deleted_date IS NULL 
            ORDER BY i.industry_name 
            {$sql_limit};"
        );

        if($industry->num_rows > 0) {
            return $industry->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the industry based on `$ind_id`.
     * It holds all the data from __industry__, __industry_field__, and __state__ tables.
     * 
     * @param int $ind_id id of the industry.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_industry($ind_id) {
        $industry = $this->dbconn->query(
            "SELECT * 
            FROM `industry` AS i 
            LEFT JOIN `industry_information` AS ii ON ii.ii_industry_id = i.industry_id 
            LEFT JOIN `industry_field` AS ind_f ON i.industry_industry_field_id = ind_f.industry_field_id 
            LEFT JOIN `state` AS st ON i.industry_state_id = st.state_id 
            WHERE i.industry_id = {$ind_id} AND i.industry_status = 'Active' AND i.industry_deleted_date IS NULL;"
        );

        if($industry->num_rows > 0) {
            return $industry->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the student university's job application based on `$studuni_id`.
     * It holds all the data from __job_student_university_application__, __job__, __job_category__, __job_position__, __industry__, __industry_field__, and __state__ tables.
     * 
     * @param int $studuni_id id of student university.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_job_applications($studuni_id) {
        $job_application = $this->dbconn->query(
            "SELECT * 
            FROM `job_student_university_application` AS jsua 
            LEFT JOIN `job` AS j ON jsua.jsua_job_id = j.job_id 
            LEFT JOIN `job_category` AS jc ON j.job_category_id = jc.jc_id 
            LEFT JOIN `job_position` AS jp ON j.job_position_id = jp.jp_id 
            LEFT JOIN `industry` AS ind ON j.job_industry_id = ind.industry_id 
            LEFT JOIN `industry_field` AS indf ON ind.industry_industry_field_id = indf.industry_field_id 
            LEFT JOIN `state` AS st ON ind.industry_state_id = st.state_id 
            WHERE jsua.jsua_student_university_id = {$studuni_id} AND ind.industry_status = 'Active' AND ind.industry_deleted_date IS NULL 
            ORDER BY jsua.jsua_application_date DESC;"
        );

        if($job_application->num_rows > 0) {
            return $job_application->fetch_all(MYSQLI_ASSOC);
        } else{
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all job category.
     * It holds all the data from `job_category` table.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_job_category() {
        $job = $this->dbconn->query("SELECT * 
                                    FROM `job_category`;");

        if($job->num_rows !== 0) {
            return $job->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all Job title suggestion.
     * It holds the data from `job`->`job_title` and `industry`->`industry_name`.
     * 
     * @param string $query string from Job title search input.
     * @return array|null array containing the suggested title name, NULL if the results is empty.
     */
    public function titleSuggestion($query) {
        $arr = array();

        // Fetch job title based on $query.
        $job = $this->dbconn->query("SELECT j.job_title 
                                    FROM `job` AS j 
                                    WHERE j.job_title LIKE '%$query%';");

        if($job->num_rows > 0) {
            foreach($job->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($arr, $val["job_title"]);
            }
        }

        // Fetch industry name based on $query.
        $industry = $this->dbconn->query("SELECT ind.industry_name 
                                    FROM `industry` AS ind
                                    WHERE ind.industry_name LIKE '%$query%';");

        if($industry->num_rows > 0) {
            foreach($industry->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($arr, $val["industry_name"]);
            }
        }

        if(count($arr) > 0) {
            return $arr;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all Job location suggestion.
     * It holds all the data from `city`, `state`, and `country` tables.
     * 
     * @param string $query string from the Job location search input.
     * @return array|null array containing the suggested location name, NULL if the results is empty.
     */
    public function locationSuggestion($query) {
        $arr = array();

        // Fetch city based on the $query.
        $city = $this->dbconn->query("SELECT * 
                                    FROM `city` AS cty 
                                    WHERE cty.city_name LIKE '%$query%';");
    
        if($city->num_rows > 0) {
            foreach($city->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($arr, $val["city_name"]);
            }
        }
    
        // Fetch state based on the $query.
        $state = $this->dbconn->query("SELECT * 
                                    FROM `state` AS st 
                                    WHERE st.state_name LIKE '%$query%';");

        if($state->num_rows > 0) {
            foreach($state->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($arr, $val["state_name"]);
            }
        }

        // Fetch country based on the $query.
        $country = $this->dbconn->query("SELECT * 
                                    FROM `country` AS ctry 
                                    WHERE ctry.country_name LIKE '%$query%';");

        if($country->num_rows > 0) {
            foreach($country->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($arr, $val["country_name"]);
            }
        }

        if(count($arr) > 0) {
            return $arr;
        } else {
            return NULL;
        }

        exit();
    }

/**------------------------------------------------- FETCH JOB INFORMATION -------------------------------------------------**/


/*-------------------------------------------------- JOB INSERT, UPDATE, AND DELETE INFORMATION --------------------------------------------------*/

    /**
     * Function to insert student university's job application.
     * It will store all the data in __job_student_university_application__ table.
     * 
     * @param array $job_arr an associative array containing job application informations.
     * @return boolean `true` if success, `false` if failed. 
     */
    public function insert_job_application($job_arr) {
        $job_application = $this->dbconn->query(
            "INSERT INTO `job_student_university_application`(`jsua_job_id`, `jsua_student_university_id`, `jsua_application_date`, `jsua_status`, `jsua_summary`) 
            VALUES ({$job_arr["job_id"]}, {$job_arr["su_id"]}, '{$job_arr["date"]}', '{$job_arr["status"]}', '{$job_arr["summary"]}');"
        );

        if($job_application) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to update the student university's job application.
     * It will update the data in __job_student_university_application__ table.
     * It is used to update the status in the table.
     * 
     * @param int $jsua_id id for __job_student_university_application__.
     * @return boolean `true` if success, `false` if failed.
     */
    public function update_job_application($jsua_id) {
        $job_application = $this->dbconn->query(
            "UPDATE `job_student_university_application` 
            SET `jsua_status` = 'Withdraw' 
            WHERE `jsua_id` = {$jsua_id};"
        );

        if($job_application) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the student university's job application.
     * It will delete the data in __job_student_university_application__ table.
     * It is used to delete the row based on the `$jsua_id` in the table.
     * 
     * @param int $jsua_id id for __job_student_university_application__.
     * @return boolean `true` if success, `false` if failed.
     */
    public function delete_job_application($jsua_id) {
        $job_application = $this->dbconn->query(
            "DELETE FROM `job_student_university_application` WHERE `jsua_id` = {$jsua_id};"
        );

        if($job_application) {
            return true;
        } else {
            return false;
        }

        exit();
    }

/**------------------------------------------------- JOB INSERT, UPDATE, AND DELETE INFORMATION -------------------------------------------------**/
}