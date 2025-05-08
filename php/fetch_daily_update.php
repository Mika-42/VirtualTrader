<?php
include 'interface.php';

$logged = [
    'username' => get_logged_username(),
    'date' => update_logged_date(),
    'actions' => update_actions(),
    'wallet' => get_logged_total_wallet(),
];

header('Content-Type: application/json');
echo json_encode($logged);