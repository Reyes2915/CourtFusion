<?php
// obtener_reservas.php

header('Content-Type: application/json');

// ... (Conexión a la base de datos y otros detalles)
include "NOACCESIBLE/credencialesdb.php";
$conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibe los datos del formulario
$idPista = $_POST['idPista'];
$fecha = $_POST['fecha'];

// Preparar y ejecutar la consulta

$stmt = mysqli_prepare($conexion, "SELECT id_pista, hora_inicio_reserva, hora_fin_reserva
                                   FROM reservas r
                                   WHERE r.id_pista = ? AND DATE_FORMAT(hora_inicio_reserva, '%Y-%m-%d') = ?");
mysqli_stmt_bind_param($stmt, 'is', $idPista, $fecha);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $idPista, $horaInicioReservaPista, $horaFinReservaPista);

if (mysqli_stmt_fetch($stmt)) {
    $conexion2 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
    if (
        $stmt2 = mysqli_prepare($conexion2, "SELECT hora_inicio_reserva, hora_fin_reserva, hora_apertura, hora_cierre
                                            FROM reservas r, pistas p
                                            WHERE r.id_pista = p.id_pista 
                                                AND r.id_pista = ? 
                                                AND DATE_FORMAT(hora_inicio_reserva, '%Y-%m-%d') = ?")
    ) {
    } else {
        echo "Error: " . mysqli_error($conexion2);
    }

    mysqli_stmt_bind_param($stmt2, 'is', $idPista, $fecha);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_bind_result($stmt2, $horaInicioReserva, $horaFinReserva, $horaApertura, $horaCierre);

    // Procesar los resultados
    $horasReservas = [];
    while (mysqli_stmt_fetch($stmt2)) {
        $horasReservas[] = [
            'inicio' => date('H:i', strtotime($horaInicioReserva)),
            'fin' => date('H:i', strtotime($horaFinReserva))
        ];
    }

    // ... (código para obtener las reservas)

    // Formatea las horas de apertura y cierre de la pista
    $horaAperturaPista = date('H:i', strtotime($horaApertura));
    $horaCierrePista = date('H:i', strtotime($horaCierre));

    // 3. Desactiva esas horas en el clockpicker
    $horasDesactivar = [];

    foreach ($horasReservas as $horaReserva) {
        $horaInicio = date('H:i', strtotime($horaReserva['inicio']));
        $horaFin = date('H:i', strtotime($horaReserva['fin']));

        // Puedes ajustar la lógica aquí según sea necesario
        // Agrega las horas al array de horas a desactivar
        $horasDesactivar[] = $horaInicio;
        $horasDesactivar[] = $horaFin;
    }

    // Convierte el array de horas a desactivar a una cadena CSV
    $horasDesactivarCSV = implode(',', $horasDesactivar);

    // Construye el array con la información necesaria
    $responseData = [
        'horasDesactivar' => $horasDesactivar,
        'horaApertura' => $horaAperturaPista,
        'horaCierre' => $horaCierrePista
    ];
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    mysqli_close($conexion2);

    // Envía la respuesta en formato JSON
    echo json_encode($responseData);
} else {
    $conexion3 = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');
    
    // Hago la consulta para obtener la hora de apertura y cierre de la pista
    $stmt3 = mysqli_prepare($conexion3, "SELECT hora_apertura, hora_cierre
                                        FROM pistas
                                        WHERE id_pista = ?");
    
    mysqli_stmt_bind_param($stmt3, 's', $idPista);
    mysqli_stmt_execute($stmt3);

    // Vincula las variables de resultado
    mysqli_stmt_bind_result($stmt3, $horaAperturaNoReserva, $horaCierreNoReserva);

    // Obtiene los resultados
    $result = mysqli_stmt_fetch($stmt3);

    if ($result) {
        // Si hay resultados, construye el array con la información necesaria
        $responseData2 = [
            'horasDesactivar' => [],
            'horaApertura' => $horaAperturaNoReserva,
            'horaCierre' => $horaCierreNoReserva,
        ];
        echo json_encode($responseData2);
    } else {
        // No se encontraron registros, puedes manejar esto como desees
        echo json_encode(['mensaje' => "No se encontraron registros para la pista con ID: $idPista"]);
    }
    
    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt3);
    mysqli_close($conexion3);
}



?>


