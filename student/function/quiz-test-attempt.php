<?php
include("../function/student-function.php");

/*--------------------------------------------------------- QUIZ ATTEMPT ---------------------------------------------------------*/

/**
 * Store the preliminary quiz's result and review in database.
 * Redirect to `quiz-attempt-question.php` page.
 */
if(isset($_POST["quizAttempt"])) {
    $subjType = $_POST["quizAttempt"];
    $subjID = $_POST["subj_id"];
    $quizID = $_POST["quiz_id"];

    if($subjType === "course") {
        $quizPrelim = $courseInfo->insert_quiz_prelim_result($quizID);

        if($quizPrelim) {
            $quizAttemptLink = "../quiz-attempt-question.php?course_id={$subjID}&quiz_id={$quizID}";
        } else {
            $quizAttemptLink = "../quiz-attempt-main.php?course_id={$subjID}&quiz_id={$quizID}";
        }
    } else if($subjType === "mc") {
        $quizPrelim = $mcInfo->insert_quiz_prelim_result($quizID);

        if($quizPrelim) {
            $quizAttemptLink = "../quiz-attempt-question.php?mc_id={$subjID}&quiz_id={$quizID}";
        } else {
            $quizAttemptLink = "../quiz-attempt-main.php?mc_id={$subjID}&quiz_id={$quizID}";
        }
    }

    header("Location: $quizAttemptLink");

    exit();
}

/**
 * Store the preliminary test's result and review in database.
 * Redirect to `test-attempt-question.php` page.
 */
if(isset($_POST["testAttempt"])) {
    $subjType = $_POST["testAttempt"];
    $subjID = $_POST["subj_id"];
    $testID = $_POST["test_id"];

    if($subjType === "course") {
        $testPrelim = $courseInfo->insert_test_prelim_result($testID);

        if($testPrelim) {
            $testAttemptLink = "../test-attempt-question.php?course_id={$subjID}&test_id={$testID}";
        } else {
            $testAttemptLink = "../test-attempt-main.php?course_id={$subjID}&test_id={$testID}";
        }
    } else if($subjType === "mc") {
        $testPrelim = $mcInfo->insert_test_prelim_result($testID);

        if($testPrelim) {
            $testAttemptLink = "../test-attempt-question.php?mc_id={$subjID}&test_id={$testID}";
        } else {
            $testAttemptLink = "../test-attempt-main.php?mc_id={$subjID}&test_id={$testID}";
        }
    }

    header("Location: $testAttemptLink");

    exit();
}

/**-------------------------------------------------------- QUIZ ATTEMPT --------------------------------------------------------**/


/*--------------------------------------------------------- QUIZ ANSWERS SUBMISSION ---------------------------------------------------------*/

/**
 * Process all the quiz's answers.
 * Calculate the score of the student university's quiz and store it in database.
 */
if(isset($_POST["submitQuizAnswers"])) {
    $subjID = $_POST["subj_id"];
    $quizID = $_POST["quiz_id"];
    $qqTotal = $_POST["qq_total"];
    $dur_end = $_POST["time_taken"];
    $dur_start = $_POST["duration"];

    // Calculate the time taken to finish the quiz.
    $start = new DateTime($dur_start);
    $end = new DateTime($dur_end);

    $diff = $end->diff($start);
    $time_taken = $diff->format("%H:%I:%S");

    // Associative 2D array to store the answer's information.
    $answers = array();

    // Store all the answers, question's id, and answer's id in an associative 2D array.
    for($i = 0; $i < $qqTotal; $i++) {
        // --- form answer's NAME attribute.
        $input = "q".($i + 1)."Answer";
        // --- form question's id. 
        $questionID = "qq_".($i + 1);
        // --- form answer's id.
        $answerID = "qa_".($i + 1);

        // --- determine the questions that has been answered.
        if(isset($_POST["$input"])) {
            array_push($answers, array(
                "answer"        => mysqli_real_escape_string($conn, $_POST["$input"]), 
                "question_id"   => $_POST["$questionID"], 
                "answer_id"     => $_POST["$answerID"]
            ));
        } else {
            array_push($answers, array(
                "answer" => NULL, 
                "question_id"   => $_POST["$questionID"], 
                "answer_id"     => $_POST["$answerID"]
            ));
        }
    }

    // Determine if it's course or micro-credential.
    if($_POST["submitQuizAnswers"] === "course") {
        $quizCheck = $courseInfo->quiz_score($quizID, $answers, $time_taken);

        if($quizCheck) {
            echo "<script>location.href = '../quiz-attempt-review.php?course_id=$subjID&quiz_id=$quizID';</script>";
        } else {
            echo "<script>alert('Error: Quiz score...');location.href = '../quiz-attempt-review.php?course_id=$subjID&quiz_id=$quizID';</script>";
        }
    } else if($_POST["submitQuizAnswers"] === "mc") {
        $quizCheck = $mcInfo->quiz_score($quizID, $answers, $time_taken);

        if($quizCheck) {
            echo "<script>location.href = '../quiz-attempt-review.php?mc_id=$subjID&quiz_id=$quizID';</script>";
        } else {
            echo "<script>alert('Error: Quiz score...');location.href = '../quiz-attempt-review.php?mc_id=$subjID&quiz_id=$quizID';</script>";
        }
    }
    
    exit();
}

/**-------------------------------------------------------- QUIZ ANSWERS SUBMISSION --------------------------------------------------------**/


/*--------------------------------------------------------- TEST ANSWERS SUBMISSION ---------------------------------------------------------*/

/**
 * Process all the test's answers.
 * Calculate the score of the student university's test and store it in database.
 */
if(isset($_POST["submitTestAnswers"])) {
    $subjID = $_POST["subj_id"];
    $testID = $_POST["test_id"];
    $tqTotal = $_POST["tq_total"];
    $dur_end = $_POST["time_taken"];
    $dur_start = $_POST["duration"];

    // Calculate the time taken to finish the quiz.
    $start = new DateTime($dur_start);
    $end = new DateTime($dur_end);

    $diff = $end->diff($start);
    $time_taken = $diff->format("%H:%I:%S");

    // Associative 2D array to store the answer's information.
    $answers = array();

    // Store all the answers, question's id, and answer's id in an associative 2D array.
    for($i = 0; $i < $tqTotal; $i++) {
        // --- form answer's NAME attribute.
        $input = "q".($i + 1)."Answer";
        // --- form question's id. 
        $questionID = "tq_".($i + 1);
        // --- form answer's id.
        $answerID = "ta_".($i + 1);

        // --- determine the questions that has been answered.
        if(isset($_POST["$input"])) {
            array_push($answers, array(
                "answer"        => mysqli_real_escape_string($conn, $_POST["$input"]), 
                "question_id"   => $_POST["$questionID"], 
                "answer_id"     => $_POST["$answerID"]
            ));
        } else {
            array_push($answers, array(
                "answer" => NULL, 
                "question_id"   => $_POST["$questionID"], 
                "answer_id"     => $_POST["$answerID"]
            ));
        }
    }

    // Determine if it's course or micro-credential.
    if($_POST["submitTestAnswers"] === "course") {
        $quizCheck = $courseInfo->test_score($testID, $answers, $time_taken);

        if($quizCheck) {
            echo "<script>location.href = '../test-attempt-review.php?course_id=$subjID&test_id=$testID';</script>";
        } else {
            echo "<script>alert('Error: Quiz score...');location.href = '../test-attempt-review.php?course_id=$subjID&test_id=$testID';</script>";
        }
    } else if($_POST["submitTestAnswers"] === "mc") {
        $quizCheck = $mcInfo->test_score($testID, $answers, $time_taken);

        if($quizCheck) {
            echo "<script>location.href = '../test-attempt-review.php?mc_id=$subjID&test_id=$testID';</script>";
        } else {
            echo "<script>alert('Error: Quiz score...');location.href = '../test-attempt-review.php?mc_id=$subjID&test_id=$testID';</script>";
        }
    }
    
    exit();
}

/**-------------------------------------------------------- TEST ANSWERS SUBMISSION --------------------------------------------------------**/