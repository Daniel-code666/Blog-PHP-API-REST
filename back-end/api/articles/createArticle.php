<?php
include '../headers.php';
include '../../config/conn.php';
include '../../models/articles.php';

$valid_extensions = array('jpeg', 'jpg', 'png');

$path = 'C:\xampp\htdocs\Cosas\blog_api\front-end\img\articulos\\';

if (!empty($_FILES['imagen'])) {
    $img = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];

    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $final_image = rand(1000, 1000000) . $img;

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);

        if (move_uploaded_file($tmp, $path)) {
            $db = new connection();
            $dbConn = $db->dbconnect();

            $article = new articles($dbConn);

            $article->art_name = $_POST['titulo'];
            $article->art_desc = $_POST['texto'];
            $article->art_img = $final_image;

            if ($article->createArticle()) {
                echo json_encode(array("msg" => true));
            } else {
                echo json_encode(array("msg" => false));
            }
        }
    }
} else {
    $db = new connection();
    $dbConn = $db->dbconnect();

    $article = new articles($dbConn);

    $article->art_name = $_POST['titulo'];
    $article->art_desc = $_POST['texto'];
    $article->art_img = "";

    if ($article->createArticle()) {
        echo json_encode(array("msg" => true));
    } else {
        echo json_encode(array("msg" => false));
    }
}



// $data = $_POST['titulo'];
// $oData = $_POST['texto'];

// $img = $_FILES['imagen']['name'];
// $tmp = $_FILES['imagen']['tmp_name'];

// echo json_encode(array("msg" => true, "data" => $img));


// $data = json_decode(file_get_contents("php://input"));

// $article->art_name = $data->art_name;
// $article->art_desc = $data->art_desc;
// $article->art_img = $data->art_img;

// if($article->createArticle()){
//     echo json_encode(array("msg"=>true));
// }else{
//     echo json_encode(array("msg"=>false));
// }