<?php
include 'conexion.php';
require('../pdfphp/fpdf/fpdf.php');
$folio=$_GET['folio'];

$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.nombre, a.ap_paterno, a.ap_materno, c.folio_cita,c.hora_cita,c.fecha_cita,c.docente,c.motivos_cita ,ad.nombreA,ad.ap_paternoA, g.grado, gr.grupo, t.nombre_tutor,t.ap_paterno_tutor,t.ap_materno_tutor FROM citatorios as c, grado as g, grupo as gr, alumnos as a, admin as ad, tutor as t WHERE c.folio_cita='$folio' AND c.matricula_alumnos=a.matricula AND a.matricula_grado=g.matricula_grado AND a.matricula_grupo=gr.matricula_grupo AND c.matricula_admin= ad.matricula_admin AND t.matricula_tutor=a.matricula_tutor");
$sentencia->execute();
$fila = $sentencia->fetch();
$nombre=$fila['nombre'];
$ap1=$fila['ap_paterno'];
$ap2=$fila['ap_materno'];
$hora=$fila['hora_cita'];
$fecha=$fila['fecha_cita'];
$docente=$fila['docente'];
$motivo=$fila['motivos_cita'];
$nomA=$fila['nombreA'];
$apA=$fila['ap_paternoA'];
$grado=$fila['grado'];
$grupo=$fila['grupo'];
$Tnombre=$fila['nombre_tutor'];
$apT=$fila['ap_paterno_tutor'];
$apT2=$fila['ap_materno_tutor'];


class PDF extends FPDF

{
// Cabecera de página
function Header()
{
	// Logo
	$this->Image('../img/logo_pb.jpg',10,8,33,0);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->Cell(30,10,'COLEGIO DE BACHILLERES DE TABASCO',0,0,'C');
	// Salto de línea
	$this->Ln(8);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->Cell(30,10,'ORGANIZMO DESCENTRALIZADO DEL ESTADO',0,0,'C');
	$this->Ln(8);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->SetFont('Arial','B',10);
	$this->Cell(10,8,'PLANTEL No.41',0,2,'C');
	
	$this->Cell(10,8,'NOTIFICACION',0,0,'C');
	$this->Ln(10);
}

// Pie de página
function Footer()
{
	// Posición: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Número de página
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Cell(0,10,'No. '.$folio,0,1,'R');
$pdf->Cell(0,10,'C.SR.(A): '.$Tnombre." ".$apT." ".$apT2,0,1);
$pdf->Cell(0,10,'SE LE SOLICITA SU PRECENCIA PARA LA SIGUIENTE FECHA: '.$fecha,0,1);
$pdf->Cell(0,10,'PARA TRATAR ASUNTO RELACIONADO CON LA CONDUCTA DE SU HIJO(A): '.$nombre." ".$ap1." ".$ap2,0,1);

$pdf->Cell(0,10,'DEL SEMESTRE: '.$grado.'          '.'GRUPO: '.$grupo.'       '.'A LAS: '.$hora.'   CON EL (LA) DOCENTE: '.$docente,0,1);

$pdf->Cell(0,10,'POR MOTIVOS: '.$motivo,0,1);
$pdf->Cell(0,10,'DE LO CONTRARIO NO SE LE PREMITIRA LA ENTRADA AL PLANTEL',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'ATENTAMENTE ',0,1,'C');
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'LIC.CRISTINA OVANDO ZAPATA ',0,1,'C');
$pdf->Cell(0,10,'SUBDIRECTORA DEL PLANTEL No.41',0,2,'C');
$pdf->Output();
?>