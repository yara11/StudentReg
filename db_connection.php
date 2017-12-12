<?php

$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'Assignment1';

$dbconnection = @mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname)
OR die('Unable to connect to MySql: '.mysqli_connect_error());

?>
