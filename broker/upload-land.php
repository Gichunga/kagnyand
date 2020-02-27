<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/land.css">
        <title>Land</title>
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
                <div class="left">
                    <div class="form">
                        <h2>Land Details</h2>
                        <form action="includes/upload-land.inc.php" method="POST">
                            <label>Name</label>
                            <input type="text" class="text-input" placeholder="Give it a name" name="name">
                            <label>Select County Where Located</label>
                            <select class="text-input" name="county">
                                <option>Nairobi</option>
                                <option>Kakamega</option>
                                <option>Mombasa</option>
                                <option>Kisumu</option>
                                <option>Nakuru</option>
                                <option>Eldoret</option>
                            </select>
                            <label>Size</label>
                            <input type="text" class="text-input" placeholder="Size (in acres)" name="size">
                            <button type="submit" name="submit" class="signup-btn">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="showcase">
                    </div>
                </div>
            </div>
            <div class="footer">
                Copyright &copy | All Rights Reserved
            </div>
        </div>
    </body>
</html>