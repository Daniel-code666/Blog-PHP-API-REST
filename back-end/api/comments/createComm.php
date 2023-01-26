<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comment = new comments($dbConn);

$commData = json_decode(file_get_contents("php://input"));

$comment->comm_text = $commData->comm_text;
$comment->comm_art_id = $commData->art_id;
$comment->comm_user_id = $commData->user_id;

if($comment->createComm()){
    echo json_encode(array("msg" => true));
}else{
    echo json_encode(array("msg" => false));
}