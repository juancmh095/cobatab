<?php
include 'conexion.php';

$folio=$_POST['folio'];
$admin=$_POST['admin'];
$fecha_exp=date("Y/m/d");
$fecha_cita=$_POST['fecha_cita'];
$motivo=$_POST['desc'];
$matri=$_POST['matricula'];
$hora=$_POST['hora'];
$docente=$_POST['maestro'];


//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO citatorios(folio_cita, hora_cita, fecha_exp_cita, fecha_cita, motivos_cita, docente, matricula_alumnos, matricula_admin) VALUES ('$folio','$hora','$fecha_exp','$fecha_cita','$motivo','$docente','$matri','$admin')");

  $gbd->commit();
  echo'<h2>Pase Generado</h2>';
  echo '<a href="pdf2.php?folio='.urlencode($folio).'">imprimir</a>';
  
  
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
