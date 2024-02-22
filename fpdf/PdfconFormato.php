<?

	include("fpdf/PDF_WriteTag.php");
	define('FPDF_FONTPATH','fpdf/font');
	
	date_default_timezone_set('Europe/Madrid');
	setlocale(LC_TIME, 'esp');
	
	$parte0="Cabecera de todo el Texto";
	$parte1="<p>De una parte, REPRESENTANTE <sb>".$nrp1."</sb> mayor de edad, con DNI <sb>"."12345678W"."</sb> y REPRESENTANTE <sb>".$nrp2."</sb> mayor de edad, con DNI <sb>".$dnirp2."</sb>, quienes actúan en nombre y representación de los profesionales que trabajan para <b>Tecnogados</b>, en calidad de Apoderados, y</p><p>De otra parte, PROVEEDOR, <sb>".$npro1."</sb> mayor de edad, con DNI <sb>".$dnipro1."</sb> y PROVEEDOR, <sb>".$npro2."</sb> mayor de edad, con DNI <sb>".$dnipro2."</sb> que actúan en nombre y representación de la empresa <sb>".$empresa."</sb> con domicilio social en <sb>".$dirempresa.", ".$cpempresa."</sb> y CIF <sb>".$cifempresa."</sb>, en calidad de <sb>".$crpro."</sb>.</p><p>
Ambas partes (en adelante \"<b>las partes</b>\" se reconocen plena y mutuamente capacidad legal para contratar y obligarse, y ambas:<p>";
	$parte2="<p>Que <b>las Partes</b> están interesadas en iniciar dicha colaboración profesional.</p>";
	
	class efpdf extends PDF_WriteTag {
		function Header(){
			$this->Setxy(90,20);
			$this->SetTextColor(150);
			$this->SetFont("arial","", 11);
			$this->MultiCell(0, 5, "CONFIDENCIAL");
			$this->Image('imagenes/Logo.png',140,10,50);
			$this->Ln();
			$this->Ln();
		}
		function Footer(){
			$this->Setxy(20,283);
			$this->SetTextColor(150);
			$this->SetFont("arial","", 10);
			$this->MultiCell(0, 5, "A fecha de ".strftime("%d de %B de %Y")."                                                                                                 ".utf8_decode(" PÃ¡g ".$this->PageNo()." de "."{nb}"),0,"J",false);
		}
	}

	$dimensiones=array (210,297);
	$pdf1=new efpdf('P','mm',$dimensiones);
	$pdf1->AliasNbPages();
	$pdf1->Addpage();

	$pdf1->SetMargins(20,20,20);
	$pdf1->SetAutoPageBreak(true, 20);
	
	//Estilos para Tags
	$pdf1->SetStyle("p","arial","N",11,"0,0,0",4);
	$pdf1->SetStyle("b","arial","B",11,"0,0,0");
	$pdf1->SetStyle("sb","arial","N",11,"60,60,60");
	
	//Contenido	
	$pdf1->SetTextColor(0,0,0);
	$pdf1->SetFont("arial","B", 36);
	$pdf1->Sety(58);
	$pdf1->MultiCell(0,5,utf8_decode($parte0),0,"C",false);
	$pdf1->Ln();
	$pdf1->SetFont("arial","B", 16);
	$pdf1->WriteTag(0,5,utf8_decode($parte1),0,"J",0);
	$pdf1->Ln(2);
	$pdf1->SetFont("arial","", 16);
	$pdf1->WriteTag(0,5,utf8_decode($parte2),0,"J",0);
	$pdf1->Ln(2);

	
	$pdf1->output();
	
?>