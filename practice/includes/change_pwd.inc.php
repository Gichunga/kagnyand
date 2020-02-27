<?php

    if(isset($_POST['change-pwd']))
    {
        session_start();
        require 'dbh.inc.php';

        $email = $_SESSION['email'];
        $oldpwd = $_POST['old-pwd'];
        $newpwd = $_POST['new-pwd'];
        $newpwd_confirm = $_POST['new-pwd-c'];

        if(empty($oldpwd) || empty($newpwd) || empty($newpwd_confirm))
        {
            header("location: ../index.php?error=emptyfields");
            exit();
        }
        else
        {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passsword_check = password_verify($newpwd, $row['password']);
            if($passsword_check == false)
            {
                header("location: ../index.php?error=wrongpassword");
                exit();
            }
            if($passsword_check == true)
            {
                if($newpwd != $newpwd_confirm)
                {
                    header("location: ../index.php?error=passwordmatch");
                    exit();
                }
                else
                {
                    $hashPassword = password_hash($newpwd, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password = '$hashPassword' WHERE email='$email'";
                    mysqli_query($sql);
                    header("location: ../index.php?passwordChange=success");
                    exit();
                }
                
            }
            else
            {
                header("location: ../index.php?error");
                exit();
            }
        }

    }
    else
    {
        header("location: ../index.php");
    }

?>