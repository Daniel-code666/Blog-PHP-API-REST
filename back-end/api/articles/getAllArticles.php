<?php

include '../headers.php';
include '../../config/conn.php';
include '../../models/articles.php';

$db = new connection();
$dbConn = $db->dbConnect();

$articles = new articles($dbConn);

$result = $articles->getAllArticles();

if(!empty($result)){
    $dataArr = [];
    $dataArr['data'] = array();

    $resultArr = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach($resultArr as $r){
        $art_data = array('art_id' => $r['art_id'], 'art_name' => $r['art_name'], 
        'art_desc' => $r['art_desc'], 'art_img' => $r['art_img'], 'created_at' => $r['created_at']);

        array_push($dataArr['data'], $art_data);
    }
    echo json_encode($dataArr);
}else{
    echo json_encode(array('msg' => false));
}


