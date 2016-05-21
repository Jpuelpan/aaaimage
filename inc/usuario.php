<?php
include("classes/class.php");
include("classes/class.imagen.php");
include("classes/class.usuario.php");
include("classes/class.favoritos.php");

$img = new Imagen;
$usr = new Usuario;
$favs = new Favoritos;

switch($_GET["section"]){
	case 'favoritos' : $title = "Mis im&aacute;genes favoritas" ; break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php include("head.php"); ?>
<body>

	<!-- Header & Menu -->
	<?php include("header_menu.php"); ?>
	<!-- Fin header & Menu -->

	<!-- Contenedor -->
	<div id="container">
	<?php
		//print_r($_GET);
		if($_GET["section"] == 'favoritos') include("view_favs.php");
	?>
	</div>
	<!-- Fin contenedor -->
	
	<!-- Footer -->
	<?php include("footer.php"); ?>
	<!-- Fin Footer -->
</body>
</html>
