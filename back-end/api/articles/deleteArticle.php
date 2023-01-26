<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/articles.php';

$db = new connection();
$dbConn = $db->dbconnect();

$article = new articles($dbConn);

$article->art_id = isset($_GET['art_id']) ? $_GET['art_id'] : die();

if($article->deleteArticle()){
    echo json_encode(array("msg"=>true));
}else{
    echo json_encode(array("msg" => false));
}