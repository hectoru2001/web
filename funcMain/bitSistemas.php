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
    <title>Bitácora de Sistemas</title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/estilos.css" rel="stylesheet">
</head>
<body>
    
<?php require_once('../includes/headers/header.php'); ?>


<div class="container">
    <h1 class="text-center mb-4">Bitácora de sistemas</h1>

    <!-- Campo de búsqueda -->
    <input type="text" id="searchInput1" class="form-control mb-3" placeholder="Buscar por Usuario o Descripción">

    <!-- Botón para abrir el formulario modal -->
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#nuevoTicketModal">
        Generar Nuevo Ticket
    </button>

    <!-- Modal para generar un nuevo ticket -->
    <div class="modal fade" id="nuevoTicketModal" tabindex="-1" aria-labelledby="nuevoTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoTicketModalLabel">Generar Nuevo Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para generar un nuevo ticket -->
                    <form action="sql/procesar_ticket.php" method="POST">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <select class="form-control" id="usuario" name="usuario" required>
                            <option value="Pedidos"> Pedidos</option>
                            <option value="Sistemas"> Sistemas</option>
                            <option value="Merkdito"> Merkdito</option>

                            <option value="Martha Maria"> Martha Maria</option>
                            <option value="Alejandra Prieto"> Alejandra Prieto</option>
                            <option value="Brianda Apodaca"> Brianda Apodaca</option>
                            <option value="Alejandra Reyes"> Alejandra Reyes</option>
                            <option value="Jessica Lopez"> Jessica Lopez</option>
                            <option value="Eduardo Acevedo"> Eduardo Acevedo</option>
                            <option value="Martha Martinez"> Martha Martinez</option>
                            <option value="Marcos Martinez"> Marcos Martinez</option>
                            <option value="Marisela Martinez"> Marisela Martinez</option>
                            <option value="Yolanda Martinez"> Yolanda Martinez</option>
                            <option value="Rosa Martinez"> Rosa Martinez</option>
                            <option value="Guadalupe Licea"> Guadalupe Licea</option>
                            <option value="Yendi Aguilar"> Yendi Aguilar</option>
                            <option value="Aaron Navarro"> Aaron Navarro</option>
                            <option value="Jose Isidro"> Jose Isidro</option>


                            
                        </select>
                    </div>

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProblema">Descripción del Problema</label>
                            <textarea class="form-control" id="descripcionProblema" name="descripcionProblema" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="solucion">Solución</label>
                            <textarea class="form-control" id="solucion" name="solucion" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Añadir tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <table  style="margin-top: 15px;" class="table">
        <thead>
            <tr>
                <th scope="col">No. Ticket</th>
                <th scope="col">Fecha</th>
                <th scope="col">Usuario</th>
                <th scope="col">Descripción</th>
                <th scope="col">Solución</th>
            </tr>
        </thead>
        <tbody class="table-group-divider table-divider-color" id="dataTableBody1">
        <?php

            $stmtbtsis = Query::ejecutar("SELECT * FROM bitacora_sistemas ORDER BY ticket DESC");
            // Iterar sobre los resultados de la consulta
            while ($row = sqlsrv_fetch_array($stmtbtsis, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['ticket'] . "</td>";

                // Formatear la fecha como una cadena legible (ejemplo: YYYY-MM-DD)
                $fechaFormateada = $row['fecha']->format('Y-m-d H:i:s');
                echo "<td>" . $fechaFormateada . "</td>";

                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['solucion'] . "</td>";
                echo "</tr>";
            }
        ?>

        </tbody>
    </table>
</div>

<script>
        document.getElementById('searchInput1').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableBody1 tr');

            rows.forEach(function(row) {
                var usuario = row.cells[2].textContent.toLowerCase();
                var descripcion = row.cells[3].textContent.toLowerCase();

                if (usuario.indexOf(input) > -1 || descripcion.indexOf(input) > -1) {
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
