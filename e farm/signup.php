<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href=".css/style.css">

</head>
<body>
<?php

	require 'header.php';

?>
<div class="section">
	<div class="wrapper">
			    <div class="head">
					<h2>Register</h2>
				</div>
		<div class="form">
				<div class="get_message">
					<?php

						if(isset($_GET['error']))
						{
							if($_GET['error'] == "emptyfields")
							{
								echo 
								"
									<div class = 'error'>
										Please fill in all fields!
									</div>
								";
							}
							else if($_GET['error'] == "passwordlength")
							{
								echo 
								"	
									<div class = 'error'>
										The password should be atleast 6 characters!
									</div>
								";
							}
							else if($_GET['error'] == "invaliddetails")
							{
								echo 
								"	
									<div class = 'error'>
										Please provide valid details!
									</div>
								";
							}
							else if($_GET['error'] == "passwordmatch")
							{
								echo 
								"	
									<div class = 'error'>
										The password do not match!
									</div>
								";
							}
							else if($_GET['error'] == "userexists")
							{
								echo 
								"	
									<div class = 'error'>
										Username taken, try another one!
									</div>
								";
							}
						}


					?>
				</div>

				<form action="includes/signup.inc.php" method="post" >
					
				
					<div class="input-group">
						<label>Username:</label>
						<input type="text" name="userName" placeholder="enter username..." autofocus>
					</div>
					
					<div class="input-group">
						<label>First Name:</label>
						<input type="text" name="firstName" placeholder="enter firstname..." autofocus>
					</div>

					<div class="input-group">
						<label>Last Name:</label>
						<input type="text" name="lastName" placeholder="enter lastname..." autofocus>
					</div>
						

					<div class="input-group">
						<label>Email:</label>
						<input type="email" name="email" placeholder="enter email..." autofocus>
					</div>

					<div class="input-group">
						<label>Phone:</label>
						<input type="text" name="phone" placeholder="enter phone number..." autofocus>
					</div>

					<div class="input-group">
						<label>County:</label>
						<input type="text" name="county" placeholder="enter county..." autofocus>
					</div>

					<div class="input-group">
						<label>Constituency:</label>
						<input type="text" name="constituency" placeholder="enter constituency..." autofocus>
					</div>

					<div class="input-group">
						<label>Password:</label>
						<input type="password" name="password" placeholder="" autofocus>
					</div>

					<div class="input-group">
						<label>Confirm Password:</label> 
						<input type="password" name="password1" placeholder="" autofocus>
					</div>

					<button type="submit" name="signup-submit" class="btn">SUBMIT</button>

					<p>
						Already have an account?<a href="index.php">login</a>
					</p>
					
				</form>
			</div>
		</div>
	</div>

<?php
	require 'footer.php';
?>
</div>
</body>
</html>