<?php
// api_request.php

// URL del endpoint de la API
$url = 'https://api.optimoroute.com/v1/?key=4609bb55327f8a6aa0e4b1b85da81732YRUP6NDuFkw&d';

// Inicializar cURL
$ch = curl_init($url);

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer 44194cee9c7df7d91403c34915ef18fbX4pc1YP9plQ',
    'Content-Type: application/json'
]);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Comprobar si hay errores
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die('Error en la solicitud: ' . $error);
}

// Cerrar cURL
curl_close($ch);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Comprobar si la decodificación fue exitosa
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error al decodificar JSON: ' . json_last_error_msg());
}

// Pasar los datos a una variable para usarlos en HTML
$result = $data;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la API</title>
</head>
<body>
    <h1>Resultado de la API</h1>
    <pre>
        <?php
        // Mostrar los datos en formato legible
        print_r($result);
        ?>
    </pre>
</body>
</html>
