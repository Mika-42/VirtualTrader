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

    <form id="log-form" method="post">

        <fieldset id="username" class="sign-field">
            <label class="sign-label">Username</label>
            <input class="sign-input" type="text">
        </fieldset>

        <fieldset id="email" class="sign-field">
            <label class="sign-label">Email</label>
            <input class="sign-input" type="email" required>
        </fieldset>

        <fieldset id="password" class="sign-field">
            <label class="sign-label">Password</label>
            <input class="sign-input" type="password" required>
        </fieldset>

        <fieldset id="confirm-password" class="sign-field">
            <label class="sign-label">confirm password</label>
            <input class="sign-input" type="password" required>
        </fieldset>

        <fieldset id="login-btn-field">
            <input id="sign-in-btn" type="submit" value="SIGN-IN">
        </fieldset>

    </form>

    <div id="sign-in">
        <a id="sign-in-link" href="log-in.php">Log-in</a>
    </div>
</aside>


</body>
</html>