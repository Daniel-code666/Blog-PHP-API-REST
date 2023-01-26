<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/users.php';

$db = new connection();
$dbConn = $db->dbConnect();

$user = new users($dbConn);

$user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

$user->getSingleUser();

if (!empty($user->user_name)) {
    echo json_encode(array("data" => array(
        "user_id" => $user->user_id, "user_name" => $user->user_name, "user_email" => $user->user_email,
        "user_rol_id" => $user->user_rol_id
    )));
} else {
    echo json_encode(array("msg" => false));
}
