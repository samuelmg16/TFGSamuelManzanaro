<!DOCTYPE html>
<html lang="es">
<?php
require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";


require_once 'dao/DaoUsuarios.php';

$daoUsuarios = new DaoUsuarios();
$daoUsuarios->listar();
$usuarios = $daoUsuarios->usuarios;

head("Gestión de Usuarios");

if (!$_SESSION['rol'] == 1) {
    header("Location: index.php");
}
?>
<main>
    <div class="container">
        <h2 class="my-4">Gestión de Usuarios</h2>
        <div class="card">
            <div class="card-body">
                <table class="crud-table table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario->__get('id'); ?></td>
                                <td><?php echo $usuario->__get('username'); ?></td>
                                <td><?php echo $usuario->__get('email'); ?></td>
                                <td><?php echo $usuario->__get('rol') == 1 ? 'Administrador' : 'Registrado'; ?></td>
                                <td>
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario" data-id="<?php echo $usuario->__get('id'); ?>"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarUsuario" data-id="<?php echo $usuario->__get('id'); ?>"><i class="fas fa-trash"></i> Eliminar</button>
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
modalEditarUsuario();
modalEliminarUsuario();
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>
<script src="js/gestUsuarios.js"></script>
</html>
