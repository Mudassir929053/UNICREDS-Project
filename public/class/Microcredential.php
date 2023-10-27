<?php
namespace DBData;

/**
 * `Microcredential` class.
 * This class used to fetch all necessary data related to micro-credential.
 */
class Microcredential {
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


/*-------------------------------------------------- MICRO-CREDENTIAL INFORMATION --------------------------------------------------*/

    /**
     * Function to fetch all the data related to the micro-credentials.
     * It holds all the data from __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * The parameter will filtered the fetched micro-credentials.
     * 
     * @param string $sql_opr string of SQL operators statement such as __LIKE__ and __IN__. Default value is empty string.
     * @param string $sql_limit contains SQL LIMIT clause. Default value is empty string.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_microcredentials($sql_opr = "", $sql_limit = "") {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $microcredential = $this->dbconn->query(
            "SELECT * 
            FROM `microcredential` AS mc 
            LEFT JOIN `mc_learning_details` AS mcld ON mcld.mcld_mc_id = mc.mc_id 
            LEFT JOIN `mc_enrolment_session` AS mces ON mces.mces_mc_id = mc.mc_id 
            LEFT JOIN `institution` AS i ON mc.mc_owner = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE {$sql_opr} mc.mc_status = 'Published' AND mc.mc_deleted_date IS NULL 
            ORDER BY mc.mc_title 
            {$sql_limit};"
        );

        if($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the micro-credential based on the `$mc_id`.
     * It holds all the data from __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_microcredential($mc_id) {
        $microcredential = $this->dbconn->query(
            "SELECT * 
            FROM `microcredential` AS mc  
            LEFT JOIN `mc_learning_details` AS mcld ON mcld.mcld_mc_id = mc.mc_id 
            LEFT JOIN `mc_enrolment_session` AS mces ON mces.mces_mc_id = mc.mc_id 
            LEFT JOIN `institution` AS i ON mc.mc_owner = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE mc.mc_id = {$mc_id} AND mc.mc_status = 'Published' AND mc.mc_deleted_date IS NULL;"
        );

        if($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the enrolled micro-credentials.
     * It holds all the data from __enrolled_mc_studuni__, __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_enrolled_microcredentials() {
        $microcredential = $this->dbconn->query(
            "SELECT * 
            FROM `enrolled_mc_studuni` AS emcsu 
            INNER JOIN `microcredential` AS mc ON emcsu.emcsu_mc_id = mc.mc_id 
            LEFT JOIN `mc_learning_details` AS mcld ON mcld.mcld_mc_id = mc.mc_id 
            LEFT JOIN `mc_enrolment_session` AS mces ON mces.mces_mc_id = mc.mc_id 
            LEFT JOIN `institution` AS i ON mc.mc_owner = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE emcsu.emcsu_student_university_id = {$this->studuni_id} AND mc.mc_status = 'Published' AND mc.mc_deleted_date IS NULL 
            ORDER BY mc.mc_title;"
        );

        if($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the enrolled micro-credential based on `$studuni_id` and `$mc_id`.
     * It holds all the data from __enrolled_mc_studuni__, __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_enrolled_microcredential($mc_id) {
        $microcredential = $this->dbconn->query(
            "SELECT * 
            FROM `enrolled_mc_studuni` AS emcsu 
            INNER JOIN `microcredential` AS mc ON emcsu.emcsu_mc_id = mc.mc_id 
            LEFT JOIN `mc_learning_details` AS mcld ON mcld.mcld_mc_id = mc.mc_id 
            LEFT JOIN `mc_enrolment_session` AS mces ON mces.mces_mc_id = mc.mc_id 
            LEFT JOIN `institution` AS i ON mc.mc_owner = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE emcsu.emcsu_student_university_id = {$this->studuni_id} AND emcsu.emcsu_mc_id = {$mc_id} AND mc.mc_status = 'Published' AND mc.mc_deleted_date IS NULL;"
        );

        if($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch course creator information based on mc_created_by.
     * It will checks if the creator is a __lecturer__ or __admin__.
     * 
     * @param int $user_id id of the user.
     * @return array an associative array containing the creator informations.
     */
    public function check_mc_creator($user_id) {
        $info_arr = array();

        $user = $this->dbconn->query(
            "SELECT r.role_name 
            FROM `user` AS u 
            INNER JOIN `role` AS r ON u.user_role_id = r.role_id 
            WHERE u.user_id = {$user_id};"
        );
        $user_info = $user->fetch_all(MYSQLI_ASSOC)[0];

        if($user_info["role_name"] === "Administrator") {
            $admin = $this->dbconn->query(
                "SELECT * 
                FROM `admin` AS a 
                LEFT JOIN institution ON institution.institution_id = a.admin_institution
                LEFT JOIN university ON institution.institution_university_id = university.university_id  
                WHERE a.admin_user_id = {$user_id};"
            );
            $admin_info = $admin->fetch_all(MYSQLI_ASSOC)[0];

            $info_arr["user_id"] = $admin_info["admin_user_id"];
            $info_arr["image"] = $admin_info["institution_logo"] !== NULL ? "../assets/images/avatar/".$admin_info["institution_logo"] : "../assets/images/avatar/university_default.jpg";
            $info_arr["name"] = $admin_info["university_name"];
            $info_arr["email"] = $admin_info["institution_email"];

        } else if($user_info["role_name"] === "Lecturer") {
            $lecturer = $this->dbconn->query(
                "SELECT * 
                FROM `lecturer` AS l 
                WHERE l.lecturer_user_id = {$user_id};"
            );

            $lecturer_info = $lecturer->fetch_all(MYSQLI_ASSOC)[0];

            $info_arr["user_id"] = $lecturer_info["lecturer_user_id"];
            $info_arr["image"] = $lecturer_info["lecturer_profile_picture"] !== NULL ? "../assets/images/avatar/".$lecturer_info["lecturer_profile_picture"] : "../assets/images/avatar/avatardefault.png";
            $info_arr["name"] = $lecturer_info["lecturer_fname"]." ".$lecturer_info["lecturer_lname"];
            $info_arr["email"] = $lecturer_info["lecturer_email"];
        }
        else if($user_info["role_name"] === "Committee") {
            $committee = $this->dbconn->query(
                "SELECT * 
                FROM `committee` AS c 
                WHERE c.committee_user_id = {$user_id};"
            );

            $committee_info = $committee->fetch_all(MYSQLI_ASSOC)[0];

            $info_arr["user_id"] = $committee_info["committee_user_id"];
            $info_arr["image"] = $committee_info["committee_logo"] !== NULL ? "../assets/images/avatar/".$committee_info["committee_logo"] : "../assets/images/avatar/university_default.jpg";
            $info_arr["name"] = $committee_info["committee_name"];
            $info_arr["email"] = $committee_info["committee_email"];
        }

        return $info_arr;

        exit();
    }
    
/**------------------------------------------------- MICRO-CREDENTIAL INFORMATION -------------------------------------------------**/


/*-------------------------------------------------- MICRO-CREDENTIAL LEARNING MATERIALS --------------------------------------------------*/

    /**
     * Function to fetch all micro-credential's videos based on `$mc_id`.
     * It holds all the data from `mc_video` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_video($mc_id) {
        $mc_video = $this->dbconn->query(
            "SELECT * 
            FROM `mc_video` AS mcv 
            WHERE mcv.mcv_mc_id = {$mc_id} AND mcv.mcv_deleted_date IS NULL 
            ORDER BY mcv.mcv_created_date;"
        );
        
        if($mc_video->num_rows > 0) {
            return $mc_video->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's notes based on `$mc_id`.
     * It holds all the data from `mc_notes` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_note($mc_id) {
        $mc_note = $this->dbconn->query(
            "SELECT * 
            FROM `mc_notes` AS mcn 
            WHERE mcn.mcn_mc_id = {$mc_id} AND mcn.mcn_deleted_date IS NULL 
            ORDER BY mcn.mcn_created_date;"
        );

        if($mc_note->num_rows > 0) {
            return $mc_note->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's slides based on `$mc_id`.
     * It holds all the data from `mc_slide` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_slide($mc_id) {
        $mc_slide = $this->dbconn->query(
            "SELECT * 
            FROM `mc_slide` AS mcs 
            WHERE mcs.mcs_mc_id = {$mc_id} AND mcs.mcs_deleted_date IS NULL 
            ORDER BY mcs.mcs_created_date;"
        );

        if($mc_slide->num_rows > 0) {
            return $mc_slide->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the micro-credential's tutorials based on `$mc_id`.
     * It holds all the data from `mc_tutorial` and `mc_tutorial_duedate` tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_tutorial($mc_id) {
        $mc_tutorial = $this->dbconn->query(
            "SELECT * 
            FROM `mc_tutorial` AS mctu 
            INNER JOIN `mc_tutorial_duedate` AS mctud ON mctud.mctud_mc_tutorial_id = mctu.mctu_id 
            WHERE mctu.mctu_mc_id = {$mc_id} AND mctu.mctu_deleted_date IS NULL 
            ORDER BY mctu.mctu_created_date;"
        );

        if($mc_tutorial->num_rows > 0) {
            return $mc_tutorial->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the micro-credential's quizzes based on `$mc_id`.
     * It holds all the data from `mc_quiz` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz($mc_id) {
        $mc_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `mc_quiz` AS mcq 
            WHERE mcq.mcq_mc_id = {$mc_id} AND mcq.mcq_deleted_date IS NULL 
            ORDER BY mcq.mcq_created_date;"
        );

        if($mc_quiz->num_rows > 0) {
            return $mc_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch a micro-credential's quiz information based on `$quiz_id`.
     * It holds all the data from `mc_quiz` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_quiz_info($quiz_id) {
        $mc_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `mc_quiz` AS mcq 
            WHERE mcq.mcq_id = {$quiz_id} AND mcq.mcq_deleted_date IS NULL;"
        );

        if($mc_quiz->num_rows > 0) {
            return $mc_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's quiz questions and answers based on `$quiz_id`.
     * It holds all the data from `mc_quiz_question`, and `mc_quiz_answer` tables.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_QnA($quiz_id) {
        $mc_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `mc_quiz_question` AS mcqq 
            LEFT JOIN `mc_quiz_answer` AS mcqa ON mcqa.mcqa_mc_quiz_question_id = mcqq.mcqq_id 
            WHERE mcqq.mcqq_mc_quiz_id = {$quiz_id} AND mcqq.mcqq_deleted_date IS NULL 
            ORDER BY mcqq.mcqq_created_date;"
        );

        if($mc_quiz->num_rows > 0) {
            return $mc_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's quiz results based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_mc_quiz_result` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_quiz_result($quiz_id) {
        $mc_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_quiz_result` AS sumcqrs 
            WHERE sumcqrs.sumcqrs_student_university_id = {$this->studuni_id} AND sumcqrs.sumcqrs_mc_quiz_id = {$quiz_id};"
        );

        if($mc_quiz->num_rows > 0) {
            return $mc_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's quiz question's review based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_mc_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_review($quiz_id) {
        $mc_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_quiz_review` AS sumcqrv 
            WHERE sumcqrv.sumcqrv_student_university_id = {$this->studuni_id} AND sumcqrv.sumcqrv_mc_quiz_id = {$quiz_id};"
        );

        if($mc_quiz->num_rows > 0) {
            return $mc_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's assignments based on `$mc_id`.
     * It holds all the data from `mc_assignment` and `mc_assignment_duedate` tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_assignment($mc_id) {
        $mc_assignment = $this->dbconn->query(
            "SELECT * 
            FROM `mc_assignment` AS mca 
            INNER JOIN `mc_assignment_duedate` AS mcad ON mcad.mcad_mc_assignment_id = mca.mca_id 
            WHERE mca.mca_mc_id = {$mc_id} AND mca.mca_deleted_date IS NULL 
            ORDER BY mca.mca_created_date;"
        );

        if($mc_assignment->num_rows > 0) {
            return $mc_assignment->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the micro-credential's projects based on `$mc_id`.
     * It holds all the data from `mc_project` and `mc_project_duedate` tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_project($mc_id) {
        $mc_project = $this->dbconn->query(
            "SELECT * 
            FROM `mc_project` AS mcp 
            INNER JOIN `mc_project_duedate` AS mcpd ON mcpd.mcpd_mc_project_id = mcp.mcp_id 
            WHERE mcp.mcp_mc_id = {$mc_id} AND mcp.mcp_deleted_date IS NULL 
            ORDER BY mcp.mcp_created_date;"
        );

        if($mc_project->num_rows > 0) {
            return $mc_project->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the micro-credential's tests based on `$mc_id`.
     * It holds all the data from `mc_test` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_test($mc_id) {
        $mc_test = $this->dbconn->query(
            "SELECT * 
            FROM `mc_test` AS mct 
            WHERE mct.mct_mc_id = {$mc_id} AND mct.mct_deleted_date IS NULL 
            ORDER BY mct.mct_created_date;"
        );

        if($mc_test->num_rows > 0) {
            return $mc_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch a micro-credential's test information based on `$test_id`.
     * It holds all the data from `mc_test` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_test_info($test_id) {
        $mc_test = $this->dbconn->query(
            "SELECT * 
            FROM `mc_test` AS mct 
            WHERE mct.mct_id = {$test_id} AND mct.mct_deleted_date IS NULL;"
        );

        if($mc_test->num_rows > 0) {
            return $mc_test->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the test's questions and answers based on `$test_id`.
     * It holds all the data from `mc_test_question`, and `mc_test_answer` tables.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_test_QnA($test_id) {
        $mc_test = $this->dbconn->query(
            "SELECT * 
            FROM `mc_test_question` AS mctq 
            LEFT JOIN `mc_test_answer` AS mcta ON mcta.mcta_mc_test_question_id = mctq.mctq_id 
            WHERE mctq.mctq_mc_test_id = {$test_id} AND mctq.mctq_deleted_date IS NULL 
            ORDER BY mctq.mctq_created_date;"
        );

        if($mc_test->num_rows > 0) {
            return $mc_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's test results based on `$studuni_id` and `$test_id`.
     * It holds all the data from `studuni_mc_test_result` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_test_result($test_id) {
        $mc_test = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_test_result` AS sumctrs 
            WHERE sumctrs.sumctrs_student_university_id = {$this->studuni_id} AND sumctrs.sumctrs_mc_test_id = {$test_id};"
        );

        if($mc_test->num_rows > 0) {
            return $mc_test->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's test question's review based on `$studuni_id` and `$test_id`.
     * It holds all the data from `studuni_mc_test_review` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_test_review($test_id) {
        $mc_test = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_test_review` AS sumctrv 
            WHERE sumctrv.sumctrv_student_university_id = {$this->studuni_id} AND sumctrv.sumctrv_mc_test_id = {$test_id};"
        );

        if($mc_test->num_rows > 0) {
            return $mc_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }


/**------------------------------------------------- MICRO-CREDENTIAL LEARNING MATERIALS -------------------------------------------------**/


/*-------------------------------------------------- MICRO-CREDENTIAL PROGRESS & SUBMISSION --------------------------------------------------*/

    /**
     * Function to determine whether the video are already watched or not.
     * It holds all the data from `studuni_mc_watched_video` table.
     * 
     * @param int $video_id id for micro-credential video.
     * @return bool `true` if matched, `false` if unmatched.
     */
    public function check_watched_video($video_id) {
        $mc_video = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_watched_video` AS sumcvw 
            WHERE sumcvw.sumcvw_mc_video_id = {$video_id} AND sumcvw.sumcvw_student_university_id = {$this->studuni_id};"
        );

        if($mc_video->num_rows > 0) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_mc_watched_video` table if the teaching video are watched.
     * It stores data about watched video(s) in `studuni_mc_watched_video` table. 
     * 
     * @param int $video_id id for micro-credential video.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_watched_video($video_id) {
        // Check if the video are already watched.
        $watched = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_mc_watched_video` AS sumcvw 
            WHERE sumcvw.sumcvw_mc_video_id = {$video_id};"
        );

        if($watched->num_rows == 0) {
            $mc_video = $this->dbconn->query(
                "INSERT INTO `studuni_mc_watched_video`(`sumcvw_student_university_id`, `sumcvw_mc_video_id`) 
                VALUES ({$this->studuni_id}, {$video_id});"
            );

            if($mc_video) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to calculate the progress of the video that has been watched and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function video_progress($mc_id) {
        $fetchVid = $this->fetch_video($mc_id);
        $total = $fetchVid !== NULL ? count($fetchVid) : 0;
        $progress = 0;

        if($fetchVid !== NULL) {
            foreach($fetchVid as $val) {
                if($this->check_watched_video($val["mcv_id"])) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch the data of the submitted tutorials.
     * It holds all the data from `studuni_mc_tutorial_submission` tables. 
     * 
     * @param int $mctu_id id for microcredential tutorial.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_tutorial_submission($mctu_id, $deleted = 0) {
        if($deleted == 0) {
            $mc_tutorial = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_tutorial_submission` AS sumctus 
                WHERE sumctus.sumctus_student_university_id = {$this->studuni_id} AND sumctus.sumctus_mc_tutorial_id = {$mctu_id};"
            );
        } else if($deleted == 1) {
            $mc_tutorial = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_tutorial_submission` AS sumctus 
                WHERE sumctus.sumctus_student_university_id = {$this->studuni_id} AND sumctus.sumctus_mc_tutorial_id = {$mctu_id} AND sumctus.sumctus_deleted_date IS NULL;"
            );
        }

        if($mc_tutorial->num_rows > 0) {
            return $mc_tutorial->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_mc_tutorial_submission` table.
     * It stores data about the tutorial submission by student university. 
     * 
     * @param int $mctu_id id for microcredential tutorial.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_tutorial_submission($mctu_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_tutorial_submission($mctu_id);

        if($isExist === NULL) {
            $mc_tutorial = $this->dbconn->query(
                "INSERT INTO `studuni_mc_tutorial_submission`(`sumctus_student_university_id`, `sumctus_mc_tutorial_id`, `sumctus_attachment`) 
                VALUES ({$this->studuni_id}, {$mctu_id}, '{$file}');"
            );
        } else {
            $sumctusID = $isExist["sumctus_id"];

            $mc_tutorial = $this->dbconn->query(
                "UPDATE `studuni_mc_tutorial_submission` 
                SET `sumctus_attachment` = '{$file}', `sumctus_submitted_date` = '{$currDate}', `sumctus_deleted_date` = NULL 
                WHERE `sumctus_id` = {$sumctusID};"
            );
        }

        if($mc_tutorial) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_mc_tutorial_submission` table.
     * 
     * @param int $mctu_id id for microcredential tutorial.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_tutorial_submission($mctu_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $mc_tutorial = $this->dbconn->query(
            "UPDATE `studuni_mc_tutorial_submission` 
            SET `sumctus_deleted_date` = '{$currDate}' 
            WHERE `sumctus_student_university_id` = {$this->studuni_id} AND `sumctus_mc_tutorial_id` = {$mctu_id};"
        );

        if($mc_tutorial) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the tutorial that has been submitted and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function tutorial_progress($mc_id) {
        $fetchTutorial = $this->fetch_tutorial($mc_id);
        $total = $fetchTutorial !== NULL ? count($fetchTutorial) : 0;
        $progress = 0;

        if($fetchTutorial !== NULL) {
            foreach($fetchTutorial as $val) {
                if($this->fetch_tutorial_submission($val["mctu_id"], 1)) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to insert the quiz's result and review.
     * This function used when the student university start attempting the quiz.
     * Store all the data in `studuni_mc_quiz_result` and `studuni_mc_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_quiz_prelim_result($quiz_id) {
        $checkReview = false;
        $total_question = 0;

        // Insert the quiz's preliminary review.
        foreach($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- store the quiz question's information in `studuni_mc_quiz_review` table.
            $quizReview = $this->dbconn->query(
                "INSERT INTO `studuni_mc_quiz_review`(`sumcqrv_student_university_id`, `sumcqrv_mc_quiz_id`, `sumcqrv_mc_quiz_question_id`, `sumcqrv_answer`, `sumcqrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, {$quiz["mcqq_id"]}, NULL, NULL);"
            );

            if($quizReview) {
                $checkReview = true;
                $total_question++;
            } else {
                $checkReview = false;
                break;
            }
        }

        // Insert the quiz's preliminary result.
        if($checkReview) {
            $quizResult = $this->dbconn->query(
                "INSERT INTO `studuni_mc_quiz_result`(`sumcqrs_student_university_id`, `sumcqrs_mc_quiz_id`, `sumcqrs_time_taken`, `sumcqrs_grade`, `sumcqrs_total_question`, `sumcqrs_total_answered_question`, `sumcqrs_total_correct_answer`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, '00:00:00', '0', {$total_question}, '0', '0');"
            );

            if($quizResult) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to calculate quiz's score.
     * Compare both answers from `mc_quiz_answer` and `$answer_info`.
     * Store all the data in `studuni_mc_quiz_result` and `studuni_mc_quiz_review` tables.
     * 
     * @param int $quiz_id id for microcredential's quiz.
     * @param array $answer_info an associative 2D array containing quiz's answers information.
     * @param string $time_taken time taken to finished the quiz (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function quiz_score($quiz_id, $answer_info, $time_taken) {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `mc_quiz_question` and calculate the grade based on the right answer.
        foreach($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- find the right answer based on the answer id.
            foreach($answer_info as $ans) {
                if($ans["answer_id"] == $quiz["mcqa_id"]) {
                    // --- check if the student answered the questions or not.
                    if($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        $answerwordfield = "mcqa_answer".$ans["answer"];
                        $answerword = $quiz["$answerwordfield"];

                        // --- compare the answer with the correct one.
                        if($ans["answer"] == $quiz["mcqa_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($quiz["mcqq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_mc_quiz_review` 
                            SET `sumcqrv_answer` = '{$answerword}', `sumcqrv_answer_status` = '{$answer_status}' 
                            WHERE `sumcqrv_student_university_id` = {$this->studuni_id} AND `sumcqrv_mc_quiz_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_mc_quiz_review` 
                            SET `sumcqrv_answer` = NULL, `sumcqrv_answer_status` = NULL 
                            WHERE `sumcqrv_student_university_id` = {$this->studuni_id} AND `sumcqrv_mc_quiz_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_mc_quiz_result` 
            SET `sumcqrs_time_taken` = '{$time_taken}', `sumcqrs_grade` = {$grade}, `sumcqrs_total_answered_question` = {$total_answered}, `sumcqrs_total_correct_answer` = {$total_correct} 
            WHERE `sumcqrs_student_university_id` = {$this->studuni_id} AND `sumcqrs_mc_quiz_id` = {$quiz_id};"
        );

        if($quizResult) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to calculate the progress of the quiz that has been submitted and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function quiz_progress($mc_id) {
        $fetchQuiz = $this->fetch_quiz($mc_id);
        $total = $fetchQuiz !== NULL ? count($fetchQuiz) : 0;
        $progress = 0;

        if($fetchQuiz !== NULL) {
            foreach($fetchQuiz as $val) {
                if($this->fetch_quiz_result($val["mcq_id"]) !== NULL) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch the data of the submitted assignments.
     * It holds all the data from `studuni_mc_assignment_submission` tables. 
     * 
     * @param int $mca_id id for microcredential assignment.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_assignment_submission($mca_id, $deleted = 0) {
        if($deleted == 0) {
            $mc_assignment = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_assignment_submission` AS sumcas 
                WHERE sumcas.sumcas_student_university_id = {$this->studuni_id} AND sumcas.sumcas_mc_assignment_id = {$mca_id};"
            );
        } else if($deleted == 1) {
            $mc_assignment = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_assignment_submission` AS sumcas 
                WHERE sumcas.sumcas_student_university_id = {$this->studuni_id} AND sumcas.sumcas_mc_assignment_id = {$mca_id} AND sumcas.sumcas_deleted_date IS NULL;"
            );
        }

        if($mc_assignment->num_rows > 0) {
            return $mc_assignment->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_mc_assignment_submission` table.
     * It stores data about the assignment submission by student university. 
     * 
     * @param int $mca_id id for microcredential assignment.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_assignment_submission($mca_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_assignment_submission($mca_id);

        if($isExist === NULL) {
            $mc_assignment = $this->dbconn->query(
                "INSERT INTO `studuni_mc_assignment_submission`(`sumcas_student_university_id`, `sumcas_mc_assignment_id`, `sumcas_attachment`) 
                VALUES ({$this->studuni_id}, {$mca_id}, '{$file}');"
            );
        } else {
            $sumcasID = $isExist["sumcas_id"];

            $mc_assignment = $this->dbconn->query(
                "UPDATE `studuni_mc_assignment_submission` 
                SET `sumcas_attachment` = '{$file}', `sumcas_submitted_date` = '{$currDate}', `sumcas_deleted_date` = NULL 
                WHERE `sumcas_id` = {$sumcasID};");
        }

        if($mc_assignment) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_mc_assignment_submission` table.
     * 
     * @param int $mca_id id for microcredential assignment.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_assignment_submission($mca_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $mc_assignment = $this->dbconn->query(
            "UPDATE `studuni_mc_assignment_submission` 
            SET `sumcas_deleted_date` = '{$currDate}' 
            WHERE `sumcas_student_university_id` = {$this->studuni_id} AND `sumcas_mc_assignment_id` = {$mca_id};"
        );

        if($mc_assignment) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the assigment that has been submitted and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function assignment_progress($mc_id) {
        $fetchAssignment = $this->fetch_assignment($mc_id);
        $total = $fetchAssignment !== NULL ? count($fetchAssignment) : 0;
        $progress = 0;

        if($fetchAssignment !== NULL) {
            foreach($fetchAssignment as $val) {
                if($this->fetch_assignment_submission($val["mca_id"], 1)) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch the data of the submitted project.
     * It holds all the data from `studuni_mc_project_submission` tables. 
     * 
     * @param int $mcp_id id for microcredential project.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_project_submission($mcp_id, $deleted = 0) {
        if($deleted == 0) {
            $mc_project = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_project_submission` AS sumcps 
                WHERE sumcps.sumcps_student_university_id = {$this->studuni_id} AND sumcps.sumcps_mc_project_id = {$mcp_id};"
            );
        } else if($deleted == 1) {
            $mc_project = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_mc_project_submission` AS sumcps 
                WHERE sumcps.sumcps_student_university_id = {$this->studuni_id} AND sumcps.sumcps_mc_project_id = {$mcp_id} AND sumcps.sumcps_deleted_date IS NULL;"
            );
        }

        if($mc_project->num_rows > 0) {
            return $mc_project->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_mc_project_submission` table.
     * It stores data about the project submission by student university. 
     * 
     * @param int $mcp_id id for microcredential project.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_project_submission($mcp_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_project_submission($mcp_id);

        if($isExist === NULL) {
            $mc_project = $this->dbconn->query(
                "INSERT INTO `studuni_mc_project_submission`(`sumcps_student_university_id`, `sumcps_mc_project_id`, `sumcps_attachment`) 
                VALUES ({$this->studuni_id}, {$mcp_id}, '{$file}');"
            );
        } else {
            $sumcpsID = $isExist["sumcps_id"];

            $mc_project = $this->dbconn->query(
                "UPDATE `studuni_mc_project_submission` 
                SET `sumcps_attachment` = '{$file}', `sumcps_submitted_date` = '{$currDate}', `sumcps_deleted_date` = NULL 
                WHERE `sumcps_id` = {$sumcpsID};"
            );
        }

        if($mc_project) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_mc_project_submission` table.
     * 
     * @param int $mcp_id id for microcredential project.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_project_submission($mcp_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $mc_project = $this->dbconn->query(
            "UPDATE `studuni_mc_project_submission` 
            SET `sumcps_deleted_date` = '{$currDate}' 
            WHERE `sumcps_student_university_id` = {$this->studuni_id} AND `sumcps_mc_project_id` = {$mcp_id};"
        );

        if($mc_project) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the project that has been submitted and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function project_progress($mc_id) {
        $fetchProject = $this->fetch_project($mc_id);
        $total = $fetchProject !== NULL ? count($fetchProject) : 0;
        $progress = 0;

        if($fetchProject !== NULL) {
            foreach($fetchProject as $val) {
                if($this->fetch_project_submission($val["mcp_id"], 1)) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to insert the test's result and review.
     * This function used when the student university start attempting the test.
     * Store all the data in `studuni_mc_test_result` and `studuni_mc_test_review` table.
     * 
     * @param int $test_id id for test.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_test_prelim_result($test_id) {
        $checkReview = false;
        $total_question = 0;

        // Insert the test's preliminary review.
        foreach($this->fetch_test_QnA($test_id) as $test) {
            // --- store the test question's information in `studuni_mc_test_review` table.
            $testReview = $this->dbconn->query(
                "INSERT INTO `studuni_mc_test_review`(`sumctrv_student_university_id`, `sumctrv_mc_test_id`, `sumctrv_mc_test_question_id`, `sumctrv_answer`, `sumctrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$test_id}, {$test["mctq_id"]}, NULL, NULL);"
            );

            if($testReview) {
                $checkReview = true;
                $total_question++;
            } else {
                $checkReview = false;
                break;
            }
        }

        // Insert the test's preliminary result.
        if($checkReview) {
            $testResult = $this->dbconn->query(
                "INSERT INTO `studuni_mc_test_result`(`sumctrs_student_university_id`, `sumctrs_mc_test_id`, `sumctrs_time_taken`, `sumctrs_grade`, `sumctrs_total_question`, `sumctrs_total_answered_question`, `sumctrs_total_correct_answer`) 
                VALUES ({$this->studuni_id}, {$test_id}, '00:00:00', '0', {$total_question}, '0', '0');"
            );

            if($testResult) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to calculate test's score.
     * Compare both answers from `mc_test_answer` and `$answer_info`.
     * Store all the data in `studuni_mc_test_result` and `studuni_mc_test_review` tables.
     * 
     * @param int $test_id id for microcredential's test.
     * @param array $answer_info an associative 2D array containing test's answers information.
     * @param string $time_taken time taken to finished the test (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function test_score($test_id, $answer_info, $time_taken) {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `mc_test_question` and calculate the grade based on the right answer.
        foreach($this->fetch_test_QnA($test_id) as $test) {
            // --- find the right answer based on the answer id.
            foreach($answer_info as $ans) {
                if($ans["answer_id"] == $test["mcta_id"]) {
                    if($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        $answerwordfield = "mcta_answer".$ans["answer"];
                        $answerword = $test["$answerwordfield"];

                        // --- compared the answer with the correct one.
                        if($ans["answer"] == $test["mcta_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($test["mctq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current test's review.
                        $testReview = $this->dbconn->query(
                            "UPDATE `studuni_mc_test_review` 
                            SET `sumctrv_answer` = '{$answerword}', `sumctrv_answer_status` = '{$answer_status}' 
                            WHERE `sumctrv_student_university_id` = {$this->studuni_id} AND `sumctrv_mc_test_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current test's review.
                        $testReview = $this->dbconn->query(
                            "UPDATE `studuni_mc_test_review` 
                            SET `sumctrv_answer` = NULL, `sumctrv_answer_status` = NULL 
                            WHERE `sumctrv_student_university_id` = {$this->studuni_id} AND `sumctrv_mc_test_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current test's result.
        $testResult = $this->dbconn->query(
            "UPDATE `studuni_mc_test_result` 
            SET `sumctrs_time_taken` = '{$time_taken}', `sumctrs_grade` = {$grade}, `sumctrs_total_answered_question` = {$total_answered}, `sumctrs_total_correct_answer` = {$total_correct} 
            WHERE `sumctrs_student_university_id` = {$this->studuni_id} AND `sumctrs_mc_test_id` = {$test_id};"
        );

        if($testResult) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to calculate the progress of the test that has been submitted and store it in 
     * `studuni_mc_learning_progress` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function test_progress($mc_id) {
        $fetchTest = $this->fetch_test($mc_id);
        $total = $fetchTest !== NULL ? count($fetchTest) : 0;
        $progress = 0;

        if($fetchTest !== NULL) {
            foreach($fetchTest as $val) {
                if($this->fetch_test_result($val["mct_id"]) !== NULL) {
                    $progress++;
                }
            }

            $percentage = round(($progress / $total) * 100);

            return array(
                "progress"   => $progress, 
                "total"      => $total, 
                "percentage" => $percentage
            );
        } else {
            return NULL;
        }

        exit();
    }

/**------------------------------------------------- MICRO-CREDENTIAL PROGRESS & SUBMISSION -------------------------------------------------**/
}