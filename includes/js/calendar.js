function generateCalendar() {
    // Obtener la fecha del input tipo month
    const selectedMonth = new Date(document.getElementById('month').value);
    
    // Variables para el año y mes seleccionados
    const year = selectedMonth.getFullYear();
    const month = selectedMonth.getMonth();

    // Obtener el primer día del mes y el último día del mes
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    // Obtener el número de días en el mes
    const daysInMonth = lastDay.getDate();

    // Obtener el día de la semana en que empieza el mes (0 = domingo, 1 = lunes, ..., 6 = sábado)
    const startingDay = firstDay.getDay();

    // Obtener el contenedor del calendario
    const calendarContainer = document.getElementById('calendarContainer');
    calendarContainer.innerHTML = ''; // Limpiar el contenido anterior del contenedor

    // Crear la tabla del calendario
    const table = document.createElement('table');

    // Crear encabezado de días de la semana
    const headerRow = table.insertRow();
    const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    daysOfWeek.forEach(day => {
        const th = document.createElement('th');
        th.textContent = day;
        headerRow.appendChild(th);
    });

    // Llenar la tabla con los días del mes
    let date = 1;
    for (let i = 0; i < 6; i++) { // Máximo de 6 semanas
        const row = table.insertRow();

        // Crear celdas para cada día de la semana
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < startingDay) {
                // Celdas vacías antes del primer día del mes
                const cell = row.insertCell();
                cell.textContent = '';
            } else if (date > daysInMonth) {
                // Terminar de llenar después del último día del mes
                break;
            } else {
                // Insertar día del mes en la celda
                const cell = row.insertCell();
                cell.textContent = date;
                date++;
            }
        }
    }

    // Agregar la tabla al contenedor del calendario
    calendarContainer.appendChild(table);
}

// Llamar a la función para generar el calendario inicial basado en el mes seleccionado por defecto
generateCalendar();
