<?
include "NOACCESIBLE/credencialesdb.php";
$c1=new mysqli($host,$user,$pass,'pistasDelgadoR');
if ($c1->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $c1->connect_errno . ") " . $c1->connect_error;
}
$stmt=mysqli_prepare($conexion,"SELECT * FROM pistas");
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt,$id, $tipo, $nombre, $comunidad, $provincia, $municipio, $cp, $correo, $telefono, $precio, $fecha, $idusu);




?>