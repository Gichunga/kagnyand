<?php
//Check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
   /**
    * The function takes one argument: a string.
    *The fuction returns a clean version of the string.
    *The clean version may be either an empty string or just
    *the removal of all newline characters.
    */

    function spam_scrubber($value)
    {
        //List the very bad values
        $very_bad = ['to:', 'cc:', 'bcc:', 'content-type:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encording:'];

        //If any of the bad strings are in
        //the submitted value, return an empty string
        foreach($very_bad as $v)
        {
            if(stripos($value, $v) !== false) return '';
        }

        //Replace any newline character with spaces:
        $value = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $value);

        //Return the value
        return trim($value);
    }

    //Clean the form data
    $scrubbed = array_map('spam_scrubber', $_POST);

    //Minimal form validation
    if(!empty($scrubbed['name']) && !empty($scrubbed['email']) && !empty($scrubbed['comments']))
    {
        // Create the body
        $body = "Name: {$scrubbed['name']}\n\nComments: {$scrubbed['comments']}";

        //make the body no longer than 70 lines
        $body = wordwrap($body, 70);

        //Send the email
        mail('gichungasteve6@gmail.com', 'Contact Form Submission', $body, "From: {$scrubbed['email']}");

        //Print  a message
        echo '<p><em>Thank you for contacting me, I will reply soon</em></p>';

        //Clear the $scrubbed so that the form is not sticky
        $scrubbed = [];
    }
    else{
        echo '<p style="font-weight: bold; color: #00ffff;">Please fill out the form completely</p>';
    }
}
    

?>
<form action="" method="post">
    <P>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if(isset($scrubbed['name'])) echo $scrubbed['name']; ?>"></P>
    <P>Email : <input type="email" name="email" size="30" maxlength="60" value="<?php if(isset($scrubbed['email'])) echo $scrubbed['email']; ?>"></P>
    <P>Comments : <textarea name="comments" cols="30" rows="10" value="<?php if(isset($scrubbed['comments'])) echo $scrubbed['comments']; ?>"></textarea></P>
    <p><input type="submit" value="SEND" name="submit"></p>
</form>