<?php
global $connect;
session_start();
include("db_connexion.php");

function getTable($table): array
{
    global $connect;
    $temp = [];
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0){
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
    }
    return $temp;
}

$logged = null;
$query = "SELECT * FROM player WHERE id = '".$_SESSION['id']."'";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0){
    $logged = $result->fetch_assoc();
}

$action = getTable('action');
$player = getTable('player');

$data = [
    'actions' => $action,
    'players' => $player,
    'logged' => $logged
];
//
//header('Content-Type: application/json');
//echo json_encode($data);