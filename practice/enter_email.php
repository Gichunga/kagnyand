<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
    <div class="password_reset">
    <h3>REQUEST PASSWORD RESET</h3>
        <form action="includes/enter-email.inc.php" method="post">
            <div class="form-group">
                <label for="email" class="email-label">Email:</label><input type="text" name="email" id="email"><br>
                <button type="submit" name="pwd-reset" id="pwd-reset">SEND</button>
            </div>
        </form>
    </div>
</body>
</html>