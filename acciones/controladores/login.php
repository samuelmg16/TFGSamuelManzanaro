<?php
require_once __DIR__ . '/../../dao/DaoUsuarios.php';
function iniciarSesion(){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $daoUsu = new DaoUsuarios();
    $usu = $daoUsu->obtener($username);
    if($usu != null){
        if(password_verify($password, $usu->__get("password"))){
            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['user_id'] = $usu->__get("id");
            $_SESSION['username'] = $usu->__get("username");
            $_SESSION['rol'] = $usu->__get("rol");
            $_SESSION['nombre_rol'] = $usu->__get("nombre_rol");
            $_SESSION['email'] = $usu->__get("email");

            $daoUsu->actualizar_ultima_sesion($username);
            echo json_encode(['success' => true, 'message' => 'Sesión iniciada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'El usuario y/o contraseña introducidos son incorrectos']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El usuario y/o contraseña introducidos son incorrectos']);
    }
}

function registrarUsuario(){

    $usu = new Usuario();
    $daoUsu = new DaoUsuarios();

    $usu->__set("rol", 2);
    $usu->__set("username", $_POST['username']);
    $usu->__set("email", $_POST['email']);
    $usu->__set("password", password_hash($_POST['password'], PASSWORD_DEFAULT));

    $usu2 = $daoUsu->obtener($_POST['username']);

    if($usu2 == null){
            $daoUsu->insertar($usu);
            if(!isset($_SESSION)){
                session_start();
            }
            $usu = $daoUsu->obtener($_POST['username']);
            $_SESSION['user_id'] = $usu->__get("id");
            $_SESSION['username'] = $usu->__get("username");
            $_SESSION['rol'] = $usu->__get("rol");
            $_SESSION['nombre_rol'] = $usu->__get("nombre_rol");
            $_SESSION['email'] = $usu->__get("email");

            $daoUsu->actualizar_ultima_sesion($_POST['username']);

            echo json_encode(['success' => true, 'message' => 'Sesión iniciada correctamente, registro completado']);
    } else {
            echo json_encode(['success' => false, 'message' => 'El nombre de usuario escogido ya está registrado']);
    }
}

function cerrarSesion(){
    if(!isset($_SESSION['user_id'])){
        session_start();
    }
    
    session_unset();
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Sesión cerrada']);
}

?>