<?php
// Incluir el archivo de conexión
require_once('../functions/conection.php');
require_once('sql/query.php');

$query = "SELECT * FROM Pedidos AS P INNER JOIN Pedidos_Logistica AS PL ON P.Pedido = PL.Pedido";
$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pedidos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Reporte de Pedidos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. Pedido</th>
                    <th>Fecha</th>
                    <th>Autor</th>
                    <th>Cliente</th>
                    <th>Razón Social</th>
                    <th>Referencia</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['Pedido']; ?></td>
                        <td><?php echo $row['Fecha']->format('Y-m-d H:i:s'); ?></td>
                        <td><?php echo $row['Autor']; ?></td>
                        <td><?php echo $row['Cliente']; ?></td>
                        <td><?php echo $row['RazonSocial']; ?></td>
                        <td><?php echo $row['Referencia']; ?></td>
                        <td><?php echo $row['Estatus']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
