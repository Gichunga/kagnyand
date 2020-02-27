<?php
//This page lets the users change their passwords

$title = "Change your password";
include 'includes/header.html';

//Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require 'includes/mysqli_connect.php';
    $errors = []; // Initialize the error array

    //Check for email address
    if(empty($_POST['email']))
    {
        $errors[] = 'You forgot to enter your email address';
    }
    else
    {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    }

    //Check for the current password
    if(empty($_POST['pass']))
    {
        $errors[] = 'You forgot to enter your current password';
    }
    else
    {
        $p = mysqli_real_escape_string($conn, trim($_POST['pass']));
    }

    //Check for a new password and match
    //against the confirmed password
    if(!empty($_POST['pass1']))
    {
        if($_POST['pass1'] != $_POST['pass2'])
        {
            $errors[] = 'The new password and the confirm password do not match';
        }
        else
        {
            $np = mysqli_real_escape_string($conn, trim($_POST['pass1']));
        }
    }
    else
    {
        $errors[] = 'You forgot to enter your new password';
    }
    if(empty($errors))
    {
        //If everything is ok
        //Check that they have entered the right email address/password combination:
        $query = "SELECT user_id FROM users WHERE (email='$email' AND pass=SHA2('$p', 512))";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if($num == 1)
        { //Match was made

            //Get the user_id
            $row = mysqli_fetch_row($result);

            //Make the update query
            $hashPassword = password_hash($newpwd, PASSWORD_DEFAULT);
            $query = "UPDATE users SET pass='$hashPassword' WHERE user_id=$row[0]";
            $result = @mysqli_query($conn, $query);
            if(mysqli_affected_rows($conn) == 1) 
            {//If it run
                
                //Print the message.
                echo '<h1>Thank you!</h1>
                <p>Your password has been updated. You will actually be able to login soon!<p><br></p></p>';
            }
            else 
            { //If it did not run Ok
                //Public message
                echo '<h1>System Error<h1>
                <p class="error">Your password could not be changed due to a system error. We apologise for the inconvenience caused</p>';
            }
            mysqli_close($conn); //Close the database connection.

            //Include the footer and quit the script (to not show the form).
            include 'includes/footer.html';
            exit();
        }
        else
        {
            //Invalid email/password combination
            echo '<h1>Error!</h1>
            <p class="error">The email and the password do not match those on the file.</p>';
        }
    }
    else
    {
        //Report the errors
        echo '<h1>Error!</h1>
        <p class="error">The following errors occured:<br>';
        foreach($errors as $msg)
        {
            echo "* $msg<br>\n";
        }
        echo '</p><p>Please try again.</p><p><br></p>';
    } //End of if (empty($errors)) IF.
    mysqli_close($conn);
} //End of the main submit condition
?>
<h1>Change Your Password:</h1>
<form action="" method="post">
    <p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></p>
    <p>Current Password: <input type="password" name="pass" size="10" maxlength="20"></p>
    <p>New Password: <input type="password" name="pass1" size="10" maxlength="20"></p>
    <p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20"></p>
    <p><input type="submit" value="CHANGE PASSWORD"></p>
</form>
<?php include 'includes/footer.html'; ?>