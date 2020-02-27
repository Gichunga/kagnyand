<?php

    $server_name = "localhost";
    $dbusername = "root";
    $password = "Gichungasteve6";
    $dbname = "brokerdb";

    $conn = mysqli_connect($server_name, $dbusername, $password, $dbname);
    if(!$conn)
    {
        die("Server Connection Failed: ".mysqli_connect_error());
    }

?>