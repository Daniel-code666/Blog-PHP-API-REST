<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/users.php';

$db = new connection();
$dbConn = $db->dbConnect();

$user = new users($dbConn);

$data = json_decode(file_get_contents("php://input"));

$user->user_name = $data->user_name;
$user->user_email = $data->user_email;
$user->user_password = md5($data->user_password);

if ($user->createUser()) {
    echo json_encode(array("msg" => true));
}else{
    echo json_encode(array("msg" => false));
}
