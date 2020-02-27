<?php
session_start();
$id = $_SESSION['userName'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>home page</title>
    <link rel="stylesheet" type="text/css" href="css/new.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	<?php
		require 'header.php';
	?>

	 <div class="hello">
           <?php 

            require 'includes/dbh.inc.php';
            $sql = "SELECT userName FROM users WHERE userName = '$id'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['userName'];

                echo 
                "
                <div class='hello'>
                Hello, <strong>$username</strong>
                </div>
                ";
            }


         ?><strong>
        </div>
        <div class="hello">
        <?php 
          if(isset($_GET['error']))
          {
            if($_GET['error'] = "emptyfields")
            {
              echo "item name and description are mandatory";
            }
          }
        ?>
      </div>

	<div class="container">
		<div class="form">
		<form action="home.php" method="post" enctype="multipart/form-data">
			 <input type="hidden" name="size" value="1000000">
				<div class="title">
					<p>Please provide details about your available stock</p>
				</div>
				<div class="form-input">
					<label>Click button to choose image</label>
					<input type="file" name="image">
				</div>
				<div class="form-input">
					<label>Item Name:</label>
					<input type="text" name="itemName" placeholder="enter item..." autofocus>
				</div>
				<div class="form-input">
					<label>Description:</label>
					<input type="text" name="description" placeholder="enter item..." autofocus>
				</div>
				<div class="form-input">
					<label>Quantity:</label>
					<input type="text" name="quantity" placeholder="enter item..." autofocus>
				</div>
				
				<button type="submit" name="stock-submit" class="btn">SUBMIT</button>
			</div>
		</form>
	</div>

	 <?php
                if(isset($_POST['stock-submit']))
                {
                    require "includes/dbh.inc.php";
                    $target = "images/".basename($_FILES['image']['name']);
                    $image = $_FILES['image']['name'];
                    $name = $_POST['itemName'];
                    $description = $_POST['description'];
                    $available = 1;

                    if(empty($name) || empty($description))
                    {
                      header("location: home.php?error=emptyfields");
                      exit();
                    }

                    $sql = "INSERT INTO stock( itemName,image, available, description) VALUES('$name','$image', '$available', '$description')";
                    if(mysqli_query($conn, $sql))
                    {
                        echo "
                            <div class='success'>
                                Product added successfully.
                            </div>
                        ";
                    }
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
                    {
                        $msg = "Image uploaded successfully";
                    }
                    else
                    {
                        $msg = "There was a problem uploading image";
                    }
                }
            ?>

            <div class="available-items">
            	  <h3 align="center"><u>AVAILABLE PRODUCTS</u></h3>
                  <table border="2" bgcolor="green" color="white" align="center" class="available-items">
                      <tr color="orange">
                          <th color="orange">S.N</th>
                          <th color="orange">PRODUCT</th>
                          <th color="orange">IMAGE</th>
                          <th color="orange">DESCRIPTION</th>
                          <th ></th>
                          <th></th>
                      </tr>
                  
            <?php
                require "includes/dbh.inc.php";
                $sql = "SELECT * FROM stock WHERE available=1";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $name = $row['itemName'];
                    $description = $row['description'];
                    $id = $row['itemNo'];
            ?>

                     <tr>
                          <th><?php echo $id; ?></th>
                          <th><?php echo $name; ?></th>
                          <th><?php echo "<img src = 'images/".$row['image']."'>"; ?></th>
                          <th><?php echo $description; ?></th>
                          <th><a href="edit.php?edit=<?php echo $id; ?>">Edit</a></th>
                          <th><a href="delete.php?delete=<?php echo $id; ?>">Delete</a></th>
                      </tr>
            <?php } ?>
                   <!--  echo "
                        <div id='img_div'>
                            <h3  style=color:orange>Name:</h3> $name<br>
                            <img src = 'images/".$row['image']."'>
                            <br>
                            <h3 style=color:orange>Description:</h3> $description<br>
                            <form action='home.php' method='POST'>
                                <input type='hidden' name='id' value=$id>
                                <button type='submit'   onClick='document.location.reload(true)' name='remove'>Remove</button>
                            </form>
                        </div>
                    "; -->
                
                
          <!--       // if(isset($_POST['remove']))
                // {
                //     require "includes/dbh.inc.php";
                //     $id = $_POST['id'];
                //     $sql = "UPDATE stock SET available = 0 WHERE itemNo = '$id'";
                //     mysqli_query($conn, $sql);
                // } -->
            
        </table>
            </div>

            <?php
            	require 'footer.php';
            ?>
</body>
</html>