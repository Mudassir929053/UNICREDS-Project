<?php
include("../function/student-function.php");


/*--------------------------------------------------------- CHAT DATE & TIME FUNCTION ---------------------------------------------------------*/

// Chat's date badge.
function chat_date($chat_date) {
    $chatDate = (
        '<div class="d-flex w-lg-100 mb-2 justify-content-center">' . 
            '<span class="badge rounded-pill bg-dark">' . $chat_date . '</span>' . 
        '</div>'
    );

    return $chatDate;
    exit();
}

/**-------------------------------------------------------- CHAT DATE & TIME FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- CHAT BUBBLE FUNCTION ---------------------------------------------------------*/

// Sender's chat bubble.
function instructor_chat($timestamp, $message) {
    $senderChat = (
        '<!-- Sender Chat -->' . 
        '<div class="d-flex w-lg-75 mb-4">' . 
            '<!-- media body -->' . 
            '<div class="ms-3">' . 
                '<small>' . date_format(date_create($timestamp), "h:i a") . '</small>' . 
                '<div class="d-flex">' . 
                    '<div class="card mt-2 rounded-top-md-left-0 border shadow">' . 
                        '<div class="card-body p-3">' . 
                            '<p class="mb-0 text-dark">' . 
                                htmlspecialchars($message) . 
                            '</p>' . 
                        '</div>' . 
                    '</div>' . 
                '</div>' . 
            '</div>' . 
        '</div>'
    );

    return $senderChat;
    exit();
}

// Receiver's chat bubble.
function student_chat($timestamp, $message) {
    $receiverChat = (
        '<!-- Chat Student -->' . 
        '<div class="d-flex justify-content-end mb-4">' . 
            '<!-- media -->' . 
            '<div class="d-flex justify-content-end w-lg-75">' . 
                '<!-- media body -->' . 
                '<div class=" me-3 text-end">' . 
                    '<small>' . date_format(date_create($timestamp), "h:i a") . '</small>' . 
                    '<div id="messageBubble<?= $sucmInfoRow->sucm_id ?>" class="d-flex">' . 
                        '<!-- card -->' . 
                        '<div class="card mt-2 rounded-top-md-end-0 bg-primary text-white shadow">' . 
                            '<!-- card body -->' . 
                            '<div class="card-body text-start p-3">' . 
                                htmlspecialchars($message) . 
                            '</div>' . 
                        '</div>' . 
                    '</div>' . 
                '</div>' . 
            '</div>' . 
        '</div>'
    );

    return $receiverChat;
    exit();
}

/**-------------------------------------------------------- CHAT BUBBLE FUNCTION --------------------------------------------------------**/


/*--------------------------------------------------------- CHAT FETCH & SEND AJAX REQUEST ---------------------------------------------------------*/

// To fetch all chats based on the receiver user ID and sender user ID.
if(isset($_POST["fetch_all_chat"])) {
    $suID = $_POST["suID"];
    $instructorID = $_POST["instructorID"];
    $_SESSION["today_tag" . $instructorID] = "";

    // echo $suID . "</br>" . $instructorID . "</br>";

    $sucmFetchAll = $conn->query("SELECT * 
                                FROM `student_university_chat_message` AS sucm 
                                WHERE (sucm.sucm_sender_user_id = '$suID' && sucm.sucm_receiver_user_id = '$instructorID') || 
                                        (sucm.sucm_sender_user_id = '$instructorID' && sucm.sucm_receiver_user_id = '$suID') 
                                ORDER BY sucm.sucm_timestamp;");

    if($sucmFetchAll) {
        if($sucmFetchAll->num_rows !== 0) {
            $currDate = "";
            $today = date("Y-m-d", strtotime("now"));
            $yesterday = date("Y-m-d", strtotime("-1 days"));
            $printed = true;

            foreach($sucmFetchAll->fetch_all(MYSQLI_ASSOC) as $val) {
                // get date and time.
                $getDateTime = explode(" ", $val["sucm_timestamp"]);
                $chatDate = $getDateTime[0];
                $chatTime = $getDateTime[1];

                // store the last chat message's date & time.
                $_SESSION["last_datetime" . $instructorID] = $val["sucm_timestamp"];

                // Chat's date tag.
                if($chatDate === $currDate) {
                    $printed = false;
                } else if($chatDate !== $currDate) {
                    $printed = true;
                } 
                
                if($chatDate === $today && $printed) {
                    echo chat_date("Today");
                    $currDate = $chatDate;
                    // store "Today" tag.
                    $_SESSION["today_tag" . $instructorID] = "Today";
                } else if($chatDate === $yesterday && $printed) {
                    echo chat_date("Yesterday");
                    $currDate = $chatDate;
                } else if($printed) {
                    echo chat_date($chatDate);
                    $currDate = $chatDate;
                }

                // Print chat messages.
                if($val["sucm_sender_user_id"] === $instructorID) {
                    echo instructor_chat($chatTime, $val["sucm_chat_message"]);
                } else if($val["sucm_sender_user_id"] === $suID) {
                    echo student_chat($chatTime, $val["sucm_chat_message"]);
                }
            }
        } else {
            echo "";
        }
    } else {
        echo "Error fetching chat messages...";
    }

    exit();
}

// To send chat messages based on instructor user ID.
if(isset($_POST["send_chat"])) {
    $suID = $_POST["suID"];
    $instructorID = $_POST["instructorID"];
    $chatMessage = htmlspecialchars($_POST["chatMessage"]);
    $chatTime = date('H:i:s', strtotime("now"));
    $chatDateTime = date('Y-m-d H:i:s', strtotime("now"));

    $sucmInsertChat = $conn->query("INSERT INTO `student_university_chat_message`(`sucm_receiver_user_id`, `sucm_sender_user_id`, `sucm_chat_message`, `sucm_timestamp`) 
                                    VALUES ('$instructorID', '$suID', '$chatMessage', '$chatDateTime')");

    if($sucmInsertChat) {
        // store the last chat message's date & time.
        $_SESSION["last_datetime" . $instructorID] = $chatDateTime;

        // check if "Today" tag are already used.
        if($_SESSION["today_tag" . $instructorID] === "") {
            echo chat_date("Today");
            $_SESSION["today_tag" . $instructorID] = "Today";
        }
        echo student_chat($chatTime, $chatMessage);
    } else {
        echo "Error sending chat message...";
    }

    exit();
}

// To fetch instructor's reply messages based on student's user ID.
if(isset($_POST["fetch_incoming_chat"])) {
    $suID = $_POST["suID"];
    $instructorID = $_POST["instructorID"];

    // set date & time.
    // --- get stored date & time from SESSION (if exist).
    if(!isset($_SESSION["last_datetime" . $instructorID])) {
        $chatDateTime = date('Y-m-d H:i:s', strtotime("now"));
    } else {
        $chatDateTime = $_SESSION["last_datetime" . $instructorID];
    }
    
    $sucmFetchChat = $conn->query("SELECT * 
                                    FROM `student_university_chat_message` AS sucm 
                                    WHERE sucm.sucm_receiver_user_id = '$suID' && sucm.sucm_sender_user_id = '$instructorID' 
                                            && sucm.sucm_timestamp > '$chatDateTime' 
                                    ORDER BY sucm.sucm_timestamp;");

    if($sucmFetchChat) {
        if($sucmFetchChat->num_rows !== 0) {
            foreach($sucmFetchChat->fetch_all(MYSQLI_ASSOC) as $val) {
                // store the last chat message's date & time.
                $_SESSION["last_datetime" . $instructorID] = $val["sucm_timestamp"];

                // get time.
                $chatTime = explode(" ", $val["sucm_timestamp"])[1];
        
                // check if "Today" tag are already used.
                if($_SESSION["today_tag" . $instructorID] === "") {
                    echo chat_date("Today");
                    $_SESSION["today_tag" . $instructorID] = "Today";
                }
                echo instructor_chat($chatTime, $val["sucm_chat_message"]);
            }
        } else {
            // echo $chatDateTime . " " . $suID . " " . $instructorID;
        }
    } else {
        echo "Error fetching chat message...";
    }

    exit();
}

/**-------------------------------------------------------- CHAT FETCH & SEND AJAX REQUEST --------------------------------------------------------**/