<!DOCTYPE html>
<html>

<head>
	<title>Restablecer Contraseña</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<?
include "NOACCESIBLE/credencialesdb.php";
include 'funciones.php';
mostrarNavbar();
if (isset($_GET['token'])) {
	$errorMsg = '';
	$exitoMsg = '';
	$token = $_GET['token'];
	$decoded_token = base64_decode(urldecode($token));
	list($usuariodb, $tiempo_expiracion) = explode('|', $decoded_token);

	if ($tiempo_expiracion >= time()) {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$nuevaContraseña = $_POST['nueva_contraseña'];
			$confirmarContraseña = $_POST['confirmar_contraseña'];

			// Realiza la validación y el cambio de contraseña para el usuario
			// Asegúrate de almacenar la nueva contraseña de manera segura (hashing y salting)

			if ($nuevaContraseña === $confirmarContraseña) {
				// Contraseña válida, realiza el cambio
				// Después de cambiar la contraseña, puedes redirigir al usuario a la página de inicio de sesión
				$c1 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');
				$stmt = mysqli_prepare($c1, "UPDATE usuarios SET contrasena=? WHERE correo=?");
				$contraseñahash = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
				$stmt->bind_param('ss', $contraseñahash, $usuariodb);
				if (!$stmt->execute()) {
					?>
					<section class="vh-100">
					<div class="container py-5 h-100">
						<div class="row d-flex justify-content-center align-items-center h-50">
							<div class="col-12 col-md-8 col-lg-6 col-xl-5">
								<div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
									<div class="card-body p-5 text-center">
										<h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
												<path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
											</svg></h3>
										<h5>Error cambiando contraseña</h5>
										<form method="post" action="index.php">
											<button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?
				} else {
					?>
					<section class="vh-100">
					<div class="container py-5 h-100">
						<div class="row d-flex justify-content-center align-items-center h-50">
							<div class="col-12 col-md-8 col-lg-6 col-xl-5">
								<div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
									<div class="card-body p-5 text-center">
										<h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
												<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
												<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
											</svg></h3>
										<h5>Contraseña cambiada Correctamente</h5>
										<form method="post" action="index.php">
											<button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?
					
				}
			} else {
				// Contraseñas no coinciden
				$errorMensaje = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
			}
		}
	} else {
		// Token caducado
		$errorMensaje = 'El token de restablecimiento de contraseña ha caducado. Por favor, solicita un nuevo enlace de restablecimiento de contraseña.';
	}
} else {
	// Token no válido
	$errorMensaje = 'Token no válido. Por favor, solicita un nuevo enlace de restablecimiento de contraseña.';
} ?>

<body>
	<div class="container mt-5">
		<div class="card shadow p-4">
			<h2 class="text-center mb-4">Restablecer Contraseña</h2>

			<?php if (isset($errorMensaje)) { ?>


				<div class="container mt-2">
					<div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
						<div class="text-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
								<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
							</svg>
							<div class="mt-3">
								<strong><?php echo $errorMensaje; ?></strong>

							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>

				<form method="POST" action="">
					<div class="mb-3">
						<label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
						<input type="password" name="nueva_contraseña" class="form-control" required>
					</div>

					<div class="mb-3">
						<label for="confirmar_contraseña" class="form-label">Confirmar Contraseña:</label>
						<input type="password" name="confirmar_contraseña" class="form-control" required>
					</div>
					<?php if (!empty($errorMsg)) { ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $errorMsg; ?>
						</div>
					<?php } ?>
					<?php if (!empty($exitoMsg)) { ?>
						<div class="alert alert-success" role="alert">
							<?php echo $exitoMsg; ?>
						</div>
					<? } ?>

					<input type="hidden" name="token" value="<?php echo $token; ?>">

					<div class="d-grid gap-2 text-center">
						<button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
					</div>
				</form>
			<? } ?>
		</div>
	</div>

</body><?
		mostrar_footer();
		?>

</html>