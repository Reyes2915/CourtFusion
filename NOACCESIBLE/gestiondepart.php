<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="imagenes/libros.jpg">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
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

    <?
    include 'NOACCESIBLE/credencialesdb.php';
    if (isset($_POST['insertar'])) {
        $codigo = $_POST['coddpto'];
        $nombre = $_POST['nombre'];
        $centro = $_POST['centro'];
        $dni = $_POST['dni'];
        $contra = $_POST['contra'];
        //Hasheo la contraseña que introduce en el formulario e introduzco los datos en la base
        $hash = password_hash($_POST['contra'], PASSWORD_DEFAULT);
        $c1 = mysqli_connect($host, $usuario, $contraseña);
        mysqli_query($c1, "use BibliotecaDelgadoR");
        $stmt = mysqli_prepare($c1, "INSERT INTO departamentos values(?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "issss", $codigo, $nombre, $centro, $dni, $hash);
        if ($stmt->execute()) {
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
                                    <h5>Departamento correctamente insertado</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?
        } else {?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg></h3>
                                    <h5>Error insertando departamento</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
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
    if (isset($_POST['bajadepart'])) {
       /*  Saco el nombre del departamento a borrar con un formulario en el cual muestro en una lista
        que contiene los nombres de los departamentos que leo de la base de datos */
        $nombre = $_POST['dpto'];
        $c1 = mysqli_connect($host, $usuario, $contraseña);
        mysqli_query($c1, "use BibliotecaDelgadoR");
        $stmt = mysqli_prepare($c1, "DELETE FROM departamentos value WHERE nombre=?");
        mysqli_stmt_bind_param($stmt, "s", $nombre);
        if ($stmt->execute()) {
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
                                    <h5>Departamento borrado correctamente</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?
        } else {
            echo ("error:" . mysqli_error($c1)); ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg></h3>
                                    <h5>Error borrando departamento</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
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
    if (isset($_POST['modificar'])) {
        $codigo = $_POST['coddpto'];
        $nombre = $_POST['nombre'];
        $centro = $_POST['centro'];
        $dni = $_POST['dni'];
        $c1 = mysqli_connect($host, $usuario, $contraseña);
        mysqli_query($c1, "use BibliotecaDelgadoR");
       /*  Actualizo el departamento segun el nombre elegido con un formulario en el cual muestro en una lista
        que contiene los nombres de los departamentos que leo de la base de datos */
        $stmt = mysqli_prepare($c1, "UPDATE departamentos SET COD_DPTO=?,centro=?,DNI_JFP=? WHERE nombre=?");
        mysqli_stmt_bind_param($stmt, "isss", $codigo, $centro, $dni,$nombre);
        if ($stmt->execute()) {
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
                                    <h5>Departamento Actualizado correctamente</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?
        } else {
            echo ("error:" . mysqli_error($c1)); ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg></h3>
                                    <h5>Error modificando departamento</h5>
                                    <form method="post" action="gestiondepart.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
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
    }
    if (isset($_POST['alta']) || isset($_POST['baja']) || isset($_POST['modif']) || isset($_POST['insertar']) || isset($_POST['modificar']) || isset($_POST['bajadepart'])) {

        if (isset($_POST['alta'])) {

        ?><br>
            <form method="post" action="">
                <h1 class="text-center">Introduce el nuevo departamento</h1>
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline ms-5"><input type="text" id="coddpto" name="coddpto" class="form-control" required /><label class="form-label" for="coddpto">Código de Departamento</label></div>
                    </div>
                    <div class="col">
                        <div class="form-outline me-5"><input type="text" id="nombre" name="nombre" class="form-control" required /><label class="form-label" for="nombre">Nombre de Departamento</label></div>
                    </div>
                </div>
</div>
<div class="row mb-4">
    <div class="col">
        <div class="form-outline ms-5 ps-3"><input type="text" id="centro" name="centro" class="form-control" required /><label class="form-label" for="centro">Centro</label></div>
    </div>
    <div class="col">
        <div class="form-outline me-5 pe-3"><input type="text" id="dni" name="dni" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" title="9 números y 1 letra" class="form-control" required /><label class="form-label" for="dni">DNI Jefe
                de departamento</label></div>
    </div>
</div>
<div class="row mb-4">
    <div class="col columnacon">
        <div class="input-group">
            <input type="password" ID="txtPassword" name="contra" class="form-control" required />
            <div class="input-group-append">
                <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                    <span class="fa fa-eye-slash icon"></span> </button>
            </div>

        </div>
        <label class="form-label" for="contra">Contraseña</label>
    </div>
</div>
<br>
<div class="form-group">
    <div class="col-md-12 text-center">
        <div class="text-center d-inline"><button type="submit" name="insertar" class="btn botonancho btn-lg btn-block mb-4 me-2">Insertar Departamento</button></div>
        <div class="text-center d-inline">
            <button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-4 ms-2">Volver</button>
        </div>
    </div>
    </form>
</div>
</div>
<?
        }

        if (isset($_POST['baja'])) {
            $c1 = mysqli_connect($host, $usuario, $contraseña);
            mysqli_query($c1, "use BibliotecaDelgadoR");
            $stmt = mysqli_prepare($c1, "SELECT NOMBRE FROM departamentos");
            if ($stmt->execute()) {
            } else {
                echo ("No se ha podido añadir el alumno, error:" . mysqli_error($c1));
                //exit(-1);
            } ?>
    <div class="container">
        <section class="vh-300">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" id="carta">
                                <h1 class="mb-5">Selecciona el departamento a dar de baja</h1>
                                <form ACTION="" method="post" class="ms-2">

                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" list="departamento" name="dpto" autocomplete="off" class="form-control" />
                                            <label class="form-label" for="dpto"></label>
                                            <datalist id="departamento">
                                                <?
                                                $stmt->bind_result($col1);

                                                /* Muestro los nombres de laos departamentos en un option */
                                                while ($stmt->fetch()) {


                                                ?> <option value="<? echo $col1 ?>">
                                                    <? } ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <button class="btn botonancho btn-lg btn-block" name="bajadepart" type="submit">Dar de Baja
                                        el departamento</button>
                                    <div class="text-center d-inline">
                                        <a href="'.$_SERVER['HTTP_REFERER'].'"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
<?
        }
        if (isset($_POST['modif'])) {
            $c1 = mysqli_connect($host, $usuario, $contraseña);
            mysqli_query($c1, "use BibliotecaDelgadoR");
            $stmt = mysqli_prepare($c1, "SELECT NOMBRE FROM departamentos");
            if ($stmt->execute()) {
            }
?>
    <form method="post" action="">
        <h1 class="text-center">Introduce el departamento a modificar</h1>
        <h6 class="text-center ms-2">*Se actualizara el departamento en base al nombre de departamento elegido</h6>
        <div class="row mb-4 mt-2">
            <div class="col">
                <div class="form-outline ms-4"><input type="text" id="coddpto" name="coddpto" class="form-control" required /><label class="form-label" for="coddpto">Código de Departamento</label></div>
            </div>
            <div class="col">
                <div class="form-outline me-5 pe-3">
                    <input type="text" list="departamento" name="nombre" autocomplete="off" class="form-control" />
                    <label class="form-label" for="dpto">Nombre de Departamento</label>
                    <datalist id="departamento">
                        <?
                        $stmt->bind_result($col1);

                        /* Muestro los nombres de laos departamentos en un option */
                        while ($stmt->fetch()) {


                        ?> <option value="<? echo $col1 ?>">
                            <? } ?>
                    </datalist>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline ms-2 ps-3"><input type="text" id="centro" name="centro" class="form-control" required /><label class="form-label" for="centro">Centro</label></div>
            </div>
            <div class="col">
                <div class="form-outline me-5 pe-3"><input type="text" id="dni" name="dni" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" title="9 números y 1 letra" class="form-control" required /><label class="form-label" for="dni">DNI
                        Jefe
                        de departamento</label></div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <div class="text-center d-inline"><button type="submit" name="modificar" class="btn botonancho btn-lg btn-block mb-4 me-2">Modificar Departamento</button></div>
                <div class="text-center d-inline">
                    <button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-4 ms-2">Volver</button>
                </div>
            </div>
    </form><?
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
                                <h1 class="mb-5">Acciones Departamentos</h1>
                                <button class="btn botonancho btn-lg btn-block ms-3" name="alta" type="submit">Alta</button>
                                <button class="btn botonancho btn-lg btn-block ms-2 " name="baja" type="submit">Baja</button>
                                <button class="btn botonancho btn-lg btn-block ms-2 " name="modif" type="submit">Modificación</button>
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
<script type="text/javascript" src="js/validar.js"></script>