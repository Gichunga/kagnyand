<?php
    require "dbh.inc.php";
    session_start();

    if(isset($_POST['submit']))
    {
        $id = $_SESSION['lid'];

        $sql = "DELETE FROM land WHERE id = '$id'";
        if(mysqli_query($conn, $sql))
        {
            header("location: ../view-posts.php?delete=success");
            exit();
        }
        else
        {
            header("location: ../view-posts.php?error");
            exit();
        }
    }
    
?>