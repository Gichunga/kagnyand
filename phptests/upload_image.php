<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload an image</title>
    <style type="text/css" rel="text/css" media="all">
        .error{
            font-weight: bold;
            color: #c00;
        }
    </style>
</head>
<body>
    <form enctype="multipart/form-data" action="includes/upload-dp.inc.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="500000">
        <fieldset><legend>Select a JPEG or PNG image of 500kb or smaller to be uploaded:</legend>
            <p><strong>
                File:
            </strong>
                <input type="file" name="file">
            </p>
        </fieldset>
        <div align="center" style="width: 50%;">
            <input type="submit" name="submit" value="SUBMIT">
        </div>
    </form>
</body>
</html>