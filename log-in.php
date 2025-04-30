<?php
include('index.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM Player WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0) {
        header('location: menu.php', true, 307);
        exit();
    }
    else{
        //todo mathis de mauvais mot de passe / username renvoie l'erreur en html
    }
}
