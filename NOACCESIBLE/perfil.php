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
  <?
  include 'NOACCESIBLE/credencialesdb.php';
  session_start();
  function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
$errormatricula=false;
if (isset($_POST['acceder']) || isset($_POST['accederprof'])) {
	if (isset($_POST['acceder'])) {
		$nie = $_POST['nie'];
		$dni = $_POST['dnialum'];




		if($c1 = mysqli_connect($host, $usuario, $contraseña,'BibliotecaDelgadoR')){
    }else{
      echo ("error:" . mysqli_error($c1));
    }
     //Comprobar si el alumno esta matriculado
     $result1=mysqli_query($c1,"SELECT * FROM alumnos");
     $result2=mysqli_query($c1,"SELECT alumno FROM matriculas");
     $filam=mysqli_fetch_all($result2,MYSQLI_NUM);
     //print_r($filam);
     while($filaa=mysqli_fetch_row($result1)){
       if(($filaa[3]==$dni) && !in_array_r($filaa[0],$filam)){
         $errormatricula=true
         ?>
       <?
       }
     }
     if($errormatricula==true){?>
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
                  <h3 class="mb-5">Soy Alumno</h3>
                  <div class="form-outline mb-4 text-start">
                    <label class="form-label" for="dnialum">DNI</label>
                    <input type="text" id="dnialum" name="dnialum" class="form-control form-control-lg"
                      pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                      title="9 números y 1 letra" />
                  </div>
                  <div class="form-outline mb-4 text-start">
                    <label class="form-label" for="nie">NIE</label>
                    <input type="text" id="nie" name="nie" class="form-control form-control-lg" />
                  </div>
                  <?if (isset($errormatricula)) {?>
                  <div class="alert alert-danger alert-dismissible fade show"
                    <?php if ($errormatricula === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                    id="errormatricula">
                    <strong>Error!Actualmente no estas matriculado.</strong>
                  </div>
                  <?}?>
                  <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                <div class="card-body p-5 text-center">
                  <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                      class="bi bi-person" viewBox="0 0 16 16">
                      <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg></h3>
                  <h3 class="mb-5">Soy Profesor</h3>
  
                  <div class="form-outline mb-4 text-start">
                    <label class="form-label" for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                      pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                      title="9 números y 1 letra" />
                  </div>
                  <?if (isset($errorprofesor)) {?>
                  <div class="alert alert-danger alert-dismissible fade show"
                    <?php if ($errorprofesor === false) {?>style="display:none" <?php } else {?>style="display:block"
                    <?}?>
                    id="errorprofesor">
                    <strong>Error!Este dni no se encuentra registrado en la biblioteca</strong>
                  </div>
                  <?}?>
                  <button class="btn btn-primary btn-lg btn-block" name="accederprof" type="submit">Acceder</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
                    </div><? }else{
     
		$stmt = mysqli_prepare($c1,'SELECT NOMBRE,APELLIDOS FROM alumnos WHERE DNI=? and NIE=?');
    mysqli_stmt_bind_param($stmt,'ss',$dni,$nie);
    mysqli_stmt_execute($stmt);

    /* vincular variables a la sentencia preparada */
    mysqli_stmt_bind_result($stmt, $col1, $col2);

    /* obtener valores */
    while (mysqli_stmt_fetch($stmt)) {
      ?>
      <div class="text-center">
      <span class="h3 b"><?echo("Actualmente estas registrado como:".$col1." ".$col2)?></span>
      </div> <?
    }
    if(!isset($_SESSION[$dni])){
    $_SESSION[$dni] = array();
    $_SESSION[$dni]['Reservas']="";
    $_SESSION[$dni]['Prestamos']="";
    $_SESSION[$dni]['Historico']="";
    }else{
      $reservas=$_SESSION[$dni]['Reservas'];
    }
print_r($_SESSION[$dni]);
if ($stmt->num_rows > 0) {
   ?>
  <div class="row mt-3">
    <div class="col-lg-6 col-xl-6">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <strong class="text-center">Mis Reservas</strong>
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="table-responsive">
              <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered">
                  <caption class="text-center">
                    Reservas
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
                      <th>Estado</th>
                      <th>Usuarios</th>
                      <th>Dpto</th>
                      <th>Cancelar</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <tr>
                     <!--  <th>Prueba</th>
                      <th>Libro para probar la table</th>
                      <th>Reyes</th>
                      <th>PHP</th>
                      <th>Editorial PHP</th>
                      <th>2006</th>
                      <th>No</th>
                      <th>Malo</th>
                      <th>Consulta</th>
                      <th>Informática</th> -->
                      <?foreach($reservas as $value){
                        foreach($value as $libro)
                        {
                       
                        
?><th><? echo $libro?></th><?
                      }?>
                      <th> <button class="btn btn-danger btn-lg btn-block text-white" name="cancelreser"
                          type="submit">Cancelar</button></th>
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
    <div class="col-lg-6 col-xl-6">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <strong class="text-center">Mis Prestamos</strong>
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="table-responsive">
              <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered">
                  <caption class="text-center">
                    Prestamos
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
                      <th>Estado</th>
                      <th>Usuarios</th>
                      <th>Dpto</th>
                      <th>Cancelar</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <tr>
                      <th>Prueba</th>
                      <th>Libro para probar la table</th>
                      <th>Reyes</th>
                      <th>PHP</th>
                      <th>Editorial PHP</th>
                      <th>2006</th>
                      <th>No</th>
                      <th>Malo</th>
                      <th>Consulta</th>
                      <th>Informática</th>
                      <th> <button class="btn btn-danger btn-lg btn-block text-white" name="cancelreser"
                          type="submit">Cancelar</button></th>
                      </th>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item mt-3">
      <h2 class="accordion-header" id="headingone">
        <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseone" aria-expanded="false" aria-controls="collapseone">
          <strong class="text-center">Histórico de prestamos</strong>
        </button>
      </h2>
      <div id="collapseone" class="accordion-collapse collapse" aria-labelledby="headingone"
        data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="table-responsive">
            <div class="col-md-12">
              <table class="table table-striped table-hover table-bordered">
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
                    <th>Estado</th>
                    <th>Usuarios</th>
                    <th>Dpto</th>
                    <th>Disponible</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th>Prueba</th>
                    <th>Libro para probar la table</th>
                    <th>Reyes</th>
                    <th>PHP</th>
                    <th>Editorial PHP</th>
                    <th>2006</th>
                    <th>No</th>
                    <th>Malo</th>
                    <th>Consulta</th>
                    <th>Informática</th>
                    <th>SI</th>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?
}else{
  $error=true;
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
                <h3 class="mb-5">Soy Alumno</h3>
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="dnialum">DNI</label>
                  <input type="text" id="dnialum" name="dnialum" class="form-control form-control-lg"
                    pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                    title="9 números y 1 letra" />
                </div>
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="nie">NIE</label>
                  <input type="text" id="nie" name="nie" class="form-control form-control-lg" />
                </div>
                <?if (isset($error)) {?>
                <div class="alert alert-danger alert-dismissible fade show"
                  <?php if ($error === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                  id="error">
                  <strong>Error!El dni o el nie no son correctos.</strong>
                </div>
                <?}?>
                <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
              <div class="card-body p-5 text-center">
                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 16 16">
                    <path
                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg></h3>
                <h3 class="mb-5">Soy Profesor</h3>

                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="dni">DNI</label>
                  <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                    pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                    title="9 números y 1 letra" />
                </div>
                <?if (isset($errorprofesor)) {?>
                <div class="alert alert-danger alert-dismissible fade show"
                  <?php if ($errorprofesor === false) {?>style="display:none" <?php } else {?>style="display:block"
                  <?}?>
                  id="errorprofesor">
                  <strong>Error!Este dni no se encuentra registrado en la biblioteca</strong>
                </div>
                <?}?>
                <button class="btn btn-primary btn-lg btn-block" name="accederprof" type="submit">Acceder</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</div>

<script type="text/javascript" src="js/validar.js"></script>
<?
}
 /*    //Comprobar si el alumno esta matriculado
    $result1=mysqli_query($c1,"SELECT * FROM alumnos");
    $result2=mysqli_query($c1,"SELECT alumno FROM matriculas");
    $filam=mysqli_fetch_all($result2,MYSQLI_NUM);
    //print_r($filam);
    while($filaa=mysqli_fetch_row($result1)){
      if(!in_array_r($filaa[0],$filam)){
        echo (utf8_encode(utf8_decode("El Alumno:$filaa[0].$filaa[2] $filaa[1],no esta matriculado").'<br>'));
      }
    } */
				?>
<?}}?>
<?

	if (isset($_POST['accederprof'])) {
		$dni = $_POST['dni'];
		$c1 = new mysqli($host, $usuario, $contraseña,'BibliotecaDelgadoR');
		$stmt = mysqli_prepare($c1,'SELECT NOMBRE FROM profesores WHERE DNI= ?');
		//Creo que no hace falta por que no hago prepare
		mysqli_stmt_bind_param($stmt,"s", $dni);
		if ($stmt->execute()) {
		} else {
			echo ("error:" . mysqli_error($c1));
		}
		//Guardo el resultado
    $stmt->store_result();

		if ($stmt->num_rows > 0) {
      $_SESSION[$dni] ="";
			?>
<div class="row mt-3">
  <div class="col-lg-6 col-xl-6">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <strong class="text-center">Mis Reservas</strong>
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
        data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="table-responsive">
            <div class="col-md-12">
              <table class="table table-striped table-hover table-bordered">
                <caption class="text-center">
                  Reservas
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
                    <th>Estado</th>
                    <th>Usuarios</th>
                    <th>Dpto</th>
                    <th>Cancelar</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th>Prueba</th>
                    <th>Libro para probar la table</th>
                    <th>Reyes</th>
                    <th>PHP</th>
                    <th>Editorial PHP</th>
                    <th>2006</th>
                    <th>No</th>
                    <th>Malo</th>
                    <th>Consulta</th>
                    <th>Informática</th>
                    <th> <button class="btn btn-danger btn-lg btn-block text-white" name="cancelreser"
                        type="submit">Cancelar</button></th>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-xl-6">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <strong class="text-center">Mis Prestamos</strong>
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
        data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="table-responsive">
            <div class="col-md-12">
              <table class="table table-striped table-hover table-bordered">
                <caption class="text-center">
                  Prestamos
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
                    <th>Estado</th>
                    <th>Usuarios</th>
                    <th>Dpto</th>
                    <th>Cancelar</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th>Prueba</th>
                    <th>Libro para probar la table</th>
                    <th>Reyes</th>
                    <th>PHP</th>
                    <th>Editorial PHP</th>
                    <th>2006</th>
                    <th>No</th>
                    <th>Malo</th>
                    <th>Consulta</th>
                    <th>Informática</th>
                    <th> <button class="btn btn-danger btn-lg btn-block text-white" name="cancelreser"
                        type="submit">Cancelar</button></th>
                    </th>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="accordion-item mt-3">
    <h2 class="accordion-header" id="headingone">
      <button class="accordion-button collapsed" id="desplegable" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseone" aria-expanded="false" aria-controls="collapseone">
        <strong class="text-center">Histórico de prestamos</strong>
      </button>
    </h2>
    <div id="collapseone" class="accordion-collapse collapse" aria-labelledby="headingone"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="table-responsive">
          <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered">
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
                  <th>Estado</th>
                  <th>Usuarios</th>
                  <th>Dpto</th>
                  <th>Disponible</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <th>Prueba</th>
                  <th>Libro para probar la table</th>
                  <th>Reyes</th>
                  <th>PHP</th>
                  <th>Editorial PHP</th>
                  <th>2006</th>
                  <th>No</th>
                  <th>Malo</th>
                  <th>Consulta</th>
                  <th>Informática</th>
                  <th>SI</th>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?

//Liberamos recurso
			mysqli_stmt_close($stmt);

//Cerramos conexión
			mysqli_close($c1);
		} else {
			$errorprofesor = true;
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
              <h3 class="mb-5">Soy Alumno</h3>
              <div class="form-outline mb-4 text-start">
                <label class="form-label" for="dnialum">DNI</label>
                <input type="text" id="dnialum" name="dnialum" class="form-control form-control-lg"
                  pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                  title="9 números y 1 letra" />
              </div>
              <div class="form-outline mb-4 text-start">
                <label class="form-label" for="nie">NIE</label>
                <input type="text" id="nie" name="nie" class="form-control form-control-lg" />
              </div>
              <?if (isset($error)) {?>
              <div class="alert alert-danger alert-dismissible fade show"
                <?php if ($error === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                id="error">
                <strong>Error!El dni o el nie no son correctos.</strong>
              </div>
              <?}?>
              <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
            <div class="card-body p-5 text-center">
              <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                  class="bi bi-person" viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg></h3>
              <h3 class="mb-5">Soy Profesor</h3>

              <div class="form-outline mb-4 text-start">
                <label class="form-label" for="dni">DNI</label>
                <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                  pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                  title="9 números y 1 letra" />
              </div>
              <?if (isset($errorprofesor)) {?>
              <div class="alert alert-danger alert-dismissible fade show"
                <?php if ($errorprofesor === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                id="errorprofesor">
                <strong>Error!Este dni no se encuentra registrado</strong>
              </div>
              <?}?>
              <button class="btn btn-primary btn-lg btn-block" name="accederprof" type="submit">Acceder</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
</div>

<script type="text/javascript" src="js/validar.js"></script>
<?
		}
	}

	?>




<?} else { 
	?>

<body>

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
                <h3 class="mb-5">Soy Alumno</h3>
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="dnialum">DNI</label>
                  <input type="text" id="dnialum" name="dnialum" class="form-control form-control-lg"
                    pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                    title="9 números y 1 letra" />
                </div>
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="nie">NIE</label>
                  <input type="text" id="nie" name="nie" class="form-control form-control-lg" />
                </div>
                <?if (isset($error)) {?>
                <div class="alert alert-danger alert-dismissible fade show"
                  <?php if ($error === false) {?>style="display:none" <?php } else {?>style="display:block" <?}?>
                  id="error">
                  <strong>Error!El dni o el nie no son correctos.</strong>
                </div>
                <?}?>
                <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
              <div class="card-body p-5 text-center">
                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 16 16">
                    <path
                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg></h3>
                <h3 class="mb-5">Soy Profesor</h3>

                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="dni">DNI</label>
                  <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                    pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                    title="9 números y 1 letra" />
                </div>
                <?if (isset($errorprofesor)) {?>
                <div class="alert alert-danger alert-dismissible fade show"
                  <?php if ($errorprofesor === false) {?>style="display:none" <?php } else {?>style="display:block"
                  <?}?>
                  id="errorprofesor">
                  <strong>Error!Este dni no se encuentra registrado en la biblioteca</strong>
                </div>
                <?}?>
                <button class="btn btn-primary btn-lg btn-block" name="accederprof" type="submit">Acceder</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
  </div>

  <script type="text/javascript" src="js/validar.js"></script>
</body>
<?}?>