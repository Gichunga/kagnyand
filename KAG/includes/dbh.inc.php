<?php
	
	
	$server_name = "localhost";
	$dbusername = "root";
	$password = "";
	$dbname = "kagdb";

	$conn = mysqli_connect($server_name, $dbusername, $password, $dbname); 
	if(!$conn)
	{
		die("Server Connection Failed".mysqli_connect_error());
	}

?>