<?php
    session_start();
    require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/logo.png">
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php
            $uid = $_SESSION['candyd'];
            $sql = "SELECT * FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                $fname = $row['firstname'];
                $lname = $row['lastname'];
                $phone = $row['phone'];
                $email = $row['email'];
                $name = $fname . " " . $lname;

                echo "
                    <h2>CONTACT DETAILS</h2>
                    <div class='contact-details'>
                        <div class='dp'>
                            <img src='a.jpg' alt='profile-pic'>
                        </div>
                        Name: $name <br>
                        Phone: $phone <br>
                        Email: $email <br>
                    </div>
                ";
            }
        ?>
    </div>
    <div class="footer">
        Copyright &copy 2020 | All Rights Reserved
    </div>
</body>
</html>