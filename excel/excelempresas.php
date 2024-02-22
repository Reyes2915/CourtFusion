<?php
include 'NOACCESIBLE/credencialesdb.php';

$c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');

// Obtener información de empresas
if ($stmtEmpresas = mysqli_prepare($c2, "SELECT id_empresa, nombre_empresa, correo_contacto, telefono_contacto, comunidad_autonoma, provincia, municipio, direccion, codigo_postal, contrasena FROM empresas")) {
    $stmtEmpresas->execute();

    if ($stmtEmpresas->store_result()) {
        if (mysqli_stmt_bind_result($stmtEmpresas, $eid, $enombre_empresa, $ecorreo_contacto, $etelefono_contacto, $ecomunidad_autonoma, $eprovincia, $emunicipio, $edireccion, $ecodigo_postal, $econtrasena)) {

            // Crear un array para almacenar los datos
            $data = array();

            while (mysqli_stmt_fetch($stmtEmpresas)) {
                $rowData = array($eid, utf8_decode($enombre_empresa), utf8_decode($ecorreo_contacto), $etelefono_contacto, utf8_decode($ecomunidad_autonoma), utf8_decode($eprovincia), utf8_decode($emunicipio), utf8_decode($edireccion), $ecodigo_postal, utf8_decode($econtrasena));
                $data[] = $rowData;
            }

            include 'xlsxwriter.class.php';
            $filename = "Empresas_CourtFusion.xlsx";
            $workbook = new XLSXWriter();
            $workbook->setAuthor('Empresas_CourtFusion');

            // Agregar encabezados para empresas
            $workbook->writeSheetHeader('Empresas', array('ID' => 'string', 'Nombre' => 'string', 'Correo' => 'string', 'Teléfono' => 'string', 'Comunidad Autónoma' => 'string', 'Provincia' => 'string', 'Municipio' => 'string', 'Dirección' => 'string', 'Código Postal' => 'string', 'Contraseña' => 'string'), $col_options = array('widths' => array(20, 100, 100, 20, 50, 50, 50, 100, 10, 300), 'suppress_row' => false));

            // Escribir los datos al archivo Excel
            foreach ($data as $rowData) {
                $workbook->writeSheetRow('Empresas', $rowData);
            }

            $workbook->writeToStdOut( $filename . '.xlsx');

            // Configuración de encabezados para descargar el archivo
            header('Content-disposition: attachment; filename=' . $filename);
            header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header("xmlversion: '1.0'");

            // Leer y descargar el archivo
            readfile($filename);
            unlink($filename);

        } else {
            echo "Error al bindear para Empresas: " . mysqli_error($c2);
        }
    } else {
        echo "Error al almacenar para Empresas: " . mysqli_error($c2);
    }

    mysqli_stmt_close($stmtEmpresas);
} else {
    echo "Error al preparar para Empresas: " . mysqli_error($c2);
}

mysqli_close($c2);
?>





