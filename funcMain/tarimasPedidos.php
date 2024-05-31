<?php
// Incluir el archivo de conexión
require_once('../functions/conection.php');
require_once('sql/query.php');

    // Función para obtener detalles de una tarima por su ID
    function obtenerDetallesTarima($tarimaID) {
        $consulta = "SELECT * FROM Tarimas_Basculas WHERE ID = $tarimaID";
        $resultado = Query::ejecutar($consulta);

        if ($resultado && sqlsrv_has_rows($resultado)) {
            $fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);

            return [
                'Numero_Pedido' => $fila['Pedido'] ?? 'No encontrado',
                'Bascula' => $fila['Bascula'] ?? 'No encontrado',
                'Ocupada' => $fila['Ocupada'] ?? 'No encontrado'
            ];
        } else {
            return [
                'Numero_Pedido' => 'No encontrado',
                'Bascula' => 'No encontrado',
                'Ocupada' => 'No encontrado'
            ];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de tarimas - AppFMTZ</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/estilos.css" rel="stylesheet">
</head>
<body>

    <?php require_once('../includes/headers/header.php'); ?>

    <div class="container">
        <h1>Control de tarimas</h1>

        <div class="row">
            <?php
            // IDs de tarimas que quieres consultar
            $tarimaIDs = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]; // Por ejemplo, consulta tarimas del ID 6 al 10

            // Iterar sobre cada ID de tarima y mostrar los detalles como tarjetas
            foreach ($tarimaIDs as $tarimaID) {
                $detalles = obtenerDetallesTarima($tarimaID);
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Tarima #<?php echo $tarimaID; ?></h2>
                        <p> <bold> Número de pedido: </bold> <?php echo htmlspecialchars($detalles['Numero_Pedido']); ?></p>
                        <p>Báscula: <?php echo htmlspecialchars($detalles['Bascula']); ?></p>
                        <p>Ocupada: <?php echo htmlspecialchars($detalles['Ocupada']); ?></p>
                        <!-- Formulario oculto para la acción de vaciar tarima -->
                        <form id="vaciarTarimaForm<?php echo $tarimaID; ?>" class="d-none" action="sql/vaciar_tarima.php" method="post">
                            <input type="hidden" name="accion" value="vaciar_tarima">
                            <input type="hidden" name="tarima_id" value="<?php echo $tarimaID; ?>">
                        </form>
                        <button type="button" onclick="vaciarTarima(<?php echo $tarimaID; ?>)" class="btn btn-primary">Vaciar tarima</button>
                        
                        <button type="button" class="btn btn-warning">Cambiar pedido</button>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para enviar el formulario de vaciar tarima
        function vaciarTarima(tarimaID) {
            var formId = 'vaciarTarimaForm' + tarimaID;
            var form = document.getElementById(formId);

            if (form) {
                // Enviar el formulario
                form.submit();
            }
        }
    </script>
</body>
</html>
