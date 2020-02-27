   <?php
      require 'includes/dbh.inc.php';

      

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="css/about.css">
 -->
<link rel="stylesheet" type="text/css" href="css/about.css">
<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">

</head>
<body>
	<?php
		require "header.php";

	?>
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/members.jpg" style="background-size: cover; width:100%; height:70vh;">
        <div class="carousel-caption  d-md-block " >
          <h5 style="text-align:center; 
          font-family:elephant;
          text-transform:uppercase;
          font-size:18px;
          color:#BE3030;;
          margin-bottom:10%;
          font-weight:bold;">KAG ignite KAKAMEGA members</h5>
          <p style="text-align:center;
           font-family: lucida calligraphy; 
           font-weight:bold;
           font-size:large;
            color:coral;">Always united in Christ Jesus. </p>
        </div>
      </div>
      <div class="carousel-item">
        <div id="image-slider-2" >
          <img src="images/ladies.jpg" style="background-size: cover; width:100%; height: 70vh;">
        </div>
        <div class="carousel-caption  d-md-block">
          <h5 style="text-align:center;
          font-family:elephant;
          text-transform:uppercase;
          font-size:18px;
          color:#BE3030;
          margin-bottom:45px;
          font-weight:bold;">KAG Ignite KAKAMEGA Ladies Missioners</h5>
          <p style="text-align:center;
           font-family: lucida calligraphy; 
           font-weight:bold;
           font-size:large;
            color:coral;">.</p>
        </div>
      </div>
      
      <div class="carousel-item">
          <div id="image-slider-3">
              <img src="images/men.jpg" style="background-size:cover; width:100%; opacity:1; height: 70vh;">
          </div>
        <div class="carousel-caption  d-md-block">
          <h5 style="text-align:center;
          font-family:elephant;
          text-transform:uppercase;
          font-size:18px;
          color:#BE3030;
          margin-bottom:45px;
          font-weight:bold;">KAG Ignite KAKAMEGA men missioners</h5>
          <p style="text-align:center; 
          font-family: lucida calligraphy; 
          font-weight:bold;
          font-size:large;
           color:coral;">Purposed to serve with dignity and authority from God.</p>
        </div>
      </div>

      <div class="carousel-item">
        <div id="image-slider-4">
          <img src="images/leaders5.jpg" style ="background-size: cover; width: 100%; height: 70vh;" alt="">
        </div>
        <div class="carousel-caption d-md-block">
          <h5 style = "text-align: center;
          font-family: elephant;
          text-transform: uppercase;
          font-size: 18px;
          color: #BE3030;
          margin-bottom: 45px;
          font-weight: bold;">KAG Ignite KAKAMEGA LEADERS</h5>
          <p style="text-align: center;
          font-family: lucida-calligraphy;
          font-weight: bold;
          font-size: large;
          color: white;">Purposed to serve with dignity and authority from God.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon"  aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>



<hr>
<div class="container">
<div align="center"  class="row">

  <div class="col-sm-4">
    <a href="/sermons">
    <button class="btn"  style="background-color: orange;  border-radius: 10px; color:white; width: 50%; margin: 10px auto; cursor: pointer;" disabled="">Sermons<br>Browse all Sermons</button>
  </a>
  </div>
  
  <div class="col-sm-4">
    <a href="#">
    <button class="btn"  style="background-color: orange;  border-radius: 10px; color:white; width: 50%; cursor: pointer;" disabled="">Give Online<br>Support Good News</button>
  </a>  
  </div>

  <div class="col-sm-4">
    <a href="#">
    <button class="btn"  style="background-color: orange;  border-radius: 10px; color:white; width: 50%; margin: 10px auto; cursor: pointer;" disabled="">Member login<br>Our Online Community</button>
  </a>  
  </div>
</div>


<div class="img-responsive events-image" style="margin-left: 30px;  ">
  <img src="images/events.jpg" style="position:relative;  float: center; width: 70vw; margin-left: 20px; ">
  <div class="content">
    <div class="events">
      <?php
        $sql = "SELECT * FROM events WHERE available=1";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result))
        {
         
            $id = $row['id'];
            $name = $row['event_name'];
            $image = $row['event_image'];
             $date = $row['eventdate'];
             $place = $row['location'];
  
            $_SESSION['id'] = $id;
  
            echo "
            <div align='center' class='row'>
            <div class='col-sm-12'>
            
            <nav          hr style='border-bottom: 2px solid white; width: 70%; background: silver;'>
  
           
  
            <ul style='margin-top: 20px;  width: 100%;  list-style-type: none; '>
           
  
        
            <li style='float: left; margin: 10px;'>
                
              
               
                  <button class='btn btn-danger' style='margin-top:30px;'> $date </button>  
              
               
            </li><br>
  
            <li  style='float: left; margin-top: 30px; color: green; text-transform: uppercase; font-weight: bold;'>
               
                
                    $name
               
               
            </li>
  
            <li  style='float: left; margin-top: 30px; margin-left: 20px;'>
              
                    <strong>Location:</strong> $place
            
            </li>
            </ul>
  
         </nav>
                       </div>
                       </div>   
                 
               
                </div>
              </div>
            </div>
  
            ";
            
          
         
        
          
        }
      ?>
    </div>
  </div>
</div>
</div>




</section>
<br><br><br><br><br>
<hr>

<div class="container-fluid" >
  <div align="center" class="row ">
    <div class="col-sm-3" >
      <div style="margin: 0px;">
        <h5 class="text-success about-vision" style="border-bottom: solid coral;  padding: 5px; max-width: 200px; margin-bottom: 20px;">OUR VISION</h5>
        <strong>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </strong>
      </div>

      <div style="margin: 7%;">
        <h5 class="text-success about-vision" style="border-bottom: solid coral; padding: 5px; max-width: 200px; margin-bottom: 20px;">OUR MISSION</h5>
          <strong>To reach all people with the gospel in truth and Spirit</strong>
      </div>  

      <div style="margin: 7%;">
        <h5 class="text-success about-vision" style="border-bottom: solid coral; padding: 5px; max-width: 200px; margin-bottom: 40px;">WHAT WE BELIEVE</h5>
          <strong>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.  </strong>
      </div>  
    </div>
     
  <div align="center" class="col-sm-5" style="
   padding: 20px; " >
    <h4 >Various Groups:</h4>
    <ol>
      <div class="row" style="height:600px; overflow: scroll; ">

         <li style="margin-top: 20px;">Children Ministry<img class="img-fluid" src="images/child.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>

      <li style="margin-top: 10px;">Missioners <img class="img-fluid" src="images/missioners.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>

      <li style="margin-top: 10px;">P &  W Team <img class="img-fluid" src="images/praise3.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>

      <li style="margin-top: 10px;">Men Fellowship <img class="img-fluid" src="images/men fellowship.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>

      <li style="margin-top: 10px;">Gents Missioners<img class="img-fluid" src="images/gents missioners.jpg" style="width: 50%; height: 70%; margin-left: 5px; "></li>

      <li style="margin-top: 10px;">Ladies Missioners<img class="img-fluid" src="images/ladies missioners.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>

      <li style="margin-top: 10px;">   Leaders<img class="img-fluid" src="images/leaders5.jpg" style="width: 50%; height: 70%; margin-left: 5px;"></li>
      </div>
     
    </ol>


  </div>
</div>  
</div>
<hr>
<section class="home-location " id="location">
  <div class="module" style="margin-left: 40px ; margin-right: 40px; margin-top: 40px;">
    <h4 >Location and Time of Service</h4>
    <p class="small" style="margin-bottom: 0;  font-weight: bold;"> 
      "Sundays &nbsp; | 8:00am, 9:30am & 11:15am"<br>
      "Sundays &nbsp; | 8:00am, 9:30am & 11:15am"<br>"Sundays &nbsp; | 8:00am, 9:30am & 11:15am"<br>"Sundays &nbsp; | 8:00am, 9:30am & 11:15am"<br>
    </p>

    <hr>
    
    <div class="container" align="center"  style="background:white;  margin: auto;">
      <button align='center' class="btn btn-primary"><a href="https://her.is/2ZG9Olv" target="_blank"><h5 style="color: white;">Get Directions to our church</h5></a>
      </button>
    </div>
      
  </div>
</section>
</div>

</div>
	<?php

	require 'footer.php';


	?>
</body>
</html>