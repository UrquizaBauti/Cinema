<?php
require_once 'RepositorioPelicula.php';

class ControladorPeliculas
{
    public $id_usuario;
    protected $rp;

    public function __construct($id_usuario = null)
    {
        $this->id_usuario = $id_usuario;
        $this->rp = new Repositorio_Pelicula();
    }

    public function getAll()
    {
        return $this->rp->get_all();
    }

    public function getPeliculasPropias($id_usuario)
    {
        return $this->rp->get_all($id_usuario);
    }

    public function agregarPelicula(Pelicula $pelicula)
    {
        return $this->rp->agregar($pelicula);
    }

    public function modificarPelicula(Pelicula $pelicula)
    {
        return $this->rp->modificar($pelicula);
    }

    public function borrarPelicula($id_pelicula)
    {
        return $this->rp->borrar($id_pelicula);
    }
}