<!DOCTYPE html>
<html lang="en">



<?php
include 'pages-head.php';

include('../database/dbcon.php');
include 'industry-function.php';
$industry_id = $_SESSION['sess_industryid'];
$lid = $_GET['pid'];
$cid = $_GET['cid'];
?>
<style>


    @page {
         size: A4;
         margin: 0;
        }
        @media print { 
            .page { 
                margin: 0;
                 border: initial; 
                 width: 21cm;
                 min-height: 29.7cm;
                  border-radius: initial;
                   box-shadow: initial;
                    background: initial; 
                    page-break-after: always; 
                }
             }
    </style>
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
            <div class="container-fluid p-10">

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <!-- Page Header -->
        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
            <div class="mb-3 mb-md-0">
         
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

                <a class="btn btn-sm btn-secondary waves-effect waves-light" href="pages-lt-quiz-questions.php?cid=<?php echo $cid?>">
                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                    <a class="btn btn-sm btn-success waves-effect waves-light"  onclick="$('#pdf').print();">
                    </i>Print </a>
                   
            </div>

        </div>
    </div>
</div>


<div class="row"id="pdf">
    <!-- basic table -->
    <div class="col-md-12 col-12 mb-5">
        <div class="card smooth-shadow-md">
            <!-- table  -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                      
                       
                    <h2><strong class="text-info "></strong></h2>
                    <div>
                    
                    <?php
                                     
                                        $querycq = $conn->query("SELECT * FROM language_test_comp_pasage AS LTP
                                        WHERE LTP.ltcp_id= '$lid'");

                                        $num = 1;
                                        if (mysqli_num_rows($querycq) > 0) {
                                            while ($rows = mysqli_fetch_object($querycq)) {

                                        ?>
                                        
                                        <h2 > Comprehension Passage: </h2 >
                                      
                                        <hr>
                                        <h4 ><?php echo $rows->ltcp_passage; ?> </h4>
                                        <hr>
                                       <?php $querycq = $conn->query("SELECT * FROM language_test_answer AS LTA LEFT JOIN language_test_question AS LTQ ON LTA.lta_id_ltq_id=LTQ.ltq_id WHERE LTQ.ltq_id_ltc_id = '$lid'");

                                        $num = 1;
                                        if (mysqli_num_rows($querycq) > 0) {
                                            while ($rows = mysqli_fetch_object($querycq)) { ?>
                                       
                                       
                                 
                                     
                                  
                               
                                       <h4><?php echo  $num++ ?>.   <?php echo$rows->ltq_question; ?></h4>
                                    <?php
                                
                                    if ($rows->ltq_question_type == 'Multiple Choice Question')
                                    {

                                    ?>
                                   <h5 class="px-5" > A:  <?php echo $rows->lta_answer1; ?></h5>
                                    
                                   <h5 class="px-5" > B:  <?php echo $rows->lta_answer2; ?>  </h5>
                                  
                                   <h5 class="px-5" > C: <?php echo $rows->lta_answer3; ?></h5>
                                      
                                   <h5 class="px-5" > D: <?php echo $rows->lta_answer4; ?></h5>
                                       <br>
                                       <?php
                                     } elseif ($rows->ltq_question_type == 'Fill In The Blank')
                                    {

                                    ?>
                                 <h5 class="px-5" >   A:  <?php echo $rows->lta_answer1; ?></h5>
                                   
                                 <h5 class="px-5" >B: <?php echo $rows->lta_answer2; ?> </h5>
                                      <br>
                                    <?php
                                     } elseif ($rows->ltq_question_type == 'Short Answers')
                                    {
                                       
                                       
                                    ?>
                                    <h5 class="px-5" > ANSWER: ________________</h5>
                                      <br>
                                     <?php
                                     }
                                    
                                    
                                    ?>
                                        <?php
                                            } 
                                        }
                                          
                                        ?>
                                       <?php
                                        } 
                                     } 
                                      
                                       ?>
                                    
                                       
                    </div>
                </div>
                </body>

</html>         