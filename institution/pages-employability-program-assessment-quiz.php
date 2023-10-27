<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include '../database/dbcon.php';
include('institution-function.php');

$institution_id = $_SESSION['sess_institutionid'];
$ep_id = $_GET['cid'];
$epq_id = $_GET['cq_id'];


?>



<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'announcement';
        include 'pages-sidebar.php';
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
                                <?php $queryquiz = $conn->query("SELECT * FROM employability_program_quiz WHERE epq_id = '$epq_id'");
                                if ($queryquiz->num_rows > 0) {
                                    $row_header = $queryquiz->fetch_object();
                                } ?>
                                <h1 class="mb-1 h2 fw-bold">Question List</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="pages-course-list.php">Course</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Course Assessment</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Add Quiz Question</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>

                                <a class="btn btn-sm btn-secondary waves-effect waves-light" href="pages-employability-program-content-assessment.php?cid=<?php echo $ep_id; ?>">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- basic table -->
                    <div class="col-md-12 col-12 mb-5">
                        <div class="card smooth-shadow-md">
                            <!-- table  -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h4 class="card-title">Question List</h4>
                                    </div>
                                    <h2><strong class="text-info "><?php echo $row_header->epq_title; ?></strong></h2>
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addQuestion">
                                            <i class="fas fa-plus-square me-1 fs-5"></i> Add Question</button>
                                    </div>
                                </div>
                                <table id="dataTableBasic1" class="table table-sm table-bordered table-hover display no-wrap" style="width:100%">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th width="5px">No.</th>
                                            <th width="200px">Question Type</th>
                                            <th>Question</th>
                                            <th>Right Answer</th>

                                            <!-- <th width="160px">&nbsp;</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <?php
                                        // "SELECT * from employability_program_quiz_question 
                                        // LEFT JOIN employability_program_quiz_answer ON employability_program_quiz_question.epqq_id = employability_program_quiz_answer.epqa_epq_id
                                        // WHERE employability_program_quiz_answer.epq_id  = $epq_id"

                                        $queryquizquestion = $conn->query("SELECT * from employability_program_quiz_question LEFT JOIN employability_program_quiz_answer ON employability_program_quiz_question.epqq_id = employability_program_quiz_answer.epqa_epq_id WHERE employability_program_quiz_question.epq_ep_id =  $epq_id;");

                                        $num = 1;
                                        if (mysqli_num_rows($queryquizquestion) > 0) {
                                            while ($rows = mysqli_fetch_object($queryquizquestion)) {
                                        ?>

                                                <tr>
                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                    <td class="text-center"><?php echo $rows->epqq_type; ?></td>
                                                    <td>
                                                        <p class="align-middle"><?php echo $rows->epqq_question; ?></p>
                                                    </td>
                                                    <td><?php echo $rows->epqa_right_answerword; ?></td>

                                                    <td class="text-center ">
                                                        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editquestion<?php echo $rows->epqq_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</button></a>
                                                        <a class="btn btn-sm btn-danger" href="institution-function.php?delete_course_quiz_question=<?php echo $rows->epqq_id; ?>&cquestion_answer=<?php echo $rows->epqa_id; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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
                </div>

                <!-- Start Modal Page For Add Question -->
                <div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="questionmodal"><?php echo $epq_id ?>Create Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data" id="addquestion" autocomplete="off">
                                    <input type="hidden" name="course_id" value="<?php echo $ep_id; ?>">
                                    <input type="hidden" name="cq_id" value="<?php echo $epq_id; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Question Type:</label>
                                        <select class="selectpicker " data-width="100%" name="cq_question_type" id="cq_question_type" onchange="showDiv(this)" required>
                                            <option value="Multiple Choice">Multiple Choice</option>
                                            <option value="True/False">True or False</option>

                                        </select>
                                        <small><i> * Select Question Type </i></small>
                                    </div>
                                    <div class="mb-3">

                                        <label class="form-label">Question :</label>
                                        <textarea class="form-control" name="cq_question" id="editornewquestion"></textarea>

                                        <script>
                                            ClassicEditor
                                                .create(document.querySelector('#editornewquestion'), {

                                                })
                                                .then(editor => {
                                                    window.editor = editor;
                                                })
                                                .catch(err => {
                                                    console.error(err.stack);
                                                });
                                        </script>
                                    </div>
                                    <div>
                                        <label class="form-label">Answers:</label>
                                        <div id="mcq">
                                            <div class="table-responsive">
                                                <table class="table table-bordered no-wrap table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50px">Correct Answer</th>
                                                            <th>Answers</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="1" name="answermulchoice" id="multi" checked>
                                                                </ul>
                                                            </td>

                                                            <td>
                                                                <input type="text" name="question_answer1" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="2" name="answermulchoice" id="multi1">
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="question_answer2" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="3" name="answermulchoice" id="multi2">
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="question_answer3" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="4" name="answermulchoice" id="multi3">
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="question_answer4" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="tf" style="display:none">
                                            <div class="table-responsive">
                                                <table class="table table-bordered no-wrap table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50px">Correct Answer</th>
                                                            <th>Answers</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="5" name="tf_answer" id="multi4" checked>
                                                                </ul>
                                                            </td>

                                                            <td>
                                                                <input type="text" name="question_answer5" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="6" name="tf_answer" id="multi5">
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="question_answer6" placeholder="Answer" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm" name="add_course_quiz_question">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- End Modal Page For Add Question -->


                <?php
                // "SELECT * from employability_program_quiz_question  
                // LEFT JOIN employability_program_quiz_answer ON epqq_id  = employability_program_quiz_answer.epqa_ep_id 
                // WHERE epq_ep_id = $epq_id "
                
                $queryquizquestion1 = $conn->query("SELECT * from employability_program_quiz_question 
                                    LEFT JOIN employability_program_quiz_answer 
                                    ON epqq_id = employability_program_quiz_answer.epqa_epq_id 
                                    WHERE epq_ep_id = $epq_id");
                $num = 1;
                while ($row1 = mysqli_fetch_object($queryquizquestion1)) {

                ?>

                    <!-- Start Modal Page For Edit Question -->
                    <div class="modal fade" id="editquestion<?php echo $row1->epqq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="questionmodal">Edit Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addquestion" autocomplete="off">
                                        <input type="hidden" name="course_id" value="<?php echo $ep_id; ?>">
                                        <input type="text" name="cq_id" value="<?php echo $epq_id; ?>">
                                        <input type="hidden" name="epqq_id" value="<?php echo $row1->epqq_id; ?>">
                                        <input type="hidden" name="epqa_id" value="<?php echo $row1->epqa_id; ?>">
                                        <input type="hidden" name="epqq_type" value="<?php echo $row1->epqq_type; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Question Type:</label>
                                            <select class="selectpicker " data-width="100%" disabled>
                                                <option value="<?php echo $row1->cqq_type; ?>" <?php if ($row1->epqq_type == "Multiple Choice") {
                                                                                                    echo "selected";
                                                                                                } else {
                                                                                                } ?>><?php echo $row1->epqq_type; ?></option>
                                                <option value="<?php echo $row1->cqq_type; ?>" <?php if ($row1->epqq_type == "True/False") {
                                                                                                    echo "selected";
                                                                                                } else {
                                                                                                } ?>><?php echo $row1->epqq_type; ?></option>

                                            </select>

                                        </div>
                                        <div class="mb-3">

                                            <label class="form-label">Question :</label>
                                            <textarea class="form-control" name="new_cq_question" id="editornewquestion<?php echo $row1->epqq_id; ?>"><?php echo $row1->epqq_question; ?></textarea>

                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editornewquestion<?php echo $row1->epqq_id; ?>'), {

                                                    })
                                                    .then(editor => {
                                                        window.editor = editor;
                                                    })
                                                    .catch(err => {
                                                        console.error(err.stack);
                                                    });
                                            </script>
                                        </div>

                                        <?php if ($row1->epqq_type == 'Multiple Choice') { ?>
                                            <div>
                                                <label class="form-label">Answers:</label>

                                                <table class="table table-bordered no-wrap table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50px">Correct Answer</th>
                                                            <th>Answers</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="1" name="new_answermulchoice" <?php if ($row1->epqa_right_answer == "1") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                                                </ul>
                                                            </td>

                                                            <td>
                                                                <input type="text" name="new_question_answer1" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer1; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="2" name="new_answermulchoice" <?php if ($row1->epqa_right_answer == "2") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="new_question_answer2" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer2; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="3" name="new_answermulchoice" <?php if ($row1->epqa_right_answer == "3") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="new_question_answer3" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer3; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="4" name="new_answermulchoice" <?php if ($row1->epqa_right_answer == "4") {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="new_question_answer4" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer4; ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } elseif ($row1->epqq_type == 'True/False') {  ?>
                                            <div>
                                                <label class="form-label">Answers:</label>

                                                <table class="table table-bordered no-wrap table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50px">Correct Answer</th>
                                                            <th>Answers</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="5" name="new_answertf" <?php if ($row1->epqa_right_answer == "5") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                                </ul>
                                                            </td>

                                                            <td>
                                                                <input type="text" name="new_question_answer5" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer1; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <input type="radio" class="check" value="6" name="new_answertf" <?php if ($row1->epqa_right_answer == "6") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="new_question_answer6" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->epqa_answer2; ?>">
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php  } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="edit_ep_quiz_question">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- End Modal Page For Edit Question -->


            </div>
        </div>
    </div>
    <!-- Script -->
    <!-- Libs JS -->

    <script>
        function deletequestion() {
            var x = confirm("Are you sure want to delete this question?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }

        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('#dataTableBasic1').DataTable();

        });

        function showDiv(select) {
            if (select.value == 'Multiple Choice') {
                // document.getElementById('mcq').style.display = "block";
                // document.getElementById('tf').style.display = "none";
                $('#mcq').show();
                $('#tf').hide();
            } else if (select.value == 'True/False') {
                // document.getElementById('mcq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $('#tf').show();
                $('#mcq').hide()
            }
        }
    </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>