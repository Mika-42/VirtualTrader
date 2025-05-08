<?php
session_start();

header('Content-Type: application/json');
function queryAll($pdo,$table): void
{
    $stmt = $pdo->prepare("SELECT * FROM ?;");
    $stmt->execute([$table]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");
$queryType = $_GET['queryType'] ?? '';


switch ($queryType) {
    case 'logged-user': // ok
        $query = "SELECT * FROM player WHERE id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data[0]);

        break;

    case 'logged-action-price':

        $stmt = $pdo->prepare("
            SELECT SUM(value) AS actionBalance 
            FROM action 
            WHERE code IN 
            (SELECT actionCode FROM ownby WHERE playerId = ?);
        ");

        $stmt->execute([$_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'logged-total-wallet': //ok
        $stmt = $pdo->prepare("
            SELECT (SELECT balance FROM player WHERE id = ?) + IFNULL(SUM(action.value), 0) AS totalWallet
            FROM player, action
            WHERE player.id = ? AND (action.code, player.id) IN (SELECT * FROM ownBy);");

        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data[0]);
        break;

    case 'all-player-total-wallet':
        $stmt = $pdo->prepare("
            SELECT SUM(value) + player.balance AS totalWallet 
            FROM action, player 
            WHERE (action.code, player.id) 
            IN (SELECT actionCode, playerId FROM ownby) ORDER BY totalWallet DESC LIMIT 10;");

        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-player-sorted-by-total-wallet':
        $stmt = $pdo->prepare("
            SELECT player.*, SUM(value) + player.balance AS totalWallet 
            FROM action, player 
            WHERE (action.code, player.id) 
            IN (SELECT actionCode, playerId FROM ownby) 
            ORDER BY totalWallet DESC 
            LIMIT 10;");

        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-players':
        queryAll($pdo, 'player');
        break;

    case 'all-actions': // ok
        $stmt = $pdo->prepare("SELECT * FROM action;");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-actions-by-name':
        $stmt = $pdo->prepare("SELECT code FROM action ORDER BY name;");
        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-actions-by-price':
        $stmt = $pdo->prepare("SELECT code FROM action ORDER BY value;");
        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-actions-by-evolution':
        $stmt = $pdo->prepare("SELECT code FROM action ORDER BY evolution;");
        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;
    default:
        echo json_encode(['error' => 'Unknown request: ' . $queryType]);
}