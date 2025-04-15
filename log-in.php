<?php
//on se coo
require_once('bd_connexion.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0) {
        header('location: http://localhost/dev/menu.php', true, 307);
    }
    else{
        echo "pseudo ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="loginPage.css">
    <title>Log-in</title>
</head>
<body>

<aside id="login-view">
    <img id="title" src="images/VT.png" alt="VirtualTrading">

    <form id="log-form" method="post" action="log-in.php">

        <fieldset id="email" class="log-field">
            <label class="log-label">Email</label>
            <input class="log-input" type="email" required>
        </fieldset>

        <fieldset id="password" class="log-field">
            <label class="log-label">Password</label>
            <input class="log-input" type="password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="log-in-btn" type="submit" value="LOGIN">
        </fieldset>

<!--        <a id="forgotten-password-link">forgotten password ?</a>-->

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="sign-in.php">Sign-in</a>
    </div>
</aside>


</body>
</html>