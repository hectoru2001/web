<?php
// Verificar si se recibió el parámetro 'clave' y 'accion' por POST
if (isset($_POST['clave']) && isset($_POST['accion'])) {
    $clave = $_POST['clave'];
    $accion = $_POST['accion'];

    // Incluir archivo de conexión
    require_once('../../functions/conection.php');

    // Preparar y ejecutar la consulta de actualización
    if ($accion === 'desactivar') {
        $sql = "UPDATE Clientes SET PermitirEditarFactura = 1 WHERE Clave = ?";
    } elseif ($accion === 'activar') {
        $sql = "UPDATE Clientes SET PermitirEditarFactura = 0 WHERE Clave = ?";
    }

    $params = array($clave);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores de preparación
    }

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores de ejecución
    }

    // Redirigir a la página principal u otra página después de la actualización
    header('Location: ../editClient.php'); // Cambia 'index.php' al nombre de tu página principal
    exit;
} else {
    // Si no se recibieron los parámetros esperados, redirigir o mostrar un mensaje de error
    header('Location: error.php'); // Cambia 'error.php' a la página de error correspondiente
    exit;
}
?>
