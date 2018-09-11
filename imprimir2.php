<?php
include 'php/conexion.php';
session_start();

if(!isset($_SESSION["usuario"])){
	
	header("location: login.php");
	}
	$id_admin=$_SESSION['usuario'];
	?>
<!DOCTYPE html>

	<head>
 	<title>Imprimir</title>
 	<link href="css/bootstrap.css" rel="stylesheet">
  	</head>

  <body>
<div class="container pagination-centered">


<div class="row">
<div class="span12">
<br/>
<a href="index.php" class="btn">Regresar al Inicio</a>
<br/>
<br/>
</div>
</div>


<div class="row-fluid">
<div class="span12">
<form method="post">
<label for="">Matricula</label>
<input name="matricula" type="text">
<br>
<button class="btn">Buscar</button>
</form>
</div>
</div>
<?php include 'php/conexion.php'; 
	$matricula=$_POST['matricula'];
?>

<div class="row-fluid">
<div class="span12">
<?php
try{
	 $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $gbd->beginTransaction();
	 $sentencia = $gbd->prepare("SELECT nombre, ap_paterno, ap_materno FROM alumnos WHERE matricula ='$matricula'");
	 $sentencia->execute();
	 $fila = $sentencia->fetch();
	 echo "<label class='label-info'>"."ALUMN@: ". $fila['nombre']." ".$fila['ap_paterno']." ".$fila['ap_materno']."</label>";
	}
	catch(Exeption $e){
		
		}
?>

</div>
</div>

<div class="row-fluid">
<div class="span3">
<form method="post" action="imprimir/pdf3.php" target="_blank">
<label>Folio Reporte</label>
<input type="text" name="folio">
<button class="btn">Imprimir</button>
</form>
</div>
<div class="span3">
<form method="post" action="imprimir/pdf2.php" target="_blank">
<label>Folio Citatorio</label>
<input type="text" name="folio">
<button class="btn">Imprimir</button>
</form>
</div>
<div class="span3">
<form method="post" action="imprimir/pdf1.php" target="_blank">
<label>Folio Pases</label>
<input type="text" name="folio">
<button class="btn">Imprimir</button>
</form>
</div>
<div class="span3">
<form method="post" action="imprimir/pdf4.php" target="_blank">
<label>Folio Justificantes</label>
<input type="text" name="folio">
<button class="btn">Imprimir</button>
</form>
</div>
</div>



<div class="row">
<div class="span3">
<hr>
<center><h3>Reportes</h3></center>
<hr>
<?php
				include 'php/conexion.php';
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT r.*, a.nombreA, a.ap_paternoA from reporte AS r, admin AS a where r.matricula_alumnos='$matricula' AND r.matricula_admin=a.matricula_admin");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
             
                            <table class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha_Creacion</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_reporte']; ?></td>
   
        <td><?php echo $fila['fecha_exp']; ?></td>
      </tr>

    
   <?php
     //$query =  $fila['idgroup'];
     //$query2 = $fila['groupp'];
  }

  ?>
</tbody>
</table>
</center>
<?php

}else{
    
    echo "<script>
        alert('Se produjo un error al realizar la consulta, intente de nuevo, por favor');
        window.location='../../index.php';
        </script>
        ";
}    

//echo $actual;
//$gbd->exec("update product set quantity = '$actual' where product = '$product'");

    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
</div>
<div class="span3">

<hr>
<center><h3>Citatorios</h3></center>
<hr>
<?php
				include 'php/conexion.php';
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT r.*, a.nombreA, a.ap_paternoA from citatorios as r, admin as a where r.matricula_alumnos='$matricula' AND r.matricula_admin=a.matricula_admin");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              
                            <table class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha_Creacion</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_cita']; ?></td>
   
        <td><?php echo $fila['fecha_exp_cita']; ?></td>
      </tr>

    
   <?php
     //$query =  $fila['idgroup'];
     //$query2 = $fila['groupp'];
  }

  ?>
</tbody>
</table>
</center>
<?php

}else{
    
    echo "<script>
        alert('Se produjo un error al realizar la consulta, intente de nuevo, por favor');
        window.location='../../index.php';
        </script>
        ";
}    

//echo $actual;
//$gbd->exec("update product set quantity = '$actual' where product = '$product'");

    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>

</div>
<div class="span3">
<hr>
<center><h3>Pases de salida</h3></center>
<hr>
<?php
				include 'php/conexion.php';
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT r.*, a.nombreA, a.ap_paternoA from pases as r, admin as a where r.matricula_alumnos='$matricula' AND r.matricula_admin=a.matricula_admin");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              
                            <table class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Hora de salida</th>
                                        <th>Fecha_Creacion</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_pases']; ?></td>
   
        <td><?php echo $fila['hora_salida']; ?></td>
        <td><?php echo $fila['fecha_exp_pases']; ?></td>
      </tr>

    
   <?php
     //$query =  $fila['idgroup'];
     //$query2 = $fila['groupp'];
  }

  ?>
</tbody>
</table>

</center>
<?php

}else{
    
    echo "<script>
        alert('Se produjo un error al realizar la consulta, intente de nuevo, por favor');
        window.location='../../index.php';
        </script>
        ";
}    

//echo $actual;
//$gbd->exec("update product set quantity = '$actual' where product = '$product'");

    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
</div>
<div class="span3">
<hr>
<center><h3>Justificantes</h3></center>
<hr>
<?php
				include 'php/conexion.php';
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT folio_justificante, fecha, motivos FROM justificante where matricula_alumnos='$matricula'");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              
                            <table class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha_Creacion</th>
                                        <th>Motivos</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_justificante']; ?></td>
   
        <td><?php echo $fila['fecha']; ?></td>
        <td><?php echo $fila['motivos']; ?></td>
      </tr>

    
   <?php
     //$query =  $fila['idgroup'];
     //$query2 = $fila['groupp'];
  }

  ?>
</tbody>
</table>

</center>
<?php

}else{
    
    echo "<script>
        alert('Se produjo un error al realizar la consulta, intente de nuevo, por favor');
        window.location='../../index.php';
        </script>
        ";
}    

//echo $actual;
//$gbd->exec("update product set quantity = '$actual' where product = '$product'");

    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al guardar los datos: " . $e->getMessage();
}
?>
</div>

</div>
</div>
   
  

</body></html>