<?php
// This guy will return json. Thank you.

// subcourse actually, will get course too later

require 'database.php';
header('Content-Type: application/json');

// WARNING, FOREIGN CHARACTER MAY BREAK THE CODE

/*
SELECT *
FROM sub_course sc
LEFT JOIN enrolled_subcourse_studuni esu ON esu.escsu_subcourse_id = sc.subcourse_id
WHERE esu.escsu_subcourse_id IS NULL AND subcourse_mc_type = 'micro-credential'
*/

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
}

$data = null;

if (isset($_GET['r'])) {
    if ($_GET['r'] == 'course') {
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $temp = array(
                    "id" => $row['course_id'],
                    "name" => $row['course_name'],
                    "description" => clean($row["course_description"]),
                    "fee" => $row['course_fee'],
                    "type" => 'c',
                );
                array_push($data, $temp);
            }
        }
    } else if ($_GET['r'] == 'microcredential') {
        $sql = "SELECT * FROM microcredential";
        $result = $conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $temp = array(
                    "id" => $row['mc_id'],
                    "name" => $row['mc_title'],
                    "description" => clean($row["mc_description"]),
                    "fee" => $row['mc_fee'],
                    "type" => 'mc',
                );
                array_push($data, $temp);
            }
        }
    }
} else {

    $data = array(
        "course" => [],
        "microcredential" => []
    );

    $sql = "SELECT * FROM course";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $temp = array(
                    "id" => $row['course_id'],
                    "name" => $row['course_name'],
                    "description" => clean($row["course_description"]),
                    "fee" => $row['course_fee'],
                    "type" => 'c',
                );
                array_push($data["course"], $temp);
            }
        }

        $sql = "SELECT * FROM microcredential";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $temp = array(
                    "id" => $row['mc_id'],
                    "name" => $row['mc_title'],
                    "description" => clean($row["mc_description"]),
                    "fee" => $row['mc_fee'],
                    "type" => 'mc',
                );
                array_push($data["microcredential"], $temp);
            }
        }


    // New Design (Have Query Both (all))
    /*
    {
        course : [
            {...},
            {...}
        ],
        subcourse : [
            {...},
            {...}
        ]
    }
    */
}

// $a = array("a"=>"red","b"=>"green");
// $a['c'] = 'blue';
// echo json_encode($a);
echo json_encode($data);
// print_r($data);
