<?php
class Usuario
{
    protected $id;
    protected $nombre_usuario;
    protected $nombre;
    protected $apellido;
    protected $email;

    public function __construct($nombre_usuario, $nombre, $apellido, $email, $id = null)
    {
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->id = $id;
    }

    public function getUsuario()
    {
        return "$this->nombre_usuario";
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEmail(){
        return $this-> email;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }


}
