<?php
include 'php/conexion.php';
session_start();

if(!isset($_SESSION["usuario"])){
	
	header("location: login.php");
	}
	$id_admin=$_SESSION['usuario'];
	
	$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$gbd->beginTransaction();
	$sentencia = $gbd->prepare("SELECT nombreA, ap_paternoA FROM admin WHERE matricula_admin='$id_admin'");
	$sentencia->execute();
	$fila = $sentencia->fetch();
	$nombre_Admin=$fila['nombreA'];
	$apellido=$fila['ap_paternoA'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de control de reportes</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><i class="fa fa-square-o "></i>BIENVENID@<?php echo " ".$nombre_Admin." ".$apellido ?></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="php/logout.php">Cerrar sesion</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="img/logo_pb.jpg" class="img-responsive" />
                     
                    </li>


                    <li>
                        <a href="index.php"><i class="fa fa-desktop "></i>Inicio</a>
                    </li>
                    <li>
                        <a href="imprimir2.php" target="_blank"><i class="fa fa-archive "></i>Imprimir varios</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users "></i>Alumnos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="alumnos2.php" target="_blank">Ver</a>
                            </li>
                            <li>
                                <a href="historial.php" target="_blank">Historial</a>
                            </li>
                            <li>
                                <a href="tutor.php" target="_blank">Agregar</a>
                            </li>
                            <li>
                                <a href="tutores.php" target="_blank">Tutores</a>
                                
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit "></i>Reportes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="reportes.php" target="_blank">Nuevo</a>
                            </li>
                           
                           
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil "></i>Justificantes<span class="fa arrow"></span></a>
                         <ul class="nav nav-third-level">
                                            <li>
                                                <a href="justificante.php" target="_blank">Nuevo</a>
                                            </li>
                                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-calendar "></i>Citatorios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="notificacion.php" target="_blank">Nuevo</a>
                            </li>
                            
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-arrow-circle-o-left "></i>Pases de salida<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="pases.php" target="_blank">Nuevo</a>
                            </li>
                            </ul>
                    </li>
                   
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php 
					$hora = time();
					$fecha= date("d-M-Y"); 
					?>
                     <h2>Sistema de control de reportes    <?php echo $fecha ?></h2>   
                    </div>
                </div>              
                 
                  <hr />
                  <!-- inicio del cuerpo -->
                  <center>
                  <form method="post">
				<input style="border-style:solid; border-radius:5px; font-family:Verdana, Geneva, sans-serif " type="date" name="fecha" value="<?php echo $fecha2=date('Y-m-d') ?>" step="1" \>
                <button type:"subimit">Buscar</button>                 
                 </form>
                 </center>
                 <hr/>
                 <?php
				include 'php/conexion.php';
				$fecha= $_POST['fecha'];
				$fecha_s= date('Y/m/d');
				try {  
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				   $sentencia = $gbd->prepare("SELECT a.matricula, a.nombre, a.ap_paterno, a.ap_materno, g.grado, gr.grupo, t.nombre_tutor, t.ap_paterno_tutor, t.ap_materno_tutor, c.fecha_cita, c.motivos_cita from alumnos as a, citatorios as c, tutor as t, grado as g, grupo as gr WHERE c.fecha_cita='$fecha' AND a.matricula_grado=g.matricula_grado AND a.matricula_grupo=gr.matricula_grupo AND a.matricula_tutor=t.matricula_tutor AND c.matricula_alumnos=a.matricula");
				if ($sentencia->execute()) { 
				  ?>
                  <center>
              <div class="col-md-6">
                        <h5>Reportes del Dia <?php echo $fecha?></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-responsive table-condensed">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th>Nombre_Alumno</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Grado</th>
                                        <th>Grupo</th>
                                        <th>Nombre_Tutor</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Fecha de la cita</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
  <?php
  

  while ($fila = $sentencia->fetch()) {
    ?>
     <tr class="success">
        <td><?php echo $fila['matricula']; ?></td>
   
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['ap_paterno']; ?></td>
        <td><?php echo $fila['ap_materno']; ?></td>
        <td><?php echo $fila['grado']; ?></td>
        <td><?php echo $fila['grupo']; ?></td>
        <td><?php echo $fila['nombre_tutor']; ?></td>+
        <td><?php echo $fila['ap_paterno_tutor']; ?></td>
        <td><?php echo $fila['ap_materno_tutor']; ?></td>
		<td><?php echo $fila['fecha_cita']; ?></td>
        <td><?php echo $fila['motivos_cita']; ?></td>
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
       
        </div>
        
   
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
