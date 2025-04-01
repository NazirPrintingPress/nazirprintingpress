<?php
if ($_SERVER["REQUEST_METHOD"] == "post") {
    // Your reCAPTCHA secret key
    $secret = 6LdYLwYrAAAAABVfODTCnSoRUYfgAvtnMDnDRXWN;
    $response = $_POST['g-recaptcha-response'];
    
    // Make the HTTP request to verify the CAPTCHA
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $responseKeys = file_get_contents($verifyUrl . '?secret=' . $secret . '&response=' . $response);
    $responseKeys = json_decode($responseKeys, true);
    
    // Check if the CAPTCHA was valid
    if ($responseKeys["success"]) {
        // CAPTCHA was successful, process the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        // You can now send an email or store the data in your database
        $to = 'your-email@example.com';
        $subject = 'New Message from Contact Form';
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";
        
        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully.";
        } else {
            echo "Failed to send the message.";
        }
    } else {
        echo "CAPTCHA validation failed. Please try again.";
    }
}
?>