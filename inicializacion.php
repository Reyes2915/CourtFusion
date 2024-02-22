<?php session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Courtfusion</title>
  <link rel="icon" href="imagenes/icono.jfif">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<?
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
  header("location: index.php");
}
include 'funciones.php';
mostrarNavbar();
$array = [];
include 'NOACCESIBLE/credencialesdb.php';
$c1 = new mysqli($host, $usuario, $contraseña) or die('Error de conexion a mysql: ' . $c1->error . '<br>');
if (mysqli_query($c1, 'DROP DATABASE IF EXISTS PistasDelgadoR;')) {
} else {
//echo ("No se ha borrar la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "CREATE DATABASE IF NOT EXISTS PistasDelgadoR;")) {
} else {
//echo ("No se ha podido crear la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "use PistasDelgadoR")) {
} else {
//echo ("No se ha podido seleccionar la base de datos, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario CHAR(36) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  correo VARCHAR(100) NOT NULL UNIQUE, -- Agregamos la restricción UNIQUE
  rol ENUM('Administrador', 'Usuario', 'Empresa') NOT NULL,
  saldo DECIMAL(10, 2) DEFAULT 0,
  contrasena VARCHAR(300) NOT NULL
)")) {
  // La tabla se creó exitosamente
} else {
  $error = mysqli_error($c1);
  $numerror = mysqli_errno($c1);
  $array[] = $error;
}


if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS empresas (
    id_empresa CHAR(36) PRIMARY KEY,
    nombre_empresa VARCHAR(100) NOT NULL,
    correo_contacto VARCHAR(100) NOT NULL,
    telefono_contacto VARCHAR(20) NOT NULL,
    comunidad_autonoma VARCHAR(50) NOT NULL,
    provincia VARCHAR(50) NOT NULL,
    municipio VARCHAR(50) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    codigo_postal VARCHAR(10) NOT NULL,
contrasena VARCHAR(300) NOT NULL
)")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS pistas (
  id_pista CHAR(36) PRIMARY KEY,
  tipo_pista ENUM('Fútbol', 'Baloncesto', 'Tenis', 'Pádel') NOT NULL,
  nombre_pista VARCHAR(100) NOT NULL,
  comunidad_autonoma VARCHAR(50) NOT NULL,
  provincia VARCHAR(50) NOT NULL,
  municipio VARCHAR(50) NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  codigo_postal VARCHAR(10) NOT NULL,
  correo_contacto VARCHAR(100) NOT NULL,
  telefono_contacto VARCHAR(20) NOT NULL,
  precio_hora DECIMAL(10, 2) NOT NULL,
  hora_apertura TIME NOT NULL,
  hora_cierre TIME NOT NULL,
  fecha_registro DATETIME NOT NULL,
  validacion ENUM('ACTIVA', 'POR VALIDAR','INACTIVA')DEFAULT 'POR VALIDAR',
  id_empresa CHAR(36),
  foreign key (id_empresa) references empresas(id_empresa)
)")) {
} else {
	$error = mysqli_error($c1);
	echo "Error al crear la tabla 'pistas': " . $error;
}
if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS valoraciones (
    id_valoracion CHAR(36) PRIMARY KEY,
    id_usuario CHAR(36),
    id_pista CHAR(36),  -- Corregido a CHAR(36)
    valoracion VARCHAR(7) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_pista) REFERENCES pistas(id_pista)
);")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
}
if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS reservas (
    id_reserva CHAR(36) PRIMARY KEY,
    id_usuario CHAR(36),
    id_pista CHAR(36),  -- Corregido a CHAR(36)
    nombre_reservante VARCHAR(90) NOT NULL,
    hora_inicio_reserva DATETIME NOT NULL,
    hora_fin_reserva DATETIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_pista) REFERENCES pistas(id_pista)
);")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
	echo $error;
}
if (mysqli_query($c1, "CREATE TABLE IF NOT EXISTS favoritos (
  id_favorito CHAR(36) PRIMARY KEY,
  id_usuario CHAR(36),
  id_pista CHAR(36),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
  FOREIGN KEY (id_pista) REFERENCES pistas(id_pista)
);")) {
} else {
//echo ("No se ha podido seleccionar la tabla libros, error:" . mysqli_error($c1));
	$error = mysqli_error($c1);
	$numerror = mysqli_errno($c1);
	$array[] = $error;
	echo $error;
}
$roles = array('Administrador', 'Usuario');
for ($i = 1; $i <= 40; $i++) {
	$id_usuario = uniqid();
	$nombre = "Usuario " . $i;
	$correo = "usuario" . $i . "@example.com";
	//Obten un rol aleatorio
	$rol = $roles[array_rand($roles)];
	$contraseña_usu = password_hash("password" . $i, PASSWORD_DEFAULT);
	$sql = "INSERT INTO usuarios (id_usuario, nombre, correo,rol, contrasena) VALUES (?, ?, ?, ?,?)";
	$stmt = mysqli_prepare($c1, $sql);
	if (mysqli_stmt_bind_param($stmt, "sssss", $id_usuario, $nombre, $correo, $rol, $contraseña_usu)) {} else {
		echo "Error al insertar usuario: " . mysqli_error($c1);
	}
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$tipos_pista = array('Fútbol', 'Baloncesto', 'Tenis', 'Pádel');
$comunidades = array('Comunidad1', 'Comunidad2', 'Comunidad3');
$provincias = array('Provincia1', 'Provincia2', 'Provincia3');
$municipios = array('Municipio1', 'Municipio2', 'Municipio3');
$direcciones= array('Calle1', 'Calle2', 'Calle3');
$codigos_postal = array('12345', '54321', '67890');
$correos_contacto = array('contacto1@example.com', 'contacto2@example.com', 'contacto3@example.com');
$telefonos_contacto = array('123456789', '987654321', '123456789');
$horas_apertura = array('08:00:00', '09:00:00', '10:00:00');
$horas_cierre= array('20:00:00', '21:00:00', '22:00:00');
// IDs de usuario inventados
$id_usuarios = [];
$c1 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c2->error . '<br>');
$sql = "SELECT id_usuario FROM usuarios";
$stmt = mysqli_prepare($c1, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id_usuario);
while (mysqli_stmt_fetch($stmt)) {
	$id_usuarios[] = $id_usuario;
}
for ($i = 1; $i <= 20; $i++) {
  $id_empresa=uniqid();
  $nombre_empresa = "Empresa " . $i;
  $correo_contacto = "empresa" . $i . "@example.com";
  $telefono_contacto = "123456789";
  $tipo_pista = $tipos_pista[array_rand($tipos_pista)];
  $nombre_pista = "Pista " . $i;
  $comunidad = $comunidades[array_rand($comunidades)];
  $provincia = $provincias[array_rand($provincias)];
  $municipio = $municipios[array_rand($municipios)];
  $direccion = $direcciones[array_rand($direcciones)];
  $codigo_postal = $codigos_postal[array_rand($codigos_postal)];
  $contraseña_emp = password_hash("password" . $i, PASSWORD_DEFAULT);
  $sql = "INSERT INTO empresas (id_empresa, nombre_empresa, correo_contacto, telefono_contacto, comunidad_autonoma, provincia, municipio, direccion, codigo_postal, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($c1, $sql);
  if (mysqli_stmt_bind_param($stmt, "ssssssssss", $id_empresa, $nombre_empresa, $correo_contacto, $telefono_contacto, $comunidad, $provincia, $municipio, $direccion, $codigo_postal, $contraseña_emp)) {
  } else {
    echo "Error al insertar empresa: " . mysqli_error($c1);
  }
  if (mysqli_stmt_execute($stmt)) {
  } else {
    echo "Error al insertar empresa: " . mysqli_error($c1);
  }
}
for ($i = 1; $i <= 60; $i++) {
	$id_pista = uniqid();
	$tipo_pista = $tipos_pista[array_rand($tipos_pista)];
	$nombre_pista = "Pista " . $i;
	$comunidad = "CANTABRIA";
	$provincia = "CANTABRIA";
	$municipio = "ANIEVAS";
  $direccion = $direcciones[array_rand($direcciones)];
	$codigo_postal = $codigos_postal[array_rand($codigos_postal)];
	$correo_contacto = $correos_contacto[array_rand($correos_contacto)];
	$telefono_contacto = $telefonos_contacto[array_rand($telefonos_contacto)];
  $validada= array('ACTIVA', 'POR VALIDAR','INACTIVA');
  $validacion = $validada[array_rand($validada)];
	$precio_hora = rand(1, 100);
  $hora_apertura = $horas_apertura[array_rand($horas_apertura)];
  $hora_cierre = $horas_cierre[array_rand($horas_cierre)];
  //Obtener un id de empresa aleatorio
 $c3= new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR') or die('Error de conexion a mysql: ' . $c3->error . '<br>');
  $sql = "SELECT id_empresa FROM empresas";
  $stmt = mysqli_prepare($c3, $sql);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id_empresa);
  while (mysqli_stmt_fetch($stmt)) {
    $id_empresas[] = $id_empresa;
  }
  $id_empresa = $id_empresas[array_rand($id_empresas)];
	$fecha_registro = date("Y-m-d H:i:s"); // Obtiene la fecha y hora actual
  $sql = "INSERT INTO pistas (id_pista, tipo_pista, nombre_pista, comunidad_autonoma, provincia, municipio, direccion, codigo_postal, correo_contacto, telefono_contacto, precio_hora, hora_apertura, hora_cierre, fecha_registro,validacion, id_empresa) VALUES (?,
  ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?,?)";
  $stmt = mysqli_prepare($c1, $sql);
  if (mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $id_pista, $tipo_pista, $nombre_pista, $comunidad, $provincia, $municipio, $direccion, $codigo_postal, $correo_contacto, $telefono_contacto, $precio_hora, $hora_apertura, $hora_cierre, $fecha_registro,$validacion, $id_empresa)) {
  } else {
    echo "Error al insertar pista: " . mysqli_error($c1);
  }

	if (mysqli_stmt_execute($stmt)) {

	} else {
		echo "Error al insertar pista: " . mysqli_error($c1);
	}
	mysqli_stmt_close($stmt);
}

?>
<section class="vh-100">
      <div class="container py-5 h-50">
        <div class="row d-flex justify-content-center align-items-center h-50">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong cartaverde" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <h3 class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle check" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                      d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                  </svg></h3>
                <h5>Biblioteca Creada correctamente</h5>
                <form method="post" action="index.php">
                  <button class="btn btn-lg btn-block btn btn-light" name="inicio" type="submit">Volver</button>
                </form>
              </div>
            </div>
            <div class="accordion-item mt-3">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed bg-danger text-white" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <strong class="text-center">Errores producidos en la creación</strong>
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="table-responsive">
                    <div class="col-md-12">
                      <table class="table table-striped table-hover table-bordered">
                        <caption class="text-center">
                          Errores
                        </caption>
                        <thead class="table-dark">
                          <tr>
                            <th>Error</th>
                          </tr>
                        </thead>
                        <tbody class="text-center" id="rows">
                          <?foreach ($array as $valor) {?>
                          <tr>
                            <th>
                              <?echo $valor ?>
                            </th>
                          </tr>
                          <?}?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
    </section>
</div>
<? mostrar_footer();?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/script.js"></script>
</body>