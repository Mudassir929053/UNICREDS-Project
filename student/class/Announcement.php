<?php
namespace DBData;

/**
 * `Announcement` class.
 * This class used to fetch all necessary data related to the announcement made by __Admin__, __Committee__, __Industry__, __Institution__, and __Lecturer__.
 */
class Announcement {
    private $dbconn;

    public function __construct() {
        $this->dbconn = $this->connect();
    }

    public function __destruct() {
        mysqli_close($this->dbconn);
    }

    private function connect() {
        include("{$_SERVER["DOCUMENT_ROOT"]}/unicreds/database/dbcon.php");
        return $conn;

        exit();
    }

/*-------------------------------------------------- FETCH ANNOUNCEMENT INFORMATION --------------------------------------------------*/

    /**
     * Function to fetch all the data of the announcement from __Admin__.
     * It holds all the data from __announcement_admin__ and __admin__ tables.
     * 
     * @return array an associative 2D array containing the announcement data from __Admin__.
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    private function fetch_announcement_admin() {
        $ann_admin = $this->dbconn->query(
            "SELECT * 
            FROM `announcement_admin` AS aa 
            LEFT JOIN `admin` AS a ON aa.announcement_created_by = a.admin_id 
            WHERE aa.announcement_receiver LIKE '%7%';"
        );

        if($ann_admin->num_rows > 0) {
            $data = array();

            foreach($ann_admin->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($data, 
                    array(
                        "title"         => $val["announcement_title"], 
                        "message"       => $val["announcement_message"], 
                        "attachment"    => $val["announcement_attachment"], 
                        "sender"        => "Admin", 
                        "sender_image"  => $val["admin_logo"] !== NULL ? "../assets/images/avatar/{$val["admin_logo"]}" : "../assets/images/avatar/avatardefault.png", 
                        "sender_name"   => $val["admin_name"], 
                        "sender_email"  => $val["admin_email"], 
                        "created_date"  => $val["announcement_created_date"]
                    )
                );
            }

            return $data;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data of the announcement from __Committee__.
     * It holds all the data from __announcement_committee__ and __committee__ tables.
     * 
     * @return array an associative 2D array containing the announcement data from __Committee__.
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    private function fetch_announcement_committee() {
        $ann_cmte = $this->dbconn->query(
            "SELECT * 
            FROM `announcement_committee` AS ac 
            LEFT JOIN `committee` AS cmte ON ac.announcement_created_by = cmte.committee_id 
            WHERE ac.announcement_receiver LIKE '%7%';"
        );

        if($ann_cmte->num_rows > 0) {
            $data = array();

            foreach($ann_cmte->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($data, 
                    array(
                        "title"         => $val["announcement_title"], 
                        "message"       => $val["announcement_message"], 
                        "attachment"    => $val["announcement_attachment"], 
                        "sender"        => "Committee", 
                        "sender_image"  => $val["committee_logo"] !== NULL ? "../assets/images/avatar/{$val["committee_logo"]}" : "../assets/images/avatar/avatardefault.png", 
                        "sender_name"   => $val["committee_name"], 
                        "sender_email"  => $val["committee_email"], 
                        "created_date"  => $val["announcement_created_date"]
                    )
                );
            }

            return $data;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data of the announcement from __Industry__.
     * It holds all the data from __announcement_industry__ and __industry__ tables.
     * 
     * @return array an associative 2D array containing the announcement data from __Industry__.
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    private function fetch_announcement_industry() {
        $ann_ind = $this->dbconn->query(
            "SELECT * 
            FROM `announcement_industry` AS ai 
            LEFT JOIN `industry` AS i ON ai.announcement_created_by = i.industry_id 
            WHERE ai.announcement_receiver LIKE '%7%';"
        );

        if($ann_ind->num_rows > 0) {
            $data = array();

            foreach($ann_ind->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($data, 
                    array(
                        "title"         => $val["announcement_title"], 
                        "message"       => $val["announcement_message"], 
                        "attachment"    => $val["announcement_attachment"], 
                        "sender"        => "Industry", 
                        "sender_image"  => $val["industry_logo"] !== NULL ? "../assets/images/industry/{$val["industry_logo"]}" : "../assets/images/avatar/avatardefault.png", 
                        "sender_name"   => $val["industry_name"], 
                        "sender_email"  => $val["industry_email"], 
                        "created_date"  => $val["announcement_created_date"]
                    )
                );
            }

            return $data;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data of the announcement from __Institution__.
     * It holds all the data from __announcement_institution__, __institution__, and __university__ tables.
     * 
     * @return array an associative 2D array containing the announcement data from __Institution__.
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    private function fetch_announcement_institution() {
        $ann_inst = $this->dbconn->query(
            "SELECT * 
            FROM `announcement_institution` AS ain 
            LEFT JOIN `institution` AS inst ON ain.announcement_created_by = inst.institution_id 
            LEFT JOIN `university` AS u ON inst.institution_university_id = u.university_id 
            WHERE ain.announcement_receiver LIKE '%7%';"
        );

        if($ann_inst->num_rows > 0) {
            $data = array();

            foreach($ann_inst->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($data, 
                    array(
                        "title"         => $val["announcement_title"], 
                        "message"       => $val["announcement_message"], 
                        "attachment"    => $val["announcement_attachment"], 
                        "sender"        => "Institution", 
                        "sender_image"  => $val["institution_logo"] !== NULL ? "../assets/images/avatar/{$val["institution_logo"]}" : "../assets/images/avatar/university_default.jpg", 
                        "sender_name"   => $val["university_name"], 
                        "sender_email"  => $val["institution_email"], 
                        "created_date"  => $val["announcement_created_date"]
                    )
                );
            }

            return $data;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the data of the announcement from __Lecturer__.
     * It holds all the data from __announcement_lecturer__ and __lecturer__ tables.
     * 
     * @return array an associative 2D array containing the announcement data from __Lecturer__.
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    private function fetch_announcement_lecturer() {
        $ann_lect = $this->dbconn->query(
            "SELECT * 
            FROM `announcement_lecturer` AS al 
            LEFT JOIN `lecturer` AS l ON al.announcement_created_by = l.lecturer_id 
            WHERE al.announcement_receiver LIKE '%7%';"
        );

        if($ann_lect->num_rows > 0) {
            $data = array();

            foreach($ann_lect->fetch_all(MYSQLI_ASSOC) as $val) {
                array_push($data, 
                    array(
                        "title"         => $val["announcement_title"], 
                        "message"       => $val["announcement_message"], 
                        "attachment"    => $val["announcement_attachment"], 
                        "sender"        => "Lecturer", 
                        "sender_image"  => $val["lecturer_profile_picture"] !== NULL ? "../assets/images/avatar/{$val["lecturer_profile_picture"]}" : "../assets/images/avatar/avatardefault.png", 
                        "sender_name"   => "{$val["lecturer_fname"]} {$val["lecturer_lname"]}", 
                        "sender_email"  => $val["lecturer_email"], 
                        "created_date"  => $val["announcement_created_date"]
                    )
                );
            }

            return $data;
        } else {
            return NULL;
        }

        exit();
    }

    /**
     * Function to fetch all the announcements from __Admin__, __Committee__, __Industry__, __Institution__, and __Lecturer__.
     * It holds all the necessary data from `fetch_announcement_admin`, `fetch_announcement_committee`, `fetch_announcement_industry`, `fetch_announcement_institution`, and `fetch_announcement_lecturer`.
     * 
     * @return array|null an associative 2D array containing the announcement data from __Lecturer__, NULL if the results is empty.
     */
    public function fetch_announcements() {
        $ann_all = array();

        $ann_all = $this->fetch_announcement_admin() !== NULL ? array_merge_recursive($ann_all, $this->fetch_announcement_admin()) : $ann_all;
        $ann_all = $this->fetch_announcement_committee() !== NULL ? array_merge_recursive($ann_all, $this->fetch_announcement_committee()) : $ann_all;
        $ann_all = $this->fetch_announcement_industry() !== NULL ? array_merge_recursive($ann_all, $this->fetch_announcement_industry()) : $ann_all;
        $ann_all = $this->fetch_announcement_institution() !== NULL ? array_merge_recursive($ann_all, $this->fetch_announcement_institution()) : $ann_all;
        $ann_all = $this->fetch_announcement_lecturer() !== NULL ? array_merge_recursive($ann_all, $this->fetch_announcement_lecturer()) : $ann_all;

        if(count($ann_all) > 0) {
            array_multisort(array_column($ann_all, "created_date"), SORT_DESC, SORT_STRING, $ann_all);

            return $ann_all;
        } else {
            return NULL;
        }

        exit();
    }

/**------------------------------------------------- FETCH ANNOUNCEMENT INFORMATION -------------------------------------------------**/
}