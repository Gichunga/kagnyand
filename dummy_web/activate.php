<?php

    //This page activates the user account
    require 'includes/config.inc.php';
    $page_title = "Account Activation";
    include 'includs/header.html';

    //If $x and $y are not set redirect the user
    $email = $_GET['x'];
    $activCode = $_GET['y'];
    if(isset($email, $activCode) && filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($activCode) == 32))
    {
        //Update the database
        require 'includes/mysqli_connect.inc.php';
        $sql = "UPDATE users SET active = NULL WHERE (email='" . mysqli_real_escape_string($conn, $email) ."' AND active='". mysqli_real_escape_string($conn, $activCode). "') LIMIT 1";
        $result = mysqli_query($conn, $sql) or trigger_error("Query: $sql\n<br>MySQL Error:" .mysqli_error($conn));

        //Print a customized message
        if(mysqli_affected_rows($conn) == 1)
        {
            echo "<h3>Your account is now active.You can now log in.</h3>";
        }
        else
        {
            echo "<p class='error'>Your account could not be activated.Please re-check the link or contact the administrator.</p>";
        }
        mysqli_close($conn);
    }
    else
    {
        //Rediret the user
        $url = BASE_URL . 'index.php'; //Define the url
        ob_end_clean(); //Delete the buffer
        header("location: $url");
        exit();
    }

    include("includes/footer.html");

