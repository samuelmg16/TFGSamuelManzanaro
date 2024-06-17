<!DOCTYPE html>

<html lang="es">

<?php

require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";
require_once "dao/DaoArticulos.php";
require_once "dao/DaoVideojuegos.php";
require_once "dao/DaoComentarios.php";

head("Artículo");
$idArt = $_GET['id'];
$daoArts = new DaoArticulos();
$daoJuego = new DaoVideojuegos();
$daoComentarios = new DaoComentarios();
$articulo = $daoArts->obtener($idArt);
$daoComentarios->listarPorArticulo($idArt);


$titulo = $articulo->__get('titulo');
$contenido = $articulo->__get('contenido');
$videojuego_id = $articulo->__get('videojuego_id');

$videojuego = $daoJuego->obtener($videojuego_id);
$portada = base64_encode($videojuego->__get('portada'));
$extension = $videojuego->__get('extension_portada');


?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 article-container">
                <h1 class="article-title"><?php echo $titulo; ?></h1>
                <div class="row">
                    <div class="col-md-8 article-content">
                        <?php echo $contenido; ?>
                    </div>
                    <div class="col-md-4 article-sidebar">
                        <a href="juego.php?id=<?php echo $videojuego_id; ?>">
                            <img src="data:image/<?php echo $extension; ?>;base64,<?php echo $portada; ?>" alt="Portada del artículo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sección de comentarios -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php
                if (isset($_SESSION['user_id'])){
                ?>
                <div class="card">
                    <div class="card-header">
                        Escribe tu comentario
                    </div>
                    <div class="card-body">
                        <form id="formComentarios" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                                <input type="hidden" name="article_id" value="<?php echo $idArt?>">
                                <label for="contenido">Comparte tu opinión con la comunidad:</label>
                                <textarea class="form-control" id="contenido" name="contenido" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publicar Comentario</button>
                        </form>
                    </div>
                </div>
                <?php
                }
                ?>

                <div class="card mt-3 mb-5">
                    <div class="card-header">
                        Comentarios
                    </div>
                    <div class="card-body">
                        <!-- Mostrar comentarios -->
                        <?php if(count($daoComentarios->comentarios) > 0) { 
                            foreach ($daoComentarios->comentarios as $comentario) {
                                $userId = $_SESSION['user_id'] ?? null;
                                // Verificamos si ese usuario ha dado like a ese comentario
                                $likeado = $daoComentarios->verificarLike($userId, $comentario->__get('id'));
                                 ?>
                                <div class="media mb-4">
                                    <div class="media-body">
                                        <h5 class="mt-0"><strong><?php echo $comentario->__get('user_username'); ?></strong></h5>
                                        <small class="text-muted"><?php echo $comentario->__get('fecha_creacion'); ?></small>
                                        <p><?php echo $comentario->__get('contenido'); ?></p>
                                        <small>A <span id="comentario<?php echo $comentario->__get('id') ?>"><?php echo $comentario->__get('num_likes'); ?></span> persona(s) les ha parecido útil</small>
                                        
                                    </div>
                                    <?php
                                    if ($userId !== $comentario->__get('user_id') && isset($_SESSION['user_id'])) { ?>
                                        <button type="button" class="btn btn-primary ml-3 float-right megusta" data-id-comentario="<?php echo $comentario->__get('id') ?>" data-likeado="<?php echo $likeado ? 'true' : 'false'; ?>">
                                            <?php echo $likeado ? 'Quitar Me gusta 👎' : 'Me gusta 👍'; ?>
                                        </button>
                                    <?php }
                                    if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $comentario->__get('user_id') || $_SESSION['rol'] === 1)){
                                        ?>
                                        <button type="button" class="btn btn-primary ml-3 float-right borrarComentario" data-id-comentario="<?php echo $comentario->__get('id') ?>">Borrar comentario</button>
                                        <?php
                                    } else if (!isset($_SESSION['user_id'])){

                                    }
                                    ?>
                                </div>
                        <?php } } else { ?>
                            <p>No hay comentarios aún.</p>
                        <?php } ?>
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
<script src="js/comentarios.js"></script>
</body>

</html>