<?php
require_once __DIR__ . '/../../dao/DaoUsuarios.php';
function obtenerUsuario()
{
    $daoUsuario = new DaoUsuarios();

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $usuario = $daoUsuario->obtenerPorId($id);

        if ($usuario) {
            echo json_encode($usuario->toArray());
        } else {
            echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
    }
}

function editarUsuario()
{
    if (isset($_POST['username'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['correo'];
        $rol = $_POST['rol'];

        $usuario = new Usuario();
        $usuario->__set("id", $id);
        $usuario->__set("username", $username);
        $usuario->__set("email", $email);
        $usuario->__set("rol", $rol);

        $daoUsuario = new DaoUsuarios();
        $daoUsuario->actualizar($usuario);

        $response = [
            'success' => true,
            'message' => '¡El usuario se ha editado correctamente!',
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

function borrarUsuario()
{
    $daoUsuario = new DaoUsuarios();

    if (isset($_POST['id'])) {
        $daoUsuario->borrar($_POST['id']);
        echo json_encode(["success" => true, 'message' => 'Usuario borrado']);
    } else {
        echo json_encode(["success" => false, 'message' => 'ID no proporcionado']);
    }
}
?>