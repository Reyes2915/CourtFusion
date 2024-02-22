<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Courtfusion</title>
  <link rel="icon" href="imagenes/icono.jfif">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link type="text/css" rel="stylesheet" href="css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<?
include "funciones.php";
mostrarNavbar();
if (isset($_POST['buscarpistas'])) {
  mostrarPistasIndex();
}


//Ahora el desplegable
if (isset($_POST['opcion'])) {
  $opcionSeleccionada = $_POST['opcion'];

  // Realiza acciones basadas en la opción seleccionada
  if ($opcionSeleccionada == 'Fútbol') {
    include "NOACCESIBLE/credencialesdb.php";
    $conexion = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
    mysqli_set_charset($conexion, "utf8");
    if ($stmt = mysqli_prepare($conexion, "SELECT * FROM pistas WHERE tipo_pista=?")) {
    } else {
      echo "Error: " . mysqli_error($conexion);
    }
    $stmt->bind_param('s', $opcionSeleccionada);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $tipo, $nombre, $comunidad, $provincia, $municipio, $cp, $correo, $telefono, $precio, $fecha, $idusu);
    $nombresPistas = array();
    while (mysqli_stmt_fetch($stmt)) {
      $nombresPistas[] = strtolower($nombre);
    }
    //Resetea el puntero de la consulta
    mysqli_stmt_data_seek($stmt, 0);
?>
    <div class="container">
      <h1 class="text-center">Listado de Pistas</h1>
      <div class="message">Los filtros de búsqueda se aplican a las 12 pistas actuales.</div>
      <div id="alert-container" class="mt-3">

      </div>
      <div class="row mb-3">
        <div class="col-md-3">
          <div class="filter-container">
            <select id="sport-filter" class="form-select">
              <option value="">Ningún deporte seleccionado</option>
              <option value="Fútbol">Fútbol</option>
              <option value="Baloncesto">Baloncesto</option>
              <option value="Tenis">Tenis</option>
              <option value="Pádel">Pádel</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <!-- Espacio en blanco para mantener la alineación -->
        </div>
        <div class="col-md-3">
          <div class="search-container text-end">
            <input type="text" id="search" class="form-control" data-search="<?= implode(',', $nombresPistas) ?>" placeholder="Buscar tu pista">
          </div>
        </div>
      </div>
      <div class="row text-center">
        <?php
        $contador = 0;
        $itemsPerPage = 12; // Cantidad de tarjetas por página
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($currentPage - 1) * $itemsPerPage;

        // Realiza la consulta SQL aquí, dependiendo de los filtros seleccionados
        // ...

        while (mysqli_stmt_fetch($stmt)) {
          // Comprueba si la pista está en favoritos
          $conexion2 = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexión a MySQL: ' . mysqli_connect_error() . '<br>');
          mysqli_set_charset($conexion2, "utf8");
          if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $stmt2 = mysqli_prepare($conexion2, "SELECT id_favorito FROM favoritos WHERE id_pista=? AND id_usuario=?");
            $stmt2->bind_param('ss', $id, $id_usuario);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_store_result($stmt2);
            mysqli_stmt_bind_result($stmt2, $id_favorito);
            mysqli_stmt_fetch($stmt2);
            if ($stmt2->num_rows > 0) {
              $esFavorito = true;
            } else {
              $esFavorito = false;
            }
          } else {
            $esFavorito = false;
          }
          $contador++;
          if ($contador <= $start) {
            continue;
          }

          if ($contador > $start + $itemsPerPage) {
            break;
          }
          // Tu código para mostrar las tarjetas aquí
          echo '<div class="col-md-4 mb-4 columna-buscar">';
          echo '<div class="card">';
          echo '<div class="card-header d-flex justify-content-between align-items-center">';
          echo '<h5 class="card-title">' . $nombre . '</h5>';
          echo '<form method="post" action="">';
          echo '<button type="submit" name="pista_id" class="btn btn-star ' . ($esFavorito ? 'star-active' : 'star-icon') . '" id="star-' . $id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="' . ($esFavorito ? 'En favoritos' : 'Añadir a favoritos') . '"><i class="fa fa-star"></i></button>';
          echo '<input type="hidden" name="pista_id" value="' . $id . '">';
          echo '</form>';
          echo '</div>';
          echo '<div class="card-body text-center">';
          //Comprobamos si existe en la carpeta de imagenes la imagen de la pista para mostrarla o no
          if (file_exists("./imagenes/pistas/" . $nombre . ".jpg")) {
            echo '<img src="./imagenes/pistas/' . $nombre . '.jpg" alt="' . $nombre . '" class="img-fluid img-thumbnail">';
          } else {
          }
          // Clase 'img-thumbnail' de Bootstrap
          echo '<ul class="list-group list-group-flush">';
          echo '<li class="list-group-item"><strong>Provincia:</strong> ' . $provincia . '</li>';
          echo '<li class="list-group-item"><strong>Municipio:</strong> ' . $municipio . '</li>';
          echo '<li class="list-group-item"><strong>Teléfono de Contacto:</strong> ' . $telefono . '</li>';
          echo '</ul>';
          echo '<button type="button" class="btn btn-primary btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Precio por hora: ' . $precio . '">Precio por hora: ' . $precio . '€' . '</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <div class="pagination-container text-center">
        <?php
        $prevPage = $currentPage - 1;
        $nextPage = $currentPage + 1;

        if ($prevPage > 0) {
          echo '<a href="?buscarpistas=buscarpistas&page=' . $prevPage . '" class="prev-page">Anterior</a>';
        }
        if ($contador > $start + $itemsPerPage) {
          echo '<a href="?buscarpistas=buscarpistas&page=' . $nextPage . '" class="next-page">Siguiente</a>';
        }
        ?>
      </div>
    </div><?
        } elseif ($opcionSeleccionada == 'Baloncesto') {
          // Hacer algo relacionado con el baloncesto
        } elseif ($opcionSeleccionada == 'Tenis') {
          // Hacer algo relacionado con el tenis
        } elseif ($opcionSeleccionada == 'Padel') {
          // Hacer algo relacionado con el pádel
        }
      }

          ?>


<body>


  <!-- Hero Section -->
  <section class="hero-section text-white py-5" style="background-image: url('imagenes/imagenindex.jpg'); background-position: center;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="hero-content text-center">
            <h1 class="display-3 mb-4 tituloindex">Reserva tu pista, juega sin límites</h1>
            <p class="lead parrafoindex">Explora nuestras instalaciones y disfruta de la experiencia única de practicar tu deporte favorito. ¡Haz tu reserva ahora!</p>
          </div>
          <div class="text-center">
            <a href="ultimasnovedades.php" style="background-color: #e86b1c;width:210px;" class="btn btn-lg mt-3">Reserva ahora</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6 text-center">
              <div class="circle-container">
                <a href="buscarpistas.php?deporte=futbol" class="text-decoration-none text-dark gifdeporte">
                  <img src="gifs/futbol.gif" class="img-fluid rounded-circle" alt="Fútbol">
                </a>
              </div>
              <p class="circle-text">Fútbol</p>
            </div>
            <div class="col-md-6 text-center">
              <div class="circle-container textosxl">
                <a href="buscarpistas.php?deporte=baloncesto" class="text-decoration-none text-dark gifdeporte">
                  <img src="gifs/baloncesto.gif" class="img-fluid rounded-circle" alt="Baloncesto">
                </a>
              </div>
              <p class="circle-text textosxl">Baloncesto</p>
            </div>
            <div class="col-md-6 text-center">
              <div class="circle-container align-end">
                <a href="buscarpistas.php?deporte=tenis" class="text-decoration-none text-dark gifdeporte">
                  <img src="gifs/tenis.gif" class="img-fluid rounded-circle" alt="Tenis">
                </a>
              </div>
              <p class="circle-text">Tenis</p>
            </div>
            <div class="col-md-6 text-center">
              <div class="circle-container textosxl">
                <a href="buscarpistas.php?deporte=padel" class="text-decoration-none text-dark gifdeporte">
                  <img src="gifs/tenis2.gif" class="img-fluid rounded-circle" alt="Pádel">
                </a>
              </div>
              <p class="circle-text textosxl">Pádel</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </section>





  <!-- Destacados Section -->
  <section class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-4">Nuestras Pistas Destacadas</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Pista 1: Baloncesto -->
        <div class="col">
          <a href="buscarpistas.php?deporte=baloncesto" class="text-decoration-none text-dark">
            <div class="card cartadeporte">
              <img src="imagenes/pistabaloncesto.png" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Pista de Baloncesto">
              <div class="card-body">
                <h5 class="card-title">Pistas de Baloncesto</h5>
                <p class="card-text line-clamp-3">Reserva nuestras pistas de baloncesto para partidos y entrenamientos.</p>
              </div>
            </div>
          </a>
        </div>
        <!-- Pista 2: Fútbol -->
        <div class="col">
          <a href="buscarpistas.php?deporte=futbol" class="text-decoration-none text-dark">
            <div class="card cartadeporte">
              <img src="imagenes/pistafutbol.jpg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Pista de Fútbol">
              <div class="card-body">
                <h5 class="card-title">Pistas de Fútbol</h5>
                <p class="card-text">Alquila campos de fútbol para tus partidos y torneos favoritos.</p>
              </div>
            </div>
          </a>
        </div>
        <!-- Pista 3: Tenis -->
        <div class="col">
          <a href="buscarpistas.php?deporte=tenis" class="text-decoration-none text-dark">
            <div class="card cartadeporte">
              <img src="imagenes/pistatenis.jpg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Pista de Tenis">
              <div class="card-body">
                <h5 class="card-title">Pistas de Tenis</h5>
                <p class="card-text">Disfruta del tenis reservando nuestras pistas. ¡Desde 10€ por hora!</p>
              </div>
            </div>
          </a>
        </div>
        <!-- Pista 4: Pádel -->
        <div class="col">
          <a href="buscarpistas.php?deporte=padel" class="text-decoration-none text-dark">
            <div class="card cartadeporte">
              <img src="imagenes/pistapadel.jpg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Pista de Pádel">
              <div class="card-body">
                <h5 class="card-title">Pistas de Pádel</h5>
                <p class="card-text">Reserva pistas de pádel para partidos emocionantes y rápidos intercambios.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>






  <!-- Formulario de Búsqueda de Pistas -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Encuentra tu Pista</h2>
      <form class="w-75 mx-auto" action="buscarpistas.php" method="get">
        <div class="mb-3">
          <label for="tipoPista" class="form-label">Tipo de Pista</label>
          <select class="form-select" id="tipoPista" name="deporte" required>
            <option value="" selected>Seleccione su pista</option>
            <option value="Fútbol">Fútbol</option>
            <option value="Baloncesto">Baloncesto</option>
            <option value="Tenis">Tenis</option>
            <option value="Pádel">Pádel</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="comunidades" class="form-label">Comunidades</label>
          <select class="form-select" id="comunidades" name="comunidades" title="comunidades">
            <option selected disabled>Seleccione la Comunidad Autónoma</option>
            <!-- Las opciones se agregarán aquí -->
          </select>
        </div>
        <div class="mb-3">
          <label for="provincias" class="form-label">Provincias</label>
          <select class="form-select" id="provincias" name="provincias" title="provincias" disabled>
            <option selected disabled>Seleccione la Provincia</option>
            <!-- Las opciones se agregarán aquí -->
          </select>
        </div>
        <div class="mb-3">
          <label for="municipios" class="form-label">Municipios</label>
          <select class="form-select" id="municipios" name="municipios" title="municipios" disabled>
            <option selected disabled>Seleccione el Municipio</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn botonancho btn-lg btn-block">Buscar Pistas</button>
        </div>
      </form>
    </div>
  </section>






  <?
  mostrar_footer();
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
  <script src="js/buscarMunicipio.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="js/cookies.js"></script>
</body>

</html>