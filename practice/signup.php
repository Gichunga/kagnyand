<?php 
$title = "Register";
include 'header.php';
?>


    <!-- <h3 style>Thank you for reaching to us, we will help you in any way we can</h3> -->

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require 'includes/dbh.inc.php';
        //Check if the form was sent using the post method
        $errors = [];

        //Check for the first name
        if(empty($_POST['fname']))
        {
            $errors[] = 'You forgot to enter your name';
        }
        else
        {
            $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
        }

        //Check for the last name
        if(empty($_POST['lname']))
        {
            $errors[] = "You forgot to enter your last name";
        }
        else
        {
            $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
        }

        //Check for the user name
        if(empty($_POST['uname']))
        {
            $errors[] = "You forgot to enter your user name";
        }
        else
        {
            $uname = mysqli_real_escape_string($conn, trim($_POST['uname']));
        }

        //Check for email
        if(empty($_POST['email']))
        {
            $errors[] = 'You forgot to enter your email';
        }
        else
        {
            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        }

        //Check for the last name
        if(empty($_POST['gender']))
        {
            $errors[] = "You forgot to enter your gender";
        }
        else
        {
            $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
        }

        //Check for password and match against the confirmed password
        if(!empty($_POST['pwd1']))
        {
            if($_POST['pwd1'] !== $_POST['pwd2'])
            {
                $errors[] = "You password did not match the confirm password";
            }
            else
            {
                $pwd = mysqli_real_escape_string($conn, $_POST['pwd1']);
            }
        }
        else
        {
            $errors[] = "You forgot to enter your password";
        }

        //If there were no errors
        if(empty($errors))
        {
            //Make the query
            require 'includes/dbh.inc.php';
            $query = "SELECT user_id FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            $num = mysqli_num_array($result);
            if($num > 0)
            {
                echo "User with that email exists";
            }
            else
            {
                //Make the query to insert the user to the database
                $query = "INSERT INTO users(fname, lname, uname, email, gender, password) VALUES('$fname', '$lname',' $uname', '$email', '$gender', SHA2('$pwd', 512))";
                $result = @mysqli_query($conn, $query);
                if(mysqli_affected_rows($conn) > 0)
                {
                    //If the query was executed successfully
                    echo "<h1>Thank you!</h1>
                    <p>You are now registered. In a moment you will be able to login</p><p><br></p>";
                }
                else
                {
                    echo "<h1>System Error!</h1>
                    <p class='error'>You could not be registered due to a system error.We apologise for the inconvenience caused</p>";
                }
            }
            mysqli_close($conn); // close the database connection

        }
        else
        {
            //Report the errors
            echo "<h1>Errors!</h1>
            <p class='error'>The following errors occured:<br>";
             foreach($errors as $msg){
            echo "* $msg<br>\n";
            }
            echo "</p><p>Please try again.</p><p><br></p>";
        }
        @mysqli_close($conn);
    }
?>
    <div class="content">
        
        <div align="center" class="signup-form">
            <h4>SIGNUP FORM</h4>
            <form action="" method="post" autocomplete="on">
    
            <div align="left" class="left">
                    <label for="firstname" class="label">First Name: <input  type="text" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" class="text-input" max-length="50" autofocus="autofocus"></label><br>
                    <label for="lastname" class="label">Last Name: <input type="text" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" class="text-input" max-length="50"></label><br>
                     <label for="username" class="label">User Name: <input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" class="text-input" max-length="50"></label><br>
                    
                    <label for="email" class="label">Email: <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo ($_POST['email']); ?>" class="text-input" max-length="50"></label><br>
                     <label for="gender" class="label">Gender:<br> <input type="radio" name="gender" value="M" <?php if((isset($_POST['gender'])) && ($_POST['gender'] == 'M')) echo('checked = /"checked/"'); ?> class="text-input">Male
                        <input type="radio" name="gender" value="F" <?php if((isset($_POST['gender'])) && ($_POST['gender'] == 'F')) echo('checked = /"checked/"'); ?> class="text-input">Female
                        <input type="radio" name="gender" value="Other" <?php if((isset($_POST['gender'])) && ($_POST['gender'] == 'Other')) echo('checked = /"checked/"'); ?> class="text-input">Other
                     </label><br>
                </div>
                <div align="left" class="right">
                    
                    <label for="password" class="label">Password: <input type="password" name="pwd1" value="<?php if(isset($_POST['pwd1'])) {echo $_POST['pwd1'];} ?>" class="text-input"  autocomplete="off" max-length="20"></label><br>
                    <label for="confirm_password" class="label">Confirm Password: <input type="password" name="pwd2" class="text-input" autocomplete="off" max-length="20"></label><br>
                    <button type="submit" name="signup-submit">SIGNUP</button>
                </div>
            </form>
        </div>       

        <div class="aside">
        <h5>Subscribe to our newsletter to get customised products as they are uploaded to our servers</h5>
        </div>

    </div>
<?php include 'footer.php'; ?>
</body>
</html>

