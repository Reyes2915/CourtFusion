<? session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Backup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <?
  include 'funciones.php';
  mostrarNavbar();
  if (isset($_GET['modifback'])) {
    $nombre = $_GET['nombre'];
    //$fecha=strtotime('d-m-Y',$_GET['fecha']);
    $fecha = date('d-m-Y', strtotime(basename($_GET['fecha'])));
    $nombreantiguo = $_GET['nombre_antiguo'];

    if (rename('backups/'.$nombreantiguo.'_backup_'.$fecha.".sql", 'backups/' . $nombre . '_backup_' . $fecha . ".sql") == true) {
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
                  <h5>Backup modificado correctamente</h5>
                  <form method="post" action="backup.php">
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
                  <h5>Error modificando backup</h5>
                  <form method="post" action="backup.php">
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
  ?>
  <div class="table-responsive mt-3">
    <div class="col-md-12">
      <table class="table table-striped table-hover table-bordered display" id="example">
        <caption class="text-center">
          Backups
        </caption>

        <thead class="table-dark">
          <tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Modificar archivo?</th>
          </tr>
        </thead>
        <? // read all the files from the directory ./backups and print the name and date orderen from newer to older with archives of format name_backup_date.sql and a button to download the file
        $files = glob('./backups/*');
        usort($files, function ($a, $b) {
          return filemtime($a) < filemtime($b);
        });
        foreach ($files as $file) {
          if ($file != '.' && $file != '..') {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext == 'sql') {

              $name = explode('_', $file);
              $date = explode('.', $name[2]);
        ?>
              <tbody>
                <tr>
                  <form method="get" action="">
                    <th class="text-center">
                    <input type="hidden" name="nombre_antiguo" value="<?php echo basename($name[0]); ?>">
                    <label for="<?php echo basename($name[0]) . ' ' . date('Y-m-d', strtotime(basename($date[0]))); ?>" value="<? echo basename($name[0]); ?>" class="visually-hidden">Nombre</label>
                      <input type="text" name="nombre" id="<?php echo basename($name[0]) . ' ' . date('Y-m-d', strtotime(basename($date[0]))); ?>" value="<? echo basename($name[0]); ?>" required>
                    </th>
                    <th class="text-center">
                    <label for="<?php echo date('Y-m-d', strtotime(basename($date[0]))) . ' ' . basename($name[0]); ?>" class="visually-hidden">Fecha y Nombre</label>
                      <input type="date" class="mx-auto" id="<?php echo date('Y-m-d', strtotime(basename($date[0]))) . ' ' . basename($name[0]); ?>" name="fecha" value="<? echo date('Y-m-d', strtotime(basename($date[0]))); ?>" required>
                    </th>
                    <th>
                      <div class="text-center text-decoration-none">
                        <a href="modificarbackup.php?modifback=modifback&&nombre=<? echo basename($name[0]) ?>&fecha=<? echo basename($date[0]) ?>">
                          <button type="button" id="modifback" name="modifback" value="modifback" class="btn botonancho btn-lg mx-auto">Modificar Backup</button></a>
                      </div>
                    </th>
                  </form>
                </tr>
              </tbody>
        <?php
            }
          }
        }
        ?>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="text-center">
    <a href="backup.php" class="text-decoration-none">
      <div class="d-flex justify-content-center mb-2"> <!-- Envolver el botón en un div centrado -->
        <button type="submit" id="volver" name="volver" class="btn botonancho btn-lg mx-auto">Volver</button> <!-- Agregar la clase mx-auto para centrar horizontalmente -->
      </div>
    </a>
  </div>

  <?


  mostrar_footer();
  ?>





  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/script.js"></script>
</body>