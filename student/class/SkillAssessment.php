<?php

namespace DBData;

/**
 * `Microcredential` class.
 * This class used to fetch all necessary data related to micro-credential.
 */
class SkillAssessment
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
    public function fetch_skillassessment($sql_opr = "", $sql_limit = "")
    {
        $sql_opr = $sql_opr !== "" ? "({$sql_opr}) AND " : "";

        $skillassessment = $this->dbconn->query(
            "SELECT * FROM skill_assessment_test AS sat 
            LEFT JOIN industry_field AS ind 
            ON sat.st_industry_field=ind.industry_field_id 
            LEFT JOIN skill_assessment_test_question AS satq
            ON sat.st_id=satq.stq_st_id
            LEFT JOIN skill_assessment_test_answer AS sata
            ON satq.stq_id=sata.stqa_stq_id WHERE sat.st_status='Published'
            {$sql_limit};"
        );

        if ($skillassessment->num_rows > 0) {
            return $skillassessment->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }






    /**------------------------------------------------- MICRO-CREDENTIAL INFORMATION -------------------------------------------------**/




    /**
     * Function to fetch all the micro-credential's quizzes based on `$mc_id`.
     * It holds all the data from `mc_quiz` table.
     * 
     * @param int $mc_id id for micro-credential.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz()
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT st.*, GROUP_CONCAT(DISTINCT at.at_st_id SEPARATOR ',') AS at_st_ids 
            FROM skill_assessment_test AS st 
            INNER JOIN assign_test AS at ON FIND_IN_SET(st.st_id, at.at_st_id) 
            WHERE st.st_status='Published' 
            AND at.at_created_date >= DATE_ADD(NOW(), INTERVAL -24 HOUR) 
            GROUP BY st.st_id
            ;
            
            ");
    
        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC);
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
    public function fetch_quiz_info($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT * FROM `skill_assessment_test`
            WHERE st_id = {$quizID} "
        );

        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all micro-credential's quiz questions and answers based on `$quiz_id`.
     * It holds all the data from `st_question`
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_QnA($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT * FROM skill_assessment_test AS sat
            LEFT JOIN industry_field AS ind  
             ON sat.st_industry_field=ind.industry_field_id
             LEFT JOIN skill_assessment_test_question AS stq
              ON sat.st_id=stq.stq_st_id
              LEFT JOIN skill_assessment_test_answer AS stqa
              ON stq.stq_id=stqa.stqa_stq_id
             WHERE stq.stq_st_id = {$quizID}
            AND stq.stq_deleted_date IS NULL 
            ORDER BY stq.stq_type='multiple choice' DESC"
        );

        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC);
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
    public function fetch_quiz_result($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT * FROM `studuni_sat_quiz_result` AS susatqrs
            WHERE susatqrs.susatqrs_student_university_id= {$this->studuni_id}
             AND susatqrs.susatqrs_sat_quiz_id={$quizID};"
        );

        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC)[0];
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
    public function fetch_quiz_review($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT * FROM studuni_st_test_review AS sstr
            WHERE sstr.susatrv_student_university_id= {$this->studuni_id} AND sstr.susatrv_st_test_id = {$quizID};"
        );

        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC);
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
    public function fetch_quiz_review1($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT count(sstr.susatrv_id) FROM studuni_st_test_review AS sstr
            WHERE sstr.susatrv_student_university_id= {$this->studuni_id} AND sstr.susatrv_st_test_id = {$quizID} AND sstr.susatrv_answer IS NOT NULL;"
        );
        // $rowCount=$sk_quiz->num_rows;
        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }
    
    }


    /**
     * Function to fetch all micro-credential's quiz question's review based on `$studuni_id` and `$quiz_id`.
     * It holds all the data from `studuni_mc_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_quiz_review2($quizID)
    {
        $sk_quiz = $this->dbconn->query(
            "SELECT count(sstr.susatrv_id) FROM skill_assessment_test_question  AS satq
            LEFT JOIN studuni_st_test_review AS sstr
            ON satq.stq_id=sstr.susatrv_st_test_question_id
            WHERE stq_type='fileupload' AND sstr.susatrv_st_test_question_id=satq.stq_id AND  sstr.susatrv_student_university_id= {$this->studuni_id}" 
        );
        // $rowCount=$sk_quiz->num_rows;
        if ($sk_quiz->num_rows > 0) {
            return $sk_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }
    
    }
    /**------------------------------------------------- MICRO-CREDENTIAL LEARNING MATERIALS -------------------------------------------------**/


    /**
     * Function to insert the quiz's result and review.
     * This function used when the student university start attempting the quiz.
     * Store all the data in `studuni_mc_quiz_result` and `studuni_mc_quiz_review` table.
     * 
     * @param int $quiz_id id for quiz.
     * @return bool `true` if success, `false` if failed.
     */
    public function insert_quiz_prelim_result($quizID)
    {
        $checkReview = false;
        $total_question = 0;


        // Insert the quiz's preliminary review.
        foreach ($this->fetch_quiz_QnA($quizID) as $quiz) {
            // --- store the quiz question's information in `studuni_mc_quiz_review` table.

            $quizReview = $this->dbconn->query(
                "INSERT INTO studuni_st_test_review(susatrv_student_university_id, susatrv_st_test_id, susatrv_st_test_question_id, susatrv_answer, susatrv_answer_status,susatrv_fileupload)
                VALUES ({$this->studuni_id}, {$quizID}, {$quiz["stq_id"]}, NULL, NULL,NULL);"
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
                "INSERT INTO `studuni_sat_quiz_result`(`susatqrs_student_university_id`, `susatqrs_sat_quiz_id`, `susatqrs_time_taken`, `susatqrs_grade`, `susatqrs_total_question`, `susatqrs_total_answered_question`, `susatqrs_total_correct_answer`) 
                VALUES ({$this->studuni_id}, {$quizID}, '00:00:00', '0', {$total_question}, '0', '0');"
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
     * Compare both answers from `mc_quiz_answer` and `$answer_info`.
     * Store all the data in `studuni_mc_quiz_result` and `studuni_mc_quiz_review` tables.
     * 
     * @param int $quiz_id id for microcredential's quiz.
     * @param array $answer_info an associative 2D array containing quiz's answers information.
     * @param string $time_taken time taken to finished the quiz (in HH:MM:SS format).
     * @return bool `true` if success, `false` if failed.
     */
    public function quiz_score($quizID, $answer_info, $time_taken)
    {
        $grade = 0;
        $total_question = 0;
        $total_answered = 0;
        $total_correct = 0;

        // Fetch data from `mc_quiz_question` and calculate the grade based on the right answer.
        foreach ($this->fetch_quiz_QnA($quizID) as $quiz) {
            // --- find the right answer based on the answer id.
            // $score = $quiz["susatqrs_total_question"];
            foreach ($answer_info as $ans) {
                
                if ($ans["answer_id"] == $quiz["stqa_id"]) {
                    $file = $ans["susatrv_fileupload"];
                    // --- check if the student answered the questions or not.
                    if ($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        // $file = $ans["susatrv_fileupload"];

                        $answerwordfield = "stqa_answer" . $ans["answer"];
                        $answerword = $quiz["$answerwordfield"];

                        // --- compare the answer with the correct one.
                        if ($ans["answer"] == $quiz["stqa_right_answer"]) {
                            $answer_status = "Correct";
                            $total_correct++;
                            // --- calculate the grade.
                            $grade += intval($quiz["stq_score"]);
                        } else {
                            $answer_status = "Incorrect";
                        }

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_st_test_review`
                            SET `susatrv_answer` = '{$answerword}', `susatrv_answer_status` = '{$answer_status}'
                            WHERE `susatrv_student_university_id` = {$this->studuni_id} AND `susatrv_st_test_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_st_test_review` 
                            SET `susatrv_answer` = NULL, `susatrv_answer_status` = NULL , `susatrv_fileupload`= '{$file}'
                            WHERE  `susatrv_student_university_id` = {$this->studuni_id} AND `susatrv_st_test_question_id` = {$ans["question_id"]} ;"
                        );
                    }

                    // break;
                }
            }
            $total_question++;
        }
        $grade = $total_correct/$total_question * 100;
        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_sat_quiz_result` 
            SET `susatqrs_time_taken` = '{$time_taken}', `susatqrs_grade` = {$grade}, `susatqrs_total_answered_question` = {$total_answered}, `susatqrs_total_correct_answer` = {$total_correct} 
            WHERE `susatqrs_student_university_id` = {$this->studuni_id} AND `susatqrs_sat_quiz_id` = {$quizID};"
        );

        if ($quizResult) {
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
    public function quiz_progress($quizID)
    {
        $fetchQuiz = $this->fetch_quiz($quizID);
        $total = $fetchQuiz !== NULL ? count($fetchQuiz) : 0;
        $progress = 0;

        if ($fetchQuiz !== NULL) {
            foreach ($fetchQuiz as $val) {
                if ($this->fetch_quiz_result($val["stq_id"]) !== NULL) {
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
}
