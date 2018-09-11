<?php
include 'php/conexion.php';
session_start();

if(!isset($_SESSION["usuario"])){
	
	header("location: login.php");
	}
	$id_admin=$_SESSION['usuario'];
	
	$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$gbd->beginTransaction();
	$sentencia = $gbd->prepare("SELECT matricula_admin, nombreA, ap_paternoA FROM admin WHERE matricula_admin='$id_admin'");
	$sentencia->execute();
	$fila = $sentencia->fetch();
	$m_admin=$fila['matricula_admin'];
	$nombre_Admin=$fila['nombreA'];
	$apellido=$fila['ap_paternoA'];
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

    <title>Reportes</title>

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
            <li class="active"><a href="alumnos2.php">Alumnos</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a href="justificantes.php">Justificantes</a></li>
            <li><a href="pases.php">Pases de salida</a></li>
            <li><a href="notificacion.php">Notificacion</a></li>
            <?php echo $nombre_Admin." ".$apellido; ?>
           
           
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<hr>
      <div class="starter-template">
      <h3>Administrador: <?php echo $nombre_Admin." ".$apellido; ?></h3>
      
        <h1>Nuevo reporte:</h1>
    <?php echo $fecha_hoy=date("d-M-Y"); ?>

<?php include 'php/conexion.php'; ?>
<form  method="post">
<input type="text" name="matricula" value="" placeholder="Matricula">
</form>
    </div>
<hr>

<?php
				$matricula=$_POST['matricula'];
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.matricula, a.nombre,a.ap_paterno, a.ap_materno, g.grado, gr.grupo from alumnos as a,grado as g, grupo as gr where a.matricula='$matricula' AND g.matricula_grado= a.matricula_grado AND gr.matricula_grupo=a.matricula_grupo;");
				if ($sentencia->execute()) { 
				  while ($fila = $sentencia->fetch()) {
					  ?>
                      <br>
                      <br>
                      <br>
                      <h3>Datos del alumn@</h3>
                      <div id="img" style="width:100px; height:100px; float:left;" align="left"><img src="alumnos/<?php echo $matricula ?>.jpg"/></div>
					  <div id="datos" style="width:300px; height:auto; margin-left:200px;float:none;" align="center">
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
                     </div>
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
  echo "Fallo al guardar los datos: " . $e->getMessage();
}

?>

<?php
include 'php/conexion.php';
$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT MAX(folio_reporte) FROM reporte;'");
$sentencia->execute();
$fila = $sentencia->fetch();
$folio=$fila['MAX(folio_reporte)'];
$folio=$folio+1;
?>


<hr>
<center>
<form  name="form2" action="php/reportes.php" method="post">
<input name="folio" value="<?php echo $folio ?>" placeholder="Folio">
<input name="admin" placeholder="Administrador" value="<?php echo $m_admin;?>">
<input name="matricula" placeholder="Matricula" value="<?php echo $matricula ?>">



<!--<table  border="4" align="center"  style="margin: 0 auto;">

<thead>
<tr>

	<th>MOTIVOS</th>
    <th>SELECCIONAR</th>
    
</tr>
</thead>
<tbody>
<tr>
		
        <td>ACTITUD DE CONSTANTE REBELDIA</td>
        <td><input type="checkbox" name="motivo1" value="ACTITUD DE CONSTANTE REBELDIA"></td>
        
        
</tr>
<tr>
        <td>DESINTERES AL ESTUDIO</td>
        <td><input type="checkbox" name="motivo2" value="DESINTERES AL ESTUDIO"></td  
></tr>
<tr>
        <td>FALTA A LA MORAL</td>
        <td><input type="checkbox" name="motivo3" value="FALTA A LA MORAL"></td  
></tr>
<tr>
        <td>FALTA DE DISCIPLINA</td>
        <td><input type="checkbox" name="motivo4" value="FALTA DE DISCIPLINA"></td  
></tr>

</tbody>

</table>-->
<br/>
<label>Motivo</label>

<select style=" width:300px; height:40px; border-radius:10px; border: inset; " name="motivos">
<option name="motivo1" value="ACTITUD DE CONSTANTE REBELDIA">ACTITUD DE CONSTANTE REBELDIA"</option>
<option name="motivo2" value="DESINTERES AL ESTUDIO">DESINTERES AL ESTUDIO</option>
<option name="motivo3" value="FALTA A LA MORAL">FALTA A LA MORAL</option>
<option name="motivo4" value="FALTA DE DISCIPLINA">FALTA DE DISCIPLINA</option>
</select>
<br/>
OTRO MOTIVO :<input type="text" name="otro" placeholder="Otro motivo">
<br/>
<h6>DESCRIPCION DEL PROBLEMA:</h6>
<br/>
<textarea name="desc" cols="80" rows="3" ></textarea>
<p>NOTA: EL ALUMNO QUE ACUMULE 3 REPORTES SE SUSPENDERAR DEFINITIVAMENTE DE ESTE PLANTEL.</p>


<button type="submit">Generar</button>

</form>

</center>

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