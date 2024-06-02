<!DOCTYPE html>

<html>

<?php
require("plantillas/header.php");
require("plantillas/footer.php");
require("dao/db.php");
$conn = conectarDB();
$id = $_GET['id'];
// Preparar la consulta SQL
$consulta = "SELECT a.titulo as 'title', contenido, videojuego_id, portada FROM articulos a JOIN videojuegos v ON a.videojuego_id = v.id WHERE a.id = $id";

// Ejecutar la consulta
$resultado = $conn->query($consulta);
if ($resultado && $resultado->num_rows > 0) {
    $articulo = $resultado->fetch_assoc();
} else {
    $articulo = null;
}

$titulo = $articulo['title'];
$portada = $articulo['portada'];
$contenido = $articulo['contenido'];
$videojuego_id = $articulo['videojuego_id'];


head("Inicio");


?>
<main>
    <div class="row justify-content-center">
    
        <div class="col-md-12">
            <h1><?php echo $titulo ?></h1>
        </div>
    <div class="row mb-4">
        <div class="col-md-8">
            <?php echo $contenido ?>
        </div>
        <div class="col-md-4">
            <a href="juego.php?id=<?php echo $videojuego_id ?>">
                <img src="mostrar_imagen.php?id=<?php echo $id; ?>" alt="Portada del artículo" width="300px">
            </a>
        </div>
    </div>
    </div>
</main>

<?php
footer();
?>

</body>

</html>