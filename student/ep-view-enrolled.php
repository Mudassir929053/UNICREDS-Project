<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body>
    <!-- Top navigation -->
    <?php
    include('pages-topbar.php'); ?>

    <?php
    $epID = $_GET["ep_id"];
    $epData = $epInfo->fetch_employability_program($epID);
    $createdby = $epData["course_created_by"];
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

                                    <!-- Micro-creds institution -->
                                    <li class="mb-1">
                                        <i class="fe fe-user-check me-2" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>
                                        <span class="text-body"><?= $epInfo->check_ep_creator($epData["course_created_by"])['name'] ?></span>

                                    </li>
                                    <li class="mb-1">
                                        <i class="fe fe-book text-success me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                        <span class="text-body">
                                            <?= $epData["ep_category"] !== NULL ? $epData["ep_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                        </span>
                                    </li>

                                </ul>

                                <!-- Employability Program  creator chat -->
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
                                    Review
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
                                        <p style="text-align: justify; text-justify: inter-word;">
                                            <?= $epData["ep_description"] ?>
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
                                                $videoProgress = $epInfo->video_progress($epID);

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
                                                // Display the student university progress for quiz.
                                                $quizProgress = $epInfo->quiz_progress($epID);

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


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Forum & Discussion -->
                                <div class="tab-pane fade <?= $_GET["pill"] === "forum" ? "show active" : "" ?>" id="forum" role="tabpanel" aria-labelledby="forum-tab">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <form action="" method="post">
                                                    <input type="hidden" name="ep_student_id" value="<?php echo $suID; ?>">
                                                    <input type="hidden" name="ep_course_id" value="<?php echo $epID; ?>">
                                                    <h2 class="text-center mb-3">Rate and Review</h2>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="feedback" name="feedback" placeholder="Enter your feedback" required></textarea>
                                                        <label for="feedback">Feedback</label>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="rating">Rating</label>
                                                        <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                                                        <input type="hidden" class="form-control" id="rating-input" name="rating">
                                                    </div>
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary btn-lg" name="add_rate">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="mt-4 container-fluid">
                                            <div class="col-md-6 offset-md-1" >
                                                <div class="row">
                                                    <h2>Course Ratings</h2>
                                                    <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark text-center">
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th width=150px>Rating</th>
                                                                <th width=350px>Review</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            // Assuming $conn is a valid mysqli or PDO database connection object
                                                            $ep_id = $epID; // example course ID

                                                            // Get all ratings for the course
                                                            $query2 = $conn->query("SELECT * FROM ep_rating WHERE ep_course_id = '$ep_id' ORDER BY ep_review_rating ASC");

                                                            // Loop through each rating and display it
                                                            $sno = 1;
                                                            while ($row = mysqli_fetch_assoc($query2)) {
                                                                $rating = $row['ep_review_rating'];
                                                                $review = $row['ep_review'];
                                                                // Generate HTML for the rating stars
                                                                $stars = '';
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $rating) {
                                                                        $stars .= '<i class="fas fa-star text-warning"></i>';
                                                                    } else {
                                                                        $stars .= '<i class="far fa-star text-warning"></i>';
                                                                    }
                                                                }

                                                                echo "<tr><td>$sno</td><td>$stars</td><td>$review</td></tr>";
                                                                $sno++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->
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
                                    <div class="collapse " id="material" data-bs-parent="#courseAccordion">
                                        <!-- List group item -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0" aria-disabled="true"></li>
                                            <!-- Videos list items -->
                                            <li class="list-group-item" aria-disabled="true">
                                                <a href="employability-program-learning-material.php?ep_id=<?= $epID ?>&amp;pill=video" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
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
                                                <a href="employability-program-learning-material.php?ep_id=<?= $epID ?>&amp;pill=note" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
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
                                                <a href="employability-program-learning-material.php?ep_id=<?= $epID ?>&amp;pill=quiz" class="d-flex justify-content-between align-items-center text-inherit text-decoration-none" style="cursor: pointer;">
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
            var link = fileLink.split("?")[0] + "?ep_id=<?= $epID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);
        });

        // Sidebar navigation.
        $("#overview > ul > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?ep_id=<?= $epID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);

            $("#tab > li > a").each(function() {
                var tabID = $(this).data("id");

                // show content if id match.
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function() {
            $(".rateyo").rateYo({
                precision: 0 // set precision to 0 to remove decimal point
            }).on("rateyo.change", function(e, data) {
                var rating = Math.round(data.rating); // round the rating to nearest integer
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('Rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating); // add rounded rating value to input field
            });
        });
    </script>

</body>

</html>