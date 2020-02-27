<?php
    require "includes/dbh.inc.php";
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/logo.png"><br>
            <p>Get land in minutes</p>
        </div>
        <div class="menu">
            <h3>QUICK LINKS</h3>
            <ul>
            <li><a href="broker.php">Home</a></li>
            <li><a href="login.php">Sell Land</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
            </ul>
            <h3>GET SEARCHING</h3>
            <ul>
            <li><a href="#jump">Search</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div id="jump" class="filter">
            <form action="broker.php" method="POST">
                <label>Size (acres)</label>
                <select name="size" class="text-input">
                    <option>Any</option>
                    <option>0-5</option>
                    <option>6-10</option>
                    <option>11-20</option>
                    <option>21-30</option>
                    <option>31-40</option>
                    <option>41-50</option>
                    <option>50+</option>
                </select>
          
                <label>Location</label>
                <select name="county" class="text-input">
                    <option>Nairobi</option>
                    <option>Kisumu</option>
                    <option>Nakuru</option>
                    <option>Kakamega</option>
                    <option>Momabasa</option>
                    <option>Eldoret</option>
                </select>
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <div class="results">
            <?php
                if(isset($_POST['search']))
                {
                    $size = $_POST['size'];
                    $county = $_POST['county'];
                    $sql = "SELECT * FROM land WHERE county = '$county'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        if($row > 0)
                        {
                            $name = $row['name'];
                            $county = $row['county'];
                            $size = $row['size'];
                            $deed = $row['title_deed'];
                            $uid = $row['user_id'];
                            $_SESSION['candyd'] = $uid;

                            if($deed == "")
                            {
                                $deed = "Not Available";
                            }
                            else
                            {
                                $deed = "Available <a href='view-deed.php' class='logout-btn'>View</a>";
                            }

                            echo "
                                <h3>Search Results</h3>
                                <div class='one'>
                                    <div class='land'>
                                        Name: $name <br>
                                        Size: $size acres<br>
                                        Location: $county <br>
                                        Title Deed: $deed <br>
                                    </div>
                                    <div class='contact'>
                                        <form action='contact.php' method='POST'>
                                            <button type='submit' name='submit'>View Contact</button>
                                        </form>
                                    </div>
                                </div>
                            ";
                        }
                        else
                        {
                            echo "
                                <div class='no-data'>
                                    <p>Sorry, we found nothing matching the specifications you provided.</p>
                                </div>
                            ";
                        }
                    }
                }
            ?>
        </div>
    </div>
    <div class="footer">
        Copyright &copy 2020 | All Rights Reserved
    </div>
</body>
</html>