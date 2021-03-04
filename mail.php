<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/PHPMailer/src/Exception.php';
    require 'lib/PHPMailer/src/PHPMailer.php';
    require 'lib/PHPMailer/src/SMTP.php';

    //Var from POST=>contact.html

    $auteur = htmlspecialchars($_POST['nom']);
    $destinataireDirect = ''; // A changer pour l'adresse mail de nadège
    $destinataire = htmlspecialchars($destinataireDirect);
    $telephone = htmlspecialchars($_POST['tel']);
    $email = htmlspecialchars($_POST['email']);
    $objet = htmlspecialchars($_POST['objet']);
    $message = htmlspecialchars($_POST['message']);



    // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                  // Enable verbose debug output
    $mail->isSMTP();                                                        // Send using SMTP
    $mail->Host       = ''; // A changer pour l'adresse Host de ton SMTP    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                               // Enable SMTP authentication
    $mail->Username   = ''; // A changer pour l'ID de ton SMTP              // SMTP username
    $mail->Password   = ''; // A changer pour le MDP de ton SMTP            // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                                // TCP port to connect to

    //Recipients
    $mail->setFrom($email, $auteur);
    $mail->addAddress($destinataire);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('prodlocbio@hotmail.com', 'Information'); // Pour avoir un reply sur son adresse gmail
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $objet;
    $mail->Body    = $message . "<br>" . "<br>" .  $auteur . "<br>" . $telephone . "<br>" . $email;
    $mail->AltBody = $message . "<br>" . "<br>" .  $auteur . "<br>" . $telephone . "<br>" . $email;

    $mail->send();
    echo 'Message has been sent';
    header('Location: contact.html');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>