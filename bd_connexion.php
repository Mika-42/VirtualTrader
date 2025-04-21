<?php
$servername = "localhost";
$username = "admin";
$password = "";
$databaseName = "user";

//on se connecte a la base de donnée
$connect = mysqli_connect($servername, $username, $password, $databaseName);

//on verifie que l'on puisse bien se connecter et sinon on renvoie une erreur
if (!$connect) {
    die("quelque chose ne vas pas avec la base de donnée");
}

// verifie si on est connecter pour debug
/// echo "la connexion avec la base de donnée est bien établie";




