<?php
if(!isset($_POST["page"])) return false;
if(!is_numeric($_POST["page"])) return false;

require_once("../config.php");
require_once("../inc/classes/class.php");
require_once("../inc/classes/class.usuario.php");
require_once("../inc/classes/class.imagen.php");
require_once("../inc/classes/class.favoritos.php");

$img = new Imagen;
$usr = new Usuario;
$favs = new Favoritos;

if(isset($_GET["view"]) && $_GET["view"] == 'true') $cantidad = 30; else $cantidad = 12;

$cantidad = 12;

$thumbs = $img->visualizar_imagenes($cantidad, ($cantidad * $_POST["page"]) );

if(!is_array($thumbs)){
	echo "end";
	return false;
}


for($i=0;$i<count($thumbs);$i++){
	if(isset($_SESSION["user_rango"]) && ($_SESSION["user_rango"] == 'Admin' || $_SESSION["user_rango"] == 'Moderador')){
		?>
			<div class="Wrapper-thumbnail <?php if($thumbs[$i]['status'] == 'eliminada') echo 'del-img'; ?>">
				<a href="<?php echo RAIZ ?>/imagenes/<?php echo $thumbs[$i]["id_img"] ?>" title="<?php echo $thumbs[$i]["name"] ?>">
					<span style="background:url(<?php echo RAIZ.'/'.$thumbs[$i]["thn"] ?>) no-repeat;"></span>
				</a>
			</div>
		<?php
	}elseif($thumbs[$i]["modo"] == 'publica' && $thumbs[$i]["status"] == 'normal'){
		?>
		<div class="Wrapper-thumbnail">
			<a href="<?php echo RAIZ ?>/imagenes/<?php echo $thumbs[$i]["id_img"] ?>" title="<?php echo $thumbs[$i]["name"] ?>">
				<span style="background:url(<?php echo RAIZ.'/'.$thumbs[$i]["thn"] ?>) no-repeat;"></span>
			</a>
		</div>
		<?php
	}
}
?>
