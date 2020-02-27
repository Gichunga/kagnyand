<?php
    require 'includes/config.inc.php';
    $page_title = "Logout";
    include "includes/header.html";

    //If no first_name session variable exists, rediret the user
    if(!isset($_SESSION['first_name']))
    {
        $url = BASE_URL . 'index.php';
        ob_end_clean();
        header("Location: $url");
        exit();

    }
    else
    {
        //Log out the user
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time()-3600); //Destroy the cookie.
    }

    //Print the customized message
    echo '<h3>You are now logged in</h3>';
    include 'includes/footer.html';
    