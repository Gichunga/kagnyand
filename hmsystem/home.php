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
                <li><a href="contact-us.php">Contact Us</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="products">
            <h2>Available Products</h2>
            <?php
                $sql = "SELECT * FROM products WHERE available=1";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $_SESSION['id'] = $id;
                    echo "
                        <div class='product'>
                            Name: $name<br>
                            Description: $description<br>
                            <form action='order.php' method='POST'>
                                <input type='hidden' name='pid' value='$id'>
                                <button type='submit' name='order'>Order</button>
                            </form>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
    <hr>
    <div class="footer">
        Copyright &copy 2019 | All Rights Reserved
    </div>
</body>
</html>