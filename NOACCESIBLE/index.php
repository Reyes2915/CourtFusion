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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

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

    <br>
    <?

session_start();
include 'NOACCESIBLE/credencialesdb.php';
$c1 = new mysqli($host, $usuario, $contraseña, 'BibliotecaDelgadoR');
if (isset($_POST['buscar']) || (isset($_POST['reservar'])) || isset($_POST['reservarlib'])) {
	if (isset($_POST['reservarlib'])) {
		$dnilib = $_POST['dnilib'];
		$codiglib = $_POST['codigolib'];
		$fechareser = $_POST['fechareser'];
		if ($stmt = mysqli_prepare($c1, 'SELECT NOMBRE FROM alumnos WHERE DNI= ?')) {
		} else {
			echo ("error:" . mysqli_error($c1));
		}
		if (mysqli_stmt_bind_param($stmt, "s", $dnilib)) {} else {echo ("error:" . mysqli_error($c1));}
		if ($stmt->execute()) {
		} else {
			echo ("error:" . mysqli_error($c1));
		}
		$result = $stmt->store_result();
		if ($stmt->num_rows > 0) {
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($c1, "SELECT COD_LIBRO,TITULO,AUTOR,MATERIA,EDITORIAL,A_EDICION,SM,USUARIO,COD_DPTO,ESTADO FROM libros where COD_LIBRO=?");
			mysqli_stmt_bind_param($stmt, "s", $codiglib);
			if ($stmt->execute()) {
			} else {
				echo ("error:" . mysqli_error($c1));
			}
			$result = $stmt->get_result();
			$array = $result->fetch_all(MYSQLI_ASSOC);
      if(!$_SESSION[$dnilib]){
        $_SESSION[$dnilib] = array();
      }
			
			$_SESSION[$dnilib]['Reservas'][]=$array;
      //array_push($_SESSION[$dnilib]['Reservas'],$array);
      $_SESSION[$dnilib]['Prestamos']="";
			$_SESSION[$dnilib]['Historico']="";
			//print_r($_SESSION[$dnilib]['Reservas']);
			mysqli_stmt_close($stmt);
			if ($stmt = mysqli_prepare($c1, 'INSERT INTO reservas VALUES(?,?)')) {
			} else {
				echo ("error:" . mysqli_error($c1));
			}
			if (mysqli_stmt_bind_param($stmt, "ss", $codiglib, $fechareser)) {} else {echo ("error:" . mysqli_error($c1));}
			if ($stmt->execute()) {
			} else {
				echo ("error:" . mysqli_error($c1));
			}
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
                    <h5>Reserva realizada Correctamente</h5>
                    <form method="post" action="index.php">
                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section><?
		} else {
			$errordni = true;
			?>
 <form action="" method="post">
      <section class="vh-100">
        <div class="container py-5 h-20">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                <div class="card-body p-5 text-center">
                  <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                      class="bi bi-person" viewBox="0 0 16 16">
                      <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg></h3>
                  <h3 class="mb-5">Introduce tu dni:</h3>

                  <div class="form-outline mb-4 text-start">
                    <label class="form-label" for="dni">DNI</label>
                    <input type="text" id="dni" name="dnilib" class="form-control form-control-lg"
                      pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                      title="9 números y 1 letra" />
                  </div>
                  <?if (isset($errordni)) {?>
                  <div class="alert alert-danger alert-dismissible fade show"
                    <?php if ($errordni === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                    id="errordni">
                    <strong>Error!Este dni no se encuentra registrado</strong>
                  </div>
                  <?}?>
                  <button class="btn btn-primary btn-lg btn-block" name="reservarlib" type="submit">Reservar
                    libro</button>
                </div>
              </div>
            </div>
          </div>
    <?
		}
	}

	if (isset($_POST['reservar'])) {
		$codigolibro = $_POST['codigolib'];
		$dt = new DateTime('now', new DateTimeZone('Europe/Madrid'));
		$d = date_add($dt, date_interval_create_from_date_string("+7 days"));
		$date = $d->format("Y-m-d H:i:s");
		$codiglib = $_POST['codigolib'];
		?>
     <form action="" method="post">
      <section class="vh-100">
        <div class="container py-5 h-20">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                <div class="card-body p-5 text-center">
                  <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                      class="bi bi-person" viewBox="0 0 16 16">
                      <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg></h3>
                  <h3 class="mb-5">Introduce tu dni:</h3>

                  <div class="form-outline mb-4 text-start">
                    <label class="form-label" for="dni">DNI</label>
                    <input type="text" id="dni" name="dnilib" class="form-control form-control-lg"
                      pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                      title="9 números y 1 letra" />
                  </div>
                  <?if (isset($errordni)) {?>
                  <div class="alert alert-danger alert-dismissible fade show"
                    <?php if ($errordni === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                    id="errordni">
                    <strong>Error!Este dni no se encuentra registrado</strong>
                  </div>
                  <?}?>
                  <button class="btn btn-primary btn-lg btn-block" name="reservarlib" type="submit">Reservar
                    libro</button>
                    <input type="hidden" name="codigolib" value="<?php echo $codiglib; ?>">
                    <input type="hidden" name="fechareser" value="<?php echo $date; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>






    <?
	} else {?>
    <!-- <section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                            </svg></h3>
                        <h5>Error reservando el libro</h5>
                        <form method="post" action="index.php">
                            <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
    <?

	}

	if (isset($_POST['buscar'])) {
		$array = [];

		$titulo = $_POST['titulo'];
		$autor = $_POST['autor'];
		$materia = $_POST['materia'];
		$usuario = $_POST['usuario'];
		$departamento = $_POST['dpto'];
		$where = "";
		$casobind = 0;
		/* Obtengo los codigos de los libros que estan en la tabla reservas y los meto en un array para posteriormente comprobar
			    que si el codigo del libro que se obtiene de la tabla libros coincide con uno que esta en el array significa
		*/
		$stmt = mysqli_prepare($c1, "SELECT COD_LIBRO FROM reservas");
		if ($stmt->execute()) {
		} else {
			echo ("error:" . mysqli_error($c1));
		}
		mysqli_stmt_bind_result($stmt, $codlib);
		while ($stmt->fetch()) {
			$array[] = $codlib;
		}

		if (!empty($titulo)) {
			//$where .= " titulo = '$titulo'";
			$where .= "TITULO=?";
			$casobind = 0;
		}

		if ((!empty($titulo)) && !empty($autor)) {
			//$where .= " and autor= '$autor'";
			$where .= " and autor=?";
			$casobind = 1;
		} elseif (!empty($autor)) {
			//$where .= "autor= '$autor'";
			$where .= "autor= ?";
			$casobind = 2;
		}
		if ((!empty($autor) || !empty($titulo)) && !empty($materia)) {
			//$where .= " and materia = '$materia'";
			$where .= " and materia =?";
			$casobind = 3;
		} elseif (!empty($materia)) {
			//$where .= " materia = '$materia'";
			$where .= " materia =?";
			$casobind = 4;
		}

		if ((!empty($materia) || !empty($autor) || !empty($titulo)) && !empty($usuario)) {
			//$where .= " and usuario= '$usuario'";
			$where .= " and usuario= ?";
			$casobind = 5;
		} elseif (!empty($usuario)) {
			//$where .= " usuario= '$usuario'";
			$where .= " usuario=?";
			$casobind = 6;
		}
		if ((!empty($usuario) || !empty($materia) || !empty($autor) || !empty($titulo)) && !empty($departamento)) {
			//$where .= " and L.COD_DPTO = D.COD_DPTO and D.NOMBRE   = '$departamento'";
			$where .= " and COD_DPTO= ?";
			$casobind = 7;
		} elseif (!empty($departamento)) {
			//$where .= " L.COD_DPTO = D.COD_DPTO and D.NOMBRE   = '$departamento'";
			$where .= " COD_DPTO= ?";
			$casobind = 8;
		}
		$stmt = mysqli_prepare($c1, "SELECT COD_LIBRO,TITULO,AUTOR,MATERIA,EDITORIAL,A_EDICION,SM,USUARIO,COD_DPTO,ESTADO FROM libros where $where");
		switch ($casobind) {
		case 0:
			$stmt->bind_param("s", $titulo);
			break;
		case 1:
			$stmt->bind_param("ss", $titulo, $autor);
			break;
		case 2:
			$stmt->bind_param("s", $autor);
			break;
		case 3:
			if (!empty($autor) && !empty($materia)) {
				$stmt->bind_param("ss", $autor, $materia);
			}
			if (!empty($titulo) && !empty($materia)) {
				$stmt->bind_param("ss", $titulo, $materia);
			}
			if (!empty($autor) && !empty($titulo) && !empty($materia)) {
				$stmt->bind_param("sss", $titulo, $autor, $materia);
			}
			break;
		case 4:
			$stmt->bind_param("s", $materia);
			break;
		case 5:
			if ((!empty($titulo) && !empty($usuario)) && (empty($autor) && empty($materia))) {
				$stmt->bind_param("ss", $titulo, $usuario);
			}
			if (!empty($autor) && !empty($usuario) && (empty($titulo) && empty($materia))) {
				$stmt->bind_param("ss", $autor, $usuario);
			}
			if (!empty($materia) && !empty($usuario) && (empty($autor) && empty($titulo))) {
				$stmt->bind_param("ss", $materia, $usuario);
			}
			if (!empty($titulo) && !empty($usuario) && !empty($autor)) {
				$stmt->bind_param("sss", $titulo, $autor, $usuario);
			}
			if (!empty($titulo) && !empty($usuario) && !empty($materia)) {
				$stmt->bind_param("sss", $titulo, $materia, $usuario);
			}
			if (!empty($autor) && !empty($usuario) && !empty($materia)) {
				$stmt->bind_param("sss", $autor, $materia, $usuario);
			}
			if (!empty($autor) && !empty($materia) && !empty($titulo) && !empty($usuario)) {
				$stmt->bind_param("ssss", $titulo, $autor, $materia, $usuario);
			}
			break;
		case 6:
			$stmt->bind_param("s", $usuario);
			break;
		case 7:
			$result = $c1->query("SELECT COD_DPTO FROM departamentos where nombre='$departamento'");
			$row = mysqli_fetch_row($result);
			$coddepart = $row[0];
			if ((!empty($titulo) && !empty($departamento)) && (empty($autor) && empty($materia) && empty($usuario))) {

				$stmt->bind_param("si", $titulo, $coddepart);
			}
			if (!empty($autor) && !empty($departamento) && (empty($titulo) && empty($materia) && empty($usuario))) {
				$stmt->bind_param("si", $autor, $coddepart);
			}
			if (!empty($materia) && !empty($departamento) && (empty($autor) && empty($titulo) && !empty($usuario))) {
				$stmt->bind_param("si", $materia, $coddepart);
			}
			if (!empty($usuario) && !empty($departamento) && (empty($autor) && empty($titulo) && !empty($materia))) {
				$stmt->bind_param("si", $usuario, $coddepart);
			}

			if (!empty($titulo) && !empty($departamento) && !empty($autor)) {
				$stmt->bind_param("ssi", $titulo, $autor, $coddepart);
			}
			if (!empty($titulo) && !empty($departamento) && !empty($materia)) {
				$stmt->bind_param("ssi", $titulo, $materia, $coddepart);
			}
			if (!empty($titulo) && !empty($departamento) && !empty($usuario)) {
				$stmt->bind_param("ssi", $titulo, $materia, $coddepart);
			}
			if (!empty($autor) && !empty($departamento) && !empty($materia)) {
				$stmt->bind_param("ssi", $autor, $materia, $coddepart);
			}
			if (!empty($autor) && !empty($departamento) && !empty($usuario)) {
				$stmt->bind_param("ssi", $autor, $usuario, $coddepart);
			}
			if (!empty($materia) && !empty($departamento) && !empty($usuario)) {
				$stmt->bind_param("ssi", $materia, $usuario, $coddepart);
			}
			if (!empty($autor) && !empty($materia) && !empty($titulo) && !empty($usuario) && !empty($departamento)) {
				$stmt->bind_param("ssssi", $titulo, $autor, $materia, $usuario, $coddepart);
			}
			break;
		case 8:
			//Obtengo el codigo del nombre del departamento elegido en el desplegable para hacer la consulta
			$result = $c1->query("SELECT COD_DPTO FROM departamentos where nombre='$departamento'");
			$row = mysqli_fetch_row($result);
			$coddepart = $row[0];
			$stmt->bind_param("s", $coddepart);
			break;
		}
		//Creo que no hace falta por que no hago prepare
		if ($stmt->execute()) {
		} else {
			echo ("error:" . mysqli_error($c1));
		}
		mysqli_stmt_bind_result($stmt, $rcod, $rtitulo, $rautor, $rmateria, $reditorial, $rano, $rsm, $rusu, $rcoddepar, $restado);
		?>
    <div class="table-responsive">
      <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered display" id="example">
          <caption class="text-center">
            Libros
          </caption>
          <thead class="table-dark">
            <tr>
              <th>ISBN</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Materia</th>
              <th>Editorial</th>
              <th>Año</th>
              <th>SM</th>
              <th>Usuarios</th>
              <th>Dpto</th>
              <th>Estado</th>
              <th>Disponible</th>
            </tr>
          </thead>
          <tbody>
            <?
		while ($stmt->fetch()) {
			//Mostramos contenido
			?>
            <tr>
              <th>
                <?echo $rcod ?>
              </th>
              <th>
                <?echo $rtitulo ?>
              </th>
              <th>
                <?echo $rautor ?>
              </th>
              <th>
                <?echo $rmateria ?>
              </th>
              <th>
                <?echo $reditorial ?>
              </th>
              <th>
                <?echo $rano ?>
              </th>
              <th>
                <?echo $rsm ?>
              </th>
              <th>
                <?echo $rusu ?>
              </th>
              <th>
                <?echo $rcoddepar ?>
              </th>
              <th>
                <?echo $restado ?>
              </th>
              <?

			if (in_array($rcod, $array)) {
				?>
              <th class="text-center bg-danger text-white"><span>No disponible</span></th>
              <?

			} else {
				?>
              <th>
                <div class="text-center">
                  <form action="" method="post">
                    <button type="submit" id="reservar" name="reservar"
                      class="btn btn-success btn-lg btn-block  ms-2">Reservar</button>

                    <input type="hidden" name="codigolib" value="<?php echo $rcod; ?>">
                  </form>
                </div>
              </th>
              <?
			}?>

      </div>
      </th>
      </tr>
      <?}?>
      </tbody>
      </table>
    </div>
  </div>
  </div>
  <?
		//Asi si no funciona con prepare
		//mysqli_stmt_execute($stmt);
		//mysqli_stmt_bind_result($stmt,$rcod,$rtitulo,$rautor,$rmateria,$reditorial,$rano,$rsm,$rusu,$rcoddepar,$restado);
		//Liberamos recurso
		mysqli_stmt_close($stmt);

//Cerramos conexión
		mysqli_close($c1);
		?>
  <div class="text-center">
    <a href="index.php"><button type="submit" id="volver" name="volver"
        class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
  </div>
  <?
	}} else {
	?>


  <h3 class="text-center bg-secondary text-white h1">Busca tu libro</h3>
  <br>
  <form method="post">
    <div class="row mb-4">
      <div class="col">
        <div class="form-outline">
          <input type="text" id="titulo" name="titulo" class="form-control" />
          <label class="form-label" for="titulo">Titulo</label>
        </div>
      </div>
      <div class="col">
        <div class="form-outline">
          <input type="text" id="autor" name="autor" class="form-control" />
          <label class="form-label" for="autor">Autor</label>
        </div>
      </div>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" id="materia" name="materia" class="form-control" />
      <label class="form-label" for="materia">Materia</label>
    </div>

    <!-- Password input -->
    <div class="row mb-4">
      <div class="col">
        <div class="form-outline">
          <input type="text" name="usuario" list="usuario" class="form-control" />
          <label class="form-label" for="usuario">Usuario</label>
          <datalist id="usuario">
            <option value="Profesor">
            <option value="Alumno">
          </datalist>
        </div>
      </div>
      <div class="col">
        <div class="form-outline">
          <input type="text" list="departamento" name="dpto" class="form-control" />
          <label class="form-label" for="dpto">Departamento</label>
          <datalist id="departamento">
            <?php
$c2 = mysqli_connect($host, $usuario, $contraseña);
	mysqli_query($c2, "use BibliotecaDelgadoR");
	$stmt = mysqli_prepare($c2, "SELECT NOMBRE FROM departamentos");
	$stmt->execute();
	$stmt->bind_result($col1);

/* Muestro los nombres de laos departamentos en un option */
	while ($stmt->fetch()) {

		?> <option value="<?echo $col1 ?>">
              <?}?>
          </datalist>
        </div>
      </div>
    </div>
    <!-- Submit button -->
    <div class="text-center">
      <button type="submit" name="buscar" class="btn btn-primary btn-lg btn-block mb-4">Buscar Libros</button>
    </div>
  </form>
  <?}?>
  </div>
  <script type="text/javascript" src="js/validar.js"></script>
</body>