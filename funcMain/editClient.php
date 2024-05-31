<?php
// Incluir el archivo de conexión
require_once('../functions/conection.php');
require_once('sql/query.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permitir editar facturas - APP FMTZ</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/estilos.css" rel="stylesheet">

</head>
<body>

<?php require_once('../includes/headers/header.php'); ?>


<div class="container">
    <h1 class="text-center mb-4">Permitir editar facturas</h1>

    <!-- Campo de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por clave o razón social">

    <!-- Tabla -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Razón Social</th>
                <th scope="col">RFC</th>
                <th scope="col">Editar factura</th>

            </tr>
        </thead>
        <tbody class="table-group-divider table-divider-color" id="dataTableBody">
        <?php
            // Procesar consulta SQL para obtener datos de clientes
            $stmtClientes = Query::ejecutar("SELECT * FROM Clientes");
            // Iterar sobre los resultados de la consulta
            while ($row = sqlsrv_fetch_array($stmtClientes, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Clave'] . "</td>";
                echo "<td>" . $row['RazonSocial'] . "</td>";
                echo "<td>" . $row['RFC'] . "</td>";
                echo "<td>";
                if ($row['PermitirEditarFactura'] == 0) {
                    // Botón para desactivar cliente
                    echo '<form method="post" action="sql/actualizar_cliente.php">';
                    echo '<input type="hidden" name="clave" value="' . $row['Clave'] . '">';
                    echo '<button type="submit" name="accion" value="desactivar" class="btn btn-success">Activar</button>';
                    echo '</form>';
                } else {
                    // Botón para activar cliente
                    echo '<form method="post" action="sql/actualizar_cliente.php">';
                    echo '<input type="hidden" name="clave" value="' . $row['Clave'] . '">';
                    echo '<button type="submit" name="accion" value="activar" class="btn btn-danger">Desactivar</button>';
                    echo '</form>';
                }
                
                echo "</td>"; // Cerrar la celda para el estado
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<button id="btnScrollToTop" class="btn btn-primary" onclick="scrollToTop()">Regresar Arriba</button>

<script src="../includes/js/searchInput.js"> </script>




<!-- Incluir Bootstrap JS (jQuery necesario) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Liberar recursos y cerrar conexión a SQL Server
sqlsrv_free_stmt($stmtClientes);
sqlsrv_close($conn);
?>
