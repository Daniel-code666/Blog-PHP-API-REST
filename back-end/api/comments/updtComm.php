<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comment = new comments($dbConn);

$data = json_decode(file_get_contents("php://input"));

$comment->comm_id = $data->comm_id;
$comment->comm_estate =  $data->comm_estate;

if($comment->updtComm()){
    echo json_encode(array("msg" => true));
}else{
    echo json_encode(array("msg" => false));
}