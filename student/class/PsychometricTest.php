<?php

namespace DBData;

/**
 * `Microcredential` class.
 * This class used to fetch all necessary data related to Employability Program.
 */
class PsychometricTest
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


    /*-------------------------------------------------- Employability Program INFORMATION --------------------------------------------------*/


    /**
     * Function to fetch all the Employability Program's quizzes based on `$mc_id`.
     * It holds all the data from `ep_quiz` table.
     * 
     * @param int $mc_id id for Employability Program.
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_ltquiz()
{
    $ep_quiz = $this->dbconn->query(
        "SELECT pt.*, GROUP_CONCAT(DISTINCT at.at_pt_id SEPARATOR ',') AS at_pt_ids 
         FROM `psychometric_test` AS pt 
         INNER JOIN assign_test AS at ON FIND_IN_SET(pt.pt_id,at.at_pt_id)
         WHERE pt.pt_status='Published' AND at.at_created_date >= DATE_ADD(NOW(), INTERVAL -24 HOUR)
         GROUP BY pt.pt_id");

    if ($ep_quiz->num_rows > 0) {
        return $ep_quiz->fetch_all(MYSQLI_ASSOC);
    } else {
        return NULL;
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
    public function fetch_ltquiz_info($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `psychometric_test` AS pt 
            WHERE pt.pt_id = {$quiz_id} AND pt.pt_deleted_date IS NULL;"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
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
            "SELECT * 
            FROM `psychometric_test_question` AS ptq 
            WHERE ptq.ptq_pt_id  = {$quiz_id} AND ptq.ptq_deleted_date IS NULL 
            ORDER BY ptq.ptq_created_date;"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
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
    public function fetch_ltquiz_result($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * 
            FROM `studuni_pt_test_result` AS supttrs 
            WHERE supttrs.supttrs_student_university_id = {$this->studuni_id} AND supttrs.supttrs_pt_test_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
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
            FROM `studuni_pt_test_review` AS supttrv 
            WHERE supttrv.supttrv_student_university_id = {$this->studuni_id} AND supttrv.supttrv_pt_test_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
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
            "SELECT * FROM language_test AS lt
            LEFT JOIN employability_program_enrolment_session AS epes ON epes.epes_ep_id = ep.ep_id
            LEFT JOIN user AS us ON ep.course_created_by = us.user_id
            WHERE {$sql_opr}ep.ep_publish = 'Published' AND ep.course_deleted_date IS NULL
            ORDER BY ep.ep_title
            {$sql_limit};"
        );

        if ($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
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
    public function fetch_language_test($ep_id)
    {
        $microcredential = $this->dbconn->query(
            "SELECT * FROM language_test_quiz AS ltq
            WHERE ltq.ltq_id = {$ep_id} ltq.ltq_deleted_date IS NULL
            ORDER BY ltq.ltq_title"
        );

        if ($microcredential->num_rows > 0) {
            return $microcredential->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
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
    public function insert_quiz_prelim_result($pt_id)
    {
        $checkReview = true;
        $total_question = 0;

        // Insert the quiz's preliminary review.
        foreach ($this->fetch_quiz_QnA($pt_id) as $quiz) {
            // --- store the quiz question's information in `studuni_pt_quiz_review` table.
            $quizReview = $this->dbconn->query(
                "INSERT INTO `studuni_pt_test_review`(`supttrv_student_university_id`,`supttrv_pt_test_id`,`supttrv_pt_test_question_id`,`supttrv_answer`) 
                VALUES ({$this->studuni_id}, {$pt_id}, {$quiz["ptq_id"]}, NULL);"
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
            $status = "completed";
            $quizResult = $this->dbconn->query(
                "INSERT INTO `studuni_pt_test_result`(`supttrs_student_university_id`, `supttrs_pt_test_id`, `supttrs_time_taken`, `supttrs_grade`, `supttrs_total_question`, `supttrs_total_answered_question`, `supttrs_total_correct_answer`,`supttrs_status`) 
                VALUES ({$this->studuni_id}, {$pt_id}, '00:00:00', '0', {$total_question}, '0', '0','$status');"
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
                if ($ans["answer_id"] == $quiz["ptq_id"]) {
                    // --- check if the student answered the questions or not.
                    if ($ans["answer"] !== NULL) {
                        // --- get the answers word.
                        if ($quiz["ptq_id"] == "Multiple Choice") {


                            $answerword =  $ans["answer"];
                            // --- compare the answer with the correct one.
                            // if ($ans["answer"] == $quiz["lta_right_answerword"]) {
                            //     $answer_status = "Correct";
                            //     $total_correct++;
                            //     // --- calculate the grade.
                            //     $grade += intval($quiz["epqq_score"]);
                            // } else {
                            //     $answer_status = "Incorrect";
                            // }

                        } else {
                            $answerword =  $ans["answer"];



                            // --- compare the answer with the correct one.
                            // if ($ans["answer"] == $quiz["lta_right_answerword"]) {
                            //     $answer_status = "Correct";
                            //     $total_correct++;
                            //     // --- calculate the grade.
                            //     $grade += intval($quiz["epqq_score"]);
                            // } else {
                            //     $answer_status = "Incorrect";
                            // }
                        }

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_pt_test_review` 
                            SET `supttrv_answer` = '{$answerword}'
                            WHERE `supttrv_student_university_id` = {$this->studuni_id} AND `supttrv_pt_test_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_pt_test_review` 
                            SET `supttrv_answer` = NULL 
                            WHERE `supttrv_student_university_id` = {$this->studuni_id} AND `supttrv_pt_test_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_pt_test_result` 
            SET `supttrs_time_taken` = '{$time_taken}', `supttrs_grade` = {$grade}, `supttrs_total_answered_question` = {$total_answered}, `supttrs_total_correct_answer` = {$total_correct} 
            WHERE `supttrs_student_university_id` = {$this->studuni_id} AND `supttrs_pt_test_id` = {$quiz_id};"
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
            FROM `studuni_pt_test_result` AS supttrs 
            WHERE sulttrs.supttrs_student_university_id = {$this->studuni_id} AND supttrs.supttrs_pt_test_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }

        exit();
    }
}
