<?
session_start();
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }
$zip = new ZipArchive();
//Get today's date
$fecha = date("d-m-Y");
$archivo = "CourtFusion_" . $fecha . ".zip";
$rutabackup = "../";
$ruta = "../TFG/";
//chmod($ruta, 0777);
function BackUp($zip, $ruta) {
	foreach (scandir($ruta) as $elemento) {
		//Descarto el directorio raiz y el actual
		if ($elemento != "." && ($elemento != "..")) {
			//Si es una carpeta la añado al zip y cambio la ruta volviendo a llamar a la funcion
			if (is_dir($ruta . "/" . $elemento)) {
				$zip->addEmptyDir($ruta . "/" . $elemento);
				$nuevaRuta = $ruta . "/" . $elemento;
				BackUp($zip, $nuevaRuta);
			} else {
				//Si es un archivo lo añado al zip con la misma ruta y nombre
				$zip->addFile($ruta . "/" . $elemento, $ruta . "/" . $elemento);
			}
		}
	}
}
if ($zip->open($archivo, ZIPARCHIVE::CREATE) !== TRUE) {
	exit("cannot open <$archivo>\n");
}
BackUp($zip, $ruta);
$zip->close();
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=$archivo");
header("Content-length: " . filesize($archivo));
header("Pragma: no-cache");
header("Expires: 0");
readfile("$archivo");
unlink($archivo);
?>
