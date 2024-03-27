<?php

// Define some constants
define("RECIPIENT_NAME", "John Doe");
define("RECIPIENT_EMAIL", "franbalcarce21@gmail.com");

// Read the form values
$success = false;
$name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : "";
$senderEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : "";
$phone = isset($_POST['phone']) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : "";
$services = isset($_POST['services']) ? filter_var($_POST['services'], FILTER_SANITIZE_STRING) : "";
$subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_STRING) : "";
$address = isset($_POST['address']) ? filter_var($_POST['address'], FILTER_SANITIZE_STRING) : "";
$website = isset($_POST['website']) ? filter_var($_POST['website'], FILTER_SANITIZE_URL) : "";
$message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_STRING) : "";

$mail_subject = 'A contact request sent by ' . $name;

$body = 'Name: ' . $name . "\r\n";
$body .= 'Email: ' . $senderEmail . "\r\n";

if ($phone) {
    $body .= 'Phone: ' . $phone . "\r\n";
}
if ($services) {
    $body .= 'Services: ' . $services . "\r\n";
}
if ($subject) {
    $body .= 'Subject: ' . $subject . "\r\n";
}
if ($address) {
    $body .= 'Address: ' . $address . "\r\n";
}
if ($website) {
    $body .= 'Website: ' . $website . "\r\n";
}

$body .= 'Message: ' . "\r\n" . $message;

// If all values exist, send the email
if ($name && $senderEmail && $message) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: " . $name . " <" . $senderEmail . ">";
    $success = mail($recipient, $mail_subject, $body, $headers);
    if ($success) {
        echo "<div class='inner success'><p class='success'>Thanks for contacting us. We will contact you ASAP!</p></div><!-- /.inner -->";
    } else {
        echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div><!-- /.inner -->";
    }
} else {
    echo "<div class='inner error'><p class='error'>Please fill in all the required fields.</p></div><!-- /.inner -->";
}
?>
