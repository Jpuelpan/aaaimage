<?php

require_once("../config.php");
require_once("../inc/classes/class.php");
require_once("../inc/classes/class.usuario.php");
require_once("../inc/classes/class.imagen.php");
require_once("../inc/classes/class.favoritos.php");

$img = new Imagen;
$usr = new Usuario;
$favs = new Favoritos;

$fav = $favs->agregar_favorito($_POST["token"]);

if($fav == 'exts'){
	$resp["gbl"] = "Aerr";
	$resp["res"] = "a";
	$resp["txt"] = "La imagen ya está en sus favoritos";
	echo json_encode($resp);
}elseif($fav >= 1){
	$resp["gbl"] = "Gscs";
	$resp["res"] = "c";
	$resp["txt"] = "Imagen agregada a favoritos.";
	echo json_encode($resp);
}elseif($fav == 0){
	$resp["gbl"] = "Aerr";
	$resp["res"] = "b";
	$resp["txt"] = "Disculpas, ha ocurrido un error.";
	echo json_encode($resp);
}elseif($fav == 'ses'){
	$resp["gbl"] = "Gscs";
	$resp["res"] = "d";
	$resp["txt"] = "Inicia sesi&oacute;n para realizar esta acci&oacute;n.";
	echo json_encode($resp);
}

?>
