<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$imageFolder = 'imagenes/pistasporvalidar/';
	$approvedFolder = 'imagenes/pistas/';

	if (isset($_POST['image']) && isset($_POST['action']) && isset($_POST['email']) && isset($_POST['idPista'])) {
		$image = $_POST['image'];
		$action = $_POST['action'];
		$userEmail = $_POST['email'];
		$idPista = $_POST['idPista'];

		// Verifica si la imagen existe en la carpeta de imágenes por validar
		if (file_exists($imageFolder . $image)) {
			if ($action === 'move') {
				// Mueve la imagen a la carpeta de imágenes aprobadas y elimina la de "pistasporvalidar"
				if (rename($imageFolder . $image, $approvedFolder . $image)) {
					// Configura PHPMailer
					require 'vendor/autoload.php';

					$mail = new PHPMailer(true);

					/* try {
						$tiempo_expiracion = time() + 600; // 10 minutos de tiempo de expiración

						// Server settings
						$mail->isSMTP(); // Send using SMTP
						$mail->CharSet = 'UTF-8';
						$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
						$mail->SMTPAuth = true; // Enable SMTP authentication
						$mail->Username = 'reyes3790183@gmail.com'; // SMTP username
						$mail->Password = 'sfpz mtlk byza vxoj'; // SMTP password
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
						$mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						// Recipients
						$mail->setFrom('reyes3790183@gmail.com', 'Courtfusion');
						$mail->addAddress($userEmail); // Add a recipient

						// Content
						$mail->isHTML(true); // Set email format to HTML
						$mail->Subject = 'Pista Correctamente Registrada';

						// Contenido HTML del correo electrónico
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
						<div>
							<img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
						</div>
						<h3>Estimado Usuario,</h3>
<p>Su pista se ha registrado correctamente en Courtfusion. Agradecemos su contribución.</p>
<p>Si tiene alguna pregunta o necesita realizar más acciones, no dude en contactarnos.</p>
<p>Atentamente,</p>
<p>El equipo de Courtfusion</p>>
					</div>
				</body>';


						$mail->send();
					} catch (Exception $e) {
						echo 'No se pudo enviar el correo electrónico. Error del servidor de correo: ' . $mail->ErrorInfo;
					} */
					require 'NOACCESIBLE/credencialesdb.php';
					$conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
					if ($conexion->connect_errno) {
						echo "Error de conexión a la base de datos" . $conexion->connect_error;
					}
					$stmt = mysqli_prepare($conexion, "UPDATE pistas SET validacion='ACTIVA' WHERE id_pista=?");
					mysqli_stmt_bind_param($stmt, "s", $idPista);
					if (mysqli_stmt_execute($stmt)) {
						echo "Pista validada correctamente";
					} else {
						echo "Error al validar la pista";
					}
				} else {
					echo 'Error al mover la imagen.';
				}
			} elseif ($action === 'delete') {
				// Elimina la imagen de "pistasporvalidar" sin moverla a "pistas"
				if (unlink($imageFolder . $image)) {
					require 'vendor/autoload.php';

					$mail = new PHPMailer(true);
					/* 
					try {
						$tiempo_expiracion = time() + 600; // 10 minutos de tiempo de expiración

						// Server settings
						$mail->isSMTP(); // Send using SMTP
						$mail->CharSet = 'UTF-8';
						$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
						$mail->SMTPAuth = true; // Enable SMTP authentication
						$mail->Username = 'reyes3790183@gmail.com'; // SMTP username
						$mail->Password = 'sfpz mtlk byza vxoj'; // SMTP password
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
						$mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						// Recipients
						$mail->setFrom('reyes3790183@gmail.com', 'Courtfusion');
						$mail->addAddress($userEmail); // Add a recipient

						// Content
						$mail->isHTML(true); // Set email format to HTML
						$mail->Subject = 'Pista Correctamente Registrada';

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
								<div>
									<img src="https://i.ibb.co/6Yr50Nw/logo-removebg-preview.png" alt="Logo de Courtfusion" class="logo">
								</div>
								<h3>Estimado Usuario,</h3>
<p>Lamentamos informarle que la imagen que proporcionó ha sido rechazada en Courtfusion.</p>
<p>Si cree que esto ha sido un error o desea volver a registrar su pista, puede hacerlo haciendo clic en el siguiente enlace:</p>
<p><a href="http://localhost/Ejercicios/TFG/registratupista.php">Registrar su Pista</a></p>
<p>Si tiene alguna pregunta o necesita más información, no dude en ponerse en contacto con nuestro equipo de soporte.</p>
<p>Atentamente,</p>
<p>El equipo de Courtfusion</p>

							</div>
						</body>';

						$mail->send();
					} catch (Exception $e) {
						echo 'No se pudo enviar el correo electrónico. Error del servidor de correo: ' . $mail->ErrorInfo;
					} */

					require 'NOACCESIBLE/credencialesdb.php';
					$conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
					if ($conexion->connect_errno) {
						echo "Error de conexión a la base de datos" . $conexion->connect_error;
					}
					$stmt = mysqli_prepare($conexion, "DELETE FROM pistas WHERE id_pista=?");
					mysqli_stmt_bind_param($stmt, "s", $idPista);
					if (mysqli_stmt_execute($stmt)) {
						echo "Pista eliminada correctamente";
					} else {
						echo "Error al eliminar la pista";
					}
				} else {
					echo 'Error al eliminar la imagen.';
				}
			} else {
				echo 'Acción no válida.';
			}
		} else {
			echo 'La imagen no existe en la carpeta de imágenes por validar.';
		}
	} else {
		echo 'No se han especificado una imagen, una acción válida o un correo electrónico de usuario.';
	}
}
