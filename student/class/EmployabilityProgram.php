<?php
namespace DBData;

/**
 * `Microcredential` class.
 * This class used to fetch all necessary data related to Employability Program.
 */
class EmployabilityProgram
{
    private $dbconn;
    private $studuni_id;

    public function __construct($studuni_id)
    {
        $this->dbconn = $this->connect();
        $this->studuni_id = $studuni_id;
    }

    public function __destruct()
    {
        mysqli_close($this->dbconn);
    }

    private function connect()
    {
        include "{$_SERVER["DOCUMENT_ROOT"]}/unicreds/database/dbcon.php";
        return $conn;

        exit();
    }

    /*-------------------------------------------------- Employability Program INFORMATION --------------------------------------------------*/




  

    /**
     * Function to fetch all the data related to the enrolled micro-credentials.
     * It holds all the data from __enrolled_mc_studuni__, __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_enrolled_employability_programs() {
        $employability_program = $this->dbconn->query(
            "SELECT * 
            FROM `enrolled_ep_studuni` AS eepsu 
            INNER JOIN `employability_program` AS ep ON eepsu.eepsu_ep_id = ep.ep_id 
            LEFT JOIN `institution` AS i ON ep.course_created_by = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE eepsu.eepsu_student_university_id = {$this->studuni_id} AND ep.ep_publish = 'Published' AND ep.course_deleted_date IS NULL
            ORDER BY ep.ep_title;"
        );

        if($employability_program->num_rows > 0) {
            return $employability_program->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the enrolled micro-credential based on `$studuni_id` and `$mc_id`.
     * It holds all the data from __enrolled_mc_studuni__, __employability_program__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_enrolled_employability_program($ep_id) {
        $employability_program = $this->dbconn->query(
            "SELECT * 
            FROM `enrolled_ep_studuni` AS eepsu 
            INNER JOIN `employability_program` AS ep ON eepsu.eepsu_ep_id = ep.ep_id 
            LEFT JOIN `institution` AS i ON ep.course_created_by = i.institution_id 
            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
            WHERE eepsu.eepsu_student_university_id = {$this->studuni_id} AND eepsu.eepsu_ep_id = {$ep_id} AND ep.ep_status = 'Published' AND ep.ep_deleted_date IS NULL;"
        );

        if($employability_program->num_rows > 0) {
            return $employability_program->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }











    /**
     * Function to fetch all the Employability Program's quizzes based on `$mc_id`.
     * It holds all the data from `ep_quiz` table.
     *
     * @param int $mc_id id for Employability Program.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_epquiz($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * FROM `employability_program_quiz` AS epq WHERE epq_ep_id = {$quiz_id} 
            AND epq.epq_deleted_date IS NULL ORDER BY epq.epq_created_date;"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }

        exit();
    }

    /**
     * Function to fetch a Employability Program's quiz information based on `$quiz_id`.
     * It holds all the data from `ep_quiz` table.
     *
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_epquiz_info($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `employability_program_quiz` AS epq 
            WHERE epq.epq_id = {$quiz_id} AND epq.epq_deleted_date IS NULL;"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return null;
        }

        exit();
    }

    /**
     * Function to fetch all Employability Program's quiz questions and answers based on `$quiz_id`.
     * It holds all the data from `ep_quiz_question`, and `ep_quiz_answer` tables.
     *
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_QnA($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * FROM employability_program_quiz_question AS epqq 
            LEFT JOIN employability_program_quiz_answer AS epqa 
            ON epqa.epqa_epq_id = epqq.epqq_id 
            WHERE epqq.epq_ep_id = {$quiz_id} AND epqq.epqq_deleted_date IS NULL 
            ORDER BY epqq.epqq_created_date;"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }

        exit();
    }

    /**
     * Function to fetch all Employability Program's quiz results based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_ep_quiz_result` table.
     *
     * @param int $quiz_id id for quiz.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_epquiz_result($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * FROM `studuni_ep_quiz_result` AS sumepqrs 
            WHERE sumepqrs.suepqrs_student_university_id = {$this->studuni_id} AND sumepqrs.suepqrs_ep_quiz_id ={$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return null;
        }

        exit();
    }

    /**
     * Function to fetch all Employability Program's quiz question's review based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_ep_quiz_review` table.
     *
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_review($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_ep_quiz_review` AS suepqrv 
            WHERE suepqrv.suepqrv_student_university_id = {$this->studuni_id} AND suepqrv.suepqrv_ep_quiz_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
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
    public function quiz_progress($ep_id) {
        $fetchQuiz = $this->fetch_epquiz($ep_id);
        $total = $fetchQuiz !== NULL ? count($fetchQuiz) : 0;
        $progress = 0;

        if($fetchQuiz !== NULL) {
            foreach($fetchQuiz as $val) {
                if($this->fetch_epquiz_result($val["epq_id"]) !== NULL) {
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
     * Function to fetch all the data related to the Employability Programs.
     * It holds all the data from __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     * The parameter will filtered the fetched Employability Programs.
     *
     * @param string $sql_opr string of SQL operators statement such as __LIKE__ and __IN__. Default value is empty string.
     * @param string $sql_limit contains SQL LIMIT clause. Default value is empty string.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_employability_programs($sql_opr = "", $sql_limit = "")
    {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $microcredential = $this->dbconn->query(
            "SELECT * FROM employability_program AS ep
            -- LEFT JOIN employability_program_enrolment_session AS epes ON epes.epes_ep_id = ep.ep_id
            LEFT JOIN user AS us ON ep.course_created_by = us.user_id
            WHERE {$sql_opr}ep.ep_publish = 'Published' AND ep.course_deleted_date IS NULL
            ORDER BY ep.ep_title
            {$sql_limit};"
        );

        if ($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }

        exit();
    }

    /**
     * Function to fetch all the data related to the Employability Program based on the `$mc_id`.
     * It holds all the data from __microcredential__, __mc_learning_details__, __mc_enrolment_session__, __institution__, and __university__ tables.
     *
     * @param int $ep_id id for Employability Program.
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_employability_program($ep_id)
    {
        $microcredential = $this->dbconn->query(
            "SELECT * FROM employability_program ep 
            LEFT JOIN employability_program_enrolment_session AS epes ON epes.epes_ep_id = ep.ep_id LEFT JOIN user as us 
            ON ep.course_created_by = us.user_id 
            WHERE ep.ep_id = {$ep_id} AND ep.ep_publish = 'Published' AND ep.course_deleted_date IS NULL;"
        );

        if ($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return null;
        }

        exit();
    }
    /**
     * Function to fetch all micro-credential's videos based on `$mc_id`.
     * It holds all the data from `mc_video` table.
     *
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_video($ep_id)
    {
        $ep_video = $this->dbconn->query(
            "SELECT * FROM `employabilty_program_video` AS epv WHERE epv.epv_ep_id = {$ep_id} AND epv.epv_status = 'Published' ORDER BY epv.epv_created_date;"
        );

        if ($ep_video->num_rows > 0) {
            return $ep_video->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }

        exit();
    }

    /**------------------------------------------------- Employability Program LEARNING MATERIALS -------------------------------------------------**/

    /*-------------------------------------------------- Employability Program PROGRESS & SUBMISSION --------------------------------------------------*/

    /**
     * Function to insert the quiz's result and review.
     * This function used when the student university start attempting the quiz.
     * Store all the data in `studuni_ep_quiz_result` and `studuni_ep_quiz_review` table.
     *
     * @param int $quiz_id id for quiz.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_quiz_prelim_result($quiz_id)
    {
        $checkReview = false;
        $total_question = 0;

        // Insert the quiz's preliminary review.
        foreach ($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- store the quiz question's information in `studuni_ep_quiz_review` table.
            $quizReview = $this->dbconn->query(
                "INSERT INTO `studuni_ep_quiz_review`(`suepqrv_student_university_id`, `suepqrv_ep_quiz_id`, `suepqrv_ep_quiz_question_id`, `suepqrv_answer`, `suepqrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, {$quiz["epqq_id"]}, NULL, NULL);"
            );

            if ($quizReview) {
                $checkReview = true;
                $total_question++;
            } else {
                $checkReview = false;
                break;
            }
        }

        // Insert the quiz's preliminary result.
        if ($checkReview) {
            $quizResult = $this->dbconn->query(
                "INSERT INTO `studuni_ep_quiz_result`(`suepqrs_student_university_id`, `suepqrs_ep_quiz_id`, `suepqrs_time_taken`, `suepqrs_grade`, `suepqrs_total_question`, `suepqrs_total_answered_question`, `suepqrs_total_correct_answer`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, '00:00:00', '0', {$total_question}, '0', '0');"
            );

            if ($quizResult) {
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
     * Compare both answers from `ep_quiz_answer` and `$answer_info`.
     * Store all the data in `studuni_ep_quiz_result` and `studuni_ep_quiz_review` tables.
     *
     * @param int $quiz_id id for microcredential's quiz.
     * @param array $answer_info an associative 2D array containing quiz's answers information.
     * @param string $time_taken time taken to finished the quiz (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function quiz_score($quiz_id, $answer_info, $time_taken)
    {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `ep_quiz_question` and calculate the grade based on the right answer.
        foreach ($this->fetch_quiz_QnA($quiz_id) as $quiz) {
            // --- find the right answer based on the answer id.
            foreach ($answer_info as $ans) {
                if ($ans["answer_id"] == $quiz["epqa_id"]) {
                    // --- check if the student answered the questions or not.
                    if ($ans["answer"] !== null) {
                        // --- get the answers word.
                        $answerwordfield = "epqa_answer" . $ans["answer"];
                        $answerword = $quiz["$answerwordfield"];

                        // --- compare the answer with the correct one.
                        if ($ans["answer"] == $quiz["epqa_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($quiz["epqq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_ep_quiz_review` 
                            SET `suepqrv_answer` = '{$answerword}', `suepqrv_answer_status` = '{$answer_status}' 
                            WHERE `suepqrv_student_university_id` = {$this->studuni_id} AND `suepqrv_ep_quiz_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_ep_quiz_review` 
                            SET `suepqrv_answer` = NULL, `suepqrv_answer_status` = NULL 
                            WHERE `suepqrv_student_university_id` = {$this->studuni_id} AND `suepqrv_ep_quiz_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_ep_quiz_result` 
            SET `suepqrs_time_taken` = '{$time_taken}', `suepqrs_grade` = {$grade}, `suepqrs_total_answered_question` = {$total_answered}, `suepqrs_total_correct_answer` = {$total_correct} 
            WHERE `suepqrs_student_university_id` = {$this->studuni_id} AND `suepqrs_ep_quiz_id` = {$quiz_id};"
        );

        if ($quizResult) {
            return true;
        } else {
            return false;
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
    public function fetch_quiz_result($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_ep_quiz_result` AS suepqrs 
            WHERE suepqrs.suepqrs_student_university_id = {$this->studuni_id} AND suepqrs.suepqrs_ep_quiz_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return null;
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
            FROM `studuni_ep_watched_video` AS sumcvw 
            WHERE sumcvw.suepvw_ep_video_id = {$video_id} AND sumcvw.suepvw_student_university_id = {$this->studuni_id};"
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
            FROM `studuni_ep_watched_video` AS sumcvw 
            WHERE sumcvw.suepvw_ep_video_id = {$video_id};"
        );

        if($watched->num_rows == 0) {
            $mc_video = $this->dbconn->query(
                "INSERT INTO `studuni_ep_watched_video`(`suepvw_student_university_id`, `suepvw_ep_video_id`) 
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
                if($this->check_watched_video($val["epv_id"])) {
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
     * Function to fetch all the micro-credential's tutorials based on `$mc_id`.
     * It holds all the data from `mc_tutorial` and `mc_tutorial_duedate` tables.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_tutorial($ep_id) {
        $ep_note = $this->dbconn->query(
            "SELECT * FROM employabilty_program_note AS epn 
            WHERE epn.epn_ep_id = {$ep_id}  AND epn.epn_status = 'Published' AND epn.epn_deleted_date IS NULL 
            ORDER BY epn.epn_created_date;
"
        );

        if($ep_note->num_rows > 0) {
            return $ep_note->fetch_all(MYSQLI_ASSOC);
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
                FROM `studuni_ep_note_submission` AS suepns 
                WHERE suepns.suepns_student_university_id = {$this->studuni_id} AND suepns.suepns_ep_tutorial_id = {$mctu_id};"
            );
        } else if($deleted == 1) {
            $mc_tutorial = $this->dbconn->query(
                "SELECT * 
                FROM `studuni_ep_note_submission` AS suepns 
                WHERE suepns.suepns_student_university_id = {$this->studuni_id} AND suepns.suepns_ep_tutorial_id = {$mctu_id} AND suepns.suepns_deleted_date IS NULL;"
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
                "INSERT INTO `studuni_ep_note_submission`(`suepns_student_university_id`, `suepns_ep_tutorial_id`, `suepns_attachment`) 
                VALUES ({$this->studuni_id}, {$mctu_id}, '{$file}');"
            );
        } else {
            $suepnsID = $isExist["suepns_id"];

            $mc_tutorial = $this->dbconn->query(
                "UPDATE `studuni_ep_note_submission` 
                SET `suepns_attachment` = '{$file}', `suepns_submitted_date` = '{$currDate}', `suepns_deleted_date` = NULL 
                WHERE `suepns_id` = {$suepnsID};"
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
            "UPDATE `studuni_ep_note_submission` 
            SET `suepns_deleted_date` = '{$currDate}' 
            WHERE `suepns_student_university_id` = {$this->studuni_id} AND `suepns_ep_tutorial_id` = {$mctu_id};"
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
                if($this->fetch_tutorial_submission($val["epn_id"], 1)) {
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
     * Function to fetch course creator information based on mc_created_by.
     * It will checks if the creator is a __lecturer__ or __admin__.
     * 
     * @param int $user_id id of the user.
     * @return array an associative array containing the creator informations.
     */
    public function check_ep_creator($user_id) {
        $info_arr = array();
    
        $user = $this->dbconn->query(
            "SELECT r.role_name 
            FROM `user` AS u 
            INNER JOIN `role` AS r ON u.user_role_id = r.role_id 
            WHERE u.user_id = {$user_id};"
        );
        $user_info = $user->fetch_all(MYSQLI_ASSOC)[0];
    
        if ($user_info["role_name"] === "Administrator") {
            $admin = $this->dbconn->query(
                "SELECT * 
                FROM `admin` AS a 
                LEFT JOIN institution ON institution.institution_id = a.admin_institution
                LEFT JOIN university ON institution.institution_university_id = university.university_id 
                WHERE a.admin_user_id = {$user_id};"
            );
            $admin_info = $admin->fetch_all(MYSQLI_ASSOC)[0];
            
            // var_dump($admin_info); // Debugging statement
            
            $info_arr["user_id"] = $admin_info["admin_user_id"];
            $info_arr["image"] = $admin_info["admin_logo"] !== NULL ? "../assets/images/avatar/" . $admin_info["admin_logo"] : "../assets/images/avatar/avatardefault.png";
            $info_arr["name"] = $admin_info["admin_name"];
            $info_arr["email"] = $admin_info["admin_email"];
        } 
        else if ($user_info["role_name"] === "Institution") {
            $inst = $this->dbconn->query(
                "SELECT * 
                FROM institution 
                LEFT JOIN university ON institution.institution_university_id = university.university_id 
                WHERE institution.institution_user_id = {$user_id};"
            );
    
            $institution = $inst->fetch_all(MYSQLI_ASSOC)[0];
            
            // var_dump($institution); // Debugging statement
    
            $info_arr["user_id"] = $institution["institution_user_id"];
            $info_arr["image"] = $institution["institution_logo"] !== NULL ? "../assets/images/avatar/" . $institution["institution_logo"] : "../assets/images/avatar/university_default.jpg";
            $info_arr["name"] = $institution["university_name"];
            $info_arr["email"] = $institution["institution_email"];
        }
     
        return $info_arr;
    
        exit();
    }
    

}
/**------------------------------------------------- MICRO-CREDENTIAL INFORMATION -------------------------------------------------**/

