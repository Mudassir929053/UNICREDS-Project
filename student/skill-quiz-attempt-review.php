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
    $quizID = $_GET["st_id"];

    // Determine whether it is course or micro-credential.
    if (isset($_GET["st_id"])) {
        $subj_type = "st";
        $subjID = $_GET["st_id"];

        // Fetch necessary data.
        $mcData = $skInfo->fetch_skillassessment($subjID);
        $fetchQuiz = $skInfo->fetch_quiz_info($quizID);
        $fetchQuizQuestion = $skInfo->fetch_quiz_QnA($quizID);
        $fetchQuizResult = $skInfo->fetch_quiz_result($quizID);
        $fetchQuizReview = $skInfo->fetch_quiz_review($quizID);
        $fetchQuizReview1 = $skInfo->fetch_quiz_review1($quizID);
        $fetchQuizReview2 = $skInfo->fetch_quiz_review2($quizID);

        // Quiz information.

        $quizTitle = $fetchQuiz["st_title"];
        $grade = $fetchQuizResult["susatqrs_grade"];
        $numQuestion = $fetchQuizResult["susatqrs_total_question"];
        $nummcqQuestion = $fetchQuizReview1["count(sstr.susatrv_id)"];
        $numfileQuestion = $fetchQuizReview2["count(sstr.susatrv_id)"];
        $numCorrect = $fetchQuizResult["susatqrs_total_correct_answer"];
        $numIncorrect = $numQuestion - $numCorrect;
        $link = "skill-assessment-test.php?st_id=$subjID&pill=quiz";

        // Question review.
        $questionList = array();
        $data = array();
        foreach ($fetchQuizQuestion as $question) {
            foreach ($fetchQuizReview as $review) {
                if ($review["susatrv_st_test_question_id"] == $question["stq_id"]) {
                    $data["question_id"] = $review["susatrv_st_test_question_id"];
                    $data["question"] = $question["stq_question"];
                    $data["answer_status"] = $review["susatrv_answer_status"];
                    $data["susatrv_fileupload"] = $review["susatrv_fileupload"];
                    $data["answer"] = $review["susatrv_answer"];
                    $data["correct_answer"] = $question["stqa_right_answer_word"];

                    break;
                }
            }

            array_push($questionList, $data);
        }
        foreach ($fetchQuizQuestion as $question) {
            $data["stq_type"] = $question["stq_type"];


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
                    <h2 class="mb-2 text-warning fw-bolder"><?= $quizTitle ?></h2>
                    <table class=" table-sm">
                        <tbody>
                            <?php if ($data["stq_type"] == 'multiple choice') { ?>
                                <tr>
                                    <th scope="row" class="fs-4 fw-bolder">Quiz score</th>
                                    <?php $grade = $numCorrect / $numQuestion * 100 ?>
                                    <td class="fs-4 fw-bolder">: <?= $grade1 = number_format($grade, 2)  ?>%</td>
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


                            <?php } elseif ($data["stq_type"] == 'fileupload' && $data["answer_status"] != NULL && $data["susatrv_fileupload"] == '' || $data["answer_status"] == 'Correct'|| $data["answer_status"] == 'Incorrect' ) { ?>
                                <tr>
                                    <th scope="row" class="fs-4 fw-bolder">Quiz score</th>
                                    <?php $grade = $numCorrect / $numQuestion * 100 ?>
                                    <td class="fs-4 fw-bolder">: <?= $grade1 = number_format($grade, 2)  ?>%</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="fs-4 fw-bolder">Number of MCQ questions</th>
                                    <td class="fs-4 fw-bolder">: <?= $nummcqQuestion ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fs-4 fw-bolder">Number of File Upload questions</th>
                                    <td class="fs-4 fw-bolder">: <?= $numfileQuestion ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fs-4 text-success fw-bolder">Number of correct questions</th>
                                    <td class="fs-4 text-success fw-bolder">: <?= $numCorrect ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fs-4 text-danger fw-bolder">Number of incorrect questions</th>
                                    <td class="fs-4 text-danger fw-bolder">: <?= $numIncorrect ?></td>
                                </tr>
                            <?php } else { ?>
                                <span>Thank you for attending the test,</span>
                                <h4>You will get your result soon</h4>
                            <?php  }
                            ?>
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