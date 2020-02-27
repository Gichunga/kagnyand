<?php

$title = 'Register';
include 'includes/header.html';

//Check for submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require 'includes/mysqli_connect.php'; //Connect to the db
	$errors = [];

	//Check for first name:
	if(empty($_POST['first_name']))
	{
		$errors[] = 'You forgot to enter your first name.';
	}
	else{
		$fname = mysqli_real_escape_string($conn, trim($_POST['first_name']));
	}

	//Check for last name
	if(empty($_POST['last_name']))
	{
		$errors[] = 'You forgot to enter your last name';
	}
	else{
		$lname = mysqli_real_escape_string($conn, trim($_POST['last_name']));
	}

	//Check for an email address:
	if(empty($_POST['email']))
	{
		$errors[] = 'You forgot to enter your email address';
	}
	else{
		$email = mysqli_real_escape_string($conn, trim($_POST['email']));
	}

	//Check for a password and match against the confirmed password"
	if(!empty($_POST['pass1']))
	{
		if($_POST['pass1'] != $_POST['pass2'])
		{
			$errors[] = 'Your password did not match the confirmed password';
		}
		else{
			$p = mysqli_real_escape_string($conn, trim($_POST['pass1']));
		}
	}else
	{
		$errors[] = 'You forgot to enter your password';
	}

	if(empty($errors))
	{
		//If everything is okay
		//Register the user to the database... 

		require('includes/mysqli_connect.php'); // Connect to the database

		//Check whether a user with the email exists
		$query = "SELECT user_id FROM users WHERE email='$email'";
		$result = @mysqli_query($conn, $query);
		$num = mysqli_num_rows($result);
		if($num > 0)
		{
			echo "User with that email exists";
		}
		else{
			//Make the query
			$query = "INSERT INTO users(first_name, last_name, email, pass, registration_date) VALUES ('$fname', '$lname', '$email', SHA2('$p', 512), NOW() )";
			@mysqli_query($conn, $query);
			if(mysqli_affected_rows($conn) > 0)
			{
				// If the query was executed successfully
				//Print a message:
				echo '<h1>Thank you!</h1>
				<p>You are now registerd. In chapter 12 you will actually be able to log in!</p><p><br></p>';
			}
			else{ // If it did not run ok
				//Public message:
				echo '<h1>System Error</h1>
				<p class="error">You could not be registered due to a system error. We apologise any inconveniences</p>';
	
				//Debugging the message:
				echo '<p>' .mysqli_error($conn) . '<br><br>Query: ' .$query . '</p>';
			} // End of if ($result) IF.
		}
		
		mysqli_close($conn); //Close the database connection.

		//Include the footer and quit the script:
		include ('includes/footer.html');
		exit();
	}
	else{ // Report the errors
		echo'<h1>Error!</h1>
		<p class="error">The following error(s) occured:<br>';
		foreach ($errors as $msg){ //Print each error
			echo "* $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';
	} //End of if (empty($errors)) IF.
	mysqli_close($conn);
}// End of the main Submit conditional.
?>
<h1>Register</h1>
<form action="" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>"></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
	<p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"></p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" ></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" ></p>
	<input type="submit" value="REGISTER">
</form>

<?php include 'includes/footer.html'; ?>