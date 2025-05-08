<?php
session_start();

header('Content-Type: application/json');

$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");

$input = json_decode(file_get_contents('php://input'), true);

$action = $_GET['action'] ?? '$action is invalid.';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
switch ($action) {
    case 'update-logged-wallet': // ok
        $stmt = $pdo->prepare("UPDATE player SET balance = ? WHERE id =?;");
        $stmt->execute([$input['balance'], $_SESSION['id']]);
        echo json_encode(["success" => $action . ' successfully executed.']);
        break;

//    case 'update-logged-actions':
//        $stmt = $pdo->prepare("UPDATE player SET balanceAction = '?' WHERE id ='?'");
//        $stmt->execute([$input['balanceAction'], $_SESSION['id']]);
//        break;

    case 'update-actions':
        $stmt = $pdo->prepare("UPDATE action SET value = ?, evolution = ? WHERE code ='?';");
        $stmt->execute([$input['value'], $input['evolution'], $_SESSION['code']]);
        break;

    case 'add-action-to': // ok
        $stmt = $pdo->prepare("INSERT IGNORE INTO ownBy (actionCode, playerId) VALUES (?, ?);");
        $stmt->execute([$input['actionCode'], $input['playerId']]);
        echo json_encode(["success" => $action . ' successfully executed.']);
        break;

    case 'remove-action-to':
        $stmt = $pdo->prepare("DELETE FROM ownBy WHERE actionCode = ? AND playerId = ?;");
        $stmt->execute([$input['actionCode'], $input['playerId']]);
        echo json_encode(["success" => $action . ' successfully executed.']);
        break;

    default:
        echo json_encode(['error' => 'Unknown request: ' . $action]);
}
} else json_encode(['error' => 'Bad request method: ' . $_SERVER['REQUEST_METHOD']]);