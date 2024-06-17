<!DOCTYPE html>
<html lang="es">
<?php
require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";

require_once "dao/DaoArticulos.php";
require_once "dao/DaoVideojuegos.php";

$daoArts = new DaoArticulos();
$daoJuego = new DaoVideojuegos();

// Obtenemos los dos artículos con mayor cantidad de comentarios
$daoArts->listarReviews();
$reviews = $daoArts->articulos;


head("Reviews");
?>
<main>
    <section id="reviews" class="mb-5">
        <h2>Reviews</h2>
        <div class="articulos">
            <?php foreach ($reviews as $articulo){ ?>
                <article>
                    <a href="articulo.php?id=<?php echo $articulo->__get('id'); ?>">
                        <?php
                            $videojuego = $daoJuego->obtener($articulo->__get('videojuego_id'));
                            $portada = base64_encode($videojuego->__get('portada'));
                            $extension = $videojuego->__get('extension_portada');
                        ?>
                        <img src="data:image/<?php echo $extension; ?>;base64,<?php echo $portada; ?>" class="principal" alt="Portada del artículo">
                        <h5><?php echo $articulo->__get('titulo'); ?></h5>
                        <p><?php echo $articulo->__get('resumen'); ?></p>
                    </a>
                </article>
            <?php } ?>
        </div>
    </section>
</main>
<?php
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>

</body>

</html>