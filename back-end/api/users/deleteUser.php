<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/users.php';

$db = new connection();
$dbConn = $db->dbConnect();

$users = new users($dbConn);

$users->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die(); 

if ($users->deleteUser()) {
    echo json_encode(array("msg" => true));
} else {
    echo json_encode(array("msg" => false));
}
