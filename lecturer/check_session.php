<?php  
	session_start();
	if(isset($_SESSION['sess_lecturerid']) && (isset($_SESSION['sess_adminid']) || (isset($_SESSION['sess_uppermanagementid']) ||(isset($_SESSION['sess_adminfinanceid']) )))) {
		echo '2';	  //too much session
	}
	else if(isset($_SESSION["sess_lecturerid"])) {  
		echo '0';     //session not expired       
	}  
	else {  
		echo '1';     //session expired  
	}
?>