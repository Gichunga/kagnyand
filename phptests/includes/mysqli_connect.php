<?php
	
	// This file contains the database acess information
	//This file also establishes a connection to MySQL,
	//selects the database, and sets the encording.

	//Set the databasae access information as constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'Gichungasteve6');
	define('DB_NAME', 'sitename');

	//Make the connection
	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

	//Set the encording
	mysqli_set_charset($conn, 'utf8');

