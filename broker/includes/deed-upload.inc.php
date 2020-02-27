<?php

    if(isset($_POST['submit']))
    {
        $file = $_FILES['file'];

        $name = $file['name'];
        $tmpName = $file['tmp_name'];
        $size = $file['size'];
        $error = $file['error'];
        $type = $file['type'];

        $ext = explode('.', $name);
        $actualExt = strtolower(end($ext));

        $allowed = array('pdf');

        if(in_array($actualExt, $allowed))
        {
            if($error === 0)
            {
                if($size < 5000)
                {
                    $newName = uniqid('', true) . "." . $actualExt;
                    $destination = "../img/deeds/" . $newName;
                    move_uploaded_file($tmpName, $destination);

                    require "dbh.inc.php";
                    session_start();
                    $uid = $_SESSION['uid'];
                    $sql = "UPDATE land SET title_deed = '$destination' WHERE user_id = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    header("location: ../title-deed.php?upload=success");
                    exit();
                }
                else
                {
                    echo "File too large";
                }
            }
            else
            {
                echo "An error occured during upload";
            }
        }
        else
        {
            echo "You cannot upload files of this type";
        }
    }

?>