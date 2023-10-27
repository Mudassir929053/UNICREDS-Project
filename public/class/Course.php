<?php
namespace DBData;

/**
 * `Course` class.
 * This class used to fetch all necessary data related to courses.
 */
class Course {
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


/*-------------------------------------------------- COURSE INFORMATION --------------------------------------------------*/

    /**
     * Function to fetch all the data related to the courses.
     * It holds all the data from __course__, __course_learning_details__, and __course_enrolment_session__ tables.
     * The parameter will filtered the fetched courses.
     * 
     * @param string $sql_opr string of SQL operators statement such as __LIKE__ and __IN__. Default value is empty string.
     * @param string $sql_limit contains SQL LIMIT clause. Default value is empty string.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_courses($sql_opr = "", $sql_limit = "") {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $course = $this->dbconn->query(
            "SELECT * 
            FROM `course` AS c 
            LEFT JOIN `course_learning_details` AS cld ON cld.cld_course_id = c.course_id 
            LEFT JOIN `course_enrolment_session` AS ces ON ces.ces_course_id = c.course_id 
            WHERE {$sql_opr} c.course_status = 'Published' AND  c.course_deleted_date IS NULL 
            ORDER BY c.course_title 
            {$sql_limit};"
        );

        if($course->num_rows > 0) {
            return $course->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the course based on the `$course_id`.
     * It holds all the data from __course__, __course_learning_details__, and __course_enrolment_session__ tables.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_course($course_id) {
        $course = $this->dbconn->query(
            "SELECT * 
            FROM `course` AS c 
            LEFT JOIN `course_learning_details` AS cld ON cld.cld_course_id = c.course_id 
            LEFT JOIN `course_enrolment_session` AS ces ON ces.ces_course_id = c.course_id 
            WHERE c.course_id = {$course_id} AND c.course_status = 'Published' AND c.course_deleted_date IS NULL;"
        );

        if($course->num_rows > 0) {
            return $course->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the enrolled courses by student university based on the `$studuni_id`.
     * It holds all the data from __enrolled_course_studuni__, __course__, __course_learning_details__, and __course_enrolment_session__ tables.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    // public function fetch_enrolled_courses() {
    //     $course = $this->dbconn->query(
    //         "SELECT * 
    //         FROM `enrolled_course_studuni` AS ecsu 
    //         LEFT JOIN `course` AS c ON ecsu.ecsu_course_id = c.course_id 
    //         LEFT JOIN `course_learning_details` AS cld ON cld.cld_course_id = c.course_id 
    //         LEFT JOIN `course_enrolment_session` AS ces ON ces.ces_course_id = c.course_id 
    //         WHERE ecsu.ecsu_student_university_id = {$this->studuni_id} AND c.course_status = 'Published' AND c.course_deleted_date IS NULL 
    //         ORDER BY c.course_title;"
    //     );

    //     if($course->num_rows > 0) {
    //         return $course->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return NULL;
    //     }

    //     exit();
    // }

    /**
     * Function to fetch all the data related to the enrolled course by student university based on the `$studuni_id` and `$course_id`.
     * It holds all the data from __enrolled_course_studuni__, __course__, __course_learning_details__, and __course_enrolment_session__ tables.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    // public function fetch_enrolled_course($course_id) {
    //     $course = $this->dbconn->query(
    //         "SELECT * 
    //         FROM `enrolled_course_studuni` AS ecsu 
    //         LEFT JOIN `course` AS c ON ecsu.ecsu_course_id = c.course_id 
    //         LEFT JOIN `course_learning_details` AS cld ON cld.cld_course_id = c.course_id 
    //         LEFT JOIN `course_enrolment_session` AS ces ON ces.ces_course_id = c.course_id 
    //         WHERE ecsu.ecsu_student_university_id = {$this->studuni_id} AND ecsu.ecsu_course_id = {$course_id} AND c.course_status = 'Published' AND c.course_deleted_date IS NULL;"
    //     );

    //     if($course->num_rows > 0) {
    //         return $course->fetch_all(MYSQLI_ASSOC)[0];
    //     } else {
    //         return NULL;
    //     }

    //     exit();
    // }
    
    /**
     * Function to determine the owner of the course which can be either administrator, instructor, or instituition.
     * Can also used to determine the creator of the course.
     * 
     * @param int $user_id id of the user.
     * @return array an associative array containing the owner info.
     */
    public function check_course_owner($user_id) {
        $user = $this->dbconn->query(
            "SELECT r.role_name 
            FROM `user` AS u 
            INNER JOIN `role` AS r ON u.user_role_id = r.role_id 
            WHERE u.user_id = {$user_id} AND u.user_deleted_date IS NULL;"
        );
        $role_name = $user->fetch_all(MYSQLI_ASSOC)[0]["role_name"];

        if($role_name === "Administrator") {
            $admin = $this->dbconn->query(
                "SELECT * 
                FROM `admin` AS a 
                LEFT JOIN institution ON institution.institution_id = a.admin_institution
                LEFT JOIN university ON institution.institution_university_id = university.university_id  
                WHERE a.admin_user_id = {$user_id} AND a.admin_deleted_date IS NULL;"
            );
            $a_info = $admin->fetch_all(MYSQLI_ASSOC)[0];
            
            return array(
                "id"        => $a_info["institution_id"], 
                "user_id"   => $a_info["admin_user_id"], 
                "image"     => $a_info["institution_logo"] !== NULL ? "../assets/images/avatar/{$a_info["institution_logo"]}" : "../assets/images/avatar/university_default.jpg", 
                "name"      => $a_info["university_name"], 
                "email"     => $a_info["institution_email"], 
                "contact"   => NULL, 
                "website"   => NULL
            );
        } else if($role_name === "Committee") {
            $committee = $this->dbconn->query(
                "SELECT * 
                FROM `committee` AS c 
                WHERE c.committee_user_id = {$user_id} AND c.committee_deleted_date IS NULL;"
            );
            $c_info = $committee->fetch_all(MYSQLI_ASSOC)[0];

            return array(
                "id"        => $c_info["committee_id"], 
                "user_id"   => $c_info["committee_user_id"], 
                "image"     => $c_info["committee_logo"] !== NULL ? "../assets/images/avatar/{$c_info["committee_logo"]}" : "../assets/images/avatar/university_default.jpg", 
                "name"      => $c_info["committee_name"], 
                "email"     => $c_info["committee_email"], 
                "contact"   => $c_info["committee_contact_no"], 
                "website"   => NULL
            );
        } else if($role_name === "Expert") {
            $expert = $this->dbconn->query(
                "SELECT * 
                FROM `expert` AS e 
                WHERE e.expert_user_id = {$user_id} AND e.expert_deleted_date IS NULL;"
            );
            $e_info = $expert->fetch_all(MYSQLI_ASSOC)[0];

            return array(
                "id"        => $e_info["expert_id"], 
                "user_id"   => $e_info["expert_user_id"], 
                "image"     => "../assets/images/avatar/avatardefault.png", 
                "name"      => "{$e_info["expert_fname"]} {$e_info["expert_lname"]}", 
                "email"     => $e_info["expert_email"], 
                "contact"   => $e_info["expert_contact_no"], 
                "website"   => NULL
            );
        } else if($role_name === "Lecturer") {
            $lecturer = $this->dbconn->query(
                "SELECT * 
                FROM `lecturer` AS l 
                WHERE l.lecturer_user_id = {$user_id} AND l.lecturer_deleted_date IS NULL;"
            );
            $l_info = $lecturer->fetch_all(MYSQLI_ASSOC)[0];

            return array(
                "id"        => $l_info["lecturer_id"], 
                "user_id"   => $l_info["lecturer_user_id"], 
                "image"     => $l_info["lecturer_profile_picture"] !== NULL ? "../assets/images/avatar/{$l_info["lecturer_profile_picture"]}" : "../assets/images/avatar/avatardefault.png", 
                "name"      => "{$l_info["lecturer_fname"]} {$l_info["lecturer_lname"]}", 
                "email"     => $l_info["lecturer_email"], 
                "contact"   => $l_info["lecturer_contact_no"], 
                "website"   => NULL
            );
        }

        exit();
    }

/**------------------------------------------------- COURSE INFORMATION -------------------------------------------------**/


/*-------------------------------------------------- COURSE LEARNING MATERIALS --------------------------------------------------*/

    /**
     * Function to fetch all course's videos based on `$course_id`.
     * It holds all the data from `course_video` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_video($course_id) {
        $course_video = $this->dbconn->query(
            "SELECT * 
            FROM `course_video` AS cv 
            WHERE cv.cv_course_id = {$course_id} AND cv.cv_deleted_date IS NULL 
            ORDER BY cv.cv_created_date;"
        );

        if($course_video->num_rows > 0) {
            return $course_video->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's notes based on `$course_id`.
     * It holds all the data from `course_notes` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_note($course_id) {
        $course_note = $this->dbconn->query(
            "SELECT * 
            FROM `course_notes` AS cn 
            WHERE cn.cn_course_id = {$course_id} AND cn.cn_deleted_date IS NULL 
            ORDER BY cn.cn_created_date;"
        );

        if($course_note->num_rows > 0) {
            return $course_note->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's slides based on `$course_id`.
     * It holds all the data from `course_slide` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_slide($course_id) {
        $course_slide = $this->dbconn->query(
            "SELECT * 
            FROM `course_slide` AS cs 
            WHERE cs.cs_course_id = {$course_id} AND cs.cs_deleted_date IS NULL 
            ORDER BY cs.cs_created_date;"
        );

        if($course_slide->num_rows > 0) {
            return $course_slide->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's tutorials based on `$course_id`.
     * It holds all the data from `course_tutorial` and `course_tutorial_duedate` tables.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_tutorial($course_id) {
        $course_tutorial = $this->dbconn->query(
            "SELECT * 
            FROM `course_tutorial` AS ctu 
            INNER JOIN `course_tutorial_duedate` AS ctud ON ctud.ctud_course_tutorial_id = ctu.ctu_id 
            WHERE ctu.ctu_course_id = {$course_id} AND ctu.ctu_deleted_date IS NULL 
            ORDER BY ctu.ctu_created_date;"
        );

        if($course_tutorial->num_rows > 0) {
            return $course_tutorial->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's quizzes based on `$course_id`.
     * It holds all data from `course_quiz` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz($course_id) {
        $course_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `course_quiz` AS cq 
            WHERE cq.cq_course_id = {$course_id} AND cq.cq_deleted_date IS NULL 
            ORDER BY cq.cq_created_date;"
        );

        if($course_quiz->num_rows > 0) {
            return $course_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch a course's quiz information based on `$quiz_id`.
     * It holds all the data from `course_quiz` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_quiz_info($quiz_id) {
        $course_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `course_quiz` AS cq 
            WHERE cq.cq_id = {$quiz_id} AND cq.cq_deleted_date IS NULL;"
        );

        if($course_quiz->num_rows > 0) {
            return $course_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all quiz's questions and answers based on `$quiz_id`.
     * It holds all the data from `course_quiz_question`, and `course_quiz_answer` tables.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_QnA($quiz_id) {
        $course_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `course_quiz_question` AS cqq 
            LEFT JOIN `course_quiz_answer` AS cqa ON cqa.cqa_course_quiz_question_id = cqq.cqq_id 
            WHERE cqq.cqq_course_quiz_id = {$quiz_id} AND cqq.cqq_deleted_date IS NULL 
            ORDER BY cqq.cqq_created_date;"
        );

        if($course_quiz->num_rows > 0) {
            return $course_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's quiz results based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_course_quiz_result` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_quiz_result($quiz_id) {
        $course_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_quiz_result` AS sucqrs 
            WHERE sucqrs.sucqrs_student_university_id = {$this->studuni_id} AND sucqrs.sucqrs_course_quiz_id = {$quiz_id};"
        );

        if($course_quiz->num_rows > 0) {
            return $course_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's quiz question's review based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_course_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_review($quiz_id) {
        $course_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_quiz_review` AS sucqrv 
            WHERE sucqrv.sucqrv_student_university_id = {$this->studuni_id} AND sucqrv.sucqrv_course_quiz_id = {$quiz_id};"
        );

        if($course_quiz->num_rows > 0) {
            return $course_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }


    /**
     * Function to fetch all course's assignments based on `$course_id`.
     * It holds all data from `course_assignment` and `course_assignment_duedate` tables.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_assignment($course_id) {
        $course_assignment = $this->dbconn->query(
            "SELECT * 
            FROM `course_assignment` AS ca 
            INNER JOIN `course_assignment_duedate` AS cad ON cad.cad_course_assignment_id = ca.ca_id 
            WHERE ca.ca_course_id = {$course_id} AND ca.ca_deleted_date IS NULL 
            ORDER BY ca.ca_created_date;"
        );

        if($course_assignment->num_rows > 0) {
            return $course_assignment->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's projects based on `$course_id`.
     * It holds all the data from `course_project` and `course_project_duedate` tables.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_project($course_id) {
        $course_project = $this->dbconn->query(
            "SELECT * 
            FROM `course_project` AS cp 
            INNER JOIN `course_project_duedate` AS cpd ON cpd.cpd_course_project_id = cp.cp_id 
            WHERE cp.cp_course_id = {$course_id} AND cp.cp_deleted_date IS NULL 
            ORDER BY cp.cp_created_date;"
        );

        if($course_project->num_rows > 0) {
            return $course_project->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's tests based on `$course_id`.
     * It holds all the data from `course_test` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_test($course_id) {
        $course_test = $this->dbconn->query(
            "SELECT * 
            FROM `course_test` AS ct 
            WHERE ct.ct_course_id = {$course_id} AND ct.ct_deleted_date IS NULL 
            ORDER BY ct.ct_created_date;"
        );

        if($course_test->num_rows > 0) {
            return $course_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch a course's test information based on `$test_id`.
     * It holds all the data from `course_test` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_test_info($test_id) {
        $course_test = $this->dbconn->query(
            "SELECT * 
            FROM `course_test` AS ct 
            WHERE ct.ct_id = {$test_id} AND ct.ct_deleted_date IS NULL;"
        );

        if($course_test->num_rows > 0) {
            return $course_test->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all test's questions and answers based on `$test_id`.
     * It holds all the data from `course_test`, `course_test_question`, and `course_test_answer` tables.
     * 
     * @param int $test_id id for course's test.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_test_QnA($test_id) {
        $course_test = $this->dbconn->query(
            "SELECT * 
            FROM `course_test_question` AS ctq 
            LEFT JOIN `course_test_answer` AS cta ON cta.cta_course_test_question_id = ctq.ctq_id 
            WHERE ctq.ctq_course_test_id = {$test_id} AND ctq.ctq_deleted_date IS NULL 
            ORDER BY ctq.ctq_created_date;"
        );

        if($course_test->num_rows > 0) {
            return $course_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's test results based on `$studuni_id` and `$test_id`.
     * It holds all the data from `studuni_course_test_result` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_test_result($test_id) {
        $course_test = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_test_result` AS suctrs 
            WHERE suctrs.suctrs_student_university_id = {$this->studuni_id} AND suctrs.suctrs_course_test_id = {$test_id};"
        );

        if($course_test->num_rows > 0) {
            return $course_test->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all course's test question's review based on `$studuni_id` and `$test_id`.
     * It holds all the data from `studuni_course_test_review` table.
     * 
     * @param int $test_id id for test.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_test_review($test_id) {
        $course_test = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_test_review` AS suctrv 
            WHERE suctrv.suctrv_student_university_id = {$this->studuni_id} AND suctrv.suctrv_course_test_id = {$test_id};"
        );

        if($course_test->num_rows > 0) {
            return $course_test->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

/**------------------------------------------------- COURSE LEARNING MATERIALS -------------------------------------------------**/


/*-------------------------------------------------- COURSE PROGRESS & SUBMISSION --------------------------------------------------*/

    /**
     * Function to determine whether the video are already watched or not.
     * It holds all the data from `studuni_course_watched_video` table.
     * 
     * @param int $video_id id for course video.
     * @return bool `true` if matched, `false` if unmatched.
     */
    public function check_watched_video($video_id) {
        $course_video = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_watched_video` AS sucvw 
            WHERE sucvw.sucvw_student_university_id = {$this->studuni_id} AND sucvw.sucvw_course_video_id = {$video_id};"
        );

        if($course_video->num_rows > 0) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_course_watched_video` table if the teaching video are watched.
     * It stores data about watched video(s) in `studuni_course_watched_video` table. 
     * 
     * @param int $video_id id for course video.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_watched_video($video_id) {
        // Check if the video are already watched.
        $watched = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_course_watched_video` AS sucvw 
            WHERE sucvw.sucvw_course_video_id = {$video_id};"
        );

        if($watched->num_rows == 0) {
            $course_video = $this->dbconn->query(
                "INSERT INTO `studuni_course_watched_video`(`sucvw_student_university_id`, `sucvw_course_video_id`) 
                VALUES ({$this->studuni_id}, {$video_id});"
            );

            if($course_video) {
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
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function video_progress($course_id) {
        $fetchVid = $this->fetch_video($course_id);
        $total = $fetchVid !== NULL ? count($fetchVid) : 0;
        $progress = 0;

        if($fetchVid !== NULL) {
            foreach($fetchVid as $val) {
                if($this->check_watched_video($val["cv_id"])) {
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
     * It holds all the data from `studuni_course_tutorial_submission` tables. 
     * 
     * @param int $ctu_id id for course tutorial.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_tutorial_submission($ctu_id, $deleted = 0) {
        if($deleted == 0) {
            $course_tutorial = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_tutorial_submission` AS suctus 
                WHERE suctus.suctus_student_university_id = {$this->studuni_id} AND suctus.suctus_course_tutorial_id = {$ctu_id};"
            );
        } else if($deleted == 1) {
            $course_tutorial = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_tutorial_submission` AS suctus 
                WHERE suctus.suctus_student_university_id = {$this->studuni_id} AND suctus.suctus_course_tutorial_id = {$ctu_id} AND suctus.suctus_deleted_date IS NULL;"
            );
        }

        if($course_tutorial->num_rows > 0) {
            return $course_tutorial->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_course_tutorial_submission` table.
     * It stores data about the tutorial submission by student university. 
     * 
     * @param int $ctu_id id for course tutorial.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_tutorial_submission($ctu_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_tutorial_submission($ctu_id);

        if($isExist === NULL) {
            $course_tutorial = $this->dbconn->query(
                "INSERT INTO `studuni_course_tutorial_submission`(`suctus_student_university_id`, `suctus_course_tutorial_id`, `suctus_attachment`) 
                VALUES ({$this->studuni_id}, {$ctu_id}, '{$file}');"
            );
        } else {
            $suctusID = $isExist["suctus_id"];

            $course_tutorial = $this->dbconn->query(
                "UPDATE `studuni_course_tutorial_submission` 
                SET `suctus_attachment` = '{$file}', `suctus_submitted_date` = '{$currDate}', `suctus_deleted_date` = NULL 
                WHERE `suctus_id` = {$suctusID};"
            );
        }

        if($course_tutorial) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_course_tutorial_submission` table.
     * 
     * @param int $ctu_id id for course tutorial.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_tutorial_submission($ctu_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $course_tutorial = $this->dbconn->query(
            "UPDATE `studuni_course_tutorial_submission` 
            SET `suctus_deleted_date` = '{$currDate}' 
            WHERE `suctus_student_university_id` = {$this->studuni_id} AND `suctus_course_tutorial_id` = {$ctu_id};"
        );

        if($course_tutorial) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the tutorial that has been submitted and store it in 
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function tutorial_progress($course_id) {
        $fetchTutorial = $this->fetch_tutorial($course_id);
        $total = $fetchTutorial !== NULL ? count($fetchTutorial) : 0;
        $progress = 0;

        if($fetchTutorial !== NULL) {
            foreach($fetchTutorial as $val) {
                if($this->fetch_tutorial_submission($val["ctu_id"], 1)) {
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
     * Store all the data in `studuni_course_quiz_result` and `studuni_course_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_quiz_prelim_result($quiz_id) {
        $checkReview = false;
        $total_question = 0;

        // Insert the quiz's preliminary review.
        foreach($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- store the quiz question's information in `studuni_course_quiz_review` table.
            $quizReview = $this->dbconn->query(
                "INSERT INTO `studuni_course_quiz_review`(`sucqrv_student_university_id`, `sucqrv_course_quiz_id`, `sucqrv_course_quiz_question_id`, `sucqrv_answer`, `sucqrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, {$quiz["cqq_id"]}, NULL, NULL);"
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
                "INSERT INTO `studuni_course_quiz_result`(`sucqrs_student_university_id`, `sucqrs_course_quiz_id`, `sucqrs_time_taken`, `sucqrs_grade`, `sucqrs_total_question`, `sucqrs_total_answered_question`, `sucqrs_total_correct_answer`) 
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
     * Compare both answers from `course_quiz_answer` and `$answer_info`.
     * Store all the data in `studuni_course_quiz_result` and `studuni_course_quiz_review` tables.
     * 
     * @param int $quiz_id id for course's quiz.
     * @param array $answer_info an associative 2D array containing quiz's answers information.
     * @param string $time_taken time taken to finished the quiz (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function quiz_score($quiz_id, $answer_info, $time_taken) {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `course_quiz_question` and calculate the grade based on the right answer.
        foreach($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- find the right answer based on the answer id.
            foreach($answer_info as $ans) {
                if($ans["answer_id"] == $quiz["cqa_id"]) {
                    if($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        $answerwordfield = "cqa_answer".$ans["answer"];
                        $answerword = $quiz["$answerwordfield"];

                        // --- compared the answer with the correct one.
                        if($ans["answer"] == $quiz["cqa_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($quiz["cqq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_course_quiz_review` 
                            SET `sucqrv_answer` = '{$answerword}', `sucqrv_answer_status` = '{$answer_status}' 
                            WHERE `sucqrv_student_university_id` = {$this->studuni_id} AND `sucqrv_course_quiz_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_course_quiz_review` 
                            SET `sucqrv_answer` = NULL, `sucqrv_answer_status` = NULL 
                            WHERE `sucqrv_student_university_id` = {$this->studuni_id} AND `sucqrv_course_quiz_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_course_quiz_result` 
            SET `sucqrs_time_taken` = '{$time_taken}', `sucqrs_grade` = {$grade}, `sucqrs_total_answered_question` = {$total_answered}, `sucqrs_total_correct_answer` = {$total_correct}
            WHERE `sucqrs_student_university_id` = {$this->studuni_id} AND `sucqrs_course_quiz_id` = {$quiz_id};"
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
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function quiz_progress($course_id) {
        $fetchQuiz = $this->fetch_quiz($course_id);
        $total = $fetchQuiz !== NULL ? count($fetchQuiz) : 0;
        $progress = 0;

        if($fetchQuiz !== NULL) {
            foreach($fetchQuiz as $val) {
                if($this->fetch_quiz_result($val["cq_id"]) !== NULL) {
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
     * It holds all the data from `studuni_course_assignment_submission` tables. 
     * 
     * @param int $ca_id id for course assignment.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_assignment_submission($ca_id, $deleted = 0) {
        if($deleted == 0) {
            $course_assignment = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_assignment_submission` AS sucas 
                WHERE sucas.sucas_student_university_id = {$this->studuni_id} AND sucas.sucas_course_assignment_id = {$ca_id};"
            );
        } else if($deleted == 1) {
            $course_assignment = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_assignment_submission` AS sucas 
                WHERE sucas.sucas_student_university_id = {$this->studuni_id} AND sucas.sucas_course_assignment_id = {$ca_id} AND sucas.sucas_deleted_date IS NULL;"
            );
        }

        if($course_assignment->num_rows > 0) {
            return $course_assignment->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_course_assignment_submission` table.
     * It stores data about the assignment submission by student university. 
     * 
     * @param int $ca_id id for course assignment.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_assignment_submission($ca_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_assignment_submission($ca_id);

        if($isExist === NULL) {
            $course_assignment = $this->dbconn->query(
                "INSERT INTO `studuni_course_assignment_submission`(`sucas_student_university_id`, `sucas_course_assignment_id`, `sucas_attachment`) 
                VALUES ({$this->studuni_id}, {$ca_id}, '{$file}');"
            );
        } else {
            $sucasID = $isExist["sucas_id"];

            $course_assignment = $this->dbconn->query(
                "UPDATE `studuni_course_assignment_submission` 
                SET `sucas_attachment` = '{$file}', `sucas_submitted_date` = '{$currDate}', `sucas_deleted_date` = NULL 
                WHERE `sucas_id` = {$sucasID};"
            );
        }

        if($course_assignment) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_course_assignment_submission` table.
     * 
     * @param int $ca_id id for course assignment.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_assignment_submission($ca_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $course_assignment = $this->dbconn->query(
            "UPDATE `studuni_course_assignment_submission` 
            SET `sucas_deleted_date` = '{$currDate}' 
            WHERE `sucas_student_university_id` = {$this->studuni_id} AND `sucas_course_assignment_id` = {$ca_id};"
        );

        if($course_assignment) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the assigment that has been submitted and store it in 
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function assignment_progress($course_id) {
        $fetchAssignment = $this->fetch_assignment($course_id);
        $total = $fetchAssignment !== NULL ? count($fetchAssignment) : 0;
        $progress = 0;

        if($fetchAssignment !== NULL) {
            foreach($fetchAssignment as $val) {
                if($this->fetch_assignment_submission($val["ca_id"], 1)) {
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
     * It holds all the data from `studuni_course_project_submission` tables. 
     * 
     * @param int $cp_id id for course project.
     * @param int $deleted 0: default, 1: fetch data where the deleted date is null.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_project_submission($cp_id, $deleted = 0) {
        if($deleted == 0) {
            $course_project = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_project_submission` AS sucps 
                WHERE sucps.sucps_student_university_id = {$this->studuni_id} AND sucps.sucps_course_project_id = {$cp_id};"
            );
        } else if($deleted == 1) {
            $course_project = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_course_project_submission` AS sucps 
                WHERE sucps.sucps_student_university_id = {$this->studuni_id} AND sucps.sucps_course_project_id = {$cp_id} AND sucps.sucps_deleted_date IS NULL;");
        }

        if($course_project->num_rows > 0) {
            return $course_project->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to store the data in `studuni_course_project_submission` table.
     * It stores data about the project submission by student university. 
     * 
     * @param int $cp_id id for course project.
     * @param string $file name of the file.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_project_submission($cp_id, $file) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));
        $isExist = $this->fetch_project_submission($cp_id);

        if($isExist === NULL) {
            $course_project = $this->dbconn->query(
                "INSERT INTO `studuni_course_project_submission`(`sucps_student_university_id`, `sucps_course_project_id`, `sucps_attachment`) 
                VALUES ({$this->studuni_id}, {$cp_id}, '{$file}');"
            );
        } else {
            $sucpsID = $isExist["sucps_id"];

            $course_project = $this->dbconn->query(
                "UPDATE `studuni_course_project_submission` 
                SET `sucps_attachment` = '{$file}', `sucps_submitted_date` = '{$currDate}', `sucps_deleted_date` = NULL 
                WHERE `sucps_id` = {$sucpsID};"
            );
        }

        if($course_project) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to delete the data in `studuni_course_project_submission` table.
     * 
     * @param int $cp_id id for course project.
     * @return bool `true` if success, `false` if failed.
     */
    public function remove_project_submission($cp_id) {
        $currDate = date('Y-m-d H:i:s', strtotime("now"));

        $course_project = $this->dbconn->query(
            "UPDATE `studuni_course_project_submission` 
            SET `sucps_deleted_date` = '{$currDate}' 
            WHERE `sucps_student_university_id` = {$this->studuni_id} AND `sucps_course_project_id` = {$cp_id};"
        );

        if($course_project) {
            return true;
        } else {
            return false;
        }
        
        exit();
    }

    /**
     * Function to calculate the progress of the project that has been submitted and store it in 
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function project_progress($course_id) {
        $fetchProject = $this->fetch_project($course_id);
        $total = $fetchProject !== NULL ? count($fetchProject) : 0;
        $progress = 0;

        if($fetchProject !== NULL) {
            foreach($fetchProject as $val) {
                if($this->fetch_project_submission($val["cp_id"], 1)) {
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
     * Store all the data in `studuni_course_test_result` and `studuni_course_test_review` table.
     * 
     * @param int $test_id id for test.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_test_prelim_result($test_id) {
        $checkReview = false;
        $total_question = 0;

        // Insert the test's preliminary review.
        foreach($this->fetch_test_QnA($test_id) as $test) {
            // --- store the test question's information in `studuni_course_test_review` table.
            $testReview = $this->dbconn->query(
                "INSERT INTO `studuni_course_test_review`(`suctrv_student_university_id`, `suctrv_course_test_id`, `suctrv_course_test_question_id`, `suctrv_answer`, `suctrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$test_id}, {$test["ctq_id"]}, NULL, NULL);");

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
                "INSERT INTO `studuni_course_test_result`(`suctrs_student_university_id`, `suctrs_course_test_id`, `suctrs_time_taken`, `suctrs_grade`, `suctrs_total_question`, `suctrs_total_answered_question`, `suctrs_total_correct_answer`) 
                VALUES ({$this->studuni_id}, {$test_id}, '00:00:00', '0', {$total_question}, '0', '0');");

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
     * Compare both answers from `course_test_answer` and `$answer_info`.
     * Store all the data in `studuni_course_test_result` and `studuni_course_test_review` tables.
     * 
     * @param int $test_id id for course's test.
     * @param array $answer_info an associative 2D array containing test's answers information.
     * @param string $time_taken time taken to finished the test (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function test_score($test_id, $answer_info, $time_taken) {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `course_test_question` and calculate the grade based on the right answer.
        foreach($this->fetch_test_QnA($test_id) as $test) {
            // --- find the right answer based on the answer id.
            foreach($answer_info as $ans) {
                if($ans["answer_id"] == $test["cta_id"]) {
                    if($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        $answerwordfield = "cta_answer".$ans["answer"];
                        $answerword = $test["$answerwordfield"];

                        // --- compared the answer with the correct one.
                        if($ans["answer"] == $test["cta_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($test["ctq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current test's review.
                        $testReview = $this->dbconn->query(
                            "UPDATE `studuni_course_test_review` 
                            SET `suctrv_answer` = '{$answerword}', `suctrv_answer_status` = '{$answer_status}' 
                            WHERE `suctrv_student_university_id` = {$this->studuni_id} AND `suctrv_course_test_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current test's review.
                        $testReview = $this->dbconn->query(
                            "UPDATE `studuni_course_test_review` 
                            SET `suctrv_answer` = NULL, `suctrv_answer_status` = NULL 
                            WHERE `suctrv_student_university_id` = {$this->studuni_id} AND `suctrv_course_test_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current test's result.
        $testResult = $this->dbconn->query(
            "UPDATE `studuni_course_test_result` 
            SET `suctrs_time_taken` = '{$time_taken}', `suctrs_grade` = {$grade}, `suctrs_total_answered_question` = {$total_answered}, `suctrs_total_correct_answer` = {$total_correct} 
            WHERE `suctrs_student_university_id` = {$this->studuni_id} AND `suctrs_course_test_id` = {$test_id};"
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
     * `studuni_course_learning_progress` table.
     * 
     * @param int $course_id id for course.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function test_progress($course_id) {
        $fetchTest = $this->fetch_test($course_id);
        $total = $fetchTest !== NULL ? count($fetchTest) : 0;
        $progress = 0;

        if($fetchTest !== NULL) {
            foreach($fetchTest as $val) {
                if($this->fetch_test_result($val["ct_id"]) !== NULL) {
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

/**------------------------------------------------- COURSE PROGRESS & SUBMISSION -------------------------------------------------**/
}