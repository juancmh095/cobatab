<?php
include 'connection.php';

$usuario=$_POST['usuario'];
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$ap=$_POST['ap'];
$am=$_POST['am'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$calle=$_POST['calle'];
$colonia=$_POST['colonia'];
$cp=$_POST['cp'];
$fn=$_POST['fn'];
$administrador=$_POST['administrador'];
$municipio=$_POST['municipio'];

//$sentencia = "INSERT INTO category (category) VALUES ('$category')";

try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
  $gbd->exec("INSERT INTO usuario(matricula,nombre,ap_paterno,ap_materno,telefono,email,calle,colonia,cp_usu,fecha_nac,nip,clv_municipio) VALUES ('$usuario','$nombre','$ap','$am','$telefono','$email','$calle','$colonia','$cp','$fn','$administrador','$municipio')");

  $gbd->commit();
   echo "<script>
        alert('Gracias por registrarte')
        window.location='../html/index.php';
        </script>
        ";
    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>

