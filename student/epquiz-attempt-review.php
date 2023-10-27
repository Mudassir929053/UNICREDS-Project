<?php
include "function/student-function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php include "pages-head.php"; ?>

<body>
    <!-- Navbar -->
    <?php
    include "pages-topbar.php";

    // Store the quiz id in $quizID.
    $quizID = $_GET["quiz_id"];

    // Determine whether it is course or micro-credential.
    if (isset($_GET["ep_id"])) {
        $subj_type = "ep";
        $subjID = $_GET["ep_id"];

        // Fetch necessary data.
        $epData = $epInfo->fetch_employability_program($subjID);
        $fetchQuiz = $epInfo->fetch_epquiz_info($quizID);
        $fetchQuizQuestion = $epInfo->fetch_quiz_QnA($quizID);
        $fetchQuizResult = $epInfo->fetch_epquiz_result($quizID);
        $fetchQuizReview = $epInfo->fetch_quiz_review($quizID);

        // Quiz information.
        $subjTitle = $epData["ep_title"];
        $quizTitle = $fetchQuiz["epq_title"];
        $grade = $fetchQuizResult["suepqrs_grade"];
        $quiztimetaken = $fetchQuizResult["suepqrs_time_taken"];

        $numQuestion = $fetchQuizResult["suepqrs_total_question"];
        $numCorrect = $fetchQuizResult["suepqrs_total_correct_answer"];
        $numIncorrect = $numQuestion - $numCorrect;
        $link = "employability-program-learning-material.php?ep_id=$subjID&pill=quiz";

        // Question review.
        $questionList = [];
        $data = [];
        foreach ($fetchQuizQuestion as $question) {
            foreach ($fetchQuizReview as $review) {
                if (
                    $review["suepqrv_ep_quiz_question_id"] ==
                    $question["epqq_id"]
                ) {
                    $data["question_id"] =
                        $review["suepqrv_ep_quiz_question_id"];
                    $data["question"] = $question["epqq_question"];
                    $data["answer_status"] = $review["suepqrv_answer_status"];
                    $data["answer"] = $review["suepqrv_answer"];
                    $data["correct_answer"] =
                        $question["epqa_right_answerword"];
                    break;
                }
            }
            array_push($questionList, $data);
        }
    }
    // Set SESSION.
    $session_name = $subj_type . "-" . $subjID . "[quizID=$quizID]";
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
            <div class="row bg-white p-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="fs-3 text-warning"><?= $subjTitle ?></h3>
                    <h2 class="mb-2 "><?= $quizTitle ?></h2>
                    <table class=" table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" class="fs-4 fw-bolder">Quiz score</th>
                                <?php $grade =
                                    ($numCorrect / $numQuestion) * 100; ?>
                                <td class="fs-4 fw-bolder">: <?= $grade1 = number_format(
                                    $grade,
                                    2
                                ) ?>%</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4 fw-bolder">Quiz Time Taken</th>
                                <td class="fs-4 fw-bold">: <?= $quiztimetaken ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4 fw-bolder">Number of questions</th>
                                <td class="fs-4 fw-bolder">: <?= $numQuestion ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4 text-success fw-bolder">Number of correct questions</th>
                                <td class="fs-4 text-success fw-bolder">: <?= $numCorrect ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fs-4 text-danger fw-bolder">Number of incorrect questions</th>
                                <td class="fs-4 text-danger fw-bolder">: <?= $numIncorrect ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="text-end">
                        <a href="<?= $link ?>">
                            <button type="button" class="btn btn-sm btn-outline-primary">
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
    <!-- Footer -->
    <?php include "pages-footer.php"; ?>
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