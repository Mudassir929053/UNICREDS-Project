<?php
include 'function/student-function.php';
// Student university id.
$suID = $_SESSION['sess_studentid'];
?>
<?php
include 'pages-head.php';
?>
<?php
include 'pages-topbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    </title>
</head>
<style>
    p {
        font-size: 12pt;
        color: black;
    }

    input {
        font-family: verdana;
        font-size: 10pt;
    }

    canvas {
        height: 40px;
        border-style: solid;
        border-width: 1px;
        border-color: black;
    }

    h1 {
        color: darkslategray;
    }

    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>
<script>
    function upload() {
        var imgcanvas = document.getElementById("canv1");
        var fileinput = document.getElementById("finput");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function showDiv(select) {
        if (select.value == 'open') {
         
            $('#open').show();
            $('#mag').hide();
            $('#add').hide();
            $('#other').hide();
            $('#c').hide();
        } else if (select.value == 'mag') {
          
            $('#mag').show();
            $('#open').hide();
            $('#add').hide();
            $('#other').hide();
            $('#c').hide();
        } else if (select.value == 'add') {
           
            $('#add').show();
            $('#open').hide();
            $('#mag').hide();
            $('#other').hide();
            $('#c').hide();
        } else if (select.value == 'other') {
           
            $('#other').show();
            $('#open').hide();
            $('#add').hide();
            $('#mag').hide();
            $('#c').hide();
        } else if (select.value == 'choose1') {
            $('#c').show();
            $('#add').hide();
            $('#open').hide();
            $('#mag').hide();
            $('#other').hide();
        }
    }

    function showDiv1(select) {
        if (select.value == 'option1') {
            $('#option1').show();
            $('#option2').hide();
            $('#option3').hide();
            $('#option4').hide();
            $('#option5').hide();
            $('#option6').hide();
            $('#c2').hide();
        } else if (select.value == 'option2') {
            $('#option2').show();
            $('#option1').hide();
            $('#option3').hide();
            $('#option4').hide();
            $('#option5').hide();
            $('#option6').hide();
            $('#c2').hide();
        } else if (select.value == 'option3') {
            $('#option3').show();
            $('#option1').hide();
            $('#option2').hide();
            $('#option4').hide();
            $('#option5').hide();
            $('#option6').hide();
            $('#c2').hide();
        } else if (select.value == 'option4') {
            $('#option4').show();
            $('#option1').hide();
            $('#option2').hide();
            $('#option3').hide();
            $('#option5').hide();
            $('#option6').hide();
            $('#c2').hide();
        } else if (select.value == 'option5') {
            $('#option5').show();
            $('#option1').hide();
            $('#option2').hide();
            $('#option3').hide();
            $('#option4').hide();
            $('#option6').hide();
            $('#c2').hide();
        } else if (select.value == 'option6') {
            $('#option6').show();
            $('#option1').hide();
            $('#option2').hide();
            $('#option3').hide();
            $('#option4').hide();
            $('#option5').hide();
            $('#c2').hide();
        } else if (select.value == 'choose2') {
            $('#c2').show();
            $('#option1').hide();
            $('#option2').hide();
            $('#option3').hide();
            $('#option4').hide();
            $('#option5').hide();
            $('#option6').hide();
        }
    }

    function showDiv2(select) {
        if (select.value == 'career') {
            $('#career').show();
            $('#education').hide();
            $('#experience').hide();
            $('#c3').hide();
        } else if (select.value == 'education') {
            $('#education').show();
            $('#career').hide();
            $('#experience').hide();
            $('#c3').hide();
        } else if (select.value == 'experience') {
            $('#experience').show();
            $('#career').hide();
            $('#education').hide();
            $('#c3').hide();
        } else if (select.value == 'choose3') {
            $('#c3').show();
            $('#experience').hide();
            $('#career').hide();
            $('#education').hide();
        }
    }

    function showDiv3(select) {
        if (select.value == 'vacancy') {
            $('#vacancy').show();
            $('#openapply').hide();
            $('#choose').hide();
        } else if (select.value == 'openapply') {
            $('#openapply').show();
            $('#vacancy').hide();
            $('#choose').hide();
        } else if (select.value == 'choose') {
            $('#choose').show();
            $('#vacancy').hide();
            $('#openapply').hide();
        }
    }
</script>

<body>
    <!-- Start Modal Page -->
    <div id="coverletterdis" tabindex="-1" role="dialog" aria-labelledby="jobadvertmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobadvertmodal">COVER LETTER</h5>
                    <h5 class="modal-title" id="messagedisplay"></h5>
                </div>
                <div class="modal-body">
                    <!-- check box fetching -->
                    <form class="cov" id="cov1" action="" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <?php
                            $query = $conn->query("SELECT * FROM student_university where su_id = '$suID'");
                            if (mysqli_num_rows($query) > 0) {
                                $rows = mysqli_fetch_object($query)
                            ?>
                                
                                <div class="mb-3 col-12 col-md-6">
                                    <label class="form-label" for="name">Name<span class="text-danger">*<span></label>
                                    <input type="text" name="name" class="form-control" placeholder="name" id="su_user_id<?php echo $suID; ?>" value="<?php echo $rows->su_fname; ?><?php echo $rows->su_lname; ?>" required>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label class="form-label" for="compName"> Email<span class="text-danger">*<span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php echo $rows->su_email; ?>" required>
                                </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-4">
                                <label class="form-label" for="date">Date <span class="text-danger">*<span></label>
                                <input type="date" name="date" id="date" class="form-control" placeholder="Select date" required>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                                <label class="form-label" for="address">Address<span class="text-danger">*<span></label>
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo $rows->su_address; ?> " placeholder="Address"required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label"> Contact no<span class="text-danger">*<span></label>
                                <input type="number" name="contact_no" class="form-control" id="contact_no" placeholder="number" value="<?php echo $rows->su_contact_no; ?>"required>
                            </div>
                        </div>
                    <?php
                            } else {
                                echo "data not found";
                            }
                    ?>
                    <div class="row">
                        <div class="mb-3 col-12 col-md-12">
                            <label class="form-label">Introduction</label>
                            <select class="selectpicker" name="introduction" data-width="100%" name="" id="" onchange="showDiv(this)" required>
                                <option value="choose1">choose </option>
                                <option value="open" name="open">Open Application</option>
                                <option value="mag" name="mag">Response to ad in newspaper or magazine </option>
                                <option value="add" name="add">Response to online ad </option>
                                <option value="other" name="other">Other </option>
                            </select>
                        </div>
                        <div id="c" value="c">
                            <div class="table-responsive">
                            </div>
                        </div>
                        <div id="open" value="open" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="o1" name="open" rows="3">Dear [Sir or Madam] ,
                                                            By means of this letter I would like to inquire about the possibility of filling an outstanding [Position type] at [Organization]. My preference would be to fill the position of [Desired position] .
                                                    </textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#o1'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="mag" value="mag" name="mag" style="display:none">
                            <div class="table-responsive">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="o2" name="mag" rows="3">Dear [Sir or Madam],
                                                        My attention was immediately drawn to the ad in [Name of newspaper or magazine] in which you state you are looking for a [Desired position] . The profile you have outlined fits me very well as I will further explain in this letter.
                                                </textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#o2'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="add" value="add" name="add" style="display:none">
                            <div class="table-responsive">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="o3" name="add" rows="3">Dear [Sir or Madam] ,
                                                    My attention was immediately drawn to the ad on [Website name] in which you state you are looking for a [Desired position]. The profile you have outlined fits me very well as I will further explain in this letter.
                                                </textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#o3'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="other" value="other" name="other" style="display:none">
                            <div class="table-responsive">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="o4" name="other" rows="3">Dear [Sir or Madam] ,
                                                    With this letter I would like to express my interest in filling an open vacancy at [Organization], in particular, the position of [Desired position] .</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#o4'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-md-12">
                            <label class="form-label">Current Situation</label>
                            <select class="selectpicker " data-width="100%" id="current_situation" name="current_situation" onchange="showDiv1(this)" required>
                                <option value="choose2">choose </option>
                                <option value="option1" name="option1">I am currently working</option>
                                <option value="option2" name="option2">I am currently working and have recently completed my studies</option>
                                <option value="option3" name="option3">I am currently working and have ample experience</option>
                                <option value="option4" name="option4">I have completed my studies</option>
                                <option value="option5" name="option5">I am currently studying</option>
                                <option value="option6" name="option6">I am currently out of work</option>
                            </select>
                        </div>
                        <div id="c2" value="c2">
                            <div class="table-responsive">
                            </div>
                        </div>
                        <div id="option1" value="option1" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="opt" rows="3" name="option1">I am currently working as [Current position] at [Organization] in [city]. In this position I am responsible for [Responsibilities] . I have especially experienced [Positive aspects] as very positive.
                                                    .</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#opt'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="option2" value="option2" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="op" rows="3" name="option2">I am currently working as [Current position] at [Organization] in [city]. In this position I am responsible for  [Responsibilities]. I have completed my [Education] studies at [School].</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#op'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="option3" value="option3" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="three" rows="3" name="option3">I am currently working as [Current position]  at  in [city] . In this position I am responsible for  [Responsibilities]. Over the past [Duration] , I have gained ample experience in the field of [Experience gained].</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#three'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="option4" value="option4" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="four" rows="3" name="option4">I have completed my [Education] studies at [school]. During these studies, students are readied for the position of [Desired position] . The studies focus on [Emphasis] as the topics of [Topics] are extensively discussed. In order to make good use of my acquired knowledge and skills, I would like to work for [Organization] , in the position of [Desired position].</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#four'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="option5" value="option5" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="five" rows="3" name="option5">I am currently studying [Education]  at [School]. During these studies, students are readied to become[Desired position] . The emphasis lies on [Emphasis] as during the educational process the topics of  are discussed. I would like to use my skills with [Organization], in order to make optimal use of my acquired knowledge.</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#five'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="option6" value="option6" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="six" rows="3" name="option6">I am currently not employed. However, I would like to gain experience through the possibilities offered by [Organization] to develop myself in the position of [Desired position] . I am very motivated to get started and would like to show that I can add value to [Organization] .</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#six'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Motivation</label>
                            <select class="selectpicker" name="motivation" data-width="100%" id="motivation" onchange="showDiv2(this)" required>
                                <option value="choose3">Choose</option>
                                <option value="career" name="career">Career-Oriented</option>
                                <option value="education" name="education">Education-oriented</option>
                                <option value="experience" name="experience">Experience-oriented</option>
                            </select>
                        </div>
                        <div id="c3" value="c3">
                            <div class="table-responsive">
                            </div>
                        </div>
                        <div id="career" value="career" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="car" name="career" rows="3">I would describe myself as someone who is [Personal Description] . Combined with my experience, I believe that I can make a valuable contribution to your organization. I see the position of [Desired position] as the perfect next step in my career. In the position of [Desired position]  I expect to be able to develop myself further as a professional.
                                                </textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#car'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="education" value="education" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="edu" name="education" rows="3">I would describe myself as someone who is [Personal Description]. I would like to put these characteristics to use within your organization. Given my education at , I think I am perfect for the position of [Desired position] . The components that were discussed during my studies closely match the skills required for this position.</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#edu'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="experience" value="experience" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="exp" name="experience" rows="3">I would describe myself as someone who is [Personal Description] . I would like to put these characteristics to use within your organization. My experience as [current position] at [Organization], has provided me with the expertise to be able to make a valuable contribution to  in the position of [Desired position] .</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#exp'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Closing</label>
                            <select class="selectpicker " data-width="100%" name="closing" id="cq_question_type" onchange="showDiv3(this)" required>
                                <option value="choose" name="choose">Choose</option>
                                <option value="vacancy" name="vacancy">Job vacancy Application</option>
                                <option value="openapply" name="openapply">Open Application</option>
                            </select>
                        </div>
                        <div id="choose" value="choose" style="display:none">
                            <div class="table-responsive">
                            </div>
                        </div>
                        <div id="vacancy" value="vacancy" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="vac" name="vacancy" rows="3">I would like to further explain my motivation for the position of [Desired position] during a personal meeting. 

 
                       </textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#vac'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="openapply" value="openapply" style="display:none">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="app" name="openapply" rows="3">I would like to further explain my motivation to work at  [Organization] during a personal meeting.</textarea>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#app'), {})
                                                        .then(editor => {
                                                            window.editor = editor;
                                                        })
                                                        .catch(err => {
                                                            console.error(err.stack);
                                                        });
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-5">
                <!-- <button type="submit" class="btn btn-secondary" name="" value="">Add New Paragraph</button> -->
                </div>
                   
                    <button type="submit" class="btn btn-primary" name="coversubmit" value="coversubmit">Submit</button>
                </div>
                
                </form>
            </div>

            <!-- End Modal Page -->

            <script>
                $(document).ready(function() {
                    $('#displaybtn').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            method: "post",
                            url: "coverletter copy.php",
                            data: $('#coverletterdis').serialize(),
                            dataType: "dataType",
                            success: function(response) {
                                $('#messagedisplay').text(response);

                            }
                        })
                    })
                })
            </script>
</body>

</html>