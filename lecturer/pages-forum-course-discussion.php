<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('lecturer-function.php');

$lecturer_id = $_SESSION['sess_lecturerid'];

$checkuserrow = $conn->query("SELECT lecturer_user_id from lecturer where lecturer_id = '$lecturer_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->lecturer_user_id;

$topic_id = $_GET['topic_id'];

?>
<style>
    .badge {
  
    white-space:normal;
    text-align:justify;

}
</style>
<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'forumcourse';
        include('pages-sidebar.php');
        ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';
            ?>
            <!-- Container fluid -->

            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page Header -->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">


                                <h1 class="mb-1 h2 fw-bold">Forum</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">Forum Topic</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>

                            <div>

                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-forum-course.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                $queryforummessage = $conn->query("SELECT * FROM forum_post_course
                                                                              WHERE fpc_topic_id = '$topic_id' AND fpc_instructor = '$get_userID';");

                $num = 1;
                if (mysqli_num_rows($queryforummessage) > 0) {
                    while ($rows = mysqli_fetch_object($queryforummessage)) {
                        $fpc_id = $rows->fpc_id;
                ?>

                        <div class=" py-3">

                            <div class="badge bg-info">
                                <h3 class="text-white text-middle"><?php echo $rows->fpc_message; ?></h3>
                            </div>
                        </div>

                        <a class="btn btn-sm btn-outline-warning waves-effect waves-light" href="#" data-bs-toggle="modal" title="Edit Topic" data-bs-target="#editForumMessage<?php echo $fpc_id; ?>">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            Edit</a>

                        <!-- Start Modal Page -->
                        <div class="modal fade" id="editForumMessage<?php echo $fpc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editforummessage" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editforummessage">Edit Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <div class="modal-body">

                                            <input type="hidden" name="fpc_id" value="<?php echo $fpc_id; ?>">
                                            <input type="hidden" name="fpc_topic_id" value="<?php echo $topic_id; ?>">
                                            <input type="hidden" name="fpc_instructor" value="<?php echo $get_userID; ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Message :</label>
                                                <textarea class="form-control" name="new_forum_message" id="forummessage_<?php echo $fpc_id; ?>"><?php echo $rows->fpc_message; ?></textarea>

                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#forummessage_<?php echo $rows->fpc_id; ?>'), {
                                                            autoParagraph: false

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
                                            <button type="submit" class="btn btn-success btn-sm" name="edit_forum_message">Submit</button>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- End Modal Page -->

                        <a class="btn btn-sm btn-outline-danger waves-effect waves-light" href="lecturer-function.php?delete_forum_message=<?php echo $fpc_id; ?>&fpc_topic_id=<?php echo $topic_id; ?>&fpc_instructor=<?php echo $get_userID; ?>" title="Delete Topic" onclick="return deleteforummessage()">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            Delete</a>


                    <?php
                    }
                } else {
                    ?>

                    <div class="badge bg-light-danger">
                        <h3 class="text-dark">No post available</h3>
                    </div>
                <?php
                }
                ?>


                <form action="" method="POST" enctype="multipart/form-data" id="mcdetail" class="py-1">
                    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                    <input type="hidden" name="sender_user_id" value="<?php echo $get_userID; ?>">
                    <div class="mb-3">
                        <label class="form-label">Comment :</label>
                        <textarea class="form-control" name="forum_message" required></textarea>

                        <!-- <script>
                            ClassicEditor
                                .create(document.querySelector('#forum'), {

                                })
                                .then(editor => {
                                    window.editor = editor;
                                })
                                .catch(err => {
                                    console.error(err.stack);
                                });
                        </script> -->
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm" name="add_forum_message">Post</button>

                    </div>
                </form>

                <hr>



            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function deleteforummessage() {
            var x = confirm("Are you sure want to delete this message?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>