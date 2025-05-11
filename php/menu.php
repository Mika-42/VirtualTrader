<?php
    include 'interface.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/loginPage.css">
    <link rel="icon" href="../images/icon.png" type="image/png">
    <title>Menu</title>
</head>
<body>

<aside id="login-view">
    <h1 id="welcome" class="big-title">Hi <?php echo htmlspecialchars(get_logged_username());?> !</h1>

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'LOGOUT') {
        session_unset();
        session_destroy();
        header('location: log-in.php');
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] == 'RESET') {
        reset_logged();
        header('location: game.php?id='.urlencode($_GET['id']));
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] == 'CONTINUE') {
        header('location: game.php?id='.urlencode($_GET['id']));
        exit();
    }
}
?>
