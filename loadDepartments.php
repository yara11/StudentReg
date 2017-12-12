<?php
	session_start();
	require_once('db_connection.php');
	$jsonresponse = array();

	$jsonresponse['session_user'] = $_SESSION['session_user'];

	$query = "SELECT dept_id, name, description FROM Department";
	$response = @mysqli_query($dbconnection, $query);

	if($response) {
		$depts = array();
		while ($row = mysqli_fetch_array($response)) {
			$depts[] = $row;
		}
		$jsonresponse['depts'] = $depts;
		$jsonresponse['success'] = true;
	} else {
		$jsonresponse['success'] = false;
		$jsonresponse['message'] = "Query failed: " . mysqli_error($dbconnection);
	}

	$dbconnection->close();
	echo json_encode($jsonresponse);
?>
