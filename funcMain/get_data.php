<?php// get_data.php

require_once('../functions/conection.php');
require_once('sql/query.php');
require_once('your_existing_php_file_with_function.php'); // Reemplaza con el nombre real del archivo que contiene tu función obtenerEstatusOptimoRoute

// Procesar la búsqueda si se envió el formulario
if (isset($_GET['searchPedido'])) {
    $searchPedido = $_GET['searchPedido'];

    // Consulta SQL filtrada por número de pedido
    $sqlFiltered = "SELECT P.Pedido, P.Fecha, P.Autor, P.Cliente, P.RazonSocial, P.Referencia, P.Estatus FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido WHERE P.Pedido LIKE '%$searchPedido%' ORDER BY P.Pedido DESC";
    $stmtbtsis = Query::ejecutar($sqlFiltered);
} else {
    // Obtener la consulta inicial de los últimos 100 pedidos
    $stmtbtsis = Query::ejecutar("SELECT TOP 5 P.Pedido, P.Fecha, P.Autor, P.Cliente, P.RazonSocial, P.Referencia, P.Estatus FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido ORDER BY P.Pedido DESC");
}

$pedidos = [];
while ($row = sqlsrv_fetch_array($stmtbtsis, SQLSRV_FETCH_ASSOC)) {
    $estatusOptimoRoute = obtenerEstatusOptimoRoute($row['Pedido']);
    $pedido = [
        'Pedido' => $row['Pedido'],
        'EstatusOptimoRoute' => $estatusOptimoRoute,
    ];
    $pedidos[] = $pedido;
}

// Enviar los datos como JSON
echo json_encode($pedidos);
?>