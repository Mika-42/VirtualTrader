<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="loginPage.css">
    <title>Log-in</title>
</head>
<body>

<aside id="login-view">
    <h1 class="big-title">Reset password</h1>

    <form id="log-form" method="post" action="log-in.php">
        <fieldset id="email" class="log-field">
            <label for="email-entry" class="log-label">Email</label>
            <input id="email-entry" class="log-input" type="email" name="email" required>
        </fieldset>

        <fieldset id="old-password" class="log-field">
            <label for="old-password-entry" class="log-label">Old password</label>
            <input id="old-password-entry" class="log-input" type="password" name="old-password" required>
        </fieldset>
        <fieldset id="new-password" class="log-field">
            <label for="new-password-entry" class="log-label">New password</label>
            <input id="new-password-entry" class="log-input" type="password" name="new-password" required>
        </fieldset>
        <fieldset id="confirm-new-password" class="log-field">
            <label for="confirm-new-password-entry" class="log-label">Confirm new password</label>
            <input id="confirm-new-password-entry" class="log-input" type="password" name="confirm-new-password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="log-in-btn" type="submit" value="RESET">
        </fieldset>

        <div id="error-msg"></div>

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="sign-in.php">Sign-in</a>
    </div>
</aside>

<?php
include('db_connexion.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST["email"];
    $old_password = $_POST["*password"];
    $New_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    $query = "SELECT * FROM Player WHERE email = '$email' AND password = '$old_password'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0) {
        $mama = "UPDATE Player SET password = '$New_password' WHERE email = '$email'";
        mysqli_query($connect, $mama);
        header('location: menu.php', true, 307);
    }
    else{
        /// todo mathis renvoie l'erreur
    }
}
?>

</body>
</html>