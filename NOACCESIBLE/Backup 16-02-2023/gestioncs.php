<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="libros.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?
if (isset($_POST['generar'])) {
    function BackUp($zip, $ruta)
    {
        foreach (scandir($ruta) as $value) {
            //Descarto el directorio raiz y el actual
            if ($value != "." && ($value != "..")) {
                //Si es una carpeta la añado al zip y cambio la ruta volviendo a llamar a la funcion
                if (is_dir($ruta . "/" . $value)) {
                    $zip->addEmptyDir($ruta . "/" . $value);
                    $nuevaRuta = $ruta . "/" . $value;
                    BackUp($zip, $nuevaRuta);
                } else {
                    //Si es un archivo lo añado al zip con la misma ruta y nombre
                    $zip->addFile($ruta . "/" . $value, $ruta . "/" . $value);
                }
            }
        }
    }

    $filename = "./backups";

    if (!file_exists($filename)) {
        mkdir('./backups', 0777, true);
    } else {
    }
    $zip = new ZipArchive();
    $fecha = date("d-m-Y", time());
    $zip->open("backups/Backup(" . $fecha . ").zip", ZIPARCHIVE::CREATE);
    BackUp($zip, ".");
    $zip->close();
    $fecha = date("d-m-Y", time());
    header("Content-disposition: attachment; filename=Backup(" . $fecha . ").zip");
    readfile("Backup(" . $fecha . ").zip");
}
if (isset($_POST['restaurar'])) {
    if (($_POST['zip']) == null) {
        echo "Debes insertar un archivo zip";
    } else {
        $zip1 = new ZipArchive();
        if (!($zip1->open($_POST['zip']))) {
            echo "No se ha podido abrir el archivo";
        } else {
            $fecha = date("d-m-Y", time());
            $zip1->extractTo('./Backup ' . $fecha);
            $zip1->close();
            echo "El backup de la fecha " . $fecha . " ha sido realizado con exito";
        }
    }
}

?>
<form action="" method="post">


    <section class="vh-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                    <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                </svg></h3>
                            <input type="file" name="zip" class="mt-3">
                            <br>
                            <input type="submit" value="Crear backup" name="generar" class="btn btn-primary btn-block mt-3">
                            <input type="submit" value="Restaurar backup" name="restaurar" class="btn btn-primary btn-block mt-3">
                        </div>
                    </div>
                </div>
            </div>
    </section>
</form>
</body>

</html>