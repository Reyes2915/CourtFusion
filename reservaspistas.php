<? session_start();
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin']) && !isset($_SESSION['isEmpresa'])) {
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reservas Empresa</title>
    <link rel="icon" href="imagenes/icono.jfif">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="css/estilos.css">
</head>

<body>
   

    <?
    include 'funciones.php';
    mostrarNavbar();
    if (isset($_GET['cancelar']) && isset($_GET['id_usuario']) && isset($_GET['id_pista'])) {
        include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
        $c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
        $stmt = mysqli_prepare($c2, "DELETE FROM reservas WHERE id_usuario=? and id_pista=?");
        mysqli_stmt_bind_param($stmt, "ss", $_GET['id_usuario'], $_GET['id_pista']);
        if (mysqli_stmt_execute($stmt)) {
            $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
            $toastContent .= "<div class='toast-header'>";
            $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
            $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
            $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
            $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
            $toastContent .= "</div>";
            $toastContent .= "<div class='toast-body bg-success text-white'>";
            $toastContent .= "Reserva cancelada correctamente.";
            $toastContent .= "</div>";
            $toastContent .= "</div>";
        } else {
              // Pista eliminada de favoritos correctamente, muestro un toast rojo con bootstrap
              $toastContent = "<div class='toast show position-fixed bottom-0 end-0' style='z-index: 1000;' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
              $toastContent .= "<div class='toast-header'>";
              $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
              $toastContent .= "<strong class='me-auto'>CourtFusion</strong>";
              $toastContent .= "<small class='text-muted'>Ahora Mismo</small>";
              $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
              $toastContent .= "</div>";
              $toastContent .= "<div class='toast-body bg-danger text-white'>";
              $toastContent .= "Error al cancelar la reserva.";
              $toastContent .= "</div>";
              $toastContent .= "</div>";
          ;
        }
        echo $toastContent;
        echo '<script>
            $(document).ready(function() {
                $("#mytoast").toast("show");
            });
        </script>';
             
        };
    
    if (isset($_SESSION['id_empresa'])) {
        $id_empresa = $_SESSION['id_empresa'];
        if (isset($_GET['id_pista'])) {
            include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
            $c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
            $stmt = mysqli_prepare($c2, "SELECT tipo_pista,direccion,municipio,nombre_pista,nombre_reservante,hora_inicio_reserva,hora_fin_reserva from pistas p,usuarios u,reservas r where p.id_pista=r.id_pista and u.id_usuario=r.id_usuario and p.id_empresa=? and p.id_pista=?");
            mysqli_stmt_bind_param($stmt, "ss", $id_empresa, $_GET['id_pista']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $tipo_pista, $direccion, $municipio, $nombre_pista, $nombre_reservante, $hora_inicio_reserva, $hora_fin_reserva);
    ?>
            <div class="table-responsive mt-5 m-4">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered display pt-3" id="example">
                        <caption class="text-center">
                            Pistas
                        </caption>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre de la Pista</th>
                                <th scope="col">Nombre del Reservante</th>
                                <th scope="col">Tipo de Pista</th>
                                <th scope="col">Municipio</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora de Inicio</th>
                                <th scope="col">Hora de Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                <tr>
                                    <td><? echo $nombre_pista ?></td>
                                    <td><? echo $nombre_reservante ?></td>
                                    <td><? echo $tipo_pista ?></td>
                                    <td><? echo $municipio ?></td>
                                    <td><? echo $direccion ?></td>
                                    <td> <? echo  date('d-m', strtotime($hora_fin_reserva)) ?></td>
                                    <td><? echo date('H:i', strtotime($hora_inicio_reserva)) ?></td>
                                    <td><? echo date('H:i', strtotime($hora_fin_reserva)) ?></td>
                                </tr>
                            <?
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mb-2">
                <a href="perfil.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
            </div>

        <?
        } else {
            include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
            $c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
            $stmt = mysqli_prepare($c2, "SELECT tipo_pista,direccion,municipio,nombre_pista,nombre_reservante,hora_inicio_reserva,hora_fin_reserva,r.id_usuario,r.id_pista,r.id_reserva from pistas p,usuarios u,reservas r where p.id_pista=r.id_pista and u.id_usuario=r.id_usuario and p.id_empresa=?");
            mysqli_stmt_bind_param($stmt, "s", $id_empresa);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $tipo_pista, $direccion, $municipio, $nombre_pista, $nombre_reservante, $hora_inicio_reserva, $hora_fin_reserva, $id_usuario, $id_pista,$id_reserva);


        ?>
            <div class="table-responsive mt-5 m-4">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered display pt-3" id="example">
                        <caption class="text-center">
                            Pistas
                        </caption>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre de la Pista</th>
                                <th scope="col">Nombre del Reservante</th>
                                <th scope="col">Tipo de Pista</th>
                                <th scope="col">Municipio</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Fecha</th>

                                <th scope="col">Hora de Inicio</th>
                                <th scope="col">Hora de Fin</th>
                                <th scope="col">Cancelar Reserva?</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">


                            <?
                            while (mysqli_stmt_fetch($stmt)) {
                            ?>

                                <tr>
                                    <td><? echo $nombre_pista ?></td>
                                    <td><? echo $nombre_reservante ?></td>
                                    <td><? echo $tipo_pista ?></td>
                                    <td><? echo $municipio ?></td>
                                    <td><? echo $direccion ?></td>
                                    <td> <? echo date('d-m', strtotime($hora_fin_reserva)) ?></td>
                                    <td><? echo date('H:i', strtotime($hora_inicio_reserva)) ?></td>
                                    <td><? echo date('H:i', strtotime($hora_fin_reserva)) ?></td>
                                    <td><a href="reservaspistas.php?cancelar=cancelar&id_usuario=<? echo $id_usuario ?>&id_pista=<? echo $id_pista ?>" class="btn btn-danger">Cancelar</a></td>
                                    <input type="hidden" name="id_reserva" value="<? echo $id_reserva ?>">
                                </tr>

                            <?
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mb-2">
                <a href="perfil.php"><button type="submit" id="volver" name="volver" class="btn botonancho btn-lg btn-block  ms-2">Volver</button></a>
            </div>

    <?


        }
    } else {
        header("Location: perfil.php");
    }

    mostrar_footer();
    ?>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/tabla.js"></script>
    <script type="text/javascript" src="js/obtenerpistas.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>