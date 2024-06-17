<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once __DIR__ . '/libreriaPDO.php';
require_once __DIR__ . '/../clases/Usuario.php';

class DaoUsuarios extends DB 
{
   public $usuarios=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct()  //Al instanciar el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname="gamescore";
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="SELECT usuarios.*, rolusu.nombre as `nombre_rol` from usuarios INNER JOIN rol_usuario rolusu ON usuarios.rol = rolusu.id";
     $param=array();
     
     $this->usuarios=array();  //Vaciamos el array entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $usu= new Usuario();
        
        $usu->__set("id", $fila['id']);
        $usu->__set("rol", $fila['rol']);
        $usu->__set("nombre_rol", $fila['nombre_rol']);
        $usu->__set("username", $fila['username']);
        $usu->__set("password", $fila['password']);
        $usu->__set("email", $fila['email']);
        $usu->__set("ultimo_inicio", $fila['ultimo_inicio']);
        
        $this->usuarios[]=$usu;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
    
   public function obtener($username)          //Obtenemos el elemento a pusuir de su username
   {
       $consulta="SELECT usuarios.*, rolusu.nombre as `nombre_rol` from usuarios INNER JOIN rol_usuario rolusu ON usuarios.rol = rolusu.id WHERE username=:username";
       $param=array(":username"=>$username);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $usu= new Usuario();
           
           $usu->__set("id", $fila['id']);
           $usu->__set("rol", $fila['rol']);
           $usu->__set("nombre_rol", $fila['nombre_rol']);
           $usu->__set("username", $fila['username']);
           $usu->__set("password", $fila['password']);
           $usu->__set("email", $fila['email']);
           $usu->__set("ultimo_inicio", $fila['ultimo_inicio']);
           
       }
       else 
       {
           return null;
       }
   
       return $usu;
   }

   public function obtenerPorId($id)          //Obtenemos el elemento a pusuir de su username
   {
       $consulta="SELECT usuarios.*, rolusu.nombre as `nombre_rol` from usuarios INNER JOIN rol_usuario rolusu ON usuarios.rol = rolusu.id WHERE usuarios.id=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $usu= new Usuario();
           
           $usu->__set("id", $fila['id']);
           $usu->__set("rol", $fila['rol']);
           $usu->__set("nombre_rol", $fila['nombre_rol']);
           $usu->__set("username", $fila['username']);
           $usu->__set("password", $fila['password']);
           $usu->__set("email", $fila['email']);
           $usu->__set("ultimo_inicio", $fila['ultimo_inicio']);
           
       }
       else 
       {
           return null;
       }
   
       return $usu;
   }
   
   public function borrar($id)      //Elimina de la tabla
   {
       $consulta="delete from usuarios where id=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaSimple($consulta,$param);
          
   }
   
   public function insertar($usu)      //Recibe como parámetro un objeto
   {
      $consulta="INSERT into usuarios values(NULL,
                                            :rol,
                                            :username,
                                            :password, 
                                            :email,
                                            NOW())";
       
      $param=array();
      
      $param[":id"]=$usu->__get("id");
      $param[":rol"]=$usu->__get("rol");
      $param[":username"]=$usu->__get("username");
      $param[":password"]=$usu->__get("password");
      $param[":email"]=$usu->__get("email");
      
      $this->ConsultaSimple($consulta,$param);
   
   }

   public function actualizar_ultima_sesion($username)      //Recibe como parámetro un objeto
   {
      $consulta="UPDATE usuarios SET ultimo_inicio=NOW() WHERE username = :username";
       
      $param=array();
      
      $param[":username"]=$username;
      
      $this->ConsultaSimple($consulta,$param);
   
   }

   public function actualizar($usu)     //Recibimos como parámetro un objeto con los datos a actualizar   
   { 
       $consulta="UPDATE usuarios set rol=:rol,
                                     username=:username,
                                     email=:email
                                     where id=:id";
       
       $param=array();
       
       $param[":id"]=$usu->__get("id");
       $param[":rol"]=$usu->__get("rol");
       $param[":username"]=$usu->__get("username");
       $param[":email"]=$usu->__get("email");
       
       $this->ConsultaSimple($consulta,$param);
       
   }




}

?>