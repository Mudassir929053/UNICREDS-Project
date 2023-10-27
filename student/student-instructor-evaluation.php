<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php
    include('pages-head.php');
?>

<body>
    <!-- Top navigation -->
<?php
    include('pages-topbar.php');
?>
    <!-- Page header -->
    <div class="bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="py-4 py-lg-6">
                        <h1 class="mb-0 text-white display-4 text-center">Instructor Evaluation</h1>
                        <p class="text-white mb-0 lead text-center">
                            Instructor Name
                        </p>
                        <p class="text-white mb-0 lead text-center">
                            <em>Course/MC Modules Title</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluation status -->
    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div><strong>DONE!</strong> You're already submitted the evaluations.</div>
            </div>
        </div>
    </div>

    <!-- Evaluation questions -->
    <div class="d-flex justify-content-center">
        <div class="w-75">
            <form id="instEvalForm" method="post" enctype="multipart/form-data">
                <!-- Part 1 -->
                <div class="card mt-md-4 mb-4">
                    <!-- Card header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Notification -->
                            <h3 class="mb-0">Title One</h3>
                            <p class="mb-0">
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <p class="text-danger mb-0 mt-2 text-end">
                                <em>Do not refresh the page if you didn't want to lose all your answers.</em>
                            </p>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Subquestions 1 -->
                        <div class="mb-5">
                            <h4 class="mb-0">Subtitle One</h4>
                            <p>
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                    <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>1. Use toggle for this questions to choose if its true or not.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="s1q1" name="s1q1" value="true" />
                                            <label class="form-check-label" for="s1q1"></label>
                                        </div>
                                    </div>
                                </li>
                                    <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>2. Use toggle for this questions to choose if its true or not.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="s1q2" name="s1q2" value="true" />
                                            <label class="form-check-label" for="s1q2"></label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Subquestions 2 -->
                        <div class="">
                            <h4 class="mb-0">Subtitle Two</h4>
                            <p>
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <!-- List group-->
                            <ul class="list-group list-group-flush">
                                    <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>1. Use toggle for this questions to choose if its true or not.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="s2q1" name="s2q1" value="true" />
                                            <label class="form-check-label" for="s2q1"></label>
                                        </div>
                                    </div>
                                </li>
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>2. Use toggle for this questions to choose if its true or not.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="s2q2" name="s2q2" value="true" />
                                            <label class="form-check-label" for="s2q2"></label>
                                        </div>
                                    </div>
                                </li>
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>3. Use toggle for this questions to choose if its true or not.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="s2q3" name="s2q3" value="true" />
                                            <label class="form-check-label" for="s2q3"></label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Part 2 -->
                <div class="card mt-md-4 mb-4">
                    <!-- Card header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Notification -->
                            <h3 class="mb-0">Title Two</h3>
                            <p class="mb-0">
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <p class="text-danger mb-0 mt-2 text-end">
                                <em>Do not refresh the page if you didn't want to lose all your answers.</em>
                            </p>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Instructions legends -->
                        <div class="mb-5 row bg-light m-2 p-1 border border-dark shadow-sm">
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Strongly Disagree</p>
                                    <p class="text-center mb-0">1</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Disagree</p>
                                    <p class="text-center mb-0">2</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Neutral</p>
                                    <p class="text-center mb-0">3</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Agree</p>
                                    <p class="text-center mb-0">4</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Strongly Agree</p>
                                    <p class="text-center mb-0">5</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="align-items-center">
                                    <p class="h5 text-center">Not Applicable</p>
                                    <p class="text-center mb-0">0</p>
                                </div>
                            </div>
                        </div>
                        <!-- Subquestions 1 -->
                        <div class="">
                            <h4 class="mb-0">Subtitle One</h4>
                            <p>
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item 1 -->
                                <li class="list-group-item px-0 py-2">
                                    <div class="row align-items-center">
                                        <!-- Question -->
                                        <div class="col-12 col-md-6">
                                            <div>1. Use radio toggle for this questions to choose the answers.</div>
                                        </div>
                                        <!-- Answer range -->
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer1" class="btn-check" name="question1" value="1" autocomplete="off">
                                                    <label for="q1Answer1" class="btn btn-outline-success">1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer2" class="btn-check" name="question1" value="2" autocomplete="off">
                                                    <label for="q1Answer2" class="btn btn-outline-success">2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer3" class="btn-check" name="question1" value="3" autocomplete="off" checked>
                                                    <label for="q1Answer3" class="btn btn-outline-success">3</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer4" class="btn-check" name="question1" value="4" autocomplete="off">
                                                    <label for="q1Answer4" class="btn btn-outline-success">4</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer5" class="btn-check" name="question1" value="5" autocomplete="off">
                                                    <label for="q1Answer5" class="btn btn-outline-success">5</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q1Answer0" class="btn-check" name="question1" value="0" autocomplete="off">
                                                    <label for="q1Answer0" class="btn btn-outline-success">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- List group item 2 -->
                                <li class="list-group-item px-0 py-2">
                                    <div class="row align-items-center">
                                        <!-- Question -->
                                        <div class="col-12 col-md-6">
                                            <div>2. Use radio toggle for this questions to choose the answers.</div>
                                        </div>
                                        <!-- Answer range -->
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer1" class="btn-check" name="question2" value="1" autocomplete="off">
                                                    <label for="q2Answer1" class="btn btn-outline-success">1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer2" class="btn-check" name="question2" value="2" autocomplete="off">
                                                    <label for="q2Answer2" class="btn btn-outline-success">2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer3" class="btn-check" name="question2" value="3" autocomplete="off" checked>
                                                    <label for="q2Answer3" class="btn btn-outline-success">3</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer4" class="btn-check" name="question2" value="4" autocomplete="off">
                                                    <label for="q2Answer4" class="btn btn-outline-success">4</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer5" class="btn-check" name="question2" value="5" autocomplete="off">
                                                    <label for="q2Answer5" class="btn btn-outline-success">5</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q2Answer0" class="btn-check" name="question2" value="0" autocomplete="off">
                                                    <label for="q2Answer0" class="btn btn-outline-success">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- List group item 3 -->
                                <li class="list-group-item px-0 py-2">
                                    <div class="row align-items-center">
                                        <!-- Question -->
                                        <div class="col-12 col-md-6">
                                            <div>3. Use radio toggle for this questions to choose the answers.</div>
                                        </div>
                                        <!-- Answer range -->
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer1" class="btn-check" name="question3" value="1" autocomplete="off">
                                                    <label for="q3Answer1" class="btn btn-outline-success">1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer2" class="btn-check" name="question3" value="2" autocomplete="off">
                                                    <label for="q3Answer2" class="btn btn-outline-success">2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer3" class="btn-check" name="question3" value="3" autocomplete="off" checked>
                                                    <label for="q3Answer3" class="btn btn-outline-success">3</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer4" class="btn-check" name="question3" value="4" autocomplete="off">
                                                    <label for="q3Answer4" class="btn btn-outline-success">4</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer5" class="btn-check" name="question3" value="5" autocomplete="off">
                                                    <label for="q3Answer5" class="btn btn-outline-success">5</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-1">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <input type="radio" id="q3Answer0" class="btn-check" name="question3" value="0" autocomplete="off">
                                                    <label for="q3Answer0" class="btn btn-outline-success">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Part 3 -->
                <div class="card mt-md-4 mb-4">
                    <!-- Card header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Notification -->
                            <h3 class="mb-0">Title Three</h3>
                            <p class="mb-0">
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <p class="text-danger mb-0 mt-2 text-end">
                                <em>Do not refresh the page if you didn't want to lose all your answers.</em>
                            </p>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Subquestions 1 -->
                        <div class="">
                            <h4 class="mb-0">Subtitle One</h4>
                            <p>
                                Instructions on how to fill in the evaluation form.
                            </p>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div class="input-group">
                                        <span class="input-group-text">Comments<br>(Optional)</span>
                                        <textarea class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Submission -->
                <div class="card mt-md-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-items-center justify-content-center">
                            <div class="d-grid gap-2 col-4">
                                <button class="btn btn-outline-danger" type="reset" name="instEvalSubmit">Clear All</button>
                            </div>
                            <div class="d-grid gap-2 ms-3 col-4">
                                <button class="btn btn-primary" type="submit" name="instEvalSubmit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
<?php
    include('pages-footer.php');
?>


  <!-- Scripts -->
  
  
  <!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>

</body>
</html>