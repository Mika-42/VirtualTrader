<?php
include('index.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        // Renvoie une erreur
        die("Les mots de passe ne correspondent pas.");
    }

    $query = "SELECT * FROM Player WHERE username = '$username'";
    $check = mysqli_query($connect, $query);

    if(mysqli_num_rows($check) > 0) {
        //mathis renvoie l'erreur en html
        die("Le nom d'utilisateur est déjà pris.");
    }
    else{
        $insert = "INSERT INTO Player (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($connect, $insert)) {
            session_destroy();
            header('Location: http://localhost/VirtualTrader/log-in.html', true, 307);
            exit;
        } else {
            // Gérer l'erreur d'insertion
            die("Erreur lors de l'insertion dans la base de données.");
        }
    }
}




