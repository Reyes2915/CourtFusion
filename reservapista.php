<?

use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="./clockpicker-gh-pages/src/clockpicker.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="./clockpicker-gh-pages/src/standalone.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />

  <title>Reserva Tu Pista</title>
  <link rel="icon" href="imagenes/icono.jfif">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link type="text/css" rel="stylesheet" href="css/estilos.css">

</head>

<body>
  <?
  include "funciones.php";
  mostrarNavbar();
  if (isset($_POST['id_pista']) && isset($_POST['municipio'])) {
    $idPista = $_POST['id_pista'];
    $municipio = $_POST['municipio'];
    if (isset($_SESSION['id_pista']) && isset($_SESSION['municipio'])) {
      unset($_SESSION['id_pista']);
      unset($_SESSION['municipio']);
      $_SESSION['id_pista'] = $idPista;
      $_SESSION['municipio'] = $municipio;
    } else {
      $_SESSION['id_pista'] = $idPista;
      $_SESSION['municipio'] = $municipio;
    }
  } else {
    $idPista = $_SESSION['id_pista'];
    $municipio = $_SESSION['municipio'];
  }
  include "NOACCESIBLE/credencialesdb.php";
  $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
  //Obtenemos el saldo del usuario
  $stmt = mysqli_prepare($conexion, "SELECT saldo,correo FROM usuarios WHERE id_usuario=?");
  mysqli_stmt_bind_param($stmt, "s", $_SESSION['id_usuario']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $saldo,$correousu);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
  $stmt = mysqli_prepare($conexion, "SELECT id_pista,tipo_pista,nombre_pista,comunidad_autonoma,provincia,municipio,direccion,codigo_postal,correo_contacto,telefono_contacto,precio_hora,hora_apertura,hora_cierre,fecha_registro,id_empresa FROM pistas WHERE id_pista=?");
  mysqli_stmt_bind_param($stmt, "s", $idPista);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_store_result($stmt);
  mysqli_stmt_bind_result($stmt,$id, $tipo, $nombrepista, $comunidad, $provincia, $municipio, $direccion, $cp, $correo, $telefono, $precio, $horaper, $horcierre, $fecha, $idusu);
  //fetch
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
  if (isset($_POST['reservar'])) {
    $idreserva = uniqid();
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    // Crea objetos DateTime para la fecha y las horas
    $fechaDatetime = new DateTime($fecha);
    $horaInicioDatetime = new DateTime($fecha . ' ' . $horaInicio);
    $horaFinDatetime = new DateTime($fecha . ' ' . $horaFin);

    // Formatea los objetos DateTime como cadenas de fecha y hora
    $fechaFormateada = $fechaDatetime->format('Y-m-d H:i:s');
    $horaInicioFormateada = $horaInicioDatetime->format('Y-m-d H:i:s');
    $horaFinFormateada = $horaFinDatetime->format('Y-m-d H:i:s');
    $idUsuario = $_SESSION['id_usuario'];
   
    //Ahora sacamos las horas reservadas para sacar el precio y comprobar si el usuario tiene saldo suficiente
    $intervalo = $horaInicioDatetime->diff($horaFinDatetime);
    $minutosTotales = ($intervalo->days * 24 * 60) + ($intervalo->h * 60) + $intervalo->i;

    // Calcula el número de horas reservadas
    $horasReservadas = $minutosTotales / 60;
    $precioTotal = $precio * $horasReservadas;

    // Calcula el precio total
    if ($saldo < $precioTotal) {
      $modalTitle = 'Saldo insuficiente';
      $modalContent = '<i class="fas fa-times-circle text-danger text-center fa-4x d-block mx-auto"></i>';
      $modalContent .= '<p class="mt-4">¡Saldo insuficiente!</p>';
      $modalContent .= '<p>¡No tienes saldo suficiente para realizar la reserva!</p>';
      $modalContent .= '<p>Por favor, recarga tu saldo para poder realizar la reserva.</p>';
    } else {

      $stmt = mysqli_prepare($conexion, "INSERT INTO reservas (id_reserva,id_usuario,id_pista,nombre_reservante,hora_inicio_reserva,hora_fin_reserva) VALUES (?, ?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt, "ssssss", $idreserva, $idUsuario, $idPista, $nombre, $horaInicioFormateada, $horaFinFormateada);
      if (mysqli_stmt_execute($stmt)) {  // Ejecución exitosa
        $modalTitle = 'Reserva registrada con éxito';
        $modalContent = '<i class="fas fa-check-circle text-success text-center fa-4x d-block mx-auto"></i>';
        $modalContent .= '<p class="mt-4">¡Reserva registrada con éxito! Gracias por tu reserva.</p>';
        $modalContent .= '<p class="mt-2">Recuerda que el pago es reembolsable si cancelas con al menos una semana de antelación. Si necesitas cancelar, por favor, asegúrate de notificarnos con suficiente tiempo.</p>';
        //Restamos el saldo al usuario
        $saldoDespues = $saldo - $precioTotal;
        //Convertimos el saldo a float
        $saldoDespues = floatval($saldoDespues);
        if ($stmt = mysqli_prepare($conexion, "UPDATE usuarios SET saldo=? WHERE id_usuario=?")) {
        } else {
          echo $stmt->error;
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $saldoDespues, $idUsuario)) {
        } else {
          echo $stmt->error;
        }
        if (mysqli_stmt_execute($stmt)) {
        } else {
          echo $stmt->error;
        }
        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
          $to = $correousu;
          // Server settings
          $mail->isSMTP(); // Send using SMTP
          $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
          $mail->SMTPAuth = true; // Enable SMTP authentication
          $mail->Username = 'reyes3790183@gmail.com'; // SMTP username
          $mail->Password = 'sfpz mtlk byza vxoj'; // SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
          $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          // Recipients
          $mail->setFrom('reyes3790183@gmail.com', 'Courtfusion');
          $mail->addAddress($to); // Add a recipient
          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = '=?UTF-8?B?' . base64_encode('Reserva Realizada Correctamente') . '?=';
          $mail->Body = '
<html>
<head>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h3 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        .logo {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost/Ejercicios/TFG/index.php">
            <img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
        </a>
        <h3>Estimado Usuario,</h3>
        <p>Su reserva en Courtfusion ha sido realizada con éxito. A continuación, se detallan los datos clave:</p>
        <p>Nombre de la pista: ' . $nombrepista . '</p>
        <p>Nombre del reservante: ' . $nombre . '</p>
        <p>Fecha de la reserva: ' . $fechaDatetime->format('d/m/Y') . '</p>
        <p>Hora de Inicio: ' . $horaInicio . '</p>
        <p>Hora de Finalización: ' . $horaFin . '</p>
        <p>Gracias por utilizar Courtfusion. Disfrute de su reserva.</p>
        <p>Atentamente,</p>
        <p>El equipo de Courtfusion</p>
    </div>
</body>
</html>';
          $mail->AltBody = 'Su reserva en Courtfusion ha sido realizada con éxito. A continuación, se detallan los datos clave:
Nombre de la pista: ' . $nombre . '
Fecha de la reserva: ' . $fechaDatetime->format('d/m/Y') . '
Hora de apertura: ' . $horaInicio . '
Hora de cierre: ' . $horaFin . '
Gracias por utilizar Courtfusion. Disfrute de su reserva.';

          $mail->send();
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      } else {
        // Error en la ejecución
        $modalTitle = 'Ha ocurrido un error';
        $modalContent = '<i class="fas fa-times-circle text-danger text-center fa-4x d-block mx-auto"></i>';
        $modalContent .= '<p class="mt-4">¡Ha ocurrido un error!</p>';
        $modalContent .= '<p>¡Inténtalo de nuevo más tarde!</p>';
        $modalContent .= '<p>Asegúrate de que has iniciado sesión correctamente y, si sigues teniendo problemas, no dudes en <a href="#contacto" title="contacto">contactarnos</a>.';
        echo $stmt->error;
      }
    }

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
  }
  ?>


  <div class="container mt-4 animate__animated animate__fadeIn animate__slow">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header text-center">
            <h4 class="mb-0" id="muniprueba">Pronóstico Semanal (<?php echo $municipio ?>)</h4>
          </div>
          <div class="card-body">
            <input type="hidden" id="direccion" value="<?php echo $direccion ?>">
            <input type="hidden" id="cp" value="<?php echo $cp ?>">
            <input type="hidden" id="comunidad" value="<?php echo $comunidad ?>">
            <input type="hidden" id="provincia" value="<?php echo $provincia ?>">
            <input type="hidden" id="municipio" value="<?php echo $municipio ?>">
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <tbody id="tiempo" class="animate__animated animate__fadeIn animate__slow">
                  <!-- Aquí se agregarán las filas con los datos -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Fila inferior dividida en tres columnas -->
    <div class="row">
      <!-- Columna 1: Formulario -->
      <div class="col-md-6 d-flex align-items-stretch"> <!-- Añadida la clase d-flex y align-items-stretch -->
        <div class="mb-1"></div>
        <div class="card w-100"> <!-- Agregada la clase w-100 para ocupar el 100% del ancho de la columna -->
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Formulario de Reserva</h3>
            <form action="" method="post" id="myForm">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" aria-describedby="nombreHelp" pattern="^[A-Za-z]+(?: ['A-Za-z]+)? ['A-Za-z]+$" required>
                <div id="nombreHelp" class="form-text">Introduce el nombre completo de la persona a la que se le asignará la reserva.</div>
              </div>

              <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+14 days')); ?>" required>
                <span id="fechaError" class="text-danger"></span>
              </div>

              <div class="row" id="time_picker">
                <div class="col-md-6 mb-3">
                  <label for="horaInicio" class="form-label">Hora de Inicio</label>
                  <input type="text" class="form-control clockpicker" id="horaInicio" name="horaInicio" autocomplete="off" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="horaFin" class="form-label">Hora de Fin</label>
                  <input type="text" class="form-control clockpicker" id="horaFin" name="horaFin" autocomplete="off" required>
                  <span id="horaFinError" class="text-danger"></span>
                </div>
              </div>

              <div class="d-grid">
                <button type="submit" name="reservar" class="btn btn-primary">Reservar Pista</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Columna 2: Mapa -->
      <div class="col-md-6  d-flex align-items-stretch"> <!-- Añadida la clase d-flex y align-items-stretch -->
        <div id="map" class="w-100" style="height: 410px;"></div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="miModal" tabindex="-1"  aria-hidden="true">
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
  <?
  mostrar_footer();
  ?>





  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/obtenerTiempoPista.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="./clockpicker-gh-pages/src/clockpicker.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById("myForm");
      const fechaInput = document.getElementById("fecha");
      const horaInicioInput = document.getElementById("horaInicio");
      const horaFinInput = document.getElementById("horaFin");

      fechaInput.addEventListener("change", function() {
        document.getElementById("fechaError").innerHTML = "";
        const fechaSeleccionada = new Date(fechaInput.value);
        if (fechaSeleccionada.getDay() === 0 || fechaSeleccionada.getDay() === 6) {
          fechaInput.setCustomValidity("No puedes seleccionar un fin de semana como fecha.");
          //Lo mostramos en un elemento <span> creado para el mensaje de error
          document.getElementById("fechaError").innerHTML = "No puedes seleccionar un fin de semana como fecha de reserva.";
        } else {
          fechaInput.setCustomValidity("");
        }
      });
      horaFinInput.addEventListener("input", function() {
        console.log('Hora de finalización cambiada');
        document.getElementById("horaFinError").innerHTML = "";
      });

      // Agregar eventos de entrada para detectar cambios en las horas de inicio y fin
      horaInicioInput.addEventListener("input", function() {
        clearValidationError();
      });

      horaFinInput.addEventListener("change", function() {
        console.log('Hora de finalización cambiada');
        clearValidationError();
      });

      // ... (resto del código)

      // Agregar un evento al formulario para que se ejecute antes del envío
      form.addEventListener("submit", function(event) {
        // Obtener los valores de las horas de inicio y fin
        const horaInicio = parseHourString(horaInicioInput.value);
        const horaFin = parseHourString(horaFinInput.value);

        // Verificar si la hora de inicio es mayor o igual que la hora de fin
        if (horaFin <= horaInicio) {
          // Mostrar un mensaje de error o tomar la acción adecuada
          displayValidationError("La hora de finalización debe ser mayor que la hora de inicio.");
          event.preventDefault(); // Evitar que el formulario se envíe
        }
        // Si la hora de finalización es menor a una hora de la hora de inicio
        else if (horaFin - horaInicio < 1) {
          // Mostrar un mensaje de error o tomar la acción adecuada
          displayValidationError("La hora de finalización debe ser al menos 1 hora después de la hora de inicio.");
          event.preventDefault(); // Evitar que el formulario se envíe
        }
      });

      // Función para mostrar un mensaje de error
      function displayValidationError(message) {
        horaFinInput.setCustomValidity(message);
        document.getElementById("horaFinError").innerHTML = message;
      }

      // Función para borrar el mensaje de error
      function clearValidationError() {
        horaFinInput.setCustomValidity("");
        document.getElementById("horaFinError").innerHTML = "";
      }

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








    });
    $(document).ready(function() {
      function mostrarClockpicker(horaMin, horaMax, horasReservadas) {
        console.log('Mostrando clockpicker');
        console.log('Hora mínima funcion: ' + horaMin);
        console.log('Hora máxima funcion: ' + horaMax);

        $('.clockpicker').clockpicker({
          autoclose: true,
          donetext: "Hecho",
          afterDone: function() {
            const horaInicioInput = document.getElementById("horaInicio");
            const horaFinInput = document.getElementById("horaFin");

            function parseHourString(hourString) {
              const parts = hourString.split(":");
              if (parts.length === 2) {
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                return hours + minutes / 60;
              }
              return 0;
            }

            // Función para formatear un número como cadena de hora en formato HH:mm
            function formatHourString(hour) {
              const hours = Math.floor(hour);
              const minutes = Math.round((hour - hours) * 60);
              return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
            }

            // Función para validar las horas
            function validateHoras() {
              const horaInicio = parseHourString(horaInicioInput.value);
              const horaFinValue = horaFinInput.value.trim(); // Obtener el valor de la hora de fin sin espacios en blanco

              // Verificar si la hora de fin está vacía
              if (horaFinValue === "") {
                // No hay valor en la hora de fin, no se aplica ninguna validación ni mensaje de error
                horaFinInput.setCustomValidity("");
                document.getElementById("horaFinError").innerHTML = "";
                return;
              }

              const horaFin = parseHourString(horaFinValue);

              // Verificar si la hora de inicio es mayor o igual que la hora de fin
              if (horaFin <= horaInicio) {
                // Mostrar un mensaje de error o tomar la acción adecuada
                horaFinInput.setCustomValidity("La hora de finalización debe ser mayor que la hora de inicio.");
                // Borramos el mensaje de error anterior
                document.getElementById("horaFinError").innerHTML = "";
                document.getElementById("horaFinError").innerHTML = "La hora de finalización debe ser mayor que la hora de inicio.";
              } else if (horaFin - horaInicio < 1) {
                // Mostrar un mensaje de error o tomar la acción adecuada
                horaFinInput.setCustomValidity("La hora de finalización debe ser al menos 1 hora después de la hora de inicio.");
                // Borramos el mensaje de error anterior
                document.getElementById("horaFinError").innerHTML = "";
                document.getElementById("horaFinError").innerHTML = "La hora de finalización debe ser al menos 1 hora después de la hora de inicio.";
              } else {
                // Restablecer la validez si todo está bien
                horaFinInput.setCustomValidity("");
                // Borrar el mensaje de error
                document.getElementById("horaFinError").innerHTML = "";
              }
            }

            // Verificar y actualizar la validación después de seleccionar la hora de fin
            validateHoras();
          },

          afterShow: function() {
            console.log('Clockpicker mostrado');
            console.log('Hora de apertura:', horaMin);
            console.log('Hora de cierre:', horaMax);
            console.log('Horas reservadas:', horasReservadas);

            // Habilitar todas las horas
            $(".clockpicker-hours").find(".clockpicker-tick").removeClass('clockpicker-tick-disabled');

            // Desactivar las horas antes de la hora de apertura y después de la hora de cierre
            $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
              return parseInt($(element).html()) < horaMin || parseInt($(element).html()) >= horaMax;
            }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
            var arrayInicio = [];
            var arrayFinal = [];

            // Desactivar las horas y minutos de las horas reservadas
            for (let i = 0; i < horasReservadas.length; i += 2) {
              const horaInicioReserva = parseInt(horasReservadas[i].split(":")[0]);
              const minutosInicioReserva = parseInt(horasReservadas[i].split(":")[1]);

              const horaFinReserva = parseInt(horasReservadas[i + 1].split(":")[0]);
              const minutosFinReserva = parseInt(horasReservadas[i + 1].split(":")[1]);

              // Creamos un array con las horas y minutos de inicio y fin de reserva
              arrayInicio.push({
                hora: horaInicioReserva,
                minuto: minutosInicioReserva
              });
              arrayFinal.push({
                hora: horaFinReserva,
                minuto: minutosFinReserva
              });

              // Desactivar la hora de inicio si los minutos son 0
              if (minutosInicioReserva === 0) {
                $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                  return parseInt($(element).html()) === horaInicioReserva;
                }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
              }

              // Si la reserva dura más de una hora, desactivar las horas intermedias
              if (horaFinReserva - horaInicioReserva > 1) {
                for (let j = horaInicioReserva + 1; j < horaFinReserva; j++) {
                  $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                    return parseInt($(element).html()) === j;
                  }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
                }
              }
            }
            // Función para desactivar los minutos para una hora específica
            function desactivarMinutos(hora, minutoInicio, minutoFin) {
              console.log('Hora:', hora);
              var hours = $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                return parseInt($(element).html()) === hora;
              });
              console.log('Horas:', hours);
              console.log('Minuto de inicio:', minutoInicio);
              console.log('Minuto de fin:', minutoFin);
              //Ahora seleccionamos los minutos que hay que desactivar independientemente de la hora que sean mayores que el minuto de inicio y menores que el minuto de fin
              var minutes = $(".clockpicker-minutes").find(".clockpicker-tick").filter(function(index, element) {
                return parseInt($(element).html()) >= minutoInicio && parseInt($(element).html()) <= minutoFin;
              });

              //Ahora desactivamos en el mouse enter de la hora todos los minutos que no esten en minutes
              $(hours).on("mousedown", function(e) {
                console.log('Mouse enter en hora:', hora);
                $(".clockpicker-minutes").find(".clockpicker-tick").removeClass('clockpicker-tick-disabled');
                $(".clockpicker-minutes").find(".clockpicker-tick").not(minutes).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
              });



              // Configurar un intervalo para verificar continuamente la visibilidad
              // Observador de mutaciones para verificar cambios en el estilo de los minutos
              var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                  if (mutation.attributeName === 'style') {
                    var visibilidad = $(".clockpicker-minutes").css("visibility");
                    console.log('Visibilidad Minutos:', visibilidad);
                    if (visibilidad === "hidden") {
                      $(".clockpicker-minutes").find(".clockpicker-tick-disabled").removeClass('clockpicker-tick-disabled').addClass('clockpicker-tick');
                    }

                    //Ahora cuando se haga mouseleave en una hora de hours, se desactivarán todos los minutos que no esten en minutes
                  }
                });
              });

              // Configurar el observador para el nodo de minutos
              var targetNode = $(".clockpicker-minutes")[0];
              var config = {
                attributes: true
              };
              observer.observe(targetNode, config);

              // Limpiar el observador cuando el reloj se oculta (puede que necesites ajustar el evento adecuado)
              $('.clockpicker').on('afterHide', function() {
                observer.disconnect();
              });

              //Volvemos a activar el observer cuando se muestra el reloj
                $('.clockpicker').on('afterShow', function() {
                    observer.observe(targetNode, config);
                });

            }

            // Desactivar las horas antes de la hora de apertura y después de la hora de cierre
            $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
              return parseInt($(element).html()) < horaMin || parseInt($(element).html()) >= horaMax;
            }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');

            // Desactivar las horas y minutos de las horas reservadas
            for (let i = 0; i < horasReservadas.length; i += 2) {
              const horaInicioReserva = parseInt(horasReservadas[i].split(":")[0]);
              const minutosInicioReserva = parseInt(horasReservadas[i].split(":")[1]);

              const horaFinReserva = parseInt(horasReservadas[i + 1].split(":")[0]);
              const minutosFinReserva = parseInt(horasReservadas[i + 1].split(":")[1]);

              // Desactivar la hora de inicio si los minutos son 0
              if (minutosInicioReserva === 0) {
                $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                  return parseInt($(element).html()) === horaInicioReserva;
                }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
              }

              // Desactivar las horas intermedias si la reserva dura más de una hora
              if (horaFinReserva - horaInicioReserva > 1) {
                for (let j = horaInicioReserva + 1; j < horaFinReserva; j++) {
                  $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                    return parseInt($(element).html()) === j;
                  }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
                }
              }

              // Llamar a la función para desactivar los minutos
              desactivarMinutos(horaInicioReserva, '0', minutosInicioReserva);
              desactivarMinutos(horaFinReserva, minutosFinReserva, '59');
            }

          },
        });
      }
      $('#horaInicio, #horaFin').prop('disabled', true);
      console.log('Documento cargado');

      var horaApertura, horaCierre, horasReservadas; // Declara las variables fuera del ámbito de la función success
      var horasDisponibles = [];
      var ticksDisabled = false;
      // Maneja el cambio en el campo de fecha
      $('#fecha').on('change', function() {
        console.log('Cambio de fecha');
        // Desactiva los campos de hora
        $('#horaInicio, #horaFin').prop('disabled', false);
        // Obtén la fecha seleccionada
        var selectedDate = $(this).val();
        console.log('Fecha seleccionada: ' + selectedDate);

        // Obtén el ID de la pista (deberías tener esta información en algún lugar) y lo almacenamos entre comillas
        var idPista = <?php echo json_encode($idPista); ?>;
        console.log('ID de la pista: ' + idPista);

        // Realiza una solicitud AJAX para obtener las reservas para la pista y fecha seleccionadas
        $.ajax({
          url: 'obtener_reservas.php', // Reemplaza con la ruta correcta para obtener reservas
          method: 'POST',
          data: {
            idPista: idPista,
            fecha: selectedDate
          },
          success: function(reservas) {
            console.log('Respuesta recibida');
            console.log(reservas);
            // Parsea la respuesta (deberías ajustar esto según cómo obtienes los datos)
            var response = reservas;




            // Asigna los valores a las variables horaApertura y horaCierre
            horaApertura = response.horaApertura;
            horaCierre = response.horaCierre;
            horasReservadas = response.horasDesactivar;




            //Ahora obtenemos las horas en las que está abierta la pista
            //Cuando las horas de apertura y cierre tengan valor obtenemos las horas cerradas
            if (horaApertura && horaCierre) {
              console.log('Hora de apertura: ' + horaApertura);
              console.log('Hora de cierre: ' + horaCierre);

              // Extraer solo las horas (ignorando los minutos)
              var horaAperturaNum = parseInt(horaApertura.split(':')[0]);
              var horaCierreNum = parseInt(horaCierre.split(':')[0]);

              // Verificar que la hora de apertura sea menor que la de cierre
              if (horaAperturaNum < horaCierreNum) {
                //Obtenemos las horas abiertas entre la hora de apertura y la de cierre
                for (var i = horaAperturaNum + 1; i < horaCierreNum; i++) {
                  horasDisponibles.push(i.toString().padStart(2, "0"));
                }
              }
            }

            console.log('Horas disponibles: ' + horasDisponibles);

            //Para los minutos


            mostrarClockpicker(horaAperturaNum, horaCierreNum, horasReservadas);


          },
          error: function(xhr, status, error) {
            console.log('XHR:', xhr);
            console.log('Status:', status);
            console.log('Error:', error);
            // Maneja el error
          }
        });


        // Maneja el envío del formulario para validar la hora de inicio
        $('#myForm').on('submit', function(event) {
          var horaInicio = $('#horaInicio').val();
          var horaCierre = $('#horaFin').val();

          // Convierte las horas a objetos Date para realizar la comparación
          var dateHoraInicio = new Date('2000-01-01T' + horaInicio + ':00');
          var dateHoraCierre = new Date('2000-01-01T' + horaCierre + ':00');

          // Comprueba si la hora de inicio es al menos 1 hora posterior a la hora de cierre
          if (dateHoraInicio <= dateHoraCierre || dateHoraInicio.getHours() - dateHoraCierre.getHours() >= 1) {
            // Continúa con el envío del formulario
          } else {
            // Detén el envío del formulario y muestra un mensaje de error
            event.preventDefault();
            alert('La hora de inicio debe ser al menos 1 hora después de la hora de cierre.');
          }
        });

        var choices = ["00", "15", "30", "45"];

      });
    });
  </script>