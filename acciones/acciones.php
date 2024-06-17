<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json; charset=utf-8');
require_once('controladores/login.php');
require_once('controladores/comentarios.php');
require_once('controladores/gestVideojuegos.php');
require_once('controladores/gestArticulos.php');
require_once('controladores/gestUsuarios.php');

if(isset($_POST['accion'])){
    switch ($_POST['accion']) {  
        case 'iniciar_sesion':
            iniciarSesion();
            break;
        case 'registrar_usuario':
            registrarUsuario();
            break;
        case 'cerrar_sesion':
            cerrarSesion();
            break;
        case 'crear_comentario':
            crearComentario();
            break;
        case 'controlar_likes':
            likes();
            break;
        case 'borrar_comentario':
            borrarComentario();
            break;
        case 'obtener_videojuego':
            obtenerVideojuego();
            break;
        case 'borrar_videojuego':
            borrarVideojuego();
            break;
        case 'crear_videojuego':
            crearVideojuego();
            break;
        case 'editar_videojuego':
            editarVideojuego();
            break;
        case 'crear_articulo':
            crearArticulo();
            break;
        case 'editar_articulo':
            editarArticulo();
            break;
        case 'borrar_articulo':
            borrarArticulo();
            break;
        case 'obtener_articulo':
            obtenerArticulo();
            break;
        case 'obtener_usuario':
                obtenerUsuario();
                break;
        case 'editar_usuario':
            editarUsuario();
            break;
        case 'eliminar_usuario':
            borrarUsuario();
            break;
    }
}

?>