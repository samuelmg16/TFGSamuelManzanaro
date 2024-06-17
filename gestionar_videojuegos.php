<!DOCTYPE html>
<html lang="es">
<?php
require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";

require_once "dao/DaoVideojuegos.php";

$daoJuego = new DaoVideojuegos();
$daoJuego->listar();
$videojuegos = $daoJuego->videojuegos;

head("Gestión de Videojuegos");

if (!$_SESSION['rol'] == 1) {
    header("Location: index.php");
}
?>
<main>
    <div class="container">
        <h2 class="my-4">Gestión de Videojuegos</h2>
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalAgregarVideojuego"><i class="fas fa-plus"></i> Agregar Nuevo Videojuego</button>
        <div class="card">
            <div class="card-body">
                <table class="crud-table table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                            <th>Precio</th>
                            <th>Fecha de Lanzamiento</th>
                            <th>Categorías</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($videojuegos as $videojuego){?>
                            <tr>
                                <td><?php echo $videojuego->__get('id'); ?></td>
                                <td><?php echo $videojuego->__get('titulo'); ?></td>
                                <td><?php echo $videojuego->__get('sinopsis'); ?></td>
                                <td><?php echo $videojuego->__get('precio'); ?></td>
                                <td><?php echo $videojuego->__get('fecha_lanzamiento'); ?></td>
                                <td><?php echo $videojuego->__get('categorias_nombre'); ?></td>
                                <td>
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditarVideojuego" data-id="<?php echo $videojuego->__get('id'); ?>"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarVideojuego" data-id="<?php echo $videojuego->__get('id'); ?>"><i class="fas fa-trash"></i> Eliminar</button>
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
modalCrearVideojuego();
modalEditarVideojuego();
modalEliminarVideojuego();
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>
<script src="js/gestVideojuegos.js"></script>
</html>
