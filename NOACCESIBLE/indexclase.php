<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <link rel="icon" href="imagenes/libros.jpg">
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-default">
      <a class="navbar-brand pull-left" href="#"><img id="logo" src="imagenes/logocifp.png"></a>
      <div class="navbar navbar-expand-lg" id="paginas">
        </a>
        <ul class="navbar-nav ms-auto ms-2 ">
          <li class="nav-item me-5 mt-5 ms-2">
            <a href="https://educamosclm.castillalamancha.es/">
              <img src="imagenes/educamos.png" alt="Educamos" width="80" height="50">
            </a>

            <br>
            <a class="navbar-brand pull-left">Educamos

            </a>
          </li>
          <li class="nav-item me-5 mt-5 ms-2">
            <a href="https://delphos.jccm.es/delphos/jsp/pag_inicio1024.jsp">
              <img src="imagenes/delphos.png" alt="Delphos" width="80" height="50">
            </a>

            <br>
            <a class="navbar-brand pull-left">Delphos

            </a>
          </li>
          <li class="nav-item me-5 mt-5 ms-2">
            <a href="https://aulasfp2223.castillalamancha.es/">
              <img src="imagenes/elearning.png" alt="Fp" width="80" height="50">
            </a>

            <br>
            <a class="navbar-brand pull-left">FP a distancia
            </a>
          </li>
          <li class="nav-item mt-5 ms-2">
            <a href="http://pop.jccm.es/acredita/">
              <img src="imagenes/acreditaCLM.png" alt="Acredita" width="80" height="50">
            </a>

            <br>
            <a class="navbar-brand pull-left fs-1 fs-md-3">Acredita
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <br>
    <nav class="navbar navbar-expand-lg" id="menu">
      <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-center">
          <ul class="nav justify-content-center">
            <li class="nav-item  ms-3 me-3">
              <a class="nav-link ms-3" href="#">Libros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-3" href="#">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-3" href="#">Administración</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <h3 class="text-center bg-secondary text-white">Encuentra lo que buscas</h3>
    <br>
    <form>
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
        <button type="submit" name="filtrar" class="btn btn-primary btn-block mb-4">Filtrar</button>
      </div>
      
  </div>
</body>