<!DOCTYPE html>
<html>
<head>
	<title>Admin-login Kag Ignite Kakamega Youth</title>
	<link rel="stylesheet" type="text/css" href="css/admin-login.css">
    <link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">

</head>
<body >
<?php
	
	require 'header.php';

?>
<div class="container-fluid" style="background-color: #181818; color: #ccc; width: 100%; height: 300px; ">
	<h3 align="left" style="color: coral;">Login to add events</h3>

<div  class="container-form" style="padding: 20px;  width: 250px; margin-left: 10%; border: 2px solid green; ">

<?php
		if (isset($_GET['invaliduser'])) {
				echo'
				<div class="error" style="border: 1px solid red; color: red; margin-bottom: 5px;">
					Sorry but that is not your username!
				</div>
				';
			}
		else
		if (isset($_GET['emptyfields'])) {
			echo'
			<div class="error" style="border: 1px solid red; color: red; margin-bottom: 5px;">
				You need to fill all fields!
			</div>
			';
		}
		elseif(isset($_GET['wrongpassword']))
		{
			echo'
				<div class="error" style="border: 1px solid red; color: red; margin-bottom: 5px;">
					Wrong password!
				</div>
			';
		}
		


	?>
	
	<form  action="includes/admin-login.inc.php" method="post" align="center">
		
		<div class="form-input" style="margin-bottom: 20px; font-weight: bold;">
			<label for="username">Username</label>
			<input type="text" name="username" >
		</div>

		<div class="form-input" style="margin-bottom: 20px; font-weight: bold;">
			<label for="password">Password</label>
			<input type="password" name="password">
		</div>
		<div class="submit-btn" >
			<input type="submit" name="login-submit" style="padding: 5px; font-size: 20px; font-weight: bold; background-color: green; margin-top: 10px;margin-left: 50px; width: 70%; border-radius:25px; ">
		</div>
	</form>
</div>
</div>



<?php

	require 'footer.php';
?>
</body>
</html>