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
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
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
//include($_SERVER['DOCUMENT_ROOT'].'/NOACCESIBLE/credencialesdb.php');
if(isset($_POST['acceder'])){

?>
<div class="container">
        <section class="vh-300">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" id="carta">
                                <h1 class="mb-5">Acciones</h1>
                                    <form method="post" action="" class="d-inline ms-2">
                                        <button class="btn botonancho btn-lg btn-block " name="inicializar"
                                            type="submit">Inicializar Biblioteca</button>
                                    </form>

                                    <form method="post" action="" class="d-inline ms-2">
                                        <button class="btn botonancho btn-lg btn-block " name="gestionusu"
                                            type="submit">Gestion Usuarios</button>
                                    </form>

                                    <form method="post" action=" " class="d-inline ms-2">
                                        <button class="btn botonancho btn-lg btn-block " name="gestiondepar"
                                            type="submit">Gestion Departamentos</button>
                                    </form>

                                    <form method="post" action="backup.php" class="d-inline ms-2">
                                        <button class="btn botonancho btn-lg btn-block " name="backup"
                                            type="submit">Backup</button>
                                    </form>

                                    <form method="post" action="" class="d-inline ms-2">
                                        <button class="btn botonancho btn-lg btn-block" name="reset" type="submit">Reset
                                            Credenciales</button>
                                    </form>
                                    <form method="post" action="index.php" class="d-block mt-5">
                                        <button class="btn botonancho btn-lg btn-block" name="volver" type="submit">Volver al Inicio</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
        <?}else{
?>

    <body>
       
            <section class="vh-100">
                <div class="container py-5 h-20">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;" id="carta">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                            fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path
                                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        </svg></h3>
                                    <form method="post" action="">
                                        <h3 class="mb-5">Identifiquese</h3>
                                        <div class="form-outline mb-4 text-start">
                                            <label class="form-label" for="dni">DNI</label>
                                            <input type="email" id="dni" name="dni"
                                                class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4 text-start">
                                            <label class="form-label" for="Contraseña">Contraseña</label>
                                            <input type="email" id="Contraseña" name="Contraseña"
                                                class="form-control form-control-lg" />
                                        </div>
                                        <button class="btn botonancho btn-lg btn-block" name="acceder"
                                            type="submit">Acceder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?}?>
    </body>