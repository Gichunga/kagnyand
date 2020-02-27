<?php

    $dbname = 'practice';
    $host = 'localhost';
    $user = 'root';
    $password = 'Gichungasteve6';

    $conn = mysqli_connect($host, $user, $password, $dbname) or die("Connection problem, check the server");

    if(!$conn)
    {
        die("Connection problem, check the server");
    }
   


?>