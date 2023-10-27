<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
    include('../database/dbcon.php');
    date_default_timezone_set("Asia/Kuala_Lumpur");

    // for micro-creds academic lecturer.
    if(isset($_POST["msg"])) {
        // Lecturer:
        /*  
            Alibaba Jones user id: 18
            Anite Anette user id: 26
        */
        // Expert: 
        /*
            Wan Warren user id: 19
        */

        // student user id: 15
        $chatMessage = $_POST["msg"];
        $chatTime = date('H:i:s', strtotime("now"));
        $chatDate = date('Y-m-d', strtotime("now"));
        $chatDateTime = date('Y-m-d H:i:s', strtotime("now"));

        $sucmInsert = $conn->query("INSERT INTO `student_university_chat_message`(`sucm_receiver_user_id`, `sucm_sender_user_id`, `sucm_chat_message`, `sucm_timestamp`) 
                                    VALUES (15, 18, '$chatMessage', '$chatDateTime');");

        if($sucmInsert) {
            echo 'alert("Send message success!")';
        } else {
            echo 'alert("Send message failed!")';
        }
    }
?>

    <body>
        <table>
            <tr>
                <td>
                    <textarea name="reply" id="reply" cols="30" rows="1"></textarea>
                </td>
                <td>
                    <button type="button" id="send" onclick="sendMsg()">Send message</button>
                </td>
            </tr>
        </table>

        <!-- <?php
            // $filename = "file.pdf";
            // $ext = pathinfo($filename, PATHINFO_EXTENSION);

            // echo "<h1>$ext</h1>";
        ?>

        <div>
            Password Encrypt: <span><?= password_hash("admin_mc",PASSWORD_DEFAULT) ?></span>
        </div> -->
        
        <script type="text/javascript">
            const sendMsg = () => {
                $.ajax({
                    type: 'POST',
                    url: 'instructor-reply-chat.php',
                    data: { msg: $("#reply").val() }
                });
            }
        </script>
    </body>
</html>