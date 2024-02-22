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
</head>
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-default ">
      <a class="navbar-brand pull-left" href="index.php"><img id="logo" src="imagenes/logocifp.png"></a>
      <div class="navbar navbar-expand-lg" id="paginas">

        </a>
        <ul class="navbar ms-auto">
          <li class="nav-item">
            <a href="https://educamosclm.castillalamancha.es/">
              <img src="imagenes/educamos.png" alt="Educamos" class="imagengrande" width="80" height="50">
            </a>

            <br>
            <span class="navbar-brand pull-left fs-6 ms-2">Educamos

            </span>
          </li>
          <li class="nav-item">
            <a href="https://delphos.jccm.es/delphos/jsp/pag_inicio1024.jsp">
              <img src="imagenes/delphos.png" alt="Delphos" class="imagengrande" width="80" height="50">
            </a>

            <br>
            <span class="navbar-brand pull-left fs-6 ms-2">Delphos

            </span>
          </li>
          <li class="nav-item">
            <a href="https://aulasfp2223.castillalamancha.es/">
              <img src="imagenes/elearning.png" class="imagengrande" alt="Fp" width="80" height="50">
            </a>

            <br>
            <span class="navbar-brand pull-left fs-6 ms-2">FP a distancia
              </a>
          </li>
          <li class="nav-item">
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
    </nav>
    <h1 class="text-center mt-2">Encuentra lo que buscas</h1>
        <section>
            <div class="container">
                            <div class="card-body text-center">
                            <div class="form-outline text-start">
                                    <label class="form-label" for="idtitulo">Titulo</label>
                                    <input type="text" id="idtitulo" name="titulo" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="idautor">Autor</label>
                                    <input type="text" id="idautor" class="form-control form-control-lg" />
                                    <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="idmateria">materia</label>
                                    <input type="text" id="idmateria" name="materia" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="idusuario">Usuario</label>
                                    <input type="text" id="idusuario" name="usu" class="form-control form-control-lg" />
                                </div>
                                <div class="form-outline mb-4 text-start">
                                    <label class="form-label" for="typeEmailX-2">Departamento</label>
                                    <input type="text" id="idepartamento" name="depart" class="form-control form-control-lg" />
                                    <div class="text-center">
        <button type="submit" name="buscar" class="btn btn-primary btn-lg btn-block mt-3">Buscar</button>
      </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
  
  </div>
</body>