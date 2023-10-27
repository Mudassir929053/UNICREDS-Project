<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];
$mcid = $_GET['mcid'];
$mcqid = $_GET['mcq_id'];
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
            <!-- Container fluid -->
            <div class="container-fluid p-4">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page Header -->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <?php $queryquiz = $conn->query("SELECT * FROM mc_quiz WHERE mcq_id = '$mcqid'");
                                if ($queryquiz->num_rows > 0) {
                                    $row_header = $queryquiz->fetch_object();
                                } ?>
                                <h1 class="mb-1 h2 fw-bold">Question List</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="pages-microcredential.php">Micro-credential</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Micro-credential Assessment</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">View Quiz Question</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>

                                <a class="btn btn-sm btn-secondary waves-effect waves-light" href="pages-microcredential-assessment-review.php?mcid=<?php echo $mcid; ?>">
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
                                    <h2><strong class="text-info "><?php echo $row_header->mcq_title; ?></strong></h2>
                                    <div>
                                     
                                    </div>
                                </div>
                                <table id="dataTableBasic1" class="table table-sm table-bordered table-hover display no-wrap" style="width:100%">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th width="5px">No.</th>
                                            <th width="200px">Question Type</th>
                                            <th>Question</th>
                                            <th>Right Answer</th>

                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <?php $queryquizquestion = $conn->query("SELECT * from mc_quiz_question 
                                                                                 LEFT JOIN mc_quiz_answer ON mcqq_id = mc_quiz_answer.mcqa_mc_quiz_question_id
                                                                                 WHERE mcqq_mc_quiz_id = $mcqid AND mcqq_deleted_date IS NULL;");

                                        $num = 1;
                                        if (mysqli_num_rows($queryquizquestion) > 0) {
                                            while ($rows = mysqli_fetch_object($queryquizquestion)) {
                                        ?>

                                                <tr>
                                                    <td class="text-center"><?php echo $num++; ?></td>
                                                    <td class="text-center"><?php echo $rows->mcqq_type; ?></td>
                                                    <td>
                                                        <p class="align-middle"><?php echo $rows->mcqq_question; ?></p>
                                                    </td>
                                                    <td><?php echo $rows->mcqa_right_answerword; ?></td>

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