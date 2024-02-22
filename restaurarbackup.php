<?session_start();
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar Backup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</head>

<body>

    <?
    include 'funciones.php';
    mostrarNavbar();
if (isset($_POST['restaurar'])) {
	$nom = $_FILES['zip']['name'];
	$tmp_path = $_FILES['zip']['tmp_name'];
	$name = pathinfo($nom, PATHINFO_FILENAME);
	$dest_path = dirname(__FILE__) . '/backups/' . $_FILES['zip']['name'];
	if (move_uploaded_file($tmp_path, $dest_path)) {
		$database = 'PistasDelgadoR';
		$restore_file = dirname(__FILE__) . '/backups/' . $_FILES['zip']['name'];
		$user = $usuario;
		$pass = $contraseña;
		$hostdb = $host;
		$command = "C:\ServidorLocal\mysql\bin\mysql -h localhost -u {$user} -p{$pass} {$database} < $restore_file";
		//$command = "/volume1/@appstore/MariaDB10/usr/local/mariadb10/bin/mysql -h localhost -u {$user} -p{$pass} {$database} < $restore_file";
		//exec('/volume1/@appstore/MariaDB10/usr/local/mariadb10/bin/mysql -u root --password="1234" BibliotecaDelgadoR </volume1/web/Informatica/DelgadoR/Biblioteca/backups/' . $name . '.sql', $output, $return);
	}
	if (!$return) {
		?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-50">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                    fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg></h3>
                            <h5>Backup restaurado correctamente</h5>
                            <form method="post" action="backup.php">
                                <button class="btn btn-lg btn-block btn btn-light" name="inicio"
                                    type="submit">Volver</button>
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
                    <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                            <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg></h3>
                            <h5>Error restaurando backup</h5>
                            <form method="post" action="backup.php">
                                <button class="btn btn-lg btn-block btn btn-light" name="inicio"
                                    type="submit">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?
	}
}
?>
    <form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
        <div class="container">
            <section class="vh-300">
                <div class="container py-5 h-50">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center" id="carta">
                                    <h1 class="mb-5">Inserta el backup para restaurarlo</h1>
                                    <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                            <path
                                                d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                        </svg></h3>

                                    <input type="file" name="zip" class="mt-3 mb-3" required>
                                    <br>

                                    <div class="d-flex justify-content-center">
                                        <div class="me-2">
                                            <button class="btn botonancho btn-lg" name="restaurar"
                                                type="submit">Restaurar Backup</button>
                                        </div>
                                        &nbsp;
                                        <!-- Agregar espacio en blanco -->
                                        &nbsp;
                                        <!-- Agregar espacio en blanco -->
                                        &nbsp;
                                        <!-- Agregar espacio en blanco -->
                                        <div class="ms-2">
                                            <a href="backup.php">
                                                <button class="btn botonancho btn-lg" name="volver" id="volver"
                                                    type="button">Volver</button>
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
    </form>


<?
mostrar_footer();
?>





   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/script.js"></script>
</body>