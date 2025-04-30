<?php
include("db_connexion.php");
header('Content-Type: application/json');

$actions = [];

$result = mysqli_query($connect, "SELECT * FROM action");

if(mysqli_num_rows($result) > 0){
    while ($row = $result->fetch_assoc()) {
        $actions[] = $row;
    }
}

$ID = getCurrentUser_Id();
$balanceAccounts = $ID < 0 ? 0 : mysqli_query($connect, "SELECT Balance FROM player WHERE id='$ID'");

$data = [
    'actions' => $actions,
    'balanceAccounts' => $balanceAccounts
];

echo json_encode($data);