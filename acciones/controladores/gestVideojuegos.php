<?php
require_once __DIR__ . '/../../dao/DaoVideojuegos.php';
function borrarVideojuego()
{

    $daoJuego = new DaoVideojuegos();

    if (isset($_POST['id'])) {
        $daoJuego->borrar($_POST['id']);
        echo json_encode(["success" => true, 'message' => 'Videojuego borrado']);
    } else {
        echo json_encode(["success" => false, 'message' => 'ID no proporcionado']);
    }
}

function obtenerVideojuego(){
    $daoJuego = new DaoVideojuegos();

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $videojuego = $daoJuego->obtener($id);

        if ($videojuego) {
            echo json_encode($videojuego->toArray());
        } else {
            echo json_encode(['success' => false, 'error' => 'Videojuego no encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Método de solicitud no válido']);
    }
}

function crearVideojuego(){
    if (isset($_POST['titulo'])) {
        $titulo = $_POST['titulo'];
        $sinopsis = $_POST['sinopsis'];
        $precio = $_POST['precio'];
        $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
        $portada = $_FILES['portada'];

        $conte=file_get_contents($_FILES['portada']['tmp_name']);
            
        
        $extension_portada = pathinfo($portada['name'], PATHINFO_EXTENSION);
    
        // Procesar las categorías seleccionadas
        $categorias_id = isset($_POST['categorias']) ? $_POST['categorias'] : [];
    
        // Crear un nuevo objeto Videojuego y asignar propiedades
        $videojuego = new Videojuego();
        $videojuego->__set("titulo", $titulo);
        $videojuego->__set("sinopsis", $sinopsis);
        $videojuego->__set("precio", $precio);
        $videojuego->__set("fecha_lanzamiento", $fecha_lanzamiento);
        $videojuego->__set("portada", $conte); // Guardamos la ruta de la imagen, no la imagen en sí
        $videojuego->__set("extension_portada", $extension_portada);
        $videojuego->__set("categorias_id", implode(",", $categorias_id)); // Convertir array de categorías a string para almacenar en BD
    
        // Insertar el nuevo videojuego en la base de datos
        $daoJuego = new DaoVideojuegos();
        $daoJuego->insertar($videojuego);
    
        // Preparar respuesta JSON
        $response = [
            'success' => true,
            'message' => '¡El videojuego se ha creado correctamente!',
        ];
    
        echo json_encode($response);
    }
}

function editarVideojuego(){
    if (isset($_POST['titulo'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $sinopsis = $_POST['sinopsis'];
        $precio = $_POST['precio'];
        $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
    
        // Procesar las categorías seleccionadas
        $categorias_id = isset($_POST['categorias']) ? $_POST['categorias'] : [];
    
        // Crear un nuevo objeto Videojuego y asignar propiedades
        $videojuego = new Videojuego();
        $videojuego->__set("id", $id);
        $videojuego->__set("titulo", $titulo);
        $videojuego->__set("sinopsis", $sinopsis);
        $videojuego->__set("precio", $precio);
        $videojuego->__set("fecha_lanzamiento", $fecha_lanzamiento);
        $videojuego->__set("categorias_id", implode(",", $categorias_id)); // Convertir array de categorías a string para almacenar en BD
    
        // Insertar el nuevo videojuego en la base de datos
        $daoJuego = new DaoVideojuegos();
        $daoJuego->actualizar($videojuego);
    
        // Preparar respuesta JSON
        $response = [
            'success' => true,
            'message' => '¡El videojuego se ha editado correctamente!',
        ];
    
        echo json_encode($response);
    }
}
?>