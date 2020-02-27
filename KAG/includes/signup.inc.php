<?php

    if (isset($_POST['submit']))
    {
        require 'dbh.inc.php';

        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd1 = $_POST['password_2'];

        if(empty($username) || empty($pwd) || empty($pwd1))
        {
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$username))
        {
            header("Location: ../signup.php?error=invaliddetails");
            exit();
        }
       
        else if($pwd !== $pwd1)
        {
            header("Location: ../signup.php?error=passwordmatch&userName=".$username);
            exit();
        }
        else
        {
            $sql = "SELECT * FROM admin WHERE username=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql))
            {
                header("Location: ../signup.php?error=sqlerror$userName=".$username);
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt,'s',$userName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0)
                {
                    header("Location: ../signup.php?error=userexists");
                    exit();
                }
                else 
                {
                    $sql = "INSERT INTO admin(username, password)  VALUES(?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        header("Location: ../signup.php?error=sqlerror&username=".$username);
                        exit();
                    }
                    else
                    {
                        $hashPassword = password_hash($pwd,PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt,'ss',$username,$hashPassword);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../admin-login.php?signup=success");
                        exit();
                    }

                }
            }
        }
            mysqli_stmt_close($stmt);
    mysqli_close();
    }


    else
    {
        header("Location: ../signup.php");
        exit();
    }

    ?>