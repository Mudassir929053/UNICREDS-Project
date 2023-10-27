<?php
namespace DBData;

/**
 * `Student` class.
 * This class used to fetch all necessary data related to student university.
 */
class Student {
    private $dbconn;
    private $studuni_id;

    public function __construct($studuni_id) {
        $this->dbconn = $this->connect();
        $this->studuni_id = $studuni_id;
    }

    public function __destruct() {
        mysqli_close($this->dbconn);
    }

    private function connect() {
        include("{$_SERVER["DOCUMENT_ROOT"]}/unicreds/database/dbcon.php");
        return $conn;

        exit();
    }


/*-------------------------------------------------- STUDENT UNIVERSITY FETCH INFORMATION --------------------------------------------------*/

    /**
     * Function to fetch all the information about student university.
     * It holds all the data from `student_university` table.
     * 
     * @return array|null an associative array, NULL if the results is empty.
     */
    public function fetch_info() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university` AS su 
            LEFT JOIN `institution` AS i ON su.su_institution_id = i.institution_id 
            LEFT JOIN `university` AS u ON u.university_id = i.institution_university_id 
            LEFT JOIN `city` AS c ON su.su_city_id = c.city_id 
            LEFT JOIN `postcode` AS p ON p.postcode_city_id = c.city_id 
            LEFT JOIN `state` AS s ON su.su_state_id = s.state_id 
            LEFT JOIN `country` AS ctry ON su.su_country_id = ctry.country_id 
            WHERE su.su_id = {$this->studuni_id} AND su.su_deleted_date IS NULL;"
        );
        if($student !=false){
        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC)[0];
        } else {
            return NULL;
        }
    }
        exit();
    }

    /**
     * Function to fetch all the information about student university's experience details.
     * It holds all the data from `student_university_experience_details` table.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    

    /**
     * Function to fetch all the information about student university's skill set.
     * It holds all the data from `student_university_skill_set` and `skill_type` table.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_skill() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university_skill_set` AS sus 
            JOIN `skill_type` AS st ON sus.sus_skill_type_id = st.skill_id 
            WHERE sus.sus_student_university_id = {$this->studuni_id} 
            ORDER BY st.skill_name;"
        );

        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }
    
/**------------------------------------------------- STUDENT EDUCATION FETCH INFORMATION -------------------------------------------------**/

    /**
     * Function to fetch all the information about student university's experience details.
     * It holds all the data from `student_university_experience_details` table.
     * 
     * @return array|null an associative 2D array, NULL if the results is empty.
     */
    public function fetch_education() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university_education_details`           
            WHERE sued_student_university_id = {$this->studuni_id} 
            ORDER BY sued_course_end_date;"
        );

        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }
    // reference
    public function fetch_reference() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university_reference_details`           
            WHERE sued_student_university_id = {$this->studuni_id} ;"
        );

        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }
    public function fetch_hobby() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university_hobby_details`           
            WHERE sued_student_university_id = {$this->studuni_id} ;"
        );

        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }
    // reference end
    // hobby
   
    // hobby END
    public function fetch_experience() {
        $student = $this->dbconn->query(
            "SELECT * 
            FROM `student_university_experience_details`           
            WHERE sued_student_university_id = {$this->studuni_id} ;"
        );

        if($student->num_rows > 0) {
            return $student->fetch_all(MYSQLI_ASSOC);
        } else {
            return NULL;
        }

        exit();
    }
/**------------------------------------------------- STUDENT UNIVERSITY FETCH INFORMATION -------------------------------------------------**/
 

/*-------------------------------------------------- STUDENT UNIVERSITY INSERT, UPDATE, AND DELETE INFORMATION --------------------------------------------------*/

    /**
     * Function to update new student university's profile information.
     * It will store all the data in `
     * versity` table.
     * 
     * @param array $studuni_info an associative array containing student university informations.
     * @return boolean `true` if success, `false` if failed.
    */
    public function update_profile($studuni_info) {
        $student = $this->dbconn->query(
            "UPDATE `student_university` 
            SET `su_city_id` = {$studuni_info["city_id"]}, `su_state_id` = {$studuni_info["state_id"]}, 
            `su_country_id` = {$studuni_info["country_id"]}, `su_fname` = '{$studuni_info["first_name"]}',
             `su_lname` = '{$studuni_info["last_name"]}', `su_no_ic` = '{$studuni_info["ic_no"]}',
             `su_linked_in` = '{$studuni_info["linked_in"]}',`su_passport_no` = '{$studuni_info["pass_no"]}',
              `su_gender` = '{$studuni_info["gender"]}', `su_contact_no` = '{$studuni_info["contact_no"]}',
               `su_dob` = '{$studuni_info["dob"]}', `su_address` = '{$studuni_info["addr"]}', 
               `su_nationality` = '{$studuni_info["nationality"]}', `su_updated_date` = '{$studuni_info["date_updated"]}' 
            WHERE `su_id` = {$this->studuni_id};"
        );

        if($student) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to update student university's email address.
     * It will store all the date in `student_university` and `user` table.
     * 
     * @param string $new_email student university's email address.
     * @return boolean `true` if success, `false` if failed.
     */
    public function update_email($new_email) {
        // Fetch user_id from `student_university` table.
        $su_user_id = $this->fetch_info()["su_user_id"];

        // Update username in `user` table.
        $userInfo = $this->dbconn->query(
            "UPDATE `user` 
            SET `user_username` = '{$new_email}' 
            WHERE `user_id` = {$su_user_id};"
        );

        // Update email in `student_university` table.
        $student = $this->dbconn->query(
            "UPDATE `student_university` 
            SET `su_email` = '{$new_email}' 
            WHERE `su_id` = {$this->studuni_id};"
        );

        if($student && $userInfo) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to fetch and compare the current password.
     * If it's matched, then update the current password with new password.
     * 
     * @param string $curr_pwd the current password.
     * @param string $new_pwd the new password.
     * @return string `success`: UPDATE password success, `fail`: there's an error in database, `unmatched`: $curr_pwd not matched.
     */
    public function update_password($curr_pwd, $new_pwd) {
        // Fetch user_id from `student_university` table.
        $su_user_id = $this->fetch_info()["su_user_id"];

        $userInfo = $this->dbconn->query(
            "SELECT u.user_password 
            FROM `user` AS u
            WHERE u.user_id = {$su_user_id};"
        );

        if($userInfo->num_rows !== 0) {
            // Check if the $curr_pwd matched or not.
            if(password_verify($curr_pwd, $userInfo->fetch_all(MYSQLI_ASSOC)[0]["user_password"])) {
                $user_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);

                $updatePwd = $this->dbconn->query(
                    "UPDATE `user` 
                    SET `user_password` = '{$user_pwd}' 
                    WHERE `user_id` = {$su_user_id};"
                );

                if($updatePwd) {
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                return "unmatched";
            }
        } else {
            return "fail";
        }

        exit();
    }

    /**
     * Function to update student university's profile picture data.
     * It will store all the data in `student_university` table.
     * 
     * @param string $file_name name of the profile picture.
     * @return boolean `true` if success, `false` if failed.
     */
    public function update_profile_picture($file_name) {
        if($file_name !== NULL) {
            $student = $this->dbconn->query(
                "UPDATE `student_university` 
                SET `su_profile_pic` = '{$file_name}' 
                WHERE su_id = {$this->studuni_id};"
            );
        } else {
            $student = $this->dbconn->query(
                "UPDATE `student_university` 
                SET `su_profile_pic` = NULL 
                WHERE su_id = {$this->studuni_id};"
            );
        }

        if($student) {
            return true;
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to update student university's curriculum vitae (CV) data.
     * It will store all the data in `student_university` table.
     * 
     * @param string $file_name name of the cv file.
     * @return boolean `true` if success, `false` if failed.
     */
    public function update_cv($file_name) {
        if($file_name !== NULL) {
            $student = $this->dbconn->query(
                "UPDATE `student_university` 
                SET `su_cv` = '{$file_name}' 
                WHERE su_id = {$this->studuni_id};"
            );
        } else {
            $student = $this->dbconn->query(
                "UPDATE `student_university` 
                SET `su_cv` = NULL 
                WHERE su_id = {$this->studuni_id};"
            );
        }

        if($student) {
            return true;
        } else {
            return false;
        }

        exit();
    }

 
 
// EDUCATION
public function insert_education($su_edu) {
    $suEduInfo = $this->dbconn->query(
        "INSERT INTO `student_university_education_details`(`sued_student_university_id`,   `sued_course_title`, `sued_course_description`, `sued_college_name`,`sued_course_start_date`, `sued_course_end_date`, `sued_course_status`) 
        VALUES ({$this->studuni_id},'{$su_edu["course_title"]}', '{$su_edu["course_desc"]}', '{$su_edu["college_name"]}', '{$su_edu["start_course_date"]}', '{$su_edu["course_end_date"]}', '{$su_edu["course_status"]}');"
    );

    if($suEduInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}

/**
 * Function to update student university's job experience.
 * It will store all the data in `student_university_experience_details` table.
 * 
 * @param array $su_exp an associative array containing student university job experience details.
 * @return boolean `true` if success, `false` if failed.
 */
public function update_education($su_edu) {
    $suEduInfo = $this->dbconn->query(
        "UPDATE `student_university_education_details` 
        SET   `sued_course_title` = '{$su_edu["course_title"]}', `sued_course_description` = '{$su_edu["course_desc"]}', `sued_college_name` = '{$su_edu["college_name"]}',`sued_course_start_date` = '{$su_edu["start_course_date"]}', `sued_course_end_date` = '{$su_edu["course_end_date"]}', `sued_course_status` = '{$su_edu["course_status"]}' 
        WHERE sued_id = {$su_edu["sued_id"]};"
    );

    if($suEduInfo) {
        return true;
    } else {
        return false;
    }
    
    exit();
}


/**
 * Function to delete the student university's job 333333333333.
 * It will remove all the data stored in the row based on the `sued_id` in `student_university_experience_details` table.
 * 
 * @param string|int $sued_id id for `student_university_experience_details` row.
 * @return boolean `true` if success, `false` if failed.
 */
public function delete_education($sued_id) {
    $suEduInfo = $this->dbconn->query(
        "DELETE FROM `student_university_education_details` WHERE `sued_id` = {$sued_id};"      
     
    );
    // -- DELETE FROM `student_university_education_details` 
    // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
    if($suEduInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}


// EDUCATION END
// reference
public function insert_reference($su_reference) {
    $suReferenceInfo = $this->dbconn->query(
        "INSERT INTO `student_university_reference_details`(`sued_student_university_id`, `sued_reference`) 
        VALUES ({$this->studuni_id},'{$su_reference["reference"]}');"
    );

    if($suReferenceInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}

/**
 * Function to update student university's job experience.
 * It will store all the data in `student_university_experience_details` table.
 * 
 * @param array $su_exp an associative array containing student university job experience details.
 * @return boolean `true` if success, `false` if failed.
 */
public function update_reference($su_reference) {
    $suReferenceInfo = $this->dbconn->query(
        "UPDATE `student_university_reference_details` 
        SET   `sued_reference` = '{$su_reference["reference"]}'
        WHERE sued_id = {$su_reference["sued_id"]};"
    );

    if($suReferenceInfo) {
        return true;
    } else {
        return false;
    }
    
    exit();
}


/**
 * Function to delete the student university's job 333333333333.
 * It will remove all the data stored in the row based on the `sued_id` in `student_university_experience_details` table.
 * 
 * @param string|int $sued_id id for `student_university_experience_details` row.
 * @return boolean `true` if success, `false` if failed.
 */
public function delete_reference($sued_id) {
    $suReferenceInfo = $this->dbconn->query(
        "DELETE FROM `student_university_reference_details` WHERE `sued_id` = {$sued_id};"      
     
    );
    // -- DELETE FROM `student_university_education_details` 
    // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
    if($suReferenceInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}


// reference end
// hobby
public function insert_hobby($su_hobby) {
    $suHobbyInfo = $this->dbconn->query(
        "INSERT INTO `student_university_hobby_details`(`sued_student_university_id`,   `sued_hobby_name`) 
        VALUES ({$this->studuni_id},'{$su_hobby["hobby_name"]}');"
    );

    if($suHobbyInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}

/**
 * Function to update student university's job experience.
 * It will store all the data in `student_university_experience_details` table.
 * 
 * @param array $su_exp an associative array containing student university job experience details.
 * @return boolean `true` if success, `false` if failed.
 */
public function update_hobby($su_hobby) {
    $suHobbyInfo = $this->dbconn->query(
        "UPDATE `student_university_hobby_details` 
        SET   `sued_hobby_name` = '{$su_hobby["hobby_name"]}'
        WHERE sued_id = {$su_hobby["sued_id"]};"
    );

    if($suHobbyInfo) {
        return true;
    } else {
        return false;
    }
    
    exit();
}


/**
 * Function to delete the student university's job 333333333333.
 * It will remove all the data stored in the row based on the `sued_id` in `student_university_experience_details` table.
 * 
 * @param string|int $sued_id id for `student_university_experience_details` row.
 * @return boolean `true` if success, `false` if failed.
 */
public function delete_hobby($sued_id) {
    $suHobbyInfo = $this->dbconn->query(
        "DELETE FROM `student_university_hobby_details` WHERE `sued_id` = {$sued_id};"      
     
    );
    // -- DELETE FROM `student_university_education_details` 
    // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
    if($suHobbyInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}
// hobby END
public function insert_experience($su_experience) {
    $suExperienceInfo = $this->dbconn->query(
        "INSERT INTO `student_university_experience_details`(`sued_student_university_id`,   `sued_language_name`,`sued_com_name`,`sued_job_start_date`,`sued_job_end_date`,`sued_job_description`) 
        VALUES ({$this->studuni_id},'{$su_experience["language_name"]}','{$su_experience["com_name"]}','{$su_experience["job_start_date"]}','{$su_experience["job_end_date"]}','{$su_experience["job_description"]}');"
    );

    if($suExperienceInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}

/**
 * Function to update student university's job experience.
 * It will store all the data in `student_university_experience_details` table.
 * 
 * @param array $su_exp an associative array containing student university job experience details.
 * @return boolean `true` if success, `false` if failed.
 */
public function update_experience($su_experience) {
    $suExperienceInfo = $this->dbconn->query(
        "UPDATE `student_university_experience_details` 
        SET   `sued_language_name` = '{$su_experience["language_name"]}',`sued_com_name` = '{$su_experience["com_name"]}',`sued_job_start_date` = '{$su_experience["job_start_date"]}',`sued_job_description` = '{$su_experience["job_description"]}'
        WHERE sued_id = {$su_experience["sued_id"]};"
    );

    if($suExperienceInfo) {
        return true;
    } else {
        return false;
    }
    
    exit();
}


/**
 * Function to delete the student university's job 333333333333.
 * It will remove all the data stored in the row based on the `sued_id` in `student_university_experience_details` table.
 * 
 * @param string|int $sued_id id for `student_university_experience_details` row.
 * @return boolean `true` if success, `false` if failed.
 */
public function delete_experience($sued_id) {
    $suExperienceInfo = $this->dbconn->query(
        "DELETE FROM `student_university_experience_details` WHERE `sued_id` = {$sued_id};"      
     
    );
    // -- DELETE FROM `student_university_education_details` 
    // -- WHERE `student_university_education_details`.`sued_id` = {$sued_id};"
    if($suExperienceInfo) {
        return true;
    } else {
        return false;
    }

    exit();
}
    /**
     * Function to insert the new student university's skill set.
     * It will store all the data in `skill_type` and `student_university_skill_set` table.
     * 
     * @param array $su_skill an associative array containing student university skill set.
     * @return boolean `true` if success, `false` if failed.
     */
    public function insert_skill($su_skill) {
        // Fetch all the skill and show it in descending order by skill_id (latest skill id at the top).
        $skillInfo = $this->dbconn->query(
            "SELECT * 
            FROM `skill_type` 
            ORDER BY skill_id DESC;"
        );

        // Check and determine the new inserted skill unique id.
        if($skillInfo->num_rows == 0) {
            // --- if its the first skill.
            $uniqueID = 1;
        } else {
            // --- if there are other skills exist.
            $skillInfoRow = mysqli_fetch_object($skillInfo);
            $uniqueID = $skillInfoRow->skill_id + 1;
        }

        // Insert the new skill into `skill_type` table.
        $addSkillType = $this->dbconn->query(
            "INSERT INTO `skill_type`(`skill_id`, `skill_name`) 
            VALUES ({$uniqueID}, '{$su_skill["skill_name"]}');"
        );

        if($addSkillType) {
            // Check if there is a certificate or not.
            if($su_skill["skill_cert"] !== NULL) {
                $suSkillInfo = $this->dbconn->query(
                    "INSERT INTO `student_university_skill_set`(`sus_student_university_id`, `sus_skill_type_id`, `sus_skill_level`, `sus_skill_certificate`, `sus_certificate_provider`, `sus_certificate_date`) 
                    VALUES ({$this->studuni_id}, {$uniqueID}, '{$su_skill["skill_lvl"]}', '{$su_skill["skill_cert"]}', '{$su_skill["cert_prvd"]}', '{$su_skill["cert_date"]}');"
                );
            } else {
                $suSkillInfo = $this->dbconn->query(
                    "INSERT INTO `student_university_skill_set`(`sus_student_university_id`, `sus_skill_type_id`, `sus_skill_level`) 
                    VALUES ({$this->studuni_id}, {$uniqueID}, '{$su_skill["skill_lvl"]}');"
                );
            }

            if($suSkillInfo) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        exit();
    }

    /**
     * Function to update the current student university's skill set.
     * It will store all the data in `skill_type` and `student_university_skill_set` table.
     * 
     * @param array $su_skill an associative array containing student university skill set.
     * @return boolean `true` if success, `false` if failed.
     */
    public function update_skill($su_skill) {
        // Check if there is a certificate or not.
        if($su_skill["skill_cert"] !== NULL) {
            // --- update skill certificate information only.
            $suSkillInfo = $this->dbconn->query(
                "UPDATE `student_university_skill_set` 
                SET `sus_skill_certificate` = '{$su_skill["skill_cert"]}', `sus_certificate_provider` = '{$su_skill["cert_prvd"]}', `sus_certificate_date` = '{$su_skill["cert_date"]}' 
                WHERE sus_id = {$su_skill["sus_id"]};"
            );

            if($suSkillInfo) {
                return true;
            } else {
                return false;
            }
        } else {
            // --- update skill information only.
            // --- update skill name.
            $skillInfo = $this->dbconn->query(
                "UPDATE `skill_type` 
                SET `skill_name` = '{$su_skill["skill_name"]}' 
                WHERE skill_id = {$su_skill["skill_id"]};"
            );

            // --- update skill level.
            if($skillInfo) {
                $suSkillInfo = $this->dbconn->query(
                    "UPDATE `student_university_skill_set` 
                    SET `sus_skill_type_id` = {$su_skill["skill_id"]}, `sus_skill_level` = '{$su_skill["skill_lvl"]}' 
                    WHERE sus_id = {$su_skill["sus_id"]};"
                );

                if($suSkillInfo) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        exit();
    }

    /**
     * Function to delete the student university's skill set or skill certificate.
     * It will remove all the data stored in the row based on the `skill_id` in `skill_type` table and `sus_id` in `student_university_skill_set` table.
     * 
     * @param array $su_skill an associative array containing student university skill set.
     * @return boolean `true` if success, `false` if failed.
     */
    public function delete_skill($su_skill) {
        if($su_skill["skill_id"] === NULL) {
            // Update the `sus_skill_certificate`, `sus_certificate_provider`, and `sus_certificate_date` to NULL.
            $suSkillInfo = $this->dbconn->query(
                "UPDATE `student_university_skill_set` 
                SET `sus_skill_certificate` = NULL, `sus_certificate_provider` = NULL, `sus_certificate_date` = NULL 
                WHERE sus_id = {$su_skill["sus_id"]};"
            );

            if($suSkillInfo) {
                return true;
            } else {
                return false;
            }
        } else {
            // Delete row from `skill_type` and `student_university_skill_set` table.
            $suSkillInfo = $this->dbconn->query(
                "DELETE FROM `student_university_skill_set` 
                WHERE sus_id = {$su_skill["sus_id"]};"
            );

            if($suSkillInfo) {
                $skillInfo = $this->dbconn->query(
                    "DELETE FROM `skill_type` 
                    WHERE skill_id = {$su_skill["skill_id"]}"
                );

                if($skillInfo) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
    }
   
    

       
}



    
