<?php

    session_start();
    if(isset($_POST['submit']))
    {
        require "dbh.inc.php";

        $name = $_POST['name'];
        $county = $_POST['county'];
        $size = $_POST['size'];
        $uid = $_SESSION['uid'];

        if(empty($name) || empty($county) || empty($size))
        {
            header("location: ../upload-land.php?error=emptyfields");
            exit();
        }
        else
        {
            $sql = "INSERT INTO land(user_id, name, county, size) VALUES('$uid', '$name', '$county', '$size')";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                header("location: ../upload-land.php?post=success");
                exit();
            }
            else
            {
                header("location: ../upload-land.php?error");
                exit();
            }
        }
    }
    else
    {
        header("location: ../index.php");
        exit();
    }

?>