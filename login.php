<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />

<script src="js/bootstrap.min.js"></script>
<title>Bienvenido</title>
</head>
<body>
<center>
<div class="container-fluid">
<div class="row-fluid">
<div class="span6">
<img src="img/logo_pb.jpg" style="padding-top:130px"/>
<center>
<h3>SISTEMA DE CONTROL DE ORDEN</h3>
</center>
</div>
<div class="span6" style="padding-top:210px">
<div class="panel panel-default" style="width:300px">
<div class="panel-heading"><p class="text-success">IDENTIFICATE</p></div>
<div class="panel-body">


<form class="form-actions icon" action="php/login.php"  method="post">
    
    <i class="icon-user"></i>
    <input class="input-large" type="text" placeholder="Usuario" name="usuario"  autofocus/>
    <br />
    <i class="icon-lock"></i>
    <input class="input-large" type="password" placeholder="Contraseña" name="pass"  />
    <br />
    <button class="btn" type="submit">
      <i class="spinner"></i>
      Iniciar sesion
    </button>
  </form>
  
  </center>
  </div>
</div>
</div>
</div>

<center>
  <footer style="padding-top:110px;"><p>&copy Juan Carlos Méndez Hernández</p></footer>
  </center>
  
  </div>
</body>
</html>
