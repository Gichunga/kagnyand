<?php
	
	$title = "View Users";
	include 'header.php';

	echo "<h1>Registered Users!</h1>";

	require 'includes/dbh.inc.php';

	$query = "SELECT lname, fname, user_id FROM users";
	$result = @mysqli_query($conn, $query);

	//Count the number of returned rows
	$num = @mysqli_num_rows($result);

	if($num > 0)
	{
		echo "<p>There are currently $num registered users</p>\n";

		echo '<table width = "100%">
			<thead>
				<tr>
					<th align="left"><strong>Edit</strong></th>
					<th align="left"><strong>Delete</strong></th>
					<th align="left"><strong>Last Name</strong></th>
					<th align="left"><strong>First Name</strong></th>
				</tr>
			</thead>
			<tbody>';

			//Fetch and print all records
			while($row = mysqli_fetch_assoc($result))
			{
				echo'<tr>
					<td align="left"><a href="editusers.php?id=' .$row['user_id'] . '">Edit</a></td>
					<td align="left"><a href="deleteusers.php?id=' .$row['user_id'] . '">Delete</a></td>
					<td align="left">' . $row['lname'] .' </td>
					<td align="left">'.$row['fname'].'</td>
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

    include 'footer.php';

?>