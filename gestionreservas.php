<?php
if (isset($_POST['pdf'])) {
    include 'pdfreservas.php';
}
session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Reservas</title>
    <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/standalone.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./clockpicker-gh-pages/src/clockpicker.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
</head>

<?
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }
if(isset($_POST['cerrarses'])){
    session_destroy();
    header("Location: index.php");
}
include 'funciones.php';
mostrarNavbar();
if (isset($_POST['alta']) || isset($_POST['baja']) || isset($_POST['modificacion']) || isset($_GET['borrar']) || isset($_POST['individual']) || isset($_POST['masiva']) || isset($_POST['insertarmasiva']) || isset($_GET['modificar']) || isset($_POST['pdf']) || isset($_POST['excel']) || isset($_POST['altareserindi'])) {
    if (isset($_POST['alta'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $conexion = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');

        // Obtener la lista de usuarios
        $stmtUsuarios = mysqli_prepare($conexion, "SELECT id_usuario, nombre FROM usuarios");
        if ($stmtUsuarios === false) {
            die("Error al preparar la consulta de usuarios: " . mysqli_error($conexion));
        }

        if (mysqli_stmt_execute($stmtUsuarios)) {
            $resultUsuarios = mysqli_stmt_get_result($stmtUsuarios);

            $usuarios = [];
            while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                $usuarios[] = $rowUsuario;
            }
        } else {
            die("Error al ejecutar la consulta de usuarios: " . mysqli_error($conexion));
        }

        // Obtener la lista de pistas
        $stmtPistas = mysqli_prepare($conexion, "SELECT id_pista, nombre_pista FROM pistas");
        if ($stmtPistas === false) {
            die("Error al preparar la consulta de pistas: " . mysqli_error($conexion));
        }

        if (mysqli_stmt_execute($stmtPistas)) {
            $resultPistas = mysqli_stmt_get_result($stmtPistas);

            $pistas = [];
            while ($rowPista = mysqli_fetch_assoc($resultPistas)) {
                $pistas[] = $rowPista;
            }
        } else {
            die("Error al ejecutar la consulta de pistas: " . mysqli_error($conexion));
        }

        // Cierra las declaraciones
        mysqli_stmt_close($stmtUsuarios);
        mysqli_stmt_close($stmtPistas);
        mysqli_close($conexion);

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
                                    <h1>Alta Reserva</h1>
                                    <!-- Dentro de tu formulario HTML -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="usuarioReserva">Usuario</label>
                                                <select class="form-select" id="usuarioReserva" name="usuarioReserva" title="Usuario" required>
                                                    <option selected disabled hidden>Seleccione un usuario</option>
                                                    <?php foreach ($usuarios as $usuario) : ?>
                                                        <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pistaReserva">Pista</label>
                                                <select class="form-select" id="pistaReserva" name="pistaReserva" title="Pista" required>
                                                    <option selected disabled hidden>Seleccione una pista</option>
                                                    <?php foreach ($pistas as $pista) : ?>
                                                        <option value="<?php echo $pista['id_pista']; ?>"><?php echo $pista['nombre_pista']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombreReservante" class="form-label">Nombre del Reservante</label>
                                                <input type="text" class="form-control" id="nombreReservante" name="nombreReservante" placeholder="Nombre Reservante" title="Nombre Reservante" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+14 days')); ?>" required>
                                                <span id="fechaError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group clockpicker">
                                                <label for="horaapertura" class="form-label">Hora de Inicio</label>
                                                <input type="text" class="form-control" id="horaInicio" name="horaapertura" placeholder="Hora de Apertura" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group clockpicker">
                                                <label for="horacierre" class="form-label">Hora de Finalización</label>
                                                <input type="text" class="form-control" id="horaFin" autocomplete="off" name="horacierre" placeholder="Hora de cierre" title="HOra de cierre" required>
                                                <span id="horaFinError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <button class="btn botonancho btn-lg btn-block ms-2 " name="altareserindi" id="altareser" type="submit">Dar de alta reserva</button>
                                        <a href="gestionreservas.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
                                    </div>
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
    if (isset($_POST['altareserindi'])) {
        include 'NOACCESIBLE/credencialesdb.php';
        $conexion = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $idReserva = uniqid();
        $idusuario = $_POST['usuarioReserva'];
        $idpista = $_POST['pistaReserva'];
        $horaInicio = $_POST['horaapertura'];
        $horaFin = $_POST['horacierre'];
        $nombreReservante = $_POST['nombreReservante'];
        $fecha = $_POST['fecha'];
        $fechaDatetime = new DateTime($fecha);
        $horaInicioDatetime = new DateTime($fecha . ' ' . $horaInicio);
        $horaFinDatetime = new DateTime($fecha . ' ' . $horaFin);

        // Formatea los objetos DateTime como cadenas de fecha y hora
        $fechaFormateada = $fechaDatetime->format('Y-m-d H:i:s');
        $horaInicioFormateada = $horaInicioDatetime->format('Y-m-d H:i:s');
        $horaFinFormateada = $horaFinDatetime->format('Y-m-d H:i:s');
        $nombreReservante = $_POST['nombreReservante'];
        $stmt = mysqli_prepare($conexion, "INSERT INTO reservas (id_reserva,id_usuario,id_pista,nombre_reservante,hora_inicio_reserva,hora_fin_reserva) VALUES (?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $idReserva, $idusuario, $idpista, $nombreReservante, $horaInicioFormateada, $horaFinFormateada);
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
                                    <h5>Reserva Insertada Correctamente</h5>
                                    <form method="post" action="gestionreservas.php">
                                        <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><? } else {
                        echo ("error:" . mysqli_error($conexion));
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
                                    <h5>Error insertando Reserva</h5>
                                    <form method="post" action="gestionreservas.php">
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
                    $stmt = mysqli_prepare($c1, "SELECT id_reserva,r.nombre_reservante,p.nombre_pista,municipio,correo,hora_inicio_reserva,hora_fin_reserva  from usuarios u,pistas p, reservas r WHERE u.id_usuario=r.id_usuario AND p.id_pista=r.id_pista");
                    $stmt->execute();
                    mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rpista, $rmunicipio, $rcorreo, $hora_inicio_reserva, $hora_fin_reserva);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Reservas
                    </caption>
                    <thead class="table-dark">
                        <tr>

                            <th>Id Reserva</th>
                            <th>Nombre Usuario</th>
                            <th>Nombre Pista</th>
                            <th>Municipio</th>
                            <th>Correo Usuario</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Borrar Reserva?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>

                                <th>
                                    <? echo $rid ?>
                                </th>
                                <th>
                                    <? echo $rnombre ?>
                                </th>

                                <th>
                                    <? echo $rpista ?>
                                </th>
                                <th>
                                    <? echo $rmunicipio ?>
                                </th>
                                <th>
                                    <? echo $rcorreo ?>
                                </th>
                                <th>
                                    <? echo date("d-m-Y H:i", strtotime($hora_inicio_reserva)) ?>
                                </th>
                                <th>
                                    <? echo date("d-m-Y H:i", strtotime($hora_fin_reserva)) ?>
                                </th>
                                <th>
                                    <div class="text-center">
                                        <a href="gestionusuarios.php?borrar=borrar&idreserva=<?php echo urlencode($rid); ?>">
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
            <a href="gestionreservas.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-2 ms-2">Volver</button></a>
        </div>

        <?
                }

                if (isset($_GET['borrar'])) {
                    include 'NOACCESIBLE/credencialesdb.php';
                    $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
                    $idreserva = $_GET['idreserva'];
                    $stmt = mysqli_prepare($c1, "DELETE FROM reservas WHERE id_reserva=?");
                    $stmt->bind_param("s", $idreserva);
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
                                    <h5>Reserva Borrada Correctamente</h5>
                                    <form method="post" action="gestionreservas.php">
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
                                    <h5>Error borrando Reserva</h5>
                                    <form method="post" action="gestionreservas.php">
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
                    $stmt = mysqli_prepare($c1, "SELECT id_reserva,u.nombre,p.nombre_pista,municipio,correo,hora_inicio_reserva,hora_fin_reserva  from usuarios u,pistas p, reservas r WHERE u.id_usuario=r.id_usuario AND p.id_pista=r.id_pista");
                    $stmt->execute();
                    mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rpista, $rmunicipio, $rcorreo, $hora_inicio_reserva, $hora_fin_reserva);
        ?>
        <div class="table-responsive mt-3">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered display" id="example">
                    <caption class="text-center">
                        Reservas
                    </caption>
                    <thead class="table-dark">
                        <tr>

                            <th>Id Reserva</th>
                            <th>Nombre Usuario</th>
                            <th>Nombre Pista</th>
                            <th>Municipio</th>
                            <th>Correo Usuario</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Modificar Reserva?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <form action="gestionreservas.php" method="get">
                                    <th>
                                        <? echo $rid ?>
                                    </th>
                                    <th>
    <label for="rnombreusu_<?php echo $rid; ?>" class="visually-hidden">Nombre de Usuario</label>
    <input type="text" name="rnombreusu" id="rnombreusu_<?php echo $rid; ?>" value="<?php echo $rnombre; ?>" required>
    <div style="display: none;">
        <?php echo $rnombre; ?>
    </div>
</th>
<th>
    <label for="rpista_<?php echo $rid; ?>" class="visually-hidden">Pista</label>
    <?php echo $rpista; ?>
</th>
<th>
    <label for="rmunicipio_<?php echo $rid; ?>" class="visually-hidden">Municipio</label>
    <?php echo $rmunicipio; ?>
</th>
<th>
    <label for="rcorreo_<?php echo $rid; ?>" class="visually-hidden">Correo</label>
    <?php echo $rcorreo; ?>
</th>
<th>
    <label for="rhorainicio_<?php echo $rid; ?>" class="visually-hidden">Hora de Inicio</label>
    <input type="datetime-local" name="rhorainicio" id="rhorainicio_<?php echo $rid; ?>" value="<?php echo date("Y-m-d\TH:i:s", strtotime($hora_inicio_reserva)); ?>" required>
</th>
<th>
    <label for="rhorafin_<?php echo $rid; ?>" class="visually-hidden">Hora de Fin</label>
    <input type="datetime-local" name="rhorafin" id="rhorafin_<?php echo $rid; ?>" value="<?php echo date("Y-m-d\TH:i:s", strtotime($hora_fin_reserva)); ?>" required>
</th>

                                    <th>
                                        <div class="text-center">

                                            <button type="submit" id="modificar" name="modificar" value="borrar" class="btn btn-info btn-lg btn-block  ms-2">Modificar</button>
                                        </div>
                                    </th>
                                    <input type="hidden" name="ridusu" value="<? echo $rid ?>">
                                    <input type="hidden" name="rcorreousu" value="<? echo $rcorreo ?>">
                                    <input type="hidden" name="rpista" value="<? echo $rpista ?>">
                                    <input type="hidden" name="rmunicipio" value="<? echo $rmunicipio ?>">

                                </form>

                            </tr>
                        <? } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="gestionreservas.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block mb-2  ms-2">Volver</button></a>
        </div>

        <?
                }
                if (isset($_GET['modificar'])) {
                    $idusu = $_GET['ridusu'];
                    $nombreusu = $_GET['rnombreusu'];
                    $correousu = $_GET['rcorreousu'];
                    $rpista = $_GET['rpista'];
                    $rmunicipio = $_GET['rmunicipio'];
                    $rhorainicio = $_GET['rhorainicio'];
                    $rhorafin = $_GET['rhorafin'];
                    include 'NOACCESIBLE/credencialesdb.php';
                    $c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
                    $stmt = mysqli_prepare($c1, "UPDATE reservas SET nombre_reservante=?,hora_inicio_reserva=?,hora_fin_reserva=? WHERE id_reserva=?");
                    mysqli_stmt_bind_param($stmt, "ssss", $nombreusu, $rhorainicio, $rhorafin, $idusu);
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
                                    <h5>Datos de la reserva modificados correctamente</h5>
                                    <form method="post" action="gestionreservas.php">
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
                                    <h5>Error modificando Reserva</h5>
                                    <form method="post" action="gestionreservas.php">
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
                    include 'excel/excelreservas.php';
                }
            } else {
    ?>
    <form method="post" action="">
        <div class="container d-flex justify-content-end mt-3 me-2">
            <div class="card p-3">
                <div class="media">
                    <div class="media-body">
                        <span class="mt-2 mb-0 h5 me-4">
                            <? echo  $_SESSION['nom_usu'] ?></span></h5>
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
                                    <h1 class="mb-5">Acciones sobre las reservas</h1>
                                    <button class="btn botonancho btn-lg btn-block ms-2" name="alta" type="submit">Alta</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="baja" type="submit">Baja</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="modificacion" type="submit">Modificacion</button>
                                    <button class="btn botonancho btn-lg btn-block ms-2 " name="pdf" type="submit">PDF</button>


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


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/tabla.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="./clockpicker-gh-pages/src/clockpicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function() {
        $('#horaInicio, #horaFin').prop('disabled', true);
        var arrayHorasActivas = [];
        var yaHaPasado = false;
        var horaInicioReserva=0;
        var horaFinReserva=0;
        var minutosInicioReserva=0;
        var minutosFinReserva=0;
        const form = document.getElementById("myForm");
        const fechaInput = document.getElementById("fecha");
        const horaInicioInput = document.getElementById("horaInicio");
        const horaFinInput = document.getElementById("horaFin");
        const pistaSelect = document.getElementById("pistaReserva");

        // Evento de cambio en el campo de fecha
        fechaInput.addEventListener("change", function() {
            document.getElementById("fechaError").innerHTML = "";
            const fechaSeleccionada = new Date(fechaInput.value);
            if (fechaSeleccionada.getDay() === 0 || fechaSeleccionada.getDay() === 6) {
                fechaInput.setCustomValidity("No puedes seleccionar un fin de semana como fecha.");
                document.getElementById("fechaError").innerHTML = "No puedes seleccionar un fin de semana como fecha de reserva.";
            } else {
                fechaInput.setCustomValidity("");
            }

            // Verifica si se ha seleccionado una pista y una fecha
            verificarIdPistaYFecha();
        });

        // Llamada a la función obtenerIdPista
        obtenerIdPista();

        // Resto del código...

        // Función para obtener el ID de la pista seleccionada
        function obtenerIdPista() {
            pistaSelect.addEventListener("change", function() {
                const selectedPistaId = pistaSelect.value;

                // Realiza las acciones que necesites con el ID de la pista seleccionada
                console.log("ID de la pista seleccionada:", selectedPistaId);

                // También podrías llamar a la función verificarHorasOcupadas() aquí, dependiendo de tus necesidades.

                // Verifica si se ha seleccionado una pista y una fecha
                verificarIdPistaYFecha();
            });
        }

        // Función para verificar si se han seleccionado la pista y la fecha
        function verificarIdPistaYFecha() {
            const selectedPistaId = pistaSelect.value;
            console.log('ID de la pista seleccionada:', selectedPistaId);
            //Lo convertimos a string para la consulta
            const selectedPistaIdString = selectedPistaId.toString();
            const fechaSeleccionada = new Date(fechaInput.value);

            // Verifica si se ha seleccionado una pista y una fecha
            if (selectedPistaId!='Seleccione una pista' && !isNaN(fechaSeleccionada.getTime())) {
                // Habilita los campos de hora
                $('#horaInicio, #horaFin').prop('disabled', false);

                // Realiza las acciones que necesites con el ID de la pista y la fecha seleccionadas
                console.log("ID de la pista seleccionada:", selectedPistaId);
                console.log("Fecha seleccionada:", fechaSeleccionada.toISOString().split('T')[0]);

                // Realizar una solicitud AJAX para obtener las reservas para la pista y fecha seleccionadas
                $.ajax({
                    url: 'obtener_reservas.php',
                    method: 'POST',
                    data: {
                        idPista: selectedPistaIdString,
                        fecha: fechaSeleccionada.toISOString().split('T')[0]
                    },
                    success: function(reservas) {
                        const response = reservas;
                        console.log('Reservas:', response);

                        const horaApertura = response.horaApertura.split(":")[0];
                        const horaCierre = response.horaCierre.split(":")[0];
                        const horasReservadas = response.horasDesactivar;
                        console.log('Hora de apertura antes de clock:', horaApertura);
                        console.log('Hora de cierre antes de clock:', horaCierre);
                        console.log('Horas reservadas antes de clock:', horasReservadas);

                        //Convertimos las horas de apertura y cierre de hh:mm:ss a

                        // Llamada a la función mostrarClockpicker
                        mostrarClockpicker( // Parámetros
                            horaApertura, // Hora de apertura
                            horaCierre, // Hora de cierre
                            horasReservadas // Horas reservadas
                        );
                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);
                    }
                });
            } else {
                // Desactiva los campos de hora si no se ha seleccionado una pista o fecha
                $('#horaInicio, #horaFin').prop('disabled', true);
            }
        }

        // Resto del código...
        $(document).on("mouseenter", ".clockpicker-hours>.clockpicker-tick-disabled", function(e) {
        ticksDisabled = true;
      });

      $(document).on("mouseenter", ".clockpicker-hours>.clockpicker-tick", function(e) {
        ticksDisabled = false;
      });
      function mostrarClockpicker(horaMin, horaMax, horasReservadas) {
    $('.clockpicker').clockpicker({
        autoclose: true,
        donetext: "Hecho",
        afterDone: function () {
            validateHoras();
        },
        afterShow: function () {
            console.log('Clockpicker mostrado');
console.log('Hora de apertura:', horaMin);
console.log('Hora de cierre:', horaMax);
console.log('Horas reservadas:', horasReservadas);

// Habilitar todas las horas
$(".clockpicker-hours").find(".clockpicker-tick").removeClass('clockpicker-tick-disabled');

// Desactivar las horas antes de la hora de apertura y después de la hora de cierre
$(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
    return parseInt($(element).html()) < horaMin || parseInt($(element).html()) >= horaMax;
}).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
var arrayInicio = [];
var arrayFinal = [];

// Desactivar las horas y minutos de las horas reservadas
for (let i = 0; i < horasReservadas.length; i += 2) {
    const horaInicioReserva = parseInt(horasReservadas[i].split(":")[0]);
    const minutosInicioReserva = parseInt(horasReservadas[i].split(":")[1]);

    const horaFinReserva = parseInt(horasReservadas[i + 1].split(":")[0]);
    const minutosFinReserva = parseInt(horasReservadas[i + 1].split(":")[1]);

    // Creamos un array con las horas y minutos de inicio y fin de reserva
    arrayInicio.push({ hora: horaInicioReserva, minuto: minutosInicioReserva });
    arrayFinal.push({ hora: horaFinReserva, minuto: minutosFinReserva });

    // Desactivar la hora de inicio si los minutos son 0
    if (minutosInicioReserva === 0) {
        $(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
            return parseInt($(element).html()) === horaInicioReserva;
        }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
    }

    // Si la reserva dura más de una hora, desactivar las horas intermedias
    if (horaFinReserva - horaInicioReserva > 1) {
        for (let j = horaInicioReserva + 1; j < horaFinReserva; j++) {
            $(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
                return parseInt($(element).html()) === j;
            }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
        }
    }
}
// Función para desactivar los minutos para una hora específica
function desactivarMinutos(hora, minutoInicio, minutoFin) {
              console.log('Hora:', hora);
              var hours = $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                return parseInt($(element).html()) === hora;
              });
              console.log('Horas:', hours);
              console.log('Minuto de inicio:', minutoInicio);
              console.log('Minuto de fin:', minutoFin);
              //Ahora seleccionamos los minutos que hay que desactivar independientemente de la hora que sean mayores que el minuto de inicio y menores que el minuto de fin
              var minutes = $(".clockpicker-minutes").find(".clockpicker-tick").filter(function(index, element) {
                return parseInt($(element).html()) >= minutoInicio && parseInt($(element).html()) <= minutoFin;
              });

              //Ahora desactivamos en el mouse enter de la hora todos los minutos que no esten en minutes
              $(hours).on("mousedown", function(e) {
                console.log('Mouse enter en hora:', hora);
                $(".clockpicker-minutes").find(".clockpicker-tick").removeClass('clockpicker-tick-disabled');
                $(".clockpicker-minutes").find(".clockpicker-tick").not(minutes).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
              });



              // Configurar un intervalo para verificar continuamente la visibilidad
              // Observador de mutaciones para verificar cambios en el estilo de los minutos
              var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                  if (mutation.attributeName === 'style') {
                    var visibilidad = $(".clockpicker-minutes").css("visibility");
                    console.log('Visibilidad Minutos:', visibilidad);
                    if (visibilidad === "hidden") {
                      $(".clockpicker-minutes").find(".clockpicker-tick-disabled").removeClass('clockpicker-tick-disabled').addClass('clockpicker-tick');
                    }

                    //Ahora cuando se haga mouseleave en una hora de hours, se desactivarán todos los minutos que no esten en minutes
                  }
                });
              });

              // Configurar el observador para el nodo de minutos
              var targetNode = $(".clockpicker-minutes")[0];
              var config = {
                attributes: true
              };
              observer.observe(targetNode, config);

              // Limpiar el observador cuando el reloj se oculta (puede que necesites ajustar el evento adecuado)
              $('.clockpicker').on('afterHide', function() {
                observer.disconnect();
              });

              //Volvemos a activar el observer cuando se muestra el reloj
                $('.clockpicker').on('afterShow', function() {
                    observer.observe(targetNode, config);
                });

            }

// Desactivar las horas antes de la hora de apertura y después de la hora de cierre
$(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
    return parseInt($(element).html()) < horaMin || parseInt($(element).html()) >= horaMax;
}).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');

// Desactivar las horas y minutos de las horas reservadas
for (let i = 0; i < horasReservadas.length; i += 2) {
    const horaInicioReserva = parseInt(horasReservadas[i].split(":")[0]);
    const minutosInicioReserva = parseInt(horasReservadas[i].split(":")[1]);

    const horaFinReserva = parseInt(horasReservadas[i + 1].split(":")[0]);
    const minutosFinReserva = parseInt(horasReservadas[i + 1].split(":")[1]);

    // Desactivar la hora de inicio si los minutos son 0
    if (minutosInicioReserva === 0) {
        $(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
            return parseInt($(element).html()) === horaInicioReserva;
        }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
    }

    // Desactivar las horas intermedias si la reserva dura más de una hora
    if (horaFinReserva - horaInicioReserva > 1) {
        for (let j = horaInicioReserva + 1; j < horaFinReserva; j++) {
            $(".clockpicker-hours").find(".clockpicker-tick").filter(function (index, element) {
                return parseInt($(element).html()) === j;
            }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
        }
    }

    // Llamar a la función para desactivar los minutos
    desactivarMinutos(horaInicioReserva, '0', minutosInicioReserva);
    desactivarMinutos(horaFinReserva, minutosFinReserva, '59');
}

        }
    });
}
      
        function parseHourString(hourString) {
            const parts = hourString.split(":");
            if (parts.length === 2) {
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                return hours + minutes / 60;
            }
            return 0;
        }
        function formatHourString(hour) {
              const hours = Math.floor(hour);
              const minutes = Math.round((hour - hours) * 60);
              return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
            }

        function validateHoras() {
            const horaInicio = parseHourString(horaInicioInput.value);
            const horaFinValue = horaFinInput.value.trim();

            if (horaFinValue === "") {
                horaFinInput.setCustomValidity("");
                document.getElementById("horaFinError").innerHTML = "";
                return;
            }

            const horaFin = parseHourString(horaFinValue);

            if (horaFin <= horaInicio) {
                horaFinInput.setCustomValidity("La hora de finalización debe ser mayor que la hora de inicio.");
                document.getElementById("horaFinError").innerHTML = "La hora de finalización debe ser mayor que la hora de inicio.";
            } else if (horaFin - horaInicio < 1) {
                horaFinInput.setCustomValidity("La hora de finalización debe ser al menos 1 hora después de la hora de inicio.");
                document.getElementById("horaFinError").innerHTML = "La hora de finalización debe ser al menos 1 hora después de la hora de inicio.";
            } else {
                horaFinInput.setCustomValidity("");
                document.getElementById("horaFinError").innerHTML = "";
            }
        }
    });
</script>

