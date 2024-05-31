<?php
// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió la acción correcta
    if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar_tarima') {
        // Obtener el ID de la tarima desde el formulario
        $tarimaID = $_POST['tarima_id'] ?? null;

        if ($tarimaID !== null) {
            // Realizar la consulta de actualización para vaciar la tarima
            require_once('../../functions/conection.php');
            class Query {
                public static function ejecutar($consulta) {
                    global $conn; // Obtener la conexión global
            
                    $stmt = sqlsrv_query($conn, $consulta);
            
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
            
                    return $stmt;
                }
            }

            $consulta = "UPDATE Tarimas_Basculas SET Pedido = 0, Ocupada = 0, Bascula = '' WHERE ID = $tarimaID";

            $resultado = Query::ejecutar($consulta);

            if ($resultado) {
                header('Location: ../tarimasPedidos.php');
            } else {
                echo '<div class="alert alert-danger" role="alert">Error al vaciar la tarima.</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">ID de tarima no válido.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Acción no válida.</div>';
    }
} else {
    // Si no es una solicitud POST, redirigir o mostrar un mensaje de error
    echo '<div class="alert alert-danger" role="alert">Acceso no permitido.</div>';
}
?>
