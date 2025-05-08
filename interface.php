<?php
//session_start();


$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");
$queryType = $_GET['queryType'] ?? '';

function get_logged_username() : string
{
    global $pdo;
    $query = "SELECT username FROM player WHERE id = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data[0]['username'];
}