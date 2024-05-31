<?php 
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - APP FMTZ</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="includes/estilos.css" rel="stylesheet">



</head>
<body>


<?php require_once('includes/headers/header.php'); ?>

<div class="container">
    <h1 class="text-center mb-4">Bienvenido, <?php echo isset($idUsuario) ? $idUsuario : ''; ?> </h1>

    <div class="container mt-5">
        <div class="row">
            <!-- Tarjeta 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Permitir editar factura</h5>
                        <p class="card-text">Activa o desactiva la opcion de editar facturas de los clientes.</p>
                        <img src="includes/img/user.png" class="images-main" alt="">
                        <a href="funcMain/editCLient.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bitácora de sistemas</h5>
                        <p class="card-text">Ingresa lo hecho en el transcurso del dia por el departamento.</p>
                        <img src="includes/img/notebook.png" class="images-main" alt="">
                        <a href="funcMain/bitSistemas.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Control de pedidos</h5>
                        <p class="card-text">Pausa, elimina, modifica, etc cualquiera de los pedidos en existencia.</p>
                        <img src="includes/img/trash.png" class="images-main" alt="">
                        <a href="funcMain/ctlPedidos.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 4 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Control de tarimas</h5>
                        <p class="card-text">Manipula cada una de las tarimas que conforman el proceso de los pedidos.</p>
                        <img src="includes/img/bascula.png" class="images-main" alt="">
                        <a href="funcMain/tarimasPedidos.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 5 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agenda de eventos</h5>
                        <p class="card-text">Maneja un calendario para programar eventos u ocasiones especiales.</p>
                        <img src="includes/img/calendario.png" class="images-main" alt="">
                        <a href="funcMain/calendar.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 5 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Control de mantenimientos</h5>
                        <p class="card-text">Maneja un calendario para programar mantenimientos, actualizaciones, etc.</p>
                        <img src="includes/img/mantenimiento.png" class="images-main" alt="">
                        <a href="funcMain/calMantenimientos.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <!-- Agregar más tarjetas según sea necesario -->
        </div>
</div>

<!-- Incluir Bootstrap JS (jQuery necesario) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
