<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php
    include('pages-head.php');

    // Get quiz id from $_GET.
    $stID = $_GET["st_id"];

    // Determine if it's course or micro-credential.
   if(isset($_GET["st_id"])) {
        $subj_type="st";
        $subjID = $_GET["st_id"];
        $quizAttempt = $skInfo->fetch_quiz_result($stID);

        // Check if the student already attempted the quiz or not.
        if($quizAttempt === NULL) {
            // --- fetch micro-credential based on subjID.
            // $mcData = $mcInfo->fetch_microcredential($subjID);
            // --- fetch the micro-credential's quiz informations and questions and its answers choices.
            $fetchQuizInfo = $skInfo->fetch_quiz_info($stID);
            $fetchQuizQnA = $skInfo->fetch_quiz_QnA($stID);

            // --- fetch the necessary micro-credential's informations.
            $quizDuration = $fetchQuizInfo["st_duration"];
            $quizExitLink = "skill-assessment-test.php";
       
            $quizTitle = $fetchQuizInfo["st_title"];
            $quizTotalQuestion = $fetchQuizQnA !== NULL ? count($fetchQuizQnA) : 0;
            $quizInstruction = $fetchQuizInfo["st_instruction"];
        } else {
            header("Location: micro-creds-learning-material.php?mc_id=$subjID&pill=quiz");
        }
    }

    $quizDuration = durationFormat($quizDuration);
?>

<body>
    <!-- Top navbar -->
    <div id="top">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid px-0">
                <!-- UNICREDS icon  data-bs-toggle="modal" data-bs-target="#alertHomePage" -->
                <span class="navbar-brand">
                    <img src="../assets/images/brand/logo/logo_unicreds.png" alt="" />
                </span>
                <div class="d-flex justify-content-center justify-items-center w-100">
                    <h2 class="text-center" id="timeRemainTop">Time: <?= $quizDuration ?></h2>
                </div>
                <!-- Buttons -->
                <ul class="navbar-nav ms-auto flex-row align-items-center">
                    <li class="nav-item docs-header-btn">
                        <!-- data-bs-toggle="modal" data-bs-target="#alertStopAttempt" -->
                        <button class="btn btn-danger me-2 me-lg-0" type="button" onclick="window.open('<?= $quizExitLink ?>', '_self');">
                            Exit
                        </button>
                    </li>
                    <li class="nav-item docs-header-btn ms-2">
                        <a href="#">
                            <button class="btn btn-success me-2 me-lg-0" id="topFinishButton" type="button" data-bs-toggle="modal" data-bs-target="#submitModal" disabled>Finish</button>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Quiz header -->
    <div class="pt-5 pb-4 bg-dark">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                   
                    <!-- heading  -->
                    <h2 class="display-3 mt-4 mb-3 text-white fw-bold">
                        <?= $quizTitle ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Quiz content -->
    <div class="d-flex justify-content-end p-lg-5 py-5">
        <div class="container m-0 p-0" style="max-width: 100% !important;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Quiz contents -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Number of questions ## collapse-->
                        <div class="pb-3 text-end ">
                            <h3>Number of questions: <?= $quizTotalQuestion ?></h3>
                        </div>
                        <!-- List of questions-->
                        <div class="card mb-4">
                            <!-- Card header -->
                            <div class="card-body">
                                <div>
                                    <h3 class="mb-0">Instructions</h3>
                                    <hr>
                                    <p class="mb-0 fs-4">
                                        <?= $quizInstruction ?>
                                    </p>
                                    <p class="text-danger mb-0 mt-2">
                                        <span class="text-dark"><strong>Reminder after starting the quiz: </strong></span><br>
                                        <em>
                                            Do not <strong>refresh</strong> the page if you didn't want to <strong>lose all your answers</strong>.<br>
                                            If you <strong>Exit</strong> or <strong>go to another page</strong>, then all your answers will <strong>not be submitted</strong> 
                                            and your attempt will be counted.
                                        </em>
                                    </p>
                                    <form action="function/quiz-test-attempt1.php" method="post" enctype="multipart/form-data">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-grid col-6 mx-25">
                                                <input type="hidden" name="subj_id" value="<?= $subjID ?>">
                                                <input type="hidden" name="st_id" value="<?= $stID ?>">
                                                <button type="submit" name="quizAttempt" value="<?= $subj_type ?>" class="btn btn-outline-success mt-6" 
                                                    <?= $quizTotalQuestion === 0 ? 'disabled' : "" ?>>
                                                    Start
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>