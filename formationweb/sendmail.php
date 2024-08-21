<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'portfolio@edenolam.com';                 // SMTP username
    $mail->Password = 'Papa17111952*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                           // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;
    //    charset
    $mail->CharSet = "utf-8";

    //Recipients
    $mail->setFrom('portfolio@edenolam.com', 'Portfolio');
    $mail->addAddress('portfolio@edenolam.com');
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = $_POST['subject'];
        $mail->isHTML(false);
        $mail->Body = <<<EOT
            Email: {$_POST['email']}
            Name: {$_POST['name']}
            Message: {$_POST['message']}
        EOT;
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
            require_once "connectdb.php";
            mysqli_query($conn, "INSERT INTO tblcontact (name, email, subject, message) VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "','" . $_POST['subject'] . "','" . $_POST['message'] . "')");
            $insert_id = mysqli_insert_id($conn);
            if (!empty($insert_id)) {
                $message = "Your contact information is saved successfully";
            }

            header('Location: https://www.edenolam.com');
            exit();
        }
    } else {
        $msg = 'Share it with us!';
    }


} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}









