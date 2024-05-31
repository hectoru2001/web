<?php
// Verificar si el usuario se autenticó correctamente (por ejemplo, después de verificar credenciales)
$nombreUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/favicon.ico">

</head>
</head>
<body>
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light" style="margin-bottom: 20px; ">
        <a class="navbar-brand" href="/AppFMTZ/main.php">
            <img src="/AppFMTZ/includes/img/logo.png" width="100" height="70" class="d-inline-block align-top" alt="">
            
        </a>

        <!-- Elementos de la barra de navegación en la derecha -->
        <ul class="navbar-nav">
            <!-- Nombre del Usuario -->
            <li class="nav-item">
                <span class="navbar-text">
                <strong><?php echo $nombreUsuario; ?></strong>
                </span>
            </li>
            <!-- Opción de Cerrar Sesión -->
            <li class="nav-item">
                <a class="nav-link" href="/AppFMTZ/functions/cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
        </nav>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>