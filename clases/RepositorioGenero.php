<?php
require_once 'Repositorio.php';
require_once 'Genero.php';

class Repositorio_Genero extends Repositorio
{
    public function getAll($codigo_genero = null)
    {
        $sql = "SELECT * FROM genero ";

        if ($codigo_genero != null) {
            $sql .= "WHERE codigo_genero = ? ";
        }
        $sql .= ";";

        $query = self::$conexion->prepare($sql);

        if ($codigo_genero) {
            $query->bind_param("i", $codigo_genero);
        }

        if ($query->execute()) {
            $query->bind_result(
                $codigo_genero,
                $nombre,
            );

            $generos = [];

            while ($query->fetch()) {
                $g = new Genero($codigo_genero, $nombre);
                $generos[] = $g;
            }
            return $generos;
        }
    }
}