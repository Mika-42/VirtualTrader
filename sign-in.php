<?php

include('bd_connexion.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $insert = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";

    $check = mysqli_query($connect, $query);

    if(mysqli_num_rows($check) > 0) {
        //mathis renvoie l'erreur en html
    }
    else{
        mysqli_query($connect, $insert);
        header('location: http://localhost/dev/log-in.php', true, 307);
    }
}


