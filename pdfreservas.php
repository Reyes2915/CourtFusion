<?php
session_start();
//Si no existe la sesión, redirecciona a la página index.php
if (!isset($_SESSION['isAdmin'])) {
    header("location: index.php");
  }
ob_start();
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'esp_ESP.UTF-8');
require_once 'fpdf/fpdf.php';
include 'NOACCESIBLE/credencialesdb.php'; //incluimos las credenciales de la base de datos
$c1 = new mysqli($host, $usuario, $contraseña, 'PistasDelgadoR');
class PDF extends FPDF {
//Cell with horizontal scaling if text is too wide
function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
{
    //Get string width
    $str_width=$this->GetStringWidth($txt);

    //Calculate ratio to fit cell
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $ratio = ($w-$this->cMargin*2)/$str_width;

    $fit = ($ratio < 1 || ($ratio > 1 && $force));
    if ($fit)
    {
        if ($scale)
        {
            //Calculate horizontal scaling
            $horiz_scale=$ratio*100.0;
            //Set horizontal scaling
            $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
        }
        else
        {
            //Calculate character spacing in points
            $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
            //Set character spacing
            $this->_out(sprintf('BT %.2F Tc ET',$char_space));
        }
        //Override user alignment (since text will fill up cell)
        $align='';
    }

    //Pass on to Cell method
    $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

    //Reset character spacing/horizontal scaling
    if ($fit)
        $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
}

//Cell with horizontal scaling only if necessary
function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
}

//Cell with horizontal scaling always
function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
}

//Cell with character spacing only if necessary
function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
}

//Cell with character spacing always
function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    //Same as calling CellFit directly
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
}
	// Cabecera de página
	function Header() {
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
			$this->Cell(0, 10, utf8_decode('Listado de usuarios'), 1, 0, 'C');
			//Title

			$this->Ln(20);
			$this->Cell(112, 10, utf8_decode('Nombre'), 1, 0, 'C');
			$this->Cell(135, 10, utf8_decode('Nombre Pista'), 1, 0, 'C');
			$this->Cell(15, 10, utf8_decode('Inicio'), 1, 0, 'C');
            $this->Cell(15, 10, utf8_decode('Fin'), 1, 0, 'C');
			$this->Ln();
		}
	}
	// Pie de página
	function Footer() {
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
$stmt = mysqli_prepare($c1, "SELECT id_reserva,u.nombre,p.nombre_pista,municipio,correo,hora_inicio_reserva,hora_fin_reserva  from usuarios u,pistas p, reservas r WHERE u.id_usuario=r.id_usuario AND p.id_pista=r.id_pista order by u.nombre DESC");
$stmt->execute();
mysqli_stmt_bind_result($stmt, $rid, $rnombre, $rpista, $rmunicipio, $rcorreo,$hora_inicio_reserva,$hora_fin_reserva);
while ($stmt->fetch()) {
    $pdf->CellFitScale(112, 10, utf8_decode($rnombre), 1, 0, 'C');
    $pdf->CellFitScale(135, 10, utf8_decode($rpista), 1, 0, 'C');
    $pdf->CellFitScale(15, 10, date('H:i', strtotime($hora_inicio_reserva)), 1, 0, 'C');
    $pdf->CellFitScale(15, 10, date('H:i', strtotime($hora_fin_reserva)), 1, 0, 'C');
    $pdf->Ln();
}

//open in blank page
$pdf->Output('I', 'ListadoReservasCourtFusion.pdf');
ob_end_flush();
?>
