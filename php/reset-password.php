<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/loginPage.css">
    <title>Reset password</title>
</head>
<body>

<aside id="login-view">
    <h1 class="big-title">Reset password</h1>

    <form id="log-form" method="POST">
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
            <input id="reset-btn"  class="button" type="submit" value="RESET">
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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    global $pdo;

    $email = $_POST["email"];
    $old_password = $_POST["old-password"];
    $new_password = $_POST["new-password"];
    $confirm_password = $_POST["confirm-new-password"];

    $query = "SELECT * FROM Player WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email, $old_password]);

    if($stmt->rowCount() > 0) {

        if($new_password === $confirm_password){

            $query = "UPDATE Player SET password = ? WHERE email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$new_password, $email]);

            echo /** @lang javascript */
            "<script>
                const el = document.getElementById('error-msg');
                const ef = document.getElementById('info-msg');
                ef.innerText = 'Password successfully reset!';
                el.innerText = '';
            </script>";

            exit;
        }
        else{
            echo /** @lang javascript */
            "<script>
                const el = document.getElementById('error-msg');
                const ef = document.getElementById('info-msg');
                el.innerText = 'The confirm password does not match.';
                ef.innerText = '';
            </script>";
        }
    }
    else{
        echo /** @lang javascript */
        "<script>
            const el = document.getElementById('error-msg');
            const ef = document.getElementById('info-msg');
            el.innerText = 'Email or old password do not exist.';
            ef.innerText = '';
        </script>";
    }
}
?>

</body>
</html>