<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/users.php';

$db = new connection();
$dbConn = $db->dbConnect();

$users = new users($dbConn);

$result = $users->getAllUsers();

if (!empty($result)) {
    $dataArr = [];
    $dataArr['data'] = array();

    $resultArr = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultArr as $r) {
        $u_data = array("user_id" => $r['user_id'], "user_name" => $r['user_name'], "user_email" => $r['user_email'],
        "user_password" => $r['user_password'], "user_rol_id" => $r['user_rol_id'], 
        "user_created_at" => $r['user_created_at'], "rol_id" => $r['rol_id'], "rol_name" => $r['rol_name']);

        array_push($dataArr['data'], $u_data);
    }

    echo json_encode($dataArr);
}else{
    echo json_encode(array("msg" => false));
}
