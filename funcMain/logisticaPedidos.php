<?php
// Incluir el archivo de conexión
require_once('../functions/conection.php');
require_once('sql/query.php');

// Función para obtener el estatus de Optimo Route
function obtenerEstatusOptimoRoute($orderNo) {
    $url = "https://api.optimoroute.com/v1/get_completion_details?key=4609bb55327f8a6aa0e4b1b85da81732YRUP6NDuFkw&orderNo=" . urlencode($orderNo);

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($ch);

    // Comprobar si hay errores en la solicitud
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Error en la solicitud: " . $error;
    }

    // Cerrar cURL
    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Comprobar si hay errores en la decodificación JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        return 'Error al decodificar JSON: ' . json_last_error_msg();
    }

    // Verificar si la respuesta tiene éxito y extraer el estatus
    if (isset($data['success']) && $data['success'] && isset($data['orders'][0]['success']) && $data['orders'][0]['success']) {
        return $data['orders'][0]['data']['status'] ?? 'No disponible';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Control de pedidos</title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/estilos.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <?php require_once('../includes/headers/header.php'); ?>

    <div class="container">
        <!-- Formulario de búsqueda de pedidos -->
        <form method="GET" action="">
            <div class="form-group">
                <label for="searchPedido">Buscar Pedido:</label>
                <input type="text" class="form-control" id="searchPedido" name="searchPedido" placeholder="Ingrese número de pedido">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
    
        </form>
    </div> 

    <!-- Tabla -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No. Pedido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Autor</th>
                <th scope="col">Cliente</th>
                <th scope="col">Razón social</th>
                <th scope="col">Referencia</th>
                <th scope="col">Estatus</th>
                <th scope="col">Estatus Optimo Route</th>



            </tr>
        </thead>
        <tbody class="table-group-divider table-divider-color" id="dataTableBody1">
        <?php

            // Obtener la consulta inicial de los últimos 100 pedidos
            $stmtbtsis = Query::ejecutar("SELECT TOP 5 * FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido ORDER BY P.Pedido DESC");

            // Procesar la búsqueda si se envió el formulario
            if (isset($_GET['searchPedido'])) {
                $searchPedido = $_GET['searchPedido'];

                // Consulta SQL filtrada por número de pedido
                $sqlFiltered = "SELECT * FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido WHERE P.Pedido LIKE '%$searchPedido%' ORDER BY P.Pedido DESC";
                $stmtbtsis = Query::ejecutar($sqlFiltered);
            }
            while ($row = sqlsrv_fetch_array($stmtbtsis, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Pedido'] . "</td>";

                // Formatear la fecha como una cadena legible (ejemplo: YYYY-MM-DD)
                $fechaFormateada = $row['Fecha']->format('Y-m-d H:i:s');
                echo "<td>" . $fechaFormateada . "</td>";

                echo "<td>" . $row['Autor'] . "</td>";
                echo "<td>" . $row['Cliente'] . "</td>";
                echo "<td>" . $row['RazonSocial'] . "</td>";
                echo "<td>" . $row['Referencia'] . "</td>";
                echo "<td>";
                    
                    if ($row['Estatus'] == -1){
                        echo "Pausado"; 
                    } else if ($row['Estatus'] == 0) {
                        echo "Sin abrir";
                    } else if ($row['Estatus'] == 1) {
                        echo "Surtiendo";
                    } else if ($row['Estatus'] == 2){
                        echo "Checando"; 
                    } else if ($row['Estatus'] == 3){
                        echo "Facturando"; 
                    } else if ($row['Estatus'] == 4){
                        echo "Facturando"; 
                    } else {
                        echo $row['Estatus'];
                    }
                echo "</td>";

                // Obtener el estatus de Optimo Route y transformarlo directamente
                $estatusOptimoRoute = obtenerEstatusOptimoRoute($row['Pedido']);
                if ($estatusOptimoRoute == 'on_route') {
                    echo "<td>En ruta</td>";
                } elseif ($estatusOptimoRoute == 'scheduled') {
                    echo "<td>Programado</td>";
                } elseif ($estatusOptimoRoute == 'failed') {
                    echo "<td>Fallido</td>";
                } elseif ($estatusOptimoRoute == 'servicing') {
                    echo "<td>Sirviendo</td>";
                } elseif ($estatusOptimoRoute == 'success') {
                    echo "<td>Completado</td>";
                }else {
                    echo "<td>" . htmlspecialchars($estatusOptimoRoute) . "</td>";
                }

                echo "</tr>";
            }
        ?>

        </tbody>
    </table>
    </div>    
    
</body>
</html>

<?php
    // Liberar recursos y cerrar conexión a SQL Server
    sqlsrv_free_stmt($stmtbtsis);
    sqlsrv_close($conn);
?>