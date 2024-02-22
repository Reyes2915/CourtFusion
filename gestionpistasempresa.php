<?php session_start();
if (isset($_POST['pdf'])) {
    include 'pdfpistasempresa.php';
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Pistas</title>
    <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/standalone.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/clockpicker.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
</head>

<?
//Si no existe la sesión de empresa ni la de administrador, redirecciona a la página index.php
if ((!isset($_SESSION['isAdmin']) && (!isset($_SESSION['isEmpresa'])))) {
    header("location: index.php");
}
if (isset($_POST['cerrarses'])) {
    session_destroy();
    header("Location: index.php");
}
include 'funciones.php';
mostrarNavbar();
if (isset($_POST['alta']) || isset($_POST['baja']) || isset($_POST['modificacion']) || isset($_GET['borrar']) || isset($_POST['individual']) || isset($_POST['masiva']) || isset($_POST['insertarmasiva']) || isset($_GET['modificar']) || isset($_POST['pdf']) || isset($_POST['altapistaindi'])) {
    if (isset($_POST['alta'])) { ?>
        <form method="post" action="">
            <div class="container d-flex justify-content-end mt-3 me-2">
                <div class="card p-3">
                    <div class="media">
                        <div class="media-body">
                            <span class="mt-2 mb-0 h5 me-4">
                                <? echo $_SESSION['nom_empresa'] ?></span></h5>
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
                                        <h1 class="mb-5">Alta Pistas</h1><button class="btn botonancho btn-lg btn-block ms-3" name="individual" type="submit">Individual</button><button class="btn botonancho btn-lg btn-block ms-2 " name="masiva" type="submit">Masiva</button>
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
    if (isset($_POST['altapistaindi'])) {
        $carpetaDestino = './imagenes/pistasporvalidar/';

        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        $imagenPista = $_FILES['imagenPista']['name'];
        $rutaTemp = $_FILES['imagenPista']['tmp_name'];
        $nombrePista = $_POST['nombrePista']; // Asegúrate de que esta variable esté definida
        include "NOACCESIBLE/credencialesdb.php";

        $tipoPista = $_POST['tipoPista'];
        $nombrePista = $_POST['nombrePista'];
        $comunidad = $_POST['comunidades'];
        $provincia = $_POST['provincias'];
        $municipio = $_POST['municipios'];
        $codigoPostal = $_POST['codigoPostal'];
        $telefonoContacto = $_POST['telefonoContacto'];
        $correoContacto = $_POST['correoContacto'];
        $precioHora = $_POST['precioHora'];
        $horaApertura = $_POST['horaapertura'];
        $horaCierre = $_POST['horacierre'];
        $direccion = $_POST['direccion'];
        //Convertir a formato time hh:mm:ss la hora de apertura y cierre para poder insertarla en la base de datos
        $horaApertura = date("H:i:s", strtotime($horaApertura));
        $horaCierre = date("H:i:s", strtotime($horaCierre));
        $idPista = uniqid();
        $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c1->error . '<br>');

        // Obtener la fecha y hora actual en el formato correcto
        $fechaRegistro = date("Y-m-d H:i:s");
        $tipoPista = str_replace('-', ' ', $tipoPista);
        $comunidad = str_replace('-', ' ', $comunidad);
        $provincia = str_replace('-', ' ', $provincia);
        $municipio = str_replace('-', ' ', $municipio);
        $correoContacto = str_replace('-', ' ', $correoContacto);
        $idPista = str_replace('-', ' ', $idPista);
        // Insertar los datos en la tabla
        if ($stmt = mysqli_prepare($conexion, "INSERT INTO pistas (id_pista,tipo_pista,nombre_pista,comunidad_autonoma,provincia,municipio,direccion,codigo_postal,correo_contacto,telefono_contacto,precio_hora,hora_apertura,hora_cierre,fecha_registro,id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        } else {
            echo  "ERROS EN EL PARAM" . $conexion->error;
        }

        // Enlazar los parámetros con los valores de las variables
        if (mysqli_stmt_bind_param($stmt, "sssssssssssssss", $idPista, $tipoPista, $nombrePista, $comunidad, $provincia, $municipio, $direccion, $codigoPostal, $correoContacto, $telefonoContacto, $precioHora, $horaApertura, $horaCierre, $fechaRegistro, $_SESSION['id_empresa'])) {
        } else {
            echo  "ERROS EN EL PARAM" . $conexion->error;
        }
        if (mysqli_stmt_execute($stmt)) {
            $tipoPista = str_replace('-', ' ', $tipoPista);
            $comunidad = str_replace('-', ' ', $comunidad);
            $provincia = str_replace('-', ' ', $provincia);
            $municipio = str_replace('-', ' ', $municipio);
            $correoContacto = str_replace('-', ' ', $correoContacto);
            $idPista = str_replace('-', ' ', $idPista);
            $nuevoNombreArchivo = $carpetaDestino . $nombrePista . "($tipoPista-$comunidad-$provincia-$municipio-$correoContacto-$idPista).jpg"; // O el formato que desees (por ejemplo, .jpg)

            // Mueve el archivo a la carpeta destino y renómbralo
            if (move_uploaded_file($rutaTemp, $nuevoNombreArchivo)) {
                // Continúa con la inserción de datos en la base de datos si es necesario
            } else {
            }
            // Ejecución exitosa
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
                                    <h5>Pista Insertada Correctamente</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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
                                    <h5>Error Insertando Pista</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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

    if (isset($_POST['individual'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $conexion = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $stmt = mysqli_prepare($conexion, "SELECT id_empresa, nombre_empresa FROM empresas");
        $query = "SELECT id_empresa, nombre_empresa FROM empresas";
        $result = mysqli_query($conexion, $query);

        $empresas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $empresas[] = $row;
        }

        mysqli_close($conexion);
        ?>
        <div class="col-md-12 col-12 formulario mb-2">
            <h2 class="text-center mb-4">Registro Pista</h2>
            <form action="" method="post" id="miFormulario" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoPista">Tipo de Pista</label>
                            <select class="form-control" id="tipoPista" name="tipoPista" required>
                                <option value="" selected>Seleccione su pista</option>
                                <option value="Fútbol">Fútbol</option>
                                <option value="Baloncesto">Baloncesto</option>
                                <option value="Tenis">Tenis</option>
                                <option value="Pádel">Pádel</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombrePista">Nombre de la Pista</label>
                            <input type="text" class="form-control" id="nombrePista" name="nombrePista" placeholder="Nombre de la pista" title="Nombre de la pista" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="comunidades" class="form-label">Comunidades</label>
                            <select class="form-select" id="comunidades" name="comunidades" title="comunidades" required>
                                <option selected disabled>Seleccione la Comunidad Autónoma</option>
                                <!-- Las opciones se agregarán aquí -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provincias" class="form-label">Provincias</label>
                            <select class="form-select" id="provincias" name="provincias" title="provincias" disabled required>
                                <option selected disabled>Seleccione la Provincia</option>
                                <!-- Las opciones se agregarán aquí -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="municipios" class="form-label">Municipios</label>
                            <select class="form-select" id="municipios" name="municipios" title="municipios" disabled required>
                                <option selected disabled>Seleccione el Municipio</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigoPostal">Código Postal</label>
                            <input type="text" class="form-control" pattern="[0-9]{5}" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" title="Código Postal" required>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefonoContacto">Teléfono</label>
                            <input type="tel" class="form-control" id="telefonoContacto" name="telefonoContacto" placeholder="Teléfono de Contacto" title="Teléfono de Contacto" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de la Pista" title="Dirección de la Pista" required>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group clockpicker">
                            <label for="horaapertura" class="form-label">Hora de Apertura</label>
                            <input type="text" class="form-control" id="horaapertura" name="horaapertura" placeholder="Hora de Apertura" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group clockpicker">
                            <label for="horacierre">Hora de Cierre</label>
                            <input type="text" class="form-control" id="horacierre" autocomplete="off" name="horacierre" placeholder="Hora de cierre" title="HOra de cierre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precioHora">Precio por hora</label>
                            <input type="number" class="form-control" id="precioHora" name="precioHora" placeholder="Precio por hora" title="Precio por hora" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correoContacto">Correo de Contacto</label>
                            <input type="email" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de Contacto" title="Correo de Contacto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="imagenPista">Foto de la Pista</label>
                        <input type="file" class="form-control" id="imagenPista" name="imagenPista" placeholder="Imagen de la Pista" title="Imagen de la Pista" required>
                    </div>
                </div>


                <div class="text-center">
                    <button class="btn botonancho btn-lg btn-block ms-2 mt-4" name="altapistaindi" type="submit">Dar de alta pista</button>

                    <a href="gestionpistasempresa.php"><button type="button" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2 mt-4">Volver</button></a>
                </div>
            </form>
        </div>
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
                                        <h1 class="mb-5">Inserta el archivo para dar de alta las pistas</h1>
                                        <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                            </svg></h3>
                                        <label for="archivoInput" class="visually-hidden">Añade el archivo para dar de alta las pistas</label>
                                        <input type="file" name="archivo" id="archivoInput" class="mt-3 mb-3" required>
                                        <br>

                                        <button class="btn botonancho btn-lg btn-block " name="insertarmasiva" type="submit" id="insertarmasiva">Insercion
                                            Masiva</button>



                                        <a href="gestionpistasempresa.php"><button class="btn botonancho btn-lg btn-block " name="volver" id="volver" type="submit">Volver</button></a>

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
        include 'NOACCESIBLE/credencialesdb.php';
        $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        /* Introduzco los valores del csv introducido en un array bidimensional para saber si la primera columna es alumno o 
        apellidos para saber si tengo que insertar en la tabla profesores o en la tabla alumnos */
        $file = fopen($tmp_name, "r");
        $filas = [];
        while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
            $filas[] = $data; // as fgetcsv return array already exlode by ","
        }
        $fila = fgetcsv($file, 0, ";");
        $primercampo = explode(';', $filas[0][0]);
        $array = [];
        $file = fopen($tmp_name, "r");
        $row = 0;
        $expectedHeaders = array(
            'id_pista',
            'tipo_pista',
            'nombre_pista',
            'comunidad_autonoma',
            'provincia',
            'municipio',
            'direccion',
            'codigo_postal',
            'correo_contacto',
            'telefono_contacto',
            'precio_hora',
            'hora_apertura',
            'hora_cierre',
            'fecha_registro',
            'validacion',
            'id_empresa'
        );
        if ($filas[0] == $expectedHeaders) {
            while ($fila = fgetcsv($file, 0, ";")) {
                $row++;
                if ($row == 1) {
                } else {
                    $stmt = mysqli_prepare($c1, "INSERT INTO pistas (id_pista,tipo_pista,nombre_pista,comunidad_autonoma,provincia,municipio,direccion,codigo_postal,correo_contacto,telefono_contacto,precio_hora,hora_apertura,hora_cierre,fecha_registro,id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "sssssssssssssss", $idPista, $tipoPista, $nombrePista, $comunidad, $provincia, $municipio, $direccion, $codigoPostal, $correoContacto, $telefonoContacto, $precioHora, $horaApertura, $horaCierre, $fechaRegistro, $_SESSION['id_empresa']);

                    if ($stmt->execute()) { ?>
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
                                                <h5>Pistas Insertadas Correctamente</h5>
                                                <form method="post" action="gestionpistas.php">
                                                    <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section><?
                                } else {
                                    //Si hay algun error lo guardo en un array para mostrarlo posteriormente en un desplegable
                                    $error = mysqli_error($c1);
                                    $numerror = mysqli_errno($c1);
                                    $array[] = $error; ?>
                        <section class="vh-100">
                            <div class="container py-5 h-100">
                                <div class="row d-flex justify-content-center align-items-center h-50">
                                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                        <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                            <div class="card-body p-5 text-center">
                                                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                                        <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg></h3>
                                                <h5>Error Insertando Pistas</h5>
                                                <form method="post" action="gestionpistas.php">
                                                    <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section><?
                                }
                            }
                        }
                    } else {
                                    ?>

            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-50">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                            <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </h3>
                                    <h5>Las cabeceras del archivo CSV no son correctas</h5>
                                    <form method="post" action="gestionpistas.php">
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
                if (isset($_POST['baja'])) {
                    include 'NOACCESIBLE/credencialesdb.php';
                    $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
                    $stmt = mysqli_prepare($c1, "SELECT id_pista,tipo_pista,nombre_pista,provincia,municipio,telefono_contacto,precio_hora,fecha_registro,validacion FROM pistas where id_empresa=? and validacion!='POR VALIDAR'");
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['id_empresa']);
                    $stmt->execute();
                    mysqli_stmt_bind_result($stmt, $rid, $rtipo, $rnombre, $rprovincia, $rmunicipio, $rtelefono, $rprecio, $rfecha, $rvalidacion);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Pistas
                    </caption>
                    <thead class="table-dark">

                        <tr>
                            <th>Tipo Pista</th>
                            <th>Nombre Pista</th>
                            <th>Provincia</th>
                            <th>Municipio</th>
                            <th>Telefono</th>
                            <th>Precio</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th>Borrar Pista?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>

                                <th>
                                    <? echo $rtipo ?>
                                </th>
                                <th>
                                    <? echo $rnombre ?>
                                </th>
                                <th>
                                    <? echo $rprovincia ?>
                                </th>
                                <th>
                                    <? echo $rmunicipio ?>
                                </th>
                                <th>
                                    <? echo $rtelefono ?>
                                </th>
                                <th>
                                    <? echo $rprecio . "€" ?>
                                </th>
                                <th>
                                    <? echo date("d-m-Y", strtotime($rfecha)) ?>
                                </th>
                                <th>
                                    <? echo $rvalidacion ?>
                                </th>
                                <input type="hidden" name="rid" value="<? echo $rid ?>">
                                <th>
                                    <div class="text-center">
                                        <a href="gestionpistasempresa.php?borrar=borrar&idpista=<?php echo urlencode($rid); ?>">
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
            <a href="perfil.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
        </div>

        <?
                }

                if (isset($_GET['borrar'])) {
                    include 'NOACCESIBLE/credencialesdb.php';
                    $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
                    $idpista = $_GET['idpista'];
                    $stmt = mysqli_prepare($c1, "DELETE FROM pistas WHERE id_pista=?");
                    $stmt->bind_param("s", $idpista);
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
                                    <h5>Pista Borrada Correctamente</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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
                                    <h5>Error borrando Pista</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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
                    $stmt = mysqli_prepare($c1, "SELECT tipo_pista,nombre_pista,provincia,municipio,codigo_postal,correo_contacto,telefono_contacto,precio_hora,hora_apertura,hora_cierre,validacion,fecha_registro,id_pista FROM pistas where id_empresa=? and validacion!='POR VALIDAR'");
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['id_empresa']);
                    $stmt->execute();
                    mysqli_stmt_bind_result($stmt, $rtipo, $rnombre, $rprovincia, $rmunicipio, $rcp, $rcorreo, $rtelefono, $rprecio, $rhoraa, $rhorac, $rvalidacion, $rfecha, $ridpista);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Pistas
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre Pista</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Precio/H</th>
                            <th>Hora Apertura</th>
                            <th>Hora Cierre</th>
                            <th>Estado de la pista</th>
                            <th>Modificar Pista?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <form action="gestionpistasempresa.php" method="get">

                                    <th>
                                        <label for="rnombre_<?php echo $rid; ?>" class="visually-hidden">Nombre</label>
                                        <input type="text" name="rnombre" id="rnombre_<?php echo $rid; ?>" value="<? echo $rnombre ?>" required>
                                        <div style="display: none;">
                                            <? echo $rnombre ?>
                                        </div>
                                    </th>
                                    <th>
                                        <label for="rcorreo_<?php echo $rid; ?>" class="visually-hidden">Correo</label>
                                        <input type="text" name="rcorreo" id="rcorreo_<?php echo $rid; ?>" value="<? echo $rcorreo ?>" required>
                                    </th>
                                    <th>
                                        <label for="rtelefono_<?php echo $rid; ?>" class="visually-hidden">Teléfono</label>
                                        <input type="text" name="rtelefono" id="rtelefono_<?php echo $rid; ?>" value="<? echo $rtelefono ?>" required>
                                    </th>
                                    <th>
                                        <label for="rprecio_<?php echo $rid; ?>" class="visually-hidden">Precio</label>
                                        <input type="text" name="rprecio" id="rprecio_<?php echo $rid; ?>" value="<? echo $rprecio ?>" required>
                                    </th>
                                    <th>
                                        <label for="rhoraa_<?php echo $rid; ?>" class="visually-hidden">Hora Inicio</label>
                                        <input type="text" name="rhoraa" id="rhoraa_<?php echo $rid; ?>" value="<? echo date("H:i", strtotime($rhoraa)) ?>" required>
                                    </th>
                                    <th>
                                        <label for="rhorac_<?php echo $rid; ?>" class="visually-hidden">Hora Fin</label>
                                        <input type="text" name="rhorac" id="rhorac_<?php echo $rid; ?>" value="<? echo date("H:i", strtotime($rhorac)) ?>" required>
                                    </th>
                                    <th>
                                        <?
                                        if ($rvalidacion == "ACTIVA" || $rvalidacion == "Validada") {
                                        ?>
                                            <label for="rvalidacion_activa_<?php echo $rid; ?>" class="visually-hidden">Activa</label>
                                            <input type="radio" name="rvalidacion" id="rvalidacion_activa_<?php echo $rid; ?>" value="ACTIVA" checked>
                                            Activa
                                            <br>
                                            <label for="rvalidacion_inactiva_<?php echo $rid; ?>" class="visually-hidden">Inactiva</label>
                                            <input type="radio" name="rvalidacion" id="rvalidacion_inactiva_<?php echo $rid; ?>" value="INACTIVA">
                                            Inactiva
                                        <?
                                        } else {
                                        ?>
                                            <label for="rvalidacion_activa_<?php echo $rid; ?>" class="visually-hidden">Activa</label>
                                            <input type="radio" name="rvalidacion" id="rvalidacion_activa_<?php echo $rid; ?>" value="ACTIVA">
                                            Activa
                                            <br>
                                            <label for="rvalidacion_inactiva_<?php echo $rid; ?>" class="visually-hidden">Inactiva</label>
                                            <input type="radio" name="rvalidacion" id="rvalidacion_inactiva_<?php echo $rid; ?>" value="INACTIVA" checked>
                                            Inactiva
                                        <?
                                        }
                                        ?>
                                    </th>



                                    <th>
                                        <div class="text-center">

                                            <button type="submit" id="modificar" name="modificar" value="borrar" class="btn btn-info btn-lg btn-block  ms-2">Modificar</button>
                                        </div>
                                    </th>
                                    <input type="hidden" name="ridpista" value="<? echo $ridpista ?>">

                                </form>

                            </tr>
                        <? } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="gestionpistasempresa.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
        </div>

        <?
                }
                if (isset($_GET['modificar'])) {
                    $ridpista = $_GET['ridpista'];
                    $nombrepista = $_GET['rnombre'];
                    $correo = $_GET['rcorreo'];
                    $telefono = $_GET['rtelefono'];
                    $precio = $_GET['rprecio'];
                    $horaa = $_GET['rhoraa'];
                    $horac = $_GET['rhorac'];
                    $validacion = $_GET['rvalidacion'];
                    include 'NOACCESIBLE/credencialesdb.php';
                    $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
                    $stmt = mysqli_prepare($c1, "UPDATE pistas SET nombre_pista=?,correo_contacto=?,telefono_contacto=?,precio_hora=?,hora_apertura=?,hora_cierre=?,validacion=? WHERE id_pista=?");
                    mysqli_stmt_bind_param($stmt, "ssssssss", $nombrepista, $correo, $telefono, $precio, $horaa, $horac, $validacion, $ridpista);
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
                                    <h5>Datos de la Pista actualizados correctamente</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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
                                    <h5>Error modificando Pista</h5>
                                    <form method="post" action="gestionpistasempresa.php">
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
            } else {
    ?>
    <form method="post" action="">
        <div class="container d-flex justify-content-end mt-3 me-2">
            <div class="card p-3">
                <div class="media">
                    <div class="media-body">
                        <span class="mt-2 mb-0 h5 me-4">
                            <? echo $_SESSION['nom_empresa'] ?></span></h5>
                        <button class="btn btn-primary mr-2" name="cerrarses">Cerrar Sesión</button>


                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="post" action="" class="d-inline ms-2">
        <div class="container">
            <section class="vh-300">
                <div class="container py-3 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center" id="carta">
                                    <h1 class="mb-5">Acciones sobre las pistas</h1>
                                    <button class="btn botonancho btn-lg btn-block ms-2" name="alta" type="submit">Alta</button>

                                    <button class="btn botonancho btn-lg btn-block ms-2" name="baja" type="submit">Baja</button>

                                    <button class="btn botonancho btn-lg btn-block ms-2" name="modificacion" type="submit">Modificación</button>

                                    <button class="btn botonancho btn-lg btn-block ms-2" name="pdf" type="submit">PDF</button>

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





</html>
<?
            }
            mostrar_footer();
?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/tabla.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/buscarMunicipio.js"></script>
<script src="./clockpicker-gh-pages/src/clockpicker.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>