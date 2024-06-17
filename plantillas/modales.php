<?php
function modalIniciarSesion()
{
?>
    <!-- Modal de Inicio de Sesión -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formIniciarSesion" method="POST">
                        <div class="form-group">
                            <small class="form-text text-danger" id="loginError"></small>
                        </div>
                        <div class="form-group">
                            <label for="username_sesion">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" id="username_sesion" placeholder="Introduce tu nombre de usuario">
                        </div>
                        <div class="form-group">
                            <label for="password_sesion">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password_sesion" placeholder="Contraseña">
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            <button type="button" id="enlace_inicio_sesion" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">¿No tienes cuenta? Regístrate</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

function modalRegistroUsuario(){
    ?>
    <!-- Modal de Registro -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Regístrate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="formRegistro" method="POST" novalidate>
                    <div class="form-group">
                        <small class="form-text text-danger" id="registerError"></small>
                    </div>
                    <div class="form-group">
                        <label for="username_registro">Nombre de usuario</label>
                        <input type="text" class="form-control" name="username" id="username_registro" placeholder="Introduce tu nombre de usuario">
                        <div class="error-message form-text text-danger" id="error-username"></div>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Introduce tu correo electrónico">
                        <div class="error-message form-text text-danger" id="error-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Contraseña">
                        <div class="error-message form-text text-danger" id="error-password"></div>
                    </div>
                    <div class="form-group">
                        <label for="registerPasswordConfirm">Confirmar Contraseña</label>
                        <input type="password" class="form-control" name="confirm_password" id="registerPasswordConfirm" placeholder="Confirmar Contraseña">
                        <div class="error-message form-text text-danger" id="error-confirm-password"></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary float-left">Registrarse</button>
                        <button type="button" id="enlace_registro" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">¿Ya tienes cuenta? Inicia Sesión</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
    function modalCrearVideojuego(){
?>
<!-- Modal Agregar Videojuego -->
<div class="modal fade" id="modalAgregarVideojuego" tabindex="-1" aria-labelledby="modalAgregarVideojuegoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarVideojuegoLabel">Agregar Nuevo Videojuego</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-crear-videojuego" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sinopsis">Sinopsis:</label>
                        <textarea name="sinopsis" id="sinopsis" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" name="precio" id="precio" class="form-control" step=".01" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
                        <input type="date" name="fecha_lanzamiento" id="fecha_lanzamiento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="portada">Portada:</label>
                        <input type="file" name="portada" id="portada" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="categorias">Categorías:</label>
                        <select multiple name="categorias[]" id="categorias" class="form-control" required>
                        <?php 
                        $daoJuego = new DaoVideojuegos();
                        $categorias = $daoJuego->listarCats();
                        foreach ($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                            <?php } ?>
                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?php
    function modalEditarVideojuego(){
?>
<!-- Modal Editar Videojuego -->
<div class="modal fade" id="modalEditarVideojuego" tabindex="-1" aria-labelledby="modalEditarVideojuegoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarVideojuegoLabel">Editar Videojuego</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="formEditarVideojuego">
                    <input type="hidden" name="id" id="editarId">
                    <div class="form-group">
                        <label for="editarTitulo">Título:</label>
                        <input type="text" name="titulo" id="editarTitulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editarSinopsis">Sinopsis:</label>
                        <textarea name="sinopsis" id="editarSinopsis" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editarPrecio">Precio:</label>
                        <input type="number" name="precio" id="editarPrecio" class="form-control" step=".01" required>
                    </div>
                    <div class="form-group">
                        <label for="editarFechaLanzamiento">Fecha de Lanzamiento:</label>
                        <input type="date" name="fecha_lanzamiento" id="editarFechaLanzamiento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editarCategorias">Categorías:</label>
                        <select multiple name="categorias[]" id="editarCategorias" class="form-control" required>
                            <?php 
                            $daoJuego = new DaoVideojuegos();
                            $categorias = $daoJuego->listarCats();
                            foreach ($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?php
    function modalEliminarVideojuego(){
?>
    <!-- Eliminar -->
    <div class="modal fade" id="modalEliminarVideojuego" tabindex="-1" role="dialog"  aria-labelledby="DeleteVideojuegoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Eliminar Videojuego</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form-videojuego-eliminar" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="eliminarId" name="id" value="">
                        <div class="eliminar text-center">
                            <p>¿Estás seguro? El videojuego será eliminado</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="eliminar-videojuego" name="eliminar" class="btn btn-danger" >Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
    function modalEliminarArticulo(){
?>
    <!-- Eliminar -->
    <div class="modal fade" id="modalEliminarArticulo" tabindex="-1" role="dialog"  aria-labelledby="DeleteArticuloModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Eliminar Articulo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form-articulo-eliminar" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="eliminarId" name="id" value="">
                        <div class="eliminar text-center">
                            <p>¿Estás seguro? El Artículo será eliminado</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="eliminar-videojuego" name="eliminar" class="btn btn-danger" >Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}

function modalCrearArticulo(){
?>
<!-- Modal Agregar Artículo -->
<div class="modal fade" id="modalAgregarArticulo" tabindex="-1" aria-labelledby="modalAgregarArticuloLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formAgregarArticulo" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarArticuloLabel">Agregar Nuevo Artículo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="resumen" class="form-label">Resumen</label>
                        <textarea class="form-control" id="resumen" name="resumen" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="">Selecciona una categoría</option>
                            <option value="1">Reviews</option>
                            <option value="2">Noticias</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="videojuego_id" class="form-label">Videojuego Asociado</label>
                        <select class="form-select" id="videojuego_id" name="videojuego_id" required>
                            <option value="">Selecciona un videojuego</option>
                            
                            <?php 
                            $daoJuego = new DaoVideojuegos();
                            $daoJuego->listar();
                            $videojuegos = $daoJuego->videojuegos;
                            foreach ($videojuegos as $videojuego) { ?>
                                <option value="<?php echo $videojuego->id; ?>"><?php echo $videojuego->titulo; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Puedes agregar más campos según sea necesario para tu aplicación -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardarArticulo">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}

function modalEditarArticulo(){
?>
<!-- Modal Editar Artículo -->
<div class="modal fade" id="modalEditarArticulo" tabindex="-1" aria-labelledby="modalEditarArticuloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarArticuloLabel">Editar Artículo</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formEditarArticulo">
                <div class="modal-body">
                    <input type="hidden" id="editarArticuloId" name="id">
                    <div class="mb-3">
                        <label for="editarTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editarTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarResumen" class="form-label">Resumen</label>
                        <textarea class="form-control" id="editarResumen" name="resumen" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editarContenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="editarContenido" name="contenido" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editarCategoria" class="form-label">Categoría</label>
                        <select class="form-select" id="editarCategoria" name="categoria" required>
                            <option value="">Selecciona una categoría</option>
                            <option value="1">Reviews</option>
                            <option value="2">Noticias</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editarVideojuego" class="form-label">Videojuego Asociado</label>
                        <select class="form-select" id="editarVideojuego" name="videojuego_id" required>
                            <option value="">Selecciona un videojuego</option>
                            <?php 
                            $daoJuego = new DaoVideojuegos();
                            $daoJuego->listar();
                            $videojuegos = $daoJuego->videojuegos;
                            foreach ($videojuegos as $videojuego) { ?>
                                <option value="<?php echo $videojuego->id; ?>"><?php echo $videojuego->titulo; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="botonEditarArticulo">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>
<?php
    function modalEliminarUsuario(){
?>
    <!-- Eliminar -->
    <div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEliminarUsuario">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminarUsuarioLabel">Eliminar Usuario</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="eliminarId" name="id">
                        <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}

function modalEditarUsuario(){
?>
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditarUsuario">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editarId" name="id">
                        <div class="mb-3">
                            <label for="editarUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editarUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editarCorreo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="editarCorreo" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="editarRol" class="form-label">Rol</label>
                            <select class="form-select" id="editarRol" name="rol" required>
                                <option value="1">Administrador</option>
                                <option value="2">Registrado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnEditarUsu">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>