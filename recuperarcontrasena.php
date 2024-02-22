<?

use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Recuperar Contraseña</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<?php
	include 'funciones.php';
	mostrarNavbar();
	?>
	<?
	if (isset($_POST['recuperarcontraseña'])) {

		//Si existe exito se borra el boton de recuperar contraseña
		if (!empty($exito)) {
			echo '<style type="text/css">
			#recuperarcontraseña {
				display: none;
			}
			</style>';
		}
		$email = $_POST['email'];

		//Comprobar si el correo electrónico existe en la base de datos
		include "NOACCESIBLE/credencialesdb.php";
		$conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $conexion->error . '<br>');
		$stmt = mysqli_prepare($conexion, "SELECT correo FROM usuarios WHERE correo=?");
		mysqli_stmt_bind_param($stmt, 's', $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if ($stmt->num_rows == 0) {
			//Ahora, si el correo electrónico existe en empresas
			$stmt = mysqli_prepare($conexion, "SELECT correo_contacto FROM empresas WHERE correo_contacto=?");
			mysqli_stmt_bind_param($stmt, 's', $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			if ($stmt->num_rows == 0) {
				$error = 'No existe ninguna cuenta asociada a ese correo electrónico.';
			} else {
				//Vamos a mandar un correo electrónico al usuario con un enlace para restablecer su contraseña
				//Import PHPMailer classes into the global namespace
				//These must be at the top of your script, not inside a function

				//Load Composer's autoloader
				require 'vendor/autoload.php';

				//Create an instance; passing `true` enables exceptions
				$mail = new PHPMailer(true);

				try {
					$tiempo_expiracion = time() + 3600; // 1 hora de tiempo de expiración
					$token = base64_encode($email . '|' . $tiempo_expiracion);

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
					$mail->addAddress($email); // Add a recipient

					// Content
					$mail->isHTML(true); // Set email format to HTML
					$mail->Subject = '=?UTF-8?B?' . base64_encode('Recuperar Contraseña') . '?=';

					try {
						$tiempo_expiracion = time() + 600; // 10 minutos de tiempo de expiración
						$token = base64_encode($email . '|' . $tiempo_expiracion);

						//Server settings
						$mail = new PHPMailer(true);
						$mail->isSMTP(); //Send using SMTP
						$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
						$mail->CharSet = 'UTF-8';
						$mail->SMTPAuth = true; //Enable SMTP authentication
						$mail->Username = 'reyes3790183@gmail.com'; //SMTP username
						$mail->Password = 'sfpz mtlk byza vxoj'; //SMTP password
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
						$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						//Recipients
						$mail->setFrom('reyes3790183@gmail.com', 'Courtfusion');
						$mail->addAddress($email); //Add a recipient

						//Content
						$mail->isHTML(true); //Set email format to HTML

						$mail->Subject = '=?UTF-8?B?' . base64_encode('Recuperar Contraseña') . '?=';

						// Contenido HTML del correo electrónico
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
						<a href="http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token) . '">
							<img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
						</a>
						<h3>Estimado Usuario,</h3>
						<p>Ha solicitado restablecer su contraseña en Courtfusion. Por favor, haga clic en el siguiente enlace para continuar:</p>
						<p><a href="http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token) . '">Restablecer Contraseña</a></p>
						<p>Si no ha solicitado restablecer su contraseña, puede ignorar este correo electrónico.</p>
						<p>Atentamente,</p>
						<p>El equipo de Courtfusion</p>
					</div>
				</body>
				</html>';

						// Versión en texto sin formato del correo electrónico
						$mail->AltBody = 'Estimado Usuario, para restablecer su contraseña, haga clic en el siguiente enlace: http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token);

						$mail->send();
						$exito = 'Se ha enviado un correo electrónico con instrucciones para restablecer su contraseña.';
					} catch (Exception $e) {
						$error = "No se pudo enviar el correo electrónico. Error del servidor de correo: {$mail->ErrorInfo}";
					}
				} catch (Exception $e) {
					$error = "No se pudo enviar el correo electrónico. Error del servidor de correo: {$mail->ErrorInfo}";
				}
			}
		} else {

			//Vamos a mandar un correo electrónico al usuario con un enlace para restablecer su contraseña
			//Import PHPMailer classes into the global namespace
			//These must be at the top of your script, not inside a function

			//Load Composer's autoloader
			require 'vendor/autoload.php';

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				$tiempo_expiracion = time() + 3600; // 1 hora de tiempo de expiración
				$token = base64_encode($email . '|' . $tiempo_expiracion);

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
				$mail->addAddress($email); // Add a recipient

				// Content
				$mail->isHTML(true); // Set email format to HTML
				$mail->Subject = '=?UTF-8?B?' . base64_encode('Recuperar Contraseña') . '?=';

				try {
					$tiempo_expiracion = time() + 600; // 10 minutos de tiempo de expiración
					$token = base64_encode($email . '|' . $tiempo_expiracion);

					//Server settings
					$mail = new PHPMailer(true);
					$mail->isSMTP(); //Send using SMTP
					$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
					$mail->CharSet = 'UTF-8';
					$mail->SMTPAuth = true; //Enable SMTP authentication
					$mail->Username = 'reyes3790183@gmail.com'; //SMTP username
					$mail->Password = 'sfpz mtlk byza vxoj'; //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
					$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('reyes3790183@gmail.com', 'Courtfusion');
					$mail->addAddress($email); //Add a recipient

					//Content
					$mail->isHTML(true); //Set email format to HTML

					$mail->Subject = '=?UTF-8?B?' . base64_encode('Recuperar Contraseña') . '?=';

					// Contenido HTML del correo electrónico
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
						<a href="http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token) . '">
							<img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
						</a>
						<h3>Estimado Usuario,</h3>
						<p>Ha solicitado restablecer su contraseña en Courtfusion. Por favor, haga clic en el siguiente enlace para continuar:</p>
						<p><a href="http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token) . '">Restablecer Contraseña</a></p>
						<p>Si no ha solicitado restablecer su contraseña, puede ignorar este correo electrónico.</p>
						<p>Atentamente,</p>
						<p>El equipo de Courtfusion</p>
					</div>
				</body>
				</html>';

					// Versión en texto sin formato del correo electrónico
					$mail->AltBody = 'Estimado Usuario, para restablecer su contraseña, haga clic en el siguiente enlace: http://localhost/Ejercicios/TFG/resetearcontrasena.php?token=' . urlencode($token);

					$mail->send();
					$exito = 'Se ha enviado un correo electrónico con instrucciones para restablecer su contraseña.';
				} catch (Exception $e) {
					$error = "No se pudo enviar el correo electrónico. Error del servidor de correo: {$mail->ErrorInfo}";
				}
			} catch (Exception $e) {
				$error = "No se pudo enviar el correo electrónico. Error del servidor de correo: {$mail->ErrorInfo}";
			}
		}
	} ?>

	<div class="container d-flex justify-content-center align-items-center mt-4">
		<div class="row">
			<div class="col-12 col-md-8 col-lg-6 mx-auto">
				<div class="card shadow p-4">
					<div class="text-center mb-4">
						<h4 class="fw-bold">Recuperar Contraseña</h4>
						<p class="mb-2">Introduce tu correo electrónico para recuperar tu contraseña.</p>
					</div>
					<form action="" method="post">
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" id="email" class="form-control" name="email" placeholder="Introduce tu email" autocomplete="off" required title="Por favor, ingresa tu correo electrónico">
						</div>
						<div class="mb-3 d-grid text-center">
							<button type="submit" name="recuperarcontraseña" class="btn btn-primary" style="background-color: #e86b1c;">Recuperar Contraseña</button>
							<a href="perfil.php" class="btn btn-primary ms-3" style="background-color: #e86b1c;">Volver</a>
						</div>
					</form>
					<?php if (!empty($error)) { ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $error; ?>
						</div>
					<? } ?>
					<?php if (!empty($exito)) { ?>
						<div class="alert alert-success" role="alert">
							<?php echo $exito; ?>
						</div>
					<? } ?>

					<div class="text-center">
						<p class="mb-0">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<?
mostrar_footer();
?>


</html>