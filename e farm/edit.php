<?php
	if(isset($_GET['delete']))
	{
		if($_GET['delete'])
		{
			$delete_id = $_GET['delete'];

			$sql = "DELETE FROM stock where id = '$delete_id'";
			$conn = 
		}
	}

?>