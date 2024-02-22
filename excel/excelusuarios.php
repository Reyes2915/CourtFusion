<?php
include 'NOACCESIBLE/credencialesdb.php';

$c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
if ($stmt = mysqli_prepare($c2, "SELECT id_usuario, nombre, correo, rol, saldo FROM usuarios")) {
} else {
    echo "Error al preparar: " . mysqli_error($c2);
}

$stmt->execute();

if ($stmt->store_result()) {
} else {
    echo "Error al almacenar: " . mysqli_error($c2);
}

if (mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rcorreo, $rrol, $rsaldo)) {
} else {
    echo "Error al bindear: " . mysqli_error($c2);
}

// Create an excel file and fill it with data and headers using utf8_decode for Spanish characters
include 'xlsxwriter.class.php';

$filename = "Usuarios_Pistas.xlsx";
$workbook = new XLSXWriter();
$workbook->setAuthor('Usuarios_CourtFusion');
$workbook->writeSheetHeader('Usuarios_Pistas', array('ID' => 'string', 'Nombre' => 'string', 'Correo' => 'string', 'Rol' => 'string', 'Saldo' => 'string'), $col_options = array('widths' => array(20, 30, 30, 50, 30), 'suppress_row' => false));

while (mysqli_stmt_fetch($stmt)) {
    // Debugging: Imprimimos los tipos de cada variable

    try{
        $workbook->writeSheetRow('Usuarios_Pistas', array($rid, utf8_decode($rnombre), utf8_decode($rcorreo), utf8_decode($rrol), $rsaldo));
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
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
