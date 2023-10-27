<?php
include('function/student-function.php');
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

    $courseID = $_GET["course_id"];
    $courseData = $courseInfo->fetch_enrolled_course($courseID);
    $createdby = $courseData["course_created_by"];
    ?>

    <div class="p-lg-5 py-5">
        <div class="container">
            <!-- Content body -->
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">

                    <!-- Micro-creds informations -->
                    <div class="card mb-5">
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Course code -->
                            <h3 class="mb-1">
                                <span class="text-body">
                                    <?= $courseData["course_code"] !== NULL && $courseData["course_code"] !== 'N/A' ? $courseData["course_code"] : "" ?>
                                </span>
                            </h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Course name -->
                                <h1 class="fw-semi-bold mb-2">
                                    <?= $courseData["course_title"] ?>
                                    <!-- ## Programme completed icon -->
                                    <i class="mdi mdi-check-decagram-outline text-success collapse"></i>
                                </h1>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <ul class="mb-1 list-inline">
                                    <!-- Course institution -->
                                    <li class="mb-1">
                                        <i class="fe fe-user-check me-2" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>
                                        <span class="text-body"><?= $courseInfo->check_course_owner($courseData["course_owner"])["name"] ?></span>
                                    </li>
                                    <!-- Coures category -->
                                    <li class="mb-1">
                                        <i class="fe fe-book text-success me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                        <span><?= $courseData["course_category"] !== NULL ? $courseData["course_category"] : "<span class='text-muted'><em>Not set</em></span>" ?></span>
                                    </li>
                                    <!-- Course duration -->
                                    <li class="mb-1">
                                        <i class="far fa-clock me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>
                                        <span class="text-body">
                                            <?= $courseData["course_duration"] ?>
                                        </span>
                                    </li>
                                    <!-- Course level -->
                                    <li>
                                        <i class="mdi mdi-school me-2 text-info" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>
                                        <span class="text-body">
                                            <?= $courseData["course_level"] !== NULL ? acadLevel($courseData["course_level"]) : "<span class='text-muted'><em>Not set</em></span>" ?>
                                        </span>
                                    </li>
                                    <!-- Course credit -->
                                    <!-- <li>
                                        <i class="fe fe-book-open me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>
                                        <span class="text-body">
                                            <?= $courseData["course_credit"] ?>
                                        </span>
                                    </li> -->
                                </ul>

                                <!-- Course creator chat -->
                                <?php
                                if ($courseData["course_created_by"] !== NULL) {
                                    $creator = $courseInfo->check_course_owner($courseData["course_created_by"]);
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
                                                include("student-instructor-chat.php");
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
                        <ul class="nav nav-lt-tab nav-pills" id="tab" role="tablist">
                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "desc" ? "active" : "" ?>" data-id="desc" id="desc-tab" data-bs-toggle="pill" href="#desc" role="tab" aria-controls="desc" aria-selected="false">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "prog" ? "active" : "" ?>" data-id="prog" id="prog-tab" data-bs-toggle="pill" href="#prog" role="tab" aria-controls="prog" aria-selected="false">
                                    Progress
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET["pill"] === "forum" ? "active" : "" ?>" data-id="forum" id="forum-tab" data-bs-toggle="pill" href="#forum" role="tab" aria-controls="forum" aria-selected="false">
                                    Forum & Discussion
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Course contents -->
                    <div class="card rounded-3">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <!-- Descriptions -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "desc" ? "show active" : "" ?>" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                    <div class="mb-4">
                                        <h3 class="mb-2">Course descriptions</h3>
                                        <p>
                                            <?= $courseData["course_description"] ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Progress -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "prog" ? "show active" : "" ?>" id="prog" role="tabpanel" aria-labelledby="prog-tab">
                                    <div class="mb-4">
                                        <h3 class="mb-1">Learning progress</h3>
                                        <p class="mb-4">Below are the progress that you have made.</p>
                                        <!-- Learning progress -->
                                        <table class="table mb-0">
                                            <tbody>
                                                <?php
                                                // Display the student university progress for video.
                                                $videoProgress = $courseInfo->video_progress($courseID);

                                                if ($videoProgress !== NULL) {
                                                    $td0 = '<i class="mdi mdi-play-circle-outline text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Video</span>';
                                                    $td1 = '<span>' . $videoProgress["progress"] . '/' . $videoProgress["total"] . '</span> <span>(' . $videoProgress["percentage"] . '%)</span>';
                                                    $bar = $videoProgress["percentage"] == 100 ? "bg-success" : "";
                                                    $val = $videoProgress["percentage"];
                                                } else {
                                                    $td0 = '<i class="mdi mdi-play-circle-outline mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Video</em></span>';
                                                    $td1 = '<span class="text-muted"><em>None</em></span>';
                                                    $bar = "";
                                                    $val = 0;
                                                }
                                                ?>
                                                <!-- Teaching video progress -->
                                                <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                // Display the student university progress for tutorial.
                                                $tutorialProgress = $courseInfo->tutorial_progress($courseID);

                                                if ($tutorialProgress !== NULL) {
                                                    $td0 = '<i class="mdi mdi-pencil text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Tutorial</span>';
                                                    $td1 = '<span>' . $tutorialProgress["progress"] . '/' . $tutorialProgress["total"] . '</span> <span>(' . $tutorialProgress["percentage"] . '%)</span>';
                                                    $bar = $tutorialProgress["percentage"] == 100 ? "bg-success" : "";
                                                    $val = $tutorialProgress["percentage"];
                                                } else {
                                                    $td0 = '<i class="mdi mdi-pencil mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Tutorial</em></span>';
                                                    $td1 = '<span class="text-muted"><em>None</em></span>';
                                                    $bar = "";
                                                    $val = 0;
                                                }
                                                ?>
                                                <!-- Tutorial progress -->
                                                <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                // Display the student university progress for quiz.
                                                $quizProgress = $courseInfo->quiz_progress($courseID);

                                                if ($quizProgress !== NULL) {
                                                    $td0 = '<i class="mdi mdi-chat-question text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Quiz</span>';
                                                    $td1 = '<span>' . $quizProgress["progress"] . '/' . $quizProgress["total"] . '</span> <span>(' . $quizProgress["percentage"] . '%)</span>';
                                                    $bar = $quizProgress["percentage"] == 100 ? "bg-success" : "";
                                                    $val = $quizProgress["percentage"];
                                                } else {
                                                    $td0 = '<i class="mdi mdi-chat-question mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Quiz</em></span>';
                                                    $td1 = '<span class="text-muted"><em>None</em></span>';
                                                    $bar = "";
                                                    $val = 0;
                                                }
                                                ?>
                                                <!-- Quiz progress -->
                                                <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                // Display the student university progress for assignment.
                                                $assignmentProgress = $courseInfo->assignment_progress($courseID);

                                                if ($assignmentProgress !== NULL) {
                                                    $td0 = '<i class="mdi mdi-file-document-edit text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Assignment</span>';
                                                    $td1 = '<span>' . $assignmentProgress["progress"] . '/' . $assignmentProgress["total"] . '</span> <span>(' . $assignmentProgress["percentage"] . '%)</span>';
                                                    $bar = $assignmentProgress["percentage"] == 100 ? "bg-success" : "";
                                                    $val = $assignmentProgress["percentage"];
                                                } else {
                                                    $td0 = '<i class="mdi mdi-file-document-edit mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Assignment</em></span>';
                                                    $td1 = '<span class="text-muted"><em>None</em></span>';
                                                    $bar = "";
                                                    $val = 0;
                                                }
                                                ?>
                                                <!-- Assignment progress -->
                                                <!-- <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                                <?php
                                                // Display the student university progress for project.
                                                // $projectProgress = $courseInfo->project_progress($courseID);

                                                // if($projectProgress !== NULL) {
                                                //     $td0 = '<i class="mdi mdi-progress-wrench text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Project</span>';
                                                //     $td1 = '<span>' . $projectProgress["progress"] . '/' . $projectProgress["total"] . '</span> <span>(' . $projectProgress["percentage"] . '%)</span>';
                                                //     $bar = $projectProgress["percentage"] == 100 ? "bg-success" : "";
                                                //     $val = $projectProgress["percentage"];
                                                // } else {
                                                //     $td0 = '<i class="mdi mdi-progress-wrench mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Project</em></span>';
                                                //     $td1 = '<span class="text-muted"><em>None</em></span>';
                                                //     $bar = "";
                                                //     $val = 0;
                                                // }
                                                ?>
                                                <!-- Project progress -->
                                                <!-- <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                                <?php
                                                // Display the student university progress for test.
                                                $testProgress = $courseInfo->test_progress($courseID);

                                                if ($testProgress !== NULL) {
                                                    $td0 = '<i class="mdi mdi-clipboard-clock text-primary mdi-18px"></i><span class="ms-2 d-none d-md-inline-block">Test</span>';
                                                    $td1 = '<span>' . $testProgress["progress"] . '/' . $testProgress["total"] . '</span> <span>(' . $testProgress["percentage"] . '%)</span>';
                                                    $bar = $testProgress["percentage"] == 100 ? "bg-success" : "";
                                                    $val = $testProgress["percentage"];
                                                } else {
                                                    $td0 = '<i class="mdi mdi-clipboard-clock mdi-dark mdi-inactive mdi-18px"></i><span class="ms-2 d-none d-md-inline-block text-muted"><em>Test</em></span>';
                                                    $td1 = '<span class="text-muted"><em>None</em></span>';
                                                    $bar = "";
                                                    $val = 0;
                                                }
                                                ?>
                                                <!-- Test progress -->
                                                <tr>
                                                    <td class="d-flex align-items-center border-top-0">
                                                        <?= $td0 ?>
                                                    </td>
                                                    <td class="text-end border-top-0">
                                                        <?= $td1 ?>
                                                    </td>
                                                    <td class="w-25 ps-3 align-middle border-top-0 ">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar <?= $bar ?>" role="progressbar" style="width: <?= $val ?>%" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Forum & Discussion -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "forum" ? "show active" : "" ?>" id="forum" role="tabpanel" aria-labelledby="forum-tab">
                                    <div class="mb-4">
                                        <h3 class="mb-2">Forum & Discussion</h3>
                                        <p>
                                            <hr>
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="table-responsive">
                                                    <table id="dataTableBasic" class="table table-sm table-hover display no-wrap shadow" style="width:100%">
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th width="10px">No.</th>
                                                                <th>Topic</th>
                                                                <th width="10px">&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="align-middle">
                                                            <?php
                                                            $queryTopicforum = $conn->query("SELECT * FROM forum_topic_course 
                                                                                                     WHERE ftc_created_by = '$createdby' AND ftc_course_id = '$courseID'");

                                                            $num = 1;
                                                            if (mysqli_num_rows($queryTopicforum) > 0) {
                                                                while ($row = mysqli_fetch_object($queryTopicforum)) {
                                                            ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $num++; ?>.</td>
                                                                        <td><?php echo $row->ftc_topic_name; ?></td>
                                                                        <td class="text-center">
                                                                            <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="forum-discussion-course.php?topicid=<?php echo $row->ftc_id; ?>&creator=<?php echo $createdby; ?>" title="Start Forum">
                                                                                <i class="mdi mdi-magnify fs-5" aria-hidden="true"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
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
                                    <div class="collapse show" id="overview" data-bs-parent="#courseAccordion">
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
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;" data-id="desc">
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
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none pe-auto" style="cursor: pointer;" data-id="prog">
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
                                                <a class="d-flex justify-content-between align-items-center text-inherit text-decoration-none pe-auto" style="cursor: pointer;" data-id="forum">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-comment-multiple-outline fs-4"></i>
                                                        </span>
                                                        <span>Forum & Discussion</span>
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
                                    <div class="collapse " id="material" data-bs-parent="#courseAccordion">
                                        <!-- List group item -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0" aria-disabled="true"></li>
                                            <!-- Videos list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=video" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
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
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=note" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-notebook fs-4"></i>
                                                        </span>
                                                        <span>Note</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Slides list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=slide" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-white icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-file-powerpoint fs-4"></i>
                                                        </span>
                                                        <span>Slide</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Tutorials list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=tutor" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-pencil fs-4"></i>
                                                        </span>
                                                        <span>Tutorial</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Quiz list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=quiz" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-chat-question fs-4"></i>
                                                        </span>
                                                        <span>Quiz</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Assignment list items -->
                                            <!-- <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=asgmt"
                                                    class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white]
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-file-document-edit fs-4"></i>
                                                        </span>
                                                        <span>Assignment</span>
                                                    </div>
                                                </a>
                                            </li> -->
                                            <!-- Project list items -->
                                            <!-- <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=proj"
                                                    class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-progress-wrench fs-4"></i>
                                                        </span>
                                                        <span>Project</span>
                                                    </div>
                                                </a>
                                            </li> -->
                                            <!-- Test list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="course-learning-material.php?course_id=<?= $courseID ?>&amp;pill=test" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
                                                    <div class="text-truncate">
                                                        <!-- ## available topics = change [bg-light -> bg-success], and [text-secondary -> text-white] -->
                                                        <span class="icon-shape bg-success text-light icon-sm rounded-circle me-2">
                                                            <i class="mdi mdi-clipboard-clock fs-4"></i>
                                                        </span>
                                                        <span>Test</span>
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
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Chat JS -->
    <script src="js/student-chat.js"></script>

    <!-- For navigation -->
    <script type="text/javascript">
        // Tab navigation.
        $("#tab > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?course_id=<?= $courseID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);
        });

        // Sidebar navigation.
        $("#overview > ul > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?course_id=<?= $courseID ?>&pill=" + id;

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