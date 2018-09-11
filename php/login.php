<?php
include 'conexion.php';
$contraseña=$_POST['pass'];
$usuario=$_POST['usuario'];

	session_start();



				
				  $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				  $gbd->beginTransaction();
				$sentencia = $gbd->prepare("SELECT matricula_admin, contrasena FROM admin WHERE matricula_admin='$usuario' AND contrasena='$contraseña'");
				$sentencia->execute();
				$fila=$sentencia->rowCount();
				if($fila > 0){
					$fila = $sentencia->fetch();
					$_SESSION['usuario']=$fila['matricula_admin'];
					$_SESSION['contraseña']=$fila['contrasena'];
					
					}
					
		if(isset($_SESSION["usuario"])){
	
	header("location: ../index.php");
	}else{
		header("location: ../login.php");
		}
					  

?>



