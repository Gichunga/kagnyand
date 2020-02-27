<?php
// Check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Check for an uploaded file:
        if(isset($_FILES['upload']))
        {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if(in_array($_FILES['upload']['type'], $allowed))
            {
                // move the file over
                if(move_uploaded_file($_FILES['upload']['tmp_name'], "../includes/uploads/{$_FILES['upload']['name']}"))
                {
                    echo "<p><em>The file has been uploaded!</em></p>";
                }
                else
                {
                    //Invalid type.
                    echo "<p class='error'>Please upload a JPEG or PNG image.</p>";
                }
            }
        }

        //Check for an error
        if($_FILES['upload']['error'] > 0)
        {
            echo '<p class="error">The file could not be uploaded because:
            <strong>';

            //Print a message based on the error.
            switch($_FILES['upload']['error'])
            {
                case 1:
                    print 'The file exceeds the upload_max_filesize setting in php.ini';
                break;

                case 2:
                    print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
                break;

                case 3:
                    print 'The file was only partially uploaded.';
                break;

                case 4:
                    print 'No file was uploaded';
                break;

                case 6:
                    print 'No temporary folder was available';
                break;

                case 7:
                    print 'Unable to write to the disk';
                break;

                case 8:
                    print 'File upload stopped';
                break;

                default:
                print 'A system error occured';
                break;
            }

            print '</strong></p>';
        }

        //Delete the file if it still exists
        if(file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']))
        {
            unlink($_FILES['upload']['tmp_name']);
        }
}

?>