<?php

require_once __DIR__ . '/libreriaPDO.php';
require_once __DIR__ . '/../clases/Comentario.php';

class DaoComentarios extends DB 
{
   public $comentarios = array();  // Array de objetos con el resultado de las consultas
    
   public function __construct()  
   {
       $this->dbname = "gamescore";
   }
    
   public function listar()       
   {
     $consulta = "SELECT c.*, u.username as user_username 
                    FROM comentarios c
                    INNER JOIN usuarios u ON c.user_id = u.id";
     $param = array();
     
     $this->comentarios = array();  // Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach ($this->filas as $fila)
     {
        $comentario = new Comentario();
        
        $comentario->__set("id", $fila['id']);
        $comentario->__set("user_id", $fila['user_id']);
        $comentario->__set("user_username", $fila['user_username']); // Almacenamos el nombre de usuario
        $comentario->__set("videojuego_id", $fila['videojuego_id']);
        $comentario->__set("contenido", $fila['contenido']);
        $comentario->__set("fecha_creacion", $fila['fecha_creacion']);
        $comentario->__set("num_likes", $fila['num_likes']);
        
        $this->comentarios[] = $comentario;   // Insertamos el objeto con los valores de esa fila en el array de objetos
     }
   }
    
   public function obtener($id)          
   {
       $consulta = "SELECT c.*, u.username as user_username 
                    FROM comentarios c
                    INNER JOIN usuarios u ON c.user_id = u.id
                    WHERE c.id = :id";
       $param = array(":id" => $id);
        
       $this->ConsultaDatos($consulta, $param);
       
       if (count($this->filas) == 1)
       {
           $fila = $this->filas[0];  // Recuperamos la fila devuelta
           
           $comentario = new Comentario();
           
           $comentario->__set("id", $fila['id']);
           $comentario->__set("user_id", $fila['user_id']);
           $comentario->__set("user_username", $fila['user_username']); // Almacenamos el nombre de usuario
           $comentario->__set("videojuego_id", $fila['videojuego_id']);
           $comentario->__set("contenido", $fila['contenido']);
           $comentario->__set("fecha_creacion", $fila['fecha_creacion']);
           $comentario->__set("num_likes", $fila['num_likes']);
           
           return $comentario;
       }
       else 
       {
           return null;
       }
   }

   public function listarPorArticulo($articuloId)          
   {
       $consulta = "SELECT c.*, u.username as user_username 
                    FROM comentarios c
                    INNER JOIN usuarios u ON c.user_id = u.id
                    WHERE c.article_id = :article_id
                    ORDER BY fecha_creacion DESC";
       $param = array(":article_id" => $articuloId);
        
       $this->ConsultaDatos($consulta, $param);
       
       $this->comentarios = array();  // Vaciamos el array entre consulta y consulta
       
       foreach ($this->filas as $fila)
       {
          $comentario = new Comentario();
          
          $comentario->__set("id", $fila['id']);
          $comentario->__set("user_id", $fila['user_id']);
          $comentario->__set("user_username", $fila['user_username']); // Almacenamos el nombre de usuario
          $comentario->__set("article_id", $fila['article_id']);
          $comentario->__set("contenido", $fila['contenido']);
          $comentario->__set("num_likes", $fila['num_likes']);
          $comentario->__set("fecha_creacion", $fila['fecha_creacion']);
          
          $this->comentarios[] = $comentario;   // Insertamos el objeto con los valores de esa fila en el array de objetos
       }
   }
   
   public function borrar($id)      
   {
       $consulta = "DELETE FROM comentarios WHERE id = :id";
       $param = array(":id" => $id);
        
       $this->ConsultaSimple($consulta, $param);
   }
   
   public function insertar($comentario)      
   {
      $consulta = "INSERT INTO comentarios (user_id, article_id, contenido, num_likes, fecha_creacion) 
                   VALUES (:user_id, :article_id, :contenido, 0, NOW())";
       
      $param = array();
      
      $param[":user_id"] = $comentario->__get("user_id");
      $param[":article_id"] = $comentario->__get("article_id");
      $param[":contenido"] = $comentario->__get("contenido");
      
      $this->ConsultaSimple($consulta, $param);
   }

   public function verificarLike($userId, $comentarioId) {
    $consulta = "SELECT * FROM likes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id";
    $parametros = array(':user_id' => $userId, ':comentario_id' => $comentarioId);
    $this->ConsultaDatos($consulta, $parametros);
    if (count($this->filas) > 0){
        return true;
    } else {
        return false;
    }
    
}

    public function agregarLike($userId, $comentarioId) {
        try{

            $consulta = "INSERT INTO likes_comentarios (user_id, comentario_id) VALUES (:user_id, :comentario_id)";
            $parametros = array(':user_id' => $userId, ':comentario_id' => $comentarioId);
            $this->ConsultaSimple($consulta, $parametros);

            $consulta = "UPDATE comentarios SET num_likes = num_likes + 1 WHERE id = :comentario_id";
            $parametros = array(':comentario_id' => $comentarioId);
            $this->ConsultaSimple($consulta, $parametros);

            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function quitarLike($userId, $comentarioId) {

        try{

            $consulta = "DELETE FROM likes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id";
            $parametros = array(':user_id' => $userId, ':comentario_id' => $comentarioId);
            $this->ConsultaSimple($consulta, $parametros);

            $consulta = "UPDATE comentarios SET num_likes = num_likes - 1 WHERE id = :comentario_id";
            $parametros = array(':comentario_id' => $comentarioId);
            $this->ConsultaSimple($consulta, $parametros);

            return true;
        } catch (Exception $e){
            return false;
        }
    }

}

?>
