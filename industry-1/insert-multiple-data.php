<!DOCTYPE html>
<html lang="en">


<?php
session_start();
include 'pages-head.php';
include '../database/dbcon.php';
?>


<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'dashboard';
        include 'pages-sidebar.php';
        ?>

        <!-- Page Content -->
        <div id="page-content">

            <?php
            include 'pages-header.php';
            include 'industry-function.php';
            $industry_id = $_SESSION['sess_industryid'];
            ?>

            <div class="row">
                <div class=" mt-4 col-1 py-5 mx-5 my-5"></div>
                <div class="card mt-4 col-8 py-5 mx-5 my-5">
                    <div class="card-header">
                        <h4>How to Insert Multiple Data into Database in PHP MySQL
                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a>
                        </h4>
                    </div>
                    <div class="card-body px-5">

                        <form action="industry-function.php" method="POST">
                        <input type="hidden" name="section[]" class="form-control" value="1" required placeholder="Enter Name">
                        <input type="hidden" name="ptq_pt_id[]" class="form-control" value="1" required placeholder="Enter Phone Number">
                        <input type="hidden" name="ptq_type[]" class="form-control" value="Multiple Choice" required placeholder="Enter Phone Number">

                        
                            <div class="main-form bg-light mt-3 px-5 ">
                                <div class="row border ">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">questionname</label>
                                            <input type="text" name="questionname[]" class="form-control" required placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Question Image</label>
                                            <input type="file" name="question_img[]" class="form-control" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                   
                                </div>                            
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">option2</label>
                                            <input type="text" name="option2[]" class="form-control" required placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">option3</label>
                                            <input type="text" name="option3[]" class="form-control" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">option4</label>
                                            <input type="text" name="option4[]" class="form-control" required placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">option1</label>
                                            <input type="text" name="option1[]" class="form-control" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <button type="submit" name="asave_multiple_data" class="btn btn-primary">Save Multiple Data</button>
                        </form>

                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append(' <div class="main-form bg-light mt-3 px-5 ">\
                                <div class="row border ">\
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">questionname</label>\
                                            <input type="text" name="questionname[]" class="form-control" required placeholder="Enter Name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">Question Image</label>\
                                            <input type="file" name="question_img[]" class="form-control" required placeholder="Enter Phone Number">\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="row">\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">option2</label>\
                                            <input type="text" name="option2[]" class="form-control" required placeholder="Enter Name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">option3</label>\
                                            <input type="text" name="option3[]" class="form-control" required placeholder="Enter Phone Number">\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="row">\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">option4</label>\
                                            <input type="text" name="option4[]" class="form-control" required placeholder="Enter Name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-6">\
                                        <div class="form-group mb-2">\
                                            <label for="">option1</label>\
                                            <input type="text" name="option1[]" class="form-control" required placeholder="Enter Phone Number">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>

</body>
</html>