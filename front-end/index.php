<?php

include("includes/header_front.php");

$response = file_get_contents("http://localhost:8080/Cosas/blog_api/back-end/api/articles/getAllArticles.php");

$response = json_decode($response);
?>

<div class="container-fluid">
    <h1 class="text-center">Artículos</h1>
    <div class="row">

        <?php foreach ($response as $art) : ?>
            <?php foreach ($art as $a) : ?>
                <div class="col-sm-4">
                    <div class="card">
                        <img src="../front-end/img/articulos/<?php echo $a->art_img; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $a->art_name; ?></h5>
                            <p><strong><?php echo formatDate($a->created_at); ?></strong></p>
                            <p class="card-text"><?php echo cutText($a->art_desc); ?></p>
                            <a href="detalle.php?art_id=<?php echo $a->art_id; ?>" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php include("includes/footer.php") ?>