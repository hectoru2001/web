function ejecutarConsulta() {
    // Aquí puedes hacer una solicitud al servidor para ejecutar la consulta
    // Puedes usar AJAX (o Fetch API) para hacer la solicitud al servidor
    // y enviar los parámetros necesarios para la consulta
    // Por ejemplo, utilizando XMLHttpRequest:
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "ejecutar_consulta.php?query=UPDATE+estatus+SET+columna+=+1", true); // Archivo PHP que ejecutará la consulta
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // La respuesta del servidor está lista
            // Puedes manejar la respuesta aquí si es necesario
            console.log(xhr.responseText);
            // Por ejemplo, podrías mostrar una alerta o actualizar la página después de ejecutar la consulta
        }
    };
    xhr.send();
}