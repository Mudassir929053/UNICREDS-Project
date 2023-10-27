const quizPath = "/unicreds/student/quiz-attempt-question.php";
const testPath = "/unicreds/student/test-attempt-question.php";
var getPath = window.location.pathname;
var currPath = "";

// Check if this is quiz or test page.
if(getPath == quizPath) {
    var currPath = "quiz";
} else if(getPath == testPath) {
    var currPath = "test";
}

/*--------------------------------------------------------- QUIZ & TEST TIMER ---------------------------------------------------------*/

/**
 * Function to calculate the duration countdown for each 1 second interval.
 * 
 * @param {string} duration duration of the quiz/test in HH:MM:SS format.
 */
function countdown(duration) {
    // Split the `duration` string based on ':' and store it in the `hour`, `minute`, and `second` variables.
    const splitDur = duration.split(":");
    var start = Date.now(), // --- initialize the start time in miliseconds.
        time_diff, 
        hour = parseInt(splitDur[0], 10), 
        minute = parseInt(splitDur[1], 10), 
        second = parseInt(splitDur[2], 10);

    // Convert the duration into seconds.
    var timer = (hour * 3600) + (minute * 60) + second;

    /**
     * Function to calculate the duration left from the `duration` variable.
     */
    function count() {
        // Get the number of seconds has elapsed since `countdown` function been called.
        time_diff = timer - (((Date.now() - start) / 1000) | 0);

        // Get the hour, minute, and second from `time_diff` variable.
        hour = parseInt(time_diff / 3600, 10);
        minute = parseInt((time_diff / 60) % 60, 10);
        second = parseInt(time_diff % 60, 10);

        // Formatting the hour, minute, and seconds output (HH:MM:SS).
        hour = hour < 10 ? "0" + hour : hour;
        minute = minute < 10 ? "0" + minute : minute;
        second = second < 10 ? "0" + second : second;

        // Store the current timer in sessionStorage.
        sessionStorage.last_duration = hour + ":" + minute + ":" + second;

        // Display the countdown duration.
        if(time_diff < 300) { // --- less than 5 minutes.
            $("#timeRemainTop").html("Time: <span class='text-danger'>"  + hour + ":" + minute + ":" + second + "</span>");
            $("#timeRemainBottom").html("Time: <span class='text-danger'>"  + hour + ":" + minute + ":" + second + "</span>");
        } else {
            $("#timeRemainTop").html("Time: <span class='text-dark'>" + hour + ":" + minute + ":" + second + "</span>");
            $("#timeRemainBottom").html("Time: <span class='text-warning'>" + hour + ":" + minute + ":" + second + "</span>");
        }

        $("input[name=time_taken]").prop("value", hour + ":" + minute + ":" + second);

        // If countdown ends.
        if(time_diff <= 0) {
            clearInterval();
            // Remove the `last_duration` from sessionStrorage.
            sessionStorage.removeItem("last_duration");
            $("#timeRemainTop").html("<span class='text-success lead'>TIME'S UP!<span>");
            $("#timeRemainBottom").html("<span class='text-success lead'>TIME'S UP!<span>");
            
            // Get the submit button value.
            var val = $("button[type=submit]").prop("value");

            // Add hidden input that contain submit name and value.
            if(currPath == "quiz") {
                $("#qnaForm").append("<input type='hidden' name='submitQuizAnswers' value='"+val+"'>");
            } else if(currPath == "test") {
                $("#qnaForm").append("<input type='hidden' name='submitTestAnswers' value='"+val+"'>");
            }

            // Submit the form.
            $("#qnaForm")[0].submit();
        }
    };

    count();
    setInterval(count, 1000); // --- 1 seconds interval.
}

/**
 * Function to start the duration countdown for quiz/test.
 * 
 * @param {string} duration duration of the quiz/test in HH:MM:SS format.
 */
function startTimer(duration) {
    // Check if there's last countdown stored (when browser are refreshed).
    if(sessionStorage.last_duration) {
        var duration = sessionStorage.last_duration;
    } else {
        var duration = duration;
    }
    
    // Call countdown function.
    countdown(duration);
}

/**-------------------------------------------------------- QUIZ & TEST TIMER --------------------------------------------------------**/


/*---------------------------------------------------------- QUIZ & TEST QUESTIONS INDICATOR ---------------------------------------------------------*/

/**
 * Used to show the answered questions indicator on the questions navigation by changing its color (purple).
 * Shows when the questions already answered.
 */

// --- for RADIO input type.
$("#questionsList > div").find("input[type='radio']").click(function() {
    $("#" + $(this).data("id")).removeClass("btn-primary").addClass("btn-success");
});

/*---------------------------------------------------------- QUIZ & TEST QUESTIONS INDICATOR ---------------------------------------------------------*/


/*---------------------------------------------------------- QUIZ & TEST QUESTIONS NAVIGATION ---------------------------------------------------------*/

/**
 * Function to navigate the questions based on the arrow icon and arrow key.
 * 
 * @param {string} direction 
 */
function navQuestion(direction) {
    var curr_question_id = "#" + $("#questionsList > div:not(.collapse)").prop("id");
    var next_question_id = "#" + $(curr_question_id).next().prop("id");
    var prev_question_id = "#" + $(curr_question_id).prev().prop("id");
    var last_question_id = "#" + $("#questionsList > div").last().prop("id");

    if(direction == "next") {
        if(curr_question_id != last_question_id) {
            $(curr_question_id).addClass("collapse");
            $(next_question_id).removeClass("collapse");

            currQuestionNum($(curr_question_id).next().prop("id"));
        } else {
            // alert("This is the last questions.");
        }
    } else if(direction == "prev") {
        if(curr_question_id != "#question1") {
            $(curr_question_id).addClass("collapse");
            $(prev_question_id).removeClass("collapse");

            currQuestionNum($(curr_question_id).prev().prop("id"));
        } else {
            // alert("This is the first questions.");
        }
    }
}

function currQuestionNum(curr_data_id) {
    var q_nav = $("ul#questionNumNav a");

    q_nav.each(function() {
        if($(this).hasClass("btn-primary") && !($(this).hasClass("btn-success"))) {
            $(this).removeClass("btn-primary").addClass("btn-outline-primary");
        } else if($(this).data("id") == curr_data_id) {
            $(this).removeClass("btn-outline-primary").addClass("btn-primary");
        }
    });
}

/**
 * Questions navigation based on the questions number.
 */
$("#questionNumNav > li > a").on("click", function() {
    var curr_question_id = "#" + $("#questionsList > div:not(.collapse)").prop("id");
    var next_question_id = "#" + $(this).data("id");
    
    $(curr_question_id).addClass("collapse");
    $(next_question_id).removeClass("collapse");

    currQuestionNum($(this).data("id"));
});

// Navigate the questions using arrow key.
$(document).keydown(function(event) {
    if(event.which == 37) {
        navQuestion('prev');
    } else if(event.which == 39) {
        navQuestion('next')
    }
});

/**
 * Prevent the changes in chosen answer when left/right key are pressed down in radio input type.
 */
$("input[type='radio']").keydown(function(e) {
    var arrowKeys = [37, 39];
    if(arrowKeys.indexOf(e.which) !== -1) {
        $(this).blur();
        return false;
    }
});

/**--------------------------------------------------------- QUIZ & TEST QUESTIONS NAVIGATION --------------------------------------------------------**/