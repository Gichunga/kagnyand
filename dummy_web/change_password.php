<?php

    // This page allows a logged in user to change their pasword
    require 'includes/config.inc.php';
    $page_title = "Change password";

    include 'includes/header.html';

    //Check if the user is logged in
    if(!isset($_SESSION['user_id']))
    {
        $url = BASE_URL . 'change_password.php';
        ob_end_clean(); //Delete the buffer
        header("Location: $url");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Check for passwod match against the confirmed password
        $pwd = FALSE;
        if(strlen($_POST['pwd1']) >= 6)
        {
            if($_POST['pwd1'] == $_POST['pwd2'])
            {
                $pwd = password_hash($pwd1, PASSWORD_DEFAULT);
            }
            else
            {
                echo '<p class="error">Your password did not match the confirm password</p>';
            }
        }
        else
        {
            echo '<p class="error">Please enter a valid password</p>';
        }

        if($pwd)
        {
            // If everything is okay make the query
            $sql = "UPDATE users SET pass='$pwd' WHERE user_id={$_SESSION['user_id']} LIMIT 1";
            $result = mysqli_query($conn, $sql) or trigger_error("Query: $sql\n<br>MySQL Error: " .mysqli_error($conn));
            if(mysqli_affected_rows($conn) == 1)
            {
                //Send an email, if desired
                echo "<h3>Your password has been changed.</h3>";
                mysqli_close($conn);
                include 'includes/footer.html';
                exit();
            }
            else
            {
                echo "<p class='error'>Your password was not changed. Make sure your new password is different than the current password. Contact the system admin if you think an error occured</p>";
            }

        }
        else
        {
            echo "<p class='error'>Please try again.</p>";
        }
        mysqli_close($conn);
    }
?>

<h1>Change Your Password</h1>
<form action="" method="post">\
    <fieldset>
        <p><strong>New Password: </strong><input type="password" name="pwd1" size="20"><small>At least 6 characters long.</small></p>
        <p><strong>Confirm Password:</strong><input type="password" name="pwd2" size="20"></p>
    </fieldset>
    <div align="center"><input type="submit" value="Change My Password"></div>
</form>

<?php include 'includes/footer.html'; ?>