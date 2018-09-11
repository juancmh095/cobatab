<?php
include 'conexion.php';

$folio=$_POST['folio'];
$fecha2=date('Y/m/d');
$admin=$_POST['admin'];
$matri=$_POST['matricula'];
$hora=$_POST['hora'];
$fechaJ=$_POST['fecha'];
$motivo=$_POST['desc'];
$materias=$_POST['Materias'];



//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO justificante(folio_justificante, fecha, motivos, fecha_jus, hora_inicio, materias, matricula_alumnos, matricula_admin) VALUES ('$folio','$fecha2','$motivo','$fechaJ','$hora','$materias','$matri','$admin')");

  $gbd->commit();
  echo'<h2>Pase Generado</h2>';
  echo '<a href="pdf4.php?folio='.urlencode($folio).'">imprimir</a>';
  
  
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
