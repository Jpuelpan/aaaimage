<?php
include("classes/class.php");
include("classes/class.imagen.php");
include("classes/class.usuario.php");
$img = new Imagen;
$usr = new Usuario;
$title = "Iniciar sesi&oacute;n - aaaimage";
$login = true;

$usr->check_user();

if($_SESSION["user_type"] == 'registred') header("location:".RAIZ);

if(!empty($_POST["usuario"]) && !empty($_POST["pass"])){
	
	$sesion = $usr->iniciar_sesion($_POST["usuario"],$_POST["pass"]);
	//print_r($sesion);
	//echo "<br /> <br />";
	//print_r($_SESSION);
	if($sesion == 'ok'){
		header("location:".RAIZ);
	}
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
		echo '<div class="clear"></div>';
		include("login_box.php");
		echo '<div class="clear"></div>';
		include("rand_images.php");
	?>
	</div>
	<!-- Fin contenedor -->
	
	<!-- Footer -->
	<?php include("footer.php"); ?>
	<!-- Fin Footer -->

</body>
</html>
