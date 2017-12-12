<?php

	session_start();
	require_once('db_connection.php');
	$jsonresponse = array();
	
	$jsonresponse['session_user'] = $session_user = $_SESSION['session_user'];
	
	$dept_query = "SELECT dept_id FROM User WHERE username = '$session_user'";
	$response = @mysqli_query($dbconnection, $dept_query);
	
	$dept_id = 0;
	if($response && mysqli_num_rows($response) > 0) {
		$dept_id = mysqli_fetch_array($response)['dept_id'];
	} else {
		$jsonresponse['success'] = false;
	}

	$course_query = "SELECT * FROM Course WHERE dept_id = $dept_id";
	if($dept_id != 0  && ($response = @mysqli_query($dbconnection, $course_query))) {
		$courses = array();
		while ($row = mysqli_fetch_array($response)) {
			$courses[] = $row;
		}
		$jsonresponse['courses'] = $courses;
		$jsonresponse['success'] = true;
	} else {
		$jsonresponse['success'] = false;
	}

	$dbconnection->close();
	echo json_encode($jsonresponse);
?>
