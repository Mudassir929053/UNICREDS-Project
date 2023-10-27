<!DOCTYPE html>
<html lang="en">
<?php
include 'pages-head.php'; ?>
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php'); ?>

<?php
$industry_id = $_SESSION['sess_industryid'];
$checkuserrow = $conn->query("SELECT industry_user_id from industry where industry_id = '$industry_id'"); $rowReadUser = $checkuserrow->fetch_object(); $get_userID = $rowReadUser->industry_user_id;
$get_userID = $rowReadUser->industry_user_id;
$pt_id = $_GET['pt_id'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'Career_Readiness';
        include('pages-sidebar.php');
        ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta/css/bootstrap.min.css">
        <link rel="stylesheet" href="..\assets\css\style1.css">
        <link rel="stylesheet" href="..\assets\css\style2.css">

        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';
            ?>
            <!-- Container fluid -->
            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg- col-md-12 col-12">
                        <!-- Page Header -->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <?php $queryquiz = $conn->query("SELECT * FROM psychometric_test WHERE pt_id = '$pt_id'");
                                if ($queryquiz->num_rows > 0) {
                                    $row_header = $queryquiz->fetch_object();
                                } ?>
                                <h1 class="mb-1 h2 fw-bold">Question List</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="pages-course-list.php">Physometric Test</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Physometric Test Assessment</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Add Physometric Test Question</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light" href="pages-career_readiness-assessment.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-7 ">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="border-bottom  mb-4 d-md-flex justify-content-between align-items-center">
                                <div class="mb-3 mb-md-0">
                                    <!-- <h1 class="mb-0 h2 fw-bold">Dashboard</h1> -->
                                </div>
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSection"><i class="fas fa-plus-square me-1 fs-5"></i>Add Section</button>
                                    <div class="btn-group" role="group">
                                        <!-- <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-plus-square me-1 fs-5"></i> Add Question
                                        </button> -->
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addMulti" href="#">Choice</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addText" href="#">Text</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addLikert" href="#">Likert</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addTF" href="#">True/False</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div>
                                    </div>
                                    <?php 
                                    $queryquizquestion = $conn->query("SELECT * from  psychometric_test_section where pts_pt_id = $pt_id");
 
                                    if (mysqli_num_rows($queryquizquestion) > 0) {
                                        while ($rows = mysqli_fetch_array($queryquizquestion)) {  
                                    ?>

                                            <ul class="m-d expand-list">
                                                <li data-md-content="10000" class="border border-info shadow-lg p-3  rounded rounded-0 m-2 py-3 pb-3 px-5 bg-gradiant" style="background-color:hsl(35.7, 100%, 57.5%)">
                                                    <label name="tab" for="tab2" tabindex="-1" class="tab_lab text-uppercase" role="tab"><?php echo $rows['pts_name'];
                                                                                                                                            $section_id =  $rows['pts_id'];
                                                                                                                                            ?></label>
                                                    <input type="checkbox" class="tab" id="tab2" tabindex="0" />

                                                    <span class="sectiond">
                                                        <a href="#" class=" text-white" data-bs-toggle="modal" data-bs-target="#modaleditnote<?php echo  $rows['pts_id']; ?>">

                                                            <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                        <a href="industry-function.php?delete_pts=<?php echo  $rows['pts_id']; ?>" class=" text-danger" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletesection()">

                                                            <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                    </span>
                                                    <span class="open-close-icon"><i class="fas fa-plus"></i><i class="fas fa-minus"></i></span>
                                                    <div class="content">
                                                        <div class="row ">



                                                            <div class="col-md-12 pt-2 text-white bg-white">
                                                                <div class="alert alert-light" role="alert">
                                                                    <div class="row pb-3 ">

                                                                        <div class="btn-group btn-sm justify-content-md-end mt-0 mb-5" role="group" aria-label="Button group with nested dropdown ">

                                                                            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSection"><i class="fas fa-plus-square me-1 fs-5"></i>Add Section</button> -->

                                                                            <div class="btn-group btn-sm" role="group">

                                                                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                                                    <i class="fas fa-plus-square me-1 fs-5"></i> Add Question

                                                                                </button>

                                                                                <ul class="dropdown-menu border" aria-labelledby="btnGroupDrop1">

                                                                                    <li><a class="dropdown-item font-weight-bold" data-bs-toggle="modal" data-bs-target="#addMulti<?php echo  $rows['pts_id']; ?>" href="#">Choice</a></li>

                                                                                    <li><a class="dropdown-item font-weight-bold" data-bs-toggle="modal" data-bs-target="#addText<?php echo  $rows['pts_id']; ?>" href="#">Text</a></li>

                                                                                    <li><a class="dropdown-item font-weight-bold" data-bs-toggle="modal" data-bs-target="#addLikert<?php echo  $rows['pts_id']; ?>" href="#">Likert</a></li>

                                                                                    <li><a class="dropdown-item font-weight-bold" data-bs-toggle="modal" data-bs-target="#addTF<?php echo  $rows['pts_id']; ?>" href="#">True/False</a></li>

                                                                                </ul>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="row pb-3 ">
                                                                    </div>
                                                                    <ul class="m-d expand-list">
                                                                        <?php $queryquizquestion1 = $conn->query("SELECT * from psychometric_test_question WHERE ptq_pts_id ='$section_id' and ptq_pt_id = '$pt_id'");
                                                                        $num1 = 1;
                                                                        if (mysqli_num_rows($queryquizquestion1) > 0) {
                                                                            while ($rows1 = mysqli_fetch_assoc($queryquizquestion1)) {
                                                                        ?>

                                                                                <li data-md-content="10000" class="border border-info shadow-lg p-3  rounded rounded-0 m-2 py-3 pb-3 px-5 bg-light">
                                                                                    <label name="tab" for="tab2" tabindex="-1" class="tab_lab " role="tab"><?php echo $rows1['ptq_question']; ?></label>
                                                                                    <input type="checkbox" class="tab" id="tab2" tabindex="0" />
                                                                                    <span class="open-close-icon"><i class="fas fa-plus"></i><i class="fas fa-minus"></i></span>

                                                                                    
                                                                                    <div class="content">
                                                                                        <?php $S = "";
                                                                                        if ($rows1['question_img'] == NULL) { ?>
                                                                                            <div class="row ">
                                                                                            </div>

                                                                                        <?php } else { ?>

                                                                                            <div class="row ">
                                                                                                <div class="col-md-12 pt-2 text-white bg-light">
                                                                                                    <div class="alert alert-light img-thumbnail" role="alert">
                                                                                                        <img src="../assets/images/question/<?php echo $rows1['question_img']; ?>" class="img-fluid" height="200px" width="350px">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php  } ?>
                                                                                        <?php if ($rows1['ptq_type'] == 'Disagree/Agree') { ?>
                                                                                            <div class="w-100"></div>
                                                                                            <div class="row ">
                                                                                                <div class="col-md-12 text-white bg-light">
                                                                                                    <div class="alert alert-light" role="alert">
                                                                                                        <p>A <?php echo $rows1['ptq_option1']; ?></p>
                                                                                                        <p>B <?php echo $rows1['ptq_option2']; ?></p>
                                                                                                        <p>C <?php echo $rows1['ptq_option3']; ?></p>
                                                                                                        <p>D <?php echo $rows1['ptq_option4']; ?></p>
                                                                                                        <p>E <?php echo $rows1['ptq_option5']; ?></p>
                                                                                                    </div>
                                                                                                    <div class="d-flex flex-row-reverse bd-highlight">
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_psychometric_test_question=<?php echo $rows1['ptq_id']; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                                        </div>
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-success bi bi-pencil-square btn-sm" data-bs-toggle="modal" data-bs-target="#editquestion<?php echo  $rows1['ptq_id']; ?>"></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php } elseif ($rows1['ptq_type'] == 'Multiple Choice') { ?>
                                                                                            <!-- <div class="w-100"></div> -->
                                                                                            <div class="w-100"></div>
                                                                                            <div class="row ">
                                                                                                <div class="col-md-12 text-white bg-light">
                                                                                                    <div class="alert alert-light" role="alert">
                                                                                                        <p>A <?php echo $rows1['ptq_option1']; ?></p>
                                                                                                        <p>B <?php echo $rows1['ptq_option2']; ?></p>
                                                                                                        <p>C <?php echo $rows1['ptq_option3']; ?></p>
                                                                                                        <p>D <?php echo $rows1['ptq_option4']; ?></p>
                                                                                                    </div>
                                                                                                    <div class="d-flex flex-row-reverse bd-highlight">
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_psychometric_test_question=<?php echo $rows1['ptq_id']; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                                        </div>
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-success bi bi-pencil-square btn-sm" data-bs-toggle="modal" data-bs-target="#editquestion<?php echo  $rows1['ptq_id']; ?>"></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-1 pt-2 text-white bg-light">
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php } elseif ($rows1['ptq_type'] == 'Text') { ?>
                                                                                            <!-- <div class="w-100"></div> -->
                                                                                            <div class="w-100"></div>
                                                                                            <div class="row ">
                                                                                                <div class="col-md-12 text-white bg-light">
                                                                                                    <div class="d-flex flex-row-reverse bd-highlight">
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_psychometric_test_question=<?php echo $rows1['ptq_id']; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                                        </div>
                                                                                                        <div class="p-2 bd-highlight text-black">
                                                                                                            <a class="btn btn-success bi bi-pencil-square btn-sm" data-bs-toggle="modal" data-bs-target="#editquestion<?php echo  $rows1['ptq_id']; ?>"></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-1 pt-2 text-white bg-light">
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php } elseif ($rows1['ptq_type'] == 'True/False') { ?>
                                                                                            <div class="w-100"></div>
                                                                                            <div class="row ">
                                                                                                <div class="col-md-12 pt-2 text-white bg-light">
                                                                                                    <div class="alert alert-light" role="alert">
                                                                                                        <p>A <?php echo $rows1['ptq_option1']; ?></p>
                                                                                                        <p>B <?php echo $rows1['ptq_option2']; ?></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="d-flex flex-row-reverse bd-highlight">
                                                                                                    <div class="p-2 bd-highlight text-black">
                                                                                                        <a class="btn btn-sm btn-danger" href="industry-function.php?delete_psychometric_test_question=<?php echo $rows1['ptq_id']; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                                    </div>
                                                                                                    <div class="p-2 bd-highlight text-black">
                                                                                                        <a class="btn btn-success bi bi-pencil-square btn-sm" data-bs-toggle="modal" data-bs-target="#editquestion<?php echo  $rows1['ptq_id']; ?>"></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                </li>
                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                    ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- Start Modal Page For Add Multiple Choice Question -->
                                                <div class="modal fade" id="addMulti<?php echo  $rows['pts_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="questionmodal">Multiple Choice Question</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST" enctype="multipart/form-data" id="addMulti" autocomplete="off">
                                                                    <input type="hidden" value="Multiple Choice" name="pt_question_type">
                                                                    <input type="hidden" name="pt_id" value="<?php echo $pt_id; ?>">
                                                                    <input type="hidden" name="pts_id" value="<?php echo  $rows['pts_id']; ?>">
                                                                    <div class="mb-3">
                                                                    </div>

                                                                    <div class="mb-3 col-12 float-start">
                                                                        <label class="form-label">Question :</label>
                                                                        <textarea class="form-control" name="pt_question[]" id="editmcquestion<?php echo  $rows['pts_id']; ?>"></textarea>
                                                                        <script>
                                                                            ClassicEditor
                                                                                .create(document.querySelector('#editmcquestion<?php echo  $rows['pts_id']; ?>'), {})
                                                                                .then(editor => {
                                                                                    window.editor = editor;
                                                                                })
                                                                                .catch(err => {
                                                                                    console.error(err.stack);
                                                                                });
                                                                        </script>
                                                                    </div>
                                                                    <p class="form-label bold">Question image : <span> ( optional ) </span> </p>
                                                                    <div class="btn  float-right bg-primary text-light ">
                                                                        <input type="file" accept="image/*" name="image[]">
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="form-label">Options:</label>
                                                                        <div id="mcq">
                                                                            <div class="table-responsive">
                                                                                <table class="table no-wrap table-hover">
                                                                                    <thead>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer1[]" placeholder="Option A" class="form-control form-control-sm">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer2[]" placeholder="Option B" class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer3[]" placeholder="Option C" class="form-control form-control-sm">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer4[]" placeholder="Option D" class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="paste-new-forms1"></div>


                                                                    <a href="javascript:void(0)" class="add-more-form1 float-end  btn btn-success btn-sm">
                                                                        <span>+ Add More</span>
                                                                    </a>


                                                            </div>

                                                            <!-- <div class="paste-new-forms1"></div> -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                                <button type="submit" class="btn btn-success btn-sm" name="add_psychometric_test_question">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- End Modal Page For Add Multiple Choice Question -->
                                                <!-- Start Modal Page For Add Multiple Choice Question -->
                                                <div class="modal fade" id="addTF<?php echo  $rows['pts_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="questionmodal">True/False Question</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST" enctype="multipart/form-data" id="addTF" autocomplete="off">
                                                                    <input type="hidden" value="True/False" name="pt_question_type">
                                                                    <input type="hidden" name="pt_id" value="<?php echo $pt_id; ?>">
                                                                    <input type="hidden" name="pts_id" value="<?php echo  $rows['pts_id']; ?>">
                                                                    <div class="mb-3">
                                                                    </div>

                                                                    <div class="mb-3 col-12 float-start">
                                                                        <label class="form-label">Question :</label>
                                                                        <textarea class="form-control" name="pt_question[]" id="editTFquestion<?php echo  $rows['pts_id']; ?>"></textarea>
                                                                        <script>
                                                                            ClassicEditor
                                                                                .create(document.querySelector('#editTFquestion<?php echo  $rows['pts_id']; ?>'), {})
                                                                                .then(editor => {
                                                                                    window.editor = editor;
                                                                                })
                                                                                .catch(err => {
                                                                                    console.error(err.stack);
                                                                                });
                                                                        </script>
                                                                    </div>
                                                                    <p class="form-label bold">Question image : <span> ( optional ) </span> </p>
                                                                    <div class="btn  float-right bg-primary text-light ">
                                                                        <input type="file" accept="image/*" name="image[]">
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="form-label">Options:</label>
                                                                        <div id="mcq">
                                                                            <div class="table-responsive">
                                                                                <table class="table no-wrap table-hover">
                                                                                    <thead>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer5[]" placeholder="Option A" value="True" class="form-control form-control-sm">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer6[]" placeholder="Option B" value="False" class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="paste-new-forms"></div>
                                                                    <a href="javascript:void(0)" class="add-more-form float-end btn btn-sm btn-success">

                                                                        <span>+ Add More</span>
                                                                    </a>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                                <button type="submit" class="btn btn-success btn-sm" name="add_psychometric_test_question">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- End Modal Page For Add Multiple Choice Question -->
                                                <!-- Start Modal Page For Add Text Question -->
                                                <div class="modal fade" id="addText<?php echo  $rows['pts_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="questionmodal">Text Question</h5>
                                                            </div>
                                                            <input type="hidden" value="<?php #echo $ptq_pts_id; 
                                                                                        ?>">
                                                            <div class="modal-body">
                                                                <form action="" method="POST" enctype="multipart/form-data" id="addText" autocomplete="off">
                                                                    <input type="hidden" value="Text" name="pt_question_type">
                                                                    <input type="hidden" name="pt_id" value="<?php echo $pt_id; ?>">
                                                                    <input type="hidden" name="pts_id" value="<?php echo  $rows['pts_id']; ?>">
                                                                    <div class="mb-3">
                                                                    </div>

                                                                    <div class="mb-3 col-12 float-start">
                                                                        <label class="form-label">Question :</label>
                                                                        <textarea class="form-control" name="pt_question[]" id="addtextquestion<?php echo  $rows['pts_id']; ?>"></textarea>
                                                                        <script>
                                                                            ClassicEditor
                                                                                .create(document.querySelector('#addtextquestion<?php echo  $rows['pts_id']; ?>'), {})
                                                                                .then(editor => {
                                                                                    window.editor = editor;
                                                                                })
                                                                                .catch(err => {
                                                                                    console.error(err.stack);
                                                                                });
                                                                        </script>
                                                                    </div>
                                                                    <p class="form-label bold">Question image : <span> ( optional ) </span> </p>
                                                                    <div class="btn  float-right bg-primary text-light ">
                                                                        <input type="file" accept="image/*" name="image[]">
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="form-label">Options:</label>
                                                                        <div id="mcq">
                                                                            <div class="table-responsive">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="paste-new-forms2"></div>


                                                                    <a href="javascript:void(0)" class="add-more-form2 float-end btn btn-sm btn-success">
                                                                        <span>+ Add More</span>
                                                                    </a>


                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                                <button type="submit" class="btn btn-success btn-sm" name="add_psychometric_test_question">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- End Modal Page For Add Text Question -->
                                                <!-- Start Modal Page For Add Likert Question -->
                                                <div class="modal fade" id="addLikert<?php echo  $rows['pts_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="questionmodal">Create Likert Question</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST" enctype="multipart/form-data" id="addLikert" autocomplete="off">
                                                                    <input type="hidden" value="Disagree/Agree" name="pt_question_type">
                                                                    <input type="hidden" name="pt_id" value="<?php echo $pt_id; ?>">
                                                                    <input type="hidden" name="pts_id" value="<?php echo  $rows['pts_id']; ?>">
                                                                    <div class="mb-3">
                                                                    </div>

                                                                    <div class="mb-3 col-12 float-start">
                                                                        <label class="form-label">Question :</label>
                                                                        <textarea class="form-control" name="pt_question[]" id="editnewlikertquestion<?php echo  $rows['pts_id']; ?>"></textarea>
                                                                        <script>
                                                                            ClassicEditor
                                                                                .create(document.querySelector('#editnewlikertquestion<?php echo  $rows['pts_id']; ?>'), {})
                                                                                .then(editor => {
                                                                                    window.editor = editor;
                                                                                })
                                                                                .catch(err => {
                                                                                    console.error(err.stack);
                                                                                });
                                                                        </script>
                                                                    </div>
                                                                    <p class="form-label">Question image (Optional) : <span> ( optional ) </span> </p>
                                                                    <div class="btn  float-right bg-primary text-light">
                                                                        <input type="file" accept="image/*" name="image[]">
                                                                    </div>
                                                                    <div>
                                                                        <label class="form-label">Options:</label>
                                                                        <div id="mcq">
                                                                            <div class="table-responsive">
                                                                                <table class="table no-wrap table-hover">
                                                                                    <thead>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer9[]" value="Strongly Disagree" placeholder="Option 1" class="form-control form-control-sm">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer10[]" placeholder="Option 2" value="Disagree" class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer11[]" placeholder="Option 3" value="Neutral" class="form-control form-control-sm">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="question_answer12[]" placeholder="Option 4" value="Agree" class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <td>
                                                                                            <input type="text" name="question_answer13[]" placeholder="Option 5" value="Strongly Agree" class="form-control form-control-sm">
                                                                                        </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="paste-new-forms3"></div>


                                                                    <a href="javascript:void(0)" class="add-more-form3 float-end btn btn-sm btn-success">
                                                                        <span>+ Add More<span>
                                                                    </a>


                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                                <button type="submit" class="btn btn-success btn-sm" name="add_psychometric_test_question">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- End Modal Page For Add Likert Question -->
                                            </ul>


                                            <div class="modal fade" id="modaleditnote<?php echo  $rows['pts_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editcn" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Section</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <input type="hidden" name="pts_id" value="<?php echo  $rows['pts_id']; ?>">
                                                                    <label class="form-label" for="textInput">Title :</label>
                                                                    <input type="text" id="pts_name" name="pts_name" value="<?php echo  $rows['pts_name']; ?>" class="form-control" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success btn-sm" name="edit_pts">Save</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <!-- Start Modal Page For Add Section -->
                                    <div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="editcn" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Section</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data" id="addSection" autocomplete="off">
                                                        <input type="hidden" name="pt_id" value="<?php echo $pt_id; ?>">
                                                        <div class="mb-3">
                                                        </div>
                                                        <div class="mb-3 col-10">
                                                            <label class="form-label">Section :</label>
                                                            <input type="text" name="section_name" class="form-control form-control-sm">
                                                        </div>
                                                        <div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm" name="add_psychometric_section">Create Section</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Page For Add Section -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    $queryquizquestion1 = $conn->query("SELECT * from psychometric_test_question 
    WHERE ptq_pt_id = $pt_id;");
    $num = 1;
    while ($row1 = mysqli_fetch_object($queryquizquestion1)) {
    ?>
        <!-- Start Modal Page For Edit Question -->
        <div class="modal fade" id="editquestion<?php echo $row1->ptq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="questionmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="questionmodal">Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="editquestion<?php echo $row1->ptq_id; ?>" autocomplete="off">
                            <input type="hidden" name="pt_id" value="<?php echo $row1->ptq_pt_id; ?>">
                            <input type="hidden" name="ptq_id" value="<?php echo $row1->ptq_id; ?>">
                            <input type="hidden" name="ptq_type" value="<?php echo $row1->ptq_type; ?>">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <div class="custom-file-container" data-upload-id="courseCoverImg<?php echo $row1->ptq_id; ?>" id="courseCoverImg<?php echo $row1->ptq_id; ?>">
                                        <label class="form-label">Question :</label>
                                        <textarea class="form-control" name="new_pt_question" id="editornewquestion<?php echo $row1->ptq_id; ?>"><?php echo $row1->ptq_question; ?></textarea>
                                        <script>
                                            ClassicEditor
                                                .create(document.querySelector('#editornewquestion<?php echo $row1->ptq_id; ?>'), {})
                                                .then(editor => {
                                                    window.editor = editor;
                                                })
                                                .catch(err => {
                                                    console.error(err.stack);
                                                });
                                        </script>
                                        <label class="form-label">Question image: (Optional)
                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                        </label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="coursecoverimg" id="pictureUpload">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <?php if ($row1->question_img != NULL) { ?>
                                            <p class="mt-2">Current File Image: <a href="../assets/images/question/<?php echo $row1->question_img; ?>" target="_blank">
                                                    <?php echo  $row1->question_img; ?></a></p>
                                        <?php } else {
                                        } ?>
                                        <!-- <div class="custom-file-container__image-preview"></div> -->
                                    </div>
                                    <script>
                                        if ($("#courseCoverImg<?php echo $row1->ptq_id; ?>").length)
                                            new FileUploadWithPreview("courseCoverImg<?php echo $row1->ptq_id; ?>", {
                                                showDeleteButtonOnImages: !0,
                                                text: {
                                                    chooseFile: " No File Selected",
                                                    browse: "Upload File"
                                                }
                                            });
                                    </script>
                                </div>
                            </div>
                            <?php if ($row1->ptq_type == 'Multiple Choice') { ?>
                                <div>
                                    <label class="form-label">Options:</label>
                                    <table class="table border border-white  no-wrap table-hover">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer1" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option1; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="new_question_answer2" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option2; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer3" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option3; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="new_question_answer4" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option4; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } elseif ($row1->ptq_type == 'True/False') {  ?>
                                <div>
                                    <label class="form-label">Options:</label>
                                    <table class="table  border border-white no-wrap table-hover">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer5" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option1; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="new_question_answer6" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option2; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } elseif ($row1->ptq_type == 'Text') {  ?>
                                <div>
                                </div>
                            <?php } elseif ($row1->ptq_type == 'Disagree/Agree') {  ?>
                                <div>
                                    <label class="form-label">Options:</label>
                                    <table class="table border border-white  no-wrap table-hover">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer9" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option1; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="new_question_answer10" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option2; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer11" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option3; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="new_question_answer12" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option4; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="new_question_answer13" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $row1->ptq_option5; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php  } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" name="edit_psychometric_quiz_question">Update</button>
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
    </div>
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

        function deletesection() {
            var x = confirm("Are you sure want to delete this Section?");
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
                $(' #da').hide();
                $(' #tb').hide();
            } else if (select.value == 'True/False') {
                // document.getElementById('mcq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $('#tf').show();
                $('#mcq').hide()
                $(' #da').hide()
                $(' #tb').hide()
            } else if (select.value == 'Disagree/Agree') {
                // document.getElementById('mcq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $(' #da').show();
                $('#tf').hide()
                $('#mcq').hide()
                $('#tb').hide()
            } else if (select.value == 'Text') {
                // document.getElementById('mcq').style.display = "none";
                // document.getElementById('tf').style.display = "block";
                $(' #tb').show();
                $(' #da').hide();
                $('#tf').hide()
                $('#mcq').hide()
            }
        }
        $(function() {
            $("#AddMulti").click(function() {
                $('#bookId').val($(this).data('id'));
                $("#addBookDialog").modal("show");
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form', function() {
                $('.paste-new-forms').append('<div class="modal-body">\
                <div class="mb-3 col-12 float-start">\
                                                            <label class="form-label">Question :</label>\
                                                            <textarea class="form-control" name="pt_question[]" id="editTFquestion"></textarea>\
                                                        </div>\
                                                        <p class="form-label bold">Question image : <span> ( optional ) </span> </p>\
                                                        <div class="btn  float-right bg-primary text-light ">\
                                                            <input type="file" accept="image/*" name="image[]">\
                                                        </div>\
                                                        <div class="row">\
                                                            <label class="form-label">Options:</label>\
                                                            <div id="mcq">\
                                                                <div class="table-responsive">\
                                                                    <table class="table no-wrap table-hover">\
                                                                        <thead>\
                                                                        </thead>\
                                                                        <tbody>\
                                                                            <tr>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer5[]" placeholder="Option A" value="True" class="form-control form-control-sm">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer6[]" placeholder="Option B" value="False" class="form-control form-control-sm">\
                                                                                </td>\
                                                                            </tr>\
                                                                        </tbody>\
                                                                    </table>\
                                                                </div>\
                                                            </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger btn-sm">Remove</button>\
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

            $(document).on('click', '.add-more-form1', function() {
                $('.paste-new-forms1').append('  <div class="modal-body">\
                                                                        <div class="mb-3 col-12 float-start">\
                                                            <label class="form-label">Question :</label>\
                                                            <textarea class="form-control" name="pt_question[]" id="editmcquestion"></textarea>\
                                                        </div>\
                                                        <p class="form-label bold">Question image : <span> ( optional ) </span> </p>\
                                                        <div class="btn  float-right bg-primary text-light ">\
                                                            <input type="file" accept="image/*" name="image[]">\
                                                        </div>\
                                                        <div class="row">\
                                                            <label class="form-label">Options:</label>\
                                                            <div id="mcq">\
                                                                <div class="table-responsive">\
                                                                    <table class="table no-wrap table-hover">\
                                                                        <thead>\
                                                                        </thead>\
                                                                        <tbody>\
                                                                            <tr>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer1[]" placeholder="Option A" class="form-control form-control-sm">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer2[]" placeholder="Option B" class="form-control form-control-sm">\
                                                                                </td>\
                                                                            </tr>\
                                                                            <tr>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer3[]" placeholder="Option C" class="form-control form-control-sm">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer4[]" placeholder="Option D" class="form-control form-control-sm">\
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
                                                            </div>\
                                                        </div>');
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn2', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form2', function() {
                $('.paste-new-forms2').append(' <div class="modal-body">\
                                                   <div class="mb-3 col-12 float-start">\
                                                            <label class="form-label">Question :</label>\
                                                            <textarea class="form-control" name="pt_question[]" id="addtextquestion"></textarea>\
                                                        </div>\
                                                        <p class="form-label bold">Question image : <span> ( optional ) </span> </p>\
                                                        <div class="btn  float-right bg-primary text-light ">\
                                                            <input type="file" accept="image/*" name="image[]">\
                                                        <div>\
                                                        </div>\
                                                        </div>\
                                                 <div class="col-md-4 ">\
                                                    <div class="form-group mb-2">\
                                                     <br>\
                                                         <button type="button" class="remove-btn2 btn btn-danger btn-sm ">Remove</button>\
                                                    </div>\
                                                </div>\       ');
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn3', function() {
                $(this).closest('.modal-body').remove();
            });

            $(document).on('click', '.add-more-form3', function() {
                $('.paste-new-forms3').append(' <div class="modal-body">\
                <div class="mb-3 col-12 float-start">\
                                                            <label class="form-label">Question :</label>\
                                                            <textarea class="form-control" name="pt_question[]" id="editnewlikertquestion"></textarea>\
                                                        </div>\
                                                        <p class="form-label">Question image (Optional) : <span> ( optional ) </span> </p>\
                                                        <div class="btn  float-right bg-primary text-light">\
                                                            <input type="file" accept="image/*" name="image[]">\
                                                        </div>\
                                                        <div>\
                                                            <label class="form-label">Options:</label>\
                                                            <div id="mcq">\
                                                                <div class="table-responsive">\
                                                                    <table class="table no-wrap table-hover">\
                                                                        <thead>\
                                                                        </thead>\
                                                                        <tbody>\
                                                                            <tr>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer9[]" value="Strongly Disagree" placeholder="Option 1" class="form-control form-control-sm">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer10[]" placeholder="Option 2" value="Somewhat Disagree" class="form-control form-control-sm">\
                                                                                </td>\
                                                                            </tr>\
                                                                            <tr>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer11[]" placeholder="Option 3" value="No Opinion" class="form-control form-control-sm">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" name="question_answer12[]" placeholder="Option 4" value="Somewhat Agree" class="form-control form-control-sm">\
                                                                                </td>\
                                                                            </tr>\
                                                                            <td>\
                                                                                <input type="text" name="question_answer13[]" placeholder="Option 5" value="Strongly Agree" class="form-control form-control-sm">\
                                                                            </td>\
                                                                            </tr>\
                                                                        </tbody>\
                                                                    </table>\
                                                                </div>\
                                                                <div class="col-md-4 ">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn3 btn btn-danger btn-sm ">Remove</button>\
                                        </div>\
                                    </div>\     </div>\
                                                        </div>\
                                    </div>\       ');
            });

        });
    </script>
    <!-- clipboard -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>