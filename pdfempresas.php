<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PDF Empresas</title>
	<link rel="icon" href="imagenes/icono.jfif" alt="Icono de la página">
</head><?php
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }
		ob_start();
		date_default_timezone_set('Europe/Madrid');
		setlocale(LC_TIME, 'esp_ESP.UTF-8');
		require_once 'fpdf/fpdf.php';
		include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
		$c2 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
		define('EURO', chr(128));
		class PDF extends FPDF
		{
			//Cell with horizontal scaling if text is too wide
			function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
			{
				//Get string width
				$str_width = $this->GetStringWidth($txt);

				//Calculate ratio to fit cell
				if ($w == 0)
					$w = $this->w - $this->rMargin - $this->x;
				$ratio = ($w - $this->cMargin * 2) / $str_width;

				$fit = ($ratio < 1 || ($ratio > 1 && $force));
				if ($fit) {
					if ($scale) {
						//Calculate horizontal scaling
						$horiz_scale = $ratio * 100.0;
						//Set horizontal scaling
						$this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
					} else {
						//Calculate character spacing in points
						$char_space = ($w - $this->cMargin * 2 - $str_width) / max(strlen($txt) - 1, 1) * $this->k;
						//Set character spacing
						$this->_out(sprintf('BT %.2F Tc ET', $char_space));
					}
					//Override user alignment (since text will fill up cell)
					$align = '';
				}

				//Pass on to Cell method
				$this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

				//Reset character spacing/horizontal scaling
				if ($fit)
					$this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
			}
			//Cell with horizontal scaling only if necessary
			function CellFitScale($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
			{
				$this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, false);
			}

			//Cell with horizontal scaling always
			function CellFitScaleForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
			{
				$this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, true);
			}

			//Cell with character spacing only if necessary
			function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
			{
				$this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
			}

			//Cell with character spacing always
			function CellFitSpaceForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
			{
				//Same as calling CellFit directly
				$this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, true);
			}
			// Cabecera de página
			function Header()
			{
				// Logo cifp
				$this->Image('imagenes/logo-removebg-preview-removebg-preview.png', 10, 8, 50, 50);
				//Logo pedro mercedes
				//$this->Image('imagenes/logopedro.jpg',170,8,30,20);
				// Arial bold 15
				$this->SetFont('Arial', 'B', 15);

				// Salto de línea
				$this->Ln(50);
				// Half of A4 width
				$w = $this->GetPageWidth() / 2;

				// Título
				{
					//Center in page
					$this->Cell(0, 10, utf8_decode('Listado de empresas'), 1, 0, 'C');
					//Title

					$this->Ln(20);
					$this->Cell(60, 10, utf8_decode('Nombre'), 1, 0, 'C');
                    $this->Cell(45, 10, utf8_decode('Correo'), 1, 0, 'C');
                    $this->Cell(25, 10, utf8_decode('Teléfono'), 1, 0, 'C');
                    $this->Cell(30, 10, utf8_decode('Provincia'), 1, 0, 'C');
                    $this->Cell(50, 10, utf8_decode('Municipio'), 1, 0, 'C');
                    $this->Cell(65, 10, utf8_decode('Dirección'), 1, 0, 'C');



					$this->Ln();
				}
			}

			// Pie de página
			function Footer()
			{
				// Posición: a 1,5 cm del final
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial', 'I', 8);
				// Número de página
				$this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . ' de {nb}'), 0, 0, 'C');
			}
		}
		$pdf = new PDF('L', 'mm', 'A4');
		$pdf->SetFont('Arial', '', 12);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetMargins(10, 20, 20);
		$pdf->SetAutoPageBreak(true, 20);
		if ($stmt = mysqli_prepare($c2, "SELECT nombre_empresa,correo_contacto,telefono_contacto,provincia,municipio,direccion from empresas")){
		} else {
			echo mysqli_error($c2);
		}
		if (mysqli_stmt_execute($stmt)) {
		} else {
			echo mysqli_error($c2);
		}
		if (mysqli_stmt_bind_result($stmt, $nombre, $correo, $telefono, $provincia, $municipio, $direccion)) {
		} else {
			echo mysqli_error($c2);
		}
		// ...
		while (mysqli_stmt_fetch($stmt)) {
			// Calcula la altura máxima requerida para cada celda en función de su contenido y ancho
			$pdf->CellFitScale(60, 10, utf8_decode($nombre), 1, 0, 'C');
			$pdf->CellFitScale(45, 10, utf8_decode($correo), 1, 0, 'C');
			$pdf->CellFitScale(25, 10, utf8_decode($telefono), 1, 0, 'C');
            $pdf->CellFitScale(30, 10, utf8_decode($provincia), 1, 0, 'C');
			$pdf->CellFitScale(50, 10, utf8_decode($municipio), 1, 0, 'C');
            $pdf->CellFitScale(65, 10, utf8_decode($direccion), 1, 0, 'C');
			$pdf->Ln();
		}

		$pdf->Output('I', 'ListadoEmpresasCourtFusion.pdf');
		ob_end_flush();
