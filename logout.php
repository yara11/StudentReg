<?php
	session_start();
	unset($_SESSION['session_user']);

	if(session_destroy())
	{
		header("Location: registration.php");
	}
?>
