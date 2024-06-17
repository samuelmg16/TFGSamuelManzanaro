<?php

//Necesitamos incluir la libreria y la clase asociada al DAO

require_once __DIR__ . '/libreriaPDO.php';
require_once __DIR__ . '/../clases/Articulo.php';

class DaoArticulos extends DB 
{
   public $articulos=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct()  //Al instanciar el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname="gamescore";
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="SELECT articulos.*, ca.nombre as `categoria_nombre` from articulos INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id ORDER BY id ASC";
     $param=array();
     
     $this->articulos=array();  //Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $art= new Articulo();
        
        $art->__set("id", $fila['id']);
        $art->__set("user_id", $fila['user_id']);
        $art->__set("categoria_id", $fila['categoria']);
        $art->__set("categoria_nombre", $fila['categoria_nombre']);
        $art->__set("titulo", $fila['titulo']);
        $art->__set("resumen", $fila['resumen']);
        $art->__set("contenido", $fila['contenido']);
        $art->__set("videojuego_id", $fila['videojuego_id']);
        $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
        
        $this->articulos[]=$art;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }

   public function listarArticulosRecomendados() {
    // Consulta SQL para obtener los artículos con la mayor cantidad de comentarios
    $consulta = "
        SELECT articulos.*, ca.nombre AS categoria_nombre, COUNT(comentarios.id) AS total_comentarios
        FROM articulos
        INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id
        LEFT JOIN comentarios ON articulos.id = comentarios.article_id
        GROUP BY articulos.id
        ORDER BY total_comentarios DESC
        LIMIT 2
    ";

    
    $this->articulos = array(); // Vaciamos el array entre consulta y consulta
    
    $this->ConsultaDatos($consulta);
    
    foreach ($this->filas as $fila) {
        $art = new Articulo();
        
        $art->__set("id", $fila['id']);
        $art->__set("user_id", $fila['user_id']);
        $art->__set("categoria_id", $fila['categoria']);
        $art->__set("categoria_nombre", $fila['categoria_nombre']);
        $art->__set("titulo", $fila['titulo']);
        $art->__set("resumen", $fila['resumen']);
        $art->__set("contenido", $fila['contenido']);
        $art->__set("videojuego_id", $fila['videojuego_id']);
        $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
        $art->__set("total_comentarios", $fila['total_comentarios']);
        
        $this->articulos[] = $art; // Insertamos el objeto con los valores de esa fila en el array de objetos
    }
  }

  public function listarArticulosRecientes() {
    // Consulta SQL para obtener los artículos más recientes ordenados por fecha de publicación
    $consulta = "
        SELECT articulos.*, ca.nombre AS categoria_nombre
        FROM articulos
        INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id
        ORDER BY articulos.fecha_publicacion DESC
        LIMIT 2
    ";
    
    $this->articulos = array(); // Vaciamos el array entre consulta y consulta
    
    $this->ConsultaDatos($consulta);
    
    foreach ($this->filas as $fila) {
        $art = new Articulo();
        
        $art->__set("id", $fila['id']);
        $art->__set("user_id", $fila['user_id']);
        $art->__set("categoria_id", $fila['categoria']);
        $art->__set("categoria_nombre", $fila['categoria_nombre']);
        $art->__set("titulo", $fila['titulo']);
        $art->__set("resumen", $fila['resumen']);
        $art->__set("contenido", $fila['contenido']);
        $art->__set("videojuego_id", $fila['videojuego_id']);
        $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
        
        $this->articulos[] = $art; // Insertamos el objeto con los valores de esa fila en el array de objetos
    }
  }

   public function listarNoticias()       //Lista el contenido de la tabla
   {
     $consulta="SELECT articulos.*, ca.nombre as `categoria_nombre` from articulos INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id WHERE categoria=2";
     $param=array();
     
     $this->articulos=array();  //Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $art= new Articulo();
        
        $art->__set("id", $fila['id']);
        $art->__set("user_id", $fila['user_id']);
        $art->__set("categoria_id", $fila['categoria']);
        $art->__set("categoria_nombre", $fila['categoria_nombre']);
        $art->__set("titulo", $fila['titulo']);
        $art->__set("resumen", $fila['resumen']);
        $art->__set("contenido", $fila['contenido']);
        $art->__set("videojuego_id", $fila['videojuego_id']);
        $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
        
        $this->articulos[]=$art;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }

   public function listarReviews()       //Lista el contenido de la tabla
   {
     $consulta="SELECT articulos.*, ca.nombre as `categoria_nombre` from articulos INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id WHERE categoria=1";
     $param=array();
     
     $this->articulos=array();  //Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $art= new Articulo();
        
        $art->__set("id", $fila['id']);
        $art->__set("user_id", $fila['user_id']);
        $art->__set("categoria_id", $fila['categoria']);
        $art->__set("categoria_nombre", $fila['categoria_nombre']);
        $art->__set("titulo", $fila['titulo']);
        $art->__set("resumen", $fila['resumen']);
        $art->__set("contenido", $fila['contenido']);
        $art->__set("videojuego_id", $fila['videojuego_id']);
        $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
        
        $this->articulos[]=$art;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
    
   public function obtener($id)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select articulos.*, ca.nombre as `categoria_nombre` from articulos INNER JOIN categorias_articulo ca ON articulos.categoria = ca.id where articulos.id=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $art= new Articulo();
           
            $art->__set("id", $fila['id']);
            $art->__set("user_id", $fila['user_id']);
            $art->__set("categoria_id", $fila['categoria']);
            $art->__set("categoria_nombre", $fila['categoria_nombre']);
            $art->__set("titulo", $fila['titulo']);
            $art->__set("resumen", $fila['resumen']);
            $art->__set("contenido", $fila['contenido']);
            $art->__set("videojuego_id", $fila['videojuego_id']);
            $art->__set("fecha_publicacion", $fila['fecha_publicacion']);
           
       }
       else 
       {
           echo "<b>El id introducido no corresponde con ningun artículo</b>";
       }
   
       return $art;
   }
   
   public function borrar($id)      //Elimina de la tabla
   {
       $consulta="delete from Articulos where id=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaSimple($consulta,$param);
          
   }
   
   public function insertar($art)      //Recibe como parámetro un objeto
   {
      $consulta="INSERT into articulos values(NULL,
                                            :user_id,
                                            :categoria,
                                            :titulo, 
                                            :resumen,
                                            :contenido,
                                            :videojuego_id,
                                            NOW() )";
       
      $param=array();
      
      
      $param[":user_id"]=$art->__get("user_id");
      $param[":categoria"]=$art->__get("categoria_id");
      $param[":titulo"]=$art->__get("titulo");
      $param[":resumen"]=$art->__get("resumen");
      $param[":contenido"]=$art->__get("contenido");
      $param[":videojuego_id"]=$art->__get("videojuego_id");
      
      $this->ConsultaSimple($consulta,$param);
   
   }

   public function actualizar($art)     //Recibimos como parámetro un objeto con los datos a actualizar   
   { 
       $consulta="update articulos set categoria=:categoria,
                                     titulo=:titulo,
                                     resumen=:resumen, 
                                     contenido=:contenido,    
                                     videojuego_id=:videojuego_id
                                     where id=:id";
       
       $param=array();
       
       $param[":id"]=$art->__get("id");
       $param[":categoria"]=$art->__get("categoria_id");
       $param[":titulo"]=$art->__get("titulo");
       $param[":resumen"]=$art->__get("resumen");
       $param[":contenido"]=$art->__get("contenido");
       $param[":videojuego_id"]=$art->__get("videojuego_id");
       
       $this->ConsultaSimple($consulta,$param);
       
   }




}

?>