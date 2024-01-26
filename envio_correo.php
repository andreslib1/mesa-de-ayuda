<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviar_correo($correo, $asunto, $contenido){

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php'; 

    $mail = new PHPMailer(true);
        //Server settings (acceso a la cuenta de gmail)
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'correotestig@outlook.com';                     //SMTP username
        $mail->Password   = 'correotesting1';                               //SMTP password
        $mail->SMTPSecure = 'STARTTLS';             //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('correotestig@outlook.com', 'Mesa de ayuda USTA');          //de donde se envia el correo
        $mail->addAddress("".$correo."");     //A quien se le envia el correo

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "".$asunto."";
        $mail->Body    = "".$contenido."";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Mensaje alternativo 

        $mail->send();

        if ($mail){

                echo "<div class='col-10 alert alert-success' role='alert'>Se ha enviado un mensaje a tu correo electronico institucional, por favor valida tu bandeja de entrada y sigue las indicaciones.</div>";
        }else{

                echo "No se pudo enviar el correo : {$mail->ErrorInfo}";
        }
}