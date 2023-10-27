<?php
include('function/student-function.php');
$suID = $_SESSION['sess_studentid'];

?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>

<body>
    <!-- Top navigation -->
    <?php
    include('pages-topbar.php');

    $epID = $_GET["ep_id"];

    $epData = $epInfo->fetch_employability_program($epID);

    $videolink;
    $collapse = "";
    $fetchVideo = $epInfo->fetch_video($epID);

    if ($fetchVideo === NULL) {
        $collapse = "collapse";
    } else {
        $videoID = $fetchVideo[0]["epv_id"];
        $videolink = "../assets/attachment/course/coursevideo/" . $fetchVideo[0]["epv_attachment"];
    }
    ?>

    <div class="p-lg-5 py-5">
        <div class="container">
            <!-- Video section -->
            <div class="row <?= $collapse ?>">
                <div class="col-lg-12 col-md-12 col-12 mb-5">
                    <div class="rounded-3 position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;">
                        <video id="teachVid" data-video-id="<?= $videoID ?>" class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100" controls>
                            <source src="<?= $videolink ?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    </div>
                </div>
            </div>
         <!-- HTML code for the link -->


            <!-- Content body -->
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                    <!-- Micro-creds informations -->
                    <div class="card mb-5">
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Microcredential code -->

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Micro-creds name -->
                                <h1 class="fw-semi-bold mb-2">
                                    <?= $epData["ep_title"] ?>
                                    <!-- ## Programme completed icon -->
                                    <i class="mdi mdi-check-decagram-outline text-success collapse"></i>
                                </h1>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                            <ul class="mb-1 list-inline">
                                    <!-- Micro-creds institution -->
                                    <li class="mb-1">
                                    <i class="fe fe-book text-success me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                        <span class="text-body">
                                            <?= $epData["ep_category"] !== NULL ? $epData["ep_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                        </span>
                                    </li>
                                    <!-- Micro-creds category -->
                                  
                                </ul>
                                <?php
                                if ($epData["course_created_by"] !== NULL) {
                                    $creator = $epInfo->check_ep_creator($epData["course_created_by"]);
                                ?>
                                    <div class="me-2">
                                        <div class="d-lg-flex align-items-center">
                                            <!-- <h4 class="me-3 text-body">Creator: </h4> -->
                                            <div class="avatar-group">
                                                <!-- notify: avatar-indicators avatar-online -->
                                                <span id="notify" class="avatar avatar-xl ">
                                                    <img alt="avatar" src="<?= $creator["image"] ?>" class="rounded-circle imgtooltip" data-template="tips" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#chatCanvas" aria-controls="chatCanvas" data-recv-id="<?= $creator["user_id"] ?>" data-send-id="<?= $suInfoRow["su_user_id"] ?>" id="showChat" onclick="fetchMessage(this.id)">
                                                    <!-- Tooltips -->
                                                    <div id="tips" class="d-none">
                                                        <h6 class="mb-0 text-uppercase text-muted text-center">Instructor</h6>
                                                        <h4 class="mb-0 fw-bold"><?= $creator["name"] ?></h4>
                                                        <span><?= $creator["email"] ?></span>
                                                    </div>
                                                    <!-- Chat canvas -->
                                                </span>
                                                <?php
                                                // include("student-instructor-chat.php");
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-lt-tab" id="tab" role="tablist">
                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "video" ? "active" : "" ?>" data-id="video" id="video-tab" data-bs-toggle="pill" href="#video" role="tab" aria-controls="video" aria-selected="false">
                                    Video
                                </a>
                            </li>
                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "note" ? "active" : "" ?>" data-id="note" id="note-tab" data-bs-toggle="pill" href="#note" role="tab" aria-controls="note" aria-selected="false">
                                    Note
                                </a>
                            </li>

                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "quiz" ? "active" : "" ?>" data-id="quiz" id="quiz-tab" data-bs-toggle="pill" href="#quiz" role="tab" aria-controls="quiz" aria-selected="false">
                                    Quiz
                                </a>
                            </li>

                        </ul>
                    </div>

                    <!-- Course contents -->
                    <div class="card rounded-3">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <!-- Learning outcomes -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "video" ? "show active" : "" ?>" id="video" role="tabpanel" aria-labelledby="video-tab">
                                    <h3 class="mb-2">Teaching Videos</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        A video lesson or lecture is a video which presents educational material for a topic which is to be learned.
                                        The format may vary. It might be a video of a teacher speaking to the camera, photographs and text about the
                                        topic or some mixture of these.
                                    </p>
                                    <?php
                                    if ($fetchVideo === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($fetchVideo); $i++) {
                                        ?>
                                            <!-- Video  Lists -->
                                            <div class="card border">
                                                <div class="card-header" id="videoHeading<?= $fetchVideo[$i]["epv_id"] ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#videoCollapse<?= $i ?>" aria-expanded="false" aria-controls="videoCollapse<?= $i ?>">
                                                            <div class="me-auto">
                                                                <?= $fetchVideo[$i]["epv_title"] ?>
                                                                <?php
                                                                if ($epInfo->check_watched_video($fetchVideo[$i]["epv_id"])) {
                                                                ?>
                                                                    <i class="mdi mdi-eye-check-outline mdi-18px text-success ms-2" data-bs-toggle="tooltip" data-placement="top" title="Viewed"></i>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <!-- <small>Duration: <?= $fetchVideo[$i]["epv_duration"] !== NULL ? duration_formatting($fetchVideo[$i]["epv_duration"]) : "<em class='text-muted'>Not specified</em>" ?></small> -->
                                                        <small>Duration: <?= $fetchVideo[$i]["epv_duration"] !== NULL ? $fetchVideo[$i]["epv_duration"] : "<em class='text-muted'>Not specified</em>" ?></small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="videoCollapse<?= $i ?>" class="collapse" aria-labelledby="videoHeading<?= $fetchVideo[$i]["epv_id"] ?>" data-bs-parent="#video">
                                                    <div class="card-body">
                                                        <p>
                                                            <?= $fetchVideo[$i]["epv_discription"] ?>
                                                        </p>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex align-items-center ms-4">
                                                                <i class="fas fa-play fa-md me-3 text-info"></i>
                                                                <a data-id="<?= $fetchVideo[$i]["epv_id"] ?>" data-link="../assets/attachment/course/coursevideo/<?= $fetchVideo[$i]["epv_attachment"] ?>" class="video-link text-inherit text-decoration-none" style="cursor: pointer;">
    <?= $fetchVideo[$i]["epv_attachment"] ?>
</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Notes -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "note" ? "show active" : "" ?>" id="note" role="tabpanel" aria-labelledby="note-tab">
                                    <h3 class="mb-2">Lecture Notes</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        Lecture notes should represent a concise and complete outline of the most important points and ideas, especially those considered most
                                        important by your professor. Lecture notes can clarify ideas not fully understood in the text or elaborate on material that the text
                                        mentions only briefly.
                                    </p>
                                    <!-- Note Lists -->
                                    <?php
                                    $mcNote = $epInfo->fetch_tutorial($epID);

                                    if ($mcNote === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($mcNote); $i++) {
                                            $fileLink = "../assets/attachment/course/coursenote/" . $mcNote[$i]["epn_attachment"];
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="noteHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#noteCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="noteCollapse<?= $i + 1 ?>">
                                                            <div class="me-auto">
                                                                <?= $mcNote[$i]["cn_title"] ?>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>Date created: <?= date_format(date_create($mcNote[$i]["epn_created_date"]), "d/m/Y") ?></small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="noteCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="noteHeading<?= $i + 1 ?>" data-bs-parent="#note">
                                                    <div class="card-body">
                                                        <?= $mcNote[$i]["cn_discription"] ?>
                                                        <div class="mt-2">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="fas fa-file fa-lg me-3 text-info"></i>
                                                                        <a href="<?= $fileLink ?>" target="_blank"><?= explode("/", $fileLink)[5] ?></a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Slide -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "slide" ? "show active" : "" ?>" id="slide" role="tabpanel" aria-labelledby="slide-tab">
                                    <h3 class="mb-2">Teaching Slides</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        The advantage of using slides is that you can spend a small amount of your time on writing (additional notes)
                                        and most of your time thinking about the content. Hence, allowing you to connect and understand the information
                                        that you hear and ask interesting questions.
                                    </p>
                                    <!-- Slide Lists -->
                                    <?php
                                    $mcSlide = $mcInfo->fetch_slide($mcID);

                                    if ($mcSlide === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($mcSlide); $i++) {
                                            $fileLink = "../assets/attachment/microcredential/mcslide/" . $mcSlide[$i]["mcs_attachment"];
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="slideHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#slideCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="slideCollapse<?= $i + 1 ?>">
                                                            <div class="me-auto">
                                                                <?= $mcSlide[$i]["mcs_title"] ?>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>Date created: <?= date_format(date_create($mcSlide[$i]["mcs_created_date"]), "d/m/Y") ?></small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="slideCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="slideHeading<?= $i + 1 ?>" data-bs-parent="#slide">
                                                    <div class="card-body">
                                                        <?= $mcSlide[$i]["mcs_description"] ?>
                                                        <div class="mt-2">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="fas fa-file fa-lg me-3 text-info"></i>
                                                                        <a href="<?= $fileLink ?>" target="_blank"><?= explode("/", $fileLink)[5] ?></a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Tutorial -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "tutor" ? "show active" : "" ?>" id="tutor" role="tabpanel" aria-labelledby="tutor-tab">
                                    <h3 class="mb-2">Tutorial Assignments</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        Learning/tutorial assignments provide you the first experience with new material, and are intended to walk
                                        you through new concepts and procedures. Skills practice assignments follow learning/tutorial assignments,
                                        and let you to apply new concepts and procedures.
                                    </p>
                                    <!-- Tutorial Lists -->
                                    <?php
                                    $mcTutorial = $mcInfo->fetch_tutorial($mcID);

                                    if ($mcTutorial === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($mcTutorial); $i++) {
                                            // Tutorial submission info.
                                            $tutorialSubm = $mcInfo->fetch_tutorial_submission($mcTutorial[$i]["mctu_id"], 1);
                                            $checkIcon = "";

                                            if ($tutorialSubm !== NULL) {
                                                $tutorialGrade = $tutorialSubm["sumctus_grade"] !== NULL ? $tutorialSubm["sumctus_grade"] : "Not graded";

                                                if ($tutorialSubm["sumctus_deleted_date"] === NULL) {
                                                    $tutorialStatus = "Submitted";
                                                    $tutorialDate = $tutorialSubm["sumctus_submitted_date"];
                                                    $checkIcon = '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>';
                                                } else {
                                                    $tutorialStatus = "Not submitted";
                                                    $tutorialDate = $tutorialSubm["sumctus_deleted_date"];
                                                }

                                                $tutorialView = "";
                                            } else {
                                                $tutorialGrade = "Not graded";
                                                $tutorialStatus = "Not submitted";
                                                $tutorialDate = "-";
                                                $tutorialView = "collapse";
                                            }
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="tutorialHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#tutorialCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="tutorialCollapse<?= $i + 1 ?>">
                                                            <div class="d-flex align-items-center me-auto" id="showTutorialCheck<?= $i + 1 ?>">
                                                                <?= $mcTutorial[$i]["mctu_title"] ?>
                                                                <span class="uploaded-indicator">
                                                                    <?= $checkIcon ?>
                                                                </span>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>
                                                            Due on: <span class="text-primary"><?= date_format(date_create($mcTutorial[$i]["mctud_duedate_date"] . " " . $mcTutorial[$i]["mctud_duedate_time"]), "h:i a, d/m/Y") ?></span>
                                                        </small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="tutorialCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="tutorialHeading<?= $i + 1 ?>" data-bs-parent="#tutor">
                                                    <div class="card-body">
                                                        <?= $mcTutorial[$i]["mctu_description"] ?>
                                                        <div class="mt-2">
                                                            <ul class="list-group list-group-flush">
                                                                <?php
                                                                if ($mcTutorial[$i]["mctu_total_no_of_tutorial"] !== 0) {
                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <div class="d-flex align-items-cenert">
                                                                            <i class="fas fa-file fa-lg me-3 text-info"></i>
                                                                            <a href="../assets/attachment/microcredential/mctutorial/<?= $mcTutorial[$i]["mctu_attachment"] ?>" target="_blank">
                                                                                <?= $mcTutorial[$i]["mctu_attachment"] ?>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- Tutorial submission -->
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Submission status</th>
                                                                    <td id="showTutorialStatus<?= $i + 1 ?>"><?= $tutorialStatus ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Grading status</th>
                                                                    <td><?= $tutorialGrade ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Time remaining</th>
                                                                    <td><?= timeRemaining($mcTutorial[$i]["mctud_duedate_time"], $mcTutorial[$i]["mctud_duedate_date"]) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Last modified</th>
                                                                    <td id="showTutorialDateModified<?= $i + 1 ?>"><?= $tutorialDate ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- Button trigger modal -->
                                                        <div class="d-grid gap-2 col-6 mx-auto">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutorialModal<?= $i + 1 ?>">
                                                                Add submission
                                                            </button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="tutorialModal<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="tutorialModalTitle<?= $i + 1 ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="tutorialModalTitle<?= $i + 1 ?>"><?= $mcTutorial[$i]["mctu_title"] ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-5">Maximum file size</dt>
                                                                            <dd class="col-sm-7 text-primary">100 MB</dd>
                                                                            <dt class="col-sm-5">Maximum number of files</dt>
                                                                            <dd class="col-sm-7 text-primary">1</dd>
                                                                            <dt class="col-sm-5">Accepted file types</dt>
                                                                            <dd class="col-sm-7 text-primary">.doc .docx .pdf</dd>
                                                                        </dl>
                                                                        <hr>
                                                                        <form id="tutorial-<?= $i + 1 ?>-microcredential" method="post" action="function/learning-material.php" class="dropzone mt-4 border-dashed">
                                                                            <div class="fallback">
                                                                                <input type="file" name="file">
                                                                            </div>
                                                                            <input type="hidden" name="tlm_cat" value="mc">
                                                                            <input type="hidden" name="uploadFile" value="tutorial">
                                                                            <input type="hidden" name="su_id" value="<?= $suID ?>">
                                                                            <input type="hidden" name="tlm_id" value="<?= $mcTutorial[$i]["mctu_id"] ?>">
                                                                        </form>
                                                                        <div></div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="" id="view-uploaded-tutorial-<?= $i + 1 ?>" class="btn btn-info <?= $tutorialView ?>" target="_blank">View Uploaded</a>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Quiz -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "quiz" ? "show active" : "" ?>" id="quiz" role="tabpanel" aria-labelledby="quiz-tab">
                                    <h3 class="mb-2">Quiz</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        A quiz is a quick and informal assessment of student knowledge. Quizzes are often used in higher education environments
                                        to briefly test a students' level of comprehension regarding course material, providing teachers with insights into student progress
                                        and any existing knowledge gaps.
                                    </p>
                                    <!-- Quiz Lists -->
                                    <?php

                                    $epQuiz = $epInfo->fetch_epquiz($epID);

                                    if ($epQuiz === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($epQuiz); $i++) {
                                            $checkIcon = "";

                                            // Check if the quiz already attempted or not.
                                            $epqResult = $epInfo->fetch_epquiz_result($epQuiz[$i]["epq_id"]);
                                            if ($epqResult !== NULL) {
                                                $checkIcon = '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>';
                                                $attempt = "<span class='text-dark'>1</span>";
                                                $score = "<span class='text-dark'>" . $epqResult["suepqrs_grade"] . "</span>";
                                                $attemptBtn = "collapse";
                                                $reviewBtn = "";
                                            } else {
                                                $attempt = 0;
                                                $score = 0;
                                                $attemptBtn = "";
                                                $reviewBtn = "collapse";
                                            }
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="quizHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#quizCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="quizCollapse<?= $i + 1 ?>">
                                                            <div class="me-auto">
                                                                <?= $epQuiz[$i]["epq_title"] ?>
                                                                <?= $checkIcon ?>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>Date created: <?= date_format(date_create($epQuiz[$i]["epq_created_date"]), "d/m/Y") ?></small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="quizCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="quizHeading<?= $i + 1 ?>" data-bs-parent="#quiz">
                                                    <div class="card-body">
                                                        <?= $epQuiz[$i]["epq_instruction"] ?>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Attempts</th>
                                                                    <td><?= $attempt ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Time limit</th>
                                                                    <td><?= $epQuiz[$i]["epq_duration"] !== NULL ? durationFormat($epQuiz[$i]["epq_duration"], '%2d Hours and %2d Minutes') : "<em class='text-muted'>Not set</em>" ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Score</th>
                                                                    <td><?= $score ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- Attempt quiz -->
                                                        <div class="d-grid gap-2 col-6 mx-auto">
                                                            <button type="button" class="btn btn-primary <?= $attemptBtn ?>" onclick="window.open('epquiz-attempt-main.php?ep_id=<?= $epID ?>&amp;quiz_id=<?= $epQuiz[$i]['epq_id'] ?>', '_self');">
                                                                Start attempt
                                                            </button>
                                                            <button type="button" class="btn btn-success <?= $reviewBtn ?>" onclick="window.open('epquiz-attempt-review.php?ep_id=<?= $epID ?>&amp;quiz_id=<?= $epQuiz[$i]['epq_id'] ?>', '_self');">
                                                                Quiz Review
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Assignment -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "asgmt" ? "show active" : "" ?>" id="asgmt" role="tabpanel" aria-labelledby="asgmt-tab">
                                    <h3 class="mb-2">Assignments</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        Assignments usually take the form of written pieces of work that are set by your instructors. They also usually contribute towards
                                        your final course/subject mark or grade. The types of assignment that you could be set depend on the course/subject you are studying.
                                    </p>
                                    <!-- Assignment Lists -->
                                    <?php
                                    $mcAssignment = $mcInfo->fetch_assignment($mcID);

                                    if ($mcAssignment === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($mcAssignment); $i++) {
                                            // Assignment submission info.
                                            $assignmentSubm = $mcInfo->fetch_assignment_submission($mcAssignment[$i]["mca_id"], 1);
                                            $checkIcon = "";

                                            if ($assignmentSubm !== NULL) {
                                                $assignmentGrade = $assignmentSubm["sumcas_grade"] !== NULL ? $assignmentSubm["sumcas_grade"] : "Not graded";

                                                if ($assignmentSubm["sumcas_deleted_date"] === NULL) {
                                                    $assignmentStatus = "Submitted";
                                                    $assignmentDate = $assignmentSubm["sumcas_submitted_date"];
                                                    $checkIcon = '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>';
                                                } else {
                                                    $assignmentStatus = "Not submitted";
                                                    $assignmentDate = $assignmentSubm["sumcas_deleted_date"];
                                                }

                                                $assignmentView = "";
                                            } else {
                                                $assignmentGrade = "Not graded";
                                                $assignmentStatus = "Not submitted";
                                                $assignmentDate = "-";
                                                $assignmentView = "collapse";
                                            }
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="assignmentHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#assignmentCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="assignmentCollapse<?= $i + 1 ?>">
                                                            <div class="d-flex align-items-center me-auto" id="showAssignmentCheck<?= $i + 1 ?>">
                                                                <?= $mcAssignment[$i]["mca_title"] ?>
                                                                <span class="uploaded-indicator">
                                                                    <?= $checkIcon ?>
                                                                </span>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>
                                                            Due on: <span class="text-primary"><?= date_format(date_create($mcAssignment[$i]["mcad_duedate_date"] . " " . $mcAssignment[$i]["mcad_duedate_time"]), "h:i a, d/m/Y") ?></span>
                                                        </small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="assignmentCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="assignmentHeading<?= $i + 1 ?>" data-bs-parent="#asgmt">
                                                    <div class="card-body">
                                                        <?= $mcAssignment[$i]["mca_description"] ?>
                                                        <div class="mt-2">
                                                            <ul class="list-group list-group-flush">
                                                                <?php
                                                                if ($mcAssignment[$i]["mca_total_no_of_assignment"] !== 0) {
                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="fas fa-file fa-lg me-3 text-info"></i>
                                                                            <a href="../assets/attachment/microcredential/mcassignment/<?= $mcAssignment[$i]["mca_attachment"] ?>" target="_blank">
                                                                                <?= $mcAssignment[$i]["mca_attachment"] ?>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- Assignment submission -->
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Submission status</th>
                                                                    <td id="showAssignmentStatus<?= $i + 1 ?>"><?= $assignmentStatus ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Grading status</th>
                                                                    <td><?= $assignmentGrade ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Time remaining</th>
                                                                    <td><?= timeRemaining($mcAssignment[$i]["mcad_duedate_time"], $mcAssignment[$i]["mcad_duedate_date"]) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Last modified</th>
                                                                    <td id="showAssignmentDateModified<?= $i + 1 ?>"><?= $assignmentDate ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- Button trigger modal -->
                                                        <div class="d-grid gap-2 col-6 mx-auto">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignmentModal<?= $i + 1 ?>">
                                                                Add submission
                                                            </button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="assignmentModal<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="assignmentModalTitle<?= $i + 1 ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="assignmentModalTitle<?= $i + 1 ?>"><?= $mcAssignment[$i]["mca_title"] ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-5">Maximum file size</dt>
                                                                            <dd class="col-sm-7 text-primary">100 MB</dd>
                                                                            <dt class="col-sm-5">Maximum number of files</dt>
                                                                            <dd class="col-sm-7 text-primary">1</dd>
                                                                            <dt class="col-sm-5">Accepted file types</dt>
                                                                            <dd class="col-sm-7 text-primary">.doc .docx .pdf</dd>
                                                                        </dl>
                                                                        <hr>
                                                                        <form id="assignment-<?= $i + 1 ?>-microcredential" method="post" action="function/learning-material.php" class="dropzone mt-4 border-dashed">
                                                                            <div class="fallback">
                                                                                <input type="file" name="file">
                                                                            </div>
                                                                            <input type="hidden" name="tlm_cat" value="mc">
                                                                            <input type="hidden" name="uploadFile" value="assignment">
                                                                            <input type="hidden" name="su_id" value="<?= $suID ?>">
                                                                            <input type="hidden" name="tlm_id" value="<?= $mcAssignment[$i]["mca_id"] ?>">
                                                                        </form>
                                                                        <div></div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="" id="view-uploaded-assignment-<?= $i + 1 ?>" class="btn btn-info <?= $assignmentView ?>" target="_blank">View Uploaded</a>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Projects -->
                                <!-- <div class="tab-pane <?= $_GET["pill"] === "proj" ? "show active" : "" ?>" id="proj" role="tabpanel" aria-labelledby="proj-tab">
                                    <h3 class="mb-2">Project</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        A project is a temporary endeavor (it has a start and end date), undertaken to create a unique product, service or result within 
                                        defined constraints. A project concludes when its specific tangible and/or intangible objectives have been attained and its resources 
                                        have been released to do other work.
                                    </p> -->
                                <!-- Projects Lists -->
                                <?php
                                // $mcProject = $mcInfo->fetch_project($mcID);

                                // if($mcProject === NULL) {
                                ?>
                                <!-- ## No Contents -->
                                <!-- <div class="mt-4 mb-4 text-center">
                                        <h3 class="display-5">Sorry! There's no content available.</h3>
                                        <p class="lead">The instructor will add this soon.</p>
                                    </div> -->
                                <?php
                                // } else {
                                //     for($i = 0; $i < count($mcProject); $i++) {
                                //         // Project submission info.
                                //         $projectSubm = $mcInfo->fetch_project_submission($mcProject[$i]["mcp_id"]);
                                //         $checkIcon = "";

                                //         if($projectSubm !== NULL) {
                                //             $projectGrade = $projectSubm["sumcps_grade"] !== NULL ? $projectSubm["sumcps_grade"] : "Not graded";

                                //             if($projectSubm["sumcps_deleted_date"] === NULL) {
                                //                 $projectStatus = "Submitted";
                                //                 $projectDate = $projectSubm["sumcps_submitted_date"];
                                //                 $checkIcon = '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>';
                                //             } else {
                                //                 $projectStatus = "Not submitted";
                                //                 $projectDate = $projectSubm["sumcps_deleted_date"];
                                //             }
                                //         } else {
                                //             $projectGrade = "Not graded";
                                //             $projectStatus = "Not submitted";
                                //             $projectDate = "-";
                                //         }
                                ?>
                                <!-- <div class="card border">
                                        <div class="card-header" id="projectHeading<?= $i + 1 ?>">
                                            <h4 class="mb-0">
                                                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" 
                                                  data-bs-target="#projectCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="projectCollapse<?= $i + 1 ?>">
                                                    <div class="d-flex align-items-center me-auto" id="showProjectCheck">
                                                        <?= $mcProject[$i]["mcp_title"] ?>
                                                        <?= $checkIcon ?>
                                                    </div>
                                                    <span class="chevron-arrow ms-4">
                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                    </span>
                                                </a>
                                            </h4>
                                            <p class="mb-0">
                                                <small>
                                                    Due on: <span class="text-primary"><?= date_format(date_create($mcProject[$i]["mcpd_duedate_date"] . " " . $mcProject[$i]["mcpd_duedate_time"]), "h:i a, d/m/Y") ?></span>
                                                </small>
                                            </p>
                                        </div>
                                        <div id="projectCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="projectHeading<?= $i + 1 ?>" data-bs-parent="#project">
                                            <div class="card-body">
                                            <?= $mcProject[$i]["mcp_description"] ?>
                                            </div> -->
                                <?php
                                // if($mcProject[$i]["mcp_total_no_of_project"] !== 0) {
                                ?>
                                <!-- <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fas fa-file fa-lg me-2 text-info"></i>
                                                        <a href="../assets/attachment/microcredential/mcproject/<?= $mcProject[$i]["mcp_attachment"] ?>" target="_blank">
                                                            <?= $mcProject[$i]["mcp_attachment"] ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> -->
                                <?php
                                // }
                                ?>
                                <!-- Projects submission -->
                                <!-- <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th class="table-primary" scope="row">Submission status</th>
                                                            <td id="showProjectStatus"><?= $projectStatus ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary" scope="row">Grading status</th>
                                                            <td><?= $projectGrade ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary" scope="row">Time remaining</th>
                                                            <td><?= timeRemaining($mcProject[$i]["mcpd_duedate_time"], $mcProject[$i]["mcpd_duedate_date"]) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary" scope="row">Last modified</th>
                                                            <td id="showProjectDateModified"><?= $projectDate ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table> -->
                                <!-- Button trigger modal -->
                                <!-- <div class="d-grid gap-2 col-6 mx-auto">
                                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal<?= $i + 1 ?>">
                                                      Add submission
                                                  </button>
                                                </div> -->
                                <!-- Modal -->
                                <!-- <div class="modal fade" id="projectModal<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="projectModalTitle<?= $i + 1 ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="projectModalTitle<?= $i + 1 ?>"><?= $mcProject[$i]["mcp_title"] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row">
                                                                    <dt class="col-sm-5">Maximum file size</dt>
                                                                    <dd class="col-sm-7 text-primary">100 MB</dd>
                                                                    <dt class="col-sm-5">Maximum number of files</dt>
                                                                    <dd class="col-sm-7 text-primary">1</dd>
                                                                    <dt class="col-sm-5">Accepted file types</dt>
                                                                    <dd class="col-sm-7 text-primary">.doc .docx .pdf</dd>
                                                                </dl>
                                                                <hr>
                                                                <form id="project-upload-form" method="post" action="function/learning-material.php" 
                                                                    class="dropzone mt-4 border-dashed">
                                                                    <div class="fallback">
                                                                        <input type="file" name="file">
                                                                    </div>
                                                                    <input type="hidden" name="tlm_cat" value="mc">
                                                                    <input type="hidden" name="uploadFile" value="project">
                                                                    <input type="hidden" name="su_id" value="<?= $suID ?>">
                                                                    <input type="hidden" name="tlm_id" value="<?= $mcProject[$i]["mcp_id"] ?>">
                                                                </form>
                                                                <div></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                <?php
                                //     }
                                // }
                                ?>
                                <!-- </div> -->

                                <!-- Test -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "test" ? "show active" : "" ?>" id="test" role="tabpanel" aria-labelledby="test-tab">
                                    <h3 class="mb-2">Test</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        They are used to determine whether you have learned what you were expected to learn or to level or degree to which you have
                                        learned the material. It is also to gather relevant information about your performance or progress, or to determine
                                        your interests to make judgments about your learning process.
                                    </p>
                                    <!-- Test Lists -->
                                    <?php
                                    $mcTest = $mcInfo->fetch_test($mcID);

                                    if ($mcTest === NULL) {
                                    ?>
                                        <!-- ## No Contents -->
                                        <div class="mt-4 mb-4 text-center">
                                            <h3 class="display-5">Sorry! There's no content available.</h3>
                                            <p class="lead">The instructor will add this soon.</p>
                                        </div>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($mcTest); $i++) {
                                            $checkIcon = "";

                                            // Check if the test already attempted or not.
                                            $mctResult = $mcInfo->fetch_test_result($mcTest[$i]["mct_id"]);
                                            if ($mctResult !== NULL) {
                                                $checkIcon = '<i class="mdi mdi-checkbox-marked-outline mdi-18px text-success ms-3" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>';
                                                $score = "<span class='text-dark'>" . $mctResult["sumctrs_grade"] . "</span>";
                                                $attemptBtn = "collapse";
                                                $reviewBtn = "";
                                            } else {
                                                $score = 0;
                                                $attemptBtn = "";
                                                $reviewBtn = "collapse";
                                            }
                                        ?>
                                            <div class="card border">
                                                <div class="card-header" id="testHeading<?= $i + 1 ?>">
                                                    <h4 class="mb-0">
                                                        <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" data-bs-target="#testCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="testCollapse<?= $i + 1 ?>">
                                                            <div class="me-auto">
                                                                <?= $mcTest[$i]["mct_title"] ?>
                                                                <?= $checkIcon ?>
                                                            </div>
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                    <p class="mb-0">
                                                        <small>Date created: <?= date_format(date_create($mcTest[$i]["mct_created_date"]), "d/m/Y") ?></small>
                                                    </p>
                                                </div>
                                                <!-- ## to show the content = add 'show' to [class] -->
                                                <div id="testCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="testHeading<?= $i + 1 ?>" data-bs-parent="#test">
                                                    <div class="card-body">
                                                        <?= $mcTest[$i]["mct_instruction"] ?>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Time limit</th>
                                                                    <td><?= $mcTest[$i]["mct_duration"] !== NULL ? durationFormat($mcTest[$i]["mct_duration"], '%2d Hours and %2d Minutes') : "<span><em>Not set</em></span>" ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-primary" scope="row">Score</th>
                                                                    <td><?= $score ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- Button trigger modal -->
                                                        <div class="d-grid gap-2 col-6 mx-auto">
                                                            <button type="button" class="btn btn-primary <?= $attemptBtn ?>" onclick="window.open('test-attempt-main.php?mc_id=<?= $mcID ?>&amp;test_id=<?= $mcTest[$i]['mct_id'] ?>', '_self');">
                                                                Start attempt
                                                            </button>
                                                            <button type="button" class="btn btn-success <?= $reviewBtn ?>" onclick="window.open('test-attempt-review.php?mc_id=<?= $mcID ?>&amp;test_id=<?= $mcTest[$i]['mct_id'] ?>', '_self');">
                                                                Test Review
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modules sidebar navigation -->
                <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                    <div class="card " id="courseAccordion">
                        <div>
                            <!-- List group modules -->
                            <ul class="list-group list-group-flush">
                                <!-- Overview -->
                                <li class="list-group-item p-0">
                                    <!-- Toggle -->
                                    <a class="h4 mb-0 d-flex align-items-center text-inherit text-decoration-none py-4 px-4" data-bs-toggle="collapse" href="#overview" role="button" aria-expanded="false" aria-controls="overview">
                                        <div class="me-auto">
                                            <!-- Title -->
                                            Overview
                                            <!-- <p class="mb-0 text-muted fs-6 mt-1 fw-normal">Not started</p> -->
                                        </div>
                                        <!-- Chevron -->
                                        <span class="chevron-arrow ms-4">
                                            <i class="fe fe-chevron-down fs-4"></i>
                                        </span>
                                    </a>
                                    <!-- Row -->
                                    <!-- Collapse -->
                                    <!-- ## here add at the [class="collapse show"] to collapse the nav -->
                                    <div class="collapse " id="overview" data-bs-parent="#courseAccordion">
                                        <!-- List group item -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0" aria-disabled="true"></li>
                                            <!-- Progress -->
                                            <!-- <li class="list-group-item" aria-disabled="true">
                                                <div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"
                                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small>0% Completed</small>
                                                </div>
                                            </li> -->
                                            <!-- List module items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="ep-view-enrolled.php?ep_id=<?= $epID ?>&amp;pill=desc" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-file-document fs-4"></i>
                                                        </span>
                                                        <span>Description</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="ep-view-enrolled.php?ep_id=<?= $epID ?>&amp;pill=prog" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-book-open-page-variant fs-4"></i>
                                                        </span>
                                                        <span>Progress</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="ep-view-enrolled.php?ep_id=<?= $epID ?>&amp;pill=forum" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-book-open-page-variant fs-4"></i>
                                                        </span>
                                                        <span>Review</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Learning material lists -->
                                <li class="list-group-item p-0">
                                    <!-- Toggle -->
                                    <a class="h4 mb-0 d-flex align-items-center text-inherit text-decoration-none py-4 px-4" data-bs-toggle="collapse" href="#material" role="button" aria-expanded="false" aria-controls="material">
                                        <div class="me-auto">
                                            <!-- Title -->
                                            Learning Materials
                                        </div>
                                        <!-- Chevron -->
                                        <span class="chevron-arrow ms-4">
                                            <i class="fe fe-chevron-down fs-4"></i>
                                        </span>
                                    </a>
                                    <!-- Row -->
                                    <!-- Collapse -->
                                    <!-- ## here add at the [class="collapse show"] to collapse the nav -->
                                    <div class="collapse show" id="material" data-bs-parent="#courseAccordion">
                                        <!-- List group item -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0" aria-disabled="true"></li>
                                            <!-- Videos list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;" data-id="video">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-play fs-4"></i>
                                                        </span>
                                                        <span>Video</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Notes list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;" data-id="note">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-notebook fs-4"></i>
                                                        </span>
                                                        <span>Note</span>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Quiz list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;" data-id="quiz">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-chat-question fs-4"></i>
                                                        </span>
                                                        <span>Quiz</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Micro-creds completion certificate -->
                                <!-- ## only visible upon completion -> remove 'collapse' -->
                                <li class="list-group-item p-0 collapse">
                                    <!-- Toggle -->
                                    <a class="h4 mb-0 d-flex align-items-center text-inherit text-decoration-none py-3 px-4" data-bs-toggle="collapse" href="#courseCert" role="button" aria-expanded="false" aria-controls="courseCert">
                                        <div class="me-auto">
                                            <!-- Title -->
                                            Certificate
                                        </div>
                                        <!-- Chevron -->
                                        <span class="chevron-arrow ms-4">
                                            <i class="fe fe-chevron-down fs-4"></i>
                                        </span>
                                    </a>
                                    <!-- Row -->
                                    <!-- Collapse -->
                                    <!-- ## here add at the [class="collapse show"] to collapse the nav -->
                                    <div class="collapse" id="courseCert" data-bs-parent="#courseAccordion">
                                        <!-- List group item -->
                                        <ul class="list-group">
                                            <!-- List module items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="#" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-file-certificate-outline fs-4"></i>
                                                        </span>
                                                        <span>Certificate Name</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- List module items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="#" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="fe fe-award fs-4"></i>
                                                        </span>
                                                        <span>Digital Badge</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include('pages-footer.php');
    ?>


    <!-- Scripts -->
    <!-- Chat JS -->
    <script src="js/student-chat.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Dropzone JS -->
    <script src="js/learning-material.js"></script>

    <!-- For navigation -->
    <script type="text/javascript">
        // Tab navigation.
        $("#tab > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?mc_id=<?= $epID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);
        });

        // Sidebar navigation.
        $("#material > ul > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?mc_id=<?= $epID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);

            $("#tab > li > a").each(function() {
                var tabID = $(this).data("id");

                // --- show content if id match.
                if (id == tabID) {
                    $(this).addClass("active");
                    $("#" + tabID).removeClass("disabled").addClass("show active");
                } else {
                    $(this).removeClass("active");
                    $("#" + tabID).removeClass("show active").addClass("disabled");
                }
            });
        });
    </script>

</body>

</html>