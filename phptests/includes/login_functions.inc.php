<?php

    function redirect_user($page = 'index.php')
    {
        //start defining the url ...
        $url = 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']);

        $url = rtrim($url, '/\\');

        $url .= '/' .$page;

        //redirect the user
        header("location: $url");
        exit();
    }

    //function to validate the form data
    function validate($conn, $email='', $password='')
    {
        $errors = [];
        if(empty($email))
        {
            $errors[] = "You forgot to enter your email address";
        }
        else
        {
            $email = mysqli_real_escape_string($conn, trim($email));
        }

        if(empty($pass))
        {
            $errors[] = "You forgot to enter your password";
        }
        else
        {
            $password = mysqli_real_escape_string($conn, trim($password));
        }

        if(empty($errors))
        {
            $sql = "SELECT user_id, first_name FROM users WHERE email=? AND passwword=?";
            $stmt = mysqli_stmt_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
            mysqli_stmt_execute($stmt);
            if(mysqli_num_rows($conn) ==1)
            {
                //fetch the record
                $row = mysqli_fetch_assoc($stmt);

                //return true and the record
                return [true, $row];
            }
        }
    }




