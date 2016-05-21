<?php

require_once("../config.php");
require_once("../inc/classes/class.php");
require_once("../inc/classes/class.usuario.php");
require_once("../inc/classes/class.imagen.php");

$img = new Imagen;
$usr = new Usuario;


if((int)$_POST["ds"] == 0){
	$resp = $img->eliminar_imagen($_POST["token"]);
}elseif((int)$_POST["ds"] == 1){
	$resp = $img->restaurar_imagen($_POST["token"]);
}

print_r($resp);


?>
