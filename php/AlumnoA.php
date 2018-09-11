<?php
include 'conexion.php';

$matricula=$_POST['matriculaA'];
$nombre=$_POST['nombreA'];
$paterno=$_POST['paternoA'];
$materno=$_POST['maternoA'];
$telefono=$_POST['telefonoA'];
$email=$_POST['emailA'];
$CURP=$_POST['curpA'];
$calle=$_POST['calleA'];
$colonia=$_POST['coloniaA'];
$interno=$_POST['interiorA'];
$externo=$_POST['exteriorA'];
$CP=$_POST['cpA'];
$municipio=$_POST['MunicipioA'];
$grado=$_POST['gradoA'];
$grupo=$_POST['grupoA'];
$matriculaT=$_POST['mt'];



//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO alumnos(matricula, nombre, ap_paterno, ap_materno, telefono, email, CURP, calle, colonia, no_int, no_ext, codigo_postal, MunicipioA, matricula_grado, matricula_grupo, matricula_tutor) VALUES ('$matricula','$nombre','$paterno','$materno','$telefono','$email','$CURP','$calle','$colonia','$interno','$externo','$CP','$municipio', '$grado', '$grupo', '$matriculaT')");

  $gbd->commit();
   echo "<script>
        alert('Alumno agregado')
		window.location='../index.php';;
        </script>
        ";
    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}


?>