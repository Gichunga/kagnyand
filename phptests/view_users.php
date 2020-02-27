<?php

    $title = "View the current users";
    include 'includes/header.html';

    //Page header
    echo "<h1>Registered Users</h1>";

    require 'includes/mysqli_connect.php';

    //Make the query
    $query = "SELECT last_name, first_name, user_id, DATE_FORMAT(registration_date, '%M, %d, %Y') AS dr FROM users ORDER BY registration_date ASC";
    $result = @mysqli_query($conn, $query);

    //Count the number of returned rows
    $num = mysqli_num_rows($result);

    if($num > 0)
    {
        //If it ran Ok, display the records

        //Print how many users there are
        echo "<p>There are currently $num registered users.</p>\n";

        //Table header.
        echo '<table width = "60%">
            <thead>
                <tr>
                    <th align="left"><strong>Edit</strong></th>
                    <th align="left"><strong>Delete</strong></th>
                    <th align="left"><strong>Last Name</strong></th>  
                    <th align="left"><strong>First Name</strong></th>
                    <th align="left"><strong>Date Registered</strong></th>
                </tr>
            </thead>
        <tbody';

        //Fetch and print all the records:
        while ($row = mysqli_fetch_assoc($result))
        {
            echo '<tr>
            <td align="left"><a href="edit_user.php?id=' .$row['user_id'] . '">Edit</a></td>
            <td align="left"><a href="delete_user.php?id=' .$row['user_id']. '">Delete</a></td>
            <td align="left">' . $row['last_name'] . '</td>
            <td align="left">' . $row['first_name'] . '</td>
            <td align="left">' . $row['dr'] . '</td>
            </tr>';
        }
        echo '</tbody></table>'; //Close the table
        mysqli_free_result($result);
    }
    else
    {
        // If the result did not run ok
        //Public message:
        echo '<p class="error">There are currently no registered users.</p>';

        //Debugging the message
        echo '<p>'. mysqli_error($conn). '<br></p>';
    }// End of if ($result)

    mysqli_close($conn); //Close the database connection.

    include 'includes/footer.html';
?>