<?php

	$server = "localhost";
	$user = "root";
	$password = "";
	$dbname = "farmdb";

	$conn = mysqli_connect($server, $user, $password, $dbname);
	if(!$conn)
	{
		die("Connection Error").mysqli_error();
	}