<?php
include 'conexion.php';

$folio=$_POST['folio'];
$hora=$_POST['hora'];
$fecha_exp=date("Y/m/d");
$motivo=$_POST['desc'];
$matri=$_POST['matricula'];
$admin=$_POST['admin'];



//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO pases(folio_pases, hora_salida, fecha_exp_pases, motivos_pases, matricula_alumnos, matricula_admin) VALUES ('$folio','$hora','$fecha_exp','$motivo','$matri','$admin')");

  $gbd->commit();
   echo "<script>
        alert('Pase de salida Generado')
        window.location='../index.php';
        </script>
        ";
    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}


?>