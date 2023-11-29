<!DOCTYPE html>
<html>

<head>
    <title>Tus peliculas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

    <body class="container">

    <form action="validar_login.php" method="post">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <h2>Ingrese con su usuario:</h2>
                <a class="navbar-center" href="index.php">
                    <img src="./assets/brand/logo.jpg" alt="" width="150" height="50" class="d-inline-block align-text-top ">
                </a>
            </div>
        </nav>
        <div class="text-center">


            <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>' . $_GET['mensaje'] . '</p></div>';
            }
            ?>

            <div class="form-floating mb-4">
                <input name="usuario" class="form-control" id="floatingInput" placeholder="Usuario">
                <label for="floatingInput">Usuario</label>
            </div>

            <div class="form-floating w-100 mb-3">
                <input name="clave" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Ingresar</button>
            <a href="nuevo_usuario.php">Crear cuenta</a>
            <p class="mt-3 mb-3 text-muted fixed-bottom text-center">&copy; Tus peliculas |  Bautista Di Benedetto </p>


</form>
</div>
</body>

</html>