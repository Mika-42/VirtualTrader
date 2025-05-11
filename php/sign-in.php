<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/loginPage.css">
    <link rel="icon" href="../images/icon.png" type="image/png">
    <title>Sign-in</title>
</head>
<body>

<aside id="login-view">
    <img id="title" src="../images/VT.png" alt="VirtualTrading">

    <form id="log-form" method="post">

        <fieldset id="username" class="sign-field">
            <label for="username-entry" class="sign-label">Username</label>
            <input id="username-entry" class="sign-input" type="text" name="username">
        </fieldset>

        <fieldset id="email" class="sign-field">
            <label for="email-entry" class="sign-label">Email</label>
            <input id="email-entry" class="sign-input" type="email" name="email" required>
        </fieldset>

        <fieldset id="password" class="sign-field">
            <label for="password-entry" class="sign-label">Password</label>
            <input id="password-entry" class="sign-input" type="password" name="password" required>
        </fieldset>

        <fieldset id="confirm_password" class="sign-field">
            <label for="confirm-password-entry" class="sign-label">confirm password</label>
            <input id="confirm-password-entry" class="sign-input" type="password" name="confirm_password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="sign-in-btn" class="button" type="submit" value="SIGN-IN">
        </fieldset>

        <div id="error-msg"></div>
        <div id="info-msg"></div>

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="log-in.php">Log-in</a>
    </div>

</aside>

<?php
include 'interface.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    global$pdo;
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $confirm_password = $_POST["confirm_password"];

    if (!password_verify($confirm_password, $password)) {
        echo /** @lang javascript */
        "<script>
            const el = document.getElementById('error-msg');
            const e = document.getElementById('info-msg');
            
            el.innerText = 'Passwords do not match.';
            e.innerText = '';
        </script>";
        exit;
    }

    $query = "SELECT * FROM Player WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    if($stmt->rowCount() > 0) {
        echo /** @lang javascript */
        "<script>
            const el = document.getElementById('error-msg');
            const e = document.getElementById('info-msg');
            
            el.innerText = 'This email is already registered.';
            e.innerText = '';
        </script>";

        die("email already taken.");
    }
    else{
        $query = "INSERT INTO Player (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        ;
        if ($stmt->execute([$username, $email, $password])) {
            echo /** @lang javascript */
            "<script>
            const el = document.getElementById('error-msg');
            const e = document.getElementById('info-msg');
            el.innerText = '';
            e.innerText = 'Successfully registered.';
            </script>";

            exit;
        } else {
            echo /** @lang javascript */
            "<script>
            const el = document.getElementById('error-msg');
            const e = document.getElementById('info-msg');
            
            el.innerText = 'Failed to insert data in database.';
            e.innerText = '';
            </script>";
            die("Erreur lors de l'insertion dans la base de données.");
        }
    }
}
?>

</body>
</html>

