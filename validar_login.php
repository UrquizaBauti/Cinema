<?php
require_once 'clases/ControladorSesion.php';

if (empty($_POST['usuario']) || empty($_POST['clave'])) {
    $redirigir = 'login.php?mensaje=Error: Todos los campos son obligatorios';
} else {
    $cs = new Controlador_Sesion();
    $login = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($login[0] === true) {
        $redirigir = 'index.php';
    } else {
        $redirigir = 'login.php?mensaje=' . $login[1];
    }
}
header('Location: '.$redirigir);