<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/articles.php';

$db = new connection();
$dbConn = $db->dbconnect();

$article = new articles($dbConn);

$article->art_id = isset($_GET['art_id']) ? $_GET['art_id'] : die();

$article->getSingleArticle();

if(!empty($article->art_name)){
    echo json_encode(array('data'=>array('art_id' => $article->art_id, 'art_name' => $article->art_name, 
        'art_desc' => $article->art_desc, 'art_img' => $article->art_img)));
}else{
    echo json_encode(array('msg' => false));
}


