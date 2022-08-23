<?php


use vendor\PHPMailer\PHPMailer\PHPMailer;
use vendor\PHPMailer\PHPMailer\SMTP;
use vendor\PHPMailer\PHPMailer\Exception;  


//Load Composer's autoloader
require 'vendor/autoload.php';


/**
 * Cette fonction permet de se connecter a une base de donnée.
 * Elle retourne l'instance / objet de la base de donnée, si la connexion a la base de donnée est succès.
 *
 * @return object $db L'instance / objet de la base de donnée.
 */
function connect_db()
{

    $db = null;

    try {
        $db = new PDO('mysql:host=localhost;dbname=gestionscolarite; charset=utf8', 'root', '');
    } catch (Exception $e) {
        die("Oups! Une erreur s'est produite lors de la connexion a la base de donnée.");
    }

    return $db;

}






/**
 * Cette fonction permet de verifier si un utilisateur existe dans la base de donnée ne possède pas cette adresse mail.
 * @param string $email L'email a vérifié.
 *
 * @return bool $check
 */
function check_email_exist_in_db(string $email)
{

    $check = false;

    $db = connect_db();

    $requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE email = :email";

    $verifier_email = $db->prepare($requette);

    $resultat = $verifier_email->execute([
        'email' => $email,
    ]);

    if ($resultat) {

        $nbr_utilisateur = $verifier_email->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

        $check = ($nbr_utilisateur > 0) ? true : false;

    }

    return $check;

} 


/**
 * Cette fonction permet de verifier si un utilisateur dans la base de donnée ne possède pas ce nom d'utilisateur.
 * @param string $nom_utilisateur Le nom d'utilisateur a vérifié.
 *
 * @return bool $check
 */
function check_user_name_exist_in_db(string $nom_utilisateur)
{

    $check = false;

    $db = connect_db();

    $requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";

    $verifier_nom_utilisateur = $db->prepare($requette);

    $resultat = $verifier_nom_utilisateur->execute([
        'nom_utilisateur' => $nom_utilisateur,
    ]);

    if ($resultat) {

        $nbr_utilisateur = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

        $check = ($nbr_utilisateur > 0) ? true : false;

    }

    return $check;

}

/**
 * Cette fonction permet de verifier si un utilisateur (email + mot de passe) existe dans la base de donnée.
 * Si oui elle retourne un tableau contenant les informations de l'utilisateur.
 * Sinon elle retourne un tableau vide.
 *
 * @param string $email L'email.
 * @param string $password Le mot de passe.
 *
 * @return array $user Les informations de l'utilisateur.
 */
function check_if_user_exist(string $email_user_name, string $password)
{

    $user = [];

    $db = connect_db();

    $requette = "SELECT * FROM utilisateur WHERE (email = :email or nom_utilisateur = :nom_utilisateur ) and mot_passe = :mot_passe";

    $verifier_nom_utilisateur = $db->prepare($requette);

    $resultat = $verifier_nom_utilisateur->execute([
        'email' => $email_user_name,
        'nom_utilisateur' => $email_user_name,
        'mot_passe' => sha1($password),
    ]);

    if ($resultat) {

        $utilisateur = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC);

        $user = (isset($utilisateur) && !empty($utilisateur) && is_array($utilisateur)) ? $utilisateur : [];

    }

    return $user;

}

function check_if_user_conneted()
{

    $check = false;


    if (isset($_COOKIE["info_utilisateur"]) && !empty($_COOKIE["info_utilisateur"])) {

        //$user_info = json_decode($_COOKIE["user_info"], true);

        $check = true;

    }

    return $check;

}


function send_mail($email, $message)
{
    try {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "sendmailcefp@gmail.com";
        $mail->Password = "Iso-Doss$22#G";

        $mail->IsHTML(true);
        $mail->AddAddress("dossou.israel48@gmail.com", "dossou.israel48@gmail.com");
        $mail->SetFrom("dossou.israel48@gmail.com", "dossou.israel48@gmail.com");
        // $mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
        // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
        $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
        $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        } else {
            echo "Email sent successfully";
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

