<?php
if (isset($_POST['pdf'])) {
    include 'pdfempresas.php';
}
session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Empresas</title>
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
if (isset($_POST['cerrarses'])) {
    session_destroy();
    header("Location: index.php");
}
include 'funciones.php';
mostrarNavbar();
if (isset($_POST['alta']) || isset($_POST['baja']) || isset($_POST['modificacion']) || isset($_GET['borrar']) || isset($_POST['individual']) || isset($_POST['masiva']) || isset($_POST['insertarmasiva']) || isset($_GET['modificar']) || isset($_POST['pdf']) || isset($_POST['excel']) || isset($_POST['altaempresa'])) {
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
                                        <h1 class="mb-5">Alta Empresas</h1><button class="btn botonancho btn-lg btn-block ms-3" name="individual" type="submit">Individual</button><button class="btn botonancho btn-lg btn-block ms-2 " name="masiva" type="submit">Masiva</button>
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
    if (isset($_POST['altaempresa'])) {
        $idempresa = uniqid();
        $nombre_empresa = $_POST['nombre_empresa'];
        $correo_contacto = $_POST['correo_contacto'];
        $telefono_contacto = $_POST['telefono_contacto'];
        $comunidad_autonoma = $_POST['comunidades'];
        $provincia = $_POST['provincias'];
        $municipio = $_POST['municipios'];
        $direccion = $_POST['direccion'];
        $codigo_postal = $_POST['codigo_postal'];
        $contrasena = $_POST['contrasena'];
        $repetirContrasena = $_POST['repetirContraseña'];
        if ($contrasena == $repetirContrasena) {
            include 'NOACCESIBLE/credencialesdb.php';
            $contraseñausudb =  password_hash($contrasena, PASSWORD_DEFAULT);
            $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
            $stmt = mysqli_prepare($c1, "INSERT INTO empresas values(?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssssssssss", $idempresa, $nombre_empresa, $correo_contacto, $telefono_contacto, $comunidad_autonoma, $provincia, $municipio, $direccion, $codigo_postal, $contraseñausudb);
            if (mysqli_stmt_execute($stmt)) {
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
                                        <h5>Empresa Insertada Correctamente</h5>
                                        <form method="post" action="gestionempresas.php">
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
                                        <h5>Error insertando Empresa</h5>
                                        <form method="post" action="gestionempresas.php">
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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="nombre_empresa">Nombre de la Empresa</label>
                                                    <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" required aria-label="Nombre de la Empresa" placeholder="Ingrese el nombre de la empresa" title="Nombre de la Empresa" autocomplete="off" />
                                                    <small id="nombre_empresaHelp" class="form-text text-muted">Por favor, ingrese el nombre de la empresa.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="correo_contacto">Correo de Contacto</label>
                                                    <input type="email" name="correo_contacto" id="correo_contacto" class="form-control" required aria-label="Correo de Contacto" placeholder="ejemplo@empresa.com" title="Correo de Contacto" autocomplete="off" />
                                                    <small id="correo_contactoHelp" class="form-text text-muted">Por favor, ingrese el correo de contacto de la empresa.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="telefono_contacto">Teléfono de Contacto</label>
                                                    <input type="tel" name="telefono_contacto" id="telefono_contacto" class="form-control" required aria-label="Teléfono de Contacto" placeholder="Ingrese el teléfono de contacto" title="Teléfono de Contacto" autocomplete="off" />
                                                    <small id="telefono_contactoHelp" class="form-text text-muted">Por favor, ingrese el teléfono de contacto de la empresa.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="comunidad_autonoma">Comunidad Autónoma</label>
                                                    <select class="form-select" id="comunidades" name="comunidades" title="comunidades">
                                                        <option selected disabled>Seleccione la Comunidad Autónoma</option>
                                                        <!-- Las opciones se agregarán aquí -->
                                                    </select>
                                                    <small id="comunidad_autonomaHelp" class="form-text text-muted">Por favor, ingrese la comunidad autónoma de la empresa.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="provincia">Provincia</label>
                                                    <select class="form-select" id="provincias" name="provincias" title="provincias" disabled>
                                                        <option selected disabled>Seleccione la Provincia</option>
                                                        <!-- Las opciones se agregarán aquí -->
                                                    </select>
                                                    <small id="provinciaHelp" class="form-text text-muted">Por favor, ingrese la provincia de la empresa.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="municipio">Municipio</label>
                                                    <select class="form-select" id="municipios" name="municipios" title="municipios" disabled>
                                                        <option selected disabled>Seleccione el Municipio</option>
                                                    </select>
                                                    <small id="municipioHelp" class="form-text text-muted">Por favor, ingrese el municipio de la empresa.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="direccion">Dirección</label>
                                                    <input type="text" name="direccion" id="direccion" class="form-control" required aria-label="Dirección" placeholder="Ingrese la dirección" title="Dirección" autocomplete="off" />
                                                    <small id="direccionHelp" class="form-text text-muted">Por favor, ingrese la dirección de la empresa.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="codigo_postal">Código Postal</label>
                                                    <input type="text" name="codigo_postal" id="codigo_postal" class="form-control" required pattern="\d{5}" aria-label="Código Postal" placeholder="Ingrese el código postal" title="Código Postal" autocomplete="off" />
                                                    <small id="codigo_postalHelp" class="form-text text-muted">Por favor, ingrese el código postal de la empresa.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="contrasena">Contraseña</label>
                                                    <input type="password" name="contrasena" id="contrasena" class="form-control" required aria-label="Contraseña" placeholder="********" title="Contraseña" autocomplete="off" />
                                                    <small id="contrasenaHelp" class="form-text text-muted">Introduce la contraseña.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline flex-fill mb-4">
                                                    <label class="form-label" for="repetirContraseña">Repite la Contraseña</label>
                                                    <input type="password" name="repetirContraseña" id="repetirContraseña" class="form-control" required aria-label="Repetir Contraseña" aria-describedby="repetirContraseñaHelp" placeholder="********" title="Repetir Contraseña" autocomplete="off" />
                                                    <small id="repetirContraseñaHelp" class="form-text text-muted">Por favor, repite la contraseña
                                                        para confirmarla.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add more rows for the remaining fields -->

                                        <br>
                                        <div class="text-center">
                                            <button class="btn botonancho btn-lg btn-block ms-2" name="altaempresa" type="submit">Registrar Empresa</button>

                                            <a href="gestionempresas.php"><button type="button" id="volver" name="volver" class="btn botonancho btn-lg btn-block ms-2">Volver</button></a>
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
                                        <h1 class="mb-5">Inserta el archivo para dar de alta a las Empresas</h1>
                                        <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                            </svg></h3>

                                        <input type="file" name="archivo" id="archivoInput" class="mt-3 mb-3" required>
                                        <br>

                                        <button class="btn botonancho btn-lg btn-block "  name="insertarmasiva" type="submit" id="insertarmasiva">Insercion
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
    fclose($file);

    // Check if the headers match the table structure for "empresas"
    $headers = explode(';', $filas[0][0]);
    $expectedHeaders = ['id_empresa', 'nombre_empresa', 'correo_contacto', 'telefono_contacto', 'comunidad_autonoma', 'provincia', 'municipio', 'direccion', 'codigo_postal', 'contrasena'];
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                        class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                    </svg>
                                </h3>
                                <h5>Las cabeceras del archivo CSV no son correctas</h5>
                                <form method="post" action="gestionempresas.php">
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
                $stmt = mysqli_prepare($c1, "INSERT IGNORE INTO empresas VALUES(?,?,?,?,?,?,?,?,?,?)");
                mysqli_stmt_bind_param($stmt, "ssssssssss", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6], $fila[7], $fila[8], $fila[9]);

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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                    fill="currentColor" class="bi bi-check-circle check"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                </svg>
                                            </h3>
                                            <h5>Empresas Insertadas Correctamente</h5>
                                            <form method="post" action="gestionempresas.php">
                                                <button class="btn btn-lg btn-block btn btn-light" name="inicio"
                                                    type="submit">Volver</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
<?php
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
                                                <h5>Error Insertando Empresas</h5>
                                                <form method="post" action="gestionempresas.php">
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
        $stmt = mysqli_prepare($c1, "SELECT id_empresa,nombre_empresa,correo_contacto,telefono_contacto,municipio FROM empresas");
        $stmt->execute();
        mysqli_stmt_bind_result($stmt, $rid, $rnombre,  $rcorreo, $rtelefono, $rmunicipio);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Empresas
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Municipio</th>
                            <th>Borrar Empresa?</th>
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
                                <th><? echo $rtelefono ?></th>
                                <th><? echo $rmunicipio ?></th>
                                <th>
                                    <div class="text-center">
                                        <a href="gestionempresas.php?borrar=borrar&idempresa=<?php echo urlencode($rid); ?>">
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
            <a href="gestionempresas.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-2  ms-2">Volver</button></a>
        </div>

        <?
    }

    if (isset($_GET['borrar'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $idempresa = $_GET['idempresa'];
        //Primero borramos todas las pistas de la empresa
        $stmt2 = mysqli_prepare($c1, "DELETE FROM pistas WHERE id_empresa=?");
        mysqli_stmt_bind_param($stmt2, "s", $idempresa);
        $stmt2->execute();
        //Borramos la empresa
        $stmt = mysqli_prepare($c1, "DELETE FROM empresas WHERE id_empresa=?");
        mysqli_stmt_bind_param($stmt, "s", $idempresa);
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
                                    <h5>Empresa Borrada Correctamente</h5>
                                    <form method="post" action="gestionempresas.php">
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
                                    <h5>Error borrando Empresa</h5>
                                    <form method="post" action="gestionempresa.php">
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
        $stmt = mysqli_prepare($c1, "SELECT id_empresa,nombre_empresa,correo_contacto,telefono_contacto,comunidad_autonoma,provincia,municipio,direccion,codigo_postal FROM empresas");
        $stmt->execute();
        mysqli_stmt_bind_result($stmt,  $rid, $rnombre,  $rcorreo, $rtelefono, $rcomunidad, $rprovincia, $rmunicipio, $rdireccion, $rcodigo);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Empresas
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Comunidad Autónoma</th>
                            <th>Provincia</th>
                            <th>Municipio</th>
                            <th>Dirección</th>
                            <th>Código Postal</th>


                            <th>Modificar Empresa?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <form action="gestionempresas.php" method="get">
                                    <th>
                                        <input type="text" name="rnombre" value="<? echo $rnombre ?>" required>
                                        <div style="display: none;">
                                            <? echo $rnombre ?>
                                        </div>

                                    </th>
                                    <th>
                                        <input type="text" name="rcorreo" value="<? echo $rcorreo ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rtelefono" value="<? echo $rtelefono ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rcomunidad" value="<? echo $rcomunidad ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rprovincia" value="<? echo $rprovincia ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rmunicipio" value="<? echo $rmunicipio ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rdireccion" value="<? echo $rdireccion ?>" required>
                                    </th>
                                    <th>
                                        <input type="text" name="rcodigo" value="<? echo $rcodigo ?>" required>
                                    </th>

                                    <th>
                                        <div class="text-center">

                                            <button type="submit" id="modificar" name="modificar" value="borrar" class="btn btn-info btn-lg btn-block  ms-2">Modificar</button>
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
            <a href="gestionempresas.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-2  ms-2">Volver</button></a>
        </div>

        <?
    }
    if (isset($_GET['modificar'])) {
        $idusu = $_GET['ridusu'];
        $nombreusu = $_GET['rnombre'];
        $correousu = $_GET['rcorreo'];
        $telefonousu = $_GET['rtelefono'];
        $comunidadusu = $_GET['rcomunidad'];
        $provinciausu = $_GET['rprovincia'];
        $municipiousu = $_GET['rmunicipio'];
        $direccionusu = $_GET['rdireccion'];
        $codigousu = $_GET['rcodigo'];
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        if ($stmt = mysqli_prepare($c1, "UPDATE empresas SET nombre_empresa=?,correo_contacto=?,telefono_contacto=?,comunidad_autonoma=?,provincia=?,municipio=?,direccion=?,codigo_postal WHERE id_empresa=?")) {
        } else {
            echo ("error:" . mysqli_error($c1));
        }
        if (mysqli_stmt_bind_param($stmt,  "ssssssss", $nombreusu, $correousu, $telefonousu, $comunidadusu, $provinciausu, $municipiousu, $direccionusu, $codigousu, $idusu)) {
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
                                    <h5>Datos de la empresa actualizados correctamente</h5>
                                    <form method="post" action="gestionempresas.php">
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
                                    <h5>Error modificando Empresa</h5>
                                    <form method="post" action="gestionempresas.php">
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
        include 'excel/excelempresas.php';
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
                                    <h1 class="mb-5">Acciones sobre las empresas</h1>
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
<script src="js/buscarMunicipio.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>