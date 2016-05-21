<?php
require_once("../config.php");
require_once("../inc/classes/class.php");
require_once("../inc/classes/class.usuario.php");
require_once("../inc/classes/class.imagen.php");
require_once("../inc/classes/class.favoritos.php");

$img = new Imagen;
$usr = new Usuario;
$favs = new Favoritos;

$DelFav = $favs->eliminar_favorito((int)$_POST["id"]);

if($DelFav == 'error' || $DelFav == 0){
	$resp["glb"] = 'Aerr';
	$resp["res"] = 'error';
	$resp["txt"] = 'Disculpas, ha ocurrido un error, reintentelo m&aacute;s tarde por favor';
	echo json_encode($resp);
}elseif($DelFav == 1){
	$resp["glb"] = 'Gscs';
	$resp["res"] = 'ok';
	$resp["txt"] = 'La imagen ha sido eliminada exitosamente.';
	echo json_encode($resp);
}elseif($DelFav == 'ses'){
	$resp["glb"] = 'Gscs';
	$resp["res"] = 'sinses';
	$resp["txt"] = 'Inicia sesi&oacute;n para realizar esta acci&oacute;n.';
	echo json_encode($resp);
}


//print_r($DelFav);

?>
