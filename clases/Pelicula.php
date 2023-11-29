<?php
require_once 'Genero.php';
class Pelicula
{
    protected $id;
    protected $titulo;
    protected $anio;
    protected $genero;
    protected $disponibilidad;
    protected $resenia;
    protected $id_usuario;


    public function __construct ($titulo, $anio, Genero $genero, $disponibilidad, $resenia, $id_usuario, $id=null)
    {
        $this->titulo = $titulo;
        $this->anio = $anio;
        $this->genero = $genero;
        $this->disponibilidad = $disponibilidad;
        $this->resenia = $resenia;
        $this->id_usuario = $id_usuario;
        $this->id = $id;
    }


    public function getTitulo() {
	return $this->titulo;
	}

    public function getAnio() {
	return $this->anio;
	}

    public function getGenero() {
	return $this->genero;
	}

    public function getDisponibilidad() {
	return $this->disponibilidad;
	}

    public function getResenia() {
	return $this->resenia;
	}

    public function getIdUsuario() {
        return $this->id_usuario;    
    }

    public function getId() {
	return $this->id;
	}
}