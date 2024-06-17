<!DOCTYPE html>
<html lang="es">
<?php
require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";

require_once 'dao/DaoVideojuegos.php';
require_once "dao/DaoArticulos.php";

$daoArticulos = new DaoArticulos();
$daoArticulos->listar();
$articulos = $daoArticulos->articulos;

head("Gestión de Artículos");

if (!$_SESSION['rol'] == 1) {
    header("Location: index.php");
}
?>
<main>
    <div class="container">
        <h2 class="my-4">Gestión de Artículos</h2>
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalAgregarArticulo"><i class="fas fa-plus"></i> Agregar Nuevo Artículo</button>
        <div class="card">
            <div class="card-body">
                <table class="crud-table table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Resumen</th>
                            <th>Contenido</th>
                            <th>Fecha de Publicación</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articulos as $articulo) { ?>
                            <tr>
                                <td><?php echo $articulo->__get('id'); ?></td>
                                <td><?php echo $articulo->__get('titulo'); ?></td>
                                <td><?php echo $articulo->__get('resumen'); ?></td>
                                <td><?php echo $articulo->__get('contenido'); ?></td>
                                <td><?php echo $articulo->__get('fecha_publicacion'); ?></td>
                                <td><?php echo $articulo->__get('categoria_nombre'); ?></td>
                                <td>
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditarArticulo" data-id="<?php echo $articulo->__get('id'); ?>"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarArticulo" data-id="<?php echo $articulo->__get('id'); ?>"><i class="fas fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
modalCrearArticulo();
modalEditarArticulo();
modalEliminarArticulo();
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>
<script src="js/gestArticulos.js"></script>
</html>
