<?php
    $title = "Edit Users";
    include "includes/header.html";

    //Check for a valid user id through the post or the get method
    if((isset($_GET['id'])) && is_numeric($_GET['id']))
    {
        $id = $_GET['id'];
    }
    elseif((isset($POST['id'])) && is_numeric($POST['id']))
    {
        $id = $_POST['id'];
    }
    else
    {
        echo "<p class='error'>This page was accessed in error</p>";
        include 'includes/footer.html';
        exit();
    }

    require 'includes/mysqli_connect.php';
    $errors = [];
    //Check for the form submission
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //Check for empty fields
        if(empty($_POST['first_name']))
        {
            $errors[] = "You forgot to enter your first name";
        }
        else
        {
            $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
        }
        if(empty($_POST['last_name']))
        {
            $errors[] = "You forgot to enter your last name";
        }
        else
        {
            $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));

        }
        if(empty($_POST['email']))
        {
            $errors[] = "You forgot to enter email";
        }
        else
        {
            $email = mysqli_real_escape_string($conn, filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL));

        }

        if(empty($errors))
        {
            //Test for unique eemail address
            $query = "SELECT user_id FROM users WHERE email='$email' AND user_id != '$id'";
            $result = @mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 0)
            {
                //Make the query
                $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE user_id='$id' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_affected_rows($conn) == 1)
                {
                    echo "<p>The user has been edited. </p>";
                }
                elseif(mysqli_affected_rows($conn) == 0)
                {
                    echo "<p class='error'>The users values have not been changed</p>";
                }
                else
                {
                    echo "<p class='error'>The user could not be edited due to a system problem</p>";
                }

            }
            else{
                echo "This email has been registered, try a different one";
            }
        }
        else
        {
            echo "<p class='error'>The following errors occured<br>\n";
            foreach($errors as $msg)
            {
                echo "$msg<br>\n";
            }
            echo "</p><p>Please try again</p>";
        }
    }//End of submit conditional
     
    //Always show the form

    //Retrieve the users details
    $query = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1)
    {
        //Get the users infromation
        $row = mysqli_fetch_assoc($result);

        //Create the form 
        echo '<form action="" method="post">
            <p>First_name: <input type="text" name="first_name" value="'.$row['first_name'].'"></p>
            <p>Last_name: <input type="text" name="last_name" value="'.$row['last_name'].'"></p>
            <p>Email: <input type="emaIl" name="email" value="'.$row['email'].'"></p>
            <p><input type="submit" name="submit" value="SUBMIT"></p>
            <input type="hidden" name="id" value="'.$id.'">
        </form>';

    }
   

?>