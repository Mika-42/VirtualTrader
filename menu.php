<?php
include('db_connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'LOGOUT') {
        //session_destroy();
        header('location: log-in.php');
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] === 'RESET') {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            mysqli_query($connect,$query);
            session_destroy();
        }
    }
    if (isset($_POST['action']) && $_POST['action'] === 'CONTINUE') {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $result=mysqli_query($connect,$query);
            if(mysqli_num_rows($result) > 0) {

            }
        }
    }
}
?>

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
            <input id="continue" class="menu-btn" type="submit" value="CONTINUE">
            <input id="reset" class="menu-btn" type="submit" value="RESET">
        </fieldset>

        <fieldset class="menu-field">
            <input id="log-out" type="submit" value="LOGOUT">
        </fieldset>
    </form>
</aside>

</body>
</html>