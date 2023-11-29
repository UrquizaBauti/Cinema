<?php
require_once 'clases/ControladorPeliculas.php';
require_once './clases/Pelicula.php';

session_start();
if (isset($_SESSION['usuario'])) {

    $usuario = unserialize($_SESSION['usuario']);
} else {

    header('Location: index.php');
}

$cp = new ControladorPeliculas($usuario->getId());

$peliculas = $cp->getPeliculasPropias($usuario->getId());

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <title>Tus películas • Perfil usuario</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-center" href="index.php">
                <img src="./assets/brand/logo.jpg" alt="logo-tus-peliculas" width="150" height="50"
                    class="d-inline-block align-text-top" />
            </a>
            <h2>Perfil administrar</h2>
            <a href="index.php"><button type="button" class="btn btn-outline-secondary">
                    Inicio
                </button></a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <a href="pelicula_nueva.php">
                    <button type="button" class="btn btn-outline-warning  mb-3">
                        Agregar nueva película
                    </button>
                </a>
                <?php
                if (isset($_GET['mensaje'])) {
                    echo '<div id="mensaje" class="alert alert-' . ($_GET['tipo']) . ' text-center" role="alert">
                    <p>' . $_GET['mensaje'] . '</p></div>';
                }
                ?>
                <!-- fin alerta -->
                <div class="card">
                    <div class="card-header">Películas creadas</div>
                    <div class="p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Genero</th>
                                    <th scope="col">Reseña</th>
                                    <th scope="col">Disponibilidad</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($peliculas) === 0) {
                                    echo
                                        '<tr>
                                        <th colspan="6" class="text-center"><h2>No agregó películas aún</h2></th>
                                    </tr>';
                                } else {
                                    foreach ($peliculas as $pelicula) {
                                        echo
                                            '<tr>
                                        <th scope="col" class="text-secondary text-center">' . $pelicula->getTitulo() . '</th>
                                        <th scope="col" class="text-secondary text-center">' . $pelicula->getAnio() . '</th>
                                        <th scope="col" class="text-secondary text-center">' . $pelicula->getGenero()->getNombre() . '</th>
                                        <th scope="col" class="text-secondary text-center">' . $pelicula->getResenia() . '</th>
                                        <th scope="col" class="text-secondary text-center">' . $pelicula->getDisponibilidad() . '</th>
                                        <th scope="col">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-info dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Acciones
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    <li><a href="pelicula_nueva.php?id_pelicula=' . $pelicula->getId() . '&titulo=' . $pelicula->getTitulo() . '&anio=' . $pelicula->getAnio() . '&disponibilidad=' . $pelicula->getDisponibilidad() . '&genero=' . $pelicula->getGenero()->getCodigo_genero() . '&resenia=' . $pelicula->getResenia() . '&id_usuario=' . $usuario->getId() . '" class="dropdown-item">Editar</a></li>
                                                    <li><a href="confirmar_borrar_pelicula.php?id_pelicula=' . $pelicula->getId() . '&titulo=' . $pelicula->getTitulo() . '&id_usuario=' . $usuario->getId() . '" class="dropdown-item">Borrar</a></li>
                                                </ul>
                                            </div>
                                        </th>
                                    </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="mt-3 mb-3 text-muted fixed-bottom text-center">
                    &copy; Tus peliculas |  Bautista Di Benedetto
                </p>
            </div>
        </div>
    </div>
</body>

</html>