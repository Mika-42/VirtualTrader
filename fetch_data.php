<?php
global $userId;
include("db_connexion.php");
header('Content-Type: application/json');

$actions = [];

$result = mysqli_query($connect, "SELECT * FROM action");

if(mysqli_num_rows($result) > 0){
    while ($row = $result->fetch_assoc()) {
        $actions[] = $row;
    }
}

$balanceAccounts = $userId < 0 ? 0 : mysqli_query($connect, "SELECT Balance FROM player WHERE id='$userId'");

$data = [
    'actions' => $actions,
    'balanceAccount' => $balanceAccounts
];

echo json_encode($data);