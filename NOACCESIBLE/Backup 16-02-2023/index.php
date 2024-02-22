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

    <br>
    <h3 class="text-center bg-secondary text-white">Encuentra lo que buscas</h3>
    <br>
    <form method="post">
      <h1 class="text-center">Busca tu libro</h1>
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
              <option value="Electricidad y Electrónica">
              <option value="Instalación y Mantenimiento">
              <option value="Imagen y Sonido">
              <option value="Informática y Comunicaciones">
              <option value="Hostelería y Turismo">
              <option value="Agraria">
              <option value="Idiomas">
              <option value="Información y Orientación profesional">
              <option value="Orientación Educativa">
            </datalist>
          </div>
        </div>
      </div>
      <!-- Submit button -->
      <div class="text-center">
        <button type="submit" name="filtrar" class="btn btn-primary btn-lg btn-block mb-4">Filtrar</button>
      </div>
    </form>
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
                    <tbody>
                        <tr>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</body>