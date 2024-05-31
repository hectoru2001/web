//Buscador de Editor de clientes

    // Obtener el campo de búsqueda y la tabla
    const searchInput = document.getElementById('searchInput');
    const dataTableBody = document.getElementById('dataTableBody');

    // Añadir un listener al evento input del campo de búsqueda
    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase(); // Obtener el texto ingresado y convertirlo a minúsculas

        // Iterar sobre las filas de la tabla y filtrar según la clave o la razón social
        const rows = dataTableBody.getElementsByTagName('tr');
        Array.from(rows).forEach(row => {
            const claveCell = row.getElementsByTagName('td')[0]; // Primera celda (Clave)
            const razonSocialCell = row.getElementsByTagName('td')[1]; // Segunda celda (Razón Social)

            // Obtener texto de la clave y la razón social en minúsculas
            const claveText = claveCell.textContent.trim().toLowerCase();
            const razonSocialText = razonSocialCell.textContent.trim().toLowerCase();

            // Mostrar u ocultar la fila según el texto de búsqueda
            if (claveText.includes(searchText) || razonSocialText.includes(searchText)) {
                row.style.display = ''; // Mostrar la fila si coincide con el texto de búsqueda
            } else {
                row.style.display = 'none'; // Ocultar la fila si no coincide con el texto de búsqueda
            }
        });
    });