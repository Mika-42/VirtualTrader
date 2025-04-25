<?php
include('index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] = 'LOGOUT') {
        session_destroy();
        header('Location: log-in.html');
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] = 'RESET') {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $query = "a faire par francois (donner a reset)";

            mysqli_query($connect,$query);
            session_destroy();
            header('location: menu.html', true, 307);
            exit();
        }
    }
    if (isset($_POST['action']) && $_POST['action'] = 'CONTINUE') {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $query = "a faire par francois (donner a choper)";

            $result=mysqli_query($connect,$query);
            if(mysqli_num_rows($result) > 0) {
                session_destroy();
                header('location: menu.html', true, 307);
            }
        }
    }
}
