<?php
include('index.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        //todo Renvoie une erreur mathis
        die("Les mots de passe ne correspondent pas.");
    }

    $query = "SELECT * FROM Player WHERE username = '$username'";
    $check = mysqli_query($connect, $query);

    if(mysqli_num_rows($check) > 0) {
        //todo mathis renvoie l'erreur en html
        die("Le nom d'utilisateur est déjà pris.");
    }
    else{
        $insert = "INSERT INTO Player (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($connect, $insert)) {
            session_destroy();
            header('Location: log-in.php', true, 307);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="loginPage.css">
    <title>Sign-in</title>
</head>
<body>

<aside id="login-view">
    <img id="title" src="images/VT.png" alt="VirtualTrading">

    <form id="log-form" method="post" action="sign-in.php">

        <fieldset id="username" class="sign-field">
            <label class="sign-label">Username</label>
            <input class="sign-input" type="text" name="username">
        </fieldset>

        <fieldset id="email" class="sign-field">
            <label class="sign-label">Email</label>
            <input class="sign-input" type="email" name="email" required>
        </fieldset>

        <fieldset id="password" class="sign-field">
            <label class="sign-label">Password</label>
            <input class="sign-input" type="password" name="password" required>
        </fieldset>

        <fieldset id="confirm_password" class="sign-field">
            <label class="sign-label">confirm password</label>
            <input class="sign-input" type="password" name="confirm_password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="sign-in-btn" type="submit" value="SIGN-IN">
        </fieldset>

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="log-in.html">Log-in</a>
    </div>
</aside>


</body>
</html>




