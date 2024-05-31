<?php
// submit_update.php

// Obtener el contenido del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si hay datos y si están en el formato esperado
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error al decodificar JSON: ' . json_last_error_msg());
}

$updates = $data['updates'];

// Aquí puedes procesar los datos, por ejemplo, enviarlos a otra API
// Ejemplo de cómo se puede enviar la solicitud a otra API
$url = 'https://api.optimoroute.com/v1/update_completion_details?key=4609bb55327f8a6aa0e4b1b85da81732YRUP6NDuFkw';

// Inicializar cURL
$ch = curl_init($url);

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer 44194cee9c7df7d91403c34915ef18fbX4pc1YP9plQ',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Comprobar si hay errores en la solicitud
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die('Error en la solicitud: ' . $error);
}

// Cerrar cURL
curl_close($ch);

// Devolver la respuesta
header('Content-Type: application/json');
echo $response;
?>
