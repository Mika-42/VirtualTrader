<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=VirtualTrader", "root", "");

function player_registered() : bool
{
    global $pdo;
    $email = $_POST["email"];

    $query = "SELECT id, password FROM Player WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    $ret = $stmt->rowCount() > 0;
    if(!$ret) return false;

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST["password"], $data["password"]))
    {
        $_SESSION['id'] = $data['id'];
        return true;
    }

    return false;
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

function get_logged_date(): string
{
    global $pdo;
    $query = "SELECT gameDate FROM player WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data['gameDate'];
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

function get_id_sort_actions_by_evolution(): array
{
    global $pdo;
    $query = "SELECT code FROM action ORDER BY evolution";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_id_sort_actions_by_name() : array
{
    global $pdo;
    $query = "SELECT code FROM action ORDER BY name";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_id_sort_actions_by_value(): array
{
    global $pdo;
    $query = "SELECT code FROM action ORDER BY value DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_all_players_by_wallet(): array
{
    global $pdo;
    $query = "SELECT player.*, IFNULL(SUM(action.value), 0) + player.balance AS totalWallet 
            FROM player 
            LEFT JOIN action ON (action.code, player.id) IN (SELECT actionCode, playerId FROM ownby) 
            GROUP BY player.id 
            ORDER BY totalWallet DESC 
            LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_logged_month_as_number(): int
{
    global $pdo;
    $query = "SELECT MONTH(gameDate) AS month FROM player WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['month'];
}

function get_logged_action_code(): array
{
    global $pdo;
    $query = "SELECT actionCode FROM ownby WHERE playerId = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buy_action($action_code) : bool
{
    global $pdo;
    $total_wallet = get_logged_total_wallet();

    $action_value = get_action_value($action_code);

    $can_be_buy =$total_wallet >= $action_value;
    if($can_be_buy)
    {
        $new_balance = get_logged_balance() - $action_value;

        $query = "UPDATE player SET balance = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$new_balance,$_SESSION['id']]);

        $query = "INSERT IGNORE INTO ownby(actionCode, playerId) VALUES(?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$action_code, $_SESSION['id']]);
    }
    return $can_be_buy;
}
function sell_action($action_code) : void
{
    global $pdo;

    $new_balance = get_logged_balance() + get_action_value($action_code);

    $query = "UPDATE player SET balance = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$new_balance,$_SESSION['id']]);

    $query = "DELETE FROM ownby WHERE actionCode = ? AND playerId = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$action_code, $_SESSION['id']]);
}

function updateActionPrice(float $currentPrice, float $previousVariation): array {

    // Étape 1 : Générer un décalage aléatoire entre -3 et +3
    $delta = rand(-300, 300) / 100.0;

    // Étape 2 : Appliquer au pourcentage précédent
    $newVariation = $previousVariation + $delta;

    // Étape 3 : Forcer la variation dans les bornes [-10%, +10%]
    $newVariation = max(-10.0, min(10.0, $newVariation));

    $krach = (rand(100, 10000) / 100.0) <= 3.5;
    if($krach)
    {
        $newVariation = rand(-2000, -3000) / 100.0;
    }

    // Étape 4 : Calcul du nouveau prix
    $newPrice = $currentPrice * (1 + $newVariation / 100.0);

    // Étape 5 : Ne jamais descendre sous 1€
    $newPrice = max(1, $newPrice);


    if($newPrice > 1000000)
    {
        $newPrice =  $currentPrice;
    }

    return [
        'new_price' => round($newPrice, 2),
        'new_variation' => round($newVariation, 2)
    ];
}

function update_actions(): array
{
    global $pdo;
    $query = "SELECT * FROM action";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $d) {

        $new = updateActionPrice($d['value'], $d['evolution']);
        $query = "UPDATE action SET value = ?, evolution = ? WHERE code = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$new['new_price'], $new['new_variation'], $d['code']]);
    }

    return $data;
}

/**
 * @throws DateMalformedStringException
 */
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
function reset_logged (): void
{
    global $pdo;
    $query = "UPDATE player SET balance = DEFAULT, gameDate = DEFAULT WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);

    $query = "DELETE FROM ownby WHERE playerId = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);

    $query = "UPDATE action SET value = default_value, evolution = default_evolution WHERE TRUE";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

}