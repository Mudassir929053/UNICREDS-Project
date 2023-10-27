<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('lecturer-function.php');

$lecturer_id = $_SESSION['sess_lecturerid'];
if (isset($_SESSION['sess_lecturerid'])) {
    // $lecturer_id = $_SESSION['sess_lecturerid'];
    $querylecturer = $conn->query("SELECT * FROM lecturer 
     WHERE lecturer_id = '$lecturer_id';");

    if (mysqli_num_rows($querylecturer) > 0) {
        $row = mysqli_fetch_object($querylecturer);
        $lecturer_institution = $row->lecturer_institution_id;
    } else {
        $lecturer_institution = " ";
    }
}

$checkuserrow = $conn->query("SELECT lecturer_user_id from lecturer where lecturer_id = '$lecturer_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->lecturer_user_id;

@$tab_type = $_SESSION['tab_type'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mc';
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
                                <h1 class="mb-1 h2 fw-bold">Micro-Credential</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">Micro-Credential</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMC">Add Micro-Credential</button> -->
                                <!-- <a class="btn btn-primary waves-effect waves-light btn-sm" href="pages-microcredential-register.php">Add Micro-Credential</a> -->
                                <button type="button" class="btn btn-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#SelectInstitution">Register Micro-Credential</button>
                            </div>
                        </div>
                    </div>

                    <!-- Start Modal Page -->
                    <div class="modal fade" id="SelectInstitution" tabindex="-1" role="dialog" aria-labelledby="institutionmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="institutionmodal">Select Institution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="institutionForm">
                                        <div class="mb-2">
                                            <label class="form-label">Institution :</label>
                                            <select class="selectpicker" data-width="100%" name="institution_id" id="institution" data-live-search="true" required>
                                                <option value="" selected disabled>Select Institution..</option>
                                                <?php
                                                $queryInstitution = $conn->query("SELECT * FROM institution
                                                LEFT JOIN user ON institution_user_id = user.user_id
                                                LEFT JOIN university ON institution_university_id = university.university_id
                                                WHERE university_name != 'Unicreds' AND institution_deleted_date IS NULL ");

                                                if (mysqli_num_rows($queryInstitution) > 0) {
                                                    while ($rows = mysqli_fetch_object($queryInstitution)) {
                                                ?>
                                                        <option value="<?php echo $rows->institution_id; ?>"><?php echo $rows->university_name; ?></option>
                                                    <?php }
                                                } else {
                                                    ?>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="select_institution">
                                        Submit
                                    </button>
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
                                <div class="card-header border-bottom-0 p-0 bg-white">
                                    <div>
                                        <!-- Nav -->
                                        <ul class="nav nav-lb-tab" id="tab" role="tablist">

                                            <?php $querymcdraft = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON review_microcredential.rmc_mc_id = mc_id 
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id                                    
                                                                                 WHERE mc_status = 'Draft' AND mc_created_by = '$get_userID' 
                                                                                 ORDER BY mc_created_date DESC;");  ?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Draft") {
                                                                        echo "active";
                                                                    } else if ($tab_type == NULL) {
                                                                        echo "active";
                                                                    } ?>" id="new_mc-tab" data-bs-toggle="pill" href="#draft" role="tab" aria-controls="new_mc">Draft
                                                    <?php if (mysqli_num_rows($querymcdraft) > 0) { ?>
                                                        <span class="badge rounded-pill bg-secondary text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcdraft); ?></span>
                                                    <?php } else {
                                                    } ?>
                                                </a>
                                            </li>

                                            <?php $querymcprocess = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON review_microcredential.rmc_mc_id = mc_id 
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id                                    
                                                                                 WHERE mc_status = 'Processing' AND mc_created_by = '$get_userID' 
                                                                                 ORDER BY mc_created_date DESC;");  ?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Processing") {
                                                                        echo "active";
                                                                    } ?>" id="processing-tab" data-bs-toggle="pill" href="#processing" role="tab" aria-controls="processing">Processing
                                                    <?php if (mysqli_num_rows($querymcprocess) > 0) { ?>
                                                        <span class="badge rounded-pill bg-warning text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcprocess); ?></span>
                                                    <?php } else {
                                                    } ?>
                                                </a>
                                            </li>


                                            <?php $querymcreject = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON review_microcredential.rmc_mc_id = mc_id 
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id                                    
                                                                                 WHERE mc_status = 'Rejected' AND mc_created_by = '$get_userID' 
                                                                                 ORDER BY mc_created_date DESC;");  ?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Rejected") {
                                                                        echo "active";
                                                                    } ?>" id="rejected-tab" data-bs-toggle="pill" href="#rejected" role="tab" aria-controls="rejected">Rejected
                                                    <?php if (mysqli_num_rows($querymcreject) > 0) { ?>
                                                        <span class="badge rounded-pill bg-danger text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcreject); ?></span>
                                                    <?php } else {
                                                    } ?>
                                                </a>
                                            </li>

                                            <?php $querymcapprove = $conn->query("SELECT * FROM microcredential 
                                                                                 LEFT JOIN review_microcredential ON review_microcredential.rmc_mc_id = mc_id
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id                                    
                                                                                 WHERE mc_status = 'Approved' AND mc_created_by = '$get_userID' 
                                                                                 ORDER BY mc_created_date DESC;");  ?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Approved") {
                                                                        echo "active";
                                                                    } ?>" id="approve-tab" data-bs-toggle="pill" href="#approve" role="tab" aria-controls="approve">Approved
                                                    <?php if (mysqli_num_rows($querymcapprove) > 0) { ?>
                                                        <span class="badge rounded-pill bg-success text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcapprove); ?></span>
                                                    <?php } else {
                                                    } ?>
                                                </a>
                                            </li>


                                            <?php $querymcpublish = $conn->query("SELECT * FROM microcredential 
                                                                                 LEFT JOIN review_microcredential ON review_microcredential.rmc_mc_id = mc_id
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id                                    
                                                                                 WHERE mc_status = 'Published' AND mc_created_by = '$get_userID' 
                                                                                 ORDER BY mc_created_date DESC;");  ?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Published") {
                                                                        echo "active";
                                                                    } ?>" id="published-tab" data-bs-toggle="pill" href="#published" role="tab" aria-controls="published">Published
                                                    <?php if (mysqli_num_rows($querymcpublish) > 0) { ?>
                                                        <span class="badge rounded-pill bg-primary text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcpublish); ?></span>
                                                    <?php } else {
                                                    } ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <!-- table  -->
                                    <div class="tab-content" id="tabContent">
                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Draft") {
                                                                    echo "active";
                                                                } else if ($tab_type == NULL) {
                                                                    echo "active";
                                                                } ?>" id="draft" role="tabpanel" aria-labelledby="new_mc-tab">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <table id="dataTableBasic1" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                                    <thead class="bg-gradient bg-light-secondary text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Request MC</th>

                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php


                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcdraft) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcdraft)) {
                                                                $mc_id = $rows->mc_id;
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="border-top-0">
                                                                        <a class="text-inherit">
                                                                            <div class="d-lg-flex align-items-center">
                                                                                <div>
                                                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded"height="70" />
                                                                                </div>
                                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>">
                                                                                        <h4 class="mb-1 text-primary-hover">
                                                                                            <?php echo $rows->mc_title; ?>
                                                                                        </h4>
                                                                                    </a>
                                                                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->mc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                        <td class="text-center"><?php echo $rows->mc_fee; ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee / 100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Draft') {
                                                                                                                            echo "badge rounded-pill bg-secondary";
                                                                                                                        } elseif ($rows->mc_status == 'Processing') {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        } elseif ($rows->mc_status == 'Approved') {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        } elseif ($rows->mc_status == 'Published') {
                                                                                                                            echo "badge rounded-pill bg-primary";
                                                                                                                        } else {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php $querynote = $conn->query("SELECT * FROM mc_notes LEFT JOIN microcredential ON microcredential.mc_id = mcn_mc_id 
                                                                                                         WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mcn_created_by = '$get_userID'");
                                                                        $totalnote =  mysqli_num_rows($querynote);

                                                                        $queryslide = $conn->query("SELECT * FROM mc_slide LEFT JOIN microcredential ON microcredential.mc_id = mcs_mc_id 
                                                                                                          WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mcs_created_by = '$get_userID'");
                                                                        $totalslide =  mysqli_num_rows($queryslide);

                                                                        $queryvideo = $conn->query("SELECT * FROM mc_video LEFT JOIN microcredential ON microcredential.mc_id = mcv_mc_id 
                                                                                                          WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mcv_created_by = '$get_userID'");
                                                                        $totalvideo =  mysqli_num_rows($queryvideo);

                                                                        $querytutor = $conn->query("SELECT * FROM mc_tutorial LEFT JOIN microcredential ON microcredential.mc_id = mctu_mc_id  
                                                                                                          WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mctu_created_by = '$get_userID'");
                                                                        $totaltutor =  mysqli_num_rows($querytutor);

                                                                        $queryquiz = $conn->query("SELECT * FROM mc_quiz LEFT JOIN microcredential ON microcredential.mc_id = mcq_mc_id  
                                                                                                         WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mcq_created_by = '$get_userID'");
                                                                        $totalquiz =  mysqli_num_rows($queryquiz);

                                                                        $queryassigmnt = $conn->query("SELECT * FROM mc_assignment LEFT JOIN microcredential ON microcredential.mc_id = mca_mc_id  
                                                                                                             WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mca_created_by = '$get_userID'");
                                                                        $totalassigmnt =  mysqli_num_rows($queryassigmnt);

                                                                        $querytest = $conn->query("SELECT * FROM mc_test LEFT JOIN microcredential ON microcredential.mc_id = mct_mc_id 
                                                                                                         WHERE mc_id = '$mc_id' AND mc_created_by = '$get_userID' AND mct_created_by = '$get_userID'");
                                                                        $totaltest =  mysqli_num_rows($querytest);

                                                                        $totallearningvideo = $totalvideo;
                                                                        $totallearningactivity = $totalslide + $totalnote;
                                                                        $totalassessment = $totaltutor + $totalquiz + $totaltest;

                                                                        ?>
                                                                        <?php if ($rows->mc_status == 'Draft') {

                                                                            if ($totallearningvideo >= 1 && $totallearningactivity >= 1 && $totalassessment >= 1) { ?>
                                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="institution_id" value="<?php echo $rows->mc_owner; ?>">
                                                                                    <input type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                                                    <input type="hidden" name="user_id" value="<?php echo $get_userID; ?>">
                                                                                    <button type="submit" class="btn btn-sm btn btn-outline-warning" name="request_mc" onclick="return requestmc()">
                                                                                        Request</button>
                                                                                </form>
                                                                            <?php } else { ?>
                                                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<p class='text-start'>A complete module contains at least the followings :</p>
                                                                                    <li class='text-start'>ONE (1) self-developed and well edited learning video </li>
                                                                                    <li class='text-start'>ONE (1) learning activity – to develop the learners</li>
                                                                                    <li class='text-start'>ONE (1) assessment – to assess the learners</li> <br>
                                                                                    <p class='text-start'><b>*You need to complete the module before request</b></p> ">
                                                                                    <button class="btn  bg-light-secondary waves-effect waves-light btn-sm text-dark" style="pointer-events: none;" type="button" disabled>
                                                                                        Request Disabled
                                                                                    </button>
                                                                                </span>
                                                                            <?php } ?>
                                                                        <?php } else { ?>
                                                                            <button class="btn btn-sm btn-warning shadow" disabled>Requesting</button>
                                                                        <?php  } ?>
                                                                    </td>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i></i>Manage Content</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-edit.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                                                                <a class="dropdown-item" href="lecturer-function.php?delete_mc=<?php echo $rows->mc_id; ?>" title="Delete Micro-Credential" onclick="return deletemc()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                                                            </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal for More -->
                                                                <div class="modal fade" id="modalView<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Micro-credential Description</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                            </div>
                                                                        </div>
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
                                        <!--Tab pane -->


                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Processing") {
                                                                    echo "active";
                                                                } ?>" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTableBasic5" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                                    <thead class="bg-gradient bg-light-warning text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Date Request</th>
                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php

                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcprocess) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcprocess)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="border-top-0">
                                                                        <a class="text-inherit">
                                                                            <div class="d-lg-flex align-items-center">
                                                                                <div>
                                                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded" />
                                                                                </div>
                                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>">
                                                                                        <h4 class="mb-1 text-primary-hover">
                                                                                            <?php echo $rows->mc_title; ?>
                                                                                        </h4>
                                                                                    </a>
                                                                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->mc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                        <td class="text-center"><?php echo $rows->mc_fee; ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee / 100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Draft') {
                                                                                                                            echo "badge rounded-pill bg-secondary";
                                                                                                                        } elseif ($rows->mc_status == 'Processing') {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        } elseif ($rows->mc_status == 'Approved') {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        } elseif ($rows->mc_status == 'Published') {
                                                                                                                            echo "badge rounded-pill bg-primary";
                                                                                                                        } else {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->rmc_date_request)) ?></td>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder dropdown-item-icon text-primary"></i></i>View Content</a>
                                                                            </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal for More -->
                                                                <div class="modal fade" id="modalView<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Micro-credential Description</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                            </div>
                                                                        </div>
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
                                        <!--Tab pane -->

                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Rejected") {
                                                                    echo "active";
                                                                } ?>" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTableBasic3" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                                    <thead class="bg-gradient bg-light-danger text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Date Rejected</th>
                                                            <th scope="col" class="border-0" width="200px">Comment</th>
                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php

                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcreject) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcreject)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="border-top-0">
                                                                        <a class="text-inherit">
                                                                            <div class="d-lg-flex align-items-center">
                                                                                <div>
                                                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded" />
                                                                                </div>
                                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>">
                                                                                        <h4 class="mb-1 text-primary-hover">
                                                                                            <?php echo $rows->mc_title; ?>
                                                                                        </h4>
                                                                                    </a>
                                                                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->mc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                        <td class="text-center"><?php echo $rows->mc_fee; ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee / 100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Draft') {
                                                                                                                            echo "badge rounded-pill bg-secondary";
                                                                                                                        } elseif ($rows->mc_status == 'Processing') {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        } elseif ($rows->mc_status == 'Approved') {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        } elseif ($rows->mc_status == 'Published') {
                                                                                                                            echo "badge rounded-pill bg-primary";
                                                                                                                        } else {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->rmc_date_review)) ?></td>

                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->rmc_comment, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewcomment<?php echo $rows->mc_id; ?><?php echo $rows->rmc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i></i>Manage Content</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-edit.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                                                                <a class="dropdown-item" href="lecturer-function.php?delete_mc=<?php echo $rows->mc_id; ?>" title="Delete Micro-Credential" onclick="return deletemc()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                                                            </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal for More Description-->
                                                                <div class="modal fade" id="modalView<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Micro-credential Description</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal for More Description-->

                                                                <!-- Modal for More Comment -->
                                                                <div class="modal fade" id="modalViewcomment<?php echo $rows->mc_id; ?><?php echo $rows->rmc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcreview" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Review Comment</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->rmc_comment; ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal for More Comment -->

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
                                        <!--Tab pane -->

                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Approved") {
                                                                    echo "active";
                                                                } ?>" id="approve" role="tabpanel" aria-labelledby="approve-tab">
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTableBasic2" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                                    <thead class="bg-gradient bg-light-success text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Date Approved</th>
                                                            <th scope="col" class="border-0" width="200px">Comment</th>
                                                            <th scope="col" class="border-0">Publish</th>
                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php

                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcapprove) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcapprove)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="border-top-0">
                                                                        <a class="text-inherit">
                                                                            <div class="d-lg-flex align-items-center">
                                                                                <div>
                                                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded" />
                                                                                </div>
                                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>">
                                                                                        <h4 class="mb-1 text-primary-hover">
                                                                                            <?php echo $rows->mc_title; ?>
                                                                                        </h4>
                                                                                    </a>
                                                                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->mc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                        <td class="text-center"><?php echo $rows->mc_fee; ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee / 100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Draft') {
                                                                                                                            echo "badge rounded-pill bg-secondary";
                                                                                                                        } elseif ($rows->mc_status == 'Processing') {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        } elseif ($rows->mc_status == 'Approved') {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        } elseif ($rows->mc_status == 'Published') {
                                                                                                                            echo "badge rounded-pill bg-primary";
                                                                                                                        } else {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->rmc_date_review)) ?></td>

                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->rmc_comment, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewcomment<?php echo $rows->mc_id; ?><?php echo $rows->rmc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>

                                                                    <td class="text-center">
                                                                        <a class="btn btn-sm btn-outline-success" href="lecturer-function.php?publish_mc=<?php echo $rows->mc_id; ?>" title="Publish Course" onclick="return publishcourse()">Publish</a>
                                                                    </td>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i></i>Manage Content</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-edit.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                                                                <a class="dropdown-item" href="lecturer-function.php?delete_mc=<?php echo $rows->mc_id; ?>" title="Delete Micro-Credential" onclick="return deletemc()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                                                            </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal for More -->
                                                                <div class="modal fade" id="modalView<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Micro-credential Description</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal for More Comment -->
                                                                <div class="modal fade" id="modalViewcomment<?php echo $rows->mc_id; ?><?php echo $rows->rmc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcreview" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Review Comment</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->rmc_comment; ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal for More Comment -->

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
                                        <!--Tab pane -->



                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Published") {
                                                                    echo "active";
                                                                } ?>" id="published" role="tabpanel" aria-labelledby="published-tab">
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTableBasic4" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                                    <thead class="bg-gradient bg-light-primary text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Date Published</th>
                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php

                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcpublish) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcpublish)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                                    <td class="border-top-0">
                                                                        <a class="text-inherit">
                                                                            <div class="d-lg-flex align-items-center">
                                                                                <div>
                                                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded" />
                                                                                </div>
                                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>">
                                                                                        <h4 class="mb-1 text-primary-hover">
                                                                                            <?php echo $rows->mc_title; ?>
                                                                                        </h4>
                                                                                    </a>
                                                                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="wide">
                                                                        <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
                                                                        <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->mc_id; ?>">
                                                                            <span style="color: skyblue;">Read More</span>
                                                                        </button>
                                                                    </td>
                                                                    <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                        <td class="text-center"><?php echo $rows->mc_fee; ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee / 100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Draft') {
                                                                                                                            echo "badge rounded-pill bg-secondary";
                                                                                                                        } elseif ($rows->mc_status == 'Processing') {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        } elseif ($rows->mc_status == 'Approved') {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        } elseif ($rows->mc_status == 'Published') {
                                                                                                                            echo "badge rounded-pill bg-primary";
                                                                                                                        } else {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <?php if ($rows->mc_published_date != NULL) { ?>
                                                                        <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->mc_published_date)) ?></td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center"><span style="vertical-align: middle;">N/A</span>
                                                                        </td>
                                                                    <?php } ?>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i></i>Manage Content</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-edit.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                                                                <!-- <a class="dropdown-item" href="lecturer-function.php?delete_mc=<?php echo $rows->mc_id; ?>" title="Delete Micro-Credential" onclick="return deletemc()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a> -->
                                                                            </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal for More -->
                                                                <div class="modal fade" id="modalView<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Micro-credential Description</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                            </div>
                                                                        </div>
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
                                        <!--Tab pane -->


                                    </div>
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
        $(document).ready(function() {
            $('#dataTableBasic1').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic2').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic3').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic4').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic5').dataTable();
        });
    </script>
    <script>
        function deletemc() {
            var x = confirm("Are you sure want to delete this micro-credential?\n\n All micro-credential details and its content will be deleted");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }

        function requestmc() {
            var x = confirm("Are you sure want to request this micro-credential?\n\n All micro-credential content cannot be edited");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }

        function publishcourse() {
            var x = confirm("Are you sure want to publish this micro-credential?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }


        function clearForm() {

            document.getElementById("mcdetail").reset();
            $('#field_id').selectpicker("refresh");

        }
    </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>