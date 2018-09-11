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

    <title>Tutores</title>

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
</div>
<?php
				
				include 'php/conexion.php';
				
				$matri=$_POST['matricula'];
				
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT matricula_tutor, nombre_tutor, ap_paterno_tutor, ap_materno_tutor, telefono, email, CURP, calle, colonia, no_int, no_ext, codigo_postal, municipioT from tutor where matricula_tutor='$matri'");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              <div class="col-md-6">
                           
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th>Nombre</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>CURP</th>
                                   		<th>calle</th>
                                        <th>colonia</th>
                                        <th>Numero_interior</th>
                                        <th>Numero_exterior</th>
                                        <th>Codigo Postal</th>
                                        <th>Municipio</th>
                                    </tr>
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
        <td><?php echo $fila['telefono']; ?></td>
        <td><?php echo $fila['email']; ?></td>
        <td><?php echo $fila['CURP']; ?></td>   
        <td><?php echo $fila['calle']; ?></td>
        <td><?php echo $fila['colonia']; ?></td>
        <td><?php echo $fila['no_int']; ?></td>
        <td><?php echo $fila['no_ext']; ?></td>
        <td><?php echo $fila['codigo_postal']; ?></td>  
        <td><?php echo $fila['municipioT']; ?></td>         
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