<?php

class Usuario
{
    private $id;
    private $rol;
    private $nombre_rol;
    private $username;
    private $password;
    private $email;
    private $ultimo_inicio;
    
    
    public function __get($propiedad)
    {
        return $this->$propiedad;
    }
    
    public function __set($propiedad,$valor)
    {
        $this->$propiedad=$valor;
    }
    
    // Método para convertir a array
    public function toArray()
    {
        return [
            'id' => $this->id,
            'rol' => $this->rol,
            'nombre_rol' => $this->nombre_rol,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'ultimo_inicio' => $this->ultimo_inicio
        ];
    }
}



?>
