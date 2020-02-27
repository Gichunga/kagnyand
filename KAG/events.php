<?php
    session_start();
    require 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
     
<title>Events-Kag Ignite Kakamega Youth</title>
<link rel="stylesheet" href="css/events.css">
<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">

</head>
<body>
    <?php

        require 'header.php';

    ?>
    </div>
<div class="content" style="background-color: white;">
     <div class="content">

        <div class="hello" style="margin-left: 20px; margin-top: 10px;">

           <?php 

            $sql = "SELECT * FROM admin WHERE id = 1";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];

                echo "Hello, <strong>".$username; echo "</strong>";
            }


         ?>

         
             <form action="includes/logout.inc.php" id="logout">
             <button id="logout-button" name="logout">LOGOUT</button>
            </form>
      
        </div><br>
        <hr class="hr">
        <div class="products" style="margin-top: 80px;">
            <div class="admin-add">
                <h2 style="color: orange; ">Add Events</h2>
          
                The events you add here will be viewed directly by your site visitors.<br>
            </div>
            <?php
                    if(isset($_GET['add']))
                    {
                        echo "
                            <div class='success'>
                                Product added successfully.
                            </div>

                        ";
                    }
                ?>
            <div align="center" id="content" style="background-color: teal; width: 70%; border-radius: 10px;">
            <form action="events.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input type="file" name="image">
                </div>
                <div>
                    <label style="color: orange">Event Name</label>
                    <input type="text" name="event_name">
                </div>
                <div>
                    <label style="color: orange">location</label>
                    <input type="text" name="location">
                </div>
                <div>
                    <label style="color: orange">date</label>
                    <input type="date" name="date">
                </div>
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
                
            </form>
            </div>
            <hr style="height: 20px;">
            <?php
                if(isset($_POST['submit']))
                {
                    require "includes/dbh.inc.php";
                    $target = "images/".basename($_FILES['image']['name']);
                    $image = $_FILES['image']['name'];
                    $name = $_POST['event_name'];
                    $location = $_POST['location'];
                    $date = $_POST['date'];

                    $available = 1;

                    $sql = "INSERT INTO events(event_image, event_name, available, location, eventdate) VALUES('$image','$name', '$available', '$location', '$date')";
                    if(mysqli_query($conn, $sql))
                    {
                        echo "
                            <script>
                                alert('event added successfully.');
                            </script>
                        ";
                    }
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
                    {
                        $msg = "Image uploaded successfully";
                    }
                    else
                    {
                        $msg = "There was a problem uploading image";
                    }
                }
            ?>


            <h3 align="center"><u>AVAILABLE EVENTS</u></h3><hr>
            <?php
                require "includes/dbh.inc.php";
                $sql = "SELECT * FROM events WHERE available=1";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $name = $row['event_name'];
                    $image = $row['event_image'];
                    $date = $row['eventdate'];

                    $location = $row['location'];
                    $id = $row['id'];
                    echo "
                        <div class='row' align='center' id='img_div' style='background-color: teal; width: 70%; margin:20px auto; border:1px solid #cbcbcb; margin-bottom: 50px; padding: 10px; border-radius: 10px;'>
                            <div class='col-md-6' style='width: 70%;'>
                             <img align='center' class='img img-fluid ' src = 'images/".$row['event_image']."' >
                                <br>
                            </div>
                            <div align='center' class='col-md-6'>
                            <h4  style=color:orange>Event:</h3> <p style='color: white;'>$name</p><br>
                            <h4 style=color:orange>date:</h3> <p style='color: white;'>$date</p><br>
                           
                            <h4 style=color:orange>Location:</h4> <p style='color: white;'>$location</p><br>
                            </div>
                            <div class='row'>
                            <div align='center' class='col-md-12'>
                                 <form action='events.php' method='POST' >
                                <input type='hidden' name='id' value=$id>
                                <button class='btn' type='submit' name='remove' style=' border-radius: 5px;  '>Remove Event</button>
                            </form>
                            </div>
                            </div>

                           

                        </div>
                    ";
                }
                if(isset($_POST['remove']))
                {
                    echo "

                    <script>

                        window.open('events.php');

                    </script>
                    ";
                    require "includes/dbh.inc.php";
                    $id = $_POST['id'];
                    $sql = "UPDATE events SET available = 0 WHERE id = '$id'";
                    mysqli_query($conn, $sql);

                }
            ?>
        </div>
    </div>
    <hr>
</div>
   

    <?php

        require 'footer.php';
    ?>
</body>
</html>