<?php
include("../includes/header.php");

if (empty($_SESSION["active"]) && $_SESSION['user_rol_id'] != 1) {
    header("Location: http://localhost:8080/Cosas/blog_api/front-end/index.php");
    exit();
}

$response = file_get_contents("http://localhost:8080/Cosas/blog_api/back-end/api/comments/getAllComms.php");

$response = json_decode($response);

?>

<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Comentarios</h3>
    </div>
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
        <table id="tblContactos" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comentario</th>
                    <th>Usuario</th>
                    <th>Artículo</th>
                    <th>Estado</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($response as $r) : ?>
                    <?php foreach ($r as $f) : ?>
                        <tr>
                            <td><?php echo $f->comm_id; ?></td>
                            <td><?php echo $f->comm_text; ?></td>
                            <td><?php echo $f->user_email; ?></td>
                            <td><?php echo $f->art_name; ?></td>
                            <?php if ($f->comm_estate == 0) : ?>
                                <td>Pendiente</td>
                            <?php else : ?>
                                <td>Aprobado</td>
                            <?php endif; ?>
                            <td><?php echo $f->comm_created_at; ?></td>
                            <td>
                                <a href="<?php echo ADMIN_ROUTE; ?>editar_comentario.php?comm_id=<?php echo $f->comm_id; ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                    Editar
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" id="delBtn" name="delBtn" onclick="getData(<?php echo $f->comm_id; ?>);">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("../includes/footer.php") ?>

<script>
    function getData(x) {
        var r = confirm("¿Eliminar?");
        if (r == true) {
            $.ajax({
                type: "DELETE",
                url: "http://localhost:8080/Cosas/blog_api/back-end/api/comments/deleteComm.php?comm_id=" + x,
                success: function(res) {
                    if (res.msg) {
                        window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/comentarios.php")
                    } else {
                        $('#mensajes').html("Hubo un error");
                    }
                },
                error: function() {
                    alert("error")
                }
            })
        }
    }

    $(document).ready(function() {
        $('#tblContactos').DataTable();
    });
</script>