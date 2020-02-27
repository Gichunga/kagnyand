<?php

    if (isset($_POST['signup-submit']))
    {
        require 'dbh.inc.php';

        $fname = strtolower(trim($_POST['fname']));
        $lname = strtolower(trim($_POST['lname']));
        $uname = trim($_POST['uname']);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $gender = strtolower(trim($_POST['gender']));
        $pwd1 = trim($_POST['pwd1']);
        $pwd2 = trim($_POST['pwd2']);
        // $pattern = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";


        //validation
        if (!email)
        {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        else if(empty($fname) || empty($lname) || empty($uname) || empty($email) || empty($gender) || empty($pwd1) || empty($pwd2))
        {
            header("location:../signup.php?error=emptyfields&firstname=".$fname."&lastname=".$lname."&username=".$uname."&email=".$email."&gender=".$gender);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname) && !preg_match("/^[a-zA-Z]*$/", $lname) && !preg_match("/^[a-zA-Z]*$/", $uname) && !preg_match("/^[a-zA-Z]*$/", $gender))
        {
            header("location:../signup.php?error=invaliddetails");
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname) && !preg_match("/^[a-zA_Z]*$/", $lname) && !preg_match("/^[a-zA_Z]*$/", $uname))
        {
            header("location: ../signup.php?error=invaliddetails&gender=".$gender);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname) && !preg_match("/^[a-zA_Z]*$/", $lname) && !preg_match("/^[a-zA_Z]*$/", $gender))
        {
            header("location: ../signup.php?error=invaliddetails&username=".$uname);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname) && !preg_match("/^[a-zA-Z]*$/", $uname) && !preg_match("/^[a-zA-Z]*$/", $gender))
        {
            header("location: ../signup.php?error=invaliddetails&lastname=".$lname);
            exit();
        }
        else if(!preg_match("/^[a-A-Z]*$/", $lname) && !preg_match("/^[a-zA-Z]*$/", $uname) && !preg_match("/^[a-zA-Z]*$/", $gender))
        {
            header("location: ../signup.php?error=invaliddetails&firstname=".$fname);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $fname))
        {
            header("location: ../signup.php?error=invalidfirstname&lastname=".$lname."&username=".$uname."&gender=".$gender."&email=".$email);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $lname))
        {
            header("location: ../signup.php?error=invalidlastname&lastname=".$lname."&username=".$uname."&gender=".$gender."&email=".$email);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $uname))
        {
            header("location: ../signup.php?error=invalidusername&firstname=".$fname."&lastname=".$lname."&email=".$email."&gender=".$gender);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z]*$/", $gender))
        {
            header("location: ../signup.php?error=invalidgender&firstname=".$fname."&username=".$uname."&lastname=".$lname."&email=".$email);
            exit();
        }
        else if(strlen($pwd1) < 8)
        {
            header("location: ../signup.php?error=passwordlength&firstname=".$fname."&lastname=".$lname."&username=".$uname."&gender=".$gender);
            exit();
        }
        else if(strlen($pwd2) < 8)
        {
            header("location: ../signup.php?error=passwordlength&firstname=".$fname."&lastname=".$lname."&username=".$uname."&gender=".$gender);
            exit();
        }
        // else if (!preg_match($pattern, $pwd1))
        // {
        //     header("location: ../index.php?error=invalidpassword&firstname=".$fname."&lastname=".$lname."&username=".$uname."&gender=".$gender);
        //     exit();
        // }
        else if($pwd1 !== $pwd2)
        {
           header("location: ../signup.php?error=passwordmatch&firstname=".$fname."&lastname=".$lname."&uname=".$uname."&email=".$email."&gender=".$gender);
           exit();
        }
        else if($pwd1 == $pwd2)
        {
            //create a placeholder for the email variable
            $sql = "SELECT email FROM users WHERE email=?";

            // initiate the database connection
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("location: ../signup.php?error=sqlerror&firstname=".$fname."&lastname=".$lname."&username=".$uname."&email=".$email."&gender=".$gender);
                exit();
            }
            //if connection has been established succesfully, bind the placeholder to the email and check whether a similar email exists in the database
            else
            {
                mysqli_stmt_bind_param($stmt, 's', $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0)
                {
                    header("location: ../signup.php?error=userexists&firstname=".$fname."&lastname=".$lname."&username=".$uname."&email=".$email."&gender=".$gender);
                    exit();
                }
                else
                {
                   $sql = "INSERT INTO users(fname, lname, uname, email, gender, password) VALUES(?, ?, ?, ?, ?, ?)";
                   $stmt = mysqli_stmt_init($conn);
                   if(!mysqli_stmt_prepare($stmt, $sql))
                   {
                        header("location: ../signup.php?error=sqlerror");
                        exit();
                   }
                   else
                   {
                       $hashPassword = password_hash($pwd1, PASSWORD_DEFAULT);
                       mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $uname, $email, $gender, $hashPassword);
                       mysqli_stmt_execute($stmt);
                       $_SESSION['email'] = $email;
                       header("location: ../index.php?signup=success");
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
        location("../signup.php");
        exit();
    }   

?>