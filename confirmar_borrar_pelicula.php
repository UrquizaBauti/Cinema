<?php
session_start();
$usuario = null;
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <title>Tus películas • Borrar película</title>
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
                <div class="jumbotron text-center">
                    <h1>Películas</h1>
                </div>
                <div class="text-center">
                    <div id="mensaje" class="alert alert-warning text-center">
                        <p>Está por <strong>borrar</strong> la película <strong><?php echo $_GET["titulo"] ?></strong>.
                            Esta acción no se puede deshacer.</p>
                    </div>

                    <form action="borrar_pelicula.php" method="post">
                        <input type="number" name="id_pelicula" hidden value=<?php echo $_GET["id_pelicula"] ?>>
                        <input type="number" name="id_usuario" hidden value=<?php echo $_GET["id_usuario"] ?>>
                        <input type="submit" value="borrar" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>