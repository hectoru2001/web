<?php
// Incluir el archivo de conexión
require_once('../../functions/conection.php');

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$fecha = new DateTime($_POST['fecha']); // Convertir la fecha a objeto DateTime
$fechaFormateada = $fecha->format('Y-m-d H:i:s'); // Formatear la fecha
$descripcionProblema = $_POST['descripcionProblema'];
$solucion = $_POST['solucion'];

// Consulta SQL para insertar el nuevo ticket en la base de datos
$sql = "INSERT INTO bitacora_sistemas (usuario, fecha, descripcion, solucion) VALUES (?, ?, ?, ?)";
$params = array($usuario, $fechaFormateada, $descripcionProblema, $solucion);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    header('Location: ../bitSistemas.php');
}

// Cerrar la conexión
sqlsrv_close($conn);
?>
