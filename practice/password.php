<?php
$title = "Change Password";
include 'header.php';

//check if the form was submitted using the post method
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $errors = [];
    require 'includes/dbh.inc.php';

    //Check for empty fields
    if(empty($_POST['email']))
    {
        $errors[] = "You forgot to enter your emai address";
    }
    else
    {
        $email = mysqli_real_escape_string($conn, trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)));
    }

    if(empty($_POST['oldpwd']))
    {
        $errors[] = "You forgot to enter your old password";
    }
    else
    {
        $oldpwd = mysqli_real_escape_string($conn, trim($_POST['oldpwd']));
    }

    if(!empty($_POST['newpwd']))
    {
        if($_POST['newpwd'] !== $_POST['newpwd_c'])
        {
            $errors[] = "New password does not match the confirm password";
        }
        else
        {
            $newpwd = mysqli_real_escape_string($conn, trim($_POST['newpwd']));
        }
    }
    else
    {
        $errors[] = "You forgot to enter your new password";
    }
    mysqli_close($conn); //close the database connection

    // Check if the error array has values
    if(empty($errors))
    {
        //If everything is okay
        //Create a query to select the users with this email password combination
        require 'includes/dbh.inc.php';
        $query = "SELECT user_id FROM users WHERE (password='$oldpwd' AND email='$email')";
        $result = @mysqli_query($conn, $query);
        $num = @mysqli_num_rows();
        if($num == 1)
        {
            //Match was made
            //Make a query to update the user and set the password to new password where 
            $row = mysqli_fetch_row($result);
            $query = "UPDATE users SET password=SHA2('$newpwd', 512) WHERE user_id=$row[0]";
            $result = mysqli_query($conn, $result);
            if(mysqli_affected_rows($conn) == 1)
            {
                echo "<h1>Thank you!</h1>
                <p>Your password has been updated successfully.</p>";
            }
            else
            {
                //If it did not run Ok
                echo"<h1>System Error!</h1>
                <p class='error'>Your password could not be changed due to a system problem. We apologise for the inconveniences caused<br>\n</p>
                ";
                include 'footer.php';
                exit();
            }

        }
        else
        {

            //Invalid email and password
            echo "<h1>Error!</h1>
            <p class='error'>The email and the password do not match those on the file</p>";
        }
mysqli_close($conn);

    }
    else
    {
        //Report the errors
        echo "<h1>Errors!</h1>
        <p>The following erros occured:<br>";
        foreach ($errors as $msg) {
            echo "* $msg<br>\n";
        }
        echo "</p><p>Please try again</p><p><br></p>";

    }

// End of the main submit condition
}
?>
<form action="" method="POST">
    <p>Email: <input type="email" name="email" size="15" maxlength="20" value="<?php if(isset($_POST['email'])) echo($_POST['email']); ?>"></p>
    <p>Old Password: <input type="Password" name="oldpwd" size="15" maxlength="20" value="<?php if(isset($_POST['oldpwd'])) echo($_POST['oldpwd']); ?>"></p>
    <p>New Password: <input type="Password" name="newpwd" size="15" maxlength="20" value="<?php if(isset($_POST['newpwd'])) echo($_POST['newpwd']); ?>"></p>
    <p>Confirm New Password: <input type="Password" name="newpwd_c" size="15" maxlength="20"></p>
    <input type="submit" name="change" value="CHANGE PASSWORD">
</form>

