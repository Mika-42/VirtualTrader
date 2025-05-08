<?php
include 'interface.php';

header('Content-Type: application/json');

$action = $_GET['action'];

switch ($action) {
    case 'init':

        $logged = [
            'username' => get_logged_username(),
            'date' => get_logged_date(),
            'actions' => update_actions(),
            'wallet' => get_logged_total_wallet(),
        ];

        echo json_encode($logged);
        break;

    case 'daily_update':
        $logged = [
            'username' => get_logged_username(),
            'date' => update_logged_date(),
            'actions' => update_actions(),
            'wallet' => get_logged_total_wallet(),
        ];
        echo json_encode($logged);
        break;

    case 'sell':
        sell_action($_GET['action_code']);
        echo json_encode(['wallet' => get_logged_total_wallet()]);
        break;

    case 'buy':
        $logged = [
            'can_be_buy' => buy_action($_GET['action_code']),
            'wallet' => get_logged_total_wallet()
            ]
        ;
        echo json_encode($logged);
        break;

    default:
}