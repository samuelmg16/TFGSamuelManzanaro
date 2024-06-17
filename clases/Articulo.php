<?php

class Articulo
{
    private $id;
    private $user_id;
    private $categoria_id;
    private $categoria_nombre;
    private $titulo;
    private $resumen;
    private $contenido;
    private $videojuego_id;
    private $fecha_publicacion;
    
    
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
            'categoria_id' => $this->categoria_id,
            'categoria_nombre' => $this->categoria_nombre,
            'titulo' => $this->titulo,
            'resumen' => $this->resumen,
            'contenido' => $this->contenido,
            'videojuego_id' => $this->videojuego_id,
            'fecha_publicacion' => $this->fecha_publicacion
        ];
    }
    
}



?>
