<?php
include("../function/student-function.php");

/*--------------------------------------------------------- STUDENT EMAIL UPDATE ---------------------------------------------------------*/

/**
 * Update the student university's current email with new one.
 * Return AJAX Response in JSON format.
 */
if(isset($_POST["updateEmail"])) {
    $newEmail = $_POST["new_email"];

    // Check if the input is an email address.
    if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        // --- invalid email format.
        echo json_encode(
            array(
                "status"  => "invalid", 
                "message" => "<strong>Invalid email!</strong> Make sure you inserted an email address."
            )
        );
    } else {
        // --- update email address.
        $updateEmail = $suInfo->update_email($newEmail);

        if($updateEmail) {
            // --- UPDATE operation success.
            echo json_encode(
                array(
                    "status"  => "success", 
                    "message" => "<strong>Success!</strong> Your email address has been updated <span class='fw-medium'>(Refreshed the page to see the changes)</span>."
                )
            );
        } else {
            // --- UPDATE operation fails.
            echo json_encode(
                array(
                    "status"  => "fail", 
                    "message" => "<strong>Failed!</strong> Something wrong when updating your email address."
                )
            );
        }
    }

    exit();
}

/**-------------------------------------------------------- STUDENT EMAIL UPDATE --------------------------------------------------------**/


/*--------------------------------------------------------- STUDENT PASSWORD UPDATE ---------------------------------------------------------*/

/**
 * Update the student university's password.
 * Return AJAX Response in JSON format.
 */
if(isset($_POST["updatePassword"])) {
    $currPwd = mysqli_real_escape_string($conn, $_POST["curr_pwd"]);
    $newPwd = mysqli_real_escape_string($conn, $_POST["new_pwd"]);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST["confirm_pwd"]);

    if(strcmp($newPwd, $confirmPwd) == 0) {
        $updatePwd = $suInfo->update_password($currPwd, $confirmPwd);

        if($updatePwd === "success") {
            $status = "success";
            $message = "<strong>Success!</strong> Your password had been successfully updated.";
        } else if($updatePwd === "fail") {
            $status = "fail";
            $message = "<strong>Failed!</strong> Something wrong when updating your password.";
        } else if($updatePwd === "unmatched") {
            $status = "invalid";
            $message = "<strong>Unmatched!</strong> Wrong password in 'Current password' field.";
        }

        echo json_encode(
            array(
                "status"  => $status, 
                "message" => $message
            )
        );
    } else {
        echo json_encode(
            array(
                "status"  => "invalid", 
                "message" => "<strong>Unmatched!</strong> Make sure the input in both 'New password' and 'Confirm new password' are matched."
            )
        );
    }

    exit();
}

/**-------------------------------------------------------- STUDENT PASSWORD UPDATE --------------------------------------------------------**/