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
    <meta charset="UTF-8">

    <title>Control de pedidos</title>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link href="../includes/estilos.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <?php require_once('../includes/headers/header.php'); ?>

    <div class="container">
        <!-- Formulario de búsqueda de pedidos -->
        <form id="searchForm">
            <div class="form-group">
                <label for="searchPedido">Buscar Pedido:</label>
                <input type="text" class="form-control" id="searchInput1" name="searchPedido" placeholder="Ingrese número de pedido">
            </div>
        </form>
    </div> 

    <!-- Tabla -->
    <table class="table table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No. Pedido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Autor</th>
                <th scope="col">Cliente</th>
                <th scope="col">Razón social</th>
                <th scope="col">Referencia</th>
                <th scope="col">Estatus</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>



            </tr>
        </thead>
        <tbody class="table-group-divider table-divider-color" id="dataTableBody1">
        <?php

            // Definir el número de pedidos por página
            $pedidosPorPagina = 13;

            // Obtener el número de la página actual
            $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($paginaActual - 1) * $pedidosPorPagina;

            // Calcular el número total de páginas
            $stmtTotal = Query::ejecutar("SELECT COUNT(*) as total FROM Pedidos");
            $totalPedidos = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC)['total'];
            $totalPaginas = ceil($totalPedidos / $pedidosPorPagina);

            // Variables para controlar la visualización de los enlaces de páginas
            $rango = 5; // Número de enlaces de páginas a mostrar
            $inicio = max(1, $paginaActual - $rango);
            $fin = min($totalPaginas, $paginaActual + $rango);

            // Obtener la consulta inicial de los últimos pedidos con límite y offset
            $sql = "SELECT * FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido ORDER BY P.Pedido DESC OFFSET $offset ROWS FETCH NEXT $pedidosPorPagina ROWS ONLY";
            $stmtbtsis = Query::ejecutar($sql);

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
                echo "<td class='";
                switch ($row['Estatus']) {
                    case -1:
                        echo "pausado'>Pausado";
                        break;
                    case 0:
                        echo "sin-abrir'>Sin abrir";
                        break;
                    case 1:
                        echo "surtiendo'>Surtiendo";
                        break;
                    case 2:
                        echo "checando'>Checando";
                        break;
                    case 3:
                        echo "facturando'>Facturando";
                        break;
                    case 4:
                        echo "listo-salida'>Listo Salida";
                        break;
                    case 5:
                        echo "enviado'>Enviado";
                }
                echo "</td>";
                    
                echo "<td></td>";
                echo "<td></td>";


                echo '<td>';
                echo '<div class="dropdown">';
                    echo '</div>';
                    echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-' . $row['Pedido'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Opciones';
                    echo '</button>';
                    echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton-' . $row['Pedido'] . '">';

                        // Obtener los detalles del pedido
                        $pedidoDetalles = Query::ejecutar("SELECT * FROM Pedidos_Detalles WHERE Pedido = '" . $row['Pedido'] . "' ORDER BY Descripcion");

                        echo '<div id="detalles-' . $row['Pedido'] . '" style="display: none;">';
                        echo '<div class="barraIconos d-flex justify-content-center">';
                            // Barra de opciones
                        echo <<<HTML
                            <nav style="border-radius: 5px;" class="navbar navbar-expand-lg navbar-light bg-light">

                                <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="Cambiar estatus">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuIcon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-forward fa-2x fa-beat"></i>
                                    </a> 
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIcon">
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="pausa" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Pausado'</a>
                                                </button>
                                            </form>
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="sinabrir" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Sin abrir'</a>
                                                </button>
                                            </form>
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="surtiendo" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Surtiendo'</a>
                                                </button>
                                            </form>
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="checando" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Checando'</a>
                                                </button>
                                            </form>
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="listo" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Listo salida'</a>
                                                </button>
                                            </form>
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="enviado" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="dropdown-item">Cambiar a 'Enviado'</a>
                                                </button>
                                            </form>
                                    </div>
                                </li>
                                        <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Pausar pedido">
                                            <form method="post" action="sql/acciones_pedido.php" class="nav-link p-0 m-0">
                                                <input type="hidden" name="pedido_id" value="{$row['Pedido']}">
                                                <button type="submit" name="accion" value="eliminar" class="btn btn-link p-0 m-0 align-baseline">
                                                    <a class="nav-link"><i class="fa-solid fa-trash-can fa-2x"></i></a>
                                                </button>
                                            </form>
                                        </li>
                                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Imprimir">
                                        <a class="nav-link" href="#"><i class="fa-solid fa-print fa-2x fa-bounce"></i></a>
                                    </li>
                        HTML;
                                echo '</ul>'; // Cerrar la lista <ul>
                                
                            
                            echo '</nav>';
                        echo '</div>';
                            echo '<div class="pedido-info">';
                            echo '<p><strong>Pedido:</strong> ' . $row['Pedido'] . '</p>';
                            echo '<p><strong>Autor:</strong> ' . $row['Autor'] . '</p>';
                            echo '<p><strong>Cliente:</strong> ' . $row['Cliente'] . '</p>';
                            echo '<p><strong>Razón Social:</strong> ' . $row['RazonSocial'] . '</p>';
                            echo '<p><strong>Referencia:</strong> ' . $row['Referencia'] . '</p>';
                        echo '</div>';


                        echo '<table class="table">';
                        echo '<tr><th>Clave Producto</th><th>Descripción</th><th>Cantidad</th><th>Cantidad solicitada</th><th>Unidad</th><th>Precio</th></tr>';
                        while ($detalle = sqlsrv_fetch_array($pedidoDetalles, SQLSRV_FETCH_ASSOC)) {
                            echo '<tr>';
                                echo '<td>' . $detalle['ClaveProducto'] . '</td>';
                                echo '<td>' . $detalle['Descripcion'] . '</td>';
                                echo '<td>' . $detalle['Cantidad'] . '</td>';
                                echo '<td>' . $detalle['CantidadSolicitada'] . '</td>';
                                echo '<td>' . $detalle['Unidad'] . '</td>';
                                echo '<td>' . $detalle['Precio'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '</div>';
                    echo '<input type="hidden" name="pedido_id" value="' . $row['Pedido'] . '">';
                    echo '<button class="dropdown-item" type="button" onclick="mostrarDetalles(' . $row['Pedido'] . ')">Ver</button>';

                    


                    echo '</div>';
                }
                echo '</div>';
                

        ?>

        </tbody>
    </table>
    
    <!-- Enlaces de paginación -->
    <nav>
        <ul class="pagination">
            <?php
            // Enlace "Anterior"
            if ($paginaActual > 1) {
                echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaActual - 1) . '">Anterior</a></li>';
            }

            // Mostrar los primeros 5 enlaces
            for ($i = 1; $i <= min(5, $totalPaginas); $i++) {
                echo '<li class="page-item ' . ($i == $paginaActual ? 'active' : '') . '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
            }

            // Mostrar el enlace "..."
            if ($totalPaginas > 5) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                // Mostrar el último enlace
                echo '<li class="page-item ' . ($totalPaginas == $paginaActual ? 'active' : '') . '"><a class="page-link" href="?pagina=' . $totalPaginas . '">' . $totalPaginas . '</a></li>';
            }

            // Enlace "Siguiente"
            if ($paginaActual < $totalPaginas) {
                echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaActual + 1) . '">Siguiente</a></li>';
            }
            ?>
        </ul>
    </nav>
    
    <!-- Modal para ver detalles del pedido -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pedidoModalLabel">Detalles del Pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="color: #ffffff;" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Aquí se cargarán los detalles del pedido -->
            <div id="pedidoDetalles"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <script>

    function mostrarDetalles(pedidoId) {
        // Obtener el contenido del div oculto
        var detalles = document.getElementById('detalles-' + pedidoId).innerHTML;
        
        // Insertar el contenido en el modal
        document.getElementById('pedidoDetalles').innerHTML = detalles;
        
        // Mostrar el modal
        $('#pedidoModal').modal('show');
    }

    function estatusDetalles(pedidoId) {
        // Obtener el contenido del div oculto
        var detalles = document.getElementById('detalles-' + pedidoId).innerHTML;
        
        // Insertar el contenido en el modal
        document.getElementById('peDetalles').innerHTML = detalles;
        
        // Mostrar el modal
        $('#estatusModal').modal('show');
    }


    document.getElementById('searchInput1').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableBody1 tr');

            rows.forEach(function(row) {
                var usuario = row.cells[0].textContent.toLowerCase();
                var descripcion = row.cells[5].textContent.toLowerCase();

                if (usuario.indexOf(input) > -1 || descripcion.indexOf(input) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });



    </script>



</body>
</html>

<?php
    // Liberar recursos y cerrar conexión a SQL Server
    sqlsrv_free_stmt($stmtbtsis);
    sqlsrv_close($conn);
?>