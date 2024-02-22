<?php
include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
$c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
$datetimeactual = date("Y-m-d H:i:s");
$stmt=$c2->prepare("DELETE FROM reservas WHERE hora_fin_reserva < ?");
$stmt->bind_param("s", $datetimeactual);
$stmt->execute();
$stmt->close();
$c2->close();
?>