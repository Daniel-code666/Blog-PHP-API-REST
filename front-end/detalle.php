<?php
include("includes/header_front.php");

$art_id = $_GET['art_id'];

$response = file_get_contents('http://localhost:8080/Cosas/blog_api/back-end/api/articles/getSingleArticle.php?art_id=' . $art_id);

$response = json_decode($response);

$response2 = file_get_contents('http://localhost:8080/Cosas/blog_api/back-end/api/comments/getCommByArt.php?comm_art_id=' . $art_id);

$response2 = json_decode($response2);

?>

<div class="row">

</div>

<div class="container-fluid">

    <div class="row">

        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1><?php echo $response->data->art_name; ?></h1>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid img-thumbnail" src="img/articulos/<?php echo $response->data->art_img; ?>">
                    </div>

                    <p><?php echo $response->data->art_desc; ?></p>

                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($_SESSION['active'])) : ?>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <form method="POST" id="commentForm" action="">
                    <input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['user_email']; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" style="height: 200px"></textarea>
                    </div>

                    <br />
                    <button type="submit" name="enviarComentario" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Comentario</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <h3 class="text-center mt-5">Comentarios</h3>

    <?php foreach ($response2 as $res) : ?>
        <?php foreach ($res as $r) : ?>
            <h4><i class="bi bi-person-circle"></i><?php echo $r->user_email; ?></h4>
            <h5><?php echo formatDate($r->comm_created_at); ?></h5>
            <p><?php echo $r->comm_text; ?></p>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

</div>
<?php include("includes/footer.php") ?>
<script src="dist/details.js"></script>