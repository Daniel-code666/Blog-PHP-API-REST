<?php

session_start();

include '../headers.php';
include '../../config/conn.php';
include '../../models/users.php';

$db = new connection();
$dbConn = $db->dbConnect();

$user = new users($dbConn);

$data = json_decode(file_get_contents("php://input"));

$user->user_email = $data->user_email;
$user->user_password = md5($data->user_password);

if ($user->login()) {
    $_SESSION['active'] = true;
    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['user_email'] = $user->user_email;
    $_SESSION['user_name'] = $user->user_name;
    $_SESSION['user_rol_id'] = $user->user_rol_id;
    $_SESSION['rol_name'] = $user->rol_name;

    echo json_encode(array("msg" => true));
} else {
    echo json_encode(array("msg" => false));
}
