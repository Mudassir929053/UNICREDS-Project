<?php
// file untuk proses dan function
// include('../database/dbcon.php');
$root_path = $_SERVER["DOCUMENT_ROOT"]."/unicreds/";

include($root_path."database/dbcon.php");
foreach(glob($root_path."public/class/*.php") as $filename) {
    include $filename;
}
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();



use DBData\Job as job;
use DBData\Course as c;
use DBData\Microcredential as mc;



$jobInfo = new job();
$courseInfo = new c();
$mcInfo = new mc();


/*------------------------------------------------------------- FUNCTIONS -------------------------------------------------------------*/

/**
 * Function to format the Time.
 * Used for the __Video__ tab in __course/micro-creds-learning-material.php__ page.
 * 
 * @param string $time Time in __HH:MM:SS__ format.
 * @return string Time formatted in __HHh MMm SSs__.
 */
function duration_formatting($time) {
    $slot = explode(":", $time);

    $hour = $slot[0] === "00" ? "" : (substr($slot[0], 0, -1) == "0" ? substr($slot[0], 1)."h " : $slot[0]."h ");
    $minute = $slot[1] === "00" ? "" : (substr($slot[1], 0, -1) == "0" ? substr($slot[1], 1)."m " : $slot[1]."m ");
    $second = $slot[2] === "00" ? "" : (substr($slot[2], 0, -1) == "0" ? substr($slot[2], 1)."s " : $slot[2]."s");

    return $hour.$minute.$second;
}

/**
 * Function to calculate the time remaining based on the `$duetime` and `$duedate`.
 * Used for the __Tutorial__ and __Assignment__ tab in __course/micro-creds-learning-material.php__ page.
 * 
 * @param string $duetime Time string in __HH:MM:SS__ format.
 * @param string $duedate Date string in __YYYY-MM-DD__ format.
 * @return string string of time remainingf from the due time and due date.
 */
function timeRemaining($duetime, $duedate) {
    $dueDateTime = $duedate . " " . $duetime;

    $now = new DateTime();
    $future_date = new DateTime($dueDateTime);
    
    $interval = $future_date->diff($now);
    
    if($now->format("Y-m-d H-m-s") < $dueDateTime) {
        echo $interval->format("%a days, %h hours, %i minutes");
    } else {
        echo "<span class='text-danger'>Due: {$interval->format('%a days, %h hours, %i minutes')}</span>";
    }
}

/**
 * Function to determine the skill level and return HTML code to display the level.
 * Used for the __Skill__ tab in __student-manage-portfolio.php__ page.
 * 
 * @param string $skill_level level of the skill.
 * @return string string of HTML code.
 */
function skillLevel($skill_level) {
    switch($skill_level) {
        case "Beginner":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                    '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                    '<rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9" />' . 
                    '<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9" />' . 
                '</svg>' . 
                'Beginner'
            );
            break;
        case "Intermediate":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                    '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                    '<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE" />' . 
                    '<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9" />' . 
                '</svg>' . 
                'Intermediate'
            );
            break;
        case "Advance":
            return (
                '<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                   '<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE" />' . 
                   '<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE" />' . 
                   '<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE" />' . 
                '</svg>' . 
                'Advance'
            );
            break;
        default:
            return NULL;
    }
}

/**
 * Function to print the duration based on the format.
 * 
 * @param int $duration duration in minutes.
 * @param string $format how to display the duration based on format values.
 * @return string formatted string of duration.
 */
function durationFormat($duration, $format = "%02d:%02d:%02d") {
   $hours = floor($duration / 60);
   $minutes = ($duration % 60);
   $seconds = 0;

   return sprintf($format, $hours, $minutes, $seconds);
}

/**
 * Function to determine micro-credential's academic level.
 * 
 * @param string $acad_lvl string of integer of academic level (eg. '1, 2').
 * @return string string of academic level name.
 */
function acadLevel($acad_lvl) {
    $level_int = explode(",", $acad_lvl);
    $result = "";

    $i = 0;
    foreach($level_int as $val) {
        if($val == "1") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Undergraduate";
        } else if($val == "2") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Postgraduate";
        } else if($val == "3") {
            if($i > 0) {
                $result .= ", ";
            }
            $result .= "Continuing and Professional Development";
        }

        $i++;
    }

    return $result;
}

/**
 * Convert the fee from sen to RM.
 * eg.: 100 = RM 1.00.
 * 
 * @param string|int $fee fee for course/micro-credential.
 * @return string string of the fee in RM XXX.XX.
 */
function feeFormat($fee) {
    $fee_RM = floatval($fee/100);

    return "RM ".number_format($fee_RM, 2, ".", ", ");
}

/**
 * Function to parse the minimum and maximum job salary.
 * 
 * @param int $min_sal minimum salary in integer.
 * @param int $max_sal maximun salary in integer.
 * @return string formatted string of salary.
 */
function salary($min_sal, $max_sal) {
    if($min_sal != 0 || $max_sal != 0) {
        if($min_sal === 0) {
            $sal_str = $max_sal > 1000 ? round($max_sal/1000, 1)."K" : $max_sal;
        } else if($max_sal === 0) {
            $sal_str = $min_sal > 1000 ? round($min_sal/1000, 1)."K" : $min_sal;
        } else {
            $sal_str = ($min_sal > 1000 ? round($min_sal/1000, 1)."K" : $min_sal)." - ".($max_sal > 1000 ? round($max_sal/1000, 1)."K" : $max_sal);
        }

        return "MYR {$sal_str} monthly";
    } else {
        return "<span class='text-muted'><em>Not specified</em></span>";
    }
}