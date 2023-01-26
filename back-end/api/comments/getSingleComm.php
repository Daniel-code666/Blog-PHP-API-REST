<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comment = new comments($dbConn);

$comment->comm_id = isset($_GET['comm_id']) ? $_GET['comm_id'] : die();

$comment->getSingleComm();

if(!empty($comment->comm_text)){
    echo json_encode(array("data" => array("comm_id" => $comment->comm_id, "comm_text" => $comment->comm_text,
        "user_email" => $comment->comm_user_email, "user_id" => $comment->comm_user_id, 
        "comm_estate" => $comment->comm_estate)));
}else{
    echo json_encode(array("msg" => false));
}