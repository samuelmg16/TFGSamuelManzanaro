<?php

class Videojuego
{
    private $id;
    private $titulo;
    private $sinopsis;
    private $precio;
    private $fecha_lanzamiento;
    private $portada;
    private $extension_portada;
    private $categorias_id;
    private $categorias_nombre;
    
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
        $categorias_id = explode(',', $this->categorias_id);
        $categorias_nombre = explode(',', $this->categorias_nombre);
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'sinopsis' => $this->sinopsis,
            'precio' => $this->precio,
            'fecha_lanzamiento' => $this->fecha_lanzamiento,
            'categorias_id' => $categorias_id,
            'categorias_nombre' => $categorias_nombre
        ];
    }
}



?>
