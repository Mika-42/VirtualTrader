<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="loginPage.css">
    <title>Menu</title>
</head>
<body>

<aside id="login-view">
    <h1 id="welcome">Hi Foo !</h1> <!-- todo insert username -->

    <form id="menu-form" method="POST">

        <fieldset class="menu-field">
            <input id="continue" class="menu-btn" type="submit" name="action" value="CONTINUE">
            <input id="reset" class="menu-btn" type="submit" name="action" value="RESET">
        </fieldset>

        <fieldset class="menu-field">
            <input id="log-out" type="submit" name="action" value="LOGOUT">
        </fieldset>
    </form>
</aside>

</body>
</html>

<?php
include('db_connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'LOGOUT') {
        session_destroy();
        header('location: log-in.php');
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] == 'RESET') {
            ///$userId = $_SESSION['user_id'];
            ///$query = "UPDATE users SET capital = 10000 WHERE user_id = $userId" AND "// todo faire le reste de la requete";
            ///mysqli_query($connect,$query);
            header('location: game.php');
            exit();
    }
    if (isset($_POST['action']) && $_POST['action'] == 'CONTINUE') {
        header('location: game.php');
        exit();
    }
}
?>
