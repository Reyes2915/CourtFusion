<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <link rel="icon" href="imagenes/libros.jpg">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<?
include($_SERVER['DOCUMENT_ROOT'].'/NOACCESIBLE/credencialesdb.php');
if(isset($_POST['filtrar'])){
  $c1 = new mysqli($host, $dbuser, $dbpass) or die('Error de conexion a mysql: ' . $c1->error . '<br>');
  mysqli_query($c1, "CREATE DATABASE IF NOT EXISTS BibliotecaDelgadoR;");
  $c1->query("use BibliotecaDelgadoR ");
  $c1->query("Create table IF NOT EXISTS libros (ISBN INT(13),Titulo VARCHAR(100),Autor VARCHAR(100),Materia VARCHAR(30),Editorial VARCHAR(25),a_edicion VARCHAR(4),soporte_m enum('SI','NO'),Usuario enum('ALUMNO','PROFESOR','CONSULTA'),cod_dpto number(2),estado enum('BUENO','MALO'), PRIMARY KEY (ISBN))");
  mysqli_query($c1, "use libros");
  $stmt = $c1->prepare("INSERT INTO libros(DNI,Nombre,Apellidos,fecha,Repetidor,foto) VALUES (?, ?, ?, ?, ?, ?)");
}
?>
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-default">
      <a class="navbar-brand pull-left" href="index.php"><img id="logo" src="imagenes/logocifp.png"></a>
      <div class="navbar navbar-expand-lg d-block d-lg-block" id="paginas">
        
        </a>
        <ul class="navbar-nav ms-auto ms-2 ">
          <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
            <a href="https://educamosclm.castillalamancha.es/">
              <img src="imagenes/educamos.png" alt="Educamos" width="80" height="50">
            </a>

            <br>
            <span class="navbar-brand pull-left fs-6 ms-2">Educamos

</span>
          </li>
          <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
            <a href="https://delphos.jccm.es/delphos/jsp/pag_inicio1024.jsp">
              <img src="imagenes/delphos.png" alt="Delphos" width="80" height="50">
            </a>

            <br>
            <span class="navbar-brand pull-left fs-6 ms-2">Delphos

</span>
          </li>
          <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
            <a href="https://aulasfp2223.castillalamancha.es/">
              <img src="imagenes/elearning.png" alt="Fp" width="80" height="50">
            </a>

            <br>
         <span class="navbar-brand pull-left fs-6 ms-2">FP a distancia
            </a>
          </li>
          <li class="nav-item mt-5 me-5 d-inline d-lg-block">
            <a href="http://pop.jccm.es/acredita/">
              <img src="imagenes/acreditaCLM.png" alt="Acredita" width="80" height="50">
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
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
<section class="vh-100">
            <div class="container py-5 h-20">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg></h3>
                                <h3 class="mb-5">Soy Alumno</h3>
                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="dni">DNI</label>
                                    <input type="email" id="dni" name="dni" class="form-control form-control-lg" />
                                </div>
                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="nie">NIE</label>
                                    <input type="email" id="nie" name="nie" class="form-control form-control-lg" />
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg></h3>
                                <h3 class="mb-5">Soy Profesor</h3>

                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="dni">DNI</label>
                                    <input type="email" id="dni" name="dni" class="form-control form-control-lg" />
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" name="acceder" type="submit">Acceder</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
</body>
