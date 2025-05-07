<?php
header('Content-Type: application/json');
function queryAll($pdo,$table): void
{
    $stmt = $pdo->prepare("SELECT * FROM ?;");
    $stmt->execute($table);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");
$queryType = $_POST['queryType'] ?? '';

switch ($queryType) {
    case 'logged-user':
        $stmt = $pdo->prepare("SELECT * FROM player WHERE id ='?'");
        $stmt->execute($_SESSION['id']);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'logged-action-price':

        $stmt = $pdo->prepare("SELECT SUM(value) AS actionBalance FROM action WHERE code IN (SELECT actionCode FROM ownby WHERE playerId ='?');");
        $stmt->execute($_SESSION['id']);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'logged-total-wallet':
        $stmt = $pdo->prepare("SELECT SUM(value) + (SELECT balance FROM player WHERE id = '?') AS totalWallet FROM action WHERE code IN (SELECT actionCode FROM ownby WHERE playerId ='?');");
        $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;

    case 'all-players':
        queryAll($pdo, 'player');
        break;

    case 'all-actions':
        queryAll($pdo, 'action');
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
}