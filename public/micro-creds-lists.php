<?php
    include('function/function.php');
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

    $totalMC = 0;
    if($mcInfo->fetch_microcredentials() !== NULL) {
        $totalMC = count($mcInfo->fetch_microcredentials());
    } else {
        $totalMC = 0;
    }
?>

    <!-- Page header -->
    <div class="bg-primary py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="mb-0 text-white display-4">Micro-credentials</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="pt-6">
        <div class="container">
            <div class="row">
                <!-- Course count / Change display / Sort content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="row d-lg-flex justify-content-between align-items-center">
                        <div class="col-md-6 col-lg-8 col-xl-9 ">
                            <h4 class="mb-3 mb-lg-0">
                                Displaying <span id="displayCount"><?= $totalMC ?></span> out of <span id="totalCount"><?= $totalMC ?></span> micro-credentials
                            </h4>
                        </div>
                        <div class="d-inline-flex col-md-6 col-lg-4 col-xl-3 justify-content-end">
                            <div class="me-2">
                                <!-- Nav -->
                                <div class="nav btn-group flex-nowrap" role="tablist">
                                    <button class="btn btn-outline-white active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid" role="tab"
                                    aria-controls="tabPaneGrid" aria-selected="true">
                                        <span class="fe fe-grid"></span>
                                    </button>
                                    <button class="btn btn-outline-white" data-bs-toggle="tab" data-bs-target="#tabPaneList" role="tab"
                                    aria-controls="tabPaneList" aria-selected="false">
                                        <span class="fe fe-list"></span>
                                    </button>
                                </div>
                            </div>
                            <!-- List  -->
                            <!-- <select class="selectpicker" data-width="100%">
                                <option value="">Sort by</option>
                                <option value="Newest">Newest</option>
                                <option value="Free">Free</option>
                                <option value="Most Popular">Most Popular</option>
                            </select> -->
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
                            <span class="dropdown-header px-0 mb-0 mt-4 ms-4"> Institutions</span>
                            <div class="d-flex w-auto" style="max-height: 300px;">
                                <div id="institution" class="d-flex flex-column py-2 overflow-auto pe-1">
                            <?php
                                $institutionInfo = $conn->query("SELECT u.university_id, u.university_name, i.institution_id, i.institution_user_id 
                                                            FROM `institution` AS i 
                                                            LEFT JOIN `university` AS u ON i.institution_university_id = u.university_id 
                                                            ORDER BY u.university_name;");
                                $institutionInfoNumRows = mysqli_num_rows($institutionInfo);

                                for($i = 0; $i < $institutionInfoNumRows; $i++) {
                                    $institutionInfoRow = mysqli_fetch_object($institutionInfo);
                            ?>
                                    <!-- Checkbox -->
                                    <div class="d-block">
                                        <div class="form-check mb-1 ms-4 me-2">
                                            <input type="checkbox" class="form-check-input" id="inst-<?= $institutionInfoRow->university_id ?>" name="inst" value="<?= $institutionInfoRow->institution_id ?>">
                                            <label class="form-check-label" for="inst-<?= $institutionInfoRow->university_name ?>"><?= $institutionInfoRow->university_name ?></label>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                                </div>
                            </div>
                        </div>
                        <!-- Academic Level -->
                        <div id="acadLevel" class="card-body border-top">
                            <span class="dropdown-header px-0 mb-2"> Academic Level</span>
                            <!-- Checkbox -->
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="acadlvl-ug" name="acad_lvl" value="1">
                                <label class="form-check-label" for="acadlvl-ug">Undergraduate</label>
                            </div>
                            <!-- Checkbox -->
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="acadlvl-pg" name="acad_lvl" value="2">
                                <label class="form-check-label" for="acadlvl-pg">Postgraduate</label>
                            </div>
                            <!-- Checkbox -->
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" for="acadlvl-cpd" name="acad_lvl" value="3">
                                <label class="form-check-label" for="acadlvl-cpd">Continuing and Professional Development</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Micro-credentials lists -->
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
                            <!-- Micro-credential grid list contents -->
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
                            <!-- Micro-credential tab list contents -->
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