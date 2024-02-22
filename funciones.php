<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta charset="UTF-8">
<?
function mostrar_footer()
{
    // Código HTML del footer
    $footer = '
    <footer class="bg-secondary text-center text-white  w-100" id="pie">
        <!-- Grid container -->
        <div class="container-fluid p-4 pb-0">
            <!-- Section: Links -->
            <section class="mb-4">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Courtfusion
                        </h6>
                        <p>
                            Somos una empresa con sede en Cuenca que se dedica a la gestión de reservas de pistas
                            deportivas alrededor de toda España.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Términos y Privacidad</h6>
                        <p>
                            <a href="politicadeprivacidad.html" class="text-white mt-4" title="Política de Privacidad">Política de
                                Privacidad</a>
                        </p>
                        <p>
                            <a href="politicadecookies.html" class="text-white mt-4" title="Política de Cookies">Política de
                                Cookies</a>
                        </p>
                        <p>
                            <a href="terminosycondiciones.html" class="text-white mt-4" title="Términos y Condiciones">Términos y
                                Condiciones</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
                        <p><i class="fas fa-home mr-3 mt-3"></i> C) Hurtado de Mendoza Nº1 Planta 3, Cuenca, España</p>
                        <p><i class="fas fa-envelope mr-3 mt-3"></i> <a href="mailto:Courtfusioninfo@gmail.com" class="text-white">Courtfusioninfo@gmail.com</a></p>
                        <p><i class="fas fa-phone mr-3 mt-3"></i> + 34 123 45 67 89</p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Siguenos en redes sociales</h6>

                        <!-- Facebook -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#" role="button" title="Síguenos en Facebook"><i class="fab fa-facebook-f"></i></a>

                        <!-- Twitter -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#" role="button" title="Síguenos en Twitter"><i class="fab fa-twitter"></i></a>

                        <!-- Instagram -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#" role="button" title="Síguenos en Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 Copyright: <span class="text-white">CourtFusion</span>
        </div>
        <!-- Copyright -->
    </footer>';

    // Devuelve el código HTML del footer
    echo $footer;
}

function mostrarNavbar()
{
    echo '
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-orange">
    <div class="container-fluid">
      <a class="navbar-brand me-4" href="index.php">
        <img src="imagenes/logo-removebg-preview.png" width="100" height="100" alt="Logo de la página" class="img-fluid" title="Logo de la página">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav d-flex flex-fill justify-content-between">
          <li class="nav-item dropdown flex-fill me-4">
            <a class="nav-link dropdown-toggle text-white" href="#" id="pistasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Pistas deportivas">
              Pistas
            </a>
            <ul class="dropdown-menu" aria-labelledby="pistasDropdown">
              <li><a class="dropdown-item" href="buscarpistas.php?deporte=futbol">Fútbol</a></li>
              <li><a class="dropdown-item" href="buscarpistas.php?deporte=baloncesto">Baloncesto</a></li>
              <li><a class="dropdown-item" href="buscarpistas.php?deporte=tenis">Tenis</a></li>
              <li><a class="dropdown-item" href="buscarpistas.php?deporte=padel">Pádel</a></li>
            </ul>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link text-white" href="ultimasnovedades.php" title="Últimas Novedades">Últimas Novedades</a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link text-white" href="tusfavoritos.php" title="Tus Favoritos">Tus Favoritos</a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link text-white" href="pistaspopulares.php" title="Pistas Populares">Pistas Populares</a>
          </li>
          <li class="nav-item flex-fill">
            <a class="nav-link text-white" href="registratupista.php" title="Registra tu Pista">Registra tu Pista</a>
          </li>
        </ul>
        <form class="d-flex ms-lg-4 me-4 mt-2 mt-lg-0" action="buscarpistas.php" method="get">
          <input class="form-control me-2" type="search" name="provincias" id="barrabusqueda" placeholder="Buscar por provincia" aria-label="Buscar" title="Búsqueda por provincia en el sitio">
          <button class="btn btn-outline-light" type="submit" title="Buscar">Buscar</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-2">
            <a class="nav-link text-white" href="perfil.php" title="Iniciar Sesión">Iniciar Sesión</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-white" href="registro.php" title="Registrarse">Registrarse</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
    ';

    echo '
    <script>
        $(document).ready(function () {
            // Cuando el mouse entra en el enlace "Pistas"
            $(".nav-link.dropdown-toggle").mouseenter(function () {
                // Abre el desplegable
                $(this).dropdown("toggle");
            });

            // Cuando el mouse sale del enlace "Pistas"
            $(".nav-item.dropdown").mouseleave(function () {
                // Cierra el desplegable
                $(this).find(".dropdown-menu").removeClass("show");
            });
        });
    </script>
    ';
}


function mostrarMejorValoradas()
{
    include 'NOACCESIBLE/credencialesdb.php';
    $conexion = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
    mysqli_set_charset($conexion, "utf8");
    //Comprobar si deporte,municipio,horaApertura tienen valor y si no ponerlos a null
    if (isset($_GET['provincia']) && !empty($_GET['provincia'])) {
        $provincia = $_GET['provincia'];
        $provinciaEncriptado = base64_encode(base64_decode($provincia));
        $provinciaDesencriptado = base64_decode($provincia);
        if ($_GET['provincia'] == $provinciaEncriptado) {
            $provincia = $provinciaDesencriptado;
        } else {
            $provincia = $_GET['provincia'];
        }
    } else {
        $provincia = null;
    }
    if (isset($_GET['deporte']) && !empty($_GET['deporte'])) {
        $deporte = $_GET['deporte'];
        $deporteEncriptado = base64_encode(base64_decode($deporte));
        $deporteDesencriptado = base64_decode($deporte);

        //Desencriptar el deporte si viene encriptado y no es nulo si no viene encriptado simplemente lo obtenemos
        if ($_GET['deporte']  == $deporteEncriptado) {

            $deporte = $deporteDesencriptado;
        } else {
            $deporte = $_GET['deporte'];
        }
    } else {
        $deporte = null;
    }

    //Desencriptar el deporte si viene encriptado y no es nulo si no viene encriptado simplemente lo obtenemos
    if (isset($_GET['municipio']) && !empty($_GET['municipio'])) {
        $municipio = $_GET['municipio'];
        $municipioEncriptado = base64_encode(base64_decode($municipio));
        $municipioDesencriptado = base64_decode($municipio);
        if ($municipio == $municipioEncriptado) {

            $municipio = $municipioDesencriptado;
        } else {
            $municipio = $_GET['municipio'];
        }
    } else {
        $municipio = null;
    }


    if (isset($_GET['horadeseada']) && !empty($_GET['horadeseada'])) {
        $horadeseada = $_GET['horadeseada'];
        $horadeseadaEncriptado = base64_encode(base64_decode($horadeseada));
        $horadeseadaDesencriptado = base64_decode($horadeseada);
        if ($_GET['horadeseada'] == $horadeseadaEncriptado) {
            $horadeseada = $horadeseadaDesencriptado;
        } else {
            $horadeseada = $_GET['horadeseada'];
        }
    } else {
        $horadeseada = null;
    }


    // Restar una hora a la hora de apertura
    if (!is_null($horadeseada)) {
        $horaCierreMenosUnaHora = date("H:i:s", strtotime($horadeseada) - 3600); // 3600 segundos es una hora
    } else {
        $horaCierreMenosUnaHora = null;
    }
    // Preparar y ejecutar la consulta
    // Preparar y ejecutar la consulta
    // Preparar y ejecutar la consulta
    // Preparar y ejecutar la consulta
    if ($stmt = mysqli_prepare($conexion, "SELECT p.id_pista, tipo_pista, nombre_pista, comunidad_autonoma, provincia, municipio, direccion, codigo_postal, correo_contacto, telefono_contacto, precio_hora, hora_apertura, hora_cierre, fecha_registro, validacion, 
    (SELECT COUNT(*) FROM valoraciones WHERE id_pista = p.id_pista AND valoracion = 'like') AS total_likes,
    (SELECT COUNT(*) FROM valoraciones WHERE id_pista = p.id_pista AND valoracion = 'dislike') AS total_dislikes
FROM pistas p
WHERE (? IS NULL OR tipo_pista = ?) AND (? IS NULL OR municipio = ?) AND (? IS NULL OR hora_cierre > ?) AND p.validacion = 'ACTIVA'
HAVING total_likes > 0 OR total_dislikes > 0
ORDER BY (total_likes - total_dislikes) DESC")) {
        // Resto de tu código
    }


    mysqli_stmt_bind_param($stmt, "ssssss", $deporte, $deporte, $municipio, $municipio, $horadeseada, $horaCierreMenosUnaHora);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $tipo, $nombre, $comunidad, $provincia, $municipio, $direccion, $codigopostal, $correo, $telefono, $precio, $horaper, $horcierre, $fecharegistro, $validacion, $total_likes, $total_dislikes);
    $nombresPistas = array();
    while (mysqli_stmt_fetch($stmt)) {
        $nombresPistas[] = strtolower($nombre);
    }
    //Resetea el puntero de la consulta
    mysqli_stmt_data_seek($stmt, 0);
?>

    <div class="container">
        <?


        ?>
        <h1 class="text-center">Pistas Mejor Valoradas</h1>
        <div class="message">Los filtros de búsqueda por nombre se aplican a las 12 pistas actuales.</div>
        <div id="alert-container" class="mt-3">
            <? if (isset($alertMessage)) {
                echo $alertMessage;
            } ?>
        </div>
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="filter-container">
                    <select id="sport-filter" class="form-select">
                        <option value="">Ningún deporte seleccionado</option>
                        <option value="futbol">Fútbol</option>
                        <option value="baloncesto">Baloncesto</option>
                        <option value="tenis">Tenis</option>
                        <option value="padel">Pádel</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2 mb-3">
                <select class="form-select" id="provincias" name="provincias" title="provincias">
                    <option selected disabled>Seleccione la Provincia</option>
                    <option value="Álava" id="01">Álava (Álava/Araba)</option>
                    <option value="Albacete" id="02">Albacete</option>
                    <option value="Alicante" id="03">Alicante (Alicante/Alacant)</option>
                    <option value="Almería" id="04">Almería</option>
                    <option value="Ávila" id="05">Ávila</option>
                    <option value="Badajoz" id="06">Badajoz</option>
                    <option value="Islas Baleares" id="07">Islas Baleares</option>
                    <option value="Barcelona" id="08">Barcelona</option>
                    <option value="Burgos" id="09">Burgos</option>
                    <option value="Cáceres" id="10">Cáceres</option>
                    <option value="Cádiz" id="11">Cádiz</option>
                    <option value="Cantabria" id="39">Cantabria</option>
                    <option value="Castellón" id="12">Castellón (Castellón/Castelló)</option>
                    <option value="Ciudad Real" id="13">Ciudad Real</option>
                    <option value="Córdoba" id="14">Córdoba</option>
                    <option value="La Coruña" id="15">La Coruña (A Coruña)</option>
                    <option value="Cuenca" id="16">Cuenca</option>
                    <option value="Gerona" id="17">Gerona (Girona)</option>
                    <option value="Granada" id="18">Granada</option>
                    <option value="Guadalajara" id="19">Guadalajara</option>
                    <option value="Guipúzcoa" id="20">Guipúzcoa (Gipuzkoa)</option>
                    <option value="Huelva" id="21">Huelva</option>
                    <option value="Huesca" id="22">Huesca</option>
                    <option value="Jaén" id="23">Jaén</option>
                    <option value="León" id="24">León</option>
                    <option value="Lérida" id="25">Lérida (Lleida)</option>
                    <option value="La Rioja" id="26">La Rioja</option>
                    <option value="Lugo" id="27">Lugo</option>
                    <option value="Madrid" id="28">Madrid</option>
                    <option value="Málaga" id="29">Málaga</option>
                    <option value="Murcia" id="30">Murcia</option>
                    <option value="Navarra" id="31">Navarra (Nafarroa)</option>
                    <option value="Orense" id="32">Orense (Ourense)</option>
                    <option value="Palencia" id="34">Palencia</option>
                    <option value="Las Palmas" id="35">Las Palmas</option>
                    <option value="Pontevedra" id="36">Pontevedra</option>
                    <option value="Salamanca" id="37">Salamanca</option>
                    <option value="Santa Cruz de Tenerife" id="38">Santa Cruz de Tenerife</option>

                    <option value="Segovia" id="40">Segovia</option>
                    <option value="Sevilla" id="41">Sevilla</option>
                    <option value="Soria" id="42">Soria</option>
                    <option value="Tarragona" id="43">Tarragona</option>
                    <option value="Teruel" id="44">Teruel</option>
                    <option value="Toledo" id="45">Toledo</option>
                    <option value="Valencia" id="46">Valencia (València)</option>
                    <option value="Valladolid" id="47">Valladolid</option>
                    <option value="Vizcaya" id="48">Vizcaya (Bizkaia)</option>
                    <option value="Zamora" id="49">Zamora</option>
                    <option value="Zaragoza" id="50">Zaragoza</option>
                    <option value="Ceuta" id="51">Ceuta</option>
                    <option value="Melilla" id="52">Melilla</option>
                </select>
            </div>
            <div class="form-group col-md-3 mb-3">
                <select class="form-select" id="municipios" name="municipios" title="municipios" disabled>
                    <option selected disabled>Seleccione el Municipio</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <div class="horadeapertura">
                    <?
                    $conexion2 = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
                    mysqli_set_charset($conexion2, "utf8");
                    $stmt2 = mysqli_prepare($conexion2, "SELECT min(hora_apertura),max(hora_cierre) FROM pistas");
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_store_result($stmt2);
                    mysqli_stmt_bind_result($stmt2, $horaaperturaminima, $horacierremaxima);
                    ?>
                    <select class="form-select" id="horadeseada" name="horadeseada" title="horadeseada">
                        <option selected disabled>Seleccione la hora que desees</option>
                        <?
                        while (mysqli_stmt_fetch($stmt2)) {
                            $horaAperturaMinima = strtotime($horaaperturaminima);
                            $horaCierreMaxima = strtotime($horacierremaxima);

                            while ($horaAperturaMinima <= $horaCierreMaxima) {
                                echo '<option value="' . date("H:i", $horaAperturaMinima) . '">' . date("H:i", $horaAperturaMinima) . '</option>';
                                $horaAperturaMinima += 60 * 60; // Sumar 1 hora en segundos (3600 segundos)
                            }
                        }
                        mysqli_close($conexion2);

                        ?>
                    </select>
                </div>

            </div>
            <div class="col-md-2 mb-3">
                <div class="search-container text-end">
                <label for="search" class="visually-hidden">Buscar tu pista</label>
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

            if ($stmt->num_rows() == 0) {
            ?>
                <div class="container mt-2">
                    <div class="alert alert-warning alert-dismissible fade show position-relative d-flex align-items-center justify-content-center" role="alert">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                            </svg>
                            <div class="mt-3">
                                <strong>No hay pistas que cumplan con las condiciones</strong>
                                <p class="mb-0">Intenta ajustar tus criterios de búsqueda.</p>
                            </div>
                        </div>
                    </div>
                </div>



            <?
            }
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
                $contadordislike = 0;
                $contadorlike = 0;
                $conexion3 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
                $stmt2 = mysqli_prepare($conexion3, "SELECT valoracion FROM valoraciones WHERE id_pista=?");
                $stmt2->bind_param('s', $id);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_store_result($stmt2);
                mysqli_stmt_bind_result($stmt2, $valoracion);
                while (mysqli_stmt_fetch($stmt2)) {
                    if ($valoracion == "like") {
                        $contadorlike++;
                    } else {
                        $contadordislike++;
                    }
                }

                //Ahora consulto los likes y dislikes del usuario para saber si ha dado like o dislike a la pista y mostrar los estilos
                $like = false;
                $dislike = false;
                $conexion4 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
                $stmt3 = mysqli_prepare($conexion4, "SELECT id_pista,valoracion FROM valoraciones WHERE id_pista=? AND id_usuario=?");
                $stmt3->bind_param('ss', $id, $_SESSION['id_usuario']);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_store_result($stmt3);
                mysqli_stmt_bind_result($stmt3, $idpista_valoracion, $valoracion);
                while (mysqli_stmt_fetch($stmt3)) {
                    if ($valoracion == "like") {
                        $like = true;
                    } else {
                        $dislike = true;
                    }
                }
                echo '<div class="col-md-4 mb-4 columna-buscar ">';
                echo '<div class="card h-100 animate__animated animate__fadeIn animate__slow">';
                echo '<div class="card-header">';

                // Primera fila con el nombre y el botón de favoritos
                echo '<div class="d-flex justify-content-between align-items-center">';
                echo '<h5 class="card-title">' . ucwords(mb_strtolower($nombre,'UTF-8')) . '</h5>';
                echo '<form method="post" action="">';
                echo '<button type="submit" name="pista_id" class="btn btn-star ' . ($esFavorito ? 'star-active' : 'star-icon') . '" id="star-' . $id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="' . ($esFavorito ? 'En favoritos' : 'Añadir a favoritos') . '"><i class="fa fa-star"></i></button>';
                echo '<input type="hidden" name="pista_id" value="' . $id . '">';
                echo '</form>';
                echo '</div>';

                // Segunda fila con la hora
                echo '<div class="hora h5">' . date("H:i", strtotime($horaper)) . '-' . date("H:i", strtotime($horcierre)) . '</div>';

                echo '</div>'; // Cierre del card-header






                echo '<div class="card-body text-center">';

                $nombreArchivo = $nombre . "($tipo-$comunidad-$provincia-$municipio-$correo-$id)";
                //Comprobamos si existe en la carpeta de imagenes la imagen de la pista para mostrarla o no
                if (file_exists("./imagenes/pistas/" . $nombreArchivo . ".jpg")) {
                    echo '<img src="./imagenes/pistas/' . $nombreArchivo . '.jpg" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                } else {
                    if($tipo=="Baloncesto"){
                        //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . strtolower($tipo) . '.png" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }else{
                    //Quitamos los acentos a la palabra tipo para que no de error al buscar la imagen
                    $tipo = str_replace('á', 'a', $tipo);
                    $tipo = str_replace('é', 'e', $tipo);
                    $tipo = str_replace('í', 'i', $tipo);
                    $tipo = str_replace('ó', 'o', $tipo);
                    $tipo = str_replace('ú', 'u', $tipo);
                    //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . (mb_strtolower($tipo,'UTF-8')) . '.jpg" alt="' . (mb_strtolower($tipo,'UTF-8')) . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }
                }

                // Clase 'img-thumbnail' de Bootstrap
                echo '<form method="post" action="reservapista.php">';

                echo '<ul class="list-group list-group-flush">';
                echo '<div class="card-footer d-flex justify-content-between">';
                if ($like = true && $idpista_valoracion == $id && $valoracion == "like") {

                    // Botón de "like" con estilo cuando el usuario ha dado "Me gusta"
                    echo '<button type="button" class="btn btn-link like-button liked" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="Me gusta">';
                    echo '<div class="hand-icon like-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-up"></i> <span class="like-count">' . $contadorlike . '</span>';
                    echo '</div>';
                    echo '</button>';
                } else {
                    // Botón de "like" (pulgar hacia arriba)
                    echo '<button type="button" class="btn btn-link like-button" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="Me gusta">';
                    echo '<div class="hand-icon like-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-up"></i> <span class="like-count">' . $contadorlike . '</span>';

                    echo '</div>';
                    echo '</button>';
                }

                if ($dislike = true && $idpista_valoracion == $id && $valoracion == "dislike") {
                    // Botón de "dislike" con estilo cuando el usuario ha dado "No me gusta"
                    echo '<button type="button" class="btn btn-link dislike-button disliked" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="No me gusta">';
                    echo '<div class="hand-icon dislike-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-down"></i> <span class="dislike-count">' . $contadordislike . '</span>';
                    echo '</div>';
                    echo '</button>';
                } else {
                    // Botón de "dislike" sin estilo cuando el usuario no ha dado "No me gusta"
                    echo '<button type="button" class="btn btn-link dislike-button" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="No me gusta">';
                    echo '<div class="hand-icon dislike-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-down"></i> <span class="dislike-count">' . $contadordislike . '</span>';
                    echo '</div>';
                    echo '</button>';
                }

                if (strpos($precio, '.00') !== false) {
                    // El precio tiene .00 al final, lo eliminamos
                    $precio = str_replace('.00', '', $precio);
                }
                echo '</div>';
                echo '<li class="list-group-item"><strong>Provincia:</strong> ' . ucwords(mb_strtolower($provincia,'UTF-8')) . '</li>';
                echo '<li class="list-group-item" name="municipio"><strong>Municipio:</strong> ' . ucwords(mb_strtolower($municipio,'UTF-8')) . '</li>';
                echo '<li class="list-group-item"><strong>Teléfono de Contacto:</strong> ' . $telefono . '</li>';
                echo '<li class="list-group-item"><strong>Precio por hora:</strong> ' . $precio . '€</li>';
                echo '</ul>';
                echo '<button style="background-color: #e86b1c;width:210px" type="submit" class="btn btn-primary btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reserva Ya">Reserva ya</button>';
                echo '<input type="hidden" name="id_pista" value="' . $id . '">';
                echo '<input type="hidden" name="nombre_pista" value="' . $nombre . '">';
                echo '<input type="hidden" name="provincia" value="' . $provincia . '">';
                echo '<input type="hidden" name="municipio" value="' . $municipio . '">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            }
            ?>
        </div>
        <div class="pagination-container text-center">
            <?php
            $prevPage = $currentPage - 1;
            $nextPage = $currentPage + 1;

            // Obtén la URL actual
            $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            // Analiza los parámetros actuales
            $parameters = $_GET;

            // Agrega o actualiza el parámetro 'page'
            $parameters['page'] = $nextPage;

            // Construye la nueva URL
            $newURL = strtok($currentURL, '?') . '?' . http_build_query($parameters);

            if ($prevPage > 0) {
                echo '<a href="?page=' . $prevPage . '" class="prev-page">Anterior</a>';
            }

            if ($contador > $start + $itemsPerPage) {
                echo '<a href="' . $newURL . '" class="next-page">Siguiente</a>';
            }





            mysqli_close($conexion);

            ?>
        </div>
    </div><?

        }


        function buscarFavorito()
        {
            $toastContent = '';
            if (isset($_SESSION['id_usuario'])) {
                $pista_id = $_POST['pista_id'];
                include 'NOACCESIBLE/credencialesdb.php';
                $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');

                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                }
                $id_usuario = $_SESSION['id_usuario'];

                // Comprueba si la pista ya está en favoritos
                $stmt = mysqli_prepare($conexion, "SELECT id_favorito FROM favoritos WHERE id_pista=? AND id_usuario=?");
                $stmt->bind_param('ss', $pista_id, $id_usuario);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if ($stmt->num_rows > 0) {
                    // Si la pista ya está en favoritos, elimínala
                    $stmt = mysqli_prepare($conexion, "DELETE FROM favoritos WHERE id_pista=? AND id_usuario=?");
                    $stmt->bind_param('ss', $pista_id, $id_usuario);

                    if ($stmt->execute()) {
                        // Pista eliminada de favoritos correctamente, muestro un toast rojo con bootstrap
                        $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
                        $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                        $toastContent .= "<div class='toast-header'>";
                        $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                        $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                        $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                        $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                        $toastContent .= "</div>";
                        $toastContent .= "<div class='toast-body bg-danger text-white'>";
                        $toastContent .=  "Pista eliminada de favoritos correctamente.";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";;
                    } else {
                        // Pista eliminada de favoritos correctamente, muestro un toast rojo con bootstrap
                        $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
                        $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                        $toastContent .= "<div class='toast-header'>";
                        $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                        $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                        $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                        $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                        $toastContent .= "</div>";
                        $toastContent .= "<div class='toast-body bg-danger text-white'>";
                        $toastContent .=  "Error al eliminar la pista de favoritos.";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";;
                    }
                } else {
                    // Si la pista no está en favoritos, agrégala
                    $idfavorito = uniqid();

                    $stmt = mysqli_prepare($conexion, "INSERT INTO favoritos (id_favorito, id_usuario, id_pista) VALUES (?, ?, ?)");
                    $stmt->bind_param('sss', $idfavorito, $id_usuario, $pista_id);

                    if ($stmt->execute()) {
                        // Pista eliminada de favoritos correctamente, muestro un toast rojo con bootstrap
                        $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
                        $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                        $toastContent .= "<div class='toast-header'>";
                        $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                        $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                        $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                        $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                        $toastContent .= "</div>";
                        $toastContent .= "<div class='toast-body bg-success text-white'>";
                        $toastContent .= "Pista añadida a favoritos correctamente.";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";;
                    } else {
                        // Error al añadir la pista a favoritos
                        // Pista eliminada de favoritos correctamente, muestro un toast rojo con bootstrap
                        $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
                        $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                        $toastContent .= "<div class='toast-header'>";
                        $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                        $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                        $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                        $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                        $toastContent .= "</div>";
                        $toastContent .= "<div class='toast-body bg-danger text-white'>";
                        $toastContent .=  "Error al añadir la pista a favoritos.";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";;
                    }
                }
                mysqli_close($conexion);
            } else {
                // El usuario no está autenticado
                        $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
                        $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                        $toastContent .= "<div class='toast-header bg-orange text-white'>";
                        $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                        $toastContent .= "<strong class='me-auto text-white'>CourtFusion</strong>";
                        $toastContent .= "<small class='text-white'>Ahora Mismo</small>";
                        $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                        $toastContent .= "</div>";
                        $toastContent .= "<div class='toast-body text-black'>";
                        $toastContent .=  "Actualmente no has iniciado sesión.";
                        $toastContent .= "<a href='perfil.php'>Iniciar Sesión</a>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";
                        $toastContent .= "</div>";;
                
            }
            echo $toastContent;
            echo '<script>
            $(document).ready(function() {
                $("#mytoast").toast("show");
            });
        </script>';
        };



        function mostrarFavoritos()
        {
            include 'NOACCESIBLE/credencialesdb.php';
            $conexion = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
            mysqli_set_charset($conexion, "utf8");
            //Comprobar si deporte,municipio,horaApertura tienen valor y si no ponerlos a null

            if (isset($_GET['deporte']) && !empty($_GET['deporte'])) {
                $deporte = base64_decode($_GET['deporte']);
            } else {
                $deporte = null;
            }
            if (isset($_GET['municipio']) && !empty($_GET['municipio'])) {
                $municipio = utf8_encode(base64_decode($_GET['municipio']));
            } else {
                $municipio = null;
            }
            if (isset($_GET['horadeseada']) && !empty($_GET['horadeseada'])) {
                $horadeseada = base64_decode($_GET['horadeseada']);
            } else {
                $horadeseada = null;
            }
            // Restar una hora a la hora de apertura
            if (!is_null($horadeseada)) {
                $horaCierreMenosUnaHora = date("H:i:s", strtotime($horadeseada) - 3600); // 3600 segundos es una hora
            } else {
                $horaCierreMenosUnaHora = null;
            }
            $stmt = mysqli_prepare($conexion, "SELECT p.id_pista,tipo_pista,nombre_pista,comunidad_autonoma,provincia,municipio,codigo_postal,correo_contacto,telefono_contacto,precio_hora, -- Añade el campo precio_hora
fecha_registro,u.id_usuario,f.id_usuario,f.id_pista FROM pistas p,usuarios u,favoritos f where f.id_usuario=u.id_usuario and f.id_pista=p.id_pista and (? IS NULL OR tipo_pista=?) AND (? IS NULL OR municipio=?) AND (? IS NULL OR hora_cierre > ?) AND validacion='ACTIVA' and f.id_usuario=? ORDER BY fecha_registro DESC LIMIT 12");
            mysqli_stmt_bind_param($stmt, "sssssss", $deporte, $deporte, $municipio, $municipio, $horaCierreMenosUnaHora, $horaCierreMenosUnaHora,$_SESSION['id_usuario']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $id, $tipo, $nombre, $comunidad, $provincia, $municipio, $cp, $correo, $telefono, $precio, $fecha, $id_usuario, $id_usuario_favorito, $id_pista_favorito);
            $nombresPistas = array();
    while (mysqli_stmt_fetch($stmt)) {
        $nombresPistas[] = strtolower($nombre);
    }
    //Resetea el puntero de la consulta
    mysqli_stmt_data_seek($stmt, 0);
            ?><div class="container">
        <h1 class="text-center">Tus Pistas Favoritas</h1>
        <div class="message">Los filtros de búsqueda por nombre se aplican a las 12 pistas actuales.</div>
        <div class="row">
            <div class="row mb-3">
                <div class="col-md-2 mb-3">
                    <div class="filter-container">
                        <select id="sport-filter" class="form-select">
                            <option value="">Ningún deporte seleccionado</option>
                            <option value="futbol">Fútbol</option>
                            <option value="baloncesto">Baloncesto</option>
                            <option value="tenis">Tenis</option>
                            <option value="padel">Pádel</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2 mb-3">
                    <select class="form-select" id="provincias" name="provincias" title="provincias">
                        <option selected disabled>Seleccione la Provincia</option>
                        <option value="Álava" id="01">Álava (Álava/Araba)</option>
                        <option value="Albacete" id="02">Albacete</option>
                        <option value="Alicante" id="03">Alicante (Alicante/Alacant)</option>
                        <option value="Almería" id="04">Almería</option>
                        <option value="Ávila" id="05">Ávila</option>
                        <option value="Badajoz" id="06">Badajoz</option>
                        <option value="Islas Baleares" id="07">Islas Baleares</option>
                        <option value="Barcelona" id="08">Barcelona</option>
                        <option value="Burgos" id="09">Burgos</option>
                        <option value="Cáceres" id="10">Cáceres</option>
                        <option value="Cádiz" id="11">Cádiz</option>
                        <option value="Cantabria" id="39">Cantabria</option>
                        <option value="Castellón" id="12">Castellón (Castellón/Castelló)</option>
                        <option value="Ciudad Real" id="13">Ciudad Real</option>
                        <option value="Córdoba" id="14">Córdoba</option>
                        <option value="La Coruña" id="15">La Coruña (A Coruña)</option>
                        <option value="Cuenca" id="16">Cuenca</option>
                        <option value="Gerona" id="17">Gerona (Girona)</option>
                        <option value="Granada" id="18">Granada</option>
                        <option value="Guadalajara" id="19">Guadalajara</option>
                        <option value="Guipúzcoa" id="20">Guipúzcoa (Gipuzkoa)</option>
                        <option value="Huelva" id="21">Huelva</option>
                        <option value="Huesca" id="22">Huesca</option>
                        <option value="Jaén" id="23">Jaén</option>
                        <option value="León" id="24">León</option>
                        <option value="Lérida" id="25">Lérida (Lleida)</option>
                        <option value="La Rioja" id="26">La Rioja</option>
                        <option value="Lugo" id="27">Lugo</option>
                        <option value="Madrid" id="28">Madrid</option>
                        <option value="Málaga" id="29">Málaga</option>
                        <option value="Murcia" id="30">Murcia</option>
                        <option value="Navarra" id="31">Navarra (Nafarroa)</option>
                        <option value="Orense" id="32">Orense (Ourense)</option>
                        <option value="Palencia" id="34">Palencia</option>
                        <option value="Las Palmas" id="35">Las Palmas</option>
                        <option value="Pontevedra" id="36">Pontevedra</option>
                        <option value="Salamanca" id="37">Salamanca</option>
                        <option value="Santa Cruz de Tenerife" id="38">Santa Cruz de Tenerife</option>

                        <option value="Segovia" id="40">Segovia</option>
                        <option value="Sevilla" id="41">Sevilla</option>
                        <option value="Soria" id="42">Soria</option>
                        <option value="Tarragona" id="43">Tarragona</option>
                        <option value="Teruel" id="44">Teruel</option>
                        <option value="Toledo" id="45">Toledo</option>
                        <option value="Valencia" id="46">Valencia (València)</option>
                        <option value="Valladolid" id="47">Valladolid</option>
                        <option value="Vizcaya" id="48">Vizcaya (Bizkaia)</option>
                        <option value="Zamora" id="49">Zamora</option>
                        <option value="Zaragoza" id="50">Zaragoza</option>
                        <option value="Ceuta" id="51">Ceuta</option>
                        <option value="Melilla" id="52">Melilla</option>
                    </select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <select class="form-select" id="municipios" name="municipios" title="municipios" disabled>
                        <option selected disabled>Seleccione el Municipio</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="horadeapertura">
                        <?
                        $conexion2 = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
                        mysqli_set_charset($conexion2, "utf8");
                        $stmt2 = mysqli_prepare($conexion2, "SELECT min(hora_apertura),max(hora_cierre) FROM pistas");
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_store_result($stmt2);
                        mysqli_stmt_bind_result($stmt2, $horaaperturaminima, $horacierremaxima);
                        ?>
                        <select class="form-select" id="horadeseada" name="horadeseada" title="horadeseada">
                            <option selected disabled>Seleccione la hora que desees</option>
                            <?
                            while (mysqli_stmt_fetch($stmt2)) {
                                $horaAperturaMinima = strtotime($horaaperturaminima);
                                $horaCierreMaxima = strtotime($horacierremaxima);

                                while ($horaAperturaMinima <= $horaCierreMaxima) {
                                    echo '<option value="' . date("H:i", $horaAperturaMinima) . '">' . date("H:i", $horaAperturaMinima) . '</option>';
                                    $horaAperturaMinima += 60 * 60; // Sumar 1 hora en segundos (3600 segundos)
                                }
                            }
                            $stmt2->close();
                            mysqli_close($conexion2);

                            ?>
                        </select>
                    </div>

                </div>
                <div class="col-md-2 mb-3">
                    <div class="search-container text-end">
                    <label for="search" class="visually-hidden">Buscar tu pista</label>
                        <input type="text" id="search" class="form-control" data-search="<?= implode(',', $nombresPistas) ?>" placeholder="Buscar tu pista">
                    </div>
                </div>
            </div>
            <?php
            if (mysqli_stmt_num_rows($stmt) == 0) {
            ?>

                <style>
                    a.explore-link {
                        color: #900;
                        /* Cambiar a tu color rojo oscuro deseado */
                        text-decoration: underline;
                        /* Opcional: para subrayar el enlace */

                        font-weight: bold;
                    }

                    a.explore-link:hover {
                        color: #700;
                        /* Cambiar a tu color rojo oscuro deseado para el estado de desplazamiento */
                    }
                </style>

                <div class="container mt-5">
                    <div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg>
                            <div class="mt-3">
                                <strong>No tienes pistas favoritas</strong>
                                <p class="mb-0">Empieza a <a class="explore-link" href="buscarpistas.php">explorar</a> y añade tus pistas favoritas para tener un control total sobre tus deportes preferidos.</p>
                            </div>
                        </div>
                    </div>
                </div>





            <?
            } else {
                while (mysqli_stmt_fetch($stmt)) {
                    echo 'Entro en el while';
                    //Numero de filas que devuelve la consulta
                    echo mysqli_stmt_num_rows($stmt);
                    if (strpos($precio, '.00') !== false) {
                        // El precio tiene .00 al final, lo eliminamos
                        $precio = str_replace('.00', '', $precio);
                    }
                    //Si nevuelve 0 filas
                    $conexion2 = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
                    mysqli_set_charset($conexion2, "utf8");
                    $stmt2 = mysqli_prepare($conexion2, "SELECT id_favorito FROM favoritos WHERE id_pista=? AND id_usuario=?");
                    $stmt2->bind_param('ss', $id, $_SESSION['id_usuario']);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_store_result($stmt2);
                    $esFavorito = mysqli_stmt_num_rows($stmt2) > 0;
                    mysqli_close($conexion2);
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card h-100 animate__animated animate__fadeIn animate__slow">';
                    echo '<div class="card-header d-flex justify-content-between align-items-center">';
                    echo '<h5 class="card-title">' . ucwords(mb_strtolower($nombre,'UTF-8')) . '</h5>';

                    echo '<form method="post" action="">';
                    echo '<button type="submit" name="pista_id" class="btn btn-star ' . ($esFavorito ? 'star-active' : 'star-icon') . '" id="star-' . $id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="' . ($esFavorito ? 'En favoritos' : 'Añadir a favoritos') . '"><i class="fa fa-star"></i></button>';
                    echo '<input type="hidden" name="pista_id" value="' . $id . '">';
                    echo '</form>';
                    echo '</div>';

                    $nombreArchivo = $nombre . "($tipo-$comunidad-$provincia-$municipio-$correo-$id)";
                    //Comprobamos si existe en la carpeta de imagenes la imagen de la pista para mostrarla o no
                    if (file_exists("./imagenes/pistas/" . $nombreArchivo . ".jpg")) {
                        echo '<img src="./imagenes/pistas/' . $nombreArchivo . '.jpg" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    } else {
                        if($tipo=="Baloncesto"){
                            //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                        echo '<img src="./imagenes/pista' . strtolower($tipo) . '.png" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                        }else{
                        //Quitamos los acentos a la palabra tipo para que no de error al buscar la imagen
                        $tipo = str_replace('á', 'a', $tipo);
                        $tipo = str_replace('é', 'e', $tipo);
                        $tipo = str_replace('í', 'i', $tipo);
                        $tipo = str_replace('ó', 'o', $tipo);
                        $tipo = str_replace('ú', 'u', $tipo);
                        //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                        echo '<img src="./imagenes/pista' . (mb_strtolower($tipo,'UTF-8')) . '.jpg" alt="' . (mb_strtolower($tipo,'UTF-8')) . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                        }
                    }

                    echo '<form method="post" action="reservapista.php">';
                    echo '<div class="card-body text-center">';
                    echo '<ul class="list-group list-group-flush">';
                    echo '<li class="list-group-item"><strong>Provincia:</strong> ' . ucwords(mb_strtolower($provincia,'UTF-8')) . '</li>';
                    echo '<li class="list-group-item"><strong>Municipio:</strong> ' . ucwords(mb_strtolower($municipio,'UTF-8')) . '</li>';
                    echo '<li class="list-group-item"><strong>Teléfono de Contacto:</strong> ' . ucwords(strtolower($telefono)) . '</li>';
                    echo '<li class="list-group-item"><strong>Precio por hora:</strong> ' . $precio . '€</li>';
                    echo '</ul>';
                    echo '<button style="background-color: #e86b1c;width:210px" type="submit" class="btn btn-primary btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reserva Ya">Reserva ya</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</form>';
                }
            }
            mysqli_close($conexion);
            ?>
        </div>
    </div><?
        }


        function mostrarPistas()
        {
            $mensaje = "Listado de Pistas"; // Mensaje predeterminado
            include 'NOACCESIBLE/credencialesdb.php';
            $conexion = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
            mysqli_set_charset($conexion, "utf8");
            //Comprobar si deporte,municipio,horaApertura tienen valor y si no ponerlos a null
            if (isset($_GET['provincias']) && !empty($_GET['provincias'])) {
                $provincia = $_GET['provincias'];
                $provinciaEncriptado = base64_encode(base64_decode($provincia));
                $provinciaDesencriptado = base64_decode($provincia);
                if ($_GET['provincias'] == $provinciaEncriptado) {
                    $provincia = $provinciaDesencriptado;
                    echo $provincia;
                } else {
                    $provincia = $_GET['provincias'];
                }
            } else {
                $provincia = null;
            }
            if (isset($_GET['deporte']) && !empty($_GET['deporte'])) {
                $deporte = $_GET['deporte'];
                $deporteEncriptado = base64_encode(base64_decode($deporte));
                $deporteDesencriptado = base64_decode($deporte);

                //Desencriptar el deporte si viene encriptado y no es nulo si no viene encriptado simplemente lo obtenemos
                if ($_GET['deporte']  == $deporteEncriptado) {

                    $deporte = $deporteDesencriptado;
                    $mensaje = "Listado de Pistas de " . ucfirst($deporte);
                } else {
                    $deporte = $_GET['deporte'];
                    $mensaje = "Listado de Pistas de " . ucfirst($deporte);
                }
            } else {
                $deporte = null;
            }

            //Desencriptar el deporte si viene encriptado y no es nulo si no viene encriptado simplemente lo obtenemos
            if (isset($_GET['municipios']) && !empty($_GET['municipios'])) {
                $municipio = $_GET['municipios'];
                $municipioEncriptado = base64_encode(base64_decode($municipio));
                $municipioDesencriptado = base64_decode($municipio);
                if ($municipio == $municipioEncriptado) {

                    $municipio = $municipioDesencriptado;
                    //Si el deporte es nulo y el municipio no lo es
                    if (is_null($deporte)) {
                        $mensaje = "Listado de Pistas en " . ucwords(mb_strtolower($municipio,'UTF-8'));
                    } else {
                        $mensaje = "Listado de Pistas de " . ucfirst($deporte) . " en " . ucwords(mb_strtolower($municipio,'UTF-8'));
                    }
                } else {
                    $municipio = $_GET['municipios'];
                    //Si el deporte es nulo y el municipio no lo es
                    if (is_null($deporte)) {
                        $mensaje = "Listado de Pistas en " . ucwords(mb_strtolower($municipio,'UTF-8'));
                    } else {
                        $mensaje = "Listado de Pistas de " . ucfirst($deporte) . " en " . ucwords(mb_strtolower($municipio,'UTF-8'));
                    }
                }
            } else {
                $municipio = null;
            }
            if (isset($_GET['horadeseada']) && !empty($_GET['horadeseada'])) {
                $horadeseada = $_GET['horadeseada'];
                $horadeseadaEncriptado = base64_encode(base64_decode($horadeseada));
                $horadeseadaDesencriptado = base64_decode($horadeseada);
                if ($_GET['horadeseada'] == $horadeseadaEncriptado) {
                    $horadeseada = $horadeseadaDesencriptado;
                } else {
                    $horadeseada = $_GET['horadeseada'];
                }
            } else {
                $horadeseada = null;
            }


            // Restar una hora a la hora de apertura
            if (!is_null($horadeseada)) {
                $horaCierreMenosUnaHora = date("H:i:s", strtotime($horadeseada) - 3600); // 3600 segundos es una hora
            } else {
                $horaCierreMenosUnaHora = null;
            }
            // Preparar y ejecutar la consulta
            $stmt = mysqli_prepare($conexion, "SELECT * FROM pistas WHERE (? IS NULL OR tipo_pista=?) AND (? IS NULL OR municipio=?) AND (? IS NULL OR hora_cierre > ?) and (? IS NULL OR provincia=?) AND validacion='ACTIVA'  ORDER BY fecha_registro DESC LIMIT 50");
            mysqli_stmt_bind_param($stmt, "ssssssss", $deporte, $deporte, $municipio, $municipio, $horadeseada, $horaCierreMenosUnaHora, $provincia, $provincia);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $id, $tipo, $nombre, $comunidad, $provincia, $municipio, $direccion, $cp, $correo, $telefono, $precio, $horaper, $horcierre, $fecha, $validada, $idempresa);
            $nombresPistas = array();
            while (mysqli_stmt_fetch($stmt)) {
                $nombresPistas[] = strtolower($nombre);
            }
            //Resetea el puntero de la consulta
            mysqli_stmt_data_seek($stmt, 0);
            ?>

    <div class="container">
        <?


        ?>
        <h1 class="text-center mt-2"><? echo $mensaje?></h1>
        <div class="message">Los filtros de búsqueda por nombre se aplican a las 12 pistas actuales.</div>
        <div id="alert-container" class="mt-3">
            <? if (isset($alertMessage)) {
                echo $alertMessage;
            } ?>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 mb-3">
                <div class="filter-container">
                    <select id="sport-filter" class="form-select">
                        <option value="">Ningún deporte seleccionado</option>
                        <option value="futbol">Fútbol</option>
                        <option value="baloncesto">Baloncesto</option>
                        <option value="tenis">Tenis</option>
                        <option value="padel">Pádel</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2 mb-3">
                <select class="form-select" id="provincias" name="provincias" title="provincias">
                    <option selected disabled>Seleccione la Provincia</option>
                    <option value="Álava" id="01">Álava (Álava/Araba)</option>
                    <option value="Albacete" id="02">Albacete</option>
                    <option value="Alicante" id="03">Alicante (Alicante/Alacant)</option>
                    <option value="Almería" id="04">Almería</option>
                    <option value="Ávila" id="05">Ávila</option>
                    <option value="Badajoz" id="06">Badajoz</option>
                    <option value="Islas Baleares" id="07">Islas Baleares</option>
                    <option value="Barcelona" id="08">Barcelona</option>
                    <option value="Burgos" id="09">Burgos</option>
                    <option value="Cáceres" id="10">Cáceres</option>
                    <option value="Cádiz" id="11">Cádiz</option>
                    <option value="Cantabria" id="39">Cantabria</option>
                    <option value="Castellón" id="12">Castellón (Castellón/Castelló)</option>
                    <option value="Ciudad Real" id="13">Ciudad Real</option>
                    <option value="Córdoba" id="14">Córdoba</option>
                    <option value="La Coruña" id="15">La Coruña (A Coruña)</option>
                    <option value="Cuenca" id="16">Cuenca</option>
                    <option value="Gerona" id="17">Gerona (Girona)</option>
                    <option value="Granada" id="18">Granada</option>
                    <option value="Guadalajara" id="19">Guadalajara</option>
                    <option value="Guipúzcoa" id="20">Guipúzcoa (Gipuzkoa)</option>
                    <option value="Huelva" id="21">Huelva</option>
                    <option value="Huesca" id="22">Huesca</option>
                    <option value="Jaén" id="23">Jaén</option>
                    <option value="León" id="24">León</option>
                    <option value="Lérida" id="25">Lérida (Lleida)</option>
                    <option value="La Rioja" id="26">La Rioja</option>
                    <option value="Lugo" id="27">Lugo</option>
                    <option value="Madrid" id="28">Madrid</option>
                    <option value="Málaga" id="29">Málaga</option>
                    <option value="Murcia" id="30">Murcia</option>
                    <option value="Navarra" id="31">Navarra (Nafarroa)</option>
                    <option value="Orense" id="32">Orense (Ourense)</option>
                    <option value="Palencia" id="34">Palencia</option>
                    <option value="Las Palmas" id="35">Las Palmas</option>
                    <option value="Pontevedra" id="36">Pontevedra</option>
                    <option value="Salamanca" id="37">Salamanca</option>
                    <option value="Santa Cruz de Tenerife" id="38">Santa Cruz de Tenerife</option>

                    <option value="Segovia" id="40">Segovia</option>
                    <option value="Sevilla" id="41">Sevilla</option>
                    <option value="Soria" id="42">Soria</option>
                    <option value="Tarragona" id="43">Tarragona</option>
                    <option value="Teruel" id="44">Teruel</option>
                    <option value="Toledo" id="45">Toledo</option>
                    <option value="Valencia" id="46">Valencia (València)</option>
                    <option value="Valladolid" id="47">Valladolid</option>
                    <option value="Vizcaya" id="48">Vizcaya (Bizkaia)</option>
                    <option value="Zamora" id="49">Zamora</option>
                    <option value="Zaragoza" id="50">Zaragoza</option>
                    <option value="Ceuta" id="51">Ceuta</option>
                    <option value="Melilla" id="52">Melilla</option>
                </select>
            </div>
            <div class="form-group col-md-3 mb-3">
                <select class="form-select" id="municipios" name="municipios" title="municipios" disabled>
                    <option selected disabled>Seleccione el Municipio</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <div class="horadeapertura">
                    <?
                    $conexion2 = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
                    mysqli_set_charset($conexion2, "utf8");
                    $stmt2 = mysqli_prepare($conexion2, "SELECT min(hora_apertura),max(hora_cierre) FROM pistas");
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_store_result($stmt2);
                    mysqli_stmt_bind_result($stmt2, $horaaperturaminima, $horacierremaxima);
                    ?>
                    <select class="form-select" id="horadeseada" name="horadeseada" title="horadeseada">
                        <option selected disabled>Seleccione la hora que desees</option>
                        <?
                        while (mysqli_stmt_fetch($stmt2)) {
                            $horaAperturaMinima = strtotime($horaaperturaminima);
                            $horaCierreMaxima = strtotime($horacierremaxima);

                            while ($horaAperturaMinima <= $horaCierreMaxima) {
                                echo '<option value="' . date("H:i", $horaAperturaMinima) . '">' . date("H:i", $horaAperturaMinima) . '</option>';
                                $horaAperturaMinima += 60 * 60; // Sumar 1 hora en segundos (3600 segundos)
                            }
                        }
                        mysqli_close($conexion2);

                        ?>
                    </select>
                </div>

            </div>
            <div class="col-md-2 mb-3">
                <div class="search-container text-end">
                <label for="search" class="visually-hidden">Buscar tu pista</label>
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

            if ($stmt->num_rows() == 0) {
            ?>
                <div class="container mt-2">
                    <div class="alert alert-warning alert-dismissible fade show position-relative" role="alert">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                            </svg>
                            <div class="mt-3">
                                <strong>No hay pistas que cumplan con las condiciones</strong>
                                <p class="mb-0">Intenta ajustar tus criterios de búsqueda.</p>
                            </div>
                        </div>
                    </div>
                </div>



            <?
            }
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
                $contadordislike = 0;
                $contadorlike = 0;
                $conexion3 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
                $stmt2 = mysqli_prepare($conexion3, "SELECT valoracion FROM valoraciones WHERE id_pista=?");
                $stmt2->bind_param('s', $id);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_store_result($stmt2);
                mysqli_stmt_bind_result($stmt2, $valoracion);
                while (mysqli_stmt_fetch($stmt2)) {
                    if ($valoracion == "like") {
                        $contadorlike++;
                    } else {
                        $contadordislike++;
                    }
                }

                //Ahora consulto los likes y dislikes del usuario para saber si ha dado like o dislike a la pista y mostrar los estilos
                $like = false;
                $dislike = false;
                $conexion4 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
                $stmt3 = mysqli_prepare($conexion4, "SELECT id_pista,valoracion FROM valoraciones WHERE id_pista=? AND id_usuario=?");
                $stmt3->bind_param('ss', $id, $_SESSION['id_usuario']);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_store_result($stmt3);
                mysqli_stmt_bind_result($stmt3, $idpista_valoracion, $valoracion);
                while (mysqli_stmt_fetch($stmt3)) {
                    if ($valoracion == "like") {
                        $like = true;
                    } else {
                        $dislike = true;
                    }
                }
                echo '<div class="col-md-4 mb-4 columna-buscar ">';
                echo '<div class="card h-100 animate__animated animate__fadeIn animate__slow">';
                echo '<div class="card-header">';

                // Primera fila con el nombre y el botón de favoritos
                echo '<div class="d-flex justify-content-between align-items-center">';
                echo '<h5 class="card-title">' . ucwords(mb_strtolower($nombre,'UTF-8')) . '</h5>';
                echo '<form method="post" action="">';
                echo '<button type="submit" name="pista_id" class="btn btn-star ' . ($esFavorito ? 'star-active' : 'star-icon') . '" id="star-' . $id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="' . ($esFavorito ? 'En favoritos' : 'Añadir a favoritos') . '"><i class="fa fa-star"></i></button>';
                echo '<input type="hidden" name="pista_id" value="' . $id . '">';
                echo '</form>';
                echo '</div>';

                // Segunda fila con la hora
                echo '<div class="hora h5">' . date("H:i", strtotime($horaper)) . '-' . date("H:i", strtotime($horcierre)) . '</div>';

                echo '</div>'; // Cierre del card-header






                echo '<div class="card-body text-center">';

                $nombreArchivo = $nombre . "($tipo-$comunidad-$provincia-$municipio-$correo-$id)";
                //Comprobamos si existe en la carpeta de imagenes la imagen de la pista para mostrarla o no
                if (file_exists("./imagenes/pistas/" . $nombreArchivo . ".jpg")) {
                    echo '<img src="./imagenes/pistas/' . $nombreArchivo . '.jpg" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                } else {
                    if($tipo=="Baloncesto"){
                        //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . strtolower($tipo) . '.png" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }else{
                    //Quitamos los acentos a la palabra tipo para que no de error al buscar la imagen
                    $tipo = str_replace('á', 'a', $tipo);
                    $tipo = str_replace('é', 'e', $tipo);
                    $tipo = str_replace('í', 'i', $tipo);
                    $tipo = str_replace('ó', 'o', $tipo);
                    $tipo = str_replace('ú', 'u', $tipo);
                    //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . (mb_strtolower($tipo,'UTF-8')) . '.jpg" alt="' . (mb_strtolower($tipo,'UTF-8')) . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }
                }

                // Clase 'img-thumbnail' de Bootstrap
                echo '<form method="post" action="reservapista.php">';

                echo '<ul class="list-group list-group-flush">';
                echo '<div class="card-footer d-flex justify-content-between">';
                if ($like = true && $idpista_valoracion == $id && $valoracion == "like") {

                    // Botón de "like" con estilo cuando el usuario ha dado "Me gusta"
                    echo '<button type="button" class="btn btn-link like-button liked" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="Me gusta">';
                    echo '<div class="hand-icon like-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-up"></i> <span class="like-count">' . $contadorlike . '</span>';
                    echo '</div>';
                    echo '</button>';
                } else {
                    // Botón de "like" (pulgar hacia arriba)
                    echo '<button type="button" class="btn btn-link like-button" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="Me gusta">';
                    echo '<div class="hand-icon like-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-up"></i> <span class="like-count">' . $contadorlike . '</span>';

                    echo '</div>';
                    echo '</button>';
                }

                if ($dislike = true && $idpista_valoracion == $id && $valoracion == "dislike") {
                    // Botón de "dislike" con estilo cuando el usuario ha dado "No me gusta"
                    echo '<button type="button" class="btn btn-link dislike-button disliked" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="No me gusta">';
                    echo '<div class="hand-icon dislike-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-down"></i> <span class="dislike-count">' . $contadordislike . '</span>';
                    echo '</div>';
                    echo '</button>';
                } else {
                    // Botón de "dislike" sin estilo cuando el usuario no ha dado "No me gusta"
                    echo '<button type="button" class="btn btn-link dislike-button" data-toggle="tooltip" data-placement="top" data-pista-id="' . $id . '" data-usuario-id="' . $_SESSION['id_usuario'] . '" title="No me gusta">';
                    echo '<div class="hand-icon dislike-button">';
                    echo '<i class="far thumbs-icon fa-thumbs-down"></i> <span class="dislike-count">' . $contadordislike . '</span>';
                    echo '</div>';
                    echo '</button>';
                }

                if (strpos($precio, '.00') !== false) {
                    // El precio tiene .00 al final, lo eliminamos
                    $precio = str_replace('.00', '', $precio);
                }
                echo '</div>';
                echo '<li class="list-group-item"><strong>Provincia:</strong> ' . ucwords(mb_strtolower($provincia,'UTF-8')) . '</li>';
                echo '<li class="list-group-item" name="municipio"><strong>Municipio:</strong> ' . ucwords(mb_strtolower($municipio,'UTF-8')) . '</li>';
                echo '<li class="list-group-item"><strong>Teléfono de Contacto:</strong> ' . ucwords(strtolower($telefono)) . '</li>';
                echo '<li class="list-group-item"><strong>Precio por hora:</strong> ' . $precio . '€</li>';
                echo '</ul>';
                echo '<button style="background-color: #e86b1c;width:210px" type="submit" class="btn btn-primary btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reserva Ya">Reserva ya</button>';
                echo '<input type="hidden" name="id_pista" value="' . $id . '">';
                echo '<input type="hidden" name="nombre_pista" value="' . $nombre . '">';
                echo '<input type="hidden" name="provincia" value="' . $provincia . '">';
                echo '<input type="hidden" name="municipio" value="' . $municipio . '">';
                echo '<input type="hidden" name="precio" value="' . $precio . '">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            }
            ?>
        </div>
        <div class="pagination-container text-center">
            <?php
            $prevPage = $currentPage - 1;
            $nextPage = $currentPage + 1;

            // Obtén la URL actual
            $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            // Analiza los parámetros actuales
            $parameters = $_GET;

            // Agrega o actualiza el parámetro 'page'
            $parameters['page'] = $nextPage;

            // Construye la nueva URL
            $newURL = strtok($currentURL, '?') . '?' . http_build_query($parameters);

            if ($prevPage > 0) {
                echo '<a href="?page=' . $prevPage . '" class="prev-page">Anterior</a>';
            }

            if ($contador > $start + $itemsPerPage) {
                echo '<a href="' . $newURL . '" class="next-page">Siguiente</a>';
            }





            mysqli_close($conexion);

            ?>
        </div>
    </div><?
        }


        function registrarUsuario()
        {
            include_once "NOACCESIBLE/credencialesdb.php";
            $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];
            $repetirContraseña = $_POST['repetirContraseña'];
            $aceptarTerminos = $_POST['aceptarTerminos'];

            if ($contraseña == $repetirContraseña) {
                $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

                // Generar id usuario para la base de datos
                $idUsuario = uniqid();

                // Insertar datos en la base de datos
                if ($stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (id_usuario, nombre, correo, rol, contrasena) VALUES (?,?,?,?,?)")) {
                } else {
                    echo $conexion->error;
                }
                $usuario = "Usuario";

                if (mysqli_stmt_bind_param($stmt, "sssss", $idUsuario, $nombre, $correo, $usuario, $contraseña)) {
                } else {
                    echo $stmt->error;
                }

                if (mysqli_stmt_execute($stmt)) {
                    // Ejecución exitosa
                    $modalTitle = '¡Registro Exitoso!';
                    $modalContent = '<i class="fas fa-check-circle text-success text-center fa-4x d-block mx-auto"></i>';
                    $modalContent .= "<p class='mt-4'>¡Felicidades, $nombre!</p>";
                    $modalContent .= "<p>¡Bienvenido a la comunidad de Court Fusion! Tu registro se ha completado con éxito, y estamos emocionados de tenerte a bordo.</p>";
                    $modalContent .= "<p>A partir de ahora, puedes disfrutar de todas las funciones y ventajas que ofrece nuestra plataforma. Para comenzar, por favor <a href='iniciarsesion.php'>inicia sesión</a> en tu cuenta y explora todo lo que Court Fusion tiene para ofrecer. Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con nosotros.</p>";
                    $modalContent .= "<p>Gracias por unirte a nosotros y ser parte de nuestra comunidad. ¡Es un placer tenerte aquí!</p>";
                } else {
                    $modalTitle = '¡Registro Fallido!';
                    $modalContent = '<i class="fas fa-times-circle text-danger text-center fa-4x d-block mx-auto"></i>';
                    $modalContent .= '<p class="mt-4">Lo sentimos, ha ocurrido un error durante el registro.</p>';
                    $modalContent .= '<p>El registro no se pudo completar en este momento. Por favor, inténtalo nuevamente más tarde o <a href="mailto:courtfusion@gmail.com">contáctanos</a> para obtener asistencia.</p>';
                }


                // Luego, utiliza JavaScript para mostrar el modal
                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'document.querySelector("#miModal").addEventListener("show.bs.modal", function () {';
                echo 'document.querySelector("#modalHeader").innerHTML = "' . $modalTitle . '";';
                echo 'document.querySelector("#modalBody").innerHTML = `' . $modalContent . '`;';
                echo '});';
                echo 'var myModal = new bootstrap.Modal(document.querySelector("#miModal"));';
                echo 'myModal.show();';
                echo '});';
                echo '</script>';
            } else {
                echo "<script>alert('Las contraseñas no coinciden');</script>";
            }
        }

        function registrarEmpresa()
        {
            include_once "NOACCESIBLE/credencialesdb.php";
            $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
            $id_empresa = uniqid();
            $nombre_empresa = $_POST['nombre_empresa'];
            $correo_contacto = $_POST['correo_contacto'];
            $telefono_contacto = $_POST['telefono_contacto'];
            $comunidad_autonoma = $_POST['comunidad_autonoma'];
            $provincia = $_POST['provincia'];
            $municipio = $_POST['municipio'];
            $direccion = $_POST['direccion'];
            $codigo_postal = $_POST['codigo_postal'];
            $terms = $_POST['terms'];
            $contraseña = $_POST['contraseñaempresa'];
            $repetirContraseña = $_POST['confirmar_contraseña'];
            if ($contraseña == $repetirContraseña) {
                $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
                //Generar id usuario para la base de datos
                $idUsuario = uniqid();
                //Insertar datos en la tabla empresas
                if ($stmt = mysqli_prepare($conexion, "INSERT INTO empresas (id_empresa, nombre_empresa, correo_contacto, telefono_contacto, comunidad_autonoma, provincia, municipio, direccion, codigo_postal, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
                } else {
                    echo $conexion->error;
                }
                if (mysqli_stmt_bind_param($stmt, "ssssssssss", $id_empresa, $nombre_empresa, $correo_contacto, $telefono_contacto, $comunidad_autonoma, $provincia, $municipio, $direccion, $codigo_postal, $contraseña)) {
                } else {
                    echo $stmt->error;
                }
                if (mysqli_stmt_execute($stmt)) {
                    // Ejecución exitosa
                    $modalTitle = '¡Registro de Empresa Exitoso!';
                    $modalContent = "<i class='fas fa-check-circle text-success text-center fa-4x d-block mx-auto'></i>";
                    $modalContent .= "<p class='mt-4'>¡Felicidades, $nombre_empresa!</p>";
                    $modalContent .= "<p>Es un placer dar la bienvenida a $nombre_empresa a la comunidad de CourtFusion. Hemos recibido tu registro con éxito, y estamos emocionados de unir fuerzas contigo.</p>";
                    $modalContent .= "<p>Desde ahora, podrás acceder a todas las funciones y ventajas que ofrece nuestra plataforma. Para comenzar, por favor <a href='iniciarsesion.php'>inicia sesión</a> en tu cuenta y comienza a explorar lo que CourtFusion tiene preparado para ti. No dudes en contactarnos si tienes alguna pregunta o necesitas asistencia.</p>";
                    $modalContent .= "<p>¡Gracias por confiar en nosotros y ser parte de nuestra comunidad!</p>";
                } else {
                    $modalTitle = '¡Registro de Empresa Fallido!';
                    $modalContent = "<i class='fas fa-times-circle text-danger text-center fa-4x d-block mx-auto'></i>";
                    $modalContent .= "<p class='mt-4'>Lo sentimos, ha ocurrido un error durante el registro.</p>";
                    $modalContent .= "<p>El registro no se pudo completar en este momento. Por favor, inténtalo nuevamente más tarde o <a href='mailto:courtfusion@gmail.com'>contáctanos</a> para obtener asistencia.</p>";
                }

                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'document.querySelector("#miModal").addEventListener("show.bs.modal", function () {';
                echo 'document.querySelector("#modalHeader").innerHTML = "' . $modalTitle . '";';
                echo 'document.querySelector("#modalBody").innerHTML = "' . $modalContent . '";'; // Usa comillas simples o dobles aquí
                echo '});';
                echo 'var myModal = new bootstrap.Modal(document.querySelector("#miModal"));';
                echo 'myModal.show();';
                echo '});';
                echo '</script>';
            } else {
                echo "<script>alert('Las contraseñas no coinciden');</script>";
            }
        }


        function mostrarPistasIndex()
        {
            //Destruye la sesiones para que no se queden los filtros de búsqueda
            if (isset($_SESSION['tipoPista']) && isset($_SESSION['comunidad']) && isset($_SESSION['provincia']) && isset($_SESSION['municipio'])) {
                unset($_SESSION['tipoPista']);
                unset($_SESSION['comunidad']);
                unset($_SESSION['provincia']);
                unset($_SESSION['municipio']);
            }
            //Si no wxisten las sesiones, se crean
            if (!isset($_SESSION['tipoPista']) && !isset($_SESSION['comunidad']) && !isset($_SESSION['provincia']) && !isset($_SESSION['municipio'])) {
                $tipoPista = $_POST['tipoPista'];
                $comunidad = $_POST['comunidades'];
                $provincia = $_POST['provincias'];
                $municipio = $_POST['municipios'];
                $_SESSION['tipoPista'] = $_POST['tipoPista'];
                $_SESSION['comunidad'] = $_POST['comunidades'];
                $_SESSION['provincia'] = $_POST['provincias'];
                $_SESSION['municipio'] = $_POST['municipios'];
            } else {
                $tipoPista = $_SESSION['tipoPista'];
                $comunidad = $_SESSION['comunidad'];
                $provincia = $_SESSION['provincia'];
                $municipio = $_SESSION['municipio'];
            }


            include "NOACCESIBLE/credencialesdb.php";
            $conexion = mysqli_connect($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . mysqli_connect_error() . '<br>');
            mysqli_set_charset($conexion, "utf8");
            if ($stmt = mysqli_prepare($conexion, "SELECT * FROM pistas WHERE tipo_pista=? AND comunidad_autonoma=? AND provincia=? AND municipio=?")) {
            } else {
                echo "Error: " . mysqli_error($conexion);
            }
            $stmt->bind_param('ssss', $tipoPista, $comunidad, $provincia, $municipio);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            echo mysqli_stmt_num_rows($stmt);
            mysqli_stmt_bind_result($stmt, $id, $tipo, $nombre, $comunidad, $provincia, $municipio, $direccion, $cp, $correo, $telefono, $precio, $horaper, $horcierre, $fecha, $validada, $idempresa);
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
                <label for="search" class="visually-hidden">Buscar tu pista</label>
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
                    if($tipo=="Baloncesto"){
                        //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . strtolower($tipo) . '.png" alt="' . $nombre . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }else{
                    //Quitamos los acentos a la palabra tipo para que no de error al buscar la imagen
                    $tipo = str_replace('á', 'a', $tipo);
                    $tipo = str_replace('é', 'e', $tipo);
                    $tipo = str_replace('í', 'i', $tipo);
                    $tipo = str_replace('ó', 'o', $tipo);
                    $tipo = str_replace('ú', 'u', $tipo);
                    //Mostramos la imagen que se llama pista+deporte por ejemplo pistabaloncesto.jpg
                    echo '<img src="./imagenes/pista' . (mb_strtolower($tipo,'UTF-8')) . '.jpg" alt="' . (mb_strtolower($tipo,'UTF-8')) . '" class="img-fluid img-thumbnail" style="height: 200px;">';
                    }
                }
                // Clase 'img-thumbnail' de Bootstrap
                echo '<ul class="list-group list-group-flush">';
                echo '<li class="list-group-item"><strong>Provincia:</strong> ' . $provincia . '</li>';
                echo '<li class="list-group-item"><strong>Municipio:</strong> ' . $municipio . '</li>';
                echo '<li class="list-group-item"><strong>Teléfono de Contacto:</strong> ' . $telefono . '</li>';
                echo '<li class="list-group-item"><strong>Precio por hora:</strong> ' . $precio . '€</li>';
                echo '</ul>';
                echo '<button style="background-color: #e86b1c;width:210px" type="submit" class="btn btn-primary btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reserva Ya">Reserva ya</button>';
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
                // Enlace a la página anterior manteniendo los parámetros de búsqueda
                echo '<a href="?page=' . $prevPage . '&tipoPista=' . $tipoPista . '&comunidades=' . $comunidad . '&provincias=' . $provincia . '&municipios=' . $municipio . '">Anterior</a>';
            }
            if ($contador > $start + $itemsPerPage) {
                // Enlace a la página siguiente manteniendo los parámetros de búsqueda
                echo '<a href="?page=' . $nextPage . '&tipoPista=' . $tipoPista . '&comunidades=' . $comunidad . '&provincias=' . $provincia . '&municipios=' . $municipio . '">Siguiente</a>';
            }
            ?>
        </div>
    </div>
<?
        }



?>