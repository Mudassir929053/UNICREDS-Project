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
                <h1 class="mb-1 h2 fw-bold">Forum</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                      <a href="#">Forum</a>
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
                <!-- <div class="card-header border-bottom-0">
                </div> -->
                <!-- table  -->
                <div class="card-body">
                  <table id="dataTableBasic" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                    <thead class="bg-gradient bg-info text-white">
                      <tr class="text-center">
                        <th scope="col" class="border-0" width="10px">No.</th>
                        <th scope="col" class="border-0" width="430px">Micro-Credential</th>

                        <th scope="col" class="border-0" width="50px">Action</th>
                      </tr>
                    </thead>
                    <tbody class="align-middle">
                      <?php
                      $querymc = $conn->query("SELECT * FROM microcredential 
                                               LEFT JOIN user ON mc_created_by = user.user_id                                                                                
                                               WHERE mc_created_by = '$get_userID' 
                                               AND mc_status = 'Published';");

                      $num = 1;
                      if (mysqli_num_rows($querymc) > 0) {
                        while ($rows = mysqli_fetch_object($querymc)) {
                          $mc_id = $rows->mc_id ;
                      ?>
                          <tr>
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td class="border-top-0">

                                <div class="d-lg-flex align-items-center">
                                  <div>
                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" alt="" class="img-4by3-lg rounded" />
                                  </div>
                                  <div class="ms-lg-3 mt-2 mt-lg-0">
                                      <h4 class="mb-1 text-primary-hover">
                                        <?php echo $rows->mc_title; ?>
                                      </h4>
                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->mc_created_date)) ?> </span>
                                  </div>
                                </div>
                        
                            </td>

                            <td class="text-center">
                            <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="pages-forum-topic-mc.php?mc_id=<?php echo $mc_id;?>" title="View">
                            <i class="fa fa-search" aria-hidden="true"></i> View Forum</a>       

                            </td>
                          </tr>


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




  <!-- clipboard -->



  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>
  <script src="../assets/js/ckeditor.js"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>