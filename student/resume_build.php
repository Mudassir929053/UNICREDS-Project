<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');

?>

<?php
include('pages-topbar.php');
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<!-- Country, State, City JS -->
<script src="js/region.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="../assets/js/theme.min.js"></script>



<head>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        /*Background color*/
        #grad1 {

            background-image: linear-gradient(120deg, #FF4081, #81D4FA);
        }

        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px;
        }

        #msform fieldset .form-card {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            padding: 20px 40px 30px 40px;
            box-sizing: border-box;
            width: 94%;
            margin: 0 3% 20px 3%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        #msform fieldset .form-card {
            text-align: left;
            color: #9E9E9E;
        }

        #msform input,
        #msform textarea {
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            /* font-family: montserrat; */
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px;
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid skyblue;
            outline-width: 0;
        }

        /*Blue Buttons*/
        #msform .action-button {
            width: 100px;
            background: skyblue;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
        }

        /*Previous Buttons*/
        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
        }

        /*Dropdown List Exp Date*/
        select.list-dt {
            border: none;
            outline: 0;
            border-bottom: 1px solid #ccc;
            padding: 2px 5px 3px 5px;
            margin: 2px;
        }

        select.list-dt:focus {
            border-bottom: 2px solid skyblue;
        }

        /*The background card*/
        .card {
            z-index: 0;
            border: none;
            border-radius: 0.5rem;
            position: relative;
        }

        /*FieldSet headings*/
        .fs-title {
            font-size: 25px;
            color: #2C3E50;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey;
        }

        #progressbar .active {
            color: #000000;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 12px;
            width: 25%;
            float: left;
            position: relative;
        }

        /*Icons in the ProgressBar*/
        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f023";
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f007";
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f09d";
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c";
        }

        /*ProgressBar before any progress*/
        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px;
        }

        /*ProgressBar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1;
        }

        /*Color number of the step and the connector before it*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: skyblue;
        }

        /*Imaged Radio Buttons*/
        .radio-group {
            position: relative;
            margin-bottom: 25px;
        }


        .radio {
            display: inline-block;
            width: 204;
            height: 104;
            border-radius: 0;
            background: lightblue;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            cursor: pointer;
            margin: 8px 2px;
        }

        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .radio.selected {
            box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
        }

        /*Fit image in bootstrap div*/
        .fit-image {
            width: 100%;
            object-fit: cover;
        }

        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;

            position: relative;
            text-align: center;
            cursor: default;
        }



        .hovereffect img {
            display: block;
            position: relative;
            -webkit-transition: all .4s linear;
            transition: all .4s linear;
        }






        .hovereffect:hover img {
            -ms-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
        }



        #tooltip {
            position: relative;
            cursor: pointer;

            font-size: 15px;
            /* font-weight: bold; */
            font-family: sans-serif;
        }

        #tooltipText {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            background-color: #000;
            color: #fff;
            white-space: nowrap;
            padding: 10px 15px;
            border-radius: 7px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease;

        }

        #tooltipText::before {
            border: 15px solid;
            border-color: #000 #0000 #0000;
        }

        #tooltip:hover #tooltipText {
            top: -130%;
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>

    <!-- MultiStep Form -->
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0" style="width:100%;">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>Personal Details</strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <div id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>Profile Picture</strong></li>
                                    <li id="personal"><strong>Personal</strong></li>
                                    <li id="payment"><strong>Experience</strong></li>
                                    <li id="confirm"><strong>Templatese</strong></li>
                                </ul>
                                <!-- fieldsets -->

                                <fieldset>
                                    <div class="form-card">

                                        <div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
                                            <div class="d-flex align-items-center">

                                                <div class="lh-1">
                                                    <h2 class="mb-0"> Profile </h2>
                                                </div>
                                            </div>
                                            <div>
                                                <div id="tooltip">
                                                    <span id="tooltipText">1. Your profile is always placed at the top of your resume.<br>2. Describe yourself in short and strong terms with both the vacancy and job title in mind.Do not use one line,but try to be as concise as possible.<br>3. Create a good profile by mentioning each of the following at the very least: achievments,quilities,goals and what are you looking for.</span>
                                                    <span><i class="fa bala">&#xf0eb;</i> Tips</span>
                                                </div>
                                                </a>
                                            </div>
                                        </div>


                                        <!-- <input type="email" name="email" placeholder="Email Id"/>
                                    <input type="text" name="uname" placeholder="UserName"/>
                                    <input type="password" name="pwd" placeholder="Password"/>
                                    <input type="password" name="cpwd" placeholder="Confirm Password"/> -->


                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="function/student-profile.php" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title h4" id="profilePicModalTitle">Profile Picture</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <ul class="nav nav-pills d-flex justify-content-center mt-0 mb-3" role="tablist">
															<li class="nav-item" data-bs-toggle="tooltip" data-placement="top" title="Upload photo">
																<button type="button" class="nav-link active btn btn-icon" id="uploadPhotoButton" data-bs-toggle="pill" href="#courseCoverImg" role="tab" aria-controls="courseCoverImg" aria-selected="true">
																	<i class="fe fe-upload"></i>
																</button>
															</li>
															<li class="nav-item ms-2" data-bs-toggle="tooltip" data-placement="top" title="Capture photo">
																<button type="button" class="nav-link btn btn-icon" id="capturePhotoButton" data-bs-toggle="pill" href="#capturePhotoPills" role="tab" aria-controls="capturePhotoPills" aria-selected="false">
																	<i class="fe fe-camera"></i>
																</button>
															</li>
														</ul> -->
                                                        <div class="tab-content">
                                                            <!-- File upload preview -->
                                                            <div data-upload-id="courseCoverImg" role="tabpanel" aria-labelledby="uploadPhotoButton">
                                                                <!-- picture preview -->
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="custom-file-container__image-preview border border-primary rounded-circle" style="width: 250px;"></div>
                                                                </div>
                                                                <label class="form-label">Profile picture
                                                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                                </label>
                                                                <!-- picture upload -->
                                                                <label class="custom-file-container__custom-file">
                                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="profilePic" accept=".jpg, .jpeg, .png" required />
                                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                </label>
                                                                <small class="mt-3 d-block">
                                                                    Important guidelines: no bigger than 800 pixels; .jpg, .jpeg, or .png.
                                                                </small>

                                                            </div>
                                                            <!-- Capture profile photo -->
                                                            <!-- <div class="tab-pane fade" id="capturePhotoPills" role="tabpanel" aria-labelledby="capturePhotoButton">
																<div class="d-flex justify-content-center mb-3">
																	<video class="border border-primary" id="videoCamera" width="320" height="240" autoplay></video>
																</div>
																<div class="d-flex justify-content-center">
																	<button type="button" class="btn btn-outline-info btn-sm" id="clickCapture">Capture</button>
																</div>
																<p>Upload this photo?</p>
																<div class="d-flex justify-content-center mt-4">
																	<canvas class="collapse" id="showCapture" width="320" height="240"></canvas>
																</div>
															</div> -->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" name="upProfilePic" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <a href="student-manage-portfolio.php" class="btn btn-secondary">Back</a>
                                    <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
                                            <div class="d-flex align-items-center">

                                                <div class="lh-1">
                                                    <h2 class="mb-0"> Personal Information </h2>
                                                </div>
                                            </div>
                                            <div>
                                                <div id="tooltip">
                                                    <span id="tooltipText">1. Please fill up your complete personal details like Name,Contact number,Links etc. Without any false details.<br>2. Please watchout for links and attachments Weather they are working properly or not.<br>3. Consider to fill-up additional information without any hesitation.<br>4. Please save the form after entering the complete details.</span>
                                                    <span><i class="fa bala">&#xf0eb;</i> Tips</span>
                                                </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bala">

                                            <form id="updateProfileForm" id='q' action="function/student-profile.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="updateProfileLabel">Update Profile</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="fnameSU">First Name <span class="text-danger">*<span></label>
                                                            <input type="text" name="fnameSU" value="<?= $suInfoRow["su_fname"] ?>" id="fnameSU" class="form-control" placeholder="First Name" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="lnameSU">Last Name <span class="text-danger">*<span></label>
                                                            <input type="text" name="lnameSU" value="<?= $suInfoRow["su_lname"] ?>" id="lnameSU" class="form-control" placeholder="Last Name" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="linkedinSU">Linked in <span class="text-danger">*<span></label>
                                                            <input type="text" name="linkedinSU" value="<?= $suInfoRow["su_linked_in"] ?>" id="linkedinSU" class="form-control" placeholder="Linked in link" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="icnumSU">I/C Number <span class="text-danger">*<span></label>
                                                            <input type="text" name="icnumSU" value="<?= $suInfoRow["su_no_ic"] ?>" id="icnumSU" class="form-control" placeholder="I/C Number" required>
                                                            <small class="text-muted">No need to add spaces or any symbols, eg. <strong>980101015152</strong></small>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="passSU">Passport </label>
                                                            <input type="text" name="passSU" value="<?= $suInfoRow["su_passport_no"] !== NULL ? $suInfoRow["su_passport_no"] : "" ?>" id="passSU" class="form-control" placeholder="Passport">
                                                            <small class="text-muted">No need to add spaces or any symbols, eg. <strong>A22242698</strong></small>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="phoneSU">Phone Number <span class="text-danger">*<span></label>
                                                            <input type="text" name="phoneSU" value="<?= $suInfoRow["su_contact_no"] ?>" id="phoneSU" class="form-control" placeholder="Phone" maxlength="10" required>
                                                            <small class="text-muted">No need to add spaces or any symbols, eg. <strong>01123456789</strong></small>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="natSU">Nationality <span class="text-danger">*<span></label>
                                                            <input type="text" name="natSU" value="<?= $suInfoRow["su_nationality"] ?>" id="natSU" class="form-control" required>
                                                        </div>



                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="dobSU">Date of Birth <span class="text-danger">*<span></label>
                                                            <input type="date" name="dobSU" value="<?= $suInfoRow["su_dob"] ?>" id="dobSU" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="genderSU">Gender <span class="text-danger">*<span></label>
                                                            <select name="genderSU" id="genderSU" class="selectpicker w-100" required>
                                                                <option value="Male" <?= $suInfoRow["su_gender"] === "Male" ? "selected" : "" ?>>Male</option>
                                                                <option value="Female" <?= $suInfoRow["su_gender"] === "Female" ? "selected" : "" ?>>Female</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="addrSU">Address Line <span class="text-danger">*<span></label>
                                                            <input type="text" name="addrSU" value="<?= $suInfoRow["su_address"] ?>" id="addrSU" class="form-control" placeholder="Address" required>
                                                            <small class="text-muted">Home/Lot/Building no., Street name</small>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label">Country <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="countryID" id="countrySU" data-country-id="<?= $suInfoRow["su_country_id"] ?>" data-width="100%" onchange="fetchState(this.id, this.value)" required>
                                                                <option value="" disabled>Select Country</option>
                                                                <?php
                                                                $countryInfo = $conn->query("SELECT * 
																						FROM `country` 
																						ORDER BY country_name");
                                                                $countryInfoNumRow = mysqli_num_rows($countryInfo);

                                                                for ($j = 0; $j < $countryInfoNumRow; $j++) {
                                                                    $countryInfoRow = mysqli_fetch_object($countryInfo);
                                                                    $selected = $countryInfoRow->country_id == $suInfoRow["su_country_id"] ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $countryInfoRow->country_id ?>" <?= $selected ?>><?= $countryInfoRow->country_name ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label">State <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="stateID" id="stateSU" data-state-id="<?= $suInfoRow["su_state_id"] ?>" data-width="100%" onchange="fetchCity(this.id, this.value)">
                                                                <option value="<?= $suInfoRow["su_state_id"] ?>" selected><?= $suInfoRow["state_name"] ?></option>

                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">City <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="cityID" id="citySU" data-city-id="<?= $suInfoRow["su_city_id"] ?>" data-width="100%">
                                                                <option value="<?= $suInfoRow["su_city_id"] ?>" selected><?= $suInfoRow["city_name"] ?></option>

                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="zipCode">Zip/Postal Code</label>
                                                            <input type="text" name="zipCode" value="<?= $suInfoRow["postcode_number"] ?>" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="upProfile" onclick='submitText(q.value)' class="btn btn-primary">Save</button>
                                                    <div id='responsefield'>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">


                                        <div class="accordion-button collapsed  text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#company" href="#collapseOne">
                                            <h4>WORK EXPERIENCE</h4>
                                        </div><br>
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Use the correct job title for job vacancy you are applying for.For Example,'web developer' should be writen as 'Full Stack Developer'.<br>2. Describe your tasks,responsibilities and any competancies developed as clearly as possible.<br>3. Take a good look at what the company is looking for,compose your text with the needs of the company in mind and complete it with your own experience.<br>4. If you have work experience,only mention the relevant tasks and responsibilities for the vacancy you wish to apply. <br>
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>



                                        <div class="collapse show" id="company">
                                            <?php
                                            $sql = "SELECT * 
                                                                                FROM `student_university_education_details`           
                                                                                WHERE sued_student_university_id = $suID  
                                                                                ORDER BY sued_course_end_date;";
                                            $student = $conn->query($sql);
                                            $student->num_rows > 0;
                                            $suExpInfo = $student->fetch_all(MYSQLI_ASSOC);
                                            rsort($suExpInfo, 1);
                                            // Fetch student university's experience details.
                                            // $suEduInfo = $suInfo->fetch_education();

                                            if ($suExpInfo === NULL) {
                                            ?>
                                            <?php

                                            } else {
                                            ?>
                                                <div class="modal-body">
                                                    <!-- Form -->
                                                    <form class="row" id="addExpForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="jobTitle">Job Title <span class="text-danger">*<span></label>
                                                            <input type="text" name="jobTitle" id="jobTitle" class="form-control" placeholder="Job Title" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="compName">Company Name <span class="text-danger">*<span></label>
                                                            <input type="text" name="compName" id="compName" class="form-control" placeholder="Company Name" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
                                                            <input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
                                                            <input type="date" name="endDate" id="endDateAdd" class="form-control" placeholder="Select date" disabled required>
                                                            <div class="form-check mt-2">
                                                                <input type="checkbox" name="jobStatus" value="Current" id="jobStatusAdd" class="form-check-input" checked onchange="endDateDisable(this.checked, this.id, 0)">
                                                                <label class="form-check-label" for="jobStatus">Present</label>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="address">Address <span class="text-danger">*<span></label>
                                                            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                        </div>

                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label">Country <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="countryID" id="countryExpAdd" data-width="100%" onchange="fetchState(this.id, this.value)" required>
                                                                <option value="" selected disabled>Select Country</option>
                                                                <?php
                                                                $countryInfo = $conn->query("SELECT * 
																		FROM `country` 
																		ORDER BY country_name");
                                                                $countryInfoNumRow = mysqli_num_rows($countryInfo);

                                                                for ($i = 0; $i < $countryInfoNumRow; $i++) {
                                                                    $countryInfoRow = mysqli_fetch_object($countryInfo);
                                                                ?>
                                                                    <option value="<?= $countryInfoRow->country_id ?>"><?= $countryInfoRow->country_name ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label">State <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="stateID" id="stateExpAdd" data-width="100%" onchange="fetchCity(this.id, this.value)" required>
                                                                <option value="" selected disabled>Select State</option>

                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">City <span class="text-danger">*<span></label>
                                                            <select class="form-control" name="cityID" id="cityExpAdd" data-width="100%" required>
                                                                <option value="" selected disabled>Select City</option>

                                                            </select>
                                                        </div>
                                                        <!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
                                                        <div class="mb-3 mb-4">
                                                            <label for="addExpDesc" class="form-label">Experience Description <span class="text-danger">*<span></label>
                                                            <textarea class="form-control" name="expDesc" id="addExpDesc" placeholder="Write your experience here " rows="5" maxlength="150"></textarea>
                                                            <span class="pull-right label label-default" id="count_message"></span>
                                                            <small>
                                                                Please describe your experience, responsibility, and any related projects that you've done.
                                                            </small>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="suExp" value="add">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-card">

                                        <div class="accordion-button collapsed  text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#education" href="#collapseOne">
                                            <h4>EDUCATION DETAILS</h4>
                                        </div><br>
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Only mention the courses that you have actually attended.<br>2. Don't mention primary or secondary schools unless they are your latest education.<br>3. If you didn't fully complete a course,it can still add value to your resume or atleast explain a gap in your work history.<br>4. Please mention your accurate percentage and group(Course) in the provided fields.
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>
                                        <div class="collapse show" id="education">
                                            <div class="card card-body">
                                                <?php
                                                $sql = "SELECT * 
																				FROM `student_university_education_details`           
																				WHERE sued_student_university_id =$suID 
																				ORDER BY sued_course_start_date desc;";
                                                $student = $conn->query($sql);
                                                $student->num_rows > 0;
                                                $suEduInfo = $student->fetch_all(MYSQLI_ASSOC);
                                                rsort($suEduInfo, 1);
                                                // Fetch student university's experience details.
                                                // $suEduInfo = $suInfo->fetch_education();

                                                if ($suEduInfo === NULL) {
                                                ?>
                                                <?php
                                                } else {
                                                ?>
                                                    <form class="row" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="collegeName">College name <span class="text-danger">*<span></label>
                                                            <input type="text" name="collegeName" id="collegeName" class="form-control" placeholder="course Title" required>
                                                        </div>

                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="courseTitle">Your Group<span class="text-danger">*<span></label>
                                                            <input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="College Name" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
                                                            <input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
                                                        </div>
                                                        <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
                                                            <input type="date" name="endDate" id="endDateAdd" class="form-control" placeholder="Select date" required>

                                                        </div>





                                                        <!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
                                                        <div class="mb-3 mb-4">
                                                            <label for="addEduDesc" class="form-label">Education Percentage <span class="text-danger">*<span></label>
                                                            <textarea class="form-control" name="eduDesc" id="addEduDesc" placeholder="eg:10/10 ,eg:9.0/10" rows="5" maxlength="10"></textarea>

                                                            <script>
                                                                ClassicEditor
                                                                    .create(document.querySelector('#addeduDesc'), {

                                                                    })
                                                                    .then(editor => {
                                                                        window.editor = editor;
                                                                    })
                                                                    .catch(err => {
                                                                        console.error(err.stack);
                                                                    });
                                                            </script>
                                                        </div>

                                                        <script>
                                                            $("#edu").click(function(e) {
                                                                e.preventDefault();
                                                                var collegeName = $("#collegeName").val();
                                                                var courseTitle = $("#courseTitle").val();
                                                                var startDate = $("#startDate").val();
                                                                var endDate = $("#endDateAdd").val();
                                                                var eduDesc = $("#eduDesc").val();
                                                                var dataString = 'collegeName=' + collegeName + '&courseTitle=' + courseTitle + '&startDate=' + startDate + '&endDate=' + endDate + '&eduDesc=' + eduDesc;
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    data: dataString,
                                                                    url: 'student-portfolio.php',
                                                                    success: function(data) {
                                                                        alert(data);
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="submit" id="edu" class="btn btn-primary" name="suEdu" value="add">Submit</button>
                                            </div>
                                            </form>
                                        <?php } ?>
                                        </div>
                                    </div>



                                    <div class="form-card">
                                        <div class="accordion-button collapsed  text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#skills" href="#collapseOne">
                                            <h4>SKILLS</h4>
                                        </div> <br>
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Only mention the skils that are valuable for the vacancy you wish to apply for.<br>2. Examples:Great communicator,Team player,Flexible etc.<br>3. Mention any valuable skills related to the vacancy such as computer and software skills. For example:Ms-word,Photoshop etc.
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>
                                        <div class="collapse show" id="skills">
                                            <?php

                                            $sql = "SELECT * 
                                                        FROM `student_university_skill_set` AS sus 
                                                        JOIN `skill_type` AS st ON sus.sus_skill_type_id = st.skill_id 
                                                        WHERE sus.sus_student_university_id =$suID
                                                        ORDER BY sus_skill_level desc;";
                                            $student = $conn->query($sql);
                                            $student->num_rows > 0;
                                            $suSkillInfo = $student->fetch_all(MYSQLI_ASSOC);
                                            rsort($suSkillInfo, 1);

                                            if ($suSkillInfo === NULL) {
                                            ?>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="modal-body">
                                                    <!-- Form -->
                                                    <form action="../student/function/student-portfolio.php" method="post" enctype="multipart/form-data">
                                                        <!-- Skill slot default -->
                                                        <div class="row" id="defaultSkillRow">
                                                            <div class="mb-3 col-12 col-md-6">
                                                                <label class="form-label" for="skillTitle">Skill <span class="text-danger">*</span></label>
                                                                <input type="text" name="skillTitle[]" id="skillTitle" class="form-control" placeholder="Skill name" required>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-3">
                                                                <label class="form-label">Proficiency <span class="text-danger">*</span></label>
                                                                <select name="skillLvl[]" id="skillLvl" class="selectpicker" data-width="100%" required>
                                                                    <option value="">Select level</option>
                                                                    <option value="40">Beginner</option>
                                                                    <option value="70">Intermediate</option>
                                                                    <option value="90">Advance</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-2">
                                                                <div class="form-check mt-6">
                                                                    <input type="checkbox" name="certCheck[]" id="certCheck" class="form-check-input" onchange="certEnable(this.checked, 0)">
                                                                    <label class="form-check-label" for="certCheck">Add certificate</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-1">
                                                                <label class="form-label fade" for="addSkillSlot">Add </label>
                                                                <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-placement="top" title="Add skill slot" onclick="addNewRow()"><i class="fe fe-plus"></i></button>
                                                            </div>
                                                            <div id="insertCert0" class="row collapse">
                                                                <div class="mb-3 col-12 col-md-4">
                                                                    <label class="form-label" for="certProvider">Certificate Provider <span class="text-danger">*</span></label>
                                                                    <input type="text" name="certProvider[]" id="certProvider0" class="form-control" placeholder="Provider name">
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-4">
                                                                    <label class="form-label" for="upCert">Upload Certificate <span class="text-danger">* </span><small>(.pdf, .doc, .docx)</small></label>
                                                                    <input type="file" accept=".pdf, .doc, .docx" size="40" name="upCert[]" class="form-control" id="upCert0">
                                                                </div>
                                                                <div class="mb-3 col-12 col-md-3">
                                                                    <label class="form-label" for="certDate">Date Received <span class="text-danger">*</span></label>
                                                                    <input type="date" name="certDate[]" id="certDate0" class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                            <!-- Skill slot 1 -->
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-primary" name="addSkill">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>




                                    <div class="form-card">
                                        <div class="accordion-button collapsed  text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#reference" href="#collapseOne">
                                            <h4>REFERENCE</h4>
                                        </div><br>
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Only mention the authenticated details of a person who is going to refer you in his/her company or industry.<br>2. Do not fill the fake details of a person who will not going to be refered you.
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>
                                        <div class="collapse show" id="reference">
                                            <div class="card card-body">
                                                <?php
                                                $sql = "SELECT * 
																				FROM `student_university_reference_details`           
																				WHERE sued_student_university_id = $suID ;";
                                                $student = $conn->query($sql);
                                                $student->num_rows > 0;
                                                $suReferenceInfo = $student->fetch_all(MYSQLI_ASSOC);
                                                rsort($suReferenceInfo, 1);
                                                // Fetch student university's experience details.
                                                // $suEduInfo = $suInfo->fetch_education();

                                                if ($suReferenceInfo === NULL) {
                                                ?>
                                                <?php
                                                } else {
                                                ?>



                                                    <form class="row" id="myform" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
                                                        <!-- <div class="mb-3 col-12 col-md-6">
                                                            <label class="form-label" for="zipCode">Zip/Postal Code</label>
                                                            <input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
                                                        </div> -->
                                                        <div class="mb-3 mb-4">
                                                            <label for="addReferenceDesc" class="form-label">reference <span class="text-danger">*<span></label>
                                                            <textarea class="form-control" name="referenceDesc" id="referenceDesc" placeholder="eg:10/10 ,eg:9.0/10" rows="5" maxlength="100"></textarea>


                                                        </div>
                                                        <div class="modal-footer">

                                                            <!-- <button type="submit" onclick="defaultChange()" class="btn btn-primary" name="suReference" id="suReference" value="addnewreferences">Submit</button> -->
                                                            <button type="submit" class="btn btn-primary" name="suReference" id="suReference" value="addnewreferences">Submit</button>
                                                        </div>
                                                    </form>

                                                <?php } ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-card">
                                        <div class="accordion-button collapsed  text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#hobby" href="#collapseOne">
                                            <h4>HOBBIES</h4>
                                        </div><br>
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Only mention the hobbies which add value to your resume and the job you wish to apply for.For example:'Dancing' may not be relavent to the IT sector,but 'Programming' would be.<br>2. Feel free to mention hobbies that tell the employer about your personality,such as sports,photography,travelling etc.<br>3. Do not mention adult hobbies thet can cause a negative impact. For example:gambling,Political stances etc.
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>
                                        <div class="collapse show" id="hobby">
                                            <div class="card card-body">
                                                <?php
                                                $sql = "SELECT * 
																				FROM `student_university_hobby_details`           
																				WHERE sued_student_university_id = $suID ;";
                                                $student = $conn->query($sql);
                                                $student->num_rows > 0;
                                                $suHobbyInfo = $student->fetch_all(MYSQLI_ASSOC);

                                                if ($suHobbyInfo === NULL) {



                                                ?>
                                                <?php
                                                } else {
                                                ?>
                                                    <form class="row" method="post" enctype="multipart/form-data">



                                                        <div class="mb-3 col-12 col-md-12">
                                                            <label class="form-label" for="courseTitle">Your hobby<span class="text-danger">*<span></label>
                                                            <input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="Your hobby" required>
                                                        </div>




                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-primary" name="suHobby" id="su_hobby" value="add">Submit</button>
                                                        </div>
                                                    </form>
                                                <?php } ?>

                                                <!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->


                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="make_payment" class="next action-button" value="Confirm" />

                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div id="tooltip">
                                            <span id="tooltipText">1. Please choose a templete according to your choice which suits your information in a correct format.<br>2. The choosen templete can be used to download or print.
                                            </span>
                                            <button type="button" class="btn btn-secondary"> <i class="fa bala">&#xf0eb;</i> Tips</button>
                                        </div>


                                        <h2 class="text-center">CHOOSE YOUR RESUME TEMPLATE</h2>
                                        <h5 class="text-center">Remember, you can always change your template later on.</h5>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-4 col-sm-6 col-xs- template-file template-file__image">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume.php">
                                                        <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20095517.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>


                                            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume2.php">
                                                        <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20091351.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume4.php">
                                                        <button type="submit" style="border: none; background: unset;" name="tmp" value="2">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-12-07%20141949.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbl">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume3.php">
                                                        <button type="submit" style="border: none; background: unset;" name="tmp" value="3">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20095054.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume1.php">
                                                        <button type="submit" style="border: none; background: unset;" name="tmp" value="4">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-24%20155345.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr ">
                                                <div class="hovereffect">
                                                    <form method="post" action="resume5.php">
                                                        <button type="submit" style="border: none; background: unset;" name="tmp" value="5">
                                                            <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20112107.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                                                            <span class="btn btn-primary btn-sm">Use This Template</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>





                                            </button></form>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />


                                </fieldset>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="jquery.min.js"></script>
    <script>
        //     $("#suReference").click(function(e) {
        //   e.preventDefault();
        //   var referenceDesc = $("#referenceDesc").val(); 

        //   var dataString = 'referenceDesc='+referenceDesc;
        //   $.ajax({
        //     type:'POST',
        //     data:dataString,
        //     url:'function/student-portfolio.php',
        //     success:function(data) {
        //       alert(data);
        //     }
        //   });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('#suReference').on('click', function() {
              $.ajax({
                    method: 'post',
                    url: 'function/student-portfolio.php',
                    data: $('myform').serialize(),
                    success: function() {
                        alert('Data updated')
                      

                    },
                    error: function() {
                        alert('error')
                    }
                })
            });
          
        });
        // $('#suReference').on('click', function() {
        //     $.ajax({
        //         method: 'post',
        //         // url: 'function/student-portfolio.php',
        //         data: $('myform').serialize(),
        //         success: function() {
        //             alert('Data updated')


        //         },
        //         error: function() {
        //             alert('error')
        //         }
        //     })
        // })
        //         function defaultChange() {
        //   $('#myform').val("bala");
        // }
    </script>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


    <script>
        $(document).ready(function() {

            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;

            $(".next").click(function() {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            });

            $(".previous").click(function() {

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            });

            $('.radio-group .radio').click(function() {
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });

            $(".submit").click(function() {
                return false;
            })

        });
    </script>
    <script>
        function submitText(q) {

            var url = 'back-end.php?q=' + q;

            var xhr = new XMLHttpRequest();

            xhr.open('GET', url, false);

            xhr.send();

            var response = xhr.response;

            responsefield.innerHTML = response;


        }
    </script>

</body>

</html>