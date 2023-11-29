<?php

class Genero
{

    protected $codigo_genero;
    protected $nombre;

    public function __construct($codigo_genero, $nombre)
    {
        $this->codigo_genero = $codigo_genero;
        $this->nombre = $nombre;
    }

    public function getCodigo_genero()
    {
        return $this->codigo_genero;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    
}
