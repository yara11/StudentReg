<?php
	session_start();
	require_once('db_connection.php');

	$dept_no = $_POST['deptno'];
	$user = $_SESSION['session_user'];
	$jsonresponse = array();

	$jsonresponse['session_user'] = $user;

	$query = "UPDATE User SET dept_id=$dept_no WHERE username='$user'";
	$response = @mysqli_query($dbconnection, $query);

	if($response) {
		$jsonresponse['success'] = true;
	} else {
		$jsonresponse['success'] = false;
		$jsonresponse['message'] = "Query failed: " . mysqli_error($dbconnection);
	}

	$dbconnection->close();
	echo json_encode($jsonresponse);
?>
