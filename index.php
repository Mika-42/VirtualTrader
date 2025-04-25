<?php
$servername = "localhost";
$username = "admin";
$password = "";
$databaseName = "user";

//on se connecte a la base de donnée
$connect = mysqli_connect($servername, $username, $password, $databaseName);

//on verifie que l'on puisse bien se connecter et sinon on renvoie une erreur
if (!$connect) {
    die("quelque chose ne vas pas avec la base de donnée");
}

if (isset($_SESSION['game_status']) && $_SESSION['game_status'] == 'lost') {
    header("Location: game-over.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_type'])) {
    $user_id = $_SESSION['user_id'];
    $action_type = $_POST['action_type'];
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO transactions (user_id, action_type, quantity) VALUES ("francois", "met", "cet merde")";
    mysqli_query($connect, $query);
}
?>