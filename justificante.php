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

    <title>Jutificantes</title>

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
           
           
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<hr>
      <div class="starter-template">
      <h3>Administrador: <?php echo $nombre_Admin." ".$apellido; ?></h3>
        <h1>Nuevo Justificante:</h1>
        <?php echo $fecha_hoy=date("d-M-Y"); ?>
<?php include 'php/conexion.php'; ?>
<form  method="post">
<input type="text" name="matricula" value="" placeholder="Matricula">
</form>
    
<hr>

<?php
				$matricula=$_POST['matricula'];
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.matricula, a.nombre,a.ap_paterno, a.ap_materno, g.grado, gr.grupo, t.nombre_tutor, t.ap_paterno_tutor, t.ap_materno_tutor from alumnos as a,tutor as t,grado as g, grupo as gr where a.matricula='$matricula' AND a.matricula_tutor=t.matricula_tutor AND g.matricula_grado= a.matricula_grado AND gr.matricula_grupo=a.matricula_grupo;");
				if ($sentencia->execute()) { 
				  while ($fila = $sentencia->fetch()) {
					  ?>
                      
                       <div id="img" style="width:100px; height:100px; float:left;" align="left"><img src="alumnos/<?php echo $matricula ?>.jpg"/></div>
					  <div id="datos" style="width:300px; height:auto; margin-left:200px;float:none;" align="center">
                      <h3>Datos del alumn@</h3>
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
                      
                      </div>
                      
                      
					  <div id="datos" style="width:300px; height:auto; margin-top:-260px;margin-left:510px;float:left;" align="center">
                      
                      <h3>Datos del Tutor</h3>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Nombre:</label>
					  <label style=" font-size:18px"><?php echo $fila['nombre_tutor']; ?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Paterno:</label>                      
					  <label style=" font-size:18px"><?php echo $fila['ap_paterno_tutor'];?></label>
                      <br>
                      <label class=" alert-info" style="font-size:20px">Ap.Materno:</label>
					  <label style=" font-size:18px"><?php echo $fila['ap_materno_tutor'];?></label>
                    
                      </div>
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
$sentencia = $gbd->prepare("SELECT MAX(folio_justificante) FROM justificante;'");
$sentencia->execute();
$fila = $sentencia->fetch();
$folio=$fila['MAX(folio_justificante)'];
$folio=$folio+1;
?>

<center>
<form name="form2" action="php/justificante.php" method="post">
<input name="folio" value="<?php echo $folio ?>" placeholder="Folio">
<input class="input-sm" value="<?php echo $m_admin; ?>" name="admin" placeholder="Administrador">
<input name="matricula" placeholder="Matricula" value="<?php echo $matricula ?>">
<br>
<label style="font-size:20px">Dia a Justificar:</label>
<input type="date" name="fecha" value="">
<br>
<label style="font-size:20px">apartir de :</label>
<input type="text" name="hora" placeholder="Horario de cita">
<br>
<label style="font-size:20px">Motivo:</label>
<br>
<textarea name="desc" cols="80" rows="3" ></textarea>
<br>
<label style="font-size:20px">Materias:</label>
<br>
<textarea name="Materias" cols="100" rows="6" ></textarea>
<button type="submit" name="guardar" style="width:auto";>Guardar e Imprimir</button>
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