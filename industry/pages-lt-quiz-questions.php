<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include '../database/dbcon.php';
include 'industry-function.php';
$industry_id = $_SESSION['sess_industryid'];

$lid = $_GET['cid'];

// $stq_type = "";

// @$stq_type = $_SESSION['sqt_type'];

?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'test';
        include 'pages-sidebar.php';
        ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';

            ?>

            <!-- Container fluid -->
            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page Header -->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <?php $queryquiz = $conn->query("SELECT * FROM language_test_question  WHERE ltqq_id = '$lid'");
                                if ($queryquiz->num_rows > 0) {
                                    $row_header = $queryquiz->fetch_object();
                                } ?>
                                <h1 class="mb-1 h2 fw-bold">Question List</h1>

                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Language Test</a>
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
                                <a class="btn btn-sm btn-secondary waves-effect waves-light" href="pages-language-test.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card rounded-3">
                    <!-- Card header -->
                    <div class="card-header border-bottom-0 p-0">
                        <div>
                            <!-- Nav -->
                            <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($stq_type == "Grammar/Vocabulary") {
                                                            echo "active";
                                                        } else if ($stq_type == null) {
                                                            echo "active";
                                                        } ?>" id="note-tab" data-bs-toggle="pill" href="#note" role="tab" aria-controls="note" aria-selected="true">Grammar/Vocabulary</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($stq_type == "Comprehension Passage") {
                                                            echo "active";
                                                        } ?>" id="fileupload-tab" data-bs-toggle="pill" href="#fileupload" role="tab" aria-controls="fileupload" aria-selected="false">Comprehension Passage</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">

                                <!-- basic table -->
                                <div class="tab-pane <?php if ($stq_type == "multiple choice") {
                                                            echo "active";
                                                        } else if ($stq_type == null) {
                                                            echo "active";
                                                        } ?>" id="note" role="tabpanel" aria-labelledby="note-tab">
                                    <div class="bg-light-info rounded p-2 mb-3 shadow">
                                        <div class="card-body bg-white">
                                            <!-- table  -->
                                            <!-- <div class="card-body"> -->
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <h4 class="card-title">Question List</h4>

                                                </div>
                                                <h2><strong class="text-info "></strong></h2>
                                                <div>
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addQuestion">
                                                        <i class="fas fa-plus-square me-1 fs-5"></i> Grammar/Vocabulary</button>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="dataTableBasic1" class="table table-sm table-bordered table-hover display no-wrap" style="width:100%">
                                                    <thead class="bg-info text-white">
                                                        <tr class="text-center">
                                                            <th width="5px">No.</th>
                                                            <th width="100px">Question Type</th>
                                                            <!-- <th width="400px">Comprehension Passage</th> -->
                                                            <th width="400px">Question</th>
                                                            <th width="200px">Answer-1</th>
                                                            <th width="200px">Answer-2</th>
                                                            <th width="200px">Answer-3</th>
                                                            <th width="200px">Answer-4</th>
                                                            <th width="200px">Right Answer</th>
                                                            <th width="200px"> Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php
                                                        $querycq = $conn->query("SELECT * FROM language_test_answer AS LTA
                                        LEFT JOIN language_test_question AS LTQ
                                        ON LTA.lta_id_ltq_id=LTQ.ltq_id
                                        WHERE LTQ.ltqq_id= '$lid' AND LTQ.ltq_id_ltc_id IS NULL ");
                                                        $num = 1;
                                                        if (mysqli_num_rows($querycq) > 0) {
                                                            while ($rows = mysqli_fetch_object($querycq)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="text-center"><?php echo $rows->ltq_question_type; ?></td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->ltq_question, 0, 20))) ?>...
                                                                        <button type="button" class="btn btn-link btn-sm btn-gradient-05 wordwrap" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->ltq_id; ?>" aria-expanded="true" aria-controls="modalView">
                                                                            <span class="btn btn-sm  btn-link">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <!-- Modal for More -->
                                                                    <div class="modal fade" id="modalView<?php echo $rows->ltq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobdesc" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Grammar/Vocabulary Question</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h5 class="text-justify"><?php echo $rows->ltq_question ?></h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal for More END -->
                                                                    <td class="wide">
                                                                        <?php echo $rows->lta_answer1; ?>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?php echo $rows->lta_answer2; ?>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?php echo $rows->lta_answer3; ?>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?php echo $rows->lta_answer4; ?>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?php echo $rows->lta_right_answerword; ?>
                                                                    </td>
                                                                    <td class="text-center ">
                                                                        <a class="px-3 fa-lg text-info" data-bs-toggle="modal" data-bs-target="#editquestiongv<?php echo $rows->ltq_id; ?>"><i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                                        <a class="px-3 fa-lg text-danger" href="industry-function.php?delete_language_test_question=<?php echo $rows->ltq_id; ?>&delete_language_test_answer=<?php echo $rows->lta_id; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true" data-bs-toggle="tooltip" data-placement="top" title="Delete"></i> </a>
                                                                    </td>
                                                                </tr>
                                                                <!-- Modal for More -->

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
                                <!-- </div> -->

                                <!-- ************************************************END OF Grammar/Vocabulary*********************************************** -->

                                <!-- *************************************************Comprehension Passage*************************************************** -->
                                <div class="tab-pane <?php if ($stq_type == "fileupload") {
                                                            echo "active";
                                                        } ?>" id="fileupload" role="tabpanel" aria-labelledby="fileupload-tab">
                                    <div class="bg-light-info rounded p-2 mb-3 shadow">
                                        <div class="card-body bg-white">

                                            <!-- table  -->
                                            <!-- <div class="card-body"> -->
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <h4 class="card-title">Question List</h4>
                                                </div>
                                                <h2><strong class="text-info "></strong></h2>
                                                <div>
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addpassage">
                                                        <i class="fas fa-plus-square me-1 fs-5"></i> Comprehension Passage</button>
                                                </div>
                                            </div>
                                            <!-- ****************************************Accordion************************************************ -->
                                            <?php



                                            $queryquizquestion = $conn->query("SELECT * FROM language_test_answer AS LTA LEFT JOIN language_test_question AS LTQ ON LTA.lta_id_ltq_id=LTQ.ltq_id LEFT JOIN language_test_comp_pasage AS LTP ON LTP.ltcp_id=LTQ.ltq_id_ltc_id WHERE LTP.test_id='$lid' AND LTQ.ltq_id_ltc_id IS NOT NULL GROUP BY LTP.ltcp_id; ");
                                            if (mysqli_num_rows($queryquizquestion) > 0) {
                                                $num1 = 1;
                                                while ($rows = mysqli_fetch_object($queryquizquestion)) {
                                            ?>
                                                    <div class="col-lg-12">

                                                        <div class="accordion accordion-flush border my-2" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="flush-heading" style="cursor: default !important;">
                                                                    <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree<?php echo $rows->ltcp_id; ?>" aria-expanded="false" aria-controls="flush-collapseThree">
                                                                        <?php echo $num1++; ?>.&nbsp
                                                                        <?= (strip_tags(substr($rows->ltcp_passage, 0, 50))) ?>... &nbsp; &nbsp; &nbsp; &nbsp;

                                                                        <div class="dropdown dropstart dropend">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <span>
                                                                                    <i class="bi bi-three-dots-vertical fs-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Options"></i>
                                                                                </span>
                                                                            </a>
                                                                            <ul class="dropdown-menu" aria-labelledby="courseDropdown">
                                                                                <li>
                                                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editpassage<?php echo $rows->ltcp_id; ?>">
                                                                                        <i class="bi bi-pencil-square text-info me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>Edit
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="industry-function.php?delete_language_test_question_for_passage=<?php echo $rows->ltq_id; ?>&delete_language_test_answer_for_passage=<?php echo $rows->lta_id; ?>&delete_language_test_passage=<?php echo $rows->ltcp_id; ?>" onclick="return deletequestion1()">
                                                                                        <i class="bi bi-trash-fill text-danger me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>Delete
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="languagetest-questions-preview.php?cid=<?php echo $lid ?>&pid=<?php echo $rows->ltcp_id; ?>">
                                                                                        <i class="bi bi-eye-fill me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview"></i>Preview
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                    </span>

                                                                    <!-- <button  class="btn fa fa-edit text-primary btn-save" 
                                                                data-bs-target="#editpassage<?php echo $rows->ltcp_id; ?>"></button> -->
                                                                </h2>

                                                                <div id="flush-collapseThree<?php echo $rows->ltcp_id; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <?php $lip_id = [$rows->ltcp_id]; ?>
                                                                        <?= (strip_tags(substr($rows->ltcp_passage, 0, 150))) ?>...
                                                                        <button type="button" class="btn btn-link btn-sm btn-gradient-05 wordwrap" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->ltcp_id; ?>" aria-expanded="true" aria-controls="modalView">
                                                                            <span class="btn btn-sm  btn-link">Read More</span>
                                                                        </button>
                                                                        <!-- Modal for More -->
                                                                        <div class="modal fade" id="modalView<?php echo $rows->ltcp_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobdesc" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Comprehension Passage</h4>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <h5 class="text-justify"><?php echo $rows->ltcp_passage ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Modal for More END -->
                                                                        <div class="content bg-light p-5">
                                                                            <div class="row ">
                                                                                <div class="table-responsive">
                                                                                    <table id="dataTableBasic2" class="table text-center table-bordered table-sm table-hover" style="width:100%">
                                                                                        <thead class="bg-info  text-white">
                                                                                            <tr class="text-center">
                                                                                                <th width="5px">No.</th>
                                                                                                <th width="100px">Question Type</th>
                                                                                                <th width="400px">Question</th>
                                                                                                <th width="400px">Right Answer</th>
                                                                                                <th width="200px">Question Action</th>

                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody class="align-middle">
                                                                                            <?php $dpid = $rows->ltcp_id; ?>

                                                                                            <?php
                                                                                            $querycq = $conn->query("SELECT * FROM language_test_answer AS LTA LEFT JOIN language_test_question AS LTQ ON LTA.lta_id_ltq_id=LTQ.ltq_id LEFT JOIN language_test_comp_pasage AS LTP ON LTP.ltcp_id=LTQ.ltq_id_ltc_id WHERE LTQ.ltq_id_ltc_id='$dpid' AND LTQ.ltq_id_ltc_id IS NOT NULL;");
                                                                                            $num = 1;
                                                                                            if (mysqli_num_rows($querycq) > 0) {
                                                                                                while ($rows = mysqli_fetch_object($querycq)) {
                                                                                            ?>
                                                                                                    <tr>

                                                                                                        <td class="text-center"><?php echo $num++; ?></td>

                                                                                                        <td class="text-center"><?php echo $rows->ltq_question_type; ?></td>

                                                                                                        <td class="wide">
                                                                                                            <?php echo $rows->ltq_question; ?>
                                                                                                        </td>
                                                                                                        <td class="wide">
                                                                                                            <?php echo $rows->lta_right_answerword; ?>
                                                                                                        </td>

                                                                                                        <td class="text-center">
                                                                                                            <button type="button" class="btn btn-sm mx-2 btn-warning" data-bs-toggle="modal" data-bs-target="#editquestioncp<?php echo $rows->ltq_id; ?>">
                                                                                                                <i class="fa fa-edit me-1" aria-hidden="true"></i>Edit</button>
                                                                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_language_test_question=<?php echo $rows->ltq_id; ?>&delete_language_test_answer=<?php echo $rows->lta_id; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash me-1" aria-hidden="true"></i>Delete</a>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                                    ?>
                                                <?php
                                            }
                                                ?>

                                                    </div>

                                                    <!-- **************************************************************************************** -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Modal Page For Add Question -->
            <div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="questionmodal">Create Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data" id="addquestion" autocomplete="off">

                                <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">
                                <div class="mb-3">
                                    <label class="form-label">Question Type:</label>
                                    <select class="selectpicker " data-width="100%" name="ltqq_type" id="ltqq_type" onchange="showDiv(this)" required>
                                        <option value="Multiple Choice Question">Multiple Choice Question</option>
                                        <option value="Fill In The Blank">Fill In The Blank</option>
                                        <option value="Short Answers">Short Answers</option>

                                    </select>
                                    <small><i> * Select Question Type </i></small>
                                </div>
                                <div class="mb-3">

                                    <label class="form-label">Question :</label>
                                    <textarea class="form-control" name="ltqq_question" id="editornewquestionq1"></textarea>

                                    <script>
                                        ClassicEditor
                                            .create(document.querySelector('#editornewquestionq1'), {

                                            })
                                            .then(editor => {
                                                window.editor = editor;
                                            })
                                            .catch(err => {
                                                console.error(err.stack);
                                            });
                                    </script>
                                </div>


                                <div id="mltq">
                                    <div class="table-responsive">
                                        <table class="table table-bordered no-wrap table-hover">
                                            <tbody>
                                                <tr>
                                                    <th width="120px">
                                                        Option-1
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer1" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Option-2
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer2" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Option-3
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer3" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Option-4
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer4" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr style="background-color: lightblue;">
                                                    <th>
                                                        Correct Answer
                                                    </th>
                                                    <td>
                                                        <select name="answermulchoice" class="form-control form-control-sm custom-select">
                                                            <option value="" selected>Choose...</option>
                                                            <option value="1">Option-1</option>
                                                            <option value="2">Option-2</option>
                                                            <option value="3">Option-3</option>
                                                            <option value="4">Option-4</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tf" style="display:none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered no-wrap table-hover">
                                            <tbody>
                                                <tr>
                                                    <th width="120px">
                                                        Option-1
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer5" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Option-2
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer6" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr style="background-color: lightblue;">
                                                    <th>
                                                        Correct Answer
                                                    </th>
                                                    <td>
                                                        <select name="tf_answer" class="form-control form-control-sm">
                                                            <option value="" selected>Choose...</option>
                                                            <option value="5">Option-1</option>
                                                            <option value="6">Option-2</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="sa" style="display:none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered no-wrap table-hover">
                                            <tbody>
                                                <tr style="background-color: lightblue;">
                                                    <th width="120px">
                                                        Answer
                                                    </th>
                                                    <td>
                                                        <input type="text" name="question_answer7" placeholder="Type Answer Here" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" name="add_language_test_quiz_question">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Start Modal Page For Edit Grammar/Vocabulary Question -->





            <!-- End Modal Page For Edit Grammar/Vocabulary Question -->

            <!------------------------------------ Start  Passage For Add Question -------------------------------------->
            <div class="modal fade" id="addpassage" tabindex="-1" role="dialog" aria-labelledby="questionmodal1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="questionmodal1">Comprehension Passage</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data" id="addpassage" autocomplete="on" onsubmit="disableHiddenFields();">

                                <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <h4>Passage :</h4>
                                    </label>
                                    <textarea class="form-control" name="ltqq_passage" id="editorpassage" placeholder="Type Passage Here"></textarea>

                                    <script>
                                        ClassicEditor
                                            .create(document.querySelector('#editorpassage'), {

                                            })
                                            .then(editor => {
                                                window.editor = editor;
                                            })
                                            .catch(err => {
                                                console.error(err.stack);
                                            });
                                    </script>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <div class="paste-new-forms1"></div>
                                            <a href="javascript:void(0)" class="add-more-form1 float-start  btn btn-outline-success btn-sm">
                                                <span>Multiple Choice Question</span>
                                            </a>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <div class="paste-new-forms2"></div>
                                            <a href="javascript:void(0)" class="add-more-form2 float-start  btn btn-outline-success btn-sm">
                                                <span>Fill In The Blank</span>
                                            </a>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <div class="paste-new-forms3"></div>
                                            <a href="javascript:void(0)" class="add-more-form3 float-start  btn btn-outline-success btn-sm">
                                                <span>Short Answers</span>
                                            </a>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" value="Submit" name="add_language_test_passage_question">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById("addpassage").addEventListener("submit", function(event) {
                    if (document.getElementById("addpassage").style.display !== "none" && !validateForm()) {
                        event.preventDefault();
                    }
                });

                function validateForm() {
                    var textareas = document.getElementsByClassName("required");
                    var isValid = true;
                    for (var i = 0; i < textareas.length; i++) {
                        if (textareas[i].value == "") {
                            alert("Please fill atleast one MCQ & passage required fields.");
                            isValid = false;
                            break;
                        }
                    }
                    return isValid;
                }
            </script>


            <script>
                function disableHiddenFields() {
                    // Get the form fields
                    var fillInTheBlank = document.getElementById("panelsStayOpen-collapseTwo");
                    var shortAnswers = document.getElementById("panelsStayOpen-collapse3");
                    var multipleChoice = document.getElementById("panelsStayOpen-collapseOne");

                    // Disable the fields if they are hidden
                    if (fillInTheBlank.style.display === "none") {
                        var fillInTheBlankFields = fillInTheBlank.getElementsByTagName("input");
                        for (var i = 0; i < fillInTheBlankFields.length; i++) {
                            fillInTheBlankFields[i].disabled = true;
                        }
                    }

                    if (shortAnswers.style.display === "none") {
                        var shortAnswersFields = shortAnswers.getElementsByTagName("input");
                        for (var i = 0; i < shortAnswersFields.length; i++) {
                            shortAnswersFields[i].disabled = true;
                        }
                    }

                    if (multipleChoice.style.display === "none") {
                        var multipleChoiceFields = multipleChoice.getElementsByTagName("input");
                        for (var i = 0; i < multipleChoiceFields.length; i++) {
                            multipleChoiceFields[i].disabled = true;
                        }
                    }
                }
            </script>


            <!-- End Modal Page For Add Question -->



            <?php
            $querycq = $conn->query("SELECT * FROM language_test_answer AS LTA
            LEFT JOIN language_test_question AS LTQ
            ON LTA.lta_id_ltq_id=LTQ.ltq_id
            WHERE LTQ.ltqq_id= '$lid' AND LTQ.ltq_id_ltc_id IS NULL  AND LTA.lta_id_ltq_id=LTQ.ltq_id");

            $num = 1;
            if (mysqli_num_rows($querycq) > 0) {
                while ($row1 = mysqli_fetch_object($querycq)) {


                    $selectedOption = '';
                    if ($row1->lta_answer1 == $row1->lta_right_answerword) {
                        $selectedOption = '1';
                    } elseif ($row1->lta_answer2 == $row1->lta_right_answerword) {
                        $selectedOption = '2';
                    } elseif ($row1->lta_answer3 == $row1->lta_right_answerword) {
                        $selectedOption = '3';
                    } elseif ($row1->lta_answer4 == $row1->lta_right_answerword) {
                        $selectedOption = '4';
                    }

            ?>

                    <!-----------------------*************Edit Question Start**************************************------------------------------------------------->
                    <div class="modal fade" id="editquestiongv<?php echo $row1->ltq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="questionmodal">Edit Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="editquestion">
                                        <input type="hidden" name="ltq_question_type" value="<?php echo $row1->ltq_question_type; ?>">
                                        <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">
                                        <input type="hidden" name="ltq_id" value="<?php echo $row1->ltq_id; ?>">
                                        <input type="hidden" name="lta_id" value="<?php echo $row1->lta_id; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Question Type:</label>

                                            <select class="selectpicker" data-width="100%" name="ltqq_type" id="ltqq_type" disabled>
                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Multiple Choice Question') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Fill In The Blank') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Short Answers') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                            </select>
                                        </div>
                                        <div class="mb-3">

                                            <label class="form-label">Question :</label>
                                            <textarea class="form-control" name="ltq_question" id="editornewquestion12<?php echo $row1->ltq_id; ?>"><?php echo $row1->ltq_question; ?></textarea>
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editornewquestion12<?php echo $row1->ltq_id; ?>'), {

                                                    })
                                                    .then(editor => {
                                                        window.editor = editor;
                                                    })
                                                    .catch(err => {
                                                        console.error(err.stack);
                                                    });
                                            </script>
                                        </div>
                                        <?php if ($row1->ltq_question_type == 'Multiple Choice Question') { ?>
                                            <div id="mltq">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th width="120px">
                                                                    Option-1
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer1" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-2
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer2" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer2; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-3
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer3" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer3; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-4
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer4" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer4; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color: lightblue;">
                                                                <th>
                                                                    Correct Answer
                                                                </th>
                                                                <td>

                                                                    <select name="answermulchoice" class="form-control form-control-sm custom-select">

                                                                        <option value="1" <?php echo ($selectedOption == '1') ? 'selected' : ''; ?>>Option-1</option>
                                                                        <option value="2" <?php echo ($selectedOption == '2') ? 'selected' : ''; ?>>Option-2</option>
                                                                        <option value="3" <?php echo ($selectedOption == '3') ? 'selected' : ''; ?>>Option-3</option>
                                                                        <option value="4" <?php echo ($selectedOption == '4') ? 'selected' : ''; ?>>Option-4</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } elseif ($row1->ltq_question_type == 'Fill In The Blank') { ?>
                                            <div id="tf">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th width="120px">
                                                                    Option-1
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer5" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-2
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer6" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer2; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color: lightblue;">
                                                                <th>
                                                                    Correct Answer
                                                                </th>
                                                                <td>
                                                                    <select name="tf_answer" class="form-control form-control-sm">
                                                                        <option value="5" <?php echo ($selectedOption == '1') ? 'selected' : ''; ?>>Option-1</option>
                                                                        <option value="6" <?php echo ($selectedOption == '2') ? 'selected' : ''; ?>>Option-2</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } elseif ($row1->ltq_question_type == 'Short Answers') { ?>
                                            <div id="sa">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr style="background-color: lightblue;">
                                                                <th width="120px">
                                                                    Answer
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer7" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm" name="edit_language_test_quiz_question">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-----------------------*************Edit Question Complete **************************************------------------------------------------------->

            <?php
            $querycq = $conn->query("SELECT * FROM language_test_answer AS LTA
            LEFT JOIN language_test_question AS LTQ
            ON LTA.lta_id_ltq_id=LTQ.ltq_id
            LEFT JOIN language_test_comp_pasage AS LTP
            ON LTP.ltcp_id=LTQ.ltq_id_ltc_id
            WHERE LTQ.ltqq_id= '$lid' AND LTQ.ltq_id_ltc_id=LTP.ltcp_id AND LTQ.ltq_id_ltc_id IS NOT NULL");

            $num = 1;
            if (mysqli_num_rows($querycq) > 0) {
                while ($row1 = mysqli_fetch_object($querycq)) {
                    $selectedOption = '';
                    if ($row1->lta_answer1 == $row1->lta_right_answerword) {
                        $selectedOption = '1';
                    } elseif ($row1->lta_answer2 == $row1->lta_right_answerword) {
                        $selectedOption = '2';
                    } elseif ($row1->lta_answer3 == $row1->lta_right_answerword) {
                        $selectedOption = '3';
                    } elseif ($row1->lta_answer4 == $row1->lta_right_answerword) {
                        $selectedOption = '4';
                    }

            ?>

                    <!-----------------------*************Edit Passage Question Start**************************************------------------------------------------------->
                    <div class="modal fade" id="editquestioncp<?php echo $row1->ltq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="questionmodal">Edit Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="editquestioncp">
                                        <input type="hidden" name="ltq_question_type" value="<?php echo $row1->ltq_question_type; ?>">
                                        <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">
                                        <input type="hidden" name="ltq_id" value="<?php echo $row1->ltq_id; ?>">
                                        <input type="hidden" name="lta_id" value="<?php echo $row1->lta_id; ?>">
                                        <input type="hidden" name="ltcp_id" value="<?php echo $row1->ltcp_id; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Question Type:</label>

                                            <select class="selectpicker" data-width="100%" name="ltqq_type" id="ltqq_type" disabled>
                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Multiple Choice Question') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Fill In The Blank') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                                <option value="<?php echo $row1->ltq_question_type; ?>" <?php if ($row1->ltq_question_type == 'Short Answers') {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        } ?>><?php echo $row1->ltq_question_type; ?></option>

                                            </select>
                                        </div>
                                        <div class="mb-3">

                                            <label class="form-label">Question :</label>
                                            <textarea class="form-control" name="ltq_question" id="editornewquestion12<?php echo $row1->ltq_id; ?>"><?php echo $row1->ltq_question; ?></textarea>
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editornewquestion12<?php echo $row1->ltq_id; ?>'), {

                                                    })
                                                    .then(editor => {
                                                        window.editor = editor;
                                                    })
                                                    .catch(err => {
                                                        console.error(err.stack);
                                                    });
                                            </script>
                                        </div>
                                        <?php if ($row1->ltq_question_type == 'Multiple Choice Question') { ?>
                                            <div id="mltq">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th width="120px">
                                                                    Option-1
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer1" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-2
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer2" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer2; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-3
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer3" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer3; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-4
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer4" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer4; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color: lightblue;">
                                                                <th>
                                                                    Correct Answer
                                                                </th>
                                                                <td>
                                                                    <select name="answermulchoice" class="form-control form-control-sm custom-select">
                                                                        <option value="1" <?php echo ($selectedOption == '1') ? 'selected' : ''; ?>>Option-1</option>
                                                                        <option value="2" <?php echo ($selectedOption == '2') ? 'selected' : ''; ?>>Option-2</option>
                                                                        <option value="3" <?php echo ($selectedOption == '3') ? 'selected' : ''; ?>>Option-3</option>
                                                                        <option value="4" <?php echo ($selectedOption == '4') ? 'selected' : ''; ?>>Option-4</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } elseif ($row1->ltq_question_type == 'Fill In The Blank') { ?>
                                            <div id="tf">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th width="120px">
                                                                    Option-1
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer5" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    Option-2
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer6" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer2; ?>">
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color: lightblue;">
                                                                <th>
                                                                    Correct Answer
                                                                </th>
                                                                <td>
                                                                    <select name="tf_answer" class="form-control form-control-sm">
                                                                        <option value="5" <?php echo ($selectedOption == '1') ? 'selected' : ''; ?>>Option-1</option>
                                                                        <option value="6" <?php echo ($selectedOption == '2') ? 'selected' : ''; ?>>Option-2</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } elseif ($row1->ltq_question_type == 'Short Answers') { ?>
                                            <div id="sa">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered no-wrap table-hover">
                                                        <tbody>
                                                            <tr style="background-color: lightblue;">
                                                                <th width="120px">
                                                                    Answer
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="question_answer7" placeholder="Type Answer Here" class="form-control form-control-sm" value="<?php echo $row1->lta_answer1; ?>">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm" name="edit_language_test_quiz_question">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-----------------------*************Edit passage Question Complete *************************------------------------------------------------->

            <?php
            $querycq = $conn->query("SELECT * FROM language_test_comp_pasage ");

            $num = 1;
            if (mysqli_num_rows($querycq) > 0) {
                while ($row1 = mysqli_fetch_object($querycq)) {

            ?>
                    <!-----------------------*************Edit Comprehension passage Question Complete *************************------------------------------------------------->

                    <div class="modal fade" id="editpassage<?php echo $row1->ltcp_id; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="questionmodal">Edit Comprehension passage</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="editpassage">
                                        <input type="hidden" name="lt_id" value="<?php echo $lid; ?>">
                                        <input type="hidden" name="ltcp_id" value="<?php echo $row1->ltcp_id; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Question :</label>
                                            <textarea class="form-control" name="ltq_question" id="editornewquestioncp<?php echo $row1->ltcp_id; ?>"><?php echo $row1->ltcp_passage; ?></textarea>
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editornewquestioncp<?php echo $row1->ltcp_id; ?>'), {

                                                    })
                                                    .then(editor => {
                                                        window.editor = editor;
                                                    })
                                                    .catch(err => {
                                                        console.error(err.stack);
                                                    });
                                            </script>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm" name="edit_comprehension_passage">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-----------------------*************Edit Comprehension passage Question Complete *************************------------------------------------------------->

        </div>
    </div>







    <!-- End Modal Page For Edit Question -->


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

        function deletequestion1() {
            var x = confirm("All questions related to this will also be deleted! Are you sure want to delete this Passage?");

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

        $(document).ready(function() {
            $('#dataTableBasic2').DataTable();

        });

        function showDiv(select) {
            if (select.value == 'Multiple Choice Question') {
                // document.getElementById('mltq').style.display = "block";
                // document.getElementById('tf').style.display = "none";
                $('#mltq').show();
                $('#tf').hide();
                $('#sa').hide();
                $('#cp').hide()
            } else if (select.value == 'Fill In The Blank') {
                // document.getElementById('mltq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $('#tf').show();
                $('#mltq').hide()
                $('#sa').hide()
                $('#cp').hide()
            } else if (select.value == 'Short Answers') {
                // document.getElementById('mltq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $('#sa').show()
                $('#mltq').hide()
                $('#tf').hide();
                $('#cp').hide()
            }


        }
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn1', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form1', function() {
                $('.paste-new-forms1').append('   <div class="modal-body">\
                                    <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">\
                                    <div class="collapse show" id="panelsStayOpen-collapseOne">\
                                        <table>\
                                            <thead>\
                                                <tr>\
                                                    <input type="hidden" value="Multiple Choice Question" name="ltqq_type[]">\
                                                    <h4>Multiple Choice Question</h4>\
                                                    <textarea class="form-control" name="ltqq_question[]" id="editormcq" placeholder="Type Question Here" required></textarea>\
                                                </tr>\
                                        </table>\
                                        <div class="table-responsive">\
                                        <table class="table table-bordered no-wrap table-hover">\
                                                <tbody>\
                                                    <tr>\
                                                        <th width="120px">\
                                                            Option-1\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer1[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th>\
                                                            Option-2\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer2[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th>\
                                                            Option-3\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer3[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th>\
                                                            Option-4\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer4[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr style="background-color: lightblue;">\
                                                        <th>\
                                                            Correct Answer\
                                                        </th>\
                                                        <td>\
                                                            <select name="answermulchoice[]" class="form-control form-control-sm">\
                                                            <option value="" selected>Choose...</option>\
                                                                <option value="1">Option-1</option>\
                                                                <option value="2">Option-2</option>\
                                                                <option value="3">Option-3</option>\
                                                                <option value="4">Option-4</option>\
                                                            </select>\
                                                        </td>\
                                                    </tr>\
                                                </tbody>\
                                            </table>\
                                            </div>\
                                                                <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn1 btn btn-danger btn-sm">Remove</button>\
                                        </div>\
                                    </div>\
                                        </div>\
                                    </div>');
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn1', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form2', function() {
                $('.paste-new-forms2').append('   <div class="modal-body">\
                                    <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">\
                                    <div class="collapse show" id="panelsStayOpen-collapseTwo">\
                                    <table>\
                                            <thead>\
                                                <tr>\
                                                    <input type="hidden" value="Fill In The Blank" name="ltqq_type[]">\
                                                    <h4>Fill In The Blank:</h4>\
                                                    <textarea class="form-control" name="ltqq_question[]" id="editorfb" placeholder="Type Question Here" required></textarea>\
                                                </tr>\
                                        </table>\
                                        <div class="table-responsive">\
                                        <table class="table table-bordered no-wrap table-hover">\
                                                <tbody>\
                                                    <tr>\
                                                        <th width="120px">\
                                                            Option-1\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer1[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th>\
                                                            Option-2\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer2[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                    <tr style="background-color: lightblue;">\
                                                        <th>\
                                                            Correct Answer\
                                                        </th>\
                                                        <td>\
                                                            <select name="answermulchoice[]" class="form-control form-control-sm">\
                                                            <option value="" selected>Choose...</option>\
                                                                <option value="1">Option-1</option>\
                                                                <option value="2">Option-2</option>\
                                                            </select>\
                                                        </td>\
                                                    </tr>\
                                                </tbody>\
                                            </table>\
                                            </div>\
                                                                <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn1 btn btn-danger btn-sm">Remove</button>\
                                        </div>\
                                    </div>\
                                        </div>\
                                    </div>');
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn1', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form3', function() {
                $('.paste-new-forms3').append('   <div class="modal-body">\
                                    <input type="hidden" name="ltqq_id" value="<?php echo $lid; ?>">\
                                    <div class="collapse show" id="panelsStayOpen-collapse3">\
                                    <table>\
                                            <thead>\
                                                <tr>\
                                                    <input type="hidden" value="Short Answers" name="ltqq_type[]">\
                                                    <h4>Short Answers:</h4>\
                                                    <textarea class="form-control" name="ltqq_question[]" id="editorfb" placeholder="Type Question Here" required></textarea>\
                                                </tr>\
                                        </table>\
                                        <div class="table-responsive">\
                                        <table class="table table-bordered no-wrap table-hover">\
                                                <tbody>\
                                                    <tr style="background-color: lightblue;">\
                                                        <th width="120px">\
                                                            Answer\
                                                        </th>\
                                                        <td>\
                                                            <input type="text" name="question_answer1[]" placeholder="Type Answer Here" class="form-control form-control-sm" required>\
                                                        </td>\
                                                    </tr>\
                                                </tbody>\
                                            </table>\
                                            </div>\
                                                                <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn1 btn btn-danger btn-sm">Remove</button>\
                                        </div>\
                                    </div>\
                                        </div>\
                                    </div>');
            });

        });
    </script>
    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>