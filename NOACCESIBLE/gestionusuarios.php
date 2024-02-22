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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<div class="container-fluid">
    <nav class="navbar navbar-default ">
        <a class="navbar-brand pull-left" href="index.php"><img id="logo" src="imagenes/logocifp.png"></a>
        <div class="navbar navbar-expand-lg d-block d-lg-block" id="paginas">

            </a>
            <ul class="navbar ms-auto">
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://educamosclm.castillalamancha.es/">
                        <img src="imagenes/educamos.png" alt="Educamos" class="imagengrande" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Educamos

                    </span>
                </li>
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://delphos.jccm.es/delphos/jsp/pag_inicio1024.jsp">
                        <img src="imagenes/delphos.png" alt="Delphos" class="imagengrande" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Delphos

                    </span>
                </li>
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://aulasfp2223.castillalamancha.es/">
                        <img src="imagenes/elearning.png" class="imagengrande" alt="Fp" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">FP a distancia
                        </a>
                </li>
                <li class="nav-item mt-5 me-5 d-inline d-lg-block">
                    <a href="http://pop.jccm.es/acredita/">
                        <img src="imagenes/acreditaCLM.png" class="imagengrande" alt="Acredita" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Acredita
                    </span>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <nav class="navbar navbar-expand-lg navbar-light" id="menu">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="nav justify-content-center">
                    <li class="nav-item  ms-3 me-3">
                        <a class="nav-link ms-3" href="index.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3" href="administracion.php">Administración</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?
include 'NOACCESIBLE/credencialesdb.php';
if (isset($_POST['insertar'])) {
	$alumno = $_POST['alumno'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$dni = $_POST['dni'];
	$nie = $_POST['nie'];
	$c1 = mysqli_connect($host, $usuario, $contraseña);
	mysqli_query($c1, "use BibliotecaDelgadoR");
    //Inserto el alumno con los valores elegidos en el formulario
	$stmt = mysqli_prepare($c1, "INSERT INTO alumnos values(?,?,?,?,?)");
	mysqli_stmt_bind_param($stmt, "issss", $alumno, $nombre, $apellidos, $dni, $nie);
	if ($stmt->execute()) {
		?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg></h3>
                            <h5>Alumno correctamente insertado</h5>
                            <form method="post" action="gestionusuarios.php">
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
		echo ("error:" . mysqli_error($c1));?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg></h3>
                            <h5>Error insertando Alumno</h5>
                            <form method="post" action="gestionusuarios.php">
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
	//Liberamos recurso
	mysqli_stmt_close($stmt);

	//Cerramos conexión
	mysqli_close($c1);
	?>
    <?
}
if (isset($_POST['insertarmasiva'])) {
	$tmp_name = $_FILES['archivo']['tmp_name'];
	$c1 = mysqli_connect($host, $usuario, $contraseña, 'BibliotecaDelgadoR');
	/* Introduzco los valores del csv introducido en un array bidimensional para saber si la primera columna es alumno o 
    apellidos para saber si tengo que insertar en la tabla profesores o en la tabla alumnos */
	$file = fopen($tmp_name, "r");
	$filas = [];
	while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
		$filas[] = $data; // as fgetcsv return array already exlode by ","
	}
	$fila = fgetcsv($file, 0, ";");
	$primercampo = explode(';', $filas[0][0]);
	if ($primercampo[1] =="APELLIDOS") {
        $stmt = mysqli_prepare($c1,"DELETE ALL FROM alumnos");
        $stmt->execute();
		$array = [];
		$file = fopen($tmp_name, "r");
		$row = 0;
		while ($fila = fgetcsv($file, 0, ";")) {
			$row++;
			if ($row == 1) {
			} else {
				$stmt = mysqli_prepare($c1,"INSERT IGNORE INTO alumnos values(?,?,?,?,?)");
				mysqli_stmt_bind_param($stmt, "ssssss", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);

				if ($stmt->execute()) {

				} else {
                    //Si hay algun error lo guardo en un array para mostrarlo posteriormente en un desplegable
					$error = mysqli_error($c1);
					$numerror = mysqli_errno($c1);
					$array[] = $error;
				}
			}
		}
	}
	if ($primercampo[1] === "NOMBRE") {
        $stmt = mysqli_prepare($c1,"DELETE ALL FROM profesores");
        $stmt->execute();
		$array = [];
		$file = fopen($tmp_name, "r");
		$row = 0;
		while ($fila = fgetcsv($file, 0, ";")) {
			$row++;
			if ($row == 1) {
			} else {
				$stmt = mysqli_prepare($c1, "INSERT INTO profesores values(?,?,?,?)");
				mysqli_stmt_bind_param($stmt, "sssi", $fila[0], $fila[1], $fila[2], $fila[3]);
				if ($stmt->execute()) {

				} else {
					$error = mysqli_error($c1);
					$numerror = mysqli_errno($c1);
					$array[] = $error;
				}
			}
		}

	}

	?>
    <section class="vh-100">
        <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg></h3>
                            <h5>Insercción de usuarios finalizada</h5>
                            <form method="post" action="gestiondepart.php">
                                <button class="btn btn-lg btn-block btn btn-light" name="inicio"
                                    type="submit">Volver</button>
                            </form>
                        </div>
                    </div>
                    <?
	if (!empty($array)) {?>
                    <div class="accordion-item mt-4">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed  bg-danger text-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                <strong class="text-center">Errores producidos en la insercción</strong>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-hover table-bordered">
                                            <caption class="text-center">
                                                Errores
                                            </caption>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Error</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center" id="rows">
                                                <?foreach ($array as $valor) {?>
                                                <tr>
                                                    <th>
                                                        <?echo $valor ?>
                                                    </th>
                                                </tr>
                                                <?}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?} else {}?>
                </div>
            </div>
        </div>
    </section>
    <?

}
?>
    <?

if (isset($_POST['individual']) || isset($_POST['masiva']) || isset($_POST['insertar']) || isset($_POST['insertarmasiva'])) {

	if (isset($_POST['individual'])) {
		?><br>
    <form method="post">
        <h1 class="text-center">Introduce al nuevo usuario</h1>
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline ms-5"><input type="text" id="alumno" name="alumno"
                        class="form-control" /><label class="form-label" for="alumno">Alumno</label></div>
            </div>
            <div class="col">
                <div class="form-outline me-5"><input type="text" id="nombre" name="nombre"
                        class="form-control" /><label class="form-label" for="nombre">Nombre</label></div>
            </div>
        </div>
</div>
<div class="row mb-4">
    <div class="col">
        <div class="form-outline ms-5 ps-3"><input type="text" id="apellidos" name="apellidos"
                class="form-control" /><label class="form-label" for="apellidos">Apellidos</label></div>
    </div>
    <div class="col">
        <div class="form-outline me-5 pe-3"><input type="text" id="dni" name="dni" class="form-control" /><label
                class="form-label" for="dni">DNI</label></div>
    </div>
</div>
<div class="form-outline mb-4 ms-5 me-5 ps-3 pe-3"><input type="text" id="nie" name="nie" class="form-control" /><label
        class="form-label" for="nie">NIE</label>
    <br>
    <div class="form-group">
        <div class="col-md-12 text-center">
            <div class="text-center d-inline"><button type="submit" name="insertar"
                    class="btn botonancho btn-lg btn-block mb-4 me-2">Insertar</button></div>
            <div class="text-center d-inline">
                <a href="'.$_SERVER['HTTP_REFERER'].'"><button type="submit" name="volver"
                        class="btn botonancho btn-lg btn-block mb-4 ms-2">Volver</button></a></div>
        </div>
        </form>
    </div>
</div>

<?
	}
	if (isset($_POST['masiva'])) {

		?>
<form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
    <div class="container">
        <section class="vh-300">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" id="carta">
                                <h1 class="mb-5">Inserta el archivo para dar de alta a los usuarios</h1>
                                <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                        <path
                                            d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                    </svg></h3>

                                <input type="file" name="archivo" class="mt-3 mb-3" required>
                                <br>

                                <button class="btn botonancho btn-lg btn-block " name="insertarmasiva"
                                    type="submit">Insercion Masiva</button>



                                <button class="btn botonancho btn-lg btn-block " name="volver"
                                    type="submit">Volver</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
<?
	}
} else {

	?>
<form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
    <div class="container">
        <section class="vh-300">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" id="carta">
                                <h1 class="mb-5">Alta Usuarios</h1><button class="btn botonancho btn-lg btn-block ms-3"
                                    name="individual" type="submit">Individual</button><button
                                    class="btn botonancho btn-lg btn-block ms-2 " name="masiva"
                                    type="submit">Masiva</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
</div>

</html>
<?
}

?>