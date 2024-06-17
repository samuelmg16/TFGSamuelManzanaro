<?php
require_once __DIR__ . '/../../dao/DaoComentarios.php';

function crearComentario(){
    $daoCom = new DaoComentarios();
    $comentario = new Comentario();
    $comentario->__set('user_id', $_POST['user_id']);
    $comentario->__set('article_id', $_POST['article_id']);
    $comentario->__set('contenido', $_POST['contenido']);

    $daoCom->insertar($comentario);

    echo json_encode(['success' => true, 'message' => 'Comentario creado correctamente']);
}

function likes(){
    if(!isset($_SESSION)){
        session_start();
    }
    
    if (isset($_SESSION['user_id']) && isset($_POST['comentario_id'])) {
        $userId = $_SESSION['user_id'];
        $comentarioId = $_POST['comentario_id'];
        $likeado = $_POST['likeado'] === 'true';
    
        $daoComentarios = new DaoComentarios();
    
        if ($likeado) {
            $result = $daoComentarios->quitarLike($userId, $comentarioId);
        } else {
            $result = $daoComentarios->agregarLike($userId, $comentarioId);
        }
    
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Like dado/quitado']);
        }
    } else{
        echo json_encode(['success' => false, 'message' => 'Datos no recogidos']);
    }
}

function borrarComentario(){
    if (isset($_POST["comentario_id"])) {
        $comentarioId = $_POST["comentario_id"];

        $daoComentarios = new DaoComentarios();
        $daoComentarios->borrar($comentarioId);

        echo json_encode(["success" => true, 'message' => 'Comentario borrado']);
        
    } else{
        echo json_encode(["success" => false, "message" => "No se pudo eliminar el comentario"]);
    }
}



?>