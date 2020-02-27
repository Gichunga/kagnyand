<?php

    require 'includes/config.inc.php';
    $page_title = 'Forgot your password';
    include 'includes/header.html';

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        require 'includes/mysqli_connect.inc.php';
        //Assume nothing
        $uid = FALSE;

        //validate the email
        if(!empty($_POST['email']))
        {
            //Check for existence of that email
            $sql = 'SELECT  user_id FROM users WHERE email="'.mysqli_real_escape_string($conn, $_POST['email']).'"';
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) == 1)
            {
                //Retrieve the user_id
                list($uid) = mysqli_fetch_row($result);
            }
            else // No database match was made
            {
                echo '<p class="error">The submitted email does not match your registered email</p>';
            }
        }
        else
        {
            echo "<p class='error'>You forgot to enter your email address.</p>";
        }

        if($uid)
        {
            //Create a new random password
            $pwd = substr(md5(uniqid(rand(), true)), 3, 15);
            $hash_Password = password_hash($pwd);

            //Update the database
            $sql = "UPDATE users SET pass='$hash_Password' WHERE user_id=$uid LIMIT 1" ;
            $result = mysqli_query($conn, $result) or trigger_error("Query: $sql\n<br>MySQL Error:" .mysqli_error($conn));
            if(mysqli_affected_rows($conn) == 1)
            {
                //Send an email
                $body = "Your password to log into <site> has temporarily changed to '$p'. Please log in using this password and this email address then yu may change your password to something more familiar";
                mail($_POST['mail'], 'Your temporary password', $body, 'From: admin@sitename.com');

                //Print a message and wrap up
                echo '<h3>Your password has been changed. You will receive the new temporary password at the email which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
                mysqli_close($conn);
                include 'includes/footer.html';
                exit();
            }
            else
            {
                // If it did not run okay
                echo "<p class='error'>Sorry, your password could not be changed due to a system error. We apologize for the inconvenience</p>";
            }

        }
        else
        {
            //Failed the validation test
            echo "<p class='error'>Please try again</p>";

        }
        mysqli_close($conn);
    }

?>

<h1>Reset Your Password</h1>
<p>Enter your email addres below and your password will be reset</p>
<form action="" method="post">
    <fieldset>
        <p><strong>Email Address:</strong><input type="email" name="email" size="20" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></p>
    </fieldset>
    <div align="center"><input type="submit" value="Reset My Password"></div>
</form>

<?php include 'includes/footer.html'; ?>