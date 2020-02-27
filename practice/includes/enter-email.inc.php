<?php
    if(isset($_POST['pwd-reset']))
    {
        require 'dbh.inc.php';
        $email = $_POST['email'];

        if(empty($email))
        {
            header("location: ../enter_email.php?error=emptyfields");
            exit();
        }
        else
        {
            $sql = "SELECT email FROM users WHERE email=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("location: ../enter_email.php?sqlerror=2");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck <= 0)
                {
                    header("location: ../enter_email.php?error=nouser");
                    exit();
                }
                else
                {
                    $token = bin2hex(random_bytes(50));
                    $sql = "INSERT INTO password_resets(email, token) VALUES(?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("location: ../enter_email.php?sqlerror=2");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, 'ss', $email, $token);
                        mysqli_stmt_execute($stmt);
                        $_SESSION['email'] = $email;
                        
                        //email users the token generated in a link they can click on
                        $to = $email;
                        $subject = "Reset your password on kagnyandaruayouth.co.ke";
                        $msg = "Hi there, click on this <a href=\"passwordreset.php?token=" . $token . "\">link</a> to reset your password on our site";
                        $msg = wordwrap($msg, 70);
                        $headers = "From: kagnyandaruayouth.com";
                        $mailsent = mail($to, $subject, $msg, $headers);
                        if($mailsent)
                        {
                            header("location: ../pending.php?mailsent=1");
                            exit();
                        }
                        else
                        {
                            header("location: ../enter_email.php?mailsent=0");
                            exit();
                        }
                    }
                }
            }
        }
    }
    else
    {
        header("location: ../enter_email.php");
        exit();
    }



?>