<?php

    if (isset($_POST['send']))
    {
        $email = $_POST['email'];
        $message = $_POST['message'];

        $mailTo = "gichungasteve6@gmail.com";
        $headers = 'From '.$email;
        $txt = "You have an email from: ". $email ."\n\n". $message;

        if(mail($mailTo, $txt, $headers))
        {
            header("location: ../footer.php?mailsent=1");
            exit();
        }
        else
        {
            header("location: ../footer.php?error=1");
            exit();
        }
    }

?>