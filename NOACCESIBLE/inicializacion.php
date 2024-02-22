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
  <link rel="stylesheet" type="text/css" href="estilo.css?1.0">
</head>
<?
?>

<body>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <?php
//Array para los errores
$array = [];
include 'NOACCESIBLE/credencialesdb.php';
$c1 = new mysqli($host, $usuario, $contraseña) or die('Error de conexion a mysql: ' . $c1->error . '<br>');
if (mysqli_query($c1, 'DROP DATABASE IF EXISTS BibliotecaDelgadoR;')) {
} else {
//echo ("No se ha borrar la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "CREATE DATABASE IF NOT EXISTS BibliotecaDelgadoR;")) {
} else {
//echo ("No se ha podido crear la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "use BibliotecaDelgadoR")) {
} else {
//echo ("No se ha podido seleccionar la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
//Creacion de tablas
if (mysqli_query($c1, "Create table IF NOT EXISTS alumnos (ALUMNO VARCHAR(10),APELLIDOS VARCHAR(50) NOT NULL,NOMBRE VARCHAR(50) NOT NULL, DNI VARCHAR(9),NIE VARCHAR(9),PRIMARY KEY(DNI))")) {
} else {
//echo ("No se ha podido seleccionar la tabla alumnos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS profesores (APELLIDOS VARCHAR(50) NOT NULL,NOMBRE VARCHAR(50) NOT NULL, DNI VARCHAR(9),COD_DPTO INT(2),PRIMARY KEY(DNI))")) {
} else {
//echo ("No se ha podido seleccionar la tabla profesores, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS departamentos (COD_DPTO INT(2) NOT NULL,NOMBRE VARCHAR(50) NOT NULL, CENTRO ENUM('CIFP1','ALBADALEJITO','PEDRO MERCEDES'),DNI_JFP VARCHAR(9),CONTRASEÑA VARCHAR(300),PRIMARY KEY(DNI_JFP))")) {
} else {
//echo ("No se ha podido seleccionar la tabla departamentos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS matriculas (ALUMNO VARCHAR(10) NOT NULL,ESTUDIOS VARCHAR(120) NOT NULL,GRUPO VARCHAR(20),PRIMARY KEY(ALUMNO,ESTUDIOS,GRUPO))")) {
} else {
//echo ("No se ha podido seleccionar la tabla matriculas, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS libros (COD_LIBRO VARCHAR(13) NOT NULL,TITULO VARCHAR(100) NOT NULL,AUTOR VARCHAR(100),MATERIA VARCHAR(30),EDITORIAL VARCHAR(30),A_EDICION INT(4),SM ENUM('SI','NO'),USUARIO ENUM('ALUMNO','PROFESOR','CONSULTA'),COD_DPTO INT(1),ESTADO ENUM('BUENO','MALO'),PRIMARY KEY(COD_LIBRO))")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS prestamos (COD_PRESTAMO VARCHAR(13) NOT NULL,COD_LIBRO VARCHAR(13),DNI VARCHAR(9) NOT NULL,FECHA_RECOGIDA DATETIME,FECHA_DEVOLUCION DATETIME,DEVUELTO ENUM('SI','NO'),PRIMARY KEY(COD_PRESTAMO))")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "Create table IF NOT EXISTS reservas (COD_LIBRO VARCHAR(13),FECHA_F DATETIMES,PRIMARY KEY(COD_LIBRO))")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
//Insertamos en alumnos
//$fcsv = fopen($_SERVER['DOCUMENT_ROOT'] . "/Informatica/DelgadoR/Biblioteca/csv/Departamentos.csv", "r");
$fcsv = fopen("csv/alumnos.csv", "r");
$fila = fgetcsv($fcsv, 0, ";");
while ($fila = fgetcsv($fcsv, 0, ";")) {
	//Compruebo que el valor de un campo de la fila no sea nulo para evitar la fila vacia que mete el csv al hacer la inserccion
	if ($fila[0] == "") {
	} else {
		$stmt = mysqli_prepare($c1, "INSERT INTO alumnos values(?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt, "sssss", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);

		if ($stmt->execute()) {

		} else {
//echo ("No se ha podido añadir el alumno, error:" . mysqli_error($c1));
			//exit(-1);
			$error = mysqli_error($c1);
			$numerror = mysqli_errno($c1);
			$array[] = $error;
		}
	}
}

//echo utfs_encode('Insercción en la Tabla Alumnos finalizada') . '<br>';
//Insertamos en profesores
//$fcsv = fopen($_SERVER['DOCUMENT_ROOT'] . "/Informatica/DelgadoR/Biblioteca/csv/Departamentos.csv", "r");
$fcsv = fopen("csv/Profesores.csv", "r");
$fila = fgetcsv($fcsv, 0, ";");
while ($fila = fgetcsv($fcsv, 0, ";")) {
	$stmt = mysqli_prepare($c1, "INSERT INTO profesores values(?,?,?,?)");
	$stmt->bind_param("sssi", $fila[0], $fila[1], $fila[2], $fila[3]);

	if ($stmt->execute()) {

	} else {
//echo ("No se ha podido añadir el profesor, error:" . mysqli_error($c1));
		//exit(-1);
		$error = mysqli_error($c1);
		$numerror = mysqli_errno($c1);
		$array[] = $error;
	}
}

//echo utfs_encode('Insercción en la Tabla Profesores finalizada') . '<br>';

//Insertamos en departamentos
//$fcsv = fopen($_SERVER['DOCUMENT_ROOT'] . "/Informatica/DelgadoR/Biblioteca/csv/Departamentos.csv", "r");
$fcsv = fopen("csv/Departamentos.csv", "r");
$fila = fgetcsv($fcsv, 0, ";");
while ($fila = fgetcsv($fcsv, 0, ";")) {
	$stmt = mysqli_prepare($c1, "INSERT INTO departamentos values(?,?,?,?,?)");
	$stmt->bind_param("issss", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);

	if ($stmt->execute()) {

	} else {
//echo ("No se ha podido añadir el departamento, error:" . mysqli_error($c1));
		//exit(-1);
		$error = mysqli_error($c1);
		$numerror = mysqli_errno($c1);
		$array[] = $error;
	}
}

//echo utfs_encode('Insercción en la Tabla Departamentos finalizada') . '<br>';

//Insertamos en Matriculas
//$fcsv = fopen($_SERVER['DOCUMENT_ROOT'] . "/Informatica/DelgadoR/Biblioteca/csv/Departamentos.csv", "r");
$fcsv = fopen("csv/Matriculas.csv", "r");
$fila = fgetcsv($fcsv, 0, ";");
while ($fila = fgetcsv($fcsv, 0, ";")) {
	$stmt = mysqli_prepare($c1, "INSERT INTO matriculas values(?,?,?)");
	$stmt->bind_param("sss", $fila[0], $fila[1], $fila[2]);

	if ($stmt->execute()) {

	} else {
//echo ("No se ha podido añadir la matricula, error:" . mysqli_error($c1));
		//exit(-1);
		$error = mysqli_error($c1);
		$numerror = mysqli_errno($c1);
		$array[] = $error;
	}
}

//echo utfs_encode('Insercción en la Tabla Matriculas finalizada') . '<br>';
//Insertamos en libros
//$fcsv = fopen($_SERVER['DOCUMENT_ROOT'] . "/Informatica/DelgadoR/Biblioteca/csv/Departamentos.csv", "r");
$fcsv = fopen("csv/AltaLibros.csv", "r");
$row = 0;
$fila = fgetcsv($fcsv, 0, ";");
while (($fila = fgetcsv($fcsv, 0, ";"))) {
	//Hago un contador para ignorar la linea de las cabeceras del csv
	$row++;
	if ($row == 1) {
	} else {
		$stmt = mysqli_prepare($c1, "INSERT INTO libros values(?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssissis", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6], $fila[7], $fila[8], $fila[9]);

		if ($stmt->execute()) {

		} else {
			//echo ("No se ha podido añadir el libro, error:" . mysqli_error($c1));
//exit(-1);
			$error = mysqli_error($c1);
			$numerror = mysqli_errno($c1);
			$array[] = $error;
		}
	}
}

//echo utfs_encode('Insercción en la Tabla Libros finalizada') . '<br>';
?>
    <section class="vh-100">
      <div class="container py-5 h-50">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle check" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                      d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                  </svg></h3>
                <h5>Biblioteca Creada correctamente</h5>
                <form method="post" action="administracion.php">
                  <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                </form>
              </div>
            </div>
            <div class="accordion-item mt-3">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed bg-danger text-white" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <strong class="text-center">Errores producidos en la creación</strong>
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

          </div>
        </div>
    </section>
  </div>
</body>