<?php
// Iniciar o reanudar la sesión
session_start();

// Establecer detalles de conexión a SQL Server
$serverName = "192.168.1.1,49853";
$connectionOptions = array(
    "Database" => "FM Ver 4",
    "Uid" => "fmtz",
    "PWD" => "123456789",
    "CharacterSet" => "UTF-8"
);

// Establecer conexión a SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>