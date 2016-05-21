<?php
include("classes/class.php");
include("classes/class.imagen.php");
include("classes/class.usuario.php");
include("classes/class.favoritos.php");
$img = new Imagen;
$usr = new Usuario;
$favs = new Favoritos;
$title = "aaaImage - tu hosting de imagenes";
$login = false;

$usr->check_user();

//print_r($_SESSION);
//echo "<br /><br />";
//print_r($_COOKIE);
//echo "<br /><br />";


if(isset($_GET["img"])){
	$imagen = $img->visualizar_imagen();
	($imagen['error'] == false) ? $title = $imagen['name'].' - aaaimage' : $title = 'Wops! - '.$imagen['text'] ;
	$this_page = null;
}

if(isset($_GET["registro"])){
	$this_page = "registro";
}

if(isset($_GET["view"])){
	$this_page = "Imagenes p&uacute;blicas";
	$title = "Imagenes p&uacute;blicas";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php include("head.php"); ?>
<body>

	<!-- Header & Menu -->
	<?php include("header_menu.php");?>
	<!-- Fin header & Menu -->

	<!-- Contenedor -->
	<div id="container">
	<?php
		echo '<div class="clear"></div>';
		
		if(count($_GET) == 0){
			include("upload_box.php");
			
			if($_SESSION["user_type"] == 'temporal') include("login_box.php");
			
			echo '<div class="clear"></div>';
			include("last_images.php");
		}elseif(isset($_GET["img"])){
			include("view_image.php");
			echo '<div class="clear"></div>';
		}elseif(isset($_GET["registro"])){
			include("register_form.php");
			echo '<div class="clear"></div>';
		}elseif(isset($_GET["view"]) && $_GET["view"] == 'true'){
			include("last_images.php");
		}
		
	?>
	</div>
	<!-- Fin contenedor -->
	
	<!-- Footer -->
	<?php include("footer.php"); ?>
	<!-- Fin Footer -->
</body>
</html>
