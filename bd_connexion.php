<?php
$servername = "localhost";
$username = "admin";
$password = "";
$databaseName = "user";

//on se connect a la base de donnée
$connect = mysqli_connect($servername, $username, $password, $databaseName);

//on deco si il y a un probleme avec la bd
if (!$connect) {
    die("quelque chose ne vas pas avec la base de donnée");
}

// verifie si on est coo pour debug
/// echo "la connexion avec la base de donnée est bien établie";

// deco de la base pour debug
// mysqli_close($connect);
