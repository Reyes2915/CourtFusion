<?
include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
$c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
$stmt = mysqli_prepare($c2, "SELECT * from pistas");
$stmt->execute();
$stmt->store_result();
if (mysqli_stmt_bind_result($stmt, $id_pista, $tipo_pista, $nombre, $comunidad, $provincia, $municipio, $direccion, $cp, $correo, $telefono, $precio_hora, $horaapertura, $horacierre, $fecha, $validada, $id_usuario)) {
} else {
  echo "Error al bindear";
}
//create and excel(.xls) fill it with data and headers use ut8_decode for spanish characters and
include 'xlsxwriter.class.php';
$filename = "Pistas_CourtFusion.xlsx";
$workbook = new XLSXWriter();
$workbook->setAuthor('Pistas Courtfusion');
$workbook->writeSheetHeader('Pistas_CourtFusion', array('ID' => 'string', 'Tipo' => 'string', 'Nombre' => 'string', 'Comunidad' => 'string', 'Provincia' => 'string', 'Municipio' => 'string', 'Direccion' => 'string', 'CP' => 'string', 'Correo' => 'string', 'Telefono' => 'string', 'Precio_hora' => 'string', 'Hora_apertura' => 'string', 'Hora_cierre' => 'string', 'Fecha' => 'string', 'Validada' => 'string', 'ID_Usuario' => 'string'), $col_options = array('widths' => array(20, 30, 30, 50), 'suppress_row' => false));
while (mysqli_stmt_fetch($stmt)) {
  $workbook->writeSheetRow('Pistas_CourtFusion', array($id_pista, $tipo_pista, $nombre, $comunidad, $provincia, $municipio, $direccion, $cp, $correo, $telefono, $precio_hora, $horaapertura, $horacierre, $fecha, $validada, $id_usuario));
}
$workbook->writeToFile($filename);
header('Content-disposition: attachment; filename=' . $filename);
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header("xmlversion: '1.0'");
readfile($filename);
unlink($filename);
?>