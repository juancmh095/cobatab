<?php
include 'conexion.php';

$folio=$_POST['folio'];
$admin=$_POST['admin'];
$fecha=date("Y/m/d");
$motivo=$_POST['motivos']." ".$_POST['otro'];
$des=$_POST['desc'];
$matri=$_POST['matricula'];


//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO reporte(folio_reporte, fecha_exp, motivo, des, matricula_alumnos, matricula_admin) VALUES ('$folio','$fecha','$motivo','$des','$matri','$admin')");

  $gbd->commit();
     echo'<h2>REPORTE GENERADO</h2>';
  echo '<a  href="pdf3.php?folio='.urlencode($folio).'">imprimir</a>';
  
  
  
    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
