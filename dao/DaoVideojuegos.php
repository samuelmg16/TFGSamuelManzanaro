<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once __DIR__.'/libreriaPDO.php';
require_once (__DIR__ . '/../clases/Videojuego.php');

class DaoVideojuegos extends DB 
{
   public $videojuegos=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct()  //Al instanciar el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname="gamescore";
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
        $consulta = "SELECT v.*, GROUP_CONCAT(cv.id) AS categorias_id, GROUP_CONCAT(cv.nombre) AS categorias_nombre
                        FROM videojuegos v
                        LEFT JOIN videojuego_categoria vc ON v.id = vc.videojuego_id
                        LEFT JOIN categorias_videojuegos cv ON vc.categoria_id = cv.id
                        GROUP BY v.id";
     $param=array();
     
     $this->videojuegos=array();  //Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $juego= new Videojuego();
        
        $juego->__set("id", $fila['id']);
        $juego->__set("titulo", $fila['titulo']);
        $juego->__set("sinopsis", $fila['sinopsis']);
        $juego->__set("precio", $fila['precio']);
        $juego->__set("fecha_lanzamiento", $fila['fecha_lanzamiento']);
        $juego->__set("portada", $fila['portada']);
        $juego->__set("extension_portada", $fila['extension_portada']);
        $juego->__set("categorias_id", $fila['categorias_id']);
        $juego->__set("categorias_nombre", $fila['categorias_nombre']);
        
        $this->videojuegos[]=$juego;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }

    public function listarCats()       //Lista el contenido de la tabla
    {
        $consulta = "SELECT * FROM categorias_videojuegos";
        $param = array();


        $this->ConsultaDatos($consulta, $param);

        $categorias = array();
        foreach ($this->filas as $fila) {
            $categorias[] = array(
                'id' => $fila['id'],
                'nombre' => $fila['nombre']
            );
        }

        return $categorias;
    }
    
   public function obtener($id)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="SELECT v.*, GROUP_CONCAT(cv.id) AS categorias_id, GROUP_CONCAT(cv.nombre) AS categorias_nombre
                        FROM videojuegos v
                        LEFT JOIN videojuego_categoria vc ON v.id = vc.videojuego_id
                        LEFT JOIN categorias_videojuegos cv ON vc.categoria_id = cv.id
                        where v.id=:id GROUP BY v.id";
       $param=array(":id"=>$id);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
            $fila = $this->filas[0];  //Recuperamos la fila devuelta

            $juego = new Videojuego();

            $juego->__set("id", $fila['id']);
            $juego->__set("titulo", $fila['titulo']);
            $juego->__set("sinopsis", $fila['sinopsis']);
            $juego->__set("precio", $fila['precio']);
            $juego->__set("fecha_lanzamiento", $fila['fecha_lanzamiento']);
            $juego->__set("portada", $fila['portada']);
            $juego->__set("extension_portada", $fila['extension_portada']);
            $juego->__set("categorias_id", $fila['categorias_id']);
            $juego->__set("categorias_nombre", $fila['categorias_nombre']);
           
       }
       else 
       {
           return null;
       }
   
       return $juego;
   }

   public function obtenerPorTitulo($titulo)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="SELECT v.*, GROUP_CONCAT(cv.id) AS categorias_id, GROUP_CONCAT(cv.nombre) AS categorias_nombre
                        FROM videojuegos v
                        LEFT JOIN videojuego_categoria vc ON v.id = vc.videojuego_id
                        LEFT JOIN categorias_videojuegos cv ON vc.categoria_id = cv.id
                        where v.titulo=:titulo GROUP BY v.id";
       $param=array(":titulo"=>$titulo);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
            $fila = $this->filas[0];  //Recuperamos la fila devuelta

            $juego = new Videojuego();

            $juego->__set("id", $fila['id']);
            $juego->__set("titulo", $fila['titulo']);
            $juego->__set("sinopsis", $fila['sinopsis']);
            $juego->__set("precio", $fila['precio']);
            $juego->__set("fecha_lanzamiento", $fila['fecha_lanzamiento']);
            $juego->__set("portada", $fila['portada']);
            $juego->__set("extension_portada", $fila['extension_portada']);
            $juego->__set("categorias_id", $fila['categorias_id']);
            $juego->__set("categorias_nombre", $fila['categorias_nombre']);
           
       }
       else 
       {
           return null;
       }
   
       return $juego;
   }
   
   
   public function borrar($id)      //Elimina de la tabla
   {
       $consulta="delete from videojuegos where id=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaSimple($consulta,$param);
          
   }
   
   public function insertar($juego)      //Recibe como parámetro un objeto
   {
      $consulta="insert into videojuegos values(NULL,
                                            :titulo,
                                            :sinopsis,
                                            :precio, 
                                            :fecha_lanzamiento,
                                            :portada,
                                            :extension_portada)";
       
      $param=array();
      
      $param[":titulo"]=$juego->__get("titulo");
      $param[":sinopsis"]=$juego->__get("sinopsis");
      $param[":precio"]=$juego->__get("precio");
      $param[":fecha_lanzamiento"]=$juego->__get("fecha_lanzamiento");
      $param[":portada"]=$juego->__get("portada");
      $param[":extension_portada"]=$juego->__get("extension_portada");
      
      $this->ConsultaSimple($consulta,$param);
      $categorias_id = explode(",", $juego->__get("categorias_id"));
      $juego2 = $this->obtenerPorTitulo($juego->__get("titulo"));
      $juegoId = $juego2->__get("id");
    foreach ($categorias_id as $categoria_id) {
        $consulta = "INSERT INTO videojuego_categoria (videojuego_id, categoria_id)
                     VALUES (:videojuego_id, :categoria_id)";
        $param = array(
            ":videojuego_id" => $juegoId,
            ":categoria_id" => $categoria_id
        );
        $this->ConsultaSimple($consulta, $param);
    }
   
   }

    public function actualizar($juego)     //Recibimos como parámetro un objeto con los datos a actualizar   
    {
        // 1. Actualizar la fila en la tabla videojuegos
        $consulta = "UPDATE videojuegos 
    SET titulo = :titulo, 
        sinopsis = :sinopsis, 
        precio = :precio, 
        fecha_lanzamiento = :fecha_lanzamiento
    WHERE id = :id";
        $param = array(
                ":id" => $juego->__get("id"),
                ":titulo" => $juego->__get("titulo"),
                ":sinopsis" => $juego->__get("sinopsis"),
                ":precio" => $juego->__get("precio"),
                ":fecha_lanzamiento" => $juego->__get("fecha_lanzamiento"),
            );
        $this->ConsultaSimple($consulta, $param);

        // 2. Eliminar todas las asociaciones existentes entre el juego y las categorías en la tabla videojuego_categoria
        $consulta = "DELETE FROM videojuego_categoria WHERE videojuego_id = :id";
        $param = array(":id" => $juego->__get("id"));
        $this->ConsultaSimple($consulta, $param);

        // 3. Insertar las nuevas asociaciones entre el juego y las categorías en la tabla videojuego_categoria
        $categorias_id = explode(",", $juego->__get("categorias_id"));
        foreach ($categorias_id as $categoria_id) {
            $consulta = "INSERT INTO videojuego_categoria (videojuego_id, categoria_id)
        VALUES (:videojuego_id, :categoria_id)";
            $param = array(
                    ":videojuego_id" => $juego->__get("id"),
                    ":categoria_id" => $categoria_id
                );
            $this->ConsultaDatos($consulta, $param);
        }
    }




}

?>