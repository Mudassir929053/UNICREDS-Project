<?php
include('function/student-function.php');
$suID = $_SESSION['sess_studentid'];

// Connect to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected price filters
if (isset($_POST['price_filter'])) {
    $price_filter = $_POST['price_filter'];
} else {
    $price_filter = [];
}

// Get the selected category filters
if (isset($_POST['category_filter'])) {
    $category_filter = $_POST['category_filter'];
} else {
    $category_filter = [];
}

// Construct the query based on the selected filters
$query = "SELECT * FROM employability_program 
LEFT JOIN institution on course_created_by = institution.institution_user_id 
LEFT JOIN enrolled_ep_studuni on enrolled_ep_studuni.eepsu_ep_id = employability_program.ep_id 
WHERE ep_publish = 'Published' 
GROUP BY employability_program.ep_title 
HAVING COUNT(*) > 0";
if (count($price_filter) > 0) {
    $query .= " AND ep_fee_status IN ('" . implode("','", $price_filter) . "')";
}
if (count($category_filter) > 0) {
    $query .= " AND ep_category IN ('" . implode("','", $category_filter) . "')";
}

// Execute the query
$result = $conn->query($query);
?>


<div class="row">
    <?php
    // Display the products
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="col-md-4 mt-3">
                <div class="border bg-white p-2">
                    <a href="student-ep-enroll.php?ep_id=<?= $row['ep_id']; ?>">
                        <img src="../assets/images/course/<?= $row['ep_cover_attachment']; ?>" class="card-img-top rounded-top-md" alt="" height="200">
                        <div class="text-left mt-3">
                            <!-- <h5 class="mb-0 text-body"> Course Title</h5> -->
                            <h6> <?= $row['ep_title']; ?> </h6>
                        </div>
                        <div class="text-left">
                            <h5 class="mb-0 text-body"> Category:</h5>
                            <h6><?= $row['ep_category']; ?></h6>
                        </div>
                        <div class="text-left">
                            <?php
                            // Get transaction count for the course
                            $query1 = $conn->query("SELECT * FROM enrolled_ep_studuni WHERE eepsu_ep_id ='$row[ep_id]'");
                            $transaction_count = mysqli_num_rows($query1);
                            // Get rating count and average rating for the course
                            $query2 = $conn->query("SELECT AVG(ep_review_rating) as avg_rating, COUNT(*) as rating_count FROM ep_rating WHERE ep_course_id='$row[ep_id]'");
                            $rating_data = mysqli_fetch_assoc($query2);
                            // $avg_rating = $rating_data['avg_rating'];
                            $avg_rating = number_format($rating_data['avg_rating'], 1);

                            $rating_count = $rating_data['rating_count'];
                            ?>
                            <p class="text-dark mb-0 fw-semi-bold">
                                <?php
                                echo   $avg_rating;
                                // Display rating stars and count
                                if ($avg_rating !== null) {
                                    $rating_in_stars = round($avg_rating); // Round the rating to the nearest integer
                                    for ($i = 1; $i <= 5; $i++) { // Display 5 stars
                                        if ($i <= $rating_in_stars) {
                                            echo '<span class="fas fa-star text-warning"></span>'; // Display a filled star
                                        } else {
                                            echo '<span class="far fa-star text-warning"></span>'; // Display an empty star
                                        }
                                    }
                                    echo " ($rating_count)"; // Display the rating count
                                } else {
                                    echo "No ratings yet"; // Display this message if there are no ratings yet
                                }
                                ?>
                            </p>
                            <p class="text-dark mb-0 fw-semi-bold">
                                <?php
                                // Display transaction count
                                // echo "$transaction_count students";
                                ?>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-left">
                                    <?php if ($row['ep_fee'] == 'Free' || $row['ep_fee'] == 'free' || $row['ep_fee'] == 0) { ?>
                                        <p class="text-dark mb-0 fw-semi-bold"><?php echo "Free"; ?></p>
                                    <?php } else { ?>
                                        <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($row['ep_fee'] / 100); ?></p>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-left">
                                    <?php
                                    $query1 = "SELECT * FROM enrolled_ep_studuni ORDER BY eepsu_student_university_id DESC";
                                    $result1 = $conn->query($query1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($row1['eepsu_student_university_id'] == $suID && $row1['eepsu_ep_id'] == $row['ep_id']) {
                                                echo '<span class="badge bg-primary">Enrolled</span>';
                                            } else {
                                                // Do something else
                                            }
                                        }
                                    } else {
                                        // Handle case where there are no enrolled programs
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>


                    </a>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p class='text-center'>No courses found.</p>";
    }
    ?>

</div>

<?php
$conn->close();
?>