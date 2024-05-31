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


    <h1 class="text-center mb-4">Permitir editar facturas</h1>

    <!-- Campo de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por clave, razón social o referencia">

    <!-- Tabla -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Razón Social</th>
                <th scope="col">Referencia</th>
                <th scope="col">Planta</th>
                <th scope="col">Dirección</th>


            </tr>
        </thead>
        <tbody class="table-group-divider table-divider-color" id="dataTableBody">
        <?php
            // Procesar consulta SQL para obtener datos de clientes
            $stmtClientes = Query::ejecutar("SELECT DISTINCT C.Clave, c.RazonSocial, p.Referencia, p.Planta, pl.Direccion FROM Clientes AS C INNER JOIN Pedidos AS P ON C.Clave = P.Cliente INNER JOIN Plantas AS PL ON PL.Referencia = P.Referencia ORDER BY Clave");
            // Iterar sobre los resultados de la consulta
            while ($row = sqlsrv_fetch_array($stmtClientes, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Clave'] . "</td>";
                echo "<td>" . $row['RazonSocial'] . "</td>";
                echo "<td>" . $row['Referencia'] . "</td>";
                echo "<td>" . $row['Planta'] . "</td>";
                echo "<td>" . $row['Direccion'] . "</td>";

                
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

<button id="btnScrollToTop" class="btn btn-primary" onclick="scrollToTop()">Regresar Arriba</button>

<script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableBody tr');

            rows.forEach(function(row) {
                var clave = row.cells[0].textContent.toLowerCase();
                var razonSocial = row.cells[1].textContent.toLowerCase();
                var referencia = row.cells[2].textContent.toLowerCase();

                if (clave.indexOf(input) > -1 || razonSocial.indexOf(input) > -1 || referencia.indexOf(input) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>




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
