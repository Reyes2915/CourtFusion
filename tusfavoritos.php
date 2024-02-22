<?session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Tus favoritos</title>
  <link rel="icon" href="imagenes/icono.jfif">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" async defer></script>
  <link type="text/css" rel="stylesheet" href="css/estilos.css">
</head>

<body id="bodyfavoritos">

<?
include "NOACCESIBLE/credencialesdb.php";
include "funciones.php";
// Si el usuario está autenticado, obtén el ID de la pista desde la solicitud
if (isset($_POST['pista_id'])) {
	buscarFavorito();
}
mostrarNavbar();
?>

  
  <?
mostrarFavoritos();
?>

<?
mostrar_footer();
?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/pruebanovedades.js"></script>
    <script src="js/tabla.js"></script>
</body>

</html>