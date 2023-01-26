<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comments = new comments($dbConn);

$comments->comm_art_id = isset($_GET['comm_art_id']) ? $_GET['comm_art_id'] : die();

$result = $comments->getCommByArt();

if(!empty($result)){
    $dataArr = [];
    $dataArr['data'] = array();

    $resultArr = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach($resultArr as $r){
        $commData = array("comm_id" => $r['comm_id'], "comm_text" => $r['comm_text'],
        "comm_estate" => $r['comm_estate'], "comm_created_at" => $r['comm_created_at'], "user_id" => $r['user_id'], 
        "user_name" => $r['user_name'], "user_email" => $r['user_email'], "user_rol_id" => $r['user_rol_id']);
        
        array_push($dataArr['data'], $commData);
    }

    echo json_encode($dataArr);
} else {
    echo json_encode(array("msg" => false));
}