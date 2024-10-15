<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $mensagemHTML)
{

    require 'vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.zerobugs.com.br';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'teste@zerobugs.com.br';
    $mail->Password = 'mc0BfI9*mm<';

    $mail->SMTPSecure = false;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('teste@zerobugs.com.br', "Teste Zero Bugs");
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }

}
?>