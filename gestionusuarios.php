<?php
if (isset($_POST['pdf'])) {
    include 'pdfusuarios.php';
}
session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Usuarios</title>
    <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
</head>

<?
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
}
include 'funciones.php';
mostrarNavbar();
if (isset($_POST['cerrarses'])) {
    session_destroy();
    header("Location: index.php");
}
if (isset($_POST['alta']) || isset($_POST['baja']) || isset($_POST['modificacion']) || isset($_GET['borrar']) || isset($_POST['individual']) || isset($_POST['masiva']) || isset($_POST['insertarmasiva']) || isset($_GET['modificar']) || isset($_POST['pdf']) || isset($_POST['excel']) || isset($_POST['altausuindi'])) {
    if (isset($_POST['alta'])) { ?>
        <form method="post" action="">
            <div class="container d-flex justify-content-end mt-3 me-2">
                <div class="card p-3">
                    <div class="media">
                        <div class="media-body">
                            <span class="mt-2 mb-0 h5 me-4">
                                <? echo $_SESSION['nom_usu'] ?></span></h5>
                            <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
            <div class="container">
                <section class="vh-300">
                    <div class="container h-50 mb-4">
                        <div class="row d-flex justify-content-center align-items-center h-50">
                            <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center" id="carta">
                                        <h1 class="mb-5">Alta Usuarios</h1><button class="btn botonancho btn-lg btn-block ms-3" name="individual" type="submit">Individual</button><button class="btn botonancho btn-lg btn-block ms-2 " name="masiva" type="submit">Masiva</button>
                                        <a href="perfil.php">
                                            <br>
                                            <br>
                                            <button class="btn botonancho btn-lg btn-block ms-2 " name="volver" type="button">Volver</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
        <? }
    if (isset($_POST['altausuindi'])) {
        $idusuarioindi = uniqid();
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseñausu = $_POST['contraseña'];
        $repetirContraseña = $_POST['repetirContraseña'];
        $rol = $_POST['rol'];
        $saldo = 0;
        if ($contraseñausu == $repetirContraseña) {
            include 'NOACCESIBLE/credencialesdb.php';
            $contraseñausudb = password_hash($contraseñausu, PASSWORD_DEFAULT);
            $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
            $stmt = mysqli_prepare($c1, "INSERT INTO usuarios values(?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssssss", $idusuarioindi, $nombre, $correo, $rol, $saldo, $contraseñausudb);
            if (mysqli_execute($stmt)) {
        ?>
                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-50">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                            </svg></h3>
                                        <h5>Usuario Insertado Correctamente</h5>
                                        <form method="post" action="gestionusuarios.php">
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
                ?>
                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-50">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                                <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg></h3>
                                        <h5>Error insertando Usuario</h5>
                                        <form method="post" action="gestionusuarios.php">
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
        }
    }

    if (isset($_POST['individual'])) {
        ?>
        <form method="post" action="" class="d-inline ms-2">
            <div class="container">
                <section class="vh-300">
                    <div class="container py-5 h-50">
                        <div class="row d-flex justify-content-center align-items-center h-50">
                            <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center" id="carta">
                                        <div class="form-outline flex-fill mb-4">
                                            <label class="form-label" for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" required aria-label="Nombre" aria-describedby="nombreHelp" placeholder="Escribe tu nombre completo" title="Nombre" autocomplete="off" />
                                            <small id="nombreHelp" class="form-text text-muted">Por favor, ingresa el nombre
                                                completo del usuario a registrar.</small>
                                        </div>

                                        <div class="form-outline flex-fill mb-4">
                                            <label class="form-label" for="correo">Correo Electrónico</label>
                                            <input type="email" name="correo" id="correo" class="form-control" required aria-label="Correo Electrónico" aria-describedby="correoHelp" placeholder="ejemplo@ejemplo.com" title="Correo Electrónico" autocomplete="off" />
                                            <small id="correoHelp" class="form-text text-muted">Por favor, ingresa el correo electrónico del usuario a registrar
                                                .</small>
                                        </div>
                                        <!--Rol select de usuario y administrador -->
                                        <div class="form-outline flex-fill mb-4">
                                            <select class="form-select" aria-label="Default select example" name="rol" id="rol">
                                                <option selected>Selecciona el rol del usuario</option>
                                                <option value="usuario">Usuario</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                            <small id="correoHelp" class="form-text text-muted">Por favor, ingresa el rol del usuario a registrar
                                                .</small>
                                        </div>


                                        <div class="mb-4">

                                            <label class="form-label" for="contraseña">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="contraseña" id="contraseña" class="form-control" required aria-label="Contraseña" aria-describedby="contraseñaHelp" placeholder="********" title="Contraseña" autocomplete="off" />
                                                <button type="button" id="mostrarContraseñaBoton" class="btn btn-outline-secondary">
                                                    <i class="fa fa-eye-slash" id="mostrarContraseña" style="cursor: pointer; line-height: 1;" aria-hidden="true" title="Mostrar Contraseña"></i>
                                                </button>
                                            </div>
                                            <small id="contraseñaHelp" class="form-text text-muted">Introduce la contraseña.</small>
                                        </div>

                                        <div class="form-outline flex-fill mb-4">
                                            <label class="form-label" for="repetirContraseña">Repite la Contraseña</label>
                                            <input type="password" name="repetirContraseña" id="repetirContraseña" class="form-control" required aria-label="Repetir Contraseña" aria-describedby="repetirContraseñaHelp" placeholder="********" title="Repetir Contraseña" autocomplete="off" />
                                            <small id="repetirContraseñaHelp" class="form-text text-muted">Por favor, repite la contraseña
                                                para confirmarla.</small>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn botonancho btn-lg btn-block ms-2 " name="altausuindi" type="submit">Dar de alta usuario</button>

                                            <a href="gestionusuarios.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
                                        </div>


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

    if (isset($_POST['masiva'])) {
    ?>
        <form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
            <div class="container">
                <section class="vh-300">
                    <div class="container py-5 h-50">
                        <div class="row d-flex justify-content-center align-items-center h-50">
                            <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center" id="carta">
                                        <h1 class="mb-5">Inserta el archivo para dar de alta a los usuarios</h1>
                                        <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                            </svg></h3>
                                        <label class="form-label" for="archivoInput">Archivo para dar de alta usuarios</label>
                                        <input type="file" name="archivo" class="mt-3 mb-3" id="archivoInput" required>
                                        <br>

                                        <button class="btn botonancho btn-lg btn-block " name="insertarmasiva" type="submit" id="insertarmasiva">Insercion
                                            Masiva</button>



                                        <button class="btn botonancho btn-lg btn-block " name="volver" id="volver" type="submit">Volver</button>

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
    if (isset($_POST['insertarmasiva'])) {
        $tmp_name = $_FILES['archivo']['tmp_name'];
        $c1 = mysqli_connect($host, $usuario, $contraseña, 'PistasDelgadoR');

        // Introduce the values of the CSV into a two-dimensional array
        $file = fopen($tmp_name, "r");
        $filas = [];
        while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
            $filas[] = $data;
        }

        // Check if the headers match the table structure
        $headers = explode(';', $filas[0][0]);
        $expectedHeaders = ['id_usuario', 'nombre', 'correo', 'rol', 'saldo', 'contrasena'];
        if ($headers !== $expectedHeaders) {
            // Incorrect headers, display an error message
        ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                            <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708z" />
                                        </svg>
                                    </h3>
                                    <h5>Las cabeceras del archivo CSV no son correctas</h5>
                                    <form method="post" action="gestionusuarios.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        } else {
            // Headers are correct, proceed with data insertion
            $array = [];
            $file = fopen($tmp_name, "r");
            $row = 0;
            while ($fila = fgetcsv($file, 0, ";")) {
                $row++;
                if ($row == 1) {
                    continue; // Skip the header row
                } else {
                    $stmt = mysqli_prepare($c1, "INSERT IGNORE INTO usuarios VALUES(?,?,?,?,?,?)");
                    mysqli_stmt_bind_param($stmt, "sssses", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);

                    if ($stmt->execute()) {
                        // Insert success message
            ?>
                        <section class="vh-100">
                            <div class="container py-5 h-100">
                                <div class="row d-flex justify-content-center align-items-center h-50">
                                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                        <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                                            <div class="card-body p-5 text-center">
                                                <h3 class="mb-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                    </svg>
                                                </h3>
                                                <h5>Usuarios Insertado Correctamente</h5>
                                                <form method="post" action="gestionusuarios.php">
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
                        // Insert failure message
                        $error = mysqli_error($c1);
                        $numerror = mysqli_errno($c1);
                        $array[] = $error;
                    ?>

                        <section class="vh-100">
                            <div class="container py-5 h-100">
                                <div class="row d-flex justify-content-center align-items-center h-50">
                                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                        <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                            <div class="card-body p-5 text-center">
                                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                                        <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg></h3>
                                                <h5>Error Insertando Usuarios</h5>
                                                <form method="post" action="gestionusuarios.php">
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
                }
            }
        }
    }

    if (isset($_POST['baja'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $stmt = mysqli_prepare($c1, "SELECT id_usuario,nombre,correo,rol FROM usuarios");
        $stmt->execute();
        mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rcorreo, $rrol);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Usuarios
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Borrar Usuario?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <th><? echo $rid ?></th>
                                <th><? echo $rnombre ?></th>
                                <th><? echo $rcorreo ?></th>
                                <th><? echo $rrol ?></th>
                                <th>
                                    <div class="text-center">
                                        <a href="gestionusuarios.php?borrar=borrar&idusuario=<?php echo urlencode($rid); ?>">
                                            <button type="submit" id="borrar" name="borrar" value="borrar" class="btn btn-danger btn-lg btn-block  ms-2"> Borrar</button></a>
                                    </div>
                                </th>
                            <? } ?>
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="perfil.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2 mb-2">Volver</button></a>
        </div>

        <?
    }

    if (isset($_GET['borrar'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $idusuario = $_GET['idusuario'];
        echo $idusuario;
        $stmt = mysqli_prepare($c1, "DELETE FROM usuarios WHERE id_usuario=?");
        $stmt->bind_param("s", $idusuario);
        if ($stmt->execute()) {
        ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg></h3>
                                    <h5>Usuario Borrado Correctamente</h5>
                                    <form method="post" action="gestionusuarios.php">
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
            ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                            <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg></h3>
                                    <h5>Error borrando Usuario</h5>
                                    <form method="post" action="gestionusuarios.php">
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
    }
    if (isset($_POST['modificacion'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $stmt = mysqli_prepare($c1, "SELECT id_usuario,nombre,correo,rol FROM usuarios");
        $stmt->execute();
        mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rcorreo, $rrol);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Usuarios
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Usuarios</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Modificar Usuario?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <form action="gestionusuarios.php" method="get">
                                    <th>
                                        <label for="ridusu" style="display: none;">Id de Usuario:</label>
                                        <? echo $rid ?>
                                    </th>
                                    <th>
                                        <label for="rnombreusu_<?php echo $rid; ?>" class="visually-hidden">Nombre de Usuario:</label>
                                        <input type="text" name="rnombreusu" id="rnombreusu_<?php echo $rid; ?>" value="<?php echo $rnombre; ?>" required>
                                        <div style="display: none;"><?php echo $rnombre; ?></div>
                                    </th>

                                    </th>


                                    <th>
                                        <label for="rcorreousu_<?php echo $rid; ?>" class="visually-hidden">Correo de usuario</label>
                                        <input type="text" name="rcorreousu" id="rcorreousu_<?php echo $rid; ?>" value="<?php echo $rcorreo; ?>" required>
                                    </th>
                                    <th>
                                        <label for="rrolusu_<?php echo $rid; ?>" class="visually-hidden">Rol del usuario</label>
                                        <input type="text" name="rrolusu" id="rrolusu_<?php echo $rid; ?>" value="<?php echo $rrol; ?>" required>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <button type="submit" id="modificar_<?php echo $rid; ?>" name="modificar" value="borrar" class="btn btn-info btn-lg btn-block  ms-2">Modificar</button>
                                        </div>
                                    </th>

                                    <input type="hidden" name="ridusu" value="<? echo $rid ?>">
                                </form>

                            </tr>
                        <? } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="gestionusuarios.php">
                <label for="volver">Volver</label>
                <button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2 mb-2">Volver</button></a>
        </div>

        <?
    }
    if (isset($_GET['modificar'])) {
        $idusu = $_GET['ridusu'];
        $nombreusu = $_GET['rnombreusu'];
        $correousu = $_GET['rcorreousu'];
        $rolusu = $_GET['rrolusu'];
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        if ($stmt = mysqli_prepare($c1, "UPDATE usuarios SET nombre=?,correo=?,rol=? WHERE id_usuario=?")) {
        } else {
            echo ("error:" . mysqli_error($c1));
        }
        if (mysqli_stmt_bind_param($stmt, "ssss", $nombreusu, $correousu, $rolusu, $idusu)) {
        } else {
            echo ("errowdr:" . mysqli_error($c1));
        }
        if ($stmt->execute()) {
        } else {
            echo ("errorsd:" . mysqli_error($c1));
        }
        if ($stmt->execute()) {
        ?>
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle check" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg></h3>
                                    <h5>Datos del Usuario actualizados correctamente</h5>
                                    <form method="post" action="gestionusuarios.php">
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
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                            <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg></h3>
                                    <h5>Error modificando Usuario</h5>
                                    <form method="post" action="gestionusuarios.php">
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


    if (isset($_POST['excel'])) {
        include 'excel/excelusuarios.php';
    }
} else {
    ?>
    <form method="post" action="">
        <div class="container d-flex justify-content-end mt-3 me-2">
            <div class="card p-3">
                <div class="media">
                    <div class="media-body">
                        <span class="mt-2 mb-0 h5 me-4">
                            <? echo $_SESSION['nom_usu'] ?></span></h5>
                        <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
        <div class="container">
            <section class="vh-300">
                <div class="container py-3 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center" id="carta">
                                    <h1 class="mb-5">Acciones sobre los usuarios</h1>
                                    <button class="btn botonancho btn-lg btn-block ms-2" name="alta" type="submit">Alta</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="baja" type="submit">Baja</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="modificacion" type="submit">Modificacion</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="pdf" type="submit">PDF</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="excel" type="submit">Excel</button>

                                    <br>
                                    <br>
                                    <a href="perfil.php">
                                        <button class="btn botonancho btn-lg btn-block ms-2 " name="volver" type="button">Volver</button></a>
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
mostrar_footer();
?>

<script type="text/javascript" src="js/validar.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/tabla.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>