<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>

<body>
    <!-- Navbar -->
    <?php
    include('pages-topbar.php');

    $totalCourse = 0;
    if ($courseInfo->fetch_courses() !== NULL) {
        $totalCourse = count($courseInfo->fetch_courses());
    } else {
        $totalCourse = 0;
    }
    ?>

    <!-- Page header -->
    <div class="bg-primary py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="mb-0 text-white display-4">Courses</h1>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="row d-lg-flex justify-content-between align-items-center">
                        <div class="col-md-6 col-lg-8 col-xl-9 ">
                            <h4 class="mb-3 mb-lg-0">
                                Displaying <span id="displayCount"><?= $totalCourse ?></span> out of <span id="totalCount"><?= $totalCourse ?></span> courses
                            </h4>
                        </div>
                        <div class="d-inline-flex col-md-6 col-lg-4 col-xl-3 justify-content-end">
                            <div class="me-2">
                                <!-- Nav -->
                                <div class="nav btn-group flex-nowrap" role="tablist">
                                    <button class="btn btn-outline-white active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid" role="tab" aria-controls="tabPaneGrid" aria-selected="true">
                                        <span class="fe fe-grid"></span>
                                    </button>
                                    <button class="btn btn-outline-white" data-bs-toggle="tab" data-bs-target="#tabPaneList" role="tab" aria-controls="tabPaneList" aria-selected="false">
                                        <span class="fe fe-list"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter -->
                <div id="filter" class="col-xl-3 col-lg-3 col-md-4 col-12 mb-4 mb-lg-0">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h4 class="mb-0">Filter</h4>
                        </div>
                         <!-- Institutions -->
                         <div class="card-body border-top p-0 mb-2">
    <span class="dropdown-header px-0 mb-0 mt-4 ms-4">Institutions</span>
    <div class="d-flex w-auto" style="max-height: 300px;">
    <div id="institution" class="d-flex flex-column py-2 overflow-auto pe-1">
        <?php
        $query = "SELECT id, course_owner_name
        FROM (
            SELECT
                CASE
                    WHEN r.role_name = 'Administrator' THEN a.admin_user_id
                    WHEN r.role_name = 'Committee' THEN c.committee_id
                    WHEN r.role_name = 'Expert' THEN e.expert_id
                    WHEN r.role_name = 'Lecturer' THEN l.lecturer_id
                END AS id,
                CASE
                    WHEN r.role_name = 'Administrator' THEN CONCAT(a.admin_name, ' (Administrator)')
                    WHEN r.role_name = 'Committee' THEN CONCAT(c.committee_name, ' (Committee)')
                    WHEN r.role_name = 'Expert' THEN CONCAT(e.expert_fname, ' ', e.expert_lname, ' (Expert)')
                    WHEN r.role_name = 'Lecturer' THEN CONCAT(l.lecturer_fname, ' ', l.lecturer_lname, ' (Lecturer)')
                END AS course_owner_name
            FROM `user` AS u
            INNER JOIN `role` AS r ON u.user_role_id = r.role_id
            LEFT JOIN `admin` AS a ON u.user_id = a.admin_user_id AND a.admin_deleted_date IS NULL
            LEFT JOIN `committee` AS c ON u.user_id = c.committee_user_id AND c.committee_deleted_date IS NULL
            LEFT JOIN `expert` AS e ON u.user_id = e.expert_user_id AND e.expert_deleted_date IS NULL
            LEFT JOIN `lecturer` AS l ON u.user_id = l.lecturer_user_id AND l.lecturer_deleted_date IS NULL
            WHERE u.user_deleted_date IS NULL
        ) AS subquery
        WHERE course_owner_name IS NOT NULL;
        ";

        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $courseOwnerName = $row['course_owner_name'];
                $c_id = $row['id'];
                ?>
                <!-- Checkbox -->
                <div class="d-block">
                    <div class="form-check mb-1 ms-4 me-2">
                        <input type="checkbox" class="form-check-input" id="inst-<?= $c_id ?>" name="inst" value="<?= $c_id ?>">
                        <label class="form-check-label" for="inst-<?= $c_id ?>"><?= $c_id . $courseOwnerName ?></label>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }
        ?>
    </div>
</div>


</div>

                        <!-- Academic Level --> 
                        <div id="acadLevel" class="card-body border-top">
                            <span class="dropdown-header px-0 mb-2"> Academic Level</span>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="acadlvl-ug" name="acad_lvl" value="1">
                                <label class="form-check-label" for="acadlvl-ug">Undergraduate</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="acadlvl-pg" name="acad_lvl" value="2">
                                <label class="form-check-label" for="acadlvl-pg">Postgraduate</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" for="acadlvl-cpd" name="acad_lvl" value="3">
                                <label class="form-check-label" for="acadlvl-cpd">Continuing and Professional Development</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses lists -->
                <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                    <div class="tab-content">
                        <!-- Tab pane grid -->
                        <div class="tab-pane fade show active pb-4" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                            <!-- Loading contents -->
                            <div class="d-flex justify-content-center">
                                <div id="gridLoad" class="spinner-border text-warning mt-6 mb-4 collapse" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <!-- Course grid list contents -->
                            <div id="gridList" class="row">
                                <!-- contents here -->
                            </div>
                        </div>
                        <!-- Tab pane list -->
                        <div class="tab-pane fade pb-4" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
                            <!-- Loading contents -->
                            <div class="d-flex justify-content-center">
                                <div id="tabLoad" class="spinner-border text-warning mt-6 mb-4 collapse" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <!-- Course tab list contents -->
                            <div id="tabList">
                                <!-- contents here -->
                            </div>
                        </div>
                        <!-- Load more -->
                        <div class="d-flex justify-content-center">
                            <button id="load-more" class="btn btn-primary collapse">Load more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    require_once("pages-footer.php");
    ?>

    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Filter JS -->
    <script src="js/catalog.js"></script>

</body>

</html>