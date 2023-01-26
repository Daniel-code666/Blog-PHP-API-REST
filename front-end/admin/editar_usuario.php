<?php 
include("../includes/header.php"); 

if (empty($_SESSION["active"]) && $_SESSION['user_rol_id'] != 1) {
    header("Location: http://localhost:8080/Cosas/blog_api/front-end/index.php");
    exit();
}

$user_id = $_GET["user_id"];

$response = file_get_contents('http://localhost:8080/Cosas/blog_api/back-end/api/users/getSingleUser.php?user_id=' . $user_id);

$response = json_decode($response);
?>


<div class="row">
    <div class="col-sm-6">
        <h3>Editar Usuario</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form id="updtUserForm" >

            <input type="hidden" name="user_id" value="<?php echo $response->data->user_id; ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" 
                placeholder="Ingresa el nombre" value="<?php echo $response->data->user_name; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa el email" 
                value="<?php echo $response->data->user_email; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" aria-label="Default select example" name="rol">
                    <?php if($response->data->user_rol_id == 1) : ?>
                        <option value="1" selected>Administrador</option>
                        <option value="2">Registrado</option>
                    <?php else : ?>
                        <option value="1">Administrador</option>
                        <option value="2" selected>Registrado</option>
                    <?php endif; ?>
                </select>
            </div>

            <br />
            <button type="submit" name="editarUsuario" class="btn btn-success float-left">
                <i class="bi bi-person-bounding-box"></i> 
                Editar Usuario
            </button>
        </form>
    </div>
</div>
<?php include("../includes/footer.php") ?>
<script src="../dist/users.js"></script>