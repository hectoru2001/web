<?php
function generate_calendar($month, $year) {
    // Días de la semana
    $daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

    // Primer día del mes
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // Número de días del mes
    $numberDays = date('t', $firstDayOfMonth);

    // Información del primer día del mes
    $dateComponents = getdate($firstDayOfMonth);

    // Nombre del mes
    $monthName = $dateComponents['month'];

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

        $calendar .= "<td class='text-center'>$currentDay</td>";

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
