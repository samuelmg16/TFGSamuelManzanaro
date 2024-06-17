<?php

class Comentario
{
    private $id;
    private $user_id;
    private $user_username;
    private $article_id;
    private $contenido;
    private $num_likes;
    private $fecha_creacion;
    
    
    public function __get($propiedad)
    {
        return $this->$propiedad;
    }
    
    public function __set($propiedad,$valor)
    {
        $this->$propiedad=$valor;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_username' => $this->user_username,
            'article_id' => $this->article_id,
            'contenido' => $this->contenido,
            'num_likes' => $this->num_likes,
            'fecha_creacion' => $this->fecha_creacion
        ];
    }
    
}



?>
