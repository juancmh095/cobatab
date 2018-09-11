<?php
include 'php/conexion.php';
session_start();

if(!isset($_SESSION["usuario"])){
	
	header("location: login.php");
	}
	$id_admin=$_SESSION['usuario'];
	?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Alumnos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

 
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <link rel="stylesheet" type="text/css" href="css/boton2.css">

    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Inicio</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse"> 
          <ul class="nav navbar-nav">
            <li class="active"><a href="alumnos2.php">Buscar Alumnos</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="justificantes.php">Justificantes</a></li>
            <li><a href="pases.php">Pases de salida</a></li>
           
           
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<hr>
      <div class="starter-template">
        <h1>ALUMNOS</h1>
        <br>

        
<?php

include 'php/conexion.php';
try {  
  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $gbd->beginTransaction();
   $sentencia = $gbd->prepare("SELECT A.*, g.grado, gr.grupo from alumnos AS A, grado AS g, grupo AS gr WHERE g.matricula_grado=A.matricula_grado AND gr.matricula_grupo=A.matricula_grupo");
if ($sentencia->execute()) { 
  ?>
  <table  border="3" style="margin: 0 auto;">
    <thead>
      <tr>
        <th>MATRICULA</th>
        <th>NOMBRE</th>
        <th>AP_PATERNO</th>
        <th>AP_MATERNO</th>
        <th>TELEFONO</th>
        <th>EMAIL</th>
        <th>CURP</th>
        <th>CALLE</th>
        <th>COLONIA</th>
        <th>No.INTERIOR</th>
        <th>No.EXTERIOR</th>
        <th>CP</th>
        <th>MUNICIPIO</th>
        <th>GRUPO</th>
        <th>GRADO</th>
        
              
      </tr>

    </thead>
<tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr>
   
        <td><?php echo $fila['matricula']; ?></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['ap_paterno']; ?></td>
        <td><?php echo $fila['ap_materno']; ?></td>
        <td><?php echo $fila['telefono']; ?></td>
        <td><?php echo $fila['email']; ?></td>
        <td><?php echo $fila['CURP']; ?></td>
        <td><?php echo $fila['calle']; ?></td>
        <td><?php echo $fila['colonia']; ?></td>
        <td><?php echo $fila['no_int']; ?></td>
        <td><?php echo $fila['no_ext']; ?></td>
        <td><?php echo $fila['codigo_postal']; ?></td>
        <td><?php echo $fila['MunicipioA']; ?></td>
        <td><?php echo $fila['grado']; ?></td>
        <td><?php echo $fila['grupo']; ?></td>
      </tr>

    
   <?php
     //$query =  $fila['idgroup'];
     //$query2 = $fila['groupp'];
  }

  ?>
</tbody>
</table>
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
<hr>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>