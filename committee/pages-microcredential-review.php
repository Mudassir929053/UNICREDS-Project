<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];

$checkuserrow = $conn->query("SELECT * from committee where committee_id = '$committee_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_uniID = $rowReadUser->committee_institution_id;
$get_committeeUserID = $rowReadUser->committee_user_id;

@$tab_type = $_SESSION['tab_type'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
      unset($_SESSION['pages']);
      $_SESSION['pages'] = 'mcreview';
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
                               
                            </div>
                        </div>
                    </div>




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

                                            <?php $querymcprocress = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON mc_id = review_microcredential.rmc_mc_id  
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN lecturer ON user.user_id = lecturer.lecturer_user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id
                                                                                 LEFT JOIN committee ON institution.institution_id = committee.committee_institution_id                                    
                                                                                 WHERE mc_status = 'Processing' AND committee.committee_institution_id = '$get_uniID' AND committee.committee_user_id = '$get_committeeUserID'
                                                                                 ORDER BY mc_created_date DESC;");?>
                                                
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Processing") { echo "active"; } else if ($tab_type == NULL) { echo "active"; }?>" id="processing-tab" data-bs-toggle="pill" href="#processing" role="tab" aria-controls="processing" >For Review 
                                                
                                                <?php if (mysqli_num_rows($querymcprocress) > 0) {?>
                                                <span class="badge rounded-pill bg-warning text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcprocress); ?></span>
                                                <?php } 
                                                else {}?>
                                                </a>
                                            </li>
                                            
                                            <?php $querymcapprove = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON mc_id = review_microcredential.rmc_mc_id  
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN lecturer ON user.user_id = lecturer.lecturer_user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id
                                                                                 LEFT JOIN committee ON institution.institution_id = committee.committee_institution_id                                    
                                                                                 WHERE mc_status = 'Approved' AND committee.committee_institution_id = '$get_uniID'  AND committee.committee_user_id = '$get_committeeUserID'
                                                                                 ORDER BY mc_created_date DESC;");?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Approved") { echo "active"; }?>" id="approve-tab" data-bs-toggle="pill" href="#approve" role="tab" aria-controls="approve" >Approved 
                                
                                                <?php if (mysqli_num_rows($querymcapprove) > 0) {?>
                                                <span class="badge rounded-pill bg-success text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcapprove); ?></span>
                                                <?php } 
                                                else {}?>
                                                </a>
                                            </li>

                                            <?php $querymcreject = $conn->query("SELECT * FROM microcredential
                                                                                 LEFT JOIN review_microcredential ON mc_id = review_microcredential.rmc_mc_id  
                                                                                 LEFT JOIN user ON mc_created_by = user.user_id
                                                                                 LEFT JOIN lecturer ON user.user_id = lecturer.lecturer_user_id
                                                                                 LEFT JOIN institution ON mc_owner = institution.institution_id
                                                                                 LEFT JOIN university ON institution.institution_university_id = university.university_id
                                                                                 LEFT JOIN committee ON institution.institution_id = committee.committee_institution_id                                    
                                                                                 WHERE mc_status = 'Rejected' AND committee.committee_institution_id = '$get_uniID'  AND committee.committee_user_id = '$get_committeeUserID'
                                                                                 ORDER BY mc_created_date DESC;");?>

                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($tab_type == "Rejected") { echo "active"; }?>" id="rejected-tab" data-bs-toggle="pill" href="#rejected" role="tab" aria-controls="rejected" >Rejected 
                                                <?php if (mysqli_num_rows($querymcreject) > 0) {?>
                                                <span class="badge rounded-pill bg-danger text-white shadow  mt-n1 ms-1"><?php echo mysqli_num_rows($querymcreject); ?></span>
                                                <?php } 
                                                else {}?>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <!-- table  -->
                                    <div class="tab-content" id="tabContent">

                                        <!--Tab pane -->
                                        <div class="tab-pane <?php if ($tab_type == "Processing") { echo "active"; } else if ($tab_type == NULL) { echo "active"; } ?>" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                                            <div class="card-body ">
                                                <div class="table-responsive">
                                                <table id="dataTableBasic5" class="table table-hover table-sm display no-wrap" style="width:100%">
                                                    <thead class="bg-gradient bg-light-warning text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Request Date</th>
                                                            <th scope="col" class="border-0">Requested By</th>
                                                            <th scope="col" class="border-0">Approve/Reject</th>
                                                            <th scope="col" class="border-0" width="50px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php
                                                        $num = 1;
                                                        if (mysqli_num_rows($querymcprocress) > 0) {
                                                            while ($rows = mysqli_fetch_object($querymcprocress)) {
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
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>">
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
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee/100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Processing')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-warning ";
                                                                                                                        }
                                                                                                                        elseif ($rows->mc_status == 'Approved')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        }  
                                                                                                                        else 
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <td class="text-center">
                                                                       <?php echo date('j/m/Y', strtotime($rows->rmc_date_request)) ?>
                                                                    </td>                                                   

                                                                    <?php if ($rows->user_role_id == '1') {
                                                                        $adminrole = $rows->user_role_id;
                                                                        $adminuserid = $rows->user_id;

                                                                        $queryadmininstitution = $conn->query("SELECT * FROM admin LEFT JOIN institution ON admin_institution = institution.institution_id
                                                                                                              LEFT JOIN university ON institution.institution_university_id = university.university_id 
                                                                                                              WHERE admin_user_id = '$adminuserid' AND admin_role_id = '$adminrole'") ;
                                                                        
                                                                        $rowReadAdmin = $queryadmininstitution->fetch_object();
                                                                        $institution_name = $rowReadAdmin->university_name;
                                                                        ?>                                                    
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $institution_name; ?> 
                                                                    </td>
                                                                    <?php } elseif ($rows->user_role_id == '7') {?> 
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $rows->lecturer_fname; ?> <?php echo $rows->lecturer_lname; ?>
                                                                    </td>
                                                                    <?php }?>     

                                                                    <td class="text-center">
                                                                    
                                                                    <a class="btn btn-sm btn-outline-warning" href="pages-microcredential-review-status.php?mcid=<?php echo $rows->mc_id; ?>" > Review</a>         
                                                                    </td>

                                                                    <td class="text-muted px-4 py-3 align-middle border-top-0">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder dropdown-item-icon text-primary"></i></i>View Content</a>
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
                                        <div class="tab-pane <?php if ($tab_type == "Approved") { echo "active"; }?>" id="approve" role="tabpanel" aria-labelledby="approve-tab">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <table id="dataTableBasic2" class="table table-hover table-sm display no-wrap" style="width:100%">
                                                    <thead class="bg-gradient bg-light-success text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Approved Date</th>
                                                            <th scope="col" class="border-0">Requested By</th>
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
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>">
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
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee/100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Processing')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        }
                                                                                                                        elseif ($rows->mc_status == 'Approved')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        }  
                                                                                                                        else 
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                       <?php echo date('j/m/Y', strtotime($rows->rmc_date_review)) ?>
                                                                    </td>

                                                                    <?php if ($rows->user_role_id == '1') {
                                                                        $adminrole = $rows->user_role_id;
                                                                        $adminuserid = $rows->user_id;

                                                                        $queryadmininstitution = $conn->query("SELECT * FROM admin LEFT JOIN institution ON admin_institution = institution.institution_id
                                                                                                              LEFT JOIN university ON institution.institution_university_id = university.university_id 
                                                                                                              WHERE admin_user_id = '$adminuserid' AND admin_role_id = '$adminrole'") ;
                                                                        
                                                                        $rowReadAdmin = $queryadmininstitution->fetch_object();
                                                                        $institution_name = $rowReadAdmin->university_name;
                                                                        ?>                                                    
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $institution_name; ?> 
                                                                    </td>
                                                                    <?php } elseif ($rows->user_role_id == '7') {?> 
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $rows->lecturer_fname; ?> <?php echo $rows->lecturer_lname; ?>
                                                                    </td>
                                                                    <?php }?> 

                                                                    <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder dropdown-item-icon text-primary"></i></i>View Content</a>
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
                                        <div class="tab-pane <?php if ($tab_type == "Rejected") { echo "active"; }?>" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <table id="dataTableBasic3" class="table table-hover table-sm display no-wrap" style="width:100%">
                                                    <thead class="bg-gradient bg-light-danger text-dark">
                                                        <tr class="text-center">
                                                            <th scope="col" class="border-0" width="10px">No.</th>
                                                            <th scope="col" class="border-0" width="250px">Micro-Credential</th>
                                                            <th scope="col" class="border-0" width="300px">Micro-Credential Description</th>
                                                            <th scope="col" class="border-0">Fee</th>
                                                            <th scope="col" class="border-0">Status</th>
                                                            <th scope="col" class="border-0">Rejected Date</th>
                                                            <th scope="col" class="border-0">Requested By</th>
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
                                                                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>">
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
                                                                        <td class="text-center">RM <?php echo floatval($rows->mc_fee/100); ?></td>
                                                                    <?php
                                                                    } ?>

                                                                    <td class="text-center">
                                                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Processing')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-warning";
                                                                                                                        }
                                                                                                                        elseif ($rows->mc_status == 'Approved')
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-success";
                                                                                                                        }  
                                                                                                                        else 
                                                                                                                        {
                                                                                                                            echo "badge rounded-pill bg-danger";
                                                                                                                        } ?>"><?php echo $rows->mc_status; ?></span>
                                                                    </td>

                                                                    <td class="text-center">
                                                                       <?php echo date('j/m/Y', strtotime($rows->rmc_date_review)) ?>
                                                                    </td>
                                                                    
                                                                    <?php if ($rows->user_role_id == '1') {
                                                                        $adminrole = $rows->user_role_id;
                                                                        $adminuserid = $rows->user_id;

                                                                        $queryadmininstitution = $conn->query("SELECT * FROM admin LEFT JOIN institution ON admin_institution = institution.institution_id
                                                                                                              LEFT JOIN university ON institution.institution_university_id = university.university_id 
                                                                                                              WHERE admin_user_id = '$adminuserid' AND admin_role_id = '$adminrole'") ;
                                                                        
                                                                        $rowReadAdmin = $queryadmininstitution->fetch_object();
                                                                        $institution_name = $rowReadAdmin->university_name;
                                                                        ?>                                                    
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $institution_name; ?> 
                                                                    </td>
                                                                    <?php } elseif ($rows->user_role_id == '7') {?> 
                                                                    <td class="text-center fw-semi-bold text-dark">
                                                                        <?php echo $rows->lecturer_fname; ?> <?php echo $rows->lecturer_lname; ?>
                                                                    </td>
                                                                    <?php }?> 

                                                                    <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                        <span class="dropdown dropstart">
                                                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                                <i class="fe fe-more-vertical"></i></a>
                                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                                <a class="dropdown-item" href="pages-microcredential-details-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                                                                <a class="dropdown-item" href="pages-microcredential-content-review.php?mcid=<?php echo $rows->mc_id; ?>"><i class="fe fe-folder dropdown-item-icon text-primary"></i></i>View Content</a>
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
            var x = confirm("Are you sure want to request this micro-credential?");

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