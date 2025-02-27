<?php
//This script expects a user id to be passed to it through the URL
//It then presents a confirmation form and deletes the user
$title = 'Delete a user';
include 'includes/header.html';
echo '<h1>Delete a User</h1>';

//Check for a valid user ID, through GET or POST
if((isset($_GET['id'])) && (is_numeric($_GET['id'])))
{
    $id  = $_GET['id'];
}
elseif((isset($_POST['id'])) && (is_numeric($_POST['id'])))
{
    $id = $_POST['id'];
}
else
{
    echo '<p class="error">This page has been accessed in error.</p>';
    include 'includes/footer.html';
    exit();
}

require 'includes/mysqli_connect.php';

//Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($_POST['sure'] == 'Yes')
    {
        //Delete the record

        //Make the query
        $query = "DELETE FROM users WHERE user_id = $id LIMIT 1";
        $result = @mysqli_query($conn, $query);
        if(mysqli_affected_rows($conn) == 1)
        {
            //Print a message
            echo '<p>The user has been deleted</p>';
        }
        else
        {
            //if the query did not run as expected
            echo '<p class="error">The user could not be deleted due to a system error</p>';
        }
    }
    else
    {
        //No confirmation of deletion
        echo '<p>The user has not be deleted</p>';
    }
}
else
{
    //Show the form

    //Retrieve the users information:
        $query = "SELECT CONCAT(last_name, ' ', first_name) FROM users WHERE user_id = $id";
        $result = @mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1)
        {
            // Valid user, show the form.

            //Get the user's infromation:
            $row = mysqli_fetch_row($result);

            //Display the record being deleted:
            echo "<h3>Name: $row[0] </h3>
            Are you sure youwant to delete this user?";

            //Create the form
            echo '<form action="" method="POST">
                <input type="radio" name="sure" value="Yes">Yes
                <input type="radio" name="sure" value="No" checked="checked">No
                <input type="submit" name="submit" value="Submit">
                <input type="hidden" name="id" value="'. $id .'">
            </form>';
        }
        else
        {
            // Not a valid user ID.
            echo '<p>This page has been accessed in error.</p>';
        } //End of the main submission conditional
        mysqli_close($conn);
        include 'includes/footer.html';
}

?>