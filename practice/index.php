<?php

$title = "Login";
include 'header.php';

?>
    <div class="content">
        <div class="login-form">
            <h4>LOGIN</h4>
            <form  action="includes/login.inc.php" method="POST" autocomplete="on">
                <label for="username" class="label" size="15" maxlength="20">Username/mail:</label> <input type="text" name="umail" value="<?php if(isset($_POST['uname'])) {echo $_POST['uname'];} ?>" class="text-input" max-length="20" autofocus="autofocus" ><br>
                <label for="pwd" class="label">Password: <input type="password" name="pwd" value="<?php if(isset($_POST['pwd'])) {echo $_POST['pwd'];} ?>" class="text-input" autocomplete="off"><br>
                <button type="submit" name="login-submit">LOGIN</button>
            </form>
            <h5>Don't have an account yet?<a href="signup.php">Register here</a>
            <a href="enter_email.php" style="text-decoration: none; "><h5 >Forgot your password?</h5></a>
            <?php
  
?>
        </div>
    </div>
<?php
include 'footer.php';

?>