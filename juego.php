<!DOCTYPE html>
<html lang="es">

<?php

require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";
require_once "dao/DaoVideojuegos.php";

head("Videojuego");

$idJuego = $_GET['id'];
$daoJuego = new DaoVideojuegos();
$videojuego = $daoJuego->obtener($idJuego);

$titulo = $videojuego->__get('titulo');
$precio = $videojuego->__get('precio');
$fecha_lanzamiento = $videojuego->__get('fecha_lanzamiento');
$categorias = $videojuego->__get('categorias_nombre');
$titulo = $videojuego->__get('titulo');
$portada = base64_encode($videojuego->__get('portada'));
$extension = $videojuego->__get('extension_portada');
$sinopsis = $videojuego->__get('sinopsis');

?>
<main>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card shadow-lg mb-4">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="data:image/<?php echo $extension; ?>;base64,<?php echo $portada; ?>" class="card-img" alt="Portada de <?php echo $titulo; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo $titulo; ?></h1>
                                <p class="card-text"><strong>Precio:</strong> <?php echo $precio; ?>€</p>
                                <p class="card-text"><strong>Fecha de Lanzamiento:</strong> <?php echo date("d-m-Y", strtotime($fecha_lanzamiento)); ?></p>
                                <p class="card-text"><strong>Categorías:</strong> <?php echo $categorias; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg mb-5">
                    <div class="card-body">
                        <h2 class="font-weight-bold">Sinopsis</h2>
                        <p class="text-justify">
                            <?php echo $sinopsis; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>

</body>

</html>