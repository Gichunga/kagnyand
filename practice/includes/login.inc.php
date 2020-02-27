<?php

    if (isset($_POST['login-submit']))
        {
            require 'dbh.inc.php';

            $mail = trim($_POST['umail']);
            $pwd = trim($_POST['pwd']);

            if(empty($mail) || empty($pwd))
            {
                header("location: ../index.php?error=emptyfields&user=".$mail);
                exit();
            }
            else
            {
                $sql = "SELECT * FROM users WHERE uname=? OR email=?";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("location: ../index.php?error=sqlerror");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt, "ss", $mail, $mail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if($row = mysqli_fetch_assoc($result))
                    {
                        $passwordCheck = password_verify($pwd, $row['password']);
                        if($passwordCheck == false)
                        {
                            header("location: ../index.php?error=wrongpassword");
                            exit();
                        }
                        else if($passwordCheck == true)
                        {
                            session_start();

                            $_SESSION['fname'] = $row['fname'];
                            $_SESSION['lname'] = $row['lname'];
                            $_SESSION['uname'] = $row['uname'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['gender'] = $row['gender'];
                            $_SESSION['password'] = $row['password'];

                            header("location: ../home.php");
                            exit();
                        }
                        else
                        {
                            header("location: ../index.php?unexpectedproblem");
                            exit();
                        }
                    }
                    else
                    {
                        header("location: ../index.php?error=nouser");
                        exit();
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close();
        }
        else
        {
            header("location: ../login.php");
            exit();
        }

?>