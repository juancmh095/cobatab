<?php
include 'php/conexion.php';
session_start();

if(!isset($_SESSION["usuario"])){
	
	header("location: login.php");
	}
	$id_admin=$_SESSION['usuario'];
	?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/navbar/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Historial alumno</title>

    <!-- Bootstrap core CSS -->
    <link href="./pagina1_files/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./pagina1_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./pagina1_files/navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./pagina1_files/ie-emulation-modes-warning.js.descarga"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="alumnos2.php">Alumnos</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Inicio</a></li>
              <li><a href="reportes.php">Reportes</a></li>
            <li><a href="justificantes.php">Justificantes</a></li>
            <li><a href="pases.php">Pases de salida</a></li>
            <li><a href="notificacion.php">Notificacion</a></li>
            </div>
        </div>
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      <h3 align="right"><?php echo $fecha_hoy=date("d-M-Y"); ?></h3>
 <form  method="post">
 <label>Matricula del alumno</label>
<input type="text" name="matricula" value="" placeholder="Matricula" style="border-radius:10px; width:200px; height:40px; border:inset; text-align:center;">
</form>
<?php include 'php/conexion.php'; ?>

    
<hr>

<?php
				$matricula=$_POST['matricula'];
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.matricula,a.nombre,a.ap_paterno,a.ap_materno,a.email,a.CURP,a.calle,a.colonia,a.no_int,a.no_ext,a.codigo_postal,a.MunicipioA,g.grado,gr.grupo,t.matricula_tutor,t.nombre_tutor,t.ap_paterno_tutor,t.ap_materno_tutor,t.telefono, t.municipioT from alumnos as a, tutor as t, grado as g, grupo as gr WHERE a.matricula='$matricula' AND a.matricula_grado=g.matricula_grado AND a.matricula_grupo=gr.matricula_grupo AND a.matricula_tutor=t.matricula_tutor;");
				if ($sentencia->execute()) { 
				  while ($fila = $sentencia->fetch()) {
					  ?>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Datos del alumno</th>
                                        <th>Datos del tutor</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                      <td><div id="img" style="width:200px; height:200px; float:left;" align="left"><img src="alumnos/1.jpg"/></div></td>
                      <td>
                      <label class=" alert-info" style="font-size:20px">matricula:</label>
					  <label style=" font-size:18px"><?php echo $matricula= $fila['matricula']; ?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Nombre:</label>
					  <label style=" font-size:18px"><?php echo $fila['nombre']; ?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Paterno:</label>                      
					  <label style=" font-size:18px"><?php echo $fila['ap_paterno'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Materno:</label>
					  <label style=" font-size:18px"><?php echo $fila['ap_materno'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Grado:</label>
					  <label style=" font-size:18px"><?php echo $fila['grado'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Grupo:</label>
					  <label style=" font-size:18px"><?php echo $fila['grupo'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Curp:</label>
					  <label style=" font-size:18px"><?php echo $fila['CURP'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">EMAIL:</label>
					  <label style=" font-size:18px"><?php echo $fila['email'];?></label>
                      <h3>Direccion</h3>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Calle:</label>
					  <label style=" font-size:18px"><?php echo $fila['calle'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Colonia:</label>
					  <label style=" font-size:18px"><?php echo $fila['colonia'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">No.Interior</label>
					  <label style=" font-size:18px"><?php echo $fila['no_int'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">No.Exterior:</label>
					  <label style=" font-size:18px"><?php echo $fila['no_ext'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Codigo Postal:</label>
					  <label style=" font-size:18px"><?php echo $fila['codigo_postal'];?></label>
                     <br>
                       <label class=" alert-info" style="font-size:20px">Municipio:</label>
					  <label style=" font-size:18px"><?php echo $fila['MunicipioA'];?></label>
                      <br>
                    
                      </td>
                      <td><h3>Datos del Tutor</h3>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Matricula:</label>
					  <label style=" font-size:18px"><?php echo $fila['matricula_tutor']; ?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Nombre:</label>
					  <label style=" font-size:18px"><?php echo $fila['nombre_tutor']; ?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Paterno:</label>                      
					  <label style=" font-size:18px"><?php echo $fila['ap_paterno_tutor'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Materno:</label>
					  <label style=" font-size:18px"><?php echo $fila['ap_materno_tutor'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Telefono:</label>
					  <label style=" font-size:18px"><?php echo $fila['telefono']; ?></label>
                       <br>
                       <label class=" alert-info" style="font-size:20px">Municipio:</label>
					  <label style=" font-size:18px"><?php echo $fila['municipioT'];?></label>
                      </td>
                      </tr>
                      </tbody>
                      </table>
                      
                      <?php
					  
					  }
					  }else{
    
    echo "<script>
        alert('Se produjo un error al realizar la consulta, intente de nuevo, por favor');
        window.location='index.php';
        </script>
        ";
}    
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al generar: " . $e->getMessage();
}

?>

<!-- Alertas-->
<?php
include 'php/conexion.php';

				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT COUNT(*) FROM reporte WHERE matricula_alumnos= '$matricula'");
				$sentencia->execute();
				$fila = $sentencia->fetch();
				$com= $fila['COUNT(*)'];
				if($com>=3){ 
					$mensaje ="NOTA: El alumno posee ".$com." reportes, lo cual causa suspencion inmediata";
					?>
                    <div class="alert alert-danger"><h4><?php echo $mensaje ?></h4></label></div>
                    <?php
					}elseif($com<3&&$com>1){
						$mensaje="NOTA: El alumno cuenta con ". $com ." reportes";
						?>
                        <div class="alert alert-warning"><h4><?php echo $mensaje ?></h4></div>
                        <?php
						}elseif($com<=1){
							$mensaje="NOTA: El alumno cuenta con ". $com ." reporte";
							?>
					        <div class="alert alert-info"><h4><?php echo $mensaje ?></h4></div>
							<?php
							}
					
					  
					   
} catch (Exception $e) {
  $gbd->rollBack();
  echo "Fallo al consultar: " . $e->getMessage();
}

?>

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
             
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha_Creacion</th>
                                        <th>Motivo</th>
                                        <th>Descripcion</th>
                                        <th>Elaborado por:</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_reporte']; ?></td>
   
        <td><?php echo $fila['fecha_exp']; ?></td>
        <td><?php echo $fila['motivo']; ?></td>
        <td><?php echo $fila['des']; ?></td>
        <td><?php echo $fila['nombreA']." ".$fila['ap_paternoA'];?>
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
              
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha_Creacion</th>
                                        <th>Fecha de cita</th>
                                        <th>Hora de la cita</th>
                                        <th>Motivo</th>
                                        <th>Elborado por:</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['folio_cita']; ?></td>
   
        <td><?php echo $fila['fecha_exp_cita']; ?></td>
        <td><?php echo $fila['fecha_cita']; ?></td>
        <td><?php echo $fila['hora_cita']; ?></td>
        <td><?php echo $fila['motivos_cita']; ?></td>
        <td><?php echo $fila['nombreA']." ".$fila['ap_paternoA'];?>
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
              
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Hora de salida</th>
                                        <th>Fecha_Creacion</th>
                                        <th>Motivo</th>
                                        <th>Elaborado por:</th>
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
        <td><?php echo $fila['motivos_pases']; ?></td>
        <td><?php echo $fila['nombreA']." ".$fila['ap_paternoA'];?>
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

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./pagina1_files/jquery.min.js.descarga"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./pagina1_files/bootstrap.min.js.descarga"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./pagina1_files/ie10-viewport-bug-workaround.js.descarga"></script>
  

</body></html>