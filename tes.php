











<?php
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
echo $db;


