
<?php
include 'conexion.php';

$matricula=$_POST['matricula'];
$nombre=$_POST['nombre'];
$paterno=$_POST['paterno'];
$materno=$_POST['materno'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$CURP=$_POST['curp'];
$calle=$_POST['calle'];
$colonia=$_POST['colonia'];
$interno=$_POST['interno'];
$externo=$_POST['externo'];
$CP=$_POST['cp'];
$municipio=$_POST['Municipio'];



//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO tutor(matricula_tutor, nombre_tutor, ap_paterno_tutor, ap_materno_tutor, telefono, email, CURP, calle, colonia, no_int, no_ext, codigo_postal, municipioT) VALUES ('$matricula','$nombre','$paterno','$materno','$telefono','$email','$CURP','$calle','$colonia','$interno','$externo','$CP','$municipio')");

  $gbd->commit();
 

	echo "<script>
        alert('Datos del Tutor Agregados')
		window.location='../alumnoA.php';
        </script>
        ";
    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}


?>
