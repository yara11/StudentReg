<?php
	
	session_start();
	require_once('db_connection.php');
	
	$jsonresponse = array();

	// Sign Up : New user
	if($_POST['formid'] == "regform") {

		$email = trim($_POST['rEmail']);
		$username = trim($_POST['rUsername']);
		$password = $_POST['rPassword'];
		$passwordconf = $_POST['rPasswordConf'];

		
		$query = "SELECT COUNT(*) from User WHERE username = '$username'";
		$email_query = "SELECT COUNT(*) from User WHERE email = '$email'";

		$response = @mysqli_query($dbconnection, $query);
		$email_response = @mysqli_query($dbconnection, $email_query);

		if(empty($email) || empty($username) || empty($password) || empty($passwordconf)) {
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Please fill out all of the fields";

		} elseif(!$response) {
			
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Select query failed: " .mysqli_error($dbconnection);

		} elseif(mysqli_fetch_array($email_response)['COUNT(*)'] != 0) {
			
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Email is associated with another account";

		} elseif(mysqli_fetch_array($response)['COUNT(*)'] != 0) {
			
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Username is unavailable";

		} elseif($password != $passwordconf) {

			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Passwords don't match";
		
		} else {
			$curdate = date('Y-m-d H:i:s');

			$insert_query = "INSERT INTO User(email, username, password, registration_date)
			VALUES('$email', '$username', '$password', '$curdate')";

			$insert_response = @mysqli_query($dbconnection, $insert_query);

			if($insert_response) {
				$jsonresponse['success'] = true;
				$jsonresponse['hasDepartment'] = false;
				$_SESSION['session_user'] = $username;
			} else {
				$jsonresponse['success'] = false;
				$jsonresponse['message'] = "Insert query failed: " .mysqli_error($dbconnection);
			}
		}

		// Sign In - Existing user
	} elseif($_POST['formid'] == "loginform") {
		
		$username = trim($_POST['username']);
		$password = $_POST['password'];

		$query = "SELECT * FROM User WHERE username = '$username'";

		$response = @mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_array($response);
		if(empty($username) || empty($password)) {
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Please fill out all of the fields";

		} elseif(!$response) {
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Select query failed: " .mysqli_error($dbconnection);

		} elseif(mysqli_num_rows($response) == 0) {
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Unknown username";

		} elseif ($row['password'] != $_POST['password']) {
			$jsonresponse['success'] = false;
			$jsonresponse['message'] = "Incorrect password";

		} else {
			
			$jsonresponse['success'] = true;
			$jsonresponse['hasDepartment'] = ($row['dept_id'] != NULL);
			$_SESSION['session_user'] = $username;
			
		}
	} else {
		$jsonresponse['success'] = false;
		$jsonresponse['message'] = "ehellibye7sal??";
	}

	$dbconnection->close();
	echo json_encode($jsonresponse);
?>
