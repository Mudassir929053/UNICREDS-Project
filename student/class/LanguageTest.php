<?php

namespace DBData;

/**
 * `Microcredential` class.
 * This class used to fetch all necessary data related to Employability Program.
 */
class LanguageTest
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
            "SELECT ltq.*, GROUP_CONCAT(DISTINCT at.at_ltq_id SEPARATOR ',') AS at_ltq_ids 
            FROM `language_test_quiz` AS ltq 
            INNER JOIN assign_test AS at ON FIND_IN_SET(ltq.ltq_id, at.at_ltq_id) 
            WHERE ltq.ltq_status='Published' AND at.at_created_date >= DATE_ADD(NOW(), INTERVAL -24 HOUR)
            GROUP BY ltq.ltq_id;"
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
    public function fetch_ltquiz_info($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * FROM `language_test_quiz` AS ltq 
            WHERE ltq.ltq_id = {$quiz_id} and ltq.ltq_deleted_date IS NULL;"
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
            "SELECT * from language_test_question AS ltq 
            LEFT JOIN language_test_comp_pasage AS ltcp ON ltq.ltq_id_ltc_id = ltcp.ltcp_id 
            LEFT JOIN language_test_answer AS lta 
            ON ltq.ltq_id = lta.lta_id_ltq_id 
            WHERE ltq.ltqq_id = {$quiz_id} AND ltq.ltq_deleted_date IS NULL 
            ORDER BY ltq.ltq_created_date;"
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
    public function fetch_ltquiz_result($quiz_id)
    {
        $ep_quiz = $this->dbconn->query(
            "SELECT * FROM `studuni_lt_test_result` AS sumlttrs 
            WHERE sumlttrs.sulttrs_student_university_id = {$this->studuni_id} AND sumlttrs.sulttrs_test_id ={$quiz_id};"
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
            FROM `studuni_lt_test_review` AS sulttrv 
            WHERE sulttrv.sulttrv_student_university_id = {$this->studuni_id} AND sulttrv.sulttrv_lt_test_id = {$quiz_id};  "
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
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
            "SELECT * FROM language_test_quiz AS lt
            WHERE {$sql_opr}lt.ltq_status = 'Published'
            ORDER BY lt.ltq_created_date
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
                "INSERT INTO `studuni_lt_test_review`(`sulttrv_student_university_id`, `sulttrv_lt_test_id`, `sulttrv_lt_test_question_id`, `sulttrv_answer`, `sulttrv_answer_status`) 
                VALUES ({$this->studuni_id}, {$quiz_id}, {$quiz["ltq_id"]}, NULL, NULL);"
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
                "INSERT INTO `studuni_lt_test_result`(`sulttrs_student_university_id`, `sulttrs_test_id`, `sulttrs_time_taken`, `sulttrs_grade`, `sulttrs_total_question`, `sulttrs_total_answered_question`, `sulttrs_total_correct_answer`)
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
                if ($ans["answer_id"] == $quiz["lta_id"]) {
                    // --- check if the student answered the questions or not.
                    if ($ans["answer"] !== null) {
                        // --- get the answers word.
                        $str =  $ans["answer"];
                       
                            $answerword1 = trim($str, "<p>");
                            $answerword = trim($answerword1, "</p>");

                            // --- compare the answer with the correct one.
                            if (
                                $answerword == $quiz["lta_right_answerword"]
                            ) {
                                $answer_status = "Correct";
                                $total_correct++;
                                // --- calculate the grade.
                                $grade += intval($quiz["epqq_score"]);
                            } else {
                                $answer_status = "Incorrect";
                            }
                        

                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_lt_test_review` 
                            SET `sulttrv_answer` = '{$answerword}', `sulttrv_answer_status` = '{$answer_status}' 
                            WHERE `sulttrv_student_university_id` = {$this->studuni_id} AND `sulttrv_lt_test_question_id` = {$ans["question_id"]};"
                        );

                        $total_answered++;
                    } else {
                        // Update the value of the current quiz review.
                        $quizReview = $this->dbconn->query(
                            "UPDATE `studuni_lt_test_review` 
                            SET `sulttrv_answer` = NULL, `sulttrv_answer_status` = NULL 
                            WHERE `sulttrv_student_university_id` = {$this->studuni_id} AND `sulttrv_lt_test_question_id` = {$ans["question_id"]};"
                        );
                    }

                    break;
                }
            }

            $total_question++;
        }

        // Update the value of the current quiz result.
        $quizResult = $this->dbconn->query(
            "UPDATE `studuni_lt_test_result` 
            SET `sulttrs_time_taken` = '{$time_taken}', `sulttrs_grade` = {$total_correct}, `sulttrs_total_answered_question` = {$total_answered}, `sulttrs_total_correct_answer` = {$total_correct} 
            WHERE `sulttrs_student_university_id` = {$this->studuni_id} AND `sulttrs_test_id` = {$quiz_id};"
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
            FROM `studuni_lt_test_result` AS sulttrs 
            WHERE sulttrs.sulttrs_student_university_id = {$this->studuni_id} AND sulttrs.sulttrs_test_id = {$quiz_id};"
        );

        if ($ep_quiz->num_rows > 0) {
            return $ep_quiz->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return null;
        }

        exit();
    }
}
