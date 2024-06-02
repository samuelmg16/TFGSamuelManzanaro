<?php
require("dao/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn = conectarDB();

    // Preparar y ejecutar la consulta para obtener la imagen
$consulta = "SELECT videojuego_id, portada FROM articulos a JOIN videojuegos v ON a.videojuego_id = v.id WHERE a.id = $id";

    // Ejecutar la consulta
$resultado = $conn->query($consulta);
$resultado = $conn->query($consulta);
if ($resultado && $resultado->num_rows > 0) {
    $articulo = $resultado->fetch_assoc();
} else {
    $articulo = null;
}
$portada = $articulo['portada'];

    if ($portada) {
        // Enviar los encabezados HTTP para la imagen
        header("Content-Type: image/jpeg"); 
        echo $portada;
        exit;
    }
}

?>
