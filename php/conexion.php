<?php

  try {
    $usuario = 'root';
    $contrasena = '';
    $gbd = new PDO('mysql:host=127.0.0.1;dbname=sistema_reporte', $usuario, $contrasena);
    array(PDO::ATTR_PERSISTENT => true);
    //echo "Conectado\n";

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
