<?php
    session_start();
    require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<link rel="stylesheet" href="css/contact-us.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/logo.png">
        </div>
        <div class="menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Edit Profile</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        <?php
            if(isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            $sql = "SELECT * FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                $fname = $row['firstname'];
                $lname = $row['lastname'];
                $phone = $row['phone'];
                $email = $row['email'];
                $name = $fname . " " . $lname;
            }
            }
        ?>
        <div class="form">
            <h2>Contact Us</h2>
            <?php
                if(isset($_GET['mailsent']))
                {
                    echo "
                        <div class='success'>
                            Message sent successfully. It will be replied shortly.
                        </div>
                    ";
                }
                else if(isset($_GET['error']))
                {
                    echo "
                        <div class='error'>
                            Message not sent. Please try again.
                        </div>
                    ";
                }
            ?>
            <form action="includes/contact-us.inc.php" method="POST">
                <label>Name</label>
                <input type="text" name="name" class="text-input" value="<?php if(isset($name)){ echo $name; } ?>">
                <label>Email</label>
                <input type="text" name="email" class="text-input" value="<?php if(isset($email)){ echo $email; } ?>">
                <label>Phone</label>
                <input type="text" name="phone" class="text-input" value="<?php if(isset($phone)){ echo $phone; } ?>">
                <label>Subject</label>
                <input type="text" name="subject" class="text-input">
                <label>Message</label><br>
                <textarea name="message" placeholder="Type Your Message"></textarea><br><br>
                <button type="submit" name="submit" class="send-btn">Send</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="footer">
        Copyright &copy 2018 | All Rights Reserved
    </div>
</body>
</html>