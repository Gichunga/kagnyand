<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
</head>
<body>
    <p>Click on an image to see it ina separate window.</p>
    <u>
        <?php
            //This script lists the images in the uploads directory
            $dir = "includes/uploads/"; // Define the directory to view
            $files = scandir($dir); //Read all images into an array

            //Display each image caption as a link to the javascript function
            foreach($files as $image)
            {
                if(substr($image, 0, 1) != '.')
                {
                    //Ignore anything starting with a period
                    //Get the images size in pixels
                    $image_size = getimagesize("$dir/$image");

                    //Make the images name URL-safe
                    $image_name = urlencode($image);

                    //Print the information
                    echo "<li><a href=\"javascript:create_window('$image_name', $image_size[0], $image_size[1])\">$image</a></li>\n";
                }
            }
        ?>
    </u>
<script src="scripts/function.js" charset="utf-8"></script>    
</body>
</html>