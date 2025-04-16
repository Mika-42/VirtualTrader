<?php

include('bd_connexion.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0) {
        header('location: http://localhost/dev/menu.php', true, 307);
    }
    else{
        echo "pseudo ou mot de passe incorrect";
    }
}
