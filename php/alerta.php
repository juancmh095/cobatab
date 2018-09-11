<?php
include 'conexion.php';

				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT COUNT(*) FROM reporte;");
				$sentencia->execute();
				$fila = $sentencia->fetch();
				echo $fila['COUNT(*)'];
				$com= $fila['COUNT(*)'];
				if($com>=3){ 
					$mensaje ="El alumno causa baja directa";
					}else{
						$mensaje="el alumno cuenta con ". $com ." reportes";
						}
					
					  
					   
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al consultar: " . $e->getMessage();
}

?>