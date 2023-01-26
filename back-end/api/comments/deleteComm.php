<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/comments.php';

$db = new connection();
$dbConn = $db->dbConnect();

$comments = new comments($dbConn);

$comments->comm_id = isset($_GET['comm_id']) ? $_GET['comm_id'] : die();

if($comments->deleteComm()){
    echo json_encode(array("msg"=>true));
}else{
    echo json_encode(array("msg"=>false));
}