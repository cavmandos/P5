<?php

require './config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';


// Send email with PHPMailer
function SendEmail($firstname, $lastname, $email, $message)
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;          
        $mail->Username = EMAIL;
        $mail->Password = PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom($email, $firstname." ".$lastname);
        $mail->addAddress(EMAIL);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Message du formulaire BlogFL';
        $mail->Body = $message;
        $mail->send();
        Toolbox::showAlert("Votre message a bien été envoyé !", Toolbox::COULEUR_VERTE);
        header("Location:accueil");
    } catch (Exception $e) {
        Toolbox::showAlert("Erreur de l'envoi de votre message", Toolbox::COULEUR_ROUGE);
        header("Location:accueil");
    }
    
}
