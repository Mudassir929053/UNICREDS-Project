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

$mc_id = $_GET['mc_id'];

?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'forummc';
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

                                <?php $querytopicforummc = $conn->query("SELECT * FROM microcredential WHERE mc_id = '$mc_id'");
                                if ($querytopicforummc->num_rows > 0) {
                                    $row_header = $querytopicforummc->fetch_object();
                                } ?>

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
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addForumTopic">Add New Topic</button>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-forum-mc.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>
                    </div>

                    <!-- Start Modal Page -->
                    <div class="modal fade" id="addForumTopic" tabindex="-1" role="dialog" aria-labelledby="forummodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="forummodal">Add Topic</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="forumreg" autocomplete="off">
                                        <input type="hidden" name="ftm_mc_id" value="<?php echo $mc_id; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $get_userID; ?>">
                                        <div class="mb-3">
                                            <label class="form-label" for="textInput">Topic Name :</label>
                                            <input class="form-control" type="text" name="topic_name" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_topic_forum_mc">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- End Modal Page -->



                </div>
                <div class="">
                    <div class="row">
                        <!-- basic table -->
                        <div class="col-md-12 col-12">
                            <div class="card shadow">
                                <!-- card header  -->

                                <!-- table  -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h4 class="card-title">Forum Topic List</h4>
                                        </div>
                                        <h2><strong class="text-info "><?php echo $row_header->mc_title; ?></strong></h2>
                                        <div>

                                        </div>
                                    </div>
                                    <table id="dataTableBasic" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                        <thead class="bg-gradient bg-info text-white">
                                            <tr class="text-center">
                                                <th scope="col" class="border-0" width="10px">No.</th>
                                                <th scope="col" class="border-0" width="430px">Topic Forum</th>

                                                <th scope="col" class="border-0" width="100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php
                                            $querymctopic = $conn->query("SELECT * FROM forum_topic_mc
                                                                          WHERE ftm_mc_id = '$mc_id' 
                                                                          AND ftm_created_by = '$get_userID';");

                                            $num = 1;
                                            if (mysqli_num_rows($querymctopic) > 0) {
                                                while ($rows = mysqli_fetch_object($querymctopic)) {
                                                    $ftm_id = $rows->ftm_id;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                        <td class="border-top-0"><?php echo $rows->ftm_topic_name; ?></td>

                                                        <td class="text-center">
                                                            <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="pages-forum-mc-discussion.php?topic_id=<?php echo $ftm_id; ?>" title="Start Forum">
                                                                <i class="fas fa-play" aria-hidden="true"></i>
                                                                Start Forum</a>

                                                            <a class="btn btn-sm btn-outline-warning waves-effect waves-light" href="#" data-bs-toggle="modal" title="Edit Topic" data-bs-target="#editForumTopic<?php echo $ftm_id; ?>">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                                Edit</a>


                                                            <a class="btn btn-sm btn-outline-danger waves-effect waves-light" href="lecturer-function.php?delete_forum_topic_mc=<?php echo $ftm_id; ?>&mc_id=<?php echo $mc_id; ?>" title="Delete Topic" onclick="return deleteforumtopic()">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                Delete</a>

                                                        </td>
                                                    </tr>

                                                    <!-- Start Modal Page -->
                                                    <div class="modal fade" id="editForumTopic<?php echo $ftm_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editforummodal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editforummodal">Edit Topic</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                                </div>
                                                                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                    <div class="modal-body">

                                                                        <input type="hidden" name="ftm_id" value="<?php echo $ftm_id; ?>">
                                                                        <input type="hidden" name="ftm_mc_id" value="<?php echo $mc_id; ?>">
                                                                        <input type="hidden" name="user_id" value="<?php echo $get_userID; ?>">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Topic Name :</label>
                                                                            <input class="form-control" type="text" name="new_topic_name" value="<?php echo $rows->ftm_topic_name; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success btn-sm" name="edit_topic_forum_mc">Submit</button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <!-- End Modal Page -->

                                </div>



                            </div>


                        <?php
                                                }
                                            } else {
                        ?>
                    <?php
                                            }
                    ?>

                    </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Script -->

    <script>
        function deleteforumtopic() {
            var x = confirm("Are you sure want to delete this topic?");

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