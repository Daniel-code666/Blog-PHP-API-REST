<?php
include("../includes/header.php");

if (empty($_SESSION["active"]) && $_SESSION['user_rol_id'] != 1) {
    header("Location: http://localhost:8080/Cosas/blog_api/front-end/index.php");
    exit();
}

$art_id = $_GET['art_id'];

$response = file_get_contents('http://localhost:8080/Cosas/blog_api/back-end/api/articles/getSingleArticle.php?art_id=' . $art_id);

$response = json_decode($response);

?>

<div class="row">

</div>

<div class="row">
    <div class="col-sm-6">
        <h3>Editar Artículo</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form id="editArtForm" entype="multipart/form-data">

            <input type="hidden" name="art_id" value="<?php echo $response->data->art_id; ?>">

            <input type="hidden" name="oldImg" value="<?php echo $response->data->art_img;?>">

            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $response->data->art_name; ?>">
            </div>

            <div class="mb-3">
                <img class="img-fluid img-thumbnail" src="../img/articulos/<?php echo $response->data->art_img; ?>">
            </div>

            <div class="mb-3">
                <label for="texto">Descripción</label>
                <input type="text" class="form-control" name="texto" id="texto" placeholder="Ingrese descripción"
                value="<?php echo $response->data->art_desc ?>">
                <!-- <label for="texto">Texto</label>
                <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto" style="height: 200px" value="<?php echo $response->data->art_desc ?>">
                <?php echo $response->data->art_desc ?>
                </textarea> -->
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Selecciona una imagen">
            </div>
            <br />
            <button type="submit" name="editarArticulo" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Artículo</button>
    </div>
</div>

<?php include("../includes/footer.php") ?>

<script src="../dist/articles.js"></script>