<?php 
	
	require 'header.php';
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href=".css/style.css">

</head>
<body>


<div class="section">
	<div class="head">
		<h2>Login</h2>
	</div>
	<?php
		if(isset($_GET['signup']))
        {
            echo "
				<div class='success'>
					Registered successfully. Please login.
                </div>
            ";
        }
	?>
		<div class="form">
			<form action="includes/login.inc.php" method="post">
				<div class="get_message">
					 <?php
                   
                    if(isset($_GET['error']))
                    {
                        if($_GET['error'] == "emptyfields")
                        {
                            echo "
                                <div class='error'>
                                    Please fill in all fields!
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "wrongpassword")
                        {
                            echo "
                                <div class='error'>
                                    Incorrect password!
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "nouser")
                        {
                            echo "
                                <div class='error'>
                                    No user found!
                                </div>
                            ";
                        }
                    }
                ?>
				</div>
				
				<div class="input-group">
					<label>Email/Phone:</label>
					<input type="text" name="mailphone" placeholder="enter email or Phone..." autofocus>
				</div>

				<div class="input-group">
					<label>Password:</label>
					<input type="password" name="password" placeholder="" autofocus>
				</div>

				<button type="submit" name="login-submit" class="btn">SUBMIT</button>

				<p>
					Don't yet have an account?<a href="signup.php">sign up</a>
				</p>
				
			</form>
		</div>
</div>












<?php 

	require 'footer.php';
 ?>
</body>
</html>