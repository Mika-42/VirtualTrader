<?php
include("db_connexion.php");

$data = [];

$query = "SELECT * FROM action";
$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0){

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);

}