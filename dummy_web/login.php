<?php
    require 'includes/config.inc.php';
    $page_title = "Login";
    include 'includes/header.html';

    if(isset($_POST['submit']))
    {
        require 'includes/mysqli_connect.inc.php';

        //Validations

        if(!empty($_POST['email']))
        {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
        }
        else
        {
            $email = FALSE;
            echo '<p class="error">You forgot to enter your email address</p>';
        }

        if(!empty($_POST['pwd']))
        {
            $pwd = trim($_POST['pwd']);
        }
        else
        {
            $pwd = FALSE;
            echo '<p class="error">You forgot to enter your password</p>';
        }

        if($email && $pwd)
        {
            //Query the database
            $sql = "SELECT user_id, first_name, user_level, pass FROM users WHERE email='$email' AND active IS NULL";
            $result = mysqli_query($conn, $sql) or trigger_error("Query: $sql\n<br>MySQL Error:". mysqli_error);
            if(mysqli_num_rows($result) == 1)
            {
                //Fetch the values
                list($user_id, $first_name, $user_level, $pwd) = mysqli_fetch_row($result);
                mysqli_free_result($result);

                //Check the password
                if(password_verify($pwd, PASSWORD_DEFAULT))
                {
                    //Store the info in a session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['user_level'] = $user_level;
                    mysqli_close($conn);

                    //Redirect the user
                    $url = BASE_URL . 'index.php';
                    ob_end_clean(); //Delete the buffer.
                    header("Location: $url");
                    exit();

                }
                else
                {
                    echo "<p class='error'>Either the mail address and password entered do not match your registration's or you have not activated your account</p>";
                }
            }
            else //No match was made
            {
                echo "<p class='error'>Either the mail address or password entered do not match your registration's or you have not activated your account</p>";
            }
        }
        else
        {
            echo "<p class='error'>Please try again</p>";
        }
        mysqli_close($conn);
    }
?>

    <h1>Login</h1>
    <p>Your browser must allow cookies in order to login.</p>
    <form action="" method="POST">
        <fieldset>
            <p><strong>Email Address:</strong><input type="email" name="email" size="20" maxlength="60"></p>
            <p><strong>Password:</strong><input type="password" name="pwd" size="20"></p>
            <div align="center"><input type="submit" value="Login" name="submit"></div>
        </fieldset>
    </form>
    <?php include 'includes/footer.html' ?>