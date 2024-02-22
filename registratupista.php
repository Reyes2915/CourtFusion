<? session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra tu Pista</title>

    <!-- Agrega los enlaces a los archivos CSS de Bootstrap y jQuery si es necesario -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" href="imagenes/icono.jfif" alt="Ícono de la página" title="Ícono de la página">
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/clockpicker.css">
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/standalone.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="css/registropista.css" rel="stylesheet">
</head>

<body>
    <?php
    include "funciones.php";
    if (isset($_SESSION['id_empresa'])) {
        if (isset($_POST['registrarpista'])) {
            $carpetaDestino = './imagenes/pistasporvalidar/';

            if (!file_exists($carpetaDestino)) {
                mkdir($carpetaDestino, 0755, true);
            }

            $imagenPista = $_FILES['imagenPista']['name'];
            $rutaTemp = $_FILES['imagenPista']['tmp_name'];
            $nombrePista = $_POST['nombrePista']; // Asegúrate de que esta variable esté definida

            // Construye el nuevo nombre de archivo
            //$_SESSION['id_usuario'] = "652d92f2ab50a";

            include "NOACCESIBLE/credencialesdb.php";

            $tipoPista = $_POST['tipoPista'];
            $nombrePista = $_POST['nombrePista'];
            $comunidad = $_POST['comunidades'];
            $provincia = $_POST['provincias'];
            $municipio = $_POST['municipios'];
            $codigoPostal = $_POST['codigoPostal'];
            $telefonoContacto = $_POST['telefonoContacto'];
            $correoContacto = $_POST['correoContacto'];
            $precioHora = $_POST['precioHora'];
            $horaApertura = $_POST['horaapertura'];
            $horaCierre = $_POST['horacierre'];
            $direccion = $_POST['direccion'];
            //Convertir a formato time hh:mm:ss la hora de apertura y cierre para poder insertarla en la base de datos
            $horaApertura = date("H:i:s", strtotime($horaApertura));
            $horaCierre = date("H:i:s", strtotime($horaCierre));
            $idPista = uniqid();
            $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');

            // Obtener la fecha y hora actual en el formato correcto
            $fechaRegistro = date("Y-m-d H:i:s");

            // Insertar los datos en la tabla
            if ($stmt = mysqli_prepare($conexion, "INSERT INTO pistas (id_pista,tipo_pista,nombre_pista,comunidad_autonoma,provincia,municipio,direccion,codigo_postal,correo_contacto,telefono_contacto,precio_hora,hora_apertura,hora_cierre,fecha_registro,id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            } else {
                echo  "ERROS EN EL PARAM" . $conexion->error;
            }

            // Enlazar los parámetros con los valores de las variables
            if (mysqli_stmt_bind_param($stmt, "sssssssssssssss", $idPista, $tipoPista, $nombrePista, $comunidad, $provincia, $municipio, $direccion, $codigoPostal, $correoContacto, $telefonoContacto, $precioHora, $horaApertura, $horaCierre, $fechaRegistro, $_SESSION['id_empresa'])) {
            } else {
                echo  "ERROS EN EL PARAM" . $conexion->error;
            }
            if (mysqli_stmt_execute($stmt)) {
                echo $idPista . '.' . $tipoPista . '.' . $nombrePista . '.' . $comunidad . '.' . $provincia . '.' . $municipio . '.' . $direccion . '.' . $codigoPostal . '.' . $correoContacto . '.' . $telefonoContacto . '.' . $precioHora . '.' . $horaApertura . '.' . $horaCierre . '.' . $fechaRegistro . '.' . $_SESSION['id_empresa'];
                $tipoPista = str_replace('-', ' ', $tipoPista);
                $comunidad = str_replace('-', ' ', $comunidad);
                $provincia = str_replace('-', ' ', $provincia);
                $municipio = str_replace('-', ' ', $municipio);
                $correoContacto = str_replace('-', ' ', $correoContacto);
                $idPista = str_replace('-', ' ', $idPista);
                $nuevoNombreArchivo = $carpetaDestino . $nombrePista . "($tipoPista-$comunidad-$provincia-$municipio-$correoContacto-$idPista).jpg"; // O el formato que desees (por ejemplo, .jpg)

                // Mueve el archivo a la carpeta destino y renómbralo
                if (move_uploaded_file($rutaTemp, $nuevoNombreArchivo)) {
                    // Continúa con la inserción de datos en la base de datos si es necesario
                } else {
                }
                // Ejecución exitosa
                $modalTitle = 'Pista registrada con éxito';
                $modalContent = '<i class="fas fa-check-circle text-success text-center fa-4x d-block mx-auto"></i>';
                $modalContent .= '<p class="mt-4">¡Pista registrada con éxito!</p>';
                $modalContent .= '<p>¡Gracias por confiar en nosotros! En breve, un administrador revisará la información y la publicará en la web.</p>';
            } else {
                // Error en la ejecución
                $modalTitle = 'Ha ocurrido un error';
                $modalContent = '<i class="fas fa-times-circle text-danger text-center fa-4x d-block mx-auto"></i>';
                $modalContent .= '<p class="mt-4">¡Ha ocurrido un error!</p>';
                $modalContent .= '<p>¡Inténtalo de nuevo más tarde!</p>';
                $modalContent .= '<p>Asegúrate de que has iniciado sesión correctamente y, si sigues teniendo problemas, no dudes en <a href="#contacto" title="contacto">contactarnos</a>.';
                echo "Error execute" . $stmt->error;
            }

            // Luego, utiliza JavaScript para mostrar el modal
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'document.querySelector("#miModal").addEventListener("show.bs.modal", function () {';
            echo 'document.querySelector("#modalHeader").innerHTML = "' . $modalTitle . '";';
            echo 'document.querySelector("#modalBody").innerHTML = \'' . $modalContent . '\';';
            echo '});';
            echo 'var myModal = new bootstrap.Modal(document.querySelector("#miModal"));';
            echo 'myModal.show();';
            echo '});';
            echo '</script>';
        } else {
        }
    } else {
        $modalTitle = 'Inicia sesión para registrar tu pista';
        $modalContent = '<i class="fas fa-exclamation-circle text-warning text-center fa-4x d-block mx-auto"></i>';
        $modalContent .= '<p class="mt-4">¡Inicia sesión como empresa para registrar tu pista!</p>';
        $modalContent .= '<p>Si no tienes una cuenta, <a href="registro.php" title="registroempresa">regístrate</a> ahora.</p>';
        $modalContent .= '<p>Si sigues teniendo problemas, no dudes en <a href="mailto:Courtfusioninfo@gmail.com" title="contacto">contactarnos</a>.</p>';

        echo '<div id="miModal" class="modal fade" tabindex="-1" role="dialog">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="modalHeader">' . $modalTitle . '</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="modal-body" id="modalBody">';
        echo $modalContent;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'var myModal = new bootstrap.Modal(document.getElementById("miModal"));';
        echo 'myModal.show();';
        echo 'document.getElementById("miModal").addEventListener("hidden.bs.modal", function () {';
        echo 'window.location.href = "index.php";'; // Redirigir al cerrar el modal
        echo '});';
        echo '});';
        echo '</script>';
    }
    mostrarNavbar();
    ?>

    <div class="modal fade" id="miModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader" aria-labelledby="modalHeader">Título del modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- El contenido del modal se llenará dinámicamente con JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader" aria-labelledby="modalHeader">Título del modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Contenido del modal se llenará dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container" id="formulariopista">
        <div class="row justify-content-between">
            <div class="col-md-5 texto-izquierda">
                <h2>Asóciate con el líder en servicios de reserva de pistas de España</h2>
                <p class="mt-5">
                    <strong>¿Quieres llevar tu negocio de alquiler de pistas deportivas al siguiente nivel? Únete a nosotros, el líder en servicios de reserva de pistas de España, y descubre cómo puedes conseguir más clientes, impulsar tus ventas y mejorar los resultados de tus acciones de marketing. Con nuestra plataforma, tendrás acceso a una amplia base de usuarios que buscan pistas deportivas de alta calidad. Conviértete en parte de nuestra red y experimenta el crecimiento de tu negocio como nunca antes.</strong>
                </p>
            </div>


            <div class="col-md-6 col-12 formulario mb-2">
                <h2 class="text-center mb-4">Registra tu Pista</h2>
                <form action="" method="post" id="miFormulario" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipoPista">Tipo de Pista</label>
                                <select class="form-control" id="tipoPista" name="tipoPista" required>
                                    <option value="" selected>Seleccione su pista</option>
                                    <option value="Fútbol">Fútbol</option>
                                    <option value="Baloncesto">Baloncesto</option>
                                    <option value="Tenis">Tenis</option>
                                    <option value="Pádel">Pádel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombrePista">Nombre de la Pista</label>
                                <input type="text" class="form-control" id="nombrePista" name="nombrePista" placeholder="Nombre de la pista" title="Nombre de la pista" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comunidades" class="form-label">Comunidades</label>
                                <select class="form-select" id="comunidades" name="comunidades" title="comunidades" required>
                                    <option selected disabled>Seleccione la Comunidad Autónoma</option>
                                    <!-- Las opciones se agregarán aquí -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincias" class="form-label">Provincias</label>
                                <select class="form-select" id="provincias" name="provincias" title="provincias" disabled required>
                                    <option selected disabled>Seleccione la Provincia</option>
                                    <!-- Las opciones se agregarán aquí -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipios" class="form-label">Municipios</label>
                                <select class="form-select" id="municipios" name="municipios" title="municipios" disabled required>
                                    <option selected disabled>Seleccione el Municipio</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigoPostal">Código Postal</label>
                                <input type="text" class="form-control" pattern="[0-9]{5}" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" title="Código Postal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefonoContacto">Teléfono</label>
                                <input type="tel" class="form-control" id="telefonoContacto" name="telefonoContacto" placeholder="Teléfono de Contacto" title="Teléfono de Contacto" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de la Pista" title="Dirección de la Pista" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group clockpicker">
                                <label for="horaapertura" class="form-label">Hora de Apertura</label>
                                <input type="text" class="form-control" id="horaapertura" name="horaapertura" placeholder="Hora de Apertura" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group clockpicker">
                                <label for="horacierre">Hora de Cierre</label>
                                <input type="text" class="form-control" id="horacierre" autocomplete="off" name="horacierre" placeholder="Hora de cierre" title="HOra de cierre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precioHora">Precio por hora</label>
                                <input type="number" class="form-control" id="precioHora" name="precioHora" placeholder="Precio por hora" title="Precio por hora" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correoContacto">Correo de Contacto</label>
                                <input type="email" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de Contacto" title="Correo de Contacto" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="imagenPista">Foto de la Pista</label>
                                <input type="file" class="form-control" id="imagenPista" name="imagenPista" placeholder="Imagen de la Pista" title="Imagen de la Pista" required>
                            </div>
                        </div>
                    </div>


                    <button type="submit" name="registrarpista" class="btn btn-primary btn-enviar" id="registrarpista" title="Enviar formulario">Únete a Courtfusion</button>
                </form>
            </div>
        </div>
    </div>

    <?

    mostrar_footer();
    ?>
    <!-- Footer -->

    <!-- Agrega los enlaces a los archivos JS de Bootstrap y jQuery si es necesario -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/buscarMunicipio.js"></script>
    <script src="./clockpicker-gh-pages/src/clockpicker.js"></script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker();
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("registrarpista");
            const horaInicioInput = document.getElementById("horaapertura");
            const horaFinInput = document.getElementById("horacierre");
            const formulario = document.getElementById("miFormulario");
            //Seleccionar el boton con la clase botonhecho para las horas de apertura y cierre

            horaInicioInput.addEventListener("click", function() {
                const botonesHecho = document.querySelectorAll(".botonhecho");

                botonesHecho.forEach(function(botonHecho) {
                    botonHecho.addEventListener("click", function() {
                        horaInicioInput.value = horaInicioInput.value;
                        horaFinInput.value = horaFinInput.value;
                        // Obtener la hora de inicio como un número
                        const horaInicio = parseHourString(horaInicioInput.value);

                        // Configurar la hora de fin con un atributo 'min' que sea una hora más que la hora de inicio
                        const horaFinMin = (horaInicio + 1).toFixed(2); // Sumar una hora a la hora de inicio
                        horaFinInput.min = formatHourString(horaFinMin); // Formatear como HH:mm y establecer como min
                    });
                });
            });

            horaFinInput.addEventListener("click", function() {
                const botonesHecho = document.querySelectorAll(".botonhecho");
                botonesHecho.forEach(function(botonHecho) {
                    botonHecho.addEventListener("click", function() {
                        horaInicioInput.value = horaInicioInput.value;
                        horaFinInput.value = horaFinInput.value;
                        // Obtener la hora de inicio como un número
                        const horaInicio = parseHourString(horaInicioInput.value);

                        // Configurar la hora de fin con un atributo 'min' que sea una hora más que la hora de inicio
                        const horaFinMin = (horaInicio + 1).toFixed(2); // Sumar una hora a la hora de inicio
                        horaFinInput.min = formatHourString(horaFinMin); // Formatear como HH:mm y establecer como min

                    });
                });
            });



            // Agregar un evento al formulario para que se ejecute antes del envío
            form.addEventListener("click", function(event) {
                // Obtener los valores de las horas de inicio y fin
                const horaInicio = parseHourString(horaInicioInput.value);
                const horaFin = parseHourString(horaFinInput.value);

                // Verificar si la hora de inicio es mayor o igual que la hora de fin
                if (horaFin <= horaInicio) {
                    // Mostrar un mensaje de error o tomar la acción adecuada
                    horaFinInput.setCustomValidity("La hora de cierre debe ser mayor que la hora de apertura.");
                } else {
                    // La hora de fin es mayor que la hora de inicio, por lo que no hay error
                    horaFinInput.setCustomValidity("");
                }
            });

            // Función para analizar una cadena de hora en formato HH:mm y devolver un valor numérico
            function parseHourString(hourString) {
                const parts = hourString.split(":");
                if (parts.length === 2) {
                    const hours = parseInt(parts[0], 10);
                    const minutes = parseInt(parts[1], 10);
                    return hours + minutes / 60;
                }
                return 0;
            }

            // Agregar un evento al campo de hora de inicio para ajustar el atributo 'min' del campo de hora de fin
            horaInicioInput.addEventListener("change", function() {
                // Obtener la hora de inicio como un número
                const horaInicio = parseHourString(horaInicioInput.value);

                // Configurar la hora de fin con un atributo 'min' que sea una hora más que la hora de inicio
                const horaFinMin = (horaInicio + 1).toFixed(2); // Sumar una hora a la hora de inicio
                horaFinInput.min = formatHourString(horaFinMin); // Formatear como HH:mm y establecer como min
            });

            // Función para formatear un número como cadena de hora en formato HH:mm
            function formatHourString(hour) {
                const hours = Math.floor(hour);
                const minutes = Math.round((hour - hours) * 60);
                return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
            }

        });
    </script>
</body>

</html>