<?php
include('function/student-function.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
$suID = $_SESSION['sess_studentid'];

?>

<body>
    <!-- Navbar -->
    <?php
    include('pages-topbar.php');

    ?>
    <!-- Page header -->
    <div class="bg-info py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="mb-0 text-white display-4">Employability Program</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Content -->
    <div class="py-6">

        <div class="container">
            <div class="row">
                <!-- Course count / Change display / Sort content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-6">
                    <div class="row d-lg-flex justify-content-between align-items-center">
                        <div class="col-md-6 col-lg-8 col-xl-9 ">
                            <h4 class="mb-3 mb-lg-0">
                                Displaying courses:
                            </h4>
                        </div>



                    </div>
                </div>

                
                    <div class="row">
                        <!-- price List  -->
                        <div class="col-md-3">
                            <form action="" method="GET">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5>Filter</h5>

                                    </div>
                                    <div class="card-body">
                                        <form>
                                                <h5>Cost</h5>

                                                <hr>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="price_filter[]" value="free" id="free">
                                                <label class="form-check-label" for="free">Free Courses</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="price_filter[]" value="paid" id="paid">
                                                <label class="form-check-label" for="paid">Paid Courses</label>
                                            </div>
                                            <br>
                                            <br>
                                            <h5>Category</h5>
                                            <hr>
                                            <?php
                                            $query = "SELECT ep_category FROM employability_program WHERE ep_publish = 'Published' AND ep_category IS NOT NULL AND ep_category != '' GROUP BY ep_category ORDER BY ep_category";
                                            $result = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $category = $row['ep_category'];
                                            ?>
                                                                                                <div class="form-check form-check-inline">

                                                        <input class="form-check-input" type="checkbox" name="category_filter[]" value="<?php echo $category; ?>" id="<?php echo $category; ?>">
                                                        <label class="form-check-label" for="<?php echo $category; ?>"><?php echo $category; ?></label>
                                                    </div>
                                            <?php
                                                }
                                            } else {
                                                echo "No categories found";
                                            }
                                            ?>
                                        </form>

                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- price Items - Products -->

                        <div class="col-md-9">
                            <!-- <div class="card  bg-light"> -->
                                <!-- <div class="card-body row"> -->
                                    <div id="products">
                                        <!-- Products will be fetched and displayed here -->
                                      
                                    </div>
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
           

                <!-- Footer -->
                <?php
                require_once("pages-footer.php");
                ?>
                <!-- Script -->
                <script src="C:\xampp\htdocs\employability-platform\student\js\ep.js"></script>


                <!-- Theme JS -->
                <script src="../assets/js/theme.min.js"></script>
                <!-- Job Search JS -->
                <script src="js/search-job.js"></script>

                </script>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Load all courses on page load
                        $.ajax({
                            url: "filter.php",
                            type: "post",
                            data: {},
                            success: function(response) {
                                $("#products").html(response);
                            }
                        });

                        // Update course list on checkbox change
                        $("form input[type='checkbox']").click(function() {
                            var price_filter = [];
                            var category_filter = [];
                            $("form input[type='checkbox']:checked").each(function() {
                                if ($(this).attr("name") === "price_filter[]") {
                                    price_filter.push($(this).val());
                                }
                                if ($(this).attr("name") === "category_filter[]") {
                                    category_filter.push($(this).val());
                                }
                            });

                            // Check if any checkboxes are checked
                            if (price_filter.length > 0 || category_filter.length > 0) {
                                // Filter courses by payment status and category
                                $.ajax({
                                    url: "filter.php",
                                    type: "post",
                                    data: {
                                        price_filter: price_filter,
                                        category_filter: category_filter
                                    },
                                    success: function(response) {
                                        $("#products").html(response);
                                    }
                                });
                            } else {
                                // Show all courses if no checkboxes are checked
                                $.ajax({
                                    url: "filter.php",
                                    type: "post",
                                    data: {},
                                    success: function(response) {
                                        $("#products").html(response);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>