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

    <title>Agregar Alumno</title>

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
     <?php include 'php/conexion.php'; ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      <p>Nota: Para alta de un alumno se ingresan primeros los datos del tutor</p>
      <h3 align="right"><?php echo $fecha_hoy=date("d-M-Y"); ?></h3>
      <hr>
      <center><h2>TUTOR</h2></center>
      <form action="" method="post">
      <table class="table">
      <thead>
      	<tr>
        	<th>Matricula</th>
           
        </tr>
      </thead>
      <tbody>
      	<tr>
        	<td><input type="text" name="matriT"></td>
                 </tr>
      </tbody>
      </table>
      <button type="submit">Buscar</button>
      </form>
       <?php
				
				
				$matri=$_POST['matriT'];
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT matricula_tutor, nombre_tutor, ap_materno_tutor, ap_paterno_tutor from tutor where matricula_tutor='$matri'");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              <div class="col-md-6">
                           <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th>Nombre</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th
                                    ></tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['matricula_tutor']; ?></td>
   
        <td><?php echo $fila['nombre_tutor']; ?></td>
        <td><?php echo $fila['ap_paterno_tutor']; ?></td>
        <td><?php echo $fila['ap_materno_tutor']; ?></td>        
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
<br>
<br>
<br>
<br>
<br>
<br>
 	<hr>
       <center><h3>Datos del Alumno</h3></center>
    <hr>
   
	
    <form name="agregarAlumno" method="post" action="php/AlumnoA.php">
   	
    <input name="mt" placeholder="Matricula Tutor" value="<?php echo $matri?>">
    <table class="table" style="width:auto;">
    <thead>
    	<tr>
        <th>Matricula</th>
        <th>Nombre</th>
        <th>Ap_paterno</th>
        <th>Ap_materno</th>
        <th>Telefono</th>
    </thead>
    <tbody>
    	<tr>
        <td><input type="text" name="matriculaA" placeholder="Matricula" ></td>
        <td><input type="text" name="nombreA" placeholder="Nombre_alumo"></td>
        <td><input type="text" name="paternoA" placeholder="Ap_paterno"></td>
        <td><input type="text" name="maternoA" placeholder="Ap_materno"></td>
        <td><input type="text" name="telefonoA" placeholder="Telefono"></td>
    </tbody>
    </table>
    <table class="table">
    <thead>
    	<tr>
          </tr>
        <th>Email</th>
        <th>Curp</th>
        <th>Calle</th>
        <th>Colonia</th>
        <th>No_Interior</th>
        </tr>
    </thead>
    <tbody>
    <tr>
     <td><input type="email" name="emailA" placeholder="Email"></td>
     <td><input type="text" name="curpA" placeholder="CURP"></td>
     <td><input type="text" name="calleA" placeholder="Calle"></td>
     <td><input type="text" name="coloniaA" placeholder="Colonia"></td>
     <td><input type="text" name="interiorA" placeholder="No.Interior"></td>
     
        
    </tr>
    </tbody>
    </table>
    <table class="table">
    <thead>
    <tr>
    	<th>No_Exterior</th>
        <th>Codigo Postal</th>
        <th>Municipio</th>
        <th>Grado</th>
        <th>Grupo</th>
        </tr>
       
    </thead>
    <tbody>
    <tr>
     <td><input type="text" name="exteriorA" placeholder="No.Exterior"></td>
     <td><input type="text" name="cpA" placeholder="Codigo Postal"></td>
     <td><input type="text" name="MunicipioA" placeholder="Municipio"></td>
     <td><select name="gradoA">
     <option name:"grado1" value="G0001">G0001 1ero</option>
     </select></td>
     <td><select name="grupoA">
     <option name:"grupo1" value="GR0001">GR0001 Grupo A</option>
     </select></td>       
    </tr>
    </tbody>
    </table>
    <button type="submit">Agregar</button>
    </form>
    

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