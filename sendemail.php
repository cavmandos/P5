<?php

//Use PHPMailer
include('./config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

function SendEmail($firstname, $lastname, $email, $message){
    try {
        $mail = new PHPMailer(true);
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;          
        $mail->Username   = EMAIL;
        $mail->Password   = PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
    
        //Recipients
        $mail->setFrom($email, $firstname." ".$lastname);
        $mail->addAddress(EMAIL);
        $mail->addAddress($email);
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Message du formulaire BlogFL';
        $mail->Body = $message;
    
        //Send email
        $mail->send();
        Toolbox::showAlert("Votre message a bien été envoyé !", Toolbox::COULEUR_VERTE);
        header("Location:accueil");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        Toolbox::showAlert("Erreur de l'envoi de votre message", Toolbox::COULEUR_ROUGE);
        header("Location:accueil");
    }
}
