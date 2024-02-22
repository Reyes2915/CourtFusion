<? session_start(); ?>
<!DOCTYPE html>
<html lang="es">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backup</title>
  <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
  <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
  <?php
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
  if (isset($_POST['crear'])) {
    include 'NOACCESIBLE/credencialesdb.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $database = 'pistasDelgadoR';
    $user = $usuario;
    $pass = $contraseña;
    $hostdb = $host;
    //Si no existe la carpeta backups, la crea
    if (!file_exists('backups')) {
      mkdir('backups', 0777, true);
    }
    //Si hay más de 3 backups, borra el más antiguo
    $files = glob("backups/PistasDelgadoR_backup_*.sql");
    if (count($files) > 3) {
      $oldest_file = $files[0];
      foreach ($files as $file) {
        if (filemtime($file) < filemtime($oldest_file)) {
          $oldest_file = $file;
        }
      }
      unlink($oldest_file);
    }
    $command = '"C:\ServidorLocal\mysql\bin\mysqldump.exe" ' . $database . " -u" . $user . " -p" . $pass . " >backups/PistasDelgadoR_backup_" . date('d-m-Y') . ".sql";
    //$command = '"/volume1/@appstore/MariaDB10/usr/local/mariadb10/bin/mysqldump" ' . $database . " -u" . $user . " -p" . $pass . " >/volume1/web/Informatica/DelgadoR/Biblioteca/backups/BibliotecaDelgadoR_backup_" . date('d-m-Y') . ".sql";
    //exec($command, $output, $return);
    include 'crear_backup.php';
  }
  ?>
  <form method="post" action="">
    <div class="container d-flex justify-content-end mt-3 me-2">
      <div class="card p-3">
        <div class="media">
          <div class="media-body">
            <span class="mt-2 mb-0 h5 me-4">
              <?php echo $_SESSION['nom_usu'] ?>
            </span>
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
                  <h1 class="mb-5">Acciones Backup</h1>

                  <button class="btn botonancho btn-lg btn-block me-2" name="crear" type="submit">Crear Backup</button>


                  <button class="btn botonancho btn-lg btn-block" name="borrar" type="button" onclick="redirigirABorrarBackup()">Borrar Backup</button>


                  <button class="btn botonancho btn-lg btn-block me-2" name="restaurarback" type="button" onclick="redirigirARestaurarBackup()">Restaurar Backup</button>


                  <button class="btn botonancho btn-lg btn-block" name="modificar" type="button" onclick="redirigirAModificarBackup()">Modificar Backup</button>

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


  <?


  mostrar_footer(); ?>








  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/script.js"></script>

</body>

</html>