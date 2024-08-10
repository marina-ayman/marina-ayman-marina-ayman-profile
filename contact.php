<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البيانات من النموذج
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // التحقق من البيانات
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete all fields correctly.";
        exit;
    }

    // إعداد البريد الإلكتروني
    $recipient = "marinaaymanae777@gmail.com"; // استبدل هذا بعنوان بريدك الإلكتروني
    $email_subject = "New message from $name: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n\n".
                  "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // إرسال البريد الإلكتروني
    if (mail($recipient, $email_subject, $email_body, $headers)) {
        http_response_code(200);
        echo "Your message has been sent successfully!";
    } else {
        http_response_code(500);
        echo "There was an error sending your message. Try again later.";
    }
} else {
    http_response_code(403);
    echo "This method is not allowed.";
}
?>
