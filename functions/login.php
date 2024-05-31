<?php
// Iniciar o reanudar la sesión
session_start();

// Establecer detalles de conexión a SQL Server
$serverName = "192.168.1.1,49853";
$connectionOptions = array(
    "Database" => "FM Ver 4",
    "Uid" => "fmtz",
    "PWD" => "123456789"
);

// Establecer conexión a SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT Identificador, Usuario, Contrasena, Nombre, Apellido_P, Apellido_M FROM usuarios WHERE Usuario = ? AND Contrasena = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Verificar si se encontró un usuario válido
    if (sqlsrv_has_rows($stmt)) {

        // Obtener el resultado de la consulta
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Guardar el identificador del usuario en una variable de sesión
        $_SESSION['id_usuario'] = $row['Nombre'] . ' ' . $row['Apellido_P'] . ' ' . $row['Apellido_M'];

        // Credenciales válidas, redirigir a la página de inicio (o mostrar mensaje de éxito)
        header("Location: ../main.php"); // Redirigir a la página de inicio
        exit;
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
}

// Cerrar conexión a SQL Server
sqlsrv_close($conn);
?>