<?php

	if(isset($_POST['login-submit']))
	{
		require 'dbh.inc.php';

		$mailphone = $_POST['mailphone'];
		$pwd =  $_POST['password'];

		if(empty($mailphone) || empty($pwd))
		{
			header("Location: ../index.php?error=emptyfields");
			exit();
		}
		else 
		{
			$sql = "SELECT * FROM users WHERE email=? OR phone=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql))
			{
				header("Location: ../index.php?error=sqerror");
				exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt,'ss',$mailphone, $mailphone);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result))
				{
					$passwordCheck = password_verify($pwd,$row['password']);
					if($passwordCheck == false)
					{
						header("Location: ../index.php?error=wrongpassword");
						exit();
					}
					else if($passwordCheck == true)
					{
						session_start();
						$_SESSION['uid'] = $row['idUsers'];
						$_SESSION['userName'] = $row['userName'];
						$_SESSION['firstName'] = $row['firstName'];
						$_SESSION['lastName'] = $row['lastName'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['phone'] = $row['phone'];
						$_SESSION['county'] = $row['county'];
						$_SESSION['constituency'] = $row['constituency'];

						header("Location: ../home.php?login=success");
						exit();
					}
					else
					{
						header("Location: ../index.php?error");
						exit();
					}
				}
			}
		}
	}