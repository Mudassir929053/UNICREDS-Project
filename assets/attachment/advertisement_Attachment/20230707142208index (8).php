<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");



// Get the user ID of the logged-in user (you need to implement this based on your authentication mechanism)
// Get the user ID of the logged-in user (you need to implement this based on your authentication mechanism)
$userID = $_SESSION['u_id'];
$isPremiumUser = false;

// Retrieve the user's subscription end date from the database
$query = "SELECT s_end_date FROM subscription WHERE subscriber_id = $userID";
$result = mysqli_query($conn, $query);

if (!$result) {
  echo "Error executing query: " . mysqli_error($conn);
  // Handle the error appropriately
} else {
  while ($user = mysqli_fetch_assoc($result)) {
    $subscriptionEndDate = $user['s_end_date'];

    // Compare the subscription end date with the current date
    $currentDate = date('Y-m-d');
    $isPremiumUser = ($subscriptionEndDate >= $currentDate);
  }
}
?>
<main id="main">



  <div class="container-fluid">
    <div class="row">
      <img src="../../assets/magazine/img/MagazineBanner1.png" class="img-fluid" alt="" style="width: 100%; padding: 0">
    </div>
  </div>


  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-1">&nbsp;</div>
      <div class="col-md-10">
        <div class="container-fluid mb-3">
          <div class="row d-flex justify-content-center">
            <div class="col-md-2 p-5 order-1">
              <div class="col-lg-1 border-start border-danger border-2 bg-white col-12" style="padding-left:20px;">
                <p class="text-black fs-3 fw-bolder">YEAR</p>
                <div id="accordionExample">
                  <?php
                  // Retrieve the year data from the URL parameter
                  $year = isset($_GET['year']) ? (int)$_GET['year'] : null;

                  // Get all distinct years with magazines in the database
                  $year_query = "SELECT DISTINCT YEAR(m_rDate) AS year FROM tb_magazines ORDER BY m_rDate DESC";
                  if ($year) {
                    $year_query = "SELECT DISTINCT YEAR(m_rDate) AS year FROM tb_magazines WHERE YEAR(m_rDate) = $year ORDER BY m_rDate DESC";
                  }
                  $year_result = mysqli_query($conn, $year_query);

                  // Loop through each year
                  while ($year_row = mysqli_fetch_assoc($year_result)) {
                    $year = $year_row['year'];
                    $months = array();
                    $endMonth = ($isPremiumUser) ? 12 : 6; // Determine the end month based on the user's premium status

                    // Loop through each month for the current year
                    for ($month = 1; $month <= $endMonth; $month++) {
                      $month_query = "SELECT COUNT(*) as total FROM tb_magazines WHERE YEAR(m_rDate) = $year AND MONTH(m_rDate) = $month";
                      $month_result = mysqli_query($conn, $month_query);
                      $month_count = mysqli_fetch_assoc($month_result)['total'];
                      $month_name = date('F', mktime(0, 0, 0, $month, 1, $year));

                      if ($month_count > 0) {
                        $months[] = '<li><a class="text-secondary" href="magazine-view-month.php?year=' . $year . '&month=' . $month . '">' . $month_name . '</a></li>';
                      } else {
                        $months[] = '<li><a class="text-secondary" href="magazine-view-month.php?year=' . $year . '&month=' . $month . '">' . $month_name . '</a></li>';
                      }
                    }

                    // Display the year and months in the accordion
                    echo '<div>';
                    echo '<h2 id="heading' . $year . '">';
                    echo '<li class="list-unstyled collapsed" onclick="toggleDropdown(\'collapse' . $year . '\')" aria-expanded="true" aria-controls="collapse' . $year . '"><span class="text-danger fs-4 me-3">&gt;</span><span class="text-black fs-5">' . $year . '</span></li>';
                    echo '</h2>';
                    echo '<div id="collapse' . $year . '" class="collapse" aria-labelledby="heading' . $year . '" data-bs-parent="#accordionExample">';
                    echo '<div>';
                    echo '<ul class="list-unstyled">';
                    echo implode("\n", $months);
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                  }
                  ?>
                </div>
              </div>
            </div>

            <?php
            $rows_per_page = 9; // set the number of rows to display per page
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // get the current page number from the URL
            ?>
            <?php
            $offset = ($current_page - 1) * $rows_per_page; // calculate the number of rows to skip
            $query = $conn->query("SELECT * FROM `tb_magazines`");
            if (mysqli_num_rows($query) > 0) {
              $image_count = 0;
            ?>
              <div class="col-md-10">
                <div class="container-fluid">
                  <div class="row mt-3">
                    <?php
                    while ($rows = mysqli_fetch_object($query)) {
                      $image_path = $rows->m_imgPath; // fetch image path from database
                      $m_id = $rows->m_id; // fetch id from database
                      $date = date_create($rows->m_rDate);
                      $year = date_format($date, "Y");
                      $month = date_format($date, "m");
                      if ($month >= 1 && $month <= 6) {
                        $image_count++;
                        if ($image_count > $offset && $image_count <= ($offset + $rows_per_page)) {
                    ?>
                          <div class="col-md-4 p-5" data-toggle="modal" data-target="#globalModal">
                            <a href="../magazine/flip/index.php?pageNum=1&m_id=<?php echo $m_id; ?>">
                              <img src="../<?= $image_path ?>" class="img-fluid" alt="">
                            </a>
                          </div>
                    <?php
                        }
                      }
                    }
                    ?>

                  <?php
                }

                $total_rows = $image_count; // Total number of images from January to June (10 pages * 3 images per page)
                $total_pages = ceil($total_rows / $rows_per_page); // calculate the total number of pages
                if ($total_pages > 1) {
                  ?>
                    <div class="col-md-10">
                      <div class="container-fluid">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center">
                            <?php
                            if ($current_page > 1) {
                              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                              echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($current_page < $total_pages) {
                              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                            }
                            ?>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  <?php
                }
                  ?>


                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <div class="col-md-1">&nbsp;</div>
    </div>
  </div>



</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../../commonPHP/jsFiles.php"); ?>

</body>

<script>
  function toggleDropdown(collapseId) {
    const collapse = document.getElementById(collapseId);
    const accordions = document.querySelectorAll('[id^="collapse"]');
    accordions.forEach(acc => {
      if (acc.id !== collapseId && acc.classList.contains('show')) {
        acc.classList.remove('show');
      }
    });
    if (collapse.classList.contains('show')) {
      collapse.classList.remove('show');
    } else {
      collapse.classList.add('show');
    }
  }
</script>
<script>
  $(document).ready(function() {
    $("#search-input").on("keyup", function() {
      var searchText = $(this).val().toLowerCase();
      $(".tab-pane.show.active .col-md-4").filter(function() {
        var title = $(this).find(".text-black").text().toLowerCase();
        return title.indexOf(searchText) == -1;
      }).hide();
      $(".tab-pane.show.active .col-md-4").filter(function() {
        var title = $(this).find(".text-black").text().toLowerCase();
        return title.indexOf(searchText) != -1;
      }).show();
    });
  });
</script>


</html>