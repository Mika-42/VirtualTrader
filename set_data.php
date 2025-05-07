<?php
$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['name']) || empty($input['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$action = $input['action'];

switch ($action) {
    case 'update-logged-wallet':
        $stmt = $pdo->prepare("UPDATE player SET balance = '?' WHERE id ='?'");
        $stmt->execute([$input['balance'], $_SESSION['id']]);
        break;

//    case 'update-logged-actions':
//        $stmt = $pdo->prepare("UPDATE player SET balanceAction = '?' WHERE id ='?'");
//        $stmt->execute([$input['balanceAction'], $_SESSION['id']]);
//        break;

    case 'update-actions':
        $stmt = $pdo->prepare("UPDATE action SET value = '?', evolution = '?' WHERE code ='?'");
        $stmt->execute([$input['value'], $input['evolution'], $_SESSION['code']]);
        break;

    case 'add-action-to':
        $stmt = $pdo->prepare("INSERT IGNORE INTO ownBy (actionCode, playerId) VALUES ('?', '?')");
        $stmt->execute([$input['actionCode'], $input['playerId']]);
        break;

    case 'remove-action-to':
        $stmt = $pdo->prepare("DELETE FROM ownBy WHERE actionCode = '?' AND playerId ='?'");
        $stmt->execute([$input['actionCode'], $input['playerId']]);
    default:
}