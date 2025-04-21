<?php
include('bd_connexion.php');

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