<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
?>

<body>
    <!-- Top navigation -->
<?php
    include('pages-topbar.php');
    
?>

    <div class="p-lg-5 py-5">
        <div class="container">
            <!-- Video section -->
           
          
            <!-- Content body -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                    <!-- Micro-creds informations -->
                    
                    <!-- Course contents -->
                    <div class="card rounded-3">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <!-- Learning outcomes -->
                               
                                

                                
                               
                                <!-- Test -->
                                
                                    <h3 class="mb-2">Test</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        They are used to determine whether you have learned what you were expected to learn or to level or degree to which you have 
                                        learned the material. It is also to gather relevant information about your performance or progress, or to determine 
                                        your interests to make judgments about your learning process.
                                    </p>
                                    <!-- Test Lists -->
                            <?php
                            
                                $ptTest = $ptInfo->fetch_ltquiz($suID);
                                if($ptTest === NULL) {
                            ?>
                                    <!-- ## No Contents -->
                                    <div class="mt-4 mb-4 text-center">
                                        <h3 class="display-5">Sorry! There's no content available.</h3>
                                        <p class="lead">The instructor will add this soon.</p>
                                    </div>
                            <?php
                                } else {
                                    for($i = 0; $i < count($ptTest); $i++) {
                                        $checkIcon = "";

                                        // Check if the test already attempted or not.
                                        $mctResult = $ptInfo->fetch_ltquiz_result($ptTest[$i]["pt_id"]);
                                        if($mctResult !== NULL) {
                                            $checkIcon =  '<span class="badge rounded-pill bg-success" data-bs-toggle="tooltip" data-placement="top" title="Completed">Completed</span>';
                                            $score = "<span class='text-dark'>".$mctResult["supttrs_grade"]."</span>";
                                            $attemptBtn = "collapse";
                                            $reviewBtn = "";
                                        } else {
                                            $score = 0;
                                            $attemptBtn =0;
                                            $reviewBtn = "collapse";
                                        }
                            ?>
                                    <div class="card border">
                                        <div class="card-header" id="testHeading<?= $i + 1 ?>">
                                            <h4 class="mb-0">
                                                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" 
                                                  data-bs-target="#testCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="testCollapse<?= $i + 1 ?>">
                                                    <div class="me-auto">
                                                        <?= $ptTest[$i]["pt_title"] ?>
                                                        <?= $checkIcon ?>
                                                    </div>
                                                    <span class="chevron-arrow ms-4">
                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                    </span>
                                                </a>
                                            </h4>
                                            <p class="mb-0">
                                                <small>Date created: <?= date_format(date_create($ptTest[$i]["pt_created_date"]), "d/m/Y") ?></small>
                                            </p>
                                        </div>
                                        <!-- ## to show the content = add 'show' to [class] -->
                                        <div id="testCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="testHeading<?= $i + 1 ?>" data-bs-parent="#test">
                                            <div class="card-body">
                                                <?= $ptTest[$i]["pt_instruction"] ?>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <tr>
                                                            <th class="table-primary" scope="row">Attempt</th>
                                                            <td><?= $attemptBtn ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary" scope="row">Time limit</th>
                                                            <td><?= $ptTest[$i]["pt_duration"] !== NULL ? durationFormat($ptTest[$i]["pt_duration"], '%2d Hours and %2d Minutes') : "<span><em>Not set</em></span>" ?></td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                                <!-- Button trigger modal -->
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <button type="button" class="btn btn-primary <?= $attemptBtn ?>" 
                                                        onclick="window.open('psychometric-test-attempt-main.php?pt_id=<?= $ptTest[$i]['pt_id'] ?>', '_self');">
                                                        Start attempt
                                                    </button>
                                                    <button type="button" class="btn btn-danger <?= $reviewBtn ?>"
                                                        onclick="window.open('?pt_id=<?= $ptTest[$i]['pt_id'] ?>', '_self');">
                                                        Completed Test 
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    
                            <?php
                                    }
                                }
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>

  <!-- Footer -->
<?php
    include('pages-footer.php');
?>


    <!-- Scripts -->
    <!-- Chat JS -->
    <script src="js/student-chat.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Dropzone JS -->
    <script src="js/learning-material.js"></script>

    <!-- For navigation -->
    <script type="text/javascript">
        // Tab navigation.
        $("#tab > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?mc_id=<?= $mcID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);
        });

        // Sidebar navigation.
        $("#material > ul > li > a").click(function() {
            var id = $(this).data("id");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?mc_id=<?= $mcID ?>&pill=" + id;

            // --- change the link query values.
            window.history.pushState("", "", link);

            $("#tab > li > a").each(function() {
                var tabID = $(this).data("id");

                // --- show content if id match.
                if(id == tabID) {
                    $(this).addClass("active");
                    $("#" + tabID).removeClass("disabled").addClass("show active");
                } else {
                    $(this).removeClass("active");
                    $("#" + tabID).removeClass("show active").addClass("disabled");
                }
            });
        });
    </script>

</body>

</html>