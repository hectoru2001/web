<?php
// Iniciar o reanudar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si existe una cookie de sesión, borrarla
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio (o a otra página)
header("Location: ../index.php"); // Cambia 'index.php' por la página de inicio o la página deseada
exit;
?>
