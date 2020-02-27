<?php

    session_start();
    if(isset($_POST['resetPassword']))
    {
        require 'dbh.inc.php';

        $new_pass = $_POST['pwd'];
        $new_pass_c = $_POST['pwdConfirm'];

        //Grab the token that came from the link
        $token = $_SESSION['token'];
        if(empty($new_pass) || empty($new_pass_c))
        {
            header("location: ../passwordreset.php?error=emptyfields");
            exit();
        }
        else if($new_pass_c !== $new_pass)
        {
            header("location: ../password_reset?error=emptyfields");
            exit();
        }
        else
        {
            $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $email = mysqli_fetch_assoc($result)['email'];
            if($email)
            {
                $hashPassword = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = '$new_pass' WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                header("location: ../index.php?reset=sucess");
            }
        }
    }
    else
    {
        header("location: ../passwordreset.php");
    }
?>