/**
 * Function that contains the alert box messages (Success/Warning).
 * To be used when updating email and password.
 * 
 * @param {string} alert_type either one of these 3 input, `success`, `fail`, or `invalid`.
 * @param {string} alert_msg alert messages.
 * @returns HTML alert message.
 */
 function msg_alert(alert_type, alert_msg) {
    if(alert_type == "success") {
        var output = (
            '<div class="alert alert-success alert-dismissible fade show" role="alert">' + 
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#check-circle-fill"/></svg>' + 
                alert_msg + 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">' + 
                    '<span aria-hidden="true"></span>' + 
                '</button>' + 
            '</div>'
        );
    } else if(alert_type == "fail") {
        var output = (
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + 
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>' + 
                alert_msg + 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">' + 
                    '<span aria-hidden="true"></span>' + 
                '</button>' + 
            '</div>'
        );
    } else if(alert_type == "invalid") {
        var output = (
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">' + 
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#info-fill"/></svg>' + 
                alert_msg + 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">' + 
                    '<span aria-hidden="true"></span>' + 
                '</button>' + 
            '</div>'
        );
    }

    return output;
}

/*--------------------------------------------------------- EMAIL FUNCTION ---------------------------------------------------------*/

// Update the new student university's email address.
$("button#changeEmail").on("click", function() {
    var new_email = $("input[name=new_email]").prop("value");

    $.ajax({
        type: "POST", 
        url: "function/student-security.php", 
        data: { updateEmail: "", new_email: new_email }, 
        dataType: "json", 
        success: function(data) {
            // Display the alert status.
            $display_alert = msg_alert(data.status, data.message);
            $("div#emailAlert").html($display_alert);
            // Empty the input field.
            $("input[name=new_email]").prop("value", "");
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
});

/**-------------------------------------------------------- EMAIL FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- PASSWORD FUNCTION ---------------------------------------------------------*/

// Make the 'Current password' input visible.
$("#showPwd").on("change", function() {
    if(this.checked) {
        $("input[name=currentpassword]").prop("type", "text");
    } else {
        $("input[name=currentpassword]").prop("type", "password");
    }
});

// Make the 'New password' input visible.
$("#showPwd0").on("change", function() {
    if(this.checked) {
        $("input[name=newpassword]").prop("type", "text");
    } else {
        $("input[name=newpassword]").prop("type", "password");
    }
});

// Make the 'Confirm new password' input visible.
$("#showPwd1").on("change", function() {
    if(this.checked) {
        $("input[name=confirmpassword]").prop("type", "text");
    } else {
        $("input[name=confirmpassword]").prop("type", "password");
    }
});

// Compare the 'New password' value with 'Confirm new password' value.
$("input[name=confirmpassword]").on("focusout", function() {
    var new_pwd = $("input[name=newpassword]").prop("value");
    var confirm_pwd = $(this).prop("value");

    if(confirm_pwd == "") {
        $("#alert_msg").html("<span class='text-warning'>(Please re-enter the password.)</span>");
        $(this).removeClass("border-success").removeClass("border-danger").addClass("border-warning");
        $("button#resetPassword").prop("disabled", true);
    } else {
        if(confirm_pwd.localeCompare(new_pwd) == 0) {
            $("#alert_msg").html("");
            $(this).removeClass("border-warning").removeClass("border-danger").addClass("border-success");
            $("button#resetPassword").prop("disabled", false);
        } else {
            $("#alert_msg").html("<span class='text-danger'>(Wrong password.)</span>");
            $(this).removeClass("border-warning").removeClass("border-success").addClass("border-danger");
            $("button#resetPassword").prop("disabled", true);
        }
    }
});

// Update student university's password.
$("button#resetPassword").on("click", function() {
    var curr_pwd = $("input[name=currentpassword]").prop("value");
    var new_pwd = $("input[name=newpassword]").prop("value");
    var confirm_pwd = $("input[name=confirmpassword]").prop("value");

    $.ajax({
        type: "POST", 
        url: "function/student-security.php", 
        data: { updatePassword: "", curr_pwd: curr_pwd, new_pwd: new_pwd, confirm_pwd: confirm_pwd }, 
        dataType: "json", 
        success: function(data) {
            // Display the alert status.
            $display_alert = msg_alert(data.status, data.message);
            $("div#pwdAlert").html($display_alert);
            // Empty the input field.
            $("input[name=currentpassword]").prop("value", "");
            $("input[name=newpassword]").prop("value", "");
            $("input[name=confirmpassword]").prop("value", "");
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
});

/**-------------------------------------------------------- PASSWORD FUNCTION --------------------------------------------------------**/