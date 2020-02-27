<?php
    session_start();
    require "includes/dbh.inc.php";
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
                <li><a href="profile.php">Profile manager</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php
            $uid = $_SESSION['uid'];
            $sql = "SELECT * FROM land WHERE user_id = '$uid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                if($row > 0)
                {
                    $name = $row['name'];
                    $county = $row['county'];
                    $size = $row['size'];
                    $deed = $row['title_deed'];
                    $id = $row['id'];
                    $_SESSION['lid'] = $id;

                    if($deed == "")
                    {
                        $deed = "Not Available <div class='deed'>
                        <h4>Attach Title Deed</h4>
                        <label>This increases people's trust in you</label>
                        <form action='title-deed.php' method='POST'>
                            <button type='submit' class='signup-btn' name='submit'>Attach</button>
                        </form>
                    </div>";
                    }
                    else
                    {
                        $deed = "Available <a href='view-deed.php' class='logout-btn'>View</a>";
                    }

                    echo "
                        <div class='land'>
                            Name: $name <br>
                            Size: $size acres<br>
                            Location: $county <br>
                            Title Deed: $deed <br>
                            <form action='includes/remove-land.inc.php' method='POST'>
                                <button type='submit' name='submit' class='remove-btn'>Remove Land</button>
                            </form>
                        </div>
                    ";
                }
                else
                {
                    echo "
                        <div class='no-data'>
                            <p>You haven't posted anything yet.</p>
                            <a href='home.php' class='logout-btn'>Back</a>
                        </div>
                    ";
                }
            }
        ?>
    </div>
    <div class="footer">
        Copyright &copy 2020 | All Rights Reserved
    </div>
</body>
</html>