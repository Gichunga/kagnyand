<!DOCTYPE html>
<html>
<head>
	<title></title>

 <link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">

</head>
<body>
	<?php

	require 'header.php';

	?>
	<?php
	if(isset($_GET['error']))
	{
		if(isset($_GET['error == wrongpassword']))
		{
			echo
		"
			<div class='error'>
				Wrong password !!!
			</div>
		";
		}
		
	}
	?>
	<h2>Please Signup</h2>
<form action="includes/signup.inc.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="enter password">
	<input type="password" name="password_2" placeholder="confirm password">

	<button type="submit" name="submit">Sign Up</button>
</form>

<?php
	require 'footer.php';

?>
</body>
</html>