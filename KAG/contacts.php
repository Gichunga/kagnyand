<!DOCTYPE html>
<html>
<head>
    <title>Contact-Us -KAG Ignite Nyandarua Youths</title>
   <link rel="stylesheet" type="text/css" href="css/contact-us.css">
   <link rel="shortcut icon" type="image/jpg" href="images/logo.jpg">
  
</head>
<body>
<?php
require 'header.php';

?>


<div class="image-responsive" style="position: relative;">
	<img align="center" class="img img-fluid" src="images/men fellowship.jpg" style="background-size: cover; width:100%; display: flex; flex-direction: row; justify-content: center;  height: 70vh;">
	<div class="image-caption" style="position:absolute; top:50%; left:50% transform:translate(-50%, -50%); ">
	</div>
		<button class="btn btn-outline-light button-text" style="position: absolute; top:50%; left:50%; transform: translate(-50%, -50%); width: 180px; font-weight: bolder;font-size:24px; border-radius:30px; color:coral;">CONTACT-US</button>

		<blockquote  style="margin-top: 20px; position:absolute; top:70%; left:0%; font-weight:bolder;text-align: center;margin:40px auto;"><kbd>Galatians 6:9</kbd><br>  <p style="color: white;">Let us not become weary in doing good, for at the proper time we will reap a harvest if we do not give up.</p> <figcaption class="quote-by"><kbd>— NIV</kbd></figcaption></blockquote>
	
</div>

    <hr>
    <div class="container">
      
        <div  class="form">
            <h2 style="color: white;">Talk To Us</h2>
            <?php
                if(isset($_GET['mailsent']))
                {
                    echo "
                        <div class='success'>
                            Message sent successfully. We will get back to you soon.
                        </div>
                    ";
                }
                else if(isset($_GET['error']))
                {
                    echo "
                        <div class='error'>
                            Message not sent. Please check for errors in your message.
                        </div>
                    ";
                }
            ?>
            <form action="includes/contact-us.inc.php" method="POST" style="color: white;">
                <label>Name</label>
                <input type="text" name="name" class="text-input" value="">
                <label>Email</label>
                <input type="email" name="email" class="text-input" value="">
                <label>Phone</label>
                <input type="text" name="phone" class="text-input" value="">
                <label>Subject</label>
                <input type="text" name="subject" class="text-input">
                <label>Message</label><br>
                <textarea name="message" placeholder="Type Your Message"></textarea><br><br>
                <button type="submit" name="submit" class="send-btn">Send</button>


            </form>
		</div>
	</div>




<?php



	require 'footer.php';

?>
</body>
</html>