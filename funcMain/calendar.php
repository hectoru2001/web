<?php
// Configuración regional para español
setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish');

// Configuración inicial
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Ajustar el mes y el año si se exceden los límites
if ($month < 1) {
    $month = 12;
    $year--;
} elseif ($month > 12) {
    $month = 1;
    $year++;
}

function generate_calendar($month, $year) {
    // Días de la semana en español
    $daysOfWeek = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    // Primer día del mes
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // Número de días del mes
    $numberDays = date('t', $firstDayOfMonth);

    // Información del primer día del mes
    $dateComponents = getdate($firstDayOfMonth);

    // Nombre del mes
    $monthName = strftime('%B', $firstDayOfMonth);

    // Día de la semana del primer día del mes
    $dayOfWeek = $dateComponents['wday'];

    // Crear la tabla del calendario
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<thead><tr>";

    // Encabezados de los días de la semana
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='text-center'>$day</th>";
    }

    $calendar .= "</tr></thead><tbody><tr>";

    // Rellenar los días vacíos antes del primer día del mes
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td></td>";
        }
    }

    // Inicializar el día del mes
    $currentDay = 1;

    // Llenar el calendario con los días del mes
    while ($currentDay <= $numberDays) {
        // Si llegamos al final de la semana, empezar una nueva fila
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        // Agregar un enlace para cada día que abra un formulario de recordatorio
        $calendar .= "<td class='text-center day' data-toggle='modal' data-target='#reminderModal' data-day='$currentDay'>$currentDay</td>";

        // Incrementar los contadores
        $currentDay++;
        $dayOfWeek++;
    }

    // Rellenar los días vacíos después del último día del mes
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($k = 0; $k < $remainingDays; $k++) {
            $calendar .= "<td></td>";
        }
    }

    $calendar .= "</tr></tbody></table>";

    return $calendar;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>    <link href="../includes/estilos.css" rel="stylesheet">
    <link href="../includes/estilos.css" rel="stylesheet">

</head>
<body>

    <?php require_once('../includes/headers/header.php'); ?>

    <div class="container">
        <h1 class="mt-4 mb-4 text-center">Calendario</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="?month=<?= $month-1 ?>&year=<?= $year ?>"><i class="fas fa-chevron-left"></i></a>
            <span class="align-self-center"><strong><?= strftime('%B %Y', mktime(0, 0, 0, $month, 1, $year)); ?></strong></span>
            <a href="?month=<?= $month+1 ?>&year=<?= $year ?>"><i class="fas fa-chevron-right"></i></a>
        </div>
        <div>
            <?php
            // Mostrar el calendario
            echo generate_calendar($month, $year);
            ?>
        </div>
    </div>


    <!-- Modal de recordatorio -->
    <div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="reminderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reminderModalLabel">Agregar Recordatorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reminderForm">
                        <div class="form-group">
                            <label for="reminderDate">Fecha:</label>
                            <input type="text" class="form-control" id="reminderDate" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reminderDescription">Descripción:</label>
                            <textarea class="form-control" id="reminderDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" form="reminderForm" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Al hacer clic en un día, actualizar la fecha en el formulario de recordatorio
            $('.day').click(function() {
                var day = $(this).data('day');
                var monthYear = '<?= strftime('%B %Y', mktime(0, 0, 0, $month, 1, $year)); ?>';
                $('#reminderDate').val(day + ' ' + monthYear);
            });
        });
    </script>
</body>
</html>
