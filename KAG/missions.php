<!DOCTYPE html>
<html lang="en">
<head>
    <title>Missions-KAG Ignite kakamega Youths</title>
<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">

</head>
<body>
  <?php

    require 'header.php';
  ?>


<div class="image-responsive" style="position: relative;">
  <img src="images/child.jpg" style="background-size: cover; width:100%; height: 80vh;">
  <div class="image-caption" style="position:absolute; top:50%; left:50% transform:translate(-50%, -50%); ">
  </div>
    <button class="btn btn-outline-light button-text" style="position: absolute; top:50%; left:50%; transform: translate(-50%, -50%); width: 150px; font-weight: bolder;font-size:24px; border-radius:30px; color:coral;">MISSIONS</button>

    <blockquote   style="margin-top: 20px; position:absolute; top:70%; left:35%; font-weight:bolder;text-align: center;margin:40px auto; color: white;"><p align="center"><kbd>Psalm 96:3</kbd><br> Proclaim his glory to the nations, his mighty deeds to all people <figcaption class="quote-by"><kbd>— NIV</kbd></p></figcaption></blockquote>
  
</div>


  <?php

    require 'footer.php';

  ?>
</body>
</html>
<?php

  if (isset($_POST['signup-submit']))
  {
    $username = $_POST[''];
  }

?>