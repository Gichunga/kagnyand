<?php
//Set the database access information as constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Gichungasteve6');
define('DB_NAME', 'dummy_web');

//Make the connections
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//If no connection could be made, trigger an error
if(!$conn)
{
    trigger_error('Could not connect to MySQL:' .mysqli_connect_error());
}
else
{
    //set the encording
    mysqli_set_charset($conn,'utf8');
}