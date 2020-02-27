<?php

	if (isset($_POST['login-submit'])) {

		require 'dbh.inc.php';

		$username = $_POST['username'];
		$pwd = $_POST['password'];

		if(empty($username) || empty($pwd))
		{
			header("location:../admin-login.php?emptyfields=1");
			exit();
		}
		else 
			if (!preg_match('/^[A-Z][A-Za-z]*$/', $username)) {
				header("location: ../admin-login.php?invaliduser=1");
				exit();
			}
		else
		{
			$sql = "SELECT * FROM admin WHERE username = ?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql))
			{
				header("location:../admin-login.php?error=sqlerror");
				exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result))
				{
					$passwordCheck = password_verify($pwd, $row['password']);
					if($passwordCheck == false)
					{
						header("location: ../admin-login.php?wrongpassword");
						exit();
					}
					else if($passwordCheck == true)
					{
						session_start();

						$_SESSION['id'] = $row['id'];
						$_SESSION['username'] = $row['username'];

						header("location: ../events.php");
							exit();
					}
					else
					{
						header("location:../admin-login.php?error");
						exit();
					}

				}
				else
				{
					header("location:../admin-login.php?nouser");
					exit();
				}
			}
		}
	}
	else
	{
		header("location:../admin-login.php");
		exit();
	}


?>