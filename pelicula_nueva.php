<?php
require_once 'clases/ControladorPeliculas.php';
require_once 'clases/RepositorioGenero.php';
require_once 'clases/Pelicula.php';
require_once 'clases/Usuario.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

$id_pelicula = null;
if (isset($_GET['id_pelicula'])) {
    $id_pelicula = $_GET['id_pelicula'];
}

if (isset($_POST['titulo']) && isset($_POST['anio']) && isset($_POST['genero'])) {
    $cp = new ControladorPeliculas($usuario->getId());
    $rg = new Repositorio_Genero();
    $genero = $rg->getAll(($_POST['genero']))[0];

    $mensaje = "";
    if ($id_pelicula) {
        $pelicula = new Pelicula(($_POST['titulo']), ($_POST['anio']), $genero, ($_POST['disponibilidad']), ($_POST['resenia']), $usuario->getId(), $id_pelicula);
        $mensaje .= "Película modificada correctamente";
        $result = $cp->modificarPelicula($pelicula);
    } else {
        $pelicula = new Pelicula(($_POST['titulo']), ($_POST['anio']), $genero, ($_POST['disponibilidad']), ($_POST['resenia']), $usuario->getId());
        $mensaje .= "Película creada correctamente";
        $result = $cp->agregarPelicula($pelicula);
    }
    if ($result) {
        $redirigir = 'pelicula_nueva.php?mensaje=' . $mensaje . '&tipo=success';
    } else {
        $mensaje .= "Error al crear la película";
        $redirigir = 'pelicula_nueva.php?mensaje=' . $mensaje . '&tipo=danger';
    }
    header('Location: ' . $redirigir);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Formulario de Película</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-center" href="index.php">
                <img src="./assets/brand/logo.jpg" alt="" width="150" height="50"
                    class="d-inline-block align-text-top" />
            </a>
            <h2>Agregar nueva película</h2>
            <a href="index.php">
                <button type="button" class="btn btn-outline-secondary">
                    Inicio
                </button>
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje" class="alert alert-' . ($_GET['tipo']) . ' text-center" role="alert">
                    <p>' . $_GET['mensaje'] . '</p></div>';
        }
        ?>
        <h2 class="mb-4">Formulario de Película</h2>
        <form action="pelicula_nueva.php?id_pelicula=<?php echo $id_pelicula ?>" method="post">

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" required value=<?php echo $id_pelicula ? $_GET['titulo'] : '' ?>>
            </div>

            <div class="form-group">
                <label for="anio">Año:</label>
                <input type="number" class="form-control" name="anio" required value=<?php echo $id_pelicula ? $_GET['anio'] : '' ?>>
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <?php
                $rg = new Repositorio_Genero();
                $generos = $rg->getAll();

                echo '<select class="form-control" name="genero">';

                foreach ($generos as $g) {
                    // Selecciona un genero en caso de editar pelicula
                    $selected = ''. $id_pelicula ? ($_GET['genero'] == $g->getCodigo_genero() ? 'selected' : '') : '';
                    echo '<option value="' . $g->getCodigo_genero() . '" ' . $selected . '>' . $g->getNombre() . '</option>';
                }
                echo '</select>';
                ?>
            </div>

            <div class="form-group">
    <label for="disponibilidad">Disponibilidad:</label>
    <select class="form-control" name="disponibilidad" id="disponibilidadSelect">
        <option value="Torrent" <?php echo $id_pelicula ? ($_GET['disponibilidad'] === "Torrent" ? 'selected' : '') : '' ?>>Torrent</option>
        <option value="Mega" <?php echo $id_pelicula ? ($_GET['disponibilidad'] === "Mega" ? 'selected' : '') : '' ?>>Mega</option>
        <option value="Mediafire" <?php echo $id_pelicula ? ($_GET['disponibilidad'] === "Mediafire" ? 'selected' : '') : '' ?>>Mediafire</option>
        <option value="No disponible" <?php echo $id_pelicula ? ($_GET['disponibilidad'] === "No disponible" ? 'selected' : '') : '' ?>>No disponible</option>
    </select>
</div>

<script>
    var selectElement = document.getElementById('disponibilidadSelect');
    selectElement.addEventListener('change', function() {
        var selectedValue = selectElement.value;
        var link = '';

        switch (selectedValue) {
            case 'Torrent':
                link = 'https://www.utorrent.com/';
                break;
            case 'Mega':
                link = 'https://mega.io/es'; 
                break;
            case 'Mediafire':
                link = 'https://www.mediafire.com/'; 
                break;
            default:
                link = '#'; 
        }

        var availabilityLink = document.getElementById('availabilityLink');
        availabilityLink.href = link;
    });
</script>

<!-- Un enlace oculto por defecto que se llenará dinámicamente -->
<a id="availabilityLink" href="#" style="display: none;">Ver Disponibilidad</a>

            <div class="form-group">
                <label for="resenia">Reseña:</label>
                <textarea class="form-control" name="resenia" rows="4"><?php echo $id_pelicula ? $_GET['resenia'] : '' ?></textarea>
            </div><br>

            <button type="submit" class="btn btn-primary">Enviar</button>
            <a href="administrador.php" class="btn btn-secondary">Volver</a>
        </form>
        <p class="mt-3 mb-3 text-muted fixed-bottom text-center">
            &copy; Tus peliculas | Bautista Di Benedetto
        </p>
    </div>

</body>

</html>