<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <link rel="icon" href="imagenes/libros.jpg">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css?1.0">
</head>
<?
include 'NOACCESIBLE/credencialesdb.php';
if ((isset($_POST['volver']) || isset($_POST['restablecer']))) {
	if (isset($_POST['volver'])) {
		header('Location: administracion.php');
	}
	if (isset($_POST['restablecer'])) {
		if ($_POST['contraseña'] == $_POST['confcontraseña']) {
			$error = false;
			$departamento = $_POST['dpto'];
			$c1 = mysqli_connect($host, $usuario, $contraseña, "BibliotecaDelgadoR");

//Creamos y preparamos la consulta
			//La "query" genera un recurso (objeto) de la clase mysqli_stmt
			$hash = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
			$stmt = mysqli_prepare($c1, "UPDATE departamentos SET Contraseña = '$hash' WHERE nombre =?");
			mysqli_stmt_bind_param($stmt, "s", $departamento);
			if ($stmt->execute()) {
        ?>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                    </svg></h3>
                                <h5>Contraseña actualizada correctamente,
                                  La nueva contraseña es: <?echo $_POST['contraseña']?>
                                </h5>
                                <form method="post" action="administracion.php">
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
        echo ("error:" . mysqli_error($c1)); ?>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                    </svg></h3>
                                <h5>Error reseteando contraseña de departamento</h5>
                                <form method="post" action="administracion.php">
                                    <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><?
			}
		} else {
			$error = true;
		}
	}
}
	?>
<?
if(!isset($error) || $error=true){
	$c1 = mysqli_connect($host, $usuario, $contraseña);
	mysqli_query($c1, "use BibliotecaDelgadoR");
	$stmt = mysqli_prepare($c1, "SELECT NOMBRE FROM departamentos");
  $stmt->execute();?>

    <div class="container">
      <section class="vh-300">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center" id="carta">
                  <h1 class="mb-5">Cambio de Contraseña de Departamento</h1>
                  <form ACTION="" method="post" class="ms-2">
                    <h3 class="text-start">Elige el departamento:</h3>
                    <div class="form-outline">
                      <input type="text" list="departamento" name="dpto" class="form-control" required />
                      <label class="form-label" for="dpto"></label>
                      <datalist id="departamento">
                        <?php

	$stmt->bind_result($col1);

	/* Muestro los nombres de laos departamentos en un option */
	while ($stmt->fetch()) {

		?> <option value="<?echo $col1 ?>">
                <?}?>
                      </datalist>
                    </div>
                    <!-- <div class="form-outline mb-4 text-start input-group-append">
                      <label for="contraseña" class="col-form-label fs-3">Nueva Contraseña:</label>
                      <br>
                      <input type="password" ID="txtPassword" name="contraseña" class="form-control form-control-lg"
                        required />
                      <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                        <span class="fa fa-eye-slash icon"></span> </button>

                    </div> -->

                <div class="col-md-12  mb-4 text-start">
                  <label for="contraseña" class="col-form-label fs-3">Nueva Contraseña:</label>
                  <div class="input-group">
                    <input ID="txtPassword" name="contraseña" type="Password" Class="form-control" required>
                    <div class="input-group-append">
                      <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                        <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                  </div>
                </div>





                <div class="form-outline mb-4 text-start">
                  <label for="confcontraseña" class="col-form-label fs-3">Confirmar Contraseña:</label>
                  <input type="password" id="confcontraseña" name="confcontraseña" class="form-control form-control-lg"
                    required />

                </div>
                <?php
if (isset($error)) {?>
                <div class="alert alert-danger alert-dismissible fade show"
                  <?php if ($error === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                  id="error">
                  <strong>Error!Las contraseñas no coinciden.</strong>
                </div>
                <?}?>
                <button class="btn botonancho btn-lg btn-block" name="restablecer" type="submit">Restablece
                  contraseña</button>
                <button class="btn botonancho btn-lg btn-block ms-3" name="volver" id="volver" type="submit">Volver a
                  Inicio</button>

                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </section>
<?}?>
  </div>
  <script type="text/javascript" src="js/validar.js"></script>