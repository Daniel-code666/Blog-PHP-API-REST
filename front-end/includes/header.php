<?php
session_start();

include 'C:\xampp\htdocs\Cosas\blog_api\back-end\config\conn.php';
include 'C:\xampp\htdocs\Cosas\blog_api\back-end\config\config_routes.php';
include 'C:\xampp\htdocs\Cosas\blog_api\back-end\helpers\format_helper.php';
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/bootstrap-icons-1.2.1/font/bootstrap-icons.css">

    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/estilos.css">

    <title>Blog PHP 8</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo FRONT_ROUTE; ?>">Blog PHP 8</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (!empty($_SESSION['active']) && $_SESSION['user_rol_id'] == 1) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?php echo ADMIN_ROUTE; ?>articulos.php">Artículos</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo ADMIN_ROUTE; ?>comentarios.php">Comentarios</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_ROUTE; ?>usuarios.php">Usuarios</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROUTE; ?>">Inicio</a>
                    </li>
                    <?php if (empty($_SESSION['active'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo FRONT_ROUTE; ?>registro.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo FRONT_ROUTE; ?>acceder.php">Acceder</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <?php if (!empty($_SESSION['active'])) : ?>
                    <li class="nav-item">
                        <p class="text-white mt-2"><i class="bi bi-person-circle"></i> </p>
                    </li>
                    <a class="nav-link" href="<?php echo FRONT_ROUTE; ?>salir.php">Salir</a>
                <?php endif; ?>
                </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container mt-5 caja">