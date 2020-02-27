<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/upload.css">
        <title>Deed Upload</title>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="logo">
                    <img src="img/logo.png">
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="profile.php">Profile Manager</a></li>
                        <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="deed">
                    <div class="form">
                        <h2>Title Deed</h2>
                        Please upload the file here
                        <form action="includes/deed-upload.inc.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file" class="text-input">
                            <button type="submit" name="submit">Upload</button>
                        </form>
                    </div>
                </div>
            <div class="footer">
                Copyright &copy 2020| All Rights Reserved
            </div>
        </div>
    </body>
</html>