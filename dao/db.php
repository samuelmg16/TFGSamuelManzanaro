<?php
function conectarDB() {
    $host = "localhost";    // Host de la base de datos
    $usuario = "root"; // Usuario de la base de datos
    $password = ""; // Contraseña de la base de datos
    $base_de_datos = "gamescore"; // Nombre de la base de datos

    // Crear conexión
    $conexion = new mysqli($host, $usuario, $password, $base_de_datos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    return $conexion;
}
?>