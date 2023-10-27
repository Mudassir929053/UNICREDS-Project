<?php
$conn = mysqli_connect("localhost","root","","unicreds"); 

if (mysqli_connect_errno()) {
	echo '<div class="alert alert-danger" role="alert">Failed to connect to MySQL: ' . mysqli_connect_error() . ' </div>';
}

?>