<?php

//This is the main page for the site
//include the configuration file
require 'includes/config.inc.php';

$page_title = "Welcome to this site!";
include 'includes/header.html';

//Welcome the user by name if they are logged in
echo '<h1>Welcome';
    if(isset($_SESSION['first_name']))
    {
        echo ", {$_SESSION['first_name']}";
    }
echo '!</h1>';
?>
<p>Spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam
</p>

<p>Spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam spam
spam spam spam spam spam spam spam spam
</p>

<?php include 'includes/footer.html'; ?>