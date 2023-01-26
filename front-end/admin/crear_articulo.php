<?php 
include("../includes/header.php"); 

if (empty($_SESSION["active"]) && $_SESSION['user_rol_id'] != 1) {
    header("Location: http://localhost:8080/Cosas/blog_api/front-end/index.php");
    exit();
}

?>

<div class="row">

</div>

<div class="row">
    <div class="col-sm-6">
        <h3>Crear un Nuevo Artículo</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form id="createArtForm" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresa el título">
            </div>
            <div class="mb-3">
                <label for="texto">Descripción</label>
                <input type="text" class="form-control" name="texto" id="texto" placeholder="Ingrese descripción">
                <!-- <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto"
                style="height: 200px"></textarea> -->
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Selecciona una imagen">
            </div>
            <br />
            <button type="submit" name="crearArticulo" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Artículo</button>
        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>

<script src="../dist/articles.js"></script>