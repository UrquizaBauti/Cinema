<?php

require_once 'Usuario.php';
require_once 'Pelicula.php';
require_once 'Genero.php';
require_once 'Repositorio.php';

class Repositorio_Pelicula extends Repositorio
{

    public function get_all($id_usuario = null)
    {
        $sql = "SELECT ";
        $sql .= "p.id_pelicula, p.titulo, p.anio,  p.disponibilidad, p.resenia, p.id_usuario, ";
        $sql .= "g.nombre, g.codigo_genero ";
        $sql .= "FROM Peliculas p ";
        $sql .= "INNER JOIN genero g ON p.id_genero = g.codigo_genero ";

        if ($id_usuario) {
            $sql .= "WHERE p.id_usuario = ? ";
        }

        $sql .= "ORDER BY p.id_pelicula;";

        // var_dump($sql); die();
        $query = self::$conexion->prepare($sql);

        if ($id_usuario) {
            // Si el filtro NO es nulo, relacionamos $filtro con el parámetro"?"
            $query->bind_param("i", $id_usuario);
        }

        if ($query->execute()) {

            $query->bind_result(
                $id,
                $titulo,
                $anio,
                $disponibilidad,
                $resenia,
                $id_usuario,
                $nombre_g,
                $id_g
            );

            $peliculas = [];

            while ($query->fetch()) {
                $g = new Genero($id_g, $nombre_g);

                $p = new Pelicula($titulo, $anio, $g, $disponibilidad, $resenia, $id_usuario, $id);

                $peliculas[] = $p;
            }
            return $peliculas;
        }
    }

    public function agregar(Pelicula $p)
    {

        // Preparamos la query del update
        $sql = "INSERT INTO peliculas (titulo, anio, id_genero, id_usuario, resenia, disponibilidad) VALUES (?, ?, ?, ?, ?, ?);";
        $query = self::$conexion->prepare($sql);

        // Obtenemos los nuevos valores desde el objeto:
        $titulo = $p->getTitulo();
        $anio = $p->getAnio();
        $genero = $p->getGenero();
        $disponibilidad = $p->getDisponibilidad();
        $resenia = $p->getResenia();
        $id_usuario = $p->getIdUsuario();


        // Asignamos los valores para reemplazar los "?" en la query
        if (!$query->bind_param("siiiss", $titulo, $anio, $genero->getCodigo_genero(), $id_usuario, $resenia, $disponibilidad)) {
            echo "fallo la consulta";
        }

        // Retornamos true si la query tiene éxito, false si fracasa
        return $query->execute();
    }

    public function borrar($pelicula_id)
    {
        $sql = "DELETE FROM peliculas WHERE id_pelicula = ?;";
        $query = self::$conexion->prepare($sql);

        if (!$query->bind_param("i", $pelicula_id)) {
            echo "fallo la consulta";
        }

        return $query->execute();
    }

    public function modificar(Pelicula $p)
    {
        $sql = "UPDATE peliculas SET titulo = ?, anio = ?, id_genero = ?, disponibilidad = ?, resenia = ? ";
        $sql .= "WHERE id_pelicula = ?;";

        $query = self::$conexion->prepare($sql);

        $titulo = $p->getTitulo();
        $anio = $p->getAnio();
        $genero = $p->getGenero();
        $disponibilidad = $p->getDisponibilidad();
        $resenia = $p->getResenia();
        $id = $p->getId();

        if (!$query->bind_param("siissi", $titulo, $anio, $genero->getCodigo_genero(), $disponibilidad, $resenia, $id)) {
            echo "fallo la consulta";
        }

        return $query->execute();
    }
}