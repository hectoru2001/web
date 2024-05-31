<?php

require_once('../functions/conection.php');

class Query {
    public static function ejecutar($consulta) {
        global $conn; // Obtener la conexión global

        $stmt = sqlsrv_query($conn, $consulta);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return $stmt;
    }
}
?>
