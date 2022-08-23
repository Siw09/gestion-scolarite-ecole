<?php

include 'function.php';

$donnees = array();

$erreurs = array();

$message = array();

if (isset($_POST["nom"]) && !empty($_POST["nom"])) {
    $donnees["nom"] = $_POST["nom"];
} else {
    $erreurs["nom"] = "Le champs nom est requis. Veuillez le renseigné.";
}

if (isset($_POST["prenom"]) && !empty($_POST["prenom"])) {
    $donnees["prenom"] = $_POST["prenom"];
} else {
    $erreurs["prenom"] = "Le champs prénom est requis. Veuillez le renseigné.";
}

if (isset($_POST["sexe"]) && !empty($_POST["sexe"])) {
    $donnees["sexe"] = $_POST["sexe"];
} else {
    $erreurs["sexe"] = "Le champs sexe est requis. Veuillez le renseigné.";
}

if (isset($_POST["date-naissance"]) && !empty($_POST["date-naissance"])) {
    $donnees["date-naissance"] = $_POST["date-naissance"];
} else {
    $erreurs["date-naissance"] = "Le champs date de naissance est requis. Veuillez le renseigné.";
}

if (isset($_POST["email"]) && !empty($_POST["email"])) {
    $donnees["email"] = $_POST["email"];
} else {
    $erreurs["email"] = "Le champs email est requis. Veuillez le renseigné.";
}

if (isset($_POST["nom-utilisateur"]) && !empty($_POST["nom-utilisateur"])) {
    $donnees["nom-utilisateur"] = $_POST["nom-utilisateur"];
} else {
    $erreurs["nom-utilisateur"] = "Le champs nom d'utilisateur est requis. Veuillez le renseigné.";
}

if (isset($_POST["mot-de-passe"]) && !empty($_POST["mot-de-passe"])) {
    $donnees["mot-de-passe"] = $_POST["mot-de-passe"];
} else {
    $erreurs["mot-de-passe"] = "Le champs mot de passe est requis. Veuillez le renseigné.";
}

if (isset($_POST["retapez-mot-de-passe"]) && !empty($_POST["retapez-mot-de-passe"])) {
    $donnees["retapez-mot-de-passe"] = $_POST["retapez-mot-de-passe"];
} else {
    $erreurs["retapez-mot-de-passe"] = "Le champs retapez mot de passe est requis. Veuillez le renseigné.";
}

if (empty($erreurs)) {

    if ($donnees["mot-de-passe"] != $donnees["retapez-mot-de-passe"]) {

        $erreurs["mot-de-passe"] = $erreurs["retapez-mot-de-passe"] = "Les mots de passe ne sont pas identitque. Veuillez le réesayer.";

    } else if (!filter_var($donnees["email"], FILTER_VALIDATE_EMAIL)) {
        $erreurs["email"] = "Cette adresse mail n'est pas une adresse mail valide. Veuillez le changez.";
    }

}


$check_email_exist_in_db = check_email_exist_in_db($donnees["email"]);

if ($check_email_exist_in_db) {
    $erreurs["email"] = "Cette adresse mail est déja utilisé. Veuillez le changez.";
}
  
$check_user_name_exist_in_db = check_user_name_exist_in_db($donnees["nom-utilisateur"]);

if ($check_user_name_exist_in_db) {
    $erreurs["nom-utilisateur"] = "Ce nom d'utilisateur est déja utilisé. Veuillez le changez.";
}


if (empty($erreurs)) {
    $db = connect_db();

    // Ecriture de la requête
    $requette = 'INSERT INTO utilisateur (nom, prenom, sexe, date_naissance, email, nom_utilisateur, mot_de_passe) VALUES (:nom, :prenom, :sexe, :date_naissance, :email, :nom_utilisateur, :mot_de_passe);';

    // Préparation
    $inserer_utilisateur = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $inserer_utilisateur->execute([
        'nom' => $donnees["nom"],
        'prenom' => $donnees["prenom"],
        'sexe' => $donnees["sexe"],
        'date_naissance' => $donnees["date-naissance"],
        'email' => $donnees["email"],
        'nom_utilisateur' => $donnees["nom-utilisateur"],
        'mot_de_passe' => sha1($donnees["mot-de-passe"])
    ]);


    if ($resultat) {
        $message_success["statut"] = 1;
        $message_success["message"] = "Inscription éffectué avec succès.";
    } else {

        $message_success["statut"] = 0;
        $message_success["message"] = "Oups! Une erreure s'est produite lors de l'inscription. Veuillez réesayé";
    }
}

header("location: inscription.php?erreurs=" . json_encode($erreurs) . "&donnees=" . json_encode($donnees) . "&message=" . json_encode($message_success));