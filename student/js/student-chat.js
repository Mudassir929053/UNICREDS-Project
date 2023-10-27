/*--------------------------------------------------------- FETCH CHAT FUNCTION ---------------------------------------------------------*/

// Fetch incoming chat messages.
function instructorMessage(instructorID, studentID) {
    // fetch chat messages.
    $.ajax({
        type: "POST", 
        url: "../student/function/student-chat.php", 
        data: { fetch_incoming_chat: "", suID: studentID, instructorID: instructorID }, 
        dataType: "html", 
        success: (data) => {
            var chatBody = "#chatBody";
            
            if(data !== "") {
                // add notification at the chat icon.
                $("a#showChat").addClass("indicator indicator-primary");
                // add notification at the avatar.
                $("#notify").addClass("avatar-indicators avatar-online");

                // display the chat.
                $(chatBody).append(data);
                $(chatBody).scrollTop($(chatBody)[0].scrollHeight);
            }
        }, 
        error: (request, status, error) => {
            alert(request.responseText);
            alert(error.message);
        }
    });
}

// Fetch chat messages when user click on the chat icon.
function fetchMessage(id) {
    var recv_id = $("#" + id).data("recv-id");
    var send_id = $("#" + id).data("send-id");

    $.ajax({
        type: 'POST',
        url: '../student/function/student-chat.php',
        data: { fetch_all_chat: "", suID: send_id, instructorID: recv_id },
        success: function(data) {
            // display the chat
            $('#chatBody').html(data);
            $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
            
            // remove notification at the chat icon.
            $("a#showChat").removeClass("indicator indicator-primary");
            // remove notification at the avatar.
            $("#notify").removeClass("avatar-indicators avatar-online");
        }
    });
}

/**-------------------------------------------------------- FETCH CHAT FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- SEND CHAT FUNCTION ---------------------------------------------------------*/

// Send chat messages when user press "Enter" or click "Send" button.
function sendMessage(message, recvID, sendID) {
    // insert the message in DB.
    $.ajax({
        type: 'POST',
        url: '../student/function/student-chat.php',
        data: { send_chat: "",instructorID: recvID, suID: sendID, chatMessage: message },
        success: function(data) {
            // emptying the chat box.
            $("#messageSend").val("");
            // display the chat.
            $('#chatBody').append(data);
            $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
        }
    });
}

/**-------------------------------------------------------- SEND CHAT FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- CHAT BOX FUNCTION ---------------------------------------------------------*/

function enterSubmit(recvID, sendID) {
    // to make the "Enter" key and send button, send the message.
    // press "Enter" to submit, press "Shift" + "Enter" to insert new line in textarea.
    var enterKey = $("#messageSend");

    enterKey.keydown(function(e) {
        if(e.keyCode === 13 && !e.shiftKey) {
            e.preventDefault();

            if(enterKey.val() === "") {
            } else {
                sendMessage(enterKey.val(), recvID, sendID);
            }
        }
    });
}

function buttonSubmit(recvID, sendID) {
    // when "Send" button clicked.
    var message = $("#messageSend").val();

    if(message !== "") {
        sendMessage(message, recvID, sendID);
    }
}

/**-------------------------------------------------------- CHAT BOX FUNCTION --------------------------------------------------------**/