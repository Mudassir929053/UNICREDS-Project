<?php
include "function/student-function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php
include "pages-head.php";

// Get quiz id from $_GET.
$quizID = $_GET["quiz_id"];

if (isset($_GET["quiz_id"])) {
    $subj_type = "lt";

    // --- get the micro-credential id and fetch micro-credential based on subjID.
    $subjID = $_GET["quiz_id"];
    // $mcData = $epInfo->fetch_employability_program($subjID);
    $mcData = $ltInfo->fetch_language_test($subjID);
    // --- fetch the micro-credential's quiz informations and questions and its answers choices.
    $fetchQuizInfo = $ltInfo->fetch_ltquiz_info($quizID);
    $fetchQuizQnA = $ltInfo->fetch_quiz_QnA($quizID);

    // Check if there's a questions or not.
    if ($fetchQuizQnA !== null) {
        // --- fetch the necessary micro-credential's informations.
        $quizDuration = $fetchQuizInfo["ltq_duration"];
        $quizExitLink = "language-test.php";

        // Store all the quiz questions & answers in an associative 2D array.
        $quizQnA = [];
        $data = [];
        $i = 0;
        foreach ($fetchQuizQnA as $val) {
            $data["qq_id"] = $val["ltq_id"];
            $data["qa_id"] = $val["lta_id"];
            $data["qq_type"] = $val["ltq_question_type"];
            // $data["qq_figure"] = $val["ltcp_passage"] !== NULL ? "../assets/attachment/microcredential/mcquiz/".$val["ltcp_passage"] : $val["ltcp_passage"];
            $data["qq_figcaption"] = $val["ltcp_passage"];
            $data["qq_question"] = $val["ltq_question"];
            $data["qa_1"] = $val["lta_answer1"];
            $data["qa_2"] = $val["lta_answer2"];
            $data["qa_3"] = $val["lta_answer3"];
            $data["qa_4"] = $val["lta_answer4"];

            // --- store all the required data in $quizQnA associative 2D array.
            array_push($quizQnA, $data);
            $i++;
        }
    } else {
        header(
            "Location: quiz-attempt-question.php?ep_id=$subjID&quiz_id=$quizID"
        );
    }
}

$quizDuration = durationFormat($quizDuration);

// Set SESSION.
// $session_name = $subj_type."-".$subjID."[quizID=$quizID]";
// if(isset($_SESSION["$session_name"])) {
//     if($subj_type === "course") {
//         header("Location: quiz-attempt-review.php?course_id=$subjID&quiz_id=$quizID");
//     } else if($subj_type === "mc") {
//         header("Location: quiz-attempt-review.php?mc_id=$subjID&quiz_id=$quizID");
//     }
// }
?>

<body>
    <!-- Top navbar -->
    <div id="top">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow fixed-top">
            <div class="container-fluid px-0">
                <!-- UNICREDS icon  data-bs-toggle="modal" data-bs-target="#alertHomePage" -->
                <span class="navbar-brand">
                    <img src="../assets/images/brand/logo/logo_unicreds.png" alt="" />
                </span>
                <div class="d-flex justify-content-center justify-items-center w-100">
                    <h2 class="text-center text-secondary" id="timeRemainTop">Time: <?= $quizDuration ?></h2>
                </div>
                <!-- Buttons -->
                <ul class="navbar-nav ms-auto flex-row align-items-center">
                    <!-- <li class="nav-item docs-header-btn">
                         data-bs-toggle="modal" data-bs-target="#alertStopAttempt"
                        <button class="btn btn-danger me-2 me-lg-0" type="button" data-bs-toggle="modal" data-bs-target="#exitModal">
                            Exit
                        </button>
                    </li> -->
                    <li class="nav-item docs-header-btn ms-2">
                        <a href="#">
                            <button class="btn btn-success me-2 me-lg-0" id="topFinishButton" type="button" data-bs-toggle="modal" data-bs-target="#submitModal">Finish</button>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <form id="qnaForm" action="function/quiz-test-attempt.php" method="post" enctype="multipart/form-data">
        <!-- Submit answers modal -->
        <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-3" id="submitModal">Finish & Submit All</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark fs-4 m-0">Are you sure you want to submit all the answers?</p>
                        <p class="text-danger fs-5 m-0"><strong>This action cannot be cancelled.</strong></p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submitQuizAnswers" value="<?= $subj_type ?>" class="btn btn-success">Submit all</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Exit quiz modal -->
        <div class="modal fade" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exitModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-3" id="exitModal">Exit Quiz</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark fs-4 m-0">Are you sure you want to exit?</p>
                        <p class="text-danger fs-5 m-0"><strong>All your answers will not saved and your attempt will be counted.</strong></p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" onclick="exitQuiz()">
                            Exit now!
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="py-6 mt-8">
            <div class="container">
                <div class="row">
                    <!-- Test questions list -->
                    <div id="questionsList" class="col-xl-9 col-lg-9 col-md-12 col-12">
                        <?php
                        // View all the questions.
                        $i = 0;
                        foreach ($quizQnA as $data) {
                            // Show the first question.
                            $collapse = $i != 0 ? "collapse" : "";

                            // Determine the question type.
                            if (
                                $data["qq_type"] === "Multiple Choice Question"
                            ) { ?>
                                <!-- Question Type 1 -->
                                <!-- *** Multiple-choice question -->
                                <div class="card mb-3 <?= $collapse ?>" id="question<?= $i +
                                                                                        1 ?>">
                                    <!-- Card header -->
                                    <div class="card-header">
                                        <h3 class="mb-0">Question <?= $i +
                                                                        1 ?></h3>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="justify-content-between align-items-center text-dark">
                                            <!-- Question -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <figcaption class=" mt-1 p-3 bg-light <?= $data["qq_figcaption"] === null
                                                                                            ? "collapse"
                                                                                            : "" ?>"><?= $data["qq_figcaption"] ?></figcaption>
                                                <figure class="w-75 h-75 mb-3 <?= $data["qq_figure"] === null
                                                                                    ? "collapse"
                                                                                    : "" ?>">
                                                    <img src="" alt="" class="w-100 h-100 border border-primary">
                                                </figure>
                                            </div>
                                            <p class="my-4 fs-4">
                                                <?= $data["qq_question"] ?>
                                            </p>
                                            <!-- Answer choices -->
                                            <div class="mb-3">
                                                <div class="form-check d-flex align-items-center">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer1" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_1"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer1" class="btn btn-outline-success py-1 px-2">A</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_1"] ?></p>
                                                </div>
                                                <div class="form-check d-flex align-items-center mt-2">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer2" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_2"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer2" class="btn btn-outline-success py-1 px-2">B</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_2"] ?></p>
                                                </div>
                                                <div class="form-check d-flex align-items-center mt-2">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer3" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_3"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer3" class="btn btn-outline-success py-1 px-2">C</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_3"] ?></p>
                                                </div>
                                                <div class="form-check d-flex align-items-center mt-2">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer4" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_4"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer4" class="btn btn-outline-success py-1 px-2">D</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_4"] ?></p>
                                                </div>
                                                <input type="hidden" name="qq_<?= $i +
                                                                                    1 ?>" value="<?= $data["qq_id"] ?>">
                                                <input type="hidden" name="qa_<?= $i +
                                                                                    1 ?>" value="<?= $data["qa_id"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } elseif (
                                $data["qq_type"] === "Fill In The Blank"
                            ) { ?>
                                <!-- Question Type 5 -->
                                <!-- *** True/False question -->
                                <div class="card mb-3 <?= $collapse ?>" id="question<?= $i +
                                                                                        1 ?>">
                                    <div class="card-header">
                                        <h3 class="mb-0">Question <?= $i +
                                                                        1 ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="justify-content-between align-items-center text-dark">
                                            <!-- Question -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <figcaption class=" mt-1 p-3 bg-light <?= $data["qq_figcaption"] === null
                                                                                            ? "collapse"
                                                                                            : "" ?>"><?= $data["qq_figcaption"] ?></figcaption>
                                                <figure class="w-75 h-75 mb-3 <?= $data["qq_figure"] === null
                                                                                    ? "collapse"
                                                                                    : "" ?>">
                                                    <img src="" alt="" class="w-100 h-100 border border-primary">
                                                </figure>
                                            </div>
                                            <p class="my-4 fs-4">
                                                <?= $data["qq_question"] ?>
                                            </p>
                                            <!-- Answer choices -->
                                            <div class="mb-3">
                                                <div class="form-check d-flex align-items-center">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer1" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_1"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer1" class="btn btn-outline-success py-1 px-2">A</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_1"] ?></p>
                                                </div>
                                                <div class="form-check d-flex align-items-center mt-2">
                                                    <input type="radio" id="q<?= $i +
                                                                                    1 ?>Answer2" data-id="qnav-q<?= $i +
                                                                                                                    1 ?>" class="btn-check" name="q<?= $i + 1 ?>Answer" value="<?= $data["qa_2"] ?>" autocomplete="off">
                                                    <label for="q<?= $i +
                                                                        1 ?>Answer2" class="btn btn-outline-success py-1 px-2">B</label>
                                                    <p class="ms-3 fs-5 m-0"><?= $data["qa_2"] ?></p>
                                                </div>

                                                <input type="hidden" name="qq_<?= $i +
                                                                                    1 ?>" value="<?= $data["qq_id"] ?>">
                                                <input type="hidden" name="qa_<?= $i +
                                                                                    1 ?>" value="<?= $data["qa_id"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <!-- Question Type 5 -->
                                <!-- *** True/False question -->
                                <div class="card mb-3 <?= $collapse ?>" id="question<?= $i +
                                                                                        1 ?>">
                                    <div class="card-header">
                                        <h3 class="mb-0">Question <?= $i +
                                                                        1 ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="justify-content-between align-items-center text-dark">
                                            <!-- Question -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <figcaption class=" mt-1 p-3 bg-light <?= $data["qq_figcaption"] === null
                                                                                            ? "collapse"
                                                                                            : "" ?>"><?= $data["qq_figcaption"] ?></figcaption>
                                                <figure class="w-75 h-75 mb-3 <?= $data["qq_figure"] === null
                                                                                    ? "collapse"
                                                                                    : "" ?>">
                                                    <img src="" alt="" class="w-100 h-100 border border-primary">
                                                </figure>
                                            </div>
                                            <p class="my-4 fs-4">
                                                <?= $data["qq_question"] ?>
                                            </p>
                                            <!-- Answer choices -->
                                            <div class="mb-3 fs-4">
                                                <div class="form-check d-flex align-items-center">
                                               

<textarea class="form-control" id="q<?= $i + 1 ?>Answer1" data-id="qnav-q<?= $i + 1 ?>" name="q<?= $i + 1 ?>Answer" placeholder="write your answer here"></textarea>

<script>
    ClassicEditor
        .create(document.querySelector('#q<?= $i + 1 ?>Answer1'), {

        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });
</script>

                                                </div>

                                                <input type="hidden" name="qq_<?= $i +
                                                                                    1 ?>" value="<?= $data["qq_id"] ?>">
                                                <input type="hidden" name="qa_<?= $i +
                                                                                    1 ?>" value="<?= $data["qa_id"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }

                            $i++;
                        }
                        ?>
                    </div>

                    <input type="hidden" name="duration" value="">
                    <input type="hidden" name="time_taken" value="">
                    <input type="hidden" name="subj_id" value="<?= $subjID ?>">
                    <input type="hidden" name="quiz_id" value="<?= $quizID ?>">
                    <input type="hidden" name="qq_total" value="<?= count(
                                                                    $quizQnA
                                                                ) ?>">

                    <!-- Questions navigation -->
                    <div class="col-lg-3 col-md-12 col-12 accordion" id="accordionQNav">
                        <div class="card border-0 mb-3">
                            <!-- Card header -->
                            <div class="card-header" id="headingOne">
                                <div class="mb-2 mt-2 text-center px-2">
                                    <a href="#" class="d-flex align-items-center text-inherit text-decoration-none " data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <div class="me-auto">
                                            <p class="mb-0 fs-4 fw-medium">Question Navigation</p>
                                        </div>
                                        <span class="chevron-arrow ms-4">
                                            <!-- <i class="fe fe-chevron-down fs-4"></i> -->
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <!-- Card body -->
                            <div class="p-2 " id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionQNav">
                                <p class="mb-3 text-center">
                                    Navigate using the <span class="text-dark fw-medium">question's number</span>
                                    or use the <span class="text-dark fw-medium">arrow</span>.
                                </p>
                                <!-- Question number navigation -->
                                <div class="d-flex justify-content-center ms-1 p-3">
                                    <ul id="questionNumNav" class="list-inline mb-0">
                                        <?php
                                        // Questions navigation for all questions.
                                        $i = 0;
                                        foreach ($quizQnA as $data) { ?>
                                            <li class="list-inline-item mb-2">
                                                <a id="qnav-q<?= $i + 1 ?>" data-id="question<?= $i + 1 ?>" class="btn btn-outline-primary btn-icon"><?= $i + 1 ?></a>
                                            </li>
                                        <?php $i++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- hr -->
                            <!-- <hr class="m-0"> -->
                            <!-- Arrow navigation -->
                            <div class="card-footer p-0 py-2 px-4 d-flex justify-content-between align-items-center">
                                <a href="#" id="prevQ" onclick="navQuestion('prev')">
                                    <i class="fe fe-arrow-left fs-3" data-bs-toggle="tooltip" data-placement="top" title="Previous"></i>
                                </a>
                                <p class="p-0 pb-1 m-0 text-muted mx-3 text-center">navigation arrow (can use arrow key)</p>
                                <a href="#" id="nextQ" onclick="navQuestion('next')">
                                    <i class="fe fe-arrow-right fs-3" data-bs-toggle="tooltip" data-placement="top" title="Next"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Quiz & Test JS -->
    <script src="js/quiz-test-attempt.js"></script>

    <!-- Duration countdown & navigation -->
    <script>
        // Start duration countdown when the page loaded.
        window.onload = function() {
            $("input[name=duration]").prop("value", '<?= $quizDuration ?>')
            startTimer('<?= $quizDuration ?>');
        }

        /**
         * Function to redirect the current page to `micro-creds-learning-material.php` page.
         */
        function exitQuiz() {
            // Remove the `last_duration` from sessionStrorage.
            sessionStorage.removeItem("last_duration");
            window.open('<?= $quizExitLink ?>', '_self');
        }

        // Remove the `last_duration` from sessionStrorage when submitting the quiz.
        $("form").submit(function() {
            sessionStorage.removeItem("last_duration");
        });
    </script>
</body>

</html>