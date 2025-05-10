<?php
include 'interface.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? 'action is not set properly';

switch ($action) {
    case 'init':

        $logged = [
            'username' => get_logged_username(),
            'date' => get_logged_date(),
            'actions' => update_actions(),
            'wallet' => get_logged_total_wallet(),
            'players' => get_all_players_by_wallet(),
            'month' => get_logged_month_as_number(),
            'owned' => get_logged_action_code(),
            'id' => $_SESSION['id']
        ];

        echo json_encode($logged);
        break;

    case 'daily_update':
        try {
            $logged = [
                'username' => get_logged_username(),
                'date' => update_logged_date(),
                'actions' => update_actions(),
                'wallet' => get_logged_total_wallet(),
                'players' => get_all_players_by_wallet(),
                'month' => get_logged_month_as_number(),
                'id' => $_SESSION['id']
            ];
            echo json_encode($logged);
        } catch (DateMalformedStringException $e) {
            echo json_encode($e);
        }

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

    case 'filter_by_name': echo json_encode(get_id_sort_actions_by_name()); break;
    case 'filter_by_value': echo json_encode(get_id_sort_actions_by_value()); break;
    case 'filter_by_evolution': echo json_encode(get_id_sort_actions_by_evolution()); break;

    default:
        echo json_encode(['error' => 'Unknown action']);
}