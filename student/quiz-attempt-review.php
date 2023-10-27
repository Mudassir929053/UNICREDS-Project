<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php
    include('pages-head.php');
?>

<body>
    <!-- Navbar -->
<?php
    include('pages-topbar.php');

    // Store the quiz id in $quizID.
    $quizID = $_GET["quiz_id"];

    // Determine whether it is course or micro-credential.
    if(isset($_GET["course_id"])) {
        $subj_type="course";
        $subjID = $_GET["course_id"];

        // Fetch necessary data.
        $mcData = $courseInfo->fetch_course($subjID);
        $fetchQuiz = $courseInfo->fetch_quiz_info($quizID);
        $fetchQuizQuestion = $courseInfo->fetch_quiz_QnA($quizID);
        $fetchQuizResult = $courseInfo->fetch_quiz_result($quizID);
        $fetchQuizReview = $courseInfo->fetch_quiz_review($quizID);

        // Quiz information.
        $subjTitle = $mcData["course_title"];
        $quizTitle = $fetchQuiz["cq_title"];
        $grade = $fetchQuizResult["sucqrs_grade"];
        $numQuestion = $fetchQuizResult["sucqrs_total_question"];
        $numCorrect = $fetchQuizResult["sucqrs_total_correct_answer"];
        $numIncorrect = $numQuestion - $numCorrect;
        $link = "course-learning-material.php?course_id=$subjID&pill=quiz";

        // Question review.
        $questionList = array();
        $data = array();
        foreach($fetchQuizQuestion as $question) {
            foreach($fetchQuizReview as $review) {
                if($review["sucqrv_course_quiz_question_id"] == $question["cqq_id"]) {
                    $data["question_id"] = $review["sucqrv_course_quiz_question_id"];
                    $data["question"] = $question["cqq_question"];
                    $data["answer_status"] = $review["sucqrv_answer_status"];
                    $data["answer"] = $review["sucqrv_answer"];
                    $data["correct_answer"] = $question["cqa_right_answerword"];

                    break;
                }
            }

            array_push($questionList, $data);
        }
    } else if(isset($_GET["mc_id"])) {
        $subj_type="mc";
        $subjID = $_GET["mc_id"];

        // Fetch necessary data.
        $mcData = $mcInfo->fetch_microcredential($subjID);
        $fetchQuiz = $mcInfo->fetch_quiz_info($quizID);
        $fetchQuizQuestion = $mcInfo->fetch_quiz_QnA($quizID);
        $fetchQuizResult = $mcInfo->fetch_quiz_result($quizID);
        $fetchQuizReview = $mcInfo->fetch_quiz_review($quizID);

        // Quiz information.
        $subjTitle = $mcData["mc_title"];
        $quizTitle = $fetchQuiz["mcq_title"];
        $grade = $fetchQuizResult["sumcqrs_grade"];
        $numQuestion = $fetchQuizResult["sumcqrs_total_question"];
        $numCorrect = $fetchQuizResult["sumcqrs_total_correct_answer"];
        $numIncorrect = $numQuestion - $numCorrect;
        $link = "micro-creds-learning-material.php?mc_id=$subjID&pill=quiz";

        // Question review.
        $questionList = array();
        $data = array();
        foreach($fetchQuizQuestion as $question) {
            foreach($fetchQuizReview as $review) {
                if($review["sumcqrv_mc_quiz_question_id"] == $question["mcqq_id"]) {
                    $data["question_id"] = $review["sumcqrv_mc_quiz_question_id"];
                    $data["question"] = $question["mcqq_question"];
                    $data["answer_status"] = $review["sumcqrv_answer_status"];
                    $data["answer"] = $review["sumcqrv_answer"];
                    $data["correct_answer"] = $question["mcqa_right_answerword"];

                    break;
                }
            }

            array_push($questionList, $data);
        }
    }

    // Set SESSION.
    $session_name = $subj_type."-".$subjID."[quizID=$quizID]";
    $_SESSION["$session_name"] = "attempted";
?>

    <!-- Page header -->
    <div class="bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="py-4 py-lg-6">
                        <h1 class="mb-0 text-white display-4">Quiz Review</h1>
                        <p class="text-white mb-0 lead">
                            Below are the lists of questions and your answers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Questions informations -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="fs-3 text-muted"><?= $subjTitle ?></h3>
                    <h2 class="mb-2"><?= $quizTitle ?></h2>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" class="fs-4">Quiz score</th>
                                <td class="fs-4">: <?= $grade ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4">Number of questions</th>
                                <td class="fs-4">: <?= $numQuestion ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4">Number of correct questions</th>
                                <td class="fs-4">: <?= $numCorrect ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4">Number of incorrect questions</th>
                                <td class="fs-4">: <?= $numIncorrect ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="text-end">
                        <a href="<?= $link ?>">
                            <button type="button" class="btn btn-outline-primary">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4">Go to Quiz</span> <i class="fe fe-arrow-right fs-3 ms-2"></i>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Question and answers lists -->
    <div class="container mb-4">
        <div id="q-lists" class="row">
            <!-- List of questions -->
<?php
    // Display all of the quiz's questions.
    $i = 1;
    foreach($questionList as $q) {
        $collapsed = "";
        $loadButton = "collapse";

        if($q["answer_status"] === "Correct") {
            $icon = '<span class="icon-shape bg-success text-light icon-md rounded-circle me-2"><i class="fe fe-check fs-3"></i></span>';
            $chosen_answer = "text-success";
        } else if($q["answer_status"] === "Incorrect") {
            $icon = '<span class="icon-shape bg-danger text-light icon-md rounded-circle me-2"><i class="fe fe-x fs-3"></i></span>';
            $chosen_answer = "text-danger";
        } else if($q["answer_status"] === NULL) {
            $icon = '<span class="icon-shape bg-secondary text-white icon-md rounded-circle me-2"><i class="fe fe-alert-circle fs-3"></i></span>';
        }

        // If the questions are more than 10, hide the rest.
        if($i > 15) {
            $collapsed = "collapse";
            $loadButton = "";
        }
?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="card mb-4 card-hover border <?= $collapsed ?>">
                    <div class="d-flex justify-content-between align-items-center p-4">
                        <div class="d-flex align-items-center">
                            <?= $icon ?>
                            <div class="ms-3" style="width: 1000px;">
                                <h4 class="mb-1">
                                    <span class="text-inherit">
                                        Question <?= $i ?>
                                    </span>
                                </h4>
                                <p class="m-0 mb-2 text-dark fs-5 text-truncate">
                                    <?= $q["question"] ?>
                                </p>
                        <?php
                            if($q["answer_status"] !== NULL) {
                        ?>
                                <p class="mb-0 fs-5">
                                    <span class="me-2">
                                        <span class="text-muted fw-medium">Chosen answer: </span>
                                        <span class="<?= $chosen_answer ?>"><?= $q["answer"] ?></span>
                                    </span>
                                    <br>
                                    <span>
                                        <span class="text-muted fw-medium">Correct answer: </span>
                                        <span class="text-dark"><?= $q["correct_answer"] ?></span>
                                    </span>
                                </p>
                        <?php
                            } else {
                        ?>
                                <p class="mb-0 fs-5">
                                    <span class="me-2">
                                        <span class="text-muted fw-medium">Chosen answer: </span>
                                        <span class="text-muted"><em>You didn't answered this question.</em></span>
                                    </span>
                                    <br>
                                    <span>
                                        <span class="text-muted fw-medium">Correct answer: </span>
                                        <span class="text-dark"><?= $q["correct_answer"] ?></span>
                                    </span>
                                </p>
                        <?php
                            }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        $i++;
    }
?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center my-3">
                <button id="load-button" class="btn btn-primary <?= $loadButton ?>" type="button">Show All</button>
            </div>
        </div>
    </div>
    <!-- Footer -->
<?php
    include('pages-footer.php');
?>


    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

    <!-- Show all questions -->
    <script>
        $("#load-button").on("click", function() {
            // Remove the Show More button.
            $(this).addClass("collapse").parent().removeClass();

            // Display the rest of the questions.
            $("#q-lists").find("div.collapse").removeClass("collapse");
        });
    </script>
</body>

</html>