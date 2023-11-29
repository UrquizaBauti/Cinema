<?php
require_once 'clases/ControladorPeliculas.php';

session_start();
$cp = new ControladorPeliculas();

$peliculas = $cp->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tus peliculas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>



<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-center" href="index.php">
                <img src="./assets/brand/logo.jpg" alt="" width="150" height="50" class="d-inline-block align-text-top ">
            </a>
            <h2>Bienvenido a <strong>Tus películas</strong></h2>
            <div container>
                <a href="login.php"><button type="button" id="boton" class="btn btn-outline-primary">Login</button></a>

                <!-- Temporal, debería mostrar el nombre de usuario y desaparecer el botón de login -->
                <a href="logout.php"><button type="button" id="Sesion" class="btn btn-outline-primary">Cerrar sesion</button></a>
                <a href="administrador.php"><button type="button" id="admin" class="btn btn-outline-secondary">Admin</button></a>
            </div>

        </div>
    </nav>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <!-- fin alerta -->
                <div class="card">
                    <div class="card-header">
                        Lista de peliculas agregadas por usuarios
                    </div>
                    <div class="p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Titulo</th>
                                    <th scope="col" class="text-center">Año</th>
                                    <th scope="col" class="text-center">Genero</th>
                                    <th scope="col" class="text-center">Reseña</th>
                                    <th scope="col" class="text-center">Disponibilidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($peliculas) === 0) {
                                    echo '<tr>
                <th colspan="6" class="text-center"><h2>No se agregaron películas aún</h2></th>
            </tr>';
                                } else {
                                    foreach ($peliculas as $pelicula) {
                                        echo '<tr>
                    <th scope="col" class="text-secondary text-center">' . $pelicula->getTitulo() . '</th>
                    <th scope="col" class="text-secondary text-center">' . $pelicula->getAnio() . '</th>
                    <th scope="col" class="text-secondary text-center">' . $pelicula->getGenero()->getNombre() . '</th>
                    <th scope="col" class="text-secondary text-center">' . $pelicula->getResenia() . '</th>
                    <th scope="col" class="text-secondary text-center">';

                                        // Verificar disponibilidad y mostrar el enlace correspondiente
                                        if ($pelicula->getDisponibilidad() === "Torrent") {
                                            echo '<a href="https://www.utorrent.com/">Torrent</a>';
                                        } elseif ($pelicula->getDisponibilidad() === "Mega") {
                                            echo '<a href="https://mega.io/es">Mega</a>';
                                        } elseif ($pelicula->getDisponibilidad() === "Mediafire") {
                                            echo '<a href="https://www.mediafire.com/">Mediafire</a>';
                                        } else {
                                            echo 'No disponible';
                                        }
                                        echo '</th>
                </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="mt-3 mb-3 text-muted fixed-bottom text-center">&copy; Tus peliculas | Bautista Di Benedetto </p>
            </div>


            <script>
                <?php

                if (isset($_SESSION['usuario'])) {
                    echo 'document.getElementById("boton").style.display = "none";';
                    echo 'document.getElementById("Sesion").style.display = "block";';
                    echo 'document.getElementById("admin").style.display = "block";';
                } else {
                    echo 'document.getElementById("boton").style.display = "block";';
                    echo 'document.getElementById("Sesion").style.display = "none";';
                    echo 'document.getElementById("admin").style.display = "none";';
                }
                ?>
            </script>

</body>

</html>