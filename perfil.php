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
  <title>Perfil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
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
        <div class="modal-footer" id="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'funciones.php';
  mostrarNavbar();
  //unset($_SESSION['id_usuario']);
  //Admin
  //$_SESSION['id_usuario'] = '654ed2c775155';
  //Usuario
  //$_SESSION['id_usuario'] = '654ed2c7b91df';
  //unset($_SESSION['id_usuario']);
  //echo $_SESSION['id_usuario'];
  //unset($_SESSION['id_empresa']);
  //$_SESSION['id_empresa'] = '654ed2cbc932f';
  if (isset($_POST['cerrarses'])) {
    session_destroy();
    header("Location: index.php");
  }
  if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_empresa'])) {
    if (isset($_SESSION['id_usuario'])) {

      if (isset($_GET['borrarreserva'])) {
        $toastContent = '';
        //Dejar de mostrar el modal
        echo '<script>';
        echo 'var myModal = new bootstrap.Modal(document.querySelector("#miModal"));';
        echo 'myModal.hide();';
        echo '</script>';
        include "NOACCESIBLE/credencialesdb.php";
        $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
        $fecha = date("Y-m-d", strtotime($_GET['horafin']));
        //Si la actual mas una semana es mayor que la fecha de la reserva, no se devuelve el dinero
        if (date("Y-m-d", strtotime("+1 week")) > $fecha) {
          $stmt = mysqli_prepare($conexion, "DELETE FROM reservas WHERE id_reserva=?");
          $stmt->bind_param('s', $_GET['idreserva']);
          if (mysqli_stmt_execute($stmt)) {
            $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
            $toastContent .= "<div class='toast-header'>";
            $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
            $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
            $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
            $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
            $toastContent .= "</div>";
            $toastContent .= "<div class='toast-body bg-success text-white'>";
            $toastContent .= "Reserva cancelada correctamente,revise su correo electrónico.";
            $toastContent .= "</div>";
            $toastContent .= "</div>";
            //Mando un correo al correo de la empresa para que sepa que se ha cancelado la reserva
            $to = $_GET['correocontacto'];
            $nombrepista = $_GET['nombrepista'];
            $nombrereservante = $_GET['nombrereservante'];
            $municipio = $_GET['municipio'];
            $direccion = $_GET['direccion'];
            $horainiciocorreo = $_GET['horainiciocorreo'];
            $horafincorreo = $_GET['horafincorreo'];
            $fecha = $_GET['fecha'];

            //Load Composer's autoloader
            require 'vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
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
              $mail->Subject = '=?UTF-8?B?' . base64_encode('Reserva Cancelada') . '?=';
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
        <img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
        <h3>Estimado Equipo de Courtfusion,</h3>
        <p>Le informamos que el usuario ' . $nombrereservante . ' ha cancelado una reserva en su instalación. A continuación, se detallan los datos de la reserva cancelada:</p>
        <p><strong>Pista:</strong> ' . $nombrepista . '</p>
        <p><strong>Usuario que canceló:</strong> ' . $nombrereservante . '</p>
        <p><strong>Municipio:</strong> ' . $municipio . '</p>
        <p><strong>Dirección:</strong> ' . $direccion . '</p>
        <p><strong>Hora de inicio:</strong> ' . $horainiciocorreo . '</p>
        <p><strong>Hora de finalización:</strong> ' . $horafincorreo . '</p>
        <p><strong>Fecha de la reserva:</strong> ' . $fecha . '</p>
        <p>Si es necesario tomar medidas adicionales o tiene alguna pregunta, por favor, póngase en contacto con el usuario o el equipo de soporte de Courtfusion.</p>
        <p>Atentamente,</p>
        <p>El equipo de Courtfusion</p>
    </div>
</body>
</html>';
              $mail->AltBody = 'Estimado Equipo de Courtfusion,

Le informamos que el usuario ' . $nombrereservante . ' ha cancelado una reserva en su instalación. A continuación, se detallan los datos de la reserva cancelada:

Pista: ' . $nombrepista . '
Usuario que canceló: ' . $nombrereservante . '
Municipio: ' . $municipio . '
Dirección: ' . $direccion . '
Hora de inicio: ' . $horainiciocorreo . '
Hora de finalización: ' . $horafincorreo . '
Fecha de la reserva: ' . $fecha . '

Si es necesario tomar medidas adicionales o tiene alguna pregunta, por favor, póngase en contacto con el usuario o el equipo de soporte de Courtfusion.

Atentamente,
El equipo de Courtfusion';

              $mail->send();
            } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
          } else {
            $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
            $toastContent .= "<div class='toast-header'>";
            $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
            $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
            $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
            $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
            $toastContent .= "</div>";
            $toastContent .= "<div class='toast-body bg-danger text-white'>";
            $toastContent .= "Error al cancelar la reserva.";
            $toastContent .= "</div>";
            $toastContent .= "</div>";
          }
          if (isset($toastContent)) {
            echo $toastContent;
            echo '<script>
              $(document).ready(function() {
                // Deshabilitar los botones
                $("#botonsaldo, #botonreservas").prop("disabled", true);
                
                $("#mytoast").toast("show");
                
                setTimeout(function(){
                  // Habilitar los botones después de 2 segundos
                  $("#boton_saldo, #boton_reservas").prop("disabled", false);
                  
                  // Redirigir a perfil.php
                  window.location.href = "perfil.php";
                }, 2000); // Espera 2 segundos antes de redirigir
              });
            </script>';
          } else {
            // Si no hay toast, redirige inmediatamente
            header("Location: perfil.php");
          }
          
        } else {
          $preciohora = $_GET['prehora'];
          $horainicio = $_GET['horainicio'];
          $horafin = $_GET['horafin'];
          $timestampInicio = strtotime($horainicio);
          $timestampFin = strtotime($horafin);

          // Si la hora de fin es anterior a la hora de inicio, asumimos que cruza la medianoche
          if ($timestampFin < $timestampInicio) {
            // Añade un día completo (24 horas) a la hora de fin
            $timestampFin += 24 * 60 * 60; // 24 horas en segundos
          }

          // Calcula la diferencia en segundos
          $diferenciaSegundos = $timestampFin - $timestampInicio;

          // Calcula la diferencia en horas
          $diferenciaHoras = $diferenciaSegundos / 3600;

          // Calcula el precio total


          $saldoadevolver = $diferenciaHoras * $preciohora;
          $stmt = mysqli_prepare($conexion, "DELETE FROM reservas WHERE id_reserva=?");
          $stmt->bind_param('s', $_GET['idreserva']);
          if (mysqli_stmt_execute($stmt)) {
            
            $stmt = mysqli_prepare($conexion, "UPDATE usuarios SET saldo=saldo+? WHERE id_usuario=?");
            $stmt->bind_param('ss', $saldoadevolver, $_SESSION['id_usuario']);
            if (mysqli_stmt_execute($stmt)) {
              $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
              $toastContent .= "<div class='toast-header'>";
              $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
              $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
              $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
              $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
              $toastContent .= "</div>";
              $toastContent .= "<div class='toast-body bg-success text-white'>";
              $toastContent .= "Reserva cancelada correctamente.Revisa tu correo electrónico.";
              $toastContent .= "</div>";
              $toastContent .= "</div>";
              //Mando un correo al correo de la empresa para que sepa que se ha cancelado la reserva
              $to = $_GET['correocontacto'];
              $nombrepista = $_GET['nombrepista'];
              $nombrereservante = $_GET['nombrereservante'];
              $municipio = $_GET['municipio'];
              $direccion = $_GET['direccion'];
              $horainiciocorreo = $_GET['horainiciocorreo'];
              $horafincorreo = $_GET['horafincorreo'];
              $fecha = $_GET['fecha'];

              //Load Composer's autoloader
              require 'vendor/autoload.php';

              //Create an instance; passing `true` enables exceptions
              $mail = new PHPMailer(true);

              try {
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
                $mail->Subject = '=?UTF-8?B?' . base64_encode('Reserva Cancelada') . '?=';
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
        <img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
        <h3>Estimado Equipo de Courtfusion,</h3>
        <p>Le informamos que el usuario ' . $nombrereservante . ' ha cancelado una reserva en su instalación. A continuación, se detallan los datos de la reserva cancelada:</p>
        <p><strong>Pista:</strong> ' . $nombrepista . '</p>
        <p><strong>Usuario que canceló:</strong> ' . $nombrereservante . '</p>
        <p><strong>Municipio:</strong> ' . $municipio . '</p>
        <p><strong>Dirección:</strong> ' . $direccion . '</p>
        <p><strong>Hora de inicio:</strong> ' . $horainiciocorreo . '</p>
        <p><strong>Hora de finalización:</strong> ' . $horafincorreo . '</p>
        <p><strong>Fecha de la reserva:</strong> ' . $fecha . '</p>
        <p>Si es necesario tomar medidas adicionales o tiene alguna pregunta, por favor, póngase en contacto con el usuario o el equipo de soporte de Courtfusion.</p>
        <p>Atentamente,</p>
        <p>El equipo de Courtfusion</p>
    </div>
</body>
</html>';
                $mail->AltBody = 'Estimado Equipo de Courtfusion,

Le informamos que el usuario ' . $nombrereservante . ' ha cancelado una reserva en su instalación. A continuación, se detallan los datos de la reserva cancelada:

Pista: ' . $nombrepista . '
Usuario que canceló: ' . $nombrereservante . '
Municipio: ' . $municipio . '
Dirección: ' . $direccion . '
Hora de inicio: ' . $horainiciocorreo . '
Hora de finalización: ' . $horafincorreo . '
Fecha de la reserva: ' . $fecha . '

Si es necesario tomar medidas adicionales o tiene alguna pregunta, por favor, póngase en contacto con el usuario o el equipo de soporte de Courtfusion.

Atentamente,
El equipo de Courtfusion';

                $mail->send();
              } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
            } else {
              $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
              $toastContent .= "<div class='toast-header'>";
              $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
              $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
              $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
              $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
              $toastContent .= "</div>";
              $toastContent .= "<div class='toast-body bg-danger text-white'>";
              $toastContent .= "Error en el reembolso.";
              $toastContent .= "</div>";
              $toastContent .= "</div>";
            }
          } else {
            $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
            $toastContent .= "<div class='toast-header'>";
            $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
            $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
            $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
            $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
            $toastContent .= "</div>";
            $toastContent .= "<div class='toast-body bg-danger text-white'>";
            $toastContent .= "Error al cancelar la reserva.";
            $toastContent .= "</div>";
            $toastContent .= "</div>";
          }
        }
        if (isset($toastContent)) {
          echo $toastContent;
          echo '<script>
            $(document).ready(function() {
              // Deshabilitar los botones
              $("#botonsaldo, #botonreservas").prop("disabled", true);
              
              $("#mytoast").toast("show");
              
              setTimeout(function(){
                // Habilitar los botones después de 2 segundos
                $("#boton_saldo, #boton_reservas").prop("disabled", false);
                
                // Redirigir a perfil.php
                window.location.href = "perfil.php";
              }, 2000); // Espera 2 segundos antes de redirigir
            });
          </script>';
        } else {
          // Si no hay toast, redirige inmediatamente
          header("Location: perfil.php");
        }
      }
      if (isset($_GET['borrar'])) {
        /*           include "NOACCESIBLE/credencialesdb.php";
      $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
   $idreser=$_GET['idreserva'];
   $fecha=date("Y-m-d",strtotime($_GET['horainicio'])); */

        //Mostrar un modal preguntando si quiere borrar la reserva
        //Si pulsa si, borrar la reserva
        //Si pulsa no, volver a la página de perfil
        // Define el contenido del modal de confirmación para borrar la reserva


        // Utiliza JavaScript para mostrar el modal de confirmación

        $modalTitle = '¿Estás seguro de que quieres cancelar la reserva?';
        $modalContent = '<i class="fas fa-exclamation-circle text-warning text-center fa-4x d-block mx-auto"></i>';
        //Las reservas que se cancelen con menos de 1 semana de antelación no se devuelve el dinero
        $modalContent .= '<p class="mt-4">Entendemos que a veces surgen imprevistos, pero ten en cuenta que si decides cancelar la reserva con menos de 1 semana de antelación, no podremos procesar un reembolso.</p>';
        $modalContent .= '<p class="mt-4">Por favor, reflexiona sobre tu elección, ya que una vez que confirmes la cancelación, no podrás revertirla.</p>';

        $modalfooter = '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>';
        $modalfooter .= '<form method="get" action=""><button type="submit" class="btn btn-danger" name="borrarreserva" value="borrarreserva">Sí</button>';
        $modalfooter .= '<input type="hidden" name="idreserva" value="' . $_GET['idreserva'] . '">';
        $modalfooter .= '<input type="hidden" name="horainicio" value="' . $_GET['horainicio'] . '">';
        $modalfooter .= '<input type="hidden" name="horafin" value="' . $_GET['horafin'] . '">';
        $modalfooter .= '<input type="hidden" name="prehora" value="' . $_GET['prehora'] . '">';
        $modalfooter .= '<input type="hidden" name="correocontacto" value="' . $_GET['correocontacto'] . '">';
        $modalfooter .= '<input type="hidden" name="nombrepista" value="' . $_GET['nombrepista'] . '">';
        $modalfooter .= '<input type="hidden" name="nombrereservante" value="' . $_GET['nombrereservante'] . '">';
        $modalfooter .= '<input type="hidden" name="municipio" value="' . $_GET['municipio'] . '">';
        $modalfooter .= '<input type="hidden" name="direccion" value="' . $_GET['direccion'] . '">';
        $modalfooter .= '<input type="hidden" name="fecha" value="' . $_GET['fecha'] . '">';
        $modalfooter .= '<input type="hidden" name="horainiciocorreo" value="' . $_GET['horainiciocorreo'] . '">';
        $modalfooter .= '<input type="hidden" name="horafincorreo" value="' . $_GET['horafincorreo'] . '">';
        $modalfooter .= '</form>';
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'document.querySelector("#miModal").addEventListener("show.bs.modal", function () {';
        echo 'document.querySelector("#modalHeader").innerHTML = "' . $modalTitle . '";';
        echo 'document.querySelector("#modalBody").innerHTML = `' . $modalContent . '`;';
        echo 'document.querySelector("#modal-footer").innerHTML = `' . $modalfooter . '`;';
        echo '});';
        echo 'var myModal = new bootstrap.Modal(document.querySelector("#miModal"));';
        echo 'myModal.show();';
        echo '});';
        echo '</script>';
      }
      include "NOACCESIBLE/credencialesdb.php";
      $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
      $stmt = mysqli_prepare($conexion, "SELECT nombre,rol FROM usuarios WHERE id_usuario=?");
      $stmt->bind_param('s', $_SESSION['id_usuario']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $stmt->bind_result($nombre, $rolusu);
      if ($stmt->num_rows > 0) {
        while ($stmt->fetch()) {
          $_SESSION['nom_usu'] = $nombre;
          if ($rolusu == "Administrador") {

            if (isset($_POST['gestionusuarios']) && isset($_POST['gestionpistas']) && isset($_POST['gestionreservas'])) {
              if (isset($_POST['gestionusuarios'])) {
                header("Location: gestionusuarios.php");
              }
              if (isset($_POST['gestionpistas'])) {
                header("Location: gestionpistas.php");
              }
              if (isset($_POST['gestionreservas'])) {
                header("Location: gestionreservas.php");
              }
            } else {
              $_SESSION['isAdmin'] = true;

  ?>
              <form method="post" action="perfil.php">
                <div class="container d-flex justify-content-end mt-3 me-2">
                  <div class="card p-3">
                    <div class="media">
                      <div class="media-body">
                        <span class="mt-2 mb-0 h5 me-4"><? echo $_SESSION['nom_usu']; ?></span></h5>
                        <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


                      </div>
                    </div>
                  </div>
                </div>
              </form>

              <div class="container">
                <section class="vh-80">
                  <div class="container h-80">
                    <div class="row justify-content-center align-items-center h-100">
                      <div class="col-12 text-center">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                          <div class="card-body p-5">
                            <h1 class="text-center mb-5">Panel de Administración</h1>
                            <div class="row mb-4 mt-1 text-center align-items-center justify-content-center">
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3">
                                <form method="post" action="gestionpistas.php">
                                  <button class="btn botonancho btn-lg btn-block" name="gestionpistas" type="submit">Gestión Pistas</button>
                                </form>
                              </div>
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3">
                                <form method="post" action="gestionusuarios.php">
                                  <button class="btn botonancho btn-lg btn-block" name="gestionusuarios" type="submit">Gestión Usuarios</button>
                                </form>
                              </div>
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3">
                                <form method="post" action="gestionreservas.php">
                                  <button class="btn botonancho btn-lg btn-block" name="gestionreservas" type="submit">Gestión Reservas</button>
                                </form>
                              </div>
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3">
                                <form method="post" action="gestionempresas.php">
                                  <button class="btn botonancho btn-lg btn-block" name="gestionempresas" type="submit">Gestión Empresas</button>
                                </form>
                              </div>
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3 mt-xl-2">
                                <form method="post" action="backup.php">
                                  <button class="btn botonancho btn-lg btn-block" name="backup" type="submit">Backup</button>
                                </form>
                              </div>
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 ms-3 ms-sm-3 ms-md-3 ms-lg-3 mt-xl-2">
                                <form method="post" action="zip.php">
                                  <button class="btn botonancho btn-lg btn-block" name="zipweb" type="submit">Zip Web</button>
                                </form>
                              </div>
                            </div>
                            <div class="row ms-3 ms-sm-3 ms-md-3 ms-lg-3">
                              <div class="col-12">
                                <a href="index.php">
                                  <button class="btn botonancho btn-lg" name="volver" type="button">Volver</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>




            <?
            }
          } else {
            if (isset($_POST['añadirsaldo'])) {
              $toastContent = '';
              include "NOACCESIBLE/credencialesdb.php";
              $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
              $stmt = mysqli_prepare($conexion, "UPDATE usuarios SET saldo=saldo+? WHERE id_usuario=?");
              $stmt->bind_param('ss', $_POST['saldoAAnadir'], $_SESSION['id_usuario']);
              if (mysqli_stmt_execute($stmt)) {
                $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                $toastContent .= "<div class='toast-header'>";
                $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                $toastContent .= "</div>";
                $toastContent .= "<div class='toast-body bg-success text-white'>";
                $toastContent .= "Saldo añadido correctamente.";
                $toastContent .= "</div>";
                $toastContent .= "</div>";
              } else {
                $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
                $toastContent .= "<div class='toast-header'>";
                $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
                $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
                $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
                $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
                $toastContent .= "</div>";
                $toastContent .= "<div class='toast-body bg-danger text-white'>";
                $toastContent .= "Error añadiendo saldo.";
                $toastContent .= "</div>";
                $toastContent .= "</div>";
                
              }
            }
            if (isset($toastContent)) {
              echo $toastContent;
              echo '<script>
            $(document).ready(function() {
                $("#mytoast").toast("show");
            });
        </script>';
            }
            ?>

            <form method="post" action="">
              <div class="container d-flex justify-content-end mt-3 me-2">
                <div class="card p-3">
                  <div class="media">
                    <div class="media-body">
                      <span class="mt-2 mb-0 h5 me-4">
                        <? echo $_SESSION['nom_usu']; ?></span></h5>
                      <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


                    </div>
                  </div>
                </div>
              </div>
            </form>
            <?

$_SESSION['isUser'] = true;
?>
            <div class="container mt-3">
              <form method="post" action="" class="d-inline ms-2" id="opcionesperfil">
                <div class="container">
                  <section class="vh-300">
                    <div class="container py-3 h-100">
                      <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                          <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" id="carta">
                              <h1 class="mb-3">Acciones Usuario</h1>
                              <button class="btn botonancho btn-lg btn-block ms-2" name="alta" id="botonsaldo" type="button">Añadir Saldo</button>
                              <button class="btn botonancho btn-lg btn-block ms-2" name="reservas" id="botonreservas" type="button">Ver Reservas</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </form>

              <div class="row d-none" id="saldo">
                <div class="col-md-12">
                  <div class="card mb-3">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title text-center"><i class="bi bi-credit-card"></i> Detalles de la Tarjeta</h5>
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="cardNumber" class="form-label"><i class="bi bi-credit-card"></i> Número de Tarjeta</label>
                          <input type="text" class="form-control" id="cardNumber" placeholder="XXXX XXXX XXXX XXXX" pattern="\d{16}" required title="Debe ingresar 16 dígitos numéricos">
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="expirationDate" class="form-label"><i class="bi bi-calendar"></i> Fecha de Vencimiento</label>
                              <input type="text" class="form-control" name="expirationDate" id="expirationDate" placeholder="MM/YY" required pattern="(0[1-9]|1[0-2])\/\d{2}" title="Ingrese una fecha válida en el formato MM/YY">

                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="cvv" class="form-label"><i class="bi bi-lock"></i> CVV</label>
                              <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" pattern="\d{3}" required title="Debe ingresar 3 dígitos numéricos">
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="saldoAAnadir" class="form-label"><i class="bi bi-cash"></i> Saldo a Añadir</label>
                          <input type="number" class="form-control" id="saldoAAnadir" name="saldoAAnadir" placeholder="Saldo a Añadir" required pattern="\d+(\.\d{2})?" title="Ingrese un número decimal (puede incluir decimales, por ejemplo, 10.50)">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn botonancho btn-lg btn-block" id="añadirsaldo" name="añadirsaldo">Añadir Saldo</button>
                          <button class="btn botonancho btn-lg btn-block ms-2" name="volver" id="volversaldo" type="button">Volver</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php

            include 'NOACCESIBLE/credencialesdb.php';
            $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
            if ($stmt = mysqli_prepare($c1, "SELECT p.nombre_pista,nombre_reservante,hora_inicio_reserva,hora_fin_reserva,p.municipio,p.direccion,id_reserva,precio_hora,p.correo_contacto from usuarios u,pistas p,reservas r where u.id_usuario=r.id_usuario and p.id_pista=r.id_pista
             and u.id_usuario=?")) {
            } else {
              echo $c1->error;
            }
            $stmt->bind_param('s', $_SESSION['id_usuario']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $nombrepista, $nombrereservante, $horainicio, $horafin, $municipio, $direccion, $idreserva, $preciohora, $correocontacto);




            ?>

            <div class="row d-none" id="reservas">
              <div class="col-md-12">
                <div class="card h-100 mt-4 mt-md-0">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center"><i class="bi bi-table"></i> Reservas</h5>
                    <div class="table-responsive flex-fill">
                      <table class="table table-striped table-hover table-bordered display text-center" id="example">
                        <caption class="text-center">
                          Pistas
                        </caption>
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Nombre de la Pista</th>
                            <th scope="col">Nombre del Reservante</th>
                            <th scope="col">Municipio</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora de Inicio</th>
                            <th scope="col">Hora de Finalización</th>
                            <th scope="col">Cancelar Reserva?</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Ciclo PHP para mostrar los datos de las reservas -->
                          <?php
                          while (mysqli_stmt_fetch($stmt)) {

                          ?>

                            <tr>
                              <form method="get" action="">
                                <td class="align-middle" name="nombrepista"><?php echo $nombrepista ?></td>
                                <td class="align-middle" name="nombrereservante"><?php echo $nombrereservante ?></td>
                                <td class="align-middle" nombre="municipio"><?php echo $municipio ?></td>
                                <td class="align-middle" name="direccion"><?php echo $direccion ?></td>
                                <td class="align-middle" name="fecha"><?php echo date("d-m", strtotime($horainicio)) ?></td>
                                <td class="align-middle"><?php echo date("H:i", strtotime($horainicio)) ?></td>
                                <td class="align-middle"><?php echo date("H:i", strtotime($horafin)) ?></td>

                                <td><button class="btn btn-danger" name="borrar" value="borrar" id="borrarreservaboton" type="submit">Cancelar Reserva</button></td>
                                <input type="hidden" name="idreserva" value="<?php echo $idreserva ?>">
                                <input type="hidden" name="nombrepista" value="<?php echo $nombrepista ?>">
                                <input type="hidden" name="nombrereservante" value="<?php echo $nombrereservante ?>">
                                <input type="hidden" name="municipio" value="<?php echo $municipio ?>">
                                <input type="hidden" name="direccion" value="<?php echo $direccion ?>">
                                <input type="hidden" name="fecha" value="<?php echo date("d-m", strtotime($horainicio)) ?>">
                                <input type="hidden" name="horainicio" value="<?php echo $horainicio ?>">
                                <input type="hidden" name="horafin" value="<?php echo $horafin ?>">
                                <input type="hidden" name="horainiciocorreo" value="<?php echo date("H:i", strtotime($horainicio)) ?>">
                                <input type="hidden" name="horafincorreo" value="<?php echo date("H:i", strtotime($horafin)) ?>">
                                <input type="hidden" name="prehora" value="<?php echo $preciohora ?>">
                                <input type="hidden" name="correocontacto" value="<?php echo $correocontacto ?>">

                              </form>
                            </tr>

                          <?php
                          }

                          ?>
                          <!-- Fin del ciclo PHP -->
                        </tbody>
                      </table>
                      <br>
                      <div class="text-center">
                        <button class="btn botonancho btn-lg btn-block ms-2" name="volver" id="volverreservas" type="button">Volver</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
      <?php
          }
        }
      }
    } else {
      $_SESSION['isEmpresa'] = true;
      include "NOACCESIBLE/credencialesdb.php";
      $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
      $stmt = mysqli_prepare($conexion, "SELECT nombre_empresa FROM empresas WHERE id_empresa=?");
      $stmt->bind_param('s', $_SESSION['id_empresa']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $stmt->bind_result($nombreemp);
      if ($stmt->num_rows > 0) {
        while ($stmt->fetch()) {
          $_SESSION['nom_empresa'] = $nombreemp;
        }
      }
      ?>
      <form method="post" action="">
        <div class="container d-flex justify-content-end mt-3 me-2">
          <div class="card p-3">
            <div class="media">
              <div class="media-body">
                <span class="mt-2 mb-0 h5 me-4">
                  <? echo  $_SESSION['nom_empresa'] ?></span></h5>
                <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


              </div>
            </div>
          </div>
        </div>
      </form>


      <div class="container" id="opcionesempresa">
        <section class="vh-300">
          <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center" id="carta">
                    <h1 class="mb-5">Panel de Control de Empresa</h1>
                    <div class="d-flex justify-content-center">
                      <form method="post" action="gestionpistasempresa.php">
                        <button class="btn botonancho btn-lg me-2" name="gestionpistasempresa" type="submit">Gestión Pistas</button>
                      </form>
                      <form method="post" action="reservaspistas.php">
                        <button class="btn botonancho btn-lg me-2" name="gestionreservasempresa" type="submit">Gestión Reservas</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>







    <?

    }
  } else {
    $error = "";  // Variable para almacenar el mensaje de error
    if (isset($_POST['iniciarsesion'])) {
      include "NOACCESIBLE/credencialesdb.php";
      $correo = $_POST['correo'];
      $contraseñausu = $_POST['contrasena'];

      $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexión a MySQL: ' . $conexion->error . '<br>');

      // Verificar credenciales para usuarios
      $stmt = $conexion->prepare("SELECT id_usuario, nombre, contrasena, rol FROM usuarios WHERE correo = ?");
      $stmt->bind_param('s', $correo);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($idusu, $nomusu, $contrasñabd, $rolusu);

      if ($stmt->num_rows > 0) {
        $stmt->fetch(); // Solo necesitamos un resultado
        if (password_verify($contraseñausu, $contrasñabd)) {
          // Crear sesión para usuario
          $_SESSION['id_usuario'] = $idusu;
          $_SESSION['nom_usuario'] = $nomusu;
          //Recargo la página para que como ya está iniciada la sesión, se muestre el perfil del usuario
          header("Location: perfil.php");
        } else {
          echo 'Contraseña incorrecta usuario';
          $error = "Correo Electrónico o Contraseña incorrectos";
        }
      } else {
        // Usuario no encontrado, verificar credenciales para empresas
        $stmt = $conexion->prepare("SELECT id_empresa, contrasena, nombre_empresa FROM empresas WHERE correo_contacto = ?");
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($idemp, $contrasñabdemp, $nombreemp);

        if ($stmt->num_rows > 0) {
          $stmt->fetch(); // Solo necesitamos un resultado
          if (password_verify($contraseñausu, $contrasñabdemp)) {
            // Crear sesión para empresa
            $_SESSION['id_empresa'] = $idemp;
            $_SESSION['nom_empresa'] = $nombreemp;
            header("Location: perfil.php");
          } else {
            $error = "Correo Electrónico o Contraseña incorrectos";
          }
        } else {
          $error = "Correo Electrónico o Contraseña incorrectos";
        }
      }

      // Cerrar la conexión
      $stmt->close();
      $conexion->close();
    }

    ?>
    <section class="vh-80" style="background-color: #9A616D;">
      <div class="container py-3 h-80">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="imagenes/imagenes4deportes.png" alt="login form" class="img-fluid w-100" style="border-radius: 1rem 0 0 1rem;" />
                </div>

                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form action="" method="post">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="imagenes/logo-removebg-preview-removebg-preview.png" width="100" height="100" alt="Logo de la página" class="img-fluid" title="Logo de la página" alt="Logo de Courtfusion">
                        <span class="h1 fw-bold mb-0">CourtFusion</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia sesión en tu cuenta</h5>

                      <div class="form-outline mb-4">
                        <input type="email" name="correo" id="correo" class="form-control form-control-lg" />
                        <label class="form-label" for="correo">Correo Electrónico</label>
                      </div>

                      <div class="form-outline mb-4">
                        <input type="password" name="contrasena" id="contrasena" class="form-control form-control-lg" />
                        <label class="form-label" for="contrasena">Contraseña</label>
                      </div>
                      <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $error; ?>
                        </div>
                      <?php endif; ?>

                      <div class="pt-1 mb-4 text-center">
                        <button class="btn botonancho btn-lg btn-block" name="iniciarsesion" type="submit">Iniciar Sesión</button>
                      </div>

                      <a class="small text-muted" href="recuperarcontrasena.php">¿Olvidaste tu contraseña?</a>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="registro.php" style="color: #393f81;">Regístrate aquí</a></p>
                      <a href="terminosycondiciones.html" class="small text-muted">Términos de uso.</a>
                      <a href="politicadeprivacidad.html" class="small text-muted">Política de privacidad</a>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <? }
  mostrar_footer();
  ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="js/tabla.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>