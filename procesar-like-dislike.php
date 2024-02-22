<?php
// Verifica si la solicitud POST contiene los datos necesarios
if (isset($_POST['pistaId'], $_POST['usuarioId'], $_POST['action'])) {
    // Obtiene los datos de la solicitud
    $pistaId = $_POST['pistaId'];
    $usuarioId = $_POST['usuarioId'];
    $action = $_POST['action'];
    $like = 'like';
    $dislike = 'dislike';

    require 'NOACCESIBLE/credencialesdb.php';
    $conexion = new mysqli($host, $usuario, $contraseña, 'pistasDelgadoR');

    // Verifica la conexión a la base de datos
    if ($conexion->connect_error) {
        echo 'Error en la conexión a la base de datos: ' . $conexion->connect_error;
        die();
    }

    if ($action === 'like') {
        // Comprueba si el usuario ya ha dado "like" a la pista
        $stmt = mysqli_prepare($conexion, "SELECT * FROM valoraciones WHERE id_pista=? AND id_usuario=? AND valoracion=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $pistaId, $usuarioId, $like);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $id, $idpista, $idusuario, $valoracion);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    // El usuario ya ha dado "like" a la pista, así que elimina el "like"
                    $stmt = mysqli_prepare($conexion, "DELETE FROM valoraciones WHERE id_pista=? AND id_usuario=?");
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ss", $pistaId, $usuarioId);
                        if (mysqli_stmt_execute($stmt)) {
                            echo 'unliked'; // Devuelve una respuesta al cliente
                        } else {
                            echo 'Error al eliminar el like: ' . mysqli_error($conexion);
                        }
                    } else {
                        echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                    }
                } else {
                    // El usuario no ha dado "like" a la pista, así que agrega el "like" y elimina el "dislike" si existe
                    $stmt = mysqli_prepare($conexion, "DELETE FROM valoraciones WHERE id_pista=? AND id_usuario=? AND valoracion=?");
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $pistaId, $usuarioId, $dislike);
                        if (mysqli_stmt_execute($stmt)) {
                            // Agrega el "like"
                            $idvaloracionnuevolike = uniqid();
                            $stmt = mysqli_prepare($conexion, "INSERT INTO valoraciones (id_valoracion, id_usuario, id_pista, valoracion) VALUES (?, ?, ?, ?)");
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "ssss", $idvaloracionnuevolike, $usuarioId, $pistaId, $like);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo 'liked'; // Devuelve una respuesta al cliente
                                } else {
                                    echo 'Error al insertar el like: ' . mysqli_error($conexion);
                                }
                            } else {
                                echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                            }
                        } else {
                            echo 'Error al eliminar el dislike: ' . mysqli_error($conexion);
                        }
                    } else {
                        echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                    }
                }
            } else {
                echo 'Error al ejecutar la consulta: ' . mysqli_error($conexion);
            }
        } else {
            echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
        }
    } elseif ($action === 'dislike') {
        // Comprueba si el usuario ya ha dado "dislike" a la pista
        $stmt = mysqli_prepare($conexion, "SELECT * FROM valoraciones WHERE id_pista=? AND id_usuario=? AND valoracion=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $pistaId, $usuarioId, $dislike);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $id, $idpista, $idusuario, $valoracion);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    // El usuario ya ha dado "dislike" a la pista, así que elimina el "dislike"
                    $stmt = mysqli_prepare($conexion, "DELETE FROM valoraciones WHERE id_pista=? AND id_usuario=? AND valoracion=?");
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $pistaId, $usuarioId, $dislike);
                        if (mysqli_stmt_execute($stmt)) {
                            echo 'undisliked'; // Devuelve una respuesta al cliente
                        } else {
                            echo 'Error al eliminar el dislike: ' . mysqli_error($conexion);
                        }
                    } else {
                        echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                    }
                } else {
                    // El usuario no ha dado "dislike" a la pista, así que agrega el "dislike" y elimina el "like" si existe
                    $stmt = mysqli_prepare($conexion, "DELETE FROM valoraciones WHERE id_pista=? AND id_usuario=? AND valoracion=?");
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $pistaId, $usuarioId, $like);
                        if (mysqli_stmt_execute($stmt)) {
                            // Agrega el "dislike"
                            $idvaloracionnuevodislike = uniqid();
                            $stmt = mysqli_prepare($conexion, "INSERT INTO valoraciones (id_valoracion, id_pista, id_usuario, valoracion) VALUES (?, ?, ?, ?)");
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "ssss", $idvaloracionnuevodislike, $pistaId, $usuarioId, $dislike);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo 'disliked'; // Devuelve una respuesta al cliente
                                } else {
                                    echo 'Error al insertar el dislike: ' . mysqli_error($conexion);
                                }
                            } else {
                                echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                            }
                        } else {
                            echo 'Error al eliminar el like: ' . mysqli_error($conexion);
                        }
                    } else {
                        echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
                    }
                }
            } else {
                echo 'Error al ejecutar la consulta: ' . mysqli_error($conexion);
            }
        } else {
            echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
        }
    }
} else {
     // El usuario no está autenticado
     $toastContent = "<div class='toast-container position-fixed bottom-0 end-0 p-3'>";
     $toastContent .= "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='mytoast' data-bs-delay='3000' data-bs-autohide='true'>";
     $toastContent .= "<div class='toast-header bg-orange text-white'>";
     $toastContent .= "<img src='./imagenes/logo-removebg-preview.png' class='rounded me-2 img-fluid' alt='...' style='max-height: 30px; max-width: 30px;'>";
     $toastContent .= "<strong class='me-auto text-white'>CourtFusion</strong>";
     $toastContent .= "<small class='text-white'>Ahora Mismo</small>";
     $toastContent .= "<button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>";
     $toastContent .= "</div>";
     $toastContent .= "<div class='toast-body text-black'>";
     $toastContent .=  "Actualmente no has iniciado sesión.";
     $toastContent .= "<a href='perfil.php'>Iniciar Sesión</a>";
     $toastContent .= "</div>";
     $toastContent .= "</div>";
     $toastContent .= "</div>";;
echo $toastContent;
echo '<script>
$(document).ready(function() {
$("#mytoast").toast("show");
});
</script>';
}
?>
