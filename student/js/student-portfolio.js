// to clear the form modal.
const clickReset = () => {
    document.getElementById("addExpForm").reset();
}


/*--------------------------------------------------------- FUNCTION FOR STUDENT UNIVERSITY JOB EXPERIENCE ---------------------------------------------------------*/

/**
 * Function to enable/disable the 'End Date' input in add/edit student university's job experience.
 * 
 * @param {boolean} check the state of the checkbox whether it is checked or not.
 * @param {string} id id for either add or edit end date input.
 * @param {number} editCount count for the edit end date.
 */
function endDateDisable(check, id, end_id ,editCount) {
    const elementID = "endDateEdit" + editCount;
    // console.log(check,id,editCount);
    if (check) {
        if (id === "jobStatusAdd") {
            end_id.setAttribute("disabled", "disabled");
            // document.getElementById("endDateAddedu").setAttribute("disabled", "disabled");
            end_id.value = "";
            // console.log(document.getElementById("endDateAdd"))
        } else {
            document.getElementById(elementID).setAttribute("disabled", "disabled");
            document.getElementById(elementID).value = "";
        }
    } else {
        if (id === "jobStatusAdd") {
            end_id.removeAttribute("disabled");
            // document.getElementById("endDateAddedu").removeAttribute("disabled");
        } else {
            document.getElementById(elementID).removeAttribute("disabled");
        }
    }
}

/**-------------------------------------------------------- FUNCTION FOR STUDENT UNIVERSITY JOB EXPERIENCE --------------------------------------------------------**/


/*--------------------------------------------------------- FUNCTION FOR STUDENT UNIVERSITY SKILL SET ---------------------------------------------------------*/

// For checkbox in Add Skill form modal.
function certEnable(check, addCount) {
    const divID = "insertCert" + addCount;
    const certProvider = "certProvider" + addCount;
    const upCert = "upCert" + addCount;
    const certDate = "certDate" + addCount;

    if(check == true) {
        document.getElementById(divID).className = "row";
        document.getElementById(certProvider).setAttribute("required", "required");
        document.getElementById(upCert).setAttribute("required", "required");
        document.getElementById(certDate).setAttribute("required", "required");
    } else {
        document.getElementById(divID).className = "row collapse";
        document.getElementById(certProvider).removeAttribute("required");
        document.getElementById(upCert).removeAttribute("required");
        document.getElementById(certDate).removeAttribute("required");
    }
}

// To add new skills row.
// ## current limit: 5 rows.
$rowcount = 1;

const addNewRow = () => {
    if($rowcount < 5) {
        $('body').tooltip({
            selector: '[data-bs-toggle="tooltip"]'
        });
        $("#defaultSkillRow").append("<div id='row" + $rowcount + "' class='row'>" + 
                                            "<hr class='text-primary'>" + 
                                            "<div class='mb-3 col-12 col-md-6'>" + 
                                                "<label class='form-label' for='skillTitle'>Skill <span class='text-danger'>*</span></label>" + 
                                                "<input type='text' name='skillTitle[]' id='skillTitle' class='form-control' placeholder='Skill name' required>" + 
                                            "</div>" +  
                                            "<div class='mb-3 col-12 col-md-3'>" + 
                                                "<label class='form-label' for='skillLvl1'>Proficiency <span class='text-danger'>*</span></label>" + 
                                                "<div class='dropdown bootstrap-select' style='width: 100%'><select name='skillLvl[]' id='skillLvl1' class='selectpicker' data-width='100%' required>" + 
                                                    "<option value=''>Select level</option>" + 
                                                    "<option value='Beginner'>Beginner</option>" + 
                                                    "<option value='Intermediate'>Intermediate</option>" + 
                                                    "<option value='Advance'>Advance</option>" + 
                                                "</select></div>" + 
                                            "</div>" + 
                                            "<div class='mb-3 col-12 col-md-2'>" + 
                                                "<div class='form-check mt-6'>" + 
                                                    "<input type='checkbox' name='certCheck[]' id='certCheck' class='form-check-input' onchange='certEnable(this.checked, " + $rowcount + ")'>" + 
                                                    "<label class='form-check-label' for='certCheck'>Add certificate</label>" + 
                                                "</div>" + 
                                                "</div>" + 
                                            "<div class='mb-3 col-12 col-md-1'>" + 
                                                "<label class='form-label fade' for='delSkillSLot'>Del <span class='text-danger'>*</span></label>" + 
                                                "<button type='button' id='" + $rowcount + "' class='btn btn-danger' data-bs-toggle='tooltip' data-placement='top' title='Delete skill slot' onclick='deleteRow(this.id)'><i class='fe fe-x'></i></button>" + 
                                            "</div>" + 
                                            "<div id='insertCert" + $rowcount + "' class='row collapse'>" + 
                                                "<div class='mb-3 col-12 col-md-4'>" + 
                                                    "<label class='form-label' for='certProvider'>Certificate Provider <span class='text-danger'>*</span></label>" + 
                                                    "<input type='text' name='certProvider[]' id='certProvider0' class='form-control' placeholder='Provider name'>" + 
                                                "</div>" + 
                                                "<div class='mb-3 col-12 col-md-4'>" + 
                                                    "<label class='form-label' for='upCert'>Upload Certificate <span class='text-danger'>* </span><small>(.pdf, .doc, .docx)</small></label>" + 
                                                    "<input type='file' accept='.pdf, .doc, .docx' size='40' name='upCert[]' class='form-control' id='upCert0'>" + 
                                                "</div>" + 
                                                "<div class='mb-3 col-12 col-md-3'>" + 
                                                    "<label class='form-label' for='certDate'>Date Received <span class='text-danger'>*</span></label>" + 
                                                    "<input type='date' name='certDate[]' id='certDate0' class='form-control' placeholder=''>" + 
                                                "</div>" + 
                                            "</div>" + 
                                        "</div>");
        $(".selectpicker").selectpicker("render");
        $rowcount++;
    } else {
        alert("Maximum number of skills slot reached! (Max: 5 at one time)");
    }
}

// To delete a row skill.
const deleteRow = (row_id) => {
    $("#row" + row_id).remove();
    $rowcount--;
}

/**-------------------------------------------------------- FUNCTION FOR STUDENT UNIVERSITY SKILL SET ---------------------------------------------------------**/