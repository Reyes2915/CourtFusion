<?php
// Datos de conexión a la base de datos
include 'NOACCESIBLE/credencialesdb.php';
$database= 'PistasDelgadoR';
$mysqli = new mysqli($host, $usuario, $contraseña,$database);

// Verificar la conexión
if ($mysqli->connect_errno) {
    echo "Error al conectar con la base de datos: " . $mysqli->connect_error;
    exit;
}

// Consulta para obtener todas las tablas de la base de datos
$tables = array();
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Iniciar el contenido del respaldo
$sql = '';
foreach ($tables as $table) {
    // Consulta para obtener la estructura de la tabla
    $result = $mysqli->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    $sql .= "\n\n" . $row[1] . ";\n\n";

    // Consulta para obtener los datos de la tabla
    $result = $mysqli->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $sql .= "INSERT INTO $table VALUES(";
        foreach ($row as $value) {
            $sql .= "'" . $mysqli->real_escape_string($value) . "',";
        }
        $sql = rtrim($sql, ',') . ");\n";
    }
}

// Cerrar la conexión
$mysqli->close();

//Si el nombre de la base de datos tiene _ las quitamos y juntamos
$database = str_replace("_", "", $database);
// Nombre del archivo de respaldo con el nombre de la base de datos
$backup_file = 'backups/' . $database . '_backup_' . date('d-m-Y') . '.sql';

// Guardar el contenido del respaldo en un archivo
if (file_put_contents($backup_file, $sql)) {
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
                            <h5>Backup creado correctamente</h5>
                            <form method="post" action="backup.php">
                                <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-50">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong bg-danger" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill check" viewBox="0 0 16 16">
                                <path d="M8 0A8 8 0 0 0 0 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8A8 8 0 0 0 8 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 1 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708z" />
                            </svg></h3>
                            <h5>Error creando backup</h5>
                            <form method="post" action="backup.php">
                                <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>



