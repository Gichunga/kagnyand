<?php

/**
 * This script:
 * -define constants and settings
 * -dictates how errors are handled
 * -defines usefule settings
 */

# Created by: Stephen Mwangi Gichunga
# On 20th feb 2020
#To enable users to register and login to our site

// **************SETTINGS*******************//
// *****************************************//

//Flag variable for site status
define('LIVE', FALSE);

//Admin contact address
define('EMAIL', 'gichungasteve6@gmail.com');

//Site url
define('BASE_URL', 'http://www.localhost/');

//Location of the MySQL connection script
#define('MYSQL', 'C:\xampp\htdocs\dummy_web\includes\mysqli_connect.inc.php');

//Adjust the timezone for PHP 5.1 and greater
#date_default_timezone_set('Africa/Nairobi');

// *************SETTINGS********************//
// ****************************************//


//*************ERROR MANAGEMENT********** */
/**************************************** */

//create the error handler
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{
    //Build the error message
    $message = "An error has occured in script '$e_file' on line $e_line: $e_message\n";

    //Add the date and time
    $message .= "Date/Time: ". date('n-j-Y H:i:s') . "\n";

    if(!LIVE) //Development (print the error)
    {
        echo '<div class="error">' .nl2br($message);

        //Add the variables and backtrace(a history of function calls and such):
        echo '<pre>' .print_r ($e_vars, 1) ."\n";
        debug_print_backtrace();
        echo '</pre></div>';
    }
    else 
    {
        //Dont show the errors
        //Send an email to the admin

        $body = $message ."\n" .print_r($e_vars, 1);
        mail(EMAIL, 'Site Error!', $body, 'From: kagnyandaruayouth@gmail.com');

        //Only print an error message if the site is not a notice
        if($e_number != E_NOTICE)
        {
            echo '<div class="error">A System error has occured. We apologise for the inconvenience.</div><br>';
        }
    } // End of !LIVE IF
} //End of my_error_handler() function

//Use my error handler:
set_error_handler('my_error_handler');
//*****************ERROR MANAGEMENT************** */
//*********************************************** */
