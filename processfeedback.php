<!DOCTYPE html>

<?php

//create short variable names
$name=$_POST['name'];
$email=$_POST['email'];
$feedback=$_POST['feedback'];

//set up some static information
$toaddress = "bruce@mybackdeck.com";

$subject = "Feedback from web site";

$mailcontent = "Customer name: ".$name."\n".
                "Customer email: ".$email."\n".
                "Customer comments:\n".$feedback."\n";

$fromaddress ="From: webserver@mybackdeck.com";

//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>

<html>
    <head>
        <title> Bob's Auto Parts - Feedback Sumitted</title>
    </head>
    <body>
        <h1>Feedback submitted</h1>
        <p>Your feedback has been sent.</p>
    </body>
</html>




