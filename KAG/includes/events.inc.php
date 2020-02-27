<?php
                if(isset($_POST['submit']))
                {
                    require "includes/dbh.inc.php";
                    $name = $_POST['event_name'];
                    $date = $_POST['date'];
                    $location = $_POST['location'];
                    $available = 1;

                    if(empty($name) || empty($date) || empty($location))
                    {
                    	
                    	echo"

                    		<script>
                    			alert('sorry but you need to fill all fields')
                    		</script>

                    	";
                    }
                    else
                    {
                    	 $sql = "INSERT INTO events(name, eventdate, location, available) VALUES('$name', '$date','$location', '$available)";
                    }
                   
                    if(mysqli_query($conn, $sql))
                    {
                        echo "
                            <div class='success'>
                                Product added successfully.
                            </div>
                        ";
                    }
                      
                }
            ?>