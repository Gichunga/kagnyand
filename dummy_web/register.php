<?php
    require 'includes/config.inc.php';
    $page_title = 'Register';
    include 'includes/header.html';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require 'includes/mysqli_connect.inc.php';


        //Trim all incoming data
        $trimmed = array_map('trim', $_POST);

        //Assume invalid values
        $first_name=$last_name=$email=$pwd=FALSE;

        if(preg_match('/^[A-Za-z]*$/', $trimmed['first_name']))
        {
            $first_name = mysqli_real_escape_string($conn, $trimmed['first_name']);
        }
        else
        {
            echo '<p class="error">Please enter your first name!</p>';
        }

        if(preg_match('/^[A-Za-z]*$/', $trimmed['last_name']))
        {
            $last_name = mysqli_real_escape_string($conn, $trimmed['last_name']);
        }
        else
        {
            echo '<p class="error">Please enter your last name!</p>';
        }

        if(filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL))
        {
            $email = mysqli_real_escape_string($conn, $trimmed['email']);
        }
        else
        {
            echo '<p class="error">Please enter a valid email address!</p>';
        }

        if(strlen($trimmed['pwd']) >=6)
        {
            if(($trimmed['pwd']) == $trimmed['pwd1'])
            {
                $hashPassword = password_hash($trimmed['pwd'], PASSWORD_DEFAULT);
            }
            else
            {
                echo '<p class="error">Your password did not match the confrim password</p>';
            }
        }
        else
        {
            echo '<p class="error">Please enter a valid password</p>';
        }

        if($first_name && $last_name && $email && $hashPassword)
        {
            //If everything s okay
            $sql = "SELECT user_id FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query: $sql\n<br>MySQL Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result) == 0)
            {
                //Create the activation code
                $actvCode = md5(uniqid(rand(), true));

                //Add the user to the database
                $sql = "INSERT INTO users(email, pass, first_name, last_name, active, registration_date) 
                    VALUES('$email', '$hashPassword', '$first_name', '$last_name', '$actvCode', NOW())";
                $result = mysqli_query($conn, $sql) or trigger_error("Query: $sql\n<br>MySQL: " .mysqli_error($conn));
                if(mysqli_affected_rows($conn) == 1)
                {
                    //Send the email
                    $body = "Thank you for registering at <kagnyandaruayouth>. To activate your account, please click the link:\n\n";
                    $body .= BASE_URL . 'activate.php?x=' .urlencode($email). "&y=$actvCode";
                    mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@kagnyandaruayouth.co.ke');

                    //Finish the page
                    echo '<h3>Thank you for registering! A confirmation emai has been sent to your address. Please click the link in the eamil in order to activate your account.</h3>';
                    include('includes/footer.html'); //Include the footer
                    exit();
                }
                else
                {
                    echo '<p class="error">You could not be registered due to a system problem. We apologise for any inconvenience caused</p>';
                }
            }
            else
            {
                echo '<p class="error">That email has been registered. If you have forgotten your password, use the link at the right to have your password sent to you.</p>';
            }
        }
        else
        {
            //If one of the data tests failed
            echo '<p class="error">Please try again</p>';
        }
        mysqli_close($conn);
    }

?>

<h1>Register</h1>
<form action="" method="post">
    <fieldset>
        <p><strong>First Name:</strong><input type="text" name="first_name" size="20" maxlength="40" value="<?php if(isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>"></p>
        <p><strong>Last Name:</strong><input type="text" name="last_name" size="20" maxlength="40" value="<?php if(isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>"></p>
        <p><strong>Email:</strong><input type="email" name="email" size="20" maxlength="40" value="<?php if(isset($trimmed['email'])) echo $trimmed['email']; ?>"></p>
        <p><strong>Password:</strong><input type="password" name="pwd" size="20" value="<?php if(isset($trimmed['pwd'])) echo $trimmed['pwd']; ?>"><small>At least 6 characters long</small></p>
        <p><strong>Confirm Password:</strong><input type="password" name="pwd1" size="20" value="<?php if(isset($trimmed['pwd1'])) echo $trimmed['pwd1']; ?>"></p>
    </fieldset>
    <div align="center"><input type="submit" name="submit" value="Register"></div>
</form>
<?php include 'includes/footer.html'; ?>