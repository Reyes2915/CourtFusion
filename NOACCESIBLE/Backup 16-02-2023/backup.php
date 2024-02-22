<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="imagenes/libros.jpg">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<?
if (isset($_POST['crear'])) {
    function BackUp($zip, $ruta)
    {
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



    $filename = "./backups";

    if (!file_exists($filename)) {
        mkdir('./backups', 0777, true);
    } else {
    }
    $zip = new ZipArchive();
    $fecha = date("d-m-Y", time());
    
    $zip->open("./backups/Backup(" . $fecha . ").zip", ZIPARCHIVE::CREATE);
    BackUp($zip,'.');
    $zip->close();
    $fecha = date("d-m-Y", time());
    header("Content-disposition: attachment; filename=Backup(" . $fecha . ").zip");
    readfile("backups/Backup(" . $fecha . ").zip");
}
if (isset($_POST['restaurar'])) {
    if (($_FILES['zip']['tmp_name']) == null) {
        echo "Debes insertar un archivo zip";
    } else {
        $zip1 = new ZipArchive();
        if (!($zip1->open($_FILES['zip']['tmp_name'], ZIPARCHIVE::CREATE))) {
            echo "No se ha podido abrir el archivo";
        } else {
            $fecha = date("d-m-Y", time());
            $zip1->extractTo('./Backup ' . $fecha);
            $zip1->close();
            echo "El backup de la fecha " . $fecha . " ha sido realizado con exito";
        }
    }
    print_r($_FILES['zip']['tmp_name']);
}

?>
<div class="container-fluid">
    <nav class="navbar navbar-default">
        <a class="navbar-brand pull-left" href="index.php"><img id="logo" src="imagenes/logocifp.png"></a>
        <div class="navbar navbar-expand-lg d-block d-lg-block" id="paginas">

            </a>
            <ul class="navbar-nav ms-auto ms-2 ">
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://educamosclm.castillalamancha.es/">
                        <img src="imagenes/educamos.png" alt="Educamos" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Educamos

                    </span>
                </li>
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://delphos.jccm.es/delphos/jsp/pag_inicio1024.jsp">
                        <img src="imagenes/delphos.png" alt="Delphos" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Delphos

                    </span>
                </li>
                <li class="nav-item me-5 mt-5 ms-2 d-inline d-lg-block">
                    <a href="https://aulasfp2223.castillalamancha.es/">
                        <img src="imagenes/elearning.png" alt="Fp" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">FP a distancia
                        </a>
                </li>
                <li class="nav-item mt-5 me-5 d-inline d-lg-block">
                    <a href="http://pop.jccm.es/acredita/">
                        <img src="imagenes/acreditaCLM.png" alt="Acredita" width="80" height="50">
                    </a>

                    <br>
                    <span class="navbar-brand pull-left fs-6 ms-2">Acredita
                    </span>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light" id="menu">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="nav justify-content-center">
                    <li class="nav-item  ms-3 me-3">
                        <a class="nav-link ms-3" href="index.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3" href="administracion.php">Administración</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form method="post" action="" class="d-inline ms-2" enctype="multipart/form-data">
        <div class="container">
            <section class="vh-300">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center" id="carta">
                                    <h1 class="mb-5">Acciones</h1>
                                    <h3 class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                            <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                        </svg></h3>

                                    <input type="file" name="zip" class="mt-3 mb-3">
                                    <br>

                                    <button class="btn botonancho btn-lg btn-block " name="crear" type="submit">Crear Backup</button>



                                    <button class="btn botonancho btn-lg btn-block " name="restaurar" type="submit">Restaurar Backup</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

</html>