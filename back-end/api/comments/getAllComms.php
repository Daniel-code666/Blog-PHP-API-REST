<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comments = new comments($dbConn);

$result = $comments->getAllComms();

if (!empty($result)) {
    $dataArr = [];
    $dataArr['data'] = array();

    $resultArr = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach($resultArr as $r){
        $commData = array("comm_id" => $r['comm_id'], "comm_text" => $r['comm_text'],
        "comm_estate" => $r['comm_estate'], "comm_created_at" => $r['comm_created_at'], "user_id" => $r['user_id'], 
        "user_name" => $r['user_name'], "user_email" => $r['user_email'], "user_rol_id" => $r['user_rol_id'],
        "art_id" => $r['art_id'], "art_name" => $r['art_name'], "art_desc" => $r['art_desc'], 
        "art_img" => $r['art_img']);
        
        array_push($dataArr['data'], $commData);
    }

    echo json_encode($dataArr);
}else{
    echo json_encode(array("msg" => false));
}
