<?php 
include("../includes/header.php"); 

if (empty($_SESSION["active"]) && $_SESSION['user_rol_id'] != 1) {
    header("Location: http://localhost:8080/Cosas/blog_api/front-end/index.php");
    exit();
}

$comm_id = $_GET['comm_id'];

$response = file_get_contents('http://localhost:8080/Cosas/blog_api/back-end/api/comments/getSingleComm.php?comm_id=' . $comm_id); 

$response = json_decode($response);

?>

<div class="row">

</div>

<div class="row">
    <div class="col-sm-6">
        <h3>Editar Comentario</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form method="POST" id="updtCommForm" action="">

            <input type="hidden" name="comm_id" value="<?php echo $response->data->comm_id ?>">

            <div class="mb-3">
                <label for="texto">Texto</label>
                <input readonly class="form-control" placeholder="Descripción" name="texto" 
                value="<?php echo $response->data->comm_text; ?>">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" value="<?php echo $response->data->user_email; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="cambiarEstado" class="form-label">Cambiar estado:</label>
                <select class="form-select" name="cambiarEstado" aria-label="Default select example">
                    <?php if($response->data->comm_estate == 1) : ?>
                        <option value="1" selected>Aprobado</option>
                        <option value="0">Pendiente</option>
                    <?php else : ?>
                        <option value="1">Aprobado</option>
                        <option value="0" selected>Pendiente</option>
                    <?php endif; ?>
                </select>
            </div>

            <br />
            <button type="submit" name="editarComentario" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Comentario</button>
        </form>
    </div>
</div>
<?php include("../includes/footer.php") ?>
<script src="../dist/comments.js"></script>