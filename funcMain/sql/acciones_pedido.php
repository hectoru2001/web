<?php
require_once('../../functions/conection.php');

class Query {
    public static function ejecutar($consulta, $parametros = []) {
        global $conn; // Obtener la conexión global

        // Preparar la consulta SQL
        $stmt = sqlsrv_prepare($conn, $consulta, $parametros);

        if (!$stmt) {
            die('Error al preparar la consulta.');
        }

        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);

        if ($result === false) {
            die('Error al ejecutar la consulta: ' . print_r(sqlsrv_errors(), true));
        }

        return $result;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de manera segura
    $pedido_id = isset($_POST['pedido_id']) ? $_POST['pedido_id'] : '';
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    // Realizar la acción según el valor del botón 'accion'
    switch ($accion) {
        case 'pausar':
            // Código para pausar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = -1 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'sinabrir':
            // Código para pausar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = 0 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'surtiendo':
            // Código para pausar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = 1 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'checando':
            // Código para reanudar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = 2 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'listo':
            // Código para reanudar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = 3 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'enviado':
            // Código para reanudar el pedido con $pedido_id
            if (!empty($pedido_id)) {
                Query::ejecutar("UPDATE Pedidos_Logistica SET Estatus = 4 WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }
            break;
        case 'eliminar':
            if (!empty($pedido_id)) {
                Query::ejecutar("DELETE Pedidos_Logistica WHERE Pedido = ?", [$pedido_id]);
                Query::ejecutar("DELETE Pedidos WHERE Pedido = ?", [$pedido_id]);
                Query::ejecutar("DELETE Pedidos_Detalles WHERE Pedido = ?", [$pedido_id]);
                header('Location: ../ctlPedidos.php'); // Redirigir después de realizar la acción
                exit;
            } else {
                echo "ID de pedido no válido.";
            }

        default:
            // Acción no válida
            echo "Acción no válida.";
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] == 'ver') {
    $pedidoId = $_POST['pedido_id'];
    $query = "SELECT * FROM Pedidos_Detalles WHERE Pedido = ?";
    $params = array($pedidoId);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row) {
        $fechaFormateada = $row['Fecha']->format('Y-m-d H:i:s');
        echo "<p><strong>No. Pedido:</strong> " . htmlspecialchars($row['Pedido']) . "</p>";
        echo "<p><strong>Fecha:</strong> " . htmlspecialchars($fechaFormateada) . "</p>";
        echo "<p><strong>Autor:</strong> " . htmlspecialchars($row['Autor']) . "</p>";
        echo "<p><strong>Cliente:</strong> " . htmlspecialchars($row['Cliente']) . "</p>";
        echo "<p><strong>Razón Social:</strong> " . htmlspecialchars($row['RazonSocial']) . "</p>";
        echo "<p><strong>Referencia:</strong> " . htmlspecialchars($row['Referencia']) . "</p>";
        echo "<p><strong>Estatus:</strong> " . htmlspecialchars($row['Estatus']) . "</p>";
    } else {
        echo "<p>No se encontraron detalles para el pedido.</p>";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    exit;
}
?>
