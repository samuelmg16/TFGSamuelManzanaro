<?php
require_once __DIR__ . '/../../dao/DaoArticulos.php';
require_once __DIR__ . '/../../dao/DaoVideojuegos.php';
function crearArticulo()
{
    // Verificar si se recibieron los datos del formulario
    if (isset($_POST['titulo'])) {
        $articulo = new Articulo();
        $articulo->__set('titulo', $_POST['titulo']);
        $articulo->__set('resumen', $_POST['resumen']);
        $articulo->__set('contenido', $_POST['contenido']);
        $articulo->__set('categoria_id', $_POST['categoria']);
        $articulo->__set('videojuego_id', $_POST['videojuego_id']);

        $daoArticulos = new DaoArticulos();
        $daoArticulos->insertar($articulo);

        $response = [
            'success' => true,
            'message' => '¡El artículo se ha agregado correctamente!'
        ];

        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error: No se recibieron datos del formulario.'
        ];

        echo json_encode($response);
    }
}

function borrarArticulo()
{

    $daoArt = new DaoArticulos();

    if (isset($_POST['id'])) {
        $daoArt->borrar($_POST['id']);
        echo json_encode(["success" => true, 'message' => 'Artículo borrado']);
    } else {
        echo json_encode(["success" => false, 'message' => 'ID no proporcionado']);
    }
}

function obtenerArticulo(){
    $daoArt = new DaoArticulos();

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $art = $daoArt->obtener($id);

        if ($art) {
            echo json_encode($art->toArray());
        } else {
            echo json_encode(['success' => false, 'error' => 'Artículo no encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Método de solicitud no válido']);
    }
}

function editarArticulo()
{
    if (isset($_POST['titulo'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $resumen = $_POST['resumen'];
        $contenido = $_POST['contenido'];
        $categoria_id = $_POST['categoria'];
        $videojuego_id = $_POST['videojuego_id'];

        $articulo = new Articulo();
        $articulo->__set('id', $id);
        $articulo->__set('titulo', $titulo);
        $articulo->__set('resumen', $resumen);
        $articulo->__set('contenido', $contenido);
        $articulo->__set('categoria_id', $categoria_id);
        $articulo->__set('videojuego_id', $videojuego_id);

        $daoArticulos = new DaoArticulos();
        $daoArticulos->actualizar($articulo);

        $response = [
            'success' => true,
            'message' => '¡El artículo se ha editado correctamente!'
        ];

        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error: No se recibieron datos del formulario.'
        ];

        echo json_encode($response);
    }
}
