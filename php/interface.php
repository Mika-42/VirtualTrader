<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");

function player_registered() : bool
{
    global$pdo;
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT id FROM Player WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email,$password]);

    $ret = $stmt->rowCount() > 0;
    if($ret)
    {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $data['id'];
    }
    return $ret;
}

function get_logged_username(): string
{
    global $pdo;
    $query = "SELECT username FROM player WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data['username'];
}

function get_logged_total_wallet(): float
{
    global $pdo;

    $query = "
    SELECT (SELECT balance FROM player WHERE id = ?) + IFNULL(SUM(action.value), 0) AS totalWallet
    FROM player, action
    WHERE player.id = ? AND (action.code, player.id) IN (SELECT * FROM ownBy);";

    $stmt = $pdo->prepare($query);

    $stmt->execute([$_SESSION['id'], $_SESSION['id']]);
    $total_wallet = $stmt->fetch(PDO::FETCH_ASSOC);
    return $total_wallet['totalWallet'];
}

function get_logged_balance() : float
{
    global $pdo;
    $query = "SELECT balance FROM player WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $logged_balance = $stmt->fetch(PDO::FETCH_ASSOC);
    return $logged_balance['balance'];
}

function get_action_value($action_code) : float
{
    global $pdo;
    $query = "SELECT value FROM action WHERE code = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$action_code]);
    $action_value = $stmt->fetch(PDO::FETCH_ASSOC);
    return $action_value['value'];
}

function buy_action($action_code) : void
{
    global $pdo;
    $total_wallet = get_logged_total_wallet();

    $action_value = get_action_value($action_code);

    if($total_wallet >= $action_value)
    {
        $new_balance = get_logged_balance() - $action_value;

        $query = "UPDATE player SET balance = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$new_balance,$_SESSION['id']]);
    }
}
function sell_action($action_code) : void
{
    global $pdo;

    $new_balance = get_logged_balance() + get_action_value($action_code);

    $query = "UPDATE player SET balance = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$new_balance,$_SESSION['id']]);

}

function update_actions(): array
{
    global $pdo;
    $query = "SELECT * FROM action";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $d) {
        $_min = max(-10, floor($d['evolution'] - 3));
        $_max = min(10, ceil($d['evolution'] + 3));
        $d['evolution'] = rand($_min * 100.0, $_max * 100.0) / 100.0;
        $d['value'] = max(round($d['value'] * (1 + $d['evolution'] / 100)), 1);

        $query = "UPDATE action SET value = ?, evolution = ? WHERE code = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$d['value'], $d['evolution'], $d['code']]);
    }

    return $data;
}

function update_logged_date(): string
{
    global $pdo;
    $query = "SELECT gameDate FROM player WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $date = new DateTime($data['gameDate']);
    $date->modify('+1 month');

    $query = "UPDATE player SET gameDate = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$date->format('Y-m-d'), $_SESSION['id']]);

    return $date->format('Y-m-d');
}
