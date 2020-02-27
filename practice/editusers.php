<?php

$title = "Delete User";
include 'header.php';
echo "<h1>Delete a User</h1>";

//Check for a valid user through GET or POST
if((isset($_GET['id'])) && is_numeric($_GET['id'])
{
	$id = $_GET['id'];

}
elseif((isset($POST['id'])) && is_numeric($POST['id'])
{
	$id = $POST['id'];

}
else
{
	echo "<p class='error'>This page has been accessed in error</p>";
	include 'footer.php';
	exit();
}

require 'inludes/dbh.inc.php';
//Check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST['sure'] == 'Yes')
	{
		//Delete the record
		$query = "DELETE FROM users WHERE user_id=$id LIMIT 1";
		$result = @mysqli_query($conn, $query);
		if(mysqli_affected_rows($conn) == 1)
		{
			echo "<p>The user has been deleted</p>";
		}
		else
		{
			// if the query did not run
			echo "<p class='error'>The user could not be deleted due to a system error</p>";
		}
	}
	else
	{
		echo "The user has not been deleted";
	}
}
else
{
	//Show the form 
	//Retrieve the users information
	$query = "SELECT CONCAT(last_name, ' ', first_name) FROM uses WHERE user_id=$id";
	$result = @mysqli_query($conn, $query);
	if(mysqli_num_rows($result) == 1)
	{
		//Valid user, show the form
		$row = mysqli_fetch_row($result);

		//Display the record being deleted
		 echo "<h3>Name: $row[0] </h3>
            Are you sure youwant to delete this user?";
            
		echo '<form action="" method="post">
			<input type="radio" name="sure" value="Yes">Yes
			<input type="radio" name="sure" value="No">no
			<input type="submit" name="submit" value="Submit">
			<input type="hidden" name="id" value="'. $id .'">
		</form>';
	}
	else
	{
		echo "<p class='error'>This page has been acessed in error.</p>";
	}
	mysqli_close($conn);
	include 'footer.php';
}


?>