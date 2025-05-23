<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/loginPage.css">
    <link rel="icon" href="../images/icon.png" type="image/png">
    <title>Log-in</title>
</head>
<body>

<aside id="login-view">
    <img id="title" src="../images/VT.png" alt="VirtualTrading">

    <form id="log-form" method="post">
        <fieldset id="email" class="log-field">
            <label for="email-entry" class="log-label">Email</label>
            <input id="email-entry" class="log-input" type="email" name="email" required>
        </fieldset>

        <fieldset id="password" class="log-field">
            <label for="password-entry" class="log-label">Password</label>
            <input id="password-entry" class="log-input" type="password" name="password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="log-in-btn" type="submit" class="button" value="LOGIN">
        </fieldset>

        <div id="forgotten-container"><a href="reset-password.php" id="forgotten-password-link">Reset password</a></div>

        <div id="error-msg"></div>

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="sign-in.php">Sign-in</a>
    </div>
</aside>

<?php
include 'interface.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(player_registered()) {
        header("location: menu.php?id=".urlencode($_SESSION['id']) , true, 307);

        echo /** @lang javascript */
        "<script>
            const el = document.getElementById('error-msg');
            el.innerText = '';
        </script>";

        exit();
    }
    else{
        echo /** @lang javascript */
        "<script>
            const el = document.getElementById('error-msg');
            el.innerText = 'Email or password is incorrect.';
        </script>";
    }
}
?>
</body>
</html>
