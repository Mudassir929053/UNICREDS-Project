<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php
    include('pages-head.php');

    // Get test id from $_GET.
    $testID = $_GET["test_id"];

    // Determine if it's course or micro-credential.
    if(isset($_GET["course_id"])) {
        $subj_type="course";
        $subjID = $_GET["course_id"];
        $testAttempt = $courseInfo->fetch_test_result($testID);

        // Check if the student already attempted the test or not.
        if($testAttempt === NULL) {
            $mcData = $courseInfo->fetch_course($subjID);
            // --- fetch the course's test informations and questions and its answers choices.
            $fetchTestInfo = $courseInfo->fetch_test_info($testID);
            $fetchTestQnA = $courseInfo->fetch_test_QnA($testID);

            // --- fetch the necessary course's informations.
            $testDuration = $fetchTestInfo["ct_duration"];
            $testExitLink = "course-learning-material.php?courseID=$subjID&amp;pill=test";
            $subjTitle = $mcData["course_title"];
            $testTitle = $fetchTestInfo["ct_title"];
            $testTotalQuestion = $fetchTestQnA !== NULL ? count($fetchTestQnA) : 0;
            $testInstruction = $fetchTestInfo["ct_instruction"];
        } else {
            header("Location: course-learning-material.php?course_id=$subjID&pill=test");
        }
    } else if(isset($_GET["mc_id"])) {
        $subj_type="mc";
        $subjID = $_GET["mc_id"];
        $testAttempt = $mcInfo->fetch_test_result($testID);
        
        // Check if the student already attempted the test or not.
        if($testAttempt === NULL) {
            $mcData = $mcInfo->fetch_microcredential($subjID);
            // --- fetch the micro-credential's test informations and questions and its answers choices.
            $fetchTestInfo = $mcInfo->fetch_test_info($testID);
            $fetchTestQnA = $mcInfo->fetch_test_QnA($testID);

            // --- fetch the necessary micro-credential's informations.
            $testDuration = $fetchTestInfo["mct_duration"];
            $testExitLink = "micro-creds-learning-material.php?mc_id=$subjID&amp;pill=test";
            $subjTitle = $mcData["mc_title"];
            $testTitle = $fetchTestInfo["mct_title"];
            $testTotalQuestion = $fetchTestQnA !== NULL ? count($fetchTestQnA) : 0;
            $testInstruction = $fetchTestInfo["mct_instruction"];
        } else {
            header("Location: micro-creds-learning-material.php?mc_id=$subjID&pill=test");
        }
    }

    $testDuration = durationFormat($testDuration);
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
                    <h2 class="text-center" id="timeRemainTop">Time: <?= $testDuration ?></h2>
                </div>
                <!-- Buttons -->
                <ul class="navbar-nav ms-auto flex-row align-items-center">
                    <li class="nav-item docs-header-btn">
                        <!-- data-bs-toggle="modal" data-bs-target="#alertStopAttempt" -->
                        <button class="btn btn-danger me-2 me-lg-0" type="button" onclick="window.open('<?= $testExitLink ?>', '_self');">
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

    <!-- Test header -->
    <div class="pt-5 pb-4 bg-dark">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <span class="fs-4 text-warning ls-md text-uppercase fw-semi-bold">
                        <?= $subjTitle ?>
                    </span>
                    <!-- heading  -->
                    <h2 class="display-3 mt-4 mb-3 text-white fw-bold">
                        <?= $testTitle ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Test content -->
    <div class="d-flex justify-content-end p-lg-5 py-5">
        <div class="container m-0 p-0" style="max-width: 100% !important;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Test contents -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Number of questions ## collapse-->
                        <div class="pb-3 text-end ">
                            <h3>Number of questions: <?= $testTotalQuestion ?></h3>
                        </div>
                        <!-- List of questions-->
                        <div class="card mb-4">
                            <!-- Card header -->
                            <div class="card-body">
                                <div>
                                    <h3 class="mb-0">Instructions</h3>
                                    <hr>
                                    <p class="mb-0 fs-4">
                                        <?= $testInstruction ?>
                                    </p>
                                    <p class="text-danger mb-0 mt-2">
                                        <span class="text-dark"><strong>Reminder after starting the test: </strong></span><br>
                                        <em>
                                            Do not <strong>refresh</strong> the page if you didn't want to <strong>lose all your answers</strong>.<br>
                                            If you <strong>Exit</strong> or <strong>go to another page</strong>, then all your answers will <strong>not be submitted</strong> 
                                            and your attempt will be counted.
                                        </em>
                                    </p>
                                    <form action="function/quiz-test-attempt.php" method="post" enctype="multipart/form-data">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-grid col-6 mx-25">
                                                <input type="hidden" name="subj_id" value="<?= $subjID ?>">
                                                <input type="hidden" name="test_id" value="<?= $testID ?>">
                                                <button type="submit" id="startButton" name="testAttempt" value="<?= $subj_type ?>" class="btn btn-outline-success mt-6" 
                                                    <?= $testTotalQuestion === 0 ? 'disabled' : "" ?>>
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