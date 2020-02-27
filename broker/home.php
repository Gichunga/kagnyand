<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css/home.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/logo.png">
        </div>
        <div class="menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Settings</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="hello">
            Hello there, <strong><?php
                            if(isset($_SESSION['firstname'])){
                                echo $_SESSION['firstname'];
                            }
                            ?></strong>
        </div>
        <div class="options">
            <div class="upload">
                <h2>Upload Land</h2>
                <p>You can upload details of the land you wish to sell here for anyone interested to view.</p>
                <a href="upload-land.php">Add land</a>
            </div>
            <div class="view-posts">
                <h2>View Your Posts</h2>
                <p>View and change details of the land you have already posted here.</p>
                <a href="view-posts.php">View Posts</a>
            </div>
        </div>
        <div class="hello">
            <h2>Settings</h2>
            <p>Edit profile or change your contact details.</p>
            <a href="profile.php">Go to Settings</a>
        </div>
    </div>
    <div class="footer">
        Copyright &copy 2020 | All Rights Reserved
    </div>
</body>
</html>