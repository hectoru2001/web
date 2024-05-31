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
                        <h5 class="card-title">Ver lista de clientes</h5>
                        <p class="card-text">Revisa información de cada uno de los clientes.</p>
                        <img src="includes/img/ver.png" class="images-main" alt="">
                        <a href="funcMain/clientList.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ver estatus de pedidos</h5>
                        <p class="card-text">Revisa el estatus de los pedidos actualmente.</p>
                        <img src="includes/img/camion-de-carga.png" class="images-main" alt="">
                        <a href="funcMain/logisticaPedidos.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        </div>


</div>

<!-- Incluir Bootstrap JS (jQuery necesario) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
