<?php
require_once 'clases/ControladorPeliculas.php';

session_start();

$usuario = unserialize($_SESSION['usuario']);

if (empty($_POST['id_pelicula'])) {
    header("Location: administrador.php?mensaje=Error al eliminar la película");
    die();
}

$cp = new ControladorPeliculas($usuario->getUsuario());

$result = $cp->borrarPelicula($_POST['id_pelicula']);

if ($result) {
    $redirigir = "administrador.php?mensaje=Película eliminada&tipo=success";
} else {
    $redirigir = "administrador.php?mensaje=Error al eliminar película&tipo=danger";
}

header("Location: $redirigir");