<?php 

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'gncdb';

	$connection = mysqli_connect('localhost', 'root', '', 'gncdb');

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} else {
		echo "";
	}
?>