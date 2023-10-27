<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>


<body>
    <?php
    include('pages-topbar.php');
    $topic_id = $_GET['topicid'];
    $created_by = $_GET['creator'];

    $suID = $_SESSION['sess_studentid'];
    $queryUserId = $conn->query("SELECT su_user_id from student_university WHERE su_id = '$suID';");
    $rowReadUser = $queryUserId->fetch_object();
    $get_userID = $rowReadUser->su_user_id;


    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php
                $queryforummessage = $conn->query("SELECT * FROM forum_post_course
                                                                       LEFT JOIN user ON fpc_instructor = user.user_id                                                 
                                                                       WHERE fpc_topic_id = '$topic_id' 
                                                                       AND fpc_instructor = '$created_by'
                                                                       AND fpc_student IS NULL;");

                $num = 1;
                if (mysqli_num_rows($queryforummessage) > 0) {
                    while ($rows = mysqli_fetch_object($queryforummessage)) {

                ?>

                        <?php if ($rows->user_role_id == '1') {

                            $queryadmin = $conn->query("SELECT * FROM admin 
                                                        LEFT JOIN user ON admin_user_id = user.user_id                                                 
                                                        WHERE user.user_id = '$created_by';");
                            $rowReadinfo = $queryadmin->fetch_object();

                        ?>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="d-flex flex-start align-items-center">
                                        <?php if ($rowReadinfo->admin_logo != NULL) { ?>
                                            <div class="me-3">
                                                <img src="../assets/images/avatar/<?php echo $rowReadinfolect->lecturer_profile_picture; ?>" alt="" class="rounded-circle avatar-md me-3" />
                                            </div>
                                        <?php } else { ?>
                                            <div class="me-3">
                                                <img src="../assets/images/avatar/avatardefault.png" alt="" class="rounded-circle avatar-md me-3" />
                                            </div>
                                        <?php } ?>
                                        <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true"><?php echo $rowReadinfo->admin_name; ?></a>
                                            <div class="text-muted small"> <?php echo date('j F Y H:i:s', strtotime($rows->fpc_created_date)) ?></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="fw-bold text-dark mb-1"><?php echo $rows->fpc_message; ?></p>

                                </div>

                            <?php } else {
                        } ?>

                            <?php
                            $queryforummessage = $conn->query("SELECT * FROM forum_post_course
                                                               LEFT JOIN user ON fpc_student = user.user_id
                                                               LEFT JOIN student_university ON user.user_id = student_university.su_user_id 
                                                               WHERE fpc_topic_id = '$topic_id' 
                                                               AND fpc_student = '$get_userID'
                                                               AND fpc_instructor IS NULL;");

                            $num = 1;
                            if (mysqli_num_rows($queryforummessage) == 0) {


                            ?>

                                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                    <div class="px-4 pt-3">

                                    </div>
                                    <div class="px-4 pt-3">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addReply">
                                            <i class="mdi mdi-reply fs-5 me-1"></i>
                                            Reply</button>
                                    </div>
                                </div>

                                <!-- Start Modal Page -->
                                <div class="modal fade" id="addReply" tabindex="-1" role="dialog" aria-labelledby="replymodal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="replymodal">Add Reply</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data" id="forumreg" autocomplete="off">
                                                    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="textInput">Message :</label>
                                                        <textarea class="form-control" name="forum_reply" id="reply"></textarea>

                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#reply'), {

                                                                })
                                                                .then(editor => {
                                                                    window.editor = editor;
                                                                })
                                                                .catch(err => {
                                                                    console.error(err.stack);
                                                                });
                                                        </script>

                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-sm" name="add_forum_reply">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- End Modal Page -->
                            <?php } else {
                            } ?>


                        <?php
                    }
                } else {
                        ?>

                        <div class="card mb-3">
                            <div class="row mb-3 mt-6 justify-content-center">
                                <div class="col-lg-10 col-md-12 col-12 text-center">
                                    <h3 class="mb-2 display-5 fw-bold">No post from instructor</h3>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                    ?>

                            </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Form -->
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <div class="mb-1">
                                <h3 class="mb-0">Replies</h3>

                            </div>
                            <div>

                            </div>
                        </div>



                        <?php
                        $queryforummessage = $conn->query("SELECT * FROM forum_post_course
                                                               LEFT JOIN user ON fpc_student = user.user_id
                                                               LEFT JOIN student_university ON user.user_id = student_university.su_user_id 
                                                               WHERE fpc_topic_id = '$topic_id' 
                                                               AND fpc_instructor IS NULL;");

                        $num = 1;
                        if (mysqli_num_rows($queryforummessage) > 0) {
                            while ($rows = mysqli_fetch_object($queryforummessage)) {

                        ?>

                                <hr>

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex ">
                                        <?php if ($rows->su_profile_pic != NULL) { ?>
                                            <img src="../assets/images/avatar/<?php echo $rows->su_profile_pic; ?>" alt="" class="rounded-circle avatar-lg" />
                                        <?php } else { ?>
                                            <img src="../assets/images/avatar/avatardefault.png" alt="" class="rounded-circle avatar-lg" />
                                        <?php } ?>
                                        <div class="mt-2 ms-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h4 class="mb-0 text-secondary"><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></h4>
                                                    <span class="text-muted fs-6"><?php echo date('j/m/Y H:i:s', strtotime($rows->fpc_created_date)) ?></span>
                                                </div>
                                                <div>

                                                </div>

                                            </div>
                                            <div class="mt-1">
                                                <h5><?php echo $rows->fpc_message; ?></h5>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- <?php if ($rows->fpc_student == $get_userID) { ?>
                                        <div class="mt-1 m-2">
                                            <span class="dropdown dropstart">
                                                <a class="icon-shape bg-info text-white icon-sm rounded-circle me-2" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                    <i class="fe fe-more-vertical text-white"></i></a>
                                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>

                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editreply<?php echo $rows->fpc_id; ?>">
                                                        <i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                                    <a class="dropdown-item" href="function/student-function.php?delete_reply=<?php echo $rows->fpc_id; ?>&topic_id=<?php echo $rows->fpc_topic_id; ?>&suid=<?php echo $get_userID; ?>" title="Delete Course" onclick="return deletereply()">
                                                        <i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                                </span>
                                            </span>
                                        </div> -->

                                        <!-- Start Modal Page -->
                                        <!-- <div class="modal fade" id="editreply<?php echo $rows->fpc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editreplymodal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editreplymodal">Edit Reply</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data" id="forumreg" autocomplete="off">
                                                            <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                                                            <input type="hidden" name="student_user_id" value="<?php echo $get_userID; ?>">
                                                            <input type="hidden" name="fpc_id" value="<?php echo $rows->fpc_id; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="textInput">Message :</label>
                                                                <textarea class="form-control" name="new_forum_reply" id="new_reply"><?php echo $rows->fpc_message; ?></textarea>

                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_reply'), {

                                                                        })
                                                                        .then(editor => {
                                                                            window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                            console.error(err.stack);
                                                                        });
                                                                </script>

                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm" name="add_new_forum_reply">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div> -->
                                        <!-- End Modal Page -->

                                    <!-- <?php } else {
                                    } ?> -->

                                </div>


                            <?php
                            }
                        } else {
                            ?>
                            <hr>
                            <!-- <div class="badge bg-light-danger">
                                    <h3 class="text-dark">No reply available</h3>
                                </div> -->
                            <div class="row mb-3 mt-6 justify-content-center">
                                <div class="col-lg-10 col-md-12 col-12 text-center">
                                    <h3 class="mb-2 display-5 fw-bold"><i class="mdi mdi-close-box-multiple me-2 text-secondary"></i>No post available</h3>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <?php
    include('pages-footer.php');
    ?>

    <script>
        function deletereply() {
            var x = confirm("Are you sure want to delete this message?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>